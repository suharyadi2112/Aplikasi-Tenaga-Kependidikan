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

class CutiPegawai extends Controller
{
	//INDEX
    public function IndexCutiPegawai(Request $request){

    	return view('admin.dashboard.CutiPegawai.index',['awal' => $request->PeriodeAkhir,'akhir' => $request->PeriodeAkhir]);

    }

    //GET DATA SERVERSIDE
    public function GetCutiPegawai(Request $request,$periode){

    	return DataTables::of(DB::table('c_cuti')
        ->join('pegawai', 'pegawai.id_pegawai', '=', 'c_cuti.id_pegawai') 
        ->join('c_periode_cuti','c_periode_cuti.id_kategori','=','c_cuti.id_periode')
        ->select(   
                    'c_cuti.id_cuti',
                    'c_cuti.id_pegawai',
                    'c_cuti.hak_cuti',
                    'c_cuti.sisa_cuti',
                    'c_cuti.tahun',
                    'pegawai.tmk',
                    'pegawai.nama_karyawan',
                    'c_periode_cuti.id_kategori',
                    'c_periode_cuti.periode_awal',
                    'c_periode_cuti.periode_akhir'

                )
        ->where('c_periode_cuti.periode_awal','=',$periode)
        )
        ->addIndexColumn()
        ->addColumn('CutiBersama', function($data){
            	
         	$DatCutiBersama = DB::table('c_cuti_bersama')->select('tanggal_cuti','ket_cuti_bersama')->where('id_periode','=',$data->id_kategori)->get();
         	$button=[];
	        foreach($DatCutiBersama as $val )
	        $button[] = $val->tanggal_cuti.' | '.$val->ket_cuti_bersama;
	        return $button;
                  
        })
        ->addColumn('TotalCuti', function($data){
            
         	$ambilcuti = DB::table('c_detail_cuti')//->select('id_set_cuti','id_cuti','id_bukti','ambil_cuti','ket_cuti')
         	->where('id_cuti','=',$data->id_cuti)->count();
         	
	        return '<b>'.$ambilcuti.' Hari</b>';
                  
        })
        ->addColumn('cutiambil', function($data){
           
         	$cek = '<div class="btn-group dropleft">';

          if ($this->cek_akses('106') == 'yes') {
            $cek .=  '<button type="button" class="btn btn-outline-primary btn-sm LihatAmbilCuti" data-id="'.$data->id_cuti.'" >
             <span class="fa fa-user-clock"></span> Ambil Cuti</button>';
          }else{
            $cek .=  '<a href="#" onclick="alert(\'Tidak ada akses\')"><button type="button" class="btn btn-outline-primary btn-sm" >
             <span class="fa fa-user-clock"></span> Ambil Cuti </button></a>';
          }
          $cek .= '<button type="button" class="btn btn-warning dropdown-toggle dropdown-icon btn-sm" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span><span class="fa fa-cogs"></span>
                    </button>
                    <div class="dropdown-menu" role="menu">';
          if ($this->cek_akses('107') == 'yes') {
            $cek .= '<button type="button" class="dropdown-item UbahCutiKaryawan" data-id="'.$data->id_cuti.'" href="#" title="Edit Data Yang Tersedia Dari Karyawan Ini"><span class="fa fa-pencil-alt"></span> Edit</button>';
          }else{
            $cek .=  '<a href="#" onclick="alert(\'Tidak ada akses\')"><button type="button" class="dropdown-item" title="Tidak Ada Akses"><span class="fa fa-pencil-alt" ></span> Edit  </button></a>';
          }

          if ($this->cek_akses('108') == 'yes') {
            $cek .= '<button type="button" class="dropdown-item HapusKaryawanCuti" data-id='.$data->id_cuti.' title="Hapus Karyawan Ini Dari List Cuti"><span class="fa fa-trash"></span> Hapus</button>';
          }else{
            $cek .= '<a href="#" onclick="alert(\'Tidak ada akses\')"><button type="button" class="dropdown-item" title="Anda Tidak Memiliki Akses"><span class="fa fa-trash"></span> Hapus  </button></a>';
          }            
                    
           $cek .= '</div>
                  </div>';
	        return $cek;
                  
        })
        ->addColumn('periode', function($data){
          return $this->tanggal_indo($data->periode_awal).' - '.$this->tanggal_indo($data->periode_akhir);
        })
        ->rawColumns(['CutiBersama','cutiambil','periode','TotalCuti'])
        ->make(true);

    }

    //CEK SISA CUTI PEGAWAI
    protected function SisaCuti($id_cuti){
      $cekCuti = DB::table('c_cuti')->select('sisa_cuti')->where('id_cuti','=', $id_cuti)->first();
      return $cekCuti;
    }

