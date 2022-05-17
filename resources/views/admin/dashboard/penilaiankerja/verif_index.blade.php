@extends('admin.layout.master')

@section('content')

<!--Plugin CSS file with desired skin-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>


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
    <div class="row">
      <div class="col-12">

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


        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Verifikasi Form Penilaian Kerja</h3>
          </div>

          <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped table-bordered display">
              <thead>
                <tr>
                  <th nowrap="">Nama Lengkap</th> 
                  <th nowrap="">Verifikasi Form</th> 
                  <th nowrap="">Pelaksanaan Tugas Lain</th> 
                  <th nowrap="">Pesan</th> 
                  <th nowrap="">Absen dan Rekap</th> 
                </tr>
              </thead>
              <tbody>

                @forelse($cekkelompok as $key => $showCekKelompok)
               

                <tr>
                  <td style="text-align: center; vertical-align:middle;">{{ $showCekKelompok->nama_lengkap }}</td>
                  <td style="text-align: center; width: 45%; vertical-align:middle;">

                    @if(cek_verif($showCekKelompok->id_user, 'a', $id_versi) == '1')
                    <a href="{{ Route('VerifPenilaianForm',
                    [
                      'type'=> 'a', 
                      'versi'=> $id_versi, 
                      'id_user'=> Crypt::encryptString($showCekKelompok->id_user),
                      'id_u_tujuan' => Crypt::encryptString($showCekKelompok->id_user_tujuan)
                    ]) }}" 
                    title="Form Penilaian Kerja A">
                          <button type="button" class="btn btn-outline-primary btn-sm">
                          <span class="fa fa-list"> </span> Verif Form A</button>
                    </a> | 

                    @elseif(cek_verif($showCekKelompok->id_user, 'a',$id_versi) == '3')
                    
                    <a href="#" 
                    title="Mungkin Masih Proses Pengerjaan"  onClick="alert('Mungkin Masih Proses Pengerjaan')">
                          <button type="button" class="btn btn-warning btn-sm">
                          <span class="fa fa-spinner"> </span> Verif Form A</button>
                    </a> | 

                    @else 
                    <a href="#" 
                    title="Form Penilaian Kerja A Sudah Selesai Diverifikasi">
                          <button type="button" class="btn btn-success btn-sm">
                          <span class="fa fa-check-circle"> </span> Verif Form A</button>
                    </a> | 
                    @endif
                    




                    @if($showCekKelompok->level == '4' || $showCekKelompok->level == '3' || $showCekKelompok->level == '1')
                    <a href="#" title="Form Penilaian Kerja B">
                          <button type="button" class="btn btn-warning btn-sm" onClick="alert('User Ini Tidak Memiliki Penilaian Form B!')">
                          <span class="fa fa-exclamation-circle"> </span> Verif Form B</button>
                    </a> | 
                    @else
                    @if(cek_verif($showCekKelompok->id_user, 'b',$id_versi) == '1')
                    <a href="{{ Route('VerifPenilaianForm',
                    [
                      'type'=> 'b', 
                      'versi'=> $id_versi, 
                      'id_user'=> Crypt::encryptString($showCekKelompok->id_user),
                      'id_u_tujuan' => Crypt::encryptString($showCekKelompok->id_user_tujuan)
                    ]) }}

                    " title="Form Penilaian Kerja B">
                          <button type="button" class="btn btn-outline-primary btn-sm">
                          <span class="fa fa-list"> </span> Verif Form B</button>
                    </a> | 
                    @elseif(cek_verif($showCekKelompok->id_user, 'b',$id_versi) == '3')
                    
                    <a href="#" 
                    title="Mungkin Masih Proses Pengerjaan" onClick="alert('Mungkin Masih Proses Pengerjaan')">
                          <button type="button" class="btn btn-warning btn-sm">
                          <span class="fa fa-spinner"> </span> Verif Form B</button>
                    </a> | 

                    @else 
                    <a href="#" 
                    title="Form Penilaian Kerja B Sudah Selesai Diverifikasi">
                          <button type="button" class="btn btn-success btn-sm">
                          <span class="fa fa-check-circle"> </span> Verif Form B</button>
                    </a> | 
                    @endif
                    @endif



                    @if(cek_verif($showCekKelompok->id_user, 'c',$id_versi) == '1')
                    <a href="{{ Route('VerifPenilaianForm',
                    [
                      'type'=> 'c', 
                      'versi'=> $id_versi, 
                      'id_user'=> Crypt::encryptString($showCekKelompok->id_user),
                      'id_u_tujuan' => Crypt::encryptString($showCekKelompok->id_user_tujuan)
                    ]) }}" title="Form Penilaian Kerja C">
                          <button type="button" class="btn btn-outline-primary btn-sm">
                          <span class="fa fa-list"> </span> Verif Form C</button>
                    </a> | 
                    @elseif(cek_verif($showCekKelompok->id_user, 'c',$id_versi) == '3')
                    
                    <a href="#" 
                    title="Mungkin Masih Proses Pengerjaan" onClick="alert('Mungkin Masih Proses Pengerjaan')">
                          <button type="button" class="btn btn-warning btn-sm">
                          <span class="fa fa-spinner"> </span> Verif Form C</button>
                    </a> | 

                    @else 
                    <a href="#" 
                    title="Form Penilaian Kerja C Sudah Selesai Diverifikasi">
                          <button type="button" class="btn btn-success btn-sm">
                          <span class="fa fa-check-circle"> </span> Verif Form C</button>
                    </a> | 
                    @endif




                    @if(cek_verif($showCekKelompok->id_user, 'd',$id_versi) == '1')
                    <a href="{{ Route('VerifPenilaianForm',
                    [
                      'type'=> 'd', 
                      'versi'=> $id_versi, 
                      'id_user'=> Crypt::encryptString($showCekKelompok->id_user),
                      'id_u_tujuan' =>Crypt::encryptString( $showCekKelompok->id_user_tujuan)
                    ]) }}" title="Form Penilaian Kerja D">
                          <button type="button" class="btn btn-outline-primary btn-sm">
                          <span class="fa fa-list"> </span> Verif Form D</button>
                    </a> 
                    @elseif(cek_verif($showCekKelompok->id_user, 'd',$id_versi) == '3')
                    
                    <a href="#" 
                    title="Mungkin Masih Proses Pengerjaan" onClick="alert('Mungkin Masih Proses Pengerjaan')">
                          <button type="button" class="btn btn-warning btn-sm">
                          <span class="fa fa-spinner"> </span> Verif Form D</button>
                    </a> | 

                    @else 
                    <a href="#" title="Form Penilaian Kerja D Sudah Selesai Diverifikasi">
                          <button type="button" class="btn btn-success btn-sm">
                          <span class="fa fa-check-circle"> </span> Verif Form D</button>
                    </a> 
                    @endif
                  

                  </td>

                  <td nowrap="" style="text-align: center;">

                  @if( $showCekKelompok->level == '11' || $showCekKelompok->level == '12' || $showCekKelompok->level == '13' )
                   <hr style="width:10%; border:2px solid grey;">
                  @else  
                    @php
                      $CekId = DB::table('b_pelaksanaan_tugas_lain')->select('id')->where([['id_user','=',$showCekKelompok->id_user],['id_versi','=',$id_versi]])->first();

                      if ($CekId) {  $idPTL = $CekId->id; }else{ $idPTL = 'no';}
                    @endphp

                    <div class="row mx-auto">

                    @if($CekId)
                    <a href="{{Route('DownloadPTL',['id' => $idPTL]) }}"><button type="button" class="btn btn-outline-info btn-sm" title="Download File Pelaksanaan Tugas Lain"><span class="fa fa-file-download"> </span></button> </a>
                    @else
                    -
                    @endif

                    @php
                      $CekNilai = DB::table('b_pelaksanaan_tugas_lain')->select('id','nilai')->where([['id_user','=',$showCekKelompok->id_user],['id_versi','=',$id_versi]])->first();

                    @endphp

                    &nbsp; | &nbsp; 

                   
                    @if($CekNilai)
                      @if(!is_null($CekNilai->nilai))

                      <form data-route="{{ Route('TampilNilaiPTL') }}"  data-routeback="#" id="FormBeriNilai" role="form" method="POST"  accept-charset="utf-8">
                        @csrf
                        <input type="hidden" value="{{ $showCekKelompok->id_tujuan }}" name="id_tujuan" required="">
                        <input type="hidden" value="{{ $id_versi }}" name="versi" required="">
                        <button type="submit" class="btn btn-success btn-sm btn-flat"title="Ubah Nilai Pelaksanaan Tugas Lain"><span class="fa fa-pencil-alt"> </span> Ubah Nilai</button>
                        <button type="button" class="btn btn-success btn-sm btn-flat" data-toggle="tooltip" data-placement="top" title="Nilai yang diberikan saat ini" ><b>{{ $CekNilai->nilai }}</b></button>
                      </form>

                      
                      @else

                        <form data-route="{{ Route('TampilNilaiPTL') }}"  data-routeback="#" id="FormBeriNilai" role="form" method="POST"  accept-charset="utf-8">
                          @csrf
                          <input type="hidden" value="{{ $showCekKelompok->id_tujuan }}"name="id_tujuan" required="">
                          <input type="hidden" value="{{ $id_versi }}"name="versi" required="">
                          <button type="submit" class="btn btn-outline-info btn-sm" title="Beri Nilai Untuk Pelaksanaan Tugas Lain"><span class="fa fa-sort-numeric-up-alt"> </span> Beri Nilai </button>
                        </form>

                        
                      @endif
                    @else
                      Belum Upload 
                    @endif

                   </div>
                  @endif
                  </td>

                  <td style="text-align: center; vertical-align:middle;">
                    @if(CekPesan($showCekKelompok->id_user_tujuan, $showCekKelompok->id_user) == 0)
                    <a href="#" title="Tinggalkan Pesan">
                          <button type="button" class="tinggalkanpesan btn btn-info btn-sm" 
                          data_iddari="{{ $showCekKelompok->id_user_tujuan }}" 
                          data_iduntuk="{{ $showCekKelompok->id_user }}" 
                          data_name="{{ $showCekKelompok->nama_lengkap }}" >
                          <span class="fa fa-envelope"> </span> </button>
                    </a> 
                    @else
                    <a href="#" title="Tinggalkan Pesan" onClick="alert('Anda Sudah Meninggalkan Pesan Untuk User Ini')">
                          <button type="button" class="btn btn-success btn-sm">
                          <span class="fa fa-check-circle"> </span> </button>
                    </a> 
                    @endif
                    
                  </td>
                  
                  <td style="text-align: center; vertical-align:middle;">
                   <a href="#" title="ABSENSI KEHADIRAN & PELAKSANAAN TUGAS LAIN"><button type="button" class="btn btn-outline-info btn-sm AbsenView" data_iduserAbsen="{{ $showCekKelompok->id_user }}"> <span class="fa fa-eye"> </span> </button></a>
         
                    <a href="{{ Route('CekRekapPenilaian',

                        ['id_user_tujuan' => Crypt::encryptString($showCekKelompok->id_user_tujuan),
                        'id_user'=> Crypt::encryptString($showCekKelompok->id_user),'id_versi' => $id_versi])

                         }}" title="Hasil Keseluruhan">
                          <button type="button" class="btn btn-outline-info btn-sm">
                          <span class="fa fa-list"> </span> Hasil</button>
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

           #note: <code> Pesan tidak bersifat wajib</code><br><hr>
           <a href="{{ Route('IndexPenilaianKerjaCek') }}" ><button type="button" class="btn btn-danger btn-sm"><span class="fa fa-arrow-left"></span> Back</button></a>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</div>
