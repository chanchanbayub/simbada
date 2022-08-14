<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> -->

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Master Data Jenis Pelanggaran</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#tambah_pelanggaran"> <i class="fa fa-plus"> </i> Tambah Jenis Pelanggaran</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Pasal Pelanggaran</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($jenis_pelanggaran as $jenis_pelanggaran) : ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td>Pasal <?= $jenis_pelanggaran["pasal_pelanggaran"] ?></td>
                            <td><?= $jenis_pelanggaran["keterangan"] ?></td>
                            <td>
                                <button class="btn btn-circle btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus" data-id="<?= $jenis_pelanggaran["id"] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-circle btn-sm btn-warning edit" data-toggle="modal" data-target="#modalEdit" data-id="<?= $jenis_pelanggaran["id"] ?>">
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

<div class="modal fade" id="tambah_pelanggaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Pelanggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_jenis_pelanggaran">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="pasal_pelanggaran" class="col-form-label">Pasal Pelanggaran :</label>
                        <input type="number" class="form-control" id="pasal_pelanggaran" name="pasal_pelanggaran">
                        <div class="invalid-feedback" id="error-pasal">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan" class="col-form-label">Keterangan :</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                        <div class="invalid-feedback" id="error-keterangan">

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
                <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Pelanggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_pelanggaran">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="hidden" id="id" name="id" class="form-control">
                        <label for="pasal_pelanggaran_edit" class="col-form-label">Pasal Pelanggaran :</label>
                        <input type="number" class="form-control" id="pasal_pelanggaran_edit" name="pasal_pelanggaran">
                        <div class="invalid-feedback" id="error-pasal-edit">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="keterangan_edit" class="col-form-label">Keterangan :</label>
                        <input type="text" class="form-control" id="keterangan_edit" name="keterangan">
                        <div class="invalid-feedback" id="error-keterangan-edit">

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
<script src="/assets/vendor/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    $("#tambah_jenis_pelanggaran").submit(function(e) {
        e.preventDefault();

        let pasal_pelanggaran = $("#pasal_pelanggaran").val();
        let keterangan = $("#keterangan").val();

        $.ajax({
            url: 'jenis_pelanggaran/insert',
            method: 'post',
            dataType: 'json',
            data: {
                pasal_pelanggaran: pasal_pelanggaran,
                keterangan: keterangan,
            },
            beforeSend: function() {
                $(".save").html('<i class="fa fa-spinner"> </i>')
            },
            success: function(response) {
                $(".save").html('<i class="fa fa-paper-plane"></i> Kirim')
                if (response.error) {
                    if (response.error.pasal_pelanggaran) {
                        $("#pasal_pelanggaran").addClass('is-invalid');
                        $("#error-pasal").html(response.error.pasal_pelanggaran);
                    } else {
                        $("#pasal_pelanggaran").removeClass('is-invalid');
                        $("#error-pasal").html('');
                    }
                    if (response.error.keterangan) {
                        $("#keterangan").addClass('is-invalid');
                        $("#error-keterangan").html(response.error.keterangan);
                    } else {
                        $("#keterangan").removeClass('is-invalid');
                        $("#error-keterangan").html('');
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

            url: 'jenis_pelanggaran/edit',
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

            url: 'jenis_pelanggaran/hapus',
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

            url: 'jenis_pelanggaran/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $("#id").val(response.id);
                $("#pasal_pelanggaran_edit").val(response.pasal_pelanggaran);
                $("#keterangan_edit").val(response.keterangan);
            }
        });
    });

    $("#edit_pelanggaran").submit(function(e) {

        e.preventDefault();

        let id = $("#id").val();
        let pasal_pelanggaran = $("#pasal_pelanggaran_edit").val();
        let keterangan = $("#keterangan_edit").val();

        $.ajax({
            url: 'jenis_pelanggaran/update',
            method: 'post',
            dataType: 'json',
            data: {
                id: id,
                pasal_pelanggaran: pasal_pelanggaran,
                keterangan: keterangan,
            },
            beforeSend: function() {
                $(".update").html('<i class="fa fa-spinner"> </i>')
            },
            success: function(response) {
                $(".update").html('<i class="fa fa-paper-plane"></i> Kirim')
                if (response.error) {
                    if (response.error.pasal_pelanggaran) {
                        $("#pasal_pelanggaran_edit").addClass('is-invalid');
                        $("#error-pasal-edit").html(response.error.pasal_pelanggaran);
                    } else {
                        $("#pasal_pelanggaran_edit").removeClass('is-invalid');
                        $("#error-pasal-edit").html('');
                    }
                    if (response.error.keterangan) {
                        $("#keterangan_edit").addClass('is-invalid');
                        $("#error-keterangan-edit").html(response.error.keterangan);
                    } else {
                        $("#keterangan_edit").removeClass('is-invalid');
                        $("#error-keterangan-edit").html('');
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