<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOILA! - الصفحة الرئيسية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #667eea;
            --secondary-color: #764ba2;
            --accent-color: #f093fb;
            --text-dark: #2d3748;
            --text-light: #718096;
            --bg-light: #f8fafc;
            --shadow: 0 10px 30px rgba(0,0,0,0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* الشريط العلوي  */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-bottom: none;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(45deg, #fff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: var(--transition);
        }

        .navbar-brand:hover {
            transform: scale(1.05);
        }

        .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            margin: 0 0.2rem;
            border-radius: 25px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 100%;
            background: rgba(255,255,255,0.1);
            transition: var(--transition);
            border-radius: 25px;
        }

        .nav-link:hover::before {
            width: 100%;
        }

        .nav-link.active {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
        }

        /* قسم الهيرو  */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--accent-color) 100%);
            color: white;
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.05)" points="0,1000 1000,0 1000,1000"/></svg>');
            background-size: cover;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #fff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .hero-subtitle {
            font-size: 1.3rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        /* نموذج البحث  */
        .search-form {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: var(--shadow);
        }

        .form-control, .form-select {
            border: none;
            border-radius: 15px;
            padding: 1rem 1.5rem;
            font-size: 1rem;
            background: rgba(255,255,255,0.9);
            backdrop-filter: blur(10px);
            transition: var(--transition);
            border: 2px solid transparent;
        }

        .form-control:focus, .form-select:focus {
            background: white;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.5);
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .search-btn {
            background: white;
            color: var(--primary-color);
            border: none;
            border-radius: 15px;
            padding: 1rem 2rem;
            font-weight: 600;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .search-btn::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            transition: var(--transition);
            border-radius: 15px;
        }

        .search-btn:hover::before {
            width: 100%;
        }

        .search-btn:hover {
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .search-btn span {
            position: relative;
            z-index: 1;
        }

        /* بطاقات الإحصائيات  */
        .stats-section {
            padding: 3rem 0;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.05);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .stat-text {
            color: var(--text-light);
            font-weight: 500;
        }

        /* بطاقات المقالات  */
        .articles-section {
            padding: 2rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 3rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .article-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    border: 1px solid rgba(0,0,0,0.05);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.article-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.15);
}

.article-card:hover .article-cover-image {
    transform: scale(1.1);
}

.placeholder-image {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}


        .image-container {
    height: 250px;
    position: relative;
    overflow: hidden;
    flex-shrink: 0;
}

.article-cover-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.3s ease;
}

.article-cover-image:hover {
    transform: scale(1.05);
}

.placeholder-image {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.category-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    z-index: 2;
}
.article-content {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.article-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    color: var(--text-dark);
    line-height: 1.4;
    min-height: 3.5em;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}


.article-excerpt {
    color: var(--text-light);
    margin-bottom: 1.5rem;
    line-height: 1.6;
    flex-grow: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.article-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
    color: var(--text-light);
    flex-shrink: 0;
}

.author-info, .date-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.read-more-btn {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    border: none;
    border-radius: 25px;
    padding: 0.8rem 1.5rem;
    font-weight: 600;
    transition: var(--transition);
    width: 100%;
    text-decoration: none;
    display: block;
    text-align: center;
    flex-shrink: 0;
}

