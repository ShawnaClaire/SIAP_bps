<?php

namespace App\Controllers;

use CodeIgniter\Model;

class Kegiatan extends BaseController
{
    protected $kegiatanModel;
    protected $satuanKegiatanModel;
    protected $jenisKegiatanModel;
    protected $subjectmatterModel;
    protected $alokasiModel;

    public function __construct()
    {
        $this->kegiatanModel = new \App\Models\KegiatanModel();
        $this->satuanKegiatanModel = new \App\Models\SatuanKegiatanModel();
        $this->jenisKegiatanModel = new \App\Models\JenisKegiatanModel();
        $this->subjectmatterModel = new \App\Models\SubjectmatterModel();
        $this->alokasiModel = new \App\Models\AlokasiModel();
    }

    public function index(): string
    {
        // helper('form');
        // session();

        $month = array(
            "1" => "Januari",
            "2" => "Februari",
            "3" => "Maret",
            "4" => "April",
            "5" => "Mei",
            "6" => "Juni",
            "7" => "Juli",
            "8" => "Agustus",
            "9" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember",
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

    public function editDataAlokasi($id)
    {
        $kegiatan = $this->kegiatanModel->where('id', $id)->first();
        $bulan_bayar_keg = explode(',', $kegiatan['bulan_bayar']);
        $alokasi = $this->alokasiModel->where('kegiatan_id', $id)->findAll();

        $bulan_bayar_alokasi = [];

        foreach ($bulan_bayar_keg as $key => $value) {
            // dd($value);
            foreach ($alokasi as $a) {
                if($a['bulan_bayar_mitra'] == $value){
                    array_push($bulan_bayar_alokasi, $value);
                }
            }
        }

        $data = [
            'id' => $kegiatan['id'],
            'kode_mata_anggaran' => $kegiatan['kode_mata_anggaran'],
            'tahun_anggaran' => $kegiatan['tahun_anggaran'],
            'uraian_detail_akun' => $kegiatan['uraian_detail_akun'],
            'jenis_kegiatan_id' => $kegiatan['jenis_kegiatan_id'],
            'satuan_kegiatan_id' => $kegiatan['satuan_kegiatan_id'],
            'volume' => $kegiatan['volume'],
            'harga_satuan' => $kegiatan['harga_satuan'],
            'subjectmatter_id' => $kegiatan['subjectmatter_id'],
            'jadwal_mulai' => $kegiatan['jadwal_mulai'],
            'jadwal_akhir' => $kegiatan['jadwal_akhir'],
            'bulan_bayar' => explode(',', $kegiatan['bulan_bayar']),
            'bulan_bayar_alokasi' => $bulan_bayar_alokasi
        ];

        return json_encode($data);
    }

    public function saveedit()
    {
        if($this->request->getVar('bulanbayar_edit') == null){
            session()->setFlashdata('message', '<div class="alert alert-danger mt-3" role="alert">
            Gagal mengupdate data kegiatan. Bulan bayar tidak boleh kosong..</div>');

            return redirect()->to('/kegiatan');

        } else{
            $this->kegiatanModel->save([
                'id' => $this->request->getVar('id_kegiatan_edit'),
                'kode_mata_anggaran' => $this->request->getVar('kodemataanggaran_edit'),
                'tahun_anggaran' => $this->request->getVar('tahunanggaran_edit'),
                'uraian_detail_akun' => $this->request->getVar('uraiandetailakun_edit'),
                'jenis_kegiatan_id' => $this->request->getVar('jeniskegiatan_edit'),
                'satuan_kegiatan_id' => $this->request->getVar('satuankegiatan_edit'),
                'volume' => $this->request->getVar('volume_edit'),
                'harga_satuan' => $this->request->getVar('hargasatuan_edit'),
                'subjectmatter_id' => $this->request->getVar('subjectmatter_edit'),
                'jadwal_mulai' => $this->request->getVar('jadwalmulai_edit'),
                'jadwal_akhir' => $this->request->getVar('jadwalakhir_edit'),
                'bulan_bayar' => implode(",", $this->request->getVar('bulanbayar_edit'))
            ]);

            session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">
            Data kegiatan berhasil diupdate.</div>');

            return redirect()->to('/kegiatan');
        }
    }

    public function hapusKegiatan()
    {
        $this->kegiatanModel->where('id', $this->request->getVar('id_kegiatan_hapus'))->delete();

        session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">
            Data kegiatan berhasil dihapus.</div>');

            return redirect()->to('/kegiatan');
    }
}
