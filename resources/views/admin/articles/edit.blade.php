@extends('admin.layouts.app')

@section('title', 'تعديل المقال')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card admin-form-card">
                <div class="card-header admin-form-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-edit me-2 text-primary"></i>
                            تعديل المقال: {{ $article->title }}
                        </h3>
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-back">
                            <i class="fas fa-arrow-right me-2"></i> رجوع للقائمة
                        </a>
                    </div>
                </div>
                
                <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <!-- العمود الرئيسي -->
                            <div class="col-lg-8">
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-edit me-2 text-primary"></i>
                                        محتوى المقال
                                    </h5>
                                    
                                    <div class="form-group custom-form-group">
                                        <label for="title" class="form-label">
                                            <i class="fas fa-heading me-1 text-muted"></i>
                                            عنوان المقال *
                                        </label>
                                        <input type="text" class="form-control custom-input @error('title') is-invalid @enderror" 
                                               id="title" name="title" value="{{ old('title', $article->title) }}" 
                                               placeholder="أدخل عنوان المقال..." required>
                                        @error('title')
                                            <div class="invalid-feedback d-block">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group custom-form-group">
                                        <label for="content" class="form-label">
                                            <i class="fas fa-file-alt me-1 text-muted"></i>
                                            المحتوى *
                                        </label>
                                        <textarea class="form-control" id="content" name="content">{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback d-block">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <!-- الشريط الجانبي -->
                            <div class="col-lg-4">
                                <!-- تصنيف المقال -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-tags me-2 text-success"></i>
                                        التصنيف
                                    </h5>
                                    
                                    <div class="form-group custom-form-group">
                                        <label for="category_id" class="form-label">التصنيف *</label>
                                        <select class="form-control custom-select @error('category_id') is-invalid @enderror" 
                                                id="category_id" name="category_id" required>
                                            <option value="">اختر التصنيف</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback d-block">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- صورة المقال -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-image me-2 text-info"></i>
                                        صورة المقال
                                    </h5>
                                    
                                    <div class="form-group custom-form-group">
                                        <label for="image" class="form-label">صورة المقال</label>
                                        
                                        <!-- عرض الصورة الحالية -->
                                        @if($article->image)
                                            <div class="current-image mb-3">
                                                <div class="current-image-container">
                                                    <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" 
                                                         class="current-image-preview">
                                                    <div class="current-image-info">
                                                        <small class="text-muted">الصورة الحالية</small>
                                                        <br>
                                                        <small class="text-success">
                                                            <i class="fas fa-check-circle me-1"></i>
                                                            موجودة
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="no-image mb-3">
                                                <div class="no-image-placeholder">
                                                    <i class="fas fa-image fa-2x text-muted"></i>
                                                    <p class="text-muted mt-2 mb-0">لا توجد صورة حالية</p>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <!-- رفع صورة جديدة -->
                                        <div class="file-upload-container">
                                            <input type="file" class="file-upload-input @error('image') is-invalid @enderror" 
                                                   id="image" name="image" accept="image/*" hidden>
                                            <label for="image" class="file-upload-label">
                                                <i class="fas fa-cloud-upload-alt me-2"></i>
                                                <span class="file-text">اختر صورة جديدة</span>
                                            </label>
                                        </div>
                                        @error('image')
                                            <div class="invalid-feedback d-block">
                                                <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                            </div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            <i class="fas fa-info-circle me-1"></i>
                                            اتركه فارغاً للحفاظ على الصورة الحالية
                                        </small>
                                        
                                        <!-- معاينة الصورة الجديدة -->
                                        <div class="image-preview-container mt-3" id="image-preview">
                                            <div class="preview-placeholder">
                                                <i class="fas fa-image fa-2x text-muted"></i>
                                                <p class="text-muted mt-2 mb-0">لم يتم اختيار صورة جديدة</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- الإعدادات -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-cog me-2 text-warning"></i>
                                        الإعدادات
                                    </h5>
                                    
                                    <div class="settings-container">
                                        <div class="setting-item">
                                            <div class="custom-switch">
                                                <input type="checkbox" class="custom-switch-input" id="is_published" name="is_published" value="1" 
                                                    {{ old('is_published', $article->is_published) ? 'checked' : '' }}>
                                                <label class="custom-switch-label" for="is_published">
                                                    <span class="switch-icon">
                                                        <i class="fas fa-eye"></i>
                                                    </span>
                                                    <span class="switch-text">
                                                        <strong>نشر المقال</strong>
                                                        <small>سيظهر المقال للزوار</small>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="setting-item">
                                            <div class="custom-switch">
                                                <input type="checkbox" class="custom-switch-input" id="comments_enabled" name="comments_enabled" value="1" 
                                                    {{ old('comments_enabled', $article->comments_enabled) ? 'checked' : '' }}>
                                                <label class="custom-switch-label" for="comments_enabled">
                                                    <span class="switch-icon">
                                                        <i class="fas fa-comments"></i>
                                                    </span>
                                                    <span class="switch-text">
                                                        <strong>تفعيل التعليقات</strong>
                                                        <small>السماح للزوار بالتعليق</small>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- معلومات المقال -->
                                <div class="form-section">
                                    <h5 class="section-title">
                                        <i class="fas fa-info-circle me-2 text-info"></i>
                                        معلومات المقال
                                    </h5>
                                    
                                    <div class="article-info">
                                        <div class="info-item">
                                            <i class="fas fa-user me-2 text-primary"></i>
                                            <div>
                                                <strong>المؤلف</strong>
                                                <p class="mb-0">{{ $article->author->name }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="info-item">
                                            <i class="fas fa-calendar-plus me-2 text-primary"></i>
                                            <div>
                                                <strong>تاريخ الإنشاء</strong>
                                                <p class="mb-0">{{ $article->created_at->format('Y-m-d') }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="info-item">
                                            <i class="fas fa-calendar-check me-2 text-primary"></i>
                                            <div>
                                                <strong>آخر تحديث</strong>
                                                <p class="mb-0">{{ $article->updated_at->format('Y-m-d') }}</p>
                                            </div>
                                        </div>

                                        @if($article->published_at)
                                        <div class="info-item">
                                            <i class="fas fa-calendar-day me-2 text-primary"></i>
                                            <div>
                                                <strong>تاريخ النشر</strong>
                                                <p class="mb-0">{{ $article->published_at->format('Y-m-d') }}</p>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- زر التحديث -->
                                <div class="form-section">
                                    <button type="submit" class="btn btn-update btn-block">
                                        <i class="fas fa-save me-2"></i> تحديث المقال
                                    </button>
                                    
                                    <div class="form-info mt-3">
                                        <div class="info-item">
                                            <i class="fas fa-lightbulb text-warning me-2"></i>
                                            <small class="text-muted">جميع الحقول marked with * إلزامية</small>
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
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    const fileText = document.querySelector('.file-text');
    
    // حدث تغيير الصورة
    imageInput.addEventListener('change', function(e) {
        const file = this.files[0];
        
        if (file) {
            // التحقق من نوع الملف
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('نوع الملف غير مدعوم. الرجاء اختيار صورة بصيغة JPEG, PNG, JPG, أو GIF.');
                this.value = '';
                return;
            }
            
            // التحقق من حجم الملف (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert('حجم الصورة كبير جداً. الحد الأقصى المسموح به هو 2MB.');
                this.value = '';
                return;
            }
            
            // تحديث نص الزر
            fileText.textContent = file.name;
            
            // معاينة الصورة
            const reader = new FileReader();
            
            reader.onload = function(e) {
                imagePreview.innerHTML = `
                    <div class="image-preview-active">
                        <div class="preview-header">
                            <small class="text-success">
                                <i class="fas fa-eye me-1"></i>
                                معاينة الصورة الجديدة
                            </small>
                        </div>
                        <img src="${e.target.result}" alt="معاينة الصورة" class="preview-image">
                        <button type="button" class="preview-remove" onclick="removeImage()">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="preview-info">
                            <small class="text-muted">${file.name} (${(file.size / 1024).toFixed(1)} KB)</small>
                        </div>
                    </div>
                `;
            }
            
            reader.onerror = function() {
                alert('حدث خطأ أثناء قراءة الملف. الرجاء المحاولة مرة أخرى.');
            }
            
            reader.readAsDataURL(file);
        }
    });

    // إضافة حدث لسحب وإفلات الصور
    const fileUploadLabel = document.querySelector('.file-upload-label');
    
    fileUploadLabel.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.background = 'linear-gradient(45deg, #edf2f7, #e2e8f0)';
        this.style.borderColor = 'var(--primary-color)';
    });
    
    fileUploadLabel.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.background = 'linear-gradient(45deg, #f8fafc, #e2e8f0)';
        this.style.borderColor = '#cbd5e0';
    });
    
    fileUploadLabel.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.background = 'linear-gradient(45deg, #f8fafc, #e2e8f0)';
        this.style.borderColor = '#cbd5e0';
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            imageInput.dispatchEvent(new Event('change'));
        }
    });
});

