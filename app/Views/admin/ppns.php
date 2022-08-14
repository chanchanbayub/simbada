<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="/assets/signaturepad/jquery.signature.css">
<link rel="stylesheet" href="/assets/signaturepad/jquery.ui.css">
<style>
    .signature {
        width: 80%;
        margin: 0 auto;
    }
</style>

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Master Data PPNS</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#tambah_ppns"> <i class="fa fa-plus"> </i> Tambah PPNS</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>UKPD</th>
                        <th>Nama PPNS</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Pangkat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($ppns as $ppns) : ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $ppns["ukpd"] ?></td>
                            <td><?= $ppns["nama_ppns"] ?></td>
                            <td><?= $ppns["nip"] ?></td>
                            <td><?= $ppns["jabatan"] ?></td>
                            <td><?= $ppns["pangkat"] ?></td>
                            <td>
                                <button class="btn btn-circle btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus" data-id="<?= $ppns["id"] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-circle btn-sm btn-warning edit" data-toggle="modal" data-target="#modalEdit" data-id="<?= $ppns["id"] ?>">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="tambah_ppns" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah PPNS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_penyidik" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class=" form-group">
                        <label for="ukpd_id" class="col-form-label">UKPD :</label>
                        <select name="ukpd_id" id="ukpd_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($ukpd as $ukpd) : ?>
                                <option value="<?= $ukpd["id"] ?>"><?= $ukpd["ukpd"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="error-ukpd">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_ppns" class="col-form-label">Nama PPNS :</label>
                        <input class="form-control" id="nama_ppns" name="nama_ppns" type="text"></input>
                        <div class="invalid-feedback" id="error-nama">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nip" class="col-form-label">NIP :</label>
                        <input class="form-control" id="nip" name="nip" type="number"></input>
                        <div class="invalid-feedback" id="error-nip">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jabatan" class="col-form-label">Jabatan :</label>
                        <input class="form-control" id="jabatan" name="jabatan" type="text"></input>
                        <div class="invalid-feedback" id="error-jabatan">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pangkat" class="col-form-label">Pangkat :</label>
                        <input class="form-control" id="pangkat" name="pangkat" type="text"></input>
                        <div class="invalid-feedback" id="error-pangkat">

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary save"> <i class="fa fa-paper-plane"></i> Kirim</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Modal Hapus-->
<div class="modal fade" id="modalHapus" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" id="id_hapus">
                </form>
                <p>Apakah Anda Yakin ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="delete">Hapus Data</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Update -->
<div class="modal fade" id="modalEdit" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit PPNS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_ppns">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="hidden" id="id" name="id" class="form-control">
                        <label for="ukpd_id_edit" class="col-form-label">UKPD :</label>
                        <select name="ukpd_id" id="ukpd_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback" id="error-ukpd-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_ppns_edit" class="col-form-label">Nama PPNS :</label>
                        <input class="form-control" id="nama_ppns_edit" name="nama_ppns" type="text"></input>
                        <div class="invalid-feedback" id="error-nama-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nip_edt" class="col-form-label">NIP :</label>
                        <input class="form-control" id="nip_edit" name="nip" type="number"></input>
                        <div class="invalid-feedback" id="error-nip-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jabatan_edit" class="col-form-label">Jabatan :</label>
                        <input class="form-control" id="jabatan_edit" name="jabatan" type="text"></input>
                        <div class="invalid-feedback" id="error-jabatan-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pangkat_edit" class="col-form-label">Pangkat :</label>
                        <input class="form-control" id="pangkat_edit" name="pangkat" type="text"></input>
                        <div class="invalid-feedback" id="error-pangkat-edit">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary update"> <i class="fa fa-paper-plane"></i> Kirim</button>
                    </div>
                </form>
            </div>

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

        $('#ukpd_id').select2({
            theme: "bootstrap4",
        });

        $('#ukpd_id_edit').select2({
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

    $("#tambah_penyidik").submit(function(e) {
        e.preventDefault();

        let ukpd_id = $("#ukpd_id").val();
        let nama_ppns = $("#nama_ppns").val();
        let nip = $("#nip").val();
        let jabatan = $("#jabatan").val();
        let pangkat = $("#pangkat").val();

        $.ajax({
            url: 'ppns/insert',
            method: 'post',
            dataType: 'json',
            data: {
                ukpd_id: ukpd_id,
                nama_ppns: nama_ppns,
                nip: nip,
                jabatan: jabatan,
                pangkat: pangkat,
            },
            beforeSend: function() {
                $(".save").html('<i class="fa fa-spinner"> </i>')
            },
            success: function(response) {
                $(".save").html('<i class="fa fa-paper-plane"></i> Kirim')
                if (response.error) {
                    if (response.error.ukpd_id) {
                        $("#ukpd_id").addClass('is-invalid');
                        $("#error-ukpd").html(response.error.ukpd_id);
                    } else {
                        $("#ukpd_id").removeClass('is-invalid');
                        $("#error-ukpd").html('');
                    }
                    if (response.error.nama_ppns) {
                        $("#nama_ppns").addClass('is-invalid');
                        $("#error-nama").html(response.error.nama_ppns);
                    } else {
                        $("#nama_ppns").removeClass('is-invalid');
                        $("#error-nama").html('');
                    }
                    if (response.error.nip) {
                        $("#nip").addClass('is-invalid');
                        $("#error-nip").html(response.error.nip);
                    } else {
                        $("#nip").removeClass('is-invalid');
                        $("#error-nip").html('');
                    }
                    if (response.error.jabatan) {
                        $("#jabatan").addClass('is-invalid');
                        $("#error-jabatan").html(response.error.jabatan);
                    } else {
                        $("#jabatan").removeClass('is-invalid');
                        $("#error-jabatan").html('');
                    }
                    if (response.error.pangkat) {
                        $("#pangkat").addClass('is-invalid');
                        $("#error-pangkat").html(response.error.pangkat);
                    } else {
                        $("#pangkat").removeClass('is-invalid');
                        $("#error-pangkat").html('');
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`,
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1000)
                }
            }
        });
    })

    $(".hapus").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        // console.log(id);
        $.ajax({

            url: 'ppns/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $("#id_hapus").val(response.ppns.id);
            }
        });
    });

    $("#delete").click(function(e) {
        e.preventDefault();
        let id = $("#id_hapus").val();
        // console.log(id);
        $.ajax({

            url: 'ppns/hapus',
            method: 'post',
            dataType: 'json',
            data: {
                id: id
            },
            beforeSend: function() {
                $("#delete").html('<i class="fa fa-spinner fa-spin"> </i>')
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`,
                });
                setTimeout(function() {
                    location.reload();
                }, 1000)
            }
        });
    });

    $(".edit").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        // console.log(id);
        $.ajax({

            url: 'ppns/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {

                let ukpd = '<option value =""> -- Silahkan Pilih -- </option>';

                response.ukpd.forEach(function(e) {
                    ukpd += `<option value ="${e.id}"> ${e.ukpd} </option>`
                });

                $("#ukpd_id_edit").html(ukpd);

                $("#id").val(response.ppns.id);
                $("#ukpd_id_edit").val(response.ppns.ukpd_id).trigger('change');
                $("#nama_ppns_edit").val(response.ppns.nama_ppns);
                $("#nip_edit").val(response.ppns.nip);
                $("#jabatan_edit").val(response.ppns.jabatan);
                $("#pangkat_edit").val(response.ppns.pangkat);
            }
        });
    });

    $("#edit_ppns").submit(function(e) {

        e.preventDefault();

        let id = $("#id").val();
        let ukpd_id = $("#ukpd_id_edit").val();
        let nama_ppns = $("#nama_ppns_edit").val();
        let nip = $("#nip_edit").val();
        let jabatan = $("#jabatan_edit").val();
        let pangkat = $("#pangkat_edit").val();

        $.ajax({
            url: 'ppns/update',
            method: 'post',
            dataType: 'json',
            data: {
                id: id,
                ukpd_id: ukpd_id,
                nama_ppns: nama_ppns,
                nip: nip,
                jabatan: jabatan,
                pangkat: pangkat,
            },
            beforeSend: function() {
                $(".update").html('<i class="fa fa-spinner"> </i>')
            },
            success: function(response) {
                $(".update").html('<i class="fa fa-paper-plane"></i> Kirim')
                if (response.error) {
                    if (response.error.ukpd_id) {
                        $("#ukpd_id_edit").addClass('is-invalid');
                        $("#error-ukpd-edit").html(response.error.ukpd_id);
                    } else {
                        $("#ukpd_id_edit").removeClass('is-invalid');
                        $("#error-ukpd-edit").html('');
                    }
                    if (response.error.nama_ppns) {
                        $("#nama_ppns_edit").addClass('is-invalid');
                        $("#error-nama-edit").html(response.error.nama_ppns);
                    } else {
                        $("#nama_ppns_edit").removeClass('is-invalid');
                        $("#error-nama-edit").html('');
                    }
                    if (response.error.nip) {
                        $("#nip_edit").addClass('is-invalid');
                        $("#error-nip-edit").html(response.error.nip);
                    } else {
                        $("#nip_edit").removeClass('is-invalid');
                        $("#error-nip-edit").html('');
                    }
                    if (response.error.jabatan) {
                        $("#jabatan_edit").addClass('is-invalid');
                        $("#error-jabatan-edit").html(response.error.jabatan);
                    } else {
                        $("#jabatan_edit").removeClass('is-invalid');
                        $("#error-jabatan-edit").html('');
                    }
                    if (response.error.pangkat) {
                        $("#pangkat_edit").addClass('is-invalid');
                        $("#error-pangkat-edit").html(response.error.pangkat);
                    } else {
                        $("#pangkat_edit").removeClass('is-invalid');
                        $("#error-pangkat-edit").html('');
                    }
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`,
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1000)
                }
            }
        });
    })
</script>
<?= $this->endSection(); ?>