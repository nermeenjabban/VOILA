<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOILA! - الصفحة الرئيسية</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .article-card {
            transition: transform 0.3s ease;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .search-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 50px 0;
            margin-bottom: 40px;
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .article-card:hover .card-img-top {
            transform: scale(1.05);
        }
        .placeholder-image {
            height: 200px;
            background: linear-gradient(45deg, #6c757d, #495057);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        .category-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(102, 126, 234, 0.9);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .pagination .page-link {
            color: #667eea;
            border: 1px solid #dee2e6;
        }
        .pagination .page-item.active .page-link {
            background-color: #667eea;
            border-color: #667eea;
        }
        .search-btn {
            background: #fff;
            color: #667eea;
            border: none;
            transition: all 0.3s ease;
        }
        .search-btn:hover {
            background: #f8f9fa;
            transform: scale(1.05);
        }
        .category-filter {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .category-filter:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
    </style>
</head>
<body>
    <!-- شريط التنقل -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="fas fa-magic me-2"></i>VOILA!
            </a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>الرئيسية
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-envelope me-1"></i>اتصل بنا
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">
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

    <!-- قسم البحث والتصفية -->
    <section class="search-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h1 class="display-4 fw-bold mb-4">مرحباً بكم في VOILA!</h1>
                    <p class="lead mb-5">اكتشف أحدث المقالات والإبداعات في عالم التكنولوجيا والتصميم</p>
                    
                    <form action="{{ route('home') }}" method="GET" class="row g-3">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control form-control-lg" 
                                       placeholder="ابحث في المقالات..." value="{{ $query ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="category_id" class="form-select form-select-lg category-filter">
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
                            <button type="submit" class="btn btn-light btn-lg w-100 search-btn">
                                <i class="fas fa-search me-2"></i>بحث
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
    </section>

    <!-- إحصائيات سريعة -->
    <div class="container mb-5">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-newspaper fa-2x text-primary mb-3"></i>
                        <h3>{{ $articles->total() }}</h3>
                        <p class="text-muted">مقال منشور</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-tags fa-2x text-success mb-3"></i>
                        <h3>{{ $categories->count() }}</h3>
                        <p class="text-muted">تصنيف</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-eye fa-2x text-info mb-3"></i>
                        <h3>محدث</h3>
                        <p class="text-muted">أحدث المحتويات</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- المقالات -->
    <div class="container">
        @if(isset($category))
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="text-center text-primary">
                        <i class="fas fa-folder me-2"></i>تصنيف: {{ $category->name }}
                    </h2>
                    <p class="text-center text-muted">عرض {{ $articles->total() }} مقال في هذا التصنيف</p>
                </div>
            </div>
        @endif

        @if($query)
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="text-center">
                        <i class="fas fa-search me-2"></i>نتائج البحث عن: "{{ $query }}"
                    </h3>
                    <p class="text-center text-muted">تم العثور على {{ $articles->total() }} نتيجة</p>
                </div>
            </div>
        @endif

        @if(isset($articles) && $articles->count() > 0)
            <div class="row">
                @foreach($articles as $article)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card article-card h-100">
                        <div class="position-relative">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" class="card-img-top" 
                                     alt="{{ $article->title }}">
                            @else
                                <div class="placeholder-image">
                                    <i class="fas fa-image fa-3x"></i>
                                </div>
                            @endif
                            <span class="category-badge">
                                {{ $article->category->name }}
                            </span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $article->title }}</h5>
                            <p class="card-text flex-grow-1 text-muted">
                                @if($article->content)
                                    {{ Str::limit(strip_tags($article->content), 120) }}
                                @else
                                    لا يوجد محتوى
                                @endif
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i> 
                                    {{ $article->author->name ?? 'مستخدم' }}
                                </small>
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i> 
                                    {{ $article->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary mt-3">
    <i class="fas fa-book-open me-2"></i>اقرأ المزيد
</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- الترقيم -->
          <!-- الترقيم -->
@if($articles->hasPages())
<div class="row mt-5">
    <div class="col-12">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                {{-- زر الصفحة الأولى --}}
                @if($articles->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo; الأولى</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $articles->url(1) }}" rel="first">&laquo; الأولى</a>
                    </li>
                @endif

                {{-- زر الصفحة السابقة --}}
                @if($articles->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">السابقة</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $articles->previousPageUrl() }}" rel="prev">السابقة</a>
                    </li>
                @endif

                {{-- أرقام الصفحات --}}
                @foreach($articles->getUrlRange(1, $articles->lastPage()) as $page => $url)
                    @if($page == $articles->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- زر الصفحة التالية --}}
                @if($articles->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $articles->nextPageUrl() }}" rel="next">التالية</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">التالية</span>
                    </li>
                @endif

                {{-- زر الصفحة الأخيرة --}}
                @if($articles->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $articles->url($articles->lastPage()) }}" rel="last">الأخيرة &raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">الأخيرة &raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>

        {{-- معلومات الصفحة --}}
        <div class="text-center mt-3">
            <p class="text-muted">
                عرض {{ $articles->firstItem() }} إلى {{ $articles->lastItem() }} من أصل {{ $articles->total() }} مقال
            </p>
        </div>
    </div>
</div>
@endif

        @else
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
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
                                <a href="{{ route('home') }}" class="btn btn-primary me-2">
                                    <i class="fas fa-home me-2"></i>العودة للرئيسية
                                </a>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-plus me-2"></i>إضافة مقالات
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- الفوتر -->
    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">
                <i class="fas fa-magic me-2"></i>&copy; 2024 VOILA! Creative Digital Agency. جميع الحقوق محفوظة.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // إضافة تفاعل للبحث
        document.addEventListener('DOMContentLoaded', function() {
            // تحديث النتائج عند تغيير التصنيف
            const categorySelect = document.querySelector('select[name="category_id"]');
            if (categorySelect) {
                categorySelect.addEventListener('change', function() {
                    this.form.submit();
                });
            }

            // تأثيرات إضافية
            const searchInput = document.querySelector('input[name="q"]');
            if (searchInput) {
                searchInput.focus();
            }
        });
    </script>
</body>
</html>