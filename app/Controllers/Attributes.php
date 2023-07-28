<?php

namespace App\Controllers;

use App\Models\AttributesModel;
use CodeIgniter\API\ResponseTrait;

class Attributes extends BaseController
{
    use ResponseTrait;

    protected $AttributesModel; 

    //* Constructor
    public function __construct()
    {
        //* ini juga bisa dilakukan di Base Controller in case semua controller butuh data ini
        $this->AttributesModel = new AttributesModel();
    }

    //* ---------- PAGES --------------------

    //* Index Page
    public function index()
    {
        $attributes = $this->AttributesModel->findAll();
        $data = [
            'title' => 'Attributes',
            'pageTitle' => 'Attributes',
            'attributes' => $attributes,
            'validation' => \config\Services::validation()
        ];

        //*Debugging
        // dd($data); 
        //*Akhir Dari Debugging

         return view('Attributes/AttributesPage.php', $data );
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
            'nama_attribute' => 'required|max_length[100]|is_unique[attributes.nama_attribute]', // Contoh aturan validasi: wajib diisi dan maksimal 100 karakter
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
        $this->AttributesModel->save([
            'nama_attribute' => $data['nama_attribute']
        ]);

        // Redirect ke halaman atribut dengan pesan sukses
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to(base_url() .'attributes')->with('success', 'Atribut berhasil ditambahkan.');    
    }

    //*Update
    public function update(){
        $id = $this->request->getPost('id_attribute');
        $dataToUpdate = $this->AttributesModel->find($id);
        if(!$dataToUpdate){
            //redirect to halaman not found
        }

        $dataToUpdate = [
            'nama_attribute' => $this->request->getPost('nama_attribute'),
        ];
        $this->AttributesModel->update($id, $dataToUpdate);
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to(base_url() .'attributes')->with('success', 'Atribut berhasil diubah.');    
    }


    //*Delete
    public function deleteAttribute($id)
    {
        // Cek apakah atribut dengan ID tersebut ada
        $attribute = $this->AttributesModel->find($id);
        if (!$attribute) {
            // return $this->('Atribut tidak ditemukan.');
        }
        // Jika ada, lakukan proses penghapusan
        try {
            $this->AttributesModel->delete($id);
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
