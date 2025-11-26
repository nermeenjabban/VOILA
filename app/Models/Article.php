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
        'published_at',
        'comments_enabled'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'comments_enabled' => 'boolean',
    ];
    
    // العلاقة مع التعليقات
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('approved', true);
    }
    
    // نطاق للمقالات التي يمكن التعليق عليها
    public function scopeCommentsEnabled($query)
    {
        return $query->where('comments_enabled', true);
    }

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

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // غير المسار إلى public/articles/
            return asset('articles/' . $this->image);
        }
        
        return asset('images/default-article.jpg');
    }
    public function scopeForEditor($query)
    {
        if (auth()->user()->role === 'editor') {
            return $query->where('author_id', auth()->id());
        }
        return $query;
    }
   
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