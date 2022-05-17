@extends('admin.layout.master')

@section('content')
<br>

<?php if(cek_akses('42') == 'yes'){
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

  <!-- /.content-header -->
  <!-- /.content-header -->

<div class="container-fluid">
  <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <form role="form" id="hitungform" method="POST" action="{{ url('/tambahsurattugas') }}">
                @csrf
                <div class="col-md-3"style="float: right;">
                      <select name="loopingform" class="form-control selectj" onchange="onSelectChange();">
                        <option value="">------Tambah Jumlah Peserta------</option>
                        <option value="0">Hanya Saya Sendiri</option>
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
            <h3 class="card-title">PENGAJUAN SURAT TUGAS</h3>
          </div>
          
          <!-- /.card-header -->
              <!-- form start -->
          <form id="formProdiEdit" class="form-horizontal" role="form" method="POST" action="{{ url('/simpansrt') }}" enctype="multipart/form-data">
            <div class="card-body">

                    <div class="row">
                      <!--tambah form-->
                      @csrf
                        <div class="col-md-4">
                              <div class="form-group">
                                <label for="nama_pegawai">Nama Pegawai :<font color="red" size="2px">*</font></label>
                                <div class="has-error">
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

                            <div class="col-md-4">
                                <div class="form-group" >
                                  <label for="nipnidn">NIP/NIDN :<font color="red" size="2px">*</font></label>
                                  <select id="snipnidn" name="nipnidn[]" class="form-control selectnipnidn" required="" >
                                    <option value="">Pegawai Mungkin Memiliki NIP dan NIDN</option>
                                  
                                  </select>
                                  <font style="color: #007bff" size="2px">*Pegawai Mungkin Memiliki NIP/NIDN</font><br>
                                  <span id="loadernip"><i class="fa fa-spinner fa-1x fa-spin"></i><font style="color: #007bff" size="2px">Pilih Nama Pegawai Dahulu</font></span>
                                </div>
                            </div>

                            <div class="col-md-4">
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

                            <div class="col-md-4">
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

                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="nipnidn">NIP/NIDN :<font color="red" size="2px">*</font></label>
                                  <select id="snipnidn{{ $i }}" name="nipnidn[]" class="form-control selectnipnidn" required="" >
                                    <option value="">Pegawai Mungkin Memiliki NIP dan NIDN</option>
                                  
                                  </select>
                                  <font style="color: #007bff" size="2px">*Pegawai Mungkin Memiliki NIP/NIDN</font><br>
                                  <span id="loadernip{{ $i }}"><i class="fa fa-spinner fa-1x fa-spin"></i><font style="color: #007bff" size="2px">Pilih Nama Pegawai Dahulu</font></span>
                                </div>
                            </div>

                            <div class="col-md-4">
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
                 
                    <br>

                    <div class="row">
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="kategori_kegiatan">kategori Kegiatan :<font color="red" size="2px">*</font></label>
                            <div class="has-error">
                                  <select class="form-control selectk" name="kategori_kegiatan" required="" >
                                      <option value="">------Pilih Nama Kategori-----</option>
                                      @foreach ($list_kategori as $item_kategori)
                                      <option value="{{$item_kategori->id_kategori}}">{{$item_kategori->nama_kategori}}</option>
                                      @endforeach
                                  </select>
                              <small class="help-block"></small>
                            </div>
                            <font style="color: #007bff" size="2px">*Ditugaskan Sebagai Juri,Narasumber Dll</font><br>
                          </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                              <label for="nama_kegiatan">Nama Kegiatan :<font color="red" size="2px">*</font></label>
                              <textarea class="form-control" id="nama_kegiatan" name="nama_kegiatan" placeholder="Penganugrahan Pemenang Entrepreneurship Award III 2019" required="" ></textarea>
                              <font style="color: #007bff" size="2px">*Nama Kegiatan Yang di Ikuti</font><br>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                              <label for="tempat_pelaksana">Tempat Pelaksanaan :<font color="red" size="2px">*</font></label>
                              <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Politeknik Negeri Batam" required="" autocomplete="off">
                              <font style="color: #007bff" size="2px">*Lokasi/Tempat Pelaksanaan Kegiatan</font><br>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                              <label for="diselenggarakan oleh">Diselenggarakan Oleh :<font color="red" size="2px">*</font></label>
                              <textarea class="form-control" id="diselenggarakan_oleh" name="diselenggarakan_oleh" placeholder="KEMENTRIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI UNIVERSITAS PADANG" required="" ></textarea>
                              <font style="color: #007bff" size="2px">*Instansi Terkait Yang Menyelenggarakan Kegiatan</font><br>
                            </div>
                        </div>


                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Tanggal :<font color="red" size="2px">*</font></label>

                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                              </div>
                              <input type="text" name="waktu_kegiatan" class="form-control float-right" id="reservationtime" readonly="" required="" >
                            </div>
                            <font style="color: #007bff" size="2px">*Tanggal Pelaksanaan Kegiatan </font><br><hr>
                             <div class="icheck-danger d-inline">
                              <input type="checkbox" id="jamkegiatan" onclick="javascript:houseclean();">
                              <label for="jamkegiatan">
                                Punya Jam Kegiatan ?
                              </label><br><hr>
                            </div>
                          </div>
                        </div>
                        
                        <div class="col-md-6" id="jammulai" style="display: none;">
                          <div class="form-group">
                            <label>Jam Kegiatan Mulai:</label>
                              <input type="text" class="timepicker form-control" id="jam_mulai_id" name="jam_kegiatan_mulai" readonly disabled="" />
                            <!-- /.input group -->
                            <font style="color: #007bff" size="2px">Biarkan Default <b>00:00</b> Jika Tidak Memiliki Jam Kegiatan</font><br>
                          </div>
                          <!-- /.form group -->
                        </div>

                        <div class="col-md-6" id="jamselesai" style="display: none;">
                          <div class="form-group">
                            <label>Jam Kegiatan Selesai:</label>
                              <input type="text" class="timepicker2 form-control" id="jam_selesai_id" name="jam_kegiatan_selesai" readonly disabled="" />
                            <!-- /.input group -->
                            <font style="color: #007bff" size="2px">Biarkan Default <b>00:00</b> Jika Tidak Memiliki Jam Kegiatan</font><br><hr>
                            <div class="icheck-danger d-inline">
                              <input type="checkbox" id="checkboxPrimary3" value="00:00:00" name="sdselesai" onclick="javascript:houseclean2();">
                              <label for="checkboxPrimary3">
                                Saya Tidak Memiliki Jam Selesai
                              </label><br>
                              <font style="color: #007bff" size="2px">Contoh : <b>08:00 WIB</b> s.d <b>Selesai</b></font>
                            </div>
                          </div>
                          <!-- /.form group -->
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Upload File Pendukung <font style="color: red" size="2px">*file yang diizinkan .pdf .jpg .png </font><br></label>
                              <div class="custom-file">

                                <input type="file"  class="size form-control" id="someId" name="files[]" required=""  autofocus multiple>
                               
                              </div>
                            <font style="color: #007bff" size="2px">*Berkas Pendukung Yang Telah Di Acc</font><br>
                          </div>
                        </div>                   

                      </div>
                      <p>Tanda "<font color="red" size="5px">*</font>"Inputan Dibutuhkan</p>
                  <!-- /.card-body -->
                    </div>
                  <!-- /.card-body -->

                  <div class="card-footer" style="float: right;">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{{ action('SuratTugas\SuratTugasController@index') }}}" title="Cancel">
                      <span class="btn btn-danger"><i class="fa fa-back"> Cancel </i></span>
                    </a>  
                  </div>
                
              </form>
            </div>
        </div><!-- /.row (main row) -->
    </div>
