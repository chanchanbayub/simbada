<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> -->

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Master Data Klasifikasi Kendaraan</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#tambah_klasifikasi"> <i class="fa fa-plus"> </i> Tambah Klasifikasi Kendaraan</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Jenis Kendaraan</th>
                        <th>Klasifikasi Kendaraan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($klasifikasi_kendaraan as $klasifikasi_kendaraan) : ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $klasifikasi_kendaraan["jenis_kendaraan"] ?></td>
                            <td><?= $klasifikasi_kendaraan["klasifikasi_kendaraan"] ?></td>
                            <td>
                                <button class="btn btn-circle btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus" data-id="<?= $klasifikasi_kendaraan["id"] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-circle btn-sm btn-warning edit" data-toggle="modal" data-target="#modalEdit" data-id="<?= $klasifikasi_kendaraan["id"] ?>">
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

<div class="modal fade" id="tambah_klasifikasi" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Klasifikasi Kendaraan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_klasifikasi_kendaraan">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="jenis_kendaraan_id" class="col-form-label">Jenis Kendaraan :</label>
                        <select name="jenis_kendaraan_id" id="jenis_kendaraan_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($jenis_kendaraan as $jenis_kendaraan) : ?>
                                <option value="<?= $jenis_kendaraan["id"] ?>"> <?= $jenis_kendaraan["jenis_kendaraan"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="error-kendaraan">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="klasifikasi_kendaraan" class="col-form-label">Klasfikasi Kendaraan:</label>
                        <input type="text" class="form-control" id="klasifikasi_kendaraan" name="klasifikasi_kendaraan">
                        <div class="invalid-feedback" id="error-klasifikasi">

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
                <form id="edit_klasifikasi">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" class="form-control">
                        <label for="jenis_kendaraan_id_edit" class="col-form-label">Jenis Kendaraan :</label>
                        <select name="jenis_kendaraan_id" id="jenis_kendaraan_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                        </select>
                        <div class="invalid-feedback" id="error-kendaraan-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="klasifikasi_kendaraan_edit" class="col-form-label">Klasfikasi Kendaraan:</label>
                        <input type="text" class="form-control" id="klasifikasi_kendaraan_edit" name="klasifikasi_kendaraan">
                        <div class="invalid-feedback" id="error-klasifikasi-edit">

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

        $('#jenis_kendaraan_id').select2({
            theme: "bootstrap4",
        });

        $('#jenis_kendaraan_id_edit').select2({
            theme: "bootstrap4",
        });
    });

    $("#tambah_klasifikasi_kendaraan").submit(function(e) {
        e.preventDefault();

        let klasifikasi_kendaraan = $("#klasifikasi_kendaraan").val();
        let jenis_kendaraan_id = $("#jenis_kendaraan_id").val();

        $.ajax({
            url: 'klasifikasi/insert',
            method: 'post',
            dataType: 'json',
            data: {
                jenis_kendaraan_id: jenis_kendaraan_id,
                klasifikasi_kendaraan: klasifikasi_kendaraan,
            },
            beforeSend: function() {
                $(".save").html('<i class="fa fa-spinner"> </i>')
            },
            success: function(response) {
                $(".save").html('<i class="fa fa-paper-plane"></i> Kirim')
                if (response.error) {
                    if (response.error.jenis_kendaraan_id) {
                        $("#jenis_kendaraan_id").addClass('is-invalid');
                        $("#error-kendaraan").html(response.error.jenis_kendaraan_id);
                    } else {
                        $("#jenis_kendaraan_id").removeClass('is-invalid');
                        $("#error-kendaraan").html('');
                    }
                    if (response.error.klasifikasi_kendaraan) {
                        $("#klasifikasi_kendaraan").addClass('is-invalid');
                        $("#error-klasifikasi").html('');
                    } else {
                        $("#jenis_kendaraan_id").removeClass('is-invalid');
                        $("#error-klasifikasi").html('');
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

            url: 'klasifikasi/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $("#id_hapus").val(response.klasifikasi.id);
            }
        });
    });

    $("#delete").click(function(e) {
        e.preventDefault();
        let id = $("#id_hapus").val();
        // console.log(id);
        $.ajax({

            url: 'klasifikasi/hapus',
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

            url: 'klasifikasi/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {

                let jenis_kendaraan = '<option value="">--Silahkan Pilih--</option>';

                response.jenis_kendaraan.forEach(function(e) {
                    jenis_kendaraan += `<option value="${e.id}">${e.jenis_kendaraan}</option>`
                });

                $("#jenis_kendaraan_id_edit").html(jenis_kendaraan);

                $("#id").val(response.klasifikasi.id);
                $("#jenis_kendaraan_id_edit").val(response.klasifikasi.jenis_kendaraan_id).trigger('change');
                $("#klasifikasi_kendaraan_edit").val(response.klasifikasi.klasifikasi_kendaraan);
            }
        });
    });

    $("#edit_klasifikasi").submit(function(e) {

        e.preventDefault();

        let id = $("#id").val();
        let jenis_kendaraan_id = $("#jenis_kendaraan_id_edit").val();
        let klasifikasi_kendaraan = $("#klasifikasi_kendaraan_edit").val();

        $.ajax({
            url: 'klasifikasi/update',
            method: 'post',
            dataType: 'json',
            data: {
                id: id,
                jenis_kendaraan_id: jenis_kendaraan_id,
                klasifikasi_kendaraan: klasifikasi_kendaraan,
            },
            beforeSend: function() {
                $(".update").html('<i class="fa fa-spinner"> </i>')
            },
            success: function(response) {
                $(".update").html('<i class="fa fa-paper-plane"></i> Kirim')
                if (response.error) {
                    if (response.error.jenis_kendaraan_id) {
                        $("#jenis_kendaraan_id_edit").addClass('is-invalid');
                        $("#error-kendaraan-edit").html(response.error.jenis_kendaraan_id);
                    } else {
                        $("#jenis_kendaraan_id_edit").removeClass('is-invalid');
                        $("#error-kendaraan-edit").html('');
                    }
                    if (response.error.klasifikasi_kendaraan) {
                        $("#klasifikasi_kendaraan_edit").addClass('is-invalid');
                        $("#error-klasifikasi-edit").html(response.error.klasifikasi_kendaraan);
                    } else {
                        $("#klasifikasi_kendaraan_edit").removeClass('is-invalid');
                        $("#error-klasifikasi-edit").html('');
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