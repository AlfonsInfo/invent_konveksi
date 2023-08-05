<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\AttributeDetailsModel;
use App\Models\ProductCategoryModel;
use App\Models\BrandsModel;
use CodeIgniter\API\ResponseTrait;

class Products extends BaseController
{
    use ResponseTrait;

    protected $productsModel; 

    //* Constructor
    public function __construct()
    {
        //* ini juga bisa dilakukan di Base Controller in case semua controller butuh data ini
        $this->productsModel = new ProductsModel();
    }

    //* ---------- PAGES --------------------

    //* Index Page
    public function index()
    {

        $db = db_connect();

        $query = $db->query("SELECT p.id_product, p.nama_product, p.harga_product, p.foto_product, p.stok_total, c.nama_category, b.nama_brand
                            , ad_warna.nilai as warna , ad_ukuran.nilai as ukuran
                            FROM products p
                            LEFT JOIN product_category c ON p.id_category = c.id_category
                            LEFT JOIN brands b on p.id_brand = b.id_brand
                            LEFT JOIN attribute_details ad_warna on p.id_details_warna = ad_warna.id_details
                            LEFT JOIN attribute_details ad_ukuran on p.id_details_ukuran = ad_ukuran.id_details
                            WHERE p.deleted_at  IS NULL
                            ");

        $products = $query->getResult();
        $rupiahFormatter = new \App\Controllers\RupiahFormatter();
        
            foreach($products as $p)
            {
                $p->foto_product = 'data:image/jpeg;base64,' . base64_encode($p->foto_product);
                $p->harga_product = $rupiahFormatter->formatRupiah($p->harga_product);
            }

        $data = [
            'title' => 'Produk',
            'pageTitle' => 'Produk',
            'products' => $products,
            'validation' => \config\Services::validation()
        ];

        return view('Products/ProductsPage.php', $data );
    }



        //*Create Page
        public function createPage()
        {
            //* Attribute values
            $AttributeDetailsModel = new AttributeDetailsModel();
            $warna = $AttributeDetailsModel->where('id_attribute',37)->findAll(); 
            $ukuran = $AttributeDetailsModel->where('id_attribute',38)->findAll();
            
            //* Brand
            $Brands = new BrandsModel();
            $Brands= $Brands->findAll(); 
            
        //* Kategori
            $Kategori = new ProductCategoryModel();
            $Kategori= $Kategori->findAll(); 

            $data = [
                'title' => 'Form | Tambah Produk',
                'pageTitle' => 'Create Pages',
                'warna' => $warna,
                'ukuran' => $ukuran,
                'brands' => $Brands,
                'kategori' => $Kategori,
                'validation' => \config\Services::validation()
            ];
    
            return view('Products/ProductsCreatePage.php', $data );

        }
        //*Create Page
        public function editPage($id)
        {
            // dd($id);

            $productToUpdate = $this->productsModel->find($id);
            $gambarBase64Default =  'data:image/jpeg;base64,' .base64_encode($productToUpdate['foto_product']);
            //* Attribute values
            $AttributeDetailsModel = new AttributeDetailsModel();
            $warna = $AttributeDetailsModel->where('id_attribute',37)->findAll(); 
            $ukuran = $AttributeDetailsModel->where('id_attribute',38)->findAll();
            
            //* Brand
            $Brands = new BrandsModel();
            $Brands= $Brands->findAll(); 
            
            //* Kategori
            $Kategori = new ProductCategoryModel();
            $Kategori= $Kategori->findAll(); 

            $data = [
                'title' => 'Form | Edit Produk',
                'pageTitle' => 'Update Product',
                'warna' => $warna,
                'ukuran' => $ukuran,
                'brands' => $Brands,
                'kategori' => $Kategori,
                'product' => $productToUpdate,
                'gambardefault'=> $gambarBase64Default,
                'validation' => \config\Services::validation()
            ];
    
            return view('Products/ProductsEditPage.php', $data );

        }


    //* ------------------- ACTIONS --------------------------------------

    
    public function create()
    {
        // Ambil semua data dari form
        $data = $this->request->getPost();
        $gambar = $this->request->getFile('foto_product');
        $this->productsModel->save([
            'nama_product' => $data['nama_produk'],
            'harga_product' => $data['harga_produk'],
            'id_details_warna' => $data['id_details_warna'],
            'id_details_ukuran' => $data['id_details_ukuran'],
            'id_brand' => $data['id_brand'],
            'id_category' => $data['id_category'],
            'stok_total' => $data['stok_total'],
            'foto_product' =>file_get_contents($gambar->getTempName()),
        ]);

        // Redirect ke halaman atribut dengan pesan sukses
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to(base_url() .'products')->with('success', 'Atribut berhasil ditambahkan.');    
    }

    //*Update
    public function update(){
        $id = $this->request->getPost('id_product');
        $data = $this->request->getPost();
        $dataToUpdate = $this->productsModel->find($id);
        if(!$dataToUpdate){
            //redirect to halaman not found
        }

        $dataToUpdate = [
            'nama_product' => $data['nama_produk'],
            'harga_product' => $data['harga_produk'],
            'id_details_warna' => $data['id_details_warna'],
            'id_details_ukuran' => $data['id_details_ukuran'],
            'id_brand' => $data['id_brand'],
            'id_category' => $data['id_category'],
            'stok_total' => $data['stok_total'],
        ];
        $this->productsModel->update($id, $dataToUpdate);
        //* Logging
        //* Data for logs
        $dataForLogs =
        [
            'id_product' => $id,
            'tipe' => 'update',
            'jumlah' =>  $data['stok_total']
        ];
        //* Insert
        self::updateStokLog($dataForLogs);
        
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to(base_url() .'products')->with('success', 'Kategori berhasil diubah.');    
    }


    public static function updateStokLog(array $data)
    {
        //* User
        $currentUser =  session()->get('id_user');
        //* Date Log
        $date = date('Y-m-d H:i:s');
        //* Model Log
        $LogsModel = new \App\Models\LogsModel();

        
        $logData = [
            'id_product' => $data['id_product'], // ID produk yang dihapus
            'log_action' => $data['tipe'], // atau sesuai yang Anda butuhkan untuk menandakan log hapus produk
            'quantity' => $data['jumlah'],
            'date' => $date,
            'id_user' => $currentUser,
            'deskripsi' => (isset($data['alasan'])) ? $data['alasan'] : null 
        ];

        $LogsModel->insert($logData);
    }
    public function updatestok()
    {
        //* Data yang didapat dari Post
        $data = $this->request->getPost();

        //*Cari product yang diupdate
        $product = $this->productsModel->find($data['id_product']);
        $stock_before = $product['stok_total']; 
        //* Data to update + atau - ? 
        ($data['tipe'] === "out") ? 
        $dataToUpdate = ['stok_total' => (int)$stock_before - (int)$data['jumlah']] : $dataToUpdate =  ['stok_total' => (int)$stock_before + (int)$data['jumlah']];
        // * Update Stok
        $this->productsModel->update($data['id_product'],$dataToUpdate);
        //* Logs
        self::updateStokLog($data);

        session()->setFlashdata('success', 'Perubahan berhasil disimpan.');
        return redirect()->to(base_url() .'products')->with('success', 'Perubahan berhasil dilakukan.');    

    }


    //*Delete
    public function delete($id)
    {
        // dd(session()->get('id_user'));
        // Cek apakah atribut dengan ID tersebut ada
        $products = $this->productsModel->find($id);
        if (!$products) {
            // return $this->('Atribut tidak ditemukan.');
        }

        // Jika ada, lakukan proses penghapusan
        try {
            $this->productsModel->delete($id);
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil dihapus.'
            ];
            
            //     dd($data);
            
            $currentUser =  session()->get('id_user');
            $date = date('Y-m-d H:i:s');
            $LogsModel = new \App\Models\LogsModel();
            $logData = [
                'id_product' => $products['id_product'], // ID produk yang dihapus
                'log_action' => 'delete', // atau sesuai yang Anda butuhkan untuk menandakan log hapus produk
                'date' => $date,
                'id_user' => $currentUser
            ];
            $LogsModel->insert($logData);
            return $this->respond($response);
        } catch (\Exception $e) {
            $response = [
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus data.'
            ];
            return $this->respond($response, 500);
        }
    }
}

?>
