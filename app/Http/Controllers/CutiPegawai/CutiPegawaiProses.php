<?php

namespace App\Http\Controllers\CutiPegawai;


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
use URL;

class CutiPegawaiProses extends Controller
{
    
    //SIMPAN PERIODE
	public function SimpanPeriode(Request $request){

		$insert = DB::table('c_periode_cuti')->insert(
		    ['periode_awal' => $request->periode_awal, 'periode_akhir' => $request->periode_akhir,'keterangan_periode' => $request->ketPeriode, 'created_at' => \Carbon\Carbon::now()]
		);
		 if ($insert) {
		 	return Response::json(array('cek' => 'berhasil'), 200);
		 }else{
		 	return Response::json(array('cek' => 'gagal'), 200);
		 }
	}

	public function HapusPeriode(Request $request){

		$CekCutBer = DB::table('c_cuti_bersama')->where('id_periode','=',$request->data_id)->count(); 

		if ($CekCutBer > 0) {
				return Response::json(array('cek' => 'cbma'), 200);
		}else{
			$delete = DB::table('c_periode_cuti')->where('id_kategori', '=', $request->data_id)->delete();
			if ($delete) {
				return Response::json(array('cek' => 'berhasil'), 200);
			}else{
				return Response::json(array('cek' => 'gagal'), 200);
			}
		}
	}

	public function UbahPeriode(Request $request){

		$update = DB::table('c_periode_cuti')->where('id_kategori','=', $request->data_id)->update(['periode_awal' => $request->periode_awal ,'periode_akhir' => $request->periode_akhir,'keterangan_periode' => $request->ketPeriode,'updated_at' => \Carbon\Carbon::now()]);
		if ($update) {
			return Response::json(array('cek' => 'berhasil'), 200);
		}else{
			return Response::json(array('cek' => 'gagal'), 200);
		}
	}

	//CUTI BERSAMA DALAM PERIODE INDEX
	public function TambahCutiBersama(Request $request){

		//cek tanggal yang dipilih
		if($this->CekTanggalCutBer($request->tanggalCutBer, $request->id_periode) == 'ada'){
			return Response::json(array('cek' => 'TglSudahAda'), 200);
		}else{
			
			if ($request->tanggalCutBer == [null]) {
			return Response::json(array('cek' => 'tglkosong'), 200);

		}else{

			$cekToString = implode(",",$request->tanggalCutBer);
			$TglVaru = explode(",",$cekToString);
		
			for ($i=0; $i < count($TglVaru); $i++) { 	
				$Hasil[] = ['id_periode' => $request->id_periode, 'tanggal_cuti' => $TglVaru[$i],'ket_cuti_bersama' => $request->ket_cuti, 'created_at' => \Carbon\Carbon::now()];
				}

			$insert = DB::table('c_cuti_bersama')->insert($Hasil);

			 if ($insert) {
			 	// SISA CUTI DI KURANG KARENA PENAMBAHAN POTONGAN CUTI BERSAMA
			 	DB::table('c_cuti')->where('id_periode','=', $request->id_periode)->update(['sisa_cuti'=> DB::raw('sisa_cuti-'.count($Hasil).''), 'update_at' => \Carbon\Carbon::now()]);
			 	return Response::json(array('cek' => 'berhasil','id_form' => $request->id_periode), 200);
			 }else{
			 	return Response::json(array('cek' => 'gagal'), 200);
			 }
			}
		}

	}

	//CEK TANGGAL YANG TELAH DIPILIH
	protected function CekTanggalCutBer($tanggalNya, $id_periode){

		 //CEK TANGGAL YANG TELAH DI PILIH SEBELUMNYA
        $cekBooking = DB::table('c_cuti_bersama')->select('tanggal_cuti')->where('id_periode','=', $id_periode)->get();
 		if(!$cekBooking->isEmpty()){
			foreach ($cekBooking as $ckjh) {
				$CekTang[] = $ckjh->tanggal_cuti;
			}	
        }else{
        		$CekTang = [];
        }
        //menemukan tanggal yang sama saat dipilih
		$found = null;
		$tanggalCutDB = $CekTang;
		$tanggalCutInput = explode(",",implode(",",str_replace(' ', '', $tanggalNya)));
		foreach($tanggalCutDB as $num) {
		    if (in_array($num,$tanggalCutInput)) {
		        $found[] = 'cek';
		    }else{

		    }
		}
		if ($found) {$hy = count($found);}else{$hy = '0';}
		if ($hy > 0) {
			return 'ada';
		}else{
			return 'kosong';
		}

	}

