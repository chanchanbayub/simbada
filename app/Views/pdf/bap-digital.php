<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BERITA ACARA PEMINDAHAN DAN PENDEREKAN KENDARAAN</title>
    <link rel="shortcut icon" href="/assets/img/logo2.png" type="image/png">
</head>
<style>
    * {
        overflow: auto;
    }

    header {
        width: 100%;
        margin: 0 auto;
        /* border: 1px solid black; */
    }

    #kopSurat {
        width: 100%;
        margin: 0 auto;
        border-collapse: collapse;
        margin-bottom: -15px;
        position: relative;
        top: 0;
        left: 0;
        z-index: 0;
    }

    .logo {
        width: 75px;
    }

    #p1 {
        font-size: 18px;
        text-transform: uppercase;
        font-family: Arial;
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
        font-family: Arial, Helvetica, sans-serif;
    }

    #p4 {
        font-size: 14px;
        line-height: 15px;
        letter-spacing: 0px;
        font-style: normal;
        font-family: Arial, Helvetica, sans-serif;
    }

    #p5 {
        font-size: 12px;
        text-transform: capitalize;
        vertical-align: top;
        /* border: 1px solid black; */
        padding-right: 40px;
        padding-bottom: 5px;
    }

    /* #divine {
		border: 300px solid black;
	} */
    hr {
        height: 2px;
        color: black;

        /* border: 10px solid black; */
    }

    .ttd {
        text-align: center;
    }

    #noSuratKend {
        margin: 0 auto;
        width: 100%;
        font-size: 14px;
        text-align: center;
        /* margin-top: -10px; */
        font-family: Arial;
    }

    #noSuratKend td {
        vertical-align: top;
    }

    .content {
        margin: 0 auto;
        font-family: Arial, Helvetica, sans-serif;
        width: 100%;
        text-align: justify;
        /* padding-top: 3px; */
        /* border: 1px solid black; */
    }

    .content p {
        font-size: 12px;
    }

    .content-table {
        margin: 0 auto;
        font-family: Arial, Helvetica, sans-serif;
        width: 100%;
        text-align: justify;
        /* padding-top: 3px; */
        /* border: 1px solid black; */
    }

    .paragraf-table {
        padding-left: 21px;
        font-family: Arial, Helvetica, sans-serif;
        /* border: 1px solid black; */
        width: 100%;
        font-size: 12px;
    }

    .catatan {
        padding-left: 21px;
        font-family: Arial, Helvetica, sans-serif;
        /* border: 1px solid black; */
        width: 100%;
        /* font-size: 12px; */
    }

    .table-footer {
        /* border: 1px solid black; */
        margin: 0 auto;
        font-family: Arial, Helvetica, sans-serif;
        width: 100%;
        border-spacing: 2px;
        /* text-align: center; */
        /* border: 1px solid black; */
    }

    .output {
        color: blue;
    }

    img {
        box-sizing: border-box;
    }

    .ttd_digital {
        width: 155px;

    }

    #tanda_tangan {
        overflow: auto;
        box-sizing: border-box;
    }

    /* .table-footer td {
		text-align: center;
	} */
