<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('admin/dist/img/logo2.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Uvers</title>
    <!--script src="{{ asset('js/app.js') }}" defer></script-->
    <script>
        var laravel = @json(['baseURL' => url('/')])
    </script>
    <!-- Styles -->
    <!--link href="asset('admin/dist/css/nprogress.css') " rel="stylesheet" />
    <script src="asset('admin/dist/js/nprogress.js'"></script-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
   
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/adminlte.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/ionicons.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!--select2-->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link href="{{ asset('admin/dist/css/nprogress.css') }}" rel="stylesheet" />
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ URL::asset('admin/dist/css/font_sans_pro.css') }}" rel="stylesheet">
</head>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light static-top">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
          <img src="{{ URL::asset('admin/dist/img/logo1.png') }}" alt="" style="width: 50%">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-item nav-link" href="{{ url('/') }}">Home</a>
        </li>
       
      </ul>
    </div>
  </div>
</nav>
<br>
<div class="container-fluid">
  <div class="row">
      <div class="col-10 mx-auto">
        <div class="shadow card card-info">
           
           <div class="card-header">
            <div style="float: right;">
                  <a href="{{{ url('showtambahclient') }}}" class="btn bg-navy btn-flat margin" data-id=""><i class="fa fa-fw fa-plus"></i>Ajukan Surat Tugas</a>
            </div>
            <h3 class="card-title">Surat Tugas</h3>
          </div>
         
          <div class="card-body">
            <table id="surattugas" class="table table-striped table-bordered display">
              <thead>
              <tr>
                <th><center><span class="fa fa-eye"></span></center></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Nama Kegiatan</th>
                <th nowrap="">Tanggal Kegiatan</th>
                <th>Lokasi</th>
                <th>Status</th>
                </tr>
              </thead>
             
              <tfoot>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Nama Kegiatan</th>
                <th nowrap="">Tanggal Kegiatan</th>
                <th>Lokasi</th>
                <th>Status</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</div>

 <div id="confirmModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h3 class="modal-title">Ikuti Kegiatan</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <form id="joinkegiatan" name="join" class="form-horizontal" role="form" action="{{ url('client/tambah') }}" method="POST">
                @csrf
                  <input type="hidden" name="id_surattugas" id="id_surattugas" value=""/>

                      <div class="form-group">
                        <textarea type="text" name="" class="nama_kegiatan form-control" readonly=""></textarea>
                      </div>

                      <div class="form-group">
                            <label for="nama_pegawai">Nama Pegawai :<font color="red" size="2px">*</font></label>
                            <div class="has-error">
                                  <select class="form-control selectp" id="pegawai" name="pegawai" required="">
                                      <option value="" >------Pilih Nama Pegawai-----</option>
                                      @foreach ($list_pegawai as $item_pegawai)
                                      <option value="{{$item_pegawai->id_pegawai}}">{{$item_pegawai->nama_karyawan}}</option>                                        
                                      @endforeach

                                  </select>
                              <small class="help-block"></small>
                            </div>
                          </div>

                          <div class="form-group">
                              <label for="nipnidn">NIP/NIDN :<font color="red" size="2px">*</font></label>
                              <select id="snipnidn" name="nipnidn" class="form-control selectnipnidn" required="">
                                <option value="">Pegawai Mungkin Memiliki NIP dan NIDN</option>
                              
                              </select>
                              <font style="color: #007bff" size="2px">*Pegawai Mungkin Memiliki NIP/NIDN</font><br>
                              <span id="loadernip"><i class="fa fa-spinner fa-1x fa-spin"></i><font style="color: #007bff" size="2px">Pilih Nama Pegawai Dahulu</font></span>
                          </div>

                          <div class="form-group">
                              <label for="jabatan">Jabatan Pegawai :<font color="red" size="2px">*</font></label>
                              <select id="sjabatan" name="jabatan" class="form-control selectj" required="">
                                <option value="">Pegawai Mungkin Memiliki 1 Atau Lebih Jabatan</option>
                              
                              </select>
                              <font style="color: #007bff" size="2px">*Pegawai Mungkin Memiliki Lebih Dari 1 Jabatan</font><br>
                              <span id="loader"><i class="fa fa-spinner fa-1x fa-spin"></i><font style="color: #007bff" size="2px">Pilih Nama Pegawai Dahulu</font></span>
                          </div>

                           <div class="modal-footer">
                              <button type="submit" class="join btn btn-primary">Ikut Kegiatan Ini</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          </div>
                        
                      </form> 
                  </div>
          </div>
      </div>
  </div>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ URL::asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ URL::asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('admin/dist/js/adminlte.js') }}"></script>
<!-- PAGE SCRIPTS -->
<script src="{{ URL::asset('admin/dist/js/pages/dashboard2.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ URL::asset('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ URL::asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/nprogress.js') }}"></script>


<script>

