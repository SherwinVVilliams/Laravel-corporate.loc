<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
       		[
       			'name' => 'VIEW_ADMIN',
       		],
       		[
       			'name' => 'ADD_ARTICLES',
       		],
       		[
       			'name' => 'UPDATE_ARTICLES',
       		],
       		[
       			'name' => 'DELETE_ARTICLES',
       		],
       		[
       			'name' => 'ADMIN_USERS',
       		],
       		[
       			'name' => 'VIEW_ADMIN_ARTICLES',
       		],
       		[
       			'name' => 'EDIT_USERS',
       		]
       	]);
    }
}
