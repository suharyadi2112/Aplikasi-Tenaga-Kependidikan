
@extends('admin.layout.master')

@section('content')

<!--toastr alert-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />

<?php if(cek_akses('53') == 'yes'){
}else{ ?>
  <script type="text/javascript">history.back(alert("Anda Tidak Memiliki Akses"))</script>
<?php } ?> 
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
@endphp
@if ($message = Session::get('success'))
  <div id='laporan'>
     <div class="uk-alert uk-alert-success p-2" id='laporan' data-uk-alert>
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
   <div class="uk-alert uk-alert-error p-2" data-uk-alert>
      <a href="" class="uk-alert-close uk-close"></a>
     
      <div class="alert alert-error alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong>{{ $message }}</strong>
      </div>
      
    </div>
  </div>
  <script type="text/javascript">
    var err = "<?php echo $message ?>";
    alert(err)
  </script>
@endif


<div class="content-header" style="padding: 1.5px;">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
       <h3 class="m-0 text-dark">Cek Data Honorarium</h3>

      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ Route('index_honorarium') }}">Index (Kembali)</a></li>
          <li class="breadcrumb-item active">Tambah Detail Honorarium</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>


<form data-route="{{ route('add_honorarium') }}" id="TamCekHonor" role="form" method="POST" accept-charset="utf-8">
@csrf

<div class="container-fluid">

