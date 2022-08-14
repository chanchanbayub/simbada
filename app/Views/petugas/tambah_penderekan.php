<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" href="/assets/signaturepad/jquery.signature.css">
<link rel="stylesheet" href="/assets/signaturepad/jquery.ui.css">

<style>
    .signature {
        width: 40%;
        margin: 0 auto;
    }
</style>

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary"> Form Tambah Penderekan</h6>
    </div>
    <div class="card-body">
        <form id="form_penderekan" autocomplete="off">
            <?= csrf_field(); ?>
            <div class=" form-group">
                <input type="hidden" class="form-control" id="bap_id" name="bap_id" value="<?= $noBap["id"] ?>">
            </div>
            <div class="form-group">
                <input type="hidden" class="form-control" id="ukpd_id" name="ukpd_id" value="<?= $noBap["ukpd_id"] ?>">
            </div>
            <div class="form-group">
                <label for="ukpd">UKPD :</label>
                <input type="text" class="form-control" id="ukpd" name="ukpd" value="<?= $noBap["ukpd"] ?>" disabled>
            </div>
            <div class="form-group">
                <label for="noBap">No BAPPK :</label>
                <input type="text" class="form-control" id="noBap" name="noBap" value="<?= $noBap["noBap"] ?>" disabled>
            </div>
            <div class="form-group">
                <label for="jenis_kendaraan_id">Jenis Kendaraan :</label>
                <select class="form-control" id="jenis_kendaraan_id" name="jenis_kendaraan_id" style="width:100% ;">
                    <option value="">--Silahkan Pilih--</option>
                    <?php foreach ($jenis_kendaraan as $jenis_kendaraan) : ?>
                        <option value="<?= $jenis_kendaraan["id"] ?>"><?= $jenis_kendaraan["jenis_kendaraan"] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback" id="error_jenis_kendaraan_id">
                </div>
            </div>
            <div class="form-group">
                <label for="klasifikasi_kendaraan_id">Klasifikasi Kendaraan :</label>
                <select class="form-control" id="klasifikasi_kendaraan_id" name="klasifikasi_kendaraan_id" style="width:100% ;" disabled>
                    <option value="">--Silahkan Pilih--</option>

                </select>
                <div id="error_klasifikasi_kendaraan_id" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="type_kendaraan_id">Type Kendaraan :</label>
                <select class="form-control" id="type_kendaraan_id" name="type_kendaraan_id" style="width:100% ;" disabled>
                    <option value="">--Silahkan Pilih--</option>
                </select>
                <div id="error_type_kendaraan_id" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="merk_kendaraan">Merk Kendaraan :</label>
                <input type="text" class="form-control" id="merk_kendaraan" name="merk_kendaraan">
                <div id="error_merk_kendaraan" class="invalid-feedback">
                </div>
            </div>
            <div class=" form-group">
                <label for="nomor_kendaraan">Nomor Kendaraan :</label>
                <input type="text" class="form-control" id="nomor_kendaraan" name="nomor_kendaraan">
                <div id="error_nomor_kendaraan" class="invalid-feedback">
                </div>
            </div>
            <div class=" form-group">
                <label for="warna_kendaraan">Warna Kendaraan :</label>
                <input type="text" class="form-control" id="warna_kendaraan" name="warna_kendaraan">
                <div id="error_warna_kendaraan" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="jenis_pelanggaran_id">Jenis Pelanggaran :</label>
                <select class="form-control" id="jenis_pelanggaran_id" name="jenis_pelanggaran_id" style="width:100% ;">
                    <option value="">--Silahkan Pilih--</option>
                    <?php foreach ($jenis_pelanggaran as $jenis_pelanggaran) : ?>
                        <option value="<?= $jenis_pelanggaran["id"] ?>"><?= $jenis_pelanggaran["keterangan"] ?></option>
                    <?php endforeach; ?>
                </select>
                <div id="error_jenis_pelanggaran_id" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="tanggal_penderekan">Tanggal Penderekan :</label>
                <input type="date" class="form-control" id="tanggal_penderekan" name="tanggal_penderekan">
                <div id="error_tanggal_penderekan" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="jam_penderekan">Jam Penderekan :</label>
                <input type="time" class="form-control" id="jam_penderekan" name="jam_penderekan">
                <div id="error_jam_penderekan" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="provinsi_id">Provinsi :</label>
                <select class="form-control" id="provinsi_id" name="provinsi_id" style="width:100% ;">
                    <option value="">--Silahkan Pilih--</option>
                    <?php foreach ($provinsi as $provinsi) : ?>
                        <option value="<?= $provinsi["id"] ?>"><?= $provinsi["provinsi"] ?></option>
                    <?php endforeach; ?>
                </select>
                <div id="error_provinsi_id" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="kota_id">Kota :</label>
                <select class="form-control" id="kota_id" name="kota_id" style="width:100% ;" disabled>
                    <option value="">--Silahkan Pilih--</option>
                </select>
                <div id="error_kota_id" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="kecamatan_id">Kecamatan :</label>
                <select class="form-control" id="kecamatan_id" name="kecamatan_id" style="width:100% ;" disabled>
                    <option value="">--Silahkan Pilih--</option>
                </select>
                <div id="error_kecamatan_id" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="kelurahan_id">Kelurahan :</label>
                <select class="form-control" id="kelurahan_id" name="kelurahan_id" style="width:100% ;" disabled>
                    <option value="">--Silahkan Pilih--</option>
                </select>
                <div id="error_kelurahan_id" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="nama_jalan">Lokasi Penderekan (Nama Jalan) :</label>
                <input type="text" class="form-control" id="nama_jalan" name="nama_jalan">
                <div id="error_nama_jalan" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="nama_gedung">Lokasi Penderekan (Nama Gedung) (opsional) :</label>
                <input type="text" class="form-control" id="nama_gedung" name="nama_gedung">
                <div id="error_nama_gedung" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="nomor_identitas_pengemudi">KTP / SIM / PASPOR Pengemudi :</label>
                <input type="text" class="form-control" id="nomor_identitas_pengemudi" name="nomor_identitas_pengemudi">
                <div id="error_nomor_identitas_pengemudi" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="nama_pengemudi">Nama Pengemudi :</label>
                <input type="text" class="form-control" id="nama_pengemudi" name="nama_pengemudi">
                <div id="error_nama_pengemudi" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="alamat_pengemudi">Alamat Pengemudi :</label>
                <input type="text" class="form-control" id="alamat_pengemudi" name="alamat_pengemudi">
                <div id="error_alamat_pengemudi" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="nomor_handphone_pengemudi">Nomor Handphone Pengemudi :</label>
                <input type="text" class="form-control" id="nomor_handphone_pengemudi" name="nomor_handphone_pengemudi">
                <div id="error_nomor_handphone_pengemudi" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="tempat_penyimpanan_kendaraan_id">Tempat Penyimpanan Kendaraan :</label>
                <select class="form-control" id="tempat_penyimpanan_kendaraan_id" name="tempat_penyimpanan_kendaraan_id" style="width:100% ;">
                    <option value="">--Silahkan Pilih--</option>
                    <?php foreach ($tempat_penyimpanan as $tempat_penyimpanan) : ?>
                        <option value="<?= $tempat_penyimpanan["id"] ?>"> <?= $tempat_penyimpanan["tempat_penyimpanan"] ?></option>
                    <?php endforeach; ?>
                </select>

                <div id="error_tempat_penyimpanan_id" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="foto">Foto Kendaraan :</label>
                <input type="file" class="form-control" id="foto" name="foto">
                <div id="error_foto" class="invalid-feedback">
                </div>
            </div>
            <div class="form-group">
                <label for="saksi_id">Saksi :</label>
                <select class="form-control" id="saksi_id" name="saksi_id" style="width:100% ;">
                    <option value="">--Silahkan Pilih--</option>
                    <?php foreach ($saksi as $saksi) : ?>
                        <option value="<?= $saksi["id"] ?>"> <?= $saksi["nama_saksi"] ?></option>
                    <?php endforeach; ?>
                </select>

                <div id="error_saksi_id" class="invalid-feedback">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</button>
                <button type="submit" class="btn btn-primary save"> <i class="fa fa-paper-plane"></i> Kirim</button>
            </div>
        </form>
    </div>
