<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
        return view( 'student.welcome' );
    }
    
}