</div>



{{-- PENILAIAN TUGAS LAIN / BERI NILAI --}}

<div id="BeriNilai" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div id="overlayPTL">
    
        </div> 

        <form data-route="{{ Route('SimpanNilaiPTL') }}"  data-routeback="#" id="myFormPTL" role="form" method="POST"  accept-charset="utf-8">
          @csrf
          <div class="modal-body" id="TampilNilai">
          
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="submitPTL"></button>
          </div>
        </form>
      
    </div>
  </div>
</div>



<!----------------------------------------------PESAN------------------------------------------------>

<div id="pesan" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
       <div id="overlayiden">
    
        </div> 
      <div class="modal-header bg-info">
        <h3 class="modal-title">Tinggalkan Pesan Untuk</h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form data-route="{{ Route('pesanMotivasi') }}"  data-routeback="#" id="myForm" role="form" method="POST"  accept-charset="utf-8">
        @csrf
       
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;">
              <input type="hidden" name="dari" id="data_iddari">
              <input type="hidden" name="untuk" id="data_iduntuk">
              <div class="form-group col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <label for="pesan">Untuk :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                          </div>
                          <input type="text" name="data_name" class="form-control" id="data_name" readonly="">
                          <input type="hidden" name="data_versi" class="form-control" value="{{ $id_versi }}" readonly="">
                        </div>
                     </div>
                </div>
              </div>

              <div class="form-group col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <label for="pesan">Tinggalkan Pesan :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                          </div>
                          <textarea class="form-control" name="isi_pesan" placeholder="Tinggalkan Pesan Motivasi Disini" required></textarea>
                        </div>
                     </div>
                </div>
              </div>
               
                 
            </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tinggalkan Pesan</button>
      </div>
      </form>
      
    </div>
  </div>
