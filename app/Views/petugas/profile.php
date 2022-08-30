<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Content Row -->
<div class="row">
    <div class="col-md-12">
        <!-- Collapsable Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Profile Petugas</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="/assets/img/logo2.png" class="img-thumbnail" alt="logo">
                        </div>
                        <div class=" col-md-8 table-responsive">
                            <table class="table">
                                <tr>
                                    <td>UKPD</td>
                                    <td>:</td>
                                    <td><?= session('ukpd') ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Petugas</td>
                                    <td>:</td>
                                    <td><?= $unit["nama"] ?></td>
                                </tr>
                                <tr>
                                    <td>NIP</td>
                                    <td>:</td>
                                    <td><?= $unit["nip_npjlp"] ?></td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td><?= $unit["jabatan"] ?></td>
                                </tr>
                                <tr>
                                    <td>Unit / Regu</td>
                                    <td>:</td>
                                    <td><?= session('username') ?></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td><?= session('username') ?></td>
                                </tr>
                                <tr>
                                    <td>Role Management</td>
                                    <td>:</td>
                                    <td><?= session('role_management') ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="3">Role Management</td>
                                </tr>
                                <tr>
                                    <td class="text-center" colspan="3"><img src="/<?= $unit["tanda_tangan_petugas"] ?>" alt="tanda_tangan" class="img-thumbnail"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content Row -->
<script src="/assets/vendor/jquery/jquery.min.js"></script>


<?= $this->endSection(); ?>