<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index(){

        return view('admin.permissions.index', [
            'permissions'=>Permission::all()
        ]);

    }

    public function store(){

        request()->validate([
            'name'=>['required']
        ]);

        Permission::create([
            'name'=> Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-') 
        ]);

        return back();

    }

    public function edit(Permission $permission){

        return view('admin.permissions.edit', [
            'permission'=>$permission
        ]);

    }

    public function update(Permission $permission){

        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(request('name'))->slug('-');
 
         if ($permission->isDirty('name')) {
             session()->flash('permission-updated', 'Permission '.$permission->name.' was updated');
             $permission->save();
         } else {
             session()->flash('permission-updated', 'Nothing to update here');
             
         }
 
        return back();
 
     }

    public function destroy(Permission $permission, Request $request){

        //$this->authorize('delete', $permission);

        $permission->delete();

        $request->session()->flash('permission-deleted','Permission: '. $permission->name .' was deleted');

        return back();

    }
}
