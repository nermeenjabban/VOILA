<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in(['admin', 'editor'])],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'تم إنشاء المستخدم بنجاح.');
    }

    public function show(User $user)
    {
        $userArticles = $user->articles()->with('category')->latest()->paginate(5);
        return view('admin.users.show', compact('user', 'userArticles'));
    }

    public function edit(User $user)
    {
        // منع المستخدم من تعديل حسابه الخاص (لمنع التلاعب بالصلاحيات)
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'لا يمكنك تعديل حسابك الشخصي من هنا.');
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // منع المستخدم من تعديل حسابه الخاص
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'لا يمكنك تعديل حسابك الشخصي من هنا.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => ['required', Rule::in(['admin', 'editor'])],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'تم تحديث المستخدم بنجاح.');
    }

    public function destroy(User $user)
    {
        // منع المستخدم من حذف حسابه الخاص
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'لا يمكنك حذف حسابك الشخصي.');
        }

        // منع حذف المستخدم إذا كان لديه مقالات
        if ($user->articles()->count() > 0) {
            return redirect()->route('admin.users.index')
                ->with('error', 'لا يمكن حذف المستخدم لأنه لديه مقالات مرتبطة به.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'تم حذف المستخدم بنجاح.');
    }

    public function toggleStatus(User $user)
    {
        // منع المستخدم من تعطيل حسابه الخاص
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error', 'لا يمكنك تعطيل حسابك الشخصي.');
        }

        $user->update([
            'is_active' => !$user->is_active,
        ]);

        $status = $user->is_active ? 'مفعل' : 'معطل';
        return redirect()->back()->with('success', "تم $status المستخدم بنجاح.");
    }
}