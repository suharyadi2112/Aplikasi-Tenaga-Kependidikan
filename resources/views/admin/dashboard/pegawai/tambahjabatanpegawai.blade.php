@extends('admin.layout.master')

@section('content')


<?php if(cek_akses('81') == 'yes'){
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
          <h1 class="m-0 text-dark">Tambah Jabatan Pegawai</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Tambah Jabatan Pegawai</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- /.content-header -->

<div class="container-fluid center">
  <div class="row">
      <!-- left column -->
      <div class="col-md-5">
        <!-- general form elements -->
        <div class="card bg-dark">
          <div class="card-header">
            <h3 class="card-title">Jabatan Pegawai</h3>
          </div>
          <!-- /.card-header -->
              <!-- form start -->
                <form id="formProdiEdit" class="form-horizontal" role="form" method="POST" action="{{ url('/simpanjabatanpegawai') }}">
                  <div class="card-body">
                   @csrf
                    
                    <div class="form-group">
                      <label for="nama_pegawai">Nama Pegawai</label>
                        <div class="has-error">
                            <select class="form-control select2" name="id_pegawai" required="">
                                <option value="">------Pilih Nama Pegawai-----</option>
                                @foreach ($pegawai as $item_pegawai)
                                <option value="{{$item_pegawai->id_pegawai}}">{{$item_pegawai->nama_karyawan}}</option>
                                @endforeach
                            </select>
                            
                            <small class="help-block"></small>
                        </div>
                    </div>

                    <div class="form-group">
                      <label for="jabatan_pegawai">Jabatan Pegawai | </label>
                      
                          <a href="#" class="add_form_field"> <span class="fa fa-plus-circle"></span>
                          </a>
                            <select name="jabatan[]" class="form-control select2" required="">
                              <option value="">Pilih Jabatan</option>
                              @foreach($jabs as $keyjabs => $vJabs)
                              <option value="{{ $vJabs->id_detail_jabatan }}">{{ $vJabs->nama_jabatan }} | {{ $vJabs->nama_detail_jabatan }}</option>
                              @endforeach
                            </select>
                            <br>
                            <select name="prodi[]" class="form-control select2" >
                              <option value="">Pilih Prodi</option>
                              @foreach($prodi as $keyprodi => $vProdi)
                              <option value="{{ $vProdi->id_prodi }}">{{ $vProdi->nama_prodi }}</option>
                              @endforeach
                            </select>
                      <div class="container1">
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

var jabs = <?php echo json_encode( $jabs ) ?>;
var prodi = <?php echo json_encode( $prodi ) ?>;

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
            $(wrapper).append('<div><br><hr class="bg-light">'+

              '<select id="jabs'+x+'" name="jabatan[]" class="form-control selectplus'+x+'" required="" >'+
                              '<option value="">Pilih Jabatan</option>'+
                               
                            '</select><br>'+
              '<select id="prodi'+x+'" name="prodi[]" class="form-control selectplus'+x+'">'+
                              '<option value="">Pilih Prodi</option>'+
                              '</select><br>'+

              '<a href="#" class="delete btn btn-danger btn-xs">Delete</a>'+

              '</div>'

              ); //add input box
        } else {
            alert('Maks 10 Slot')
        }

        //TAMBAHAN JABATAN
        for (var i = 0; i < jabs.length; i++) {
            var select = document.getElementById('jabs'+x+'');
            var option = document.createElement("option");
            option.text = jabs[i].nama_jabatan+' | '+jabs[i].nama_detail_jabatan;
            option.value = jabs[i].id_detail_jabatan;
            select.add(option);
        }

        //TAMBAHAN PRODI
        for (var i = 0; i < prodi.length; i++) {
            var select = document.getElementById('prodi'+x+'');
            var option = document.createElement("option");
            option.text = prodi[i].nama_prodi;
            option.value = prodi[i].id_prodi;
            select.add(option);
        }

        $('.selectplus'+x+'').select2({
              theme: 'bootstrap4'
            });

    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});

$('.select2').select2({
      theme: 'bootstrap4'
    })

</script>
<style type="text/css">
  .select2-selection{background-color: #ffffff !important; color: black;}
</style>
@include('sweet::alert')
@endsection
