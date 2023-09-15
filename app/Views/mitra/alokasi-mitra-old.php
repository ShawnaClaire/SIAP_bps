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
        <div id="storage_volume" style="display: none;">value</div>
        <div id="storage_hargasatuan" style="display: none;">value</div>

        <!-- <button id="try" class="btn btn-warning">Try Get Alokasi</button>
        <input type="text" name="try" id="try-input"> -->

        <form action="/mitra/addalokasi" method="post">
            <?= csrf_field(); ?>
            <div class="container mb-3 mt-3">
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
                        <label for="kegiatan" class="form-label">Kegiatan</label>
                    </div>
                    <div class="col-9 col-sm-8 col-md-6">
                        <select id="kegiatan" name="kegiatan" class="form-select" required>
                            <option value="" selected disabled>-- Pilih Kegiatan --</option>
                        </select>
                    </div>
                </div>

                <div id="item-container-box" style="display: none;">
                    <div class="row mb-1">
                        <div class="col-12 fw-bolder">
                            Masukkan Mitra
                        </div>
                    </div>



                    <div class="mb-2 d-flex justify-content-start align-items-center gap-4">
                        <div>
                            <div class="btn btn-success add-item-btn"><i class="fa-solid fa-plus"></i></div>
                        </div>
                        <div>
                            <div id="message1" class="alert alert-primary px-2 py-0 mb-1" role="alert" style="visibility: visible;">
                                Message 1
                            </div>

                            <div id="message2" class="alert alert-primary px-2 py-0 mb-1" role="alert" style="visibility: visible;">
                                Message 2
                            </div>

                            <div id="message3" class="alert alert-primary px-2 py-0 mb-1" role="alert" style="visibility: visible;">
                                Message 3
                            </div>

                        </div>
                    </div>

                    <div class="item mb-3" id="item">
                        <div class="mb-1 d-flex justify-content-between align-items-center p-1 rounded-2 gap-2">
                            <div class="w-25 mitra-column">
                                <select name="mitra[]" class="form-select mitra-input" required>
                                    <option value="" selected disabled>--Pilih Mitra--</option>
                                    <?php foreach ($mitra as $m) : ?>
                                        <option value="<?= $m['sobat_id']; ?>"><?= $m['sobat_id']; ?>, <?= $m['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="w-25 bebankerja-column">
                                <input type="number" class="form-control bebankerja" name="bebankerja[]" aria-describedby="bebankerja" placeholder="Beban Kerja..." min="1" required>
                            </div>

                            <div class="w-25 posisi-column">
                                <select name="posisi[]" class="form-select" required>
                                    <option value="" selected disabled>--Pilih Posisi--</option>
                                    <?php foreach ($posisi as $p) : ?>
                                        <option value="<?= $p['id']; ?>"><?= $p['posisi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="w-25 bulanbayar-column">
                                <select name="bulanbayar[]" class="form-select bulan-bayar" required>
                                    <option value="" selected disabled>--Bulan Bayar--</option>
                                </select>
                            </div>


                            <div class="" style="visibility: hidden;">
                                <div class="btn btn-light"><i class="fa-solid fa-xmark"></i></div>
                            </div>

                            <div class="w-25 honor-column" style="display: none;">
                                <input type="number" class="form-control honor" name="honor[]" aria-describedby="honor" placeholder="Honor..." min="0" required readonly>
                            </div>

                            <div class="w-25 honor-teralokasi-column" style="display: none;">
                                <input type="number" class="form-control honor-teralokasi" name="honorteralokasi[]" aria-describedby="honor-teralokasi" placeholder="Honor Teralokasi..." min="0" required readonly>
                            </div>

                            <div class="bulan_bayar_status">
                                <!-- default -->
                            </div>

                        </div>
                    </div>
                </div>


                <div class="d-flex justify-content-end gap-3 col-12 col-sm-11 col-md-12">
                    <button id="submitmanual" type="submit" class="btn btn-primary me-5" style="display: none;">Submit</button>
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
                            <?php foreach ($tahun as $t) : ?>
                                <option value="<?= $t['tahun_anggaran']; ?>"><?= $t['tahun_anggaran']; ?></option>
                            <?php endforeach; ?>
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
    function dynamicInput() {
        $('.add-item-btn').click(function(e) {
            e.preventDefault();
            $('#item').prepend(`
            <div class="mb-1 d-flex justify-content-between gap-2 align-items-center p-1 rounded-2 gap-2">    
            <div class="w-25 mitra-column">
                    <select name="mitra[]" class="form-select mitra-input" required>
                        <option value="" selected disabled>--Pilih Mitra--</option>
                        <?php foreach ($mitra as $m) : ?>
                            <option value="<?= $m['sobat_id']; ?>"><?= $m['sobat_id']; ?>, <?= $m['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="w-25 bebankerja-column">
                    <input type="number" class="form-control bebankerja" name="bebankerja[]" aria-describedby="bebankerja" placeholder="Beban Kerja..."  min="1" required>
                </div>

                <div class="w-25 posisi-column">
                    <select name="posisi[]" class="form-select" required>
                        <option value="" selected disabled>--Pilih Posisi--</option>
                        <?php foreach ($posisi as $p) : ?>
                            <option value="<?= $p['id']; ?>"><?= $p['posisi']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="w-25 bulanbayar-column">
                <select name="bulanbayar[]" class="form-select bulan-bayar" required>
                        <option value="" selected disabled>--Bulan Bayar--</option>
                    </select>
                </div>

                <div class="">
                    <div class="btn btn-danger remove-item-btn"><i class="fa-solid fa-xmark"></i></div>
                </div>

                
                <div class="w-25 honor-column" style="display: none;">
                    <input type="number" class="form-control honor" name="honor[]" aria-describedby="honor" placeholder="Honor..." min="0" required readonly>
                </div>

                <div class="w-25 honor-teralokasi-column" style="display: none;">
                    <input type="number" class="form-control honor-teralokasi" name="honorteralokasi[]" aria-describedby="honor-teralokasi" placeholder="Honor Teralokasi..." min="0" required readonly>
                </div>

                <div class="bulan_bayar_status">
                <!-- default2 -->
                </div>
                

            </div>
        `);

            $('.mitra-input').select2();

            $('.bulan-bayar').each(function() {
                // alert($(this).val());
                if ($(this).val() == null) {
                    getBulanBayar($(this));
                }
            });

            $('.bebankerja').change(function() {
                bebanKerjaValidate();
                calculateHonor();

                var statusobj = $(this).parent().parent().children('.bulan_bayar_status');
                var mitra = $(this).parent().parent().children('.mitra-column').children('.mitra-input').val();
                var tahun = $('#tahun').val();
                var bulan_bayar = $(this).parent().parent().children('.bulanbayar-column').children('.bulan-bayar').val();
                var honorteralokasiinput = $(this).parent().parent().children('.honor-teralokasi-column').children('.honor-teralokasi');
                var honor = $(this).parent().parent().children('.honor-column').children('.honor');
                var row = $(this).parent().parent();

                // validasi total honor
                if (bulan_bayar != null) {
                    validateHonor(tahun, mitra, bulan_bayar, honor.val(), honorteralokasiinput, row);
                }
            });


            $('.bulan-bayar').change(function() {
                $('.bulan-bayar').each(function() {
                    var statusobj = $(this).parent().parent().children('.bulan_bayar_status');
                    var mitra = $(this).parent().parent().children('.mitra-column').children('.mitra-input').val();
                    var tahun = $('#tahun').val();
                    var honorteralokasiinput = $(this).parent().parent().children('.honor-teralokasi-column').children('.honor-teralokasi');
                    var honor = $(this).parent().parent().children('.honor-column').children('.honor');
                    var row = $(this).parent().parent();

                    // validasi total honor
                    validateHonor(tahun, mitra, $(this).val(), honor.val(), honorteralokasiinput, row);

                    // validasi OB
                    validateOB(tahun, mitra, $(this).val(), row)

                })
            });

            $('.mitra-input').change(function() {
                $('.mitra-input').each(function() {

                    var statusobj = $(this).parent().parent().children('.bulan_bayar_status');
                    var bulan_bayar = $(this).parent().parent().children('.bulanbayar-column').children('.bulan-bayar').val();
                    var tahun = $('#tahun').val();
                    var honorteralokasiinput = $(this).parent().parent().children('.honor-teralokasi-column').children('.honor-teralokasi');
                    var honor = $(this).parent().parent().children('.honor-column').children('.honor');
                    var row = $(this).parent().parent();

                    // validasi total honor
                    if (bulan_bayar != null) {
                        validateHonor(tahun, $(this).val(), bulan_bayar, honor.val(), honorteralokasiinput, row);
                    }

                    // validasi OB
                    validateOB(tahun, $(this).val(), bulan_bayar, row);

                })
            });



        })
    }

    function getBulanBayar(obj) {
        // alert(obj.val())
        var kegiatan = $('#kegiatan').val();
        var action = 'get_bulanbayar';

        if (kegiatan != '') {
            $.ajax({
                url: "<?= site_url('mitra/alokasiGetBulanBayar'); ?>",
                type: "POST",
                data: {
                    kegiatan: kegiatan,
                    action: action
                },
                dataType: "JSON",
                success: function(data) {
                    var html = '<option value="" selected disabled>--Bulan Bayar--</option>';
                    for (let index = 0; index < data.length; index++) {
                        // alert(data[index]);
                        switch (data[index]) {
                            case "1":
                                html += '<option value="' + data[index] + '">' + 'Januari' + '</option>';
                                break;
                            case "2":
                                html += '<option value="' + data[index] + '">' + 'Februari' + '</option>';
                                break;
                            case "3":
                                html += '<option value="' + data[index] + '">' + 'Maret' + '</option>';
                                break;
                            case "4":
                                html += '<option value="' + data[index] + '">' + 'April' + '</option>';
                                break;
                            case "5":
                                html += '<option value="' + data[index] + '">' + 'Mei' + '</option>';
                                break;
                            case "6":
                                html += '<option value="' + data[index] + '">' + 'Juni' + '</option>';
                                break;
                            case "7":
                                html += '<option value="' + data[index] + '">' + 'Juli' + '</option>';
                                break;
                            case "8":
                                html += '<option value="' + data[index] + '">' + 'Agustus' + '</option>';
                                break;
                            case "9":
                                html += '<option value="' + data[index] + '">' + 'September' + '</option>';
                                break;
                            case "10":
                                html += '<option value="' + data[index] + '">' + 'Oktober' + '</option>';
                                break;
                            case "11":
                                html += '<option value="' + data[index] + '">' + 'November' + '</option>';
                                break;
                            case "12":
                                html += '<option value="' + data[index] + '">' + 'Desember' + '</option>';
                                break;

                            default:
                                break;
                        }
                    }

                    // $('.bulan-bayar').html(html);
                    obj.html(html);

                },
                error: function(xhr, thrownError) {
                    alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        } else {
            obj.val('');
            // $('.bulan-bayar').val('');
        }


    }

    function alokasiManual() {
        $('#tahun').change(function() {
            var tahun = $('#tahun').val();
            var action = 'get_kegiatan';

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
                        var html = '<option value="" selected disabled>-- Pilih Kegiatan --</option>';
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

    function getInfoKegiatan() {
        var kegiatan = $('#kegiatan').val();
        var action = 'get_infokegiatan';

        if (kegiatan != '') {
            $.ajax({
                url: "<?= site_url('mitra/alokasiGetInfoKegiatan'); ?>",
                type: "POST",
                data: {
                    kegiatan_id: kegiatan,
                    action: action
                },
                dataType: "JSON",
                success: function(data) {
                    // var info = {'volume':data['volume'], 'harga_satuan':data['harga_satuan']};
                    $('#storage_hargasatuan').html(data['harga_satuan']);
                    $('#storage_volume').html(data['volume']);

                },
                error: function(xhr, thrownError) {
                    alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

    }

    function bebanKerjaValidate() {
        var volume_bebankerja = 0;
        $('.bebankerja').each(function() {
            volume_bebankerja += parseInt($(this).val());
        })

        var volume = parseInt($('#storage_volume').html());

        if (volume_bebankerja > volume) {
            $('#message1').removeClass('alert-primary');
            $('#message1').addClass('alert-danger');
            $('#message1').html("<li> Total beban kerja melebihi volume kegiatan. Volume kegiatan adalah " + $('#storage_volume').html() + "</li>");
            $('#message1').css('visibility', 'visible');
            $('#submitmanual').prop("disabled", true);
        } else {
            $('#message1').html("-");
            $('#message1').css('visibility', 'hidden');
            $('#submitmanual').prop("disabled", false);
        }
    }

    function calculateHonor() {
        var harga_satuan = parseInt($('#storage_hargasatuan').html());

        $('.bebankerja').each(function() {
            var honor = $(this).val() * harga_satuan;
            $(this).parent().parent().children('.honor-column').children('.honor').val(honor);
        })
    }

    function validateHonor(thn, mitra, bln_byr, honor, obj, row) {
        // var tahun = "2022";
        // var mitra = "222";
        // var bulan_bayar = "8";
        // obj = $('#try-input');

        // for get honor teralokasi
        var tahun = thn;
        var mitra = mitra;
        var bulan_bayar = bln_byr;
        var action = 'get_alokasi';
        var kegiatan = $('#kegiatan').val();

        $.ajax({
            url: "<?= site_url('mitra/getAlokasi'); ?>",
            type: "POST",
            data: {
                tahun: tahun,
                mitra: mitra,
                bulan_bayar: bulan_bayar,
                kegiatan_id: kegiatan,
                action: action
            },
            dataType: "JSON",
            success: function(data) {
                obj.val(data['total_honor']);

                var total_honor = parseInt(honor) + parseInt(data['total_honor']);

                if (total_honor > data['sbml_mitra']) {
                    // row.html('error');
                    row.addClass('bg-danger');
                    row.css('--bs-bg-opacity', '.7');

                    $('#message2').removeClass('alert-primary');
                    $('#message2').addClass('alert-danger');
                    $('#message2').html("<li>Total honor mitra " + mitra + " bulan " + bulan_bayar + " melebihi batas. Batas honor mitra adalah " + data['sbml_mitra'] + "</li>");
                    $('#message2').css('visibility', 'visible');
                    $('#submitmanual').prop("disabled", true);

                } else {
                    if (row.hasClass('bg-danger')) {
                        row.removeClass('bg-danger');
                        row.css('--bs-bg-opacity', '1');

                        $('#message2').html("-");
                        $('#message2').css('visibility', 'hidden');
                        $('#submitmanual').prop("disabled", false);
                    }
                }
            },
            error: function(xhr, thrownError) {
                alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }



    function validateOB(thn, mitra, bln_byr, row) {
        e.preventDefault();
        // var tahun = "2022";
        // var mitra = "222";
        // var bulan_bayar = "8";
        // obj = $('#try-input');

        // for get honor teralokasi
        var tahun = thn;
        var mitra = mitra;
        var bulan_bayar = bln_byr;
        var action = 'get_alokasiOB';


        $.ajax({
            url: "<?= site_url('mitra/getAlokasiOB'); ?>",
            type: "POST",
            data: {
                tahun: tahun,
                mitra: mitra,
                bulan_bayar: bulan_bayar,
                action: action
            },
            dataType: "JSON",
            success: function(data) {

                if (data > 0) {
                    row.addClass('bg-danger');
                    row.css('--bs-bg-opacity', '.7');

                    $('#message3').removeClass('alert-primary');
                    $('#message3').addClass('alert-danger');
                    $('#message3').html("<li>Mitra " + mitra + " sudah mengikuti kegiatan O-B pada bulan " + bulan_bayar + ". Tidak bisa mengikuti kegiatan lain.</li>");
                    $('#message3').css('visibility', 'visible');
                    $('#submitmanual').prop("disabled", true);

                } else {
                    if (row.hasClass('bg-danger')) {
                        row.removeClass('bg-danger');
                        row.css('--bs-bg-opacity', '1');

                        $('#message3').html("-");
                        $('#message3').css('visibility', 'hidden');
                        $('#submitmanual').prop("disabled", false);
                    }
                }
            },
            error: function(xhr, thrownError) {
                alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }



    // function validateHonor(honor, honorteralokasi, row) {
    //     var sbml = 50000;
    //     var total_honor = parseInt(honor) + parseInt(honorteralokasi);
    //     alert(total_honor);
    //     if (total_honor > sbml) {
    //         row.addClass('bg-danger');
    //         // alert('honor melebihi sbml');
    //     } else{
    //         row.removeClass('bg-danger');
    //         row.addClass('bg-success');
    //     }

    // }


    $(document).ready(function() {
        // ALOKASI MANUAL
        $('#tahun').select2();
        $('#kegiatan').select2();
        $('.mitra-input').select2();

        alokasiManual();
        dynamicInput();

        $('#kegiatan').change(function() {
            getBulanBayar($('.bulan-bayar'));
            $('#item-container-box').css('display', 'block');
            $('#submitmanual').css("display", "block");
            getInfoKegiatan();
        });

        $('.bebankerja').change(function() {
            bebanKerjaValidate();
            calculateHonor();

            var statusobj = $(this).parent().parent().children('.bulan_bayar_status');
            var mitra = $(this).parent().parent().children('.mitra-column').children('.mitra-input').val();
            var tahun = $('#tahun').val();
            var bulan_bayar = $(this).parent().parent().children('.bulanbayar-column').children('.bulan-bayar').val();
            var honorteralokasiinput = $(this).parent().parent().children('.honor-teralokasi-column').children('.honor-teralokasi');
            var honor = $(this).parent().parent().children('.honor-column').children('.honor');
            var row = $(this).parent().parent();

            // validasi total honor
            if (bulan_bayar != null) {
                validateHonor(tahun, mitra, bulan_bayar, honor.val(), honorteralokasiinput, row);
            }
        });


        $('.bulan-bayar').change(function() {
            $('.bulan-bayar').each(function() {
                var statusobj = $(this).parent().parent().children('.bulan_bayar_status');
                var mitra = $(this).parent().parent().children('.mitra-column').children('.mitra-input').val();
                var tahun = $('#tahun').val();
                var honorteralokasiinput = $(this).parent().parent().children('.honor-teralokasi-column').children('.honor-teralokasi');
                var honor = $(this).parent().parent().children('.honor-column').children('.honor');
                var row = $(this).parent().parent();

                // validasi total honor
                validateHonor(tahun, mitra, $(this).val(), honor.val(), honorteralokasiinput, row);

                // validasi OB
                validateOB(tahun, mitra, $(this).val(), row)


            })
        });

        $('.mitra-input').change(function() {
            $('.mitra-input').each(function() {
                var statusobj = $(this).parent().parent().children('.bulan_bayar_status');
                var bulan_bayar = $(this).parent().parent().children('.bulanbayar-column').children('.bulan-bayar').val();
                var tahun = $('#tahun').val();
                var honorteralokasiinput = $(this).parent().parent().children('.honor-teralokasi-column').children('.honor-teralokasi');
                var honor = $(this).parent().parent().children('.honor-column').children('.honor');
                var row = $(this).parent().parent();

                if (bulan_bayar != null) {
                    // validasi total honor
                    validateHonor(tahun, $(this).val(), bulan_bayar, honor.val(), honorteralokasiinput, row);

                    // validasi OB
                    validateOB(tahun, $(this).val(), bulan_bayar, row);
                }


            })
        });





        // $('#try').click(function() {
        //     getHonorTeralokasi();
        // })


        // UPLOAD EXCEL
        $('#tahun_excel').select2();
        $('#kegiatan_excel').select2();
        alokasiExcel();


        

    });

    $(document).on('click', '.remove-item-btn', function(e) {
        e.preventDefault();
        let row_item = $(this).parent().parent();
        $(row_item).remove();
        bebanKerjaValidate();
    })
</script>

<?= $this->endSection(); ?>