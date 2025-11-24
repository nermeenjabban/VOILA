@extends('admin.layouts.app')

@section('title', 'تعديل المستخدم: ' . $user->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">تعديل المستخدم: {{ $user->name }}</h3>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary float-left">
                        <i class="fas fa-arrow-right"></i> رجوع
                    </a>
                </div>
                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name">الاسم الكامل *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $user->name) }}" 
                                           placeholder="أدخل الاسم الكامل" required>
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">البريد الإلكتروني *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $user->email) }}" 
                                           placeholder="أدخل البريد الإلكتروني" required>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">كلمة المرور</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                                   id="password" name="password" 
                                                   placeholder="اتركه فارغاً للحفاظ على كلمة المرور الحالية">
                                            @error('password')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirmation">تأكيد كلمة المرور</label>
                                            <input type="password" class="form-control" 
                                                   id="password_confirmation" name="password_confirmation" 
                                                   placeholder="أعد إدخال كلمة المرور">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="role">الدور *</label>
                                    <select class="form-control @error('role') is-invalid @enderror" 
                                            id="role" name="role" required>
                                        <option value="">اختر الدور</option>
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>مدير</option>
                                        <option value="editor" {{ old('role', $user->role) == 'editor' ? 'selected' : '' }}>محرر</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> تحديث المستخدم
                                    </button>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">معلومات المستخدم</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center mb-3">
                                            <i class="fas fa-user-circle fa-3x text-primary"></i>
                                        </div>
                                        <p class="mb-2">
                                            <strong>الحالة:</strong><br>
                                            @if($user->is_active)
                                                <span class="badge badge-success">نشط</span>
                                            @else
                                                <span class="badge badge-danger">معطل</span>
                                            @endif
                                        </p>
                                        <p class="mb-2">
                                            <strong>عدد المقالات:</strong><br>
                                            <span class="badge badge-info">{{ $user->articles()->count() }}</span>
                                        </p>
                                        <p class="mb-2">
                                            <strong>تاريخ التسجيل:</strong><br>
                                            <small class="text-muted">{{ $user->created_at->format('Y-m-d') }}</small>
                                        </p>
                                        <p class="mb-0">
                                            <strong>آخر تحديث:</strong><br>
                                            <small class="text-muted">{{ $user->updated_at->format('Y-m-d') }}</small>
                                        </p>
                                    </div>
                                </div>

                                <div class="card mt-3 bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">ملاحظة</h6>
                                        <p class="small text-muted mb-0">
                                            اترك حقلي كلمة المرور فارغين إذا كنت لا تريد تغيير كلمة المرور.
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