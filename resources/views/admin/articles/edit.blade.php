@extends('admin.layouts.app')

@section('title', 'تعديل المقال')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تعديل المقال: {{ $article->title }}</h3>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary float-left">
                        <i class="fas fa-arrow-right"></i> رجوع
                    </a>
                </div>
                <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">عنوان المقال *</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title', $article->title) }}" required>
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="content">المحتوى *</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" 
                                              id="content" name="content" rows="15" required>{{ old('content', $article->content) }}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="category_id">التصنيف *</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror" 
                                            id="category_id" name="category_id" required>
                                        <option value="">اختر التصنيف</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">صورة المقال</label>
                                    
                                    @if($article->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" 
                                                 style="max-width: 200px; max-height: 200px; border-radius: 5px;">
                                            <br>
                                            <small class="text-muted">الصورة الحالية</small>
                                        </div>
                                    @endif
                                    
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" 
                                               id="image" name="image" accept="image/*">
                                        <label class="custom-file-label" for="image">اختر صورة جديدة</label>
                                    </div>
                                    @error('image')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    <small class="form-text text-muted">اتركه فارغاً للحفاظ على الصورة الحالية</small>
                                    
                                    <div class="mt-2" id="image-preview"></div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_published" name="is_published" value="1" 
                                            {{ old('is_published', $article->is_published) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_published">نشر المقال</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-save"></i> تحديث المقال
                                    </button>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-body">
                                        <h6>معلومات المقال:</h6>
                                        <p class="mb-1"><strong>المؤلف:</strong> {{ $article->author->name }}</p>
                                        <p class="mb-1"><strong>تاريخ الإنشاء:</strong> {{ $article->created_at->format('Y-m-d') }}</p>
                                        <p class="mb-0"><strong>آخر تحديث:</strong> {{ $article->updated_at->format('Y-m-d') }}</p>
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
    // معاينة الصورة
    document.getElementById('image').addEventListener('change', function(e) {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = '';
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '200px';
                img.style.maxHeight = '200px';
                img.style.borderRadius = '5px';
                img.style.marginTop = '10px';
                preview.appendChild(img);
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });

    // تحديث اسم الملف في input file
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        const fileName = document.getElementById('image').files[0].name;
        const nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endsection