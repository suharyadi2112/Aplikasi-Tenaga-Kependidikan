
@extends('admin.layout.master')

@section('content')
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
<br>
<div class="container-fluid"> 
       @if ($message = Session::get('success'))
           <div class="uk-alert uk-alert-success" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
             
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $message }}</strong>
              </div>
              
          </div>
        @endif
        @if ($message = Session::get('error'))
           <div class="uk-alert uk-alert-error" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
             
              <div class="alert alert-error alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $message }}</strong>
              </div>
              
          </div>
        @endif
         @if ($message = Session::get('kosong'))
         <?php $id_baru = Session::get('cek_id') ?>
           <div class="uk-alert uk-alert-warning" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
             
              <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $message }} | </strong>
                <a href="{{ Route('PegawaiAddDataDiri',['id_user' => $id_baru]) }}">Isi Data Diri  </a>
              </div>
              
          </div>
        @endif
    <!-- Main content -->
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  @if($Ddiri->jenis_kelamin == 'Pria')
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ URL::asset('admin/dist/img/avatar5.png') }}"
                       alt="User profile picture">
                  @else
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{ URL::asset('admin/dist/img/avatar3.png') }}"
                       alt="User profile picture">
                  @endif
                 
                </div>

                <h3 class="profile-username text-center">{{ $Ddiri->nama_lengkap }}</h3>
                <h4 class="profile-username text-center">{{ $Ddiri->nama_mandarin }}</h4>


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-heart"></i> Agama</strong>

                <p class="text-muted">
                 {{ $Ddiri->agama }}
                </p>

                <hr>
                <strong><i class="fas fa-map-marked-alt"></i> Tempat Lahir</strong>

                <p class="text-muted">
                 {{ $Ddiri->nama }} - {{ $Ddiri->nama_kab }}
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

                <p class="text-muted">{{ $Ddiri->alamat_sekarang }}</p>

                <hr>

                <strong><i class="fas fa-at"></i> E-mail</strong>

                <p class="text-muted">{{ $Ddiri->email }}</p>

                <hr>
                <strong><i class="fas fa-comments"></i> Kontak Whatsapp</strong>

                <p class="text-muted">{{ $Ddiri->nomor_wa }}</p>

                <hr>

                <strong><i class="fas fa-venus-mars"></i> Jenis Kelamin</strong>

                <p class="text-muted">{{ $Ddiri->jenis_kelamin }}</p>

               
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2 " id="myTab">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Umum</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Pendidikan</a></li>
                  <li class="nav-item"><a class="nav-link" href="#marital" data-toggle="tab">Marital dll</a></li>
                  <li class="nav-item"   style="padding-right: 10rem">
                  <a class="nav-link" href="{{ URL::to('pegawai') }}" data-toggle="tooltip" data-placement="bottom" title="Kembali - Home Pegawai"><b><span class="fa fa-arrow-left"></span> Kembali </b></a></li>

                  <form role="form" id="cekdata" method="POST" action="">@csrf
                    <select class="nav-link select" id="list_pegawai" name="nm_pegawai" onchange="onSelectChange();">
                      <option>Pilih Pegawai</option>
                      @foreach($list_pegawai as $yt => $s_lp)
                        <option value="{{ $s_lp->id_user }}" @if ($id_user == $s_lp->id_user) selected  @endif>{{ $s_lp->nama_karyawan }}</option>
                      @endforeach</select>
                  </form>
                </ul>
              </div><!-- /.card-header -->
            
            </div>

              <div class="tab-content">
              <div class="active tab-pane" id="activity">    
                
              <div class="card">
                <div class="card-header bg-info">
                  <h3 class="card-title">Data Diri</h3>
                </div>
                  <div class="card-body">
                       
                    <div class="table-responsive">
                      <table id="cek_penilaian" class="table table-striped dt-responsive display" width="100%">
                        <thead>
                        <tr>
                          <th><span class="fa fa-eye"></span></th>
                          <th nowrap="">Nomor KTP</th> 
                          <th nowrap="">Aktif KTP</th>
                          <th nowrap="">Nomor NPWP</th>
                          <th nowrap="">Tanggal Lahir</th>
                          <th nowrap="">Status Marital</th>
                          <th nowrap=""><span class="fa fa-cogs"></span></th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                    <!-- /.tab-content -->
                 </div><!-- /.card-body -->
              </div>


              <div class="card">
                <div class="card-header bg-info">
                  <h3 class="card-title">Identitas</h3>
                </div>

                <div class="card-body" style="padding-top: 5px;">
                    <a href="#" title="Edit Data" style="float: right;">
                        <button type="button" class="edit_identitas btn btn-outline-success btn-xs" >
                          <span class="fa fa-pencil-alt"> </span></button>
                     </a></br></br>
                  <div class="table-responsive">
                    <table id="" class="table table-striped dt-responsive display">
                      <thead>
                        <tr>
                          <th nowrap="">No</th> 
                          <th nowrap="">Identitas yang dimiliki</th> 
                          
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($iden as $keyiden => $showiden)
                        <tr>
                          <td>{{ $keyiden + 1 }}</td>
                          <td>{{ $showiden->jenis }}</td>
                        </tr>
                        @empty
                        <tr>
                          <td style="text-align: center;" colspan="10">Tidak Ada Data</td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>



              </div><!--batas id-->

              <div class="tab-pane" id="settings"> 
                <div class="card ">
                  <div class="card-header bg-info">
                    <h3 class="card-title">Sekolah Menengah Atas(Sederajat)</h3>
                  </div>

                  <div class="card-body">
                    <a href="#" class="btn btn-outline-success btn-xs TambahSMA" style="float: right;"><span class="fa fa-plus"> </span> Tambah SMA</a><br><br>
                    <div class="table-responsive">
                      <table id="" class="table table-striped dt-responsive display">
                        <thead>
                          <tr>
                            <th nowrap="">No</th> 
                            <th nowrap="">Nama Sekolah</th>
                            <th nowrap="">Jurusan</th>
                            <th nowrap="">Mulai Pendidikan</th>
                            <th nowrap="">Selesai Pendidikan</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($sma as $keysma => $showsma)
                          <tr>
                            <td>{{ $keysma + 1 }}</td>
                            <td>{{ $showsma->nama_sekolah }}</td>
                            <td>{{ $showsma->jurusan }}</td>
                            <td><span class="badge badge-pill badge-success">{{ $showsma->mulai_pendidikan }} </span></td>
                            <td><span class="badge badge-pill badge-danger">{{ $showsma->selesai_pendidikan }}</span></td>
                             <td>
                               <a href="#" title="Edit Data SMA">
                                <button type="button" class="EditSMA btn btn-outline-success btn-xs" 
                                data_idsma="{{ $showsma->id_sekolah }}"
                                data_namasma="{{ $showsma->nama_sekolah }}"
                                data_jurusan="{{ $showsma->jurusan }}"
                                data_mulaipensma="{{ $showsma->mulai_pendidikan }}"
                                data_selesaipensma="{{ $showsma->selesai_pendidikan }}"

                                >
                                  <span class="fa fa-pencil-alt"> </span></button>
                              </a>
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td style="text-align: center;" colspan="10">Tidak Ada Data</td>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
                <div class="card ">
                  <div class="card-header bg-info">
                    <h3 class="card-title">Perguruan Tinggi</h3>
                     <a href="#" class="TambahPerting btn btn-flat btn-xs" style="float: right; background: #08203c">
                        <span class="fa fa-plus"> </span>
                      </a>
                  </div>
                  <div class="card-body">
                    
                    <div class="table-responsive">
                      <table id="" class="table table-striped dt-responsive display">
                        <thead>
                          <tr>
                            <th nowrap="">No</th> 
                            <th nowrap="">Nama Perguruan Tinggi</th>
                            <th nowrap="">Program Studi</th>
                            <th nowrap="">Tingkat</th>
                            <th nowrap="">IPK</th>
                            <th nowrap="">Mulai Pendidikan</th>
                            <th nowrap="">Selesai Pendidikan</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($perting as $keyperting => $showperting)
                          <tr>
                            <td>{{ $keyperting + 1 }}</td>
                            <td>{{ $showperting->nama_sekolah_perting }}</td>
                            <td>{{ $showperting->program_studi }}</td>
                            <td>{{ $showperting->tingkat }}</td>
                            <td>{{ $showperting->ipk }}</td>
                            <td><span class="badge badge-pill badge-success">{{ $showperting->mulai_pendidikan }} </span></td>
                            <td><span class="badge badge-pill badge-danger">{{ $showperting->selesai_pendidikan }}</span></td>
                            <td nowrap="">
                              <a href="#" title="Edit Data Perguruan Tinggi">
                                <button type="button" class="EditPerting btn btn-outline-success btn-xs" 
                                data_idperting="{{ $showperting->id_perting }}"
                                data_nama_sekolah_perting="{{ $showperting->nama_sekolah_perting }}"
                                data_tingkat_perting="{{ $showperting->tingkat }}"
                                data_jurusan_perting="{{ $showperting->program_studi }}"
                                data_ipk_perting="{{ $showperting->ipk }}"
                                data_mulai_pendidikan_perting="{{ $showperting->mulai_pendidikan }}"
                                data_selesai_pendidikan_perting="{{ $showperting->selesai_pendidikan }}"
                                
                                >

                                  <span class="fa fa-pencil-alt"> </span></button>
                              </a> | 

                              <a href="{{ Route('HapusPerting',['id' => $showperting->id_perting]) }}" title="Hapus Data Perguruan Tinggi">
                                <button type="button" class=" btn btn-outline-danger btn-xs" onclick="return confirm('Anda yakin menghapus data ini ?')">

                                  <span class="fa fa-trash"> </span></button>
                              </a>
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td style="text-align: center;" colspan="10">Tidak Ada Data</td>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                    <!-- /.tab-content -->
                  </div><!-- /.card-body -->
                </div>
            </div>

            <div class="tab-pane" id="marital"> 
              <div class="card ">
                <div class="card-header bg-info">
                  <h3 class="card-title">Marital</h3>
                </div>
                <div class="card-body">
                   <a href="#" class="btn btn-outline-success btn-xs TambahPasangan" style="float: right;"><span class="fa fa-plus"></span> Tambah Pasangan</a>
                <br><br>     
                  <div class="table-responsive">
                    <table id="" class="table table-striped dt-responsive display">
                      <thead>
                        <tr>
                          <th nowrap="">No</th> 
                          <th nowrap="">Nama Suami/Istri</th>
                          <th nowrap="">Pekerjaan Suami/Istri</th>
                          <th nowrap="">Nomor Telepon Suami/Istri</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($maritalpasangan as $keymari => $showmari)
                        <tr>
                          <td>{{ $keymari + 1 }}</td>
                          <td>{{ $showmari->nama_pasangan }}</td>
                          <td>{{ $showmari->pekerjaan_pasangan }}</td>
                          <td>{{ $showmari->nomor_telepon_pasangan }}</td>
                          <td nowrap="">
                              
                            <a href="#" title="Edit Data Marita Pasangan">
                                <button type="button" class="EditMaritalPasangan btn btn-outline-success btn-xs" 
                                data_idpasangan="{{ $showmari->id_maritalpasangan }}"
                                data_namapasangan="{{ $showmari->nama_pasangan }}"
                                data_pekerjaanpasangan="{{ $showmari->pekerjaan_pasangan }}"
                                data_nomorteleponpasangan="{{ $showmari->nomor_telepon_pasangan }}"
                                >

                                  <span class="fa fa-pencil-alt"> </span></button>
                              </a> | 
                               <a href="{{ Route('HapusMaritalPasangan',['id_pasagan' => $showmari->id_maritalpasangan]) }}" title="Hapus Marita Pasangan" class="btn btn-outline-danger btn-xs" onclick="return confirm('Anda yakin menghapus data ini ?')">
                                   <span class="fa fa-trash"></span>
                              </a>

                          </td>
                        </tr>
                        @empty
                        <tr>
                          <td style="text-align: center;" colspan="10">Tidak Ada Data</td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>

              <div class="card ">
                <div class="card-header bg-info">
                  <h3 class="card-title">Marital Anak</h3>
                </div>
                <div class="card-body">
                   <a href="#" class="TambahMaritalAnak btn btn-outline-success btn-xs" style="float: right;">
                    <span class="fa fa-plus"></span> Tambah Anak
                  </a>
                  <br><br>  
                  <div class="table-responsive">
                    <table id="" class="table table-striped dt-responsive display">
                      <thead>
                        <tr>
                          <th nowrap="">No</th> 
                          <th nowrap="">Nama Anak</th>
                          <th nowrap="">Tanggal Lahir Anak</th>
                          <th nowrap="">Jenis Kelamin Anak</th>
                          <th nowrap="">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($marital as $keymari => $showmari)
                        <tr>
                          <td>{{ $keymari + 1 }}</td>
                          <td>{{ $showmari->nama_anak }}</td>
                          <td>{{ $showmari->ttl_anak }}</td>
                          <td>{{ $showmari->jenis_kelamin_anak }}</td>
                          <td>
                            <a href="#" title="Edit Data Marita Anak">
                              <button type="button" class="EditMaritalAnak btn btn-outline-success btn-xs" 
                              data_idanak="{{ $showmari->id_marital }}"
                              data_namaanak="{{ $showmari->nama_anak }}"
                              data_ttlanak="{{ $showmari->ttl_anak }}"
                              data_jeniskelaminanak="{{ $showmari->jenis_kelamin_anak }}"
                              >

                                <span class="fa fa-pencil-alt"> </span></button>
                            </a> |
                            <a href="{{ Route('HapusMaritalAnak',['id' => $showmari->id_marital]) }}" title="Hapus Data Anak">
                                <button type="button" class=" btn btn-outline-danger btn-xs" onclick="return confirm('Anda yakin menghapus data ini ?')">
                                  <span class="fa fa-trash"> </span></button>
                            </a>
                          </td>
                        </tr>
                        @empty
                        <tr>
                          <td style="text-align: center;" colspan="10">Tidak Ada Data</td>
                        </tr>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>

              <div class="card ">
                <div class="card-header bg-info">
                  <h3 class="card-title">Kontak Darurat</h3>
                </div>
                <div class="card-body">
                  <a href="#" class="btn btn-outline-success btn-xs TambahKontakDarurat" style="float: right;"><span class="fa fa-plus"></span> Tambah Kontak</a>
                  <br><br>
                  <div class="table-responsive">
                    <table id="" class="table table-striped dt-responsive display">
                      <thead>
                        <tr>
                          <th nowrap="">Nama</th>
                          <th nowrap="">Hubungan</th>
                          <th nowrap="">Nomor Telepon</th>
                          <th nowrap="">Kota</th>
                          <th>Aksi</th>
                      </thead>
                      <tbody>
                        @forelse($kontak_darurat as $rt => $v_kon)
                        <tr>
                          <td>{{ $v_kon->nama_kd }}</td>
                          <td>{{ $v_kon->hubungan_kd }}</td>
                          <td>{{ $v_kon->nomor_telepon_kd }}</td>
                          <td>{{ $v_kon->kota_kd }}</td>
                          <td>
                            
                            <a href="#" title="Edit Data Kontak Darurat">
                                <button type="button" class="EditKontakDarurat btn btn-outline-success btn-xs" 
                                data_idkontakdarurat="{{ $v_kon->id_kontak_darurat }}"
                                data_nama_kd="{{ $v_kon->nama_kd }}"
                                data_hubungan_kd="{{ $v_kon->hubungan_kd }}"
                                data_nomor_telepon_kd="{{ $v_kon->nomor_telepon_kd }}"
                                data_kota_kd="{{ $v_kon->kota_kd }}"
                                >

                                  <span class="fa fa-pencil-alt"> </span></button>
                              </a> | 
                               <a href="{{ Route('HapusKonDar',['id' => $v_kon->id_kontak_darurat]) }}" title="Hapus Kontak Darurat">
                                <button type="button" class="btn btn-outline-danger btn-xs" onclick="return confirm('Anda yakin menghapus data ini ?')">
                                  <span class="fa fa-trash"> </span></button>
                            </a>
                          </td>
                        </tr>
                        @empty
                          <tr>
                            <td colspan="10" style="text-align: center;">Tidak Ada Data</td>
                          </tr>
                        @endforelse
                    
                      
                      </tbody>
                    </table>
                  </div>
                  <!-- /.tab-content -->
                </div><!-- /.card-body -->
              </div>


            </div>


          </div>

        </div>
      </div>

