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

    <div class="mt-4 alokasimanual-container">
        <h3>Tambah Manual</h3>
        <div id="storage_volume" style="display: none;">volume</div>
        <div id="storage_volume_belum_teralokasi" style="display: none;">volume belum teralokasi</div>
        <div id="storage_hargasatuan" style="display: none;">harga satuan</div>
        <div id="storage_satuankegiatanid" style="display: none;">satuan kegiatan id</div>
        <div id="storage_bulanbayaroption" style="display: none;">value</div>

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
                        <div class="col-1">
                            <div class="btn btn-success add-item-btn"><i class="fa-solid fa-plus"></i></div>
                        </div>
                        <div class="col-10">
                            <div id="message1" class="alert alert-primary px-2 py-0 mb-1" role="alert" style="visibility: hidden;">
                                Message 1
                            </div>

                            <div id="message2" class="alert alert-primary px-2 py-0 mb-1" role="alert" style="visibility: hidden;">
                                Message 2
                            </div>

                            <div id="message3" class="alert alert-primary px-2 py-0 mb-1" role="alert" style="visibility: hidden;">
                                Message 3
                            </div>
                        </div>
                    </div>

                    <div class="item mb-3" id="item">
                        <div id="row1" class="mb-1 d-flex justify-content-between align-items-center p-1 rounded-2 gap-2">
                            <div class="w-25 mitra-column">
                                <select id="mitra1" onchange="mitraInputChange('mitra1','1')" name="mitra[]" class="form-select mitra-input" required>
                                    <option value="" selected disabled>--Pilih Mitra--</option>
                                    <?php foreach ($mitra as $m) : ?>
                                        <option value="<?= $m['sobat_id']; ?>"><?= $m['sobat_id']; ?>, <?= $m['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="w-25 bebankerja-column">
                                <input id="bebankerja1" onchange="bebanKerjaChange('bebankerja1','1')" type="number" class="form-control bebankerja" name="bebankerja[]" aria-describedby="bebankerja" placeholder="Beban Kerja..." min="1" required>
                            </div>

                            <div class="w-25 posisi-column">
                                <select id="posisi1" name="posisi[]" class="form-select" required>
                                    <option value="" selected disabled>--Pilih Posisi--</option>
                                    <?php foreach ($posisi as $p) : ?>
                                        <option value="<?= $p['id']; ?>"><?= $p['posisi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="w-25 bulanbayar-column">
                                <select id="bulanbayar1" onchange="bulanBayarChange('bulanbayar1','1')" name="bulanbayar[]" class="form-select bulan-bayar" required>
                                    <option value="" selected disabled>--Bulan Bayar--</option>
                                </select>
                            </div>


                            <div class="" style="visibility: hidden;">
                                <div class="btn btn-light"><i class="fa-solid fa-xmark"></i></div>
                            </div>

                            <div class="w-25 honor-column" style="display: none;">
                                <input id="honor1" type="number" class="form-control honor" name="honor[]" aria-describedby="honor" placeholder="Honor..." min="0" required readonly>
                            </div>

                            <div class="w-25 honor-teralokasi-column" style="display: none;">
                                <input id="honorteralokasi1" type="number" class="form-control honor-teralokasi" name="honorteralokasi[]" aria-describedby="honor-teralokasi" placeholder="Honor Teralokasi..." min="0" required readonly>
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


    <div class="mt-4 alokasiexcel-container">
        <h3>Upload Excel</h3>
        <p>Tambah alokasi dengan mengunggah file excel.</p>
        <a href="<?= base_url('template_excel/template alokasi.xlsx'); ?>" class="btn btn-success">Unduh Template</a>


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
                        <div class="mb-2">
                            <select id="kegiatan_excel" name="kegiatan_excel" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Kegiatan --</option>
                            </select>
                        </div>
                        <div class="fw-bold">
                            <div id="volume_keg_info" class="d-flex gap-2 px-2 py-1 mb-0 alert alert-primary" role="alert" style="visibility: hidden;">
                                <div class="col-9">
                                    Volume kegiatan belum teralokasi:
                                </div>
                                <div id="volume_value" class="col-3">
                                    00/00
                                </div>
                            </div>
                        </div>
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
                    <button id="submitexcel" type="submit" class="btn btn-primary" disabled>Submit</button>
                </div>

            </div>
        </form>
    </div>

</div>


<!-- JS for Alokasi Manual -->
<script>
    var totalhonor_error_msg = {};
    var OB_error_msg = {};

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

    function dynamicInput(i) {
        $('#item').prepend(`
            <div id=row` + i + ` class="mb-1 d-flex justify-content-between gap-2 align-items-center p-1 rounded-2 gap-2">   
             
                <div class="w-25 mitra-column">
                    <select id=mitra` + i + ` onchange="mitraInputChange('mitra` + i + `','` + i + `')" ` + ` name="mitra[]" class="form-select mitra-input" required>
                        <option value="" selected disabled>--Pilih Mitra--</option>
                        <?php foreach ($mitra as $m) : ?>
                            <option value="<?= $m['sobat_id']; ?>"><?= $m['sobat_id']; ?>, <?= $m['nama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="w-25 bebankerja-column">
                    <input id=bebankerja` + i + ` onchange="bebanKerjaChange('bebankerja` + i + `','` + i + `')" ` + ` type="number" class="form-control bebankerja" name="bebankerja[]" aria-describedby="bebankerja" placeholder="Beban Kerja..."  min="1" required>
                </div>

                <div class="w-25 posisi-column">
                    <select id=posisi` + i + ` name="posisi[]" class="form-select" required>
                        <option value="" selected disabled>--Pilih Posisi--</option>
                        <?php foreach ($posisi as $p) : ?>
                            <option value="<?= $p['id']; ?>"><?= $p['posisi']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="w-25 bulanbayar-column">
                    <select id=bulanbayar` + i + ` onchange="bulanBayarChange('bulanbayar` + i + `','` + i + `')" ` + ` name="bulanbayar[]" class="form-select bulan-bayar" required>
                        <option value="" selected disabled>--Bulan Bayar--</option>
                    </select>
                </div>

                <div class="">
                    <div id=remove-btn` + i + ` onclick="removeButtonClick('remove-btn` + i + `')" ` + ` class="btn btn-danger remove-item-btn"><i class="fa-solid fa-xmark"></i></div>
                </div>
                
                <div class="w-25 honor-column" style="display: none;">
                    <input id=honor` + i + ` type="number" class="form-control honor" name="honor[]" aria-describedby="honor" placeholder="Honor..." min="0" required readonly>
                </div>

                <div class="w-25 honor-teralokasi-column" style="display: none;">
                    <input id=honorteralokasi` + i + ` type="number" class="form-control honor-teralokasi" name="honorteralokasi[]" aria-describedby="honor-teralokasi" placeholder="Honor Teralokasi..." min="0" required readonly>
                </div>

                <div id=bulan-bayar-status` + i + ` class="bulan_bayar_status">
                    <!-- default2 -->
                </div>
                

            </div>
            `);

        $('.mitra-input').select2();

        $('.bulan-bayar').each(function() {
            if ($(this).val() == null) {
                // getBulanBayar($(this));
                bulan_bayar_option = $('#storage_bulanbayaroption').html();
                $(this).html(bulan_bayar_option);
            }
        });


    }

    function getBulanBayarOption() {
        var kegiatan = $('#kegiatan').val();
        var action = 'get_bulanbayar';

        if (kegiatan != '') {
            $.ajax({
                url: "<?= site_url('mitra/alokasiGetBulanBayar'); ?>",
                type: "POST",
                async: false,
                data: {
                    kegiatan: kegiatan,
                    action: action
                },
                dataType: "JSON",
                success: function(data) {
                    var html = '<option value="" selected disabled>--Bulan Bayar--</option>';
                    for (let index = 0; index < data.length; index++) {
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

                    $('#storage_bulanbayaroption').html(html);

                },
                error: function(xhr, thrownError) {
                    alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        } else {
            $('#storage_bulanbayaroption').html('');
        }


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
                async: false,
                data: {
                    kegiatan_id: kegiatan,
                    action: action
                },
                dataType: "JSON",
                success: function(data) {
                    // var info = {'volume':data['volume'], 'harga_satuan':data['harga_satuan']};
                    $('#storage_hargasatuan').html(data['harga_satuan']);
                    $('#storage_volume').html(data['volume_total']);
                    $('#storage_volume_belum_teralokasi').html(data['volume_belum_teralokasi']);
                    $('#storage_satuankegiatanid').html(data['satuan_kegiatan_id']);

                },
                error: function(xhr, thrownError) {
                    alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

    }

    function bebanKerjaValidate() {
        // alert('validate beban kerja');
        var volume_bebankerja = 0;
        $('.bebankerja').each(function() {
            if ($(this).val() != '') {
                volume_bebankerja += parseInt($(this).val());
            }
        })

        var volume = parseInt($('#storage_volume').html());
        var volume_belum_teralokasi = parseInt($('#storage_volume_belum_teralokasi').html());

        if (volume_bebankerja > volume_belum_teralokasi) {
            $('#message1').removeClass('alert-primary');
            $('#message1').addClass('alert-danger');
            $('#message1').html("<li> Total beban kerja melebihi volume kegiatan. Volume kegiatan belum teralokasi adalah " + $('#storage_volume_belum_teralokasi').html() + " / " + $('#storage_volume').html() + "</li>");
            $('#message1').css('visibility', 'visible');
            $('#submitmanual').prop("disabled", true);
        } else {
            $('#message1').html("");
            $('#message1').css('visibility', 'hidden');

            if (Object.keys(totalhonor_error_msg).length == 0 && Object.keys(OB_error_msg).length == 0 && $('#message1').html() == "") {
                $('#submitmanual').prop("disabled", false);
            }
        }
    }

    function calculateHonor(input_id, index) {
        var harga_satuan = parseInt($('#storage_hargasatuan').html());

        var bebankerja_obj = $("#" + input_id);
        var honor = bebankerja_obj.val() * harga_satuan;
        $("#honor" + index).val(honor);
        // obj.parent().parent().children('.honor-column').children('.honor').val(honor);

    }

    function validateHonor(thn, mitra, bln_byr, honor, obj, row) {
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
                    if (!row.hasClass('bg-danger')) {
                        row.addClass('bg-danger');
                        row.css('--bs-bg-opacity', '.7');
                    }
                    row.addClass('totalhonor-error');

                    $('#message2').removeClass('alert-primary');
                    $('#message2').addClass('alert-danger');

                    // $('#message2').html("<li>Total honor mitra " + mitra + " bulan " + bulan_bayar + " melebihi batas. Batas honor mitra adalah " + data['sbml_mitra'] + "</li>");

                    bulan_bayar = convertMonth(bulan_bayar);

                    var row_id = row.attr("id");
                    totalhonor_error_msg[row_id] = "<li>Total honor mitra " + mitra + " bulan " + bulan_bayar + " melebihi batas. Batas honor mitra adalah " + data['sbml_mitra'] + "</li>";

                    // console.log(totalhonor_error_msg);

                    error_msg = "";
                    for (const key in totalhonor_error_msg) {
                        const value = totalhonor_error_msg[key];
                        error_msg += value;
                    }
                    $('#message2').html(error_msg);

                    $('#message2').css('visibility', 'visible');
                    $('#submitmanual').prop("disabled", true);

                } else {
                    if (row.hasClass('totalhonor-error')) {
                        row.removeClass('totalhonor-error');
                    }

                    if (!row.hasClass('OB-error')) {
                        row.removeClass('bg-danger');
                        row.css('--bs-bg-opacity', '1');
                    }

                    var row_id = row.attr("id");
                    if (totalhonor_error_msg[row_id] != "") {
                        delete totalhonor_error_msg[row_id];
                    }

                    if (Object.keys(totalhonor_error_msg).length == 0) {
                        $('#message2').css('visibility', 'hidden');

                    } else {
                        error_msg = "";
                        for (const key in totalhonor_error_msg) {
                            const value = totalhonor_error_msg[key];
                            error_msg += value;
                        }
                        $('#message2').html(error_msg);
                    }

                    // alert(Object.keys(totalhonor_error_msg).length);
                    if (Object.keys(totalhonor_error_msg).length == 0 && Object.keys(OB_error_msg).length == 0 && $('#message1').html() == "") {
                        $('#submitmanual').prop("disabled", false);
                    }
                }
            },
            error: function(xhr, thrownError) {
                alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function getMitraKegiatan(thn, mitra, bln_byr, row) {
        var tahun = thn;
        var mitra = mitra;
        var bulan_bayar = bln_byr;
        var action = 'get_alokasiAll';

        // alert(tahun + " " + mitra + " " + bulan_bayar);

        $.ajax({
            url: "<?= site_url('mitra/getAllAlokasi'); ?>",
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
                    if (!row.hasClass('bg-danger')) {
                        row.addClass('bg-danger');
                        row.css('--bs-bg-opacity', '.7');
                    }
                    row.addClass('OB-error');

                    $('#message3').removeClass('alert-primary');
                    $('#message3').addClass('alert-danger');

                    bulan_bayar = convertMonth(bulan_bayar);

                    var row_id = row.attr("id");
                    OB_error_msg[row_id] = "<li>Mitra " + mitra + " sudah mengikuti kegiatan lain pada bulan " + bulan_bayar + " sehingga <strong>tidak bisa</strong> mengikuti kegiatan ini.</li>";

                    // console.log(OB_error_msg);

                    error_msg = "";
                    for (const key in OB_error_msg) {
                        const value = OB_error_msg[key];
                        error_msg += value;
                    }
                    $('#message3').html(error_msg);


                    $('#message3').css('visibility', 'visible');
                    $('#submitmanual').prop("disabled", true);

                } else {
                    if (row.hasClass('OB-error')) {
                        row.removeClass('OB-error');
                    }

                    if (!row.hasClass('totalhonor-error')) {
                        row.removeClass('bg-danger');
                        row.css('--bs-bg-opacity', '1');
                    }

                    var row_id = row.attr("id");
                    if (OB_error_msg[row_id] != "") {
                        delete OB_error_msg[row_id];
                    }

                    if (Object.keys(OB_error_msg).length == 0) {
                        $('#message3').css('visibility', 'hidden');
                    } else {
                        error_msg = "";
                        for (const key in OB_error_msg) {
                            const value = OB_error_msg[key];
                            error_msg += value;
                        }
                        $('#message3').html(error_msg);
                    }

                    // alert(Object.keys(OB_error_msg).length);
                    if (Object.keys(totalhonor_error_msg).length == 0 && Object.keys(OB_error_msg).length == 0 && $('#message1').html() == "") {
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
        var tahun = thn;
        var mitra = mitra;
        var bulan_bayar = bln_byr;
        var action = 'get_alokasiOB';

        // alert(tahun + " " + mitra + " " + bulan_bayar);

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
                    if (!row.hasClass('bg-danger')) {
                        row.addClass('bg-danger');
                        row.css('--bs-bg-opacity', '.7');
                    }
                    row.addClass('OB-error');

                    $('#message3').removeClass('alert-primary');
                    $('#message3').addClass('alert-danger');


                    // $('#message3').html("<li>Mitra " + mitra + " sudah mengikuti kegiatan O-B pada bulan " + bulan_bayar + ". Tidak bisa mengikuti kegiatan lain.</li>");

                    bulan_bayar = convertMonth(bulan_bayar);

                    var row_id = row.attr("id");
                    OB_error_msg[row_id] = "<li>Mitra " + mitra + " sudah mengikuti kegiatan O-B pada bulan " + bulan_bayar + " sehingga <strong>tidak bisa</strong> mengikuti kegiatan lain.</li>";

                    // console.log(OB_error_msg);

                    error_msg = "";
                    for (const key in OB_error_msg) {
                        const value = OB_error_msg[key];
                        error_msg += value;
                    }
                    $('#message3').html(error_msg);


                    $('#message3').css('visibility', 'visible');
                    $('#submitmanual').prop("disabled", true);

                } else {
                    if (row.hasClass('OB-error')) {
                        row.removeClass('OB-error');
                    }

                    if (!row.hasClass('totalhonor-error')) {
                        row.removeClass('bg-danger');
                        row.css('--bs-bg-opacity', '1');
                    }

                    var row_id = row.attr("id");
                    if (OB_error_msg[row_id] != "") {
                        delete OB_error_msg[row_id];
                    }

                    if (Object.keys(OB_error_msg).length == 0) {
                        $('#message3').css('visibility', 'hidden');
                    } else {
                        error_msg = "";
                        for (const key in OB_error_msg) {
                            const value = OB_error_msg[key];
                            error_msg += value;
                        }
                        $('#message3').html(error_msg);
                    }

                    // alert(Object.keys(OB_error_msg).length);
                    if (Object.keys(totalhonor_error_msg).length == 0 && Object.keys(OB_error_msg).length == 0 && $('#message1').html() == "") {
                        $('#submitmanual').prop("disabled", false);
                    }
                }
            },
            error: function(xhr, thrownError) {
                alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function bebanKerjaChange(input_id, index) {
        // validasi volume beban kerja
        bebanKerjaValidate();
        // hitung honor berdasarkan beban kerja
        calculateHonor(input_id, index);

        var tahun = $('#tahun').val();
        var row = $("#row" + index);
        var mitra = $("#mitra" + index).val();
        var bulan_bayar = $("#bulanbayar" + index).val();
        var honorteralokasiinput = $("#honorteralokasi" + index);
        var honor = $("#honor" + index).val();

        // validasi total honor
        if (bulan_bayar != null) {
            validateHonor(tahun, mitra, bulan_bayar, honor, honorteralokasiinput, row);
        }

    }

    function mitraInputChange(input_id, index) {
        var tahun = $('#tahun').val();
        var row = $("#row" + index);
        var mitra = $("#" + input_id).val();
        var bulan_bayar = $("#bulanbayar" + index).val();
        var honorteralokasiinput = $("#honorteralokasi" + index);
        var honor = $("#honor" + index).val();

        if (bulan_bayar != null) {
            // validasi total honor
            validateHonor(tahun, mitra, bulan_bayar, honor, honorteralokasiinput, row);

            // validasi OB
            if ($('#storage_satuankegiatanid').html() == "3") {
                // case : mitra sudah mengikuti kegiatan lain, ingin diassign kegiatan OB
                getMitraKegiatan(tahun, mitra, bulan_bayar, row);
            } else {
                // case : mitra sudah mengikuti kegiatan OB, ingin diassign kegiatan lain
                validateOB(tahun, mitra, bulan_bayar, row);
            }
        }

    }

    function bulanBayarChange(input_id, index) {
        var tahun = $('#tahun').val();
        var row = $("#row" + index);
        var mitra = $("#mitra" + index).val();
        var bulan_bayar = $("#" + input_id).val();
        var honorteralokasiinput = $("#honorteralokasi" + index);
        var honor = $("#honor" + index).val();

        // validasi total honor
        validateHonor(tahun, mitra, bulan_bayar, honor, honorteralokasiinput, row);

        // validasi OB
        if ($('#storage_satuankegiatanid').html() == "3") {
            // case : mitra sudah mengikuti kegiatan lain, ingin diassign kegiatan OB
            getMitraKegiatan(tahun, mitra, bulan_bayar, row);
        } else {
            // case : mitra sudah mengikuti kegiatan OB, ingin diassign kegiatan lain
            validateOB(tahun, mitra, bulan_bayar, row);
        }
    }

    function removeButtonClick(btn_id) {
        var row = $("#" + btn_id).parent().parent();

        var row_id = row.attr("id");
        if (totalhonor_error_msg[row_id] != "") {
            delete totalhonor_error_msg[row_id];
        }

        if (OB_error_msg[row_id] != "") {
            delete OB_error_msg[row_id];
        }

        $(row).remove();

        if (Object.keys(totalhonor_error_msg).length == 0) {
            $('#message2').css('visibility', 'hidden');
        } else {
            error_msg = "";
            for (const key in totalhonor_error_msg) {
                const value = totalhonor_error_msg[key];
                error_msg += value;
            }
            $('#message2').html(error_msg);
        }

        if (Object.keys(OB_error_msg).length == 0) {
            $('#message3').css('visibility', 'hidden');
        } else {
            error_msg = "";
            for (const key in OB_error_msg) {
                const value = OB_error_msg[key];
                error_msg += value;
            }
            $('#message3').html(error_msg);
        }

    }


    $(document).ready(function() {
        // ALOKASI MANUAL
        $('#tahun').select2();
        $('#kegiatan').select2();
        $('.mitra-input').select2();

        alokasiManual();
        // dynamicInput();

        $('#kegiatan').change(function() {
            // getBulanBayar($('.bulan-bayar'));
            getBulanBayarOption();

            bulan_bayar_option = $('#storage_bulanbayaroption').html();
            $('.bulan-bayar').html(bulan_bayar_option);
            // alert('looping');

            $('#item-container-box').css('display', 'block');
            $('#submitmanual').css("display", "block");
            getInfoKegiatan();

            // validasi volume beban kerja
            bebanKerjaValidate();
        });

        var counter = 1;
        $('.add-item-btn').click(function(e) {
            // e.preventDefault();
            counter++;
            // console.log(counter);
            dynamicInput(counter);
        })


    });

    $(document).on('click', '.remove-item-btn', function(e) {
        e.preventDefault();
        let row_item = $(this).parent().parent();
        $(row_item).remove();
        bebanKerjaValidate();
    })
</script>

<!-- JS for Alokasi Excel -->
<script>
    function getInfoKegiatanExcel() {
        var kegiatan = $('#kegiatan_excel').val();
        var action = 'get_infokegiatan';

        if (kegiatan != '') {
            $.ajax({
                url: "<?= site_url('mitra/alokasiGetInfoKegiatan'); ?>",
                type: "POST",
                async: false,
                data: {
                    kegiatan_id: kegiatan,
                    action: action
                },
                dataType: "JSON",
                success: function(data) {
                    if (data['volume_belum_teralokasi'] == 0) {
                        $('#volume_keg_info').removeClass("alert-primary");
                        $('#volume_keg_info').addClass("alert-danger");
                        $('#volume_value').html(data['volume_belum_teralokasi'] + "/" + data['volume_total']);
                        $('#submitexcel').prop("disabled", true);
                    } else {
                        $('#volume_keg_info').removeClass("alert-danger");
                        $('#volume_keg_info').addClass("alert-primary");
                        $('#volume_value').html(data['volume_belum_teralokasi'] + "/" + data['volume_total']);
                        $('#submitexcel').prop("disabled", false);
                    }

                },
                error: function(xhr, thrownError) {
                    alert("Error" + xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

    }

    $(document).ready(function() {
        // UPLOAD EXCEL
        $('#tahun_excel').select2();
        $('#kegiatan_excel').select2();
        alokasiExcel();

        $('#kegiatan_excel').change(function() {
            $('#volume_keg_info').css('visibility', 'visible');
            getInfoKegiatanExcel();
        })
    });
</script>

<?= $this->endSection(); ?>