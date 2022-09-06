<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use File;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{

    public function index(){

        $posts = auth()->user()->posts;   //->paginate(5);
        //$posts = Post::all();



        return view('admin.posts.index', ['posts'=>$posts]);

    }



    public function show(Post $post){

        return view('blog-post', ['post'=>$post]);

    }

    public function create(){


        $this->authorize('create', Post::class);
        return view('admin.posts.create');

    }

    public function store(Request $request){

        $this->authorize('create', Post::class);

        
        $request->validate([
            'title'=>'required|min:2|max:255',
            'post_image'=>'file',      //'mimes:jpeg,png'
            'body'=>'required'
           ]);
    
    $requestData = $request->all();

    if($request->hasFile('post_image')){
        $fileName = time().$request->file('post_image')->getClientOriginalName();
    $path = $request->file('post_image')->storeAs('images', $fileName, 'public');
    $requestData["post_image"] = '/storage/'.$path;
    }

    


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
    session()->flash('post-created-message', 'Post was created');

       return redirect()->route('post.index');

       //dd($request->post_image);

    }

    public function edit(Post $post){

        //$this->authorize('view', $post);

        // if (auth()-user()->can('view', $post)) {
        //     # code...
        // }

        return view('admin.posts.edit', ['post'=>$post]);

    }

    public function destroy(Post $post, Request $request){

        $this->authorize('delete', $post);

        $post->delete();

        $request->session()->flash('message','Post was deleted');

        return back();

    }

    public function update(Post $post, Request $request){

        $inputs = $request->validate([
            'title'=>'required|min:2|max:255',
            'post_image'=>'file',      //'mimes:jpeg,png'
            'body'=>'required'
           ]);

           
           if($request->hasFile('post_image')){
            $fileName = time().$request->file('post_image')->getClientOriginalName();
        $path = $request->file('post_image')->storeAs('images', $fileName, 'public');
        $post["post_image"] = '/storage/'.$path;
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];


        $this->authorize('update', $post);

        //auth()->user()->posts()->save($post);
        $post->update();

        session()->flash('post-updated-message', 'Post was updated');
        return redirect()->route('post.index');

    }

    

}