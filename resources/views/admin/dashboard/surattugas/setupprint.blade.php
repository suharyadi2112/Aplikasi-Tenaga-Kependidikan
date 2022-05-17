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
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Setup Print</h3>
          </div>
          
          <!-- /.card-header -->
              <!-- form start -->
          <form id="" class="form-horizontal" role="form" method="POST" target="_blank" action="{{ url('/cetak/'.encrypt($id_surattugas).'/surat') }}" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                  @csrf
                      <div class="col-md-4">
                          <div class="form-group">
                            <label for="surat_tugas">Nomor Surat Tugas :<font color="red" size="2px">*</font></label>
                            <div class="has-error"  data-toggle="penjelasan" title="Nomor Surat">
                                 <input type="text" id="nosurat" value="{{ $no_surat->nomor_surat }}" name="no_surat" class="form-control" autocomplete="off" placeholder="Ketik Angka 0 Untuk Melihat No Surat Terakhir" required="">
                              <small class="help-block"></small>
                            </div>
                          </div>
                      </div>   
                </div>
                <div class="row">
                  <div class="col-md-8">
                    <div class="form-group">
                      <div class="mb-3">
                        <label for="surat_tugas">Kategori Tambahan <font color="red" size="2px">*Contoh Kategori Sebagai Juri : Bidang Lomba "IT Network System Administration" </font> <font color="blue" size="2px">*Kosongkan Jika Tidak Perlu:</font></label>
                        <textarea class="textarea" placeholder="Place some text here" name="kategori_tambahan" 
                                  style="font-size: 12px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        </textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                      <div class="form-group clearfix">
                        <label for="surat_tugas">Pengabdian <font color="red" size="2px">* </font>:</label>
                        <div class="icheck-success d-inline">
                          <input type="radio" name="pengabdian" value="pengabdian kepada masyarakat" checked id="radioDanger1">
                          <label for="radioDanger1">
                            Ya
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" name="pengabdian" value="" id="radioDanger2">
                          <label for="radioDanger2">
                            Tidak
                          </label>
                        </div>
                       </div>
                    </div>   
                  <!-- /.card-body -->
                  </div>
                  <!-- /.card-body -->
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group clearfix">
                        <label for="surat_tugas">Nomor Pegawai <font color="red" size="2px">* </font>:</label>
                        <div class="icheck-success d-inline">
                          <input type="radio" name="th_nomor_pegawai" value="NIP" checked id="radioDanger3">
                          <label for="radioDanger3">
                            NIP
                          </label>
                        </div>
                        <div class="icheck-primary d-inline">
                          <input type="radio" name="th_nomor_pegawai" value="NIDN" id="radioDanger4">
                          <label for="radioDanger4">
                            NIDN
                          </label>
                        </div>
                       </div>
                    </div>   
                  <!-- /.card-body -->
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group clearfix">
                        <label for="ttd">TTD Pak Krisdarjono <font color="red" size="2px">* </font>:</label>
                        <div class="icheck-success d-inline">
                          <input type="radio" name="ttd" value="1" checked id="radioDanger5">
                          <label for="radioDanger5">
                            Gunakan
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" name="ttd" value="0" id="radioDanger6">
                          <label for="radioDanger6">
                            Tidak
                          </label>
                        </div>
                       </div>
                    </div>   
                  <!-- /.card-body -->
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group clearfix">
                        <label for="ttd">Tempat Dilaksanakan <font color="red" size="2px">* </font>:</label>
                        <div class="icheck-primary d-inline">
                          <input type="radio" name="posisi" value="tempat dilaksanakan di" checked id="TempatDilaksanakan1">
                          <label for="TempatDilaksanakan1">
                            tempat dilaksanakan di
                          </label>
                        </div>
                        <div class="icheck-primary d-inline">
                          <input type="radio" name="posisi" value="dengan menggunakan" id="TempatDilaksanakan2">
                          <label for="TempatDilaksanakan2">
                            dengan menggunakan
                          </label>
                        </div>
                       </div>
                    </div>   
                  <!-- /.card-body -->
                  </div>

                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group clearfix">
                        <label for="ttd">Jarak Enter <font color="red" size="2px">* </font>:</label>
                        <div class="icheck-info d-inline">
                          <input type="radio" name="jumlahloop" value="0" checked id="radioDanger0">
                          <label for="radioDanger0">
                            0 
                          </label>
                        </div>
                        <div class="icheck-success d-inline">
                          <input type="radio" name="jumlahloop" value="1" id="radioDanger7">
                          <label for="radioDanger7">
                            1 
                          </label>
                        </div>
                        <div class="icheck-warning d-inline">
                          <input type="radio" name="jumlahloop" value="2" id="radioDanger8">
                          <label for="radioDanger8">
                            2
                          </label>
                        </div>
                        <div class="icheck-primary d-inline">
                          <input type="radio" name="jumlahloop" value="3" id="radioDanger9">
                          <label for="radioDanger9">
                            3
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" name="jumlahloop" value="4" id="radioDanger10">
                          <label for="radioDanger10">
                            4
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" name="jumlahloop" value="5" id="radioDanger11">
                          <label for="radioDanger11">
                            5
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" name="jumlahloop" value="6" id="radioDanger12">
                          <label for="radioDanger12">
                            6
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" name="jumlahloop" value="7" id="radioDanger122">
                          <label for="radioDanger122">
                            7
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" name="jumlahloop" value="8" id="radioDanger123">
                          <label for="radioDanger123">
                            8
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" name="jumlahloop" value="9" id="radioDanger124">
                          <label for="radioDanger124">
                            9
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" name="jumlahloop" value="10" id="radioDanger125">
                          <label for="radioDanger125">
                            10
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" name="jumlahloop" value="12" id="radioDanger126">
                          <label for="radioDanger126">
                            12
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" name="jumlahloop" value="14" id="radioDanger127">
                          <label for="radioDanger127">
                            14
                          </label>
                        </div>
                        <div class="icheck-danger d-inline">
                          <input type="radio" name="jumlahloop" value="16" id="radioDanger128">
                          <label for="radioDanger128">
                            16
                          </label>
                        </div>
                       </div>
                    </div>   
                  <!-- /.card-body -->
                  </div>

                  <div class="card-footer" style="float: right;">
                    <button type="submit" class="btn btn-primary"><span class="fa fa-print"> Print</span></button>
                    <a href="{{{ action('SuratTugas\SuratTugasController@index') }}}" title="Cancel">
                      <span class="btn btn-danger"><i class="fa fa-back"> Cancel </i></span>
                    </a>  
                  </div>
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
jQuery( document ).ready(function( $ ) {
  var path1 = "{{ route('autocompletesurattugas') }}";
  $('#nosurat').typeahead({
      source:  function (query, process) {
      return $.get(path1, { query: query }, function (data) {
              return process(data);
          });
      }
  });
});

</script>
<script>
$("input#nosurat").on({
  keydown: function(e) {
    if (e.which === 32)
      return false;
  },
  change: function() {
    this.value = this.value.replace(/\s/g, "");
  }
});

$(function () {
  $('[data-toggle="penjelasan"]').tooltip({
    animated: 'fade',
    placement: 'bottom',
    html: true
  })
  $('[data-toggle="penjelasan2"]').tooltip({
    animated: 'fade',
    placement: 'bottom',
    html: true
  })
  
})

</script>

<script>
  jQuery( document ).ready(function( $ ) {
    // Summernote
    $('.textarea').summernote();

  })
</script>
 
<style>
.tooltip-inner {
    min-width: 100%; /* the minimum width */
}
</style>



@include('sweet::alert')
@endsection

