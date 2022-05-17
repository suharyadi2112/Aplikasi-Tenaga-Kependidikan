
@extends('admin.layout.master')


@section('content') 
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard v2</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v2</li>
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
      <div class="card-header">
        <a href="{{{ action('Jurusan\JurusanController@tambah') }}}">
        <button type="button" class="btn bg-navy btn-flat margin"><i class="fa fa-fw fa-plus"></i>Tambah Jurusan</button></a>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="jurusan" class="table table-bordered table-striped data-table">
          <thead>
          <tr>
            <th>Kode</th>
            <th>Nama jurusan</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
            <?php foreach ($jurusan as $datajurusan):  ?>
            <tr>
             
             <td style="text-align: center;">{{ $datajurusan->jurKode}}</td>
              <td>{{ $datajurusan->jurNama}}</td>
              <td><a href="{{{ action('Jurusan\JurusanController@hapus',[$datajurusan->jurKode]) }}}" title="hapus" onclick="return confirm('Apakah anda yakin akan menghapus Jurusan {{{$datajurusan->jurKode .' - '.$datajurusan->jurNama }}}?')">
                <span class="label label-danger"><i class="fa fa-trash"> Delete </i></span>
                </a>
              </td>         
             
            </tr>
            <?php endforeach  ?>
          </tbody>
          <tfoot>
          <tr>
             <th>Kode</th>
            <th>Nama jurusan</th>
            <th>Aksi</th>
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

<script>
$.noConflict();
jQuery( document ).ready(function( $ ) {
    $('#jurusan').DataTable({
      
    });
});
// Code that uses other library's $ can follow here.
</script>
@endsection

