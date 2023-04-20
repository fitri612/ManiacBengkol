<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'slug',
        'image',
        'author',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikeBy(User $user)
    {
        if($this->likes->where('user_id', $user->id)){
            return $this->likes->where('user_id', $user->id)->count() > 0;
        }else{
            return false;
        }
    }
}
