<?php

namespace App\Http\Controllers\SuratUndangan;

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

class SuratUndanganProses extends Controller
{	

	//GET DATA MORE TABLE MULTIPLE PRINT
	public function LoadMoreUndangan(Request $request){

            if($request->ajax()){
 
                if ($request->ns) {
                
                    $NoSurMultiple = DB::table('a_srt_udg_penguji')
                    ->join('a_tbl_mhs', 'a_tbl_mhs.id_mhs', '=', 'a_srt_udg_penguji.id_mhs')
                    ->select('a_srt_udg_penguji.id_undangan','a_srt_udg_penguji.no_surat','a_srt_udg_penguji.tanggal_pelaksanaan','a_srt_udg_penguji.tahun','a_tbl_mhs.nama')
                   	->orderBy('tahun', 'DESC')
                    ->orderBy('no_surat','DESC')
                    ->where([['a_srt_udg_penguji.no_surat','<',$request->ns],['a_srt_udg_penguji.tahun','=',$request->tahun]])
                    ->paginate(5);

                }else{
                    $NoSurMultiple = DB::table('a_srt_udg_penguji')
                    ->join('a_tbl_mhs', 'a_tbl_mhs.id_mhs', '=', 'a_srt_udg_penguji.id_mhs')
                    ->select('a_srt_udg_penguji.id_undangan','a_srt_udg_penguji.tanggal_pelaksanaan','a_srt_udg_penguji.no_surat','a_srt_udg_penguji.tahun','a_tbl_mhs.nama')
                    ->orderBy('tahun', 'DESC')
                    ->orderBy('no_surat','DESC')
                    ->where('a_srt_udg_penguji.tahun','=',$request->tahun)
                    ->paginate(5);
                }
           
              $output = '';
              $last_id = '';
              
                if(!$NoSurMultiple->isEmpty())
                {   
                    $output .= '
                    <table class="table table-striped table-bordered display table-dark table-hover">
                    <thead>';

                    if ($request->ns) {
                        # code...
                    }else{
                    $output .= '<tr>
                                    <th>Nomor Surat</th>
                                    <th>Mahasiswa</th>
                                    <th>Pelaksanaan</th>
                                    <th class="p-2" style="vertical-align: middle;">
                                    <div class="icheck-primary d-inline"  style="cursor:pointer;">
                                      <input type="checkbox" id="checkboxPrimarysks" name="ceksemua" value="check" onclick="toggle(this)">
                                      <label for="checkboxPrimarysks">
                                        
                                      </label>
                                    </div>
                                    </th>
                                </tr>';
                    }
                    $output .= '</thead>
                    <tbody style="">';

                    foreach ($NoSurMultiple as $keyMult => $item_NoSurMultiple){
                    '<div id="cekss">';
                    $output .=  '<tr >
                                    <td class="p-2" style="vertical-align: middle; width:30%;">'.$item_NoSurMultiple->no_surat.'</td>
                                    <td class="p-2" style="vertical-align: middle; width:50%;">'.$item_NoSurMultiple->nama.'</td>
                                    <td class="p-2" style="vertical-align: middle; width:20%;">'.$this->tanggal_indo($item_NoSurMultiple->tanggal_pelaksanaan).'</td>
                                    <td class="p-2" style="vertical-align: middle;">
                                        <div class="icheck-primary d-inline" style="cursor:pointer; text-align: center;">
                                            <input type="checkbox" id="Mult'.$item_NoSurMultiple->id_undangan.'" name="id[]" value="'.$item_NoSurMultiple->id_undangan.'">
                                            <label for="Mult'.$item_NoSurMultiple->id_undangan.'"></label>
                                        </div>
                                    </td>
                                </tr>';

                    $last_id = $item_NoSurMultiple->id_undangan;
                    $gns = $item_NoSurMultiple->no_surat;
                    '</div>';
                    }
                    '</tbody>
                    
                    </table>';

                    $output .='<tr id="sisa"><td colspan="4" style="text-align:center;"><div id="load_more">
                    <button type="button" name="load_more_button" class="btn btn-primary btn-sm" data-ns="'.$gns.'" data-id="'.$last_id.'" id="load_more_button">Lebih Banyak</button>
                    </div></td>
                    <tr>';

                }else{
               $output .= '
               <div id="load_more">
                <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
               </div>
               ';
              }
              return Response::json(array('cek' => $output), 200);
          }
	}

