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
        @if ($message = Session::get('errorext'))
           <div class="uk-alert uk-alert-error" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
             
              <div class="alert alert-error alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $message }}</strong>
              </div>
              
          </div>
        @endif
          <div class="card-body bg-dark p-2">
            <h3 class="card-title" style="font-size: 25px;">Penilaian Kerja | </h3><font size="2">&nbsp; Universitas Universal</font>
            <select class="form-control col-2" name="versi" id="listVersi" style="float: right;">
              @php
              $versi = DB::table('b_versi_soal')->select('id','tahun')->get();
              @endphp
              <option value="no" selected>Pilih Tahun</option>
              @foreach($versi as $Vversi)
              <option value="{{ $Vversi->id }}" >{{ $Vversi->tahun }}</option>
              @endforeach
            </select>
            <br><br><hr style="margin-top:5px; margin-bottom:5px;">
            &nbsp; <b>Tahun</b> <font id="tahun" style="font-size: 30px; font-weight: bold;">{{ $tahun}}</font>
              <div class="table-responsive">
                <table id="cek_penilaian" class="table table-striped table-bordered table-dark table-hover display tabel_peni">
                  <thead>
                  <tr>
                    <th nowrap="">Nama Pegawai</th> 
                    <th nowrap="" class="ButFPK">Form Penilaian Kinerja</th> 
                    <th nowrap="">Aksi Lainnya</th> 
                    <th nowrap="" class="ButFPK">Status</th> 
                    <th nowrap="" class="ButFPK">Hasil</th>
                    </tr>
                  </thead>
                </table>
                <br><br><br><br>
                
                <a href="{{ Route('DownloadPetunjukTeknis') }}" class="btn btn-xs btn-outline-info" title="Download, Detail Tentang Penilaian Kerja Tenaga Kependidikan"><span class="fa fa-download"></span> Detail </a> 

                <br><br>
              </div>

        </div>
        <!-- /.card -->
</div>
</div>

{{-- MODAL UNTUK MENGUBAH STATUS SELESAI DALAM MENGISI FORM2 --}}
<div id="status_selesai" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
       <div id="overlay">
    
        </div> 
        <form data-route="{{ Route('PostStatus') }}" id="StatusSelesai" role="form"  method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
       
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;">
            <input type="hidden" name="status" value="ubah">
            <input type="hidden" name="versi" value="{{ $id_versi }}">
            <font style="text-align:center; font-weight:bold; font-size:30px;">Apakah Anda Yakin Untuk Melanjutkannya ?</font>
                 
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Saya Telah Selesai !</button>
      </div>
      </form>
      
    </div>
  </div>
</div>

{{-- MODAL UNTUK MENAMPILKAN BUTTON VERIFIKASI DAN LAINNYA DI PENILAIAN KERJA --}}
<div id="DetailDanLainnya" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark">
        <div class="modal-body" id="RenderKontenDetail">
            <div class="table-responsive">
              <table id="DetailDanLainnyaTable" class="table table-striped table-bordered table-dark table-hover display" width="100%">
                 <thead>
                  <tr>
                    <th nowrap="">Verifikasi</th>
                    <th nowrap="" class="BtnLain">Tugas Lain</th>
                    <th nowrap="" class="BtnLain">Nilai Atasan</th> 
                  </tr>   
                  </thead>
                </table> 
            </div>   
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      
    </div>
  </div>
</div>


{{-- MODAL UNTUK UPLOAD PELAKSANAAN TUGAS LAIN --}}
<div id="TugasLainModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog ">
    <div class="modal-content">
        <div id="overlay">
    
        </div> 
        <div class="modal-header bg-info">
          <h3 class="modal-title">Upload Pelaksanaan Tugas Lain</h3>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
        <form action="{{ Route('UploadTugasLain') }}" id="UploadTugasLain" role="form"  method="POST" accept-charset="utf-8" enctype="multipart/form-data">
        {{ csrf_field() }}
       
            <div class="modal-body mx-auto">
                <div class="card card-body shadow p-3 bg-white rounded" style="text-align: justify;">
                    Pelaksanaan tugas lain yaitu: membuat SOP pekerjaan dan/atau deskripsi pekerjaan dengan
                    merincikan dari bulan Januari sd. Desember dan/atau ringkasan pekerjaan (job summary)
                    dan/atau project management timeline dengan penjelasan secara lengkap. 
                </div>
                <div class="card card-body shadow p-3 bg-white rounded">

                    <label>File</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-file"></i></span>
                      </div>
                      <input type="file" id="TugasLainValidasi" class="form-control" name="TugasLain" accept=".pdf, .doc, .docx, .xls, .xlsx, .zip" required>
                    </div>
                    <code>.pdf, .doc, .docx, .xls, .xlsx, .zip</code>
                    <font style="font-weight: bold; font-size: 10px" >*ZIP/Archive jika lebih dari 1 file</font>

                    <hr>
                    <label>Keterangan Jika Ada</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-font"></i></span>
                      </div>
                      <textarea type="text" name="Keterangan" class="form-control" placeholder="Masukan Keterangan"></textarea>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload File !</button>
            </div>
      </form>
      
    </div>
  </div>
