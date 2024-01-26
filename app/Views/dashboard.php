<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Kegiatan Subject Matter</h1>
    <!-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol> -->

    <!-- Cards -->
    <div class="row mt-4">
        <div class="col-xl col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Sosial</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">Produksi</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">Distribusi</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">Neraca</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl col-md-6">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">IPDS</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Kegiatan -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Kegiatan Bulan Ini
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Subject Matter</th>
                        <th>Nama Kegiatan</th>
                        <th>Jadwal</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Subject Matter</th>
                        <th>Nama Kegiatan</th>
                        <th>Jadwal</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($kegiatan as $k) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?php
                                foreach ($subjectmatter as $key => $value) {
                                    if ($k['subjectmatter_id'] == $value['id']) {
                                        echo ($value['nama_subjectmatter']);
                                    }
                                }
                                ?>
                                </td>
                            <td><?= $k['uraian_detail_akun']; ?></td>
                            <td><?= $k['jadwal_mulai']; ?> - <?= $k['jadwal_akhir']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>