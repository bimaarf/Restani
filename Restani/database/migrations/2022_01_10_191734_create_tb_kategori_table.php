<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kategori', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->timestamps();
        });
        Category::insert([
            ['name'  => 'Sayur'],
            ['name'  => 'Buah'],
            ['name'  => 'Rempah'],
            ['name'  => 'Umbi'],
            ['name'  => 'Kacang-kacangan'],
            ['name'  => 'Daging'],
            ['name'  => 'Ikan'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kategori');
    }
}
