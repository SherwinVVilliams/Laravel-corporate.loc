<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
        	[
	        	'text' => 'This is first comment on the site',
	        	'name' => 'Alexey Bragin',
	        	'email' => 'Alexey@mail.ru',
	        	'site' => 'vk.com',
	        	'parent_id' => 0
        	],
        	[
        		'text' => 'This is second comment on the site',
	        	'name' => 'Bogdan Ganalov',
	        	'email' => 'boganalov@mail.ru',
	        	'site' => 'Yandex.com',
	        	'parent_id' => 0
        	],
            [
                'text' => 'This is third comment on the site',
                'name' => 'Boris Nemec',
                'email' => 'borka@mail.ru',
                'site' => 'Yandex.com',
                'parent_id' => 1
            ],
            [
                'text' => 'This is fourth comment on the site',
                'name' => 'Timofey Pavlov',
                'email' => 'kakUsik@mail.ru',
                'site' => 'Facebook.com',
                'parent_id' => 3
            ],
            [
                'text' => 'This is fifth comment on the site',
                'name' => 'Andrey Golovach',
                'email' => 'GolovA@mail.ru',
                'site' => 'Yandex.com',
                'parent_id' => 4
            ],

        ]);
    }
}
