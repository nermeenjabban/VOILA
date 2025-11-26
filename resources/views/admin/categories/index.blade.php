@extends('admin.layouts.app')

@section('title', 'إدارة التصنيفات')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card admin-card">
                <div class="card-header admin-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-folder me-2 text-primary"></i>
                            إدارة التصنيفات
                        </h3>
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-add">
                            <i class="fas fa-plus me-2"></i> إضافة تصنيف جديد
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    
                   

                    <!-- جدول التصنيفات -->
                    @if($categories->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover admin-table">
                                <thead class="admin-table-header">
                                    <tr>
                                        <th width="80">#</th>
                                        <th>اسم التصنيف</th>
                                       
                                        <th width="120">عدد المقالات</th>
                                        <th>الوصف</th>
                                        <th width="130">تاريخ الإنشاء</th>
                                        <th width="180">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr class="admin-table-row">
                                        <td>
                                            <span class="category-id">{{ $category->id }}</span>
                                        </td>
                                        <td>
                                            <div class="category-title">
                                                <strong>{{ $category->name }}</strong>
                                            </div>
                                        </td>
                                       
                                        <td>
                                            <span class="articles-count-badge">{{ $category->articles_count }}</span>
                                        </td>
                                        <td>
                                            <div class="category-description">
                                                @if($category->description)
                                                    {{ Str::limit($category->description, 60) }}
                                                @else
                                                    <span class="text-muted">لا يوجد وصف</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="date-info">
                                                <i class="fas fa-calendar me-1 text-muted"></i>
                                                {{ $category->created_at->format('Y-m-d') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('admin.categories.show', $category) }}" 
                                                   class="btn btn-action btn-view"
                                                   title="عرض التصنيف">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                <a href="{{ route('admin.categories.edit', $category) }}" 
                                                   class="btn btn-action btn-edit" 
                                                   title="تعديل التصنيف">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a href="{{ route('admin.articles.index', ['category_id' => $category->id]) }}" 
                                                   class="btn btn-action btn-articles"
                                                   title="عرض مقالات التصنيف">
                                                    <i class="fas fa-newspaper"></i>
                                                </a>
                                                
                                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-action btn-delete"
                                                            onclick="return confirm('هل أنت متأكد من حذف هذا التصنيف؟')"
                                                            title="حذف التصنيف">
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
                        @if($categories->hasPages())
                        <div class="pagination-container mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="pagination-info">
                                    <p class="text-muted mb-0">
                                        عرض {{ $categories->firstItem() }} إلى {{ $categories->lastItem() }} من أصل {{ $categories->total() }} تصنيف
                                    </p>
                                </div>
                                <div class="pagination-links">
                                    {{ $categories->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                        @endif
                    @else
                        <div class="empty-state text-center py-5">
                            <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">لا توجد تصنيفات</h4>
                            <p class="text-muted mb-4">لم يتم إضافة أي تصنيفات بعد.</p>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>إضافة أول تصنيف
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
.category-id {
    background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin: 0 auto;
}

.category-title {
    text-align: right;
}

.slug-badge {
    background: linear-gradient(45deg, #a0aec0, #718096);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    direction: ltr;
    display: inline-block;
}

.articles-count-badge {
    background: linear-gradient(45deg, #48bb78, #38a169);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin: 0 auto;
}

.category-description {
    text-align: right;
    font-size: 0.9rem;
    line-height: 1.5;
}

.date-info {
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

.btn-view {
    background: linear-gradient(45deg, #4299e1, #3182ce);
}

.btn-edit {
    background: linear-gradient(45deg, #ed8936, #dd6b20);
}

.btn-articles {
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
    
    .category-description {
        font-size: 0.8rem;
    }
}
</style>
@endsection