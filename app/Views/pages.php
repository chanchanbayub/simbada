<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SIMBADA LLAJ">
    <meta name="author" content="DINAS PERHUBUNGAN DKI JAKARTA">
    <meta name="keywords" content="DINAS PERHUBUNGAN, SIMBADALLAJ, SIMDALOPS">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.min.css"> -->

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="/assets/img/logo2.png" type="image/png">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="h4 text-gray-900 mb-4">Kendaraan di Derek ? <br> Cari Kendaraan</h1>
                            </div>
                            <form class="user" autocomplete="off">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" style="text-transform:uppercase ;" id="search" name="search" placeholder="Masukan Nomor Kendaraan">
                                    <span class="small"> Contoh : B 1234 XX</span>
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block search">
                                    <i class="fa fa-search"></i> Cari Kendaraan
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <span class="small"> <a href="/auth/login"> SIMDALOPS &copy; 2022 </a></span>
                            </div>
                            <div class="text-center">
                                <span class="small">Dinas Perhubungan Provinsi DKI Jakarta</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="modal-data" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img src="..." class="img-fluid" id="foto_kendaraan" alt="Responsive image">
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jenis Kendaraan</th>
                                    <th scope="col">Type Kendaraan</th>
                                    <th scope="col">Nomor Kendaraan</th>
                                    <th scope="col">Merk Kendaraan</th>
                                    <th scope="col">Warna Kendaraan</th>
                                    <th scope="col">Lokasi Penderekan</th>
                                    <th scope="col">Tanggal Penderekan</th>
                                    <th scope="col">Jam Penderekan</th>
                                    <th scope="col">Tempat Penyimpanan Kendaraan</th>
                                </tr>
                            </thead>
                            <tbody id="dataKendaraan">
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="text-center">
                        <a class="btn btn-primary" href="" target="_blank" id="whatsapp"> <i class="fab fa-whatsapp"></i> Ajukan Pengeluaran</a>
                        <a class="btn btn-success" href="" target="_blank" id="download"> <i class="fa fa-download"></i> Download BAP</a>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>

    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>

    <script>
        $(".user").submit(function(e) {
            e.preventDefault();
            let cari = $("#search").val();
            $.ajax({
                url: '/search',
                data: {
                    search: cari
                },
                dataType: 'json',
                method: 'post',
                beforeSend: function() {
                    $(".search").attr('disabled', 'disabled');
                    $(".search").html('<i class="fa fa-spinner fa-spin"> </i>')
                },
                success: function(response) {
                    $(".search").removeAttr('disabled', 'disabled');
                    $(".search").html(' <i class="fa fa-search"></i> Cari Kendaraan')
                    if (response.error) {
                        if (response.error.search) {
                            $("#search").addClass('is-invalid');
                            $(".small").html(response.error.search);
                        } else {
                            $("#search").removeAttr('is-invalid');
                            $(".small").html('Contoh : B 1234 XX');
                        }
                    } else if (response.success) {
                        // console.log(response);
                        if (response.dataKendaraan != null) {
                            $("#modal-data").modal('show');
                            $(".modal-title").html(response.success);
                            $("#foto_kendaraan").attr('src', `penderekan/${response.dataKendaraan.foto}`);
                            let table = `<tr> 
                                <td> 1. </td>
                                <td> ${response.dataKendaraan.jenis_kendaraan} </td>
                                <td> ${response.dataKendaraan.type_kendaraan} </td>
                                <td> ${response.dataKendaraan.nomor_kendaraan} </td>
                                <td> ${response.dataKendaraan.merk_kendaraan} </td>
                                <td> ${response.dataKendaraan.warna_kendaraan} </td>
                                <td> ${response.dataKendaraan.nama_jalan} </td>
                                <td> ${response.dataKendaraan.tanggal_penderekan} </td>
                                <td> ${response.dataKendaraan.jam_penderekan} </td>
                                <td> ${response.dataKendaraan.tempat_penyimpanan} </td>
                            </tr>`;

                            $("#dataKendaraan").html(table);

                            $("#download").attr('href', `/pdf/bap_digital/${response.dataKendaraan.noBap}`);
                            $("#whatsapp").attr('href', `https://api.whatsapp.com/send?phone=6285799200900&text=PARKIR%20${response.dataKendaraan.nomor_kendaraan}%20${response.dataKendaraan.nama_jalan}`);

                        } else {
                            alert('Tidak Ada Data');
                        }
                    }
                },
                error: function() {
                    $(".search").removeAttr('disabled', 'disabled');
                    $(".search").html(' <i class="fa fa-search"></i> Cari Kendaraan')
                    alert('SERVER ERROR');
                }
            });
        });
    </script>

</body>

</html>