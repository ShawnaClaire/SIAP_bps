<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Daftar Mitra</h1>
    <!-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol> -->


    <!-- Tabel Daftar Mitra -->
    <div class="card mb-4 mt-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Daftar Mitra
        </div>
        <div class="card-body">
            <div class="mb-3 d-flex gap-4">
                <a href="<?= base_url('mitra/export'); ?>" class="btn btn-primary"><i class="fa-solid fa-file-arrow-down fa-xl me-2"></i>Download</a>
            </div>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>ID Sobat</th>
                        <th>Nama Mitra</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Jenis Kelamin</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>ID Sobat</th>
                        <th>Nama Mitra</th>
                        <th>NIK</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>Jenis Kelamin</th>
                    </tr>
                </tfoot> -->
                <tbody>\
                    <?php foreach ($mitra as $m) : ?>
                        <tr>
                            <td><?= $m['idsobat']; ?></td>
                            <td><?= $m['nama']; ?></td>
                            <td><?= $m['nik']; ?></td>
                            <td><?= $m['alamat']; ?></td>
                            <td><?= $m['email']; ?></td>
                            <td><?= $m['jenis_kelamin']; ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>