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

class PegawaiController extends Controller
{   
  ///////////////////////////////////////////////index/////////////////////////////////////////////////////////////
  public function index(){  

    $jabs= DB::table('b_set_detail_jabatan')
       ->join('b_set_jabatan','b_set_detail_jabatan.id_set_jabatan','=','b_set_jabatan.id_set_jabatan')
       ->select('b_set_detail_jabatan.id_detail_jabatan','b_set_detail_jabatan.id_set_jabatan','b_set_detail_jabatan.nama_detail_jabatan','b_set_jabatan.nama_jabatan')->orderBy('nama_jabatan','ASC')->orderBy('nama_detail_jabatan', 'ASC')->get();

      $prodi= DB::table('a_prodi')->select('id_prodi','nama_prodi')->orderBy('nama_prodi','ASC')->get();

    return view('admin.dashboard.pegawai.index',['jabs' => $jabs,'prodi' => $prodi]);
    
  }  

  //BERKAS DATA DIRI MELALUI MANAGEMENT PEGAWAI
  public function GetFormTambahBerkas($id_user){//get form untuk upload berkas baru melalui admin managemnt pegawai

    $UrutanNama = array('0' => 'ktp','1' => 'npwp','2' => 'kk', '3' => 'bpjs_ketenagakerjaan', '4' => 'bpjs_kesehatan','5' => 'sim','6' => 'ijazah','7' => 'transkrip','8' => 'ijazahs1','9' => 'transkrips1','10' => 'ijazahs2','11' => 'transkrips2','12' => 'ijazahs3','13' => 'transkrips3');

    $DataDB = DB::table('b_berkas_data_diri')->select('jenis_berkas')->where('id_user','=',$id_user)->get();
 
    $Hasil = array();
    foreach ($DataDB as $key => $CekVal) {
      $Hasil[] = $CekVal->jenis_berkas;
    }

  
    $arr3 = array_values(array_diff($UrutanNama, $Hasil));
    
    $form = '';
    $form .= '<div class="shadow-lg p-2 mb-2 ">
              <form  class="form-horizontal" role="form" method="POST" action="'.Route('TambahBerkasFilev').'" accept-charset="utf-8" enctype="multipart/form-data">

                <table class="table bg-white table-striped display">
                  <thead>
                    <tr>
                      <th nowrap="">File</th>
                      <th nowrap="">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>';
                  for ($i=0; $i < count($arr3); $i++) { 
    $form .=      '<tr>
                      <td>'.$arr3[$i].'</td>
                      <td>
                       <input type="file" class="bg-secondary InputBerkasForm" id="'.$arr3[$i].'" name="'.$arr3[$i].'" accept=".jpg, .jpeg, .png, .pdf, .zip, .rar"/>
                        <button style="float:right;" type="button" class="btn btn-outline-danger btn-xs CloseFile" id="'.$arr3[$i].'"><span class="fa fa-times-circle"></span></button>
                       <input type="hidden" name="_token" value="'.csrf_token().'"/>
                      </td>
                  </tr>';
                  }
    $form .=      '</tbody>
                </table>
                <button class="btn btn-primary" style="float:right;"><li class="fa fa-upload"></li> Upload Berkas</button>
                </form>
              </div>';

    return Response::json(array('HasilCek' => $form), 200);

  }

  public function BerkasDataDiri($id_user){//menampilkan list data berkas yang di upload karyawan waktu penilaian kerja

    $Data =  DB::table('b_berkas_data_diri')->where('id_user','=',$id_user)->get(); 
  
    if (!$Data->isEmpty()) { 
      
      $table = '';
      $table .= '<p>
                    <button class="btn btn-info btn-sm btn-flat" id="ButtonUploadBerkas" type="button" data-toggle="collapse" data-target="#UntukUploadData" aria-expanded="false" aria-controls="UntukUploadData"><span id="SpanBerkasUpload" class="fa fa-plus"></span> 
                      Tambah Berkas
                    </button>
                    &nbsp;&nbsp;<font size="2"><span class="fa fa-arrow-left"></span> &nbsp;Klik untuk buka/perbaharui</font>
                  </p>
                  <div class="collapse" id="UntukUploadData">
                    <div class="card card-body p-2" id="KontenFormUploadAdmin">
                      
                    </div>
                  </div>
                  <table class="table table-striped table-dark" width="100%" id="TabelBerkass">
                    <thead>
                      <tr>
                        <th scope="col">Jenis Berkas</th>
                        <th scope="col">Nama File</th> 
                        <th scope="col">Size File</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>';
                    foreach ($Data as $key => $VData) {
      $table .=     '<tr id="RowBagian'.$VData->id.'">
                        <td>'.$VData->jenis_berkas.'</td>
                        <td>'.$VData->nama_file.'</td>
                        <td>'.$this->formatBytes($VData->size_file).'</td>
                        <td width="20%" style="text-align:center; vertical-align:middle;" nowrap>
                          <div class="btn-group">
                            <a href="'.Route('LihatBerkasPegawai',['id_file' => $VData->id]).'"><button class="btn btn-sm btn-block btn-primary" title="Download File"><li class="fa fa-download"></li> unduh</button>
                            </a>
                         
                            <button class="btn btn-sm btn-block btn-outline-danger HapusBerkasPegawaiAdmin" Data-Id="'.$VData->id.'" title="Hapus File"><li class="fa fa-trash"></li> hapus</button>
                          </div>

                        </td>
                      </tr>';
                    }
        $table .=  '</tbody>
                  </table>';

      return Response::json(array('HasilCek' => '001','tablenya' => $table), 200);

    }else{
      return Response::json(array('HasilCek' => '002'), 200);
    }
  }


  //LIHAT BERKAS DATADIRI
  public function LihatBerkasPegawai($id_file){

    $Data = DB::table('b_berkas_data_diri')->select('*')->where('id','=',$id_file)->first();
    if (!is_null($Data)) {

         if (file_exists($this->PathBerkasDataDiri($Data->id_user, $Data->nama_file))) {
           return response()->download($this->PathBerkasDataDiri($Data->id_user, $Data->nama_file), "$Data->nama_file",
            [
                'Content-Type' => 'application/octet-stream'
            ]);
          }else{
             return Redirect::back()->with('warningMessage', 'File tidak ditemukan');
           }
    }else{
      return Redirect::back()->with('warningMessage', 'File tidak ditemukan');
    }

  }
  //PATH BERKAS DATA DIRI
  protected function PathBerkasDataDiri($id_user, $nama_file){
      $path = public_path().'/berkas_data_diri/'.$id_user.'/'.$nama_file;
      return $path;
  }


