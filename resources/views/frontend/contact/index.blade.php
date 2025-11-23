<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اتصل بنا - VOILA!</title>
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
        .contact-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 80px 0 60px;
            margin-bottom: 50px;
        }
        .contact-form {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            padding: 40px;
            margin-bottom: 50px;
        }
        .contact-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 20px;
            padding: 40px;
            height: 100%;
        }
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 30px;
        }
        .info-item i {
            font-size: 1.5rem;
            margin-left: 15px;
            margin-top: 5px;
        }
        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .map-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
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
                    <a class="nav-link" href="{{ route('contact.index') }}">
    <i class="fas fa-envelope me-1"></i>اتصل بنا
</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">
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
                    <h1 class="display-4 fw-bold mb-4">اتصل بنا</h1>
                    <p class="lead mb-0">نحن هنا لمساعدتك! تواصل معنا لأي استفسار أو ملاحظة</p>
                </div>
            </div>
        </div>
    </section>

    <!-- محتوى الصفحة -->
    <div class="container">
        @if(session('success'))
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                <div class="contact-form">
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
                <div class="map-container mb-5">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3610.178763990367!2d55.27218711500938!3d25.19751498389622!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f43348a67e24b%3A0xff45e502e1ceb7e2!2sBurj%20Khalifa!5e0!3m2!1sen!2sae!4v1640000000000!5m2!1sen!2sae" 
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
                <div class="contact-info">
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
                    <div class="mt-5">
                        <h5 class="mb-3">تابعنا على</h5>
                        <div class="d-flex">
                            <a href="#" class="btn btn-outline-light btn-sm me-2">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-outline-light btn-sm me-2">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="btn btn-outline-light btn-sm me-2">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="btn btn-outline-light btn-sm">
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
                <div class="text-center mb-5">
                    <h3 class="mb-4">لماذا تختار VOILA؟</h3>
                </div>
                <div class="row text-center">
                    <div class="col-md-3 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body py-4">
                                <i class="fas fa-bolt fa-2x text-warning mb-3"></i>
                                <h5>سريع الاستجابة</h5>
                                <p class="text-muted">نرد على استفساراتك خلال 24 ساعة</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body py-4">
                                <i class="fas fa-headset fa-2x text-primary mb-3"></i>
                                <h5>دعم فني</h5>
                                <p class="text-muted">فريق دعم متاح على مدار الساعة</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body py-4">
                                <i class="fas fa-shield-alt fa-2x text-success mb-3"></i>
                                <h5>آمن ومضمون</h5>
                                <p class="text-muted">بياناتك محمية ومشفرة</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body py-4">
                                <i class="fas fa-star fa-2x text-info mb-3"></i>
                                <h5>جودة عالية</h5>
                                <p class="text-muted">نقدم أفضل الحلول التقنية</p>
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