<div class="">

      <!-- left column --> 
      <div class="col-md-12 mx-auto">

    <a href="{{URL::to('honorarium')}}" class="btn btn-sm btn-warning"><span class="fa fa-angle-double-left"></span> Kembali</a><br>
      Jika nama dosen yang dtampilkan kurang atau tidak ada, harap periksa data dosen yang tidak ada tersebut di pengaturan honorarium
      <div class="card card card-outline card-tabs">
        <div class="card-header bg-dark p-0 pt-1 border-bottom-0" id="myTab">
          <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-three-sks-tab" data-toggle="tab" href="#custom-tabs-three-sks" role="tab" aria-controls="custom-tabs-three-sks" aria-selected="true" ><span class="fa fa-book"></span> Surat Keterangan Selesai <span class="badge badge-danger"></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-three-sta-tab" data-toggle="tab" href="#custom-tabs-three-sta" role="tab" aria-controls="custom-tabs-three-sta" aria-selected="false" ><span class="fa fa-book"></span> Sidang Tugas Akhir</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-three-sp-tab" data-toggle="tab" href="#custom-tabs-three-sp" role="tab" aria-controls="custom-tabs-three-sp" aria-selected="false"><span class="fa fa-book"></span> Seminar Proposal</a>
            </li>
          </ul>
        </div>
      
        <div class="card-body p-0 bg-dark">
          <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-three-sks" role="tabpanel" aria-labelledby="custom-tabs-three-sks-tab">
                <!---------------------------------------SURAT KETERANGAN SELESAI------------------------------------------>
          

                @if($sks == 1)
                <div class="p-3">
                  <center>Tidak Ada Data</center>
                </div>
                @else
                  <div style="padding: 6px;">
                    <div class="icheck-danger d-inline"  style="cursor:pointer;">
                      <input type="checkbox" id="checkboxPrimarysks" name="ceksemua" value="check" onclick="toggle(this)">
                      <label for="checkboxPrimarysks">
                        Centang Semua | Surat Keterangan Selesai
                      </label>
                    </div>
                  </div>
                <?php $kj = 0; ?>
                @foreach($sks as $key => $value)
                  @foreach($value as $key2 => $showcek)
                  @php $no = $key+1 @endphp
                 
                  <table border="0" >
                    <tr>
                      <td style="width: 100%;">
                        @if($key2 == 0)
                        <?php echo '<span class="badge badge-success badge-pill" style="margin-left: 6px;">'.$no.'</span><span class="badge badge-warning badge-pill" style="margin-left: 6px;margin-bottom: 10px;margin-top: 10px;">'.strip_tags($showcek->judul).'</span>' ?>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="vertical-align: middle; padding-left: 6px; padding-top: 6px; padding-bottom: 6px;">
                        <a class="btn btn-primary btn-xs" data-toggle="collapse" href="#collapseExample{{$key2}}{{$showcek->id_berkas_buff}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$key2}}{{$showcek->id_berkas_buff}}">
                          {{$showcek->nama_karyawan}}
                        </a>
                      </td>
                      <td>
                        <div class="icheck-primary d-inline">
                              <input style="cursor:pointer; " name="foo" type="checkbox" id="ha{{$key2}}{{$showcek->id_berkas_buff}}" />
                              <label for="ha{{$key2}}{{$showcek->id_berkas_buff}}"></label>
                        </div>
                      </td>
                    </tr>
                  </table>

                  <fieldset id="pilihan_list{{$key2}}{{$showcek->id_berkas_buff}}" disabled>
                  
                    <input type="hidden" name="id_dosensks{{$kj}}" class="form-control" value="{{$showcek->id_dosen}}">
                    <input type="hidden" name="id_berkas_buffsks{{$kj}}" class="form-control" value="{{$showcek->id_berkas_buff}}">
                    <input type="hidden" name="tessks" value="cek">

                    <div class="collapse" id="collapseExample{{$key2}}{{$showcek->id_berkas_buff}}">

                      <div class="card-body p-2">

                        <div class="row">
                        
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Nama Karyawan</label>
                              <input type="hidden" name="nama_karyawansks{{$kj}}"  value="{{ $showcek->id_pegawai }}" readonly>
                              <input type="text" class="form-control" value="{{ $showcek->nama_karyawan }}" readonly>
                            </div>
                          </div>

                          <input type="hidden" name="katbuf" value="{{ $showcek->kategori_buff }}">

                          <div class="col-sm-3">
                            <div class="form-group">
                              <label>Jabatan Fungsional</label>
                              <input type="text" name="jabatan_fungsionalsks{{$kj}}" class="form-control" value="{{ $showcek->jabatan_fungsional }}" readonly="">
                            </div>
                          </div>


                          @if($showcek->kategori_buff == 'surat_keterangan_selesai' && $showcek->jenis_mk != 'Magang')

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Tugas Sebagai | <span class="badge badge-danger badge-pill">{{$showcek->kategori_buff}}</span></label>
                              <input type="text" name="tugas_sebagaisks{{$kj}}" class="form-control" value="{{ jenis_tugas_sks($showcek->kategori_dosen,$key2) }}" readonly="">
                            </div>
                          </div>

                          @elseif(($showcek->kategori_buff == 'surat_keterangan_selesai') && ($showcek->jenis_mk == 'Magang'))

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Tugas Sebagai | <span class="badge badge-danger badge-pill">{{$showcek->kategori_buff}}</span></label>
                              <input type="text" name="tugas_sebagaisks{{$kj}}" class="form-control" value="{{ jenis_tugas_sks($showcek->kategori_dosen,$showcek->jenis_mk) }}" readonly="">
                            </div>
                          </div>

                          @else
                            Terjadi Kesalahan
                          @endif

                          @if($showcek->kategori_buff == 'surat_keterangan_selesai' && $showcek->jenis_mk != 'Magang')

                            @if($key2 == 0)
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Harga</label>
                                <input type="hidden" name="pembayaransks{{$kj}}" value="{{ $showcek->p_t_a_satu }}">

                                <input type="text" class="form-control" value="Rp.{{ $showcek->p_t_a_satu }}" readonly="">
                              </div>
                            </div>
                              
                            @else
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Harga</label>
                                <input type="hidden" name="pembayaransks{{$kj}}" value="{{ $showcek->p_t_a_dua }}">

                                <input type="text" class="form-control" value="Rp.{{ $showcek->p_t_a_dua }}" readonly="">
                              </div>
                            </div>

                            @endif

                          @elseif($showcek->kategori_buff == 'surat_keterangan_selesai' && $showcek->jenis_mk == 'Magang')

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Harga</label>
                                <input type="hidden" name="pembayaransks{{$kj}}" value="{{ $showcek->pkp }}">
                                <input type="text" class="form-control" value="Rp.{{ $showcek->pkp }}" readonly="">
                              </div>
                            </div>

                          @else
                            <font color="red">Terjadi Kesalahan</font>
                          @endif

                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Mulai</label>
                                <input type="hidden" name="mulaisks{{$kj}}" value="{{ $showcek->mulai }}" readonly="">
                                <input type="text" class="form-control" value="{{ tanggal_indo($showcek->mulai) }}" readonly="">
                            </div>
                          </div>
                          
                          <div class="col-sm-2">
                            <div class="form-group">
                              <label>Selesai</label>
                                <input type="hidden" name="selesaisks{{$kj}}" value="{{ $showcek->selesai }}" readonly="">
                                <input type="text" class="form-control" value="{{ tanggal_indo($showcek->selesai) }}" readonly="">
                            </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Nama Mahasiswa</label>
                                <input type="text"  name="nama_mahasiswasks{{$kj}}" class="form-control" value="{{ $showcek->nama }}" readonly="">
                             </div>
                          </div>

                          <div class="col-sm-4">
                            <div class="form-group">
                              <label>Nama Prodi</label>
                                <input type="text" name="nama_prodisks{{$kj}}" class="form-control" value="{{ $showcek->nama_prodi }}" readonly="">
                        
                            </div>
                          </div>

                          <!--row-->
                        </div>


                      </div>
                    </div>

                  </fieldset>
                  <?php $kj++; ?>

                  @endforeach
                @endforeach

                <input type="hidden" name="totdat"  value="{{$kj}}">
                @endif
            </div>

            <div class="tab-pane fade show" id="custom-tabs-three-sta" role="tabpanel" aria-labelledby="custom-tabs-three-sks-tab">
              

            <!---------------------------------------SIDANG TUGAS AKHIR------------------------------------------>

              @if($sta == 1)
              <div class="p-3">
                <center>Tidak Ada Data</center>
              </div>
              @else
                <div style="padding: 6px;">
                    <div class="icheck-danger d-inline"  style="cursor:pointer;">
                      <input type="checkbox" id="checkboxPrimarysta" name="ceksemua" value="check" onclick="toggle2(this)">
                      <label for="checkboxPrimarysta">
                        Centang Semua | Sidang Tugas Akhir
                      </label>
                    </div>
                </div>
              <?php $kz = 0; ?>
              @foreach($sta as $key => $value)
                @foreach($value as $key2 => $showcek)
                @php $no = $key+1 @endphp
                    <table border="0" >
                    <tr>
                      <td style="width: 100%;">
                        @if($key2 == 0)
                        <?php echo '<span class="badge badge-success badge-pill" style="margin-left: 6px;">'.$no.'</span><span class="badge badge-warning badge-pill" style="margin-left: 6px;margin-bottom: 10px;margin-top: 10px;">'.strip_tags($showcek->judul).'</span>' ?>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="vertical-align: middle; padding-left: 6px; padding-top: 6px; padding-bottom: 6px;">
                        <a class="btn btn-primary btn-xs" data-toggle="collapse" href="#collapseExample{{$key2}}{{$showcek->id_berkas_buff}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$key2}}{{$showcek->id_berkas_buff}}">
                          {{$showcek->nama_karyawan}}
                        </a>
                      </td>
                      <td>
                        <div class="icheck-primary d-inline">
                              <input style="cursor:pointer; " name="foo2" type="checkbox" id="ha{{$key2}}{{$showcek->id_berkas_buff}}" />
                              <label for="ha{{$key2}}{{$showcek->id_berkas_buff}}"></label>
                        </div>
                      </td>
                    </tr>
                  </table>

      
                <fieldset id="pilihan_list{{$key2}}{{$showcek->id_berkas_buff}}" disabled>
                
                  <input type="hidden" name="id_dosensta{{$kz}}" class="form-control" value="{{$showcek->id_dosen}}">
                  <input type="hidden" name="id_berkas_buffsta{{$kz}}" class="form-control" value="{{$showcek->id_berkas_buff}}">
                  <input type="hidden" name="tessta" value="cek">

                  <div class="collapse" id="collapseExample{{$key2}}{{$showcek->id_berkas_buff}}">

                    <div class="card-body bg-dark p-2">

                      <div class="row">


                        <div class="col-sm-4">
                          <div class="form-group">
                            <label>Nama Karyawan</label>
                              <input type="hidden" name="nama_karyawansta{{$kz}}"  value="{{ $showcek->id_pegawai }}" readonly>
                              <input type="text" class="form-control" value="{{ $showcek->nama_karyawan }}" readonly>
                          </div>
                        </div>

                        <input type="hidden" name="katbufsta{{$kz}}" value="{{ $showcek->kategori_buff }}">

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Jabatan Fungsional</label>
                            <input type="text" name="jabatan_fungsionalsta{{$kz}}" class="form-control" value="{{ $showcek->jabatan_fungsional }}" readonly="">
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Tugas Sebagai | <span class="badge badge-danger badge-pill">{{$showcek->kategori_buff}}</span></label>
                            
                              <input type="text" name="tugas_sebagaista{{$kz}}" class="form-control" value="{{ jenis_tugas($showcek->kategori_dosen,$showcek->kategori_buff) }}" readonly="">
                         
                          </div>
                        </div>


                        @if($showcek->kategori_buff == 'sidang tugas akhir')
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Harga</label>
                            <input type="hidden" name="pembayaransta{{$kz}}"  value="{{ $showcek->p_tugas_akhir }}" >

                              <input type="text" class="form-control" value="Rp.{{ $showcek->p_tugas_akhir }}" readonly="">
                          </div>
                        </div>
                        @endif
                      
                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Tanggal Pelaksanaan</label>
                            <input type="hidden" name="tanggal_pelaksanaansta{{$kz}}" value="{{ $showcek->tanggal_pelaksanaan }}" >
                            <input type="text" class="form-control" value="{{ tanggal_indo($showcek->tanggal_pelaksanaan) }}" readonly="">
                          </div>
                        </div>

                        <div class="col-sm-2">
                          <div class="form-group">
                            <label>Waktu</label>
                              <input type="text" name="jam_mulaista{{$kz}}" class="form-control" value="{{ $showcek->jam_mulai }}" readonly="">
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Nama Mahasiswa</label>
                              <input type="text"  name="nama_mahasiswasta{{$kz}}" class="form-control" value="{{ $showcek->nama }}" readonly="">
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Nama Prodi</label>
                              <input type="text" name="nama_prodista{{$kz}}" class="form-control" value="{{ $showcek->nama_prodi }}" readonly="">
                          </div>
                        </div>

                        <!--row-->
                      </div>
                    </div>
                  </div>

                </fieldset>

                <?php $kz++; ?>
                
                @endforeach
              @endforeach
              <input type="hidden" name="totdatsta"  value="{{$kz}}">
              @endif

            </div>

            <div class="tab-pane fade show" id="custom-tabs-three-sp" role="tabpanel" aria-labelledby="custom-tabs-three-sks-tab">

              <!---------------------------------------SEMINAR PROPOSAL------------------------------------------>

              @if($sp == 1)
              <div class="p-3">
                <center>Tidak Ada Data</center>
              </div>
              @else
                <div style="padding: 6px;">
                    <div class="icheck-danger d-inline"  style="cursor:pointer;">
                      <input type="checkbox" id="checkboxPrimarysp" name="ceksemua" value="check" onclick="toggle3(this)">
                      <label for="checkboxPrimarysp">
                        Centang Semua | Seminar Proposal
                      </label>
                    </div>
                </div>
              <?php $kt = 0; ?>
              @foreach($sp as $key => $value)
                @foreach($value as $key2 => $showcek)

                 @php $no = $key+1 @endphp
                    <table border="0" >
                    <tr>
                      <td style="width: 100%;">
                        @if($key2 == 0)
                        <?php echo '<span class="badge badge-success badge-pill" style="margin-left: 6px;">'.$no.'</span><span class="badge badge-warning badge-pill" style="margin-left: 6px;margin-bottom: 10px;margin-top: 10px;">'.strip_tags($showcek->judul).'</span>' ?>
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="vertical-align: middle; padding-left: 6px; padding-top: 6px; padding-bottom: 6px;">
                        <a class="btn btn-primary btn-xs" data-toggle="collapse" href="#collapseExample{{$key2}}{{$showcek->id_berkas_buff}}" role="button" aria-expanded="false" aria-controls="collapseExample{{$key2}}{{$showcek->id_berkas_buff}}">
                          {{$showcek->nama_karyawan}}
                        </a>
                      </td>
                      <td>
                        <div class="icheck-primary d-inline">
                              <input style="cursor:pointer; " name="foo3" type="checkbox" id="ha{{$key2}}{{$showcek->id_berkas_buff}}" />
                              <label for="ha{{$key2}}{{$showcek->id_berkas_buff}}"></label>
                        </div>
                      </td>
                    </tr>
                  </table>

              <fieldset id="pilihan_list{{$key2}}{{$showcek->id_berkas_buff}}" disabled>
              
                <input type="hidden" name="id_dosensp{{$kt}}" class="form-control" value="{{$showcek->id_dosen}}">
                <input type="hidden" name="id_berkas_buffsp{{$kt}}" class="form-control" value="{{$showcek->id_berkas_buff}}">
                <input type="hidden" name="tessp" value="cek">

                <div class="collapse" id="collapseExample{{$key2}}{{$showcek->id_berkas_buff}}">

                  <div class="card-body bg-dark p-2">

                    <div class="row">


                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Nama Karyawan</label>
                              <input type="hidden" name="nama_karyawansp{{$kt}}"  value="{{ $showcek->id_pegawai }}" readonly>
                              <input type="text" class="form-control" value="{{ $showcek->nama_karyawan }}" readonly>
                        </div>
                      </div>

                        <input type="hidden" name="katbufsp{{$kt}}" value="{{ $showcek->kategori_buff }}">

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Jabatan Fungsional</label>
                            <input type="text" name="jabatan_fungsionalsp{{$kt}}" class="form-control" value="{{ $showcek->jabatan_fungsional }}" readonly="">
                      
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                        <label>Tugas Sebagai | <span class="badge badge-danger badge-pill">{{$showcek->kategori_buff}}</span></label>
                          <input type="text" name="tugas_sebagaisp{{$kt}}" class="form-control" value="{{ jenis_tugas($showcek->kategori_dosen,$showcek->kategori_buff) }}" readonly="">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                        <label>Harga</label>
                          <input type="hidden" name="pembayaransp{{$kt}}" value="{{ $showcek->p_seminar_p_t_a }}">
                          <input type="text" class="form-control" value="Rp.{{ $showcek->p_seminar_p_t_a }}" readonly="">
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Nama Mahasiswa</label>
                            <input type="text"  name="nama_mahasiswasp{{$kt}}" class="form-control" value="{{ $showcek->nama }}" readonly="">
                     
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Nama Prodi</label>
                            <input type="text" name="nama_prodisp{{$kt}}" class="form-control" value="{{ $showcek->nama_prodi }}" readonly="">
                      
                        </div>
                      </div>


                      <div class="col-sm-3">
                        <div class="form-group">
                        <label>Tanggal Pelaksanaan</label>
                          <input type="hidden" name="tanggal_pelaksanaansp{{$kt}}" value="{{ $showcek->tanggal_pelaksanaan }}" >
                          <input type="text" class="form-control" value="{{ tanggal_indo($showcek->tanggal_pelaksanaan) }}" readonly="">
                        </div>
                      </div>
                    
                      <div class="col-sm-3">
                        <div class="form-group">
                          <label>Waktu</label>
                            <input type="text" name="jam_mulaisp{{$kt}}" class="form-control" value="{{ $showcek->jam_mulai }}" readonly="">
                   
                        </div>
                      </div>

                      

                    <!--row-->
                    </div>
                  </div>
                </div>

              </fieldset>

              <?php $kt++;  ?>
              @endforeach
              @endforeach

              <input type="hidden" name="totdatsp"  value="{{$kt}}">
              @endif


            </div>
          </div>
        </div>
      </div>

        
        <button type="submit" class="btn btn-outline-primary" style="float: right;"><span class="fa fa-plus"></span> Simpan Data</button>

    </div>
  </div>
