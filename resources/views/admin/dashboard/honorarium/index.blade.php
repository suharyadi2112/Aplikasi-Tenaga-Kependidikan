
@extends('admin.layout.master')

@section('content')


<?php if(cek_akses('50') == 'yes'){
}else{ ?>
  <script type="text/javascript">history.back(alert("Anda Tidak Memiliki Akses"))</script>
<?php } ?> 


 <!-- ./row -->
      
<div class="container-fluid"> 
    <div class="row">
      <div class="col-12">

        <font size="2" color="blue"><b>* <span class="badge badge-pill badge-secondary">Waktu Upload</span> : <span class="badge badge-pill badge-warning">Waktu upload file scan</span> | </b></font>
        <font size="2" color="blue"><b>* <span class="badge badge-pill badge-secondary">Kategori</span> : <span class="badge badge-pill badge-warning">Jenis yang membedakan seminar proposal, tugas akhir maupun surat keterangan selesai</span></b></font>


         @if ($message = Session::get('success'))
          <div id='laporan'>
             <div class="uk-alert uk-alert-success" id='laporan' data-uk-alert>
                <a href="" class="uk-alert-close uk-close"></a>
               
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>{{ $message }}</strong>
                </div>
                
            </div>
          </div>
        @endif

        @if ($message = Session::get('error'))
          <div id='laporan'>
           <div class="uk-alert uk-alert-error" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
             
              <div class="alert alert-error alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $message }}</strong>
              </div>
              
            </div>
          </div>
        @endif


        <div class="row">
          <div class="col-12 col-sm-12">
            <div class="card card card-outline card-tabs">
              <div class="card-header bg-dark p-0 pt-1 border-bottom-0" id="myTab">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="tab" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true" ><span class="fa fa-cloud-download-alt"></span> New <span class="badge badge-danger">{{ $tot_new }}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-waiting-tab" data-toggle="tab" href="#custom-tabs-three-waiting" role="tab" aria-controls="custom-tabs-three-waiting" aria-selected="false" ><span class="fa fa-spinner"></span> Waiting <span class="badge badge-danger">{{ $tot_last }}</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="tab" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false"><span class="fa fa-check-circle"></span> Finish</a>
                  </li>

                  <li class="nav-item ml-5">
                    <a class="nav-link bg-danger" target="_blank" href="{{ Route('setting_honorarium') }}" role="tab"  aria-selected="false" onclick="return confirm('Page akan segera alihkan, Anda yakin untuk dilanjutkan ?' ) "><span class="fas fa-money-bill-wave"></span> Bayaran ?</a>
                  </li>
              
                </ul>
              </div>
              <div class="card-body p-0 bg-dark">
                <div class="tab-content" id="custom-tabs-three-tabContent">

                  <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">

                    <!-------------------TABLE UNTUK DATA YANG BELUM DI PROSES---------------->
                    <div class="shadow bg-dark rounded">
                        <div class="card-body p-2">
                          <a href="#middle" class="btn btn-sm btn-outline-warning"><span class="fas fa-angle-double-down"></span> Scroll Down</a>
                       
                            <div class="icheck-primary d-inline"  style="cursor:pointer; float: right; padding-bottom: 10px;">
                              <input type="checkbox" id="checkboxPrimarysks" name="ceksemua" value="check" onclick="toggle(this)">
                              <label for="checkboxPrimarysks">
                                Centang Semua
                              </label>
                            </div>
                           
                            <hr style="margin: 5px;">
                          <div class="table-responsive">
                            <form action="{{ route('cek_dos_honorarium') }}" method="POST">
                              @csrf
                            <table class="table table-striped table-bordered display table-dark table-hover" id="proses_0">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Kategori</th>
                                    <th colspan="2">NoSurat & File</th>
                                    <th>Mahasiswa & Dosen</th>
                                    <th>Upload</th>
                                    <th>Aksi</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @forelse($dataproses as $uy => $showuy)
                                  <tr>
                                    <td style="width: 5%; vertical-align: middle;text-align: center;">{{ $uy + 1 }}</td>
                                    
                                    @if($showuy->kategori_buff == 'surat_keterangan_selesai')
                                    <td class="bg-secondary" style="vertical-align: middle;text-align: center;">{{ $showuy->kategori_buff }}</td>
                                    @elseif($showuy->kategori_buff == 'sidang tugas akhir')
                                    <td class="bg-info" style="vertical-align: middle;text-align: center;">{{ $showuy->kategori_buff }}</td>
                                    @elseif($showuy->kategori_buff == 'seminar proposal')
                                    <td class="bg-warning" style="vertical-align: middle;text-align: center;">{{ $showuy->kategori_buff }}</td>
                                    @else
                                    <td>
                                      {{ $showuy->kategori_buff }}
                                    </td>
                                    @endif

                                    <td style="vertical-align: middle;text-align: center; width: auto;" class="p-1" nowrap="">

                                      @if($showuy->kategori_buff == 'surat_keterangan_selesai')
                                      @php
                                         $no_surat_sks = DB::table('a_sks_dp')
                                                    ->where('id_sks_selesai' ,'=',$showuy->id_sks)
                                                    ->select(   'a_sks_dp.no_surat')
                                                    ->orderBy('a_sks_dp.no_surat','ASC')
                                                    ->get();
                                        foreach ($no_surat_sks as $kuet => $no_su_sks) {
                                          if ($kuet == 0) {
                                            echo $no_su_sks->no_surat;
                                          }
                                        }
                                      
                                      @endphp
                                      @elseif($showuy->kategori_buff == 'sidang tugas akhir' || $showuy->kategori_buff == 'seminar proposal')
                                      @php
                                        $ns_udg = DB::table('a_srt_udg_penguji')
                                                    ->where('id_undangan' ,'=',$showuy->id_undangan)
                                                    ->select('a_srt_udg_penguji.no_surat')
                                                    ->get();
                                        foreach ($ns_udg as $no_su_udg) {
                                            echo $no_su_udg->no_surat;
                                        }
                                      @endphp
                                      @else
                                        Tidak Dalam Kondisi
                                      @endif

                                      <hr class="m-2 bg-light">
                                
                                      {{ $showuy->file_name }}
                                    </td>
                                    <td style="vertical-align: middle;text-align: center;" class="p-1">
                                      <a href="{{ Route('download_file_scan',['id' => $showuy->id_berkas_buff]) }}" title="Download">
                                      <button type="button" class="btn btn-outline-primary btn-xs"><span class="fa fa-download"> </span></button>
                                      </a> | 
                                      <a href="{{ Route('preview_file_scan',['id' => $showuy->id_berkas_buff]) }}" title="Preview File" target="_blank">
                                      <button type="button" class="btn btn-outline-info btn-xs"><span class="fa fa-eye"> </span></button>
                                      </a>
                                    </td>
                                    <td style="vertical-align: middle;">
                                      @if($showuy->kategori_buff == 'surat_keterangan_selesai')
                                        @php
                                            $ngences2 = $showuy->id_data_buff;
                                            $cek_mhs2 = DB::table('a_tbl_mhs')
                                                        ->join('a_surat_keterangan_selesai','a_surat_keterangan_selesai.mahasiswa','=','a_tbl_mhs.id_mhs')
                                                        ->join('a_berkas_scan_buff','a_berkas_scan_buff.id_data_buff','=','a_surat_keterangan_selesai.id_sks')
                                                        ->join('a_prodi','a_prodi.id_prodi','=','a_surat_keterangan_selesai.prodi')
                                                        ->where([['kategori_buff', '=','surat_keterangan_selesai'],['id_data_buff','=',$ngences2]])
                                                        ->select('a_tbl_mhs.nama','a_tbl_mhs.nim','a_prodi.nama_prodi')
                                                        ->get();
                                                
                                            foreach ($cek_mhs2 as  $valuemhs2) {
                                               echo $valuemhs2->nama. ' - ('.$valuemhs2->nim.') - ('.$valuemhs2->nama_prodi.')';
                                            }
                                          @endphp
                                        @elseif($showuy->kategori_buff == 'sidang tugas akhir' || $showuy->kategori_buff == 'seminar proposal')
                                          @php
                                            $ngences = $showuy->id_data_buff;
                                            $cek_mhs = DB::table('a_tbl_mhs')
                                                        ->join('a_srt_udg_penguji','a_srt_udg_penguji.id_mhs','=','a_tbl_mhs.id_mhs')
                                                        ->join('a_berkas_scan_buff','a_berkas_scan_buff.id_data_buff','=','a_srt_udg_penguji.id_undangan')
                                                        ->join('a_prodi','a_prodi.id_prodi','=','a_srt_udg_penguji.id_prodi')
                                                        ->where([['kategori_buff', '=','sidang tugas akhir'],['id_data_buff','=',$ngences]])
                                                        ->orWhere([['kategori_buff' ,'=','seminar proposal'],['id_data_buff','=',$ngences]])
                                                        ->select('a_tbl_mhs.nama','a_tbl_mhs.nim','a_prodi.nama_prodi')
                                                        ->get();
                                            foreach ($cek_mhs as  $valuemhs) {
                                                 echo $valuemhs->nama. ' - ('.$valuemhs->nim.') - ('.$valuemhs->nama_prodi.')';
                                            }
                                          @endphp
                                        @endif

                                      <hr class="m-2 bg-warning">

                                      @if($showuy->kategori_buff == 'surat_keterangan_selesai')
                                        @php
                                         $sks_cekdospem = DB::table('a_sks_dp')
                                                      ->join('pegawai','pegawai.id_pegawai','=','a_sks_dp.id_dosen')
                                                      ->where('id_sks_selesai' ,'=',$showuy->id_sks)
                                                      ->select(   'a_sks_dp.id',
                                                                  'pegawai.nama_karyawan',
                                                                  'pegawai.nidn')
                                                      ->orderBy('a_sks_dp.id','ASC')
                                                      ->get();
                                          $kuo = 1;
                                          foreach ($sks_cekdospem as  $sks_value_pembimbing) {
                                              echo $kuo.'.'.$sks_value_pembimbing->nama_karyawan.'<br>';
                                          $kuo++;
                                          }
                                        @endphp
                                      @elseif($showuy->kategori_buff == 'sidang tugas akhir' || $showuy->kategori_buff == 'seminar proposal')
                                        @php
                                         $cekdos = DB::table('a_udg_dp')
                                                      ->join('pegawai','pegawai.id_pegawai','=','a_udg_dp.id_dosen')
                                                      ->where([['id_udg' ,'=',$showuy->id_undangan],['kategori_dosen','=','Penguji']])
                                                      ->select(   'a_udg_dp.id',
                                                                  'pegawai.nama_karyawan',
                                                                  'pegawai.nidn')
                                                      ->orderBy('a_udg_dp.id','ASC')
                                                      ->get();
                                          $kso = 1;
                                          foreach ($cekdos as  $value) {
                                              echo $kso.' '.$value->nama_karyawan.'<br>';
                                          $kso++;
                                          }
                                        @endphp
                                      @else
                                        <b>Tidak Dalam Kondisi</b>
                                      @endif
                                    </td>
                                    <td nowrap style="vertical-align: middle;text-align: center;">{{ tanggal_indo($showuy->created_at) }}</td>
                                    <td style="vertical-align: middle;text-align: center;">  

                                      <div class="icheck-primary d-inline">
                                          <input style="cursor:pointer" name="id_berkas_buff[]" type="checkbox" id="ha{{ $uy }}" 
                                     value="{{ $showuy->id_berkas_buff }}"/>
                                     
                                          <label for="ha{{ $uy }}" class="p-0"></label>

                                      </div>

                                    </td>
                                  </tr>
                                  @empty 
                                  <tr>
                                    <td colspan="100"><center>Tidak Ada Data</center></td>
                                  </tr>
                                  @endforelse

                                </tbody>
                              </table><br>
                              <a href="#checkboxPrimarysks" class="btn btn-sm btn-outline-warning"><span class="fa fa-angle-double-up"></span> Scroll Up</a> | 
                              <button type="submit" class="btn btn-info btn-sm" id="middle"><span class="fa fa-forward"></span> Teruskan</button><br><br>
                              </form>
                          </div>
                        </div>
                      </div>


                  </div>

                  <div class="tab-pane fade" id="custom-tabs-three-waiting" role="tabpanel" aria-labelledby="custom-tabs-three-waiting-tab">

                    <!-------------------TABLE UNTUK DATA YANG SUDAH DI PROSES DAN TINGGAL DI CETAK---------------->
                    <div id="atas"></div>
                    <div class="shadow bg-dark rounded">
                        <div class="card-body p-2">
                          <a href="#bawah" class="btn btn-sm btn-outline-warning"><span class="fa fa-angle-double-down"></span> Scroll Down</a>
                               <?php if(cek_akses('52') == 'yes'){ ?>
                                <a href="{{ Route('print_honorarium') }}" class="btn btn-info btn-sm"  target="_blank">
                                  <span class="fa fa-print"> </span> Print
                                </a>
                                <?php }else{ ?>
                                  <a href="#" class="btn btn-danger btn-sm" onclick="myFunction()">
                                    <span class="fa fa-print"> </span> Print
                                  </a>

                                  <script>
                                  function myFunction() {
                                    alert("Anda Tidak Memiliki Akses");
                                  }
                                  </script>

                                <?php } ?> 
                            @if($tot_last > 0)
                            <div class="dropdown dropleft"  style="float: right;">
                              <button class="btn btn-success dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Selesai ?
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ Route('KembaliRest') }}" onclick="return confirm('Mereset file yang waiting/menunggu akan mengembalikan ke berkas baru, Anda yakin untuk dilanjutkan ?' ) "><span class="fa fa-recycle"> </span> Kembali Ke Semula</a>
                                <a class="dropdown-item" href="{{ Route('DaratFinish') }}"onclick="return confirm('Tandai Telah Selesai jika data di waiting file sudah di proses, data akan mendarat di bagian Finish, Anda yakin untuk dilanjutkan ?' ) "><span class="fa fa-check-circle" > </span> Tandai Telah Selesai</a>
                              </div>
                            </div>
                            @endif
                          <hr style="margin: 5px;">
                          <div class="table-responsive">

                            <table class="table table-striped table-bordered display table-dark table-hover">
                              <thead>
                              <tr>
                                <th nowrap="">NoSurat</th>
                                <th nowrap="">Nama Dosen</th>
                                <th nowrap="">Jabatan Fungsional</th>
                                <th nowrap="">Tugas Sebagai</th>
                                <th nowrap="">Nama Mahasiswa - Prodi</th>
                                <th nowrap="">Pembayaran</th>
                                <th nowrap="">Lampiran</th>
                                <th nowrap="">Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php 

                              $temp = null;

                              ?>
                              
                                @forelse($a_last as $key => $showindex)
                                  <tr>
                                    @if(($temp == $showindex->id_berkas_buff) || ($temp == null ))
                                    @else
                                    <tr>
                                      <td colspan="100" class="bg-warning" style="padding: 7px;"></td>
                                    </tr>
                                    @endif

                                    <td>
                                      @if($showindex->kategori_buff == 'surat_keterangan_selesai')
                                      @php
                                         $no_surat_sks = DB::table('a_sks_dp')
                                                    ->where('id_sks_selesai' ,'=',$showindex->id_sks)
                                                    ->select(   'a_sks_dp.no_surat')
                                                    ->orderBy('a_sks_dp.no_surat','ASC')
                                                    ->get();
                                        foreach ($no_surat_sks as $ss => $no_su_sks) {
                                          if ($ss == 0) {
                                            echo $no_su_sks->no_surat;
                                          }
                                        }
                                      
                                      @endphp
                                      @elseif($showindex->kategori_buff == 'sidang tugas akhir' || $showindex->kategori_buff == 'seminar proposal')
                                      @php
                                        $ns_udg = DB::table('a_srt_udg_penguji')
                                                    ->where('id_undangan' ,'=',$showindex->id_undangan)
                                                    ->select('a_srt_udg_penguji.no_surat')
                                                    ->get();
                                        foreach ($ns_udg as $no_su_udg) {
                                            echo $no_su_udg->no_surat;
                                        }
                                      @endphp
                                      @else
                                        Tidak Dalam Kondisi
                                      @endif
                                    </td>
                                
                                    <td>{{ $showindex->nama_karyawan }}</td>
                                    <td>{{ $showindex->jabatan_fungsional }}</td>
                                    <td>{{ $showindex->tugas_sebagai }}</td>
                                    <td>{{ $showindex->nama_mahasiswa }} <br> <b>{{ $showindex->prodi }}</b></td>
                                    <td><b>Rp.{{ number_format($showindex->pembayaran) }}</b></td>
                                    <td>{{ $showindex->nama_lampiran }}</td>
                                    <td nowrap="">

                                      <a href="{{ Route('download_file_scan',['id' => $showindex->id_berkas_buff]) }}" title="Download">
                                        <button type="button" class="btn btn-outline-primary btn-xs"><span class="fa fa-download"> </span></button>
                                      </a> | 

                                      <a href="{{ Route('preview_file_scan',['id' => $showindex->id_berkas_buff]) }}" title="Preview File" target="_blank">
                                        <button type="button" class="btn btn-outline-info btn-xs"><span class="fa fa-eye"> </span></button>
                                      </a> |
                                        
                                      <a onClick="return confirm('Apakah Anda Yakin Menghapus Data {{ $showindex->nama_dosen }}?')" 
                                          href="{{ Route('destroy_del_hon', ['id' => $showindex->id,'id_berkas_buff' => $showindex->id_berkas_buff]) }}" class="btn btn-outline-danger btn-xs btn-flat" title="Hapus Data"><span class="fa fa-trash"></span>
                                      </a>

                                    </td>
                                  </tr>

                                  <?php 

                                  $temp = $showindex->id_berkas_buff;

                                  ?>
                                @empty
                                <tr>
                                  <td colspan="10" style="text-align: center;">Belum Ada Data Yang Dipilih</td>
                                </tr>
                                @endforelse
                              </tbody>
                            </table>
                            <a href="#atas" class="btn btn-sm btn-outline-warning"><span class="fa fa-angle-double-up"></span> Scroll Up</a>
                        </div>
                      </div>
                    </div>
                    <div id="bawah"></div>

                  </div>

                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">

                      <div class="shadow bg-dark rounded">
                      <div class="card bg-dark">
                      <div class="card-body p-2">

                        <hr style="margin-top: 5px;margin-bottom: 5px;"> 
                        <!--font size="1.8"><b>Blok Pada Waktu Upload : <span class="badge badge-pill badge-success">Hijau</span> waktu alternatif pada rentang tanggal buka dan tutup buku <span class="badge badge-pill badge-dark">Hitam</span> waktu normal pada rentang tanggal buka dan tutup buku</b></font-->

                          <div class="table-responsive">
                          <table id="cek_file_honorarium" class="table table-striped table-bordered dt-responsive display table-dark">
                            <thead>
                            <tr>
                              <th style="text-align: center;"><span class="fa fa-eye"></span></th>
                              <th>id berkas buff</th>
                              <!--th nowrap="">id Buff</th-->
                              <th nowrap="">Kategori</th>
                              <th nowrap="">Nama File</th>
                              <th nowrap="">Waktu Upload</th>
                              </tr>
                            </thead>
                          </table>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
        
      <!-- /.col -->
    </div>
  </div>
