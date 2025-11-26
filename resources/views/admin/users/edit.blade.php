@extends('admin.layouts.app')

@section('title', 'تعديل المستخدم: ' . $user->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card admin-card">
                <div class="card-header admin-card-header">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3 gap-md-0">
                        <h3 class="card-title mb-0 text-center text-md-start">
                            <i class="fas fa-user-edit me-2 text-primary"></i>
                            تعديل المستخدم: <span class="text-warning">{{ $user->name }}</span>
                        </h3>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-back w-100 w-md-auto">
                            <i class="fas fa-arrow-right me-2"></i> رجوع للقائمة
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-lg-8">
                                <div class="form-card">
                                    <div class="form-card-header">
                                        <h5 class="form-card-title">
                                            <i class="fas fa-user-cog me-2 text-primary"></i>
                                            تعديل معلومات المستخدم
                                        </h5>
                                    </div>
                                    <div class="form-card-body">
                                        <div class="form-group mb-4">
                                            <label for="name" class="form-label">
                                                الاسم الكامل 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                                   id="name" name="name" value="{{ old('name', $user->name) }}" 
                                                   placeholder="أدخل الاسم الكامل للمستخدم" required>
                                            @error('name')
                                                <div class="invalid-feedback d-block">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="email" class="form-label">
                                                البريد الإلكتروني 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                                   id="email" name="email" value="{{ old('email', $user->email) }}" 
                                                   placeholder="أدخل البريد الإلكتروني" required>
                                            @error('email')
                                                <div class="invalid-feedback d-block">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <label for="password" class="form-label">كلمة المرور الجديدة</label>
                                                    <div class="password-input-container">
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                               id="password" name="password" 
                                                               placeholder="اتركه فارغاً للحفاظ على كلمة المرور الحالية">
                                                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                    @error('password')
                                                        <div class="invalid-feedback d-block">
                                                            <i class="fas fa-exclamation-circle me-1"></i>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    <small class="form-text text-muted">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        اتركه فارغاً إذا لم ترد تغيير كلمة المرور
                                                    </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mb-4">
                                                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                                                    <div class="password-input-container">
                                                        <input type="password" class="form-control" 
                                                               id="password_confirmation" name="password_confirmation" 
                                                               placeholder="أعد إدخال كلمة المرور الجديدة">
                                                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="role" class="form-label">
                                                الدور 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select class="form-control select-input @error('role') is-invalid @enderror" 
                                                    id="role" name="role" required>
                                                <option value="">اختر دور المستخدم</option>
                                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>مدير النظام</option>
                                                <option value="editor" {{ old('role', $user->role) == 'editor' ? 'selected' : '' }}>محرر</option>
                                            </select>
                                            @error('role')
                                                <div class="invalid-feedback d-block">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary btn-save">
                                                <i class="fas fa-save me-2"></i> تحديث المستخدم
                                            </button>
                                            <button type="reset" class="btn btn-secondary btn-reset">
                                                <i class="fas fa-redo me-2"></i> إعادة تعيين
                                            </button>
                                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-cancel">
                                                <i class="fas fa-times me-2"></i> إلغاء
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                                <div class="info-sidebar">
                                    <div class="info-card">
                                        <div class="info-card-header">
                                            <h6 class="info-card-title mb-0">
                                                <i class="fas fa-info-circle me-2 text-primary"></i>
                                                معلومات المستخدم
                                            </h6>
                                        </div>
                                        <div class="info-card-body">
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
                                                <h6 class="user-name mt-3">{{ $user->name }}</h6>
                                                <p class="text-muted small">{{ $user->email }}</p>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-user-shield text-primary"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>الدور الحالي</h6>
                                                    <p class="text-muted">
                                                        @if($user->role === 'admin')
                                                            <span class="role-badge admin">مدير النظام</span>
                                                        @else
                                                            <span class="role-badge editor">محرر</span>
                                                        @endif
                                                    </p>
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
                                                        <span class="count-number">{{ $user->articles()->count() }}</span>
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
                                    </div>

                                    <div class="stats-card mt-4">
                                        <div class="stats-card-header">
                                            <h6 class="stats-card-title mb-0">
                                                <i class="fas fa-chart-bar me-2 text-primary"></i>
                                                إحصائيات سريعة
                                            </h6>
                                        </div>
                                        <div class="stats-card-body">
                                            <div class="stat-item">
                                                <span class="stat-label">إجمالي المستخدمين</span>
                                                <span class="stat-value">{{ \App\Models\User::count() }}</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-label">المدراء</span>
                                                <span class="stat-value">{{ \App\Models\User::where('role', 'admin')->count() }}</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-label">المحررين</span>
                                                <span class="stat-value">{{ \App\Models\User::where('role', 'editor')->count() }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert-card mt-4">
                                        <div class="alert-card-header">
                                            <h6 class="alert-card-title mb-0">
                                                <i class="fas fa-exclamation-triangle me-2 text-warning"></i>
                                                ملاحظات مهمة
                                            </h6>
                                        </div>
                                        <div class="alert-card-body">
                                            <div class="alert-item">
                                                <i class="fas fa-key me-2 text-info"></i>
                                                <span class="small">اترك كلمة المرور فارغة للحفاظ على الكلمة الحالية</span>
                                            </div>
                                            <div class="alert-item">
                                                <i class="fas fa-shield-alt me-2 text-info"></i>
                                                <span class="small">تغيير الدور يؤثر على صلاحيات المستخدم</span>
                                            </div>
                                            <div class="alert-item">
                                                <i class="fas fa-user-check me-2 text-info"></i>
                                                <span class="small">لا يمكنك تعديل بياناتك الخاصة من هنا</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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

/* بطاقة النموذج */
.form-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    overflow: hidden;
}

.form-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.form-card-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.form-card-body {
    padding: 1.5rem;
}

/* حقول النموذج */
.form-label {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: var(--transition);
    background: white;
}

.form-control-lg {
    padding: 1rem 1.25rem;
    font-size: 1.1rem;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    background: white;
}

.form-control.is-invalid {
    border-color: #e53e3e;
}

.form-control.is-invalid:focus {
    box-shadow: 0 0 0 3px rgba(229, 62, 62, 0.1);
}

.invalid-feedback {
    font-weight: 500;
    margin-top: 0.5rem;
}

.form-text {
    font-size: 0.85rem;
    margin-top: 0.5rem;
}

/* حقل كلمة المرور */
.password-input-container {
    position: relative;
}

.password-toggle {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #a0aec0;
    cursor: pointer;
    transition: var(--transition);
}

.password-toggle:hover {
    color: var(--primary-color);
}

.password-input-container .form-control {
    padding-right: 3rem;
}

/* أزرار النموذج */
.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e2e8f0;
    flex-wrap: wrap;
}

