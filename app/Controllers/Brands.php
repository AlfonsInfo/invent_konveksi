<?php

namespace App\Controllers;

use App\Models\BrandsModel;
use CodeIgniter\API\ResponseTrait;

class Brands extends BaseController
{
    use ResponseTrait;

    protected $Brands; 

    //* Constructor
    public function __construct()
    {
        //* ini juga bisa dilakukan di Base Controller in case semua controller butuh data ini
        $this->Brands = new BrandsModel();
    }

    //* ---------- PAGES --------------------

    //* Index Page
    public function index()
    {
        $brands = $this->Brands->findAll();
        $data = [
            'title' => 'Brands',
            'pageTitle' => 'Brands',
            'brands' => $brands,
            'validation' => \config\Services::validation()
        ];

        //*Debugging
        // dd($data); 
        //*Akhir Dari Debugging

         return view('Brands/BrandsPage.php', $data );
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
            'nama_brand' => 'required|max_length[100]|is_unique[attributes.nama_attribute]', // Contoh aturan validasi: wajib diisi dan maksimal 100 karakter
        ];

        // Atur pesan error kustom (opsional)
        $errors = [
            'nama_brand' => [
                'required' => 'Nama brand harus diisi.',
                'max_length' => 'Nama brand maksimal 100 karakter.',
                'is_unique' => 'Brnad harus unik'
            ],
        ];

        // Validasi data
        if (!$this->validate($rules, $errors)) {

            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url() .'attributes');
        }

        // Jika validasi berhasil, simpan data ke dalam database
        $this->Brands->save([
            'nama_brand' => $data['nama_brand']
        ]);

        // Redirect ke halaman atribut dengan pesan sukses
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to(base_url() .'brands')->with('success', 'Brand berhasil ditambahkan.');    
    }

    //*Update
    public function update(){
        $id = $this->request->getPost('id_brand');
        $dataToUpdate = $this->Brands->find($id);
        if(!$dataToUpdate){
            //redirect to halaman not found
        }

        $dataToUpdate = [
            'nama_brand' => $this->request->getPost('nama_brand'),
        ];
        $this->Brands->update($id, $dataToUpdate);
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to(base_url() .'brands')->with('success', 'Brand berhasil diubah.');    
    }


    //*Delete
    public function delete($id)
    {
        // Cek apakah atribut dengan ID tersebut ada
        $attribute = $this->Brands->find($id);
        if (!$attribute) {
            // return $this->('Atribut tidak ditemukan.');
        }
        // Jika ada, lakukan proses penghapusan
        try {
            $this->Brands->delete($id);
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
