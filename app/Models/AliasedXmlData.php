<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AliasedXmlData extends Model
{
    use HasFactory;

    protected $table = 'aliased_xml_data';

    protected $fillable = [
        'tahun_anggaran', 'kode_jenis_dokumen', 'kode_satker', 'kode_dept', 'kode_unit', 
        'kode_program', 'kode_giat', 'kode_output', 'kode_lokasi', 'kode_kabupaten', 
        'kode_dekon', 'kode_sub_output', 'kode_komponen', 'kode_sub_komponen', 'kode_akun', 
        'kode_kppn', 'kode_beban', 'kode_jenis_bantuan', 'kode_cara_tarik', 'register', 
        'cara_hitung', 'prosentase_phln', 'prosentase_rkp', 'prosentase_rmp', 'kppn_rkp', 
        'kppn_rmp', 'kppn_phln', 'reg_dam', 'kode_luncuran', 'kode_blokir', 'uraian_blokir', 'kode_ib'
    ];
}