    //SHOW DETAIL AMBIL CUTI
    public function ShowDetailAmbilCuti(Request $request){

      if ($this->SisaCuti($request->id_cuti)->sisa_cuti <= 0) {
        $SisaCutil = 'CutiHabis';
      }else{
        $SisaCutil = 'MasihAda';
      }

        if ($this->cek_akses('106') == 'yes') {
          
          $ambilcuti = DB::table('c_detail_cuti')
          ->LeftJoin('c_bukti','c_bukti.c_bukti','=','c_detail_cuti.id_bukti')
          ->join('c_cuti','c_cuti.id_cuti','=','c_detail_cuti.id_cuti')
          ->select('c_detail_cuti.id_set_cuti','c_detail_cuti.id_cuti','c_detail_cuti.id_bukti','c_detail_cuti.ambil_cuti','c_detail_cuti.ket_cuti','c_bukti.filename','c_bukti.c_bukti','c_cuti.id_pegawai')
            ->where('c_detail_cuti.id_cuti','=',$request->id_cuti)->get();


          //CEK TANGGAL YANG TELAH DI PILIH SEBELUMNYA
          $cekBooking = DB::table('c_detail_cuti')->select('ambil_cuti')->where('id_cuti','=', $request->id_cuti)->get();
          if (!$cekBooking->isEmpty()) {
             foreach ($cekBooking as $ckjh) {
              $CekTang[] = $ckjh->ambil_cuti;
            }
          }else{
            $CekTang = '';
          }
         

          $output = '';
          $output.='   
            <a class="btn btn-sm btn-info" id="TmcutBtn" data-toggle="collapse" href="#TambahAmbilCutiCh" role="button" aria-expanded="false" aria-controls="TambahAmbilCutiCh">
                  <span id="spanAmCut" class="fa fa-plus-circle"> </span> Tambah Pengambilan Cuti
                </a>
              <a class="btn btn-sm btn-info" id="BtnUploadFileCut" data-toggle="collapse" cek="tes" href="#UploadFile" role="button" aria-expanded="false" aria-controls="UploadFile">
                  <span id="spanFileUpload" class="fa fa-file-image"> </span> Kelola File
                </a>
              <br><br>
              <div class="collapse" id="UploadFile" data_id="'.$request->id_cuti.'" style="padding-top:10px;">
                  <div class="card card-body bg-dark p-2">

            <div id="KontenUpload"></div>

          </div>
              </div>

              <form data-route="'. route('UpdateCutiPros') .'" id="UpdateCutiPros" role="form" method="POST" accept-charset="utf-8">
              <div class="card card-body bg-warning p-2" id="FormEditCuti" style="display: none;">
              <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label>Pilih Tanggal</label>
                            <input type="hidden" name="id_set_cuti" id="id_set_cuti" class="form-control" readonly required>
                            <input id="SetTanggalEdit" type="date" name="tanggal_cuti" class="form-control" required>
                        </div>
                      </div>
                     <div class="col-6">
                        <div class="form-group">
                          <label>Ketarangan Cuti</label>
                          <textarea name="ket_cuti" id="ket_cuti_ytr" class="form-control" placeholder="Masukan Keterangan Cuti"></textarea>
                        </div>
                      </div>
                     </div>
                     <div class="col-md-6 offset-md-6">
                      <button type="submit" class="btn btn-sm btn-info btn-flat UpdateAmbilCuti" style="float:right;"><span class="fa fa-pen-alt"></span> Update Data</button>
                      <button type="button" class="btn btn-sm btn-danger btn-flat CloseFormCut" style="float:right;"><span class="fa fa-times-circle"></span> Close</button>
                     </div>
                  </div>
              </div>
            </form>

              <form data-route="'. route('SimpanAmbilCuti') .'" id="SimpanPengambilanCuti" role="form" method="POST" accept-charset="utf-8">
          <div class="collapse" id="TambahAmbilCutiCh" style="padding-top:10px;">
                  <div class="card card-body bg-dark p-2">
                    <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          <label>Pilih Tanggal</label>
                            <input type="hidden" name="id_cuti" value="'.$request->id_cuti.'" class="form-control" readonly required>
                            <input id="mdp-demo" name="tanggal_cuti[]" class="form-control" placeholder="Click Disini" readonly required>
                        </div>
                      </div>
                     <div class="col-6">
                        <div class="form-group">
                          <label>Ketarangan Cuti</label>
                          <textarea name="ket_cuti" class="form-control" placeholder="Masukan Keterangan Cuti"></textarea>
                        </div>
                      </div>
                     </div>
                     <div class="col-md-6 offset-md-6">
                      <button type="submit" class="btn btn-sm btn-info SimpanAmbilCuti" style="float:right;"><span class="fa fa-save"></span> Simpan</button>
                     </div>
                   </div>
                 </div>
              </div>
             <form>
              ';
          $output .= '<div class="shadow-lg p-3 mb-5 bg-white rounded"><table class="table table-bordered table-hover" id="TablePengambilanCuti" width="100%">';
          $output .= '<thead>
                <tr>  
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>File</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table></div>';
        
            return Response::json(array('output' => $output,'ambil_cuti' => $CekTang,'akses' => $SisaCutil), 200);
          }else{
            return Response::json(array('akses' => 'noakses'), 200);
          }  

    
    }


