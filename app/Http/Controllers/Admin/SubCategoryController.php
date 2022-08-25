<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Category;
use Carbon\Carbon;
use App\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subCategorys = SubCategory::get();
        return view('admin.employee.index', compact('subCategorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('admin.employee.create', compact('categories'));
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
            'sub_category_name'     => 'required|string',
            'sub_category_designation'     => 'required|string',
            'sub_category_email' => 'required|email',
            'category_id'    => 'required',
            'password'    => 'required|min:6',
            'employee_avatar'    => 'mimes:jpeg,bmp,png,jpg'
        ]);
        $avatar = $request->file('employee_avatar');
        $slug = Str::slug($request->sub_category_name,'-');
        if (isset($avatar)) {
            $currentDate = Carbon::now()->toDateString();
            $avatarname = $slug.'-'.$currentDate.uniqid().'.'.$avatar->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('users')) {
                Storage::disk('public')->makeDirectory('users');
            }
            $image = Image::make($avatar)->resize(450, 500)->save($avatarname,80);
            Storage::disk('public')->put('users/'.$avatarname,$image);
        }

        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category_id;
        $subCategory->sub_category_name = $request->sub_category_name;
        $subCategory->sub_category_designation = $request->sub_category_designation;
        $sub_category_slug = $request->sub_category_name;
        $subCategory->sub_category_slug = $slug;
        $subCategory->sub_category_email = $request->sub_category_email;
        $subCategory->password = bcrypt($request->password);
        if (isset($avatarname)) {
            $subCategory->avatar = $avatarname;
        }
        $subCategory->save();

        $user = new User();
        $user->role_id = 2;
        $user->subcategory_id = $subCategory->id;
        $user->name = $request->sub_category_name; 
        $user->email = $request->sub_category_email; 
        $user->password = bcrypt($request->password);
        if (isset($avatarname)) {
            $user->avatar = $avatarname;
        }
        $user->save();
        return redirect()->route('admin.sub_category.index'); ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        return view('admin.employee.show',compact('subCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory)
    {
        $categories = Category::get();
        return view('admin.employee.edit',compact('subCategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        if (isset($request->category_id) || isset($request->sub_category_name) || isset($request->sub_category_designation) || isset($request->sub_category_email) ){
            $avatar = $request->file('employee_avatar');
            $slug = Str::slug($request->sub_category_name,'-');
            $oldImage = $subCategory->avatar;
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
                $subCategory->avatar = $avatarname;
                DB::table('users')
                    ->where('subcategory_id', $subCategory->id)
                    ->update(['avatar' => $avatarname]);
            }
            $subCategory->category_id = $request->category_id;
            $subCategory->sub_category_name = $request->sub_category_name;
            $subCategory->sub_category_designation = $request->sub_category_designation;
            $sub_category_slug = $request->sub_category_name;
            $subCategory->sub_category_slug = $slug;
            $subCategory->sub_category_email = $request->sub_category_email;
            if ( isset($request->old_password) && !Hash::check($request->old_password, $subCategory->password) ){
                return redirect()->back()->withErrors(['The old password does not match our records.']);
            } else if(isset($request->old_password)){
                $subCategory->password = bcrypt($request->password);
                DB::table('users')
                ->where('subcategory_id', $subCategory->id)
                ->update(['password' => bcrypt($request->password)]);
            }
            DB::table('users')
                    ->where('subcategory_id', $subCategory->id)
                    ->update(['name' => $request->sub_category_name, 'email' => $request->sub_category_email]);
                    
            $subCategory->update();

            // DB::table('users')
            //   ->where('subcategory_id', $subCategory->id)
            //   ->update(['avatar' => $avatarname]);

        }
        
        return redirect()->route('admin.sub_category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        $subCategory->delete();
        return redirect()->back();
    }
}
