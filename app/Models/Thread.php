<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'slug',
    ];

    public function replies()
    {
        return $this->hasMany(Reply::class)->orderBy('created_at', 'DESC');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
