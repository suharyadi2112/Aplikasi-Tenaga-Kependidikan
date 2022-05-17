<?php

namespace App\Http\Controllers\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\level as Level;
use App\Pegawai as Pegawai;
use App\Jabatan as jabatan;
use DataTables;
use DB;
use Validator;
use Response;
use Redirect;
use Alert;
use Auth;
use Session;
use File;

class PegawaiController_20 extends Controller
{		

	//TAMBAH BERKAS FILE PEGAWAI 
	public function TambahBerkasFilev(Request $request){


		$ktp_upload = $request->file('ktp');
		$npwp_upload = $request->file('npwp');
		$kk_upload = $request->file('kk');
		$bpjs_keten_upload = $request->file('bpjs_ketenagakerjaan');
		$bpjs_kesehatan_upload = $request->file('bpjs_kesehatan');
		$sim_upload = $request->file('sim');
		$ijazah_upload = $request->file('ijazah');
		$transkrip_upload = $request->file('transkrip');

		$ijazahs1_upload = $request->file('ijazahs1');
		$ijazahs2_upload = $request->file('transkrips1');
		$ijazahs3_upload = $request->file('ijazahs2');
		$transkrips1_upload = $request->file('transkrips2');
		$transkrips2_upload = $request->file('ijazahs3');
		$transkrips3_upload = $request->file('transkrips3');

		$CekArrayFile = array($ktp_upload,$npwp_upload,$kk_upload,$bpjs_keten_upload,$bpjs_kesehatan_upload,$sim_upload,$ijazah_upload,$transkrip_upload,$ijazahs1_upload,$transkrips1_upload,$ijazahs2_upload,$transkrips2_upload,$ijazahs3_upload,$transkrips3_upload);


		$UrutanNama = array('0' => 'ktp','1' => 'npwp','2' => 'kk', '3' => 'bpjs_ketenagakerjaan', '4' => 'bpjs_kesehatan','5' => 'sim','6' => 'ijazah','7' => 'transkrip','8' => 'ijazahs1','9' => 'transkrips1','10' => 'ijazahs2','11' => 'transkrips2','12' => 'ijazahs3','13' => 'transkrips3');


		if(empty(array_filter($CekArrayFile)) == true){
			return Redirect::back()->with('warningMessage', 'Gagal Upload, Pilih minimal 1 file');
		}else{

			$HasilSeleksiNull = array_filter($CekArrayFile, function($v){ 
				 return !is_null($v) && $v !== ''; 
				});

			$CekValue = array_values($HasilSeleksiNull);

			for ($i=0; $i < count($HasilSeleksiNull); $i++) { 

					if (!is_null($CekValue[$i])) {
						$sizephoto = $CekValue[$i]->getSize();
						$new_name = Auth::user()->id.'_'.$UrutanNama[$i] . '.' . $CekValue[$i]->getClientOriginalExtension();
						$ext = $CekValue[$i]->getClientOriginalExtension();
						$jenis_berkas = $UrutanNama[$i];

						if ($sizephoto > 20971520) {
							return Redirect::back()->with('warningMessage', 'File '.$UrutanNama[$i].' lebih dari 20 mb');
						}

						if ($this->CekSediaBerkasDataDiri($UrutanNama[$i], Auth::user()->id) == 'yes') {
							return Redirect::back()->with('warningMessage', ''.$UrutanNama[$i].' Sudah Ada');
						}


						if ($ext!== "PDF" && $ext!== "pdf" && $ext!== "zip" && $ext!== "ZIP" && $ext!== "rar" && $ext!== "RAR" && $ext!== "jpg" && $ext!== "jpeg" && $ext!== "RAR" && $ext!== "png" && $ext!== "PNG" ) {
				    		
				    		return Redirect::back()->with('warningMessage', 'Extention File Tidak Diizinkan');

				    	}else{

				    		$path = public_path().'/berkas_data_diri/'.Auth::user()->id;

								if(!File::isDirectory($path)){
								  Storage::makeDirectory($path, $mode = 0711, true, true);
								}
								if(File::isDirectory("$path/".$new_name)==false){
								    if (file_exists($path.'/'.$new_name)) {
								      return Redirect::back()->with('warningMessage', 'FILE SUDAH ADA');
								      die;
								    }
								  	$Check = $CekValue[$i]->move($path, $new_name);
										if ($Check) { 	

					      			$dataInsert[] = ['id_user' => Auth::user()->id, 'jenis_berkas' => $jenis_berkas, 'nama_file' => $new_name, 'type_file' =>  $ext, 'size_file' => $sizephoto, 'created_at' => \Carbon\Carbon::now()];
											
											
					      		}

								}else{                
								   return Redirect::back()->with('warningMessage', 'Terjadi Kesalahan #34kh2sd');
								}
				    }

					}
				}
		}

		$insert = DB::table('b_berkas_data_diri')->insert($dataInsert);

		if ($insert) {
			 return Redirect::back()->with('successMessage', 'Berhasil memproses berkas');
		}else{
			 return Redirect::back()->with('warningMessage', 'Terjadi kesalahan #lk34j3456');
		}


	}
	protected function CekSediaBerkasDataDiri($jenis_berkas, $id_user){
		$Data = DB::table('b_berkas_data_diri')->where([['id_user','=',$id_user],['jenis_berkas','=',$jenis_berkas]])->first();
		if (!is_null($Data)) {
			return 'yes';
		}else{
			return 'no';
		}
	}

