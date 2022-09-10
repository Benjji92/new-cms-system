<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CommentReply;

class Comment extends Model
{
    use HasFactory;


    public function replies()
    {
        return $this->hasMany(CommentReply::class);
    }



}
