<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned();
            $table->enum('tipe', ['aksi', 'posisi'] );
            $table->string('judul');
            $table->text('deskripsi');
            $table->dateTime('tanggal');
            $table->foreignId('kategori_id')->unsigned();
            $table->integer('jumlah_penerima')->nullable();
            $table->integer('jumlah_personil')->nullable();
            $table->string('nama_lembaga')->nullable();
            $table->string('nama_penanggungjawab')->nullable();
            $table->string('tlp_penanggungjawab')->nullable();
            $table->string('email_penanggungjawab')->nullable();
            $table->text('sektor')->nullable();
            $table->string('sektor_lain')->nullable();
            $table->string('spesialisasi')->nullable();
            $table->string('log_lat');
            $table->text('alamat');
            $table->string('tautan_berita')->nullable();
            $table->string('tautan_video')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aksis');
    }
}