    //KONTEN UPLOAD CUTI
   	public function KontenUploadCuti(Request $request){

      if ($this->cek_akses('110') == 'yes') {
        
        $ambilcuti = DB::table('c_detail_cuti')->select('id_set_cuti','ambil_cuti','created_at')
        ->where([['c_detail_cuti.id_cuti','=',$request->data_id],['c_detail_cuti.id_bukti','=',null]])->orderBy('ambil_cuti','DESC')->get();

          $output = '';
        $output .= '<form method="post" id="upload_form" enctype="multipart/form-data">
              <input type="hidden" name="id_cuti" value="'.$request->data_id.'" required>
              <div class="row">
                      <div class="col-12">
                        <table class="table table-sm table-bordered">
                <thead>
                  <tr>
                    <th scope="col"><span class="fa fa-check-circle"></span> Pilih Tanggal</th>
                    <th scope="col">Waktu Input</th>
                  </tr>
                </thead>
                <tbody>';

          foreach ($ambilcuti as $fth => $v) {

          $output .=      '<tr>
                        <td> 

                          <div class="icheck-primary d-inline">
                                    <input type="checkbox" name="PilTang[]" value="'.$v->id_set_cuti.'" id="PilTang'.$v->id_set_cuti.'">
                                    <label for="PilTang'.$v->id_set_cuti.'">
                                      <font size="2">'.$v->ambil_cuti.'</font>
                                    </label>
                                </div>
                                </td>
                        <td>'.$v->created_at.'</td>
                      </tr>';
          }
          $output .=      '</tbody>
                  </table>
                          </div>
                          <div class="col-12">
                            <label>Upload File</label><br>
                            <input type="file" name="select_file" id="select_file" required/>
                            <code style="background-color:white; padding:5px;">jpg, png, pdf</code><br><hr>
                          </div> 
                          </div>

                          <div class="col-md-6 offset-md-6">
                          <button type="submit" class="btn btn-sm btn-info UploadFileCheck" style="float:right;"><span class="fa fa-save"></span> Simpan / Upload</button>
                         </div>

                        </div>
                        </form>'; 

          return Response::json(array('output' => $output), 200);

      }else{
          return Response::json(array('output' => 'noakses'), 200);
      }

   	}

    //GET DATA TABLE PENGAMBILAN CUTI
    public function GetDatPengCut(Request $request, $id_cuti){

    	return DataTables::of(DB::table('c_detail_cuti')
    		->LeftJoin('c_bukti','c_bukti.c_bukti','=','c_detail_cuti.id_bukti')
    		->join('c_cuti','c_cuti.id_cuti','=','c_detail_cuti.id_cuti')
    		->select('c_detail_cuti.id_set_cuti','c_detail_cuti.id_cuti','c_detail_cuti.id_bukti','c_detail_cuti.ambil_cuti','c_detail_cuti.ket_cuti','c_bukti.filename','c_bukti.c_bukti','c_cuti.id_pegawai')
         	->where('c_detail_cuti.id_cuti','=',$id_cuti)
        )
        ->addIndexColumn()
        ->addColumn('aksi', function($data){

          	return '<a href="'. URL::asset('bukticuti/'.$data->filename.'') .'" class="btn btn-xs btn-outline-info" target="_blank" style="cursor: pointer;"><span class="fa fa-eye"></span></a> | 

          	<button type="button" data-id="'.$data->id_set_cuti.'" class="btn btn-xs btn-outline-primary EditDataCut" style="cursor: pointer;" ><span class="fa fa-pencil-alt"></span></button> | 

          	<button type="button" data-id="'.$data->id_set_cuti.'" class="btn btn-xs btn-outline-danger HapusPilihCuti" style="cursor: pointer;"><span class="fa fa-trash"></span></button> ';
                  
        })
		->rawColumns(['aksi'])
		->make(true);

    }

