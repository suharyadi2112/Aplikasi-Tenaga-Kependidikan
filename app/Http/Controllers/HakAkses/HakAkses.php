<?php

namespace App\Http\Controllers\HakAkses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Collection;

use DataTables;
use DB;
use Validator; 
use Response;
use Redirect;
use Auth;
Use Exception;
use DateTime;


class HakAkses extends Controller
{
    

	public function index_hakakses(){

		$usergroup = DB::table('usergroup')->get();
		$groupmodul = DB::table('hak')->select('groupmodul')->groupBy('groupmodul')->orderBy('urutan','ASC')->get();
		
		return view('admin.dashboard.setupakses.index_akses',['usergroup' => $usergroup, 'groupmodul' => $groupmodul]);

	} 

	public function simpan_hakakses(Request $request){

		try {
			DB::table('hak_akses')->where('usergroup','=',$request->usergroup)->delete();
		} catch (Exception $e) {
			return Redirect::back()->with('error', 'Terjadi Kesalahan #lh34l');
		}

		//$row_tampil = mysqli_fetch_array(mysqli_query($link, "SELECT * FROM usergroup WHERE md5(id)='$usergroup'"), MYSQLI_ASSOC);
		$row_tampil = DB::table('usergroup')->select('*')->where('id','=',$request->usergroup)->first();
		
		$hasil_loop = array();
		for ($i = 1; $i <= $request->jmlha; $i++) {
            //query insert hak akses yang baru ke tabel akses
			try {

				$hasil_loop[] = ['usergroup' => $row_tampil->id, 'modul' => $request->input('ha'.$i)];

				
			} catch (Exception $e) {
				return Redirect::back()->with('error', 'Terjadi Kesalahan #lh3433v');
			}

        }

        DB::table('hak_akses')->insert($hasil_loop);
        return Redirect::back()->with('success', 'Berhasil Mengubah Data Hak Akses');

	}


}