</div>


</form>

@php
function jenis_tugas($jenis_a, $jenis_b){

    if (($jenis_a  == 'Penguji') && ($jenis_b == 'seminar proposal')) {

       return 'Penguji Seminar Proposal Tugas Akhir';

    }elseif(($jenis_a  == 'Penguji') && ($jenis_b == 'sidang tugas akhir')){

        return 'Penguji Tugas Akhir';

    }else{
        return 'null';
    }

}

function jenis_tugas_sks($jenis_a, $jenis_b){

    if (($jenis_a  == 'Pembimbing') && ($jenis_b == '0')) {

       return 'Dosen Pembimbing Tugas Akhir Pertama';

    }elseif(($jenis_a  == 'Pembimbing') && ($jenis_b == '1')){

        return 'Dosen Pembimbing Tugas Akhir Kedua';

    }elseif(($jenis_a == 'Pembimbing') && ($jenis_b == 'Magang')){

        return 'Pembimbing Kerja Praktik/Magang';

    }else{
        return 'null';
    }

}


function tanggal_indo($tanggal) {
        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
    }

@endphp


@endsection
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

<script type="text/javascript">

     $(document).on('submit', '#TamCekHonor', function (e) {
      var result = confirm("Anda Yakin Telah Memeriksa Data Dengan Benar ?");
      if (result) {
          e.preventDefault();
          var route = $('#TamCekHonor').data('route');
          var form_data = $(this);
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          Pace.track(function(){
            $.ajax({
              type: 'POST',
              url: route,
              data: form_data.serialize(),
              beforeSend: function () {
                $('.disabcekhonor').attr('disabled', 'disabled');
                Pace.restart();
              },
              success: function (data) {
                switch (data.cek) {
                case "berhasil":
                toastr.success('Data Berhasil Diproses');
                  setTimeout(function(){
                   window.location.href = "{{ route('index_honorarium')}}"; 
                  }, 3000);
                  break;
                case "gagal":
                  toastr.warning(data.datacek);
                  break;
              
                }
              },
              complete: function () {
                $('.disabcekhonor').prop("disabled", false);
              },
              error: function (xhr) {
                swal("Upsss!", "TERJADI kESALAHAN", "error");
              },
            })
          });
        }
     });

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



       //cek harga honorarium memalui iframe embed modal
    $(document).on('click', '.cek_set_honor', function(){
     $('#show_set_honor').modal('show');
    });

