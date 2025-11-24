@extends('admin.layouts.app')

@section('title', 'لوحة التحكم')

@section('content')
@php
    use App\Models\ContactMessage;
    $contactStats = [
        'total' => ContactMessage::count(),
        'unread' => ContactMessage::where('reviewed', false)->count()
    ];
@endphp

<!-- في قسم الإحصائيات أضيفي -->
<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-0 shadow-sm h-100">
        <div class="card-body text-center">
            <i class="fas fa-envelope fa-2x text-warning mb-3"></i>
            <h3>{{ $contactStats['total'] }}</h3>
            <p class="text-muted mb-0">رسائل الاتصال</p>
            @if($contactStats['unread'] > 0)
                <small class="text-danger">
                    <i class="fas fa-circle me-1"></i>
                    {{ $contactStats['unread'] }} جديدة
                </small>
            @endif
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- الإحصائيات -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-newspaper fa-2x text-primary mb-3"></i>
                    <h3>0</h3>
                    <p class="text-muted mb-0">المقالات</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-comments fa-2x text-success mb-3"></i>
                    <h3>0</h3>
                    <p class="text-muted mb-0">التعليقات</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-envelope fa-2x text-warning mb-3"></i>
                    <h3>0</h3>
                    <p class="text-muted mb-0">رسائل الاتصال</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-2x text-info mb-3"></i>
                    <h3>0</h3>
                    <p class="text-muted mb-0">المستخدمين</p>
                </div>
            </div>
        </div>
    </div>

    <!-- محتوى إضافي -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">مرحباً بك في لوحة تحكم VOILA!</h5>
                    <p class="card-text">
                        هذه لوحة التحكم الخاصة بنظام إدارة المحتوى. يمكنك من هنا إدارة المقالات، التصنيفات، 
                        التعليقات، ورسائل الاتصال.
                    </p>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h6>الصلاحيات المتاحة:</h6>
                            <ul>
                                <li>إدارة المقالات والتعديل عليها</li>
                                <li>التحكم في التعليقات وموافقتها</li>
                                <li>عرض رسائل الاتصال والرد عليها</li>
                                @if(Auth::user()->role == 'admin')
                                <li>إدارة المستخدمين والصلاحيات</li>
                                <li>التحكم الكامل في النظام</li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6>إحصائيات سريعة:</h6>
                            <p class="mb-1"><strong>الدور:</strong> {{ Auth::user()->role == 'admin' ? 'مدير نظام' : 'محرر' }}</p>
                            <p class="mb-1"><strong>البريد الإلكتروني:</strong> {{ Auth::user()->email }}</p>
                            <p class="mb-0"><strong>تاريخ التسجيل:</strong> {{ Auth::user()->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>
                    
                    <!-- روابط سريعة -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h6>روابط سريعة:</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('admin.articles.index') }}" class="btn btn-primary">
                                    <i class="fas fa-newspaper me-2"></i>إدارة المقالات
                                </a>
                                <a href="{{ route('admin.articles.create') }}" class="btn btn-success">
                                    <i class="fas fa-plus me-2"></i>مقال جديد
                                </a>
                                <a href="{{ route('home') }}" target="_blank" class="btn btn-info">
                                    <i class="fas fa-external-link-alt me-2"></i>عرض الموقع
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection