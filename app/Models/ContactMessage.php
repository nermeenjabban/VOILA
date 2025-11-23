<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}