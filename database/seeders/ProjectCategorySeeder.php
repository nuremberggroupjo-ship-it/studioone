<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectCategory;

class ProjectCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Design', 'name_ar' => 'تصميم'],
            ['name' => '3D Renders', 'name_ar' => 'عروض ثلاثية الأبعاد'],
            ['name' => 'Materials', 'name_ar' => 'المواد'],
            ['name' => 'Execution', 'name_ar' => 'تنفيذ'],
            ['name' => 'Renovation', 'name_ar' => 'تجديد']
        ];

        foreach ($categories as $category) {
            ProjectCategory::create($category);
        }
    }
}
