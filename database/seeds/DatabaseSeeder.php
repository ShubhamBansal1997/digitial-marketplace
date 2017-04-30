<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(Users::class);
        // $this->call(Category::class);
        // $this->call(Banners::class);
        $this->call(Settings::class);
    }
}
