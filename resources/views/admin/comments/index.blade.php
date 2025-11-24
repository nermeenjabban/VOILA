@extends('admin.layouts.app')

@section('title', 'إدارة التعليقات')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">التعليقات</h3>
                </div>
                <div class="card-body">
                    <!-- شريط البحث والتصفية -->
                    <form action="{{ route('admin.comments.index') }}" method="GET" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" name="search" class="form-control" placeholder="بحث في التعليقات..." 
                                       value="{{ request('search') }}">
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-control">
                                    <option value="">جميع الحالات</option>
                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>مقبول</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>بانتظار الموافقة</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="article_id" class="form-control">
                                    <option value="">جميع المقالات</option>
                                    @foreach($articles as $article)
                                        <option value="{{ $article->id }}" {{ request('article_id') == $article->id ? 'selected' : '' }}>
                                            {{ Str::limit($article->title, 40) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">بحث</button>
                                <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">إعادة تعيين</a>
                            </div>
                        </div>
                    </form>

                    <!-- إجراءات جماعية -->
                    <form action="{{ route('admin.comments.bulk-action') }}" method="POST" class="mb-3" id="bulk-action-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <select name="action" class="form-control" required>
                                    <option value="">اختر إجراءً</option>
                                    <option value="approve">موافقة على المحدد</option>
                                    <option value="disapprove">إلغاء موافقة على المحدد</option>
                                    <option value="delete">حذف المحدد</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary" id="bulk-action-btn">تطبيق</button>
                            </div>
                            <div class="col-md-6 text-left">
                                <small class="text-muted">تم تحديد <span id="selected-count">0</span> تعليق</small>
                            </div>
                        </div>

                        @if($comments->count() > 0)
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50">
                                                <input type="checkbox" id="select-all">
                                            </th>
                                            <th width="60">#</th>
                                            <th>المحتوى</th>
                                            <th>المؤلف</th>
                                            <th>المقال</th>
                                            <th>الحالة</th>
                                            <th>التاريخ</th>
                                            <th width="150">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($comments as $comment)
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="comment_ids[]" value="{{ $comment->id }}" class="comment-checkbox">
                                            </td>
                                            <td>{{ $comment->id }}</td>
                                            <td>
                                                <div class="comment-content">
                                                    {{ Str::limit($comment->content, 80) }}
                                                </div>
                                                <small class="text-muted">{{ Str::limit($comment->content, 150) }}</small>
                                            </td>
                                            <td>
                                                <strong>{{ $comment->author_name }}</strong><br>
                                                <small class="text-muted">{{ $comment->author_email }}</small>
                                            </td>
                                            <td>
                                                <a href="{{ route('articles.show', $comment->article_id) }}" target="_blank" class="text-decoration-none">
                                                    {{ Str::limit($comment->article->title, 40) }}
                                                </a>
                                            </td>
                                            <td>
                                                @if($comment->approved)
                                                    <span class="badge badge-success">مقبول</span>
                                                @else
                                                    <span class="badge badge-warning">بانتظار الموافقة</span>
                                                @endif
                                            </td>
                                            <td>{{ $comment->created_at->format('Y-m-d H:i') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.comments.show', $comment) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if($comment->approved)
                                                        <form action="{{ route('admin.comments.disapprove', $comment) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm btn-warning" title="إلغاء الموافقة">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('admin.comments.approve', $comment) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="btn btn-sm btn-success" title="موافقة">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                                onclick="return confirm('هل أنت متأكد من حذف هذا التعليق؟')">
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
                                {{ $comments->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                <h4 class="text-muted">لا توجد تعليقات</h4>
                                <p class="text-muted">
                                    @if(request()->hasAny(['search', 'status', 'article_id']))
                                        لم نتمكن من العثور على تعليقات تطابق بحثك.
                                    @else
                                        لم يتم إضافة أي تعليقات بعد.
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
        const checkboxes = document.querySelectorAll('.comment-checkbox');
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
            const selected = document.querySelectorAll('.comment-checkbox:checked').length;
            selectedCount.textContent = selected;
            bulkActionBtn.disabled = selected === 0;
        }

        // تحديث العداد عند تغيير أي checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });

        // التأكيد على الإجراءات الجماعية
        document.getElementById('bulk-action-form').addEventListener('submit', function(e) {
            const selected = document.querySelectorAll('.comment-checkbox:checked').length;
            const action = this.querySelector('select[name="action"]').value;
            
            if (selected === 0) {
                e.preventDefault();
                alert('يرجى اختيار تعليقات أولاً.');
                return;
            }

            if (!action) {
                e.preventDefault();
                alert('يرجى اختيار إجراء.');
                return;
            }

            const actionText = {
                'approve': 'الموافقة على',
                'disapprove': 'إلغاء الموافقة على',
                'delete': 'حذف'
            }[action];

            if (!confirm(`هل أنت متأكد من ${actionText} ${selected} تعليق؟`)) {
                e.preventDefault();
            }
        });
    });
</script>

<style>
    .comment-content {
        max-width: 200px;
        word-wrap: break-word;
    }
</style>
@endsection