</script>

<!---SURAT KETERANGAN SELESAI-->

@if($sks == 1)
@else
@foreach($sks as $key => $value)
@foreach($value as $key2 => $showcek)
<script type="text/javascript">
$(document).ready(function() {

  $(document).on('click', '#ha<?php echo $key2.$showcek->id_berkas_buff ?>', function(){
        //$('#console-event').html('Toggle: ' + $(this).prop('checked'))
        if (document.getElementById('ha<?php echo $key2.$showcek->id_berkas_buff ?>').checked == true) {
          document.getElementById('pilihan_list<?php echo $key2.$showcek->id_berkas_buff ?>').removeAttribute('disabled','disabled');
        }else{
          document.getElementById('pilihan_list<?php echo $key2.$showcek->id_berkas_buff ?>').setAttribute('disabled','disabled');
        }
      });

});

$(document).ready(function() {
    $(document).on('click', '#checkboxPrimarysks', function(){
      if (document.getElementById('checkboxPrimarysks').checked == true) {
          $("#pilihan_list<?php echo $key2.$showcek->id_berkas_buff ?>").prop('disabled', false);
        }else{
          $("#pilihan_list<?php echo $key2.$showcek->id_berkas_buff ?>").prop('disabled', true);
        }
      });
});

</script>
@endforeach
@endforeach
@endif

