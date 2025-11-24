<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'author_name',
        'author_email',
        'content',
        'approved'
    ];

    protected $casts = [
        'approved' => 'boolean'
    ];

    /**
     * العلاقة مع المقال
     */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    /**
     * نطاق للتعليقات المقبولة فقط
     */
    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    /**
     * نطاق للتعليقات المنتظرة الموافقة
     */
    public function scopePending($query)
    {
        return $query->where('approved', false);
    }

    /**
     * الحصول على محتوى مختصر
     */
    public function getExcerptAttribute()
    {
        return Str::limit($this->content, 100);
    }
}