  //LIST PEGAWAI
  public function pegawailist(Request $request){

      return DataTables::of(DB::table('pegawai')
      ->select('pegawai.nip','pegawai.nidn','pegawai.nama_karyawan','pegawai.id_pegawai','pegawai.tmt','pegawai.status_aktif','pegawai.tmk','pegawai.tanggal_keluar','pegawai.keterangan_histori','pegawai.status_aktif','pegawai.nitk','pegawai.id_user')
   
      )
      ->addColumn('berkas_data_diri', function($data){

        $DataBerkas = DB::table('b_berkas_data_diri')->where('id_user','=',$data->id_user)->get();

        return $DataBerkas;


      })
      ->addColumn('jabatan', function($data){

        $cek_jab = DB::table('jabatan_pegawai')
        ->join('b_set_detail_jabatan','b_set_detail_jabatan.id_detail_jabatan','=','jabatan_pegawai.detail_jabatan')
        ->join('b_set_jabatan','b_set_jabatan.id_set_jabatan','=','b_set_detail_jabatan.id_set_jabatan')
        ->select('b_set_jabatan.nama_jabatan','b_set_detail_jabatan.nama_detail_jabatan')
        ->where('id_pegawai_fk','=',$data->id_pegawai)
        ->get();

        $button=[];
        foreach($cek_jab as $key )
        $button[] = $key->nama_jabatan.' | '.$key->nama_detail_jabatan;
        

        return $button;

        
      })
      ->addColumn('DataDiri', function($data){

        $CekDataDiri = DB::table('b_data_diri')
        ->where('id_user','=',$data->id_user)
        ->count();

        if ($CekDataDiri > 0) {
          $button = '<a href="'.Route('DataDiriPegawai',['id_user' => $data->id_user]).'" title="Data Diri">
                                <button type="button" class="btn btn-outline-success btn-xs"><span class="fa fa-check"></span></button>
                              </a>';
        }else{

          if ($data->id_user) {
            $button = '<a href="'.Route('PegawaiAddDataDiri',['id_user' => $data->id_user]).'" title="Data Diri">
                                <button type="button" class="btn btn-outline-warning btn-xs" ><span class="fa fa-exclamation-circle"></span></button>
                              </a>';
          }else{
            $button = '<a href="'.Route('UserIndex').'" onclick="return confirm(\''.$data->nama_karyawan.' Belum Memiliki Akun, Buat Akun Terlebih Dahulu ? \' ) "><button type="button" class="btn btn-outline-danger btn-sm"><span class="fa fa-exclamation"></span></button></a> ';
          }
        }
        return $button;
      })
      ->addColumn('action', function($data){

              $button =   '
                 <div class="dropdown dropleft">
                    <button class="btn btn-outline-info dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="fa fa-cogs"></span>
                    </button>
                      <div class="dropdown-menu bg-light" aria-labelledby="dropdownMenu2" style="padding: 7px; text-align: center; width: max-content; position:left;">

                      <font size="2" data-toggle="tooltip" data-placement="top" title="Nama Pegawai">'.$data->nama_karyawan.'</font> | 
                      <a data-toggle="tooltip" data-placement="top" title="EDIT PEGAWAI">
                      <button type="button" class="btn btn-outline-primary btn-sm EditPegawai" IdPegawai="'.$data->id_pegawai.'"><span class="fa fa-edit"></span></button>
                      </a> | 
                      <a><button type="button" class="btn btn-outline-warning btn-sm LihatJabatan" DataIdPegawai="'.$data->id_pegawai.'" data-toggle="tooltip" data-placement="top" title="LIHAT JABATAN KARYAWAN"><span class="fa fa-briefcase"></span></button></a> |
                      <a data-toggle="tooltip" data-placement="top" title="LIHAT JABATAN FUNGSIONAL"><button type="button" class="btn btn-outline-info btn-sm LihatJFungsional" DataIdPegawai="'.$data->id_pegawai.'"><span class="fa fa-chalkboard-teacher"></span></button></a> | 
                      <a href="pegawai/'.$data->id_pegawai.'/destroy" data-toggle="tooltip" data-placement="top" title="HAPUS KARYAWAN" onclick="return confirm(\'Apakah Anda Yakin Menghapus Data Pegawai '.$data->nama_karyawan.' Ini ? \' ) "><button type="button" class="btn btn-outline-danger btn-sm"><span class="fa fa-trash"></span></button></a> 

                      </div>
                  </div>';

              return $button;
          })

          ->rawColumns(['action','DataDiri','berkas_data_diri'])
          ->make(true);
  
  }
  ///////////////////////////////////////////////index/////////////////////////////////////////////////////////////

  ///////////////////////////////////////////////////2.0/////////////////////////////////////////////////

  /////////////////////////////////////////////LIHAT JABATAN////////////////////////////////////////////////
  public function lht_jabatan($id_pegawai){

      $CheckJabPeg = DB::table('jabatan_pegawai')
      ->leftjoin('b_set_detail_jabatan','jabatan_pegawai.detail_jabatan','=','b_set_detail_jabatan.id_detail_jabatan')
      ->leftjoin('b_set_jabatan','b_set_detail_jabatan.id_set_jabatan','=','b_set_jabatan.id_set_jabatan')
      ->select('jabatan_pegawai.*','b_set_jabatan.kategori')->where('jabatan_pegawai.id_pegawai_fk','=',$id_pegawai)->orderBy('nm_jabatan','ASC')->get();

      if ($CheckJabPeg->isEmpty()) {
          return response()->json('Tidak Ada Jabatan !');
      }else{
          foreach ($CheckJabPeg as $key => $value) {
             $hasil[] = ' 
             <ul class="todo-list" data-widget="todo-list" >
                  <li class="bg-dark" style="border-left: 0px;">
                    <span class="text">'.$value->nm_jabatan.'<span class="badge badge-pill badge-info">'.$value->kategori.'</span></span>
                    <div class="tools">
                      <a href="#" title="Edit Nama Jabatan" class="btn btn-outline-info btn-xs EditNamaJabatan"  DataIdPegEdit="'.$value->id_jabatan.'" NamaJabEdit="'.$value->detail_jabatan.'" ProdiJabs="'.$value->prodi.'"> <i class="fas fa-edit"></i></a> &nbsp;
                      <a href="'.Route('DestoryJabPegawai',['id' => $value->id_jabatan]).'" class="btn btn-outline-danger btn-xs" title="Hapus Jabatan" onclick="return confirm(\'Apakah Anda Yakin Menghapus Jabatan Ini ? \' ) " ><i class="fas fa-trash"></i></a>
                    </div>
                  </li>

                </ul>';
          }
      }
      return response()->json($hasil);

  }
  

