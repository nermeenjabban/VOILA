<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - VOILA!</title>
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
        .article-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0 40px;
            margin-bottom: 40px;
        }
        .article-image {
            max-height: 500px;
            object-fit: cover;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .article-content {
            line-height: 1.8;
            font-size: 1.1rem;
        }
        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin: 20px 0;
        }
        .related-article-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        .related-article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .comment-card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 12px;
            margin-bottom: 20px;
        }
        .comment-form {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .badge-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
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
                        <a class="nav-link" href="#">
                            <i class="fas fa-envelope me-1"></i>اتصل بنا
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- رأس المقال -->
    <section class="article-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="/category/{{ $article->category->id }}" class="text-white">{{ $article->category->name }}</a></li>
                            <li class="breadcrumb-item active text-white" aria-current="page">المقال</li>
                        </ol>
                    </nav>
                    
                    <span class="badge badge-custom mb-3">{{ $article->category->name }}</span>
                    <h1 class="display-4 fw-bold mb-4">{{ $article->title }}</h1>
                    
                    <div class="d-flex align-items-center text-white-50">
                        <div class="d-flex align-items-center me-4">
                            <i class="fas fa-user me-2"></i>
                            <span>{{ $article->author->name }}</span>
                        </div>
                        <div class="d-flex align-items-center me-4">
                            <i class="fas fa-calendar me-2"></i>
                            <span>{{ $article->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-comments me-2"></i>
                            <span>{{ $article->approvedComments->count() }} تعليق</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- محتوى المقال -->
    <div class="container">
        <div class="row">
            <!-- المحتوى الرئيسي -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-5">
                    <div class="card-body p-4">
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" class="article-image w-100 mb-4" alt="{{ $article->title }}">
                        @endif
                        
                        <div class="article-content">
                            {!! $article->content !!}
                        </div>

                        <!-- وسوم المشاركة -->
                        <div class="border-top pt-4 mt-4">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted me-3">شارك هذا المقال:</span>
                                </div>
                                <div>
                                    <a href="#" class="btn btn-outline-primary btn-sm me-2">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-info btn-sm me-2">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="btn btn-outline-danger btn-sm">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- التعليقات -->
                <div class="card border-0 shadow-sm mb-5">
                    <div class="card-header bg-transparent border-0 py-3">
                        <h4 class="mb-0">
                            <i class="fas fa-comments me-2 text-primary"></i>
                            التعليقات ({{ $article->approvedComments->count() }})
                        </h4>
                    </div>
                    <div class="card-body">
                        @if($article->approvedComments->count() > 0)
                            @foreach($article->approvedComments as $comment)
                                <div class="comment-card card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="card-title mb-0">{{ $comment->author_name }}</h6>
                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="card-text text-muted mb-0">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                                <p class="text-muted">لا توجد تعليقات بعد. كن أول من يعلق!</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- نموذج إضافة تعليق -->
                <div class="comment-form">
                    <h4 class="mb-4">
                        <i class="fas fa-edit me-2 text-primary"></i>
                        أضف تعليقاً
                    </h4>
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('articles.comments.store', $article->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="author_name" class="form-label">الاسم *</label>
                                    <input type="text" class="form-control @error('author_name') is-invalid @enderror" 
                                           id="author_name" name="author_name" value="{{ old('author_name') }}" required>
                                    @error('author_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="author_email" class="form-label">البريد الإلكتروني *</label>
                                    <input type="email" class="form-control @error('author_email') is-invalid @enderror" 
                                           id="author_email" name="author_email" value="{{ old('author_email') }}" required>
                                    @error('author_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">التعليق *</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" 
                                      id="content" name="content" rows="5" 
                                      placeholder="اكتب تعليقك هنا..." required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">سيظهر تعليقك بعد المراجعة من قبل المشرف.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>إرسال التعليق
                        </button>
                    </form>
                </div>
            </div>

            <!-- الشريط الجانبي -->
            <div class="col-lg-4">
                <!-- المقالات ذات الصلة -->
                @if($relatedArticles->count() > 0)
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-transparent border-0 py-3">
                            <h5 class="mb-0">
                                <i class="fas fa-link me-2 text-primary"></i>
                                مقالات ذات صلة
                            </h5>
                        </div>
                        <div class="card-body">
                            @foreach($relatedArticles as $relatedArticle)
                                <div class="card related-article-card mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <a href="{{ route('articles.show', $relatedArticle->id) }}" 
                                               class="text-decoration-none text-dark">
                                                {{ Str::limit($relatedArticle->title, 50) }}
                                            </a>
                                        </h6>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $relatedArticle->created_at->format('Y-m-d') }}
                                            </small>
                                            <span class="badge bg-primary rounded-pill" style="font-size: 0.7rem;">
                                                {{ $relatedArticle->category->name }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- معلومات الكاتب -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0 py-3">
                        <h5 class="mb-0">
                            <i class="fas fa-user me-2 text-primary"></i>
                            عن الكاتب
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-user-circle fa-3x text-primary"></i>
                        </div>
                        <h6>{{ $article->author->name }}</h6>
                        <p class="text-muted small mb-3">كاتب ومطور ويب</p>
                        <div class="d-flex justify-content-center">
                            <a href="#" class="btn btn-outline-primary btn-sm me-2">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
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