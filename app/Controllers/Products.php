<?php

namespace App\Controllers;

use App\Models\ProductsModel;
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
        $products = $this->productsModel->findAll();
        $data = [
            'title' => 'Products',
            'pageTitle' => 'Products',
            'products' => $products,
            'validation' => \config\Services::validation()
        ];

        //*Debugging
        // dd($data); 
        //*Akhir Dari Debugging
    
         return view('Products/ProductCategoryPage.php', $data );
    }


        //*Create Page
        public function createPage()
        {
            $data = [
                'title' => 'Form | Tambah Attribut',
                'pageTitle' => 'Create Attributes',
    
            ];
    
        }


    //* ------------------- ACTIONS --------------------------------------

    
    public function create()
    {
        // Ambil semua data dari form
        $data = $this->request->getPost();

        // Atur aturan validasi untuk setiap field
        $rules = [
            'nama_category' => 'required|max_length[100]|is_unique[attributes.nama_attribute]', // Contoh aturan validasi: wajib diisi dan maksimal 100 karakter
        ];

        // Atur pesan error kustom (opsional)
        $errors = [
            'nama_attribute' => [
                'required' => 'Nama atribut harus diisi.',
                'max_length' => 'Nama atribut maksimal 100 karakter.',
                'is_unique' => 'Attribut harus unik'
            ],
        ];

        // Validasi data
        if (!$this->validate($rules, $errors)) {

            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url() .'attributes');
        }

        // Jika validasi berhasil, simpan data ke dalam database
        $this->productsModel->save([
            'nama_category' => $data['nama_category']
        ]);

        // Redirect ke halaman atribut dengan pesan sukses
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to(base_url() .'productcategory')->with('success', 'Atribut berhasil ditambahkan.');    
    }

    //*Update
    public function update(){
        $id = $this->request->getPost('id_category');
        $dataToUpdate = $this->productsModel->find($id);
        if(!$dataToUpdate){
            //redirect to halaman not found
        }

        $dataToUpdate = [
            'nama_category' => $this->request->getPost('nama_category'),
        ];
        $this->productsModel->update($id, $dataToUpdate);
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to(base_url() .'productcategory')->with('success', 'Kategori berhasil diubah.');    
    }


    //*Delete
    public function delete($id)
    {
        // Cek apakah atribut dengan ID tersebut ada
        $attribute = $this->productsModel->find($id);
        if (!$attribute) {
            // return $this->('Atribut tidak ditemukan.');
        }
        // Jika ada, lakukan proses penghapusan
        try {
            $this->productsModel->delete($id);
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil dihapus.'
            ];
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
