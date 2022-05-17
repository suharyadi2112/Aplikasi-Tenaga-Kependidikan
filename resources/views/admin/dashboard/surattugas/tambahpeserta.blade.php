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
  <!-- /.content-header -->
  <!-- /.content-header -->

<div class="container-fluid">
  <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-success">
          <div class="card-header">
            <form role="form" id="hitungform" method="POST" action="{{ url('/tambah/'.encrypt($id_surattugas_fk).'/peserta') }}">
                @csrf
                <div class="col-md-3"style="float: right;">
                      <select name="loopingform" class="form-control selectj" onchange="onSelectChange();">
                        <option value="">------Tambah Jumlah Peserta------</option>
                        <option value="1">1 Peserta</option>
                        <option value="2">2 Peserta</option>
                        <option value="3">3 Peserta</option>
                        <option value="4">4 Peserta</option>
                        <option value="5">5 Peserta</option>
                        <option value="6">6 Peserta</option>
                        <option value="7">7 Peserta</option>
                        <option value="8">8 Peserta</option>
                        <option value="9">9 Peserta</option>
                        <option value="10">10 Peserta</option>

                      </select>
                  </div>
              </form>
            <h3 class="card-title">Tambah Peserta</h3>
          </div>
          
          <!-- /.card-header -->
              <!-- form start -->
          <form id="formProdiEdit" class="form-horizontal" role="form" method="POST" action="{{ url('/simpan/'.encrypt($id_surattugas_fk).'/peserta') }}" enctype="multipart/form-data">
            <div class="card-body">

                    <div class="row">
                      <!--tambah form-->
                      @csrf
                        <div class="col-md-4">
                              <div class="form-group">
                                <label for="nama_pegawai">Nama Pegawai :<font color="red" size="2px">*</font></label>
                                <div class="has-error"  data-toggle="penjelasan" title="Pilih Nama Pegawai Yang Akan Didaftarkan Dalam Pengajuan Surat Tugas">
                                      <select class="form-control selectp" id="pegawai" name="pegawai[]" required >
                                          <option value="" >------Pilih Nama Pegawai-----</option>
                                          @foreach ($list_pegawai as $item_pegawai)
                                          <option value="{{$item_pegawai->id_pegawai}}">{{$item_pegawai->nama_karyawan}}</option>                                        
                                          @endforeach

                                      </select>
                                  <small class="help-block"></small>
                                </div>
                              </div>
                            </div>   

                            <div class="col-md-4" data-toggle="penjelasan" title="Pilih Sesuai Kebutuhan Nidn Atau Nip Dalam Pengajuan Surat Tugas">
                                <div class="form-group" >
                                  <label for="nipnidn">NIP/NIDN :<font color="red" size="2px">*</font></label>
                                  <select id="snipnidn" name="nipnidn[]" class="form-control selectnipnidn" required="" >
                                    <option value="">Pegawai Mungkin Memiliki NIP dan NIDN</option>
                                  
                                  </select>
                                  <font style="color: #007bff" size="2px">*Pegawai Mungkin Memiliki NIP/NIDN</font><br>
                                  <span id="loadernip"><i class="fa fa-spinner fa-1x fa-spin"></i><font style="color: #007bff" size="2px">Pilih Nama Pegawai Dahulu</font></span>
                                </div>
                            </div>

                            <div class="col-md-4" data-toggle="penjelasan" title="Pilih Jabatan Peserta Dalam Pengajuan Surat Tugas">
                                <div class="form-group">
                                  <label for="jabatan">Jabatan Pegawai :<font color="red" size="2px">*</font></label>
                                  <select id="sjabatan" name="jabatan[]" class="form-control selectj" required="" >
                                    <option value="">Pegawai Mungkin Memiliki 1 Atau Lebih Jabatan</option>
                                  
                                  </select>
                                  <font style="color: #007bff" size="2px">*Pegawai Mungkin Memiliki Lebih Dari 1 Jabatan</font><br>
                                  <span id="loader"><i class="fa fa-spinner fa-1x fa-spin"></i><font style="color: #007bff" size="2px">Pilih Nama Pegawai Dahulu</font></span>
                                </div>
                            </div>
                            
