@extends('admin.layouts.app')

@section('title', 'تفاصيل المستخدم: ' . $user->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card admin-card">
                <div class="card-header admin-card-header">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3 gap-md-0">
                        <h3 class="card-title mb-0 text-center text-md-start">
                            <i class="fas fa-user-circle me-2 text-primary"></i>
                            تفاصيل المستخدم: <span class="text-warning">{{ $user->name }}</span>
                        </h3>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-back w-100 w-md-auto">
                            <i class="fas fa-arrow-right me-2"></i> رجوع للقائمة
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="articles-card">
                                <div class="articles-card-header">
                                    <h5 class="articles-card-title mb-0">
                                        <i class="fas fa-newspaper me-2 text-primary"></i>
                                        مقالات المستخدم
                                    </h5>
                                    <span class="articles-count-badge">{{ $userArticles->total() }}</span>
                                </div>
                                <div class="articles-card-body">
                                    @if($userArticles->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-hover admin-table">
                                                <thead class="admin-table-header">
                                                    <tr>
                                                        <th width="80">#</th>
                                                        <th>عنوان المقال</th>
                                                        <th width="120">التصنيف</th>
                                                        <th width="100">الحالة</th>
                                                        <th width="120">التاريخ</th>
                                                        <th width="120">الإجراءات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($userArticles as $article)
                                                    <tr class="admin-table-row">
                                                        <td>
                                                            <span class="article-id">{{ $article->id }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="article-title">
                                                                <strong>{{ Str::limit($article->title, 50) }}</strong>
                                                                @if($article->comments_enabled)
                                                                    <small class="text-success ms-2">
                                                                        <i class="fas fa-comment"></i>
                                                                    </small>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="category-badge">{{ $article->category->name }}</span>
                                                        </td>
                                                        <td>
                                                            @if($article->is_published)
                                                                <span class="status-badge published">
                                                                    <i class="fas fa-check-circle me-1"></i>منشور
                                                                </span>
                                                            @else
                                                                <span class="status-badge draft">
                                                                    <i class="fas fa-pencil-alt me-1"></i>مسودة
                                                                </span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="date-info">
                                                                <i class="fas fa-calendar me-1 text-muted"></i>
                                                                {{ $article->created_at->format('Y-m-d') }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="action-buttons">
                                                                <a href="{{ route('admin.articles.edit', $article) }}" 
                                                                   class="btn btn-action btn-edit"
                                                                   title="تعديل المقال">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="{{ route('articles.show', $article) }}" 
                                                                   target="_blank" 
                                                                   class="btn btn-action btn-view"
                                                                   title="معاينة المقال">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        @if($userArticles->hasPages())
                                        <div class="pagination-container mt-4">
                                            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3 gap-md-0">
                                                <div class="pagination-info">
                                                    <p class="text-muted mb-0">
                                                        عرض {{ $userArticles->firstItem() }} إلى {{ $userArticles->lastItem() }} من أصل {{ $userArticles->total() }} مقال
                                                    </p>
                                                </div>
                                                <div class="pagination-links">
                                                    {{ $userArticles->links() }}
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @else
                                        <div class="empty-articles text-center py-5">
                                            <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                                            <h4 class="text-muted">لا توجد مقالات</h4>
                                            <p class="text-muted mb-4">لم يقم هذا المستخدم بإضافة أي مقالات بعد</p>
                                            @if(auth()->user()->role === 'admin' || auth()->id() === $user->id)
                                                <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                                                    <i class="fas fa-plus me-2"></i>إضافة مقال جديد
                                                </a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                            <div class="info-sidebar">
                                <div class="user-profile-card">
                                    <div class="user-profile-header">
                                        <h6 class="user-profile-title mb-0">
                                            <i class="fas fa-user me-2 text-primary"></i>
                                            الملف الشخصي
                                        </h6>
                                    </div>
                                    <div class="user-profile-body">
                                        <div class="user-avatar-section text-center mb-4">
                                            <div class="user-avatar-large">
                                                @if($user->avatar)
                                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="avatar-img">
                                                @else
                                                    <div class="avatar-placeholder-large">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <h4 class="user-name mt-3">{{ $user->name }}</h4>
                                            @if($user->role === 'admin')
                                                <span class="role-badge admin">مدير النظام</span>
                                            @else
                                                <span class="role-badge editor">محرر</span>
                                            @endif
                                        </div>

                                        <div class="user-info-list">
                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-envelope text-primary"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>البريد الإلكتروني</h6>
                                                    <p class="text-muted user-email">{{ $user->email }}</p>
                                                </div>
                                            </div>
                                            
                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-chart-line text-success"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>الحالة</h6>
                                                    <p class="text-muted">
                                                        @if($user->is_active)
                                                            <span class="status-badge active">
                                                                <i class="fas fa-check-circle me-1"></i>نشط
                                                            </span>
                                                        @else
                                                            <span class="status-badge inactive">
                                                                <i class="fas fa-times-circle me-1"></i>معطل
                                                            </span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-newspaper text-warning"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>المقالات</h6>
                                                    <div class="articles-count">
                                                        <span class="count-number">{{ $userArticles->total() }}</span>
                                                        <small class="text-muted">مقال</small>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-calendar-plus text-info"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>تاريخ التسجيل</h6>
                                                    <p class="text-muted">{{ $user->created_at->format('Y-m-d H:i') }}</p>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-calendar-check text-info"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>آخر تحديث</h6>
                                                    <p class="text-muted">{{ $user->updated_at->format('Y-m-d H:i') }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="user-actions mt-4">
                                            <div class="d-grid gap-2">
                                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-edit-user">
                                                    <i class="fas fa-edit me-2"></i>تعديل المستخدم
                                                </a>
                                                @if(auth()->id() !== $user->id)
                                                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" 
                                                                class="btn {{ $user->is_active ? 'btn-deactivate' : 'btn-activate' }} w-100"
                                                                title="{{ $user->is_active ? 'تعطيل المستخدم' : 'تفعيل المستخدم' }}">
                                                            <i class="fas {{ $user->is_active ? 'fa-user-slash' : 'fa-user-check' }} me-2"></i>
                                                            {{ $user->is_active ? 'تعطيل المستخدم' : 'تفعيل المستخدم' }}
                                                        </button>
                                                    </form>
                                                @else
                                                    <div class="current-user-notice">
                                                        <i class="fas fa-info-circle me-2 text-info"></i>
                                                        <span class="small text-muted">هذا حسابك الشخصي</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="stats-card mt-4">
                                    <div class="stats-card-header">
                                        <h6 class="stats-card-title mb-0">
                                            <i class="fas fa-chart-bar me-2 text-primary"></i>
                                            إحصائيات المستخدم
                                        </h6>
                                    </div>
                                    <div class="stats-card-body">
                                        <div class="stat-item">
                                            <span class="stat-label">المقالات المنشورة</span>
                                            <span class="stat-value">{{ $user->articles()->where('is_published', true)->count() }}</span>
                                        </div>
                                        <div class="stat-item">
                                            <span class="stat-label">المقالات المسودة</span>
                                            <span class="stat-value">{{ $user->articles()->where('is_published', false)->count() }}</span>
                                        </div>
                                        <div class="stat-item">
                                            <span class="stat-label">المقالات هذا الشهر</span>
                                            <span class="stat-value">{{ $user->articles()->whereMonth('created_at', now()->month)->count() }}</span>
                                        </div>
                                    </div>
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

/* البطاقة الرئيسية */
.admin-card {
    border: none;
    border-radius: 20px;
    box-shadow: var(--shadow);
    background: white;
}

.admin-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-bottom: 1px solid rgba(0,0,0,0.05);
    padding: 1.5rem 1.5rem;
    border-radius: 20px 20px 0 0 !important;
}

.admin-card-header .card-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
}

.btn-back {
    background: linear-gradient(45deg, #a0aec0, #718096);
    border: none;
    border-radius: 15px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: var(--transition);
}

.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(160, 174, 192, 0.4);
}

/* بطاقة المقالات */
.articles-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    overflow: hidden;
}

.articles-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.articles-card-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.articles-count-badge {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
}

.articles-card-body {
    padding: 1.5rem;
}

/* الجدول */
.admin-table {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.admin-table-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
}

.admin-table-header th {
    border: none;
    padding: 1rem;
    font-weight: 600;
    text-align: center;
}

.admin-table-row {
    transition: var(--transition);
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.admin-table-row:hover {
    background: rgba(102, 126, 234, 0.03);
    transform: translateY(-1px);
}

.admin-table-row td {
    padding: 1rem;
    vertical-align: middle;
    text-align: center;
}

/* عناصر الجدول */
.article-id {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin: 0 auto;
}

.article-title {
    text-align: right;
}

.category-badge {
    background: linear-gradient(45deg, #48bb78, #38a169);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

.status-badge.published {
    background: linear-gradient(45deg, #48bb78, #38a169);
    color: white;
}

.status-badge.draft {
    background: linear-gradient(45deg, #ed8936, #dd6b20);
    color: white;
}

.date-info {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

/* أزرار الإجراءات */
.action-buttons {
    display: flex;
    gap: 0.3rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-action {
    width: 35px;
    height: 35px;
    border: none;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    color: white;
}

.btn-edit {
    background: linear-gradient(45deg, #ed8936, #dd6b20);
}

.btn-view {
    background: linear-gradient(45deg, #4299e1, #3182ce);
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* حالة فارغة للمقالات */
.empty-articles {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 15px;
    margin: 1rem 0;
}

/* الشريط الجانبي */
.info-sidebar {
    position: sticky;
    top: 20px;
}

.user-profile-card, .stats-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    overflow: hidden;
}

.user-profile-header, .stats-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.user-profile-title, .stats-card-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.user-profile-body, .stats-card-body {
    padding: 1.5rem;
}

/* صورة المستخدم */
.user-avatar-section {
    padding: 1rem 0;
}

.user-avatar-large {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin: 0 auto;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border: 4px solid white;
    box-shadow: 0 6px 20px rgba(0,0,0,0.1);
}

.avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder-large {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-size: 2.5rem;
}

.user-name {
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

/* معلومات المستخدم */
.user-info-list {
    margin-top: 1.5rem;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 1.25rem;
}

.info-item:last-child {
    margin-bottom: 0;
}

.info-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.info-icon i {
    font-size: 0.9rem;
}

.info-content h6 {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.25rem;
    font-size: 0.85rem;
}

.info-content p {
    font-size: 0.8rem;
    margin: 0;
    line-height: 1.5;
}

.user-email {
    direction: ltr;
    text-align: left;
}

/* الأدوار والحالات */
.role-badge {
    padding: 0.4rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-block;
}

.role-badge.admin {
    background: linear-gradient(45deg, #ed8936, #dd6b20);
    color: white;
}

.role-badge.editor {
    background: linear-gradient(45deg, #4299e1, #3182ce);
    color: white;
}

.status-badge.active {
    background: linear-gradient(45deg, #48bb78, #38a169);
    color: white;
}

.status-badge.inactive {
    background: linear-gradient(45deg, #f56565, #e53e3e);
    color: white;
}

.articles-count {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.count-number {
    font-weight: 700;
    color: var(--primary-color);
    font-size: 1.2rem;
}

/* أزرار المستخدم */
.user-actions {
    margin-top: 2rem;
}

.btn-edit-user {
    background: linear-gradient(45deg, #ed8936, #dd6b20);
    border: none;
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: var(--transition);
    color: white;
}

.btn-edit-user:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(237, 137, 54, 0.4);
    color: white;
}

.btn-activate {
    background: linear-gradient(45deg, #48bb78, #38a169);
    border: none;
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: var(--transition);
    color: white;
}

.btn-deactivate {
    background: linear-gradient(45deg, #a0aec0, #718096);
    border: none;
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: var(--transition);
    color: white;
}

.btn-activate:hover, .btn-deactivate:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.current-user-notice {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem;
    background: #ebf8ff;
    border-radius: 8px;
    border: 1px solid #bee3f8;
}

/* إحصائيات */
.stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #e2e8f0;
}

.stat-item:last-child {
    border-bottom: none;
}

.stat-label {
    font-weight: 500;
    color: var(--text-light);
    font-size: 0.9rem;
}

.stat-value {
    font-weight: 700;
    color: var(--primary-color);
    font-size: 1.1rem;
}

/* الترقيم */
.pagination-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 15px;
    padding: 1.5rem;
    border: 1px solid rgba(0,0,0,0.05);
}

.pagination-info {
    font-weight: 600;
    color: var(--text-dark);
}

.pagination-links .pagination {
    margin: 0;
    gap: 0.3rem;
}

.page-link {
    border: none;
    border-radius: 10px !important;
    padding: 0.6rem 1rem;
    color: var(--text-dark);
    font-weight: 600;
    transition: var(--transition);
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.page-link:hover {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

/* التكيف مع الشاشات الصغيرة */
@media (max-width: 768px) {
    .admin-card-header {
        padding: 1rem;
    }
    
    .admin-card-header .card-title {
        font-size: 1.25rem;
        text-align: center;
    }
    
    .btn-back {
        width: 100%;
        max-width: 200px;
    }
    
    .articles-card-header, .user-profile-header, .stats-card-header {
        padding: 1rem 1.25rem;
    }
    
    .articles-card-body, .user-profile-body, .stats-card-body {
        padding: 1rem;
    }
    
    .admin-table-header {
        display: none;
    }
    
    .admin-table-row {
        display: block;
        margin-bottom: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        padding: 1rem;
    }
    
    .admin-table-row td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
        text-align: right;
    }
    
    .admin-table-row td::before {
        content: attr(data-label);
        font-weight: 700;
        color: var(--primary-color);
        font-size: 0.9rem;
    }
    
    .admin-table-row td:last-child {
        border-bottom: none;
    }
    
    .article-id, .articles-count-badge {
        margin: 0;
    }
    
    .action-buttons {
        justify-content: flex-start;
        gap: 0.5rem;
    }
    
    .user-avatar-large {
        width: 80px;
        height: 80px;
    }
    
    .avatar-placeholder-large {
        font-size: 2rem;
    }
    
    .info-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .info-icon {
        align-self: center;
    }
    
    .articles-count {
        justify-content: center;
    }
    
    .pagination-container {
        padding: 1rem;
    }
    
    .pagination-links .pagination {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .page-link {
        padding: 0.5rem 0.75rem;
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .container-fluid {
        padding: 0.5rem;
    }
    
    .admin-card {
        border-radius: 15px;
    }
    
    .user-avatar-large {
        width: 70px;
        height: 70px;
    }
    
    .avatar-placeholder-large {
        font-size: 1.8rem;
    }
    
    .stat-item {
        padding: 0.6rem 0;
    }
}

@media (max-width: 400px) {
    .admin-card-header .card-title {
        font-size: 1.1rem;
    }
    
    .articles-card-title, .user-profile-title {
        font-size: 1rem;
    }
    
    .btn-edit-user, .btn-activate, .btn-deactivate {
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
    }
    
    .user-avatar-large {
        width: 60px;
        height: 60px;
    }
    
    .avatar-placeholder-large {
        font-size: 1.5rem;
    }
}

/* إضافة data-label للخلايا في الجدول للشاشات الصغيرة */
@media (max-width: 768px) {
    .admin-table-row td:nth-child(1)::before { content: "رقم المقال"; }
    .admin-table-row td:nth-child(2)::before { content: "العنوان"; }
    .admin-table-row td:nth-child(3)::before { content: "التصنيف"; }
    .admin-table-row td:nth-child(4)::before { content: "الحالة"; }
    .admin-table-row td:nth-child(5)::before { content: "التاريخ"; }
    .admin-table-row td:nth-child(6)::before { content: "الإجراءات"; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // إضافة data-label للخلايا للشاشات الصغيرة
    if (window.innerWidth <= 768) {
        const headers = document.querySelectorAll('.admin-table-header th');
        const rows = document.querySelectorAll('.admin-table-row');
        
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            cells.forEach((cell, index) => {
                if (headers[index]) {
                    cell.setAttribute('data-label', headers[index].textContent.trim());
                }
            });
        });
    }
    
    // تأثيرات عند التمرير على الأزرار
    if (window.matchMedia('(hover: hover)').matches) {
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    }
});
</script>
@endsection