    //GET DATA PERIODE
    public function GetPeriode(Request $request){

    	return DataTables::of(DB::table('c_periode_cuti')->select(   
                    'c_periode_cuti.id_kategori',
                    'c_periode_cuti.periode_awal',
                    'c_periode_cuti.periode_akhir',
                    'c_periode_cuti.keterangan_periode'

                )
        )
        ->addIndexColumn()
        ->addColumn('aksi', function($data){
          	
          	return '<button type="button" title="Edit Tanggal Periode" data-id="'.$data->id_kategori.'" class="btn btn-xs btn-outline-info EditPeriode" ><span class="fa fa-edit"></span></button> | <button title="Hapus Tanggal Periode" type="button" data-id="'.$data->id_kategori.'" class="btn btn-xs btn-outline-danger HapusPeriode" ><span class="fa fa-trash"></span></button>';
                  
        })
        ->addColumn('cutibersama', function($data){

          	$dataSet = DB::table('c_cuti_bersama')->where('id_periode','=',$data->id_kategori)->select('id_cuti_bersama','id_periode','tanggal_cuti','ket_cuti_bersama')->orderBy('id_cuti_bersama','DESC')->get();

          	
          	$output	='';
          	$output .= '
		          	<a href="#" style="cursor: pointer;" class="TambCutBerCe" data-awal="'.$data->periode_awal.'"data-akhir="'.$data->periode_akhir.'" data-id="'.$data->id_kategori.'">
		             Tambah Cuti Bersama
		            </a>
		          
	               	<div class="card card-body bg-dark p-2 CkeClose" id="FormCutBer'.$data->id_kategori.'" style="display:none;">
		           		<form data-route="'. route('TambahCutiBersama') .'" class="SimpanCutBersama" role="form" method="POST" accept-charset="utf-8">
			                <div class="row">
				                <div class="col-5">
				                  <div class="form-group">
				                  	<label>Tanggal Cuti</label>
				                  	<div class="input-group mb-3">
					                  	<input type="hidden" name="id_periode" class="form-control" value="'.$data->id_kategori.'" required>

  					                  	<div class="InputDateCutBer"></div>
                              
				                    </div>
				                  </div>
			                 	</div>
			                 	<div class="col-7">
				                  <div class="form-group">
				                  	<label>Keterangan Cuti</label>
				                  	<div class="input-group mb-3">
					                  	<textarea name="ket_cuti"  maxlength="50" placeholder="Masukan Keterangan Cuti" class="form-control" style="height:38px;"required></textarea>
				                    </div>
                            <code>max 50 karakter</code>
				                  </div>
			                 	</div>
			                 	<div class="col-md-6 offset-md-6">
				                 	<button type="submit" class="btn btn-sm btn-info SimpanCut" style="float:right;"><span class="fa fa-save"></span> Simpan</button>
				                </div>
			                </div>
			            </form>
	              	</div>

	               	<div class="card card-body bg-warning p-2" id="EditkahCutBer'.$data->id_kategori.'" style="display:none;">
		           		<form data-route="'. route('EditCutiBersamaPros') .'" class="EditCutiBersamaPros" role="form" method="POST" accept-charset="utf-8">
			                <div class="row">
				                <div class="col-5">
				                  <div class="form-group">
				                  	<label>Tanggal Cuti</label>
				                  	<div class="input-group mb-3">
					                  	<input type="hidden" id="id_cutberKah'.$data->id_kategori.'" name="data_id" class="form-control" required>
					                  	<input type="date" id="tanggalCutberkah'.$data->id_kategori.'" name="tanggal_cuti" min="'.$data->periode_awal.'" max="'.$data->periode_akhir.'" class="form-control" size="20" required>
				                    </div>
				                  </div>
			                 	</div>
			                 	<div class="col-7">
				                  <div class="form-group">
				                  	<label>Keterangan Cuti</label>
				                  	<div class="input-group mb-3">
					                  	<textarea name="ketcuti"  maxlength="50" id="ketCutBerkah'.$data->id_kategori.'" placeholder="Masukan Keterangan Cuti" class="form-control" style="height:38px;"required></textarea>
				                    </div>
                            <code>max 50 karakter</code>
				                  </div>
			                 	</div>
			                 	<div class="col-md-6 offset-md-6">
				                 	<button type="submit" class="btn btn-sm btn-info btn-flat UpdateCutBerNew" style="float:right;"><span class="fa fa-pen-alt"></span> Update Data</button>
		                			<button type="button" class="btn btn-sm btn-danger btn-flat CloseCutBer" data-id_periode="'.$data->id_kategori.'" style="float:right;"><span class="fa fa-times-circle"></span> Close</button>
				                </div>
			                </div>
			            </form>
	              	</div>

		             <hr style="margin:8px;">
		            <div class="card card-body p-2" >
          			<table class="table table-sm table-bordered">
          				<thead>
	          				<tr>
		          				<th>Tanggal</th>
		          				<th>Keterangan</th>
		          				<th>Aksi</th>
	          				</tr>
          				</thead>
						<tbody>';
          	foreach ($dataSet as $key => $v) {
          		$output .= '<tr>
						      <td nowrap style="vertical-align:middle;"><b>'.$v->tanggal_cuti.'</b></td>
						      <td style="text-align:justify;"><b>'.$v->ket_cuti_bersama.'</b></td>
						      <td style="vertical-align:middle;">

						      	<button type="button" title="Edit Tanggal Periode" data-id_periode="'.$data->id_kategori.'" data-id="'.$v->id_cuti_bersama.'" data-tanggal="'.$v->tanggal_cuti.'"  data-ket="'.$v->ket_cuti_bersama.'" class="btn btn-xs btn-info EditCutiBersamaNew" ><span class="fa fa-edit"></span></button>

						      	 | <button title="Hapus Tanggal Cuti Bersama" type="button" data-id="'.$v->id_cuti_bersama.'" class="btn btn-xs btn-danger HapusCutiBersama" ><span class="fa fa-trash"></span></button>

						      	</td>
						    </tr>';
		  	}
          	$output .= '</tbody>
						</table>
						</div>';
          	return $output;       

          
        })
        ->rawColumns(['aksi','cutibersama'])
        ->make(true);

    }

