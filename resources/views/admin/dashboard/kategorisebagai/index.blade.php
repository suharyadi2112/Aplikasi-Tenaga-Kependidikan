
@extends('admin.layout.master')


@section('content')


<?php if(cek_akses('46') == 'yes'){
}else{ ?>
  <script type="text/javascript">history.back(alert("Anda Tidak Memiliki Akses"))</script>
<?php } ?> 


<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Kategori Sebagai</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active">Kategori Sebagai</li>
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
            <a href="{{{ action('KategoriSebagai\KategoriController@showtambah') }}}" class="btn bg-navy btn-flat margin" data-id=""><i class="fa fa-fw fa-plus"></i>Tambah Kategori</a>
          </div>
          <div class="card-body">
            <table id="datatableskategori" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Nama Kategori</th>
                <th>Created At</th>
                <th>Aksi</th>
                </tr>
              </thead>
             
              <tfoot>
              <tr>
                <th>Nama Kategori</th>
                <th>Created At</th>
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

<script>
$.noConflict();

jQuery( document ).ready(function( $ ) {

    console.log(),
    $('#datatableskategori').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('kategori.data') !!}',

        columns: [
            { data: 'nama_kategori', name: 'nama_kategori' },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action' },
        ]
    });
});
</script>
@include('sweet::alert')
@endsection
