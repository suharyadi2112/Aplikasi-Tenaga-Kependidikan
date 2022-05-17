@extends('admin.layout.master')

@section('content')

<?php if(cek_akses('43') == 'yes'){
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
  <!-- /.content-header -->
  <!-- /.content-header -->

<div class="container-fluid">
  <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
           
            <h3 class="card-title">EDIT SURAT TUGAS</h3>
          </div>
          
          <!-- /.card-header -->
              <!-- form start -->
          <form id="formProdiEdit" class="form-horizontal" role="form" method="POST" action="{{ url('/surattugas/'.$id_surattugas.'/ubah') }}" enctype="multipart/form-data">
            <div class="card-body">
              @csrf
                  <input type="hidden" name="_method" value="PUT">
                  <input type="hidden" name="id_surattugas" value="{{$id_surattugas}}" >


                    <div class="row">
                      <div class="col-md-4" data-toggle="penjelasan" title="Peserta Memilih Sebagai Apa Dalam Mengikuti Kegiatan Tersebut, Sebagai Narasumber, Pemakalah Atau Yang Lainnya">
                          <div class="form-group">
                            <label for="kategori_kegiatan">kategori Kegiatan :<font color="red" size="2px">*</font></label>
                            <div class="has-error">
                                  <select class="form-control selectk" name="kategori_kegiatan" required="" >
                                        @foreach ($list_kategori as $item_kategori)
                                        <option @if ($item_kategori->id_kategori == $kategori_fk) selected @endif" value="{{$item_kategori->id_kategori}}">{{$item_kategori->nama_kategori}}</option>
                                        @endforeach
                                  </select>

                              <small class="help-block"></small>
                            </div>
                            <font style="color: #007bff" size="2px">*Ditugaskan Sebagai Juri,Narasumber Dll</font><br>
                          </div>
                        </div>

                        <div class="col-md-8" data-toggle="penjelasan" title="Nama Kegiatan Yang Diikuti Peserta Sebagai Contoh 'Penganugrahan Pemenang Entrepreneurship Award III 2019' Atau Yang Lainya">
                            <div class="form-group">
                              <label for="nama_kegiatan">Nama Kegiatan :<font color="red" size="2px">*</font></label>
                              <textarea class="form-control" id="nama_kegiatan" name="nama_kegiatan" required="" >{{ $nama_kegiatan }}</textarea>
                              <font style="color: #007bff" size="2px">*Nama Kegiatan Yang di Ikuti</font><br>
                            </div>
                        </div>

                        <div class="col-md-4" data-toggle="penjelasan" title="Lokasi Saat Berlangsungnya Kegiatan">
                            <div class="form-group">
                              <label for="tempat_pelaksana">Tempat Pelaksanaan :<font color="red" size="2px">*</font></label>
                              <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $lokasi }}" required="" autocomplete="off">
                              <font style="color: #007bff" size="2px">*Lokasi/Tempat Pelaksanaan Kegiatan</font><br>
                            </div>
                        </div>

                        <div class="col-md-8" data-toggle="penjelasan" title="Instansi Terkait Yang Menyelenggarakan Kegiatan Yang Akan Diikuti">
                            <div class="form-group">
                              <label for="diselenggarakan oleh">Diselenggarakan Oleh :<font color="red" size="2px">*</font></label>
                              <textarea class="form-control" id="diselenggarakan_oleh" name="diselenggarakan_oleh" required="" >{{ $penyelengara }} </textarea>
                              <font style="color: #007bff" size="2px">*Instansi Terkait Yang Menyelenggarakan Kegiatan</font><br>
                            </div>
                        </div>

                        <div class="col-md-4" data-toggle="penjelasan" title="Tanggal Berlangsungnya Kegiatan Yang Diikuti">
                          <div class="form-group">
                            <label>Tanggal Kegiatan :<font color="red" size="2px">*</font></label>

                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                              </div>
                              <input type="text" name="tanggal_kegiatan" class="form-control float-right" id="reservationtime" readonly="" required="" >
                            </div>
                            <font style="color: #007bff" size="2px">*Tanggal dan Jam Pelaksanaan Kegiatan </font><br>
                          </div>
                        </div>

                        <div class="col-md-4" data-toggle="penjelasan" title="Jam Berlangsungnya Kegiatan Yang Diikuti">
                          <div class="form-group">
                            <label>Jam Kegiatan Mulai:<font color="red" size="2px">*</font></label>
                              <input type="text" class="timepicker form-control" name="jam_kegiatan_mulai" readonly />
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->
                        </div>
                        <div class="col-md-4" data-toggle="penjelasan" title="Jam Berlangsungnya Kegiatan Yang Diikuti">
                          <div class="form-group">
                            <label>Jam Kegiatan Selesai:<font color="red" size="2px">*</font></label>
                              <input type="text" class="timepicker2 form-control" name="jam_kegiatan_selesai" readonly />
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->
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
   
    $('#reservationtime').daterangepicker({
      startDate: "{{ $tanggal_kegiatan_mulai }}",
      endDate: "{{ $tanggal_kegiatan_selesai }}",
      locale: {
        format: 'YYYY-MM-DD'
      }

    })
    //$("#reservationtime").daterangepicker("setDate", "2018-08-16 11:00:00 AM 2018-08-16 11:00:00 AM");

  })
</script>

<script type="text/javascript">
    $('.timepicker').timepicker({
      timeFormat: 'HH:mm:ss',
      interval: 30,
      minTime: '24',
      maxTime: '23:59pm',
      defaultTime: '11',
      startTime: '00:00am', 
      dynamic: false,
      dropdown: true,
      scrollbar: true
  }).val('{{ $jam_kegiatan_mulai }}');
</script>
<script type="text/javascript">
    $('.timepicker2').timepicker({
      timeFormat: 'HH:mm:ss',
      interval: 30,
      minTime: '24',
      maxTime: '23:59pm',
      defaultTime: '11',
      startTime: '00:00am',
      dynamic: false,
      dropdown: true,
      scrollbar: true
  }).val('{{ $jam_kegiatan_selesai }}');
</script>

<script type="text/javascript">

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
