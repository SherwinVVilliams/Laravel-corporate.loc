<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('portfolios')->insert([
        	[
        	'title' => 'Steep This!',
        	'text' => 'Nullam volupat, mauris scelerisque iacullus semper, jutso. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.',
        	'customer' => 'Steep This!',
        	'alias' => 'project1',
        	'img' => '{"mini": "0081-175x175.jpg", "max" : "0081-770x368.jpg", "path":"0082.jpg"}',
            'filter_alias' => 'brand-identity'
        	],
        	[
        	'title' => 'Kineda',
        	'text' => 'Nullam volupat, mauris scelerisque iacullus semper, jutso. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.',
        	'customer' => 'Kindeda' ,
        	'alias' => 'project2',
        	'img' => '{"mini": "0071-175x175.jpg", "max" : "0071-770x368.jpg", "path":"0072.jpg"}',
            'filter_alias' => 'brand-identity'
        	],
        	[
        	'title' => 'Miller Bob',
        	'text' => 'Nullam volupat, mauris scelerisque iacullus semper, jutso. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.',
        	'customer' => 'Miller Bob' ,
        	'alias' => 'project3',
        	'img' => '{"mini": "0011-175x175.jpg", "max" : "0013.jpg", "path":"0012.jpg"}',
            'filter_alias' => 'brand-identity'
        	],
        	[
        	'title' => 'Vitale',
        	'text' => 'Nullam volupat, mauris scelerisque iacullus semper, jutso. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.',
        	'customer' => 'Vitale' ,
        	'alias' => 'project4',
        	'img' => '{"mini" : "0027-175x175.jpg", "max" : "0029.jpg", "path" : "0029.jpg"}',
            'filter_alias' => 'brand-identity'
        	],
        	[
        	'title' => 'Nili Studios',
        	'text' => 'Nullam volupat, mauris scelerisque iacullus semper, jutso. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.',
        	'customer' => 'Customer 2' ,
        	'alias' => 'project5',
        	'img' => '{"mini": "0034-175x175.jpg", "max" : "0034-770x368.jpg", "path":"0035.jpg"}',
            'filter_alias' => 'brand-identity'
        	],
        	[
        	'title' => 'Digitpool medien',
        	'text' => 'Nullam volupat, mauris scelerisque iacullus semper, jutso. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.',
        	'customer' => 'Digitpool medien' ,
        	'alias' => 'project6',
        	'img' => '{"mini": "0043-175x175.jpg", "max" : "0043-770x368.jpg", "path":"0045.jpg"}',
            'filter_alias' => 'brand-identity'
        	],
        	[
        	'title' => 'Octupus',
        	'text' => 'Nullam volupat, mauris scelerisque iacullus semper, jutso. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.',
        	'customer' => 'Octupus' ,
        	'alias' => 'project7',
        	'img' => '{"mini": "0052-175x175.jpg", "max" : "0052-770x368.jpg", "path":"0054.jpg"}',
            'filter_alias' => 'brand-identity'
        	],
        	[
        	'title' => 'Love',
        	'text' => 'Nullam volupat, mauris scelerisque iacullus semper, jutso. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.',
        	'customer' => 'Love' ,
        	'alias' => 'project8',
        	'img' => '{"mini": "0061-175x175.jpg", "max" : "0061-770x368.jpg", "path":"0063.jpg"}',
            'filter_alias' => 'brand-identity'
        	],
        	[
        	'title' => 'Guanacos Corrida de Aventura',
        	'text' => 'Nullam volupat, mauris scelerisque iacullus semper, jutso. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis.',
        	'customer' => 'Guanacos' ,
        	'alias' => 'project9',
        	'img' => '{"mini": "009-175x175.jpg", "max" : "009-770x368.jpg", "path":"0092.jpg"}',
            'filter_alias' => 'brand-identity'
        	]
        ]);
    }
}