	//HAPUS BERKAS
	public function HapusBerkasPegawaiAdmin($id_file){

		$Data = DB::table('b_berkas_data_diri')->select('*')->where('id','=',$id_file)->first();

		if (file_exists($this->PathBerkasDataDiri($Data->id_user, $Data->nama_file))) {
			$Cekks = File::delete($this->PathBerkasDataDiri($Data->id_user, $Data->nama_file));
			if ($Cekks) {
				DB::table('b_berkas_data_diri')->where('id', '=', $id_file)->delete();
				return Response::json(array( 'HasilCeks' => '001' ), 200);
			}else{
				//gagal menghapus file
				return Response::json(array( 'HasilCeks' => '002' ), 200);
			}
		}else{
			//file tidak ada
			return Response::json(array( 'HasilCeks' => '003' ), 200);
		}
	}
	//PATH BERKAS DATA DIRI
	protected function PathBerkasDataDiri($id_user, $nama_file){
	  $path = public_path().'/berkas_data_diri/'.$id_user.'/'.$nama_file;
	  return $path;
	}

	public function HapusKonDar($id){
		try {
			DB::table('b_kontak_darurat')->where('id_kontak_darurat', '=', $id)->delete();
		    return Redirect::back()->with('success', 'Berhasil Menghapus Data');
		} catch (Exception $e) {
			return Redirect::back()->with('error', 'Gagal Menghapus Data');
		}
	}

	public function TambahKontakDarurat(Request $request)
	{
	    try {
			$kontaknew[] = [	'id_user' =>$request->id_user,
							   	'nama_kd' => $request->nama_nodarurat,
							   	'hubungan_kd' => $request->hubungan_nodarurat,
							   	'nomor_telepon_kd' => $request->nomor_darurat,
							   	'kota_kd' => $request->kota_nodarurat,
									
								'created_at' => \Carbon\Carbon::now()
							    ];

			DB::table('b_kontak_darurat')->insert($kontaknew);
			return Redirect::back()->with('success', 'Berhasil Menambah Kontak Darurat');

		} catch (Exception $e) {
			return Redirect::back()->with('error', 'Gagal Menambah Kontak Darurat');
		}
	}

	public function EditAnakMarital(Request $request)
	{
		try {
			DB::table('b_marital')
				->where('id_marital' ,'=', $request->id_anak)
		      	->update([
							'nama_anak' => $request->nama_anak,
	  						'ttl_anak' => $request->ttl_anak,
	  						'jenis_kelamin_anak' => $request->jenis_kelamin_anak,
							'updated_at' => \Carbon\Carbon::now()]);

		      	return Redirect::back()->with('success', 'Berhasil Mengubah Data');
		} catch (Exception $e) {
				return Redirect::back()->with('error', 'Gagal Mengubah Data');
		}
	}

