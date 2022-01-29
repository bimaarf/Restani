<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_telp', 20);
            $table->string('jenis_kelamin');
            $table->string('avatar', 255)->default('default.jpg');
            $table->rememberToken();
            $table->timestamps();
        });

        User::insert([
            [
                'name'      => 'admin',
                'email'     => 'admin@gmail.com',
                'password'  => Hash::make('admin'),
                'no_telp'   => '628957048557451',
                'jenis_kelamin' => "Perempuan"
            ],
            [
                'name'      => 'mitra',
                'email'     => 'mitra@gmail.com',
                'password'  => Hash::make('admin'),
                'no_telp'   => '62895704855745',
                'jenis_kelamin' => "Laki-laki"
            ],
            [
                'name'      => 'user',
                'email'     => 'user@gmail.com',
                'password'  => Hash::make('admin'),
                'no_telp'   => '62895704855745',
                'jenis_kelamin' => "Laki-laki"
            ],
        ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
