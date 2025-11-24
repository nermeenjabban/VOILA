@extends('admin.layouts.app')

@section('title', 'إدارة رسائل الاتصال')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">رسائل الاتصال</h3>
                </div>
                <div class="card-body">
                    <!-- إحصائيات سريعة -->
                    @php
                        $stats = app('App\Http\Controllers\Admin\ContactMessageController')->getStats();
                    @endphp
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $stats['total'] }}</h4>
                                            <p class="mb-0">إجمالي الرسائل</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-envelope fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $stats['unread'] }}</h4>
                                            <p class="mb-0">رسائل جديدة</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-envelope-open fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4>{{ $stats['read'] }}</h4>
                                            <p class="mb-0">رسائل مقروءة</p>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-check-circle fa-2x"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- شريط البحث والتصفية -->
                    <form action="{{ route('admin.contact-messages.index') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="بحث في الرسائل..." 
                                       value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-control">
                                    <option value="">جميع الحالات</option>
                                    <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>جديدة</option>
                                    <option value="reviewed" {{ request('status') == 'reviewed' ? 'selected' : '' }}>مقروءة</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">بحث</button>
                                <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">إعادة تعيين</a>
                            </div>
                        </div>
                    </form>

                    <!-- إجراءات جماعية -->
                    <form action="{{ route('admin.contact-messages.bulk-action') }}" method="POST" class="mb-3" id="bulk-action-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <select name="action" class="form-control" required>
                                    <option value="">اختر إجراءً</option>
                                    <option value="mark-reviewed">تحديد كمقروءة</option>
                                    <option value="mark-unread">تحديد كغير مقروءة</option>
                                    <option value="delete">حذف المحدد</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary" id="bulk-action-btn">تطبيق</button>
                            </div>
                            <div class="col-md-6 text-left">
                                <small class="text-muted">تم تحديد <span id="selected-count">0</span> رسالة</small>
                            </div>
                        </div>

                        @if($messages->count() > 0)
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">
                                                <input type="checkbox" id="select-all">
                                            </th>
                                            <th width="60">#</th>
                                            <th>المرسل</th>
                                            <th>الموضوع</th>
                                            <th>الرسالة</th>
                                            <th>الحالة</th>
                                            <th>التاريخ</th>
                                            <th width="120">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($messages as $message)
                                        <tr class="{{ $message->reviewed ? '' : 'table-warning' }}">
                                            <td>
                                                <input type="checkbox" name="message_ids[]" value="{{ $message->id }}" class="message-checkbox">
                                            </td>
                                            <td>{{ $message->id }}</td>
                                            <td>
                                                <strong>{{ $message->name }}</strong><br>
                                                <small class="text-muted">{{ $message->email }}</small>
                                            </td>
                                            <td>
                                                <strong>{{ $message->subject }}</strong>
                                            </td>
                                            <td>
                                                <div class="message-preview">
                                                    {{ Str::limit($message->message, 80) }}
                                                </div>
                                            </td>
                                            <td>
                                                @if($message->reviewed)
                                                    <span class="badge badge-success">مقروءة</span>
                                                @else
                                                    <span class="badge badge-warning">جديدة</span>
                                                @endif
                                            </td>
                                            <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.contact-messages.show', $message) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if($message->reviewed)
                                                        <form action="{{ route('admin.contact-messages.mark-unread', $message) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm btn-warning" title="تحديد كغير مقروءة">
                                                                <i class="fas fa-envelope"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('admin.contact-messages.mark-reviewed', $message) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm btn-success" title="تحديد كمقروءة">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('admin.contact-messages.destroy', $message) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                                onclick="return confirm('هل أنت متأكد من حذف هذه الرسالة؟')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="d-flex justify-content-center mt-3">
                                {{ $messages->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h4 class="text-muted">لا توجد رسائل</h4>
                                <p class="text-muted">
                                    @if(request()->hasAny(['search', 'status']))
                                        لم نتمكن من العثور على رسائل تطابق بحثك.
                                    @else
                                        لم يتم إرسال أي رسائل حتى الآن.
                                    @endif
                                </p>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.message-checkbox');
        const selectedCount = document.getElementById('selected-count');
        const bulkActionBtn = document.getElementById('bulk-action-btn');

        // تحديد/إلغاء تحديد الكل
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectedCount();
        });

        // تحديث العداد
        function updateSelectedCount() {
            const selected = document.querySelectorAll('.message-checkbox:checked').length;
            selectedCount.textContent = selected;
            bulkActionBtn.disabled = selected === 0;
        }

        // تحديث العداد عند تغيير أي checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });

        // التأكيد على الإجراءات الجماعية
        document.getElementById('bulk-action-form').addEventListener('submit', function(e) {
            const selected = document.querySelectorAll('.message-checkbox:checked').length;
            const action = this.querySelector('select[name="action"]').value;
            
            if (selected === 0) {
                e.preventDefault();
                alert('يرجى اختيار رسائل أولاً.');
                return;
            }

            if (!action) {
                e.preventDefault();
                alert('يرجى اختيار إجراء.');
                return;
            }

            const actionText = {
                'mark-reviewed': 'تحديد كمقروءة',
                'mark-unread': 'تحديد كغير مقروءة',
                'delete': 'حذف'
            }[action];

            if (!confirm(`هل أنت متأكد من ${actionText} ${selected} رسالة؟`)) {
                e.preventDefault();
            }
        });
    });
</script>

<style>
    .message-preview {
        max-width: 200px;
        word-wrap: break-word;
    }
    .table-warning {
        background-color: #fff3cd !important;
    }
</style>
@endsection