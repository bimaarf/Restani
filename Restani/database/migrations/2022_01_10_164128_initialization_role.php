<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;
use App\Models\Permission;
class InitializationRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin          =   Role::create([
            'name'          => 'admin',
        ]);
        $mitra          =   Role::create([
            'name'          => 'mitra',
        ]);
        $user           =   Role::create([
            'name'          => 'user',
        ]);

        $dashboard      = Permission::create([
            'name'          => 'dashboard-admin',
        ]);
        $seller     = Permission::create([
            'name'          => 'create-post',
        ]);
        $buyer     = Permission::create([
            'name'          => 'create-orders',
        ]);

        $admin->attachPermissions([$dashboard, $seller]);
        $mitra->attachPermissions([$seller]);
        $user->attachPermissions([$buyer]);
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
