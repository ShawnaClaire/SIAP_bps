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
        $data = [
            'title' => 'Kegiatan',
            'kegiatan' => $kegiatan,
        ];
        
        return view('kegiatan', $data);
    }

    public function save()
    {
        $this->kegiatanModel->save([
            'kode_mata_anggaran' => $this->request->getVar('kode_mata_anggaran'),
            'nama_kegiatan' => $this->request->getVar('namakegiatan'),
            'kode_mata_anggaran' => $this->request->getVar('kodemataanggaran'),
            'satuan_kegiatan_id' => $this->request->getVar('satuankegiatan'),
            'honor' => $this->request->getVar('honor'),
            'bulan_bayar' => $this->request->getVar('bulanbayar'),
            'subjectmatter_id' => $this->request->getVar('subjectmatter'),
            'jadwal_mulai' => $this->request->getVar('jadwalmulai'),
            'jadwal_akhir' => $this->request->getVar('jadwalakhir'),
        ]); 

        session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">
        Data kegiatan berhasil ditambahkan </div>');

        return redirect()->to('/kegiatan');
    }
}
