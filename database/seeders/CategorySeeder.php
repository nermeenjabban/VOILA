<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'برمجة', 'description' => 'مقالات عن البرمجة وتطوير الويب'],
            ['name' => 'تصميم', 'description' => 'مقالات عن تصميم واجهات المستخدم والتجربة'],
            ['name' => 'أداء', 'description' => 'نصائح وتحسينات لأداء التطبيقات'],
            ['name' => 'أمان', 'description' => 'مقالات عن الأمان السيبراني وحماية التطبيقات'],
            ['name' => 'تقنيات', 'description' => 'أحدث التقنيات والاتجاهات في عالم التكنولوجيا'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }

        $this->command->info('تم إنشاء ' . count($categories) . ' تصنيف بنجاح!');
    }
}