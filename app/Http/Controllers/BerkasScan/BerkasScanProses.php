<?php

namespace App\Http\Controllers\BerkasScan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;


use App\level as Level;
use App\Pegawai as Pegawai; 
use DataTables;
use DB;
use Validator; 
use Response;
use Redirect;
use Auth;
use File;


class BerkasScanProses extends Controller
{


    public function ProsesUploadBerkasScan(Request $request){

    $count = DB::table('a_berkas_scan_buff')
    		->where([['id_data_buff','=',$request->id_sks],['kategori_buff','=',$request->kategori_berkas]])
    		->count();

    if ($count > 0) {
    	return Redirect::back()->with('error', 'File Sudah Ada');
    }

    $extention = pathinfo(Input::file('files')->getClientOriginalName(), PATHINFO_EXTENSION);
    $namaphoto = pathinfo(Input::file('files')->getClientOriginalName(), PATHINFO_FILENAME);
    $sizephoto = $request->file('files')->getSize();
    $files = $request->file('files');


	//$randomname = date('Ymd') .'-'. substr(uniqid(rand(), true), 5, 5) .'-'. Auth::id();
	$path = public_path().'/berkas_scan/'.$request->kategori_berkas.'/'.$request->id_sks;

	  if(empty($errors)==true){
	      if(!File::isDirectory($path)){
	            Storage::makeDirectory($path, $mode = 0711, true, true);
	          }
	          if(File::isDirectory("$path/".$namaphoto)==false){
	               if (file_exists($path.'/'.$namaphoto)) {
	                return Redirect::back()->with('error', 'Terjadi Kesalahan #df345');
	                die;
	              }
	            $files->move("$path/",$namaphoto.'.'.$extention);
	          }else{                  // rename the file if another one exist
	                return Redirect::back()->with('error', 'Terjadi Kesalahan #3453sd');
	          }
	      }else{
	              print_r($errors);
	      }

	    if ($files) {
	        $result = DB::table('a_berkas_scan_buff')
            ->insert(
            	[
            		'id_data_buff' => $request->id_sks,
	            	'kategori_buff'=> $request->kategori_berkas,
	            	'file_name'=> $namaphoto, 
	            	'file_size' => $sizephoto,
	            	'file_type' => $extention,
                    'nama_lampiran' => $request->nama_lampiran,
	            	'created_at' => \Carbon\Carbon::now()
            	]);

	        return Redirect::back()->with('success', 'Berhasil Upload File '.$namaphoto.'.'.$extention.'');
	    }
	   

    }

    //Download File Berkas soal scanan
    public Function download_file_scanan($id){


        $ceknmfile = DB::table('a_berkas_scan_buff')->select('*')
        ->where('id_berkas_buff' ,'=', $id)
        ->first(); 

        $file= public_path(). "/berkas_scan/".$ceknmfile->kategori_buff."/".$ceknmfile->id_data_buff."/".$ceknmfile->file_name.'.'.$ceknmfile->file_type;

        $headers = [
              'Content-Type' => 'application/pdf',
              'Content-Type:' => 'image/png',
              'Content-Type:' => 'image/jpg',
           ];

        return response()->download($file, $ceknmfile->file_name.'.'.$ceknmfile->file_type, $headers);

    }

	//Preview FileBerkas scanan dari bu fifi
    public function preview_file_scanan($id){

        $ceknmfile = DB::table('a_berkas_scan_buff')->select('*')
        ->where('id_berkas_buff', '=', $id)
        ->first(); 

        $file= public_path(). "/berkas_scan/".$ceknmfile->kategori_buff."/".$ceknmfile->id_data_buff."/".$ceknmfile->file_name.'.'.$ceknmfile->file_type;

        return response()->file($file);

    }

    protected function cek_akses($aModul) {
        $level = Auth::user()->level;
        $username = Auth::user()->username;
        //query untuk mendapatkan iduser dari user           

        $quser = DB::table('users')->select('level')->where('username','=',$username)->first();
        $qry = DB::table('hak_akses')->select('id')->where([['usergroup','=',$quser->level],['modul','=',$aModul]])->count();

        if (1 > $qry) {
            return "no";
        } else {
            return "yes";
        }
    }


}
