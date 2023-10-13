<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use function PHPUnit\Framework\isEmpty;

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
        // $keg = $this->validasiVolume('1', '3');
        // $keg = $this->alokasiModel->where('tahun', '2022')->findAll();
        // $keg = $this->alokasiModel->getAlokasiOB('2023');
        // $keg = $this->alokasiModel->getAlokasiSBML('2022');

        // dd($alokasi = $this->alokasiModel->getMitraSBML('2023', 7, '111'));
        // $alokasi = $this->alokasiModel->getAlokasiAndKegiatan('111', '2022', '8');
        // dd($alokasi);

        $data = [
            'title' => 'Cek Mitra',
            'mitra' => $this->mitraModel->findAll(),
            'tahun' => $this->kegiatanModel->getUniqueYear()
        ];
        return view('mitra/cek-mitra', $data);
    }


    // >> CEK MITRA <<
    public function getAlokasiMitraAjax()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_alokasi_mitra') {
                $tahun = $this->request->getVar('tahun');
                $mitra = $this->request->getVar('mitra');
                // $bulan_bayar = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
                $data_perbulan = [];
                for ($i = 1; $i <= 12; $i++) {
                    $alokasi = $this->alokasiModel->getMitraSBML($tahun, $i, $mitra);

                    $total_honor = 0;
                    $arr_sbml = [];
                    $sbml = 0;

                    foreach ($alokasi as $a) {
                        if ($a['satuan_kegiatan_id'] != "3") {
                            $total_honor += $a['honor'];
                            array_push($arr_sbml, $a['sbml']);
                            $sbml = max($arr_sbml);
                        }
                        if ($a['satuan_kegiatan_id'] == "3") {
                            $total_honor += $a['honor'];
                            $sbml = $a['sbml'];
                        }
                    }

                    $data = [
                        'bulan' => $i,
                        'honor_teralokasi' => $total_honor,
                        'sbml_mitra' => $sbml,
                        'alokasi_tersedia' => $sbml - $total_honor
                    ];


                    array_push($data_perbulan, $data);
                };

                return json_encode($data_perbulan);
            }
        }
    }

    public function getInfoMitraAjax()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_info_mitra') {
                $sobat_id = $this->request->getVar('sobat_id');
                $mitra = $this->mitraModel->where('sobat_id', $sobat_id)->first();

                $data = [
                    'sobat_id' => $mitra['sobat_id'],
                    'nama' => $mitra['nama'],
                    'email' => $mitra['email']
                ];
                return json_encode($data);
            }
        }
    }

    public function convertBulan($bulan)
    {
        switch ($bulan) {
            case 1:
                $month = "Januari";
                break;
            case 2:
                $month = "Februari";
                break;
            case 3:
                $month = "Maret";
                break;
            case 4:
                $month = "April";
                break;
            case 5:
                $month = "Mei";
                break;
            case 6:
                $month = "Juni";
                break;
            case 7:
                $month = "Juli";
                break;
            case 8:
                $month = "Agustus";
                break;
            case 9:
                $month = "September";
                break;
            case 10:
                $month = "Oktober";
                break;
            case 11:
                $month = "November";
                break;
            case 12:
                $month = "Desember";
                break;


            case "Januari":
                $month = 1;
                break;
            case "Februari":
                $month = 2;
                break;
            case "Maret":
                $month = 3;
                break;
            case "April":
                $month = 4;
                break;
            case "Mei":
                $month = 5;
                break;
            case "Juni":
                $month = 6;
                break;
            case "Juli":
                $month = 7;
                break;
            case "Agustus":
                $month = 8;
                break;
            case "September":
                $month = 9;
                break;
            case "Oktober":
                $month = 10;
                break;
            case "November":
                $month = 11;
                break;
            case "Desember":
                $month = 12;
                break;


            default:
                $month = "";
        }

        return ($month);
    }

    public function detailAlokasiMitra($sobat_id, $tahun, $bulan, $honor_teralokasi, $sbml)
    {
        $mitra = $this->mitraModel->where('sobat_id', $sobat_id)->first();
        $alokasi = $this->alokasiModel->getAlokasiAndKegiatan($sobat_id, $tahun, $bulan);
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
            'title' => "Detail Alokasi Mitra",
            'alokasi' => $alokasi,
            'mitra' => $mitra,
            'tahun' => $tahun,
            'bulan' => $this->convertBulan($bulan),
            'month' => $month,
            'sbml'  => $sbml,
            'honor_teralokasi' => $honor_teralokasi

        ];
        return view('mitra/detail-alokasi-mitra', $data);
    }

    public function editDataAlokasi($id)
    {
        $alokasi = $this->alokasiModel->where('id', $id)->first();
        $bulanbayar = explode(",", $alokasi['bulan_bayar_mitra']);

        $data = [
            'alokasi_id' => $alokasi['id'],
            'beban_kerja' => $alokasi['beban_kerja'],
            'bulan_bayar' => $bulanbayar
        ];

        return json_encode($data);
    }


    public function simpanEditAlokasi()
    {
        $id_alokasi = $this->request->getVar('id_alokasi');
        $sobat_id = $this->request->getVar('sobat_id');
        $tahun = $this->request->getVar('tahun');
        $bulan = $this->convertBulan($this->request->getVar('bulan'));
        $honor_teralokasi = $this->request->getVar('honor_teralokasi');
        $sbml = $this->request->getVar('sbml');
        $beban_kerja = $this->request->getVar('beban_kerja');

        // Validasi total honor
        $alokasi = $this->alokasiModel->where('sobat_id', $sobat_id)->where('tahun', $tahun)->where('bulan_bayar_mitra', $bulan)->findAll();

        $total_honor = 0;

        foreach ($alokasi as $a) {
            if ($a['id'] == $id_alokasi) {
                $harga_satuan = $this->kegiatanModel->where('id', $a['kegiatan_id'])->first()['harga_satuan'];
            } else {
                $total_honor += $a['honor'];
            }
        }

        $honor_edit = (int) $beban_kerja * $harga_satuan;
        $total_honor += $honor_edit;


        if ($total_honor > $sbml) {
            session()->setFlashdata('message', '<div class="alert alert-danger mt-3" role="alert">
            Gagal mengedit alokasi. Total honor bulan ' . $this->convertBulan($bulan) . ' tidak boleh melebihi ' . $sbml . '</div>');
            return redirect()->to('/mitra/detailAlokasiMitra/' . $sobat_id . '/' . $tahun . '/' . $bulan . '/' . $honor_teralokasi . '/' . $sbml);
        } else {
            $data_alokasi = [
                'id' => $id_alokasi,
                'beban_kerja' => $this->request->getVar('beban_kerja'),
                'honor' => $honor_edit
            ];

            $this->alokasiModel->save($data_alokasi);

            session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">
            data alokasi berhasil diedit </div>');
            return redirect()->to('/mitra/detailAlokasiMitra/' . $sobat_id . '/' . $tahun . '/' . $bulan . '/' . $honor_teralokasi . '/' . $sbml);
        }
    }

    public function hapusAlokasi()
    {
        $id_alokasi = $this->request->getVar('id_alokasi_hapus');
        $sobat_id = $this->request->getVar('sobat_id');
        $tahun = $this->request->getVar('tahun');
        $bulan = $this->convertBulan($this->request->getVar('bulan'));
        $honor_teralokasi = $this->request->getVar('honor_teralokasi');
        $sbml = $this->request->getVar('sbml');

        // dd($sobat_id,$tahun,$bulan,$honor_teralokasi,$sbml);

        $this->alokasiModel->where('id', $id_alokasi)->delete();
        session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">
            Data alokasi berhasil dihapus </div>');

        return redirect()->to('/mitra/detailAlokasiMitra/' . $sobat_id . '/' . $tahun . '/' . $bulan . '/' . $honor_teralokasi . '/' . $sbml);
    }

    // >> END OF CEK MITRA <<



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
        $data = [
            'sobat_id' => $this->request->getVar('sobat_id'),
            'nik' => $this->request->getVar('nik'),
            'nama' => $this->request->getVar('namamitra'),
            'alamat' => $this->request->getVar('alamat'),
            'email' => $this->request->getVar('email'),
            'jenis_kelamin' => $this->request->getVar('jeniskelamin'),
            'posisi' => $this->request->getVar('posisi'),
        ];

        $err_msg = [];
        $mitra_db = $this->mitraModel->findAll();
        foreach ($mitra_db as $key => $value) {
            if ($value['sobat_id'] == $data['sobat_id']) {
                array_push($err_msg, "duplicate");
            }
        }

        if (empty($err_msg)) {
            $this->mitraModel->save($data);
            session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">
            Data mitra berhasil ditambahkan </div>');

            return redirect()->to('/mitra/tambahmitra');
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger mt-3" role="alert">
            Gagal menambahkan mitra, data sudah ada di database </div>');

            return redirect()->to('/mitra/tambahmitra');
        }
    }



    // ALOKASI MITRA
    public function alokasimitra()
    {
        $data = [
            'title' => 'Alokasi Mitra',
            'mitra' => $this->mitraModel->findAll(),
            'posisi' => $this->posisiModel->findAll(),
            'tahun' => $this->kegiatanModel->getUniqueYear(),
            'counter' => 0
        ];
        return view('mitra/alokasi-mitra', $data);
    }

    public function alokasiGetBulanBayar()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_bulanbayar') {
                $kegiatan = $this->kegiatanModel->where('id', $this->request->getVar('kegiatan'))->first();
                $bulanbayar = explode(",", $kegiatan['bulan_bayar']);
                return json_encode($bulanbayar);
            }
        }
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

    public function alokasiGetInfoKegiatan()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_infokegiatan') {
                $kegiatan = $this->kegiatanModel->where('id', $this->request->getVar('kegiatan_id'))->first();
                $alokasi = $this->alokasiModel->where('kegiatan_id', $this->request->getVar('kegiatan_id'))->findAll();

                $volume_teralokasi = 0;
                foreach ($alokasi as $a) {
                    $volume_teralokasi += $a['beban_kerja'];
                }


                $data = [
                    'volume_total' => $kegiatan['volume'],
                    'volume_belum_teralokasi' => $kegiatan['volume'] - $volume_teralokasi,
                    'harga_satuan' => $kegiatan['harga_satuan'],
                    'satuan_kegiatan_id' => $kegiatan['satuan_kegiatan_id']
                ];
                // dd($data);
                return json_encode($data);
            }
        }
    }

    public function addalokasi()
    {
        $mitra = $this->request->getVar('mitra');

        for ($i = 0; $i < count($mitra); $i++) {
            $data = [
                'tahun' => $this->request->getVar('tahun'),
                'kegiatan_id' => $this->request->getVar('kegiatan'),
                'sobat_id' => $this->request->getVar('mitra')[$i],
                'beban_kerja' => $this->request->getVar('bebankerja')[$i],
                'posisi_id' => $this->request->getVar('posisi')[$i],
                'bulan_bayar_mitra' => $this->request->getVar('bulanbayar')[$i],
                'honor' => $this->request->getVar('honor')[$i]
            ];

            $this->alokasiModel->save($data);
        }

        session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">
    Alokasi berhasil ditambahkan </div>');
        return redirect()->to('/mitra/alokasimitra');
    }

    public function getAlokasi()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_alokasi') {
                $tahun = $this->request->getVar('tahun');
                $mitra = $this->request->getVar('mitra');
                $bulan_bayar = $this->request->getVar('bulan_bayar');
                $kegiatan_id = $this->request->getVar('kegiatan_id');

                // $alokasi = $this->alokasiModel->where('tahun', $tahun)->where('sobat_id', $mitra)->where('bulan_bayar_mitra', $bulan_bayar)->findAll();

                $alokasi = $this->alokasiModel->getMitraSBML($tahun, $bulan_bayar, $mitra);

                $total_honor = 0;
                $arr_sbml = [];

                foreach ($alokasi as $a) {
                    if ($a['satuan_kegiatan_id'] != "3") { //satuan kegiatan bukan O-B
                        $total_honor += $a['honor'];
                        array_push($arr_sbml, $a['sbml']);
                    }
                }

                if (count($arr_sbml) != 0) {
                    $keg = $this->kegiatanModel->getSBML($kegiatan_id);
                    $keg_sbml = $keg[0]['sbml'];
                    if ($keg[0]['satuan_kegiatan_id'] != "3") {
                        array_push($arr_sbml, $keg_sbml);
                        $sbml = max($arr_sbml);
                    } else {
                        $keg = $this->kegiatanModel->getSBML($kegiatan_id);
                        $sbml = $keg[0]['sbml'];
                    }
                } else {
                    $keg = $this->kegiatanModel->getSBML($kegiatan_id);
                    $sbml = $keg[0]['sbml'];
                }

                $data = [
                    'total_honor' => $total_honor,
                    'sbml_mitra' => $sbml
                ];

                return json_encode($data);
            }
        }
    }

    public function getAllAlokasi()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_alokasiAll') {
                $tahun = $this->request->getVar('tahun');
                $mitra = $this->request->getVar('mitra');
                $bulan_bayar = $this->request->getVar('bulan_bayar');

                $alokasi = $this->alokasiModel->getMitraSBML($tahun, $bulan_bayar, $mitra);
                $keg = count($alokasi);

                return json_encode($keg);
            }
        }
    }

    public function getAlokasiOB()
    {
        if ($this->request->getVar('action')) {
            $action = $this->request->getVar('action');

            if ($action == 'get_alokasiOB') {
                $tahun = $this->request->getVar('tahun');
                $mitra = $this->request->getVar('mitra');
                $bulan_bayar = $this->request->getVar('bulan_bayar');

                $alokasi = $this->alokasiModel->getMitraSBML($tahun, $bulan_bayar, $mitra);

                $arr_satuankegiatan = [];

                foreach ($alokasi as $a) {
                    if ($a['satuan_kegiatan_id'] == '3') {
                        array_push($arr_satuankegiatan, $a['satuan_kegiatan_id']);
                    }
                }

                $OB = count($arr_satuankegiatan);


                return json_encode($OB);
            }
        }
    }

    // public function tambahalokasimanual()
    // {
    //     $this->alokasiModel->save([
    //         'tahun' => $this->request->getVar('tahun'),
    //         'kegiatan_id' => $this->request->getVar('kegiatan'),
    //         'sobat_id' => $this->request->getVar('mitra'),
    //         'beban_kerja' => $this->request->getVar('bebankerja'),
    //         'posisi_id' => $this->request->getVar('posisi')
    //     ]);

    //     session()->setFlashdata('message', '<div class="alert alert-success mt-3" role="alert">
    //     Alokasi berhasil ditambahkan </div>');

    //     return redirect()->to('/mitra/alokasimitra');
    // }


    // ALOKASI EXCEL
    public function validasiVolume($kegiatan_id, $volume_bebankerja)
    {
        $kegiatan = $this->kegiatanModel->where('id', $kegiatan_id)->first();
        $alokasi = $this->alokasiModel->where('kegiatan_id', $kegiatan_id)->findAll();

        $volume_teralokasi = 0;
        foreach ($alokasi as $a) {
            $volume_teralokasi += $a['beban_kerja'];
        }
        // dd('volume teralokasi', $volume_teralokasi);

        if ($volume_bebankerja > ($kegiatan['volume'] - $volume_teralokasi)) {
            return false;
        } else {
            return true;
        }
    }

    public function validasiOB($tahun, $kegiatan_id, $mitra_input)
    {
        $satuan_kegiatan = $this->kegiatanModel->where('id', $kegiatan_id)->first()['satuan_kegiatan_id'];


        if ($satuan_kegiatan == 3) {
            // Case: mitra sudah mengikuti kegiatan lain, ingin diassign kegiatan OB.
            $alokasi_list = [];
            $alokasi_mitra = $this->alokasiModel->where('tahun', $tahun)->findAll();

            foreach ($mitra_input as $key => $value) {
                if ($key == 0) { //table header
                    continue;
                }

                foreach ($alokasi_mitra as $a) {
                    if ($value[0] == $a['sobat_id'] && $value[3] == $a['bulan_bayar_mitra']) {
                        $data = [
                            'sobat_id' => $value[0],
                            'bulan_bayar' =>  $value[3]
                        ];
                        array_push($alokasi_list, $data);
                    }
                }
            }

            return ($alokasi_list);
        } else {
            // Case: mitra sudah mengikuti kegiatan OB, ingin diassign kegiatan lain.
            $OB_list = [];
            $alokasi_OB = $this->alokasiModel->getAlokasiOB($tahun);

            foreach ($mitra_input as $key => $value) {
                if ($key == 0) { //table header
                    continue;
                }

                foreach ($alokasi_OB as $a) {
                    if ($value[0] == $a['sobat_id'] && $value[3] == $a['bulan_bayar_mitra']) {
                        $data = [
                            'sobat_id' => $value[0],
                            'bulan_bayar' =>  $value[3]
                        ];
                        array_push($OB_list, $data);
                    }
                }
            }

            return ($OB_list);
        }
    }

    public function validasiTotalHonor($tahun, $kegiatan_id, $mitra_input)
    {
        $alokasi = $this->alokasiModel->getAlokasiSBML($tahun);

        $total_honor = 0;
        $arr_sbml = [];
        $keg = $this->kegiatanModel->getSBML($kegiatan_id);
        $harga_satuan = $this->kegiatanModel->where('id', $kegiatan_id)->first()['harga_satuan'];
        $total_honor_msg = [];

        foreach ($mitra_input as $key => $value) {
            foreach ($alokasi as $a) {
                if ($value[0] == $a['sobat_id'] && $value[3] == $a['bulan_bayar_mitra'] && $a['satuan_kegiatan_id'] != "3") {
                    $total_honor += $a['honor'];
                    array_push($arr_sbml, $a['sbml']);
                }
            }

            if (count($arr_sbml) != 0) {
                $keg_sbml = $keg[0]['sbml'];
                if ($keg[0]['satuan_kegiatan_id'] != "3") {
                    array_push($arr_sbml, $keg_sbml);
                    $sbml = max($arr_sbml);
                } else {
                    $sbml = $keg[0]['sbml'];
                }
            } else {
                $sbml = $keg[0]['sbml'];
            }

            $honor_input = (int) $value[1] * (int) $harga_satuan;
            $honor = $honor_input + $total_honor;
            if ($honor > $sbml) {
                $data = [
                    'sobat_id' => $value[0],
                    'bulan_bayar' => $value[3],
                    'total_honor' => $total_honor,
                    'sbml_mitra' => $sbml
                ];

                array_push($total_honor_msg, $data);
            }
        }

        return ($total_honor_msg);
    }

    public function getMitraAlokasiInfo($tahun, $bulan_bayar, $mitra, $kegiatan_id)
    {
        $alokasi = $this->alokasiModel->getMitraSBML($tahun, $bulan_bayar, $mitra);

        $total_honor = 0;
        $arr_sbml = [];

        foreach ($alokasi as $a) {
            if ($a['satuan_kegiatan_id'] != "3") { //satuan kegiatan bukan O-B
                $total_honor += $a['honor'];
                array_push($arr_sbml, $a['sbml']);
            }
        }

        if (count($arr_sbml) != 0) {
            $keg = $this->kegiatanModel->getSBML($kegiatan_id);
            $keg_sbml = $keg[0]['sbml'];
            if ($keg[0]['satuan_kegiatan_id'] != "3") {
                array_push($arr_sbml, $keg_sbml);
                $sbml = max($arr_sbml);
            } else {
                $keg = $this->kegiatanModel->getSBML($kegiatan_id);
                $sbml = $keg[0]['sbml'];
            }
        } else {
            $keg = $this->kegiatanModel->getSBML($kegiatan_id);
            $sbml = $keg[0]['sbml'];
        }

        $data = [
            'total_honor' => $total_honor,
            'sbml_mitra' => $sbml
        ];

        return $data;
    }

    public function importAlokasi()
    {
        $file = $this->request->getFile('alokasi_excel');
        $extension = $file->getClientExtension();
        $tahun = $this->request->getVar('tahun_excel');
        $kegiatan = $this->request->getVar('kegiatan_excel');
        $satuan_kegiatan = $this->kegiatanModel->where('id', $kegiatan)->first()['satuan_kegiatan_id'];

        if ($extension == 'xlsx' || $extension == 'xls') {
            if ($extension == 'xls') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($file);
            $alokasi = $spreadsheet->getActiveSheet()->toArray();

            $volume_bebankerja = 0;

            $alokasi_db = $this->alokasiModel->where('tahun', $tahun)->findAll();

            $bulan_bayar_master = explode(",", $this->kegiatanModel->where('id', $kegiatan)->first()['bulan_bayar']);
            // dd($bulan_bayar_master);
            $posisi_id_master = ['1', '2', '3', '4', '5'];
            $bulan_bayar_notvalid = [];
            $posisi_id_notvalid = [];
            $duplicate_data = [];

            $data_mitra = [];

            foreach ($alokasi as $key => $value) {

                if ($key == 0) { //table header
                    continue;
                }

                $volume_bebankerja += $value[1]; //beban kerja

                if (!in_array($value[2], $posisi_id_master)) {
                    array_push($posisi_id_notvalid, 'tidak valid');
                }
                if (!in_array($value[3], $bulan_bayar_master)) {
                    array_push($bulan_bayar_notvalid, 'tidak valid');
                }

                $data = [
                    'tahun' => $tahun,
                    'kegiatan_id' => $kegiatan,
                    'sobat_id' => $value[0],
                    'beban_kerja' => $value[1],
                    'posisi_id' => $value[2],
                    'bulan_bayar_mitra' => $value[3],
                    'honor' => (int) $value[1] * (int) $satuan_kegiatan
                ];

                foreach ($alokasi_db as $key => $value) {
                    if ($value['kegiatan_id'] == $kegiatan and $value['sobat_id'] == $data['sobat_id'] and $value['bulan_bayar_mitra'] == $data['bulan_bayar_mitra']) {
                        array_push($duplicate_data, $data);
                    }
                }

                array_push($data_mitra, $data);
            }



            // A. VALIDASI VOLUME BEBAN KERJA
            $status_volume = $this->validasiVolume($kegiatan, $volume_bebankerja);
            if ($status_volume) { //CASE: beban kerja clean

                // B. VALIDASI BULAN BAYAR
                if (empty($bulan_bayar_notvalid)) { //CASE: bulan bayar valid

                    // C. VALIDASI POSISI ID
                    if (empty($posisi_id_notvalid)) { //CASE: posisi id valid

                        // D. VALIDASI DUPLIKASI
                        if (empty($duplicate_data)) {

                            // E. VALIDASI KEGIATAN O-B
                            $validasi_kegiatanOB = $this->validasiOB($tahun, $kegiatan, $alokasi);
                            if (empty($validasi_kegiatanOB)) { //CASE: validasi OB clean

                                // F. VALIDASI TOTAL HONOR
                                $total_honor_err = $this->validasiTotalHonor($tahun, $kegiatan, $alokasi);
                                if (empty($total_honor_err)) {
                                    // == DATA CLEAN ==
                                    dd('clean all validation');
                                } else {

                                    $list = '';
                                    foreach ($total_honor_err as $err) {
                                        $msg = '<li> Total honor mitra ' . $err['sobat_id'] . ' bulan ' . $err['bulan_bayar'] . ' melebihi batas. Batas honor mitra adalah ' . $err['sbml_mitra'] . '</li>';
                                        $list = $list . $msg;
                                    }
                                    session()->setFlashdata(
                                        'message',
                                        '<div class="alert alert-danger mt-3" role="alert"><ul>' .
                                            $list .
                                            '</ul></div>'
                                    );
                                }
                                return redirect()->to('/mitra/alokasimitra');
                            } else {
                                //validasi OB error
                                if ($satuan_kegiatan == 3) {
                                    $list = '';
                                    foreach ($validasi_kegiatanOB as $OB) {
                                        $msg = '<li> Mitra ' . $OB['sobat_id'] . ' sudah mengikuti kegiatan lain pada bulan ' . $OB['bulan_bayar'] . ' sehingga <strong>tidak bisa</strong> mengikuti kegiatan O-B.</li>';
                                        $list = $list . $msg;
                                    }
                                    session()->setFlashdata(
                                        'message',
                                        '<div class="alert alert-danger mt-3" role="alert"><ul>' .
                                            $list .
                                            '</ul></div>'
                                    );
                                } else {
                                    $list = '';
                                    foreach ($validasi_kegiatanOB as $OB) {
                                        $msg = '<li> Mitra ' . $OB['sobat_id'] . ' sudah mengikuti kegiatan O-B pada bulan ' . $OB['bulan_bayar'] . ' sehingga <strong>tidak bisa</strong> mengikuti kegiatan lain.</li>';
                                        $list = $list . $msg;
                                    }
                                    session()->setFlashdata(
                                        'message',
                                        '<div class="alert alert-danger mt-3" role="alert"><ul>' .
                                            $list .
                                            '</ul></div>'
                                    );
                                }

                                return redirect()->to('/mitra/alokasimitra');
                            }
                        } else {

                            $list = '';
                            foreach ($duplicate_data as $d) {
                                $msg = '<li>Data alokasi mitra ' . $d['sobat_id'] . ' bulan bayar ' . $d['bulan_bayar_mitra'] . ' untuk kegiatan ini sudah ada di database.' . '</li>';
                                $list = $list . $msg;
                            }
                            session()->setFlashdata(
                                'message',
                                '<div class="alert alert-danger mt-3" role="alert"> Gagal menambahkan alokasi <br><ul>' .
                                    $list .
                                    '</ul>Gunakan fitur edit alokasi mitra jika ingin mengubahnya.</div>'
                            );

                            return redirect()->to('/mitra/alokasimitra');
                        }
                    } else {
                        session()->setFlashdata('message', '<div class="alert alert-danger mt-3" role="alert">Posisi id tidak valid. </div>');

                        return redirect()->to('/mitra/alokasimitra');
                    }
                } else {
                    session()->setFlashdata('message', '<div class="alert alert-danger mt-3" role="alert">Bulan bayar tidak valid. </div>');

                    return redirect()->to('/mitra/alokasimitra');
                }
            } else {
                session()->setFlashdata('message', '<div class="alert alert-danger mt-3" role="alert">
                Total beban kerja melebihi volume kegiatan. </div>');

                return redirect()->to('/mitra/alokasimitra');
            }
        } else {
            session()->setFlashdata('message', '<div class="alert alert-danger mt-3" role="alert">
            Format file tidak sesuai </div>');

            return redirect()->to('/mitra/alokasimitra');
        }
    }
    // END OF ALOKASI EXCEL

    // END OF ALOKASI MITRA

}