  /////////////////////////////////////////////LIHAT JABATAN FUNGSIONAL////////////////////////////////////////////////
  public function LihatJabFungsional($id_pegawai){

      $CheckJabPegFungional = DB::table('a_honor_pegawai')
      ->join('pegawai','a_honor_pegawai.id_pegawai_fk2','=','pegawai.id_pegawai')
      ->select('a_honor_pegawai.*','pegawai.nama_karyawan')->where('id_pegawai_fk2','=',$id_pegawai)->get();

      if ($CheckJabPegFungional->isEmpty()) {
          return response()->json('<center>Tidak Ada Jabatan Fungsional ! <a href="#" data-toggle="tooltip" data-placement="bottom" title="TAMBAH HONOR" class="TambahHonor" IdPegawai='.$id_pegawai.'> Tambah Honor Pegawai ?</center>');
      }else{

      $button ="<table class='table table-dark table-striped'>";
        $button .="<thead>";
          $button .="<tr>";
            $button .="<th scope='col' data-toggle='tooltip' data-placement='bottom' title='NAMA KARYAWAN'>Nama Karyawan</th>";
            $button .="<th scope='col' data-toggle='tooltip' data-placement='bottom' title='JABATAN FUNGSIONAL'>Jab Fung</th>";
            $button .="<th scope='col' data-toggle='tooltip' data-placement='bottom' title='PEMBIMBING TUGAS AKHIR 1'>P-TA 1</th>";
            $button .="<th scope='col' data-toggle='tooltip' data-placement='bottom' title='PEMBIMBING TUGAS AKHIR 2'>P-TA 2</th>";
            $button .="<th scope='col' data-toggle='tooltip' data-placement='bottom' title='PENGUJI TUGAS AKHIR'>Peng-TA</th>";
            $button .="<th scope='col' data-toggle='tooltip' data-placement='bottom' title='PENGUJI SEMINAR TUGAS AKHIR'>PS-PTA</th>";
            $button .="<th scope='col' data-toggle='tooltip' data-placement='bottom' title='PEMBIMBING KERJA PRAKTIK'>PKP</th>";
            $button .="<th scope='col'>Aksi</th>";
          $button .="</tr>";
        $button .="</thead>";
          $button .="<tbody>";

                foreach($CheckJabPegFungional as $value ) {
                  $button .="<tr>";
                    $button .="<td>".$value->nama_karyawan."</td>";
                    $button .="<td nowrap>".$value->jabatan_fungsional."</td>";
                    $button .="<td nowrap>".$value->p_t_a_satu."</td>";
                    $button .="<td nowrap>".$value->p_t_a_dua."</td>";
                    $button .="<td nowrap>".$value->p_tugas_akhir."</td>";
                    $button .="<td nowrap>".$value->p_seminar_p_t_a."</td>";
                    $button .="<td nowrap>".$value->pkp."</td>";
                    $button .="<td nowrap>";

                      $button .="<a href='#' data-toggle='tooltip' data-placement='left' title='EDIT HONOR'>";
                      $button .="<button type='button' class='btn btn-outline-primary btn-xs editHonor' idHonor=".$value->id_honor."><span class='fa fa-edit'></span></button>";
                      $button .="</a> | ";
                      $button .="<a href='".Route('destroy_set_honor',['id' => $value->id_honor])."' data-toggle='tooltip' data-placement='right' title='HAPUS HONOR' onclick='return confirm(\"Apakah Anda Yakin Menghapus Data Ini ? \" ) '><button type='button' class='btn btn-outline-danger btn-xs'><span class='fa fa-trash'></span></button></a>"; 
                    $button .="</td>";
                  $button .="</tr>";
                  }
                $button .="</tbody>";
              $button .="</table>";
      }
      return response()->json($button);

  }  

  //////////////////////////////////////VIEW TAMPILAN TAMBAH HONOR PEGAWAI/KARYAWAN 2.0//////////////////////////////////////
  public function TambahHonorView($id_pegawai){

       $honor = DB::table('pegawai')->select('pegawai.nama_karyawan')->where('id_pegawai','=',$id_pegawai)->first();

       $button ='<label>Nama Karyawan  : <h4>'.$honor->nama_karyawan.'</h4></label><hr style="margin-top: 0px;margin-bottom: 0.5rem;">';
       $button.='<input type="hidden" name="id_pegawai" value="'.$id_pegawai.'">';
       $button .='<label>Jabatan Fungsional  :<font color="red" size="2px">*</font></label>';
       $button .='<div class="form-group">';
         $button .='<input type="text" name="jabatan_fungsional" class="form-control"  placeholder="Asisten Ahli" required="">';
       $button .='</div>';
       $button .='<label>Pembimbing Tugas Akhir Pertama :<font color="red" size="2px">*</font></label>';
       $button .='<div class="form-group">';
         $button .='<input type="number" name="pta1" class="form-control" required="" placeholder="100000">';
       $button .='</div>';
       $button .='<label>Pembimbing Tugas Akhir kedua :<font color="red" size="2px">*</font></label>';
       $button .='<div class="form-group">';
         $button .='<input type="number" name="pta2" class="form-control"  required="" placeholder="100000">';
       $button .='</div>';
       $button .='<label>Penguji Tugas Akhir :<font color="red" size="2px">*</font></label>';
       $button .='<div class="form-group">';
         $button .='<input type="number" name="peng_ta" class="form-control"  required="" placeholder="100000">';
       $button .='</div>';
       $button .='<label>Penguji Seminar Proposal Tugas Akhir :<font color="red" size="2px">*</font></label>';
       $button .='<div class="form-group">';
         $button .='<input type="number" name="peng_s_ta" class="form-control" required="" placeholder="100000">';
       $button .='</div>';
       $button .='<label>Pembimbing Kerja Praktik :<font color="red" size="2px">*</font></label>';
       $button .='<div class="form-group">';
         $button .='<input type="number" name="pkp" class="form-control" required="" placeholder="100000">';
       $button .='</div>';


      return response()->json($button);        

  }

