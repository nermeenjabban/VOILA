@extends('admin.layouts.app')

@section('title', 'إدارة المقالات')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">المقالات</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> إضافة مقال جديد
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- شريط البحث والتصفية -->
                    <form action="{{ route('admin.articles.index') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control" placeholder="بحث في المقالات..." 
                                       value="{{ request('search') }}">
                            </div>
                            <div class="col-md-2">
                                <select name="category_id" class="form-control">
                                    <option value="">جميع التصنيفات</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-control">
                                    <option value="">جميع الحالات</option>
                                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>منشور</option>
                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">بحث</button>
                                <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">إعادة تعيين</a>
                            </div>
                        </div>
                    </form>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الصورة</th>
                                <th>العنوان</th>
                                <th>التصنيف</th>
                                <th>المؤلف</th>
                                <th>الحالة</th>
                                <th>تاريخ النشر</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>
                                    @if($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" 
                                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                    @else
                                        <div style="width: 50px; height: 50px; background: #f8f9fa; border-radius: 5px; 
                                                    display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ Str::limit($article->title, 50) }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $article->category->name }}</span>
                                </td>
                                <td>{{ $article->author->name }}</td>
                                <td>
                                    @if($article->is_published)
                                        <span class="badge badge-success">منشور</span>
                                    @else
                                        <span class="badge badge-warning">مسودة</span>
                                    @endif
                                </td>
                                <td>
                                    @if($article->published_at)
                                        {{ $article->published_at->format('Y-m-d') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.articles.toggle-publish', $article) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm {{ $article->is_published ? 'btn-secondary' : 'btn-success' }}">
                                                <i class="fas {{ $article->is_published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                            </button>
                                        </form>

                                        <!-- في عمود الإجراءات أضيفي -->
<form action="{{ route('admin.articles.toggle-comments', $article) }}" method="POST" class="d-inline">
    @csrf
    @method('PATCH')
    <button type="submit" class="btn btn-sm {{ $article->comments_enabled ? 'btn-secondary' : 'btn-success' }}" 
            title="{{ $article->comments_enabled ? 'تعطيل التعليقات' : 'تفعيل التعليقات' }}">
        <i class="fas {{ $article->comments_enabled ? 'fa-comment-slash' : 'fa-comment' }}"></i>
    </button>
</form>
                                        <a href="{{ route('articles.show', $article) }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="d-flex justify-content-center">
                        {{ $articles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection