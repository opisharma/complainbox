<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Category;
use App\SubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserControllerTwo extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->select('id','role_id','avatar','name','email')->get();
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('categories')->select('id','category_name')->get();
        return view('admin.users.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'role_id'   =>  'required',
            'name'     => 'required|string',
            'email'     => 'required|email|unique:users',
            'password'  =>  'required|min:6'
        
        ]);
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        if ($request->role_id === '3') {
            $user->student_id = $request->student_id;
            $user->department = $request->department;
            $user->shift = $request->shift;
        }
        if ($request->role_id === '2') {
            $subCategory = new SubCategory();
            $subCategory->category_id = $request->category_id;
            $subCategory->sub_category_name = $request->name;
            $subCategory->sub_category_designation = $request->sub_category_designation;
            $sub_category_slug = $request->name;
            $subCategory->sub_category_slug = Str::slug($sub_category_slug,'-');
            $subCategory->sub_category_email = $request->email;
            $subCategory->password = bcrypt($request->password);
            $subCategory->save();
            $user->subcategory_id = $subCategory->id;
        }
        
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('admin.u.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
