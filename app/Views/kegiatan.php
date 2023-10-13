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
                        <th>Jumlah Petugas Mitra</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Subject Matter</th>
                        <th>Uraian Detail Akun</th>
                        <th>Jadwal</th>
                        <th>Jumlah Petugas Mitra</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($kegiatan as $k) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $k['subjectmatter_id']; ?></td>
                            <td><?= $k['uraian_detail_akun']; ?></td>
                            <td><?= $k['jadwal_mulai']; ?> - <?= $k['jadwal_akhir']; ?></td>
                            <td>jumlah mitra</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>