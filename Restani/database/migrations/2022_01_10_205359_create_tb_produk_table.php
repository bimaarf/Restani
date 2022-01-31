<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_produk', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('key', 255);
            $table->text('desc');
            $table->string('harga', 255);
            $table->string('stok', 255);
            $table->string('foto', 255);
            $table->string('lokasi', 255);
            $table->bigInteger('rating')->nullable();
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('tb_kategori');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_produk');
    }
}
