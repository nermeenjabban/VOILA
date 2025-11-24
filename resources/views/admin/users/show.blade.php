@extends('admin.layouts.app')

@section('title', 'تفاصيل المستخدم: ' . $user->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل المستخدم: {{ $user->name }}</h3>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary float-left">
                        <i class="fas fa-arrow-right"></i> رجوع للقائمة
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">مقالات المستخدم</h5>
                                </div>
                                <div class="card-body">
                                    @if($userArticles->count() > 0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>عنوان المقال</th>
                                                        <th>التصنيف</th>
                                                        <th>الحالة</th>
                                                        <th>التاريخ</th>
                                                        <th>الإجراءات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($userArticles as $article)
                                                    <tr>
                                                        <td>{{ $article->id }}</td>
                                                        <td>{{ Str::limit($article->title, 50) }}</td>
                                                        <td>
                                                            <span class="badge badge-info">{{ $article->category->name }}</span>
                                                        </td>
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
                                            {{ $userArticles->links() }}
                                        </div>
                                    @else
                                        <div class="text-center py-4">
                                            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">لا توجد مقالات لهذا المستخدم</h5>
                                            <p class="text-muted">لم يقم هذا المستخدم بإضافة أي مقالات بعد</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">معلومات المستخدم</h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-4">
                                        <i class="fas fa-user-circle fa-4x text-primary"></i>
                                        <h4 class="mt-2">{{ $user->name }}</h4>
                                        @if($user->role === 'admin')
                                            <span class="badge badge-success">مدير نظام</span>
                                        @else
                                            <span class="badge badge-primary">محرر</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <strong>البريد الإلكتروني:</strong><br>
                                        {{ $user->email }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>الحالة:</strong><br>
                                        @if($user->is_active)
                                            <span class="badge badge-success">نشط</span>
                                        @else
                                            <span class="badge badge-danger">معطل</span>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <strong>إجمالي المقالات:</strong><br>
                                        <span class="badge badge-info" style="font-size: 1.1em;">
                                            {{ $userArticles->total() }}
                                        </span>
                                    </div>
                                    <div class="mb-3">
                                        <strong>تاريخ التسجيل:</strong><br>
                                        {{ $user->created_at->format('Y-m-d') }}
                                    </div>
                                    <div class="mb-3">
                                        <strong>آخر تحديث:</strong><br>
                                        {{ $user->updated_at->format('Y-m-d') }}
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                                            <i class="fas fa-edit me-2"></i>تعديل المستخدم
                                        </a>
                                        @if(auth()->id() !== $user->id)
                                            <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn {{ $user->is_active ? 'btn-secondary' : 'btn-success' }} w-100">
                                                    <i class="fas {{ $user->is_active ? 'fa-user-slash' : 'fa-user-check' }} me-2"></i>
                                                    {{ $user->is_active ? 'تعطيل' : 'تفعيل' }}
                                                </button>
                                            </form>
                                        @endif
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