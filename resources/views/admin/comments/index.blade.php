@extends('admin.layouts.app')

@section('title', 'إدارة التعليقات')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card admin-card">
                <div class="card-header admin-card-header">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3 gap-md-0">
                        <h3 class="card-title mb-0 text-center text-md-start">
                            <i class="fas fa-comments me-2 text-primary"></i>
                            إدارة التعليقات
                        </h3>
                        <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary btn-back">
                            <i class="fas fa-redo me-2"></i> تحديث الصفحة
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- شريط البحث والتصفية -->
                    <div class="search-filter-card mb-4">
                        <form action="{{ route('admin.comments.index') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">بحث في التعليقات</label>
                                        <input type="text" name="search" class="form-control search-input" 
                                               placeholder="ابحث في المحتوى، اسم المؤلف أو البريد..." 
                                               value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">الحالة</label>
                                        <select name="status" class="form-control select-input">
                                            <option value="">جميع الحالات</option>
                                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>مقبول</option>
                                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>بانتظار الموافقة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">المقال</label>
                                        <select name="article_id" class="form-control select-input">
                                            <option value="">جميع المقالات</option>
                                            @foreach($articles as $article)
                                                <option value="{{ $article->id }}" {{ request('article_id') == $article->id ? 'selected' : '' }}>
                                                    {{ Str::limit($article->title, 35) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label d-none d-md-block">&nbsp;</label>
                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary btn-search">
                                                <i class="fas fa-search me-2"></i>بحث
                                            </button>
                                            <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary btn-reset">
                                                <i class="fas fa-redo me-2"></i>إعادة تعيين
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- إجراءات جماعية -->
                    <form action="{{ route('admin.comments.bulk-action') }}" method="POST" class="mb-4" id="bulk-action-form">
                        @csrf
                        <div class="bulk-actions-card">
                            <div class="bulk-actions-header">
                                <h6 class="bulk-actions-title mb-0">
                                    <i class="fas fa-tasks me-2 text-primary"></i>
                                    الإجراءات الجماعية
                                </h6>
                                <div class="selected-info">
                                    <small class="text-muted">تم تحديد <span id="selected-count" class="selected-number">0</span> تعليق</small>
                                </div>
                            </div>
                            <div class="bulk-actions-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-4">
                                        <select name="action" class="form-control select-input" required id="bulk-action-select">
                                            <option value="">اختر إجراءً جماعياً</option>
                                            <option value="approve">موافقة على المحدد</option>
                                            <option value="disapprove">إلغاء موافقة على المحدد</option>
                                            <option value="delete">حذف المحدد</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary btn-bulk-action w-100" id="bulk-action-btn" >
                                            <i class="fas fa-play me-2"></i>تطبيق
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input type="checkbox" id="select-all" class="form-check-input">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- جدول التعليقات -->
                        @if($comments->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover admin-table">
                                    <thead class="admin-table-header">
                                        <tr>
                                            <th width="50" class="text-center">تحديد</th>
                                            <th width="70">#</th>
                                            <th>المحتوى</th>
                                            <th width="150">المؤلف</th>
                                            <th width="150">المقال</th>
                                            <th width="120">الحالة</th>
                                            <th width="130">التاريخ</th>
                                            <th width="140">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($comments as $comment)
                                        <tr class="admin-table-row">
                                            <td class="text-center">
                                                <input type="checkbox" name="comment_ids[]" value="{{ $comment->id }}" class="comment-checkbox">
                                            </td>
                                            <td>
                                                <span class="comment-id">{{ $comment->id }}</span>
                                            </td>
                                            <td>
                                                <div class="comment-content">
                                                    <div class="comment-text">
                                                        {{ Str::limit($comment->content, 100) }}
                                                    </div>
                                                    @if(strlen($comment->content) > 100)
                                                    <small class="text-muted">{{ Str::limit($comment->content, 150) }}</small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="author-info">
                                                    <strong class="author-name">{{ $comment->author_name }}</strong>
                                                    <small class="author-email">{{ $comment->author_email }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="article-info">
                                                    <a href="{{ route('articles.show', $comment->article_id) }}" target="_blank" class="article-link">
                                                        {{ Str::limit($comment->article->title, 40) }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td>
                                                @if($comment->approved)
                                                    <span class="status-badge approved">
                                                        <i class="fas fa-check-circle me-1"></i>مقبول
                                                    </span>
                                                @else
                                                    <span class="status-badge pending">
                                                        <i class="fas fa-clock me-1"></i>بانتظار الموافقة
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="date-info">
                                                    <i class="fas fa-calendar me-1 text-muted"></i>
                                                    {{ $comment->created_at->format('Y-m-d') }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('admin.comments.show', $comment) }}" 
                                                       class="btn btn-action btn-view"
                                                       title="عرض التفاصيل">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if($comment->approved)
                                                        <form action="{{ route('admin.comments.disapprove', $comment) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-action btn-disapprove" title="إلغاء الموافقة">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('admin.comments.approve', $comment) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('POST')
                                                            <button type="submit" class="btn btn-action btn-approve" title="موافقة">
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-action btn-delete"
                                                                onclick="return confirm('هل أنت متأكد من حذف هذا التعليق؟')"
                                                                title="حذف التعليق">
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
                            
                            <!-- الترقيم -->
                            @if($comments->hasPages())
                            <div class="pagination-container mt-4">
                                <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3 gap-md-0">
                                    <div class="pagination-info">
                                        <p class="text-muted mb-0">
                                            عرض {{ $comments->firstItem() }} إلى {{ $comments->lastItem() }} من أصل {{ $comments->total() }} تعليق
                                        </p>
                                    </div>
                                    <div class="pagination-links">
                                        {{ $comments->appends(request()->query())->links() }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        @else
                            <div class="empty-state text-center py-5">
                                <i class="fas fa-comments fa-4x text-muted mb-3"></i>
                                <h4 class="text-muted">
                                    @if(request()->hasAny(['search', 'status', 'article_id']))
                                        لا توجد تعليقات تطابق بحثك
                                    @else
                                        لا توجد تعليقات
                                    @endif
                                </h4>
                                <p class="text-muted mb-4">
                                    @if(request()->hasAny(['search', 'status', 'article_id']))
                                        حاول تعديل معايير البحث أو إعادة تعيين الفلتر
                                    @else
                                        لم يتم إضافة أي تعليقات بعد
                                    @endif
                                </p>
                                @if(request()->hasAny(['search', 'status', 'article_id']))
                                    <a href="{{ route('admin.comments.index') }}" class="btn btn-primary">
                                        <i class="fas fa-redo me-2"></i>عرض جميع التعليقات
                                    </a>
                                @endif
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
:root {
    --primary-color: #667eea;
    --secondary-color: #764ba2;
    --accent-color: #f093fb;
    --text-dark: #2d3748;
    --text-light: #718096;
    --bg-light: #f8fafc;
    --shadow: 0 10px 30px rgba(0,0,0,0.1);
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* البطاقة الرئيسية */
.admin-card {
    border: none;
    border-radius: 20px;
    box-shadow: var(--shadow);
    background: white;
    margin-bottom: 2rem;
}

.admin-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-bottom: 1px solid rgba(0,0,0,0.05);
    padding: 1.5rem 1.5rem;
    border-radius: 20px 20px 0 0 !important;
}

.admin-card-header .card-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.btn-back {
    background: linear-gradient(45deg, #a0aec0, #718096);
    border: none;
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: var(--transition);
    color: white;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
}

.btn-back:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(160, 174, 192, 0.4);
    color: white;
}

/* شريط البحث */
.search-filter-card {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 15px;
    padding: 1.5rem;
    border: 1px solid rgba(0,0,0,0.05);
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.search-input, .select-input {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    font-size: 0.9rem;
    transition: var(--transition);
    background: white;
    width: 100%;
}

.search-input:focus, .select-input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    outline: none;
}

.btn-search, .btn-reset {
    border: none;
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: var(--transition);
    font-size: 0.9rem;
    width: 100%;
}

.btn-search {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
}

.btn-search:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

.btn-reset {
    background: linear-gradient(45deg, #a0aec0, #718096);
    color: white;
}

.btn-reset:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(160, 174, 192, 0.4);
}

/* الإجراءات الجماعية */
.bulk-actions-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    overflow: hidden;
    margin-bottom: 1.5rem;
    border: 1px solid rgba(0,0,0,0.05);
}

.bulk-actions-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.bulk-actions-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.selected-info {
    font-size: 0.9rem;
}

.selected-number {
    font-weight: 700;
    color: var(--primary-color);
}

.bulk-actions-body {
    padding: 1.5rem;
}

.btn-bulk-action {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: var(--transition);
    color: white;
    font-size: 0.9rem;
}

.btn-bulk-action:not(:disabled):hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

.btn-bulk-action:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

/* الجدول */
.admin-table {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
    background: white;
    margin-bottom: 0;
}

.admin-table-header {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
}

.admin-table-header th {
    border: none;
    padding: 1rem;
    font-weight: 600;
    text-align: center;
    font-size: 0.9rem;
}

.admin-table-row {
    transition: var(--transition);
    border-bottom: 1px solid rgba(0,0,0,0.05);
    background: white;
}

.admin-table-row:hover {
    background: rgba(102, 126, 234, 0.03);
    transform: translateY(-1px);
}

.admin-table-row td {
    padding: 1rem;
    vertical-align: middle;
    text-align: center;
    border-bottom: 1px solid #f1f5f9;
}

/* عناصر الجدول */
.comment-id {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin: 0 auto;
    font-size: 0.8rem;
}

.comment-content {
    text-align: right;
    max-width: 250px;
}

.comment-text {
    font-weight: 500;
    color: var(--text-dark);
    line-height: 1.4;
    margin-bottom: 0.25rem;
    font-size: 0.9rem;
}

.author-info {
    text-align: right;
}

.author-name {
    display: block;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.25rem;
    font-size: 0.9rem;
}

.author-email {
    color: var(--text-light);
    font-size: 0.8rem;
}

.article-info {
    text-align: right;
}

.article-link {
    color: var(--text-dark);
    text-decoration: none;
    transition: var(--transition);
    font-weight: 500;
    font-size: 0.9rem;
}

.article-link:hover {
    color: var(--primary-color);
}

.status-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

.status-badge.approved {
    background: linear-gradient(45deg, #48bb78, #38a169);
    color: white;
}

.status-badge.pending {
    background: linear-gradient(45deg, #ed8936, #dd6b20);
    color: white;
}

.date-info {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.85rem;
    color: var(--text-light);
}

/* أزرار الإجراءات */
.action-buttons {
    display: flex;
    gap: 0.3rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-action {
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    color: white;
    font-size: 0.8rem;
}

.btn-view {
    background: linear-gradient(45deg, #4299e1, #3182ce);
}

.btn-approve {
    background: linear-gradient(45deg, #48bb78, #38a169);
}

.btn-disapprove {
    background: linear-gradient(45deg, #ed8936, #dd6b20);
}

.btn-delete {
    background: linear-gradient(45deg, #f56565, #e53e3e);
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* الترقيم */
.pagination-container {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 15px;
    padding: 1.5rem;
    border: 1px solid rgba(0,0,0,0.05);
    margin-top: 1.5rem;
}

.pagination-info {
    font-weight: 600;
    color: var(--text-dark);
    font-size: 0.9rem;
}

.pagination-links .pagination {
    margin: 0;
    gap: 0.3rem;
}

.page-link {
    border: none;
    border-radius: 10px !important;
    padding: 0.6rem 1rem;
    color: var(--text-dark);
    font-weight: 600;
    transition: var(--transition);
    background: white;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    font-size: 0.9rem;
}

.page-link:hover {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
}

/* حالة فارغة */
.empty-state {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 20px;
    margin: 2rem 0;
    padding: 3rem 2rem;
}

/* checkboxes */
.form-check-input {
    width: 1.1em;
    height: 1.1em;
    margin-top: 0.15em;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.form-check-label {
    cursor: pointer;
    font-size: 0.9rem;
}

.comment-checkbox {
    width: 1.1em;
    height: 1.1em;
    cursor: pointer;
}

/* التكيف مع الشاشات الصغيرة */
@media (max-width: 768px) {
    .admin-card-header {
        padding: 1rem 1.25rem;
    }
    
    .admin-card-header .card-title {
        font-size: 1.25rem;
    }
    
    .search-filter-card {
        padding: 1.25rem;
    }
    
    .bulk-actions-header {
        padding: 1rem 1.25rem;
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .bulk-actions-body {
        padding: 1.25rem;
    }
    
    .admin-table {
        font-size: 0.85rem;
    }
    
    .admin-table-header {
        display: none;
    }
    
    .admin-table-row {
        display: block;
        margin-bottom: 1rem;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        padding: 1rem;
        border: 1px solid #e2e8f0;
    }
    
    .admin-table-row td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f1f5f9;
        text-align: right;
    }
    
    .admin-table-row td::before {
        content: attr(data-label);
        font-weight: 700;
        color: var(--primary-color);
        font-size: 0.85rem;
        flex: 0 0 120px;
    }
    
    .admin-table-row td:first-child {
        justify-content: center;
        border-bottom: none;
        padding-bottom: 0;
    }
    
    .admin-table-row td:last-child {
        border-bottom: none;
        padding-top: 1rem;
        justify-content: center;
    }
    
    .comment-id {
        margin: 0;
    }
    
    .action-buttons {
        justify-content: center;
        gap: 0.5rem;
    }
    
    .pagination-container {
        padding: 1.25rem;
    }
}

@media (max-width: 576px) {
    .container-fluid {
        padding: 0.75rem;
    }
    
    .admin-card {
        border-radius: 15px;
        margin-bottom: 1rem;
    }
    
    .search-filter-card .row {
        gap: 1rem;
    }
    
    .btn-search, .btn-reset {
        padding: 0.75rem;
    }
}

/* إضافة data-label للخلايا في الجدول للشاشات الصغيرة */
@media (max-width: 768px) {
    .admin-table-row td:nth-child(1)::before { content: "تحديد"; }
    .admin-table-row td:nth-child(2)::before { content: "رقم التعليق"; }
    .admin-table-row td:nth-child(3)::before { content: "المحتوى"; }
    .admin-table-row td:nth-child(4)::before { content: "المؤلف"; }
    .admin-table-row td:nth-child(5)::before { content: "المقال"; }
    .admin-table-row td:nth-child(6)::before { content: "الحالة"; }
    .admin-table-row td:nth-child(7)::before { content: "التاريخ"; }
    .admin-table-row td:nth-child(8)::before { content: "الإجراءات"; }
}
</style>
@endpush


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // إضافة data-label للخلايا للشاشات الصغيرة
    if (window.innerWidth <= 768) {
        const headers = document.querySelectorAll('.admin-table-header th');
        const rows = document.querySelectorAll('.admin-table-row');
        
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            cells.forEach((cell, index) => {
                if (headers[index]) {
                    cell.setAttribute('data-label', headers[index].textContent.trim());
                }
            });
        });
    }
    
    // إدارة الإجراءات الجماعية
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.comment-checkbox');
    const selectedCount = document.getElementById('selected-count');
    const bulkActionBtn = document.getElementById('bulk-action-btn');
    const bulkActionSelect = document.getElementById('bulk-action-select');

    // ✅ تأكد من وجود العناصر قبل استخدامها
    if (selectAll && checkboxes.length > 0 && selectedCount && bulkActionBtn && bulkActionSelect) {
        
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
            bulkActionBtn.disabled = selected === 0 || !bulkActionSelect.value;
            
            // تحديث select all
            selectAll.checked = selected > 0 && selected === checkboxes.length;
            selectAll.indeterminate = selected > 0 && selected < checkboxes.length;
        }

        // تحديث العداد عند تغيير أي checkbox
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });

        // تحديث حالة الزر عند تغيير ال select
        bulkActionSelect.addEventListener('change', updateSelectedCount);

        // التأكيد على الإجراءات الجماعية
        document.getElementById('bulk-action-form').addEventListener('submit', function(e) {
            const selected = document.querySelectorAll('.comment-checkbox:checked').length;
            const action = bulkActionSelect.value;
            
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
            } else {
                // إظهار حالة تحميل
                bulkActionBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>جاري المعالجة...';
                bulkActionBtn.disabled = true;
            }
        });

        // التهيئة الأولية
        updateSelectedCount();
    }
});
</script>
@endpush
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // إضافة data-label للخلايا للشاشات الصغيرة
    if (window.innerWidth <= 768) {
        const headers = document.querySelectorAll('.admin-table-header th');
        const rows = document.querySelectorAll('.admin-table-row');
        
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            cells.forEach((cell, index) => {
                if (headers[index]) {
                    cell.setAttribute('data-label', headers[index].textContent.trim());
                }
            });
        });
    }
    
    // إدارة الإجراءات الجماعية
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.comment-checkbox');
    const selectedCount = document.getElementById('selected-count');
    const bulkActionBtn = document.getElementById('bulk-action-btn');
    const bulkActionSelect = document.getElementById('bulk-action-select');

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
        bulkActionBtn.disabled = selected === 0 || !bulkActionSelect.value;
        
        // تحديث select all
        selectAll.checked = selected > 0 && selected === checkboxes.length;
        selectAll.indeterminate = selected > 0 && selected < checkboxes.length;
    }

    // تحديث العداد عند تغيير أي checkbox
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });

    // تحديث حالة الزر عند تغيير ال select
    bulkActionSelect.addEventListener('change', updateSelectedCount);

    // التأكيد على الإجراءات الجماعية
    document.getElementById('bulk-action-form').addEventListener('submit', function(e) {
        const selected = document.querySelectorAll('.comment-checkbox:checked').length;
        const action = bulkActionSelect.value;
        
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
@endpush