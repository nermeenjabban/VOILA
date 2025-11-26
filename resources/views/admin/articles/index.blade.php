@extends('admin.layouts.app')

@section('title', 'إدارة المقالات')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card admin-card">
                <div class="card-header admin-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-newspaper me-2 text-primary"></i>
                            إدارة المقالات
                        </h3>
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-add">
                            <i class="fas fa-plus me-2"></i> إضافة مقال جديد
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- شريط البحث والتصفية -->
                    <div class="search-filter-card mb-4">
                        <form action="{{ route('admin.articles.index') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">بحث في المقالات</label>
                                        <input type="text" name="search" class="form-control search-input" 
                                               placeholder="اكتب كلمة للبحث..." value="{{ request('search') }}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">التصنيف</label>
                                        <select name="category_id" class="form-control select-input">
                                            <option value="">جميع التصنيفات</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-label">الحالة</label>
                                        <select name="status" class="form-control select-input">
                                            <option value="">جميع الحالات</option>
                                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>منشور</option>
                                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>مسودة</option>
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
                                            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary btn-reset">
                                                <i class="fas fa-redo me-2"></i>إعادة تعيين
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- جدول المقالات -->
                    <div class="table-responsive">
                        <table class="table table-hover admin-table">
                            <thead class="admin-table-header">
                                <tr>
                                    <th width="60">#</th>
                                    <th>العنوان</th>
                                    <th width="120">التصنيف</th>
                                    <th width="120">المؤلف</th>
                                    <th width="100">الحالة</th>
                                    <th width="120">تاريخ النشر</th>
                                    <th width="200">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($articles as $article)
                                <tr class="admin-table-row">
                                    <td>
                                        <span class="article-id">{{ $article->id }}</span>
                                    </td>
                                    <td>
                                        <div class="article-title">
                                            <strong>{{ Str::limit($article->title, 50) }}</strong>
                                            @if($article->comments_enabled)
                                                <small class="text-success ms-2">
                                                    <i class="fas fa-comment"></i>
                                                </small>
                                            @endif
                                        </div>
                                        <!-- <small class="text-muted">
                                            {{ Str::limit(strip_tags($article->content), 70) }}
                                        </small> -->
                                    </td>
                                    <td>
                                        <span class="category-badge">{{ $article->category->name }}</span>
                                    </td>
                                    <td>
                                        <div class="author-info">
                                            <i class="fas fa-user me-1 text-muted"></i>
                                            <span>{{ $article->author->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($article->is_published)
                                            <span class="status-badge published">
                                                <i class="fas fa-check-circle me-1"></i>منشور
                                            </span>
                                        @else
                                            <span class="status-badge draft">
                                                <i class="fas fa-pencil-alt me-1"></i>مسودة
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="date-info">
                                            @if($article->published_at)
                                                <i class="fas fa-calendar me-1 text-muted"></i>
                                                {{ $article->published_at->format('Y-m-d') }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.articles.edit', $article) }}" 
                                               class="btn btn-action btn-edit" 
                                               title="تعديل المقال">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            <form action="{{ route('admin.articles.toggle-publish', $article) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="btn btn-action {{ $article->is_published ? 'btn-unpublish' : 'btn-publish' }}"
                                                        title="{{ $article->is_published ? 'إخفاء المقال' : 'نشر المقال' }}">
                                                    <i class="fas {{ $article->is_published ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.articles.toggle-comments', $article) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="btn btn-action {{ $article->comments_enabled ? 'btn-comments-off' : 'btn-comments-on' }}"
                                                        title="{{ $article->comments_enabled ? 'تعطيل التعليقات' : 'تفعيل التعليقات' }}">
                                                    <i class="fas {{ $article->comments_enabled ? 'fa-comment-slash' : 'fa-comment' }}"></i>
                                                </button>
                                            </form>
                                            
                                            @if($article->is_published)
    <a href="{{ route('articles.show', $article) }}" 
       target="_blank" 
       class="btn btn-action btn-preview"
       title="معاينة المقال">
        <i class="fas fa-external-link-alt"></i>
    </a>
@else
    <button type="button" 
            class="btn btn-action btn-preview"
            title="المقال غير منشور - لا يمكن معاينته"
            onclick="alert('لا يمكن معاينة المقال لأنه غير منشور بعد')">
        <i class="fas fa-external-link-alt"></i>
    </button>
@endif
                                            
                                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-action btn-delete"
                                                        onclick="return confirm('هل أنت متأكد من حذف هذا المقال؟')"
                                                        title="حذف المقال">
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
                    @if($articles->hasPages())
                    <div class="pagination-container mt-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="pagination-info">
                                <p class="text-muted mb-0">
                                    عرض {{ $articles->firstItem() }} إلى {{ $articles->lastItem() }} من أصل {{ $articles->total() }} مقال
                                </p>
                            </div>
                            <div class="pagination-links">
                                {{ $articles->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($articles->count() == 0)
                    <div class="empty-state text-center py-5">
                        <i class="fas fa-newspaper fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">لا توجد مقالات</h4>
                        <p class="text-muted mb-4">لم يتم إضافة أي مقالات بعد.</p>
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>إضافة أول مقال
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

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
}

.admin-card-header {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-bottom: 1px solid rgba(0,0,0,0.05);
    padding: 1.5rem 1.5rem 0.5rem;
    border-radius: 20px 20px 0 0 !important;
}

.admin-card-header .card-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
}

.btn-add {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
    border-radius: 15px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: var(--transition);
}

.btn-add:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

/* شريط البحث */
.search-filter-card {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 15px;
    padding: 1.5rem;
    border: 1px solid rgba(0,0,0,0.05);
}

.form-label {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.search-input, .select-input {
    border: none;
    border-radius: 12px;
    padding: 0.75rem 1rem;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    transition: var(--transition);
}

.search-input:focus, .select-input:focus {
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    border: 1px solid var(--primary-color);
}

.btn-search, .btn-reset {
    border-radius: 12px;
    padding: 0.75rem;
    font-weight: 600;
    transition: var(--transition);
}

.btn-search {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    border: none;
}

.btn-search:hover {
    transform: translateY(-2px);
}

/* الجدول */
.admin-table {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0,0,0,0.05);
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
}

.admin-table-row {
    transition: var(--transition);
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.admin-table-row:hover {
    background: rgba(102, 126, 234, 0.03);
    transform: translateY(-1px);
}

.admin-table-row td {
    padding: 1rem;
    vertical-align: middle;
    text-align: center;
}

/* عناصر الجدول */
.article-id {
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
}

.article-title {
    text-align: right;
}

.category-badge {
    background: linear-gradient(45deg, #48bb78, #38a169);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

.status-badge.published {
    background: linear-gradient(45deg, #48bb78, #38a169);
    color: white;
}

.status-badge.draft {
    background: linear-gradient(45deg, #ed8936, #dd6b20);
    color: white;
}

.author-info, .date-info {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

/* أزرار الإجراءات */
.action-buttons {
    display: flex;
    gap: 0.3rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-action {
    width: 35px;
    height: 35px;
    border: none;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    color: white;
}

.btn-edit {
    background: linear-gradient(45deg, #ed8936, #dd6b20);
}

.btn-publish {
    background: linear-gradient(45deg, #48bb78, #38a169);
}

.btn-unpublish {
    background: linear-gradient(45deg, #a0aec0, #718096);
}

.btn-comments-on {
    background: linear-gradient(45deg, #4299e1, #3182ce);
}

.btn-comments-off {
    background: linear-gradient(45deg, #a0aec0, #718096);
}

.btn-preview {
    background: linear-gradient(45deg, #9f7aea, #805ad5);
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
}

.pagination-info {
    font-weight: 600;
    color: var(--text-dark);
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
}

@media (max-width: 768px) {
    .action-buttons {
        gap: 0.2rem;
    }
    
    .btn-action {
        width: 30px;
        height: 30px;
        font-size: 0.8rem;
    }
    
    .admin-table-header th,
    .admin-table-row td {
        padding: 0.5rem;
        font-size: 0.9rem;
    }
    
    .search-filter-card .row {
        gap: 1rem;
    }
}
</style>
@endsection