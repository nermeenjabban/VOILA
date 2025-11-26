@extends('admin.layouts.app')

@section('title', 'تعديل التصنيف: ' . $category->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card admin-card">
                <div class="card-header admin-card-header">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3 gap-md-0">
                        <h3 class="card-title mb-0 text-center text-md-start">
                            <i class="fas fa-edit me-2 text-primary"></i>
                            تعديل التصنيف: <span class="text-warning">{{ $category->name }}</span>
                        </h3>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-back w-100 w-md-auto">
                            <i class="fas fa-arrow-right me-2"></i> رجوع للقائمة
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-7 col-lg-8">
                                <div class="form-card">
                                    <div class="form-card-header">
                                        <h5 class="form-card-title">
                                            <i class="fas fa-edit me-2 text-primary"></i>
                                            تعديل معلومات التصنيف
                                        </h5>
                                    </div>
                                    <div class="form-card-body">
                                        <div class="form-group mb-4">
                                            <label for="name" class="form-label">
                                                اسم التصنيف 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                                   id="name" name="name" value="{{ old('name', $category->name) }}" 
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
                                                   id="slug" name="slug" value="{{ old('slug', $category->slug) }}" 
                                                   placeholder="أدخل رابط التصنيف">
                                            @error('slug')
                                                <div class="invalid-feedback d-block">
                                                    <i class="fas fa-exclamation-circle me-1"></i>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                يمكنك ترك هذا الحقل فارغاً لتحديث الرابط تلقائياً من الاسم
                                            </small>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label for="description" class="form-label">وصف التصنيف</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                                      id="description" name="description" rows="5" 
                                                      placeholder="أدخل وصفاً مختصراً للتصنيف">{{ old('description', $category->description) }}</textarea>
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
                                                <i class="fas fa-save me-2"></i> تحديث التصنيف
                                            </button>
                                            <button type="reset" class="btn btn-secondary btn-reset">
                                                <i class="fas fa-redo me-2"></i> إعادة تعيين
                                            </button>
                                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-cancel">
                                                <i class="fas fa-times me-2"></i> إلغاء
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-5 col-lg-4">
                                <div class="info-sidebar">
                                    <div class="info-card">
                                        <div class="info-card-header">
                                            <h6 class="info-card-title mb-0">
                                                <i class="fas fa-info-circle me-2 text-primary"></i>
                                                معلومات التصنيف
                                            </h6>
                                        </div>
                                        <div class="info-card-body">
                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-link text-primary"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>الرابط الحالي</h6>
                                                    <p class="text-muted slug-preview">{{ $category->slug }}</p>
                                                </div>
                                            </div>
                                            
                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-newspaper text-success"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>عدد المقالات</h6>
                                                    <div class="articles-count">
                                                        <span class="count-number">{{ $category->articles_count ?? 0 }}</span>
                                                        <small class="text-muted">مقال</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-calendar-plus text-warning"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>تاريخ الإنشاء</h6>
                                                    <p class="text-muted">{{ $category->created_at->format('Y-m-d H:i') }}</p>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <div class="info-icon">
                                                    <i class="fas fa-calendar-check text-info"></i>
                                                </div>
                                                <div class="info-content">
                                                    <h6>آخر تحديث</h6>
                                                    <p class="text-muted">{{ $category->updated_at->format('Y-m-d H:i') }}</p>
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
                                            <div class="stat-item">
                                                <span class="stat-label">المقالات في هذا التصنيف</span>
                                                <span class="stat-value">{{ $category->articles_count ?? 0 }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="alert-card mt-4">
                                        <div class="alert-card-header">
                                            <h6 class="alert-card-title mb-0">
                                                <i class="fas fa-exclamation-triangle me-2 text-warning"></i>
                                                تنبيهات مهمة
                                            </h6>
                                        </div>
                                        <div class="alert-card-body">
                                            <div class="alert-item">
                                                <i class="fas fa-sync-alt me-2 text-info"></i>
                                                <span class="small">سيتم تحديث الرابط تلقائياً عند تغيير الاسم</span>
                                            </div>
                                            <div class="alert-item">
                                                <i class="fas fa-link me-2 text-info"></i>
                                                <span class="small">تغيير الرابط قد يؤثر على محركات البحث</span>
                                            </div>
                                            <div class="alert-item">
                                                <i class="fas fa-newspaper me-2 text-info"></i>
                                                <span class="small">المقالات المرتبطة ستتأثر بالتغييرات</span>
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
    border-radius: 15px;
    box-shadow: var(--shadow);
    background: white;
    margin: 0 auto;
    max-width: 100%;
}

.admin-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-bottom: 1px solid rgba(0,0,0,0.05);
    padding: 1.25rem 1rem;
    border-radius: 15px 15px 0 0 !important;
}

