<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAliasedXmlDataTable extends Migration
{
    public function up()
    {
        Schema::create('aliased_xml_data', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_anggaran')->nullable();
            $table->string('kode_jenis_dokumen')->nullable();
            $table->string('kode_satker')->nullable();
            $table->string('kode_departemen')->nullable();
            $table->string('kode_unit')->nullable();
            $table->string('kode_program')->nullable();
            $table->string('kode_kegiatan')->nullable();
            $table->string('kode_output')->nullable();
            $table->string('kode_lokasi')->nullable();
            $table->string('kode_kabupaten_kota')->nullable();
            $table->string('kode_dekon')->nullable();
            $table->string('kode_soutput')->nullable();
            $table->string('kode_komponen')->nullable();
            $table->string('kode_skomponen')->nullable();
            $table->string('kode_akun')->nullable();
            $table->string('kode_kppn')->nullable();
            $table->string('kode_beban')->nullable();
            $table->string('kode_jenis_bantuan')->nullable();
            $table->string('kode_cara_tarik')->nullable();
            $table->string('register')->nullable();
            $table->string('cara_hitung')->nullable();
            $table->string('header1')->nullable();
            $table->string('header2')->nullable();
            $table->string('kode_header')->nullable();
            $table->integer('nomor_item')->nullable();
            $table->string('nama_item')->nullable();
            $table->integer('volume1')->nullable();
            $table->string('satuan1')->nullable();
            $table->integer('volume2')->nullable();
            $table->string('satuan2')->nullable();
            $table->integer('volume3')->nullable();
            $table->string('satuan3')->nullable();
            $table->integer('volume4')->nullable();
            $table->string('satuan4')->nullable();
            $table->decimal('volume_kegiatan', 9, 2)->nullable();
            $table->string('satuan_kegiatan')->nullable();
            $table->decimal('harga_satuan', 17, 2)->nullable();
            $table->decimal('jumlah', 15, 0)->nullable();
            $table->decimal('jumlah2', 15, 0)->nullable();
            $table->decimal('pagu_phln', 15, 0)->nullable();
            $table->decimal('pagu_rmp', 15, 0)->nullable();
            $table->decimal('pagu_rkp', 15, 0)->nullable();
            $table->string('kode_blokir')->nullable();
            $table->decimal('blokir_phln', 15, 0)->nullable();
            $table->decimal('blokir_rmp', 15, 0)->nullable();
            $table->decimal('blokir_rkp', 15, 0)->nullable();
            $table->decimal('rupiah_blokir', 15, 0)->nullable();
            $table->string('kode_copy')->nullable();
            $table->string('kode_abt')->nullable();
            $table->string('kode_sbu')->nullable();
            $table->decimal('volume_sbk', 14, 2)->nullable();
            $table->decimal('volume_rkakl', 14, 2)->nullable();
            $table->string('bulan_kontrak')->nullable();
            $table->string('nomor_kontrak')->nullable();
            $table->date('tanggal_kontrak')->nullable();
            $table->decimal('nilai_kontrak', 15, 0)->nullable();
            $table->decimal('januari', 15, 0)->nullable();
            $table->decimal('februari', 15, 0)->nullable();
            $table->decimal('maret', 15, 0)->nullable();
            $table->decimal('april', 15, 0)->nullable();
            $table->decimal('mei', 15, 0)->nullable();
            $table->decimal('juni', 15, 0)->nullable();
            $table->decimal('juli', 15, 0)->nullable();
            $table->decimal('agustus', 15, 0)->nullable();
            $table->decimal('september', 15, 0)->nullable();
            $table->decimal('oktober', 15, 0)->nullable();
            $table->decimal('november', 15, 0)->nullable();
            $table->decimal('desember', 15, 0)->nullable();
            $table->decimal('jumlah_tunda', 15, 0)->nullable();
            $table->string('kode_luncuran')->nullable();
            $table->decimal('jumlah_abt', 18, 0)->nullable();
            $table->string('nomor_revisi')->nullable();
            $table->string('kode_ubah')->nullable();
            $table->decimal('kurs', 4, 3)->nullable();
            $table->decimal('index_kpjm', 7, 4)->nullable();
            $table->string('kode_ib')->nullable();
            $table->string('kode_status')->nullable();
            $table->string('level_revisi')->nullable();
            $table->string('revisi_rkakl_ke')->nullable();
            $table->string('revisi_dipa_ke')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('aliased_xml_data');
    }
}