<!---SIDANG TUGAS AKHIR--->


@if($sta == 1)
@else
@foreach($sta as $key => $value)
@foreach($value as $key2 => $showcek)
<script type="text/javascript">
$(document).ready(function() {

  $(document).on('click', '#ha<?php echo $key2.$showcek->id_berkas_buff ?>', function(){
        //$('#console-event').html('Toggle: ' + $(this).prop('checked'))
        if (document.getElementById('ha<?php echo $key2.$showcek->id_berkas_buff ?>').checked == true) {
          document.getElementById('pilihan_list<?php echo $key2.$showcek->id_berkas_buff ?>').removeAttribute('disabled','disabled');
        }else{
          document.getElementById('pilihan_list<?php echo $key2.$showcek->id_berkas_buff ?>').setAttribute('disabled','disabled');
        }
      });

});

$(document).ready(function() {
    $(document).on('click', '#checkboxPrimarysta', function(){
      if (document.getElementById('checkboxPrimarysta').checked == true) {
          $("#pilihan_list<?php echo $key2.$showcek->id_berkas_buff ?>").prop('disabled', false);
        }else{
          $("#pilihan_list<?php echo $key2.$showcek->id_berkas_buff ?>").prop('disabled', true);
        }
      });
});

</script>
@endforeach
@endforeach
@endif

