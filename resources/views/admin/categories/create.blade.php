@extends('admin.layouts.app')

@section('title', 'إضافة تصنيف جديد')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card admin-card">
                <div class="card-header admin-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-folder-plus me-2 text-primary"></i>
                            إضافة تصنيف جديد
                        </h3>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-back">
                            <i class="fas fa-arrow-right me-2"></i> رجوع للقائمة
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-card">
                                    <div class="form-card-header">
                                        <h5 class="form-card-title">
                                            <i class="fas fa-edit me-2 text-primary"></i>
                                            معلومات التصنيف
                                        </h5>
                                    </div>
                                    <div class="form-card-body">
                                        <div class="form-group mb-4">
                                            <label for="name" class="form-label">
                                                اسم التصنيف 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                                   id="name" name="name" value="{{ old('name') }}" 
                                                   placeholder="أدخل اسم التصنيف" required>
                                            @error('name')
                                                <div class="invalid-feedback d-block">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="slug" class="form-label">رابط التصنيف</label>
                                            <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" 
                                                   id="slug" name="slug" value="{{ old('slug') }}" 
                                                   placeholder="سيتم إنشاء الرابط تلقائياً">
                                            @error('slug')
                                                <div class="invalid-feedback d-block">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                يمكنك ترك هذا الحقل فارغاً لإنشاء الرابط تلقائياً
                                            </small>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="description" class="form-label">وصف التصنيف</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                                      id="description" name="description" rows="5" 
                                                      placeholder="أدخل وصفاً مختصراً للتصنيف">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback d-block">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-text-container">
                                                <small class="form-text text-muted">
                                                    <i class="fas fa-lightbulb me-1"></i>
                                                    هذا الحقل اختياري، لكنه يساعد في تحسين محركات البحث
                                                </small>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-primary btn-save">
                                                <i class="fas fa-save me-2"></i> حفظ التصنيف
                                            </button>
                                            <button type="reset" class="btn btn-secondary btn-reset">
                                                <i class="fas fa-redo me-2"></i> إعادة تعيين
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="info-sidebar">
                                    <div class="info-card">
                                        <div class="info-card-header">
                                            <h6 class="info-card-title mb-0">
                                                <i class="fas fa-info-circle me-2 text-primary"></i>
                                                معلومات سريعة
                                            </h6>
                                        </div>
                                        <div class="info-card-body">
                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-folder text-primary"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>تنظيم المحتوى</h6>
                                                    <p class="text-muted">التصنيفات تساعد في تنظيم المقالات وتصنيفها بشكل منطقي</p>
                                                </div>
                                            </div>
                                            
                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-link text-success"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>روابط واضحة</h6>
                                                    <p class="text-muted">سيتم إنشاء رابط تلقائي للتصنيف بناءً على الاسم</p>
                                                </div>
                                            </div>
                                            
                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-newspaper text-warning"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>ربط المقالات</h6>
                                                    <p class="text-muted">يمكن ربط المقالات بالتصنيفات لسهولة التصفح</p>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-search text-info"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>تحسين SEO</h6>
                                                    <p class="text-muted">الوصف الجيد يساعد في تحسين ظهور التصنيف في محركات البحث</p>
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
                                                <span class="stat-label">إجمالي التصنيفات</span>
                                                <span class="stat-value">{{ \App\Models\Category::count() }}</span>
                                            </div>
                                            <div class="stat-item">
                                                <span class="stat-label">التصنيفات النشطة</span>
                                                <span class="stat-value">{{ \App\Models\Category::has('articles')->count() }}</span>
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

.form-control-sm {
    padding: 0.6rem 0.8rem;
    font-size: 0.9rem;
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

.form-text-container {
    margin-top: 0.5rem;
}

/* أزرار النموذج */
.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e2e8f0;
}

.btn-save {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
    border-radius: 12px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    transition: var(--transition);
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

.btn-reset {
    background: linear-gradient(45deg, #a0aec0, #718096);
    border: none;
    border-radius: 12px;
    padding: 0.75rem 2rem;
    font-weight: 600;
    transition: var(--transition);
}

.btn-reset:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(160, 174, 192, 0.4);
}

/* الشريط الجانبي للمعلومات */
.info-sidebar {
    position: sticky;
    top: 20px;
}

.info-card, .stats-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    overflow: hidden;
}

.info-card-header, .stats-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.info-card-title, .stats-card-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.info-card-body, .stats-card-body {
    padding: 1.5rem;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.info-item:last-child {
    margin-bottom: 0;
}

.info-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.info-icon i {
    font-size: 1rem;
}

.info-content h6 {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.25rem;
    font-size: 0.9rem;
}

.info-content p {
    font-size: 0.85rem;
    margin: 0;
    line-height: 1.5;
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

/* التكيف مع الشاشات الصغيرة */
@media (max-width: 768px) {
    .admin-card-header {
        padding: 1rem;
    }
    
    .form-card-body {
        padding: 1rem;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .btn-save, .btn-reset {
        width: 100%;
    }
    
    .info-item {
        flex-direction: column;
        text-align: center;
    }
    
    .info-icon {
        align-self: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // إنشاء slug تلقائياً من اسم التصنيف
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    
    if (nameInput && slugInput) {
        nameInput.addEventListener('input', function() {
            if (!slugInput.value) {
                const slug = this.value
                    .toLowerCase()
                    .replace(/[^\w\u0600-\u06FF\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                slugInput.value = slug;
            }
        });
    }
    
    // تأثيرات عند التمرير على الأزرار
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endsection