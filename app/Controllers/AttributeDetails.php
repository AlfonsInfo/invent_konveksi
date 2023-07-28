<?php

namespace App\Controllers;

use App\Models\AttributeDetailsModel;
use CodeIgniter\API\ResponseTrait;

class AttributeDetails extends BaseController
{
    use ResponseTrait;

    protected $AttributeDetailsModel; 

    //* Constructor
    public function __construct()
    {
        //* ini juga bisa dilakukan di Base Controller in case semua controller butuh data ini
        $this->AttributeDetailsModel = new AttributeDetailsModel();
    }

    //* ---------- PAGES --------------------

    //* Index Page
    public function index($id)
    {
        $attributeDetails = $this->AttributeDetailsModel->where('id_attribute',$id)->findAll();
        $data = [
            'title' => 'Attributes Details',
            'idAtt' => $id,
            'pageTitle' => 'Attributes Details',
            'attributeDetails' => $attributeDetails,
            'validation' => \config\Services::validation()
        ];

        //*Debugging
        // dd($data); 
        //*Akhir Dari Debugging

         return view('AttributeDetails/AttributeDetailsPage.php', $data );
    }



    //* ------------------- ACTIONS --------------------------------------

    
    public function create()
    {
        // Ambil semua data dari form
        $data = $this->request->getPost();

        // dd($data);

        // Jika validasi berhasil, simpan data ke dalam database
        $this->AttributeDetailsModel->save([
            'nilai' => $data['value'],
            'id_attribute' => $data['id_attribute']
        ]);

        // Redirect ke halaman atribut dengan pesan sukses
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to(base_url() .'attributedetails/' . $data['id_attribute'])->with('success', 'Atribut berhasil ditambahkan.');    
    }

    //*Update
    public function update(){

        $id = $this->request->getPost('id_details');
        $idAtt = $this->request->getPost('id_attribute');
        $dataToUpdate = $this->AttributeDetailsModel->find($id);
        if(!$dataToUpdate){
            //redirect to halaman not found
        }

        $dataToUpdate = [
            'nilai' => $this->request->getPost('value'),
        ];
        $this->AttributeDetailsModel->update($id, $dataToUpdate);
        session()->setFlashdata('success', 'Data berhasil disimpan.');
        return redirect()->to(base_url() .'attributedetails/' . $idAtt)->with('success', 'Atribut berhasil diubah.');    
    }


    //*Delete
    public function deleteAttribute($id)
    {

        // Cek apakah atribut dengan ID tersebut ada
        $attribute = $this->AttributeDetailsModel->find($id);
        if (!$attribute) {
            // return $this->('Atribut tidak ditemukan.');
        }
        // Jika ada, lakukan proses penghapusan
        try {
            $this->AttributeDetailsModel->delete($id);
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
