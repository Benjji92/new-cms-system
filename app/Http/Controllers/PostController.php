<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function show(Post $post){

        return view('blog-post', ['post'=>$post]);

    }

    public function create(){

        return view('admin.posts.create');

    }

    public function store(){

        
       $inputs = request()->validate([
        'title'=>'required|min:8|max:255',
        'post_image'=>'file',      //'mimes:jpeg,png'
        'body'=>'required'
       ]);

       if (request('post-image')) {
        $inputs['post-image'] = request('post-image')->store('images');
       }

       auth()->user()->posts()->create($inputs);

       return back();

      // dd($request->post_image);

    }

}

