<?php

namespace App\Http\Controllers\SuratTugasPembimbing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;


use App\level as Level;
use App\Pegawai as Pegawai; 
use App\SuratTugasPembimbing as srttgspembimbing; 
use DataTables;
use DB;
use Validator; 
use Response;
use Redirect;
use Auth;
use File;

class SuratTugasPembimbingProses extends Controller {


    ////////////////////////////URUTAN PEMBIMBING PROSES/////////////////////////////////
    public function UrtPemProses(Request $request){

        try {
            $HUpdate = DB::table('a_srt_tgs_pembimbing')->where('id','=',$request->data_id)->update(['urutan_pembimbing' => $request->data_radio]);
            return Response::json(array('cekUrt' => '1'), 200);
        } catch (Exception $e) {
            return Response::json(array('cekUrt' => '2'), 200);
        }


    }




    ////////////////////////////////////////////////surat tugas penguji///////////////////////////////////////////////
    public function simpansurattugaspenguji(Request $request){

        $cekQuery = DB::table('a_srt_udg_penguji')->where('id_undangan','=',$request->id_surat_udg)->first();
        
        $from = '626/AK/STD/I/2021';
        $to = '791/AK/STD/I/2021';

        $cek =  DB::table('a_srt_tgs_pembimbing')->select('no_surat')
        ->orderBy('tahun', 'DESC')
        ->orderBy('no_surat','DESC')
        ->whereNotBetween('no_surat', [$from, $to])
        ->latest()
        ->first();

        if (empty($cek)) {
            $rtz = '0';
        }else{
            $pisah = explode( '/', $cek->no_surat);
            $rtz = $pisah[0];
        }

        $insert = DB::table('a_srt_tgs_pembimbing')
                    ->insert(
                        [
                            'no_surat' => sprintf("%03s", $rtz + 1).$this->nosurattugas(),
                            'id_udg' => $request->id_surat_udg,
                            'id_prodi' => $cekQuery->id_prodi,
                            'id_mk' => $cekQuery->id_nama_mk,
                            'id_mhs' => $cekQuery->id_mhs,
                            'jenis_surat' => 'Baru',
                            'semester' => $request->semester,
                            'tahun_ajar' => $request->tahun_ajar,
                            'tahun' => date('Y',strtotime(\Carbon\Carbon::now())),
                            'created_at' =>\Carbon\Carbon::now()
                        ]
                    );

        if ($insert) {
            return Redirect::back()->with('success', 'Berhasil Menambah Data Untuk Surat Tugas Penguji');
        }else{
            return Redirect::back()->with('error', 'Gagal Menambah Data');
        }

    }
////////////////////////////////////////////////surat tugas penguji///////////////////////////////////////////////


///////////////////////////////////////Update Nomor surat tugas pembimbing////////////////////////////////////////////////
	public function updatesrttgspembimbing(Request $request){



    if($this->cek_akses('58') == 'yes'){



        $cekjumlah = DB::table('a_srt_tgs_pembimbing')->select('no_surat')->where('no_surat','=',$request->no_surat.$request->nosusuto)->count();

        if ($cekjumlah > 0) {

            return Response::json(array(
                'success' => false,
                'errors' => 'Gagal #ljkn3',

            ), 400);

        }else{
            $cekQuErY = DB::table('a_srt_tgs_pembimbing')
            ->where('id','=', $request->id)
            ->update(['no_surat' => $request->no_surat.$request->nosusuto]);

            if ($cekQuErY) {

                return Response::json(array(
                    'success' => 'berhasil',
                    'errors' => false,

                ), 200);

            }else{
                return Response::json(array(
                    'success' => false,
                    'errors' => 'Gagal #3049b',

                ), 400);
            }

        }


        }else{ 

            return Response::json(array(
                        'success' => false,
                        'errors' => 'Gagal #3049b',

                    ), 400);

        }  


		

	}
///////////////////////////////////////Update Nomor surat tugas pembimbing////////////////////////////////////////////////



///////////////////////////////////////Edit surat tugas pembimbing////////////////////////////////////////////////

	public function destroysrttgspembimbing($id){

            $Data = DB::table('a_srt_tgs_pembimbing')->select('no_surat')->where('id','=',$id)->first();

            $nrd = DB::delete("delete from a_srt_tgs_pembimbing where id = '$id'");
            
            if ($nrd) {

                DB::table('a_mata_kuliah_mbkm')->where('no_surat_tugas_pembimbing','=', $Data->no_surat)->delete();

                alert()->success('surat tugas', 'Berhasil Menghapus Pegawai')->persistent('Close');
                return Redirect::back()->with('success', 'Berhasil');

            }else{
                alert()->error('surat tugas', 'Gagal Hapus Data Pegawai')->persistent('Close');
                return Redirect::back()->with('error', 'Gagal');
        }
    }

	public function editsrttgspembimbing(Request $request){

		$CekQuerY = DB::table('a_srt_tgs_pembimbing')->where('id','=', $request->id)

		            ->update([	
		            			'id_dosen' =>$request->input('id_dosen'),
								'id_prodi' =>$request->input('id_prodi'),
								'id_mk' =>$request->input('id_mk'),
								'id_mhs' =>$request->input('id_mhs'),
								'semester' =>$request->input('semester'),
								'jenis_surat' =>$request->input('jenis_surat'),
								'tahun_ajar' => $request->input('tahun_ajar'),
								'updated_at' => \Carbon\Carbon::now()
							]);
    
		if ($CekQuerY) {

			return Response::json(array(
                'success' => 'berhasil',
                'errors' => false,

            ), 200);

		}else{
			return Response::json(array(
                'success' => false,
                'errors' => $CekQuerY,

            ), 400);
		}
	}

///////////////////////////////////////Edit surat tugas pembimbing////////////////////////////////////////////////



///////////////////////////////////////tambah surat tugas pembimbing////////////////////////////////////////////////
	public function tambahsurattugaspembimbing(Request $request){  

        $from = '626/AK/STD/I/2021';
        $to = '791/AK/STD/I/2021';

        $cek =  DB::table('a_srt_tgs_pembimbing')->select('no_surat')
        ->orderBy('tahun', 'DESC')
        ->orderBy('no_surat','DESC')
        ->whereNotBetween('no_surat', [$from, $to])
        ->latest()
        ->first();

        if (empty($cek)) {
            $rtz = '0';
        }else{
            $pisah = explode( '/', $cek->no_surat);
            $rtz = $pisah[0];
        }

        $cekPro = DB::table('a_tbl_mhs')->select('prodi')->where('id_mhs','=',$request->input('id_mhs'))->first();
        if ($cekPro) {
        }else{
            return Response::json(array('cek' => '3'), 200);
        }

        for ($i = 0; $i < count($request->input('id_dosen')); $i++) {

            if (count($request->id_dosen) <= 1) {
                $totdos = null;
            }else{
                $totdos = $i + 1;
            }
                $answers[] = [
                    'no_surat' => sprintf("%03s", $rtz + $i + 1).$this->nosurattugas(),
                    'id_dosen' =>$request->input('id_dosen')[$i],
                    'id_prodi' =>$cekPro->prodi,
                    'id_mk' =>$request->input('id_mk'),
                    'id_mhs' =>$request->input('id_mhs'),
                    'semester' =>$request->input('semester'),
                    'jenis_surat' =>$request->input('jenis_surat'),
                    'urutan_pembimbing' => $totdos,
                    'tahun_ajar' => $request->input('tahun_ajar'),
                    'nama_kegiatan_mbkm' => $request->input('nama_kegiatan'),
                    'bentuk_mbkm' => $request->input('mbkm'),
                    'sks_diakui_mbkm' => $request->input('sks_diakui'),
                    'tahun' => date('Y',strtotime(\Carbon\Carbon::now())),
                    'created_at' => \Carbon\Carbon::now(),
                ];

           if (!is_null($request->input('mata_kuliah'))) {//CEK JIKA TIDAK MBKM
                for ($mk = 0; $mk < count($request->input('mata_kuliah')); $mk++) {
                    $answersMatkul[] = [
                        'no_surat_tugas_pembimbing' => sprintf("%03s", $rtz + $i + 1).$this->nosurattugas(),
                        'id_mata_kuliah' =>$request->input('mata_kuliah')[$mk],
                        'detail_mata_kuliah' =>$request->input('DetailMatkul')[$mk],
                        'created_at' => \Carbon\Carbon::now(),
                    ];
                }
           }
        }
        try {
        
            $cekQuery = DB::table('a_srt_tgs_pembimbing')->insert($answers);

            if (!is_null($request->input('mata_kuliah'))) {//CEK JIKA TIDAK MBKM
                $cekQueryMatKul = DB::table('a_mata_kuliah_mbkm')->insert($answersMatkul);
            }
            return Response::json(array('cek' => '1','errors' => false), 200);
        } catch (Exception $e) {
            return Response::json(array('cek' => '2','errors' => report($e)), 200);
        }

    }

