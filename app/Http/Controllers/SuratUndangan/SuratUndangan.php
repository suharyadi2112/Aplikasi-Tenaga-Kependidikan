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

class SuratUndangan extends Controller 
{	

    public function CekOptionUDG(Request $request, $id){

        if ($request->jenis == 'srttgs') {
            $cekDosenPenguji = DB::table('a_srt_tgs_pembimbing')
            ->join('a_udg_dp','a_udg_dp.id_udg','=','a_srt_tgs_pembimbing.id_udg')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'a_udg_dp.id_dosen') 
            ->select('a_udg_dp.*','pegawai.*','a_srt_tgs_pembimbing.bentuk_mbkm')
            ->where([
                ['a_srt_tgs_pembimbing.id','=',$request->id],
                ['a_udg_dp.kategori_dosen','=','Penguji']
            ])
            ->orderBy('a_udg_dp.id','ASC')
            ->get();

            $cekMBKM = DB::table('a_srt_tgs_pembimbing')
            ->select('a_srt_tgs_pembimbing.bentuk_mbkm','a_srt_tgs_pembimbing.no_surat')
            ->where( 'a_srt_tgs_pembimbing.id','=',$request->id)
            ->first();

            if (!is_null($cekMBKM->bentuk_mbkm)) {
                return 'Ini Setup MBKM, No Surat | '.$cekMBKM->no_surat;
            }

            if ($cekDosenPenguji->isEmpty()) {
                return '<span class="badge badge-pill badge-danger">Bukan Surat Tugas Penguji / Penguji Tidak Ditemukan</span>';
            }
            
        }else if ($request->jenis == 'srttgsudg') {
            $cekDosenPenguji =  DB::table('a_udg_dp')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'a_udg_dp.id_dosen') 
            ->select('a_udg_dp.*','pegawai.*')
            ->where([
                ['id_udg','=',$request->id],
                ['a_udg_dp.kategori_dosen','=','Penguji']
            ])
            ->orderBy('a_udg_dp.id','ASC')
            ->get();
        }else{
            return 'Tidak Ada Data';
        }

        $no = 1;
        $jml = 0;
        $cekdos = '';
        $cekdos .='<table style="border-collapse: collapse; width: 100%;" border="0" class="table table-sm">
                    <thead>
                        <tr>
                            <th style="vertical-align:middle; text-align:center;">No</th>
                            <th style="vertical-align:middle; ">Nama</th>
                            <th style="vertical-align:middle; ">Tukar ?</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach($cekDosenPenguji as $key => $valdos){
            $cekdos .= '<tr>
                            <td style="width: 4.24451%; font-size: 11.0pt; font-family: Arial, sans-serif; text-align:center;">'.$no.'</td>
                            <td style="width: 62.4221%; font-size: 11.0pt; font-family: Arial, sans-serif; line-height: 150%;  ">
                            '.$valdos->nama_karyawan.' ';
            $cekdos .= ($key == 0) ? '(Ketua)' : (($key == 1) ? '(Pembimbing)' : '(Anggota)');
            $cekdos .= '</td>
                        <td nowrap>
                           <div class="form-group clearfix">
                              <div class="icheck-success d-inline">
                                <input type="radio" id="fsdf'.$key.'" value="(Ketua)" name="r1'.$key.'"
                                '.(($key == 0)?'checked':"").'>
                                <label for="fsdf'.$key.'">
                                </label>
                              </div>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="dfsfr'.$key.'" value="(Pembimbing)" name="r1'.$key.'"
                                '.(($key == 1)?'checked':"").'>
                                <label for="dfsfr'.$key.'">
                                </label>
                              </div>
                              <div class="icheck-warning d-inline">
                                <input type="radio" id="tewr'.$key.'" value="(Anggota)" name="r1'.$key.'"
                                '.(($key != 0 && $key != 1)?'checked':"").'>
                                <label for="tewr'.$key.'">
                                </label>
                              </div>
                            </div>
                        </td>
            </tr>';
            $no++;
            $jml++;
        }

        $cekdos .= '<input type="hidden" value="'.$jml.'" name="jumlahdos">
                    </tbody>
                    </table>
                    <span class="badge badge-pill badge-success">Ketua</span>
                    <span class="badge badge-pill badge-primary">Pembimbing</span>
                    <span class="badge badge-pill badge-warning">Anggota</span>
                    ';

        return $cekdos;

    }

    //lihat administrasi berkas sebelum cetak
    public function showsetupadministrasi($id){

        $cek_prodi = DB::table('a_srt_udg_penguji')
                    ->join('a_prodi', 'a_prodi.id_prodi', '=', 'a_srt_udg_penguji.id_prodi') 
                    ->join('a_berkas_adm', 'a_berkas_adm.id_jenisberkas', '=', 'a_srt_udg_penguji.id_berkas_adm')
                    ->select('a_srt_udg_penguji.*','a_prodi.kode_prodi','a_prodi.nama_prodi','a_berkas_adm.nama_berkas')
                    ->where('a_srt_udg_penguji.id_undangan','=',$id)
                    ->first();


        return view('admin.dashboard.suratundangan.setup_administrasi', ['id' => $id, 'nama_prodi' => $cek_prodi->nama_prodi, 'nm_berkas' => $cek_prodi->nama_berkas ,'kode_prodi' => $this->cek_unsur($cek_prodi->id_berkas_adm),'id_berkas_adm' => $cek_prodi->id_berkas_adm]);

    }
    

    //setup berkas administrasi setiap prodi
    public function cekberkasadministrasi(Request $request){


        
        $cekData =  DB::table('a_srt_udg_penguji')
                    ->join('a_prodi', 'a_prodi.id_prodi', '=', 'a_srt_udg_penguji.id_prodi') 
                    ->join('a_nama_mk', 'a_nama_mk.id_mk', '=', 'a_srt_udg_penguji.id_nama_mk') 
                    ->join('a_tbl_mhs', 'a_tbl_mhs.id_mhs', '=', 'a_srt_udg_penguji.id_mhs') 
                    ->join('a_berkas_adm', 'a_berkas_adm.id_jenisberkas', '=', 'a_srt_udg_penguji.id_berkas_adm') 
                    ->join('a_ruangan', 'a_ruangan.id_ruangan', '=', 'a_srt_udg_penguji.id_ruangan') 

                    ->select(   
                                'a_srt_udg_penguji.id_undangan',
                                'a_srt_udg_penguji.no_surat',
                                'a_srt_udg_penguji.judul', 
                                'a_srt_udg_penguji.tanggal_pelaksanaan', 
                                'a_srt_udg_penguji.jam_mulai', 
                                'a_srt_udg_penguji.jam_selesai', 
                                'a_srt_udg_penguji.lampiran', 
                                'a_srt_udg_penguji.id_berkas_adm', 
                                'a_berkas_adm.nama_berkas', 
                                'a_prodi.nama_prodi',
                                'a_nama_mk.nama_mk',
                                'a_tbl_mhs.nama',
                                'a_tbl_mhs.nim',
                                'a_ruangan.nama_ruangan'
                            )
                    ->where('id_undangan','=',$request->id_undangan)
                    ->first();


        $cekDosenPem =  DB::table('a_udg_dp')
                            ->join('pegawai', 'pegawai.id_pegawai', '=', 'a_udg_dp.id_dosen') 
                            ->select('a_udg_dp.*','pegawai.*')
                            ->where([
                                ['id_udg','=',$request->id_undangan],
                                ['kategori_dosen','=','Pembimbing']
                            ])
                            ->get();

        $cekDosenPen =  DB::table('a_udg_dp')
                            ->join('pegawai', 'pegawai.id_pegawai', '=', 'a_udg_dp.id_dosen') 
                            ->select('a_udg_dp.*','pegawai.*')
                            ->where([
                                ['id_udg','=',$request->id_undangan],
                                ['kategori_dosen','=','Penguji']
                            ])
                            ->get();
        

        if ($request->jenis == 'clp_sm' || $request->jenis == 'clp_v_2_sm') {

            if ($request->jenis == 'clp_sm') {

                return view('admin.dashboard.suratundangan.berkas.SM.adm_ujian_pertunjukan_dan_sidang_lembar_penilaian_TA_SM', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen]);

                die;

            }elseif ($request->jenis == 'clp_v_2_sm') {
                return view('admin.dashboard.suratundangan.berkas.SM.adm_ujian_pertunjukan_dan_sidang_lembar_penilaian_TA_SM_V_2', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen]);

                die;

            }
            

            die;
            
        }elseif(is_null($request->pilihan_jenis)){

                return redirect()->back()->with('gagal', 'Anda tidak memilih apapun'); 

        }
                    
      

        switch ($cekData->id_berkas_adm) {
            //akuntansi proposal tugas akhir
            case '1':
                return view('admin.dashboard.suratundangan.berkas.AK.adm_ujian_proposal_TA_AK', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis]);
                break;
            //akuntansi ujian tugas akhir
            case '2':
                return view('admin.dashboard.suratundangan.berkas.AK.adm_ujian_TA_AK', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis]);
                break;
            //managemen seminar
            case '3':
                return view('admin.dashboard.suratundangan.berkas.MN.adm_seminar_MN', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis]);
                break;
            //managemen ujian tugas akhir
            case '4':
                return view('admin.dashboard.suratundangan.berkas.MN.adm_ujian_TA_MN', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis]);
                break;



            //Pendidikan Bahasa Mandari Seminar Proposal Tugas Akhir
            case '5':
                return view('admin.dashboard.suratundangan.berkas.PBM.adm_seminar_proposal_PBM', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis]);
                break;

            //Pendidikan Bahasa Mandari Seminar Proposal Tugas Akhir
            case '6':
                return view('admin.dashboard.suratundangan.berkas.PBM.adm_ujian_TA_PBM', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis]);
                break;



            //Sistem Informasi Seminar Proposal
            case '7':
                return view('admin.dashboard.suratundangan.berkas.SI.adm_seminar_proposal_SI', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis]);
                break;
            //Sistem Informasi Ujian Tugas Akhir
            case '8':
                return view('admin.dashboard.suratundangan.berkas.SI.adm_ujian_TA_SI', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis]);
                break;
            //Teknik Informatika Seminar Proposal
            case '22':
                return view('admin.dashboard.suratundangan.berkas.TIF.adm_seminar_proposal_TIF', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis]);
                break;
            //Teknik Informatika Seminar Proposal
            case '23':
                return view('admin.dashboard.suratundangan.berkas.TIF.adm_ujian_TA_TIF', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen,'pilihan' => $request->pilihan_jenis]);
                break;

            //Teknik Industri Seminar Proposal
            case '18':
                return view('admin.dashboard.suratundangan.berkas.TI.adm_seminar_proposal_TI', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis]);
                break;
            //Teknik Perangkat Lunak Seminar Proposal
            case '27':
                return view('admin.dashboard.suratundangan.berkas.TPL.adm_seminar_proposal_TPL', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen,'pilihan' => $request->pilihan_jenis]);
                break;
            //Teknik Perangkat Lunak Ujian TA
            case '28':
                return view('admin.dashboard.suratundangan.berkas.TPL.adm_ujian_TA_TPL', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen,'pilihan' => $request->pilihan_jenis]);
                break;
            //Teknik Lingkungan Seminar Proposal TA
            case '24':
                return view('admin.dashboard.suratundangan.berkas.TL.adm_seminar_proposal_TA_TL', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis]);
                break;
            //Teknik Lingkungan Seminar Kemajuan TA
            case '25':
                return view('admin.dashboard.suratundangan.berkas.TL.adm_seminar_kemajuan_TA_TL', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis]);
                break;
            //Teknik Lingkungan Ujian TA 
            case '26':
                return view('admin.dashboard.suratundangan.berkas.TL.adm_ujian_TA_TL', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis,'tahun_ajar' => $request->tahun_ajar,'semester' => $request->semester]);
                break;
            //Seni Musik ujian proposal TA
            case '9':
                return view('admin.dashboard.suratundangan.berkas.SM.adm_ujian_proposal_TA_SM', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen,  'pilihan' => $request->pilihan_jenis]);
                break;
            //Seni Musik ujian kelayakan TA
            case '10':
                return view('admin.dashboard.suratundangan.berkas.SM.adm_ujian_kelayakan_TA_SM', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis,'tahun_ajar' => $request->tahun_ajar,'semester' => $request->semester]);
                break;
            //Seni Musik ujian pra pertunjukan TA 
            case '11':
                return view('admin.dashboard.suratundangan.berkas.SM.adm_ujian_pra_pertunjukan_TA_SM', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis,'tahun_ajar' => $request->tahun_ajar,'semester' => $request->semester]);
                break;
            //Seni Musik ujian pertunjukan dan sidang TA 
            case '12':
                return view('admin.dashboard.suratundangan.berkas.SM.adm_ujian_pertunjukan_dan_sidang_TA_SM', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'pilihan' => $request->pilihan_jenis,'tahun_ajar' => $request->tahun_ajar,'semester' => $request->semester]);
                break;

            //Seni TARI ujian proposal TA ST (evaluasi 1)
            case '13':
                return view('admin.dashboard.suratundangan.berkas.ST.adm_ujian_proposal_TA_ST_evaluasi_1', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'id_udg' => $request->id_undangan, 'pilihan' => $request->pilihan_jenis,'tahun_ajar' => $request->tahun_ajar,'semester' => $request->semester]);
                break;

            //Seni TARI ujian materi TA ST (evaluasi 2)
            case '14':
                return view('admin.dashboard.suratundangan.berkas.ST.adm_ujian_materi_TA_ST_evaluasi_2', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'id_udg' => $request->id_undangan, 'pilihan' => $request->pilihan_jenis,'tahun_ajar' => $request->tahun_ajar,'semester' => $request->semester]);
                break;

            //Seni TARI ujian kelayakan TA ST (evaluasi 3)
            case '15':
                return view('admin.dashboard.suratundangan.berkas.ST.adm_ujian_kelayakan_TA_ST_evaluasi_3', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'id_udg' => $request->id_undangan,'pilihan' => $request->pilihan_jenis,'tahun_ajar' => $request->tahun_ajar,'semester' => $request->semester]);
                break;

            //Seni TARI ujian penyajian TA ST OK
            case '16':
                return view('admin.dashboard.suratundangan.berkas.ST.adm_ujian_penyajian_TA_ST', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'id_udg' => $request->id_undangan, 'pilihan' => $request->pilihan_jenis,'tahun_ajar' => $request->tahun_ajar,'semester' => $request->semester]);
                break;

            //Seni TARI ujian pertanggung jawaban TA ST OK
            case '17':
                return view('admin.dashboard.suratundangan.berkas.ST.adm_ujian_pertanggungjawaban_TA_ST', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'id_udg' => $request->id_undangan, 'pilihan' => $request->pilihan_jenis,'tahun_ajar' => $request->tahun_ajar,'semester' => $request->semester]);
                break;

            //Teknik Industri Ujian Tugas Akhir
            case '20':
                return view('admin.dashboard.suratundangan.berkas.TI.adm_ujian_tugas_TA_TI', ['cek' => $cekData, 'dospem' => $cekDosenPem, 'dospen' => $cekDosenPen, 'id_udg' => $request->id_undangan, 'pilihan' => $request->pilihan_jenis]);
                break;

      
            
            default:
                abort(500,'Unauthorized action.');
                break;
        }

    }


	//Setup Cetak Surat Undangan Penguji
	public function setupcetakudgpenguji(Request $request){

        for ($sd=0; $sd < $request->jumlahdos ; $sd++) { 
           $cekPos[] = $request->input('r1'.$sd);
        }

        if (empty($cekPos)) {
            //dd('bug');
            $cekPos = '1';
        }else{
            $cekPos = $cekPos;
        }
       
        if($this->cek_akses('70') == 'yes'){
        
        }else{ 
            return Redirect::back()->with('error', 'Anda Tidak Memiliki Akses Untuk Mencetak Berkas Ini');
        }

        for ($jh=0; $jh < count($request->id); $jh++) { 

          $cekData[] =    DB::table('a_srt_udg_penguji')
                        ->join('a_prodi', 'a_prodi.id_prodi', '=', 'a_srt_udg_penguji.id_prodi') 
                        ->join('a_nama_mk', 'a_nama_mk.id_mk', '=', 'a_srt_udg_penguji.id_nama_mk') 
                        ->join('a_tbl_mhs', 'a_tbl_mhs.id_mhs', '=', 'a_srt_udg_penguji.id_mhs') 
                        ->join('a_berkas_adm', 'a_berkas_adm.id_jenisberkas', '=', 'a_srt_udg_penguji.id_berkas_adm') 
                        ->join('a_ruangan', 'a_ruangan.id_ruangan', '=', 'a_srt_udg_penguji.id_ruangan') 

                        ->select(   
                                    'a_srt_udg_penguji.id_undangan',
                                    'a_srt_udg_penguji.no_surat',
                                    'a_srt_udg_penguji.judul', 
                                    'a_srt_udg_penguji.tanggal_pelaksanaan', 
                                    'a_srt_udg_penguji.jam_mulai', 
                                    'a_srt_udg_penguji.jam_selesai', 
                                    'a_srt_udg_penguji.lampiran', 
                                    'a_srt_udg_penguji.created_at', 
                                    'a_berkas_adm.nama_berkas', 
                                    'a_prodi.nama_prodi',
                                    'a_nama_mk.nama_mk',
                                    'a_tbl_mhs.nama',
                                    'a_tbl_mhs.nim',
                                    'a_ruangan.nama_ruangan'
                                )
                        ->where('id_undangan','=',$request->id[$jh])
                        ->first();
        }


        
        return view('admin.dashboard.suratundangan.cetak_undangan_penguji',['cekData' => $cekData,'ttd' => $request->ttd,'cap_uvers' => $request->cap_uvers, 'tgl_diinginkan' => $request->tgl_diinginkan, 'TglInput' => $request->TglInput,'sebagai' => $request->sebagai, 'cekPos' => $cekPos]);

	}

	//show form edit surat undangan
	public function showformeditudg($id){

		$cekdata    = 	DB::table('a_srt_udg_penguji')->where('id_undangan', '=', $id)
					 	->join('a_berkas_adm', 'a_berkas_adm.id_jenisberkas', '=', 'a_srt_udg_penguji.id_berkas_adm') 
					 	->select('a_srt_udg_penguji.*', 'a_berkas_adm.nama_berkas','a_berkas_adm.id_jenisberkas')
		->first();

		$dosen 		= DB::table('pegawai')->get();
        $prodi 		= DB::table('a_prodi')->get();
        $mk    		= DB::table('a_nama_mk')->get();
        $mhs    	= DB::table('a_tbl_mhs')->get();
        $ruangan    = DB::table('a_ruangan')->get();

        return view('admin.dashboard.suratundangan.edit',['dosen' => $dosen, 'prodi' => $prodi, 'mhs' => $mhs ,'mk' => $mk, 'ruangan' => $ruangan, 'udg' => $cekdata,'id_undangan' => $id]);
	}

	//menampilkan tampilan form tambah surat undangan
	public function showtambahundangan(){

		$surat_tugas = DB::table('a_srt_tgs_pembimbing')
                        ->join('a_tbl_mhs','a_tbl_mhs.id_mhs','=','a_srt_tgs_pembimbing.id_mhs')
                        ->select('a_srt_tgs_pembimbing.no_surat','a_srt_tgs_pembimbing.id','a_tbl_mhs.nama','a_tbl_mhs.nim')
                        ->where([['id_dosen','!=',null],['id_udg','=',null],['id_mk','=','8']])
                        //->orWhere('id_mk','=','9')
                        ->orderBy('no_surat','DESC')->get();
      

        $dosen = DB::table('pegawai')->select('*')->orderBy('nama_karyawan','ASC')->get();
        $prodi = DB::table('a_prodi')->get();
        $mk    = DB::table('a_nama_mk')->where('id_mk','=','9')->get();
        $mhs   = DB::table('a_tbl_mhs')
                ->leftJoin('a_prodi','a_prodi.id_prodi','=','a_tbl_mhs.prodi')
                ->orderBy('nama','ASC')
                ->get();


        $ruangan    = DB::table('a_ruangan')->get();
        return view('admin.dashboard.suratundangan.tambah',['dosen' => $dosen, 'prodi' => $prodi, 'mhs' => $mhs ,'mk' => $mk, 'ruangan' => $ruangan,'NoSuratPembimbing' => $surat_tugas]);

	}



