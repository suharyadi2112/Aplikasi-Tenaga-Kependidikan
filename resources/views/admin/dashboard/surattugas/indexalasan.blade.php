
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
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Alasan Ditolak</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Alasan</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
  <!-- /.content-header --> 
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
             <table id="datatablespeserta" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Alasan Ditolak</th>
               
              </tr>
              </thead>
              <tbody>
                 @forelse ($list_alasan as $item_alasan)
                    <tr>
                        <td>{{ $item_alasan->keterangan }}</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="10"><center>Tidak Ada Data Peserta, Tambah Peserta Untuk mengisi </center></td>
                    </tr>
                  @endforelse
                    
              </tbody>
              <tfoot>
              <tr>
                <th>Alasan Ditolak</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</div>
@endsection
@section('script')

@include('sweet::alert')
@endsection
