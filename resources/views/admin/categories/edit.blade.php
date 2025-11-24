@extends('admin.layouts.app')

@section('title', 'تعديل التصنيف: ' . $category->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تعديل التصنيف: {{ $category->name }}</h3>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary float-left">
                        <i class="fas fa-arrow-right"></i> رجوع
                    </a>
                </div>
                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name">اسم التصنيف *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $category->name) }}" 
                                           placeholder="أدخل اسم التصنيف" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description">وصف التصنيف</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="4" 
                                              placeholder="أدخل وصفاً مختصراً للتصنيف">{{ old('description', $category->description) }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> تحديث التصنيف
                                    </button>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">معلومات التصنيف</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="mb-2">
                                            <strong>الرابط:</strong><br>
                                            <small class="text-muted">{{ $category->slug }}</small>
                                        </p>
                                        <p class="mb-2">
                                            <strong>عدد المقالات:</strong><br>
                                            <span class="badge badge-info">{{ $category->articles_count ?? 0 }}</span>
                                        </p>
                                        <p class="mb-2">
                                            <strong>تاريخ الإنشاء:</strong><br>
                                            <small class="text-muted">{{ $category->created_at->format('Y-m-d') }}</small>
                                        </p>
                                        <p class="mb-0">
                                            <strong>آخر تحديث:</strong><br>
                                            <small class="text-muted">{{ $category->updated_at->format('Y-m-d') }}</small>
                                        </p>
                                    </div>
                                </div>

                                <div class="card mt-3 bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">تنبيه</h6>
                                        <p class="small text-muted mb-0">
                                            عند تعديل اسم التصنيف، سيتم تحديث الرابط تلقائياً.
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