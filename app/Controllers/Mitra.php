<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// for Ajax
// use CodeIgniter\HTTP\IncomingRequest;
// use PHPUnit\Framework\Constraint\IsEmpty;

/**
 * @propertyIncomingRequest $request 
 */

class Mitra extends BaseController
{
    protected $mitraModel;
    protected $kegiatanModel;
    protected $posisiModel;
    protected $alokasiModel;

    public function __construct()
    {
        $this->mitraModel = new \App\Models\MitraModel();
        $this->kegiatanModel = new \App\Models\KegiatanModel();
        $this->posisiModel = new \App\Models\PosisiModel();
        $this->alokasiModel = new \App\Models\AlokasiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Cek Mitra',
            'mitra' => $this->mitraModel->findAll()
        ];
        return view('mitra/cek-mitra', $data);
    }


    // CEK MITRA

    public function getAlokasiMitraAjax(){
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_mitra') {
                $kegiatan = $this->kegiatanModel->where('tahun', $this->request->getVar('tahun'))
                ->findAll();

                return json_encode($kegiatan);
            }
        }
    }

    // END OF CEK MITRA

    public function export()
    {
        $mitra = $this->mitraModel->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'sobat_id');
        $sheet->setCellValue('B1', 'nik');
        $sheet->setCellValue('C1', 'nama');
        $sheet->setCellValue('D1', 'alamat');
        $sheet->setCellValue('E1', 'email');
        $sheet->setCellValue('F1', 'jenis_kelamin');

        $column = 2;
        foreach ($mitra as $key => $value) {
            $sheet->setCellValue('A' . $column, $value['sobat_id']);
            $sheet->setCellValue('B' . $column, $value['nik']);
            $sheet->setCellValue('C' . $column, $value['nama']);
            $sheet->setCellValue('D' . $column, $value['alamat']);
            $sheet->setCellValue('E' . $column, $value['email']);
            $sheet->setCellValue('F' . $column, $value['jenis_kelamin']);
            $column++;
        }

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=mitra.xlsx');
        header('Cache-control: max-age=0');
        $writer->save('php://output');
        exit();
    }



    public function tambahmitra()
    {
        $data = [
            'title' => 'Tambah Mitra'
        ];
        return view('mitra/tambah-mitra', $data);
    }


    public function import()
    {
        $file = $this->request->getFile('mitra_excel');
        $extension = $file->getClientExtension();

        if ($extension == 'xlsx' || $extension == 'xls') {

            if ($extension == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($file);
            $mitra = $spreadsheet->getActiveSheet()->toArray();


            $err_msg = [];
            foreach ($mitra as $key => $value) {
                $mitra_db = $this->mitraModel->findAll();
                $err = [];

                if ($key == 0) {
                    continue;
                }
                $data = [
                    'sobat_id' => $value[0],
                    'nik' => $value[1],
                    'nama' => $value[2],
                    'alamat' => $value[3],
                    'email' => $value[4],
                    'jenis_kelamin' => $value[5]
                ];

                foreach ($mitra_db as $key => $value) {
                    if ($value['sobat_id'] == $data['sobat_id']) {
                        array_push($err, "duplicate");
                        array_push($err_msg, "duplicate");
                    }
                }

                if (empty($err)) {
                    $this->mitraModel->insert($data);
                }
            }

            if (empty($err_msg)) {
                $mitra_baru = count($mitra) - 1;
                session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">
            ' . $mitra_baru . ' mitra baru berhasil ditambahkan </div>');
                return redirect()->to('/mitra/tambahmitra');
            } else {
                $mitra_baru = count($mitra) - count($err_msg) - 1;
                $mitra_duplikat = count($err_msg);

                $str1 = $mitra_baru . ' mitra baru berhasil ditambahkan' . ', ' . $mitra_duplikat . ' mitra lainnya sudah ada di database';

                session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">' . $str1 . '</div>');
                return redirect()->to('/mitra/tambahmitra');
            }
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger mt-3" role="alert">
            Format file tidak sesuai </div>');

            return redirect()->to('/mitra/tambahmitra');
        }
    }


    public function tambahmanual()
    {
        $this->mitraModel->save([
            'idsobat' => $this->request->getVar('sobat_id'),
            'nik' => $this->request->getVar('nik'),
            'nama' => $this->request->getVar('namamitra'),
            'alamat' => $this->request->getVar('alamat'),
            'email' => $this->request->getVar('email'),
            'jenis_kelamin' => $this->request->getVar('jeniskelamin'),
            'posisi' => $this->request->getVar('posisi'),
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">
        Data mitra berhasil ditambahkan </div>');

        return redirect()->to('/mitra/tambahmitra');
    }



    // ALOKASI MITRA
    public function alokasimitra()
    {
        $data = [
            'title' => 'Alokasi Mitra',
            'mitra' => $this->mitraModel->findAll(),
            'posisi' => $this->posisiModel->findAll()
        ];
        return view('mitra/alokasi-mitra', $data);
    }

    public function alokasiGetKegiatan()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_kegiatan') {
                $kegiatan = $this->kegiatanModel->where('tahun_anggaran', $this->request->getVar('tahun'))->findAll();

                return json_encode($kegiatan);
            }
        }
    }

    public function tambahalokasimanual()
    {
        $this->alokasiModel->save([
            'tahun' => $this->request->getVar('tahun'),
            'kegiatan_id' => $this->request->getVar('kegiatan'),
            'sobat_id' => $this->request->getVar('mitra'),
            'beban_kerja' => $this->request->getVar('bebankerja'),
            'posisi_id' => $this->request->getVar('posisi')
        ]);

        session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">
        Alokasi berhasil ditambahkan </div>');

        return redirect()->to('/mitra/alokasimitra');
    }


    public function importAlokasi()
    {
        $file = $this->request->getFile('alokasi_excel');
        $extension = $file->getClientExtension();

        if ($extension == 'xlsx' || $extension == 'xls') {

            if ($extension == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $spreadsheet = $reader->load($file);
            $alokasi = $spreadsheet->getActiveSheet()->toArray();

            $err_msg = [];
            foreach ($alokasi as $key => $value) {
                $alokasi_db = $this->alokasiModel->findAll();
                $err = [];

                if ($key == 0) {
                    continue;
                }
                $data = [
                    'tahun' => $this->request->getVar('tahun_excel'),
                    'kegiatan_id' => $this->request->getVar('kegiatan_excel'),
                    'sobat_id' => $value[0],
                    'beban_kerja' => $value[1],
                    'posisi_id' => $value[2]
                ];

                foreach ($alokasi_db as $key => $value) {
                    if ($value['tahun'] == $data['tahun'] AND $value['kegiatan_id'] == $data['kegiatan_id'] AND $value['sobat_id'] == $data['sobat_id']) {
                        array_push($err, "duplicate");
                        array_push($err_msg, "duplicate");
                    }
                }

                if (empty($err)) {
                    $this->alokasiModel->insert($data);
                }
            }

            if (empty($err_msg)) {
                $alokasi_baru = count($alokasi) - 1;
                session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">
            ' . $alokasi_baru . ' alokasi baru berhasil ditambahkan </div>');
                return redirect()->to('/mitra/alokasimitra');
            } else {
                $alokasi_baru = count($alokasi) - count($err_msg) - 1;
                $alokasi_duplikat = count($err_msg);

                $str1 = $alokasi_baru . ' alokasi baru berhasil ditambahkan' . ', ' . $alokasi_duplikat . ' alokasi lainnya sudah ada di database';

                session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">' . $str1 . '</div>');
                return redirect()->to('/mitra/alokasimitra');
            }
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger mt-3" role="alert">
            Format file tidak sesuai </div>');

            return redirect()->to('/mitra/alokasimitra');
        }
    }

    // END OF ALOKASI MITRA

}