	public function TambahAnakMaritalPegawai(Request $request)
	{
		try {
			$answer_anaknew[] = [	
									'id_user' => $request->id_user,
									'nama_anak' => $request->nama_anak,
									'ttl_anak' => $request->ttl_anak,
									'jenis_kelamin_anak' => $request->jenis_kelamin_anak,
								
									'created_at' => \Carbon\Carbon::now()
							    ];

			DB::table('b_marital')->insert($answer_anaknew);
			return Redirect::back()->with('success', 'Berhasil Menambah Data Anak');

		} catch (Exception $e) {
			return Redirect::back()->with('error', 'Gagal Menambah Data');
		}
	}

	public function HapusMaritalPasangan($id_user)
	{	
		try {
			DB::table('b_marital_pasangan')->where('id_maritalpasangan', '=', $id_user)->delete();
		    return Redirect::back()->with('success', 'Berhasil Menghapus Data');
		} catch (Exception $e) {
			return Redirect::back()->with('error', 'Gagal Menghapus Data');
		}	    
	}

	public function TambahMaritalPasangan(Request $request){

		try {
			$InsertMarital = DB::table('b_marital_pasangan')
					      	->insert([	
					      				'id_user' => $request->id_user,
										'nama_pasangan' => $request->nama_pasangan,
				  						'pekerjaan_pasangan' => $request->pekerjaan_pasangan,
				  						'nomor_telepon_pasangan' => $request->nomor_telepon_pasangan,
										'created_at' => \Carbon\Carbon::now()]);

					      	return Redirect::back()->with('success', 'Berhasil Menambah Data');

			$UpdateStatus = DB::table('b_data_diri')
				            ->where('id_user','=', $request->id_user)
				            ->update(['status_marital' => 'Menikah']);
		} catch (Exception $e) {
				return Redirect::back()->with('error', 'Gagal Menambah Data');
		}

	}

	//TAMBAH PERGURUAN TINGGI
	public function TambahPertingPeg(Request $request) {

		try {
			$answers_pertingnew[] = [	

									'id_user' => $request->id_user,
			        				'nama_sekolah_perting' => $request->nama_sekolah_perting,
			  						'tingkat' => $request->tingkat_perting,
			  						'program_studi' => $request->jurusan_perting,
			  						'ipk' => $request->ipk_perting,
			  						'mulai_pendidikan' => $request->mulai_pendidikan_perting,
			  						'selesai_pendidikan' => $request->selesai_pendidikan_perting,
								
									'created_at' => \Carbon\Carbon::now()
							    ];

			DB::table('b_perguruan_tinggi')->insert($answers_pertingnew);
			return Redirect::back()->with('success', 'Berhasil Menambah Data Perguruan Tinggi');

		} catch (Exception $e) {
			return Redirect::back()->with('error', 'Terjadi Kesalahan Dalam Memproses Data');
		}
	}

	public function TambahSmaSederajat(Request $request){

		$jml = DB::table('b_sma_sederajat')->where('id_user','=',$request->id_user)->count();

		if ($jml > 0) {
			return Redirect::back()->with('error', 'Hanya boleh memasukan 1 SMA/Sederajat');
		}else{
			DB::table('b_sma_sederajat')->insert(
			    ['id_user' => $request->id_user, 'nama_sekolah' => $request->nama_sekolah,'jurusan' => $request->jurusan,'mulai_pendidikan' => $request->mulai_pendidikan,'selesai_pendidikan' => $request->selesai_pendidikan]
			);
			return Redirect::back()->with('success', 'Berhasil Menambahkan SMA');
		}
	}

