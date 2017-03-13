<?php

use Illuminate\Database\Seeder;

class Banners extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->insert([
            'banner_name' => 'Homepage-Banner-1',
            'banner_url' => 'www.google.com',
            'banner_size' => '200x200',
        ]);
        DB::table('banners')->insert([
            'banner_name' => 'Homepage-Banner-2',
            'banner_url' => 'www.google.com',
            'banner_size' => '200x200',
        ]);
        DB::table('banners')->insert([
            'banner_name' => 'Homepage-Banner-3',
            'banner_url' => 'www.google.com',
            'banner_size' => '200x200',
        ]);
        DB::table('banners')->insert([
            'banner_name' => 'Homepage-Banner-4',
            'banner_url' => 'www.google.com',
            'banner_size' => '200x200',
        ]);
        DB::table('banners')->insert([
            'banner_name' => 'Homepage-Banner-5',
            'banner_url' => 'www.google.com',
            'banner_size' => '200x200',
        ]);
        DB::table('banners')->insert([
            'banner_name' => 'Homepage-Banner-6',
            'banner_url' => 'www.google.com',
            'banner_size' => '200x200',
        ]);
    }
}