</style>

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
                    <h2 style="text-align:center; "> BERITA ACARA</h2>
                    <br>
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
        <p style="text-align:justify;">Pada hari ini<b class="output"> <?= tanggal_indonesia(date('Y-m-d', strtotime($penderekan["tanggal_penderekan"]))) ?></b>, tanggal <b class="output"><?= date('d', strtotime($penderekan["tanggal_penderekan"])) ?></b>, bulan <b class="output"> <?= bulan(date('n', strtotime($penderekan["tanggal_penderekan"])))  ?> </b> tahun <b class="output"> <?= date('Y', strtotime($penderekan["tanggal_penderekan"])) ?> </b>pukul <b class="output"> <?= date('H:i', strtotime($penderekan["jam_penderekan"])) ?> </b> WIB, saya : <b class="output"><?= $penderekan["nama_ppns"] ?></b> NIP <b class="output"> <?= $penderekan["nip"] ?> </b> Selaku Penyidik Pegawai Negeri Sipil (PPNS) dari kantor tersebut diatas, bersama–sama dengan :
        </p>
        <table class="content">
            <tr>
                <td>
                    <p>1. <b class="output"><?= $penderekan["nama"] ?></b> / </p>
                    <p>2. <b class="output"><?= $penderekan["nama_saksi"] ?></b> /</p>
                    <p>Masing–masing dari kantor yang sama, berdasarkan : ---------------------------------------------------------------------------------------- Surat Tugas nomor <b class="output">583</b> / <b class="output">1811</b> / <b class="output"> 231 </b> tanggal <b class="output"> 31 Juli 2022</b> tentang -----------------------------------------------------------------------------------
                        <b class="output"> PENDEREKAN </b>---------------------------------------------------------
                    </p>
                    </p>
                </td>
            </tr>
        </table>
        <table class="content-table">
            <tr>
                <td>
                    <p>Telah melakukan penderekan kendaraan sesuai dengan Perda 5 Tahun 2014 Tentang Transportasi di Jl ------------------------- <b class="output"><?= $penderekan['nama_jalan'] ?></b> ------------------------- dengan keterangan sebagai berikut :</p>
                </td>
            </tr>
        </table>
        <table>
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
                <td> <b class="output"><?= $penderekan["jenis_kendaraan"]  ?> / <?= $penderekan["klasifikasi_kendaraan"] ?> / <?= $penderekan["merk_kendaraan"] ?> </b></td>
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
        <br>
        <table class="content-table">
            <tr>
                <td>
                    <p>Kendaraan tersebut dilakukan pemindahan ke tempat penyimpanan kendaraan : <b class="output"> <?= $penderekan["tempat_penyimpanan"] ?> </b></p>
                </td>
            </tr>
        </table>

        <table class="content-table">
            <tr>
                <td>
                    <p>----------Untuk pengeluaran kendaraan saudara diwajibkan membayar Retribusi sesuai Perda 1 tahun 2015 tentang perubahan atas Perda 3 tahun 2012 tentang Retribusi Daerah dan menyelesaikan administrasi Pengeluaran Kendaraan, selanjutnya pengambilan kendaraan dilakukan sebagaimana tempat penyimpanan kendaraan atas.
                        <br> ----------Demikian Berita Acara Penderekan Pemindahan Kendaraan ini dibuat dengan sebenarbenarnya atas kekuatan sumpah jabatan, kemudian ditutup dan ditandatangani di <b class="output">Jakarta</b> pada tanggal <b class="output"> <?= date_indo(date('Y-m-d', strtotime($penderekan["tanggal_penderekan"]))) ?> </b>
                    </p>
                </td>
            </tr>
        </table>
        <table class="table-footer" align="center">
            <tr>
                <td align="center">Petugas Lapangan</td>
                <td align="center">Saksi</td>
                <td align="center">Pengemudi</td>
            </tr>
            <tr>
                <td align="center"><img class="ttd_digital" src="<?= $penderekan["tanda_tangan_petugas"] ?>" alt="tanda_tangan_petugas"></td>
                <td align="center"><img class="ttd_digital" src="<?= $penderekan["tanda_tangan_saksi"] ?>" alt="tanda_tangan_saksi"></td>
                <td align="center"><img class="ttd_digital" src="<?= $penderekan["ttd_digital"] ?>" alt="ttd_pengemudi"></td>
            </tr>
            <tr>
                <td align="center">
                    <p>( <b class="output"><?= $penderekan["nama"] ?></b> )</p>
                </td>
                <td align="center">
                    <p>( <b class="output"><?= $penderekan["nama_saksi"] ?></b> )</p>
                </td>
                <td align="center">
                    <p>( <b class="output"> <?= $penderekan["nama_pengemudi"] ?></b> )</p>
                </td>
            </tr>
        </table>
        <p style="text-align: center;">Mengetahui, <br> Penyidik Pegawai Negeri Sipil </p>
        <div class="ttd">
            <img class="ttd_digital" src="<?= $penderekan["tanda_tangan"] ?>" alt="tanda_tangan_ppns">
        </div>
        <p style=" text-align: center;">( <b class="output"> <?= $penderekan["nama_ppns"] ?> </b> )
            <br> <b class="output">NIP : <?= $penderekan["nip"] ?> </b>
        </p>
    </div>
</body>

</html>