.admin-card-header .card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-dark);
    word-break: break-word;
}

.btn-back {
    background: linear-gradient(45deg, #a0aec0, #718096);
    border: none;
    border-radius: 12px;
    padding: 0.75rem 1.25rem;
    font-weight: 600;
    transition: var(--transition);
    font-size: 0.9rem;
}

.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(160, 174, 192, 0.4);
}

/* بطاقة النموذج */
.form-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    overflow: hidden;
    height: fit-content;
}

.form-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1rem 1.25rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.form-card-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.form-card-body {
    padding: 1.25rem;
}

/* حقول النموذج */
.form-label {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    display: block;
    font-size: 0.95rem;
}

* {
    box-sizing: border-box;
}

@media (max-width: 360px) {
    .card-title {
        font-size: 0.9rem !important;
    }

    .form-label {
        font-size: 0.8rem !important;
    }

    .form-control {
        font-size: 0.85rem !important;
        padding: 0.55rem 0.75rem !important;
    }

    .info-card-title,
    .stats-card-title,
    .alert-card-title {
        font-size: 0.8rem !important;
    }
}


.form-control {
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: var(--transition);
    background: white;
    width: 100%;
}

.form-control-lg {
    padding: 0.875rem 1rem;
    font-size: 1.05rem;
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
    font-size: 0.85rem;
}

.form-text {
    font-size: 0.8rem;
    margin-top: 0.5rem;
}

.form-text-container {
    margin-top: 0.5rem;
}

/* أزرار النموذج */
.form-actions {
    display: flex;
    gap: 0.75rem;
    margin-top: 1.5rem;
    padding-top: 1.25rem;
    border-top: 1px solid #e2e8f0;
    flex-wrap: wrap;
}

.btn-save {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
    border-radius: 10px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: var(--transition);
    color: white;
    font-size: 0.9rem;
    flex: 1;
    min-width: 120px;
}

.btn-save:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    color: white;
}

.btn-reset {
    background: linear-gradient(45deg, #a0aec0, #718096);
    border: none;
    border-radius: 10px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: var(--transition);
    color: white;
    font-size: 0.9rem;
    flex: 1;
    min-width: 120px;
}

.btn-reset:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(160, 174, 192, 0.4);
    color: white;
}

.btn-cancel {
    border: 2px solid #a0aec0;
    border-radius: 10px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: var(--transition);
    color: #718096;
    font-size: 0.9rem;
    flex: 1;
    min-width: 120px;
    background: white;
}

.btn-cancel:hover {
    background: #a0aec0;
    color: white;
    transform: translateY(-2px);
}

/* الشريط الجانبي للمعلومات */
.info-sidebar {
    position: relative;
}

.info-card, .stats-card, .alert-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(0,0,0,0.05);
    overflow: hidden;
}

