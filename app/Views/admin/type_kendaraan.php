<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> -->

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Master Data Type Kendaraan</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#tambah_type"> <i class="fa fa-plus"> </i> Tambah Type Kendaraan</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Klasfikasi Kendaraan</th>
                        <th>Type Kendaraan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($type_kendaraan as $type_kendaraan) : ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $type_kendaraan["klasifikasi_kendaraan"] ?></td>
                            <td><?= $type_kendaraan["type_kendaraan"] ?></td>
                            <td>
                                <button class="btn btn-circle btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus" data-id="<?= $type_kendaraan["id"] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-circle btn-sm btn-warning edit" data-toggle="modal" data-target="#modalEdit" data-id="<?= $type_kendaraan["id"] ?>">
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

<div class="modal fade" id="tambah_type" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Type Kendaraan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_type_kendaraan">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="klasifikasi_id" class="col-form-label">Klasifikasi Kendaraan :</label>
                        <select name="klasifikasi_id" id="klasifikasi_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($klasifikasi as $klasifikasi) : ?>
                                <option value="<?= $klasifikasi["id"] ?>"><?= $klasifikasi["klasifikasi_kendaraan"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="error-klasifikasi">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type_kendaraan" class="col-form-label">Type Kendaraan:</label>
                        <input type="text" class="form-control" id="type_kendaraan" name="type_kendaraan">
                        <div class="invalid-feedback" id="error-type">

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
                <h5 class="modal-title" id="exampleModalLabel">Edit Klasifikasi Kendaraan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_type">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" class="form-control">
                        <label for="klasifikasi_id_edit" class="col-form-label">Jenis Kendaraan :</label>
                        <select name="klasifikasi_id" id="klasifikasi_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                        </select>
                        <div class="invalid-feedback" id="error-klasifikasi-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type_kendaraan_edit" class="col-form-label">Type Kendaraan:</label>
                        <input type="text" class="form-control" id="type_kendaraan_edit" name="type_kendaraan">
                        <div class="invalid-feedback" id="error-type-edit">

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

        $('#klasifikasi_id_edit').select2({
            theme: "bootstrap4",
        });

        $('#klasifikasi_id').select2({
            theme: "bootstrap4",
        });
    });

    $("#tambah_type_kendaraan").submit(function(e) {
        e.preventDefault();

        let klasifikasi_id = $("#klasifikasi_id").val();
        let type_kendaraan = $("#type_kendaraan").val();

        $.ajax({
            url: 'type_kendaraan/insert',
            method: 'post',
            dataType: 'json',
            data: {
                type_kendaraan: type_kendaraan,
                klasifikasi_id: klasifikasi_id,
            },
            beforeSend: function() {
                $(".save").html('<i class="fa fa-spinner"> </i>')
            },
            success: function(response) {
                $(".save").html('<i class="fa fa-paper-plane"></i> Kirim')
                if (response.error) {
                    if (response.error.klasifikasi_id) {
                        $("#klasifikasi_id").addClass('is-invalid');
                        $("#error-klasifikasi").html(response.error.klasifikasi_id);
                    } else {
                        $("#klasifikasi_id").removeClass('is-invalid');
                        $("#error-klasifikasi").html(response.error.klasifikasi_id);
                    }
                    if (response.error.type_kendaraan) {
                        $("#type_kendaraan").addClass('is-invalid');
                        $("#error-type").html(response.error.type_kendaraan);
                    } else {
                        $("#type_kendaraan").removeClass('is-invalid');
                        $("#error-type").html(response.error.type_kendaraan);
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

            url: 'type_kendaraan/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $("#id_hapus").val(response.type_kendaraan.id);
            }
        });
    });

    $("#delete").click(function(e) {
        e.preventDefault();
        let id = $("#id_hapus").val();
        // console.log(id);
        $.ajax({

            url: 'type_kendaraan/hapus',
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
        // console.log(id);
        $.ajax({

            url: 'type_kendaraan/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                console.log(response);
                let klasifikasi = '<option value="">--Silahkan Pilih--</option>';

                response.klasifikasi.forEach(function(e) {
                    klasifikasi += `<option value="${e.id}">${e.klasifikasi_kendaraan}</option>`
                });

                $("#klasifikasi_id_edit").html(klasifikasi);
                // console.log(klasifikasi);

                $("#id").val(response.type_kendaraan.id);

                $("#klasifikasi_id_edit").val(response.type_kendaraan.klasifikasi_id).trigger('change');
                $("#type_kendaraan_edit").val(response.type_kendaraan.type_kendaraan);
            }
        });
    });

    $("#edit_type").submit(function(e) {

        e.preventDefault();

        let id = $("#id").val();
        let klasifikasi_id = $("#klasifikasi_id_edit").val();
        let type_kendaraan = $("#type_kendaraan_edit").val();

        $.ajax({
            url: 'type_kendaraan/update',
            method: 'post',
            dataType: 'json',
            data: {
                id: id,
                klasifikasi_id: klasifikasi_id,
                type_kendaraan: type_kendaraan,
            },
            beforeSend: function() {
                $(".update").html('<i class="fa fa-spinner"> </i>')
            },
            success: function(response) {
                $(".update").html('<i class="fa fa-paper-plane"></i> Kirim')
                if (response.error) {
                    if (response.error.klasifikasi_id) {
                        $("#klasifikasi_id_edit").addClass('is-invalid');
                        $("#error-klasifikasi-edit").html(response.error.klasifikasi_id);
                    } else {
                        $("#klasifikasi_id_edit").removeClass('is-invalid');
                        $("#error-klasifikasi-edit").html('');
                    }
                    if (response.error.type_kendaraan) {
                        $("#type_kendaraan_edit").addClass('is-invalid');
                        $("#error-type-edit").html(response.error.type_kendaraan);
                    } else {
                        $("#type_kendaraan_edit").removeClass('is-invalid');
                        $("#error-type-edit").html('');
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