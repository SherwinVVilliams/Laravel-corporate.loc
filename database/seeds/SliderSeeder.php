<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sliders')->insert([
        	[
        		'title'=> 'Love',
        		'img' => "love1.jpg",//'{"mini": "love1-150x59.jpg", "max" : "love1.jpg"}',
        		'desc' => ' Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.'
        	],
        	[
        		'title'=> 'Red Passions',
        		'img' => "red-passion1.jpg",//'{"mini": "red-passion1-150x59.jpg", "max" : "red-passion1.jpg"}',
        		'desc' => ' Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.'
        	],
        	[
        		'title'=> 'Slide',
        		'img' => 'sci11.jpg',//'{"mini": "sci11-150x59.jpg", "max" : "sci11.jpg"}',
        		'desc' => ' Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.'
        	],
        	[
        		'title'=> 'Vacation',
        		'img' => 'xx21.jpg',//{"mini": "xx21.jpg", "max" : "xx21.jpg"}',
        		'desc' => ' Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.'
        	],
        ]);
    }
}