  //////////////////////////////////////VIEW TAMPILAN EDIT HONOR PEGAWAI/KARYAWAN 2.0//////////////////////////////////////
  public function ViewEditHonor($id){

      $honor = DB::table('a_honor_pegawai')
      ->join('pegawai','a_honor_pegawai.id_pegawai_fk2','=','pegawai.id_pegawai')
      ->select('a_honor_pegawai.*','pegawai.nama_karyawan')
      ->where('id_honor','=',$id)->first();

       $button ='<label>Nama Karyawan  : <h4>'.$honor->nama_karyawan.'</h4></label><hr style="margin-top: 0px;margin-bottom: 0.5rem;">';
       $button.='<input type="hidden" name="id_honor" value="'.$honor->id_honor.'">';
       $button .='<label>Jabatan Fungsional  :<font color="red" size="2px">*</font></label>';
       $button .='<div class="form-group">';
         $button .='<input type="text" name="jabatan_fungsional" class="form-control" value="'.$honor->jabatan_fungsional.'"  placeholder="Asisten Ahli" required="">';
       $button .='</div>';
       $button .='<label>Pembimbing Tugas Akhir Pertama :<font color="red" size="2px">*</font></label>';
       $button .='<div class="form-group">';
         $button .='<input type="number" name="pta1" class="form-control" value="'.$honor->p_t_a_satu.'" required="" placeholder="100000">';
       $button .='</div>';
       $button .='<label>Pembimbing Tugas Akhir kedua :<font color="red" size="2px">*</font></label>';
       $button .='<div class="form-group">';
         $button .='<input type="number" name="pta2" class="form-control" value="'.$honor->p_t_a_dua.'" required="" placeholder="100000">';
       $button .='</div>';
       $button .='<label>Penguji Tugas Akhir :<font color="red" size="2px">*</font></label>';
       $button .='<div class="form-group">';
         $button .='<input type="number" name="peng_ta" class="form-control" value="'.$honor->p_tugas_akhir.'" required="" placeholder="100000">';
       $button .='</div>';
       $button .='<label>Penguji Seminar Proposal Tugas Akhir :<font color="red" size="2px">*</font></label>';
       $button .='<div class="form-group">';
         $button .='<input type="number" name="peng_s_ta" class="form-control" value="'.$honor->p_seminar_p_t_a.'" required="" placeholder="100000">';
       $button .='</div>';
       $button .='<label>Pembimbing Kerja Praktik :<font color="red" size="2px">*</font></label>';
       $button .='<div class="form-group">';
         $button .='<input type="number" name="pkp" class="form-control" value="'.$honor->pkp.'" required="" placeholder="100000">';
       $button .='</div>';


      return response()->json($button);

  }

  ////////////////////////////////////////////////////2.0///////////////////////////////////////////////////


  public function CekUserPeg(Request $request){

      if (Input::get('id')) {
        $set = Input::get('id');

        $IdUserGanda = DB::table('pegawai')->select('id_user')->where('id_user','=',$set)->count();
        $NmPegGanda = DB::table('pegawai')->select('nama_karyawan')->where('id_user','=',$set)->first();

          if ($IdUserGanda > 0) {
          $return = "<font class='bg-danger' size='2'>User Ini Sudah Terdaftar. | Pemilik ".$NmPegGanda->nama_karyawan."</font>";
          return $return;
        }else{
          return "f12we";
        }
      }else{
      }
  }

  ///////////////////////////////////////////////tambah/////////////////////////////////////////////////////////////
  public function showtambah(){
        
       $button ='<label>Akun User: <font size="1" color="yellow"> *Jika ada, Jika belum ada harap buat akun terlebih dahulu, atau kosongkan saja</font></label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-user-shield"></i></span>';
       $button .='</div>';
       $usr= DB::table('users')
       ->select('users.name','users.id')->orderBy('users.name','ASC')->get();
       $button .='<select class="form-control selecthjy" id="CekUser" name="akun_user">';
       $button .='<option value="">Pilih Akun Yang Sudah Ada</option>';
       foreach ($usr as $keyusr => $usrShow) {
       $button .='<option value="'.$usrShow->id.'"><b>'.$usrShow->name.'</b></option>';
       }
       $button .='</select>';
       $button .='</div>';
       $button .='<div id="UserDanger"></div>';
       $button .='<br><a href="'.Route('UserIndex').'" class="btn btn-xs btn-info">buat akun</a>';
       $button .='</div>';


       $button .='<label>Nama Karyawan : <font size="2" color="yellow"> *wajib diisi</font></label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-id-card"></i></span>';
       $button .='</div>';
       $button .='<input type="text" name="nama_karyawan" class="form-control" placeholder="Suharyadi" autocomplete="off" required>';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>Status: <font size="2" color="yellow"> *wajib diisi</font></label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-user-check"></i></span>';
       $button .='</div>';
       $button .='<select class="form-control select" name="status_aktif" required>
                      <option value="">Pilih</option>
                      <option value="Aktif">Aktif</option>
                      <option value="Tidak Aktif">Tidak Aktif</option>
                      <option value="Honorer Aktif">Honorer Aktif</option>
                      <option value="Honorer Tidak Aktif">Honorer Tidak Aktif</option>
                      <option value="Cuti Kuliah">Cuti Kuliah</option>
                      <option value="Penguji Ahli Dosen Luar">Penguji Ahli (Dosen Luar)</option>
                  </select>';
       $button .='</div>';
       $button .='</div>';


       $button .='<label>NIP : <font size="2" color="yellow"> *wajib diisi</font></label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-id-card"></i></span>';
       $button .='</div>';
       $button .='<input type="text" name="nip" class="form-control" placeholder="Masukan NIP" autocomplete="off" required>';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>NIDN :</label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-id-card"></i></span>';
       $button .='</div>';
       $button .='<input type="text" name="nidn" class="form-control"  placeholder="Masukan NIDN" autocomplete="off">';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>NITK :</label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-id-card"></i></span>';
       $button .='</div>';
       $button .='<input type="text" name="nitk" class="form-control"  placeholder="Masukan NITK" autocomplete="off">';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>TMT :</label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>';
       $button .='</div>';
       $button .='<input type="date" name="tmt" class="form-control" placeholder="Masukan TMT" autocomplete="off" >';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>TMK :</label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>';
       $button .='</div>';
       $button .='<input type="date" name="tmk" class="form-control" placeholder="Masukan TMK" autocomplete="off">';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>Jabatan Pegawai: <font size="2" color="yellow"> *wajib diisi</font></label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-user-md"></i></span>';
       $button .='</div>';
       $jabs= DB::table('b_set_detail_jabatan')
       ->join('b_set_jabatan','b_set_detail_jabatan.id_set_jabatan','=','b_set_jabatan.id_set_jabatan')
       ->select('b_set_detail_jabatan.id_detail_jabatan','b_set_detail_jabatan.id_set_jabatan','b_set_detail_jabatan.nama_detail_jabatan','b_set_jabatan.nama_jabatan')
       ->orderBy('b_set_jabatan.nama_jabatan','ASC')
       ->orderBy('b_set_detail_jabatan.nama_detail_jabatan','ASC')
       ->get();
       $button .='<select class="form-control select" name="jabatan_auto" required>';
       $button .='<option value="">Pilih Jabatan</option>';
       foreach ($jabs as $keyjb => $jb) {
       $button .='<option value="'.$jb->id_detail_jabatan.'"><b>'.$jb->nama_jabatan.'</b> | '.$jb->nama_detail_jabatan.'</option>';
       }
       $button .='</select>';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>Program Studi : <font size="2" color="yellow"> *prodi diisi jika dibutuhkan</font></label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-book"></i></span>';
       $button .='</div>';
       $prodi= DB::table('a_prodi')->select('id_prodi','nama_prodi')->orderBy('nama_prodi','ASC')->get();
       $button .='<select class="form-control" name="prodi">';
       $button .='<option value="">Pilih Prodi</option>';
       foreach ($prodi as $kp => $prd) {
       $button .='<option value="'.$prd->id_prodi.'">'.$prd->nama_prodi.'</option>';
       }
       $button .='</select>';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>Keterangan/History :</label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-history"></i></span>';
       $button .='</div>';
       $button .='<textarea type="text" name="keterangan" class="form-control"  placeholder="Masukan Keterangan" autocomplete="off"></textarea>';
       $button .='</div>';
       $button .='</div>';
     

      return response()->json($button);
      //return view('admin.dashboard.pegawai.tambahpegawai');
      
  }

