<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'title', 'type', 'genre', 'rating', 
        'body', 'consumed_at', 'is_public', 'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function wasEdited()
    {
        return $this->updated_at->gt($this->created_at);
    }
}
