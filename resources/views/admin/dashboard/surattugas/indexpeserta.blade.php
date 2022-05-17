
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
        <h1 class="m-0 text-dark">Peserta</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Peserta</li>
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
                <a href="{{ url('surattugas') }}" class="btn bg-warning btn-flat btn-sm" data-id=""><i class="fa fa-arrow-left"></i>Kembali
                </a>
              @if(Auth::user()->level == "1")
                <a href="{{ url('/tambah/'.encrypt($id_surattugas_fk).'/peserta') }}" class="btn bg-navy btn-flat btn-sm" data-id=""><i class="fa fa-fw fa-plus"></i>Tambah Peserta
              </a>
              <br><br>
              @endif
              <thead>
              <tr>
                <th style="width: 200px;">Nama Pegawai</th>
                <th style="width: 200px;">NIP</th>
                <th style="width: 500px;">NIDN</th>
                <th style="width: 500px;">Nama Jabatan</th>
                @if(Auth::user()->level == "1")
                <th style="width: 500px;">Aksi</th>
                @endif
                </tr>
              </thead>
              <tbody>
                 @forelse ($list_peserta as $item_peserta)
                    <tr>
                        <td>{{ $item_peserta->nama_karyawan }}</td>
                        <td>{{ $item_peserta->nipp }}</td>
                        <td>{{ $item_peserta->nidnp }}</td>
                        <td>{{ $item_peserta->nama_jabatanp }}</td>
                        @if(Auth::user()->level == "1")
                        <td>
                          <a href="{{ url('/hapus/'.encrypt($item_peserta->id_peserta).'/peserta/'.encrypt($item_peserta->id_surattugas_fk).'') }}" title="hapus" onclick="return confirm('Apakah anda yakin akan menghapus Peserta {{{$item_peserta->nipp .' - '.$item_peserta->nama_karyawan }}}?')">
                          <button type="button" class="btn btn-danger btn-xs"><span class="fa fa-trash"> Hapus Peserta </span></button>
                          </a>
                        </td>  
                        @endif 
                    </tr>
                    @empty
                    <tr>
                      <td colspan="10"><center>Tidak Ada Data Peserta, Tambah Peserta Untuk mengisi </center></td>
                    </tr>
                  @endforelse
                    
              </tbody>
              <tfoot>
              <tr>
                <th style="width: 200px;">Nama Pegawai</th>
                <th style="width: 200px;">NIP</th>
                <th style="width: 500px;">NIDN</th>
                <th style="width: 500px;">Nama Jabatan</th>
                @if(Auth::user()->level == "1")
                <th style="width: 500px;">Aksi</th>
                @endif
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
