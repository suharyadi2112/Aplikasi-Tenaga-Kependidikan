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
<div class="uk-alert uk-alert-error" data-uk-alert>
    <a href="" class="uk-alert-close uk-close"></a>
    @if ($message = Session::get('error'))

    <div class="alert alert-error alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-exclamation-circle"></i> Alert!</h5>
      <strong>{{ $message }}</strong>
    </div>
    @endif
</div>

<div class="container-fluid">
  <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Berkas Pengajuan</h3>
          </div>
            <!-- /.card-header -->
              <!-- form start -->
              <form id="formProdiEdit" class="form-horizontal" role="form" method="POST" action="{{ url('/simpan/'.encrypt($id_surattugas_fk).'/berkas') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                      <div class="col-md-4"  data-toggle="penjelasan" title="File Pendukung Yang Akan Periksa Pada Bagian Kepegawaian, Yang Sudah Disetujui Pihak Terkait">
                            <div class="form-group">
                              <label>Upload File Pendukung <font style="color: red" size="2px">*file yang diizinkan .pdf .jpg .png </font><br></label>
                                <div class="custom-file">

                                  <input type="file"  class="size form-control" id="someId" name="files[]" required=""  autofocus multiple>
                                 
                                </div>
                              <font style="color: #007bff" size="2px">*Berkas Pendukung Yang Telah Di Acc Pihak Terkait</font><br>
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