	public function EditIdentitasDataPegawai(Request $request,$id_user){
		try {
			if (is_null($request->iden) == false) {	
				for ($z = 0; $z < count($request->input('iden')); $z++) {

					if (is_null($request->iden[$z])) {
								continue;
						    }
				    $answers_newiden[] = [
							'jenis' => $request->input('iden')[$z],
							'id_user' => $id_user,
						  	'created_at' => \Carbon\Carbon::now()
					    ];
				    }
			}

				try {
					DB::table('b_identitas_lainnya')->where('id_user', '=', $id_user)->delete();
					} catch (Exception $e) {
					return Response::json(array(
				                'success' => false,
				                'errors' => 'gagal #lk54345',
				            ), 400);
				}

			if (is_null($request->iden) == false) {		
				DB::table('b_identitas_lainnya')->insert($answers_newiden);
			}
			return Response::json(array(
		                'success' => 'Berhasil',
		                'errors' => false,

		            ), 200);

		} catch (Exception $e) {

			return Response::json(array(
		                'success' => false,
		                'errors' => 'gagal #p34',

		            ), 400);
		}
	}

	public function DataDiriPegawai(Request $request, $id_user){

       	$CekDataDiri = DB::table('b_data_diri')->where('id_user','=',$id_user)->count();
        $nm_peg = DB::table('pegawai')->where('id_user','=',$id_user)->select('nama_karyawan')->first();

        if ($CekDataDiri > 0) {
        }else{

			return Redirect::back()->with('kosong','User '.$nm_peg->nama_karyawan.' Belum Memiliki Data Diri')->with('cek_id',''.$id_user.'');

	     }

		$ListPegawai = DB::table('pegawai')->select('id_user','id_pegawai','nama_karyawan')->where('id_user','!=',null)->get();

		$Ddiri = DB::table('b_data_diri')
        ->join('provinsi','b_data_diri.provinsi_lahir','=','provinsi.id_prov')
        ->join('kabupaten','b_data_diri.kota_lahir','=','kabupaten.id_kab')
        ->select('b_data_diri.*','provinsi.nama','kabupaten.nama_kab')
        ->where('b_data_diri.id_user','=',$id_user)
        ->first();

        $kontak_darurat =  DB::table('b_kontak_darurat')
        ->select('*')
        ->where('id_user','=',$id_user)
        ->get();


        $identitas_lainnya =  DB::table('b_identitas_lainnya')
        ->select('*')
        ->where('id_user','=',$id_user)
        ->get();

        $marital =  DB::table('b_marital')
        ->select('*')
        ->where('id_user','=',$id_user)
        ->get();

        $maritalpasangan =  DB::table('b_marital_pasangan')
        ->select('*')
        ->where('id_user','=',$id_user)
        ->get();

        $sma = DB::table('b_sma_sederajat')
        ->select('*')
        ->where('b_sma_sederajat.id_user','=',$id_user)
        ->get();

        $perting = DB::table('b_perguruan_tinggi')
        ->select('*')
        ->where('b_perguruan_tinggi.id_user','=',$id_user)
        ->get();

        $list_provinsi = DB::table('provinsi')->select('*')->get();
        
        return view('admin.dashboard.pegawai.DataDiriPegawai',['Ddiri' => $Ddiri,  'iden' => $identitas_lainnya, 'marital' => $marital, 'maritalpasangan' => $maritalpasangan,'sma' => $sma, 'perting' => $perting, 'list_provinsi' => $list_provinsi, 'id_user' => $id_user,'kontak_darurat' => $kontak_darurat,'list_pegawai' => $ListPegawai]);

	}

    public function PegawaiAddDataDiri($id_user){

    	$nm_kar = DB::table('pegawai')->select('nama_karyawan')->where('id_user','=',$id_user)->first();

    	$list_provinsi = DB::table('provinsi')->select('*')->get();
    	$list_jab_pendidik = DB::table('b_set_jabatan')->select('id_set_jabatan','nama_jabatan')->where('kategori','=','Pendidik')->get();

    	$list_jab_t_kependidikan = DB::table('b_set_jabatan')->select('id_set_jabatan','nama_jabatan')->where('kategori','=','Tenaga Kependidikan')->get();

    	return view('admin.dashboard.pegawai.TambahDataDiriPegawai',['list_provinsi' => $list_provinsi,'list_jab_pendidik' => $list_jab_pendidik,'list_jab_t_kependidikan' => $list_jab_t_kependidikan,'id_user' => $id_user,'nama_karyawan' => $nm_kar->nama_karyawan]);
    }

