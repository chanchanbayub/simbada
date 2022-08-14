<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>

<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Dropdown Card Example -->
<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Berita Acara Penderekan Pemindahan Kendaraan <?= session('username'); ?></h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No BAPPK</th>
                        <th>Unit / Regu</th>
                        <th>UKPD</th>
                        <th>Nama Dandru Derek</th>
                        <th>NIP</th>
                        <th>Nama PPNS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($bap as $bap) : ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td>
                                <a href="/petugas/penderekan/noBap/<?= $bap["noBap"] ?>"><?= $bap["noBap"] ?></a>
                            </td>
                            <td><?= $bap["unit_penindak"] ?></td>
                            <td><?= $bap["ukpd"] ?></td>
                            <td><?= $bap["nama"] ?></td>
                            <td><?= $bap["nip_npjlp"] ?></td>
                            <td><?= $bap["nama_ppns"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="/assets/vendor/jquery/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
<?= $this->endSection(); ?>