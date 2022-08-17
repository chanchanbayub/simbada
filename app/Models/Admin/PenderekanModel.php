<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class PenderekanModel extends Model
{
    protected $table            = 'penderekan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['ukpd_id', 'bap_id', 'tanggal_penderekan', 'jam_penderekan', 'jenis_pelanggaran_id', 'tempat_penyimpanan_kendaraan_id', 'saksi_id'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $fieldTable = 'penderekan.id, penderekan.ukpd_id, penderekan.bap_id, penderekan.tanggal_penderekan, penderekan.jam_penderekan, penderekan.tempat_penyimpanan_kendaraan_id,  bap.noBap, kendaraan.merk_kendaraan, warna_kendaraan, nomor_kendaraan, jenis_kendaraan.jenis_kendaraan, klasifikasi_kendaraan.klasifikasi_kendaraan, type_kendaraan, nama_jalan, nama_gedung, nomor_identitas_pengemudi, nama_pengemudi, alamat_pengemudi, nomor_handphone_pengemudi, ttd_digital, tempat_penyimpanan, keterangan, nama_ppns, nip, tanda_tangan, nama, tanda_tangan_petugas, saksi_penderekan.nama_saksi, tanda_tangan_saksi.tanda_tangan_saksi, kendaraan.nomor_kendaraan, warna_kendaraan, merk_kendaraan';

    protected $editTable = 'penderekan.id, penderekan.ukpd_id, penderekan.bap_id, penderekan.tanggal_penderekan, penderekan.jam_penderekan, penderekan.jenis_pelanggaran_id, penderekan.tempat_penyimpanan_kendaraan_id, penderekan.saksi_id, bap.noBap, bap.ppns_id, kendaraan.jenis_kendaraan_id, kendaraan.klasifikasi_kendaraan_id, kendaraan.type_kendaraan_id, kendaraan.merk_kendaraan,kendaraan.nomor_kendaraan, kendaraan.warna_kendaraan, foto_kendaraan.foto, foto_kendaraan.mime , lokasi_penderekan.provinsi_id, lokasi_penderekan.kota_id, lokasi_penderekan.kecamatan_id, lokasi_penderekan.kelurahan_id, lokasi_penderekan.nama_jalan, lokasi_penderekan.nama_gedung, nomor_identitas_pengemudi, nama_pengemudi, alamat_pengemudi, nomor_handphone_pengemudi, ttd_digital, unit_penindak.unit_penindak';

    public function getDataPenderekan($ukpd_id)
    {
        return $this->db->table($this->table)
            ->select($this->fieldTable)
            ->where(['penderekan.ukpd_id' => $ukpd_id])
            ->join('bap', 'bap.id = penderekan.bap_id')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('kendaraan', 'kendaraan.id_penderekan = penderekan.id')
            ->join('jenis_kendaraan', 'kendaraan.jenis_kendaraan_id = jenis_kendaraan.id')
            ->join('klasifikasi_kendaraan', 'klasifikasi_kendaraan.id = kendaraan.klasifikasi_kendaraan_id')
            ->join('type_kendaraan', 'type_kendaraan.id = kendaraan.type_kendaraan_id')
            ->join('lokasi_penderekan', 'lokasi_penderekan.id_penderekan = penderekan.id')
            ->join('identitas_pengemudi', 'identitas_pengemudi.id_penderekan = penderekan.id')
            ->join('tempat_penyimpanan', 'tempat_penyimpanan.id = penderekan.tempat_penyimpanan_kendaraan_id')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id = penderekan.jenis_pelanggaran_id')
            ->join('ppns', 'ppns.id = bap.ppns_id')
            ->join('tanda_tangan_ppns', 'tanda_tangan_ppns.ppns_id = ppns.id')
            ->join('petugas', 'petugas.unit_id = unit_penindak.id')
            ->join('tanda_tangan_petugas', 'petugas.id = tanda_tangan_petugas.petugas_id')
            ->join('saksi_penderekan', 'saksi_penderekan.id = penderekan.saksi_id')
            ->join('tanda_tangan_saksi', 'saksi_penderekan.id = tanda_tangan_saksi.saksi_id')
            ->orderBy('penderekan.id desc')
            ->get()->getResultArray();
    }

    public function getBapDigital($noBap)
    {
        return $this->table($this->table)
            // ->select($this->fieldTable)
            ->join('bap', 'bap.id = penderekan.bap_id')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('kendaraan', 'kendaraan.id_penderekan = penderekan.id')
            ->join('jenis_kendaraan', 'jenis_kendaraan.id = kendaraan.jenis_kendaraan_id')
            ->join('klasifikasi_kendaraan', 'klasifikasi_kendaraan.id = kendaraan.klasifikasi_kendaraan_id')
            ->join('type_kendaraan', 'type_kendaraan.id = kendaraan.type_kendaraan_id')
            ->join('lokasi_penderekan', 'lokasi_penderekan.id_penderekan = penderekan.id')
            ->join('identitas_pengemudi', 'identitas_pengemudi.id_penderekan = penderekan.id')
            ->join('tempat_penyimpanan', 'tempat_penyimpanan.id = penderekan.tempat_penyimpanan_kendaraan_id')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id = penderekan.jenis_pelanggaran_id')
            ->join('ppns', 'ppns.id = bap.ppns_id')
            ->join('tanda_tangan_ppns', 'tanda_tangan_ppns.ppns_id = ppns.id')
            ->join('petugas', 'petugas.unit_id = unit_penindak.id')
            ->join('tanda_tangan_petugas', 'petugas.id = tanda_tangan_petugas.petugas_id')
            ->join('saksi_penderekan', 'saksi_penderekan.id = penderekan.saksi_id')
            ->join('tanda_tangan_saksi', 'saksi_penderekan.id = tanda_tangan_saksi.saksi_id')
            ->where(["noBap" => $noBap])
            ->orderBy('penderekan.id desc')
            ->get()->getRowArray();
    }

    public function editDataPenderekan($noBap)
    {
        return $this->table($this->table)
            ->select($this->editTable)
            ->join('bap', 'bap.id = penderekan.bap_id')
            ->where(['bap.noBap' => $noBap])
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            ->join('kendaraan', 'kendaraan.id_penderekan = penderekan.id')
            ->join('jenis_kendaraan', 'kendaraan.jenis_kendaraan_id = jenis_kendaraan.id')
            ->join('klasifikasi_kendaraan', 'kendaraan.klasifikasi_kendaraan_id = klasifikasi_kendaraan.id')
            ->join('type_kendaraan', 'kendaraan.type_kendaraan_id = type_kendaraan.id')
            ->join('foto_kendaraan', 'penderekan.id = foto_kendaraan.id_penderekan')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id = penderekan.jenis_pelanggaran_id')
            ->join('lokasi_penderekan', 'penderekan.id = lokasi_penderekan.id_penderekan')
            ->join('identitas_pengemudi', 'penderekan.id = identitas_pengemudi.id_penderekan')
            // ->join('tempat_penyimpanan', 'tempat_penyimpanan.id = penderekan.tempat_penyimpanan_kendaraan_id')

            // ->join('ppns', 'ppns.id = bap.ppns_id')
            // ->join('tanda_tangan_ppns', 'tanda_tangan_ppns.ppns_id = ppns.id')
            // ->join('petugas', 'petugas.unit_id = unit_penindak.id')
            // ->join('tanda_tangan_petugas', 'petugas.id = tanda_tangan_petugas.petugas_id')
            // ->join('saksi_penderekan', 'saksi_penderekan.id = penderekan.saksi_id')
            // ->join('tanda_tangan_saksi', 'saksi_penderekan.id = tanda_tangan_saksi.saksi_id')
            ->orderBy('penderekan.id desc')
            ->get()->getRowArray();
    }

    public function getJumlahPenderekan($date)
    {
        return $this->table($this->table)
            ->select($this->editTable)
            ->join('bap', 'bap.id = penderekan.bap_id')
            ->join('unit_penindak', 'unit_penindak.id = bap.unit_id')
            // ->where(['unit_penindak' => $username])
            ->where(['tanggal_penderekan' => $date])
            ->join('kendaraan', 'kendaraan.id_penderekan = penderekan.id')
            ->join('jenis_kendaraan', 'kendaraan.jenis_kendaraan_id = jenis_kendaraan.id')
            ->join('klasifikasi_kendaraan', 'kendaraan.klasifikasi_kendaraan_id = klasifikasi_kendaraan.id')
            ->join('type_kendaraan', 'kendaraan.type_kendaraan_id = type_kendaraan.id')
            ->join('foto_kendaraan', 'penderekan.id = foto_kendaraan.id_penderekan')
            ->join('jenis_pelanggaran', 'jenis_pelanggaran.id = penderekan.jenis_pelanggaran_id')
            ->join('lokasi_penderekan', 'penderekan.id = lokasi_penderekan.id_penderekan')
            ->join('identitas_pengemudi', 'penderekan.id = identitas_pengemudi.id_penderekan')
            ->orderBy('penderekan.id desc')
            ->countAllResults();
    }
}
