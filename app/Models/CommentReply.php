<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;

class CommentReply extends Model
{
    use HasFactory;

    protected $fillable = [

        'comment_id',
        'email',
        'author',
        'body',
        'is_acitve'


    ];



  
  public function comment()
  {
      return $this->belongsTo(Comment::class);
  }

}
