
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
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
           
           <div class="card-header">
            <h3 class="card-title">Surat Tugas</h3>
          </div>
         
          <div class="card-body">
            <div class="table-responsive">
            <table id="surattugas" class="table table-striped table-bordered dt-responsive display">
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
                <th>Nama Kegiatan</th>
                <th>Tanggal Kegiatan</th>
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
                <th>Nama Kegiatan</th>
                <th>Tanggal Kegiatan</th>
                <th>Lokasi</th>
                <th>Status</th>
              </tr>
              </tfoot>
            </table></div>
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
                  <h3 class="modal-title">Verifikasi Kegiatan Ini</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <form id="joinkegiatan" class="form-horizontal" role="form" action="{{ url('verifikasi/kegiatan') }}" method="POST">
                @csrf
                      <input type="hidden" name="id_surattugas" id="id_surattugas" value=""/>

                      <div class="form-group clearfix">
                        <div class="icheck-success d-inline">
                          <input type="radio" name="validasi" value="1" id="radioDanger1" required="">
                          <label for="radioDanger1">
                            Terima
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" name="validasi" value="2" id="radioDanger2" required="">
                          <label for="radioDanger2">
                          </label>
                        </div>
                        <label for="radioDanger3">
                            Tolak
                        </label>

                        <div class="icheck-warning d-inline">
                          <input type="radio" name="validasi" value="3" id="radioDanger3" required="">
                          <label for="radioDanger3">
                          </label>
                        </div>
                        <label for="radioDanger3">
                            Proses
                        </label>
                        <hr>

                        <textarea class="form-control" placeholder="Sertakan Alasan Jika Ditolak" name="alasan"></textarea>
                        
                      </div>
                      <font color="blue">*Pastikan Sudah Mengecek Isi Dari kegiatan Ini</font>
                      <div class="modal-footer">
                          <button type="submit" class="join btn btn-primary">Verifikasi</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                        
                  </form> 
              </div>
          </div>
      </div>
  </div>

 
@endsection
@section('script')

<script type="text/javascript">
jQuery( document ).ready(function( $ ) {
  var id_surattugas;
  $(document).on('click', '.validasi', function(){

    id_surattugas = $(this).attr('id');
    $('#confirmModal').modal('show');
    $(".modal-body #id_surattugas").val( id_surattugas );

   });
});
</script>

<script type="text/javascript">

function format ( d ) {
    return 'Penyelenggara: '+d.penyelengara+'<br>'+
        'Kategori: '+d.nama_kategori+'<br>'+
        'Jam: '+d.jam_kegiatan_mulai+'-'+d.jam_kegiatan_selesai+'<br>'+
        
        '<a href="lihat/'+d.id_surattugas+'/pesertahead" title="Lihat Peserta"><button type="button" class="btn btn-outline-info btn-xs" title="Lihat Peserta Yang Mengikuti kegiatan Ini"><span class="fa fa-eye"> Lihat Peserta</span></button></a> - '+
        '<a href="lihat/'+d.id_surattugas+'/filehead" title="Lihat File"><button type="button" class="btn btn-outline-success btn-xs" title="Lihat Peserta Yang Mengikuti kegiatan Ini"><span class="fa fa-file"> Lihat File Pendukung</span></button></a>';
} 
$.noConflict();
jQuery( document ).ready(function( $ ) {
   
    var dt = $('#surattugas').DataTable({
        processing: true,
        serverSide: true,
        //scrollX: true,
        ajax: '{!! route('admin.headlist') !!}',
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
 jQuery( document ).ready(function( $ ) {

  $('[data-toggle="penjelasan"]').tooltip()
  
})
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
@endsection
