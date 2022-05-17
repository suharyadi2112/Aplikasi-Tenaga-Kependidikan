
@extends('admin.layout.master')


@section('content')

<?php if(cek_akses('41') == 'yes'){
}else{ ?>
  <script type="text/javascript">history.back(alert("Anda Tidak Memiliki Akses"))</script>
<?php } ?> 

<br> 
<div class="container-fluid"> 
    <div class="row">
      <div class="col-12">
           <div class="uk-alert uk-alert-success" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
              @if ($message = Session::get('successMessage'))

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                <strong>{{ $message }}</strong>
              </div>
              @endif
          </div>
          
          <div class="card-body bg-dark p-2">
            <h3 class="card-title">Surat Tugas | </h3>&nbsp;
     
            <a href="{{ URL('showtambahclient') }}" class="btn btn-outline-info btn-flat margin btn-sm" data-id=""><i class="fa fa-fw fa-plus"></i>Tambah Surat Tugas</a>

            <a href="{{ Route('ExportExcelSrtTgs') }}" class="btn btn-outline-info btn-flat margin btn-sm" data-id=""><i class="fa fa-fw fa-file-excel"></i>Export Excel</a>

            <!--a href="{{{ action('SuratTugas\SuratTugasController@showtambah') }}}" class="btn bg-navy btn-flat margin btn-sm" ><i class="fa fa-fw fa-plus"></i>Tambah Surat Tugas</a-->
            <br><br>
            <div class="table-responsive">
            <table id="datatablespegawai" class="table table-striped table-bordered display table-dark table-hover" width="100%">
              <thead>
              <tr>
                <th><center><span class="fa fa-eye"></span></center></th>
                <th></th>
                <th>Nomor Surat</th>
                <th nowrap>Aksi</th>
                <th>Kegiatan</th>
                <th>Tanggal Kegiatan</th>
                <th>Status</th>
                <th>Aksi</th>
                </tr>
              </thead>
            </table></div>
          </div>
          <!-- /.card-body -->
        <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</div>

 <div id="confirmModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h3 class="modal-title">Update Nomor Surat Tugas</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                    <div class="modal-body">
                      <form id="joinkegiatan" class="form-horizontal" role="form" action="{{ url('update/nosurat') }}" method="POST">
                      @csrf
                      <input type="hidden" name="id_surattugas" id="id_surattugas" value=""/>
                      
                      <div class="form-group">
                        <label for="surat_tugas">Nomor Surat Tugas :<font color="red" size="2px">*</font></label>
                        <div title="Nomor Surat">

                          <div class="input-group">
                     
                             <input type="text" id="nosurat" name="no_surat" class="form-control" autocomplete="off" placeholder="No.Surat " required="" style="max-width: 100px;">
                              <div class="input-group-prepend">
                              <span class="input-group-text">{{ $nosu }}</span>
                            </div>
                          </div>
                          <small class="help-block"></small>
                        </div>
                      </div>
                      

                       <div class="modal-footer">
                          <button type="submit" class="join btn btn-primary">Update Nomor Surat</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    
                  </form> 
              </div>
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
@endphp
  
@endsection
@section('script')
<script type="text/javascript">
jQuery( document ).ready(function( $ ) {
  var id_surattugas;
  $(document).on('click', '.up_no', function(){

    id_surattugas = $(this).attr('id');
    $('#confirmModal').modal('show');
    $(".modal-body #id_surattugas").val( id_surattugas );

   });
});

</script>

<script type="text/javascript">
jQuery( document ).ready(function( $ ) {
   $("input#nosurat").on({
    keydown: function(e) {
      if (e.which === 32)
        return false;
    },
    change: function() {
      this.value = this.value.replace(/\s/g, "");
    }
  });
 });
</script>
<!--script type="text/javascript">
jQuery( document ).ready(function( $ ) {
  var path1 = "{{ route('autocompletesurattugas') }}";
  $('#nosurat').typeahead({
      source:  function (query, process) {
      return $.get(path1, { query: query }, function (data) {
              return process(data);
          });
      }
});
});
</script-->
<script>

function format ( d ) {
    return '<div class="slider">'+ 
    'Penyelenggara : <small class="badge badge-primary"><i class="far fa fa-map-marker-alt"></i> '+d.penyelengara+'</small>  '+
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
                            '<td>'+d.jam_kegiatan_mulai+'-'+d.jam_kegiatan_selesai+'</td>'+
                            '<td>'+d.jumlahorang+' Orang Peserta</td>'+
                        '</tr>'+
                  '</tbody>'+
            '</table>'+
            '</div>'
       
}

$.noConflict();
jQuery( document ).ready(function( $ ) {
    
    var dt = $('#datatablespegawai').DataTable({
        processing: true,
        serverSide: true,
        //scrollX: true,
        responsive: true,
        ajax: '{!! route('surat.data') !!}',
        order: [ [1, 'DESC'] ], 
        language: {
            "infoFiltered":"",
            "processing": '<img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 30%;">',
            "searchPlaceholder": "Masukan Nomor Surat",
        },
        buttons: [
            'csv', 'excel'
        ],
        
        columns: [
            {
                "class":          "details-control",
                "orderable":      false,
                //"data":           'id_surattugas',
                "defaultContent": ""
            },
            { data: 'id_surattugas', name: 'surat_tugas.id_surattugas', visible : false }, 
            { data: 'nomor_surat', name: 'surat_tugas.nomor_surat' },
            { data: 'peserta', name: 'peserta' },
            { data: 'nama_kegiatan', name: 'surat_tugas.nama_kegiatan' },
            { data: 'tanggal_mulai',
              render: function ( data, type, row ) {
                  return row.tanggal_mulai + ' - ' + row.tanggal_selesai + '';
              }
            },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' },
        ],

          createdRow: function ( row, data, index ) {
            $('td', row).eq(6).attr("nowrap","nowrap");
            $('td', row).eq(1).attr("nowrap","nowrap");
          },
         
    });

    setInterval( function () {
       $('#datatablespegawai').DataTable().ajax.reload();
    }, 300000 );

    $(document).on('click', '.cekswal', function(){
      id_user = $(this).attr('id');
      nama_kegiatan = $(this).attr('data-id');
      swal({
        title: "Apakah Anda Yakin?",
        text: "Melanjutkan Proses Kegiatan "+nama_kegiatan+"!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

          $.ajax({
           url:"update/"+id_user+"/proses",

          beforeSend:function(){
           },
          success:function(data)
           {
            setTimeout(function(){
            swal("Berhasil! Data Pengajuan Surat Tugas Berhasil Diproses!", {
              icon: "success",
            });
             $('#datatablespegawai').DataTable().ajax.reload();
            }, 1000);
           },
          error: function(xhr) { // if error occured
                swal("Upsss!", "Terjadi Kesalahan, Cek Internet Anda!", "error");
         
            },
          })  
        } else {
          swal("Batal Untuk Melakukan Proses!");
        }
      });
     });
    // Array to track the ids of the details displayed rows
    var detailRows = [];
 
       // Add event listener for opening and closing details
    $('#datatablespegawai tbody').on('click', 'td.details-control', function () {
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