.read-more-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    color: white;
}

        /* الترقيم  */
        .pagination-container {
            padding: 3rem 0;
        }

        .pagination {
            gap: 0.5rem;
        }
        

        .page-link {
            border: none;
            border-radius: 15px !important;
            padding: 0.8rem 1.2rem;
            color: var(--text-dark);
            font-weight: 600;
            transition: var(--transition);
            background: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .page-link:hover {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            transform: translateY(-2px);
        }

        .page-item.active .page-link {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        /* الفوتر  */
        .footer {
            background: linear-gradient(135deg, var(--text-dark) 0%, #1a202c 100%);
            color: white;
            padding: 3rem 0 2rem;
            margin-top: 4rem;
        }

        .footer-brand {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #fff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .footer-text {
            opacity: 0.8;
            line-height: 1.6;
        }

        /* رسومات متحركة */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .floating {
            animation: float 3s ease-in-out infinite;
        }

        /* تأثيرات الاستجابة */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
        }

        /* تأثيرات التحميل */
        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* شريط التقدم */
        .progress-bar {
            position: fixed;
            top: 0;
            right: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            z-index: 1001;
            transition: width 0.3s ease;
        }
    </style>
</head>
<body>
    <!-- شريط التقدم -->
    <div class="progress-bar" id="progressBar"></div>

    <!-- شريط التنقل -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand floating" href="{{ route('home') }}">
                <i class="fas fa-magic me-2"></i>VOILA!
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>الرئيسية
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.index') }}">
                            <i class="fas fa-envelope me-1"></i>اتصل بنا
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            <i class="fas fa-cog me-1"></i>لوحة التحكم
                        </a>
                    </li>
                </ul>
                
                <!-- قائمة التصنيفات في الشريط -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-tags me-1"></i>التصنيفات
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($categories as $category)
                                <li>
                                    <a class="dropdown-item" href="/category/{{ $category->id }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- قسم الهيرو -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center text-center fade-in">
                <div class="col-lg-8">
                    <h1 class="hero-title">مرحباً بكم في VOILA!</h1>
                    <p class="hero-subtitle">اكتشف أحدث المقالات والإبداعات في عالم التكنولوجيا والتصميم</p>
                    
                    <div class="search-form fade-in">
                        <form action="{{ route('home') }}" method="GET" class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="q" class="form-control form-control-lg" 
                                       placeholder="ابحث في المقالات..." value="{{ $query ?? '' }}">
                            </div>
                            <div class="col-md-4">
                                <select name="category_id" class="form-select form-select-lg">
                                    <option value="">جميع التصنيفات</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ ($category_id ?? '') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn search-btn w-100">
                                    <span><i class="fas fa-search me-2"></i>بحث</span>
                                </button>
                            </div>
                        </form>

                        @if($query || $category_id)
                            <div class="mt-4">
                                <a href="{{ route('home') }}" class="btn btn-outline-light">
                                    <i class="fas fa-times me-2"></i>مسح الفلترة
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- إحصائيات سريعة -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card fade-in">
                        <div class="stat-icon">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div class="stat-number">{{ $articles->total() }}</div>
                        <div class="stat-text">مقال منشور</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card fade-in">
                        <div class="stat-icon">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="stat-number">{{ $categories->count() }}</div>
                        <div class="stat-text">تصنيف</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card fade-in">
                        <div class="stat-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="stat-number">محدث</div>
                        <div class="stat-text">أحدث المحتويات</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- المقالات -->
    <!-- المقالات -->
<section class="articles-section">
    <div class="container">
        @if(request()->has('category_id') && $articles->count() > 0)
            @php
                $selectedCategory = \App\Models\Category::find(request('category_id'));
            @endphp
            @if($selectedCategory)
                <div class="row mb-5 fade-in">
                    <div class="col-12 text-center">
                        <h2 class="section-title">
                            <i class="fas fa-folder me-2"></i>تصنيف: {{ $selectedCategory->name }}
                        </h2>
                        <p class="text-muted">عرض {{ $articles->total() }} مقال في هذا التصنيف</p>
                    </div>
                </div>
            @endif
        @endif

        @if($query && $articles->count() > 0)
            <div class="row mb-5 fade-in">
                <div class="col-12 text-center">
                    <h2 class="section-title">
                        <i class="fas fa-search me-2"></i>نتائج البحث عن: "{{ $query }}"
                    </h2>
                    <p class="text-muted">تم العثور على {{ $articles->total() }} نتيجة</p>
                </div>
            </div>
        @endif

        @if(!request()->has('category_id') && !request()->has('q'))
            <div class="row mb-5 fade-in">
                <div class="col-12 text-center">
                    <h2 class="section-title">أحدث المقالات</h2>
                    <p class="text-muted">اكتشف أحدث المحتويات في موقعنا</p>
                </div>
            </div>
        @endif

        @if(isset($articles) && $articles->count() > 0)
            <div class="row g-4">
                @foreach($articles as $article)
                <div class="col-lg-4 col-md-6 fade-in">
                    <div class="article-card">
                        <!-- حاوية الصورة -->
                        <div class="image-container">
                            @if($article->image)
                                <img src="{{ $article->image ?? asset('articles/' . $article->image) }}" 
                                     class="article-cover-image" 
                                     alt="{{ $article->title }}">
                            @else
                                <div class="placeholder-image d-flex align-items-center justify-content-center">
                                    <i class="fas fa-image fa-3x text-light"></i>
                                </div>
                            @endif
                            <!-- شارة التصنيف -->
                            <span class="category-badge">
                                {{ $article->category->name }}
                            </span>
                        </div>
                        
                        <!-- محتوى البطاقة -->
                        <div class="article-content">
                            <h3 class="article-title">{{ $article->title }}</h3>
                            <p class="article-excerpt">
                                @if($article->content)
                                    {{ Str::limit(strip_tags($article->content), 120) }}
                                @else
                                    لا يوجد محتوى
                                @endif
                            </p>
                            <div class="article-meta">
                                <div class="author-info">
                                    <i class="fas fa-user"></i>
                                    <span>{{ $article->author->name ?? 'مستخدم' }}</span>
                                </div>
                                <div class="date-info">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ $article->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            <a href="{{ route('articles.show', $article->id) }}" class="read-more-btn">
                                اقرأ المزيد
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- الترقيم -->
            @if($articles->hasPages())
            <div class="pagination-container fade-in">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                {{ $articles->appends(request()->query())->links() }}
                            </ul>
                        </nav>
                        <div class="text-center mt-3">
                            <p class="text-muted">
                                عرض {{ $articles->firstItem() }} إلى {{ $articles->lastItem() }} من أصل {{ $articles->total() }} مقال
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        @else
            <div class="row fade-in">
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-4x text-muted mb-4"></i>
                        <h3 class="text-muted">لا توجد مقالات</h3>
                        <p class="text-muted mb-4">
                            @if($query || $category_id)
                                لم نتمكن من العثور على مقالات تطابق بحثك.
                            @else
                                لا توجد مقالات منشورة حالياً.
                            @endif
                        </p>
                        <div class="mt-3">
                            <a href="{{ route('home') }}" class="btn read-more-btn me-3" style="width: auto;">
                                <i class="fas fa-home me-2"></i>العودة للرئيسية
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary" style="width: auto;">
                                <i class="fas fa-plus me-2"></i>إضافة مقالات
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

    <!-- الفوتر -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <div class="footer-brand">
                        <i class="fas fa-magic me-2"></i>VOILA!
                    </div>
                    <p class="footer-text">
                        منصة رائدة في تقديم أحدث المحتويات التقنية والإبداعية
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="footer-text mb-0">
                        &copy; 2025 VOILA! Creative Digital Agency. جميع الحقوق محفوظة.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // شريط التقدم
        window.addEventListener('scroll', function() {
            const winHeight = window.innerHeight;
            const docHeight = document.documentElement.scrollHeight;
            const scrollTop = window.pageYOffset;
            const trackLength = docHeight - winHeight;
            const progress = (scrollTop / trackLength) * 100;
            document.getElementById('progressBar').style.width = progress + '%';
        });

        // تأثيرات التفاعل
        document.addEventListener('DOMContentLoaded', function() {
            // تحديث النتائج عند تغيير التصنيف
            const categorySelect = document.querySelector('select[name="category_id"]');
            if (categorySelect) {
                categorySelect.addEventListener('change', function() {
                    this.form.submit();
                });
            }

            // تأثيرات التمرير
            const fadeElements = document.querySelectorAll('.fade-in');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            fadeElements.forEach(el => {
                el.style.opacity = 0;
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'all 0.6s ease-out';
                observer.observe(el);
            });

            // التركيز على حقل البحث
            const searchInput = document.querySelector('input[name="q"]');
            if (searchInput) {
                searchInput.focus();
            }
        });
    </script>
</body>
</html>