	//GET DATA PEMBIMBING 2.0
    public function GetDataPembimbing(Request $request){

		$cekSurat = DB::table('a_srt_tgs_pembimbing')
					->join('a_tbl_mhs','a_tbl_mhs.id_mhs','=','a_srt_tgs_pembimbing.id_mhs')
					->join('a_prodi','a_prodi.id_prodi','=','a_srt_tgs_pembimbing.id_prodi')
					->leftJoin('pegawai','pegawai.id_pegawai','=','a_srt_tgs_pembimbing.id_dosen')
					->select('a_tbl_mhs.nama','a_tbl_mhs.nim','a_tbl_mhs.id_mhs',
							 'a_srt_tgs_pembimbing.no_surat',
							 'a_prodi.nama_prodi','a_prodi.id_prodi',
							 'pegawai.id_pegawai')
					->where('id','=',$request->id_surat)->first();

		if (is_null($cekSurat)) {
			return Response::json(array( 'kosong' => '1' ), 200);
		}else{

		$cek_dospem = DB::table('a_srt_tgs_pembimbing')
					->join('pegawai','pegawai.id_pegawai','=','a_srt_tgs_pembimbing.id_dosen')
					->select('a_srt_tgs_pembimbing.id_dosen','pegawai.nama_karyawan')
					->where('a_srt_tgs_pembimbing.id','=',$request->id_surat)
					->get();

				$button=[];	
				foreach($cek_dospem as $key )
        			$button[] = $key->id_dosen;

        return Response::json(array(
                            'no_su' => $cekSurat->no_surat,

                            'id_mhs' => $cekSurat->id_mhs,
                            'nama_mhs' => $cekSurat->nama,
                            'nim' => $cekSurat->nim,

                            'nama_prodi' => $cekSurat->nama_prodi,
                            'id_prodi' => $cekSurat->id_prodi,

                            'dospem' => $button

                        ), 200);
        }
    }

	//Preview Berkas Upload dari bagian undangan
	public function preview_berkas_scan($id, $kategori, $kategori2){

        $ceknmfile = DB::table('a_berkas_scan_buff')->select('*')
        ->where([['id_data_buff', '=', $id],['kategori_buff','=',$kategori]])
        ->orWhere([['id_data_buff', '=', $id],['kategori_buff','=',$kategori2]])
        ->first(); 

        if(is_null($ceknmfile)){

        	abort(404);

        }else{

	        $file= public_path(). "/berkas_scan/".$ceknmfile->kategori_buff."/".$ceknmfile->id_data_buff."/".$ceknmfile->file_name.'.'.$ceknmfile->file_type;

	        return response()->file($file);
	    }

	}

	public function destroy_file_scan_undangan($id, $kategori, $kategori2){


		$ceknmfile = DB::table('a_berkas_scan_buff')->select('*')
	        ->where([['id_data_buff', '=', $id],['kategori_buff','=',$kategori]])
	        ->orWhere([['id_data_buff', '=', $id],['kategori_buff','=',$kategori2]])
	        ->first(); 
	        
	    if(is_null($ceknmfile)){

        	abort(404);

        }else{

		    $cek_berkas= public_path(). "/berkas_scan/".$ceknmfile->kategori_buff."/".$ceknmfile->id_data_buff."/".$ceknmfile->file_name.'.'.$ceknmfile->file_type;


		    if ($cek_berkas) {

				 try {

	        		File::delete($cek_berkas);

	        		$cek = DB::table('a_berkas_scan_buff')
	        		->where([['id_data_buff', '=', $id],['kategori_buff','=',$kategori]])
		        	->orWhere([['id_data_buff', '=', $id],['kategori_buff','=',$kategori2]])
		        	->delete();

			       	return Redirect::back()->with('success', 'File Sudah Dihapus');

			    } catch (Exception $e) {

			       	return Redirect::back()->with('error', 'Terjadi Kesalahan #lkngo3');

			    }


		    }else{
		    	return Redirect::back()->with('error', 'Terjadi Kesalahan');
		    }
		}
    }


	//get nama berkas
    public function get_namaberkas(){

    	$set = Input::get('id');

        # Inisialisasi variabel berdasarkan masing-masing tabel dari model
        # dimana ID target sama dengan ID inputan
        $ceknidn = DB::table('a_berkas_adm')
        ->join('a_prodi', 'a_prodi.id_prodi', '=', 'a_berkas_adm.id_prodi')
        ->select('a_berkas_adm.id_jenisberkas','a_berkas_adm.id_prodi','a_berkas_adm.nama_berkas','a_prodi.nama_prodi','a_prodi.id_prodi')
        ->where('a_berkas_adm.id_prodi', $set)
        ->get();

        # Buat pilihan "Switch Case" berdasarkan variabel "type" dari form
        switch(Input::get('type')):
            # untuk kasus "kabupaten"
            case 'gd_nmberkas':
                $return = '<option value="">Pilih Berkas Administrasi...</option>';
                # lakukan perulangan untuk tabel kabupaten lalu kirim
                foreach($ceknidn as $key ) 
                    # isi nilai return
                    $return .= "<option value='$key->id_jenisberkas'>$key->nama_berkas || $key->nama_prodi</option>";
                  # kirim
                return $return;
            break;
        # pilihan berakhir
        endswitch;    
    }

