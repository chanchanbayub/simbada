<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> -->

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Master Data Saksi Penderekan</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#tambah_saksi"> <i class="fa fa-plus"> </i> Tambah Saksi</button>
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
                        <th>Nama Saksi</th>
                        <th>NIP / NPJLP</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($saksi_penderekan as $saksi_penderekan) : ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $saksi_penderekan["ukpd"] ?></td>
                            <td><?= $saksi_penderekan["nama_saksi"] ?></td>
                            <td><?= $saksi_penderekan["nip_saksi"] ?></td>
                            <td><?= $saksi_penderekan["jabatan"] ?></td>
                            <td>
                                <button class="btn btn-circle btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus" data-id="<?= $saksi_penderekan["id"] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-circle btn-sm btn-warning edit" data-toggle="modal" data-target="#modalEdit" data-id="<?= $saksi_penderekan["id"] ?>">
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

<div class="modal fade" id="tambah_saksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Saksi Penderekan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_saksi" autocomplete="off">
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
                        <label for="nama_saksi" class="col-form-label">Nama Saksi :</label>
                        <input type="text" class="form-control" id="nama_saksi" name="nama_saksi">
                        <div class="invalid-feedback" id="error-nama">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nip_saksi" class="col-form-label">NIP / NPJLP Saksi :</label>
                        <input type="text" class="form-control" id="nip_saksi" name="nip_saksi">
                        <div class="invalid-feedback" id="error-nip">

                        </div>
                    </div>
                    <div class=" form-group">
                        <label for="jabatan_id" class="col-form-label">Jabatan :</label>
                        <select name="jabatan_id" id="jabatan_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($jabatan as $jabatan) : ?>
                                <option value="<?= $jabatan["id"] ?>"><?= $jabatan["jabatan"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="error-jabatan">

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
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Role Management</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_saksi">
                    <?= csrf_field(); ?>
                    <div class=" form-group">
                        <input type="hidden" id="id" name="id">
                        <label for="ukpd_id_edit" class="col-form-label">UKPD :</label>
                        <select name="ukpd_id" id="ukpd_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback" id="error-ukpd-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_saksi_edit" class="col-form-label">Nama Saksi :</label>
                        <input type="text" class="form-control" id="nama_saksi_edit" name="nama_saksi">
                        <div class="invalid-feedback" id="error-nama-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nip_saksi" class="col-form-label">NIP / NPJLP Saksi :</label>
                        <input type="text" class="form-control" id="nip_saksi_edit" name="nip_saksi">
                        <div class="invalid-feedback" id="error-nip-edit">

                        </div>
                    </div>
                    <div class=" form-group">
                        <label for="jabatan_id_edit" class="col-form-label">Jabatan :</label>
                        <select name="jabatan_id" id="jabatan_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback" id="error-jabatan-edit">

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
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();

        $("#ukpd_id").select2({
            theme: 'bootstrap4'
        });

        $("#jabatan_id").select2({
            theme: 'bootstrap4'
        });

        $("#ukpd_id_edit").select2({
            theme: 'bootstrap4'
        });

        $("#jabatan_id_edit").select2({
            theme: 'bootstrap4'
        });
    });

    $("#tambah_saksi").submit(function(e) {
        e.preventDefault();
        let ukpd_id = $("#ukpd_id").val();
        let nama_saksi = $("#nama_saksi").val();
        let nip_saksi = $("#nip_saksi").val();
        let jabatan_id = $("#jabatan_id").val();
        $.ajax({
            url: 'saksi_penderekan/insert',
            method: 'post',
            dataType: 'json',
            data: {
                ukpd_id: ukpd_id,
                nama_saksi: nama_saksi,
                nip_saksi: nip_saksi,
                jabatan_id: jabatan_id,
            },
            beforeSend: function() {
                $(".save").html('<i class="fa fa-spinner"> </i>');
                $(".save").attr('disabled', 'disabled');
            },
            success: function(response) {
                $(".save").html('<i class="fa fa-paper-plane"></i> Kirim')
                $(".save").removeAttr('disabled', 'disabled')
                if (response.error) {
                    if (response.error.ukpd_id) {
                        $("#ukpd_id").addClass('is-invalid');
                        $("#error-ukpd").html(response.error.ukpd_id);
                    } else {
                        $("#ukpd_id").addClass('is-invalid');
                        $("#error-ukpd").html('');
                    }
                    if (response.error.nama_saksi) {
                        $("#nama_saksi").addClass('is-invalid');
                        $("#error-nama").html(response.error.nama_saksi);
                    } else {
                        $("#nama_saksi").addClass('is-invalid');
                        $("#error-nama").html('');
                    }
                    if (response.error.nip_saksi) {
                        $("#nip_saksi").addClass('is-invalid');
                        $("#error-nip").html(response.error.nip_saksi);
                    } else {
                        $("#nip_saksi").addClass('is-invalid');
                        $("#error-nip").html('');
                    }
                    if (response.error.jabatan_id) {
                        $("#jabatan_id").addClass('is-invalid');
                        $("#error-jabatan").html(response.error.jabatan_id);
                    } else {
                        $("#jabatan_id").addClass('is-invalid');
                        $("#error-jabatan").html('');
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
            },
            error: function() {
                $(".save").html('<i class="fa fa-paper-plane"></i> Kirim')
                $(".save").removeAttr('disabled', 'disabled')
                alert('Data Tidak Terkirim !');
            }
        });
    })

    $(".hapus").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        // console.log(id);
        $.ajax({

            url: 'saksi_penderekan/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $("#id_hapus").val(response.saksi_penderekan.id);
            }
        });
    });

    $("#delete").click(function(e) {
        e.preventDefault();
        let id = $("#id_hapus").val();
        // console.log(id);
        $.ajax({

            url: 'saksi_penderekan/hapus',
            method: 'post',
            dataType: 'json',
            data: {
                id: id
            },
            beforeSend: function() {
                $("#delete").html('<i class="fa fa-spinner fa-spin"> </i>');
                $("#delete").attr('disabled', 'disabled');
            },
            success: function(response) {
                $("#delete").html('<i class="fa fa-paper-plane"></i> Kirim');
                $("#delete").removeAttr('disabled', 'disabled');
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

            url: 'saksi_penderekan/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $("#id").val(response.saksi_penderekan.id);

                let ukpd_id = '<option value="">--Silahkan Pilih--</option>';

                response.ukpd.forEach(function(e) {
                    if (response.saksi_penderekan.ukpd_id == e.id) {
                        ukpd_id += `<option value="${e.id}" selected> ${e.ukpd} </option>`;
                    } else {
                        ukpd_id += `<option value="${e.id}"> ${e.ukpd} </option>`;
                    }
                    $("#ukpd_id_edit").html(ukpd_id);
                });

                let jabatan_id = '<option value="">--Silahkan Pilih--</option>';

                response.jabatan.forEach(function(e) {
                    if (response.saksi_penderekan.jabatan_id == e.id) {
                        jabatan_id += `<option value="${e.id}" selected> ${e.jabatan} </option>`;
                    } else {
                        jabatan_id += `<option value="${e.id}"> ${e.jabatan} </option>`;
                    }
                    $("#jabatan_id_edit").html(jabatan_id);
                });

                $("#nama_saksi_edit").val(response.saksi_penderekan.nama_saksi);
                $("#nip_saksi_edit").val(response.saksi_penderekan.nip_saksi);
            }
        });
    });

    $("#edit_saksi").submit(function(e) {
        e.preventDefault();
        let id = $("#id").val();
        let ukpd_id = $("#ukpd_id_edit").val();
        let nama_saksi = $("#nama_saksi_edit").val();
        let nip_saksi = $("#nip_saksi_edit").val();
        let jabatan_id = $("#jabatan_id_edit").val();

        $.ajax({
            url: 'saksi_penderekan/update',
            method: 'post',
            dataType: 'json',
            data: {
                id: id,
                ukpd_id: ukpd_id,
                nama_saksi: nama_saksi,
                nip_saksi: nip_saksi,
                jabatan_id: jabatan_id,
            },
            beforeSend: function() {
                $(".update").html('<i class="fa fa-spinner"> </i>');
                $(".update").attr('disabled', 'disabled');
            },
            success: function(response) {
                $(".update").html('<i class="fa fa-paper-plane"></i> Kirim')
                $(".update").removeAttr('disabled', 'disabled')
                if (response.error) {
                    if (response.error.ukpd_id) {
                        $("#ukpd_id_edit").addClass('is-invalid');
                        $("#error-ukpd-edit").html(response.error.ukpd_id);
                    } else {
                        $("#ukpd_id_edit").addClass('is-invalid');
                        $("#error-ukpd-edit").html('');
                    }
                    if (response.error.nama_saksi) {
                        $("#nama_saksi_edit").addClass('is-invalid');
                        $("#error-nama-edit").html(response.error.nama_saksi);
                    } else {
                        $("#nama_saksi_edit").addClass('is-invalid');
                        $("#error-nama-edit").html('');
                    }
                    if (response.error.nip_saksi) {
                        $("#nip_saksi_edit").addClass('is-invalid');
                        $("#error-nip-edit").html(response.error.nip_saksi);
                    } else {
                        $("#nip_saksi_edit").addClass('is-invalid');
                        $("#error-nip-edit").html('');
                    }
                    if (response.error.jabatan_id) {
                        $("#jabatan_id_edit").addClass('is-invalid');
                        $("#error-jabatan-edit").html(response.error.jabatan_id);
                    } else {
                        $("#jabatan_id_edit").addClass('is-invalid');
                        $("#error-jabatan-edit").html('');
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
            },
            error: function() {
                $(".save").html('<i class="fa fa-paper-plane"></i> Kirim')
                $(".save").removeAttr('disabled', 'disabled')
                alert('Data Tidak Terkirim !');
            }
        });
    })
</script>
<?= $this->endSection(); ?>