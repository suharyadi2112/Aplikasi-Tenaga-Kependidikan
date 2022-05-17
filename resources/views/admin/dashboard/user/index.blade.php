
@extends('admin.layout.master')


@section('content')


<?php if(cek_akses('73') == 'yes'){
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

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">User</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
  <!-- /.content-header --> 
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

        <div class="card">
          <!-- /.card-header -->
          <div class="card-header">
            <a href="{{{ URL::to('pegawai') }}}" class="btn btn-outline-warning btn-flat margin" data-id="" ><i class="fa fa-fw fa-angle-double-left"></i>Pegawai</a>
            <a href="{{{ action('Auth\UserController@showtambah') }}}" class="btn bg-navy btn-flat margin" data-id=""><i class="fa fa-fw fa-plus"></i>Tambah User</a>
          </div>
          <div class="card-body">
            <table id="datatables" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Usergroup</th>
                <th>Aksi</th>
              </tr>
              </thead>
             
              <tfoot>
              <tr>
                <th>Nama</th>
                <th>Username</th>
                <th>Usergroup</th>
                <th>Aksi</th>
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


  <div id="confirmModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h2 class="modal-title">Confirmation</h2>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  <h4 align="center" style="margin:0;">Apakah Anda Yakin Ingin Menghapus Ini?</h4>
              </div>
              <div class="modal-footer">
               <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
          </div>
      </div>
  </div>

   <div id="confirmModalreset" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h2 class="modal-title">Confirmation</h2>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                  <h4 align="center" style="margin:0;">Apakah Anda Yakin Ingin Mereset Pass Ini?</h4>
              </div>
              <div class="modal-footer">
               <button type="button" name="ok_button_reset" id="ok_button_reset" class="btn btn-danger">OK</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
          </div>
      </div>
  </div>
  <!--end of Modal -->    

</div>



@endsection
@section('script')

<script>
$.noConflict();
jQuery( document ).ready(function( $ ) {
    console.log(),
    $('#datatables').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('user.data') !!}',


        columns: [
            { data: 'name', name: 'name' },
            { data: 'username', name: 'username' },
            { data: 'nama', name: 'level' },
            { data: 'action', name: 'action' },
        ]
    });

     //Hapus 
    var id_user;

     $(document).on('click', '.delete', function(){
      id_user = $(this).attr('id');
      $('#confirmModal').modal('show');
     });

     $('#ok_button').click(function(){
      $.ajax({
       url:"datauser/destroy/"+id_user,

       beforeSend:function(){
        $('#ok_button').text('Deleting...');

        //NProgress.start();
       },

       success:function(data)
       {

        //NProgress.done();
        setTimeout(function(){
         $('#confirmModal').modal('hide');
         swal({
              title: "Deleted!",
              text: "Your post has been deleted.",
              type: "success"
          }),
         $('#datatables').DataTable().ajax.reload();
        }, 1000);
       },
       error: function(xhr) { // if error occured
                    swal("Upsss!", "Terjadi Kesalahan", "error");
                },
      })
     });


        //Hapus 
    var id_user;

     $(document).on('click', '.reset', function(){
      id_user = $(this).attr('id');
      $('#confirmModalreset').modal('show');
     });

     $('#ok_button_reset').click(function(){
      $.ajax({
       url:"datauser/reset/"+id_user,

       beforeSend:function(){
        $('#ok_button_reset').text('Reseting...');
       },

       success:function(data)
       {
        setTimeout(function(){
         $('#confirmModalreset').modal('hide');
         swal({
              title: "Reseting!",
              text: "Your post has been Reseting.",
              type: "success"
          }),
         $('#datatables').DataTable().ajax.reload();
        }, 1000);
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
