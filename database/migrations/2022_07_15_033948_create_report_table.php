<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rep_tahun', function (Blueprint $table) {
            $table->id('id_thn');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->year('thn');
            $table->timestamps();
        });
        Schema::create('rep_saldo_periode', function (Blueprint $table) {
            $table->id('id_periode');
            $table->unsignedBigInteger('id_thn');
            $table->foreign('id_thn')->references('id_thn')->on('rep_tahun')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('bulan', 50);
            $table->decimal('saldo_awal', 12);
            $table->decimal('sisa_saldo', 12);
            $table->string('ket', 100);
            $table->timestamps();
        });
        Schema::create('rep_kas', function (Blueprint $table) {
            $table->id('id_kas');
            $table->unsignedBigInteger('id_periode');
            $table->foreign('id_periode')->references('id_periode')->on('rep_saldo_periode')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->date('tanggal');
            $table->text('kebutuhan');
            $table->enum('tipe', ['debit', 'kredit']);
            $table->decimal('jml_uang', 12);
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
        Schema::dropIfExists('rep_kas');
        Schema::dropIfExists('rep_saldo_periode');
        Schema::dropIfExists('rep_tahun');
        Schema::dropIfExists('users');
    }
};