</div>


<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="syarat_dan_ketentuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Syarat Dan Ketentuan Kebijakan Privasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 style="text-align:center ;">Disclamer</h3>
                <hr>
                <p style="text-align: justify;">Simdalops tidak bertanggung jawab atas segala kesalahan data yang kendaraan diinputkan. Maka dengan ini saya menyatakan bahwa data kendaraan tersebut benar dan terbukti melakukan pelanggaran sesuai undang undang yang berlaku, dan apabila suatu saat nanti terdapat kekeliruan data, maka simdalops tidak bertanggung jawab terhadap kekeliruan data tersebut. </p>
                <hr>
                <h3 style="text-align:center ;">Kebijakan & Privasi</h3>
                <hr>
                <p style="text-align: justify;">Kami berkomitmen untuk menjaga keamanan dan kerahasiaan data pribadi yang diberikan Pengguna saat mengakses dan menggunakan Platform (“Data Pribadi”). Dalam hal ini, Data Pribadi diberikan oleh Pengguna secara sadar dan tanpa adanya tekanan atau paksaan dari pihak manapun, serta ikut bertanggung jawab penuh dalam menjaga kerahasiaan Data Pribadi tersebut. <br>
                    Simdalops dengan ini menyatakan bahwa Anda telah membaca dan memahami secara penuh konten dan sebab-akibat dari Kebijakan Privasi kami, dan Anda tidak dapat secara paksa mencabut kembali persetujuan Anda yang telah terikat dengan ketentuan-ketentuan dari Kebijakan Privasi kami.</p>
                <hr>
                <h3 style="text-align:center">Tanda Tangan Pelanggar / Pengemudi </h3>
                <hr>
                <form id="signaturPad">
                    <div class="signature">
                        <br>
                        <div id="canva"></div>
                        <div class="text-left">
                            <button id="clear" type="button" class="btn btn-outline-danger btn-xs"> <i class="fa fa-times"></i> Hapus </button>
                            <textarea id="signature64" name="ttd" style="display: none;"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak Setuju</button>
                <button type="submit" class="btn btn-primary" id="send">Setujui</button>
            </div>
            </form>
        </div>
    </div>
