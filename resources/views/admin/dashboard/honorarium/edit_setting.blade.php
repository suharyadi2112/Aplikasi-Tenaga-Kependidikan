@extends('admin.layout.master')

@section('content')
<?php if(cek_akses('90') == 'yes'){
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

<div class="container-fluid"> 
    <div class="row">
      <div class="col-12">

        
        @if ($message = Session::get('success'))
           <div class="uk-alert uk-alert-success" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
             
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $message }}</strong>
              </div>
              
          </div>
        @endif

        @if ($message = Session::get('error'))
           <div class="uk-alert uk-alert-error" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
             
              <div class="alert alert-error alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $message }}</strong>
              </div>
              
          </div>
        @endif

        <div class="card card-info">
          <div class="card-header">
          
            <h3 class="card-title">Edit</h3>
          </div>

          <div class="card-body">
          <form action="{{ route('put_set_honor') }}" role="form" method="POST" accept-charset="utf-8"> 
          @csrf


          <input type="hidden" name="id_honor" value="{{ $honor->id_honor }}">


                  <div class="card card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <label>Nama Dosen :<font color="red" size="2px">* </font></label>

                        <div class="input-group">
                            <input type="text" name="jabatan_fungsional" class="form-control" value="{{ $honor->nama_karyawan }}"  placeholder="Asisten Ahli" required="" readonly="">
                        </div>
                      </div>
                     
                    </div>
                  </div>


                  <div class="card card-body">
                    <div class="row">
                      <div class="col-md-12">

                        <label>Jabatan Fungsional  :<font color="red" size="2px">*</font></label>
                        <div class="input-group">
                          <input type="text" name="jabatan_fungsional" class="form-control" value="{{ $honor->jabatan_fungsional }}"  placeholder="Asisten Ahli" required="">
                        </div>

                        <label>Pembimbing Tugas Akhir Pertama :<font color="red" size="2px">*</font></label>
                        <div class="input-group">
                          <input type="number" name="pta1" class="form-control" value="{{ $honor->p_t_a_satu}}" required="" placeholder="100000">
                        </div>

                        <label>Pembimbing Tugas Akhir kedua :<font color="red" size="2px">*</font></label>
                        <div class="input-group">
                          <input type="number" name="pta2" class="form-control" value="{{$honor->p_t_a_dua }}" required="" placeholder="100000">
                        </div>


                        <label>Penguji Tugas Akhir :<font color="red" size="2px">*</font></label>
                        <div class="input-group">
                          <input type="number" name="peng_ta" class="form-control" value="{{ $honor->p_tugas_akhir}}" required="" placeholder="100000">
                        </div>

                        <label>Penguji Seminar Proposal Tugas Akhir :<font color="red" size="2px">*</font></label>
                        <div class="input-group">
                          <input type="number" name="peng_s_ta" class="form-control" value="{{ $honor->p_seminar_p_t_a}}" required="" placeholder="100000">
                        </div>

                        <label>Pembimbing Kerja Praktik :<font color="red" size="2px">*</font></label>
                        <div class="input-group">
                          <input type="number" name="pkp" class="form-control" value="{{$honor->pkp }}" required="" placeholder="100000">
                        </div>

                      </div>
                    </div>
                  </div>  

                  <a href="{{ Route('setting_honorarium') }}"><button type="button" class="btn btn-danger"><span class="fa fa-arrow-left"></span> Back</button></a>
                  <button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span> Edit</button>
            
            </form> 
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</div>
</div>




@endsection
@section('script')
<script type="text/javascript">
	$('.select').select2({
      theme: 'bootstrap4'
    });
</script>
@include('sweet::alert')
@endsection