    //INDEX MODAL TAMPIL PERIODE
    public function LihatPeriodeCuti(Request $request){

      if ($this->cek_akses('102') == 'yes') {
        
        $output = '';
        $output .= '<a class="btn btn-sm btn-info" id="BtnTambhPeriod" data-toggle="collapse" href="#PeriodeTam" role="button" aria-expanded="false" aria-controls="PeriodeTam">
                <span id="PeriodeTamSpan" class="fa fa-plus"> </span> Tambah Periode
              </a><br><br>
              <div class="collapse" id="PeriodeTam">
              <div class="card card-body bg-dark p-2">
              <form data-route="'. route('SimpanPeriodeCut') .'" id="SimpanPeriode" role="form" method="POST" accept-charset="utf-8">
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <label>Periode Awal</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                          <input type="date" name="periode_awal" class="form-control" required>
                        </div>
                      </div>
                    </div>
                   <div class="col-4">
                      <div class="form-group">
                        <label>Periode Akhir</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                          <input type="date" name="periode_akhir" class="form-control" required>
                        </div>
                    </div>
                   </div>
                    <div class="col-4">
                      <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="ketPeriode" placeholder="Masukan Keterangan" style="height:40px;"></textarea>
                    </div>
                   </div>
                   <div class="col-md-6 offset-md-6">
                    <button type="submit" class="btn btn-sm btn-info SimpanPeriodety" style="float:right;"><span class="fa fa-save"></span> Simpan</button>
                   </div>
                   </form>
                </div>
                </div>
              <hr>
              </div>
              ';
        $output .= '<table class="table table-bordered table-hover" id="periode" width="100%">';
          $output .= '  <thead>
                <tr>
                  <th>Aksi Periode</th>
                  <th>Periode Awal</th>
                  <th>Periode Akhir</th>
                  <th>Keterangan</th>
                  <th>Cuti Bersama</th>
                </tr>
                </thead>

                <tbody>
                ';
       
          $output .= '</tbody></table>';
          return response()->json($output);
          
      }else{

        return Response::json(array('error' => true), 500);
      }

    }

    //GET DATA EDIT PERIODE
    public function GetDataEditPriod(Request $request){

    	$data = DB::table('c_periode_cuti')->select(   
                    'c_periode_cuti.id_kategori',
                    'c_periode_cuti.periode_awal',
                    'c_periode_cuti.periode_akhir',
                    'c_periode_cuti.keterangan_periode')->where('id_kategori','=',$request->data_id)->first();

    	$output = '';
    	$output .= '
    		<form data-route="'. route('UbahPeriodeCut') .'" id="UbahPeriode" role="form" method="POST" accept-charset="utf-8">
                <div class="row">
	                <div class="col-md-3">
	                  <div class="form-group">
	                  	<label>Periode Awal</label>
	                 		<input type="hidden" name="data_id" value="'.$data->id_kategori.'" required>
		                    <input type="date" name="periode_awal" class="form-control"  value="'.$data->periode_awal.'" required>
	                    
	                  </div>
                 	</div>
                 <div class="col-3">
                  	<div class="form-group">
                  		<label>Periode Akhir</label>
                  			<input type="date" name="periode_akhir" class="form-control" value="'.$data->periode_akhir.'" required>
                    </div>
                 </div>
                  <div class="col-4">
                  	<div class="form-group">
                  		<label>Keterangan</label>
                    	<textarea class="form-control" name="ketPeriode" placeholder="Masukan Keterangan" style="height:38px;">'.$data->keterangan_periode.'</textarea>
                  	</div>
                 </div>
                  <div class="col-2">
                  	<div class="form-group">
                  	<label>Submit</label>
                    	<button type="submit" class="btn btn-info"><span class="fa fa-pen"></span> Ubah</button>
                    </div>
                 </div>
             
                 </div>
            </form>';
    	return response()->json($output);
    }

  

