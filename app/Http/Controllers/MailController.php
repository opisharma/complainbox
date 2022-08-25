<?php

namespace App\Http\Controllers;

use App\Category;
use App\SubCategory;
use App\Mail as DBMail;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {

        $categories = Category::all();
        return view('email.compose',compact('categories'));
    }

    public function getSubcategory( Request $request )
    {
        $sub_category = SubCategory::where('category_id', $request->id)->pluck('sub_category_name','sub_category_email')->toArray();
        return response()->json($sub_category);
    }
    
    public function getSubcategoryID( Request $request )
    {
        $sub_category = SubCategory::where('category_id', $request->id)->pluck('sub_category_name','id')->toArray();

        return response()->json($sub_category);
    }

    public function sendmail( Request $request )
    {

        $request->validate([
            'category' => 'required',
            'subject'   =>  'required',
            'message'   =>  'required|string|max:2000',
        ]);

        $mail = new DBMail();
        $mail->user_id = Auth::user()->id;
        $mail->department_id = $request->category;
        $mail->subject = $request->subject;
        $mail->message = html_entity_decode($request->message);
        $mail->save();
        $mail->employees()->attach($request->employee_id);
        
        $data = array(
            'name'  =>  $request->name,
            'message'   =>  html_entity_decode($request->message),
            'mailId' => $mail->id,
            'is_approved' => $mail->status,
        );
        //html_entity_decode
        $subject = $request->subject;
        foreach($request->email as $mail) 
        {
            Mail::to($mail)->send(new SendMail($data,$subject));
        }
        return redirect()->back();
    }

    public function approve( $id )
    {
        $mail = DBMail::where('id', $id)->first();
        $mail->status = 1;
        $mail->save();
        return redirect()->back();
    }

    public function decline($id)
    {
        $mail = DBMail::where('id', $id)->first();
        $mail->status = 2;
        $mail->save();
        return redirect()->back();
    }
}