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
            // إنشاء تصنيفات إذا لم تكن موجودة
            $categories = Category::factory()->count(5)->create();
        }

        $articles = [
            [
                'title' => 'مقدمة في Laravel وأهم الميزات الجديدة',
                'content' => '<p>لارافيل هو إطار عمل PHP مفتوح المصدر، يتميز ببساطة التعبير وأدواته الرائعة التي تمنحك الأساس اللازم لبناء أي تطبيق. في هذا المقال سنستعرض أهم الميزات الجديدة في الإصدارات الحديثة.</p>
                            <h3>مميزات Laravel</h3>
                            <ul>
                                <li>نظام Eloquent ORM قوي</li>
                                <li>نظام المصادقة المدمج</li>
                                <li>أداة Artisan لسطر الأوامر</li>
                                <li>نظام Blade للقوالب</li>
                            </ul>',
                'category_id' => $categories->where('name', 'برمجة')->first()->id ?? $categories->first()->id,
                'author_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'أفضل ممارسات تصميم واجهات المستخدم في 2024',
                'content' => '<p>تصميم واجهات المستخدم يتطور باستمرار، وفي عام 2024 ظهرت اتجاهات جديدة يجب على كل مصمم معرفتها. في هذا المقال سنستعرض أهم الممارسات الحديثة في تصميم UI/UX.</p>
                            <h3>الاتجاهات الحديثة</h3>
                            <p>1. التصميم الداكن المدمج</p>
                            <p>2. الرسوم المتحركة الدقيقة</p>
                            <p>3. التصميم الشفاف والزجاجي</p>
                            <p>4. التركيز على سهولة الاستخدام</p>',
                'category_id' => $categories->where('name', 'تصميم')->first()->id ?? $categories->get(1)->id,
                'author_id' => $editor->id,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'كيفية تحسين أداء تطبيقات الويب',
                'content' => '<p>تحسين الأداء هو أحد العوامل الأساسية لنجاح أي تطبيق ويب. في هذا الدليل الشامل، سنستعرض أفضل الطرق لتحسين سرعة تطبيقاتك.</p>
                            <h3>نصائح لتحسين الأداء</h3>
                            <ol>
                                <li>تحسين الصور واستخدام التنسيقات الحديثة</li>
                                <li>تفعيل التخزين المؤقت</li>
                                <li>تقليل طلبات HTTP</li>
                                <li>استخدام CDN</li>
                                <li>تحسين كود JavaScript وCSS</li>
                            </ol>',
                'category_id' => $categories->where('name', 'أداء')->first()->id ?? $categories->get(2)->id,
                'author_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'مقدمة في React.js ومكوناتها الأساسية',
                'content' => '<p>React.js هي مكتبة JavaScript شهيرة لبناء واجهات المستخدم، طورتها فيسبوك. تتميز بمرونتها وكفاءتها في التعامل مع التطبيقات الكبيرة.</p>
                            <h3>مميزات React</h3>
                            <ul>
                                <li>المكونات القابلة لإعادة الاستخدام</li>
                                <li>الافتراض DOM لتحسين الأداء</li>
                                <li>مجتمع نشط ودعم قوي</li>
                                <li>سهولة التعلم والتطبيق</li>
                            </ul>',
                'category_id' => $categories->where('name', 'برمجة')->first()->id ?? $categories->first()->id,
                'author_id' => $editor->id,
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'أهمية الأمان السيبراني في عصر التكنولوجيا',
                'content' => '<p>مع تزايد الاعتماد على التكنولوجيا، أصبح الأمان السيبراني أكثر أهمية من أي وقت مضى. في هذا المقال سنناقش أفضل الممارسات لحماية تطبيقاتك.</p>
                            <h3>نصائح للأمان</h3>
                            <p>• استخدام كلمات مرور قوية</p>
                            <p>• تحديث البرامج باستمرار</p>
                            <p>• تشفير البيانات الحساسة</p>
                            <p>• تنفيذ مصادقة ثنائية</p>',
                'category_id' => $categories->where('name', 'أمان')->first()->id ?? $categories->get(3)->id,
                'author_id' => $admin->id,
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],
            [
                'title' => 'كيفية بناء نظام إدارة محتوى باستخدام Laravel',
                'content' => '<p>في هذا البرنامج التعليمي، سنتعلم كيفية بناء نظام إدارة محتوى كامل باستخدام Laravel. سنغطي كل شيء من النماذج إلى العلاقات.</p>
                            <h3>الميزات التي سنبنيها</h3>
                            <ul>
                                <li>إدارة المقالات</li>
                                <li>نظام التصنيفات</li>
                                <li>إدارة المستخدمين</li>
                                <li>نظام التعليقات</li>
                                <li>لوحة تحكم للمشرفين</li>
                            </ul>',
                'category_id' => $categories->where('name', 'برمجة')->first()->id ?? $categories->first()->id,
                'author_id' => $editor->id,
                'is_published' => false, // مقال غير منشور
                'published_at' => null,
            ],
        ];

        foreach ($articles as $articleData) {
            $slug = Str::slug($articleData['title']);
            
            Article::create(array_merge($articleData, [
                'slug' => $slug,
                'image' => null, // يمكن إضافة صور لاحقاً
            ]));
        }

        $this->command->info('تم إنشاء ' . count($articles) . ' مقال بنجاح!');
    }
}