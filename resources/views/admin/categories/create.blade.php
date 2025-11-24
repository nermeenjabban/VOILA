@extends('admin.layouts.app')

@section('title', 'إضافة تصنيف جديد')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">إضافة تصنيف جديد</h3>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary float-left">
                        <i class="fas fa-arrow-right"></i> رجوع
                    </a>
                </div>
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name">اسم التصنيف *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" 
                                           placeholder="أدخل اسم التصنيف" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">وصف التصنيف</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="4" 
                                              placeholder="أدخل وصفاً مختصراً للتصنيف">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">هذا الحقل اختياري</small>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> حفظ التصنيف
                                    </button>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">معلومات سريعة</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="small text-muted mb-2">
                                            <i class="fas fa-info-circle me-2"></i>
                                            التصنيفات تساعد في تنظيم المقالات وتصنيفها.
                                        </p>
                                        <p class="small text-muted mb-2">
                                            <i class="fas fa-link me-2"></i>
                                            سيتم إنشاء رابط تلقائي للتصنيف.
                                        </p>
                                        <p class="small text-muted mb-0">
                                            <i class="fas fa-newspaper me-2"></i>
                                            يمكن ربط المقالات بالتصنيفات.
                                        </p>
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