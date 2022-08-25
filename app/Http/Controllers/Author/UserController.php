<?php

namespace App\Http\Controllers\Author;

use App\User;
use Carbon\Carbon;
use App\Category;
use App\SubCategory;
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
        $categories = Category::all();
        $employee = SubCategory::findOrfail($user->subcategory_id);
        return view('author.profile.edit',compact('categories','user','employee'));
    }

    public function show($id)
    {
        $user = User::findOrfail($id);
        $employee = SubCategory::findOrfail($user->subcategory_id);
        return view('author.profile.show',compact('user','employee'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $employee = SubCategory::findOrfail($user->subcategory_id);
        
        if (isset($request->sub_category_name) || isset($request->sub_category_email) || isset($request->sub_category_designation) || isset($request->avatar) ){
            $avatar = $request->file('employee_avatar');
            $slug = Str::slug($request->sub_category_name,'-');
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
                $employee->avatar = $avatarname;
                $user->avatar = $avatarname;
            }
            $employee->category_id = $request->category_id;
            $employee->sub_category_name = $request->sub_category_name;
            $employee->sub_category_designation = $request->sub_category_designation;
            $employee->sub_category_email = $request->sub_category_email;
            $employee->update();
            
            $user->name = $request->sub_category_name;
            $user->email = $request->sub_category_email;
            if ( isset($request->old_password) && !Hash::check($request->old_password, $employee->password) ){
                return redirect()->back()->withErrors(['The old password does not match our records.']);
            } else if(isset($request->old_password)){
                $user->password = bcrypt($request->password);
                $employee->password = bcrypt($request->password);
            }
            
            
            $user->update();
        }
        return redirect()->route('author.show',$user->id);
    }
}
