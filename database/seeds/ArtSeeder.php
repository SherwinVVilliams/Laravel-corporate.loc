<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('articles')->insert([
        	[
        		'title' => 'This is the title of the first article. Enjoy it',
        		'text' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim' ,
        		'desc' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.',
        		'alias' =>'article-1',
        		'img' => '{"mini": "003-55x55.jpg", "max" : "003-816x282.jpg", "path":"003-816x282.jpg"}',
        		'user_id' => 1,
        		'category_id' => 1,
        	],
        	[
        		'title' => 'Nice & Clean. The best for your blog!',
        		'text' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim' ,
        		'desc' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.',
        		'alias' =>'article-2',
        		'img' => '{"mini": "001-55x55.png", "max" : "001-816x282.jpg", "path":"001-816x282.jpg"}',
        		'user_id' => 1,
        		'category_id' => 1,
        	],
        	[
        		'title' => 'Diet for best health',
        		'text' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim' ,
        		'desc' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.',
        		'alias' =>'article-3',
        		'img' => '{"mini": "0037-55x55.jpg", "max" : "00212-816x282.jpg", "path":"00212-816x282.jpg"} ',
        		'user_id' => 1,
        		'category_id' => 2,
        	]
        ]);
    }
}
