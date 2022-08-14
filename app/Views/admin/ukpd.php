<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> -->

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Master Data UKPD</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#tambah_ukpd"> <i class="fa fa-plus"> </i> Tambah UKPD</button>
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
                        <th>Nama Ukpd</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($ukpd as $ukpd) : ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $ukpd["ukpd"] ?></td>
                            <td><?= $ukpd["nama_ukpd"] ?></td>
                            <td>
                                <button class="btn btn-circle btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus" data-id="<?= $ukpd["id"] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-circle btn-sm btn-warning edit" data-toggle="modal" data-target="#modalEdit" data-id="<?= $ukpd["id"] ?>">
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

<div class="modal fade" id="tambah_ukpd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah UKPD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_ukpd">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="ukpd" class="col-form-label">UKPD :</label>
                        <input type="text" class="form-control" id="ukpd" name="ukpd" placeholder="cth : dalops">
                        <div class="invalid-feedback" id="error-ukpd">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_ukpd" class="col-form-label">Nama UKPD</label>
                        <textarea class="form-control" id="nama_ukpd" name="nama_ukpd" placeholder="cth : bidang dalops"></textarea>
                        <div class="invalid-feedback" id="error-nama">

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
                <h5 class="modal-title" id="exampleModalLabel">Edit UKPD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_ukpd">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" class="form-control">
                        <label for="ukpd" class="col-form-label">UKPD :</label>
                        <input type="text" class="form-control" id="ukpd_edit" name="ukpd" placeholder="cth : dalops">
                        <div class="invalid-feedback" id="error-ukpd-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_ukpd" class="col-form-label">Nama UKPD</label>
                        <textarea class="form-control" id="nama_ukpd_edit" name="nama_ukpd" placeholder="cth : bidang dalops"></textarea>
                        <div class="invalid-feedback" id="error-nama-edit">

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
    });

    $("#tambah_ukpd").submit(function(e) {
        e.preventDefault();

        let ukpd = $("#ukpd").val();
        let nama_ukpd = $("#nama_ukpd").val();

        $.ajax({
            url: 'ukpd/insert',
            method: 'post',
            dataType: 'json',
            data: {
                ukpd: ukpd,
                nama_ukpd: nama_ukpd
            },
            beforeSend: function() {
                $(".save").html('<i class="fa fa-spinner"> </i>')
            },
            success: function(response) {
                $(".save").html('<i class="fa fa-paper-plane"></i> Kirim')
                if (response.error) {
                    if (response.error.ukpd) {
                        $("#ukpd").addClass('is-invalid');
                        $("#error-ukpd").html(response.error.ukpd);
                    } else {
                        $("#ukpd").removeClass('is-invalid');
                        $("#error-ukpd").html('');
                    }
                    if (response.error.nama_ukpd) {
                        $("#nama_ukpd").addClass('is-invalid');
                        $("#error-nama").html(response.error.nama_ukpd);
                    } else {
                        $("#nama_ukpd").removeClass('is-invalid');
                        $("#error-nama").html('');
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

            url: 'ukpd/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $("#id_hapus").val(response.id);
            }
        });
    });

    $("#delete").click(function(e) {
        e.preventDefault();
        let id = $("#id_hapus").val();
        // console.log(id);
        $.ajax({

            url: 'ukpd/hapus',
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

            url: 'ukpd/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $("#id").val(response.id);
                $("#ukpd_edit").val(response.ukpd);
                $("#nama_ukpd_edit").val(response.nama_ukpd);
            }
        });
    });

    $("#edit_ukpd").submit(function(e) {

        e.preventDefault();

        let id = $("#id").val();
        let ukpd = $("#ukpd_edit").val();
        let nama_ukpd = $("#nama_ukpd_edit").val();

        $.ajax({
            url: 'ukpd/update',
            method: 'post',
            dataType: 'json',
            data: {
                id: id,
                ukpd: ukpd,
                nama_ukpd: nama_ukpd
            },
            beforeSend: function() {
                $(".update").html('<i class="fa fa-spinner"> </i>')
            },
            success: function(response) {
                $(".update").html('<i class="fa fa-paper-plane"></i> Kirim')
                if (response.error) {
                    if (response.error.ukpd) {
                        $("#ukpd_edit").addClass('is-invalid');
                        $("#error-ukpd-edit").html(response.error.ukpd);
                    } else {
                        $("#ukpd_edit").removeClass('is-invalid');
                        $("#error-ukpd-edit").html('');
                    }
                    if (response.error.nama_ukpd) {
                        $("#nama_ukpd_edit").addClass('is-invalid');
                        $("#error-nama-edit").html(response.error.nama_ukpd);
                    } else {
                        $("#nama_ukpd_edit").removeClass('is-invalid');
                        $("#error-nama-edit").html('');
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