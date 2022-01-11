<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FindingRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin      =   User::find(1);
        $adminRole  =   Role::where('name', 'admin')->first();
        $admin->attachRole($adminRole);

        $mitra      =   User::find(2);
        $mitraRole  =   Role::where('name', 'mitra')->first();
        $mitra->attachRole($mitraRole);

        $user      =   User::find(3);
        $userRole  =   Role::where('name', 'user')->first();
        $user->attachRole($userRole);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
