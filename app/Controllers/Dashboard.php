<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $kegiatanModel;
    protected $subjectmatterModel;

    public function __construct()
    {
        $this->kegiatanModel = new \App\Models\KegiatanModel();
        $this->subjectmatterModel = new \App\Models\SubjectmatterModel();
        
    }

    public function index(): string
    {
        $kegiatan = $this->kegiatanModel->findAll();
        $kegiatan_bulanini = [];
        foreach ($kegiatan as $k => $value) {
            if(date('F',strtotime($value['jadwal_mulai'])) == date('F')) {
                array_push($kegiatan_bulanini, $value);
            }
        }

        $data = [
            'title' => 'Dashboard',
            'kegiatan' => $kegiatan_bulanini,
            'subjectmatter' => $this->subjectmatterModel->findAll(),
        ];
        
        return view('dashboard', $data);
    }
}
