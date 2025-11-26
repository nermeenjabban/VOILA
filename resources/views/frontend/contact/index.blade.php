<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اتصل بنا - VOILA!</title>
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

        /* رأس الصفحة */
        .contact-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--accent-color) 100%);
            color: white;
            padding: 100px 0 50px;
            position: relative;
            overflow: hidden;
        }

        .contact-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.05)" points="0,1000 1000,0 1000,1000"/></svg>');
            background-size: cover;
        }

        /* نموذج الاتصال */
        .contact-form {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow);
            padding: 2.5rem;
            border: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 3rem;
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

        /* معلومات الاتصال */
        .contact-info {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-radius: 20px;
            padding: 2.5rem;
            height: 100%;
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: var(--shadow);
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding: 1rem;
            border-radius: 15px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            transition: var(--transition);
        }

        .info-item:hover {
            background: rgba(255,255,255,0.15);
            transform: translateX(-5px);
        }

        .info-item i {
            font-size: 1.5rem;
            margin-left: 1rem;
            margin-top: 0.25rem;
            background: linear-gradient(45deg, #fff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .info-item h5 {
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .info-item p {
            margin-bottom: 0;
            opacity: 0.9;
        }

        /* خريطة */
        .map-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid rgba(0,0,0,0.05);
        }

        /* بطاقات الميزات */
        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 1px solid rgba(0,0,0,0.05);
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* وسائل التواصل الاجتماعي */
        .social-links {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .social-btn {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.1);
            color: white;
            text-decoration: none;
            transition: var(--transition);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .social-btn:hover {
            background: rgba(255,255,255,0.2);
            transform: translateY(-2px);
            color: white;
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

        @media (max-width: 768px) {
            .contact-header {
                padding: 80px 0 30px;
            }
            
            .contact-form, .contact-info {
                padding: 2rem;
            }
            
            .info-item {
                margin-bottom: 1.5rem;
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
                        <a class="nav-link active" href="{{ route('contact.index') }}">
                            <i class="fas fa-envelope me-1"></i>اتصل بنا
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            <i class="fas fa-cog me-1"></i>لوحة التحكم
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- رأس الصفحة -->
    <section class="contact-header">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="display-5 fw-bold mb-4 fade-in">اتصل بنا</h1>
                    <p class="lead mb-0 fade-in">نحن هنا لمساعدتك! تواصل معنا لأي استفسار أو ملاحظة</p>
                </div>
            </div>
        </div>
    </section>

    <!-- محتوى الصفحة -->
    <div class="container">
        @if(session('success'))
            <div class="row mb-4 fade-in">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show border-0" role="alert" style="border-radius: 15px;">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <!-- نموذج الاتصال -->
            <div class="col-lg-8">
                <div class="contact-form fade-in">
                    <h3 class="mb-4">
                        <i class="fas fa-paper-plane me-2 text-primary"></i>
                        أرسل رسالة
                    </h3>
                    
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="name" class="form-label">الاسم الكامل *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="email" class="form-label">البريد الإلكتروني *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="subject" class="form-label">موضوع الرسالة *</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                   id="subject" name="subject" value="{{ old('subject') }}" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="message" class="form-label">الرسالة *</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" name="message" rows="6" 
                                      placeholder="اكتب رسالتك هنا..." required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>إرسال الرسالة
                        </button>
                    </form>
                </div>

                <!-- خريطة -->
                <div class="map-container mb-5 fade-in">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3610.178763990367!2d55.27218711500938!3d25.19753498389622!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43348a67e24b%3A0xff45e502e1ceb7e2!2sBurj%20Khalifa!5e0!3m2!1sen!2sae!4v1640000000000!5m2!1sen!2sae" 
                        width="100%" 
                        height="300" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>

            <!-- معلومات الاتصال -->
            <div class="col-lg-4">
                <div class="contact-info fade-in">
                    <h3 class="mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        معلومات التواصل
                    </h3>
                    
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h5>العنوان</h5>
                            <p>دبي، الإمارات العربية المتحدة<br>برج خليفة، الطابق 15</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h5>الهاتف</h5>
                            <p>+971 4 123 4567</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h5>البريد الإلكتروني</h5>
                            <p>info@voila.digital</p>
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h5>ساعات العمل</h5>
                            <p>الأحد - الخميس<br>9:00 ص - 6:00 م</p>
                        </div>
                    </div>

                    <!-- وسائل التواصل الاجتماعي -->
                    <div class="mt-5 pt-3 border-top border-white-50">
                        <h5 class="mb-3">تابعنا على</h5>
                        <div class="social-links">
                            <a href="#" class="social-btn">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-btn">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-btn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="social-btn">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- إحصائيات سريعة -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="text-center mb-5 fade-in">
                    <h3 class="mb-4">لماذا تختار VOILA؟</h3>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-4 fade-in">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <h5>سريع الاستجابة</h5>
                            <p class="text-muted mb-0">نرد على استفساراتك خلال 24 ساعة</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 fade-in">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h5>دعم فني</h5>
                            <p class="text-muted mb-0">فريق دعم متاح على مدار الساعة</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 fade-in">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h5>آمن ومضمون</h5>
                            <p class="text-muted mb-0">بياناتك محمية ومشفرة</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4 fade-in">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <h5>جودة عالية</h5>
                            <p class="text-muted mb-0">نقدم أفضل الحلول التقنية</p>
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