	//CEK ID KATEGORI (PERIODE)
	protected function CekIdPeriode($data_id){
			$DataCek = DB::table('c_cuti_bersama')
			->select('c_periode_cuti.id_kategori')
			->join('c_periode_cuti','c_periode_cuti.id_kategori','=','c_cuti_bersama.id_periode')
			->join('c_cuti','c_cuti.id_periode','=','c_periode_cuti.id_kategori')
			->where('c_cuti_bersama.id_cuti_bersama','=',$data_id)
			->first();
			
			if ($DataCek) {
				$cek = $DataCek->id_kategori;
			}else{
				$cek = '0';
			}
		return $cek;
	}

	//HAPUS CUTI BERSAMA
	public function HapusCutiBersama(Request $request){

		$cbn = $this->CekIdPeriode($request->data_id);

		$delete = DB::table('c_cuti_bersama')->where('id_cuti_bersama', '=', $request->data_id)->delete();
		if ($delete) {
			// SISA CUTI DI TAMBAH KARENA PENAMBAHAN POTONGAN CUTI BERSAMA
			DB::table('c_cuti')->where('id_periode','=', $cbn)->update(['sisa_cuti'=> DB::raw('sisa_cuti+1'), 'update_at' => \Carbon\Carbon::now()]);

			return Response::json(array('cek' => 'berhasil'), 200);
		}else{
			return Response::json(array('cek' => 'gagal'), 200);
		}
	}

	//PROSES UPDATE DATA CUTI BERSAMA
	public function EditCutiBersamaPros(Request $request){

		$update = DB::table('c_cuti_bersama')->where('id_cuti_bersama','=', $request->data_id)->update(['tanggal_cuti' => $request->tanggal_cuti ,'ket_cuti_bersama' => $request->ketcuti,'updated_at' => \Carbon\Carbon::now()]);
		if ($update) {
			return Response::json(array('cek' => 'berhasil'), 200);
		}else{
			return Response::json(array('cek' => 'gagal'), 200);
		}

	}


	//TAMBAH PEGAWAI CUTI / HAKCUTI
	public function TamPegCuti(Request $request){

		$dataPeg = DB::table('pegawai')->select('id_pegawai','nama_karyawan')
    				->where('status_aktif','=','Aktif')->get();

    	$DataCutBer = DB::table('c_cuti_bersama')
    				->join('c_periode_cuti','c_periode_cuti.id_kategori','=','c_cuti_bersama.id_periode')
    				->where('c_periode_cuti.id_kategori','=',$request->periode)
    				->count();

    	$jk = $request->hakcuti - $DataCutBer;
    	if ($jk < 0) {$sisatcuti = '0';}else{$sisatcuti = $jk;}

    	//UNTUK MULTIPLE PEGAWAI
    	if ($request->pegawaiall) {
    		foreach ($dataPeg as $key => $value) {
    			if ($this->cekExitPegawaiCuti($request->periode, $value->id_pegawai) > 0) {
    				continue;
    			}else{
    				$DataNya[] = ['id_pegawai' => $value->id_pegawai, 'id_periode' => $request->periode , 'hak_cuti' => $request->hakcuti, 'sisa_cuti' => $sisatcuti,'created_at' => \Carbon\Carbon::now(), 'tahun' => date('Y',strtotime(\Carbon\Carbon::now()))];
    			}
    		}
    		if (empty($DataNya) == false) {
    			$CekInsert = DB::table('c_cuti')->insert($DataNya);
    			if ($CekInsert) {
	    			return Response::json(array('cek' => 'Bbanyak'), 200);
	    		}else{
	    			return Response::json(array('cek' => 'Gbanyak'), 200);
	    		}
    		}else{
    			return Response::json(array('cek' => 'full'), 200);
    		}
    		
    	}else{
    		
	    	if ($this->cekExitPegawaiCuti($request->periode, $request->pegawai) > 0) {
	    		return Response::json(array('cek' => 'Pexist'), 200);
	    	}else{
	    		$CekSoloPeg = DB::table('c_cuti')->insert(['id_pegawai' => $request->pegawai,'id_periode' => $request->periode, 'hak_cuti' => $request->hakcuti, 'sisa_cuti' => $sisatcuti, 'created_at' => \Carbon\Carbon::now(), 'tahun' => date('Y',strtotime(\Carbon\Carbon::now()))]);
	    		
	    		if ($CekSoloPeg) {
	    			return Response::json(array('cek' => 'Bsolo'), 200);
	    		}else{
	    			return Response::json(array('cek' => 'Gsolo'), 200);
	    		}
	    	}
    	}
    	
		return Response::json(array('cek' => 'tes'), 200);

	}
	//CEK KETERSEDIAAN PEGAWAI DI DALAM CUTI
	protected function cekExitPegawaiCuti($periode, $peg){
		$CekExits = DB::table('c_cuti')
	    				->where([['id_periode','=',$periode],['id_pegawai','=',$peg]])
	    				->count();

	    return $CekExits;
	}

