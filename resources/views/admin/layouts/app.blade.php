<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - VOILA! Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-height: 100vh;
            position: fixed;
            width: 250px;
            top: 0;
            right: 0;
        }
        .main-content {
            margin-right: 250px;
            padding: 20px;
            min-height: 100vh;
        }
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 20px;
        }
        .sidebar .nav-link {
            color: white;
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
        }
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
        }
        .card {
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            border: none;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <!-- الشريط الجانبي -->
    <div class="sidebar">
        <div class="p-4">
            <h4 class="text-center mb-4">
                <i class="fas fa-magic me-2"></i>VOILA!
            </h4>
            
            <div class="text-center mb-4">
                <i class="fas fa-user-circle fa-3x mb-2"></i>
                <h6>{{ Auth::user()->name }}</h6>
                <small class="badge bg-light text-primary">
                    {{ Auth::user()->role == 'admin' ? 'مدير' : 'محرر' }}
                </small>
            </div>

            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>لوحة التحكم
                </a>
                <a class="nav-link" href="{{ route('admin.articles.index') }}">
                    <i class="fas fa-newspaper me-2"></i>المقالات
                </a>
                <a class="nav-link" href="{{ route('admin.categories.index') }}">
    <i class="fas fa-tags me-2"></i>التصنيفات
</a>
<a class="nav-link" href="{{ route('admin.comments.index') }}">
    <i class="fas fa-comments me-2"></i>التعليقات
</a>
<a class="nav-link" href="{{ route('admin.contact-messages.index') }}">
    <i class="fas fa-envelope me-2"></i>رسائل الاتصال
</a>
                
                @if(Auth::user()->role == 'admin')
              
    <a class="nav-link" href="{{ route('admin.users.index') }}">
        <i class="fas fa-users me-2"></i>المستخدمين
    </a>
@endif
               
                
                <hr>
                <a class="nav-link" href="{{ route('home') }}" target="_blank">
                    <i class="fas fa-external-link-alt me-2"></i>عرض الموقع
                </a>
                <a class="nav-link" href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt me-2"></i>تسجيل الخروج
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </nav>
        </div>
    </div>

    <!-- المحتوى الرئيسي -->
    <div class="main-content">
        <!-- شريط التنقل العلوي -->
        <nav class="navbar">
            <div class="container-fluid">
                <h4 class="mb-0">@yield('title')</h4>
                <div class="d-flex align-items-center">
                    <span class="text-muted me-3">مرحباً، {{ Auth::user()->name }}</span>
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" 
                                data-bs-toggle="dropdown">
                            <i class="fas fa-cog"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">الملف الشخصي</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    تسجيل الخروج
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- الرسائل -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- المحتوى -->
        <div class="mt-4">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>