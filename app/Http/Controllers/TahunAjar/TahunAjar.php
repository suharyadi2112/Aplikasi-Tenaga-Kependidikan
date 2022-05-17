<?php

namespace App\Http\Controllers\TahunAjar;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;

use DataTables;
use DB;
use Validator; 
use Response;
use Redirect;
use Auth;
use File;

class TahunAjar extends Controller
{

    public function indexAwal(){

    	$ThnAjar = DB::table('tahun_ajar')->select('*')->orderBy('tahun_ajar','DESC')->get();

        return view('admin.dashboard.tahunajar.index', [ 'ThnAjar' => $ThnAjar ]);

    }

    public function UbahStsTahunAjar(Request $request){

        if ($this->cek_akses('113') == 'yes') {

            $ThnAjar = DB::table('tahun_ajar')->where('id','=',$request->id_thnajr)->first();
        
            if ($ThnAjar->status == 1) {
                DB::table('tahun_ajar')->where('id','=', $request->id_thnajr)->update(['status' => 0]);
            }else{
                DB::table('tahun_ajar')->where('id','=', $request->id_thnajr)->update(['status' => 1]);
            }

            return Response::json(array('gg' => '2','errors' => false), 200);

        }else{
            return Response::json(array('gg' => '3'), 200);//no akses
        }

    	
        /* $ThnAjar = DB::table('tahun_ajar')->where('id','=',$request->id_thnajr)->first();
        if ($ThnAjar->status == 1) {
            DB::table('tahun_ajar')->where('id','=', $request->id_thnajr)->update(['status' => 0]);
        }else{
            $ThnAjarCek = DB::table('tahun_ajar')->where('status','=','1')->count();
            if ($ThnAjarCek > 0) {
                return Response::json(array('gg' => '1','errors' => false), 200);
            }else{
                DB::table('tahun_ajar')->where('id','=', $request->id_thnajr)->update(['status' => 1]);
            }
        }
        return Response::json(array('gg' => '2','errors' => false), 200);*/

    } 

    public function TambahTahunAjar(Request $request){

    		try {
        	$insert = DB::table('tahun_ajar')
                    ->insert(
                        [
                            'tahun_ajar' => $request->tahunajar,
                            'semester' => $request->semester,
                            'status' => $request->status,
                            'created_at' =>\Carbon\Carbon::now()
                        ]
                    );
            return Response::json(array('success' => 'berhasil','errors' => false), 200);

			} catch (Exception $e) {
			return Response::json(array('success' => false,'errors' => '#59863'), 400);
			}
    }

    public function DestroyThnAjr($id){

    	$ThnAjar = DB::table('tahun_ajar')->where('id','=',$id)->first();
    	if ($ThnAjar->status == 1) {
    		return Redirect::back()->with('error', 'Non-Aktifkan Status Terlebih Dahulu');
    	}else{
	    	try {
	        	DB::table('tahun_ajar')->where('id', '=', $id)->delete();
	            return Redirect::back()->with('success', 'Berhasil Hapus Data');

			} catch (Exception $e) {
				return Redirect::back()->with('error', 'Gagal Hapus Data');
			}
		}

    }


    //AKSES    
    protected function cek_akses($aModul) {
        $level = Auth::user()->level;
        $username = Auth::user()->username;
        //query untuk mendapatkan iduser dari user           
        $quser = DB::table('users')->select('level')->where('username','=',$username)->first();
        $qry = DB::table('hak_akses')->select('id')->where([['usergroup','=',$quser->level],['modul','=',$aModul]])->count();
        if (1 > $qry) { return "no"; } else {return "yes";}
    }
}