////////////////////////////////////////////////index undangan//////////////////////////////////
    public function indexundangan(){
    
    	return view('admin.dashboard.suratundangan.index',['nosu' => $this->nosurattugas()]);

    }

    public function getdataindexundangan(){

        return DataTables::of(DB::table('a_srt_udg_penguji')
        ->join('a_prodi', 'a_prodi.id_prodi', '=', 'a_srt_udg_penguji.id_prodi') 
        ->join('a_nama_mk', 'a_nama_mk.id_mk', '=', 'a_srt_udg_penguji.id_nama_mk') 
        ->join('a_tbl_mhs', 'a_tbl_mhs.id_mhs', '=', 'a_srt_udg_penguji.id_mhs') 
        ->join('a_ruangan', 'a_ruangan.id_ruangan', '=', 'a_srt_udg_penguji.id_ruangan') 
        ->join('a_berkas_adm', 'a_berkas_adm.id_jenisberkas', '=', 'a_srt_udg_penguji.id_berkas_adm') 
        //->leftJoin('a_berkas_scan_buff', 'a_berkas_scan_buff.id_data_buff', '=', 'a_srt_udg_penguji.id_undangan') 


        ->select(   
                    'a_srt_udg_penguji.id_undangan',
                    'a_srt_udg_penguji.tahun',
                    'a_srt_udg_penguji.no_surat',
                    'a_srt_udg_penguji.judul', 
                    'a_srt_udg_penguji.tanggal_pelaksanaan', 
                    'a_srt_udg_penguji.jam_mulai', 
                    'a_srt_udg_penguji.jam_selesai',
                    'a_srt_udg_penguji.lampiran', 
                    'a_prodi.nama_prodi',
                    'a_nama_mk.nama_mk',
                    'a_nama_mk.jenis_mk',
                    'a_tbl_mhs.nama',
                    'a_ruangan.nama_ruangan',
                    'a_berkas_adm.id_jenisberkas',
                    'a_berkas_adm.nama_berkas',
                    'a_berkas_adm.jenis_berkas_adm'
                    //'a_berkas_scan_buff.kategori_buff',
                    //'a_berkas_scan_buff.id_data_buff'
                )
        //Sama Halnya di get data surat keterangan selesai, bisa dibaca di bagian itu
        //->where('a_berkas_scan_buff.kategori_buff','!=','surat_keterangan_selesai')
        //->orderBy('a_srt_udg_penguji.id_undangan','DESC')
        )
        ->addIndexColumn()

        ->addColumn('action', function($data){

                        $button = '';
                        $button .= '<a href="'.Route('SetAdminis',['id' => $data->id_undangan]).'" title="Setup Administrasi">
                                    <button type="button" class="btn btn-outline-success btn-sm"><span class="fa fa-print"> </span> Setup Cetak Berkas Administrasi</button>
                                    </a>';

                        if (Auth::user()->id != '142') {
                        $button .= '<a href="'.Route('showformedit-ert',['id' => $data->id_undangan]).'" title="Edit">
                                    <button type="button" class="btn btn-outline-primary btn-sm"><span class="fa fa-pencil-alt"> </span></button>
                                    </a>';

                        $button .= '<a href="'.Route('destroy_undangan-ert',['id' => $data->id_undangan]).'" onclick="return confirm(\'Apakah Anda Yakin Menghapus Data Ini ? \' ) " title="Hapus">
                                    <button type="button" class="btn btn-outline-danger btn-sm"><span class="fa fa-trash"> </span></button>
                                    </a>';
                        }

                        return $button;

                    })

        ->addColumn('upload_berkas_cek', function($data){


                if($this->cek_akses('71') == 'yes'){

                   $button = '<a class="upload_berkas dropdown-item" data-id="'.$data->id_undangan.'" jenis_mk="'.$data->jenis_berkas_adm.'" nama_mhs="'.$data->nama.'" style="cursor: pointer;"><span class="fa fa-upload"></span> Upload Berkas</a>';

                   return $button;


                    }else{ 

                        $button = '<a class="dropdown-item"><span class="fa fa-upload"></span> Upload Berkas (Tidak Ada Akses)</a>';
                            return $button;

                    }  

            })

        ->addColumn('preview_berkas', function($data){

                if($this->cek_akses('71') == 'yes'){

                        $count_berkas_scan = DB::table('a_berkas_scan_buff')
                            ->where([['kategori_buff','=','seminar proposal'],['id_data_buff','=',$data->id_undangan]])
                            ->orWhere([['kategori_buff','=','sidang tugas akhir'],['id_data_buff','=',$data->id_undangan]])
                            ->count();

                        if ($count_berkas_scan > 0) {

                            $button = '<a class="dropdown-item" target="_blank" href="'.Route('preview_berkas_scan',['id' => $data->id_undangan,'kategori' => 'sidang tugas akhir','kategori2' => 'seminar proposal']).'"><span class="fa fa-eye"></span> Preview Berkas</a>';

                            return $button;

                        }else{

                            $button = '<a class="dropdown-item"><span class="fa fa-eye"></span> Preview Berkas</a>';
                            return $button;

                        }
                        
                    }else{ 
                        $button = '<a class="dropdown-item"><span class="fa fa-eye"></span> Preview Berkas(Tidak Ada Akses)</a>';
                            return $button;
                    }


                        
                    })

        ->addColumn('destroy_berkas', function($data){

                 if($this->cek_akses('71') == 'yes'){

                        $count_berkas_scan = DB::table('a_berkas_scan_buff')
                        ->where([['kategori_buff','=','seminar proposal'],['id_data_buff','=',$data->id_undangan]])
                        ->orWhere([['kategori_buff','=','sidang tugas akhir'],['id_data_buff','=',$data->id_undangan]])
                        ->count();

                        if ($count_berkas_scan > 0) {


                             $cek_pilihan_print = DB::table('a_berkas_scan_buff')
                            ->select('pilihan_print')
                            ->where([['kategori_buff','=','seminar proposal'],['id_data_buff','=',$data->id_undangan]])
                            ->orWhere([['kategori_buff','=','sidang tugas akhir'],['id_data_buff','=',$data->id_undangan]])
                            ->first();

                            //untuk cek apakah berkas upload yang sudah, sedang di keranjang honorarium atau tidak (di proses)
                            if ($cek_pilihan_print->pilihan_print == '1') {
                                $button = '';
                                if (Auth::user()->id != '142') {
                                $button = '';
                                $button .= '<a class="dropdown-item" href="#" onclick="return alert(\'Data ini sedang dalam proses pengerjaan admin KEPEGAWAIAN dan berkas ini tidak bisa dihapus, harap hubungi admin. \' ) "><span class="fa fa-trash"></span> Hapus Berkas</a>';
                                }
                                return $button;
                               
                            }else{
                                $button = '';
                                if (Auth::user()->id != '142') {
                                $button = '';
                                $button .= '<a class="dropdown-item" href="'.Route('destroy_file_scan_undangan',['id' => $data->id_undangan,'kategori' => 'sidang tugas akhir','kategori2' => 'seminar proposal']).'" onclick="return confirm(\'Apakah Anda Yakin Menghapus Berkas Ini ? \' ) "><span class="fa fa-trash"></span> Hapus Berkas</a>';
                                }
                                return $button;

                            }



                        }else{

                            $button = '<a class="dropdown-item"><span class="fa fa-trash"></span> Hapus Berkas</a>';
                            return $button;

                        }
        
                    }else{ 
                        $button = '<a class="dropdown-item"><span class="fa fa-trash"></span> Hapus Berkas(Tidak Ada Akses)</a>';
                            return $button;
                    }
                    

                    })

        ->addColumn('judul_con', function($data){

                        $judul_con = $data->judul;

                        return $judul_con;

                    })

        ->addColumn('status_upload_scan', function($data){

                        $count_berkas_scan = DB::table('a_berkas_scan_buff')
                        ->where([['kategori_buff','=','seminar proposal'],['id_data_buff','=',$data->id_undangan]])
                        ->orWhere([['kategori_buff','=','sidang tugas akhir'],['id_data_buff','=',$data->id_undangan]])
                        ->count();

                        if ($count_berkas_scan > 0) {
                            $status_upload_scan = '<span class="badge badge-success">Sudah</span>';
                        }elseif($count_berkas_scan <= 0){
                            $status_upload_scan = '<span class="badge badge-warning">Belum</span>';
                        }   

                        return $status_upload_scan;

                    })

        ->addColumn('penguji', function($data){
            
                        $cek = DB::table('a_udg_dp')->select('*')->where([['id_udg','=',$data->id_undangan],['kategori_dosen', '=','Penguji']])->count();

                        if ($cek == 0) {
                        return '<a href="'.Route('ShowDosenPenguji',['id_undangan' => $data->id_undangan]).'"><span class="badge badge-danger">'.$cek.' penguji | <span class="fa fa-mouse-pointer"></span></span></a>';
                        }else{
                        return '<a href="'.Route('ShowDosenPenguji',['id_undangan' => $data->id_undangan]).'"><span class="badge badge-success">'.$cek.' penguji | <span class="fa fa-mouse-pointer"></span></span></a>';
                        }
                 })

         ->addColumn('pembimbing', function($data){
            
                        $cek = DB::table('a_udg_dp')->select('*')->where([['id_udg','=',$data->id_undangan],['kategori_dosen', '=','Pembimbing']])->count();

                        if ($cek == 0) {
                        return '<a href="'.Route('ShowDosenPembimbing',['id_undangan' => $data->id_undangan]).'"><span class="badge badge-danger">'.$cek.' pembimbing | <span class="fa fa-mouse-pointer"></span></span></a>';
                        }else{
                        return '<a href="'.Route('ShowDosenPembimbing',['id_undangan' => $data->id_undangan]).'"><span class="badge badge-success">'.$cek.' pembimbing | <span class="fa fa-mouse-pointer"></span></span></a>';
                        }
                 })


        ->rawColumns(['action','penguji','pembimbing','judul_con', 'status_upload_scan','preview_berkas','destroy_berkas','upload_berkas_cek'])
        ->make(true);
                    
    }