// دالة إزالة الصورة
function removeImage() {
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');
    const fileText = document.querySelector('.file-text');
    
    imageInput.value = '';
    fileText.textContent = 'اختر صورة جديدة';
    imagePreview.innerHTML = `
        <div class="preview-placeholder">
            <i class="fas fa-image fa-2x text-muted"></i>
            <p class="text-muted mt-2 mb-0">لم يتم اختيار صورة جديدة</p>
        </div>
    `;
}
</script>

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
.admin-form-card {
    border: none;
    border-radius: 20px;
    box-shadow: var(--shadow);
    background: white;
    overflow: hidden;
}

.admin-form-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-bottom: 1px solid rgba(0,0,0,0.05);
    padding: 1.5rem 1.5rem 0.5rem;
    border-radius: 20px 20px 0 0 !important;
}

.admin-form-header .card-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
}

.btn-back {
    background: linear-gradient(45deg, #a0aec0, #718096);
    border: none;
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    color: white;
    text-decoration: none;
    transition: var(--transition);
}

.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(113, 128, 150, 0.4);
    color: white;
}

/* الأقسام */
.form-section {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    border: 1px solid rgba(0,0,0,0.05);
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--primary-color);
}

/* حقول الإدخال */
.custom-form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.75rem;
    display: block;
}