    //TAMPIL MODAL TAMBAH PEGAWAI DALAM PERIODE
    public function TampilTambahPegawai(Request $request){

      if ($this->cek_akses('103') == 'yes') {

      	$dataNow = date('Y-m-d',strtotime(\Carbon\Carbon::now()));

     		$dt = date('Y-m-d',strtotime(\Carbon\Carbon::now()));

    		$LgBerjalan= DB::table('c_periode_cuti')->select('id_kategori')->whereRaw('"'.$dt.'" between `periode_awal` and `periode_akhir`')->first();
    		if ($LgBerjalan) {
    			$hjk = $LgBerjalan->id_kategori;
    		}else{
    			$hjk = '';
    		}

  		$dataSet= DB::table('c_periode_cuti')
  				->select('periode_awal','periode_akhir','id_kategori')
  			    ->get();

      	$dataPeg = DB::table('pegawai')->select('id_pegawai','nama_karyawan')
      				->where('status_aktif','=','Aktif')
      				->orderBy('nama_karyawan','ASC')->get();

      	$output = '';
      	$output .= ' <div class="col-12">
  				      <div class="form-group">
  				      	<label style="font-size:16px;">Periode Yang Sedang Berjalan!</label> | note! <a class="badge badge-pill badge-info"  data-toggle="collapse" href="#priodtr" role="button" aria-expanded="false" aria-controls="priodtr"><span class="fa fa-exclamation-circle"></span></a>
  				      	<div class="collapse" id="priodtr">
  					      	'.$this->aturanTamPeg('pilihperiode').'
  				      	</div>
  				      	<div class="input-group mb-3">
  				          	<div class="input-group-prepend">
  				              <span class="input-group-text"><i class="fas fa-calendar"></i></span>
  				            </div>
  				            <select class="form-control" name="periode" id="EventPeriode" required>
  				            <option value="">Pilih Periode</option>';
  				            foreach ($dataSet as $vDataPeriod) {
  		$output.=	            '<option value='.$vDataPeriod->id_kategori.' '.(($vDataPeriod->id_kategori==$hjk)?'class="bg-success"':"").'>'.$vDataPeriod->periode_awal.' - '.$vDataPeriod->periode_akhir.'</option>';
  				            }
  	
  		$output .=	        	'</select>
  							</div>
  					      </div>
  					 	</div>

  				 	  <div class="col-12">
  				      <div class="form-group">
  				      	<label style="font-size:16px;">Nama Pegawai & TMK</label> | note! <a class="badge badge-pill badge-info"  data-toggle="collapse" href="#tambpeg" role="button" aria-expanded="false" aria-controls="tambpeg"><span class="fa fa-exclamation-circle"></span></a>
  				      	<div class="collapse" id="tambpeg">
  					      	'.$this->aturanTamPeg('inputsemuapegawai').'
  					    <br>
  					  	</div>
  				      	<div class="input-group mb-3">
  				          	<div class="input-group-prepend">
  				              <span class="input-group-text"><i class="fas fa-user"></i></span>
  				            </div>
  				            <select name="pegawai" class="form-control" id="ForPegall" required>
  				            	<option value="">Pilih Pegawai Aktif</option>
  				            </select>
  				        </div>

  				      	<div class="form-group">
  					        <div class="icheck-primary d-inline">
  		                        <input type="checkbox" name="pegawaiall" value="ada" id="allpeg">
  		                        <label for="allpeg">
  		                        	<font size="2">Input semua pegawai yang aktif diperiode terpilih</font>
  		                        </label>
  		                    </div>
  	                    </div>
  	                    <label style="font-size:11px;">#Keterangan Cuti Bersama di Periode Terpilih</label>
  	                    <div id="ListCutber"></div>

  				      </div>
  				 	</div>

  			 	  	<div class="col-12">
  				      <div class="form-group">
  				      	<label style="font-size:16px;">Hak Cuti</label> | note! <a class="badge badge-pill badge-info"  data-toggle="collapse" href="#hakcuti" role="button" aria-expanded="false" aria-controls="hakcuti"><span class="fa fa-exclamation-circle"></span></a>
  				      	<div class="collapse" id="hakcuti">
  					      	'.$this->aturanTamPeg('hakcutites').'
  					    <br>
  					  	</div>
  					  	<!--div id="EstimasiHkCut">Estimasi Hak Cuti = <b>?</b></div-->
  				      	<div class="input-group mb-3">
  				          	<div class="input-group-prepend">
  				              <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
  				            </div>
  				        	<input type="text" value="12" name="hakcuti" class="form-control" required>    
  				        </div>
  				      </div>
  				 	</div>

  				 	';

    	   return response()->json($output);

       }else{
          return Response::json(array('error' => true), 500);
       }

    }

    //cek pegawai yang belum ada di list
    public function GetDataPegawaiCek(Request $request){
    	if ($request->data_id) {
    		$pegawai = DB::select("SELECT nama_karyawan,id_pegawai, tmk
								FROM pegawai 
								WHERE pegawai.status_aktif = 'Aktif' && pegawai.id_pegawai
								NOT IN(select id_pegawai from c_cuti where c_cuti.id_periode = '$request->data_id')"
							);
    		if ($pegawai) {
    			$output = '';
		    	foreach ($pegawai as $key => $value) {
		    		$output .= '<option value="'.$value->id_pegawai.'">'.$value->nama_karyawan.' | ('.$this->tanggal_indo($value->tmk).')</option>';
		    	}
    		}else{
    			$output = '<option value="">Semua Pegawai Aktif Telah Diinput</option>';
    		}
	    
		}else{
    		$output = '<option value="">Pilih Periode Terlebih Dahulu</option>';
    	}

    	$CutBer = DB::table('c_cuti_bersama')->select('tanggal_cuti','ket_cuti_bersama')->where('id_periode','=',$request->data_id)->orderBy('tanggal_cuti','ASC')->get();
    	$Output2 = '';
    	$Output2 .= '<ul class="list-group bg-dark p-2" style="text-align:justify;">';

    	if (!$CutBer->isEmpty()) {
    		foreach ($CutBer as $gtt => $vct) {
			$Output2 .= '<li class="list-group-item bg-dark p-1">'.$vct->tanggal_cuti.' | '.$vct->ket_cuti_bersama.'</li>
					 	';
	    	}
    	}else{
    		$Output2 .= '<li class="list-group-item bg-dark p-1">Tidak Ada Cuti Bersama</li>';
    	}
    	$Output2 .= '<li class="list-group-item bg-dark p-1"><h6><span class="badge badge-pill badge-info">Total '.count($CutBer).'</span></h6></li>';
    	$Output2 .=	'</ul>';

    	return Response::json(array('ListPegAktif' => $output,'ketCutBer' => $Output2), 200);
    }


