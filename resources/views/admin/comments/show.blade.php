@extends('admin.layouts.app')

@section('title', 'تفاصيل التعليق')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">

            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">تفاصيل التعليق #{{ $comment->id }}</h3>

                    <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-right"></i>
                        رجوع
                    </a>
                </div>

                <div class="card-body">

                    <div class="row">

                        {{-- القسم اليسار - نص التعليق --}}
                        <div class="col-lg-8 col-md-12 mb-3">
                            <div class="card h-100 shadow-sm">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">محتوى التعليق</h5>
                                </div>

                                <div class="card-body">

                                    <div class="bg-light p-3 rounded mb-4">
                                        <p class="mb-0 text-wrap">{{ $comment->content }}</p>
                                    </div>

                                    <div class="row">

                                        {{-- معلومات التعليق --}}
                                        <div class="col-md-6 mb-3">
                                            <h6 class="font-weight-bold">معلومات التعليق:</h6>

                                           

                                            <p class="mb-2">
                                                <strong>تاريخ الإضافة:</strong><br>
                                                {{ $comment->created_at->format('Y-m-d H:i') }}
                                            </p>

                                            <p class="mb-0">
                                                <strong>آخر تحديث:</strong><br>
                                                {{ $comment->updated_at->format('Y-m-d H:i') }}
                                            </p>
                                        </div>

                                        {{-- معلومات الكاتب --}}
                                        <div class="col-md-6 mb-3">
                                            <h6 class="font-weight-bold">معلومات الكاتب:</h6>

                                           

                                            <p class="mb-2">
                                                <strong>البريد الإلكتروني:</strong><br>
                                                {{ $comment->author_email }}
                                            </p>

                                           
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- القسم اليمين - المقال المرتبط + الإجراءات --}}
                        <div class="col-lg-4 col-md-12">

                            {{-- بطاقة المقال --}}
                            <div class="card shadow-sm mb-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">المقال المرتبط</h5>
                                </div>

                                <div class="card-body">

                                    <h6 class="mb-1">
                                        <a href="{{ route('articles.show', $comment->article_id) }}"
                                           class="text-decoration-none" target="_blank">
                                            {{ $comment->article->title }}
                                        </a>
                                    </h6>

                                    <p class="text-muted small mb-1">
                                        بقلم: {{ $comment->article->author->name }}
                                    </p>

                                    <p class="text-muted small mb-3">
                                        {{ $comment->article->created_at->format('Y-m-d') }}
                                    </p>

                                    <div class="mb-3">
                                        <strong>حالة التعليقات:</strong><br>
                                        @if($comment->article->comments_enabled)
                                            <span class="badge badge-success">مفعلة</span>
                                        @else
                                            <span class="badge badge-danger">معطلة</span>
                                        @endif
                                    </div>

                                    <a href="{{ route('articles.show', $comment->article_id) }}"
                                       class="btn btn-info btn-block mb-2" target="_blank">
                                        <i class="fas fa-external-link-alt ml-1"></i> عرض المقال
                                    </a>

                                   

                                </div>
                            </div>

                            {{-- بطاقة الإجراءات --}}
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">الإجراءات</h5>
                                </div>

                                <div class="card-body">

                                    {{-- الموافقة / إلغاء --}}
                                    @if($comment->approved)
                                        <form action="{{ route('admin.comments.disapprove', $comment) }}"
                                              method="POST" class="mb-2">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-warning btn-block">
                                                <i class="fas fa-times ml-1"></i> إلغاء الموافقة
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.comments.approve', $comment) }}"
                                              method="POST" class="mb-2">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-success btn-block">
                                                <i class="fas fa-check ml-1"></i> موافقة
                                            </button>
                                        </form>
                                    @endif

                                    {{-- حذف --}}
                                    <form action="{{ route('admin.comments.destroy', $comment) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-block"
                                            onclick="return confirm('هل أنت متأكد من حذف هذا التعليق؟')">
                                            <i class="fas fa-trash ml-1"></i> حذف التعليق
                                        </button>
                                    </form>

                                </div>
                            </div>

                        </div>

                    </div> {{-- row --}}

                </div> {{-- card-body --}}
            </div> {{-- card --}}

        </div>
    </div>

</div>
@endsection
