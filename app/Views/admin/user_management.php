<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> -->

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Master Data User Management</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#tambah_user"> <i class="fa fa-plus"> </i> Tambah User Management</button>
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
                        <th>Role Management</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($user_management as $user_management) : ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $user_management["ukpd"] ?></td>
                            <td><?= $user_management["role_management"] ?></td>
                            <td><?= $user_management["username"] ?></td>
                            <td><?= ($user_management["status"] == 0 ? 'Aktif' : 'NonAktif') ?></td>
                            <td>
                                <button class="btn btn-circle btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus" data-id="<?= $user_management["id"] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-circle btn-sm btn-warning edit" data-toggle="modal" data-target="#modalEdit" data-id="<?= $user_management["id"] ?>">
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

<div class="modal fade" id="tambah_user" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User Management</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_user_management">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="ukpd_id" class="col-form-label">UKPD :</label>
                        <select name="ukpd_id" id="ukpd_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($ukpd as $ukpd) : ?>
                                <option value="<?= $ukpd["id"] ?>"> <?= $ukpd["ukpd"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="error-ukpd">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role_id" class="col-form-label">Role Management :</label>
                        <select name="role_id" id="role_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($role_management as $role_management) : ?>
                                <option value="<?= $role_management["id"] ?>"> <?= $role_management["role_management"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="error-role">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-form-label">Username :</label>
                        <input type="text" class="form-control" id="username" name="username">
                        <div class="invalid-feedback" id="error-user">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-form-label">Password :</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="invalid-feedback" id="error-password">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Status :</label>
                        <select name="status" id="status" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="0">Aktif</option>
                            <option value="1">NonAktif</option>

                        </select>
                        <div class="invalid-feedback" id="error-status">

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
                <h5 class="modal-title" id="exampleModalLabel">Edit User Management</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_user_management">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                        <label for="ukpd_id_edit" class="col-form-label">UKPD :</label>
                        <select name="ukpd_id" id="ukpd_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                        </select>
                        <div class="invalid-feedback" id="error-ukpd-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role_id_edit" class="col-form-label">Role Management :</label>
                        <select name="role_id" id="role_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback" id="error-role-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username_edit" class="col-form-label">Username :</label>
                        <input type="text" class="form-control" id="username_edit" name="username">
                        <div class="invalid-feedback" id="error-user-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_edit" class="col-form-label">Password :</label>
                        <input type="password" class="form-control" id="password_edit" name="password">
                        <div class="invalid-feedback" id="error-password-edit">


                        </div>
                        <p style="font-size: 12px; color:red;">Kosongkan jika tidak mengganti password</p>
                    </div>
                    <div class="form-group">
                        <label for="status_edit" class="col-form-label">Status :</label>
                        <select name="status" id="status_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <option value="0">Aktif</option>
                            <option value="1">NonAktif</option>

                        </select>
                        <div class="invalid-feedback" id="error-status-edit">

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

        $('#ukpd_id').select2({
            theme: "bootstrap4",
        });

        $('#ukpd_id_edit').select2({
            theme: "bootstrap4",
        });

        $('#role_id').select2({
            theme: "bootstrap4",
        });

        $('#role_id_edit').select2({
            theme: "bootstrap4",
        });

        $('#status').select2({
            theme: "bootstrap4",
        });
        $('#status_edit').select2({
            theme: "bootstrap4",
        });
    });

    $("#tambah_user_management").submit(function(e) {
        e.preventDefault();

        let ukpd_id = $("#ukpd_id").val();
        let role_id = $("#role_id").val();
        let username = $("#username").val();
        let password = $("#password").val();
        let status = $("#status").val();

        $.ajax({
            url: 'user_management/insert',
            method: 'post',
            dataType: 'json',
            data: {
                ukpd_id: ukpd_id,
                role_id: role_id,
                username: username,
                password: password,
                status: status,
            },
            beforeSend: function() {
                $(".save").html('<i class="fa fa-spinner"> </i>')
                $(".save").attr('disabled', 'disabled');
            },
            success: function(response) {
                $(".save").html('<i class="fa fa-paper-plane"></i> Kirim')
                $(".save").removeAttr('disabled', 'disabled');
                if (response.error) {
                    if (response.error.ukpd_id) {
                        $("#ukpd_id").addClass('is-invalid');
                        $("#error-ukpd").html(response.error.ukpd_id);
                    } else {
                        $("#ukpd_id").removeClass('is-invalid');
                        $("#error-ukpd").html('');
                    }
                    if (response.error.role_id) {
                        $("#role_id").addClass('is-invalid');
                        $("#error-role").html(response.error.role_id);
                    } else {
                        $("#role_id").removeClass('is-invalid');
                        $("#error-role").html('');
                    }
                    if (response.error.username) {
                        $("#username").addClass('is-invalid');
                        $("#error-user").html(response.error.username);
                    } else {
                        $("#username").removeClass('is-invalid');
                        $("#error-user").html('');
                    }
                    if (response.error.password) {
                        $("#password").addClass('is-invalid');
                        $("#error-password").html(response.error.password);
                    } else {
                        $("#password").removeClass('is-invalid');
                        $("#error-password").html('');
                    }
                    if (response.error.status) {
                        $("#status").addClass('is-invalid');
                        $("#error-status").html(response.error.status);
                    } else {
                        $("#status").removeClass('is-invalid');
                        $("#error-status").html('');
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
        $.ajax({

            url: 'user_management/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $("#id_hapus").val(response.user_management.id);
            }
        });
    });

    $("#delete").click(function(e) {
        e.preventDefault();
        let id = $("#id_hapus").val();
        $.ajax({

            url: 'user_management/hapus',
            method: 'post',
            dataType: 'json',
            data: {
                id: id
            },
            beforeSend: function() {
                $("#delete").html('<i class="fa fa-spinner"> </i>')
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

        $.ajax({

            url: 'user_management/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                let ukpd_id = '<option value=""> -- Silahkan Pilih -- </option>';

                response.ukpd.forEach(function(e) {
                    if (e.id == response.user_management.ukpd_id) {
                        ukpd_id += `<option value="${e.id}" selected> ${e.ukpd} </option>`;
                    } else {
                        ukpd_id += `<option value="${e.id}"> ${e.ukpd} </option>`;
                    }

                });

                $("#ukpd_id_edit").html(ukpd_id);

                let role_id = '<option value=""> -- Silahkan Pilih -- </option>';

                response.role_management.forEach(function(e) {
                    if (e.id == response.user_management.role_id) {
                        role_id += `<option value="${e.id}" selected> ${e.role_management} </option>`;
                    } else {
                        role_id += `<option value="${e.id}"> ${e.role_management} </option>`;
                    }

                });

                $("#role_id_edit").html(role_id);

                $("#id").val(response.user_management.id);
                $("#ukpd_id_edit").val(response.user_management.ukpd_id).trigger('change');
                $("#role_id_edit").val(response.user_management.role_id).trigger('change');
                $("#username_edit").val(response.user_management.username);
                $("#status_edit").val(response.user_management.status).trigger('change');


            }
        });
    });

    $("#edit_user_management").submit(function(e) {

        e.preventDefault();
        let id = $("#id").val();
        let ukpd_id = $("#ukpd_id_edit").val();
        let role_id = $("#role_id_edit").val();
        let username = $("#username_edit").val();
        let password = $("#password_edit").val();
        let status = $("#status_edit").val();

        $.ajax({
            url: 'user_management/update',
            method: 'post',
            dataType: 'json',
            data: {
                id: id,
                ukpd_id: ukpd_id,
                role_id: role_id,
                username: username,
                password: password,
                status: status,
            },
            beforeSend: function() {
                $(".update").html('<i class="fa fa-spinner"> </i>')
                $(".update").attr('disabled', 'disabled');
            },
            success: function(response) {
                $(".update").html('<i class="fa fa-paper-plane"></i> Kirim')
                $(".update").removeAttr('disabled', 'disabled');
                if (response.error) {
                    if (response.error.ukpd_id) {
                        $("#ukpd_id_edit").addClass('is-invalid');
                        $("#error-ukpd-edit").html(response.error.ukpd_id);
                    } else {
                        $("#ukpd_id_edit").removeClass('is-invalid');
                        $("#error-ukpd-edit").html('');
                    }
                    if (response.error.role_id) {
                        $("#role_id_edit").addClass('is-invalid');
                        $("#error-role-edit").html(response.error.role_id);
                    } else {
                        $("#role_id_edit").removeClass('is-invalid');
                        $("#error-role_edit").html('');
                    }
                    if (response.error.username) {
                        $("#username_edit").addClass('is-invalid');
                        $("#error-user-edit").html(response.error.username);
                    } else {
                        $("#unit_penindak_edit").removeClass('is-invalid');
                        $("#error-user-edit").html('');
                    }
                    if (response.error.password) {
                        $("#password_edit").addClass('is-invalid');
                        $("#error-password-edit").html(response.error.password);
                    } else {
                        $("#password_edit").removeClass('is-invalid');
                        $("#error-password-edit").html('');
                    }
                    if (response.error.status) {
                        $("#status_edit").addClass('is-invalid');
                        $("#error-status-edit").html(response.error.status);
                    } else {
                        $("#status").removeClass('is-invalid');
                        $("#error-status-edit").html('');
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