<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BERITA ACARA PEMINDAHAN DAN PENDEREKAN KENDARAAN</title>
    <link rel="shortcut icon" href="/assets/img/logo2.png" type="image/png">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            position: relative;
        }

        header {
            width: 100%;
            margin: 0 auto;
        }

        #kopSurat {
            width: 100%;
            margin: 0 auto;
            border-collapse: collapse;
            margin-bottom: -15px;
        }

        .logo {
            width: 75px;
        }

        #p1 {
            font-size: 18px;
            text-transform: uppercase;
            line-height: 15px;
            letter-spacing: 0px;
            font-style: normal;
        }

        #p2 {
            font-size: 24px;
            text-transform: uppercase;
            line-height: 15px;
            letter-spacing: 1px;
            font-weight: 900;
        }

        #p3 {
            font-size: 14px;
            letter-spacing: 1px;
            line-height: 15px;
        }

        #p4 {
            font-size: 14px;
            line-height: 15px;
            letter-spacing: 0px;
            font-style: normal;
        }

        #p5 {
            font-size: 12px;
            text-transform: capitalize;
            vertical-align: top;
            padding-right: 40px;
            padding-bottom: 5px;
        }

        p {
            font-style: normal;
        }

        hr {
            height: 2px;
            color: black;
        }

        .ttd {
            text-align: center;
        }

        #noSuratKend {
            margin: 0 auto;
            width: 100%;
            font-size: 14px;
            text-align: center;
        }

        #noSuratKend td {
            vertical-align: top;
        }

        .content-table {
            margin: 0 auto;
            width: 100%;
            text-align: justify;
        }

        .content-table td {
            padding: 5px 0;
        }

        .content-table td,
        p {
            line-height: 23px;
        }

        #data {
            width: 75%;
        }

        /* #data tr {
            padding: 3px 0;
        } */

        #data td {
            line-height: 23px;
        }

        .table-footer {
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
            position: relative;
        }

        .output {
            color: black;
        }

        .ttd_digital {
            width: 155px;
        }

        .ttd_cap {
            box-sizing: border-box;
            width: 180px;
            /* height: 0px; */
        }
    </style>
</head>

