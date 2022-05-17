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

class SuratTugasPembimbing extends Controller
{


    //////////////////////////// ///CEK/UPDATE URURTAN PEMBIMBING//////////////////////////////////////
    public function CekUrutantPembimbing(Request $request){

        $CekDB = DB::table('a_srt_tgs_pembimbing')->select('urutan_pembimbing')->where('id','=',$request->data_id)->first();

        if ($CekDB) {
            $table = '';    
            $table .= '<table class="table table-sm table-bordered">
                          <thead>
                            <tr>
                              <th scope="col">Urutan Sekarang</th>
                              <th scope="col">Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td scope="row" style=" text-align:center; font-weight:bold">
                               '.((is_null($CekDB->urutan_pembimbing) || empty($CekDB->urutan_pembimbing))?'Sendiri': ''.$CekDB->urutan_pembimbing.'').'
                            </td>
                              <td nowrap style=" text-align:center">

                                    <!-- radio -->
                                    <div class="form-group clearfix">
                                      <div class="icheck-success d-inline">
                                        <input type="radio" value="1" name="RadioUrtPem" '.(($CekDB->urutan_pembimbing == 1)?'checked':"").' id="radioDanger1">
                                        <label for="radioDanger1">
                                        </label>
                                      </div>
                                      <div class="icheck-warning d-inline">
                                        <input type="radio" value="2" name="RadioUrtPem" '.(($CekDB->urutan_pembimbing == 2)?'checked':"").'  id="radioDanger2">
                                        <label for="radioDanger2">
                                        </label>
                                      </div>
                                      <div class="icheck-danger d-inline">
                                        <input type="radio" value="3" name="RadioUrtPem" '.(($CekDB->urutan_pembimbing == 3)?'checked':"").'  id="radioDanger3">
                                        <label for="radioDanger3">
                                        </label>
                                      </div>
                                      <div class="icheck-secondary d-inline">
                                        <input type="radio" value="" name="RadioUrtPem" '.(($CekDB->urutan_pembimbing == null || empty($CekDB->urutan_pembimbing))?'checked':"").'  id="radioDanger4">
                                        <label for="radioDanger4">
                                        </label>
                                      </div>
                                   
                                    </div>
                                  </div>

                              </td>
                            </tr>
                          </tbody>
                        </table>
                        ';

        }else{
            $table = 'Data Tidak Ditemukan'; 
        }

        return Response::json(array('tableUrtPem' => $table), 200);

    }




    ///////////////////////////index surat tugas pembimbing////////////////////////////    
    public function exportsrttgspembimbing(Request $request){

        if (is_null($request->id)) {
            return Redirect::back()->with('error', 'Pilih Minimal 1');
        }


        for ($sd=0; $sd < $request->jumlahdos ; $sd++) { 
           $cekPos[] = $request->input('r1'.$sd);
        }

        if (empty($cekPos)) {
            //dd('bug');
            $cekPos = '1';
        }else{
            $cekPos = $cekPos;
        }

        for ($i=0; $i < count($request->id); $i++) { 
          

            $cekQuery[] = DB::table('a_srt_tgs_pembimbing')
            ->leftJoin('pegawai', 'pegawai.id_pegawai', '=', 'a_srt_tgs_pembimbing.id_dosen') 
            ->join('a_prodi', 'a_prodi.id_prodi', '=', 'a_srt_tgs_pembimbing.id_prodi') 
            ->join('a_nama_mk', 'a_nama_mk.id_mk', '=', 'a_srt_tgs_pembimbing.id_mk') 
            ->join('a_tbl_mhs', 'a_tbl_mhs.id_mhs', '=', 'a_srt_tgs_pembimbing.id_mhs')
            ->leftJoin('a_srt_udg_penguji', 'a_srt_udg_penguji.id_undangan', '=', 'a_srt_tgs_pembimbing.id_udg') 
            ->leftJoin('a_berkas_adm', 'a_berkas_adm.id_jenisberkas', '=', 'a_srt_udg_penguji.id_berkas_adm') 
            ->leftJoin('a_ruangan', 'a_ruangan.id_ruangan', '=', 'a_srt_udg_penguji.id_ruangan') 

            ->select(   

                        'a_srt_tgs_pembimbing.no_surat',
                        'a_srt_tgs_pembimbing.id', 
                        'a_srt_tgs_pembimbing.tahun_ajar', 
                        'a_srt_tgs_pembimbing.semester', 
                        'a_srt_tgs_pembimbing.jenis_surat', 
                        'a_srt_tgs_pembimbing.id_udg', 
                        'a_srt_tgs_pembimbing.urutan_pembimbing', 
                        'a_srt_tgs_pembimbing.created_at', 
                        'a_srt_udg_penguji.judul', 
                        'a_srt_udg_penguji.tanggal_pelaksanaan', 
                        'a_srt_udg_penguji.jam_mulai', 
                        'a_srt_udg_penguji.jam_selesai', 
                        'a_srt_tgs_pembimbing.bentuk_mbkm', 
                        'a_srt_tgs_pembimbing.nama_kegiatan_mbkm', 
                        'a_srt_tgs_pembimbing.sks_diakui_mbkm', 
                        'a_berkas_adm.nama_berkas', 
                        'a_ruangan.nama_ruangan', 
                        'pegawai.nama_karyawan',
                        'pegawai.nidn',
                        'a_prodi.nama_prodi',
                        'a_nama_mk.nama_mk',
                        'a_tbl_mhs.nama',
                        'a_tbl_mhs.nim'

                    )->where('id' ,'=', $request->id[$i])->first();


            }


            return view('admin.dashboard.surattugaspembimbing.print',
                    [   
                        'cekQuery' => $cekQuery,
                        'ttd' => $request->ttd,
                        //'dospen' => $cekdospenguji,
                        'tgl_diinginkan' => $request->tgl_diinginkan,
                        'TglInput' => $request->TglInput,
                        'cap_uvers' => $request->cap_uvers,
                        'cekPos' => $cekPos,
                        'sebagai' => $request->sebagai
                    ]);

    }
///////////////////////////index surat tugas pembimbing////////////////////////////





///////////////////////////index surat tugas pembimbing////////////////////////////
	public function index_surattugaspembimbing(){

        $cek_nosu = DB::table('a_srt_udg_penguji')
        ->join('a_tbl_mhs','a_tbl_mhs.id_mhs','=','a_srt_udg_penguji.id_mhs')
        ->select('a_srt_udg_penguji.id_undangan','a_srt_udg_penguji.no_surat','a_tbl_mhs.nama','a_tbl_mhs.nim')->orderBy('id_undangan','DESC')->get();

        $NoSurMultiple = DB::table('a_srt_tgs_pembimbing')
                    ->join('a_tbl_mhs', 'a_tbl_mhs.id_mhs', '=', 'a_srt_tgs_pembimbing.id_mhs')
                    ->select('a_srt_tgs_pembimbing.id','a_srt_tgs_pembimbing.no_surat','a_tbl_mhs.nama')
                    ->orderBy('a_srt_tgs_pembimbing.no_surat','DESC')
                    ->get();


        $thnajar =  DB::table('tahun_ajar')->select('tahun_ajar')->groupBy('tahun_ajar')->where('status','=','1')->get();
        $semester =  DB::table('tahun_ajar')->select('semester')->groupBy('semester')->where('status','=','1')->get();

        return view('admin.dashboard.surattugaspembimbing.index',['NoSurMultiple' => $NoSurMultiple,'nosu' => $this->nosurattugas(), 'nosu_udg' => $cek_nosu,'thnajar' => $thnajar,'semester'=>$semester]);

	}

