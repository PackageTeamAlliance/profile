<?php

namespace Pta\Profile\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Modules\Menus\src\Entities\Menu;
use Illuminate\Database\Eloquent\Model;
use Modules\Content\Database\Seeders\DefaultTableSeeder;
use Modules\Content\Database\Seeders\PermissionSeederTableSeeder;

class ProfileDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DefaultTableSeeder::class);
        $this->call(PermissionSeederTableSeeder::class);
    }
}