<body>
    <header>
        <table id="kopSurat">
            <tr>
                <td>
                    <img class="logo" src="assets/img/logo.png" alt="logo" />
                </td>
                <td align="center">
                    <p id="p1"> pemerintah daerah khusus ibu kota jakarta</p>
                    <p id="p2"> dinas perhubungan</p>
                    <p id="p3">Jalan Taman Jatibaru Nomor 1 Telepon 3501349 Faksimile 3455264</p>
                    <p id="p4">Website : www.dishub.jakarta.go.id E-mail : admsuratdishubdki@gmail.com </p>
                    <p id="p4">J A K A R T A</p>
                </td>
                <td>
                    <img class="logo" src="assets/img/logo2.png" alt="logo" />
                </td>
            </tr>
            <tr>
                <td colspan="3" align="right" id="p5">
                    Kode Pos : 10150
                </td>
            </tr>
        </table>
    </header>
    <hr>
    <div>
        <table id="noSuratKend">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td align="center">
                    <h2 style="text-align:center;"> BERITA ACARA</h2>
                    <h2 style="text-align:center;">PENDEREKAN PEMINDAHAN KENDARAAN</h2>
                </td>
                <td>
                    <p> No. <b style="color:red ;"> <?= $penderekan["noBap"] ?> </b></p>
                </td>
                <td>
                    <h3> <b style="color:red ;"></b></h3>
                </td>
            </tr>
        </table>
        <table class="content-table">
            <tr>
                <td>
                    <p style="text-align:justify;">Pada hari ini<b class="output"> <?= tanggal_indonesia(date('Y-m-d', strtotime($penderekan["tanggal_penderekan"]))) ?></b>, tanggal <b class="output"><?= date('d', strtotime($penderekan["tanggal_penderekan"])) ?></b>, bulan <b class="output"> <?= bulan(date('n', strtotime($penderekan["tanggal_penderekan"])))  ?> </b> tahun <b class="output"> <?= date('Y', strtotime($penderekan["tanggal_penderekan"])) ?> </b>pukul <b class="output"> <?= date('H:i', strtotime($penderekan["jam_penderekan"])) ?> </b> WIB, saya : <b class="output"><?= $penderekan["nama_ppns"] ?></b> NIP <b class="output"> <?= $penderekan["nip"] ?> </b> Selaku Penyidik Pegawai Negeri Sipil (PPNS) dari kantor tersebut di atas, bersama–sama dengan : <br> 1. <b class="output"><?= $penderekan["nama"] ?></b> <br> Masing–masing dari kantor yang sama, berdasarkan : --------------------------------------------------------------------------------------- Surat Tugas nomor <b class="output">437 / PH.06.00 </b> tanggal <b class="output"> 31 Maret 2023</b> tentang <b class="output">PENDEREKAN</b><b>.</b> <br> Telah melakukan penderekan kendaraan sesuai Perda 5 Tahun 2014 tentang Transportasi di Jl ------------------------- <b class="output"><?= $penderekan['nama_jalan'] ?></b> ------------------------- dengan keterangan sebagai berikut :</p>
                </td>
            </tr>
        </table>
        <table id="data">
            <tr>
                <td>Nama Pelanggar / Pengemudi </td>
                <td>:</td>
                <td> <b class="output"> <?= $penderekan["nama_pengemudi"] ?> </b></td>
            </tr>
            <tr>
                <td>NIK/SIM/PASPOR</td>
                <td>:</td>
                <td> <b class="output"> <?= $penderekan["nomor_identitas_pengemudi"] ?></b> </td>
            </tr>
            <tr>
                <td>Jenis Kendaraan </td>
                <td>:</td>
                <td> <b class="output"> <?= $penderekan["klasifikasi_kendaraan"] ?> </b></td>
            </tr>
            <tr>
                <td>Merek Kendaraan </td>
                <td>:</td>
                <td> <b class="output"><?= $penderekan["merk_kendaraan"] ?> </b></td>
            </tr>
            <tr>
                <td>Warna Kendaraan</td>
                <td>:</td>
                <td> <b class="output"> <?= $penderekan["warna_kendaraan"] ?> </b></td>
            </tr>
            <tr>
                <td>Nomor Handphone</td>
                <td>:</td>
                <td> <b class="output"> <?= $penderekan["nomor_handphone_pengemudi"] ?> </b></td>
            </tr>
            <tr>
                <td>TNKB</td>
                <td>:</td>
                <td> <b class="output"> <?= $penderekan["nomor_kendaraan"] ?></b></td>
            </tr>
            <tr>
                <td>Jenis Pelanggaran</td>
                <td>:</td>
                <td> <b class="output"> <?= $penderekan["keterangan"] ?> </b></td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <p>Terhadap Kendaraan tersebut dilakukan pemindahan ke Tempat Penyimpanan Kendaraan : <b class="output"><?= $penderekan["tempat_penyimpanan"] ?></b><b>.</b></p>
                </td>
            </tr>
        </table>
        <table class="content-table">
            <tr>
                <td>
                    <p>----------Untuk pengeluaran kendaraan saudara diwajibkan membayar Retribusi sesuai Perda 1 Tahun 2015 tentang Perubahan Atas Perda 3 Tahun 2012 tentang Retribusi Daerah dan menyelesaikan administrasi Pengeluaran Kendaraan, selanjutnya pengambilan kendaraan dilakukan di Tempat Penyimpanan Kendaraan atas.
                        <br> ----------Demikian Berita Acara Penderekan Pemindahan Kendaraan ini dibuat dengan sebenar benarnya atas kekuatan sumpah jabatan, kemudian ditutup dan ditandatangani di <b class="output">Jakarta</b> pada tanggal <b class="output"> <?= date_indo(date('Y-m-d', strtotime($penderekan["tanggal_penderekan"]))) ?></b><b>.</b>
                    </p>
                </td>
            </tr>
        </table>
        <br>
        <table class="table-footer" align="center">
            <tr>
                <td align="center">Saksi</td>
                <td align="center">Pelanggar</td>
                <td align="center">Penyidik Pegawai Negeri Sipil</td>
            </tr>
            <tr>
                <td align="center"><img class="ttd_digital" src="<?= $penderekan["tanda_tangan_petugas"] ?>" alt="tanda_tangan_petugas"> </td>
                <td align="center"><img class="ttd_digital" src="<?= $penderekan["ttd_digital"] ?>" alt="tanda_tangan_saksi"></td>
                <td align="center"><img class="ttd_digital" src="<?= $penderekan["tanda_tangan"] ?>" alt="tanda_tangan_ppns"></td>
            </tr>
            <tr>
                <td align="center">
                    <p>( <b class="output"><?= $penderekan["nama"] ?></b> )<br> <b class="output">NIP / NRK : <?= $penderekan["nip_npjlp"] ?> </p>
                </td>
                <td align="center">
                    <p>( <b class="output"> <?= $penderekan["nama_pengemudi"] ?></b> )</p>
                </td>
                <td align="center">
                    <p>( <b class="output"> <?= $penderekan["nama_ppns"] ?> </b> ) <br> <b class="output">NIP : <?= $penderekan["nip"] ?> </b></p>
                </td>
            </tr>
        </table>

        <img src="assets/img/cap.png" class="ttd_cap" style="margin-left:380px; margin-top:-180px;" alt="cap">

    </div>
</body>

</html>