</div>



@endsection
@section('script')
<script type="text/javascript">

$.noConflict();
jQuery( document ).ready(function( $ ) {



$(document).on('click', '.ajukan', function(){
  $('#status_selesai').modal('show');
});

$(document).on('submit', '#StatusSelesai', function(e) {  
  e.preventDefault();
  var route = $('#StatusSelesai').data('route');
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
        console.log(data)
         $.blockUI({ css: { 
            border: 'none', 
            padding: '5px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '5px', 
            '-moz-border-radius': '5px', 
            opacity: .5, 
            color: '#fff' 
        } }); 

        switch(data.gg){
          case '1': /*First case */
          swal("Berhasil!", "Berhasil Memproses Data", "success");
          break;
          case '2' : /*Second... */
          swal("Gagal!", "Form Penilaian Kerja Belum Semua Diisi", "error");
          break;
          case '3' : /* You know the drill... */
          swal("Gagal!", "Data Sudah Disubmit sebelumnya", "error");
          break;
          case '4' : /* You know the drill... */
          swal("Gagal!", "Terjadi Kesalahan Dalam Menyimpan Data", "error");
          break;
          case '100' : /* You know the drill... */
          swal("Gagal!", "Terjadi Kesalahan Dalam Perhitungan Verifikasi", "error");
          break;
          case '300' : /* You know the drill... */
          swal("Verifikasi Belum Siap!", "Harap Verifikasi Form Secara Keseluruhan", "error");
          break;
          case 'kly' : /* You know the drill... */
          swal("Gagal!", "Terjadi Kesalahan #kn345", "error");
          break;
          case 'PTLKosong' : /* You know the drill... */
          swal("Gagal!", "Pelaksanaan Tugas Lain Belum Diupload", "error");
          break;
          case 'NilaiAtasan0' : /* You know the drill... */
          swal("Gagal!", "Anda Belum Melakukan Penilaian Kepada Atasan, Harap Lakukan Penilaian Terlebih Dahulu", "error");
          break;
          default:
          break;
          /* If none of the above */
          }
        },
      complete: function() {
            $('.overlay').remove();
            $('#status_selesai').modal('hide');
            $.unblockUI();
            $('#cek_penilaian').DataTable().ajax.reload();

            },
      error: function(xhr, status, error) {
        alert(xhr.responseText);
        setTimeout(function () { location.reload(1); }, 500);
      }

  })
});


//MODAL UNTUK UPLOAD TUGAS LAIN
$(document).on('click', '.UploadTugasLain', function () {
     $('#TugasLainModal').modal('show');
});

//HAPUS FILE / DATA PELAKSANAAN TUGAS LAIN
$(document).on('click', '.HapusFilePTL', function () {
     
    var id = $(this).data("id");
    if (id == 'no') {
        alert('terjadi kesalahan');
    }else{
    var result = confirm("Apakah anda yakin menghapus file ini?");
        if (result) {
            Pace.track(function(){
                Pace.restart();
                $.post('{{ Route('HapusPTL') }}', {
                    _token: "{{ csrf_token() }}",
                    data_id: id,
                    }).done(function (data, response) { 
                         switch(data.Hasil){
                          case 'berhasil':
                          swal("Berhasil!", "Berhasil Menghapus File", "success");
                          break;
                          case 'gagal' :
                          swal("Gagal!", "Gagal Menghapus File", "error");
                          break;
                          case 'tidakada' :
                          swal("Gagal!", "File Tidak Ditemukan", "error");
                          break;
                          default:
                          }
                        $('#DetailDanLainnyaTable').DataTable().ajax.reload();
                    });
            });
        }
    }     
});


