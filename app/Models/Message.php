<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = [
        'user_id', 'content', 'is_read'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
