<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Alokasi Mitra</h1>
    <!-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol> -->

    <?php if (session()->getFlashdata('message')) : ?>
        <?= session()->getFlashdata('message'); ?>
    <?php endif; ?>

    <div class="mt-4">
        <h3>Tambah Manual</h3>
        <form action="/mitra/tambahalokasimanual" method="post">
            <?= csrf_field(); ?>
            <div class="container mb-3 mt-3">
                <!-- <div class="row mb-3">
                    <div class="col-3">
                        <label for="tahun" class="form-label">Tahun</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <input type="text" class="form-control" id="tahun" name="tahun" aria-describedby="tahun" placeholder="Tahun..." required maxlength="4">
                    </div>
                </div> -->

                <div class="row mb-3">
                    <div class="col-3">
                        <label for="tahun" class="form-label">Tahun</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <select id="tahun" name="tahun" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Tahun --</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3">
                        <label for="kegiatan" class="form-label">Kegiatan</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <select id="kegiatan" name="kegiatan" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Kegiatan --</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3">
                        <label for="mitra" class="form-label">Mitra</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <select id="mitra" name="mitra" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Mitra --</option>
                            <?php foreach ($mitra as $m) : ?>
                                <option value="<?= $m['sobat_id']; ?>"><?= $m['sobat_id']; ?>, <?= $m['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3">
                        <label for="bebankerja" class="form-label">Beban Kerja</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <input type="number" class="form-control" id="bebankerja" name="bebankerja" aria-describedby="bebankerja" placeholder="Beban Kerja..." required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3">
                        <label for="posisi" class="form-label">Posisi</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <select id="posisi" name="posisi" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Posisi --</option>
                            <?php foreach ($posisi as $p) : ?>
                                <option value="<?= $p['id']; ?>"><?= $p['posisi']; ?></option>
                            <?php endforeach; ?>
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
        <p>Tambah alokasi dengan mengunggah file excel.</p>
        <a href="<?= base_url('template_excel/template alokasi.xlsx'); ?>" class="btn btn-success">Download Template</a>


        <form action="/mitra/importAlokasi" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="container mb-3 mt-3">
                <!-- <div class="row mb-3">
                    <div class="col-3">
                        <label for="tahun" class="form-label">Tahun</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <input type="text" class="form-control" id="tahun" name="tahun" aria-describedby="tahun" placeholder="Tahun..." required maxlength="4">
                    </div>
                </div> -->

                <div class="row mb-3">
                    <div class="col-3">
                        <label for="tahun_excel" class="form-label">Tahun</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <select id="tahun_excel" name="tahun_excel" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Tahun --</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3">
                        <label for="kegiatan_excel" class="form-label">Kegiatan</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <select id="kegiatan_excel" name="kegiatan_excel" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Kegiatan --</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-3">
                        <label for="alokasi_excel" class="form-label">File Excel</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <input class="form-control" type="file" id="alokasi_excel" name="alokasi_excel" required>
                    </div>
                </div>


                <div class="d-flex justify-content-end gap-3 col-12 col-sm-11 col-md-9">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
        </form>
    </div>

</div>

<script>
    function alokasiManual() {
        $('#tahun').change(function() {
            var tahun = $('#tahun').val();
            var action = 'get_kegiatan';

            // alert(action);

            if (tahun != '') {
                // alert(tahun);
                $.ajax({
                    url: "<?= site_url('mitra/alokasiGetKegiatan'); ?>",
                    type: "POST",
                    data: {
                        tahun: tahun,
                        action: action
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // alert(success);
                        var html = '<option value="" selected disabled>--Pilih Kegiatan--</option>';
                        for (let index = 0; index < data.length; index++) {
                            html += '<option value="' + data[index].id + '">' + data[index].uraian_detail_akun + '</option>';
                        }

                        $('#kegiatan').html(html);

                    },
                    error: function(xhr, thrownError) {
                        alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            } else {
                $('#kegiatan').val('');
            }
        })
    }
    
    
    function alokasiExcel() {
        $('#tahun_excel').change(function() {
            var tahun = $('#tahun_excel').val();
            var action = 'get_kegiatan';

            // alert(tahun);

            if (tahun != '') {
                // alert(tahun);
                $.ajax({
                    url: "<?= site_url('mitra/alokasiGetKegiatan'); ?>",
                    type: "POST",
                    data: {
                        tahun: tahun,
                        action: action
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // alert(success);
                        var html = '<option value="" selected disabled>--Pilih Kegiatan--</option>';
                        for (let index = 0; index < data.length; index++) {
                            html += '<option value="' + data[index].id + '">' + data[index].uraian_detail_akun + '</option>';
                        }

                        $('#kegiatan_excel').html(html);

                    },
                    error: function(xhr, thrownError) {
                        alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            } else {
                $('#kegiatan_excel').val('');
            }
        })
    }

    $(document).ready(function() {
        $('#tahun').select2();
        $('#kegiatan').select2();
        $('#mitra').select2();
        alokasiManual();
        
        $('#tahun_excel').select2();
        $('#kegiatan_excel').select2();
        alokasiExcel();

    });
</script>

<?= $this->endSection(); ?>