<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::latest()->get();
        $users = DB::table('users')
                     ->select('id','role_id','avatar','name','email as student_email','student_id','department','shift')
                     ->where('role_id', '=', 3)
                     ->get();
        return view('admin.student.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string',
            'email'     => 'required|email|unique:users',
            'student_id'     => 'required|unique:users',
            'department'     => 'string',
            'shift'          => 'string',
            'password'  =>  'required|min:6',
            'avatar'    =>  'mimes:jpeg,bmp,png,jpg'
        
        ]);

        $avatar = $request->file('avatar');
        $slug = Str::slug($request->name,'-');
        if (isset($avatar)) {
            $currentDate = Carbon::now()->toDateString();
            $avatarname = $slug.'-'.$currentDate.uniqid().'.'.$avatar->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('users')) {
                Storage::disk('public')->makeDirectory('users');
            }
            $image = Image::make($avatar)->resize(450, 500)->save($avatarname,80);
            Storage::disk('public')->put('users/'.$avatarname,$image);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->student_id = $request->student_id;
        $user->department = $request->department;
        $user->shift = $request->shift;
        $user->password = bcrypt($request->password);
        if (isset($avatarname)) {
            $user->avatar = $avatarname;
        }
        $user->save();
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.student.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.student.edit',compact('user'));
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
        if (isset($request->name) || isset($request->email) || isset($request->student_id) || isset($request->department) || isset($request->shift) ){
            $avatar = $request->file('avatar');
            $slug = Str::slug($request->name,'-');
            $oldImage = $user->avatar;
            if (isset($avatar)) {
                $currentDate = Carbon::now()->toDateString();
                $avatarname = $slug.'-'.$currentDate.uniqid().'.'.$avatar->getClientOriginalExtension();

                if (!Storage::disk('public')->exists('users')) {
                    Storage::disk('public')->makeDirectory('users');
                }
                if (Storage::disk('public')->exists('users/'.$oldImage)) {
                    Storage::disk('public')->delete('users/'.$oldImage);
                }
                $image = Image::make($avatar)->resize(450, 500)->save($avatarname,80);
                Storage::disk('public')->put('users/'.$avatarname,$image);
                
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->student_id = $request->student_id;
            $user->department = $request->department;
            $user->shift = $request->shift;
            if ( isset($request->old_password) && !Hash::check($request->old_password, $user->password) ){
                return redirect()->back()->withErrors(['The old password does not match our records.']);
            } else if(isset($request->old_password)){
                $user->password = bcrypt($request->password);
            }
            if (isset($avatarname)) {
                $user->avatar = $avatarname;
            }
            $user->update();
        }
        return redirect()->route('admin.users.index');
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
