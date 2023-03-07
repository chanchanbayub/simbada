<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> -->

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Master Data Nomor Surat Tugas</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#tambah_spt"> <i class="fa fa-plus"> </i> Tambah Surat Tugas</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Surat Tugas</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($surat_tugas as $surat_tugas) : ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $surat_tugas["nomor_surat"] ?></td>
                            <td><?= $surat_tugas["tanggal"] ?></td>
                            <td>
                                <button class="btn btn-circle btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus" data-id="<?= $surat_tugas["id"] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-circle btn-sm btn-warning edit" data-toggle="modal" data-target="#modalEdit" data-id="<?= $surat_tugas["id"] ?>">
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

<div class="modal fade" id="tambah_spt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Surat Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_nomor_surat">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="ukpd" class="col-form-label">Nomor Surat Tugas :</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" placeholder="silahkan isi">
                        <div class="invalid-feedback" id="error-nomor_surat">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ukpd" class="col-form-label">Tanggal Surat Tugas :</label>
                        <input type="text" class="form-control" id="tanggal" name="tanggal" placeholder="silahkan isi">
                        <div class="invalid-feedback" id="error-tanggal">

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
                <h5 class="modal-title" id="exampleModalLabel">Edit Nomor Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_nomor_surat">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" class="form-control">
                        <label for="ukpd" class="col-form-label">Nomor Surat Tugas :</label>
                        <input type="text" class="form-control" id="nomor_surat_edit" name="nomor_surat">
                        <div class="invalid-feedback" id="error-nomor_surat-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ukpd" class="col-form-label">Tanggal Surat Tugas :</label>
                        <input type="text" class="form-control" id="tanggal_edit" name="tanggal">
                        <div class="invalid-feedback" id="error-tanggal-edit">

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

    $("#tambah_nomor_surat").submit(function(e) {
        e.preventDefault();

        let nomor_surat = $("#nomor_surat").val();
        let tanggal = $("#tanggal").val();

        $.ajax({
            url: 'nomor_spt/insert',
            method: 'post',
            dataType: 'json',
            data: {
                nomor_surat: nomor_surat,
                tanggal: tanggal,
            },
            beforeSend: function() {
                $(".save").html('<i class="fa fa-spinner"> </i>')
            },
            success: function(response) {
                $(".save").html('<i class="fa fa-paper-plane"></i> Kirim')
                if (response.error) {
                    if (response.error.nomor_surat) {
                        $("#nomor_surat").addClass('is-invalid');
                        $("#error-nomor_surat").html(response.error.nomor_surat);
                    } else {
                        $("#nomor_surat").removeClass('is-invalid');
                        $("#error-nomor_surat").html('');
                    }
                    if (response.error.tanggal) {
                        $("#tanggal").addClass('is-invalid');
                        $("#error-tanggal").html(response.error.tanggal);
                    } else {
                        $("#tanggal").removeClass('is-invalid');
                        $("#error-tanggal").html('');
                    }

                } else {
                    Swal.fire({
                        icon: 'success',
                        title: `${response.success}`,
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 3000)
                }
            }
        });
    })

    $(".hapus").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        // console.log(id);
        $.ajax({

            url: 'nomor_spt/edit',
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

            url: 'nomor_spt/hapus',
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

            url: 'nomor_spt/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $("#id").val(response.id);
                $("#nomor_surat_edit").val(response.nomor_surat);
                $("#tanggal_edit").val(response.tanggal);
            }
        });
    });

    $("#edit_nomor_surat").submit(function(e) {

        e.preventDefault();

        let id = $("#id").val();
        let nomor_surat = $("#nomor_surat_edit").val();
        let tanggal = $("#tanggal_edit").val();

        $.ajax({
            url: 'nomor_spt/update',
            method: 'post',
            dataType: 'json',
            data: {
                id: id,
                nomor_surat: nomor_surat,
                tanggal: tanggal,
            },
            beforeSend: function() {
                $(".update").html('<i class="fa fa-spinner"> </i>')
            },
            success: function(response) {
                $(".update").html('<i class="fa fa-paper-plane"></i> Kirim')
                if (response.error) {
                    if (response.error.nomor_surat) {
                        $("#nomor_surat_edit").addClass('is-invalid');
                        $("#error-nomor_surat-edit").html(response.error.nomor_surat);
                    } else {
                        $("#nomor_surat_edit").removeClass('is-invalid');
                        $("#error-nomor_surat-edit").html('');
                    }
                    if (response.error.tanggal) {
                        $("#tanggal_edit").addClass('is-invalid');
                        $("#error-tanggal-edit").html(response.error.tanggal);
                    } else {
                        $("#tanggal_edit").removeClass('is-invalid');
                        $("#error-tanggal-edit").html('');
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