</div>


<div class="modal fade" id="ViewAbsen" role="dialog" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content" id="modal-content">
   
          <div class="row">
            <div class="col-lg-12">
              <div class="modal-body" id="ProjectAbsen">
                
              </div>
            </div>
         </div>
      </div>
  </div>
</div>

<!----------------------------------------------TAMBAH JABATAN ------------------------------------------------>

@php
function cek_verif($id_user, $kategori_soal, $id_versi){

  $tescek = DB::table('b_jawaban')
  ->join('b_soal','b_soal.id_soal','=','b_jawaban.id_soal')
  ->join('b_verif_jawaban','b_jawaban.id_jawaban','=','b_verif_jawaban.id_jawaban_fk')
  ->select('b_jawaban.*','b_soal.kategori_soal')
  ->where([['b_jawaban.id_user','=',$id_user],['b_soal.kategori_soal','=', $kategori_soal],['b_verif_jawaban.id_user_verif','=',Auth::user()->id],['b_soal.id_versi_fk','=',$id_versi]])
  ->get();

  if (empty($tescek)) {
    return '3';
  }

  if ($tescek->isEmpty()) {
    return '1';
  }else{
    return '2';
  }
}

function CekPesan($dari, $untuk){

  $cek = DB::table('b_pesan')->select('pesan_dari','pesan_untuk')
      ->where([['pesan_dari','=',$dari],['pesan_untuk','=', $untuk]])
      ->count();

  return $cek;
}