	//simpan edit 
	public function simpanedit(Request $request, $id){

		$cek =	DB::table('a_srt_udg_penguji')
	            ->where('id_undangan','=', $id)
	            ->update(
	            	[
	            		'id_mhs' => $request->id_mhs,
	            		'judul' => $request->judul,
	            		'id_prodi' => $request->id_prodi,
	            		'id_nama_mk' => $request->id_mk,
	            		'id_berkas_adm' => $request->id_jenisberkas,
	            		'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
	            		'id_ruangan' => $request->id_ruangan,
	            		'lampiran' => $request->lampiran,
	            		'jam_mulai' => $request->jam_mulai,
	            		'jam_selesai' => $request->jam_selesai,
	            		'updated_at' =>  \Carbon\Carbon::now()
	            	]
	            );

	    if ($cek) {
	    	return Response::json(array(
			                'success' => 'Berhasil',
				                'errors' => false,
				            ), 200);
		    }else{
		    	return Response::json(array(
				                'success' => false,
				                'errors' => 'Terjadi Kesalahan #l34h34',
				            ), 400);
		    }

	
	}

	//Update Nomor Surat Undangan
	public function updatenosu(Request $request){

		if($this->cek_akses('72') == 'yes'){

				$cek =	DB::table('a_srt_udg_penguji')
	            ->where('id_undangan','=', $request->id)
	            ->update(['no_surat' => $request->no_surat.$request->nosusuto]);

			    if ($cek) {
			    	return Response::json(array(
					                'success' => 'Berhasil',
					                'errors' => false,
					            ), 200);
			    }else{
			    	return Response::json(array(
					                'success' => false,
					                'errors' => 'Terjadi Kesalahan #lkjh34',
					            ), 400);
			    }

		}else{ 
			return Response::json(array(
					                'success' => false,
					                'errors' => 'Anda Tidak Memiliki Akses Untuk Mengubah Nomor Surat',
					            ), 400);
					            } 

	

	}

	//Tambah Surat Undangan Penguji Proposal dan TA
	public function tambahsuratundangan(Request $request){

		//$cek =  DB::table('a_srt_udg_penguji')->latest('id_undangan', 'no_surat')->first();

		$from = '302/AK/U/I/2021';
        $to = '307/AK/U/I/2021';

        $cek =  DB::table('a_srt_udg_penguji')->select('no_surat')
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

		$result = 	DB::table('a_srt_udg_penguji')
	    			->insert(
	        			[	'no_surat' => sprintf("%03s", $rtz + 1).$this->nosurattugas(), 
	        				'id_nama_mk' => $request->id_mk,
	        				'id_mhs' => $request->id_mhs, 
	        				'id_prodi' => $request->id_prodi,
	        				'id_ruangan' => $request->id_ruangan,
	        				'id_berkas_adm' => $request->id_jenisberkas,
	        				'judul' => $request->judul,
	        				'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
	        				'jam_mulai' => $request->jam_mulai,
	        				'jam_selesai' => $request->jam_selesai,
	        				'lampiran' => $request->lampiran,
	        				'tahun' => date('Y',strtotime(\Carbon\Carbon::now())),

	        				'created_at' => \Carbon\Carbon::now()
	        			]);

	   	if ($result) {

	   		$Lastid = DB::getPdo()->lastInsertId();

	   		if ($request->input('id_pegawai')) {
				for ($i = 0; $i < count($request->input('id_pegawai')); $i++) {

		        $answers[] = [
		        	'id_udg' => $Lastid,
		        	'kategori_dosen' => 'Penguji',
		        	'id_dosen' => $request->input('id_pegawai')[$i],
		        	'created_at' => \Carbon\Carbon::now()
				    ];
			    }

			    $cekQuery = DB::table('a_udg_dp')->insert($answers);

		   		if ($cekQuery) {
			    
			    }else{
			    	return Response::json(array(
			                'success' => false,
			                'errors' => 'Terjadi Kesalahan #32432',
			            ), 400);
			    }
	   		}

	   		if ($request->input('id_pembimbing')) {

	   			for ($i = 0; $i < count($request->input('id_pembimbing')); $i++) {

		        $answers2[] = [
		        	'id_udg' => $Lastid,
		        	'kategori_dosen' => 'Pembimbing',
		        	'id_dosen' => $request->input('id_pembimbing')[$i],
		        	'created_at' => \Carbon\Carbon::now()
				    ];
			    }

			    $cekQuery2 = DB::table('a_udg_dp')->insert($answers2);

		   		if ($cekQuery2) {
			    
			    }else{
			    	return Response::json(array(
			                'success' => false,
			                'errors' => 'Terjadi Kesalahan #32rft2',
			            ), 400);
			    }

	   		}


	   	}else{

	   		return Response::json(array(
		                'success' => false,
		                'errors' => 'Terjadi Kesalahan #olkj39',
		            ), 400);

	   	}
	}