	//CEK SISA CUTI PEGAWAI
	protected function SisaCuti($id_cuti){
		$cekCuti = DB::table('c_cuti')->select('sisa_cuti')->where('id_cuti','=', $id_cuti)->first();
		return $cekCuti;
	}

	//SIMPAN DATA/TANGGAL PENGAMBILAN CUTI 
	public function SimpanAmbilCuti(Request $request){

		//cek tanggal yang dipilih
		if($this->CekTanggal($request->tanggal_cuti, $request->id_cuti) == 'ada'){
			return Response::json(array('cek' => 'TglSudahAda'), 200);
		}else{
			//cek tanggal cuti / required dari tanggal cuti
			if ($request->tanggal_cuti == [null]) {
			return Response::json(array('cek' => 'tglkosong'), 200);
			}else{

				//CEK SISA CUTI
				if ($this->SisaCuti($request->id_cuti)->sisa_cuti <= 0) {
					return Response::json(array('cek' => 'cutihabis'), 200);
				}else{

					$cekToString = implode(",",$request->tanggal_cuti);
					$TglVaru = explode(",",$cekToString);

					//CEK SISA CUTI
					if ($this->SisaCuti($request->id_cuti)->sisa_cuti < count($TglVaru)) {
						return Response::json(array('cek' => 'SisaCutLebihSikit'), 200);
					}else{

						//pengurangan cuti
						$PotongCuti = $this->SisaCuti($request->id_cuti)->sisa_cuti - count($TglVaru);;

						for ($i=0; $i < count($TglVaru); $i++) { 	
							$Hasil[] = ['id_cuti' => $request->id_cuti, 'ambil_cuti' => $TglVaru[$i],'ket_cuti' => $request->ket_cuti, 'created_at' => \Carbon\Carbon::now()];
							//HISTORY
							$this->historiCuti($request->id_cuti, Auth::id(),$TglVaru[$i],'Ambil Cuti', $request->ket_cuti,$request->ip(),request()->getHttpHost(), \Carbon\Carbon::now());
				 		}
						$insert = DB::table('c_detail_cuti')->insert($Hasil);
						

						if ($insert) {
							$update = DB::table('c_cuti')->where('id_cuti','=', $request->id_cuti)->update(['sisa_cuti' => $PotongCuti, 'update_at' => \Carbon\Carbon::now()]);

						 	return Response::json(array('cek' => 'berhasil'), 200);
						}else{
						 	return Response::json(array('cek' => 'gagal'), 200);
						}
					}
				}
			}
		}
		
	}

	//CEK TANGGAL YANG TELAH DIPILIH
	protected function CekTanggal($tanggalNya, $id_cuti){

		 //CEK TANGGAL YANG TELAH DI PILIH SEBELUMNYA
        $cekBooking = DB::table('c_detail_cuti')->select('ambil_cuti')->where('id_cuti','=', $id_cuti)->get();
 		if(!$cekBooking->isEmpty()){
			foreach ($cekBooking as $ckjh) {
				$CekTang[] = $ckjh->ambil_cuti;
			}	
        }else{
        		$CekTang = [];
        }
        //menemukan tanggal yang sama saat dipilih
		$found = null;
		$tanggalCutDB = $CekTang;
		$tanggalCutInput = explode(",",implode(",",str_replace(' ', '', $tanggalNya)));
		foreach($tanggalCutDB as $num) {
		    if (in_array($num,$tanggalCutInput)) {
		        $found[] = 'cek';
		    }else{

		    }
		}
		if ($found) {$hy = count($found);}else{$hy = '0';}
		if ($hy > 0) {
			return 'ada';
		}else{
			return 'kosong';
		}

	}


