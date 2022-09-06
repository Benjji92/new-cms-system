<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;

class UserController extends Controller
{
    public function show(User $user){

        return view('admin.users.profile', ['user'=>$user]);

    }
}
