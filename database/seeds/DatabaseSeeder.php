<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
         $this->call(SliderSeeder::class);
         $this->call(CategorySeeder::class);
         $this->call(FilterSeeder::class);
         $this->call(MenuSeeder::class);
         $this->call(PortfolioSeeder::class);
         $this->call(ArtSeeder::class);
         $this->call(CommentSeeder::class);
         $this->call(PermissionSeeder::class);
         $this->call(RoleSeeder::class);
         $this->call(PermissionRoleSeeder::class);
         $this->call(RoleUserSeeder::class);


    }
}
