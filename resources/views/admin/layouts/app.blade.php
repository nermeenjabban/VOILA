<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - VOILA! Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Tahoma", sans-serif;
        }

        /* ===== Sidebar ===== */
        .sidebar {
            position: fixed;
            top: 0;
            right: -260px; /* hidden by default */
            width: 260px;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            z-index: 2000;
            padding: 25px 20px;
            transition: right 0.4s ease;
        }

        .sidebar.active {
            right: 0; /* Show menu */
        }

        .sidebar .nav-link {
            color: white !important;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: 0.3s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.15);
        }

        /* Overlay behind sidebar */
        .overlay {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.45);
            z-index: 1500;
            display: none;
        }

        .overlay.active {
            display: block;
        }

        /* ===== Main content ===== */
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        .main-content {
            padding: 20px;
            margin-top: 80px;
        }

        /* Desktop sidebar (always visible) */
        @media (min-width: 992px) {
            .sidebar {
                right: 0;
            }
            .overlay {
                display: none !important;
            }
            .main-content {
                margin-right: 260px;
            }
            #openSidebarBtn {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- ===== Overlay ===== -->
    <div id="overlay" class="overlay"></div>

    <!-- ===== Sidebar (Drawer) ===== -->
    <div id="sidebar" class="sidebar">
        <h4 class="text-center mb-3"><i class="fas fa-magic me-2"></i>VOILA!</h4>

        <div class="text-center mb-4">
            <i class="fas fa-user-circle fa-3x mb-2"></i>
            <h6>{{ Auth::user()->name }}</h6>
            <small class="badge bg-light text-primary">
                {{ Auth::user()->role == 'admin' ? 'مدير' : 'محرر' }}
            </small>
        </div>

        <nav class="nav flex-column">

            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt me-2"></i> لوحة التحكم
            </a>

            <a class="nav-link" href="{{ route('admin.articles.index') }}">
                <i class="fas fa-newspaper me-2"></i> المقالات
            </a>

            <a class="nav-link" href="{{ route('admin.categories.index') }}">
                <i class="fas fa-tags me-2"></i> التصنيفات
            </a>

            <a class="nav-link" href="{{ route('admin.comments.index') }}">
                <i class="fas fa-comments me-2"></i> التعليقات
            </a>

            <a class="nav-link" href="{{ route('admin.contact-messages.index') }}">
                <i class="fas fa-envelope me-2"></i> رسائل الاتصال
            </a>

            @if(Auth::user()->role == 'admin')
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users me-2"></i> المستخدمين
                </a>
            @endif

            <hr class="border-light">

            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                <i class="fas fa-external-link-alt me-2"></i> عرض الموقع
            </a>

            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i> تسجيل الخروج
            </a>

            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                @csrf
            </form>
        </nav>
    </div>

    <!-- ===== Navbar ===== -->
    <nav class="navbar fixed-top px-3">
        <div class="d-flex align-items-center w-100">

            <!-- Button for mobile sidebar -->
            <button id="openSidebarBtn" class="btn btn-primary me-3">
                <i class="fas fa-bars"></i>
            </button>

            <h4 class="mb-0">@yield('title')</h4>

            <div class="mx-auto d-flex align-items-center">
    <span class="text-muted me-2">
        مرحباً، {{ Auth::user()->name }}
    </span>

    <div class="dropdown">
        <button class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
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

    <!-- ===== Main Content ===== -->
    <div class="main-content">
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                <button class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')

    </div>

    <!-- ===== Scripts ===== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");
        const openBtn = document.getElementById("openSidebarBtn");

        openBtn.addEventListener("click", () => {
            sidebar.classList.add("active");
            overlay.classList.add("active");
        });

        overlay.addEventListener("click", () => {
            sidebar.classList.remove("active");
            overlay.classList.remove("active");
        });
    </script>

    @yield('scripts')

</body>
</html>
