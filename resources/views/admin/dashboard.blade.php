@extends('admin.layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
@php
    use App\Models\ContactMessage;
    use App\Models\Article;
    use App\Models\Comment;
    use App\Models\User;
    
    $stats = [
        'articles' => Article::count(),
        'comments' => Comment::count(),
        'contacts' => ContactMessage::count(),
        'users' => User::count(),
        'unread_contacts' => ContactMessage::where('reviewed', false)->count()
    ];
@endphp

<div class="container-fluid">
    <!-- الإحصائيات -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 stats-card">
                <div class="card-body text-center">
                    <div class="stats-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h3 class="stats-number">{{ $stats['articles'] }}</h3>
                    <p class="stats-text">المقالات</p>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 stats-card">
                <div class="card-body text-center">
                    <div class="stats-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="stats-number">{{ $stats['comments'] }}</h3>
                    <p class="stats-text">التعليقات </p>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 stats-card">
                <div class="card-body text-center">
                    <div class="stats-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 class="stats-number">{{ $stats['contacts'] }}</h3>
                    <p class="stats-text">رسائل الاتصال</p>
                    @if($stats['unread_contacts'] > 0)
                        <div class="unread-badge">
                            <span class="badge bg-danger">
                                <i class="fas fa-bell me-1"></i>
                                {{ $stats['unread_contacts'] }} جديدة
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 stats-card">
                <div class="card-body text-center">
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="stats-number">{{ $stats['users'] }}</h3>
                    <p class="stats-text">المستخدمين</p>
                </div>
            </div>
        </div>
    </div>

    <!-- محتوى إضافي -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm welcome-card">
                <div class="card-body">
                    <div class="welcome-header">
                        <h5 class="card-title">
                            <i class="fas fa-magic me-2 text-primary"></i>
                            مرحباً بك في لوحة تحكم VOILA!
                        </h5>
                        <p class="welcome-text">
                            هذه لوحة التحكم الخاصة بنظام إدارة المحتوى. يمكنك من هنا إدارة المقالات، التصنيفات، 
                            التعليقات، ورسائل الاتصال.
                        </p>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="features-section">
                                <h6 class="section-title">
                                    <i class="fas fa-list-check me-2 text-success"></i>
                                    الصلاحيات المتاحة:
                                </h6>
                                <ul class="features-list">
                                    <li>
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        إدارة المقالات والتعديل عليها
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        التحكم في التعليقات وموافقتها
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        عرض رسائل الاتصال والرد عليها
                                    </li>
                                    @if(Auth::user()->role == 'admin')
                                    <li>
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        إدارة المستخدمين والصلاحيات
                                    </li>
                                    <li>
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        التحكم الكامل في النظام
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="user-info-section">
                                <h6 class="section-title">
                                    <i class="fas fa-user-circle me-2 text-info"></i>
                                    معلومات المستخدم:
                                </h6>
                                <div class="user-details">
                                    <div class="user-detail-item">
                                        <i class="fas fa-shield-alt me-2 text-primary"></i>
                                        <span class="detail-label">الدور:</span>
                                        <span class="detail-value">
                                            @if(Auth::user()->role == 'admin')
                                                <span class="badge bg-primary">مدير نظام</span>
                                            @else
                                                <span class="badge bg-success">محرر</span>
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="user-detail-item">
                                        <i class="fas fa-envelope me-2 text-primary"></i>
                                        <span class="detail-label">البريد الإلكتروني:</span>
                                        <span class="detail-value">{{ Auth::user()->email }}</span>
                                    </div>
                                    
                                    <div class="user-detail-item">
                                        <i class="fas fa-calendar me-2 text-primary"></i>
                                        <span class="detail-label">تاريخ التسجيل:</span>
                                        <span class="detail-value">{{ Auth::user()->created_at->translatedFormat('d F Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- روابط سريعة -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="quick-links-section">
                                <h6 class="section-title">
                                    <i class="fas fa-rocket me-2 text-warning"></i>
                                    روابط سريعة:
                                </h6>
                                <div class="quick-links">
                                    <a href="{{ route('admin.articles.index') }}" class="quick-link-btn">
                                        <i class="fas fa-newspaper me-2"></i>
                                        <span>إدارة المقالات</span>
                                    </a>
                                    
                                    <a href="{{ route('admin.articles.create') }}" class="quick-link-btn">
                                        <i class="fas fa-plus me-2"></i>
                                        <span>مقال جديد</span>
                                    </a>
                                    
                                    <a href="{{ route('admin.contact-messages.index') }}" class="quick-link-btn">
                                        <i class="fas fa-envelope me-2"></i>
                                        <span>رسائل الاتصال</span>
                                        @if($stats['unread_contacts'] > 0)
                                            <span class="notification-badge">{{ $stats['unread_contacts'] }}</span>
                                        @endif
                                    </a>
                                    
                                    <a href="{{ route('home') }}" target="_blank" class="quick-link-btn">
                                        <i class="fas fa-external-link-alt me-2"></i>
                                        <span>عرض الموقع</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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

/* بطاقات الإحصائيات */
.stats-card {
    border-radius: 20px;
    transition: var(--transition);
    border: 1px solid rgba(0,0,0,0.05);
    background: white;
}

.stats-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.stats-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.stats-number {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.stats-text {
    color: var(--text-light);
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.unread-badge {
    margin-top: 0.5rem;
}

/* بطاقة الترحيب */
.welcome-card {
    border-radius: 20px;
    border: 1px solid rgba(0,0,0,0.05);
    background: white;
}

.welcome-header {
    text-align: center;
    margin-bottom: 2rem;
}

.welcome-header .card-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.welcome-text {
    color: var(--text-light);
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 0;
}

/* الأقسام */
.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid var(--primary-color);
    display: inline-block;
}

/* قائمة الميزات */
.features-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.features-list li {
    padding: 0.5rem 0;
    color: var(--text-dark);
    font-size: 1rem;
}

/* معلومات المستخدم */
.user-details {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 15px;
    padding: 1.5rem;
}

.user-detail-item {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    padding: 0.5rem;
    border-radius: 10px;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.user-detail-item:last-child {
    margin-bottom: 0;
}

.detail-label {
    font-weight: 600;
    color: var(--text-dark);
    margin-left: 0.5rem;
}

.detail-value {
    color: var(--text-light);
    margin-right: auto;
}

/* الروابط السريعة */
.quick-links {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.quick-link-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem 1.5rem;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    text-decoration: none;
    border-radius: 15px;
    transition: var(--transition);
    font-weight: 600;
    position: relative;
}

.quick-link-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    color: white;
}

.notification-badge {
    position: absolute;
    top: -8px;
    left: -8px;
    background: #dc3545;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 0.7rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
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
    .quick-links {
        grid-template-columns: 1fr;
    }
    
    .user-detail-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .stats-number {
        font-size: 2rem;
    }
}
</style>
@endsection