jQuery( document ).ready(function( $ ) {
    $("#joinkegiatan").submit(function () {
        $(".join").attr("disabled", true);
        return true;
    });
});


var id_surattugas;
jQuery( document ).ready(function( $ ) {
$(document).on('click', '.tambah', function(){

  id_surattugas = $(this).attr('id');
  nama_kegiatan = $(this).attr('data-id');
  $('#confirmModal').modal('show');
  $(".modal-body #id_surattugas").val( id_surattugas );
  $(".modal-body .nama_kegiatan").val( nama_kegiatan );

 });
});

//cekstatusterimaatautidak
var _0x16d8=['<button\x20type=\x22button\x22\x20name=\x22tambah\x22\x20id=\x22','\x22\x20data-id=\x22','\x22\x20class=\x22tambah\x20btn\x20btn-success\x20btn-xs\x22><span\x20class=\x22fa\x20fa-plus\x22>\x20Join</span></button>\x20-\x20','<button\x20type=\x22button\x22\x20class=\x22btn\x20btn-danger\x20btn-xs\x22><span\x20class=\x22fa\x20fa-plus\x22>\x20Tidak\x20Bisa\x20Join</span></button>\x20-\x20','terjadi\x20Kesalahan'];(function(_0x409866,_0x5a9a63){var _0x3e8825=function(_0x480d5e){while(--_0x480d5e){_0x409866['push'](_0x409866['shift']());}};_0x3e8825(++_0x5a9a63);}(_0x16d8,0x69));var _0x5dd4=function(_0x1e1cfa,_0x5b7475){_0x1e1cfa=_0x1e1cfa-0x0;var _0x2ff98d=_0x16d8[_0x1e1cfa];return _0x2ff98d;};function cekstatus(_0x3f86ac,_0x5b28d0,_0x3b08e3){if(_0x3f86ac==0x0){return _0x5dd4('0x0')+_0x5b28d0+_0x5dd4('0x1')+_0x3b08e3+_0x5dd4('0x2');}else if(_0x3f86ac==0x1){return _0x5dd4('0x3');}else if(_0x3f86ac==0x2){return _0x5dd4('0x3');}else if(_0x3f86ac==0x3){return _0x5dd4('0x3');}else{return _0x5dd4('0x4');}}

<?php 
//decode cekstatus
/*
function cekstatus (cek , d, nama_kegiatan){

  if (cek == 0) {
    return '<button type="button" name="tambah" id="'+d+'" data-id="'+nama_kegiatan+'" class="tambah btn btn-success btn-xs"><span class="fa fa-plus"> Join</span></button> - '

  } else if(cek == 1){
    return '<button type="button" class="btn btn-danger btn-xs"><span class="fa fa-plus"> Tidak Bisa Join</span></button> - '
  } else if(cek == 2){
    return '<button type="button" class="btn btn-danger btn-xs"><span class="fa fa-plus"> Tidak Bisa Join</span></button> - '
  } else if(cek == 3){
    return '<button type="button" class="btn btn-danger btn-xs"><span class="fa fa-plus"> Tidak Bisa Join</span></button> - '
  }else{
    return 'terjadi Kesalahan'
  }

}
*/
?>
function cekjam (ceka, cekb){
  if ((ceka == '00:00:00') == false && (cekb == '00:00:00') == false) {
    return ''+ceka+' s.d.'+cekb;
  }else if((ceka == '00:00:00') == true && (cekb == '00:00:00') == true){
    return 'Tidak Memiliki Jam Kegiatan';
  }else if((ceka == '00:00:00') == false && (cekb == '00:00:00') == true){
    return ''+ceka+' s.d. Selesai';
  }else{
    return 'terjadi kesalahan'; 
  }
}
//javascript row detail