	//HAPUS PENGAMBILAN CUTI
	public function HapusPengCuti(Request $request){
		
		//cek id_cutinya
		$cekDb = DB::table('c_detail_cuti')->select('id_cuti','ambil_cuti')->where('id_set_cuti','=', $request->data_id)->first();
		//hapus data cuti yang diambil
		$delete = DB::table('c_detail_cuti')->where('id_set_cuti', '=', $request->data_id)->delete();

		if ($delete) {

			$update = DB::table('c_cuti')->where('id_cuti','=', $cekDb->id_cuti)->update(['sisa_cuti'=> DB::raw('sisa_cuti+1'), 'update_at' => \Carbon\Carbon::now()]);

			$this->historiCuti($cekDb->id_cuti, Auth::id(),$cekDb->ambil_cuti,'Hapus Cuti', 'Hapus Pengambilan Cuti',$request->ip(),request()->getHttpHost(), \Carbon\Carbon::now());

			return Response::json(array('cek' => 'berhasil'), 200);
		}else{
			return Response::json(array('cek' => 'gagal'), 200);
		}

	}

	// //CEK KETERSEDIAAN CUTI SALAH SATU PEGAWAI
	protected function CekSediaCuti($id_cuti){
		$cekData = DB::table('c_detail_cuti')->where('id_cuti','=',$id_cuti)->count();
		if ($cekData <= 0) {
			return 'no';
		}else{
			return 'yes';
		}
	}

	//UPLOAD FILE PENGAMBILAN CUTI 
	public function UploadPengambilanCuti(Request $request){

		if ($this->CekSediaCuti($request->id_cuti) == 'no') {
			return Response::json(array('cek' => 'Kosongg'), 200);
		}else{

			if ($request->PilTang) {
			}else{
				return Response::json(array('cek' => 'TglNo'), 200);
			}

			for ($i=0; $i < count($request->PilTang); $i++) { 
				$CheckSudah = DB::table('c_detail_cuti')->select('ambil_cuti','id_bukti')->where('id_set_cuti','=', $request->PilTang[$i])->first();
				if ($CheckSudah->id_bukti) {
					return Response::json(array('cek' => 'sudahAda','TglDipilih' => $CheckSudah->ambil_cuti), 200);
				}
			}

		    $validation = Validator::make($request->all(), [
			    'select_file' => 'required|mimes:jpg,jpeg,png,pdf|max:5000',
			]);
		     if($validation->passes())
		     {
		      $image = $request->file('select_file');
		      $sizephoto = $request->file('select_file')->getSize();
		      $new_name = $request->id_cuti.'_'.rand() . '.' . $image->getClientOriginalExtension();

		      $Check = $image->move(public_path('bukticuti'), $new_name);

		      if ($Check) {

		      	$insertPhoto = DB::table('c_bukti')->insert(
				  ['filename' => $new_name, 'filesize' => $sizephoto,'created_at' => \Carbon\Carbon::now()]
				);
		      	$last_id = DB::getPDO()->lastInsertId($insertPhoto);

				for ($i=0; $i < count($request->PilTang); $i++) { 
					$UpdataDetail = DB::table('c_detail_cuti')->where('id_set_cuti','=',$request->PilTang[$i])->update(
					  ['id_bukti' => $last_id, 'updated_at' => \Carbon\Carbon::now()]
					);
				}
			  	return Response::json(array('cek' => 'berhasil'), 200);
		      }
		     }
		     else{
		     	return Response::json(array('cek' => 'gagal'), 200);
		     }

		}

    }

    public function GetDataCutEdit(Request $request){

	    //CEK TANGGAL YANG TELAH DI PILIH SEBELUMNYA
        $cekBooking = DB::table('c_detail_cuti')->select('ambil_cuti')->where('id_cuti','=', $request->id_cuti)->get();
        if (!$cekBooking->isEmpty()) {
        	 foreach ($cekBooking as $ckjh) {
	        	$CekTang[] = $ckjh->ambil_cuti;
	        }
        }else{
        	$CekTang = '';
        }
       
    	//cek id_cutinya
		$cekDb = DB::table('c_detail_cuti')
		->select('c_detail_cuti.id_cuti','c_detail_cuti.id_bukti','c_detail_cuti.ambil_cuti','c_detail_cuti.ket_cuti')
		->where('id_set_cuti','=', $request->data_id)->latest()->first();

    	return Response::json(array('ket_cuti' => $cekDb->ket_cuti,'tanggal' => $cekDb->ambil_cuti), 200);

    }

