<?php

namespace App\Http\Controllers\Student;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrfail($id);
        return view('student.profile.edit',compact('user'));
    }

    public function show($id)
    {
        $user = User::findOrfail($id);
        return view('student.profile.show',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);
        if (isset($request->name) || isset($request->email) || isset($request->student_id) || isset($request->department) || isset($request->shift) || isset($request->avatar) ){
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
            if ( isset($request->old_password) && !Hash::check($request->old_password, $subCategory->password) ){
                return redirect()->back()->withErrors(['The old password does not match our records.']);
            } else if(isset($request->old_password)){
                $user->password = bcrypt($request->password);
            }
            if (isset($avatarname)) {
                $user->avatar = $avatarname;
            }
            $user->update();
        }
        return redirect()->route('user.show',$user->id);
    }
}