</div>


<script src="/assets/vendor/jquery/jquery.min.js"></script>
<script src="/assets/signaturepad/jquery.ui.min.js"></script>
<script src="/assets/signaturepad/jquery.signature.min.js"></script>
<script src="/assets/signaturepad/jquery.ui.touch-punch.min.js"></script>

<script>
    $(document).ready(function() {

        $('#dataTable').DataTable();

        $('#jenis_kendaraan_id').select2({
            theme: "bootstrap4",
        });

        $('#klasifikasi_kendaraan_id').select2({
            theme: "bootstrap4",
        });

        $('#type_kendaraan_id').select2({
            theme: "bootstrap4",
        });

        $('#jenis_pelanggaran_id').select2({
            theme: "bootstrap4",
        });

        $('#provinsi_id').select2({
            theme: "bootstrap4",
        });

        $('#kota_id').select2({
            theme: "bootstrap4",
        });

        $('#kecamatan_id').select2({
            theme: "bootstrap4",
        });

        $('#kelurahan_id').select2({
            theme: "bootstrap4",
        });

        $('#tempat_penyimpanan_kendaraan_id').select2({
            theme: "bootstrap4",
        });

        $('#petugas_id').select2({
            theme: "bootstrap4",
        });
    });

    // Signature Pad
    $('#widget').draggable();

    let signaturePad = $("#canva").signature({
        syncField: '#signature64',
        syncFormat: 'PNG',
        color: '#0000FF',
        // guideline: true
    });

    $('#clear').click(function() {
        signaturePad.signature('clear');
    });
    // End Signature Pad

    $("#jenis_kendaraan_id").change(function(e) {
        e.preventDefault();

        let id = $(this).val();

        $.ajax({
            url: '/petugas/penderekan/noBap/getKlasifikasi',
            type: 'get',
            data: {
                jenis_kendaraan_id: id
            },
            dataType: 'json',
            success: function(response) {
                let klasifikasi_kendaraan = "<option value=''> --Silahkan Pilih-- </option>";
                if (response.klasifikasi_kendaraan.length > 0) {
                    $("#klasifikasi_kendaraan_id").removeAttr('disabled', 'disabled');
                    response.klasifikasi_kendaraan.forEach(function(e) {
                        klasifikasi_kendaraan += `<option value='${e.id}'> ${e.klasifikasi_kendaraan} </option>`
                    });
                } else {
                    $("#klasifikasi_kendaraan_id").attr('disabled', 'disabled');
                    klasifikasi_kendaraan += "<option value=''> --Silahkan Pilih-- </option>";
                }
                $('#klasifikasi_kendaraan_id').html(klasifikasi_kendaraan);
            }
        });
    });

    $("#klasifikasi_kendaraan_id").change(function(e) {
        e.preventDefault();

        let id = $(this).val();

        $.ajax({
            url: '/petugas/penderekan/noBap/getTypeKendaraan',
            type: 'get',
            data: {
                klasifikasi_kendaraan_id: id
            },
            dataType: 'json',
            success: function(response) {
                let type_kendaraan = "<option value=''> --Silahkan Pilih-- </option>";
                if (response.type_kendaraan.length > 0) {
                    $("#type_kendaraan_id").removeAttr('disabled', 'disabled');
                    response.type_kendaraan.forEach(function(e) {
                        type_kendaraan += `<option value='${e.id}'> ${e.type_kendaraan} </option>`
                    });
                } else {
                    $("#type_kendaraan_id").attr('disabled', 'disabled');
                    type_kendaraan += "<option value=''> --Silahkan Pilih-- </option>";
                }
                $('#type_kendaraan_id').html(type_kendaraan);
            }
        });
    })

    $("#provinsi_id").change(function(e) {
        e.preventDefault();

        let id = $(this).val();

        $.ajax({
            url: '/petugas/penderekan/noBap/getKota',
            type: 'get',
            data: {
                provinsi_id: id
            },
            dataType: 'json',
            success: function(response) {
                let kota = "<option value=''> --Silahkan Pilih-- </option>";
                if (response.kota.length > 0) {
                    $("#kota_id").removeAttr('disabled', 'disabled');
                    response.kota.forEach(function(e) {
                        kota += `<option value='${e.id}'> ${e.kabupaten_kota} </option>`
                    });
                } else {
                    $("#kota_id").attr('disabled', 'disabled');
                    kota += "<option value=''> --Silahkan Pilih-- </option>";
                }
                $('#kota_id').html(kota);
            }
        });
    })

    $("#kota_id").change(function(e) {
        e.preventDefault();

        let id = $(this).val();

        $.ajax({
            url: '/petugas/penderekan/noBap/getKecamatan',
            type: 'get',
            data: {
                kota_id: id
            },
            dataType: 'json',
            success: function(response) {
                let kecamatan = "<option value=''> --Silahkan Pilih-- </option>";
                if (response.kecamatan.length > 0) {
                    $("#kecamatan_id").removeAttr('disabled', 'disabled');
                    response.kecamatan.forEach(function(e) {
                        kecamatan += `<option value='${e.id}'> ${e.kecamatan} </option>`
                    });
                } else {
                    $("#kecamatan_id").attr('disabled', 'disabled');
                    kecamatan += "<option value=''> --Silahkan Pilih-- </option>";
                }
                $('#kecamatan_id').html(kecamatan);
            }
        });
    })

    $("#kecamatan_id").change(function(e) {
        e.preventDefault();

        let id = $(this).val();

        $.ajax({
            url: '/petugas/penderekan/noBap/getKelurahan',
            type: 'get',
            data: {
                kecamatan_id: id
            },
            dataType: 'json',
            success: function(response) {
                let kelurahan = "<option value=''> --Silahkan Pilih-- </option>";
                if (response.kelurahan.length > 0) {
                    $("#kelurahan_id").removeAttr('disabled', 'disabled');
                    response.kelurahan.forEach(function(e) {
                        kelurahan += `<option value='${e.id}'> ${e.kelurahan} </option>`
                    });
                } else {
                    $("#kelurahan_id").attr('disabled', 'disabled');
                    kelurahan += "<option value=''> --Silahkan Pilih-- </option>";
                }
                $('#kelurahan_id').html(kelurahan);
            }
        });
    });

    $("#petugas_id").change(function(e) {
        let id = $(this).val();
        console.log(id);
    })

    // Form Penderekan
    $("#form_penderekan").submit(function(e) {
        e.preventDefault();

        let ukpd_id = $('#ukpd_id').val();
        let bap_id = $('#bap_id').val();
        let jenis_kendaraan_id = $('#jenis_kendaraan_id').val();
        let klasifikasi_kendaraan_id = $('#klasifikasi_kendaraan_id').val();
        let type_kendaraan_id = $('#type_kendaraan_id').val();
        let merk_kendaraan = $('#merk_kendaraan').val();
        let nomor_kendaraan = $('#nomor_kendaraan').val();
        let warna_kendaraan = $('#warna_kendaraan').val();
        let jenis_pelanggaran_id = $('#jenis_pelanggaran_id').val();
        let tanggal_penderekan = $('#tanggal_penderekan').val();
        let jam_penderekan = $('#jam_penderekan').val();
        let provinsi_id = $('#provinsi_id').val();
        let kota_id = $('#kota_id').val();
        let kecamatan_id = $('#kecamatan_id').val();
        let kelurahan_id = $('#kelurahan_id').val();
        let nama_jalan = $('#nama_jalan').val();
        let nama_gedung = $('#nama_gedung').val();
        let nomor_identitas_pengemudi = $('#nomor_identitas_pengemudi').val();
        let nama_pengemudi = $('#nama_pengemudi').val();
        let alamat_pengemudi = $('#alamat_pengemudi').val();
        let nomor_handphone_pengemudi = $('#nomor_handphone_pengemudi').val();
        let tempat_penyimpanan_kendaraan_id = $('#tempat_penyimpanan_kendaraan_id').val();
        let foto = $('#foto').val();
        let saksi_id = $('#saksi_id').val()

        let formData = new FormData(this);

        formData.append('ukpd_id', ukpd_id);
        formData.append('bap_id', bap_id);
        formData.append('jenis_kendaraan_id', jenis_kendaraan_id);
        formData.append('klasifikasi_kendaraan_id', klasifikasi_kendaraan_id);
        formData.append('type_kendaraan_id', type_kendaraan_id);
        formData.append('merk_kendaraan', merk_kendaraan);
        formData.append('nomor_kendaraan', nomor_kendaraan);
        formData.append('warna_kendaraan', warna_kendaraan);
        formData.append('jenis_pelanggaran_id', jenis_pelanggaran_id);
        formData.append('tanggal_penderekan', tanggal_penderekan);
        formData.append('jam_penderekan', jam_penderekan);
        formData.append('provinsi_id', provinsi_id);
        formData.append('kota_id', kota_id);
        formData.append('kecamatan_id', kecamatan_id);
        formData.append('kelurahan_id', kelurahan_id);
        formData.append('nama_jalan', nama_jalan);
        formData.append('nama_gedung', nama_gedung);
        formData.append('nomor_identitas_pengemudi', nomor_identitas_pengemudi);
        formData.append('nama_pengemudi', nama_pengemudi);
        formData.append('alamat_pengemudi', alamat_pengemudi);
        formData.append('nomor_handphone_pengemudi', nomor_handphone_pengemudi);
        formData.append('tempat_penyimpanan_kendaraan_id', tempat_penyimpanan_kendaraan_id);
        formData.append('foto', foto);
        formData.append('saksi_id', saksi_id);

        $("#syarat_dan_ketentuan").modal('show');


        $("#syarat_dan_ketentuan").on('submit', '#signaturPad', function(e) {
            e.preventDefault();
            let signature = $("#signature64").val();
            formData.append('ttd_digital', signature);
            sendData(formData);
        });
    });



    function sendData(formData) {
        $("#syarat_dan_ketentuan").modal('hide');
        $.ajax({
            url: '/petugas/penderekan/insert',
            data: formData,
            dataType: 'json',
            enctype: 'multipart/form-data',
            type: 'POST',
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $(".save").html('<i class="fas fa-cog fa-spin"></i>');
                $(".save").attr('disabled', 'disabled');
            },
            success: function(response) {
                $(".save").html('<i class="fa fa-paper-plane">Kirim</i>');
                $(".save").removeAttr('disabled', 'disabled');
                if (response.error) {
                    if (response.error.jenis_kendaraan_id) {
                        $("#jenis_kendaraan_id").addClass('is-invalid');
                        $("#error_jenis_kendaraan_id").html(response.error.jenis_kendaraan_id);
                    } else {
                        $("#jenis_kendaraan_id").removeClass('is-invalid');
                        $("#error_jenis_kendaraan_id").html('');
                    }
                    if (response.error.klasifikasi_kendaraan_id) {
                        $("#klasifikasi_kendaraan_id").addClass('is-invalid');
                        $("#error_klasifikasi_kendaraan_id").html(response.error.klasifikasi_kendaraan_id);
                    } else {
                        $("#klasifikasi_kendaraan_id").removeClass('is-invalid');
                        $("#error_klasifikasi_kendaraan_id").html('');
                    }
                    if (response.error.type_kendaraan_id) {
                        $("#type_kendaraan_id").addClass('is-invalid');
                        $("#error_type_kendaraan_id").html(response.error.type_kendaraan_id);
                    } else {
                        $("#type_kendaraan_id").removeClass('is-invalid');
                        $("#error_type_kendaraan_id").html('');
                    }
                    if (response.error.merk_kendaraan) {
                        $("#merk_kendaraan").addClass('is-invalid');
                        $("#error_merk_kendaraan").html(response.error.merk_kendaraan);
                    } else {
                        $("#merk_kendaraan").removeClass('is-invalid');
                        $("#error_merk_kendaraan").html('');
                    }
                    if (response.error.nomor_kendaraan) {
                        $("#nomor_kendaraan").addClass('is-invalid');
                        $("#error_nomor_kendaraan").html(response.error.nomor_kendaraan);
                    } else {
                        $("#nomor_kendaraan").removeClass('is-invalid');
                        $("#error_nomor_kendaraan").html('');
                    }
                    if (response.error.jenis_pelanggaran_id) {
                        $("#jenis_pelanggaran_id").addClass('is-invalid');
                        $("#error_jenis_pelanggaran_id").html(response.error.jenis_pelanggaran_id);
                    } else {
                        $("#jenis_pelanggaran_id").removeClass('is-invalid');
                        $("#error_jenis_pelanggaran_id").html('');
                    }
                    if (response.error.tanggal_penderekan) {
                        $("#tanggal_penderekan").addClass('is-invalid');
                        $("#error_tanggal_penderekan").html(response.error.tanggal_penderekan);
                    } else {
                        $("#tanggal_penderekan").removeClass('is-invalid');
                        $("#error_tanggal_penderekan").html('');
                    }
                    if (response.error.jam_penderekan) {
                        $("#jam_penderekan").addClass('is-invalid');
                        $("#error_jam_penderekan").html(response.error.jam_penderekan);
                    } else {
                        $("#jam_penderekan").removeClass('is-invalid');
                        $("#error_jam_penderekan").html('');
                    }
                    if (response.error.provinsi_id) {
                        $("#provinsi_id").addClass('is-invalid');
                        $("#error_provinsi_id").html(response.error.provinsi_id);
                    } else {
                        $("#provinsi_id").removeClass('is-invalid');
                        $("#error_provinsi_id").html('');
                    }
                    if (response.error.kota_id) {
                        $("#kota_id").addClass('is-invalid');
                        $("#error_kota_id").html(response.error.kota_id);
                    } else {
                        $("#kota_id").removeClass('is-invalid');
                        $("#error_kota_id").html('');
                    }
                    if (response.error.kecamatan_id) {
                        $("#kecamatan_id").addClass('is-invalid');
                        $("#error_kecamatan_id").html(response.error.kecamatan_id);
                    } else {
                        $("#kecamatan_id").removeClass('is-invalid');
                        $("#error_kecamatan_id").html('');
                    }
                    if (response.error.kelurahan_id) {
                        $("#kelurahan_id").addClass('is-invalid');
                        $("#error_kelurahan_id").html(response.error.kelurahan_id);
                    } else {
                        $("#kelurahan_id").removeClass('is-invalid');
                        $("#error_kelurahan_id").html('');
                    }
                    if (response.error.nama_jalan) {
                        $("#nama_jalan").addClass('is-invalid');
                        $("#error_nama_jalan").html(response.error.nama_jalan);
                    } else {
                        $("#nama_jalan").removeClass('is-invalid');
                        $("#error_nama_jalan").html('');
                    }
                    if (response.error.nomor_identitas_pengemudi) {
                        $("#nomor_identitas_pengemudi").addClass('is-invalid');
                        $("#error_nomor_identitas_pengemudi").html(response.error.nomor_identitas_pengemudi);
                    } else {
                        $("#nomor_identitas_pengemudi").removeClass('is-invalid');
                        $("#error_nomor_identitas_pengemudi").html('');
                    }
                    if (response.error.nama_pengemudi) {
                        $("#nama_pengemudi").addClass('is-invalid');
                        $("#error_nama_pengemudi").html(response.error.nama_pengemudi);
                    } else {
                        $("#nama_pengemudi").removeClass('is-invalid');
                        $("#error_nama_pengemudi").html('');
                    }
                    if (response.error.alamat_pengemudi) {
                        $("#alamat_pengemudi").addClass('is-invalid');
                        $("#error_alamat_pengemudi").html(response.error.alamat_pengemudi);
                    } else {
                        $("#alamat_pengemudi").removeClass('is-invalid');
                        $("#error_alamat_pengemudi").html('');
                    }
                    if (response.error.nomor_handphone_pengemudi) {
                        $("#nomor_handphone_pengemudi").addClass('is-invalid');
                        $("#error_nomor_handphone_pengemudi").html(response.error.nomor_handphone_pengemudi);
                    } else {
                        $("#nomor_handphone_pengemudi").removeClass('is-invalid');
                        $("#error_nomor_handphone_pengemudi").html('');
                    }
                    if (response.error.tempat_penyimpanan_kendaraan_id) {
                        $("#tempat_penyimpanan_kendaraan_id").addClass('is-invalid');
                        $("#error_tempat_penyimpanan_id").html(response.error.tempat_penyimpanan_kendaraan_id);
                    } else {
                        $("#tempat_penyimpanan_kendaraan_id").removeClass('is-invalid');
                        $("#error_tempat_penyimpanan_id").html('');
                    }
                    if (response.error.foto) {
                        $("#foto").addClass('is-invalid');
                        $("#error_foto").html(response.error.foto);
                    } else {
                        $("#foto").removeClass('is-invalid');
                        $("#error_foto").html('');
                    }
                    if (response.error.saksi_id) {
                        $("#saksi_id").addClass('is-invalid');
                        $("#error_saksi_id").html(response.error.saksi_id);
                    } else {
                        $("#saksi_id").removeClass('is-invalid');
                        $("#error_saksi_id").html('');
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`
                    });
                    setTimeout(function() {
                        document.location.href = '/petugas/bap';
                    }, 1500);
                }
            },
            error: function() {
                $(".save").html('<i class="fa fa-paper-plane">Kirim</i>');
                $(".save").removeAttr('disabled', 'disabled');
                alert('Data Belum Tersimpan!');
            }
        });
    }
</script>
<?= $this->endSection(); ?>