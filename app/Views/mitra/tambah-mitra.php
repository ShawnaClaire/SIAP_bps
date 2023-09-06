<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Mitra</h1>
    <!-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol> -->

    <?php if (session()->getFlashdata('message')) : ?>
        <?= session()->getFlashdata('message'); ?>
    <?php endif; ?>


    <div class="mt-4">
        <h3>Tambah Manual</h3>
        <form action="/mitra/tambahmanual" method="post">
            <?= csrf_field(); ?>
            <div class="container mb-3 mt-3">
                <div class="row mb-3">
                    <div class="col-3">
                        <label for="sobat_id" class="form-label">ID Sobat</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <input type="number" class="form-control" id="sobat_id" name="sobat_id" aria-describedby="sobat_id" placeholder="ID Sobat..." required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3">
                        <label for="namamitra" class="form-label">Nama Mitra</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <input type="text" class="form-control" id="namamitra" name="namamitra" aria-describedby="namamitra" required placeholder="Nama Mitra...">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3">
                        <label for="nik" class="form-label">NIK</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <input type="number" class="form-control" id="nik" name="nik" aria-describedby="nik" placeholder="NIK..." required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3">
                        <label for="email" class="form-label">Email</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" required placeholder="Email...">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3">
                        <label for="alamat" class="form-label">Alamat</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <input type="text" class="form-control" id="alamat" name="alamat" aria-describedby="alamat" required placeholder="Alamat...">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3">
                        <label for="jeniskelamin" class="form-label">Jenis Kelamin</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <select id="jeniskelamin" name="jeniskelamin" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="1">Laki-Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 col-12 col-sm-11 col-md-9">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </div>

    <div class="mt-4">
        <h3>Upload Excel</h3>
        <p>Tambah mitra dengan mengunggah file excel.</p>
        <a href="<?= base_url('template_excel/template mitra.xlsx'); ?>" class="btn btn-success">Download Template</a>
        <!-- Button Upload Mitra - trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadMitra">
            Upload Data
        </button>
    </div>


    <!-- Modal Upload Data Mitra -->
    <div class="modal fade" id="uploadMitra" tabindex="-1" aria-labelledby="uploadMitraLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="uploadMitraLabel">Upload Data Mitra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('mitra/import'); ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <?= csrf_field(); ?>
                        <label for="mitra_excel" class="form-label">Default file input example</label>
                        <input class="form-control" type="file" id="mitra_excel" name="mitra_excel" required>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-end gap-3">
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <a class="btn btn-secondary" data-bs-dismiss="modal">Batal</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>

<?= $this->endSection(); ?>