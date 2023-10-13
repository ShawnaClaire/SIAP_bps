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
                    <?php foreach ($tahun as $t) : ?>
                        <option value="<?= $t['tahun_anggaran']; ?>"><?= $t['tahun_anggaran']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-3">
                <label for="mitra" class="form-label">Mitra</label>
            </div>
            <div class="col-9 col-sm-8 col-md-6">
                <select id="mitra" name="mitra" class="form-select" required disabled>
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
        <div id="data-card" class="card-body">
            <div id="identitasMitra">
                <div class="row fw-bold">
                    <div class="col-4 col-md-3">Nama Mitra</div>
                    <div id="namamitra-view" class="col-8">: [Nama mitra]</div>
                </div>
                <div class="row fw-bold">
                    <div class="col-4 col-md-3">Sobat ID</div>
                    <div id="sobatid-view" class="col-8">: [Sobat ID]</div>
                </div>
            </div>

            <table id="tabel_alokasi_mitra" class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Honor Teralokasi</th>
                        <th>Alokasi Tersedia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <!-- <tfoot>
                    <tr>
                        <th>Bulan</th>
                        <th>Honor Teralokasi</th>
                        <th>Alokasi Tersedia</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot> -->
                <tbody>
                    <tr id='row1'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr id='row2'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr id='row3'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr id='row4'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr id='row5'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr id='row6'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr id='row7'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr id='row8'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr id='row9'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr id='row10'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr id='row11'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr id='row12'>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                </tbody>
            </table>
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

    
    function getAlokasiMitra() {
        var tahun = $('#tahun').val();
        var mitra = $('#mitra').val();
        // alert('tahun:' + $('#tahun').val() + " mitra:" + $('#mitra').val())

        var action = 'get_alokasi_mitra';

        $.ajax({
            url: "<?= site_url('mitra/getAlokasiMitraAjax'); ?>",
            type: "POST",
            async: false,
            data: {
                tahun: tahun,
                mitra: mitra,
                action: action
            },
            dataType: "JSON",
            success: function(data) {
                var html = '';
                var i = 1;

                for (let index = 0; index < data.length; index++) {
                    var persentase_honor_teralokasi = Math.round(data[index].honor_teralokasi/data[index].sbml_mitra*100);

                    var bulan = convertMonth(String(data[index].bulan));

                    if (data[index].honor_teralokasi == 0) {
                        $('#row' + String(i)).html(
                            "<td>" + bulan + "</td>" +
                            "<td>" + "-" + "</td>" +
                            "<td>" + "-" + "</td>" +
                            "<td>" + `<button class="btn btn-secondary" onclick='seeDetail(`+ data[index].bulan + `,`+ data[index].honor_teralokasi + `,` + data[index].sbml_mitra + `)' disabled>Detail</button>` + "</td>"
                        );

                    } else {
                        if(persentase_honor_teralokasi >= 60 && persentase_honor_teralokasi < 80){
                            $('#row' + String(i)).html(
                                "<td>" + bulan + "</td>" +
                                "<td> Rp" + data[index].honor_teralokasi + `<div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-warning" style="width: `+persentase_honor_teralokasi+`%">`+persentase_honor_teralokasi+`%</div>
                                </div>` + "</td>" +
                                "<td> Rp" + data[index].alokasi_tersedia + "</td>" +
                                "<td>" + `<div class="btn btn-primary" onclick='seeDetail(`+ data[index].bulan + `,`+ data[index].honor_teralokasi + `,` + data[index].sbml_mitra + `)'>Detail</div>` + "</td>"
                            );
                        } else if(persentase_honor_teralokasi >= 80){
                            $('#row' + String(i)).html(
                                "<td>" + bulan + "</td>" +
                                "<td> Rp" + data[index].honor_teralokasi + `<div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-danger" style="width: `+persentase_honor_teralokasi+`%">`+persentase_honor_teralokasi+`%</div>
                                </div>` + "</td>" +
                                "<td> Rp" + data[index].alokasi_tersedia + "</td>" +
                                "<td>" + `<div class="btn btn-primary" onclick='seeDetail(`+ data[index].bulan + `,`+ data[index].honor_teralokasi + `,` + data[index].sbml_mitra + `)'>Detail</div>` + "</td>"
                            );
                        } else{
                            $('#row' + String(i)).html(
                                "<td>" + bulan + "</td>" +
                                "<td> Rp" + data[index].honor_teralokasi + `<div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar bg-success" style="width: `+persentase_honor_teralokasi+`%">`+persentase_honor_teralokasi+`%</div>
                                </div>` + "</td>" +
                                "<td> Rp" + data[index].alokasi_tersedia + "</td>" +
                                "<td>" + `<div class="btn btn-primary" onclick='seeDetail(`+ data[index].bulan + `,`+ data[index].honor_teralokasi + `,` + data[index].sbml_mitra + `)'>Detail</div>` + "</td>"
                            );
                        }
                    }

                    i++;


                }

            },
            error: function(xhr, thrownError) {
                alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function printMitraInfo(){
        var sobat_id = $('#mitra').val();

        var action = 'get_info_mitra';

        $.ajax({
            url: "<?= site_url('mitra/getInfoMitraAjax'); ?>",
            type: "POST",
            async: false,
            data: {
                sobat_id: sobat_id,
                action: action
            },
            dataType: "JSON",
            success: function(data) {
                // alert(data.sobat_id + " " + data.nama);
                $('#namamitra-view').html(": " + data.nama);
                $('#sobatid-view').html(": " + data.sobat_id);

            },
            error: function(xhr, thrownError) {
                alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function seeDetail(bulan, honorteralokasi, sbml){
        location.href = "<?= base_url('mitra/detailAlokasiMitra/'); ?>" + $('#mitra').val() + "/" + $('#tahun').val() + "/" + bulan + "/" + honorteralokasi + "/" + sbml;
    }

    $(document).ready(function() {
        var tahun = $('#tahun').val();
        var mitra = $('#mitra').val();

        $('#tahun').select2();
        $('#mitra').select2();

        $('#mitra').change(function() {
            var mitra = $('#mitra').html();
            var data_mitra = mitra.split(', ');
            printMitraInfo();
            getAlokasiMitra();
        });

        $('#tahun').change(function() {
            $('#mitra').prop('disabled', false);
            if ($('#mitra').val() != null) {
                getAlokasiMitra();
            }
        });


    });
</script>

<?= $this->endSection(); ?>