.info-card-header, .stats-card-header, .alert-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1rem 1.25rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.info-card-title, .stats-card-title, .alert-card-title {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.info-card-body, .stats-card-body, .alert-card-body {
    padding: 1.25rem;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
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

.slug-preview {
    direction: ltr;
    text-align: left;
    font-family: monospace;
    background: #f7fafc;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    border: 1px solid #e2e8f0;
    font-size: 0.75rem;
    word-break: break-all;
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
    padding: 0.6rem 0;
    border-bottom: 1px solid #e2e8f0;
}

.stat-item:last-child {
    border-bottom: none;
}

.stat-label {
    font-weight: 500;
    color: var(--text-light);
    font-size: 0.85rem;
}

.stat-value {
    font-weight: 700;
    color: var(--primary-color);
    font-size: 1rem;
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
    .info-sidebar > div {
        margin-bottom: 1rem;
    }
}
.info-sidebar {
    width: 100%;
}
@media (max-width: 480px) {
    .btn {
        padding: 0.55rem 1rem !important;
        font-size: 0.85rem !important;
    }
}

    
    .admin-card-header {
        padding: 1rem 0.75rem;
    }
    
    .admin-card-header .card-title {
        font-size: 1.1rem;
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
        gap: 0.5rem;
    }
    
    .btn-save, .btn-reset, .btn-cancel {
        width: 100%;
        flex: none;
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
    
    .info-card-body, .stats-card-body, .alert-card-body {
        padding: 1rem;
    }
}

@media (max-width: 576px) {
    .admin-card {
        border-radius: 10px;
        margin: 0.25rem;
    }
    
    .admin-card-header {
        padding: 0.75rem 0.5rem;
    }
    
    .form-card-body {
        padding: 0.75rem;
    }
    
    .form-control {
        padding: 0.6rem 0.75rem;
        font-size: 0.95rem;
    }
    
    .form-control-lg {
        padding: 0.75rem;
    }
    
    .info-item {
        margin-bottom: 1rem;
    }
    
    .stat-item {
        padding: 0.5rem 0;
    }
    
    .alert-item {
        padding: 0.4rem 0;
    }
}

@media (max-width: 400px) {
    .admin-card-header .card-title {
        font-size: 1rem;
    }
    
    .form-card-title {
        font-size: 1rem;
    }
    
    .btn-save, .btn-reset, .btn-cancel {
        padding: 0.6rem 1rem;
        font-size: 0.85rem;
    }
    
    .info-icon {
        width: 32px;
        height: 32px;
    }
    
    .info-icon i {
        font-size: 0.8rem;
    }
}

/* تحسينات للشاشات الكبيرة */
@media (min-width: 1200px) {
    .container-fluid {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    .admin-card {
        border-radius: 20px;
    }
    
    .form-card {
        border-radius: 15px;
    }
}

/* تحسينات للتخطيط العام */
.row {
    margin: 0;
}

.col-12, .col-lg-8, .col-lg-4 {
    padding: 0.5rem;
}

@media (min-width: 768px) {
    .col-12, .col-lg-8, .col-lg-4 {
        padding: 0.75rem;
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
document.addEventListener('DOMContentLoaded', function() {
    // إنشاء slug تلقائياً من اسم التصنيف
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    const slugPreview = document.querySelector('.slug-preview');
    
    if (nameInput && slugInput) {
        nameInput.addEventListener('input', function() {
            if (!slugInput.value) {
                const slug = this.value
                    .toLowerCase()
                    .replace(/[^\w\u0600-\u06FF\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
                slugInput.value = slug;
                if (slugPreview) {
                    slugPreview.textContent = slug;
                }
            }
        });

        slugInput.addEventListener('input', function() {
            if (slugPreview) {
                slugPreview.textContent = this.value || nameInput.value
                    .toLowerCase()
                    .replace(/[^\w\u0600-\u06FF\s-]/g, '')
                    .replace(/[\s_-]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }
        });
    }
    
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

    // تحديث المعاينة الأولية
    if (slugPreview && nameInput) {
        slugPreview.textContent = slugInput.value || nameInput.value
            .toLowerCase()
            .replace(/[^\w\u0600-\u06FF\s-]/g, '')
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    // تحسين الأداء على الأجهزة المحمولة
    if ('ontouchstart' in window) {
        document.documentElement.style.setProperty('--transition', 'all 0.2s ease');
    }
});
</script>
@endsection