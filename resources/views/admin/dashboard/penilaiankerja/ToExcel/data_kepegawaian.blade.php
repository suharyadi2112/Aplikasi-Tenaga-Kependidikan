@extends('admin.layout.master')
@section('content')

<br>

@php
 
function cek_akses($aModul) {

    $level = Auth::user()->level;
    $username = Auth::user()->username;        

    $quser = DB::table('users')->select('level')->where('username','=',$username)->first();
    $qry = DB::table('hak_akses')->select('id')->where([['usergroup','=',$quser->level],['modul','=',$aModul]])->count();

    if (1 > $qry) {
        return "no";
    } else {
        return "yes";
    }

}

@endphp

<div class="card-body">
    <h3><u>Data Diri</u></h3><br>
    <div class="table-responsive">
        <table id="cek_penilaian" class="table table-striped table-bordered">
            <tr>
                <th>Perihal</th>
                <th>Aksi</th>
            </tr>
            <tr>
                <td>
                    Data Diri/Umum
                </td>
                <td>
                    <form action="{{ Route('DataPegawaiExport') }}" method="post">
                        @csrf
                        <input type="hidden" value="1" name="DataPegawaiPenilaianKerja">
                        <button class="btn btn-xs btn-info DownloadDataPegawai" type="submit"><span class="fa fa-download"></span> Download</button>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</div>

@endsection
@section('script')



@include('sweet::alert')
@endsection