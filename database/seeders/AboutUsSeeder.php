<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutUsSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')->insert([
            'slug' => 'about_us',
            'small_header' => 'About Us',
            'small_header_ar' => 'عنّا',
            'name' => 'About Us',
            'name_ar' => 'عنّا',
            'description' => 'We provide the best engineering office services.',
            'description_ar' => 'نحن نقدم أفضل خدمات المكتب الهندسي.',
            'button_name' => 'Read More',
            'button_name_ar' => 'اقرأ المزيد',
            'button_link' => '#',
            'image_path' => '/defualt-post.jpg',  
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