<!---SEMINAR PROPOSAL-->

@if($sp == 1)
@else
@foreach($sp as $key => $value)
@foreach($value as $key2 => $showcek)
<script type="text/javascript">
$(document).ready(function() {

  $(document).on('click', '#ha<?php echo $key2.$showcek->id_berkas_buff ?>', function(){
        //$('#console-event').html('Toggle: ' + $(this).prop('checked'))
        if (document.getElementById('ha<?php echo $key2.$showcek->id_berkas_buff ?>').checked == true) {
          document.getElementById('pilihan_list<?php echo $key2.$showcek->id_berkas_buff ?>').removeAttribute('disabled','disabled');
        }else{
          document.getElementById('pilihan_list<?php echo $key2.$showcek->id_berkas_buff ?>').setAttribute('disabled','disabled');
        }
      });

});
$(document).ready(function() {
    $(document).on('click', '#checkboxPrimarysp', function(){
      if (document.getElementById('checkboxPrimarysp').checked == true) {
          $("#pilihan_list<?php echo $key2.$showcek->id_berkas_buff ?>").prop('disabled', false);
        }else{
          $("#pilihan_list<?php echo $key2.$showcek->id_berkas_buff ?>").prop('disabled', true);
        }
      });
  });
</script>
@endforeach
@endforeach
@endif




<script type="text/javascript">

    function toggle(source) {
      checkboxes = document.getElementsByName('foo');
      for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;

      }
    }
    function toggle2(source) {
      checkboxes = document.getElementsByName('foo2');
      for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;

      }
    }

    function toggle3(source) {
      checkboxes = document.getElementsByName('foo3');
      for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;

      }
    }
</script>

@include('sweet::alert')
@endsection
