
@extends('admin.layout.master')

@section('content')

<?php if(cek_akses('88') == 'yes'){
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
<br>
<div class="content-header" style="padding: 0px;">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-7">
        <h4 class="m-0 text-dark">Honorarium Pembimbingan Tugas Akhir dan Kerja Praktik</h4>
      </div><!-- /.col -->
      <div class="col-sm-4">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active"><a href="{{ URL::to('pegawai') }}">Pegawai</a></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
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

        <a href="{{ URL::to('pegawai') }}" class="btn btn-sm btn-flat btn-outline-warning" >
                <span class="fa fa-backward"> </span> Kembali Ke Management Pegawai
        </a>
       
        <?php if(cek_akses('89') == 'yes'){ ?>
         <a href="#" class="btn_honor_add btn btn-sm btn-flat bg-navy" >
          <span class="fa fa-plus"> </span> Tambah data dosen
          </a>
        <?php }else{ ?>
          <a href="#" class=" btn btn-sm btn-flat bg-navy" onclick="myFunction()">
          <span class="fa fa-plus"> </span> Tambah data dosen
          </a>

          <script>
          function myFunction() {
            alert("Anda Tidak Memiliki Akses");
          }
          </script>

        <?php } ?> 
        <br><br>
            
          <div class="card-body" style="padding: 0px;">
            <div class="table-responsive">
            <table id="setting_honorarium" class="table table-striped table-bordered dt-responsive display table-dark">
              <thead>
              <tr>
                <th><span class="fa fa-eye"></span></th>
                <th nowrap="" data-toggle="tooltip" data-placement="top" title="Nama Dosen">Nama Dosen</th> 
                <th nowrap="" data-toggle="tooltip" data-placement="top" title="Nama Dosen">Jabatan Fungsional</th>
                <th nowrap="" data-toggle="tooltip" data-placement="top" title="Pembimbing Tugas Akhir 1">P-T-A 1</th>
                <th nowrap="" data-toggle="tooltip" data-placement="top" title="Pembimbing Tugas Akhir 2">P-T-A 2</th>
                <th nowrap="" data-toggle="tooltip" data-placement="top" title="Penguji Tugas Akhir">Peng TA</th>
                <th nowrap="" data-toggle="tooltip" data-placement="top" title="Penguji Seminar Proposal Tugas Akhir">Peng S-P-T-A</th>
                <th nowrap="" data-toggle="tooltip" data-placement="top" title="Pembimbing Kerja Praktik / Magang">PKP</th>
                </tr>
              </thead>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    <!-- /.col -->
  </div>
</div>
</div>


<!--Input data honorarium baru-->
<div id="honoradd"  class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog ">
    <div class="modal-content">
       <div id="overlay_buktup">
        
      </div>
        <div class="modal-header bg-info">
            <h4>Tambah Data Dosen Honorarium</h4>
            <button type="button" class="tutup_bg close" data-dismiss="modal">&times;</button>
        </div>
         <form data-route="{{ route('add_set_honor') }}" id="add_set_honor" role="form" method="POST" accept-charset="utf-8"> 
          @csrf
            <div class="modal-body ">
              <div class="container-fluid">
                  <div class="col-md-12">

                  <a href="{{URL::to('pegawai')}}"><span class="fa fa-plus"></span> Tambah Pegawai</a>
                  <div class="card card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <label>Nama Dosen :<font color="red" size="2px">* </font></label>

                        <div class="input-group">
                            <select class="select" name="id_pegawai" required="">
                              <option value=""> Pilih Pegawai</option>
                              @foreach($dosen as $showdosen)
                              <option value="{{$showdosen->id_pegawai}}">{{ $showdosen->nama_karyawan }}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>
                     
                    </div>
                  </div>


                  <div class="card card-body">
                    <div class="row">
                      <div class="col-md-12">

                        <label>Jabatan Fungsional  :<font color="red" size="2px">*</font></label>
                        <div class="input-group">
                          <input type="text" name="jabatan_fungsional" class="form-control"  placeholder="Asisten Ahli" required="">
                        </div>

                        <label>Pembimbing Tugas Akhir Pertama :<font color="red" size="2px">*</font></label>
                        <div class="input-group">
                          <input type="number" name="pta1" class="form-control" required="" placeholder="100000">
                        </div>

                        <label>Pembimbing Tugas Akhir kedua :<font color="red" size="2px">*</font></label>
                        <div class="input-group">
                          <input type="number" name="pta2" class="form-control" required="" placeholder="100000">
                        </div>


                        <label>Penguji Tugas Akhir :<font color="red" size="2px">*</font></label>
                        <div class="input-group">
                          <input type="number" name="peng_ta" class="form-control" required="" placeholder="100000">
                        </div>

                        <label>Penguji Seminar Proposal Tugas Akhir :<font color="red" size="2px">*</font></label>
                        <div class="input-group">
                          <input type="number" name="peng_s_ta" class="form-control" required="" placeholder="100000">
                        </div>

                        <label>Pembimbing Kerja Praktik :<font color="red" size="2px">*</font></label>
                        <div class="input-group">
                          <input type="number" name="pkp" class="form-control" required="" placeholder="100000">
                        </div>

                      </div>
                    </div>
                  </div>

                  </div>  

                  </div>
                  </div>

               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span> Simpan</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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


function format ( d ) {

      // `d` is the original data object for the row
      return '<div class="slider">'+
                ''+d.action+''
              '</div>'



  }

 var dt =  $('#setting_honorarium').DataTable({
        processing: true,
        serverSide: true,
        scrollY : false,
        bStateSave : true,
        ajax: '{!! route('get_data_setting_honorarium') !!}',
        order: [ [1, 'DESC'] ], 
        
        columns: [
            {
                "class":          "details-control",
                "orderable":      false,
                //"data" : 'id',
                "defaultContent": "",
            }, 
            { data: 'nama_karyawan', name: 'pegawai.nama_karyawan' },
            { data: 'jabatan_fungsional', name: 'jabatan_fungsional' },
            { data: 'p_t_a_satu',name: 'p_t_a_satu'
             
            },
            { data: 'p_t_a_dua',name: 'p_t_a_dua'
              
            },
            { data: 'p_tugas_akhir',name: 'p_tugas_akhir'
             
            },
            { data: 'p_seminar_p_t_a',name: 'p_seminar_p_t_a'
             
            },
            { data: 'pkp',name: 'pkp' },
        ],
          createdRow: function ( row, data, index ) {
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
          },

    });
    var detailRows = [];
 
      // Add event listener for opening and closing details
    $('#setting_honorarium tbody').on('click', 'td.details-control', function () {
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





    //untuk buka modal tambah data honorarium
    $(document).on('click', '.btn_honor_add', function(){
      $('#honoradd').modal('show');
    });


    //komunikasi ke server penambahan buka dan tutup buku
    $(document).on('submit', '#add_set_honor', function(e) {  
      e.preventDefault();
      var route = $('#add_set_honor').data('route');
      var form_data = $(this);
      var wrapper = $("#overlay_buktup");
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
            console.log(Response);
             $.blockUI({ css: { 
                border: 'none', 
                padding: '5px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '5px', 
                '-moz-border-radius': '5px', 
                opacity: .5, 
                color: '#fff' 
            } }); 
            
              setTimeout(function(){
                swal("Berhasil!", "Berhasil Mengubah Data", "success");
                });
              
            },
          complete: function() {
                $('#overlay_buktup').remove();
                $('#buktupshow').modal('hide');
                setTimeout(function () { location.reload(1); }, 2000);
                $.unblockUI();

                },
          error: function(xhr) { // if error occured
                    swal("Upsss!", "Terjadi Kesalahan", "error");
                },

      })
    });

    $('.select').select2({
      theme: 'bootstrap4'
    });

});



</script>



<script type="text/javascript">
 jQuery( document ).ready(function( $ ) {

 
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  
})
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
