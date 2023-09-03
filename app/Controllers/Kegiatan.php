<?php

namespace App\Controllers;

use CodeIgniter\Model;

class Kegiatan extends BaseController
{
    protected $kegiatanModel;

    public function __construct()
    {
        $this->kegiatanModel = new \App\Models\KegiatanModel();
        
    }

    public function index(): string
    {
        helper('form');

        session();
        $kegiatan = $this->kegiatanModel->findAll();
        // $val = \Config\Services::validation()->getErrors();
        // dd($val);
        $data = [
            'title' => 'Kegiatan',
            'kegiatan' => $kegiatan,
            // 'validation' => validation_list_errors()
        ];
        
        return view('kegiatan', $data);
    }

    public function save()
    {
        // validate inputs
        // if (!$this->validate([
        //     'subjectmatter' => 'required',
        //     'namakegiatan' => 'required' ,
        //     'satuankegiatan' => 'required' ,
        //     'honor' => 'required|numeric' ,
        //     'bayar' => 'required' ,
        //     'jadwalmulai' => 'required' ,
        //     'jadwalakhir' => 'required' ,
        // ])) {
        //     $validation = \Config\Services::validation();
        //     return redirect()->to('/kegiatan')->withInput()->with('validation', $validation);
        // }

        $this->kegiatanModel->save([
            'subjectmatter' => $this->request->getVar('subjectmatter'),
            'namakegiatan' => $this->request->getVar('namakegiatan'),
            'satuankegiatan' => $this->request->getVar('satuankegiatan'),
            'honor' => $this->request->getVar('honor'),
            'bayar' => $this->request->getVar('bulanbayar'),
            'jadwalmulai' => $this->request->getVar('jadwalmulai'),
            'jadwalakhir' => $this->request->getVar('jadwalakhir'),
        ]); 

        session()->setFlashdata('savemessage', '<div class="alert alert-success mt-3" role="alert">
        Data kegiatan berhasil ditambahkan </div>');

        return redirect()->to('/kegiatan');
    }
}
