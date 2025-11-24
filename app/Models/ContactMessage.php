<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'reviewed'
    ];

    protected $casts = [
        'reviewed' => 'boolean'
    ];

    /**
     * نطاق للرسائل غير المقروءة
     */
    public function scopeUnread($query)
    {
        return $query->where('reviewed', false);
    }

    /**
     * نطاق للرسائل المقروءة
     */
    public function scopeRead($query)
    {
        return $query->where('reviewed', true);
    }

    /**
     * الحصول على محتوى مختصر للرسالة
     */
    public function getExcerptAttribute()
    {
        return Str::limit($this->message, 100);
    }

    /**
     * الحصول على اسم المرسل مع إخفاء جزء من البريد الإلكتروني
     */
    public function getSenderDisplayAttribute()
    {
        return $this->name . ' (' . Str::mask($this->email, '*', 3) . ')';
    }

    /**
     * الحصول على حالة الرسالة
     */
    public function getStatusAttribute()
    {
        return $this->reviewed ? 'مقروءة' : 'جديدة';
    }

    /**
     * الحصول على لون الحالة
     */
    public function getStatusColorAttribute()
    {
        return $this->reviewed ? 'success' : 'warning';
    }
}