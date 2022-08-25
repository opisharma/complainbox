<?php

namespace App\Http\Controllers\Student;

use App\Mail as DBMail;
use App\Category;
use App\SubCategory;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MailController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('student.email.compose',compact('categories'));
    }

    public function emails()
    {
        $mails = DBMail::where('user_id', Auth::user()->id)->get();
        return view('student.email.index', compact('mails'));
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
            'email' => 'required',
            'employee_id' => 'required',
            'subject'   =>  'required',
            'message'   =>  'required|string|max:2000',
        ]);
        $document = $request->file('document');

        $slug = Str::slug($request->subject,'-');
            if (isset($document)) {
                $currentDate = Carbon::now()->toDateString();
                $documentName = $slug.'-'.$currentDate.uniqid().'.'.$document->getClientOriginalExtension();


                if (!Storage::disk('public')->exists('docs')) {
                    Storage::disk('public')->makeDirectory('docs');
                }
                Storage::disk('public')->putFileAs('docs/',$document,$documentName);
               
                
            }
        // Check if uploaded file size was greater than 
        // maximum allowed file size
        if (isset($document) && $document->getError() == 1) {
            $max_size = $document->getMaxFileSize() / 1024 / 1024;  // Get size in Mb
            $error = 'The document size must be less than ' . $max_size . 'Mb.';
            return redirect()->back()->with('flash_danger', $error);
        }

        $mail = new DBMail();
        $mail->user_id = Auth::user()->id;
        $mail->department_id = $request->category;
        $mail->subject = $request->subject;
        $mail->message = html_entity_decode($request->message);
        if (isset($document)) {
            $mail->document = $documentName;
        }
        $mail->save();
        $mail->employees()->attach($request->employee_id);
        
        
        if (isset($document)) {
            $data = array(
                'name'  =>  $request->name,
                'message'   =>  html_entity_decode($request->message),
                'mailId' => $mail->id,
                'is_approved' => $mail->status,
                'document' => $document
            );
        }else {
            $data = array(
                'name'  =>  $request->name,
                'message'   =>  html_entity_decode($request->message),
                'mailId' => $mail->id,
                'is_approved' => $mail->status,
                'document' => false
            );
        }
        //html_entity_decode
        $subject = $request->subject;
        foreach($request->email as $mail) 
        {
            Mail::to($mail)->send(new SendMail($data,$subject));
        }
        return redirect()->back();
    }

    public function show($id)
    {
        $mail = DBMail::findOrfail($id);
        return view('student.email.show',compact('mail'));
    }

    public function approve( $id )
    {
        $mail = DBMail::where('id', $id)->first();
        $mail->status = 1;
        $mail->save();
        return redirect()->back();
    }
}
