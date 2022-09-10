<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['role:Admin', 'auth'])->group(function () {
    
   Route::resource('admin/comments', PostCommentsController::class);
   Route::resource('admin/comment/replies', CommentRepliesController::class);


});