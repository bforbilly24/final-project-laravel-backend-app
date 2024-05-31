<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAliasedXmlDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aliased_xml_data', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_anggaran', 4);
            $table->string('kode_jenis_dokumen', 2);
            $table->string('kode_satker', 6);
            $table->string('kode_dept', 3);
            $table->string('kode_unit', 2);
            $table->string('kode_program', 2);
            $table->string('kode_giat', 4);
            $table->string('kode_output', 3);
            $table->string('kode_lokasi', 2);
            $table->string('kode_kabupaten', 2);
            $table->string('kode_dekon', 1);
            $table->string('kode_sub_output', 3);
            $table->string('kode_komponen', 3);
            $table->string('kode_sub_komponen', 2);
            $table->string('kode_akun', 6);
            $table->string('kode_kppn', 3);
            $table->string('kode_beban', 1);
            $table->string('kode_jenis_bantuan', 1);
            $table->string('kode_cara_tarik', 1);
            $table->string('register', 8);
            $table->string('cara_hitung', 1);
            $table->decimal('prosentase_phln', 3, 0)->nullable();
            $table->decimal('prosentase_rkp', 3, 0)->nullable();
            $table->decimal('prosentase_rmp', 3, 0)->nullable();
            $table->string('kppn_rkp', 3)->nullable();
            $table->string('kppn_rmp', 3)->nullable();
            $table->string('kppn_phln', 3)->nullable();
            $table->string('reg_dam', 8)->nullable();
            $table->string('kode_luncuran', 1)->nullable();
            $table->string('kode_blokir', 1)->nullable();
            $table->string('uraian_blokir', 100)->nullable();
            $table->string('kode_ib', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aliased_xml_data');
    }
}
