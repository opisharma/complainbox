<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
        return view( 'admin.welcome' );
    }

    public function edit($id)
    {
        $user = User::findOrfail($id);
        return view('admin.profile.edit',compact('user'));
    }

    public function show($id)
    {
        $user = User::where('role_id',1)->findOrfail($id);
        return view('admin.profile.show',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);
        
        if (isset($request->name) || isset($request->email) || isset($request->avatar) ){
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
                $user->avatar = $avatarname;
            }
        
            $user->name = $request->name;
            $user->email = $request->email;
            if ( isset($request->old_password) && !Hash::check($request->old_password, $user->password) ){
                return redirect()->back()->withErrors(['The old password does not match our records.']);
            } else if(isset($request->old_password)){
                $user->password = bcrypt($request->password);
            }
            
            
            $user->update();
        }
        return redirect()->route('admin.show',$user->id);
    }

}