	//get nidn saat memilih nama dosen
    public function gd_nidn(){

    	$set = Input::get('id');

        # Inisialisasi variabel berdasarkan masing-masing tabel dari model
        # dimana ID target sama dengan ID inputan
        $ceknidn = DB::table('pegawai')
        ->select('id_pegawai','nidn','nama_karyawan')
        ->where('id_pegawai', $set)
        ->first();

        if (empty($ceknidn->nidn)) {
        	$rty123 = '-';
        }else{
        	$rty123 = $ceknidn->nidn;
        }

        # Buat pilihan "Switch Case" berdasarkan variabel "type" dari form
        switch(Input::get('type')):
            # untuk kasus "kabupaten"
            case 'gd_nidn':
                # buat nilai default
                $return = '<input type="text" class="form-control" value="'.$ceknidn->nama_karyawan.' | '.$rty123.'" readonly/>';
                return $return;
            break;
        # pilihan berakhir
        endswitch;    
    }

    //get nim saat memilih nama mahasiswa
    public function gd_mhs_nim(){

    	$set = Input::get('id');

        # Inisialisasi variabel berdasarkan masing-masing tabel dari model
        # dimana ID target sama dengan ID inputan
        $ceknim = DB::table('a_tbl_mhs')
        ->select('id_mhs','nim','nama')
        ->where('id_mhs', $set)
        ->first();

        if (empty($ceknim->nim)) {
        	$rty123 = '-';
        }else{
        	$rty123 = $ceknim->nim;
        }

        # Buat pilihan "Switch Case" berdasarkan variabel "type" dari form
        switch(Input::get('type')):
            # untuk kasus "kabupaten"
            case 'gd_mhs':
                # buat nilai default
                $return = '<input type="text" class="form-control" value="'.$ceknim->nama.' | '.$rty123.'" readonly/>';
                return $return;
            break;
        # pilihan berakhir
        endswitch;    
    }
 /////////////////////////////////////////////////tambah surat tugas pembimbing////////////////////////////////////////////////

    protected function nosurattugas(){

        $bulan = date('n');
        $endtahun = $tahun = date('Y');
        $nomor = "/AK/STD/".$this->getRomawi($bulan)."/".$endtahun;

        return $nomor;
    }
    protected function getRomawi($bln){
        switch ($bln){
        case 1: 
            return "I";
        break;
        case 2:
            return "II";
        break;
        case 3:
            return "III";
        break;
        case 4:
            return "IV";
        break;
        case 5:
            return "V";
        break;
        case 6:
            return "VI";
        break;
        case 7:
            return "VII";
        break;
        case 8:
            return "VIII";
        break;
        case 9:
            return "IX";
        break;
        case 10:
            return "X";
        break;
        case 11:
            return "XI";
        break;
        case 12:
            return "XII";
        break;
        }
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
