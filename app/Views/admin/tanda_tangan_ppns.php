<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>
<link rel="stylesheet" href="/assets/signaturepad/jquery.signature.css">
<link rel="stylesheet" href="/assets/signaturepad/jquery.ui.css">
<style>
    .signature {
        width: 100%;
        /* margin: 0 auto; */
        overflow: auto;
    }

    .kbw-signature {
        width: 400px;
        /* height: 200px; */
    }

    #canva canvas {
        width: 100% !important;
        height: auto;
    }
</style>
</style>

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Master Data Tanda Tangan PPNS</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#tambah_ppns"> <i class="fa fa-plus"> </i> Tambah Tanda PPNS</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama PPNS</th>
                        <th>NIP</th>
                        <th>Tanda Tangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($tanda_tangan as $tanda_tangan) : ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $tanda_tangan["nama_ppns"] ?></td>
                            <td><?= $tanda_tangan["nip"] ?></td>
                            <td><img src="/<?= $tanda_tangan["tanda_tangan"] ?>" alt="tanda_tangan" width="100"></td>
                            <td>
                                <button class="btn btn-circle btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus" data-id="<?= $tanda_tangan["id"] ?>">
                                    <i class="fa fa-trash"></i>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tanda Tangan PPNS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_tanda_tangan" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class=" form-group">
                        <label for="ppns_id" class="col-form-label">Nama PPNS :</label>
                        <select name="ppns_id" id="ppns_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($ppns as $ppns) : ?>
                                <option value="<?= $ppns["id"] ?>"><?= $ppns["nama_ppns"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="error-ppns">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanda_tangan" class="col-form-label">Tanda Tangan PPNS :</label>
                        <div class="signature">
                            <div id="canva"></div>
                            <div class="text-left">
                                <button id="clear" type="button" class="btn btn-outline-danger btn-xs"> <i class="fa fa-times"></i> Hapus </button>
                                <textarea id="signature64" name="tanda_tangan" style="display: none;"></textarea>
                            </div>
                            <div class="invalid-feedback" id="error-ttd">

                            </div>
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

<script src="/assets/vendor/jquery/jquery.min.js"></script>
<script src="/assets/signaturepad/jquery.ui.min.js"></script>
<script src="/assets/signaturepad/jquery.signature.min.js"></script>
<script src="/assets/signaturepad/jquery.ui.touch-punch.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();

        $('#ppns_id').select2({
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

    $("#tambah_tanda_tangan").submit(function(e) {
        e.preventDefault();
        let ppns_id = $("#ppns_id").val();
        let tanda_tangan = $("#signature64").val();

        $.ajax({
            url: 'tanda_tangan/insert',
            method: 'post',
            dataType: 'json',
            data: {
                ppns_id: ppns_id,
                tanda_tangan: tanda_tangan,
            },
            beforeSend: function() {
                $(".save").html('<i class="fa fa-spinner fa-spin"> </i>')
            },
            success: function(response) {
                $(".save").html('<i class="fa fa-paper-plane"></i> Kirim')
                if (response.error) {
                    if (response.error.ppns_id) {
                        $("#ppns_id").addClass('is-invalid');
                        $("#error-ppns").html(response.error.ppns_id);
                    } else {
                        $("#ppns_id").removeClass('is-invalid');
                        $("#error-ppns").html('');
                    }
                    if (response.error.tanda_tangan) {
                        $("#canva").addClass('is-invalid');
                        $("#error-ttd").html(response.error.tanda_tangan);
                    } else {
                        $("#canva").removeClass('is-invalid');
                        $("#error-ttd").html('');
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

            url: 'tanda_tangan/edit',
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

            url: 'tanda_tangan/hapus',
            method: 'post',
            dataType: 'json',
            data: {
                id: id
            },
            beforeSend: function() {
                $("#delete").html('<i class="fa fa-spinner fa-spin"> </i>')
                $("#delete").attr('disabled', 'disabled');
            },
            success: function(response) {
                $("#delete").html('Hapus Data')
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
</script>
<?= $this->endSection(); ?>