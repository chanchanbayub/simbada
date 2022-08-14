<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            SISA BAP</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahBap ?> Lembar</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-book fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Jumlah Penderekan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahPenderekan ?> Kendaraan</div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-car fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<script src="/assets/vendor/jquery/jquery.min.js"></script>

<?= $this->endSection(); ?>