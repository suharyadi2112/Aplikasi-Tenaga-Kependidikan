@extends('admin.layout.master')

@section('content')


<?php if(cek_akses('80') == 'yes'){
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
          <h1 class="m-0 text-dark">Edit Pegawai</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Edit Pegawai</li>
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
            <h3 class="card-title">Edit Pegawai</h3>
          </div>
          <!-- /.card-header -->
              <!-- form start -->
                <form id="formProdiEdit" class="form-horizontal" role="form" method="POST" action="{{  url('/editpeg/'.$id_pegawai.'/awai') }}">
                  <div class="card-body">
                   @csrf
                    <div class="form-group">

                      <input type="hidden" name="_method" value="PUT">
                      <input type="hidden" name="id_pegawai" value="{{$id_pegawai}}" >

                      <label for="NIP">NIP</label>
                      <input type="text" class="form-control @error('nip') is-invalid @enderror"" id="inputError" name="nip" value="{{ $nip }}" placeholder="4321223" onkeypress="return validate(event)">

                      @error('nip')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                      @enderror

                    </div>
                    <div class="form-group">
                      <label for="nidn">NIDN</label>
                      <input type="text" class="form-control @error('nidn') is-invalid @enderror"" id="inputError" name="nidn" value="{{ $nidn }}" placeholder="100202850267" onkeypress="return validate(event)" >

                      @error('nidn')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                      @enderror

                    </div>
                    <div class="form-group">
                      <label for="nama_karyawan">Nama Karyawan</label>
                      <input type="text" class="form-control @error('nama_karyawan') is-invalid @enderror"" id="inputError" name="nama_karyawan" value="{{ $nama_karyawan }}" placeholder="Jumiati">

                      @error('nama_karyawan')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                      @enderror

                    </div>

                    @foreach($list_jabatan as $itemjabatan)
                     <div class="form-group">
                      <label for="nama_karyawan">Nama Jabatan</label>
                      <input type="hidden" name="id_jabatan" value="{{ $itemjabatan->id_jabatan }}">
                      <input type="text" class="form-control @error('nama_karyawan') is-invalid @enderror"" id="inputError" name="nm_jabatan" value="{{ $itemjabatan->nm_jabatan }}" placeholder="Rektor" required="">

                      @error('nm_jabatan')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                      @enderror

                    </div>
                    @endforeach
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{{ action('Pegawai\PegawaiController@index') }}}" title="Cancel">
                      <span class="btn btn-danger"><i class="fa fa-back"> Cancel </i></span>
                    </a>  
                  </div>
                
                </form>
            </div><!-- /.row (main row) -->
        </div>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

</script>

@include('sweet::alert')
@endsection
