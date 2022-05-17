@extends('admin.layout.master')

@section('content')

<hr style="margin-top: 3px; margin-bottom: 3px; opacity: 0;">
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
            <h3 class="card-title" style="vertical-align: top;">Data Penilaian Kerja | </h3>&nbsp; <font id="tahun" style="font-size: 30px; font-weight: bold;">{{ $tahun}}</font>
            <select class="form-control col-2 rounded-0" name="versi" id="listVersi" style="float: right;">
              @php
              $versi = DB::table('b_versi_soal')->select('id','tahun')->get();
              @endphp
              <option value="no" selected>Pilih Tahun</option>
              @foreach($versi as $Vversi)
              <option value="{{ $Vversi->id }}">{{ $Vversi->tahun }}</option>
              @endforeach
            </select>
            <button class="cek_list btn btn-flat" data-versiterus="{{ $id_versi }}" id="VersiTahunTerus" style="float: right; background-color: #08203c; color:white;">
              <span class="fa fa-plus"> </span> Teruskan Pegawai
            </button>
          </div>

          <div class="card-body bg-dark p-2">
            <div class="table-responsive">
            <table id="cek_penilaian" class="table table-striped table-bordered table-dark table-hover display">
              <thead>
              <tr>
                <th nowrap="">Nama Pegawai</th> 
                <th nowrap="">Data Diri</th>
                <th nowrap="">Absensi</th>
                <th nowrap="">Jawaban & Verif</th> 
                <th nowrap="">Rekapan</th> 
                <th nowrap="">Detail</th> 
                </tr>
              </thead>

              <td colspan="10" style="text-align:center; font-weight:bold;">Plih Tahun Dahulu</td>
            </table>
            <br>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</div>
</div>


<div id="list_selesai" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog ">
    <div class="modal-content">
       <div id="overlay">
    
        </div> 
        <div class="modal-header bg-info">
          <h3 class="modal-title">Setting Tujuan  | <font id="tahunterus"> {{ $tahun }} </font></h3>

          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form data-route="{{ Route('teruskanpegawai') }}" id="FormTeruskan" role="form"  method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
        
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;" id="kontenTerukan">
              
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Teruskan !</button>
      </div>
      </form>
      
    </div>
  </div>
</div>

<div class="modal fade" id="projectView" role="dialog" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modal-content">
   
          <div class="row">
            <div class="col-lg-12">
              <div class="modal-body" id="project-content">
               
              </div>
            </div>
         </div>
      </div>
  </div>
</div>

{{-- LIHAT ABSEN --}}
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
{{-- LIHAT NILAI DARI BAWAHAN --}}
<div class="modal fade" id="ViewNilaiBawahan" role="dialog" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" id="modal-content">
   
          <div class="row">
            <div class="col-lg-12">
              <div class="modal-body" id="ProjectNilai">
  
              </div>
            </div>
         </div>
      </div>
  </div>
</div>



@endsection
@section('script')
<script type="text/javascript">

