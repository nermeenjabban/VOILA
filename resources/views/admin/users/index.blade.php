@extends('admin.layouts.app')

@section('title', 'إدارة المستخدمين')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card admin-card">
                <div class="card-header admin-card-header">
                    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3 gap-md-0">
                        <h3 class="card-title mb-0 text-center text-md-start">
                            <i class="fas fa-users me-2 text-primary"></i>
                            إدارة المستخدمين
                        </h3>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-add w-100 w-md-auto">
                            <i class="fas fa-plus me-2"></i> إضافة مستخدم جديد
                        </a>
                    </div>
                </div>
                <div class="card-body">
                   

                    <!-- جدول المستخدمين -->
                    @if($users->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover admin-table">
                                <thead class="admin-table-header">
                                    <tr>
                                        <th width="70">#</th>
                                        <th width="80">الصورة</th>
                                        <th>الاسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th width="120">الدور</th>
                                        <th width="100">الحالة</th>
                                        <th width="100">المقالات</th>
                                        <th width="130">تاريخ التسجيل</th>
                                        <th width="200">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr class="admin-table-row">
                                        <td>
                                            <span class="user-id">{{ $user->id }}</span>
                                        </td>
                                        <td>
                                            <div class="user-avatar">
                                                @if($user->avatar)
                                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="avatar-img">
                                                @else
                                                    <div class="avatar-placeholder">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="user-info">
                                                <strong class="user-name">{{ $user->name }}</strong>
                                                @if(auth()->id() === $user->id)
                                                    <span class="badge-you">أنت</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="user-email">{{ $user->email }}</span>
                                        </td>
                                        <td>
                                            @if($user->role === 'admin')
                                                <span class="role-badge admin">مدير</span>
                                            @else
                                                <span class="role-badge editor">محرر</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->is_active)
                                                <span class="status-badge active">
                                                    <i class="fas fa-check-circle me-1"></i>نشط
                                                </span>
                                            @else
                                                <span class="status-badge inactive">
                                                    <i class="fas fa-times-circle me-1"></i>معطل
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="articles-count-badge">{{ $user->articles_count ?? 0 }}</span>
                                        </td>
                                        <td>
                                            <div class="date-info">
                                                <i class="fas fa-calendar me-1 text-muted"></i>
                                                {{ $user->created_at->format('Y-m-d') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('admin.users.show', $user) }}" 
                                                   class="btn btn-action btn-view"
                                                   title="عرض المستخدم">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                <a href="{{ route('admin.users.edit', $user) }}" 
                                                   class="btn btn-action btn-edit" 
                                                   title="تعديل المستخدم">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                @if(auth()->id() !== $user->id)
                                                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" 
                                                                class="btn btn-action {{ $user->is_active ? 'btn-deactivate' : 'btn-activate' }}"
                                                                title="{{ $user->is_active ? 'تعطيل المستخدم' : 'تفعيل المستخدم' }}">
                                                            <i class="fas {{ $user->is_active ? 'fa-user-slash' : 'fa-user-check' }}"></i>
                                                        </button>
                                                    </form>
                                                    
                                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-action btn-delete"
                                                                onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')"
                                                                title="حذف المستخدم">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="current-user-badge">أنت</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- الترقيم -->
                        @if($users->hasPages())
                        <div class="pagination-container mt-4">
                            <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3 gap-md-0">
                                <div class="pagination-info">
                                    <p class="text-muted mb-0">
                                        عرض {{ $users->firstItem() }} إلى {{ $users->lastItem() }} من أصل {{ $users->total() }} مستخدم
                                    </p>
                                </div>
                                <div class="pagination-links">
                                    {{ $users->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                        @endif
                    @else
                        <div class="empty-state text-center py-5">
                            <i class="fas fa-users fa-4x text-muted mb-3"></i>
                            <h4 class="text-muted">لا يوجد مستخدمين</h4>
                            <p class="text-muted mb-4">لم يتم إضافة أي مستخدمين بعد.</p>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>إضافة أول مستخدم
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
    padding: 1.5rem 1.5rem;
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
.user-id {
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

.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin: 0 auto;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-color);
    font-size: 1.2rem;
}

.user-info {
    text-align: right;
}

.user-name {
    display: block;
    margin-bottom: 0.25rem;
}

.badge-you {
    background: linear-gradient(45deg, #48bb78, #38a169);
    color: white;
    padding: 0.2rem 0.6rem;
    border-radius: 12px;
    font-size: 0.7rem;
    font-weight: 600;
}

.user-email {
    direction: ltr;
    text-align: left;
    font-size: 0.9rem;
}

.role-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-block;
}

.role-badge.admin {
    background: linear-gradient(45deg, #ed8936, #dd6b20);
    color: white;
}

.role-badge.editor {
    background: linear-gradient(45deg, #4299e1, #3182ce);
    color: white;
}

.status-badge {
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
}

.status-badge.active {
    background: linear-gradient(45deg, #48bb78, #38a169);
    color: white;
}

.status-badge.inactive {
    background: linear-gradient(45deg, #f56565, #e53e3e);
    color: white;
}

.articles-count-badge {
    background: linear-gradient(45deg, #9f7aea, #805ad5);
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

.date-info {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.9rem;
}

.current-user-badge {
    background: linear-gradient(45deg, #a0aec0, #718096);
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
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

.btn-activate {
    background: linear-gradient(45deg, #48bb78, #38a169);
}

.btn-deactivate {
    background: linear-gradient(45deg, #a0aec0, #718096);
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

/* التكيف مع الشاشات الصغيرة */
@media (max-width: 768px) {
    .admin-card-header {
        padding: 1rem;
    }
    
    .search-filter-card {
        padding: 1rem;
    }
    
    .search-filter-card .row {
        gap: 1rem;
    }
    
    .admin-table-header {
        display: none;
    }
    
    .admin-table-row {
        display: block;
        margin-bottom: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        padding: 1rem;
    }
    
    .admin-table-row td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
        text-align: right;
    }
    
    .admin-table-row td::before {
        content: attr(data-label);
        font-weight: 700;
        color: var(--primary-color);
        font-size: 0.9rem;
    }
    
    .admin-table-row td:last-child {
        border-bottom: none;
    }
    
    .user-id, .articles-count-badge {
        margin: 0;
    }
    
    .user-avatar {
        margin: 0;
    }
    
    .action-buttons {
        justify-content: flex-start;
        gap: 0.5rem;
    }
    
    .btn-action {
        width: 40px;
        height: 40px;
    }
    
    .pagination-container {
        padding: 1rem;
    }
    
    .pagination-links .pagination {
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .page-link {
        padding: 0.5rem 0.75rem;
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .container-fluid {
        padding: 0.5rem;
    }
    
    .admin-card {
        border-radius: 15px;
    }
    
    .admin-card-header .card-title {
        font-size: 1.25rem;
    }
    
    .btn-add {
        padding: 0.6rem 1rem;
        font-size: 0.9rem;
    }
    
    .user-info {
        text-align: center;
    }
    
    .role-badge, .status-badge {
        font-size: 0.75rem;
        padding: 0.3rem 0.6rem;
    }
}

@media (max-width: 400px) {
    .action-buttons {
        gap: 0.3rem;
    }
    
    .btn-action {
        width: 35px;
        height: 35px;
        font-size: 0.8rem;
    }
    
    .user-avatar {
        width: 40px;
        height: 40px;
    }
    
    .avatar-placeholder {
        font-size: 1rem;
    }
}

/* إضافة data-label للخلايا في الجدول للشاشات الصغيرة */
@media (max-width: 768px) {
    .admin-table-row td:nth-child(1)::before { content: "رقم المستخدم"; }
    .admin-table-row td:nth-child(2)::before { content: "الصورة"; }
    .admin-table-row td:nth-child(3)::before { content: "الاسم"; }
    .admin-table-row td:nth-child(4)::before { content: "البريد الإلكتروني"; }
    .admin-table-row td:nth-child(5)::before { content: "الدور"; }
    .admin-table-row td:nth-child(6)::before { content: "الحالة"; }
    .admin-table-row td:nth-child(7)::before { content: "المقالات"; }
    .admin-table-row td:nth-child(8)::before { content: "تاريخ التسجيل"; }
    .admin-table-row td:nth-child(9)::before { content: "الإجراءات"; }
}
</style>

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
    
    // تأثيرات عند التمرير على الأزرار
    if (window.matchMedia('(hover: hover)').matches) {
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    }
});
</script>
@endsection