   ///////////////////////////////////////////////Edit/////////////////////////////////////////////////////////////
  public function ViewEditPeg($id){
        

       $pegawai = DB::table('pegawai')->select('*')->where('id_pegawai','=',$id)->first();


       $button ='<label>Edit Pegawai  : <h4>'.$pegawai->nama_karyawan.'</h4></label>
       <a href="#"  class="btn bg-gradient-primary btn-xs LihatJabatan" style="float:right"  DataIdPegawai="'.$id.'">Edit Jabatan Dan Prodi</a><hr style="margin-top: 0px;margin-bottom: 0.5rem;">
       ';

       $button .='<label>Akun User: <font size="1" color="yellow"> *Jika ada, Jika belum ada harap buat akun terlebih dahulu, atau kosongkan saja</font></label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-user-shield"></i></span>';
       $button .='</div>';
       $usr= DB::table('users')
       ->select('users.name','users.id')->orderBy('users.name','ASC')->get();
       $button .='<select class="form-control selecthjj" id="CekUserhtjj" name="akun_user">';
       foreach ($usr as $keyusr => $usrShow) {

        if ($usrShow->id==$pegawai->id_user) {
          $button .='<option value="'.$usrShow->id.'" '.(($usrShow->id==$pegawai->id_user)?'selected="selected"':"").'><b>'.$usrShow->name.'</b></option>';

          break;
        }elseif (is_null($pegawai->id_user)) {
          
          if ($keyusr == 0) {
          $button .='<option value="">Pilih Akun Yang Sudah Ada</option>';
          }
          $button .='<option value="'.$usrShow->id.'" '.(($usrShow->id==$pegawai->id_user)?'selected="selected"':"").'><b>'.$usrShow->name.'</b></option>';
        }else{

        }
      
       }
       $button .='</select>';
       $button .='</div>';
       $button .=''.(($pegawai->id_user)?' <label><font size="2" color="red"> *Pegawai ini telah memiliki akun user</font></label> ':"").'';
       $button .='<div id="UserDangerftg"></div>';
       $button .='<br><a href="'.Route('UserIndex').'" class="btn btn-xs btn-info '.(($pegawai->id_user)?'disabled':"").'" >buat akun</a>';
       $button .='</div>';


       $button .='<input type="hidden" name="id_peg" value="'.$id.'" required>';
       $button .='<label>Nama Karyawan: <font size="2" color="yellow"> *wajib diisi</font></label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-id-card"></i></span>';
       $button .='</div>';
       $button .='<input type="text" name="nama_karyawan" value="'.$pegawai->nama_karyawan.'" class="form-control" placeholder="Suharyadi" autocomplete="off" required>';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>Status: <font size="2" color="yellow"> *wajib diisi</font></label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-user-check"></i></span>';
       $button .='</div>';
       $button .='<select class="form-control select" name="status_aktif" required>
      <option value="">Pilih Pilih</option>
      <option value="Aktif" '.(($pegawai->status_aktif=='Aktif')?'selected="selected"':"").'>Aktif</option>
      <option value="Tidak Aktif" '.(($pegawai->status_aktif=='Tidak Aktif')?'selected="selected"':"").'>Tidak Aktif</option>
      <option value="Honorer Aktif" '.(($pegawai->status_aktif=='Honorer Aktif')?'selected="selected"':"").'>Honorer Aktif</option>
      <option value="Honorer Tidak Aktif" '.(($pegawai->status_aktif=='Honorer Tidak Aktif')?'selected="selected"':"").'>Honorer Tidak Aktif</option>
      <option value="Cuti Kuliah" '.(($pegawai->status_aktif=='Cuti Kuliah')?'selected="selected"':"").'>Cuti Kuliah</option>
      <option value="Penguji Ahli Dosen Luar" '.(($pegawai->status_aktif=='Penguji Ahli Dosen Luar')?'selected="selected"':"").'>Penguji Ahli (Dosen Luar)</option>
                  </select>';
       $button .='</div>';
       $button .='</div>';

       
       $button .='<label>NIP : <font size="2" color="yellow"> *wajib diisi</font></label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-id-card"></i></span>';
       $button .='</div>';
       $button .='<input type="text" name="nip" class="form-control" value="'.$pegawai->nip.'" placeholder="Masukan NIP" autocomplete="off" required>';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>NIDN :</label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-id-card"></i></span>';
       $button .='</div>';
       $button .='<input type="text" name="nidn" class="form-control" value="'.$pegawai->nidn.'" placeholder="Masukan NIDN" autocomplete="off">';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>NITK :</label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-id-card"></i></span>';
       $button .='</div>';
       $button .='<input type="text" name="nitk" class="form-control" value="'.$pegawai->nitk.'" placeholder="Masukan NITK" autocomplete="off">';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>TMT :</label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>';
       $button .='</div>';
       $button .='<input type="date" name="tmt" class="form-control" value="'.$pegawai->tmt.'" placeholder="Masukan TMT" autocomplete="off">';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>TMK :</label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>';
       $button .='</div>';
       $button .='<input type="date" name="tmk" class="form-control" value="'.$pegawai->tmk.'" placeholder="Masukan TMK" autocomplete="off">';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>Tanggal Keluar :<font color="yellow" size="2">*Diisi jika karyawan keluar</font></label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>';
       $button .='</div>';
       $button .='<input type="date" name="tanggal_keluar" class="form-control" value="'.$pegawai->tanggal_keluar.'" placeholder="Masukan Tanggal Keluar" autocomplete="off">';
       $button .='</div>';
       $button .='</div>';

       $button .='<label>Keterangan/History :</label>';
       $button .='<div class="form-group">';
       $button .='<div class="input-group">';
       $button .='<div class="input-group-prepend">';
       $button .='<span class="input-group-text"><i class="fa fa-history"></i></span>';
       $button .='</div>';
       $button .='<textarea type="text" name="keterangan" class="form-control"  placeholder="Masukan Keterangan" autocomplete="off">'.$pegawai->keterangan_histori.'</textarea>';
       $button .='</div>';
       $button .='</div>';

     

      return response()->json($button);
      //return view('admin.dashboard.pegawai.tambahpegawai');
      
  }
      /**
       * Create a new user instance after a valid registration.
       *
       * @param  array  $data
       * @return User
       */

