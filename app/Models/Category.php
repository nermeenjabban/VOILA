<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    /**
     * العلاقة مع المقالات
     */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function articlesCount()
{
    return $this->articles()->count();
}

    /**
     * الحصول على المقالات المنشورة فقط
     */
    public function publishedArticles()
    {
        return $this->hasMany(Article::class)->where('is_published', true);
    }

    /**
     * إنشاء slug تلقائياً عند حفظ التصنيف
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = \Illuminate\Support\Str::slug($category->name);
            }
        });
    }
    

    
}