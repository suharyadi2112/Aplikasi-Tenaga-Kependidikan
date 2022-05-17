<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\User as User;
use Notification;
use App\Notifications\MyFirstNotification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
    }



}
