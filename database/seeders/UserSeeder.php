<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // التحقق من وجود المستخدمين أولاً لتجنب التكرار
        $admin = User::where('email', 'admin@voila.digital')->first();
        $editor = User::where('email', 'editor@voila.digital')->first();

        if (!$admin) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@voila.digital',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true
            ]);
            $this->command->info('تم إنشاء المستخدم المدير.');
        } else {
            $this->command->info('المستخدم المدير موجود مسبقاً.');
        }

        if (!$editor) {
            User::create([
                'name' => 'Editor User',
                'email' => 'editor@voila.digital',
                'password' => Hash::make('password'),
                'role' => 'editor',
                'is_active' => true
            ]);
            $this->command->info('تم إنشاء المستخدم المحرر.');
        } else {
            $this->command->info('المستخدم المحرر موجود مسبقاً.');
        }

        // تحديث المستخدمين الموجودين لإضافة الحقل الجديد is_active
        User::whereNull('is_active')->update(['is_active' => true]);
        $this->command->info('تم تحديث المستخدمين الموجودين.');
    }
}