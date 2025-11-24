@extends('admin.layouts.app')

@section('title', 'تفاصيل التعليق')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل التعليق #{{ $comment->id }}</h3>
                    <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary float-left">
                        <i class="fas fa-arrow-right"></i> رجوع للقائمة
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">محتوى التعليق</h5>
                                </div>
                                <div class="card-body">
                                    <div class="bg-light p-4 rounded">
                                        <p class="mb-0">{{ $comment->content }}</p>
                                    </div>
                                    
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <h6>معلومات التعليق:</h6>
                                            <p class="mb-2">
                                                <strong>الحالة:</strong>
                                                @if($comment->approved)
                                                    <span class="badge badge-success">مقبول</span>
                                                @else
                                                    <span class="badge badge-warning">بانتظار الموافقة</span>
                                                @endif
                                            </p>
                                            <p class="mb-2">
                                                <strong>تاريخ الإضافة:</strong><br>
                                                {{ $comment->created_at->format('Y-m-d H:i') }}
                                            </p>
                                            <p class="mb-0">
                                                <strong>آخر تحديث:</strong><br>
                                                {{ $comment->updated_at->format('Y-m-d H:i') }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>معلومات الكاتب:</h6>
                                            <p class="mb-2">
                                                <strong>الاسم:</strong><br>
                                                {{ $comment->author_name }}
                                            </p>
                                            <p class="mb-2">
                                                <strong>البريد الإلكتروني:</strong><br>
                                                {{ $comment->author_email }}
                                            </p>
                                            <p class="mb-0">
                                                <strong>IP Address:</strong><br>
                                                <small class="text-muted">غير متوفر</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">المقال المرتبط</h5>
                                </div>
                                <div class="card-body">
                                    <h6>
                                        <a href="{{ route('articles.show', $comment->article_id) }}" target="_blank" class="text-decoration-none">
                                            {{ $comment->article->title }}
                                        </a>
                                    </h6>
                                    <p class="text-muted small mb-2">
                                        بقلم: {{ $comment->article->author->name }}
                                    </p>
                                    <p class="text-muted small mb-3">
                                        {{ $comment->article->created_at->format('Y-m-d') }}
                                    </p>
                                    
                                    <div class="mb-3">
                                        <strong>حالة التعليقات في المقال:</strong><br>
                                        @if($comment->article->comments_enabled)
                                            <span class="badge badge-success">مفعلة</span>
                                        @else
                                            <span class="badge badge-danger">معطلة</span>
                                        @endif
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="{{ route('articles.show', $comment->article_id) }}" target="_blank" class="btn btn-info">
                                            <i class="fas fa-external-link-alt me-2"></i>عرض المقال
                                        </a>
                                        <a href="{{ route('admin.articles.edit', $comment->article_id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit me-2"></i>تعديل المقال
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">الإجراءات</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        @if($comment->approved)
                                            <form action="{{ route('admin.comments.disapprove', $comment) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-times me-2"></i>إلغاء الموافقة
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.comments.approve', $comment) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-check me-2"></i>موافقة
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('هل أنت متأكد من حذف هذا التعليق؟')">
                                                <i class="fas fa-trash me-2"></i>حذف التعليق
                                            </button>
                                        </form>
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