</div>

@endsection
@section('script')

<script type="text/javascript">
  jQuery( document ).ready(function($){
   //Date range picker
    $('#reservationtime').daterangepicker({
      //timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'YYYY-MM-DD',
      }
    })
  })
</script>


<script type="text/javascript">
   function houseclean()
    {
    if (document.getElementById('jamkegiatan').checked == true)
      {
      $("#jammulai").show();
      $("#jamselesai").show();
      document.getElementById('jam_mulai_id').removeAttribute('disabled');
      document.getElementById('jam_selesai_id').removeAttribute('disabled');
      $("#checkboxPrimary3").prop('checked', false); 
      }
    else
      {
      $("#jammulai").hide();
      $("#jamselesai").hide();
      document.getElementById('jam_mulai_id').setAttribute('disabled','disabled');
      document.getElementById('jam_selesai_id').setAttribute('disabled','disabled');
      }
    }

</script>

<script type="text/javascript">
   function houseclean2()
    {
    if (document.getElementById('checkboxPrimary3').checked == true)
      {
      $("#jamselesai").hide();
      document.getElementById('jam_selesai_id').setAttribute('disabled','disabled');
      }
    else
      {
      $("#jam_selesai_id").show();
      document.getElementById('jam_selesai_id').removeAttribute('disabled','disabled');
      }
    }

</script>


<script type="text/javascript">
    $('.timepicker').timepicker({
      timeFormat: 'HH:mm:ss',
      interval: 30,
      minTime: '24',
      maxTime: '23:59pm',
      defaultTime: '00:00am',
      startTime: '00:00am', 
      dynamic: false,
      dropdown: true,
      scrollbar: true
  });
</script>
<script type="text/javascript">
    $('.timepicker2').timepicker({
      timeFormat: 'HH:mm:ss',
      interval: 30,
      minTime: '24',
      maxTime: '23:59pm',
      defaultTime: '00:00am',
      startTime: '00:00am',
      dynamic: false,
      dropdown: true,
      scrollbar: true
  });
</script>

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
var file = document.getElementById('someId');

file.onchange = function() {
   for (var i = 0; i < file.files.length; i++) {

        if(this.files[i].size > 2097152){
           swal( file.files.item(i).name  +  "", "File Mungkin Lebih 2MB!", "error");
           this.value = "";

        }
        var ext = file.files[i].name.substr(-3);
        if(ext!== "jpg" && ext!== "PNG"  && ext!== "png" && ext!== "PDF" && ext!== "pdf")  {
            swal( file.files.item(i).name  +  "", "Extention File Mungkin Tidak Diizinkan", "error");
            this.value = '';
        }else{
            alert( file.files.item(i).name  + ", File Diizinkan");
        }
      }

      function getFile(filePath) {
          return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
      }
};
</script>
<script type="text/javascript">

</script>

<script type="text/javascript">

function onSelectChange(){
 document.getElementById('hitungform').submit();
}

$(function () {
  $('[data-toggle="penjelasan"]').tooltip()
  
})
</script>


<script type="text/javascript">
    var path1 = "{{ route('autocomplete') }}";
    $('#nama_kegiatan').typeahead({
        source:  function (query, process) {
        return $.get(path1, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>

<script type="text/javascript">
    var path = "{{ route('autocomplete2') }}";
    $('#diselenggarakan_oleh').typeahead({
        source:  function (query, process) {
        return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });
</script>
 
<style>
.tooltip-inner {
    min-width: 350px; /* the minimum width */
}
</style>

@include('sweet::alert')
@endsection
