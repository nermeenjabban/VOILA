<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        // التأكد من وجود مستخدمين وتصنيفات أولاً
        $admin = User::where('email', 'admin@voila.digital')->first();
        $editor = User::where('email', 'editor@voila.digital')->first();
        
        $categories = Category::all();
        
        if ($categories->isEmpty()) {
            $categories = Category::factory()->count(5)->create();
        }

        // تعريف المقالات مع صورها
        $articles = [
            [
                'title' => 'مقدمة في Laravel وأهم الميزات الجديدة',
                'content' => '<p>لارافيل هو إطار عمل PHP مفتوح المصدر...</p>',
                'category_id' => $categories->where('name', 'برمجة')->first()->id ?? $categories->first()->id,
                'author_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'comments_enabled' => true,
                'image' => 'articles/laravel.png', 
            ],
            [
                'title' => 'أفضل ممارسات تصميم واجهات المستخدم في 2024',
                'content' => '<p>تصميم واجهات المستخدم يتطور باستمرار...</p>',
                'category_id' => $categories->where('name', 'تصميم')->first()->id ?? $categories->get(1)->id,
                'author_id' => $editor->id,
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'comments_enabled' => true,
                'image' => 'articles/design.jpg',
            ],
            [
                'title' => 'كيفية تحسين أداء تطبيقات الويب',
                'content' => '<p>تحسين الأداء هو أحد العوامل الأساسية...</p>',
                'category_id' => $categories->where('name', 'أداء')->first()->id ?? $categories->get(2)->id,
                'author_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(1),
                'comments_enabled' => true,
                'image' => 'articles/performance.jpg',
            ],
            [
                'title' => 'مقدمة في React.js ومكوناتها الأساسية',
                'content' => '<p>React.js هي مكتبة JavaScript شهيرة...</p>',
                'category_id' => $categories->where('name', 'برمجة')->first()->id ?? $categories->first()->id,
                'author_id' => $editor->id,
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'comments_enabled' => true,
                'image' => 'articles/react.png',
            ],
            [
                'title' => 'أهمية الأمان السيبراني في عصر التكنولوجيا',
                'content' => '<p>مع تزايد الاعتماد على التكنولوجيا...</p>',
                'category_id' => $categories->where('name', 'أمان')->first()->id ?? $categories->get(3)->id,
                'author_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(7),
                'comments_enabled' => true,
                'image' => 'articles/security.jpg',
            ],
            [
                'title' => 'كيفية بناء نظام إدارة محتوى باستخدام Laravel',
                'content' => '<p>في هذا البرنامج التعليمي، سنتعلم...</p>',
                'category_id' => $categories->where('name', 'برمجة')->first()->id ?? $categories->first()->id,
                'author_id' => $editor->id,
                'is_published' => false,
                'published_at' => null,
                'comments_enabled' => true,
                'image' => 'articles/laravel.png',
            ],
        ];

        foreach ($articles as $articleData) {
            $slug = Str::slug($articleData['title']);
            
            Article::create(array_merge($articleData, [
                'slug' => $slug,
            ]));
        }

        $this->command->info('تم إنشاء ' . count($articles) . ' مقال بنجاح مع الصور!');
    }
}