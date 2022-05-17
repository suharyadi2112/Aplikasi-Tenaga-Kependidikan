
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
            <h3 class="card-title">Data Pengelompokan</h3>
          </div>

          <div class="card-body">
            <div class="table-responsive">
            <table id="cek_penilaian" class="table table-striped table-bordered display">
              <thead>
              <tr>
                <th nowrap="">Nama Pegawai</th> 
              </tr>
              @forelse($kelompok as $key => $show_kelompok)
              <tr>
                <td>{{ $show_kelompok->nama_lengkap }}</td>
              </tr>
              @empty
              <tr>
                <td>Tidak Ada Data</td>
              </tr>
              @endforelse
              </thead>
            </table>
          </div>
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


@include('sweet::alert')
@endsection