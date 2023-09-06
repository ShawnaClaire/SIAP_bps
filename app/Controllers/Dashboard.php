<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $kegiatanModel;

    public function __construct()
    {
        $this->kegiatanModel = new \App\Models\KegiatanModel();
        
    }

    public function index(): string
    {
        $kegiatan = $this->kegiatanModel->findAll();
        $kegiatan_bulanini = [];
        foreach ($kegiatan as $k => $value) {
            if(date('F',strtotime($value['jadwalmulai'])) == date('F')) {
                array_push($kegiatan_bulanini, $value);
            }
        }

        $data = [
            'title' => 'Dashboard',
            'kegiatan' => $kegiatan_bulanini
        ];
        
        return view('dashboard', $data);
    }
}