////////////////////////////////////////////////index undangan/////////////////////////////////////////////////////




/////////////////////////////////////////////Undangan Bagian Dosen////////////////////////////////////////////////
	public function show_index_udg_dosen($id){

		$cek = 	DB::table('a_udg_dp')
				->join('pegawai','pegawai.id_pegawai', '=', 'a_udg_dp.id_dosen')
				->where([['id_udg','=',$id],['kategori_dosen', '=','Penguji']])
				->orderBy('id', 'ASC')
				->get();

		$listdoSen = DB::table('pegawai')->select('id_pegawai','nama_karyawan','nidn')->get();
		
		return view('admin.dashboard.suratundangan.dosen', ['dosen' => $cek, 'id_undangan' => $id, 'list_pegawai'=> $listdoSen]);

	}

    public function show_index_udg_dosen_pembimbing($id){

        $cek =  DB::table('a_udg_dp')
                ->join('pegawai','pegawai.id_pegawai', '=', 'a_udg_dp.id_dosen')
                ->where([['id_udg','=',$id],['kategori_dosen', '=','Pembimbing']])
                ->orderBy('id', 'ASC')
                ->get();

        $listdoSen = DB::table('pegawai')->select('id_pegawai','nama_karyawan','nidn')->get();
        
        return view('admin.dashboard.suratundangan.dosenpembimbing', ['dosen' => $cek, 'id_undangan' => $id, 'list_pegawai'=> $listdoSen]);
    }