    //HISTORY
    public function HistoryCuti(Request $request){

      if ($this->cek_akses('104') == 'yes') {
          $output = '';
          $output .= '<table class="table table-striped table-bordered bg-light display table-hover" id="HistoriTable">';
            $output .= '  <thead>
                  <tr>
                    <th></th>
                    <th>No</th>
                    <th>Nama Karyawan</th>
                    <th>Jenis</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Waktu Input</th>
                  </tr>
                  </thead>
                  <tbody>
                  ';
         
            $output .= '</tbody></table>';
        return response()->json($output);
      }else{
        return Response::json(array('Error' => true), 500);
      }
    	
    }

    //HISTORY GGET DATA
    public function GetHistoryCuti(Request $request){
    	return DataTables::of(DB::table('c_history_cuti')
    		->join('c_cuti','c_cuti.id_cuti','=','c_history_cuti.id_cuti')
    		->join('pegawai','pegawai.id_pegawai','=','c_cuti.id_pegawai')
    		->select(   
                    'c_history_cuti.id_histori',
                    'c_history_cuti.id_cuti',
                    'c_history_cuti.id_user',
                    'c_history_cuti.tanggal_aksi',
                    'c_history_cuti.jenis',
                    'c_history_cuti.keterangan',
                    'c_history_cuti.get_ip',
                    'c_history_cuti.get_host',
                    'c_history_cuti.created_at',
                    'pegawai.nama_karyawan'

                )
        )
        ->addIndexColumn()
        ->rawColumns([])
        ->make(true);
    }

    //GET DATA UNTUK UBAH DATA KARYAWAN DI LIST CUTI
    public function GetDataUbahCutiKaryawan(Request $request){

    	$data = DB::table('c_cuti')
    	->join('pegawai','pegawai.id_pegawai','=','c_cuti.id_pegawai')
    	->select('c_cuti.id_cuti','pegawai.id_pegawai','c_cuti.id_periode','c_cuti.hak_cuti','c_cuti.sisa_cuti','pegawai.nama_karyawan')
    	->where('id_cuti','=',$request->data_id)->first();

    	//cek total hari cuti bersama
    	$CekCutBer = DB::table('c_cuti_bersama')->where('id_periode','=',$data->id_periode)->count(); 
    	//cek hari yang sudah di ambil / cuti
    	$CekambilCut = DB::table('c_detail_cuti')->where('id_cuti','=',$request->data_id)->count(); 

    	if ($data) {
    		$output = '';
	    	$output .= ' 
	    		
	    		<form data-route="'. route('UbahDataKaryawanCuti') .'" id="UbahDataKaryawanCuti" role="form" method="POST" accept-charset="utf-8">
	                <div class="col-12">
	                <h4><u>'.$data->nama_karyawan.'</u></h4>
	                  <div class="form-group">
	                  	<label>Hak Cuti</label>
	                  	<div class="input-group mb-3">
		                  	<div class="input-group-prepend">
			                  <span class="input-group-text"><i class="fas fa-user-check"></i></span>
			                </div>
			                <input type="hidden" name="id_cuti" value="'.$request->data_id.'"required></input>
		                    <input type="text" id="hak_cuti" name="hak_cuti" value="'.$data->hak_cuti.'" class="form-control" autocomplete="off" required>
		                    <div class="input-group-append">
		                    	<div class="input-group-text">HARI</div>
		                  	</div>
	                    </div>
	                    <b>Estimasi : </b><br>
	                    #dikurang cuti bersama diperiode ini <b>'.$CekCutBer.'</b> hari<br>
	                    #dikurang cuti yang telah diambil (jika ada) <b>'.$CekambilCut.'</b> hari
	                    <div id="HasilSisa"> </div>
	                  </div>
	             	</div>

	             <div class="col-12">
	              	<div class="form-group">
	              		<label>Sisa Cuti</label>
	              		<div class="input-group mb-3">
		                  	<div class="input-group-prepend">
			                  <span class="input-group-text"><i class="fas fa-box-open"></i></span>
			                </div>
	                		<input type="text" id="SisaCutEsti" name="sisa_cuti" value='.$data->sisa_cuti.' class="form-control" required>
	                		<div class="input-group-append">
		                    	<div class="input-group-text">HARI</div>
		                  	</div>
	                	</div>
	             	</div>
	             </div>
	             <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button type="submit" class="btn btn-info UbahDataCuti" style="float:right;"><span class="fa fa-save"></span> Simpan</button>
			      </div>
	      
	             </form>';

	    	return Response::json(array('output' =>$output, 'cutbertot' => $CekCutBer,'cutamtot' => $CekambilCut), 200);
    	}else{
    		return Response::json(array('cek' =>'hjh'), 200);
    	}

    	

    }


