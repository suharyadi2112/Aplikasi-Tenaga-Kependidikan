<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
//use Carbon\Carbon;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class AdminController extends Controller
{

	public function __construct(Request $request)
    {
        $this->middleware('auth');
        //return view('admin.dashboard.surattugasclient.indexclient');
    }

    //cek akses
    public function index(Request $request){
      $level = Auth::user()->level;
      //dd($level);
      switch ($level) {
        case "1":
            return $this->dashboardLevel1(); //Admin
            break;
        case "2":            
            return $this->dashboardLevel2($request); 
            break;
        case "3":
            return $this->dashboardLevel3(); 
            break;
        default:
            return $this->umum();
            break;
      }
    }
    //lokasi file setelah cek akses
    protected function dashboardLevel1(){

    	return view('admin.dashboard.index.mainadmin');

    }
    protected function dashboardLevel2(){

        return view('admin.dashboard.index.mainadmin');
        
    }
    protected function dashboardLevel3(){

        return view('admin.dashboard.index.mainadmin');
        
    }
    protected function umum(){

        return view('admin.dashboard.index.mainadmin');

    }




}
