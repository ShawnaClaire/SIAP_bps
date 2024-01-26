<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Kegiatan Sensus dan Survei</h1>
    <!-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol> -->

    <!-- Button Tambah Kegiatan - trigger modal -->
    <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Tambah
    </button>

    <!-- Flash Data -->
    <?php if (session()->getFlashdata('message')) : ?>
        <?= session()->getFlashdata('message'); ?>
    <?php endif; ?>

    <!-- Modal Tambah Kegiatan -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kegiatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/kegiatan/save" method="post">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="subjectmatter" class="form-label">Subject Matter</label>
                                </div>
                                <div class="col-8">
                                    <select id="subjectmatter" name="subjectmatter" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Subject Matter --</option>
                                        <?php foreach ($subjectmatter as $s) : ?>
                                            <option value="<?= $s['id']; ?>"><?= $s['nama_subjectmatter']; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="tahunanggaran" class="form-label">Tahun Anggaran</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="tahunanggaran" name="tahunanggaran" aria-describedby="tahunanggaran" required maxlength="4">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="kodemataanggaran" class="form-label">Kode Mata Anggaran</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="kodemataanggaran" name="kodemataanggaran" aria-describedby="kodemataanggaran" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="uraiandetailakun" class="form-label">Uraian Detail Akun</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="uraiandetailakun" name="uraiandetailakun" aria-describedby="uraiandetailakun" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="jeniskegiatan" class="form-label">Jenis Kegiatan</label>
                                </div>
                                <div class="col-8">
                                    <select id="jeniskegiatan" name="jeniskegiatan" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Jenis Kegiatan --</option>
                                        <?php foreach ($jenis_kegiatan as $jk) : ?>
                                            <option value="<?= $jk['id']; ?>"><?= $jk['jenis_kegiatan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="satuankegiatan" class="form-label">Satuan Kegiatan</label>
                                </div>
                                <div class="col-8">
                                    <select id="satuankegiatan" name="satuankegiatan" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Satuan Kegiatan --</option>
                                        <?php foreach ($satuan_kegiatan as $sk) : ?>
                                            <option value="<?= $sk['id']; ?>"><?= $sk['satuan_kegiatan']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="volume" class="form-label">Volume</label>
                                </div>
                                <div class="col-8">
                                    <input type="number" class="form-control" id="volume" name="volume" aria-describedby="volume" placeholder="Volume..." required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="hargasatuan" class="form-label">Harga Satuan</label>
                                </div>
                                <div class="col-8">
                                    <input type="number" class="form-control" id="hargasatuan" name="hargasatuan" aria-describedby="hargasatuan" placeholder="Rp..." required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="jadwalmulai" class="form-label">Jadwal Mulai</label>
                                </div>
                                <div class="col-8">
                                    <input type="date" class="form-control" id="jadwalmulai" name="jadwalmulai" aria-describedby="jadwalmulai" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="jadwalakhir" class="form-label">Jadwal Akhir</label>
                                </div>
                                <div class="col-8">
                                    <input type="date" class="form-control" id="jadwalakhir" name="jadwalakhir" aria-describedby="jadwalakhir" required>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-4">
                                    <label for="bulanbayar" class="form-label">Bulan Bayar</label>
                                </div>
                                <div class="col-8 d-flex flex-wrap justify-content-evenly  align-items-start">
                                    <?php foreach ($month as $key => $value) : ?>
                                        <div class=" col-6 col-md-4">
                                            <input class="form-check-input" type="checkbox" value="<?= $key; ?>" id="bulanbayar<?= $key; ?>" name="bulanbayar[]">
                                            <label class="form-check-label" for="bulanbayar<?= $key; ?>"><?= $value; ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>


                        </div>

                        <div class="d-flex justify-content-end gap-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Daftar Kegiatan -->
    <div class="card mb-4 mt-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Kegiatan
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Subject Matter</th>
                        <th>Uraian Detail Akun</th>
                        <th>Jadwal</th>
                        <!-- <th>Jumlah Petugas Mitra</th> -->
                        <th>Aksi</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Subject Matter</th>
                        <th>Uraian Detail Akun</th>
                        <th>Jadwal</th>
                        <th>Jumlah Petugas Mitra</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($kegiatan as $k) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td>
                                <?php
                                foreach ($subjectmatter as $key => $value) {
                                    if ($k['subjectmatter_id'] == $value['id']) {
                                        echo ($value['nama_subjectmatter']);
                                    }
                                }
                                ?>
                                
                            </td>
                            <td><?= $k['uraian_detail_akun']; ?></td>
                            <td><?= $k['jadwal_mulai']; ?> - <?= $k['jadwal_akhir']; ?></td>
                            <!-- <td>jumlah mitra</td> -->
                            <td>
                                <div class="d-flex flex-row gap-3 justify-content-center">
                                    <!-- edit button -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editKegiatanModal" onclick="edit_kegiatan(<?= $k['id']; ?>)">
                                        <i class="fa-solid fa-pen-to-square fa-lg text-white"></i>
                                    </button>

                                    <!-- delete button -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusKegiatanModal" onclick="hapus_kegiatan(<?= $k['id']; ?>)">
                                        <i class="fa-solid fa-trash fa-lg text-white"></i>
                                    </button>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit Kegiatam-->
<div class="modal fade" id="editKegiatanModal" tabindex="-1" aria-labelledby="editKegiatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editKegiatanModalLabel">Edit Kegiatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/kegiatan/saveedit" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" id="id_kegiatan_edit" name="id_kegiatan_edit">

                    <div class="mb-3">
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="subjectmatter_edit" class="form-label">Subject Matter</label>
                            </div>
                            <div class="col-8">
                                <select id="subjectmatter_edit" name="subjectmatter_edit" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Subject Matter --</option>
                                    <?php foreach ($subjectmatter as $s) : ?>
                                        <option id="subjectmatter<?= $s['id']; ?>" value="<?= $s['id']; ?>"><?= $s['nama_subjectmatter']; ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="tahunanggaran_edit" class="form-label">Tahun Anggaran</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" id="tahunanggaran_edit" name="tahunanggaran_edit" aria-describedby="tahunanggaran_edit" required maxlength="4">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="kodemataanggaran_edit" class="form-label">Kode Mata Anggaran</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" id="kodemataanggaran_edit" name="kodemataanggaran_edit" aria-describedby="kodemataanggaran_edit" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="uraiandetailakun_edit" class="form-label">Uraian Detail Akun</label>
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" id="uraiandetailakun_edit" name="uraiandetailakun_edit" aria-describedby="uraiandetailakun_edit" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="jeniskegiatan_edit" class="form-label">Jenis Kegiatan</label>
                            </div>
                            <div class="col-8">
                                <select id="jeniskegiatan_edit" name="jeniskegiatan_edit" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Jenis Kegiatan --</option>
                                    <?php foreach ($jenis_kegiatan as $jk) : ?>
                                        <option id="jeniskeg<?= $jk['id']; ?>" value="<?= $jk['id']; ?>"><?= $jk['jenis_kegiatan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="satuankegiatan_edit" class="form-label">Satuan Kegiatan</label>
                            </div>
                            <div class="col-8">
                                <select id="satuankegiatan_edit" name="satuankegiatan_edit" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Satuan Kegiatan --</option>
                                    <?php foreach ($satuan_kegiatan as $sk) : ?>
                                        <option id="satuankeg<?= $sk['id']; ?>" value="<?= $sk['id']; ?>"><?= $sk['satuan_kegiatan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="volume_edit" class="form-label">Volume</label>
                            </div>
                            <div class="col-8">
                                <input type="number" class="form-control" id="volume_edit" name="volume_edit" aria-describedby="volume_edit" placeholder="Volume..." required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="hargasatuan_edit" class="form-label">Harga Satuan</label>
                            </div>
                            <div class="col-8">
                                <input type="number" class="form-control" id="hargasatuan_edit" name="hargasatuan_edit" aria-describedby="hargasatuan_edit" placeholder="Rp..." required>
                                <div id="alert_hrgsatuan" class="alert alert-warning fw-bolder mt-2 p-1" style="display: none;"></div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="jadwalmulai_edit" class="form-label">Jadwal Mulai</label>
                            </div>
                            <div class="col-8">
                                <input type="date" class="form-control" id="jadwalmulai_edit" name="jadwalmulai_edit" aria-describedby="jadwalmulai_edit" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="jadwalakhir_edit" class="form-label">Jadwal Akhir</label>
                            </div>
                            <div class="col-8">
                                <input type="date" class="form-control" id="jadwalakhir_edit" name="jadwalakhir_edit" aria-describedby="jadwalakhir_edit" required>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-4">
                                <label for="bulanbayar_edit" class="form-label">Bulan Bayar</label>
                            </div>
                            <div class="col-8 d-flex flex-wrap justify-content-evenly  align-items-start">
                                <?php foreach ($month as $key => $value) : ?>
                                    <div class=" col-6 col-md-4">
                                        <input class="form-check-input bulanbayar_input" type="checkbox" value="<?= $key; ?>" id="bulanbayar_edit<?= $key; ?>" name="bulanbayar_edit[]">
                                        <label class="form-check-label bulanbayar_label" id="bulanbayar_edit_label<?= $key; ?>" for="bulanbayar_edit<?= $key; ?>"><?= $value; ?></label>
                                    </div>
                                <?php endforeach; ?>
                                <div id="alert_blnbyr" class="alert alert-warning fw-bolder mt-2 p-1" style="display: none;"></div>
                            </div>
                        </div>


                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal Hapus Kegiatan-->
<div class="modal fade" id="hapusKegiatanModal" tabindex="-1" aria-labelledby="hapusKegiatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="hapusKegiatanModalLabel">Hapus Kegiatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h5>Anda yakin ingin menghapus kegiatan ini?</h5>
                <i class="fa-solid fa-trash fa-2xl text-danger mt-4"></i>
                <form action="/kegiatan/hapusKegiatan" method="post">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <input type="hidden" id="id_kegiatan_hapus" name="id_kegiatan_hapus">
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <button type="submit" class="btn btn-primary">Hapus</button>
                        <a class="btn btn-secondary" data-bs-dismiss="modal">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function convertMonth(month) {
        switch (month) {
            case "1":
                month = "Januari";
                return (month);
                break;
            case "2":
                month = "Februari";
                return (month);
                break;
            case "3":
                month = "Maret";
                return (month);
                break;
            case "4":
                month = "April";
                return (month);
                break;
            case "5":
                month = "Mei";
                return (month);
                break;
            case "6":
                month = "Juni";
                return (month);
                break;
            case "7":
                month = "Juli";
                return (month);
                break;
            case "8":
                month = "Agustus";
                return (month);
                break;
            case "9":
                month = "September";
                return (month);
                break;
            case "10":
                month = "Oktober";
                return (month);
                break;
            case "11":
                month = "November";
                return (month);
                break;
            case "12":
                month = "Desember";
                return (month);
                break;

            default:
                break;
        }
    }

    function edit_kegiatan($id) {
        $('.bulanbayar_input').each(function() {
            $(this).prop('checked', false);
            $(this).css('pointer-events', 'auto');
        })
        $('.bulanbayar_label').each(function() {
            $(this).css('pointer-events', 'auto');
        })
        $('#alert_hrgsatuan').html('');
        $('#alert_hrgsatuan').css('display', 'none');

        $.ajax({
            url: "<?= site_url('/kegiatan/editDataAlokasi/'); ?>" + $id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data.id != '') { //cek kalau datanya ditemukan
                    // masukkann data di tiap2 inputan
                    $('#id_kegiatan_edit').val(data.id);
                    $(`#subjectmatter` + data.subjectmatter_id).attr("selected", "selected");
                    $('#tahunanggaran_edit').val(data.tahun_anggaran);
                    $('#kodemataanggaran_edit').val(data.kode_mata_anggaran);
                    $('#uraiandetailakun_edit').val(data.uraian_detail_akun);
                    $(`#jeniskeg` + data.jenis_kegiatan_id).attr("selected", "selected");
                    $(`#satuankeg` + data.satuan_kegiatan_id).attr("selected", "selected");
                    $('#volume_edit').val(data.volume);
                    $('#hargasatuan_edit').val(data.harga_satuan);
                    $('#jadwalmulai_edit').val(data.jadwal_mulai);
                    $('#jadwalakhir_edit').val(data.jadwal_akhir);

                    var bln_byr = data.bulan_bayar;
                    var bln_byr_alokasi = data.bulan_bayar_alokasi;

                    if (bln_byr_alokasi.length != 0) {
                        var temp = [];
                        for (let index = 0; index < bln_byr_alokasi.length; index++) {
                            temp[index] = convertMonth(bln_byr_alokasi[index]);
                        }

                        var bln_no_edit = temp.join(", ");
                        $('#alert_blnbyr').html('Tidak dapat mengubah bulan bayar ' + bln_no_edit + ' karena sudah ada alokasi');
                        $('#alert_blnbyr').css('display', 'block');
                    } else{
                        $('#alert_blnbyr').html('');
                        $('#alert_blnbyr').css('display', 'none');
                    }

                    for (let i = 0; i < bln_byr.length; i++) {
                        $(`#bulanbayar_edit` + bln_byr[i]).prop('checked', true);

                        if (bln_byr_alokasi.length != 0) {
                            for (let j = 0; j < bln_byr_alokasi.length; j++) {
                                // alert(bln_byr_alokasi[j]);
                                if (bln_byr_alokasi[j] == bln_byr[i]) { //ada alokasi untuk bulan bayar tersebut 
                                    $(`#bulanbayar_edit` + bln_byr[i]).css('pointer-events', 'none');
                                    $(`#bulanbayar_edit_label` + bln_byr[i]).css('pointer-events', 'none');
                                }
                            }
                        }
                    }


                }
            },
            error: function(xhr, thrownError) {
                alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function hapus_kegiatan($id) {
        $('#id_kegiatan_hapus').val($id);
    }


    $(document).ready(function() {
        $('#hargasatuan_edit').change(function() {
            $('#alert_hrgsatuan').html('<small>Peringatan! mengubah harga satuan dapat mempengaruhi total honor alokasi mitra</small>');
            $('#alert_hrgsatuan').css('display', 'block');
        })
    });
</script>



<?= $this->endSection(); ?>