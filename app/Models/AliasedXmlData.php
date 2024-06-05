<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AliasedXmlData extends Model
{
    use HasFactory;

    protected $table = 'aliased_xml_data';

    protected $fillable = [
        'tahun_anggaran', 'kode_jenis_dokumen', 'kode_satker', 'kode_departemen',
        'kode_unit', 'kode_program', 'kode_kegiatan', 'kode_output', 'kode_lokasi',
        'kode_kabupaten_kota', 'kode_dekon', 'kode_soutput', 'kode_komponen',
        'kode_skomponen', 'kode_akun', 'kode_kppn', 'kode_beban', 'kode_jenis_bantuan',
        'kode_cara_tarik', 'register', 'cara_hitung', 'header1', 'header2', 'kode_header',
        'nomor_item', 'nama_item', 'volume1', 'satuan1', 'volume2', 'satuan2',
        'volume3', 'satuan3', 'volume4', 'satuan4', 'volume_kegiatan', 'satuan_kegiatan',
        'harga_satuan', 'jumlah', 'jumlah2', 'pagu_phln', 'pagu_rmp', 'pagu_rkp',
        'kode_blokir', 'blokir_phln', 'blokir_rmp', 'blokir_rkp', 'rupiah_blokir',
        'kode_copy', 'kode_abt', 'kode_sbu', 'volume_sbk', 'volume_rkakl',
        'bulan_kontrak', 'nomor_kontrak', 'tanggal_kontrak', 'nilai_kontrak', 'januari',
        'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september',
        'oktober', 'november', 'desember', 'jumlah_tunda', 'kode_luncuran', 'jumlah_abt',
        'nomor_revisi', 'kode_ubah', 'kurs', 'index_kpjm', 'kode_ib', 'kode_status',
        'level_revisi', 'revisi_rkakl_ke', 'revisi_dipa_ke'
    ];
}
