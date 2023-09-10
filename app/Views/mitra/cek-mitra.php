<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Cek Mitra</h1>
    <!-- <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol> -->

    <div class="container mt-4">
        <!-- Filter -->
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
                <label for="bulan" class="form-label">Bulan</label>
            </div>
            <div class="col-9 col-sm-8 col-md-6">
                <select id="bulan" name="bulan" class="form-select" required>
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

    </div>



    <!-- Tabel Daftar Mitra -->
    <div class="card mb-4 mt-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Mitra
        </div>
        <div class="card-body">
            <div id="identitasMitra" style="display: none;">
                <div class="row fw-bold">
                    <div class="col-4 col-md-3">Nama Mitra</div>
                    <div class="col-8">: [Nama mitra]</div>
                </div>
                <div class="row fw-bold">
                    <div class="col-4 col-md-3">Tahun</div>
                    <div class="col-8">: [Tahun]</div>
                </div>
                <div class="row fw-bold">
                    <div class="col-4 col-md-3">Bulan</div>
                    <div class="col-8">: [Bulan]</div>
                </div>
            </div>

            <div class="mt-3 d-flex gap-4">
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
                            <td><?= $m['sobat_id']; ?></td>
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


<script>
    function getMitra() {
        $('#tahun').change(function() {

            $('#bulan').prop("disabled", false);
            $('#bulan').change(function() {

                $('#mitra').prop("disabled", false);
                
                var tahun = $('#tahun').val();
                var bulan = $('#bulan').val();
                var action = 'get_mitra';


                if ((tahun != '') && (bulan != '')) {
                // alert(tahun);
                $.ajax({
                    url: "<?= site_url('mitra/getAlokasiMitraAjax'); ?>",
                    type: "POST",
                    data: {
                        tahun: tahun,
                        bulan: bulan,
                        action: action
                    },
                    dataType: "JSON",
                    success: function(data) {
                        // alert(success);
                        var html = '<option value="" selected disabled>--Pilih Mitra--</option>';
                        for (let index = 0; index < data.length; index++) {
                            html += '<option value="' + data[index].sobat_id + '">' + data[index].sobat_id + ', '+ data[index].nama + '</option>';
                        }

                        $('#mitra').html(html);

                    },
                    error: function(xhr, thrownError) {
                        alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            } else {
                $('#mitra').val('');
            }

            })

            // alert(action);


            
        })
    }


    $(document).ready(function() {
        var tahun = $('#tahun').val();
        var bulan = $('#bulan').val();
        var mitra = $('#mitra').val();

        $('#tahun').select2();
        $('#bulan').select2();
        $('#mitra').select2();

        if (tahun == null) {
            $('#bulan').prop("disabled", true);
            $('#mitra').prop("disabled", true);
        }

        getMitra();

        // alert(tahun + " " + bulan + " " + mitra)

        // if(tahun==null && bulan==null && mitra==null){
        //     $('#identitasMitra').html("");
        // }


    });
</script>

<?= $this->endSection(); ?>