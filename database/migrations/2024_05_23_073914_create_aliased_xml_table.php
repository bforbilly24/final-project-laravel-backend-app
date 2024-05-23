<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('xml_data', function (Blueprint $table) {
            $table->id();
            $table->string('A');
            $table->string('B');
            $table->string('C');
            $table->string('D');
            $table->string('E');
            $table->string('F');
            $table->string('G');
            $table->string('H');
            $table->string('I');
            $table->string('J');
            $table->string('K');
            $table->string('L');
            $table->string('M');
            $table->string('N');
            $table->string('O');
            $table->string('P');
            $table->string('Q');
            $table->string('R');
            $table->string('S');
            $table->string('T');
            $table->string('U');
            $table->string('V');
            $table->string('W');
            $table->string('X');
            $table->string('Y');
            $table->string('Z');
            $table->string('AA');
            $table->string('BB');
            $table->string('CC');
            $table->string('DD');
            $table->string('FF');
            $table->string('GG');
            $table->string('HH');
            $table->string('II');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('xml_data');
    }
};