	public function getdatasurattugaspembimbing(){

       
        return DataTables::of(DB::table('a_srt_tgs_pembimbing')
        ->leftJoin('pegawai', 'pegawai.id_pegawai', '=', 'a_srt_tgs_pembimbing.id_dosen') 
        ->join('a_prodi', 'a_prodi.id_prodi', '=', 'a_srt_tgs_pembimbing.id_prodi') 
        ->join('a_nama_mk', 'a_nama_mk.id_mk', '=', 'a_srt_tgs_pembimbing.id_mk') 
        ->join('a_tbl_mhs', 'a_tbl_mhs.id_mhs', '=', 'a_srt_tgs_pembimbing.id_mhs') 
        ->leftJoin('a_srt_udg_penguji', 'a_srt_udg_penguji.id_undangan', '=', 'a_srt_tgs_pembimbing.id_udg') 

        ->select(	

        			'a_srt_tgs_pembimbing.no_surat',
                    'a_srt_tgs_pembimbing.id', 
                    'a_srt_tgs_pembimbing.tahun_ajar', 
                    'a_srt_tgs_pembimbing.semester', 
                    'a_srt_tgs_pembimbing.jenis_surat', 
                    'a_srt_tgs_pembimbing.urutan_pembimbing', 
                    'a_srt_tgs_pembimbing.created_at', 
                    'a_srt_tgs_pembimbing.tahun',
                    //'a_srt_udg_penguji.no_surat as ceksu',
                    'a_srt_tgs_pembimbing.id_udg', 
        			'pegawai.nama_karyawan',
        			'a_prodi.nama_prodi',
        			'a_nama_mk.nama_mk',
                    'a_nama_mk.jenis_mk',
                    'a_nama_mk.id_mk',
        			'a_tbl_mhs.nama'


        		)

        //->orderBy('a_srt_tgs_pembimbing.id','DESC')
        )
        ->addIndexColumn()
        
        ->addColumn('action', function($data){

                        $button = '';

                        if (Auth::user()->id != '142') {
                        $button = '<a href="'.Route('showformsrttgspembimbing',['id' => $data->id]).'" title="Edit">
                                    <button type="button" class="btn btn-outline-primary btn-sm"><span class="fa fa-pencil-alt"> </span></button>
                                    </a>';
                        }


    
                        if($this->cek_akses('57') == 'yes'){
                            if (Auth::user()->id != '142') {
                                $button .=  '<a href="'.Route('dessrttgspembimbing',['id' => $data->id]).'" title="Hapus" onclick="return confirm(\'Apakah Anda Yakin Menghapus '.$data->nama.' Ini ? \' ) "><button type="button" class="btn btn-outline-danger btn-sm"><span class="fa fa-trash"></span></button></a>';
                            }
                            

                        }else{ 

                            $button .=  '<a href="#" title="Hapus" onclick="alert(\' Anda Tidak Memiliki Akses\' ) "><button type="button" class="btn btn-outline-danger btn-sm"><span class="fa fa-trash"></span> </button></a>';


                         }  

                        if (is_null($data->urutan_pembimbing)) {
                            $button .= ' &nbsp; <a class="urtPemb" data_id="'.$data->id.'" style="cursor: pointer; text-decoration:underline">#Sendiri</a>';
                        }else{

                        }
                        
                       return $button;



                         

                    })

        ->addColumn('jumlah_dosenpenguji', function($data){

                       $cek = DB::table('a_udg_dp')->select('*')->where([['id_udg','=',$data->id_udg],['kategori_dosen', '=','Penguji']])->count();


                        return $cek;

                    })
                    ->rawColumns(['action','jumlah_dosenpenguji'])
                    ->make(true);
                    
	}
    ///////////////////////////index surat tugas pembimbing////////////////////////////


