<?= $this->extend('template/layout'); ?>
<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
<!-- Content Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                Detail Data Kendaraan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="card " style="width: 18rem;">
                            <img src="/penderekan/<?= $penderekan["foto"] ?>" class="img-fluid img-thumbnail" alt="Foto Kendaraan" width="250">
                        </div>
                    </div>
                    <div class="col-md-8 table-responsive">
                        <table class="table">
                            <tr>
                                <td>Jenis Kendaraan</td>
                                <td>:</td>
                                <td><?= $penderekan["jenis_kendaraan"] ?></td>
                            </tr>
                            <tr>
                                <td>Klasifikasi Kendaraan</td>
                                <td>:</td>
                                <td><?= $penderekan["klasifikasi_kendaraan"] ?></td>
                            </tr>
                            <tr>
                                <td>Type Kendaraan</td>
                                <td>:</td>
                                <td><?= $penderekan["type_kendaraan"] ?></td>
                            </tr>
                            <tr>
                                <td>Merk Kendaraan</td>
                                <td>:</td>
                                <td><?= $penderekan["merk_kendaraan"] ?></td>
                            </tr>
                            <tr>
                                <td>Nomor Kendaraan</td>
                                <td>:</td>
                                <td><?= $penderekan["nomor_kendaraan"] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Pelanggar -->
        <div class="card mb-4">
            <div class="card-header">
                Detail Data Penderekan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table">
                            <tr>
                                <td>Provinsi</td>
                                <td>:</td>
                                <td><?= $penderekan["provinsi"] ?></td>
                            </tr>
                            <tr>
                                <td>Kota / Kabupaten</td>
                                <td>:</td>
                                <td><?= $penderekan["kabupaten_kota"] ?></td>
                            </tr>
                            <tr>
                                <td>Kecamatan</td>
                                <td>:</td>
                                <td><?= $penderekan["kecamatan"] ?></td>
                            </tr>
                            <tr>
                                <td>Kelurahan</td>
                                <td>:</td>
                                <td><?= $penderekan["kelurahan"] ?></td>
                            </tr>
                            <tr>
                                <td>Nama Jalan</td>
                                <td>:</td>
                                <td><?= $penderekan["nama_jalan"] ?></td>
                            </tr>
                            <tr>
                                <td>Nama Gedung</td>
                                <td>:</td>
                                <td><?= $penderekan["nama_gedung"] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Pelanggar -->
        <div class="card mb-4">
            <div class="card-header">
                Detail Data Pelanggar / WR
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="/<?= $penderekan["foto_pelanggar"] ?>" class="img-fluid img-thumbnail" alt="foto_saat_tanda_tangan">
                            <img src="/<?= $penderekan["ttd_digital"] ?>" class="img-fluid img-thumbnail" alt="Tanda Tangan Pelanggar">
                            <p class="text-center">Tanda Tangan Pelanggar</p>
                        </div>
                    </div>
                    <div class="col-md-8 table-responsive">
                        <table class="table">
                            <tr>
                                <td>Nama Pelanggar</td>
                                <td>:</td>
                                <td><?= $penderekan["nama_pengemudi"] ?></td>
                            </tr>
                            <tr>
                                <td>Alamat Pelanggar</td>
                                <td>:</td>
                                <td><?= $penderekan["alamat_pengemudi"] ?></td>
                            </tr>
                            <tr>
                                <td>Nomor Indentitas Pelanggar</td>
                                <td>:</td>
                                <td><?= $penderekan["nomor_identitas_pengemudi"] ?></td>
                            </tr>
                            <tr>
                                <td>Nomor Handphone Pelanggar</td>
                                <td>:</td>
                                <td><?= $penderekan["nomor_handphone_pengemudi"] ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Content Row -->
<script src="/assets/vendor/jquery/jquery.min.js"></script>

<?= $this->endSection(); ?>