@endphp

@endsection
@section('script')

<!--Plugin JavaScript file-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script type="text/javascript">

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).on('click', '.BeriNilai', function(){
  
  var id_tujuan = $('.BeriNilai').attr('dataid');
  var idVersi = $('.BeriNilai').attr('idVersi');

    Pace.track(function(){
    Pace.restart();
      $.post('{{ Route('TampilNilaiPTL') }}', {
        _token: "{{ csrf_token() }}",
        data : { "id_tujuan": id_tujuan, "id_versi": idVersi}
       
      }).done(function (data, response) {
        $("#TampilNilai").html(data.ceks);
        $('#data_value_id_tujuan').val(id_tujuan);
        $("#demo_0").ionRangeSlider({
          min: 1,
          max: 4,
          from: data.SetNilai,
          skin: "round",
          max_postfix: "+",
          prefix: 'Nilai : ',
        });
        $('#submitPTL').html(data.TextButton);
        $('#BeriNilai').modal('show');
      });
    });

});

$(document).on('submit', '#FormBeriNilai', function(e) {  
 
  e.preventDefault();
  var route = $('#FormBeriNilai').data('route');
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

      beforeSend: function(){
        Pace.restart();
       
      },
      success: function(data, Response){
          $("#TampilNilai").html(data.ceks);
          $('#data_value_id_tujuan').val(data.id_tujuuan);
          $("#demo_0").ionRangeSlider({
            min: 1,
            max: 4,
            from: data.SetNilai,
            skin: "round",
            max_postfix: "+",
            prefix: 'Nilai : ',
          });
          $('#submitPTL').html(data.TextButton);
          $('#BeriNilai').modal('show');
        },
      complete: function() {
            },
      error: function(xhr) { // if error occured
                swal("Upsss!", "Terjadi Kesalahan", "error");
            },

    });
  });
});