    public function load_data(Request $request){

            if($request->ajax()){
 
                if ($request->ns) {

                    $NoSurMultiple = DB::table('a_srt_tgs_pembimbing')
                    ->join('a_tbl_mhs', 'a_tbl_mhs.id_mhs', '=', 'a_srt_tgs_pembimbing.id_mhs')
                    ->select('a_srt_tgs_pembimbing.id','a_srt_tgs_pembimbing.no_surat','a_tbl_mhs.nama','a_srt_tgs_pembimbing.tahun')
                    ->orderBy('tahun', 'DESC')
                    ->orderBy('no_surat','DESC')
                    ->where([['a_srt_tgs_pembimbing.no_surat','<',$request->ns],['a_srt_tgs_pembimbing.tahun','=',$request->tahun]])
                    ->paginate(5);


                }else{

                    $NoSurMultiple = DB::table('a_srt_tgs_pembimbing')
                    ->join('a_tbl_mhs', 'a_tbl_mhs.id_mhs', '=', 'a_srt_tgs_pembimbing.id_mhs')
                    ->select('a_srt_tgs_pembimbing.id','a_srt_tgs_pembimbing.no_surat','a_tbl_mhs.nama','a_srt_tgs_pembimbing.tahun')
                    ->orderBy('tahun', 'DESC')
                    ->orderBy('no_surat','DESC')
                    ->where('a_srt_tgs_pembimbing.tahun','=',$request->tahun)
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
                    $output .=  '<tr>
                                    <td class="p-2" style="vertical-align: middle; width:40%;">'.$item_NoSurMultiple->no_surat.'</td>
                                    <td class="p-2" style="vertical-align: middle; width:60%;">'.$item_NoSurMultiple->nama.'</td>
                                    <td class="p-2" style="vertical-align: middle;">
                                        <div class="icheck-primary d-inline" style="cursor:pointer; text-align: center;">
                                            <input type="checkbox" id="Mult'.$item_NoSurMultiple->id.'" name="id[]" value="'.$item_NoSurMultiple->id.'">
                                            <label for="Mult'.$item_NoSurMultiple->id.'"></label>
                                        </div>
                                    </td>
                                </tr>';

                        $last_id = $item_NoSurMultiple->id;
                        $gns = $item_NoSurMultiple->no_surat;
                    }
                    '</tbody>
                    </table>';
                    $output .='<tr id="sisa"><td colspan="3" style="text-align:center;"><div id="load_more">
                    <button type="button" name="load_more_button" class="btn btn-primary btn-sm"  data-ns="'.$gns.'" data-id="'.$last_id.'" id="load_more_button">Lebih Banyak</button>
                    </div></td><tr>';

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


    ///////////////////////////tambah surat tugas pembimbing////////////////////////////
    public function showformtambah(Request $request){

        $mata_kuliah = DB::table('a_mata_kuliah')->orderBy('nama_matkul','ASC')->get();

        $dosen =    DB::table('pegawai')->orderBy('nama_karyawan','ASC')->get();
        $prodi =    DB::table('a_prodi')->get();
        $thnajar =  DB::table('tahun_ajar')->select('tahun_ajar')->groupBy('tahun_ajar')->where('status','=','1')->get();
        $semester =  DB::table('tahun_ajar')->select('semester')->groupBy('semester')->where('status','=','1')->get();
        //$mk    =    DB::table('a_nama_mk')->get();
        $mhs   =    DB::table('a_tbl_mhs')
                    ->join('a_prodi','a_prodi.id_prodi','=','a_tbl_mhs.prodi') 
                    ->where('status','=','aktif')
                    ->orWhere('status','=','cuti')
                    ->orWhere('status','=','tidak')
                    ->orderBy('nama','ASC')
                    ->get();


        return view('admin.dashboard.surattugaspembimbing.tambah',['dosen' => $dosen, 'prodi' => $prodi, 'mhs' => $mhs,'thnajar' => $thnajar,'semester'=>$semester,'mata_kuliah' => $mata_kuliah]);

    }
    ///////////////////////////tambah surat tugas pembimbing////////////////////////////


    public function mkauto(Request $request){

        $mkFprodi    =  DB::table('a_tbl_mhs') 
                        ->join('a_prodi','a_prodi.id_prodi','=','a_tbl_mhs.prodi')
                        ->select('nama_mk')
                        ->where('a_tbl_mhs.id_mhs', '=', $request->id_mhstr)
                        ->first();


        $pieces = explode(",", $mkFprodi->nama_mk);
        $output = '';
        foreach ($pieces as $key => $value) {

            $mk    =    DB::table('a_nama_mk')
            ->select('nama_mk','id_mk','jenis_mk')
            ->where('id_mk', '=', $value)
            ->first();
            $output .=  '<option value="'.$mk->id_mk.'">'.$mk->nama_mk.' | '.$mk->jenis_mk.'</option>';
        }
        $output .= '<option value="8">Tugas Akhir | Pembimbing</option>';
        return $output;
    }



    ///////////////////////////tambah surat tugas pembimbing////////////////////////////

    public function showeditsrttgspembimbing($id){

        $cektabel = DB::table('a_srt_tgs_pembimbing')

        ->leftJoin('pegawai', 'pegawai.id_pegawai', '=', 'a_srt_tgs_pembimbing.id_dosen') 
        ->join('a_prodi', 'a_prodi.id_prodi', '=', 'a_srt_tgs_pembimbing.id_prodi') 
        ->join('a_nama_mk', 'a_nama_mk.id_mk', '=', 'a_srt_tgs_pembimbing.id_mk') 
        ->join('a_tbl_mhs', 'a_tbl_mhs.id_mhs', '=', 'a_srt_tgs_pembimbing.id_mhs') 

        ->select(   

                    'a_srt_tgs_pembimbing.*', 
                    'pegawai.nama_karyawan',
                    'pegawai.nidn',
                    'a_prodi.nama_prodi',
                    'a_nama_mk.nama_mk',
                    'a_tbl_mhs.nama'


                )

        ->where('id', '=' , $id)->first();

        $dosen = DB::table('pegawai')->get();
        $prodi = DB::table('a_prodi')->get();
        $mk    = DB::table('a_nama_mk')->get();
        $mhs   = DB::table('a_tbl_mhs')->get();

        return view('admin.dashboard.surattugaspembimbing.edit', ['cektabel' => $cektabel,'dosen' => $dosen, 'prodi' => $prodi, 'mhs' => $mhs ,'mk' => $mk]);

    }
    ///////////////////////////tambah surat tugas pembimbing////////////////////////////



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

    protected function tanggal_indo($tanggal) {
        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
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