$.noConflict();
jQuery( document ).ready(function( $ ) {

function Selectod(){

  var sel =   $('.select').select2({
                  theme: 'bootstrap4'
              });

  return sel;

}

//MODAL MENENTUKAN TUJUAN
$(document).on('click', '.cek_list', function(){
  var versi = $(this).attr("data-versiterus");
  var versiDefault = "{{$id_versi}}";    

  if (versi === undefined){
    alert('Harap Pilih Tahun Dahulu')
  }else{
     Pace.track(function(){
      Pace.restart();
      $.post('{{ Route('AsalDanTujuan') }}', {
          _token: "{{ csrf_token() }}",
          data : {level : {{ $level }}, versi: versi },
          }).done(function (data, response) { 

            $('#kontenTerukan').html(data.ceks);
            $('#list_selesai').modal('show');
            Selectod();
          });
    });
  }

 
});

//MODAL NILAI ATASAN(NILAI DARI BAWAHAN)
$(document).on('click', '.popnilaiatasan', function(){
  var versi = $(this).attr("data-versi");
  var tujuan = $(this).attr("data-id_tujuan");

   Pace.track(function(){
    Pace.restart();
    $.post('{{ Route('CekJawabanBawahan') }}', {
        _token: "{{ csrf_token() }}",
        data : {tujuan : tujuan, versi: versi },
        }).done(function (data, response) { 
          $('#ViewNilaiBawahan').modal('show');
          $('#ProjectNilai').html(data.ceks);

        });
    });
 
});

//UNTUK TERUSAN BAWAHAN DAN ATASAN
 $(document).on('submit', '#FormTeruskan', function(e) {  
      e.preventDefault();
      var route = $('#FormTeruskan').data('route');
      var form_data = $(this);
      var wrapper = $("#overlay");
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
          success: function(data, response){
            var Pesan = data.pesan;
            switch(data.ceks){
              case '1': 
              swal("Gagal!", data.pesan, "warning");
              break;
              case '2' :
              swal("Berhasil!", "Berhasil Meneruskan Pegawai", "success");
              break;
              case '3' : 
              swal("Gagal!", "Gagal Meneruskan Pegawai", "error");
              break;
              case '3' : 
              default:
             
              }
            },
          complete: function() {
                $('.overlay').remove();
                $('#list_selesai').modal('hide');
                $('#cek_penilaian').DataTable().ajax.reload();

                },
          error: function(xhr, status, error) {}

      })
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
     var idVersi = $(this).attr("idversi");
     $.ajax({
       url:'{!! route('getViewAbsen',['id_user' => ":id_userT", 'id_versi' => $id_versi]) !!}'.replace(":id_user", id_userT),
       method:"POST",
       data: {id_user : id_userT, id_versi: idVersi},
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

//untuk view tujuan individu
$(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
   $(document).on('click', '.TujuanIndividu', function(){
     var id_user = $(this).attr("data_iduser");
     var data_versi = $(this).attr("data-versi");

     $.ajax({
       url:"../../../tujuan/individu/"+id_user+"/"+data_versi,
       method:"POST",
       data: {id_user : id_user},
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

         $('#project-content').html(data);
         $('#projectView').modal("show");
         $.unblockUI();
       }
     });
   });
});

//RENDER SAAT PERTAMA KALI LOADING DATA
DataPenilaianAdmin('{{ $id_versi }}');

//SELECTED SELECT VERSI TAHUN
$('#listVersi option[value={{ $id_versi }}]').attr('selected','selected');

function DataPenilaianAdmin(idVersi){

  var dt =  $('#cek_penilaian').DataTable({
       processing: true,
       serverSide: true,
       //scrollY : false,
       destroy: true,
       searching : false,
       ajax: '{{route('GetDataPenAdmin',['level' => $level, 'idVersi' => ":idVersi"]) }}'.replace(":idVersi", idVersi),
       order: [ [0, 'DESC'] ], 
       language: {
          "infoFiltered":"",
          "processing": '<img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 30%;">',
        },
       columns: [
           { data: 'nama_lengkap', 
                 render: function (data, type, row) {
                 if ( row.level == 13) {
                   return ''+row.name+''
                 }else{
                   return ''+row.nama_lengkap+''
                 }
             }
           },
           { data: 'datadiri', name: 'datadiri' },
           { data: 'absensi', name: 'absensi' },
           { data: 'print_verif', name: 'print_verif' },
           { data: 'rekap', name: 'rekap' },
           { data: 'status',
             render: function ( data, type, row ) {
                 return row.status + ' - ' + row.kelompok + '';
             }
           },
       ],

     createdRow: function ( row, data, index ) {
          $('td', row).eq(0).css("text-align", "center");
          $('td', row).eq(3).attr("nowrap","nowrap");
          $('td', row).eq(3).css("text-align", "center");
          $('td', row).eq(1).css("text-align", "center");
          $('td', row).eq(2).attr("nowrap","nowrap");
          $('td', row).eq(2).css("text-align", "center");
          $('td', row).eq(2).css("vertical-align", "middle");
          $('td', row).eq(5).attr("nowrap","nowrap");
          $('td', row).eq(5).css("text-align", "center");
          $('td', row).eq(5).css("vertical-align", "middle");
          $('td', row).eq(4).css("text-align", "center");
      },

   });
    
}

$('#listVersi').change(function() {
    if($(this).val() === 'no'){
      alert('Silahkan Pilih Tahun');
    }else{

          var idVersi = $(this).val();

          $.post('{{ Route('TahunVersiDLL') }}', {
            _token: "{{ csrf_token() }}",
            data_id:idVersi,
           
          }).done(function (data, response) {

            $("#tahun").html(data.ceks);
            $("#tahunterus").html(data.ceks);
            //MENGGANTI VALUE DARI ID VERSI TOMBOL TERUSKAN SAAT TERJADI PERUBAHAN PEMILIHAN TAHUN
            $('#VersiTahunTerus').attr('data-versiterus', idVersi);

          });
          DataPenilaianAdmin(idVersi)
      }
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
</style>

@include('sweet::alert')
@endsection