function format ( d ) {
    return cekstatus(d.status_acc, d.id_surattugas, d.nama_kegiatan)+
            '<a href="lihat/'+d.id_surattugas+'/pesertaclient" title="Lihat Peserta"><button type="button" class="btn btn-outline-info btn-xs" title="Lihat Peserta Yang Mengikuti kegiatan Ini"><span class="fa fa-eye"> Lihat Peserta</span></button></a>'+
              '<hr>'+
              'Penyelenggara : <small class="badge badge-primary"><i class="far fa fa-building"></i> '+d.penyelengara+'</small>'+
               ' | <small class="badge badge-success"><i class="far fa fa-file-pdf"></i> '+d.berkas+' File Pendukung</small>  '+
              '<hr>'+
                '<table id="surattugas" class="table table-striped">'+
                 '<thead style="background-color: #08203c; color: white">'+
                      '<tr>'+
                        '<th style="width: 200px;">Kategori</th>'+
                        '<th style="width: 500px;">Lokasi</th>'+
                        '<th style="width: 500px;">Jam</th>'+
                        '<th style="width: 500px;">Jumlah Peserta</th>'+
                        '</tr>'+
                      '</thead>'+
                      '<tbody>'+
                            '<tr>'+
                                '<td>'+d.nama_kategori+'</td>'+
                                '<td>'+d.lokasi+'</td>'+
                                '<td>'+cekjam(d.jam_kegiatan_mulai, d.jam_kegiatan_selesai)+'</td>'+
                                '<td>'+d.jumlahorang+' Orang Peserta</td>'+
                            '</tr>'+
                      '</tbody>'+
                '</table>';

}
$.noConflict();
jQuery( document ).ready(function( $ ) {
   
    var dt = $('#surattugas').DataTable({
        processing: true,
        serverSide: true,
        //scrollX: true,
        responsive: true,
        ajax: '{!! route('surat.data.client') !!}',
        order: [ [1, 'DESC'] ], 
       
        columns: [
            {
                "class":          "details-control",
                "orderable":      false,
                //"data":           null,
                "defaultContent": ""
            },
            { data: 'id_surattugas', name: 'surat_tugas.id_surattugas', visible: false },
            { data: 'penyelengara', name: 'surat_tugas.penyelengara', visible: false},
            { data: 'nama_kategori', name: 'kategorisebagai.nama_kategori', visible: false},
            { data: 'tanggal_selesai', name: 'tanggal_selesai', visible: false},
            { data: 'jam_kegiatan_mulai', name: 'surat_tugas.jam_kegiatan_mulai', visible: false},
            { data: 'jam_kegiatan_selesai', name: 'surat_tugas.jam_kegiatan_selesai', visible: false},
            { data: 'status_acc', name: 'surat_tugas.status_acc', visible: false},
            { data: 'jumlahorang', name: 'jumlahorang', visible: false},
            { data: 'berkas', name: 'berkas', visible: false},
            { data: 'nama_kegiatan', name: 'surat_tugas.nama_kegiatan' },
            { data: 'tanggal_mulai',
              render: function ( data, type, row ) {
                  return row.tanggal_mulai + ' - ' + row.tanggal_selesai + '';
              }
            },
            { data: 'lokasi', name: 'surat_tugas.lokasi' },
            { data: 'status', name: 'status' },
        ],
         
    });

    setInterval( function () {
       $('#surattugas').DataTable().ajax.reload();
    }, 300000 );

    // Array to track the ids of the details displayed rows
    var detailRows = [];
 
    $('#surattugas tbody').on( 'click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = dt.row( tr );
        var idx = $.inArray( tr.attr('id'), detailRows );
 
        if ( row.child.isShown() ) {
            tr.removeClass( 'details' );
            row.child.hide();
 
            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
            tr.addClass( 'details' );
            row.child( format( row.data() ) ).show();
 
            // Add to the 'open' array
            if ( idx === -1 ) {
                detailRows.push( tr.attr('id') );
            }
        }
    } );

    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    } );
    
});

</script>

<script type="text/javascript">
jQuery( document ).ready(function($){
  $('#pegawai').on('change', function(){
          $.post('{{ URL::to('/dropdownclient') }}', {
              type: 'jabatan', 
              _token: "{{ csrf_token() }}",
              id: $('#pegawai').val(),

              beforeSend: function() {
                $("#loader").show();
                NProgress.start();
              },

              success: function(msg) {
                  $("#loader").hide();
                  NProgress.done();
              },
            }, 
            function(e){
              $('#sjabatan').html(e);
          });
      });
});

jQuery( document ).ready(function($){
  $('#pegawai').on('change', function(){
        $.post('{{ URL::to('/dropdownnipnidnclient') }}', {
            type: 'nipnidn', 
            _token: "{{ csrf_token() }}",
            id: $('#pegawai').val(),

            beforeSend: function() {
              $("#loadernip").show();
             
              NProgress.start();
            },

            success: function(msg) {
                $("#loadernip").hide();
              
                NProgress.done();
            },
          }, 
          function(e){
            $('#snipnidn').html(e);
        });
    });
});
</script>

<script type="text/javascript">
 jQuery( document ).ready(function( $ ) {

  $('[data-toggle="penjelasan"]').tooltip()
  
})


jQuery( document ).ready(function($){
  $('.selectp').select2({
    theme: 'bootstrap4'
  });
  $('.selectj').select2({
    theme: 'bootstrap4'
  });
  $('.selectk').select2({
    theme: 'bootstrap4'
  });
  $('.selectnipnidn').select2({
    theme: 'bootstrap4'
  });


});
</script>
<style>
.tooltip-inner {
    min-width: 350px; /* the minimum width */
}

td.details-control {
    background: url('{{ URL::asset('admin/dist/img/open.png') }}') no-repeat center center;
    cursor: pointer;
}
tr.details td.details-control {
    background: url('{{ URL::asset('admin/dist/img/close.png') }}') no-repeat center center;
}
</style>
@include('sweet::alert')