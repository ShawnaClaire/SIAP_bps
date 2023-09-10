<?php

namespace App\Controllers;

use CodeIgniter\Model;

class Kegiatan extends BaseController
{
    protected $kegiatanModel;
    protected $satuanKegiatanModel;
    protected $jenisKegiatanModel;
    protected $subjectmatterModel;

    public function __construct()
    {
        $this->kegiatanModel = new \App\Models\KegiatanModel();
        $this->satuanKegiatanModel = new \App\Models\SatuanKegiatanModel();
        $this->jenisKegiatanModel = new \App\Models\JenisKegiatanModel();
        $this->subjectmatterModel = new \App\Models\SubjectmatterModel();
        
    }

    public function index(): string
    {
        // helper('form');
        // session();

        $month = array(
            "1"=>"Januari", 
            "2"=>"Februari", 
            "3"=>"Maret", 
            "4"=>"April",
            "5"=>"Mei",
            "6"=>"Juni",
            "7"=>"Juli",
            "8"=>"Agustus",
            "9"=>"September",
            "10"=>"Oktober",
            "11"=>"November",
            "12"=>"Desember",
        );

        $data = [
            'title' => 'Kegiatan',
            'kegiatan' => $this->kegiatanModel->findAll(),
            'satuan_kegiatan' => $this->satuanKegiatanModel->findAll(),
            'jenis_kegiatan' => $this->jenisKegiatanModel->findAll(),
            'subjectmatter' => $this->subjectmatterModel->findAll(),
            'month' => $month
        ];
        
        return view('kegiatan', $data);
    }

    public function save()
    {
        // $blm = implode(",", $this->request->getVar('bulanbayar'));
        // dd($blm, explode(",", $blm));

        $this->kegiatanModel->save([
            'kode_mata_anggaran' => $this->request->getVar('kodemataanggaran'),
            'tahun_anggaran' => $this->request->getVar('tahunanggaran'),
            'uraian_detail_akun' => $this->request->getVar('uraiandetailakun'),
            'jenis_kegiatan_id' => $this->request->getVar('jeniskegiatan'),
            'satuan_kegiatan_id' => $this->request->getVar('satuankegiatan'),
            'volume' => $this->request->getVar('volume'),
            'harga_satuan' => $this->request->getVar('hargasatuan'),
            'subjectmatter_id' => $this->request->getVar('subjectmatter'),
            'jadwal_mulai' => $this->request->getVar('jadwalmulai'),
            'jadwal_akhir' => $this->request->getVar('jadwalakhir'),
            'bulan_bayar' => implode(",", $this->request->getVar('bulanbayar'))
        ]); 

        session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">
        Data kegiatan berhasil ditambahkan </div>');

        return redirect()->to('/kegiatan');
    }
}
