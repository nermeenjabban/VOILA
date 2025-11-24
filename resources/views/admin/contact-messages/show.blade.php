@extends('admin.layouts.app')

@section('title', 'تفاصيل الرسالة: ' . $contactMessage->subject)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تفاصيل الرسالة: {{ $contactMessage->subject }}</h3>
                    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary float-left">
                        <i class="fas fa-arrow-right"></i> رجوع للقائمة
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">محتوى الرسالة</h5>
                                </div>
                                <div class="card-body">
                                    <div class="bg-light p-4 rounded">
                                        <p class="mb-0" style="white-space: pre-wrap;">{{ $contactMessage->message }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- معلومات إضافية -->
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">معلومات الرسالة</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-2">
                                                <strong>الموضوع:</strong><br>
                                                {{ $contactMessage->subject }}
                                            </p>
                                            <p class="mb-2">
                                                <strong>الحالة:</strong><br>
                                                @if($contactMessage->reviewed)
                                                    <span class="badge badge-success">مقروءة</span>
                                                @else
                                                    <span class="badge badge-warning">جديدة</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-2">
                                                <strong>تاريخ الإرسال:</strong><br>
                                                {{ $contactMessage->created_at->format('Y-m-d H:i') }}
                                            </p>
                                            <p class="mb-0">
                                                <strong>آخر تحديث:</strong><br>
                                                {{ $contactMessage->updated_at->format('Y-m-d H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">معلومات المرسل</h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-4">
                                        <i class="fas fa-user-circle fa-3x text-primary"></i>
                                        <h4 class="mt-2">{{ $contactMessage->name }}</h4>
                                    </div>

                                    <div class="mb-3">
                                        <strong>البريد الإلكتروني:</strong><br>
                                        <a href="mailto:{{ $contactMessage->email }}" class="text-decoration-none">
                                            {{ $contactMessage->email }}
                                        </a>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <a href="mailto:{{ $contactMessage->email }}?subject=رد على: {{ $contactMessage->subject }}" 
                                           class="btn btn-primary">
                                            <i class="fas fa-reply me-2"></i>الرد على الرسالة
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
                                        @if($contactMessage->reviewed)
                                            <form action="{{ route('admin.contact-messages.mark-unread', $contactMessage) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-envelope me-2"></i>تحديد كغير مقروءة
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.contact-messages.mark-reviewed', $contactMessage) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-check me-2"></i>تحديد كمقروءة
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" 
                                                    onclick="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">
                                                <i class="fas fa-trash me-2"></i>حذف الرسالة
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