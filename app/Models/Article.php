<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'author_id',
        'category_id',
        'is_published',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ];

    /**
     * العلاقة مع المستخدم (المؤلف)
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * العلاقة مع التصنيف
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * العلاقة مع التعليقات
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * الحصول على التعليقات المقبولة فقط
     */
    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('approved', true);
    }

    /**
     * نطاق للمقالات المنشورة فقط
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * نطاق للمقالات الحديثة
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}