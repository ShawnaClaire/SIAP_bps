<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Alokasi Mitra</h1>
    <!-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol> -->
    
    <?php if (session()->getFlashdata('message')) : ?>
        <?= session()->getFlashdata('message'); ?>
    <?php endif; ?>

    <!-- Tabel Detail Alokasi Mitra -->
    <div id="data-card" class="card mb-4 mt-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Alokasi Mitra
        </div>
        <div class="card-body">
            <div id="identitasMitra" class="mb-5">
                <div class="row fw-bold">
                    <div class="col-4 col-md-3">Nama Mitra</div>
                    <div id="namamitra-view" class="col-8">: <?= $mitra['nama']; ?></div>
                </div>
                <div class="row fw-bold">
                    <div class="col-4 col-md-3">Sobat ID</div>
                    <div id="sobatid-view" class="col-8">: <?= $mitra['sobat_id']; ?></div>
                </div>
                <div class="row fw-bold">
                    <div class="col-4 col-md-3">Tahun</div>
                    <div id="tahun-view" class="col-8">: <?= $tahun; ?></div>
                </div>
                <div class="row fw-bold">
                    <div class="col-4 col-md-3">Bulan</div>
                    <div id="bulan-view" class="col-8">: <?= $bulan; ?></div>
                </div>
            </div>

            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Beban Kerja</th>
                        <th>Total Honor</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th>Beban Kerja</th>
                        <th>Total Honor</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($alokasi as $a) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $a['uraian_detail_akun']; ?></td>
                            <td><?= $a['beban_kerja']; ?></td>
                            <td><?= $a['honor']; ?></td>
                            <td>
                                <div class="d-flex flex-row gap-3 justify-content-center">
                                    <!-- edit button -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editAlokasi" onclick="edit_Alokasi(<?= $a['id']; ?>)">
                                        <i class="fa-solid fa-pen-to-square fa-lg text-white"></i>
                                    </button>

                                    <!-- delete button -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusAlokasi" onclick="hapus_Alokasi(<?= $a['id']; ?>)">
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


    <!-- Modal Edit Alokasi-->
    <div class="modal fade" id="editAlokasi" tabindex="-1" aria-labelledby="editAlokasiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editAlokasiLabel">Edit Alokasi Mitra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/mitra/simpanEditAlokasi" method="post">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <input type="hidden" id="id_alokasi" name="id_alokasi">
                            <input type="hidden" id="sobat_id" name="sobat_id" value="<?= $mitra['sobat_id']; ?>">
                            <input type="hidden" id="tahun" name="tahun" value="<?= $tahun; ?>">
                            <input type="hidden" id="bulan" name="bulan" value="<?= $bulan; ?>">
                            <input type="hidden" id="honor_teralokasi" name="honor_teralokasi" value="<?= $honor_teralokasi; ?>">
                            <input type="hidden" id="sbml" name="sbml" value="<?= $sbml; ?>">
                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="beban_kerja" class="form-label">Beban Kerja</label>
                                </div>
                                <div class="col-8">
                                    <input type="number" class="form-control" id="beban_kerja" name="beban_kerja" aria-describedby="beban_kerja" placeholder="Beban Kerja..." required min="0">
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

    <!-- Modal Hapus Alokasi-->
    <div class="modal fade" id="hapusAlokasi" tabindex="-1" aria-labelledby="hapusAlokasiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="hapusAlokasiLabel">Hapus Alokasi Mitra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h5>Anda yakin ingin menghapus alokasi ini?</h5>
                    <i class="fa-solid fa-trash fa-2xl text-danger mt-4"></i>
                    <form action="/mitra/hapusAlokasi" method="post">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <input type="hidden" id="id_alokasi_hapus" name="id_alokasi_hapus">
                            <input type="hidden" id="sobat_id" name="sobat_id" value="<?= $mitra['sobat_id']; ?>">
                            <input type="hidden" id="tahun" name="tahun" value="<?= $tahun; ?>">
                            <input type="hidden" id="bulan" name="bulan" value="<?= $bulan; ?>">
                            <input type="hidden" id="honor_teralokasi" name="honor_teralokasi" value="<?= $honor_teralokasi; ?>">
                            <input type="hidden" id="sbml" name="sbml" value="<?= $sbml; ?>">
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

</div>

<script>
    function edit_Alokasi($id) {
        $.ajax({
            url: "<?= site_url('/mitra/editDataAlokasi/'); ?>" + $id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                if (data.alokasi_id != '') { //cek kalau datanya ditemukan
                    // masukkann data di tiap2 inputan
                    $('#id_alokasi').val(data.alokasi_id);
                    $('#beban_kerja').val(data.beban_kerja);

                }
            },
        });
    }
    
    function hapus_Alokasi($id) {
        $('#id_alokasi_hapus').val($id);
    }


</script>


<?= $this->endSection(); ?>