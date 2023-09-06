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
                                        <option value="1">Sosial</option>
                                        <option value="2">Produksi</option>
                                        <option value="3">Distribusi</option>
                                        <option value="4">Neraca</option>
                                        <option value="5">IPDS</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="namakegiatan" class="form-label">Nama Kegiatan</label>
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control" id="namakegiatan" name="namakegiatan" aria-describedby="namakegiatan" required>
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
                                    <label for="satuankegiatan" class="form-label">Satuan Kegiatan</label>
                                </div>
                                <div class="col-8">
                                    <select id="satuankegiatan" name="satuankegiatan" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Satuan Kegiatan --</option>
                                        <option value="1">Dokumen</option>
                                        <option value="2">Blok Sensus</option>
                                        <option value="3">O-B</option>
                                        <option value="4">O-K</option>
                                        <option value="5">O-P</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="honor" class="form-label">Honor</label>
                                </div>
                                <div class="col-8">
                                    <input type="number" class="form-control" id="honor" name="honor" aria-describedby="honor" placeholder="Rp..." required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-4">
                                    <label for="bulanbayar" class="form-label">Dibayarkan di Bulan</label>
                                </div>
                                <div class="col-8">
                                    <select id="bulanbayar" name="bulanbayar" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Bulan --</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
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
                        <th>Nama Kegiatan</th>
                        <th>Jadwal</th>
                        <th>Jumlah Petugas Mitra</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Subject Matter</th>
                        <th>Nama Kegiatan</th>
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
                            <td><?= $k['nama_kegiatan']; ?></td>
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