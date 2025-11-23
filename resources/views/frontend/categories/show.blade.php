<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تصنيف: {{ $category->name }} - VOILA!</title>
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
        .category-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
        }
        .article-card {
            transition: transform 0.3s ease;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 15px;
            overflow: hidden;
        }
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
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
            background: rgba(102, 126, 234, 0.9);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        .category-sidebar {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 25px;
        }
        .category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .category-list li {
            margin-bottom: 10px;
        }
        .category-list a {
            text-decoration: none;
            color: #333;
            padding: 10px 15px;
            border-radius: 8px;
            display: block;
            transition: all 0.3s ease;
        }
        .category-list a:hover {
            background: #667eea;
            color: white;
        }
        .category-list a.active {
            background: #667eea;
            color: white;
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
            <div class="collapse navbar-collapse">
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
                <div class="col-12 text-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">الرئيسية</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">التصنيفات</li>
                        </ol>
                    </nav>
                    
                    <h1 class="display-4 fw-bold mb-3">
                        <i class="fas fa-folder me-3"></i>{{ $category->name }}
                    </h1>
                    
                    @if($category->description)
                        <p class="lead mb-4">{{ $category->description }}</p>
                    @endif
                    
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="d-flex align-items-center text-white me-4">
                            <i class="fas fa-newspaper me-2"></i>
                            <span>{{ $articles->total() }} مقال</span>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <i class="fas fa-layer-group me-2"></i>
                            <span>تصنيف</span>
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
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="alert alert-info border-0">
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
                                    <span class="category-badge" style="position: absolute; top: 10px; left: 10px;">
                                        {{ $article->category->name }}
                                    </span>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">{{ Str::limit($article->title, 60) }}</h5>
                                    <p class="card-text flex-grow-1 text-muted">
                                        @if($article->content)
                                            {{ Str::limit(strip_tags($article->content), 100) }}
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
                                            {{ $article->created_at->format('Y-m-d') }}
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
                    @if($articles->hasPages())
                    <div class="row mt-5">
                        <div class="col-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    {{ $articles->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                    @endif

                @else
                    <!-- لا توجد مقالات -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body text-center py-5">
                                    <i class="fas fa-folder-open fa-4x text-muted mb-4"></i>
                                    <h3 class="text-muted">لا توجد مقالات في هذا التصنيف</h3>
                                    <p class="text-muted mb-4">
                                        لم يتم إضافة أي مقالات إلى تصنيف "{{ $category->name }}" بعد.
                                    </p>
                                    <div class="mt-3">
                                        <a href="{{ route('home') }}" class="btn btn-primary me-2">
                                            <i class="fas fa-home me-2"></i>العودة للرئيسية
                                        </a>
                                        <a href="/admin" class="btn btn-outline-primary">
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
                <div class="category-sidebar mb-4">
                    <h5 class="mb-4">
                        <i class="fas fa-tags me-2 text-primary"></i>
                        جميع التصنيفات
                    </h5>
                    <ul class="category-list">
                        @foreach($categories as $cat)
                            <li>
                                <a href="/category/{{ $cat->id }}" 
                                   class="{{ $cat->id == $category->id ? 'active' : '' }}">
                                    <i class="fas fa-folder me-2"></i>
                                    {{ $cat->name }}
                                    <span class="badge bg-secondary float-start ms-2">{{ $cat->articles()->where('is_published', true)->count() }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- إحصائيات -->
                <div class="category-sidebar">
                    <h5 class="mb-4">
                        <i class="fas fa-chart-bar me-2 text-primary"></i>
                        إحصائيات التصنيف
                    </h5>
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-newspaper fa-2x text-primary mb-2"></i>
                                <h4 class="mb-1">{{ $articles->total() }}</h4>
                                <small class="text-muted">مقال</small>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-calendar fa-2x text-success mb-2"></i>
                                <h4 class="mb-1">{{ $category->created_at->format('Y') }}</h4>
                                <small class="text-muted">سنة الإنشاء</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</body>
</html>