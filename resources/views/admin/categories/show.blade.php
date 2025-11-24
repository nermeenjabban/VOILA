@extends('admin.layouts.app')

@section('title', 'تفاصيل التصنيف: ' . $category->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل التصنيف: {{ $category->name }}</h3>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary float-left">
                        <i class="fas fa-arrow-right"></i> رجوع للقائمة
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">مقالات التصنيف</h5>
                                </div>
                                <div class="card-body">
                                    @if($articles->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>عنوان المقال</th>
                                                        <th>المؤلف</th>
                                                        <th>الحالة</th>
                                                        <th>التاريخ</th>
                                                        <th>الإجراءات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($articles as $article)
                                                    <tr>
                                                        <td>{{ $article->id }}</td>
                                                        <td>{{ Str::limit($article->title, 50) }}</td>
                                                        <td>{{ $article->author->name }}</td>
                                                        <td>
                                                            @if($article->is_published)
                                                                <span class="badge badge-success">منشور</span>
                                                            @else
                                                                <span class="badge badge-warning">مسودة</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $article->created_at->format('Y-m-d') }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-sm btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="{{ route('articles.show', $article) }}" target="_blank" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <div class="d-flex justify-content-center mt-3">
                                            {{ $articles->links() }}
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">لا توجد مقالات في هذا التصنيف</h5>
                                            <p class="text-muted">يمكنك إضافة مقالات جديدة وربطها بهذا التصنيف</p>
                                            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus me-2"></i>إضافة مقال جديد
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">معلومات التصنيف</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <strong>اسم التصنيف:</strong><br>
                                        {{ $category->name }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>الرابط:</strong><br>
                                        <code>{{ $category->slug }}</code>
                                    </div>
                                    <div class="mb-3">
                                        <strong>الوصف:</strong><br>
                                        @if($category->description)
                                            {{ $category->description }}
                                        @else
                                            <span class="text-muted">لا يوجد وصف</span>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <strong>عدد المقالات:</strong><br>
                                        <span class="badge badge-primary" style="font-size: 1.1em;">
                                            {{ $articles->total() }}
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>تاريخ الإنشاء:</strong><br>
                                        {{ $category->created_at->format('Y-m-d') }}
                                    </div>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                                            <i class="fas fa-edit me-2"></i>تعديل التصنيف
                                        </a>
                                        <a href="/category/{{ $category->id }}" target="_blank" class="btn btn-info">
                                            <i class="fas fa-external-link-alt me-2"></i>عرض في الموقع
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
</div>
@endsection