    //BELUM DI SELESAIKAN 
    /*public function EstimasiHakcuti(Request $request){

    	$dataSet = DB::table('pegawai')->select('tmk')->where('id_pegawai','=',$request->data_id)->first();
    	if ($dataSet->tmk) {
    		$dpt = $dataSet->tmk;
    	}else{
    		return Response::json(array('cek' => 'blmadatmk'), 200);
    	}

    	$dt = date('Y-m-d',strtotime(\Carbon\Carbon::now()));
		$periodskr= DB::table('c_periode_cuti')
			->select('periode_akhir','id_kategori')
		    ->whereRaw('"'.$dt.'" between `periode_awal` and `periode_akhir`')
		    ->first();

		if ($periodskr->periode_akhir) {
			
			$timeStart = strtotime($dpt);
			$timeEnd = strtotime($periodskr->periode_akhir);
			// Menambah bulan ini + semua bulan pada tahun sebelumnya
			$numBulan =  (date("Y",$timeEnd)-date("Y",$timeStart))*12;
			// menghitung selisih bulan
			$numBulan += date("m",$timeEnd)-date("m",$timeStart);

			if ($numBulan > 12) {
				return 'Estimasi Hak Cuti = <b>12 Hari </b>';
			}else{
				return 'Estimasi Hak Cuti = <b>'.$numBulan.' Hari </b>'; 
			}
		}else{
			return Response::json(array('cek' => 'kjtl'), 200);
		}


    }*/

	/////////////////////////FUNCTION PROTECTED//////////////////////////////////


    protected function tanggal_indo($tanggal) {

    	if ($tanggal) {
    		$bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	        $split = explode('-', $tanggal);
	        return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
    	}else{
    		return '-';
    	}

		
    }

    protected function aturanTamPeg($jenis){
    	if ($jenis == 'inputsemuapegawai') {
    		return '<ul class="list-group bg-dark p-2" style="text-align:justify;">
					  <li class="list-group-item bg-dark p-1">Pegawai yang ditampilkan dilist merupakan pegawai yang masih Aktif</li>
					  <li class="list-group-item bg-dark p-1">Pengaturan pegawai Aktif terdapat dimenu pegawai</li>
					  <li class="list-group-item bg-dark p-1">Jika pegawai tidak tampil dilist, pastikan pegawai berstatus Aktif dan sudah ada di Database Pegawai.</li>
					  <li class="list-group-item bg-dark p-1">Untuk pilihan "input semua pegawai" digunakan untuk input semua pegawai aktif secara langsung/sekaligus. Perlu diingat jika menggunakan "Input Semua Pegawai" jatah cuti diSet secara Default/Ketetapan aturan uvers dan ini merata untuk semua pegawai. Sangat disarankan untuk "Input Semua Pegawai" digunakan diawal Periode.</li>
					</ul>';
    	}elseif($jenis == 'pilihperiode'){
    		return '<ul class="list-group bg-dark p-2" style="text-align:justify;">
					  <li class="list-group-item bg-dark p-1">Pilih periode yang akan digunakan untuk cuti pegawai.</li>
					  <li class="list-group-item bg-dark p-1">Jika tidak ada Periode yang diinginkan, mohon cek dibagian pengaturan Periode dan cuti bersama.</li>
					  <li class="list-group-item bg-dark p-1">Pastikan periode yang diinginkan sudah diinput di bagian Periode dan Cuti Bersama</li>
					  <li class="list-group-item bg-dark p-1">Blok Berwarna Hijau, Merupakan Periode Yang Berjalan Sekarang</li>
					 
					</ul>';
    	}elseif($jenis == 'hakcutites'){
    		return '<ul class="list-group bg-dark p-2" style="text-align:justify;">
					  <li class="list-group-item bg-dark p-1">Menggunakan "Input Semua Pegawai" Hak Cuti sudah ditetapkan sebanyak ketentuan Uvers.</li>
					  <!--li class="list-group-item bg-dark p-1">Jika memilih pegawai yang masuk kerja/TMK di PERTENGAHAN PERIODE, sistem akan menampilkan estimasi <b>Hak Cuti</b> yang diterima.</li-->
					</ul>';
    	}else{
    		return'Catatan Tidak Ditemukan';
    	}
    }

    protected function cek_akses($aModul) {
        $level = Auth::user()->level;
        $username = Auth::user()->username;
        //query untuk mendapatkan iduser dari user           
        $quser = DB::table('users')->select('level')->where('username','=',$username)->first();
        $qry = DB::table('hak_akses')->select('id')->where([['usergroup','=',$quser->level],['modul','=',$aModul]])->count();
        if (1 > $qry) { return "no"; } else {return "yes";}
    }

}
