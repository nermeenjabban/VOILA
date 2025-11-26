<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - VOILA!</title>
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
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 50%, var(--accent-color) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* حاوية التسجيل */
        .login-container {
            background: white;
            border-radius: 25px;
            box-shadow: var(--shadow);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            border: 1px solid rgba(0,0,0,0.05);
            transition: var(--transition);
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        /* رأس التسجيل */
        .login-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 2.5rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><polygon fill="rgba(255,255,255,0.05)" points="0,1000 1000,0 1000,1000"/></svg>');
            background-size: cover;
        }

        .brand-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            background: linear-gradient(45deg, #fff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: block;
        }

        /* جسم التسجيل */
        .login-body {
            padding: 2.5rem;
        }

        /* حقول الإدخال */
        .form-control {
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

        .form-control:focus {
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .input-group-text {
            background: transparent;
            border: none;
            border-radius: 15px 0 0 15px;
        }

        /* زر التسجيل */
        .btn-primary {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 15px;
            padding: 1rem 2rem;
            font-weight: 600;
            transition: var(--transition);
            width: 100%;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        /* التنبيهات */
        .alert {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .alert-danger {
            background: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
            color: #c53030;
        }

        /* خانة التذكر */
        .form-check-input {
            border-radius: 6px;
            border: 2px solid #e2e8f0;
            transition: var(--transition);
        }

        .form-check-input:checked {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border-color: var(--primary-color);
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* روابط */
        .back-link {
            color: var(--text-light);
            text-decoration: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-link:hover {
            color: var(--primary-color);
            transform: translateX(-5px);
        }

        /* بطاقة بيانات الاختبار */
        .test-data-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255,255,255,0.2);
            margin-top: 2rem;
            transition: var(--transition);
        }

        .test-data-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }

        .test-data-card .card-body {
            padding: 1.5rem;
        }

        .user-role {
            display: inline-block;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* تأثيرات التحميل */
        .fade-in {
            animation: fadeIn 0.8s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .login-container {
                margin: 1rem;
                max-width: none;
            }
            
            .login-header {
                padding: 2rem;
            }
            
            .login-body {
                padding: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="login-container fade-in">
                    <div class="login-header">
                        <i class="fas fa-magic brand-icon"></i>
                        <h3 class="mb-2">VOILA! Admin</h3>
                        <p class="mb-0 opacity-90">لوحة تحكم المشرفين</p>
                    </div>
                    
                    <div class="login-body">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ $errors->first() }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label fw-semibold">البريد الإلكتروني</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                           placeholder="ادخل بريدك الإلكتروني">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">كلمة المرور</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="current-password"
                                           placeholder="ادخل كلمة المرور">
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            

                            <div class="d-grid gap-2 mb-4">
                                <button type="submit" class="btn btn-primary py-2">
                                    <i class="fas fa-sign-in-alt me-2"></i>تسجيل الدخول
                                </button>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('home') }}" class="back-link">
                                    <i class="fas fa-arrow-right me-1"></i>العودة للرئيسية
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // تأثيرات التحميل
        document.addEventListener('DOMContentLoaded', function() {
            const fadeElements = document.querySelectorAll('.fade-in');
            
            fadeElements.forEach((el, index) => {
                el.style.opacity = 0;
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'all 0.6s ease-out';
                
                setTimeout(() => {
                    el.style.opacity = 1;
                    el.style.transform = 'translateY(0)';
                }, index * 200);
            });

            // إضافة تأثير عند التركيز على الحقول
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>