.custom-input, .custom-select, .custom-textarea {
    border: none;
    border-radius: 12px;
    padding: 1rem 1.25rem;
    font-size: 1rem;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    transition: var(--transition);
    border: 2px solid transparent;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    width: 100%;
}

.custom-input:focus, .custom-select:focus, .custom-textarea:focus {
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    border-color: var(--primary-color);
    transform: translateY(-2px);
}

.custom-textarea {
    resize: vertical;
    min-height: 300px;
    line-height: 1.6;
}

/* الصورة الحالية */
.current-image-container {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: linear-gradient(135deg, #f0fff4, #c6f6d5);
    border-radius: 12px;
    border: 1px solid #9ae6b4;
}

.current-image-preview {
    width: 80px;
    height: 80px;
    border-radius: 8px;
    object-fit: cover;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.current-image-info {
    flex: 1;
}

.no-image-placeholder {
    padding: 1.5rem;
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    border-radius: 12px;
    border: 2px dashed #cbd5e0;
    text-align: center;
    color: var(--text-light);
}

/* رفع الملفات */
.file-upload-container {
    margin-bottom: 0.5rem;
}

.file-upload-label {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem 1.5rem;
    background: linear-gradient(45deg, #f8fafc, #e2e8f0);
    border: 2px dashed #cbd5e0;
    border-radius: 12px;
    cursor: pointer;
    transition: var(--transition);
    font-weight: 600;
    color: var(--text-light);
}

.file-upload-label:hover {
    background: linear-gradient(45deg, #edf2f7, #e2e8f0);
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.file-text {
    margin-right: 0.5rem;
}

/* معاينة الصورة */
.image-preview-container {
    text-align: center;
}

.preview-placeholder {
    padding: 1.5rem;
    background: linear-gradient(45deg, #f8fafc, #e2e8f0);
    border-radius: 12px;
    border: 2px dashed #cbd5e0;
    color: var(--text-light);
}

.image-preview-active {
    position: relative;
    display: inline-block;
    max-width: 100%;
    background: linear-gradient(135deg, #f0fff4, #c6f6d5);
    border-radius: 12px;
    padding: 1rem;
    border: 1px solid #9ae6b4;
}

.preview-header {
    text-align: left;
    margin-bottom: 0.5rem;
}

.preview-image {
    max-width: 100%;
    max-height: 150px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.preview-remove {
    position: absolute;
    top: -8px;
    left: -8px;
    background: #e53e3e;
    color: white;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
    font-size: 0.7rem;
}

.preview-remove:hover {
    background: #c53030;
    transform: scale(1.1);
}

.preview-info {
    margin-top: 0.5rem;
}

/* الإعدادات */
.settings-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 12px;
    padding: 1rem;
}

.setting-item {
    margin-bottom: 1rem;
}

.setting-item:last-child {
    margin-bottom: 0;
}

.custom-switch {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.custom-switch-input {
    display: none;
}

.custom-switch-label {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    cursor: pointer;
    transition: var(--transition);
    padding: 0.5rem;
    border-radius: 10px;
    flex: 1;
}

.custom-switch-label:hover {
    background: rgba(255,255,255,0.5);
}

.switch-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
    transition: var(--transition);
}

.custom-switch-input:checked + .custom-switch-label .switch-icon {
    background: linear-gradient(45deg, #48bb78, #38a169);
}

.switch-text {
    flex: 1;
}

.switch-text strong {
    display: block;
    color: var(--text-dark);
    margin-bottom: 0.25rem;
}

.switch-text small {
    color: var(--text-light);
    font-size: 0.85rem;
}

/* معلومات المقال */
.article-info {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 12px;
    padding: 1rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
    padding: 0.75rem;
    background: white;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.info-item:last-child {
    margin-bottom: 0;
}

.info-item i {
    width: 35px;
    height: 35px;
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
}

/* زر التحديث */
.btn-update {
    background: linear-gradient(45deg, #ed8936, #dd6b20);
    border: none;
    border-radius: 15px;
    padding: 1rem 2rem;
    font-weight: 600;
    color: white;
    transition: var(--transition);
    width: 100%;
    font-size: 1.1rem;
}

.btn-update:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(237, 137, 54, 0.4);
    color: white;
}

/* معلومات إضافية */
.form-info {
    background: linear-gradient(135deg, #fff5f5, #fed7d7);
    border-radius: 12px;
    padding: 1rem;
    border: 1px solid #fed7d7;
}

.form-info .info-item {
    background: none;
    box-shadow: none;
    padding: 0;
    margin: 0;
}

@media (max-width: 768px) {
    .admin-form-header {
        padding: 1rem;
    }
    
    .form-section {
        padding: 1rem;
        margin-bottom: 1rem;
    }
    
    .custom-input, .custom-select, .custom-textarea {
        padding: 0.75rem 1rem;
    }
    
    .btn-update {
        padding: 0.875rem 1.5rem;
    }
    
    .current-image-container {
        flex-direction: column;
        text-align: center;
    }
    
    .info-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
}
</style>
@endsection