<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\AttributeDetailsModel;
use App\Models\ProductCategoryModel;
use App\Models\BrandsModel;
use App\Models\TransactionsModel;
use App\Models\TransactionDetailModel;
use CodeIgniter\API\ResponseTrait;

class Transactions extends BaseController
{
    use ResponseTrait;

    protected $productsModel; 
    protected $transactionsModel; 
    protected $transactionDetailsModel; 

    //* Constructor
    public function __construct()
    {
        $this->productsModel = new ProductsModel();
        $this->transactionsModel = new TransactionsModel();
        $this->transactionDetailsModel = new TransactionDetailModel();
    }

    //* ---------- PAGES --------------------

    //* Index Page
    public function index()
    {

        $db = db_connect();

        $query = $db->query("SELECT p.id_product, p.nama_product, p.harga_product,  p.foto_product, p.stok_total, c.nama_category, b.nama_brand
                            , ad_warna.nilai as warna , ad_ukuran.nilai as ukuran
                            FROM products p
                            LEFT JOIN product_category c ON p.id_category = c.id_category
                            LEFT JOIN brands b on p.id_brand = b.id_brand
                            LEFT JOIN attribute_details ad_warna on p.id_details_warna = ad_warna.id_details
                            LEFT JOIN attribute_details ad_ukuran on p.id_details_ukuran = ad_ukuran.id_details
                            ");

        $products = $query->getResult();
        $rupiahFormatter = new \App\Controllers\RupiahFormatter();
        
        foreach($products as $p)
        {
            $p->foto_product = 'data:image/jpeg;base64,' . base64_encode($p->foto_product);
            $p->harga_product = $rupiahFormatter->formatRupiah($p->harga_product);
        }

        $data = [
            'title' => 'Halaman Transaksi',
            'pageTitle' => 'Transaksi',
            'products' => $products,
            'validation' => \config\Services::validation()
        ];

        return view('Transactions/TransactionsPage.php', $data );
    }

    public function todayTransaction()
    {
        $today = date('Y-m-d');
        $transactions = $this->transactionsModel
        ->where('tanggal_transaksi >=', $today . ' 00:00:00')
        ->where('tanggal_transaksi <=', $today . ' 23:59:59')->findAll();

        $data = [
            'title' => 'Transaksi Hari ini',
            'pageTitle' => 'Transaksi',
            'transactions' => $transactions,
            'validation' => \config\Services::validation()
        ];

        return view('Transactions/TodayTransactionPage.php', $data );

    }


    public function todayTransactiondetails($id)
    {
        $db = db_connect();

        $query = $db->query("SELECT * FROM transaction_details td
                            RIGHT JOIN transactions t ON td.id_transaksi = t.no_struk_transaksi
                            LEFT JOIN products p on td.id_produk = p.id_product
                            WHERE t.no_struk_transaksi = $id;
                            ");

        $transaction_details = $query->getResult();

        foreach($transaction_details as $p)
        {
            $p->foto_product = 'data:image/jpeg;base64,' . base64_encode($p->foto_product);
        }


        $data = [
            'title' => 'Transaksi Hari ini',
            'pageTitle' => 'Detail Transaksi',
            'transaction_details' => $transaction_details,
            'validation' => \config\Services::validation()
        ];

        return view('Transactions/TodayTransactionDetails', $data );

    }



        

    //* ------------------- ACTIONS --------------------------------------


    public function addToCart()
    {
        $id_product = $this->request->getPost('id_product');
        $jumlah =  $this->request->getPost("jumlah");
        $detailProduct = $this->productsModel->find($id_product);
        $total_harga = (int)$detailProduct['harga_product'] * (int)$jumlah;

        $productsData = array(
            'id_product' => $id_product,
            'nama_product' => $detailProduct['nama_product'], // Ganti product_name dengan kolom yang sesuai
            'harga_unit' => $detailProduct['harga_product'], // Ganti product_price dengan kolom yang sesuai
            'jumlah' => $jumlah,
            'total_harga' => $total_harga
        );

        //* cek cart ada/tidak
        $cart = session()->get('cart') ?? array();
        $cart[] =$productsData;

        //* hitung total_transaksi
        $total_transaksi = 0;
        foreach($cart as $c){
            $total_transaksi+=(int)$c['total_harga'];
        }

        session()->set('total_transaksi',$total_transaksi);
        session()->set('cart', $cart);

        return redirect()->to(site_url('transactions'));
    }

    public static function notEmptyMultiDim($array){
        foreach ($array as $element) {
            if (is_array($element)) {
                if (!self::notEmptyMultiDim($element)) {
                    return false;
                }
            } else {
                if (empty($element)) {
                    return false;
                }
            }
        }
        return true;
    }


    public static function countSame($array)
    {
        $countFirst = count($array[0]);
        foreach($array as $a) :
            if($countFirst != count($a))
            return false;
        endforeach;

        return true;
    }

    public function updateProductStock($id_product, $quantity_sold)
    {
        $product = $this->productsModel->find($id_product);
        if ($product) {
            $new_stock = $product['stok_total'] - $quantity_sold;
            $this->productsModel->update($id_product, ['stok_total' => $new_stock]);        
        }
    }

    public function insertLogSell(array $data)
    {
        //* User
        $currentUser =  session()->get('id_user');
        //* Date Log
        $date = date('Y-m-d H:i:s');
        //* Model Log
        $LogsModel = new \App\Models\LogsModel();

        
        $logData = [
            'id_product' => $data[0], // ID produk yang dihapus
            'log_action' => 'out', // atau sesuai yang Anda butuhkan untuk menandakan log hapus produk
            'quantity' => $data[1],
            'date' => $date,
            'id_user' => $currentUser,
            'deskripsi' => 'terjual' 
        ];

        $LogsModel->insert($logData);
    }

    public function checkOut()
    {
        try{

            $id_product = $this->request->getPost('id_product');
            $jumlah =  $this->request->getPost("jumlah");
            $harga_per_unit =  $this->request->getPost("harga_per_unit");
            $total_harga = $this->request->getPost("total_harga");
            
            $total_transaksi =  ($_SESSION['total_transaksi']);
            $tanggal_transaksi = date('Y-m-d H:i:s');
            
            $transactions = [
            'tanggal_transaksi' => $tanggal_transaksi,
            'total_transaksi' => $total_transaksi
        ];

        $this->transactionsModel->save($transactions);
        $newlyInsertedId = $this->transactionsModel->insertID();
        
        
        $combine = [$id_product,$jumlah, $harga_per_unit, $total_harga];
        if(self::notEmptyMultiDim($combine) && self::countSame($combine))
        {
            $detailToInsert = array();
            for($i = 0 ;$i <count($id_product); $i++)
            {
                $detailToInsert[]=array(
                    'id_transaksi' => $newlyInsertedId,
                    'id_produk' => $id_product[$i],
                    'jumlah' => $jumlah[$i],
                    'harga_per_unit' => $harga_per_unit[$i],
                    'total_harga' => $total_harga[$i]
                );
            }
            
            //*insert batch data
            $this->transactionDetailsModel->insertBatch($detailToInsert);


            //* Update Kurangin Jumlah Produk
            foreach($detailToInsert as $d)
            {
                self::updateProductStock($d['id_produk'],$d['jumlah']);
                self::insertLogSell([$d['id_produk'],$d['jumlah']]);
            }
            
            session()->remove('cart');
            session()->remove('total_transaksi');
            


            //* Update Catat Transaksi Out
            
            session()->setFlashdata('success', 'Checkout successful!');
            return redirect()->to(site_url('/transactions'));
        }else{
            
        }
    }catch(\Exception $e){
        echo "Terjadi kesalahan: " . $e->getMessage();
    }
        
        }
}

?>