  public function tambahpegawai(Request $request){

      $IdUserGanda = DB::table('pegawai')->select('id_user')->where([['id_user','=',$request->akun_user],['id_user','!=',null]])->first();
      $NmPegGanda = DB::table('pegawai')->select('nama_karyawan')->where([['id_user','=',$request->akun_user],['id_user','!=',null]])->first();

      if ($IdUserGanda > 0) {
      return Response::json(array('ceks' => 'userganda','nm_kar' => $request->NmPegGanda,'errors' => false), 200);
      }

      //cek nidn dan nip ganda
      $nip_count = DB::table('pegawai') ->where([['nip', '=', $request->nip],['id_pegawai','!=',$request->id_peg],['nip','!=',null]]) ->count(); 
      $nidn_count = DB::table('pegawai') ->where([['nidn', '=', $request->nidn],['id_pegawai','!=',$request->id_peg],['nidn','!=',null]]) ->count(); 
      $nitk_count = DB::table('pegawai') ->where([['nitk', '=', $request->nitk],['id_pegawai','!=',$request->id_peg],['nitk','!=',null]]) ->count(); 
      if ($nip_count > 0) { return Response::json(array( 'ceks' => 'duplikatnip', 'errors' => false, ), 200); } if ($nidn_count > 0) { return Response::json(array( 'ceks' => 'duplikatnidn', 'errors' => false, ), 200); }
      if ($nitk_count > 0) { return Response::json(array( 'ceks' => 'duplikatnitk', 'errors' => false, ), 200); }

      $jabs= DB::table('b_set_detail_jabatan')
      ->join('b_set_jabatan','b_set_detail_jabatan.id_set_jabatan','=','b_set_jabatan.id_set_jabatan')
      ->select('b_set_jabatan.nama_jabatan','nama_detail_jabatan')
      ->where('b_set_detail_jabatan.id_detail_jabatan','=',$request->jabatan_auto)
      ->first();

      try {
        DB::table('pegawai')->insert(
         [ 'nip' => $request->nip, 'nidn' => $request->nidn, 'nitk' => $request->nitk, 'nama_karyawan' => $request->nama_karyawan, 'tmt' => $request->tmt, 'tmk' => $request->tmk, 'status_aktif' => $request->status_aktif, 'keterangan_histori' => $request->keterangan,'id_user' => $request->akun_user, 'created_at' => \Carbon\Carbon::now() ]
        );

        $last_id = DB::getPDO()->lastInsertId();
         
        DB::table('jabatan_pegawai')->insert([
                'id_pegawai_fk' => $last_id,
                'nm_jabatan' => $this->cekgol($jabs->nama_jabatan).$jabs->nama_detail_jabatan,
                'detail_jabatan' => $request->jabatan_auto,
                'prodi' => $request->prodi,
            ]);
        return Response::json(array(
                            'ceks' => 'berhasil',
                            'nm_kar' => $request->nama_karyawan,
                            'errors' => false,
                        ), 200);

      } catch (Exception $e) {
        return Response::json(array(
                            'ceks' => 'gagal',
                            'nm_kar' => $request->nama_karyawan,
                            'errors' => false,
                        ), 200);
      }
  }
  //PEMISAH GOLONGAN JABATAN
  protected function cekgol($a){ switch ($a) { case 'Dosen': return $GolonganJab = $a.' '; break; case 'Ko.Prodi': return $GolonganJab = $a.' '; break; case 'Dekan': return $GolonganJab = $a.' '; break; case 'Koordinator': return $GolonganJab = $a.' '; break; case 'Sekretaris Dekan': return $GolonganJab = $a.' '; break; default: break; } }

  ///////////////////////////////////////////////tambah/////////////////////////////////////////////////////////////


  /////////////////////////////////////////////UBAH JABATAN/////////////////////////////////////////////
  public function UbahNamaJabatan(Request $request){

      $jabs= DB::table('b_set_detail_jabatan')
           ->join('b_set_jabatan','b_set_detail_jabatan.id_set_jabatan','=','b_set_jabatan.id_set_jabatan')
           ->select('b_set_jabatan.nama_jabatan','nama_detail_jabatan')
           ->where('b_set_detail_jabatan.id_detail_jabatan','=',$request->NamaJabs)
           ->first();

      try {
          DB::table('jabatan_pegawai')
          ->where('id_jabatan', $request->id_jabatan)
          ->update([

              'nm_jabatan' => $this->cekgol($jabs->nama_jabatan).$jabs->nama_detail_jabatan,
              'detail_jabatan' => $request->NamaJabs,
              'prodi' => $request->prodi,

          ]);

          return Response::json(array(
                                  'ceks' => 'berhasil',
                                  'errors' => false,
                              ), 200);

      } catch (Exception $e) {
          return Response::json(array(
                                  'ceks' => 'gagal',
                                  'errors' => false,
                              ), 200);
      }
  }
  /////////////////////////////////////////////UBAH JABATAN/////////////////////////////////////////////

  ///////////////////////////////////////////////tambahjabatan///////////////////////////////////////////////////////

  public function showtambahjabatan(){

      $pegawai = Pegawai::orderBy('id_pegawai')->get();
      $jabs= DB::table('b_set_detail_jabatan')
       ->join('b_set_jabatan','b_set_detail_jabatan.id_set_jabatan','=','b_set_jabatan.id_set_jabatan')
       ->select('b_set_detail_jabatan.id_detail_jabatan','b_set_detail_jabatan.id_set_jabatan','b_set_detail_jabatan.nama_detail_jabatan','b_set_jabatan.nama_jabatan')->get();

      $prodi= DB::table('a_prodi')->select('id_prodi','nama_prodi')->get();

      return view('admin.dashboard.pegawai.tambahjabatanpegawai',['pegawai' => $pegawai, 'jabs' => $jabs,'prodi' => $prodi]);
      
  }

