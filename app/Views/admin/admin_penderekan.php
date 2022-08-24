<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Master Data Penderekan <?= session('ukpd') ?></h6>
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                <div class="dropdown-header">Aksi:</div>
                <a href="/admin/penderekan/form_penderekan" class="dropdown-item"> <i class=" fa fa-plus"> </i> Tambah Penderekan</a>
            </div>

        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nomor BAPPK</th>
                        <th>Tanggal Penderekan</th>
                        <th>Jenis Kendaraan</th>
                        <th>Klasifikasi Kendaraan</th>
                        <th>Type Kendaraan</th>
                        <th>Nomor Kendaraan</th>
                        <th>Lokasi Penderekan (Nama Jalan)</th>
                        <th>Nama Pengemudi / Pelanggar</th>
                        <th>Alamat Pengemudi / Pelanggar</th>
                        <th>Tempat Penyimpanan Kendaraan</th>
                        <th style="text-align:center ;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($data_penderekan as $data_penderekan) : ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $data_penderekan["noBap"] ?></td>
                            <td><?= format_indo(date('Y-m-d', strtotime($data_penderekan["tanggal_penderekan"])))  ?></td>
                            <td><?= $data_penderekan["jenis_kendaraan"] ?></td>
                            <td><?= $data_penderekan["klasifikasi_kendaraan"] ?></td>
                            <td><?= $data_penderekan["type_kendaraan"] ?></td>
                            <td><?= $data_penderekan["nomor_kendaraan"] ?></td>
                            <td> Jl <?= $data_penderekan["nama_jalan"] ?></td>
                            <td><?= $data_penderekan["nama_pengemudi"] ?></td>
                            <td><?= $data_penderekan["alamat_pengemudi"] ?></td>
                            <td><?= $data_penderekan["tempat_penyimpanan"] ?></td>
                            <td style="text-align:center;">
                                <button class="btn btn-circle btn-sm btn-danger hapus" data-toggle="modal" data-target="#modalHapus" data-id="<?= $data_penderekan["id"] ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <a href="/admin/penderekan/edit_data/<?= $data_penderekan["noBap"] ?>" class="btn btn-circle btn-sm btn-warning edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="/pdf/bap_digital/<?= $data_penderekan["noBap"] ?>" class="btn btn-circle btn-sm btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
                <button type="button" class="btn btn-danger" id="delete">Hapus Data</button>
            </div>
        </div>
    </div>
</div>

<script src="/assets/vendor/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });


    $(".hapus").click(function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: '/admin/penderekan/edit',
            method: 'get',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(response) {
                $("#id_hapus").val(response.penderekan.id);
            }
        });
    });

    $("#delete").click(function(e) {
        e.preventDefault();
        let id = $('#id_hapus').val();
        $.ajax({
            url: '/admin/penderekan/hapus',
            type: 'post',
            dataType: 'json',
            data: {
                id: id
            },
            beforeSend: function() {
                $("#delete").html('<i class="fa fa-spinner fa-spin"> </i>');
                $("#delete").attr('disabled', 'disabled');
            },
            success: function(response) {
                $("#delete").html('Hapus Data');
                $("#delete").removeAttr('disabled', 'disabled');
                Swal.fire({
                    icon: 'success',
                    title: `${response.success}`
                });
                setTimeout(function() {
                    document.location.reload();
                }, 1500)
            },
            error: function() {
                $("#delete").html('Hapus Data');
                $("#delete").removeAttr('disabled', 'disabled');
                alert('Data Gagal di Hapus!');
            }
        });
    })
</script>
<?= $this->endSection(); ?>