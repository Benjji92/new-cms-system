<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use File;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function show(User $user){

        return view('admin.users.profile', ['user'=>$user]);

    }

    public function update(User $user, Request $request){

        $inputs = $request->validate([
            'username'=>['required','string','max:255','alpha_dash'],
            'name'=>['required','string','max:255'],
            'email'=>['required','email','max:255'],
            'avatar'=>['file'],      //'mimes:jpeg,png'
            //'password'=>['min:6','max:255','confirmed'],
           ]);

        //    $inputs = $request->validate([
        //     'username'=>'required|string|max:255|alpha_dash',
        //     'name'=>'required|string|max:255',
        //     'email'=>'required|email|max:255',
        //     'avatar'=>'file'      //'mimes:jpeg,png'
        //     //'password'=>['min:6','max:255','confirmed'],
        //    ]);

           

           

        // if (request('avatar')) {
        //     $inputs['avatar'] = request('avatar')->store('images');
        // }

        if($request->hasFile('avatar')){
            $fileName = time().$request->file('avatar')->getClientOriginalName();
        $path = $request->file('avatar')->storeAs('images', $fileName, 'public');
        $user["avatar"] = '/storage/'.$path;
        $user->update();
        } else {
            $user->update($inputs);
        }

        return back();

    }
}
