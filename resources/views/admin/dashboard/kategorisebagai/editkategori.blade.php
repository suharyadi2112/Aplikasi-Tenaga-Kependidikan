@extends('admin.layout.master')


@section('content')

<?php if(cek_akses('48') == 'yes'){
}else{ ?>
  <script type="text/javascript">history.back(alert("Anda Tidak Memiliki Akses"))</script>
<?php } ?> 


<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Kategori</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Nama Kategori</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- /.content-header -->

<div class="container-fluid">
  <div class="row">
      <!-- left column -->
      <div class="col-md-5">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Kategori</h3>
          </div>
          <!-- /.card-header -->
              <!-- form start -->
                <form id="" class="form-horizontal" role="form" method="POST" action="{{ url('/editkat/'.$id_kategori.'/egori') }}">
                  <div class="card-body">
                   @csrf
                    <div class="form-group">

                      @csrf
                      <input type="hidden" name="_method" value="PUT">
                      <input type="hidden" name="id_kategori" value="{{$id_kategori}}" >

                      <label for="Nama Kategori">Nama Kategori</label>
                      <input type="text" class="form-control @error('namakategori') is-invalid @enderror"" id="inputError" name="namakategori" value="{{ $nama_kategori }}" >

                      @error('namakategori')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                      @enderror

                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{{ action('KategoriSebagai\KategoriController@index') }}}" title="Cancel">
                      <span class="btn btn-danger"><i class="fa fa-back"> Cancel </i></span>
                    </a>  
                  </div>
                
                </form>
            </div><!-- /.row (main row) -->
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

@include('sweet::alert')
@endsection