.btn-save {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
    border-radius: 12px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    transition: var(--transition);
    color: white;
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    color: white;
}

.btn-reset {
    background: linear-gradient(45deg, #a0aec0, #718096);
    border: none;
    border-radius: 12px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    transition: var(--transition);
    color: white;
}

.btn-reset:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(160, 174, 192, 0.4);
    color: white;
}

.btn-cancel {
    border: 2px solid #a0aec0;
    border-radius: 12px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    transition: var(--transition);
    color: #718096;
    background: white;
}

.btn-cancel:hover {
    background: #a0aec0;
    color: white;
    transform: translateY(-2px);
}

/* الشريط الجانبي للمعلومات */
.info-sidebar {
    position: sticky;
    top: 20px;
}

.info-card, .stats-card, .alert-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    overflow: hidden;
}

.info-card-header, .stats-card-header, .alert-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.info-card-title, .stats-card-title, .alert-card-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.info-card-body, .stats-card-body, .alert-card-body {
    padding: 1.5rem;
}

/* صورة المستخدم */
.user-avatar-section {
    padding: 1rem 0;
}

.user-avatar-large {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    margin: 0 auto;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border: 3px solid white;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
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
    font-size: 2rem;
}

.user-name {
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.25rem;
}

/* معلومات المستخدم */
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

/* الأدوار والحالات */
.role-badge {
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.75rem;
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

.status-badge {
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
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
    font-size: 1.1rem;
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

/* بطاقة التنبيهات */
.alert-card {
    border: 2px solid #fffaf0;
}

.alert-card-header {
    background: linear-gradient(135deg, #fffaf0 0%, #feebc8 100%);
}

.alert-item {
    display: flex;
    align-items: flex-start;
    padding: 0.5rem 0;
    border-bottom: 1px solid #fed7d7;
    gap: 0.5rem;
}

.alert-item:last-child {
    border-bottom: none;
}

.alert-item i {
    color: #dd6b20;
    font-size: 0.8rem;
    margin-top: 0.1rem;
    flex-shrink: 0;
}

.alert-item span {
    font-size: 0.8rem;
    color: #744210;
    line-height: 1.4;
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
    
    .form-card-body {
        padding: 1rem;
    }
    
    .form-actions {
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .btn-save, .btn-reset, .btn-cancel {
        width: 100%;
    }
    
    .password-input-container .form-control {
        padding-right: 3rem;
    }
    
    .info-card-body, .stats-card-body, .alert-card-body {
        padding: 1rem;
    }
    
    .user-avatar-large {
        width: 70px;
        height: 70px;
    }
    
    .avatar-placeholder-large {
        font-size: 1.5rem;
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
}

@media (max-width: 576px) {
    .container-fluid {
        padding: 0.5rem;
    }
    
    .admin-card {
        border-radius: 15px;
    }
    
    .form-control-lg {
        padding: 0.875rem 1rem;
    }
    
    .stat-item {
        padding: 0.6rem 0;
    }
}

@media (max-width: 400px) {
    .admin-card-header .card-title {
        font-size: 1.1rem;
    }
    
    .form-card-title {
        font-size: 1rem;
    }
    
    .btn-save, .btn-reset, .btn-cancel {
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
    }
    
    .user-avatar-large {
        width: 60px;
        height: 60px;
    }
    
    .avatar-placeholder-large {
        font-size: 1.2rem;
    }
}

/* تحسينات للشاشات الكبيرة */
@media (min-width: 1200px) {
    .container-fluid {
        max-width: 1400px;
        margin: 0 auto;
    }
}

/* تحسينات للقراءة والتفاعل */
.form-control:focus {
    transform: translateY(-1px);
}

.btn:active {
    transform: translateY(0) !important;
}

/* تحسينات للأجهزة التي تدعم اللمس */
@media (hover: none) {
    .btn:hover {
        transform: none;
    }
    
    .form-control:focus {
        transform: none;
    }
}
</style>

<script>
function togglePassword(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const toggleButton = passwordField.nextElementSibling;
    const icon = toggleButton.querySelector('i');
    
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.className = 'fas fa-eye-slash';
        toggleButton.setAttribute('title', 'إخفاء كلمة المرور');
    } else {
        passwordField.type = 'password';
        icon.className = 'fas fa-eye';
        toggleButton.setAttribute('title', 'إظهار كلمة المرور');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // تأثيرات عند التمرير على الأزرار (لأجهزة غير اللمس فقط)
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

    // تحسين الأداء على الأجهزة المحمولة
    if ('ontouchstart' in window) {
        document.documentElement.style.setProperty('--transition', 'all 0.2s ease');
    }
});
</script>
@endsection