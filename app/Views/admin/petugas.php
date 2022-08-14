<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Master Data Petugas</h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#tambah_petugas"> <i class="fa fa-plus"> </i> Tambah Petugas</button>
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
                        <th>Jabatan</th>
                        <th>Nama Petugas</th>
                        <th>NIP / NPJLP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($petugas as $petugas) : ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $petugas["ukpd"] ?></td>
                            <td><?= $petugas["unit_penindak"] ?></td>
                            <td><?= $petugas["jabatan"] ?></td>
                            <td><?= $petugas["nama"] ?></td>
                            <td><?= $petugas["nip_npjlp"] ?></td>
                            <td>
                                <button class="btn btn-circle btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus" data-id="<?= $petugas["id"] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button class="btn btn-circle btn-sm btn-warning edit" data-toggle="modal" data-target="#modalEdit" data-id="<?= $petugas["id"] ?>">
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

<div class="modal fade" id="tambah_petugas" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formPetugas" autocomplete="off">
                    <?= csrf_field(); ?>
                    <div class="form-group">
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
                        <label for="unit_id" class="col-form-label">Unit / Regu :</label>
                        <select name="unit_id" id="unit_id" class="form-control">
                            <option value="">--Silahkan Pilih--</option>
                            <?php foreach ($unit_penindak as $unit_penindak) : ?>
                                <option value="<?= $unit_penindak["id"] ?>"><?= $unit_penindak["unit_penindak"] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback" id="error-unit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama" class="col-form-label">Nama Petugas :</label>
                        <input class="form-control" id="nama" name="nama" type="text"></input>
                        <div class="invalid-feedback" id="error-nama">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nip_npjl" class="col-form-label">NIP / NPJLP :</label>
                        <input class="form-control" id="nip_npjlp" name="nip_npjlp" type="number"></input>
                        <div class="invalid-feedback" id="error-nip">

                        </div>
                    </div>
                    <div class="form-group">
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditPetugas" autocomplete="off">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <div class=" form-group">
                        <label for="ukpd_id_edit" class="col-form-label">UKPD :</label>
                        <select name="ukpd_id_edit" id="ukpd_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback" id="error-ukpd-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unit_id_edit" class="col-form-label">Unit / Regu :</label>
                        <select name="unit_id_edit" id="unit_id_edit" class="form-control">
                            <option value="">--Silahkan Pilih--</option>

                        </select>
                        <div class="invalid-feedback" id="error-unit-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_edit" class="col-form-label">Nama Petugas :</label>
                        <input class="form-control" id="nama_edit" name="nama_edit" type="text"></input>
                        <div class="invalid-feedback" id="error-nama-edit">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nip_npjlp_edit" class="col-form-label">NIP / NPJLP :</label>
                        <input class="form-control" id="nip_npjlp_edit" name="nip_npjlp" type="number"></input>
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

        $('#ukpd_id').select2({
            theme: "bootstrap4",
        });

        $('#unit_id').select2({
            theme: "bootstrap4",
        });

        $('#ukpd_id_edit').select2({
            theme: "bootstrap4",
        });

        $('#unit_id_edit').select2({
            theme: "bootstrap4",
        });

        $("#jabatan_id").select2({
            theme: "bootstrap4",
        });

        $("#jabatan_id_edit").select2({
            theme: "bootstrap4",
        });

    });

    $("#formPetugas").submit(function(e) {
        e.preventDefault();
        let ukpd_id = $("#ukpd_id").val();
        let unit_id = $("#unit_id").val();
        let nama = $("#nama").val();
        let nip_npjlp = $("#nip_npjlp").val();
        let jabatan_id = $("#jabatan_id").val();

        $.ajax({
            url: 'petugas/insert',
            method: 'post',
            dataType: 'json',
            data: {
                ukpd_id: ukpd_id,
                unit_id: unit_id,
                nama: nama,
                nip_npjlp: nip_npjlp,
                jabatan_id: jabatan_id
            },
            beforeSend: function() {
                $(".save").html('<i class="fa fa-spinner fa-spin"> </i>')
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
                        $("#ukpd_id").removeClass('is-invalid');
                        $("#error-ukpd").html('');
                    }
                    if (response.error.unit_id) {
                        $("#unit_id").addClass('is-invalid');
                        $("#error-unit").html(response.error.unit_id);
                    } else {
                        $("#unit_id").removeClass('is-invalid');
                        $("#error-unit").html('');
                    }
                    if (response.error.nama) {
                        $("#nama").addClass('is-invalid');
                        $("#error-nama").html(response.error.nama);
                    } else {
                        $("#nama").removeClass('is-invalid');
                        $("#error-nama").html('');
                    }
                    if (response.error.nip_npjlp) {
                        $("#nip_npjlp").addClass('is-invalid');
                        $("#error-nip").html(response.error.nip_npjlp);
                    } else {
                        $("#nip_npjlp").removeClass('is-invalid');
                        $("#error-nip").html('');
                    }
                    if (response.error.jabatan_id) {
                        $("#jabatan_id").addClass('is-invalid');
                        $("#error-jabatan").html(response.error.jabatan_id);
                    } else {
                        $("#jabatan_id").removeClass('is-invalid');
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
        $.ajax({
            url: 'petugas/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $("#id_hapus").val(response.petugas.id);
            }
        });
    });

    $("#delete").click(function(e) {
        e.preventDefault();
        let id = $("#id_hapus").val();
        // console.log(id);
        $.ajax({

            url: 'petugas/hapus',
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
                $("#delete").html('<i class="fa fa-paper-plane"></i>')
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

            url: 'petugas/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {

                let ukpd = '<option value =""> -- Silahkan Pilih -- </option>';

                response.ukpd.forEach(function(e) {
                    if (response.petugas.ukpd_id == e.id) {
                        ukpd += `<option value ="${e.id}" selected> ${e.ukpd} </option>`
                    } else {
                        ukpd += `<option value ="${e.id}"> ${e.ukpd} </option>`
                    }
                });
                $("#ukpd_id_edit").html(ukpd);

                let unit_penindak = '<option value =""> -- Silahkan Pilih -- </option>';
                response.unit_penindak.forEach(function(e) {
                    if (response.petugas.unit_id == e.id) {
                        unit_penindak += `<option value ="${e.id}" selected> ${e.unit_penindak} </option>`
                    } else {
                        unit_penindak += `<option value ="${e.id}"> ${e.unit_penindak} </option>`
                    }
                });

                $("#unit_id_edit").html(unit_penindak);

                let jabatan = '<option value =""> -- Silahkan Pilih -- </option>';
                response.jabatan.forEach(function(e) {
                    if (response.petugas.jabatan_id == e.id) {
                        jabatan += `<option value ="${e.id}" selected> ${e.jabatan} </option>`
                    } else {
                        jabatan += `<option value ="${e.id}"> ${e.jabatan} </option>`
                    }
                });

                $("#jabatan_id_edit").html(jabatan);

                $("#id").val(response.petugas.id);
                $("#nama_edit").val(response.petugas.nama);
                $("#nip_npjlp_edit").val(response.petugas.nip_npjlp);
            }
        });
    });

    $("#formEditPetugas").submit(function(e) {
        e.preventDefault();
        let id = $("#id").val();
        let ukpd_id = $("#ukpd_id_edit").val();
        let unit_id = $("#unit_id_edit").val();
        let nama = $("#nama_edit").val();
        let nip_npjlp = $("#nip_npjlp_edit").val();
        let jabatan_id = $("#jabatan_id_edit").val();

        $.ajax({
            url: 'petugas/update',
            method: 'post',
            dataType: 'json',
            data: {
                id: id,
                ukpd_id: ukpd_id,
                unit_id: unit_id,
                nama: nama,
                nip_npjlp: nip_npjlp,
                jabatan_id: jabatan_id,
            },
            beforeSend: function() {
                $(".update").html('<i class="fa fa-spinner"> </i>');
                $(".update").attr('disabled', 'disabled');
            },
            success: function(response) {
                $(".update").html('<i class="fa fa-paper-plane"></i> Kirim');
                $(".update").removeAttr('disabled', 'disabled');
                if (response.error) {
                    if (response.error.ukpd_id) {
                        $("#ukpd_id_edit").addClass('is-invalid');
                        $("#error-ukpd-edit").html(response.error.ukpd_id);
                    } else {
                        $("#ukpd_id_edit").removeClass('is-invalid');
                        $("#error-ukpd-edit").html('');
                    }
                    if (response.error.unit_id) {
                        $("#unit_id_edit").addClass('is-invalid');
                        $("#error-unit-edit").html(response.error.unit_id);
                    } else {
                        $("#unit_id_edit").removeClass('is-invalid');
                        $("#error-unit-edit").html('');
                    }
                    if (response.error.nama) {
                        $("#nama_edit").addClass('is-invalid');
                        $("#error-nama-edit").html(response.error.nama);
                    } else {
                        $("#nama_edit").removeClass('is-invalid');
                        $("#error-nama-edit").html('');
                    }
                    if (response.error.nip_npjlp) {
                        $("#nip_npjlp_edit").addClass('is-invalid');
                        $("#error-nip-edit").html(response.error.nip_npjlp);
                    } else {
                        $("#nip_npjlp_edit").removeClass('is-invalid');
                        $("#error-nip-edit").html('');
                    }
                    if (response.error.jabatan_id) {
                        $("#jabatan_id_edit").addClass('is-invalid');
                        $("#error-jabatan-edit").html(response.error.jabatan_id);
                    } else {
                        $("#jabatan_id_edit").removeClass('is-invalid');
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
            }
        });
    })
</script>
<?= $this->endSection(); ?>