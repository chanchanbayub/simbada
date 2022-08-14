<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> -->

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Master Data Berita Acara Penderekan</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#tambah_bap"> <i class="fa fa-plus"> </i> Tambah BAP</button>
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
                        <th>Unit / Regu</th>
                        <th>NoBap</th>
                        <th>Nama Dandru Derek</th>
                        <th>NIP</th>
                        <th>Nama PPNS</th>
                        <th>Status BAP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($bap as $bap) : ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $bap["ukpd"] ?></td>
                            <td><?= $bap["unit_penindak"] ?></td>
                            <td><?= $bap["noBap"] ?></td>
                            <td><?= $bap["nama"] ?></td>
                            <td><?= $bap["nip_npjlp"] ?></td>
                            <td><?= $bap["nama_ppns"] ?></td>
                            <td><?= $bap["status_bap"] ?></td>
                            <td>
                                <button class="btn btn-circle btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus" data-id="<?= $bap["id"] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-circle btn-sm btn-warning edit" data-toggle="modal" data-target="#modalEdit" data-id="<?= $bap["id"] ?>">
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

<div class="modal fade" id="tambah_bap" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah No BAP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="tambah_no_bap" autocomplete="off">
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
                        <label for="ppns_id" class="col-form-label">Nama PPNS :</label>
                        <select name="ppns_id" id="ppns_id" class="form-control" disabled>
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback" id="error-ppns">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="noBap_start" class="col-form-label">Nomor BAP Awal :</label>
                        <input type="number" class="form-control" id="noBap_start" name="noBap_start">
                        <div class="invalid-feedback" id="error-noBap-start">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="noBap_end" class="col-form-label">Nomor BAP Akhir :</label>
                        <input type="number" class="form-control" id="noBap_end" name="noBap_end">
                        <div class="invalid-feedback" id="error-noBap-end">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unit_id" class="col-form-label">Unit / Regu :</label>
                        <select name="unit_id" id="unit_id" class="form-control" disabled>
                            <option value="">--Silahkan Pilih--</option>
                        </select>
                        <div class="invalid-feedback" id="error-unit">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status_id" class="col-form-label">Status BAP :</label>
                        <select name="status_id" id="status_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($status_bap as $status_bap) : ?>
                                <option value="<?= $status_bap["id"] ?>"> <?= $status_bap["status_bap"] ?></option>
                            <?php endforeach; ?>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Nomor BAP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit_no_bap">
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
                        <label for="ppns_id_edit" class="col-form-label">PPNS :</label>
                        <select name="ppns_id" id="ppns_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback" id="error-ukpd-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="noBap_edit" class="col-form-label">Nomor BAP :</label>
                        <input type="number" class="form-control" id="noBap_edit" name="noBap">
                        <div class="invalid-feedback" id="error-bap-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unit_id_edit" class="col-form-label">Unit / Regu :</label>
                        <select name="unit_id" id="unit_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                        </select>
                        <div class="invalid-feedback" id="error-unit-edit">

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status_id_edit" class="col-form-label">Status BAP :</label>
                        <select name="status_id" id="status_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>

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

        $('#unit_id').select2({
            theme: "bootstrap4",
        });
        $('#ppns_id').select2({
            theme: "bootstrap4",
        });

        $('#status_id').select2({
            theme: "bootstrap4",
        });

    });


    $("#ukpd_id").change(function(e) {
        let ukpd_id = $(this).val();
        let id = $('id').val();
        $.ajax({
            url: 'bap/getUnit',
            method: 'get',
            dataType: 'json',
            data: {
                ukpd_id: ukpd_id,
                id: id
            },
            success: function(response) {
                let unit_penindak = '<option value=""> --Silahkan Pilih-- </option>';

                if (response.unit_penindak.length > 0) {
                    response.unit_penindak.forEach(function(e) {
                        $("#unit_id").removeAttr('disabled', 'disabled');
                        unit_penindak += `<option value = "${e.id}" >${e.unit_penindak}</option>`;
                    });
                } else {
                    unit_penindak = '<option value=""> --Silahkan Pilih-- </option>';
                }

                $("#unit_id").html(unit_penindak);

                let ppns = '<option value=""> --Silahkan Pilih-- </option>';

                if (response.ppns.length > 0) {
                    response.ppns.forEach(function(e) {
                        $("#ppns_id").removeAttr('disabled', 'disabled');
                        ppns += `<option value = "${e.id}" >${e.nama_ppns}</option>`;
                    });
                } else {
                    ppns = '<option value=""> --Silahkan Pilih-- </option>';
                }

                $("#ppns_id").html(ppns);
            }
        });

    });




    $("#tambah_no_bap").submit(function(e) {
        e.preventDefault();

        let ukpd_id = $("#ukpd_id").val();
        let ppns_id = $("#ppns_id").val();
        let noBap_start = $("#noBap_start").val();
        let noBap_end = $("#noBap_end").val();
        let unit_id = $("#unit_id").val();
        let status_id = $("#status_id").val();

        $.ajax({
            url: 'bap/insert',
            method: 'post',
            dataType: 'json',
            data: {
                ukpd_id: ukpd_id,
                ppns_id: ppns_id,
                unit_id: unit_id,
                noBap_start: noBap_start,
                noBap_end: noBap_end,
                status_id: status_id,
            },
            beforeSend: function() {
                $(".save").html('<i class="fa fa-spinner"> </i>')
                $(".save").attr('disabled', 'disabled')
            },
            success: function(response) {
                $(".save").html('<i class="fa fa-paper-plane"></i> Kirim')
                $(".save").removeAttr('disabled', 'disabled')
                if (response.error) {
                    if (response.error.ukpd_id) {
                        $("#ukpd_id").addClass('is-invalid');
                        $("#error-ukpd").html(response.error.ukpd_id);
                    } else {
                        $("#ukpd_id").removeClass('is-invalid');
                        $("#error-ukpd").html('');
                    }
                    if (response.error.noBap_start) {
                        $("#noBap_start").addClass('is-invalid');
                        $("#error-noBap-start").html(response.error.noBap_start);
                    } else {
                        $("#noBap_start").removeClass('is-invalid');
                        $("#error-noBap-start").html('');
                    }
                    if (response.error.noBap_end) {
                        $("#noBap_end").addClass('is-invalid');
                        $("#error-noBap-end").html(response.error.noBap_end);
                    } else {
                        $("#noBap_end").removeClass('is-invalid');
                        $("#error-noBap-end").html('');
                    }
                    if (response.error.ppns_id) {
                        $("#ppns_id").addClass('is-invalid');
                        $("#error-ppns").html(response.error.ppns_id);
                    } else {
                        $("#ppns_id").removeClass('is-invalid');
                        $("#error-ppns").html('');
                    }
                    if (response.error.unit_id) {
                        $("#unit_id").addClass('is-invalid');
                        $("#error-unit").html(response.error.unit_id);
                    } else {
                        $("#unit_id").removeClass('is-invalid');
                        $("#error-unit").html('');
                    }
                    if (response.error.status_id) {
                        $("#status_id").addClass('is-invalid');
                        $("#error-status").html(response.error.status_id);
                    } else {
                        $("#status_id").removeClass('is-invalid');
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
        // console.log(id);
        $.ajax({

            url: 'bap/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $("#id_hapus").val(response.bap.id);
            }
        });
    });

    $("#delete").click(function(e) {
        e.preventDefault();
        let id = $("#id_hapus").val();
        // console.log(id);
        $.ajax({

            url: 'bap/hapus',
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

            url: 'bap/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {

                // UKPD
                let ukpd_id = '<option value=""> -- Silahkan Pilih -- </option>';

                response.ukpd.forEach(function(e) {
                    if (e.id == response.bap.ukpd_id) {
                        ukpd_id += `<option value="${e.id}" selected> ${e.ukpd} </option>`;
                    } else {
                        ukpd_id += `<option value="${e.id}"> ${e.ukpd} </option>`;
                    }

                });

                $("#ukpd_id_edit").html(ukpd_id);

                // Unit id
                let unit_id = '<option value=""> -- Silahkan Pilih -- </option>';

                response.unit_penindak.forEach(function(e) {
                    if (e.id == response.bap.unit_id) {
                        unit_id += `<option value="${e.id}" selected> ${e.unit_penindak} </option>`;
                    } else {
                        unit_id += `<option value="${e.id}"> ${e.unit_penindak} </option>`;
                    }

                });

                $("#unit_id_edit").html(unit_id);

                // status_bap
                let status_id = '<option value=""> -- Silahkan Pilih -- </option>';

                response.status_bap.forEach(function(e) {
                    if (e.id == response.bap.status_id) {
                        status_id += `<option value="${e.id}" selected> ${e.status_bap} </option>`;
                    } else {
                        status_id += `<option value="${e.id}"> ${e.status_bap} </option>`;
                    }

                });

                $("#status_id_edit").html(status_id);

                // NoBap
                $("#noBap_edit").val(response.bap.noBap);
                $("#id").val(response.bap.id);

                // ppns
                let ppns = '<option value=""> -- Silahkan Pilih -- </option>';

                response.ppns.forEach(function(e) {
                    if (e.id == response.bap.ppns_id) {
                        ppns += `<option value="${e.id}" selected> ${e.nama_ppns} </option>`;
                    } else {
                        ppns += `<option value="${e.id}"> ${e.nama_ppns} </option>`;
                    }

                });

                $("#ppns_id_edit").html(ppns);
            }
        });
    });

    $("#edit_no_bap").submit(function(e) {

        e.preventDefault();
        let id = $("#id").val();
        let ukpd_id = $("#ukpd_id_edit").val();
        let unit_id = $("#unit_id_edit").val();
        let ppns_id = $("#ppns_id_edit").val();
        let noBap = $("#noBap_edit").val();
        let status_id = $("#status_id_edit").val();

        $.ajax({
            url: 'bap/update',
            method: 'post',
            dataType: 'json',
            data: {
                id: id,
                ukpd_id: ukpd_id,
                unit_id: unit_id,
                ppns_id: ppns_id,
                noBap: noBap,
                status_id: status_id,

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
                    if (response.error.noBap) {
                        $("#noBap_edit").addClass('is-invalid');
                        $("#error-bap-edit").html(response.error.noBap);
                    } else {
                        $("#noBap_edit").removeClass('is-invalid');
                        $("#error-bap-edit").html('');
                    }
                    if (response.error.unit_id) {
                        $("#unit_id_edit").addClass('is-invalid');
                        $("#error-unit-edit").html(response.error.unit_id);
                    } else {
                        $("#unit_id_edit").removeClass('is-invalid');
                        $("#error-unit-edit").html('');
                    }
                    if (response.error.ppns_id) {
                        $("#ppns_id_edit").addClass('is-invalid');
                        $("#error-ppns-edit").html(response.error.ppns_id);
                    } else {
                        $("#ppns_id_edit").removeClass('is-invalid');
                        $("#error-ppns-edit").html('');
                    }
                    if (response.error.status_id) {
                        $("#status_id_edit").addClass('is-invalid');
                        $("#error-status-edit").html(response.error.status_id);
                    } else {
                        $("#status_id_edit").removeClass('is-invalid');
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