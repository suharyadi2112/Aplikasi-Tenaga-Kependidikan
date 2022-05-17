
@extends('admin.layout.master')

@section('content')


<?php if(cek_akses('51') == 'yes'){
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

<div class="content-header" style="padding: 1.5px;">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
       <h3 class="m-0 text-dark">Keranjang Honorarium</h3>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ Route('index_honorarium') }}">Index (Kembali)</a></li>
          <li class="breadcrumb-item active">Detail Honorarium</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>


<div class="container-fluid"> 
    <div class="row">
      <div class="col-12">

         @if ($message = Session::get('success'))
           <div class="uk-alert uk-alert-success" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
             
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $message }}</strong>

                  <script type="text/javascript">
                    var err = "<?php echo $message ?>";
                    alert(err)
                  </script>

              </div>
              
          </div>
        @endif

        @if ($message = Session::get('error'))
           <div class="uk-alert uk-alert-error" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
             
              <div class="alert alert-error alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $message }}</strong>

                  <script type="text/javascript">
                    var err = "<?php echo $message ?>";
                    alert(err)
                  </script>

              </div>
              
          </div>
        @endif

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Detail Honorarium</h3>
            <?php if(cek_akses('52') == 'yes'){ ?>
              <a href="{{ Route('print_honorarium') }}" class="btn btn-dark btn-xs btn-flat"  target="_blank" style="float: right;">
                <span class="fa fa-print"> </span> Print
              </a>
              <?php }else{ ?>
                <a href="#" class="btn btn-dark btn-xs btn-flat" style="float: right;" onclick="myFunction()">
                  <span class="fa fa-print"> </span> Print
                </a>

                <script>
                function myFunction() {
                  alert("Anda Tidak Memiliki Akses");
                }
                </script>

            <?php } ?> 
          </div>

        <div class="card-body">
          <div class="table-responsive">
            <table id="" class="table table-striped table-bordered dt-responsive display">
              <thead>
              <tr>
                
                <th nowrap="">Nama Dosen</th>
                <th nowrap="">Jabatan Fungsional</th>
                <th nowrap="">Tugas Sebagai</th>
                <th nowrap="">Status</th>
                <th nowrap="">Nama Mahasiswa - Prodi</th>
                <th nowrap="">Pembayaran</th>
                <th nowrap="">Lampiran</th>
                <th nowrap="">Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 

              $temp = null;

              ?>
              
                @forelse($index as $key => $showindex)
                  <tr>

                    @if(($temp == $showindex->id_berkas_buff) || ($temp == null ))

                    @else
                    <tr>
                      <td colspan="100" class="bg-dark" style="padding: 7px;"></td>
                    </tr>
                    @endif

                    <td>{{ $showindex->nama_karyawan }}</td>
                    <td>{{ $showindex->jabatan_fungsional }}</td>
                    <td>{{ $showindex->tugas_sebagai }}</td>
                    <td nowrap="">{{ $showindex->status_dosen }}</td>
                    <td>{{ $showindex->nama_mahasiswa }} <br> <b>{{ $showindex->prodi }}</b></td>
                    <td><b>Rp.{{ number_format($showindex->pembayaran) }}</b></td>
                    <td>{{ $showindex->nama_lampiran }}</td>
                    <td nowrap="">

                      <a href="{{ Route('download_file_scan',['id' => $showindex->id_berkas_buff]) }}" title="Download">
                        <button type="button" class="btn btn-outline-primary btn-xs"><span class="fa fa-download"> </span></button>
                      </a> | 

                      <a href="{{ Route('preview_file_scan',['id' => $showindex->id_berkas_buff]) }}" title="Preview File" target="_blank">
                        <button type="button" class="btn btn-outline-info btn-xs"><span class="fa fa-eye"> </span></button>
                      </a> <br><hr>
                        
                      <a onClick="return confirm('Apakah Anda Yakin Menghapus Data {{ $showindex->nama_dosen }}?')" 
                          href="{{ Route('destroy_del_hon', ['id' => $showindex->id,'id_berkas_buff' => $showindex->id_berkas_buff]) }}" class="btn btn-outline-danger btn-xs btn-flat" title="Hapus Data"><span class="fa fa-trash"></span>
                      </a>

                    </td>
                  </tr>

                  <?php 

                  $temp = $showindex->id_berkas_buff;

                  ?>
                @empty
                <tr>
                  <td colspan="10" style="text-align: center;">Belum Ada Data Yang Dipilih</td>
                </tr>
                @endforelse
              </tbody>
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