  public function tambahjabatan(Request $request){

    for ($i = 0; $i < count($request->input('jabatan')); $i++) {

    $jabs= DB::table('b_set_detail_jabatan')
         ->join('b_set_jabatan','b_set_detail_jabatan.id_set_jabatan','=','b_set_jabatan.id_set_jabatan')
         ->select('b_set_jabatan.nama_jabatan','nama_detail_jabatan')
         ->where('b_set_detail_jabatan.id_detail_jabatan','=',$request->jabatan[$i])
         ->first();

    $dataSet[] = [
                  'id_pegawai_fk' => $request->input('id_pegawai'),
                  'nm_jabatan' => $this->cekgol($jabs->nama_jabatan).$jabs->nama_detail_jabatan,
                  'detail_jabatan' => $request->jabatan[$i],
                  'prodi' => $request->prodi[$i],
              ];
      }
    $tambah_jab = DB::table('jabatan_pegawai')->insert($dataSet);

       if ($tambah_jab) {
          alert()->success('Jabatan Pegawai', 'Berhasil Tambah Jabatan Pegawai')->persistent('Close');
          return Redirect::action('Pegawai\PegawaiController@index');
       }else{
          alert()->error('Jabatan Pegawai', 'Gagal Tambah Jabatan Pegawai')->persistent('Close');
          return Redirect::action('Pegawai\PegawaiController@showtambahjabatan');
       }
  }

  ///////////////////////////////////////////////tambahjabatan///////////////////////////////////////////////////////

  public function simpanedit(Request $request){
      //cek nidn dan nip ganda
      $nip_count = DB::table('pegawai') ->where([['nip', '=', $request->nip],['id_pegawai','!=',$request->id_peg],['nip','!=',null]])->count(); 
      $nidn_count = DB::table('pegawai') ->where([['nidn', '=', $request->nidn],['id_pegawai','!=',$request->id_peg],['nidn','!=',null]])->count(); 
      $nitk_count = DB::table('pegawai') ->where([['nitk', '=', $request->nitk],['id_pegawai','!=',$request->id_peg],['nitk','!=',null]])->count(); 

      if ($nip_count > 0) { return Response::json(array( 'ceks' => 'duplikatnip', 'errors' => false, ), 200); } if ($nidn_count > 0) { return Response::json(array( 'ceks' => 'duplikatnidn', 'errors' => false, ), 200); }
      
      if ($nitk_count > 0) { return Response::json(array( 'ceks' => 'duplikatnitk', 'errors' => false, ), 200); }
  
      try {
      DB::table('pegawai') ->where('id_pegawai', $request->id_peg) ->update([ 'nip' => $request->nip, 'nidn' => $request->nidn, 'nitk' => $request->nitk, 'nama_karyawan' => $request->nama_karyawan,'id_user' => $request->akun_user, 'tmt' => $request->tmt, 'tmk' => $request->tmk, 'status_aktif' => $request->status_aktif, 'keterangan_histori' => $request->keterangan,'tanggal_keluar' => $request->tanggal_keluar, 'updated_at' => \Carbon\Carbon::now() ]);
      return Response::json(array( 'ceks' => 'berhasil', 'errors' => false, ), 200);
      }catch (Exception $e) {
      return Response::json(array( 'ceks' => 'gagal', 'errors' => false, ), 200);
      }
  }

  ///////////////////////////////////////////////Edit////////////////////////////////////////////////////////////

