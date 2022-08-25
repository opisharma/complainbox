<?php

namespace App\Http\Controllers\Admin;

use App\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function emails()
    {
        $mails = Mail::all();
        return view('admin.email.index', compact('mails'));
    }

    public function show($id)
    {
        $mail = Mail::findOrfail($id);
        return view('admin.email.show',compact('mail'));
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

    public function destroy($id)
    {
        $mail = Mail::findOrfail($id);
        $mail->delete();
        return redirect()->back();
    }
}