</div>

@php
function cek_akses($aModul) {
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
function tanggal_indo($tanggal) {
$datecek=date_create($tanggal);
$enddate = date_format($datecek,"Y-m-d");

        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $split = explode('-', $enddate);
        return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
    }
@endphp
@endsection
@section('script')


<script type="text/javascript">
//CHECK ALL 
function toggle(source) {
  checkboxes = document.getElementsByName('id_berkas_buff[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;

  }
}
/*
///////////////////////////////////////////////ZONA PROCESS////////////////////////////////////////////////

*/
$.noConflict();
jQuery( document ).ready(function( $ ) {
///////////////////////////////////////////////ZONA SELESAI DARI PROSES////////////////////////////////////////////////

//stay di tab jika di refresh
$(document).ready(function(){
  $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
    localStorage.setItem('activeTab', $(e.target).attr('href'));
  });
  var activeTab = localStorage.getItem('activeTab');
  if(activeTab){
    $('#myTab a[href="' + activeTab + '"]').tab('show');
  }
});

var sleepCheck = function(cekkk) {
      if (cekkk == undefined) {
        return '-';  
      }else{
        return cekkk;
      }
}

//mengubah format tanggal timestamp agar gampang untuk melakukan kondisi
function formatDate(nowDate) {
  return nowDate.getFullYear() +"-"+ (nowDate.getMonth() + 1) + '-'+ nowDate.getDate();
}
  /* Formatting function for row details - modify as you need */
function format ( d ) {

  if (d.kategori_buff == 'surat_keterangan_selesai') {
    //console.log(d.kategori_buff);
      var trs='';
      $.each($(d.dosen_pembimbing_sks),function(key,value){


        trs+='<tr>'+
                  '<td>'+d.no_surat_sks[key]+'</td>'+
                  '<td>'+d.dosen_pembimbing_sks[key]+'</td>'+
                  '<td>'+d.jabatan_fungsional_sks[key]+'</td>'+
              '</tr>';
      })
      // `d` is the original data object for the row
      return '<div class="slider">'+
      'Mahasiswa : <span class="badge badge-pill badge-primary"> '+d.mhs_sks+'</span> '+d.action+'<br>'+
      '<hr style="margin-top: 5px;opx;margin-bottom: 5px;">'+
      'Lampiran : <span class="badge badge-pill badge-info"> '+d.nama_lampiran+'</span>'+
      '<hr style="margin-top: 5px;opx;margin-bottom: 5px;">'+
      'Jenis : <span class="badge badge-pill badge-info"> '+d.jenis_mk+'-'+d.nama_mk+'</span><br>'+
      '<hr style="margin-top: 5px;opx;margin-bottom: 5px;">'+
      'Waktu Pelaksanaan : <span class="badge badge-pill badge-success"> '
        +moment(d.mulai).format("dddd - LL")+
      '</span> - <span class="badge badge-pill badge-danger"> '
        +moment(d.selesai).format("dddd - LL")+'</span>'+
      
      '<hr style="margin-top: 5px;opx;margin-bottom: 0px;">'+
          '<table class="table table-border table-dark table-sm">'+
             '<thead class="bg-primary" ">'+
                '<th>Nomor Surat Keterangan Selesai</th>'+  
                '<th>Dosen Pembimbing, NIDN</th>'+  
                '<th>Jabatan Fungsional</th>'+  
             '</thead><tbody>' +trs+
          '</tbody></table>'+
        '</div>'

  }else{


      var trs='';
      var trss='';
      $.each($(d.dosen_penguji),function(key,value){
        trs+='<tr>'+
                  '<td>'+value+'</td>'+
                  '<td>'+d.jabatan_fungsional_penguji[key]+'</td>'+
               '</tr>';
        /*trss+='<tr>'+
                  '<td>'+sleepCheck(d.dosen_pembimbing[key])+'</td>'+
                  '<td>'+sleepCheck(d.jabatan_fungsional_pembimbing[key])+'</td>'+
               '</tr>';*/
      })
    
      // `d` is the original data object for the row
      return '<div class="slider">'+
            'Mahasiswa : <span class="badge badge-pill badge-primary"> '+d.mhs_sm_ta+'</span> '+d.action+'<br>'+
            '<hr style="margin-top: 5px;opx;margin-bottom: 5px;">'+
            'Lampiran : <span class="badge badge-pill badge-info"> '+d.nama_lampiran+'</span>'+
            '<hr style="margin-top: 5px;opx;margin-bottom: 5px;">'+
            'Nomor Surat : <span class="badge badge-pill badge-info">'+d.no_surat_undangan+'</span> <br>'+
            '<hr style="margin-top: 5px;opx;margin-bottom: 5px;">'+
            'Waktu Pelaksanaan : <span class="badge badge-pill badge-success"> '
              +moment(d.tanggal_pelaksanaan).format("dddd - LL")+
            '</span> - <span class="badge badge-pill badge-danger"> '
              +d.jam_mulai+' WIB</span>'+
            '<hr style="margin-top: 5px;opx;margin-bottom: 0px;">'+

            '<table class="table table-border table-dark table-sm">'+
                   '<thead class="bg-warning" ">'+
                      '<th>Dosen Penguji, NIDN </th>'+
                      '<th>Jabatan Fungsional Penguji</th>'+
                   '</thead><tbody>' +trs+
                '</tbody></table><br>'+
                /*'<table class="table table-border table-dark table-sm">'+
                   '<thead class="bg-warning" ">'+
                      '<th>Dosen Pembimbing, NIDN</th>'+  
                      '<th>Jabatan Fungsional Pembimbing</th>'+  
                   '</thead><tbody>' +trss+
                '</tbody></table>'+*/
                '</div>'
      }
}
    
 var dt =  $('#cek_file_honorarium').DataTable({
        processing: true,
        serverSide: true,
        scrollY : false,
        ajax: '{!! route('getdatahonorarium') !!}',
        //searching: false,
        //bStateSave : true,
        language: {
            "infoFiltered":"",
            "processing": '<img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 30%;">',
            "searchPlaceholder": "Masukan Nama File",
        },
        columns: [
            {
                "class":          "details-control",
                "orderable":      false,
                //"data" : 'id',
                "defaultContent": "",
            }, 
            { data: 'id_berkas_buff', name: 'id_berkas_buff', visible:false},
            //{ data: 'id_data_buff', name: 'id_data_buff' },
            { data: 'kategori_buff', name: 'kategori_buff' },
            { data: 'file_name',
              render: function ( data, type, row ) {
                  return row.file_name + '.' + row.file_type;
              },
            },
            { data: 'created_at',
              render: function ( data, type, row ) {
                  return moment(row.created_at).format("dddd - LL")
                  //var cc = new Date(row.created_at);
                  //return '<span class="badge badge-pill badge-primary" style="width: 10rem">'+formatDate(cc)+'</span>'
              },
            },
        ],
        createdRow: function ( row, data, index ) {

            if ( data['kategori_buff'] == 'surat_keterangan_selesai' ) {
                  $('td', row).eq(1).addClass("bg-secondary");
            }else if(data['kategori_buff'] == 'sidang tugas akhir'){
                  $('td', row).eq(1).addClass("bg-info");
            }else if(data['kategori_buff'] == 'seminar proposal'){
                  $('td', row).eq(1).addClass("bg-warning");
            }else{

            }
            $('td', row).eq(4).css("padding", "0px");
            $('td', row).eq(4).css("text-align", "center");
            //$('td', row).eq(4).css("", "center");

            if(data['cek_waktu_nabrak'] == true){
              $('td', row).eq(3).append("<br><span class='badge badge-pill badge-secondary'><span class='fa fa-eye'></span></span>");
              //$('td', row).eq(3).addClass('bg-primary');
            }
            //variable untuk melakukan perbandinga tanggal
            //var unformatedDate = new Date(data['created_at']);
            //var datebaru = formatDate(unformatedDate);
            $('td', row).eq(1).attr("nowrap","nowrap");
            $('td', row).eq(2).attr("nowrap","nowrap");
            $('td', row).eq(1).css("font-weight", "bold");
            $('td', row).eq(5).attr("nowrap","nowrap");
            

          },
    });

  // Add event listener for opening and closing details
    $('#cek_file_honorarium tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = dt.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            $('div.slider', row.child()).slideUp( function () {
                row.child.hide();
                tr.removeClass('shown');
            } );
        }
        else {
            // Open this row
            row.child( format(row.data()), 'no-padding' ).show();
            tr.addClass('shown');
 
            $('div.slider', row.child()).slideDown();
        }
    } );
});

</script>

<style>
td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_close.png') no-repeat center center;
}
div.slider {
    display: none;
}
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color:  #1a521f;
}
</style>


@include('sweet::alert')
@endsection