    //UPDATE DATA CUTI/PENGAMBILAN CUTI
    public function UpdateCutiPros(Request $request){
    	$UpdataDetail = DB::table('c_detail_cuti')->where('id_set_cuti','=',$request->id_set_cuti)->update(
				  ['ambil_cuti' => $request->tanggal_cuti, 'ket_cuti' => $request->ket_cuti, 'updated_at' => \Carbon\Carbon::now()]
				);
    	if ($UpdataDetail) {
    		//cek id_cutinya
			$cekDb = DB::table('c_detail_cuti')->select('id_cuti')->where('id_set_cuti','=', $request->id_set_cuti)->first();
    		$this->historiCuti($cekDb->id_cuti, Auth::id(),$request->tanggal_cuti,'Ubah Cuti', $request->ket_cuti,$request->ip(),request()->getHttpHost(), \Carbon\Carbon::now());

    		return Response::json(array('cek' =>'berhasil'), 200);
    	}else{
    		return Response::json(array('cek' =>'gagal'), 200);
    	}
    }

    //EXPORT EXCEL CUTI
    public function ExportCutiInfo($id){

    	if ($this->cek_akses('105') == 'yes') {
    		
    		if ($id) {
	    		$CheckData = DB::table('c_cuti')
				->join('pegawai','pegawai.id_pegawai','=','c_cuti.id_pegawai')
				->join('c_periode_cuti','c_periode_cuti.id_kategori','=','c_cuti.id_periode')
				->select('c_cuti.hak_cuti','c_cuti.id_cuti','c_cuti.sisa_cuti','c_cuti.tahun','pegawai.nama_karyawan','pegawai.tmk','c_periode_cuti.periode_awal','c_periode_cuti.id_kategori','c_periode_cuti.periode_akhir')
				->orderBy('pegawai.nama_karyawan','ASC')
				->where('c_periode_cuti.id_kategori','=',$id)->get();

				return view('admin.dashboard.CutiPegawai.export',['CekData' => $CheckData ,'id_periode' => $id]);
	    	}else{
	    		return redirect()->back()->with('error', 'Anda Tidak Memilih Tanggal');   
	    	}

    	}else{
    		return Response::json(array('Error' => true), 500);
    	}


    	
    }

    //UPDATE POST TMK VIA CUTI PEGAWAI
    public function UpdateTmkViaCuti(Request $request){

    	if ($this->cek_akses('109') == 'yes') {
    		$UpdataDetail = DB::table('pegawai')->where('id_pegawai','=',$request->id_pegawai)->update(
				  ['tmk' => $request->TangglTmk, 'updated_at' => \Carbon\Carbon::now()]
				);
	    	if ($UpdataDetail) {
	    		return Response::json(array('cek' =>'berhasil'), 200);
	    	}else{
	    		return Response::json(array('cek' =>'gagal'), 200);
	    	}
    	}else{
    			return Response::json(array('cek' =>'noakses'), 200);
    	}

    	

    }

    //HAPUS KARYAWAN DARI CUTI LIST
    public function HapusKarFromCut(Request $request){
    	$CekExist = DB::table('c_detail_cuti')->where('id_cuti','=', $request->data_id)->count();
    	if ($CekExist > 0) {
    		return Response::json(array('cek' =>'Exits'), 200);
    	}else{
    		$delete = DB::table('c_cuti')->where('id_cuti', '=', $request->data_id)->delete();
    		if ($delete) {
    			return Response::json(array('cek' =>'berhasil'), 200);
    		}else{
    			return Response::json(array('cek' =>'gagal'), 200);
    		}
    	}
    }

    //POST UBAH DATA KARYAWAN CUTI
    public function SubmitUbahDatKaryCut(Request $request){

    	$UpdataDetail = DB::table('c_cuti')->where('id_cuti','=',$request->id_cuti)->update(
				  ['hak_cuti' => $request->hak_cuti, 'sisa_cuti' => $request->sisa_cuti]
				);
    	if ($UpdataDetail) {
    		return Response::json(array('cek' =>'berhasil'), 200);
    	}else{
    		return Response::json(array('cek' =>'gagal'), 200);
    	}

    }


    //UNTUK HISTORY
    protected function historiCuti($id_cuti, $id_user,$tanggal,$jenis, $ket, $get_ip,$get_host, $waktu){
    	$InsertHis = DB::table('c_history_cuti')->insert(['id_cuti' => $id_cuti, 'id_user' => $id_user,'tanggal_aksi' => $tanggal,'jenis' => $jenis, 'keterangan' => $ket, 'get_ip' => $get_ip, 'get_host' => $get_host, 'created_at' => \Carbon\Carbon::now()]);
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