    public function PegawaiProsesSimpanData(Request $request) {
    

	if (is_null($request->nama_nodarurat) == false) {	

			for ($kd = 0; $kd < count($request->input('nama_nodarurat')); $kd++) {
				if (is_null($request->nama_nodarurat[$kd])) {
						continue;
				    }else{
			        $answer_kontakdarurat[] = [
	        				'id_user' => $request->id_user,
						   	'nama_kd' => $request->nama_nodarurat[$kd],
						   	'hubungan_kd' => $request->hubungan_nodarurat[$kd],
						   	'nomor_telepon_kd' => $request->nomor_darurat[$kd],
						   	'kota_kd' => $request->kota_nodarurat[$kd],
								
							'created_at' => \Carbon\Carbon::now()
					    ];
				    }
				    DB::table('b_kontak_darurat')->insert($answer_kontakdarurat);
				}
		}


    $c_datadiri = DB::table('b_data_diri')->where('id_user','=',$request->id_user)->count();

		if ($c_datadiri > 0) {
				 return Response::json(array(
                'success' => 'duplicat',
                'errors' => false,

            ), 200);
		}
		try {

			if ($request->ikrarvege == 'Ikrar') {
				$ikrartahun_vege = $request->ikrartahun;
				$ikrarvege = $request->ikrarvege;
			}else{
				$ikrartahun_vege = null;
				$ikrarvege = $request->ikrarvege;
			}

			if ($request->QiuDao == 'Iya') {
				$QiuDao = $request->QiuDao;
				$detailqiudao = $request->detailqiudao;
			}else{
				$detailqiudao = null;
				$QiuDao = $request->QiuDao;
			}

		   	if (is_null($request->nama_lengkap) == false) {
			//INSERT DATADIRI	
			$answer_datadiri[]	=	['id_user' => $request->id_user,
								   	'agama' => $request->agama ,
									'alamat_sekarang' => $request->alamat_sekarang ,
									'durasi_ktp' => $request->durasi_ktp ,
									'email' => $request->email ,
									'golongan_darah' => $request->golongan_darah ,
									'jenis_kelamin' => $request->jenis_kelamin ,
									'kota_lahir' => $request->kota_lahir ,
									'nama_lengkap' => $request->nama_lengkap ,
									'nama_mandarin' => $request->nama_mandarin ,
									'nomor_ktp' => $request->nomor_ktp ,
									'nomor_npwp' => $request->nomor_npwp ,
									'nomor_telepon' => $request->nomor_telepon ,
									'nomor_telepon_2' => $request->nomor_telepon_2 ,
									'nomor_wa'=> $request->nomor_wa ,
									'provinsi_lahir' => $request->provinsi_lahir ,
									'status_marital' => $request->status_marital ,
									'status_tempat_tinggal' => $request->status_tempat_tinggal ,
									'tanggal_lahir' => $request->tanggal_lahir, 
									'vege' => $ikrarvege, 
									'ikrartahun_vege' => $ikrartahun_vege, 
									'qiudao' => $QiuDao, 
									'jenis_qiudao' => $detailqiudao, 
									'suku' => $request->suku, 
									'created_at' => \Carbon\Carbon::now()];
			}

			if (is_null($request->jenis_iden) == false) {										
			//INSERT JENIS IDENTITAS
			for ($i = 0; $i < count($request->input('jenis_iden')); $i++) {

						        $answers_iden[] = [
				        				'jenis' => $request->input('jenis_iden')[$i],
										'id_user' => $request->id_user,
									  	'created_at' => \Carbon\Carbon::now()
								    ];
							    }
			}



			if (is_null($request->nama_anak) == false) {

				for ($a = 0; $a < count($request->input('nama_anak')); $a++) {

			        $answers_marital[] = [
	        				'nama_anak' => $request->input('nama_anak')[$a],
	        				'ttl_anak' => $request->input('ttl_anak')[$a],
	        				'jenis_kelamin_anak' => $request->input('jenis_kelamin_anak')[$a],
							'id_user' => $request->id_user,
						  	'created_at' => \Carbon\Carbon::now()
					    ];
				    }
			}

			if ($request->status_marital == 'Menikah') {

		        $answers_maritalpasangan[] = [
        				'nama_pasangan' => $request->input('nama_pasangan'),
        				'pekerjaan_pasangan' => $request->input('pekerjaan_pasangan'),
        				'nomor_telepon_pasangan' => $request->input('nomor_telepon_pasangan'),
						'id_user' => $request->id_user,
					  	'created_at' => \Carbon\Carbon::now()
				    ];
			}

			if (is_null($request->nama_nodarurat) == false) {	
	
				for ($kd = 0; $kd < count($request->input('nama_nodarurat')); $kd++) {
					if (is_null($request->nama_nodarurat[$kd])) {
							continue;
					    }
				        $answer_kontakdarurat[] = [
		        				'id_user' => $request->id_user,
							   	'nama_kd' => $request->nama_nodarurat[$kd],
							   	'hubungan_kd' => $request->hubungan_nodarurat[$kd],
							   	'nomor_telepon_kd' => $request->nomor_darurat[$kd],
							   	'kota_kd' => $request->kota_nodarurat[$kd],
									
								'created_at' => \Carbon\Carbon::now()
						    ];
					    }
			}


			if (is_null($request->nama_sekolah) == false) {	
			//INSERT PENDIDIKAN SEKOLAH MEMENGAH ATAS(SEDERAJAT)
			$answer_sma[]	=	[
									'id_user' => $request->id_user,
								   	'nama_sekolah' => $request->nama_sekolah,
								   	'jurusan' => $request->jurusan,
								   	'mulai_pendidikan' => $request->mulai_pendidikan,
								   	'selesai_pendidikan' => $request->selesai_pendidikan,
										
									'created_at' => \Carbon\Carbon::now()
									];
			}

			if (is_null($request->nama_sekolah_perting) == false) {						
			//INSERT PENDIDIKAN PERGURUAN TINGGI
			for ($b = 0; $b < count($request->input('nama_sekolah_perting')); $b++) {

						        $answers_perting[] = [
				        				'id_user' => $request->id_user,
				        				'nama_sekolah_perting' => $request->input('nama_sekolah_perting')[$b],
				        				'tingkat' => $request->input('tingkat_perting')[$b],
				        				'program_studi' => $request->input('jurusan_perting')[$b],
				        				'ipk' => $request->input('ipk_perting')[$b],
				        				'mulai_pendidikan' => $request->input('mulai_pendidikan_perting')[$b],
										'selesai_pendidikan' => $request->input('selesai_pendidikan_perting')[$b],
									  	'created_at' => \Carbon\Carbon::now()
								    ];
							    }
			}


			//8 TABEL	
			if (is_null($request->nama_lengkap) == false) {  
				DB::table('b_data_diri')->insert($answer_datadiri);
			}
	
			if (is_null($request->nama_sekolah) == false) {	
				DB::table('b_sma_sederajat')->insert($answer_sma);
			}
			if (is_null($request->jenis_iden) == false) {
				DB::table('b_identitas_lainnya')->insert($answers_iden);
			}
			if (is_null($request->nama_anak) == false) {
			  	DB::table('b_marital')->insert($answers_marital);
			}	
			if ($request->status_marital == 'Menikah') {
				DB::table('b_marital_pasangan')->insert($answers_maritalpasangan);
			}	
			if (is_null($request->nama_sekolah_perting) == false) {
				DB::table('b_perguruan_tinggi')->insert($answers_perting);
			}
			
			return Response::json(array(
                'success' => 'berhasil',
                'errors' => false,

            	), 200);
	    
	    } catch (Exception $e) {
	        return Response::json(array(
                'success' => 'gagal',
                'errors' => false,

            	), 200);
	    	}
		}

}
