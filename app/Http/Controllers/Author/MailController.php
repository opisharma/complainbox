<?php

namespace App\Http\Controllers\Author;

use App\SubCategory;
use App\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function emails()
    {
        $mails = SubCategory::findOrfail(Auth::user()->subcategory_id)->mails;
        return view('author.email.index', compact('mails'));
    }

    public function show($id)
    {
        $mail = Mail::findOrfail($id);
        // $authors = Mail::with('employees')->where('status',null)->get();
        // $mails = Mail::with('employees')->get();
        // $authors = $mails->where('status',null);
        // foreach ($authors as $value) {
        //     return $value;
        // }
        // $relationship = DB::table('mail_subcategory')
        // ->join('subcategories','mail_subcategory.subcategory_id' , '=', 'subcategories.id')
        // ->join('mails', 'mail_subcategory.mail_id', '=', 'mails.id')
        // ->select('mail_subcategory.mail_id','mail_subcategory.subcategory_id')
        // ->where('mails.status','=',null)
        // ->get();
        // return $relationship->employees;
        // foreach ($relationship as $value) {
        //     return json_encode($value);;
        // }
        return view('author.email.show',compact('mail'));
    }

    public function approve( $id )
    {
        $mail = Mail::where('id', $id)->first();
        $mail->status = 1;
        $mail->save();
        return redirect()->back();
    }

    public function decline($id)
    {
        $mail = Mail::where('id', $id)->first();
        $mail->status = 2;
        $mail->save();
        return redirect()->back();
    }
}