	//Hapus Dosen Penguji Surat Undangan
	public function destroydospen($id_undangan, $key){

		$cek = DB::table('a_udg_dp')->where('id', '=', $key)->delete();


		if ($cek) {
			return Response::json(array( 
	                'success' => 'Berhasil',
	                'errors' => false,
	            ), 200);
		}else{
			
		}
	}


	//hapus undangan
    public function destroyundangan($id){

     	if($this->cek_akses('68') == 'yes'){


	    	$cek = DB::table('a_berkas_scan_buff')->select('id_berkas_buff')
	        ->where([['id_data_buff', '=', $id],['kategori_buff','=','seminar proposal']])
	        ->orWhere([['id_data_buff', '=', $id],['kategori_buff','=', 'sidang tugas akhir']])
	        ->count();


		    if ($cek > 0) {
		    	return Redirect::back()->with('error', 'Gagal Hapus File, Harap Hapus File Scan Yang Sudah Diupload Terlebih Dahulu');
		    }else{


		    	$nrd = DB::delete("delete from a_srt_udg_penguji where id_undangan = '$id'");

		        if ($nrd) {

		        	$nrd2 = DB::delete("delete from a_udg_dp where id_udg = '$id'");
		        	if ($nrd2) {
		        		# code...
		        	}else{
		        		alert()->error('surat Undangan', 'Gagal')->persistent('Close');
		                return Redirect::back()->with('error', 'Code error #ljn34');
		        	}

		        	alert()->success('surat undangan', 'Berhasil Menghapus Data Surat Undangan')->persistent('Close');
		            return Redirect::back()->with('success', 'Berhasil');


		        }else{
		                alert()->error('surat Undangan', 'Gagal Hapus Data Surat Undangan')->persistent('Close');
		                return Redirect::back()->with('error', 'Gagal');
		        }
		    }

		}else{ 
		  return Redirect::back()->with('error', 'Anda Tidak Memiliki Hak Akses Untuk Menghapus Data Ini');
		} 


    }


    //Tambah Dosen Penguji / Pembimbing
    public function tamdos(Request $request){

    	if ($request->kategori_dosen == 'Penguji') {
    		$kategori_dosen = $request->kategori_dosen;
    	}else if($request->kategori_dosen == 'Pembimbing'){
    		$kategori_dosen = $request->kategori_dosen;
    	}else{
    		return Response::json(array(
		                'success' => false,
		                'errors' => 'Gagal Menyimpan Data',

		            ), 400);
    	}

    	$ceklama = DB::table('a_udg_dp')->where([['id_dosen','=', $request->id_penguji],['id_udg','=',$request->id_undangan],['kategori_dosen', '=',$kategori_dosen]])->select('id_penguji')->count();
	
        if ($ceklama > 0) {
        	return Response::json(array(
	                'success' => false,
	                'errors' => 'Dosen Sudah Ada',

	            ), 400);

        }else{

    		$result = DB::table('a_udg_dp')
            ->insert(['id_udg' => $request->id_undangan, 'kategori_dosen'=> $kategori_dosen, 'id_dosen' => $request->id_penguji, 'created_at' => \Carbon\Carbon::now()]);

	        if ($result) {
        	 	return Response::json(array(
	                'success' => 'Berhasil',
	                'errors' => false,

	            ), 200);
	        }else{
	        	return Response::json(array(
		                'success' => false,
		                'errors' => 'Gagal Menyimpan Data',

		            ), 400);

	        }
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

     protected function nosurattugas(){

        $bulan = date('n');
        $endtahun = $tahun = date('Y');
        $nomor = "/AK/U/".$this->getRomawi($bulan)."/".$endtahun;

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

    protected function tanggal_indo($tanggal) {
	        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	        $split = explode('-', $tanggal);
	        return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
	    }
}