  ///////////////////////////////////////////////Hapus/////////////////////////////////////////////////////////////
  public function destroy($id){

    $cek_user = DB::table('pegawai')->select('id_user')->where('id_pegawai','=',$id)->first();
    
    if($this->cek_akses('83') == 'yes'){
            $nrd = DB::delete("delete from pegawai where id_pegawai = '$id'");
            $nrd2 = DB::delete("delete from jabatan_pegawai where id_pegawai_fk = '$id'");
            DB::table('b_data_diri')->where('id_user', '=', $cek_user->id_user)->delete();
            DB::table('b_identitas_lainnya')->where('id_user', '=', $cek_user->id_user)->delete();
            DB::table('b_kontak_darurat')->where('id_user', '=', $cek_user->id_user)->delete();
            DB::table('b_marital')->where('id_user', '=', $cek_user->id_user)->delete();
            DB::table('b_marital_pasangan')->where('id_user', '=', $cek_user->id_user)->delete();
            DB::table('b_perguruan_tinggi')->where('id_user', '=', $cek_user->id_user)->delete();
            DB::table('b_sma_sederajat')->where('id_user', '=', $cek_user->id_user)->delete();


            if (!$nrd && $nrd2) {
               
                alert()->error('Pegawai', 'Gagal Menghapus Pegawai')->persistent('Close');
                return Redirect::route('pegawai.show');

            }else{
                alert()->success('Pegawai', 'Berhasil Hapus Data Pegawai')->persistent('Close');
                return Redirect::route('pegawai.show');
        }
    }else{

        alert()->error('Pegawai', 'Tidak Memiliki Hak Akses Untuk Menghapus Pegawai')->persistent('Close');
                return Redirect::route('pegawai.show');

    } 

  }
  ///////////////////////////////////////////////Hapus/////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////Hapus Jabatan/////////////////////////////////////////////////////
  public function destroyjabatan($id){

      if($this->cek_akses('83') == 'yes'){

          $jabatan = DB::delete("delete from jabatan_pegawai where id_jabatan = '$id'");
          //Jurusan::where('jurKode','=', $id)->first();
          if (!$jabatan) {
             
              alert()->error('Pegawai', 'Gagal Menghapus Jabatan')->persistent('Close');
              return Redirect::route('pegawai.show');

          }else{
              alert()->success('Pegawai', 'Berhasil Hapus Jabatan Pegawai')->persistent('Close');
              return Redirect::route('pegawai.show');
          }

      }else{
          alert()->error('Pegawai', 'Tidak Memiliki Hak Akses Untuk Menghapus Jabatan')->persistent('Close');
              return Redirect::route('pegawai.show');
      }
  }
 ///////////////////////////////////////////////Hapus Jabatan//////////////////////////////////////////////////////


public function ViewKategoriJabatan(){

  return view('admin.dashboard.pegawai.kategori_jabatan');

}

public function GetDataKatJabatan(Request $request){

      return DataTables::of(DB::table('b_set_jabatan')
      ->select('b_set_jabatan.id_set_jabatan','b_set_jabatan.nama_jabatan','b_set_jabatan.id_set_jabatan','b_set_jabatan.lengkap','b_set_jabatan.kategori')
   
      )
      ->addColumn('jabatan_detail', function($data){

        $cek_jab = DB::table('b_set_detail_jabatan')
        ->join('b_set_jabatan','b_set_jabatan.id_set_jabatan','=','b_set_detail_jabatan.id_set_jabatan')
        ->select('b_set_jabatan.nama_jabatan','b_set_detail_jabatan.nama_detail_jabatan','b_set_detail_jabatan.id_detail_jabatan')
        ->where('b_set_detail_jabatan.id_set_jabatan','=',$data->id_set_jabatan)
        ->orderBy('b_set_detail_jabatan.nama_detail_jabatan','ASC')
        ->get();

        $button=[];
        foreach($cek_jab as $key )
        $button[] = $key->nama_detail_jabatan;
        

        return $button;

        
      })
      ->addColumn('action', function($data){

              $button =   '
                      <a data-toggle="tooltip" data-placement="top" title="EDIT JABATAN KATEGORI UTAMA">
                      <button type="button" class="btn btn-outline-primary btn-xs EditPegawaiJab" IdPegawai="'.$data->id_set_jabatan.'" NamaJabatan="'.$data->nama_jabatan.'" LengkapJabatan="'.$data->lengkap.'" KategoriJabatan="'.$data->kategori.'"><span class="fa fa-edit"></span></button>
                      </a> | 
                    <a data-toggle="tooltip" data-placement="top" title="HAPUS JABATAN KATEGORI UTAMA"><button type="button" class="btn btn-outline-danger btn-xs HapKatJab" IdHapKatJab="'.$data->id_set_jabatan.'"><span class="fa fa-trash"></span></button></a> 
                     ';

              return $button;

          })

          ->rawColumns(['action'])
          ->make(true);
  

}

//MANAGEMENT JABATAN
public function TambahKatJab(Request $request){

    $tesGanda = DB::table('b_set_jabatan')->where('nama_jabatan','=',$request->nama_jabatan)->count();
    
    if ($tesGanda > 0) {
        return Response::json(array(
          'ceks' => 'ganda',
          'errors' => false,
          ), 200);
    }

      try{
        $dataSet[] = [
          'nama_jabatan' => $request->input('nama_jabatan'),
          'lengkap' => $request->input('nama_lengkap_jabatan'),
          'kategori' => $request->input('kategori_jabatan'),
        ];
        DB::table('b_set_jabatan')->insert($dataSet);
        $last_id = DB::getPDO()->lastInsertId();
        $dataSet2[] = [
          'id_set_jabatan' => $last_id,
          'nama_detail_jabatan' => $request->input('nama_detail_jabatan'),
        ];
        DB::table('b_set_detail_jabatan')->insert($dataSet2);
        return Response::json(array(
          'ceks' => 'berhasil',
          'errors' => false,
      ), 200);
    
    }catch (Exception $e) {
      return Response::json(array(
        'ceks' => 'gagal',
        'errors' => false,
    ), 200);
    }
} 

//EDIT KATEGORI JABATAN
public function EditKatJab(Request $request){

  $tesGanda = DB::table('b_set_jabatan')->where([['nama_jabatan','=',$request->nama_jabatan],['id_set_jabatan','!=',$request->id_set_jabatan]])->count();
  
  if ($tesGanda > 0) {
    return Response::json(array(
      'ceks' => 'ganda',
      'errors' => false,
      ), 200);
  }

  try{
      DB::table('b_set_jabatan')
      ->where('id_set_jabatan','=',$request->id_set_jabatan)
      ->update([
              'nama_jabatan' => $request->nama_jabatan,
              'kategori' => $request->kategori_jabatan,
              'lengkap' => $request->nama_lengkap_jabatan,
            ]);
      return Response::json(array('ceks'=>'berhasil','errors'=>false,),200);
    }catch (Exception $e) {
      return Response::json(array('ceks'=>'gagal','errors'=>false,),200);
  }
}

//HAPUS JABATAN KATEGORI UTAMA
public function DestroyKatab(Request $request){

  $tesGanda = DB::table('b_set_detail_jabatan')->where('id_set_jabatan','=',$request->IdSetJab)->count();
  if ($tesGanda > 0) {
    return Response::json(array('ceks'=>'anak-anak','errors'=>false,),200);
  }
  try{
    DB::table('b_set_jabatan')->where('id_set_jabatan','=',$request->IdSetJab)->delete();
    return Response::json(array('ceks'=>'berhasil','errors'=>false,),200);
  }catch (Exception $e) {
    return Response::json(array('ceks'=>'gagal','errors'=>false,),200);
  }
}

public function TambahDetailSaja(Request $request){

  $tesGanda = DB::table('b_set_detail_jabatan')->where([['id_set_jabatan','=',$request->id_set_jabatan],['nama_detail_jabatan','=',$request->nama_detail_jabatan]])->count();

  if ($tesGanda > 0) {
   return Response::json(array('ceks'=>'ganda','errors'=>false,),200);
  }
  try{
    $dataSet2[] = [
      'id_set_jabatan' => $request->input('id_set_jabatan'),
      'nama_detail_jabatan' => $request->input('nama_detail_jabatan'),
    ];
      DB::table('b_set_detail_jabatan')->insert($dataSet2);
      return Response::json(array('ceks'=>'berhasil','errors'=>false,),200);
    }catch (Exception $e) {
      return Response::json(array('ceks'=>'gagal','errors'=>false,),200);
    }

}

//HAPUS DETAIL JABATAN
public function DestroyDetailJab(Request $request){
  try{
    DB::table('b_set_detail_jabatan')->where([['id_set_jabatan', '=', $request->wakilHap2],['nama_detail_jabatan', '=', $request->wakilHap]])->delete();
    return Response::json(array('ceks'=>'berhasil','errors'=>false,),200);
  }catch (Exception $e) {
    return Response::json(array('ceks'=>'gagal','errors'=>false,),200);
  }
}

//EDIT DETAIL JABATAN
public function UpdateDetJab(Request $request){

 try{
    DB::table('b_set_detail_jabatan')
    ->where([['id_set_jabatan','=', $request->id_set_jabatan],['nama_detail_jabatan','=',$request->nama_detail_jabatan_old]])
    ->update(['nama_detail_jabatan' => $request->nama_detail_jabatan]);
    return Response::json(array('ceks'=>'berhasil','errors'=>false,),200);
  }catch (Exception $e) {
    return Response::json(array('ceks'=>'gagal','errors'=>false,),200);
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

protected function formatBytes($bytes) {
  if ($bytes > 0) {
      $i = floor(log($bytes) / log(1024));
      $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
      return sprintf('%.02F', round($bytes / pow(1024, $i),1)) * 1 . ' ' . @$sizes[$i];
  } else {
      return 0;
  }
}


}
