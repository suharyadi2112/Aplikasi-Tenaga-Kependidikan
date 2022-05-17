@extends('admin.layout.master')

@section('content')

<?php if(cek_akses('82') == 'yes'){
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
          <h1 class="m-0 text-dark">Tambah Pegawai</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tambah Pegawai</li>
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
            <h3 class="card-title">Pegawai</h3>
          </div>
          <!-- /.card-header -->
              <!-- form start -->
                <form id="formProdiEdit" class="form-horizontal" role="form" method="POST" action="{{ url('/simpanpegawai') }}">
                  <div class="card-body">
                   @csrf
                    <div class="form-group">
                      <label for="NIP">NIP</label>
                      <input type="text" class="form-control @error('nip') is-invalid @enderror"" id="inputError" name="nip" value="" placeholder="1909.9.1156" onkeypress="return validate(event)" >

                      @error('nip')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                      @enderror

                    </div>
                    <div class="form-group">
                      <label for="nidn">NIDN</label>
                      <input type="text" class="form-control @error('nidn') is-invalid @enderror"" id="inputError" name="nidn" value="" placeholder="100202850267" onkeypress="return validate(event)" >

                      @error('nidn')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                      @enderror

                    </div>
                    <div class="form-group">
                      <label for="nama_karyawan">Nama Karyawan</label>
                      <input type="text" class="form-control @error('nama_karyawan') is-invalid @enderror"" id="inputError" name="nama_karyawan" value="" placeholder="Jumiati">

                      @error('nama_karyawan')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                      @enderror

                    </div>

                    <div class="form-group">
                      <label for="jabatan_pegawai">Jabatan Pegawai</label>
                      <div class="container1">
                          <button class="add_form_field btn btn-primary btn-xs">Add More Potision
                            <span style="font-size:16px; font-weight:bold;">+</span>
                          </button>
                          <br><br>
                          <div>
                            <input type="text" class="form-control" name="jabatan[]" placeholder="Dosen Fisika" required="">
                          </div>
                      </div>
                    </div>
                  
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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

//add form jabatan
$(document).ready(function() {
    var max_fields = 10;
    var wrapper = $(".container1");
    var add_button = $(".add_form_field");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<br><div><input type="text" class="form-control" name="jabatan[]" placeholder="Rektor" required/><hr><a href="#" class="delete btn btn-danger btn-xs">Delete</a></div>'); //add input box
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});

</script>

@include('sweet::alert')
@endsection