</div>

@include('admin.dashboard.pegawai.ModalEditPegawai')
@php
/*
function tanggal_indo($tanggal) {
        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $split = explode('-', $tanggal);
        return $bulan[(int) $split[1]] . ' ' . $split[0];
    }
    */
@endphp

@endsection
@section('script')
<script type="text/javascript">
function isNumberKey(evt)
    {
       var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;

       return true;
    }


function onSelectChange(){

  jQuery( document ).ready(function( $ ) {
    var id_user =  $( "#list_pegawai" ).val();
    url = '{{route("DataDiriPegawai", ":id_user")}}'.replace(":id_user", id_user);
    b = document.getElementById("cekdata").action = url;
    if (b) {
      document.getElementById('cekdata').submit();
    }
    
  });

}



$.noConflict();
jQuery( document ).ready(function( $ ) {



$('[data-mask]').inputmask();
 $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
/////////////////////////////////////PERGURUAN TINGGI////////////////////////////////////////////

//edit perguruan tinggi
$(document).on('click', '.EditPerting', function(){

  $('#edit_perting').modal('show');
  var  data_idperting = $(this).attr('data_idperting');
  var  nama_sekolah_perting = $(this).attr('data_nama_sekolah_perting');
  var  tingkat_perting = $(this).attr('data_tingkat_perting');
  var  jurusan_perting = $(this).attr('data_jurusan_perting');
  var  ipk_perting = $(this).attr('data_ipk_perting');
  var  mulai_pendidikan_perting = $(this).attr('data_mulai_pendidikan_perting');
  var  selesai_pendidikan_perting = $(this).attr('data_selesai_pendidikan_perting') 
  $("#id_perting").val(data_idperting);
  $("#nama_sekolah_perting").val(nama_sekolah_perting);
  $('#tingkat_perting option[value="' + tingkat_perting + '"]').attr('selected','selected');
  $("#jurusan_perting").val(jurusan_perting);
  $("#ipk_perting").val(ipk_perting);
  $("#mulai_pendidikan_perting").val(mulai_pendidikan_perting);
  $("#selesai_pendidikan_perting").val(selesai_pendidikan_perting);

});

//tambah perguruan tinggi
$(document).on('click', '.TambahPerting', function(){

  $('#tambah_perting').modal('show');

});


/////////////////////////////////////PERGURUAN TINGGI//////////////////////////////////////////////


/////////////////////////////////////MARITAL PASANGAN//////////////////////////////////////////////

//Tambah Marital Pasangan
$(document).on('click', '.TambahPasangan', function(){

  $('#TambahMaritalPasangan').modal('show');

});
$(document).on('click', '.EditMaritalPasangan', function(){

  $('#edit_maritalpasangan').modal('show');

  var  idpasangan = $(this).attr('data_idpasangan');
  var  nama_pasangan2 = $(this).attr('data_namapasangan');
  var  pekerjaan_pasangan2 = $(this).attr('data_pekerjaanpasangan');
  var  nomor_telepon_pasangan2 = $(this).attr('data_nomorteleponpasangan');
  $("#nama_pasangan2").val(nama_pasangan2);
  $("#pekerjaan_pasangan2").val(pekerjaan_pasangan2);
  $("#nomor_telepon_pasangan2").val(nomor_telepon_pasangan2);
  $("#idpasangan").val(idpasangan);

});


$(document).on('click', '.TambahMaritalAnak', function(){
  $('#tambah_maritalanak').modal('show');
});

$(document).on('click', '.EditMaritalAnak', function(){

  $('#edit_anak').modal('show');

  var  id_anak = $(this).attr('data_idanak');
  var  nama_anak_id = $(this).attr('data_namaanak');
  var  ttl_anak_id = $(this).attr('data_ttlanak');
  var  jenis_kelamin_anak_id = $(this).attr('data_jeniskelaminanak');
  $("#id_anak").val(id_anak);
  $("#nama_anak_id").val(nama_anak_id);
  $("#ttl_anak_id").val(ttl_anak_id);
  $('#jenis_kelamin_anak_id option[value="' + jenis_kelamin_anak_id + '"]').attr('selected','selected');
  
});
/////////////////////////////////////MARITAL PASANGAN/////////////////////////////////////////////



/////////////////////////////////////SMA SEDERAJAT EDIT////////////////////////////////////////////

$(document).on('click', '.EditSMA', function(){

  $('#sma_sederajat').modal('show');

  var data_idsma = $(this).attr('data_idsma');
  var data_namasma = $(this).attr('data_namasma');
  var data_jurusan = $(this).attr('data_jurusan');
  var data_mulaipensma = $(this).attr('data_mulaipensma');
  var data_selesaipensma = $(this).attr('data_selesaipensma');

  $("#idsma").val(data_idsma);
  $("#nama_sma").val(data_namasma);
  $("#jurusan").val(data_jurusan);
  $("#mulaisma").val(data_mulaipensma);
  $("#selesaisma").val(data_selesaipensma);
  

});

/////////////////////////////////////SMA SEDERAJAT EDIT////////////////////////////////////////////


/////////////////////////////////////SMA SEDERAJAT TAMBAH////////////////////////////////////////////

$(document).on('click', '.TambahSMA', function(){

  $('#sma_sederajat_tambah').modal('show');

});

/////////////////////////////////////SMA SEDERAJAT TAMBAH////////////////////////////////////////////



///////////////////////////////////////////KONTAK DARURAT///////////////////////////////////////////////////
$(document).on('click', '.EditKontakDarurat', function(){

  $('#edit_kontakdarurat').modal('show');

  var  id_kontak = $(this).attr('data_idkontakdarurat');
  var  nama_nodarurat = $(this).attr('data_nama_kd');
  var  hubungan_nodarurat = $(this).attr('data_hubungan_kd');
  var  nomor_darurat = $(this).attr('data_nomor_telepon_kd');
  var  kota_nodarurat = $(this).attr('data_kota_kd');

  $("#id_kontak").val(id_kontak);
  $("#nama_nodarurat").val(nama_nodarurat);
  $("#hubungan_nodarurat").val(hubungan_nodarurat);
  $("#nomor_darurat").val(nomor_darurat);
  $("#kota_nodarurat").val(kota_nodarurat);

  
});
$(document).on('click', '.TambahKontakDarurat', function(){

  $('#tambah_kontakdarurat').modal('show');
  
});

///////////////////////////////////////////KONTAK DARURAT///////////////////////////////////////////////////



/////////////////////////////////////EDIT IDENTITAS LAINNYA//////////////////////////////////////////////////


$(document).on('click', '.edit_identitas', function(){

  $('#identitas_edit').modal('show');


   $(document).on('submit', '#UpdateIdentitas', function(e) {  
      e.preventDefault();
      var route = $('#UpdateIdentitas').data('route');
      var form_data = $(this);
      var wrapper = $("#overlayiden");
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        $.ajax({

          type: 'POST',
          url: route,
          data: form_data.serialize(),

          beforeSend: function(){

            $(wrapper).append(  '<div class="overlay d-flex justify-content-center align-items-center">'+
                                      '<i class="fas fa-2x fa-sync fa-spin"></i>'+
                                      'Sedang Memproses Data'+
                                  '</div>');

          },
          success: function(Response){

             $.blockUI({ css: { 
                border: 'none', 
                padding: '5px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '5px', 
                '-moz-border-radius': '5px', 
                opacity: .5, 
                color: '#fff' 
            } }); 
            swal("Berhasil!", "Berhasil Memproses Data!", "success");
            
           
            },
          complete: function() {
                $('.overlay').remove();
                $('#UpdateIdentitas').modal('hide');
                $.unblockUI();
                setTimeout(location.reload.bind(location), 2000);

                },
          error: function(xhr) { // if error occured
                    swal("Upsss!", "Terjadi Kesalahan", "error");
                },

      })
    });



 });

/////////////////////////////////////EDIT IDENTITAS LAINNYA//////////////////////////////////////////////////







$(document).on('click', '.edit_datadiri', function(){

    var tahunikrar = "<?php echo $Ddiri->ikrartahun_vege; ?>";
    var jenis_qiudao = "<?php echo $Ddiri->jenis_qiudao; ?>";
    var agama = "<?php echo $Ddiri->agama; ?>";
    //list ikrar tahun

    var year = 1900;
    var till = 2020;
    var jejak = "Belum Dipilih";
    var options = "";
    for(var y=year; y<=till; y++){
      if (options == "") {
        options += "<option value=''>"+ jejak +"</option>";
      }
      options += "<option value="+y+">"+ y +"</option>";
    }
    document.getElementById("tahunikrar").innerHTML = options;


  $('#tahunikrar option[value="' + tahunikrar + '"]').attr('selected','selected');

  if (agama != 'Buddha Maitreya') {

    $('#ikrarradio').prop('disabled', true);
    $('#ikrarradio12').prop('disabled', true);
    $('#tahunikrar').prop('disabled', true);
    $('#status_vihara').prop('disabled', true);
    $('#status_vihara12').prop('disabled', true);
    $('#DaoQin').prop('disabled', true);
    $('#FoYuan').prop('disabled', true);
    $('#TanZhu').prop('disabled', true);

  }
  //console.log(tahunikrar);
  if (tahunikrar === "") {
    $('#tahunikrar').prop('disabled', true);
  }

  if (jenis_qiudao === "") {
    $('#DaoQin').prop('disabled', true);
    $('#FoYuan').prop('disabled', true);
    $('#TanZhu').prop('disabled', true);
  }
  
  $('#status_vihara').click(function(){
    $('#DaoQin').prop('disabled', false);
    $('#FoYuan').prop('disabled', false);
    $('#TanZhu').prop('disabled', false);
  });
  $('#status_vihara12').click(function(){
    $('#DaoQin').prop('disabled', true);
    $('#FoYuan').prop('disabled', true);
    $('#TanZhu').prop('disabled', true);
    
    $('#DaoQin').prop('checked', false); 
    $('#FoYuan').prop('checked', false); 
    $('#TanZhu').prop('checked', false); 
  });

  $('#ikrarradio').click(function(){
    $('#tahunikrar').prop('disabled', false);
  });
  $('#ikrarradio12').click(function(){
    $('#tahunikrar').prop('disabled', true);
  });
  

  $('#radioPrimary22112').click(function(){
    $('#ikrarradio').prop('disabled', false);
    $('#ikrarradio12').prop('disabled', false);
    $('#tahunikrar').prop('disabled', false);
    $('#status_vihara').prop('disabled', false);
    $('#status_vihara12').prop('disabled', false);
    $('#DaoQin').prop('disabled', false);
    $('#FoYuan').prop('disabled', false);
    $('#TanZhu').prop('disabled', false);
  });

  //islam
  $('#radioPrimary2a').click(function(){
    $('#ikrarradio').prop('disabled', true);
    $('#ikrarradio12').prop('disabled', true);
    $('#tahunikrar').prop('disabled', true);
    $('#status_vihara').prop('disabled', true);
    $('#status_vihara12').prop('disabled', true);
    $('#DaoQin').prop('disabled', true);
    $('#FoYuan').prop('disabled', true);
    $('#TanZhu').prop('disabled', true);


    $('#ikrarradio').prop('checked', false); 
    $('#ikrarradio12').prop('checked', false);
    $('#status_vihara').prop('checked', false); 
    $('#status_vihara12').prop('checked', false); 
    $('#DaoQin').prop('checked', false); 
    $('#FoYuan').prop('checked', false); 
    $('#TanZhu').prop('checked', false); 

  });


  //kristen
  $('#radioPrimary2b').click(function(){
    $('#ikrarradio').prop('disabled', true);
    $('#ikrarradio12').prop('disabled', true);
    $('#tahunikrar').prop('disabled', true);
    $('#status_vihara').prop('disabled', true);
    $('#status_vihara12').prop('disabled', true);
    $('#DaoQin').prop('disabled', true);
    $('#FoYuan').prop('disabled', true);
    $('#TanZhu').prop('disabled', true);

    $('#ikrarradio').prop('checked', false); 
    $('#ikrarradio12').prop('checked', false); 
    $('#status_vihara').prop('checked', false); 
    $('#status_vihara12').prop('checked', false); 
    $('#DaoQin').prop('checked', false); 
    $('#FoYuan').prop('checked', false); 
    $('#TanZhu').prop('checked', false);

  });

  //katolik
  $('#radioPrimary2c').click(function(){
    $('#ikrarradio').prop('disabled', true);
    $('#ikrarradio12').prop('disabled', true);
    $('#tahunikrar').prop('disabled', true);
    $('#status_vihara').prop('disabled', true);
    $('#status_vihara12').prop('disabled', true);
    $('#DaoQin').prop('disabled', true);
    $('#FoYuan').prop('disabled', true);
    $('#TanZhu').prop('disabled', true);

    $('#ikrarradio').prop('checked', false); 
    $('#ikrarradio12').prop('checked', false); 
    $('#status_vihara').prop('checked', false); 
    $('#status_vihara12').prop('checked', false); 
    $('#DaoQin').prop('checked', false); 
    $('#FoYuan').prop('checked', false); 
    $('#TanZhu').prop('checked', false);
  });

  //hindu
  $('#radioPrimary2d').click(function(){
    $('#ikrarradio').prop('disabled', true);
    $('#ikrarradio12').prop('disabled', true);
    $('#tahunikrar').prop('disabled', true);
    $('#status_vihara').prop('disabled', true);
    $('#status_vihara12').prop('disabled', true);
    $('#DaoQin').prop('disabled', true);
    $('#FoYuan').prop('disabled', true);
    $('#TanZhu').prop('disabled', true);

    $('#ikrarradio').prop('checked', false); 
    $('#ikrarradio12').prop('checked', false); 
    $('#status_vihara').prop('checked', false); 
    $('#status_vihara12').prop('checked', false); 
    $('#DaoQin').prop('checked', false); 
    $('#FoYuan').prop('checked', false); 
    $('#TanZhu').prop('checked', false);
  });


  //budha
  $('#radioPrimary2e').click(function(){
    $('#ikrarradio').prop('disabled', true);
    $('#ikrarradio12').prop('disabled', true);
    $('#tahunikrar').prop('disabled', true);
    $('#status_vihara').prop('disabled', true);
    $('#status_vihara12').prop('disabled', true);
    $('#DaoQin').prop('disabled', true);
    $('#FoYuan').prop('disabled', true);
    $('#TanZhu').prop('disabled', true);

    $('#ikrarradio').prop('checked', false); 
    $('#ikrarradio12').prop('checked', false); 
    $('#status_vihara').prop('checked', false); 
    $('#status_vihara12').prop('checked', false); 
    $('#DaoQin').prop('checked', false); 
    $('#FoYuan').prop('checked', false); 
    $('#TanZhu').prop('checked', false);
  });

  //konghucu
  $('#radioPrimary2f').click(function(){
    $('#ikrarradio').prop('disabled', true);
    $('#ikrarradio12').prop('disabled', true);
    $('#tahunikrar').prop('disabled', true);
    $('#status_vihara').prop('disabled', true);
    $('#status_vihara12').prop('disabled', true);
    $('#DaoQin').prop('disabled', true);
    $('#FoYuan').prop('disabled', true);
    $('#TanZhu').prop('disabled', true);

    $('#ikrarradio').prop('checked', false); 
    $('#ikrarradio12').prop('checked', false); 
    $('#status_vihara').prop('checked', false); 
    $('#status_vihara12').prop('checked', false); 
    $('#DaoQin').prop('checked', false); 
    $('#FoYuan').prop('checked', false); 
    $('#TanZhu').prop('checked', false);
  });
  
  $('[data-mask]').inputmask()


  $('#datadiri_edit').modal('show');


  var nama_lengkap = $(this).attr('data_namalengkap');
  var mandarin = $(this).attr('data_mandarin');
  var nomor_ktp = $(this).attr('nomor_ktp');
  var durasi_ktp = $(this).attr('durasi_ktp');
  var nomor_npwp = $(this).attr('nomor_npwp');
  var provinsi_lahir = $(this).attr('provinsi_lahir');
  var kota_lahir = $(this).attr('kota_lahir');
  var tanggal_lahir = $(this).attr('tanggal_lahir');
  var nomor_telepon = $(this).attr('nomor_telepon');
  var nomor_telepon_2 = $(this).attr('nomor_telepon_2');
  var nomor_wa = $(this).attr('nomor_wa');
  



  $("#nama_lengkap").val(nama_lengkap);
  $("#nama_mandarin").val(mandarin);
  $("#nomor_ktp").val(nomor_ktp);
  $('#berlaku_sd option[value="' + durasi_ktp + '"]').attr('selected','selected');
  $("#nomor_npwp").val(nomor_npwp);
  $("div.cekperubahan select").val(provinsi_lahir);
  $('.selectedit').select2({
      theme: 'bootstrap4'
    });
  $("#tanggal_lahir").val(tanggal_lahir);
  $("#nomor_telepon").val(nomor_telepon);
  $("#nomor_telepon_2").val(nomor_telepon_2);
  $("#nomor_wa").val(nomor_wa);

 });

 $(document).on('submit', '#UpdateDataDiri', function(e) {  
      e.preventDefault();
      var route = $('#UpdateDataDiri').data('route');
      var form_data = $(this);
      var wrapper = $("#overlay");
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        $.ajax({

          type: 'PUT',
          url: route,
          data: form_data.serialize(),

          beforeSend: function(){

            $(wrapper).append(  '<div class="overlay d-flex justify-content-center align-items-center">'+
                                      '<i class="fas fa-2x fa-sync fa-spin"></i>'+
                                      'Sedang Memproses Data'+
                                  '</div>');

          },
          success: function(Response){

             $.blockUI({ css: { 
                border: 'none', 
                padding: '5px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '5px', 
                '-moz-border-radius': '5px', 
                opacity: .5, 
                color: '#fff' 
            } }); 
            swal("Berhasil!", "Berhasil Memproses Data!", "success");
            
           
            },
          complete: function() {
                $('.overlay').remove();
                $('#UpdateDataDiri').modal('hide');
                $.unblockUI();
                setTimeout(location.reload.bind(location), 2000);

                },
          error: function(xhr) { // if error occured
                    swal("Upsss!", "Terjadi Kesalahan", "error");
                },

      })
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


function format ( d ) {

    return '<div class="slider">'+  
                '<table id="#" class="table table-bordered table-sm">'+
                     '<thead style="background-color: #08203c; color: white">'+
                      '<tr>'+
                        '<th style="width: 200px;">Gologan Darah</th>'+
                        '<th style="width: 200px;">Nomor Telepon</th>'+
                        '<th style="width: 500px;">Nomor Telepon 2</th>'+
                        '<th style="width: 500px;">Status Tempat Tinggal</th>'+
                        '</tr>'+
                      '</thead>'+
                      '<tbody>'+
                            '<tr>'+
                                '<td>'+d.golongan_darah+'</td>'+
                                '<td>'+d.nomor_telepon+'</td>'+
                                '<td>'+d.nomor_telepon_2+'</td>'+
                                '<td>'+d.status_tempat_tinggal+'</td>'+
                            '</tr>'+
                      '</tbody>'+
                '</table>'+
              '</div>'
  
  }


 var dt =  $('#cek_penilaian').DataTable({
        processing: true,
        serverSide: true,
        //scrollY : false,
        ajax: '{!! route('GetDataPkAdmin',['id_user' => $id_user]) !!}',
        order: [ [1, 'DESC'] ], 
        searching: false,
        lengthChange: false,
        
        columns: [
            {
                "class":          "details-control",
                "orderable":      false,
                //"data" : 'id',
                "defaultContent": "",
            }, 
         
            { data: 'nomor_ktp', name: 'nomor_ktp' },
            { data: 'durasi_ktp', name: 'durasi_ktp' },
            { data: 'nomor_npwp', name: 'nomor_npwp' },
            { data: 'tanggal_lahir', name: 'tanggal_lahir' },
            { data: 'status_marital', name: 'status_marital' },
            { data: 'action', name: 'action' },
          
        ],



    });


    var detailRows = [];
   
        // Add event listener for opening and closing details
      $('#cek_penilaian tbody').on('click', 'td.details-control', function () {
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
       // On each draw, loop over the `detailRows` array and show any child rows
      dt.on( 'draw', function () {
          $.each( detailRows, function ( i, id ) {
              $('#'+id+' td.details-control').trigger( 'click' );
          } );
      } );

    $('#provinsi').on('change', function(){
      var wrapper = $("#overlay");
      $.post('{{ URL::to('/kabupatenkota') }}', {
          type: 'kabupaten', 
          _token: "{{ csrf_token() }}",
          id: $('#provinsi').val(),

          beforeSend: function() {

              $(wrapper).append(  '<div class="overlay d-flex justify-content-center align-items-center">'+
                                      '<i class="fas fa-2x fa-sync fa-spin"></i>'+
                                      'Sedang Memproses Data'+
                                  '</div>');

          },
          success: function(msg) {
             
          },
      
        }, 
        function(e){
          $('#kabupatenkota').html(e);
           $('.overlay').remove();
      });
  });



});

</script>

<script type="text/javascript">
  jQuery( document ).ready(function($){
    $('.select').select2({
      theme: 'bootstrap4'
    });

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
.select2-selection{background-color: #ffffff !important; color: black;}
</style>

@include('sweet::alert')
@endsection
