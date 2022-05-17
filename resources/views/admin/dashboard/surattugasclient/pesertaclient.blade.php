<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('admin/dist/img/logo2.png') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Uvers</title>
    <!--script src="{{ asset('js/app.js') }}" defer></script-->
    <script>
        var laravel = @json(['baseURL' => url('/')])
    </script>
    <!-- Styles -->
    <!--link href="asset('admin/dist/css/nprogress.css') " rel="stylesheet" />
    <script src="asset('admin/dist/js/nprogress.js'"></script-->


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
   
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL::asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/adminlte.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ URL::asset('admin/dist/css/ionicons.min.css') }}">
    
    <link href="{{ asset('admin/dist/css/nprogress.css') }}" rel="stylesheet" />
    
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ URL::asset('admin/dist/css/font_sans_pro.css') }}" rel="stylesheet">

</head>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light static-top">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
          <img src="{{ URL::asset('admin/dist/img/logo1.png') }}" alt="" style="width: 50%">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-item nav-link" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link"  data-toggle="penjelasan" title="Masuk Sebagai Admin" href="{{ route('login') }}"><button class="btn btn-outline-info btn-xs"><span class="fa fa-sign-in-alt"></span></button></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br>

  <!-- /.content-header --> 
<div class="container-fluid">
    <div class="row">
      <div class="col-10 mx-auto">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
             <table id="datatablespeserta" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Nama Pegawai</th>
                <th>NIP</th>
                <th>NIDN</th>
                <th>Nama Jabatan</th>
                </tr>
              </thead>
              <tbody>
                 @forelse ($list_peserta as $item_peserta)
                    <tr>
                        <td>{{ $item_peserta->nama_karyawan }}</td>
                        <td>{{ $item_peserta->nipp }}</td>
                        <td>{{ $item_peserta->nidnp }}</td>
                        <td>{{ $item_peserta->nama_jabatanp }}</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="10"><center>Tidak Ada Data Peserta</center></td>
                    </tr>
                  @endforelse
                    
              </tbody>
              <tfoot>
              <tr>
                <th>Nama Pegawai</th>
                <th>NIP</th>
                <th>NIDN</th>
                <th>Nama Jabatan</th>
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

<!-- REQUIRED SCRIPTS -->
<!-- overlayScrollbars -->
<script src="{{ URL::asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('admin/dist/js/adminlte.js') }}"></script>

<!-- PAGE SCRIPTS -->
<script src="{{ URL::asset('admin/dist/js/pages/dashboard2.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ URL::asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script type="text/javascript">

function onSelectChange(){
 document.getElementById('hitungform').submit();
}

$(function () {
  $('[data-toggle="penjelasan"]').tooltip()
  
})
</script>