/////////////////////////////////////////////Undangan Bagian Dosen////////////////////////////////////////////////







    protected function cek_unsur($kode_prodi){

        switch ($kode_prodi) {
            //TEKNIK INDUSTRI TUGAS AKHIR
            case '20':
                return array('a' => 'Persetujuan Ujian Tugas Akhir',
                            'b' => 'Berita Acara Ujian Tugas Akhir',
                            'c' => 'Saran Perbaikan Ujian Tugas Akhir', 
                            'd' => 'Lembar Penilaian Ujian Tugas Akhir',
                            'e' => 'Daftar Hadir Ujian Tugas Akhir',
                            'f' => 'Persetujuan Selesai Tugas Akhir');
                break;

            //TEKNIK INDUSTRI SEMINAR PROPOSAL
            case '18':
                return array('a' => 'Persetujuan Seminar Proposal Tugas Akhir',
                            'b' => 'Berita Acara Seminar Proposal Tugas Akhir',
                            'c' => 'Saran Perbaikan Seminar Proposal Tugas Akhir', 
                            'd' => 'Lembar Penilaian Seminar Proposal Tugas Akhir',
                            'e' => 'Daftar Hadir Seminar Proposal Tugas Akhir',
                            'f' => 'Daftar Hadir Seminar Proposal Tugas Akhir (Mahasiswa)');
                break;

            //AKUNTANSI UJIAN PROPOSAL TUGAS AKHIR
            case '1':
                return array('a' => 'Persetujuan Ujian Proposal Tugas Akhir',
                            'b' => 'Berita Acara Ujian Proposal Tugas Akhir',
                            'c' => 'Saran Perbaikan Ujian Proposal Tugas Akhir', 
                            'd' => 'Lembar Penilaian Ujian Proposal Tugas Akhir',
                            'e' => 'Daftar Hadir Ujian Proposal Tugas Akhir',
                            'f' => 'Daftar Hadir Mahasiswa Ujian Proposal Tugas Akhir');
                break;

            //AKUNTANSI UJIAN TUGAS AKHIR
            case '2':
                return array('a' => 'Persetujuan Ujian Tugas Akhir',
                            'b' => 'Berita Acara Ujian Tugas Akhir',
                            'c' => 'Saran Perbaikan Ujian Tugas Akhir', 
                            'd' => 'Lembar Penilaian Ujian Tugas Akhir',
                            'e' => 'Daftar Hadir Ujian Tugas Akhir',
                            'f' => 'Persetujuan Selesai Tugas Akhir');
                break;

            //MANAJEMEN SEMINAR PROPOSAL
            case '3':
                return array('a' => 'Persetujuan Seminarr',
                            'b' => 'Berita Acara Seminar',
                            'c' => 'Saran Perbaikan Seminar', 
                            'd' => 'Lembar Penilaian Seminar',
                            'e' => 'Daftar Hadir Seminar',
                            'f' => 'Daftar Hadir Mahasiswa Seminar');
                break;

            //MANAJEMEN UJIAN TUGAS AKHIR
            case '4':
                return array('a' => 'Persetujuan Ujian Tugas Akhir',
                            'b' => 'Berita Acara Ujian Tugas Akhir',
                            'c' => 'Saran Perbaikan Ujian Tugas Akhir', 
                            'd' => 'Lembar Penilaian Ujian Tugas Akhir',
                            'e' => 'Daftar Hadir Ujian Tugas Akhir',
                            'f' => 'Persetujuan Selesai Tugas Akhir');
                break;




            //PENDIDIKAN BAHASA MANDARIN UJIAN PRPOSAL
            case '5':
                return array('a' => 'Berita Acara Seminar Proposal',
                            'b' => 'Saran Perbaikan Seminar Proposal',
                            'c' => 'Lembar Penilaian Seminar Proposal', 
                            'd' => 'Daftar Hadir Seminar Proposal',
                            'e' => 'Daftar Hadir Seminar Mahasiswa');
                break;


            //PENDIDIKAN BAHASA MANDARIN UJIAN TUGAS BAHASA MANDARIN
            case '6':
                return array('a' => 'Berita Acara Ujian Tugas Akhir',
                            'b' => 'Saran Perbaikan Ujian Tugas Akhir',
                            'c' => 'Lembar Penilaian Ujian Tugas Akhir', 
                            'd' => 'Daftar Hadir Ujian Tugas Akhir',
                            'e' => 'Persetujuan Selesai Tugas Akhir');
                break;



            //SISTEM INFORMASI SEMINAR PROPOSAL TUGAS AKHIR
            case '7':
                return array('a' => 'Berita Acara Seminar Proposal',
                            'b' => 'Saran Perbaikan Seminar Proposal',
                            'c' => 'Lembar Penilaian Seminar Proposal', 
                            'd' => 'Daftar Hadir Seminar Proposal');
                break;

            //SISTEM INFORMASI UJIAN TUGAS AKHIR
            case '8':
                return array('a' => 'Berita Acara Ujian Tugas Akhir',
                            'b' => 'Saran Perbaikan Ujian Tugas Akhir',
                            'c' => 'Lembar Penilaian Ujian Tugas Akhir', 
                            'd' => 'Daftar Hadir Ujian Tugas Akhir',
                            'e' => 'Surat Pernyataan Pengumpulan Laporan Tugas Akhir',
                            'f' => 'Persetujuan Selesai Tugas Akhir');
                break;

            //TEKNIK INFORMATIKA SEMINAR PROPOSAL
            case '22':
                return array('a' => 'Berita Acara Seminar Proposal',
                            'b' => 'Saran Perbaikan Seminar Proposal',
                            'c' => 'Lembar Penilaian Seminar Proposal', 
                            'd' => 'Daftar Hadir Seminar Proposal');
                break;

            //TEKNIK INFORMATIKA UJIAN TUGAS AKHIR
            case '23':
                return array('a' => 'Berita Acara Ujian Tugas Akhir',
                            'b' => 'Saran Perbaikan Ujian Tugas Akhir',
                            'c' => 'Lembar Penilaian Ujian Tugas Akhir', 
                            'd' => 'Daftar Hadir Ujian Tugas Akhir',
                            'e' => 'Persetujuan Selesai Tugas Akhir');
                break;

            //TEKNIK PERANGKAT LUNAK SEMINAR PROPOSAL
            case '27':
                return array('a' => 'Berita Acara Seminar Proposal',
                            'b' => 'Saran Perbaikan Seminar Proposal',
                            'c' => 'Lembar Penilaian Seminar Proposal', 
                            'd' => 'Daftar Hadir Seminar Proposal');
                break;

            //TEKNIK PERANGKAT LUNAK TUGAS AKHIR
            case '28':
                return array('a' => 'Berita Acara Ujian Tugas Akhir',
                            'b' => 'Saran Perbaikan Ujian Tugas Akhir',
                            'c' => 'Lembar Penilaian Ujian Tugas Akhir', 
                            'd' => 'Daftar Hadir Ujian Tugas Akhir',
                            'e' => 'Persetujuan Selesai Tugas Akhir');
                break;
            
            //TEKNIK LINGKUNGAN SEMINAR PROPOSAL TUGAS AKHIR
            case '24':
                return array('a' => 'Persetujuan Seminar Proposal Tugas Akhir',
                            'b' => 'Berita Acara Seminar Proposal Tugas Akhir',
                            'c' => 'Saran Perbaikan Seminar Proposal Tugas Akhir', 
                            'd' => 'Lembar Penilaian Seminar Proposal Tugas Akhir',
                            'e' => 'Daftar Hadir Seminar Proposal Tugas Akhir',
                            'f' => 'Daftar Hadir Seminar Proposal Tugas Akhir (peserta/mahasiswa)');
                break;
            
            //TEKNIK LINGKUNGAN SEMINAR KEMAJUAN TUGAS AKHIR
            case '25':
                return array('a' => 'Persetujuan Seminar Kemajuan Penelitian Tugas Akhir',
                            'b' => 'Berita Acara Seminar Kemajuan Penelitian Tugas Akhir',
                            'c' => 'Saran Perbaikan Seminar Kemajuan Penelitian Tugas Akhir', 
                            'd' => 'Lembar Penilaian Seminar Kemajuan Penelitian Tugas Akhir',
                            'e' => 'Daftar Hadir Seminar Kemajuan Penelitian Tugas Akhir',
                            'f' => 'Daftar Hadir Seminar Kemajuan Penelitian Tugas Akhir (Mahasiswa)');
                break;
            
            //TEKNIK LINGKUNGAN TUGAS AKHIR
            case '26':
                return array('a' => 'Persetujuan Ujian Tugas Akhir',
                            'b' => 'Berita Acara Ujian Tugas Akhir',
                            'c' => 'Saran Perbaikan Ujian Tugas Akhir', 
                            'd' => 'Lembar Penilaian Ujian Tugas Akhir',
                            'e' => 'Daftar Hadir Ujian Tugas Akhir',
                            'f' => 'Lembar Rekapitulasi Nilai Tugas Akhir Program Studi Teknik Lingkungan',
                            'g' => 'Persetujuan Selesai Tugas Akhir');
                break;
            
            //SENI MUSIK UJIAN PROPOSAL
            case '9':
                return array('a' => 'Berita Acara Ujian Proposal Tugas Akhir',
                            'b' => 'Saran Perbaikan Ujian Proposal Tugas Akhir',
                            'c' => 'Lembar Penilaian Ujian Proposal Tugas Akhir', 
                            'd' => 'Daftar Hadir Ujian Proposal Tugas Akhir');
                break;
            
            //SENI MUSIK UJIAN KELAYAKAN TA
            case '10':
                return array('a' =>'Berita Acara Ujian Kelayakan Tugas Akhir Program Studi Seni Musik',
                            'b' => 'Saran Perbaikan Ujian Kelayakan Tugas Akhir',
                            'c' => 'Lembar Penilaian Ujian Kelayakan Tugas Akhir', 
                            'd' => 'Daftar Hadir Ujian Kelayakan Tugas Akhir Program Studi Seni Musik');
                break;
            
             //SENI MUSIK UJIAN PRA PERTUNJUKAN TA
             case '11':
                return array('a' =>' Berita Acara Ujian Pra Pertunjukan Tugas Akhir Program Studi Seni Musik',
                            'b' => ' Saran Perbaikan Ujian Pra Pertunjukan Tugas Akhir',
                            'c' => ' Lembar Penilaian Ujian Pra Pertunjukan Tugas Akhir', 
                            'd' => ' Daftar Hadir Ujian Pra Pertunjukan Tugas Akhir Program Studi Seni Musik');
                break;
            
            //SENI MUSIK UJIAN PERTUNJUKAN DAN SIDANG
            case '12':
                return array('a' =>'Berita Acara Ujian Tugas Akhir Program Studi Seni Musik',
                            'b' => 'Daftar Hadir Ujian Tugas Akhir',
                            'c' => 'Saran Perbaikan Ujian Tugas Akhir', 
                            'd' => 'Lembar Penilaian Ujian Tugas Akhir',
                            'g' => 'Lembar Penilaian Ujian Tugas Akhir versi 2',
                            'e' => 'Lembar Rekapitulasi Nilai Tugas Akhir Program Studi Seni Musik',
                            'f' => 'Persetujuan Selesai Tugas Akhir');
                break;
            
            //SENI TARI UJIAN PROPOSAL TUGAS AKHIR EVALUASI 1
            case '13':
                return array('a' =>'Berita Acara Evaluasi I: Ujian Proposal Tugas Akhir Program Studi Seni Tari',
                            'b' => 'Saran Perbaikan Evaluasi I: Ujian Proposal Tugas Akhir',
                            'c' => 'Lembar Penilaian Evaluasi I: Ujian Proposal Tugas Akhir', 
                            'd' => 'Daftar Hadir Evaluasi I: Ujian Proposal Tugas Akhir',
                            'e' => 'Daftar Hadir Mahasiswa Evaluasi I: Ujian Proposal Tugas Akhir Program Studi Seni Tari');
                break;

            //SENI TARI UJIAN MATERI TUGAS AKHIR EVALUASI 2
            case '14':
                return array('a' =>'Berita Acara Evaluasi II: Ujian Materi Tugas Akhir Program Studi Seni Tari',
                            'b' => 'Saran Perbaikan Evaluasi II: Ujian Materi Tugas Akhir',
                            'c' => 'Lembar Penilaian Evaluasi II: Ujian Materi Karya Tugas Akhir', 
                            'd' => 'Daftar Hadir Evaluasi II: Ujian Materi Tugas Akhir');
                break;
            
            //SENI TARI UJIAN KELAYAKAN TUGAS AKHIR EVALUASI 3
            case '15':
                return array('a' =>'Berita Acara Evaluasi III: Ujian Kelayakan Tugas Akhir Program Studi Seni Tari',
                            'b' => 'Saran Perbaikan Evaluasi III: Ujian Kelayakan Tugas Akhir',
                            'c' => 'Lembar Penilaian Evaluasi III: Ujian Kelayakan Karya Tugas Akhir', 
                            'd' => 'Daftar Hadir Evaluasi III: Ujian Kelayakan Tugas Akhir');
                break;
            
            //SENI TARI UJIAN PENYAJIAN TUGAS AKHIR
            case '16':
                return array('a' =>'Berita Acara Ujian Penyajian Karya Tugas Akhir Program Studi Seni Tari',
                            'b' => 'Lembar Penilaian Ujian Penyajian Karya Tugas Akhir',
                            'c' => 'Daftar Hadir Ujian Penyajian Karya Tugas Akhir');
                break;
            
            //SENI TARI UJIAN PERTANGGUNGJAWABAN TUGAS AKHIR
            case '17':
                return array('a' =>'Berita Acara Ujian Pertanggungjawaban Karya Tugas Akhir Program Studi Seni Tari',
                            'b' => 'Lembar Rekapitulasi Nilai Akhir Ujian Penyajian dan Pertanggungjawaban Karya Tugas Akhir Program Studi Seni Tari',
                            'c' => 'Saran Perbaikan Ujian Pertanggungjawaban Tugas Akhir',
                            'd' => 'Lembar Penilaian Ujian Pertanggungjawaban Karya Tugas Akhir',
                            'e' => 'Daftar Hadir Ujian Pertanggungjawaban Tugas Akhir',
                            'f' => 'Surat Pernyataan Pengumpulan Laporan Tugas Akhir',
                            'g' => 'Persetujuan Selesai Tugas Akhir');
                break;

                
               
                
                
                
                
                









            default:
                return  array('2112' => 'Tidak Dalam Kondisi');
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

}
