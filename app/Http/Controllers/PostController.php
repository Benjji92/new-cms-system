<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use File;

class PostController extends Controller
{

    public function index(){

        $posts = Post::all();

        return view('admin.posts.index', ['posts'=>$posts]);

    }



    public function show(Post $post){

        return view('blog-post', ['post'=>$post]);

    }

    public function create(){

        return view('admin.posts.create');

    }

    public function store(Request $request){

        
        $request->validate([
            'title'=>'required|min:2|max:255',
            'post_image'=>'file',      //'mimes:jpeg,png'
            'body'=>'required'
           ]);
    
    $requestData = $request->all();
    $fileName = time().$request->file('post_image')->getClientOriginalName();
    $path = $request->file('post_image')->storeAs('images', $fileName, 'public');
    $requestData["post_image"] = '/storage/'.$path;


    /*-------------------------------------------------
    ---This code above will make sure you can use   ---
    ---local paths and http paths for your images,  ---
    ---so remember it, just in case.                ---
    --------------------------------------------------*/

    // getPostImageAttribute($value) {
    //     if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
    //         return $value;
    //     }
    //     return asset('storage/' . $value);
    //     }

    auth()->user()->posts()->create($requestData);

       return back();

       //dd($request->post_image);

    }

}