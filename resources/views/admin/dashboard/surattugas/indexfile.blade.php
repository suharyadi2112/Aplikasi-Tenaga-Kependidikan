
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
<div class="uk-alert uk-alert-success" data-uk-alert>
    <a href="" class="uk-alert-close uk-close"></a>
    @if ($message = Session::get('successMessage'))

    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-check"></i> Alert!</h5>
      <strong>{{ $message }}</strong>
    </div>
    @endif
</div>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Berkas Pengajuan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Berkas</li>
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
              <a href="{{ url('surattugas') }}" class="btn bg-warning btn-flat btn-sm" data-id=""><i class="fa fa-arrow-left"></i>Kembali</a>
              @if(Auth::user()->level == "1")
                <a href="{{ url('/tambah/'.encrypt($id_surattugas).'/berkas') }}" class="btn bg-navy btn-flat btn-sm" data-id=""><i class="fa fa-fw fa-plus"></i>Tambah Berkas Pendukung
                </a><br><br>
              @endif
              <thead>
              <tr>
                <th>Nama Berkas</th>
                <th>Size</th>
                <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                 @forelse ($list_berkas as $item_berkas)
                    <tr>
                        <td>{{ $item_berkas->file_name }}</td>
                        <td>{{ formatSizeUnits($item_berkas->file_size) }}</td>
                        <td>   
                          @if(Auth::user()->level == "1")
                          <a href="{{{ URL::to('download/'.encrypt($item_berkas->id_srt_tgs_fk).'/file/'.$item_berkas->file_name.'') }}}">
                                <button class="btn btn-success btn-xs"><span class="fa fa-file-download"> Unduh File</span></button>
                          </a> 
                          @endif
                          @if(Auth::user()->level == "2")
                          <a href="{{{ URL::to('download/'.encrypt($item_berkas->id_srt_tgs_fk).'/berkas/'.$item_berkas->file_name.'') }}}">
                                <button class="btn btn-success btn-xs"><span class="fa fa-file-download"> Unduh File</span></button>
                          </a> 
                          @endif
                          @if(Auth::user()->level == "1")
                          | 
                          <a href="{{{ URL::to('/hapus/'.encrypt($item_berkas->id_file).'/file/'.encrypt($id_surattugas).'') }}}" onclick="return confirm('Apakah anda yakin akan menghapus File Ini {{{$item_berkas->file_name .' - '.formatSizeUnits($item_berkas->file_size) }}}?')">
                                <button class="btn btn-danger btn-xs"><span class="fa fa-trash"> Hapus File</span></button>
                          </a> 
                          @endif
                        </td>
                    </tr>
                  @empty
                  <tr>
                    <td colspan="10">
                      <center>Tidak Ada Berkas Apapun</center>
                    </td>
                  </tr>
                  @endforelse
              </tbody>
              <tfoot>
              <tr>
                <th style="">Nama Berkas</th>
                <th style="">Size</th>
                <th style="">Aksi</th>
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

<?php 
function formatSizeUnits($bytes){
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }
        return $bytes;
}

?>

@endsection
@section('script')

@include('sweet::alert')
@endsection
