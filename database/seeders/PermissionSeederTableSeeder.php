<?php

namespace Modules\Content\Database\Seeders;

use DB;
use Guardian;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionSeederTableSeeder extends Seeder
{
    protected $model;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = config('access.group');
        $this->model = new $model;

        if (! $group = $this->model->where('name', 'Content')->first()) {
            $group = $this->create_group();
        }


        $this->create_permissions($group);
    }

    public function create_group()
    {
        $model = config('access.group');
        $this->model = new $model;
        $access = new $this->model;
        $access->name = 'Content';
        $access->sort = 4;
        $access->created_at = Carbon::now();
        $access->updated_at = Carbon::now();
        $access->save();

        return $access;
    }

    public function create_permissions($group)
    {
        $dependancy = DB::table(config('access.permissions_table'))->where('name', 'view-backend')->first();
        
        $i = 1;
        foreach (config('content.permissions') as $permission) {
            $model = config('access.permission');
            $p = new $model;
            if (! $p->where('name', $permission['name'])->first()) {
                $p = new $model;
                $p->name = $permission['name'];
                $p->display_name = $permission['display_name'];
                $p->system = true;
                $p->group_id = $group->id;
                $p->sort = $i;
                $p->created_at = Carbon::now();
                $p->updated_at = Carbon::now();
                $p->save();

                DB::table(config('access.permission_dependencies_table'))->insert([
                    'permission_id' => $p->id,
                    'dependency_id' => $dependancy->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                     
                $i++;
            }
        }
    }
}
