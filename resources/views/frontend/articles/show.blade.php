<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} - VOILA!</title>
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

        /* رأس المقال */
        .article-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--accent-color) 100%);
            color: white;
            padding: 100px 0 50px;
            position: relative;
            overflow: hidden;
        }

        .article-header::before {
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

        .badge-custom {
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            color: white;
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            border: 1px solid rgba(255,255,255,0.3);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        /* محتوى المقال */
        .article-image {
            max-height: 500px;
            width: 100%;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: var(--shadow);
            margin-bottom: 2rem;
        }

        .article-content {
            line-height: 1.8;
            font-size: 1.1rem;
            color: var(--text-dark);
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            margin: 2rem 0;
            box-shadow: var(--shadow);
        }

        .article-content h1,
        .article-content h2,
        .article-content h3,
        .article-content h4 {
            color: var(--text-dark);
            margin: 2rem 0 1rem;
            font-weight: 700;
        }

        .article-content p {
            margin-bottom: 1.5rem;
        }

        .article-content ul, 
        .article-content ol {
            margin-bottom: 1.5rem;
            padding-right: 2rem;
        }

        .article-content li {
            margin-bottom: 0.5rem;
        }

        /* البطاقات */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            background: white;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 1.5rem 1.5rem 0.5rem;
        }

        /* المقالات ذات الصلة */
        .related-article-card {
            border-radius: 15px;
            overflow: hidden;
            margin-bottom: 1rem;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .related-article-card:hover {
            transform: translateY(-3px);
        }

        .related-article-card .card-body {
            padding: 1.25rem;
        }

        .related-article-card .card-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .related-article-card .card-title a {
            color: var(--text-dark);
            text-decoration: none;
            transition: var(--transition);
        }

        .related-article-card .card-title a:hover {
            color: var(--primary-color);
        }

        /* التعليقات */
        .comment-card {
            border-radius: 15px;
            margin-bottom: 1rem;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .comment-card .card-body {
            padding: 1.5rem;
        }

        /* نموذج التعليق */
        .comment-form {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow);
            padding: 2rem;
            border: 1px solid rgba(0,0,0,0.05);
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
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .form-control:focus, .form-select:focus {
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 15px;
            padding: 1rem 2rem;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
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

        /* معلومات الكاتب */
        .author-card {
            text-align: center;
            padding: 2rem;
        }

        .author-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 2rem;
        }

        /* التبويبات */
        .meta-info {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255,255,255,0.9);
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .article-header {
                padding: 80px 0 30px;
            }
            
            .meta-info {
                justify-content: center;
                gap: 1rem;
            }
            
            .meta-item {
                font-size: 0.8rem;
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
                        <a class="nav-link" href="{{ route('contact.index') }}">
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
                    <!-- <nav aria-label="breadcrumb" class="fade-in">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                            <li class="breadcrumb-item"><a href="/category/{{ $article->category->id }}">{{ $article->category->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">المقال</li>
                        </ol>
                    </nav> -->
                    
                    <span class="badge badge-custom mb-3 fade-in">{{ $article->category->name }}</span>
                    <h1 class="display-5 fw-bold mb-4 fade-in">{{ $article->title }}</h1>
                    
                    <div class="meta-info fade-in">
                        <div class="meta-item">
                            <i class="fas fa-user"></i>
                            <span>{{ $article->author->name }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-calendar"></i>
                            <span>{{ $article->created_at->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-comments"></i>
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
                <div class="card mb-5 fade-in">
                    <div class="card-body p-4">
                    @if($article->image)
    <img src="{{ asset($article->image) }}" 
         class="article-image" 
         alt="{{ $article->title }}">
@endif
                        
                        <div class="article-content">
                            {!! $article->content !!}
                        </div>

                      
                    </div>
                </div>

                <!-- التعليقات -->
                <div class="card mb-5 fade-in">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <i class="fas fa-comments me-2 text-primary"></i>
                            التعليقات ({{ $article->approvedComments->count() }})
                        </h4>
                    </div>
                    <div class="card-body">
                        @if($article->approvedComments->count() > 0)
                            @foreach($article->approvedComments as $comment)
                                <div class="comment-card card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="card-title mb-0 text-primary">{{ $comment->author_name }}</h6>
                                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="card-text text-dark mb-0">{{ $comment->content }}</p>
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
                <div class="comment-form fade-in">
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
                    <div class="card mb-4 fade-in">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-link me-2 text-primary"></i>
                                مقالات ذات صلة
                            </h5>
                        </div>
                        <div class="card-body">
                            @foreach($relatedArticles as $relatedArticle)
                                <div class="card related-article-card">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <a href="{{ route('articles.show', $relatedArticle->id) }}" 
                                               class="text-decoration-none">
                                                {{ Str::limit($relatedArticle->title, 50) }}
                                            </a>
                                        </h6>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <small class="text-muted">
                                                <i class="fas fa-calendar me-1"></i>
                                                {{ $relatedArticle->created_at->format('Y-m-d') }}
                                            </small>
                                            <span class="badge rounded-pill" 
                                                  style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color)); font-size: 0.7rem;">
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
                <div class="card fade-in">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-user me-2 text-primary"></i>
                            عن الكاتب
                        </h5>
                    </div>
                    <div class="card-body author-card">
                        <div class="author-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <h6 class="text-primary">{{ $article->author->name }}</h6>
                        <p class="text-muted small mb-3">كاتب ومطور ويب متخصص</p>
                        <p class="text-muted small">
                            كاتب محتوى تقني ومطور ويب بخبرة واسعة في مجال البرمجة والتكنولوجيا.
                        </p>
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