//PROSES UNTUK MENYIMPAN / MENGUPDATE NILAIPELAKSANAAN TUGAS LAIN
$(document).on('submit', '#myFormPTL', function(e) {  
  e.preventDefault();
  var route = $('#myFormPTL').data('route');
  var form_data = $(this);
  var wrapper = $("#overlayPTL");
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

      beforeSend: function(){
        Pace.restart();
        $(wrapper).append(  '<div class="overlay d-flex justify-content-center align-items-center">'+
                                  '<i class="fas fa-2x fa-sync fa-spin"></i>'+
                                  'Sedang Memproses Data'+
                              '</div>');
      },
      success: function(data, Response){
         switch(data.nhg){
            case '001':
            swal("Gagal!", 'Terjadi Kesalahan #kn34k', "error");
            break;
            case '002' : 
            swal("Berhasil!", "Berhasil Memproses Data", "success");
            setTimeout(location.reload.bind(location), 1000);
            break;
            case '003' : 
            swal("Warning!", "Nilai hanya boleh 1 sampai dengan 4, tidak boleh 0 ataupun lebih dari 4", "warning");
            break;
            default:
            break;
            }
        },
      complete: function() {
            $('.overlay').remove();
            },
      error: function(xhr) { // if error occured
                swal("Upsss!", "Terjadi Kesalahan", "error");
            },

    });
  });
});


//untuk view absen
$(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   $(document).on('click', '.AbsenView', function(){
     var id_userT = $(this).attr("data_iduserAbsen");

     $.ajax({
       url: '{!! route('getViewAbsen',['id_user' => ":id_userT", 'id_versi' => $id_versi]) !!}'.replace(":id_user", id_userT),
       method:"POST",
       data: {id_user : id_userT},
        beforeSend: function() {
              $.blockUI({ css: { 
                      border: 'none', 
                      padding: '5px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '5px', 
                      '-moz-border-radius': '5px', 
                      opacity: .5, 
                      color: '#fff' 
                  } }); 
            },
       success:function(data){

         $('#ProjectAbsen').html(data);
         $('#ViewAbsen').modal("show");
         $.unblockUI();
         
       }
     });
   });
});



  
  $(document).on('click', '.tinggalkanpesan', function(){


    $('#pesan').modal('show');

    var data_iddari = $(this).attr('data_iddari');
    var data_iduntuk = $(this).attr('data_iduntuk');
    var data_name = $(this).attr('data_name');
    
    $("#data_iddari").val(data_iddari);
    $("#data_iduntuk").val(data_iduntuk);
    $("#data_name").val(data_name);




    $(document).on('submit', '#myForm', function(e) {  
      e.preventDefault();
      var route = $('#myForm').data('route');
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
          success: function(data, Response){

           switch(data.ceks){
              case 'berhasil': /*First case */
              swal("Berhasil!", 'Berhasil Meninggalkan Pesan Motivasi Untuk "'+data_name+'"', "success");
              break;
              case 'gagal' : /*Second... */
              swal("Gagal!", "Form Penilaian Kerja Belum Semua Diisi", "error");
              break;
              case 'sudah ada' : /*Second... */
              swal("Gagal!", 'Anda Sudah Meninggalkan Pesan Motivasi Untuk "'+data_name+'"', "error");
              break;
              default:
              /* If none of the above */
              }
            
           
            },
          complete: function() {
                $('.overlay').remove();
                $('#myForm').modal('hide');
                $.unblockUI();
                setTimeout(location.reload.bind(location), 1000);

                },
          error: function(xhr) { // if error occured
                    swal("Upsss!", "Terjadi Kesalahan", "error");
                },

      })
    });
    

  });
</script>

@include('sweet::alert')
@endsection