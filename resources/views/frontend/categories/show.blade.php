<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تصنيف: {{ $category->name }} - VOILA!</title>
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

        /* الشريط العلوي */
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-bottom: none;
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
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.1);
        }

        .nav-link.active {
            background: rgba(255,255,255,0.15);
        }

        /* رأس التصنيف */
        .category-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--accent-color) 100%);
            color: white;
            padding: 100px 0 50px;
            position: relative;
            overflow: hidden;
        }

        .category-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.05)" points="0,1000 1000,0 1000,1000"/></svg>');
            background-size: cover;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
        }

        .breadcrumb-item a {
            color: rgba(255,255,255,0.8) !important;
            text-decoration: none;
            transition: var(--transition);
        }

        .breadcrumb-item a:hover {
            color: white !important;
        }

        .breadcrumb-item.active {
            color: white;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255,255,255,0.6);
        }

        /* بطاقات المقالات */
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

        .image-container {
            height: 220px;
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

        .article-card:hover .article-cover-image {
            transform: scale(1.1);
        }

        .placeholder-image {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
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
            font-size: 1.2rem;
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

        /* الشريط الجانبي */
        .sidebar-card {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .sidebar-header {
            background: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1.5rem 1.5rem 0.5rem;
        }

        .category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .category-list li {
            margin-bottom: 0.5rem;
        }

        .category-list a {
            text-decoration: none;
            color: var(--text-dark);
            padding: 0.8rem 1rem;
            border-radius: 12px;
            display: block;
            transition: var(--transition);
            border: 1px solid transparent;
        }

        .category-list a:hover {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            transform: translateX(-5px);
        }

        .category-list a.active {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-color: rgba(255,255,255,0.2);
        }

        .category-count {
            background: rgba(255,255,255,0.2);
            color: white;
            padding: 0.2rem 0.6rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* إحصائيات */
        .stat-card {
            text-align: center;
            padding: 1.5rem 1rem;
            border-radius: 15px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .stat-text {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* الترقيم */
        .pagination-container {
            padding: 3rem 0;
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

        /* الفوتر */
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

        /* تأثيرات التحميل */
        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* معلومات التصنيف */
        .meta-info {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-top: 1rem;
            justify-content: center;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255,255,255,0.9);
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            .category-header {
                padding: 80px 0 30px;
            }
            
            .meta-info {
                justify-content: center;
                gap: 1rem;
            }
            
            .meta-item {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <!-- شريط التنقل -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-magic me-2"></i>VOILA!
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>الرئيسية
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <i class="fas fa-tags me-1"></i>التصنيفات
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.index') }}">
                            <i class="fas fa-envelope me-1"></i>اتصل بنا
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- رأس التصنيف -->
    <section class="category-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- <nav aria-label="breadcrumb" class="fade-in">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">التصنيفات</li>
                        </ol>
                    </nav> -->
                    
                    <h1 class="display-5 fw-bold mb-4 text-center fade-in">
                        <i class="fas fa-folder me-3"></i>{{ $category->name }}
                    </h1>
                    
                    @if($category->description)
                        <p class="lead text-center mb-4 fade-in">{{ $category->description }}</p>
                    @endif
                    
                    <div class="meta-info fade-in">
                        <div class="meta-item">
                            <i class="fas fa-newspaper"></i>
                            <span>{{ $articles->total() }} مقال</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-calendar"></i>
                            <span>أنشئ في {{ $category->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- محتوى الصفحة -->
    <div class="container">
        <div class="row">
            <!-- المحتوى الرئيسي -->
            <div class="col-lg-9">
                @if($articles->count() > 0)
                    <!-- إحصائيات سريعة -->
                    <div class="row mb-5 fade-in">
                        <div class="col-12">
                            <div class="alert alert-info border-0 rounded-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-info-circle me-2"></i>
                                        عرض <strong>{{ $articles->count() }}</strong> مقال في هذه الصفحة
                                        من أصل <strong>{{ $articles->total() }}</strong> مقال في التصنيف
                                    </div>
                                    <div class="text-muted">
                                        الصفحة {{ $articles->currentPage() }} من {{ $articles->lastPage() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- قائمة المقالات -->
                    <div class="row g-4">
                        @foreach($articles as $article)
                        <div class="col-lg-4 col-md-6 fade-in">
                            <div class="article-card">
                                <!-- حاوية الصورة -->
                                <div class="image-container">
                                @if($article->image)
    <img src="{{ asset($article->image) }}" 
         class="article-image" 
         alt="{{ $article->title }}">
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
                                            <span>{{ $article->created_at->format('Y-m-d') }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('articles.show', $article->id) }}" class="read-more-btn">
                                        <i class="fas fa-book-open me-2"></i>اقرأ المزيد
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
                                        {{ $articles->links() }}
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
                    <!-- لا توجد مقالات -->
                    <div class="row fade-in">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center py-5">
                                    <i class="fas fa-folder-open fa-4x text-muted mb-4"></i>
                                    <h3 class="text-muted">لا توجد مقالات في هذا التصنيف</h3>
                                    <p class="text-muted mb-4">
                                        لم يتم إضافة أي مقالات إلى تصنيف "{{ $category->name }}" بعد.
                                    </p>
                                    <div class="mt-3">
                                        <a href="{{ route('home') }}" class="btn read-more-btn me-3" style="width: auto;">
                                            <i class="fas fa-home me-2"></i>العودة للرئيسية
                                        </a>
                                        <a href="/admin" class="btn btn-outline-primary" style="width: auto;">
                                            <i class="fas fa-plus me-2"></i>إضافة مقالات
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- الشريط الجانبي -->
            <div class="col-lg-3">
                <!-- قائمة التصنيفات -->
                <div class="sidebar-card fade-in">
                    <div class="sidebar-header">
                        <h5 class="mb-0">
                            <i class="fas fa-tags me-2 text-primary"></i>
                            جميع التصنيفات
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="category-list">
                            @foreach($categories as $cat)
                                <li>
                                    <a href="/category/{{ $cat->id }}" 
                                       class="{{ $cat->id == $category->id ? 'active' : '' }}">
                                        <i class="fas fa-folder me-2"></i>
                                        {{ $cat->name }}
                                        <span class="category-count">{{ $cat->articles()->where('is_published', true)->count() }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- إحصائيات -->
                <div class="sidebar-card fade-in">
                    <div class="sidebar-header">
                        <h5 class="mb-0">
                            <i class="fas fa-chart-bar me-2 text-primary"></i>
                            إحصائيات التصنيف
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-newspaper"></i>
                                    </div>
                                    <div class="stat-number">{{ $articles->total() }}</div>
                                    <div class="stat-text">مقال منشور</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="stat-card">
                                    <div class="stat-icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="stat-number">{{ $category->created_at->format('Y') }}</div>
                                    <div class="stat-text">سنة الإنشاء</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الفوتر -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <div class="footer-brand">
                        <i class="fas fa-magic me-2"></i>VOILA!
                    </div>
                    <p class="footer-text mb-0">
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
        // تأثيرات التحميل
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>
</body>
</html>