<!---------------------------------------------ngulang form -------------------------------------------------------------------->
                        <?php for ($i = 1; $i <= $jumlah_form; $i++) { ?>

                            <div class="col-md-4" data-toggle="penjelasan" title="Pilih Nama Pegawai Yang Akan Didaftarkan Dalam Pengajuan Surat Tugas">
                              <div class="form-group">
                                <label for="nama_pegawai">Nama Pegawai :<font color="red" size="2px">*</font><?php echo $i; ?></label>
                                <div class="has-error">
                                      <select class="form-control selectp" id="pegawai{{ $i }}" name="pegawai[]" required="" >
                                          <option value="">------Pilih Nama Pegawai-----</option>
                                          @foreach ($list_pegawai as $item_pegawai)
                                          <option value="{{$item_pegawai->id_pegawai}}">{{$item_pegawai->nama_karyawan}}</option>

                                        
                                          @endforeach

                                      </select>
                                  <small class="help-block"></small>
                                </div>
                              </div>
                            </div>   

                            <div class="col-md-4" data-toggle="penjelasan" title="Pilih Sesuai Kebutuhan Nidn Atau Nip Dalam Pengajuan Surat Tugas">
                                <div class="form-group">
                                  <label for="nipnidn">NIP/NIDN :<font color="red" size="2px">*</font></label>
                                  <select id="snipnidn{{ $i }}" name="nipnidn[]" class="form-control selectnipnidn" required="" >
                                    <option value="">Pegawai Mungkin Memiliki NIP dan NIDN</option>
                                  
                                  </select>
                                  <font style="color: #007bff" size="2px">*Pegawai Mungkin Memiliki NIP/NIDN</font><br>
                                  <span id="loadernip{{ $i }}"><i class="fa fa-spinner fa-1x fa-spin"></i><font style="color: #007bff" size="2px">Pilih Nama Pegawai Dahulu</font></span>
                                </div>
                            </div>

                            <div class="col-md-4"  data-toggle="penjelasan" title="Pilih Jabatan Peserta Dalam Pengajuan Surat Tugas">
                                <div class="form-group">
                                  <label for="jabatan">Jabatan Pegawai :<font color="red" size="2px">*</font></label>
                                  <select id="sjabatan{{ $i }}" name="jabatan[]" class="form-control selectj" required="" >
                                    <option value="">Pegawai Mungkin Memiliki 1 Atau Lebih Jabatan</option>
                                  
                                  </select>
                                  <font style="color: #007bff" size="2px">*Pegawai Mungkin Memiliki Lebih Dari 1 Jabatan</font><br>
                                  <span id="loader{{ $i }}"><i class="fa fa-spinner fa-1x fa-spin"></i><font style="color: #007bff" size="2px">Pilih Nama Pegawai Dahulu</font></span>
                                </div>
                            </div>

                       <?php  }  ?>
<!---------------------------------------------ngulang form -------------------------------------------------------------------->
                    </div>
                      <p>Tanda "<font color="red" size="5px">*</font>"Inputan Dibutuhkan</p>
                    </div>
                  <!-- /.card-body -->

                  <div class="card-footer" style="float: right;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{{ action('SuratTugas\SuratTugasController@index') }}}" title="Cancel">
                      <span class="btn btn-danger"><i class="fa fa-back"> Back </i></span>
                    </a>  
                  </div>
                
              </form>
            </div>
        </div><!-- /.row (main row) -->
    </div>
</div>

@endsection
@section('script')


<?php for ($ia = 1; $ia <= $jumlah_form; $ia++) { ?>
<script type="text/javascript">
 var ia = "<?php echo $ia ?>";           
  jQuery( document ).ready(function($){
      $('#pegawai<?php echo $ia; ?>').on('change', function(){
              $.post('{{ URL::to('/dropdown') }}', {
                  type: 'jabatan', 
                  _token: "{{ csrf_token() }}",
                  id: $('#pegawai<?php echo $ia; ?>').val(),

                  beforeSend: function() {
                    $("#loader<?php echo $ia; ?>").show();
                  },

                  success: function(msg) {
                    $("#loader<?php echo $ia; ?>").hide();

                  },
                }, 
                function(e){
                  $('#sjabatan<?php echo $ia; ?>').html(e);
              });
          });
    });

    jQuery( document ).ready(function($){
      $('#pegawai<?php echo $ia; ?>').on('change', function(){
            $.post('{{ URL::to('/dropdownnipnidn') }}', {
                type: 'nipnidn', 
                _token: "{{ csrf_token() }}",
                id: $('#pegawai<?php echo $ia; ?>').val(),

                beforeSend: function() {
                  $("#loadernip<?php echo $ia; ?>").show();
                 
                },

                success: function(msg) {
                    $("#loadernip<?php echo $ia; ?>").hide();
                  

                },
              }, 
              function(e){
                $('#snipnidn<?php echo $ia; ?>').html(e);
            });
        });
    });
</script>
<?php } ?>

<script type="text/javascript">
jQuery( document ).ready(function($){
  $('#pegawai').on('change', function(){
          $.post('{{ URL::to('/dropdown') }}', {
              type: 'jabatan', 
              _token: "{{ csrf_token() }}",
              id: $('#pegawai').val(),

              beforeSend: function() {
                $("#loader").show();
              },

              success: function(msg) {
                  $("#loader").hide();

              },
            }, 
            function(e){
              $('#sjabatan').html(e);
          });
      });
});

jQuery( document ).ready(function($){
  $('#pegawai').on('change', function(){
        $.post('{{ URL::to('/dropdownnipnidn') }}', {
            type: 'nipnidn', 
            _token: "{{ csrf_token() }}",
            id: $('#pegawai').val(),

            beforeSend: function() {
              $("#loadernip").show();
             
            },

            success: function(msg) {
                $("#loadernip").hide();
              

            },
          }, 
          function(e){
            $('#snipnidn').html(e);
        });
    });
});


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

<script type="text/javascript">

function onSelectChange(){
 document.getElementById('hitungform').submit();
}

$(function () {
  $('[data-toggle="penjelasan"]').tooltip()
  
})
</script>

<style>
.tooltip-inner {
    min-width: 350px; /* the minimum width */
}
</style>

@include('sweet::alert')
@endsection