//MODAL DETAIL LAINNYA
$(document).on('click', '.DetailLainnya', function () {
     
    var id_data_diri = $(this).data("id_data_diri");
    var id_versi = $(this).data("id_versi");

    if (id_data_diri === undefined || id_versi === undefined){
        alert('Data Tidak Ditemukan');
    }else{

        Pace.track(function(){
            Pace.restart();

             //INDEX DETAIL VERIFIKASI DAN LAINNYA
             $('#DetailDanLainnyaTable').DataTable({
                    processing: true,
                    serverSide: true,
                    searching : false,
                    lengthChange : false,
                    destroy: true,
                    paging :   false,
                    ordering : false,
                    info :     false,
                    //scrollY : false,
                    ajax: '{!! route('DetailPenilaianKerja',['id_versi' => ":idVersi"]) !!}'.replace(":idVersi", id_versi),
                    language: {
                        "infoFiltered":"",
                        "processing": '<img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 30%;">',
                    },
                    columns: [
                        { data: 'verif', name: 'verif' },
                        { data: 'tugas_lain', name: 'tugas_lain' },
                        { data: 'nilai_atasan', name: 'nilai_atasan' },
                    ],

                    createdRow: function ( row, data, index ) {
                        
                        if(data.level === '13'){
                            $(".BtnLain").css("display", "none");
                            $('td', row).eq(1).css("display", "none");
                            $('td', row).eq(2).css("display", "none");
                        }else{
                            $('td', row).eq(1).attr("nowrap","nowrap");
                            $('td', row).eq(2).attr("nowrap","nowrap");
                        }     
                        $('td', row).eq(0).attr("nowrap","nowrap");
                        $('td', row).eq(3).attr("nowrap","nowrap");
                        $('td', row).eq(1).css("text-align", "center");
                    },
                });

            $('#DetailDanLainnya').modal('show');

        
        });
        
    }     
});



//VALIDASI TIPE FILE UPLOAD TUGAS LAIN
var file = document.getElementById('TugasLainValidasi');
file.onchange = function() {
   for (var i = 0; i < file.files.length; i++) {

        var ext = file.files[i].name.substr(-3);
        var ygempat = file.files[i].name.substr(-4);
        if(ext!== "PDF" && ext!== "pdf" && ext!== "xls" && ygempat!== "xlsx" && ext!== "doc" && ygempat!== "docx" && ext!== "XLS" && ygempat!== "XLSX" && ext!== "DOC" && ygempat!== "DOCX" && ext!== "zip" && ext!== "ZIP" && ext!== "rar" && ext!== "RAR")  {
            swal( file.files.item(i).name  +  "", "Extention File Mungkin Tidak Diizinkan", "error");
            this.value = '';
        }
      
      }

      function getFile(filePath) {
          return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
      }
};

function DataPenilaian(idVersi){

    //INDEX PENILAIAN TUGAS LAIN
     var dt =  $('#cek_penilaian').DataTable({
            processing: true,
            serverSide: true,
            searching : false,
            lengthChange : false,
            destroy: true,
            paging :   false,
            ordering : false,
            info :     false,
            //scrollY : false,
            ajax: '{!! route('GetDataPen',['idVersi' => ":idVersi"]) !!}'.replace(":idVersi", idVersi),
            order: [ [1, 'DESC'] ], 
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
                { data: 'action', name: 'action' },
                { data: 'AksiLainnya', name: 'AksiLainnya' },
                { data: 'status', name: 'status' },
                { data: 'hasil_penilaian', name: 'hasil_penilaian' },
            ],

            createdRow: function ( row, data, index ) {

                if(data.level === '13'){
                    $(".ButFPK").css("display", "none");
                    $('td', row).eq(1).css("display", "none");
                    $('td', row).eq(3).css("display", "none");
                    $('td', row).eq(4).css("display", "none");
                }else{
                    $('td', row).eq(1).attr("nowrap","nowrap");
                    $('td', row).eq(3).attr("nowrap","nowrap");
                    $('td', row).eq(1).css("width", "1%");
                    $('td', row).eq(3).css("width", "1%");
                }                
                $('td', row).eq(2).css("text-align", "center");
                $('td', row).eq(0).css("text-align", "center");
                $('td', row).eq(0).css("vertical-align", "middle");
            },
        });

}
    

    //SELECTED SELECT VERSI TAHUN
    $('#listVersi option[value={{ $id_versi }}]').attr('selected','selected');

    //RENDER SAAT PERTAMA KALI LOADING DATA
    DataPenilaian('{{ $id_versi }}');

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

          });

        DataPenilaian(idVersi)
        }   

    });


    //SET GROW
    setInterval(function(){
       $(".setgrow").toggleClass("A spinner-grow spinner-grow-sm text-success");
    }, 5000);
    
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