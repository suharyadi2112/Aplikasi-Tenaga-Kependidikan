
@extends('admin.layout.master')

@section('content')

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

        <div class="card card-success">
          <div class="card-header">
            
            <h3 class="card-title">Honorarium Pembimbingan Tugas Akhir dan Kerja Praktik</h3>
          </div>

          <div class="card-body">
            <div class="table-responsive">
            <table id="setting_honorarium" class="table table-striped table-bordered dt-responsive display">
              <thead>
              <tr>
                <th nowrap="">Nama Dosen</th> 
                <th nowrap="">Status Dosen</th>
                <th nowrap="">Jabatan Fungsional</th>
                <th nowrap="">P-T-A 1</th>
                <th nowrap="">P-T-A 2</th>
                <th nowrap="">Peng TA</th>
                <th nowrap="">Peng S-P-T-A</th>
                <th nowrap="">PKP</th>
                </tr>
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

<script type="text/javascript">




$.noConflict();
jQuery( document ).ready(function( $ ) {




 $('#setting_honorarium').DataTable({
        processing: true,
        serverSide: true,
        scrollY : false,
        ajax: '{!! route('get_data_setting_honorarium') !!}',
        order: [ [1, 'DESC'] ], 
        
        columns: [
         
            { data: 'nama_karyawan', name: 'pegawai.nama_karyawan' },
            { data: 'status_dosen', name: 'status_dosen' },
            { data: 'jabatan_fungsional', name: 'jabatan_fungsional' },
            { data: 'p_t_a_satu',
              render: function ( data, type, row ) {
                  var output = (row.p_t_a_satu/1000).toFixed(3);
                  return output;
              },
            },
            { data: 'p_t_a_dua',
              render: function ( data, type, row ) {
                  var output = (row.p_t_a_dua/1000).toFixed(3);
                  return 'Rp.'+output;
              },
            },
            { data: 'p_tugas_akhir',
              render: function ( data, type, row ) {
                  var output = (row.p_tugas_akhir/1000).toFixed(3);
                  return 'Rp.'+output;
              },
            },
            { data: 'p_seminar_p_t_a',
              render: function ( data, type, row ) {
                  var output = (row.p_seminar_p_t_a/1000).toFixed(3);
                  return 'Rp.'+output;
              },
            },
            { data: 'pkp',
              render: function ( data, type, row ) {
                  var output = (row.pkp/1000).toFixed(3);
                  return 'Rp.'+output;
              },
            },
        ],


    });
  



});



</script>




@include('sweet::alert')
@endsection
