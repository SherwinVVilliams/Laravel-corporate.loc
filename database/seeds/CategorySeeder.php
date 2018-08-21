<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('categories')->insert([
	       	[
	       		'title' => 'Блог',
	       		'parent_id' => 0,
	       		'alias' => 'blog'
	       	],
	       	[
	       		'title' => 'Компьютеры',
	       		'parent_id' => 1,
	       		'alias' => 'computers'
	       	],
	       	 	[
	       		'title' => 'Интересное',
	       		'parent_id' => 1,
	       		'alias' => 'interesting'
	       	],
	       	 	[
	       		'title' => 'Советы',
	       		'parent_id' => 1,
	       		'alias' => 'soveti'
	       	]
   		]); 
    }
}
