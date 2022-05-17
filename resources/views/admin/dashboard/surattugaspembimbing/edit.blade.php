@extends('admin.layout.master')

@section('content')\

<?php if(cek_akses('56') == 'yes'){
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
  <!-- /.content-header -->
  <!-- /.content-header -->

<div class="container-fluid">
  <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Edit Surat Tugas Magang & TA</h3>
          </div>

          <form data-route="{{ route('edit_srttgspembimbing') }}" id="editsrttgs_pembimbing" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="card-body bg-light">

                  @csrf
                  <h5>Umum</h5>
                  <div class="shadow-sm p-2 mb-3 bg-white rounded col-md-12 row mx-auto">
                  <input type="hidden" value="{{ $cektabel->id }}" name="id">
                    @if(is_null($cektabel->id_udg))
                     
                      <div class="col-md-6">
                          <div class="form-group" >

                            <label for="nama dosen">Nama Dosen<font color="red" size="2px">*</font> :</label>
                            <select id="id_dosen" name="id_dosen" class="form-control dosen" required="" >
                              <option value="">Pilih Nama Dosen</option>
                                @foreach ($dosen as $item_dosen)
                                <option @if ($item_dosen->id_pegawai == $cektabel->id_dosen) selected @endif" value="{{$item_dosen->id_pegawai}}">{{$item_dosen->nama_karyawan}}</option>                                        
                                @endforeach
                            </select>
                          
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group" >

                            <label for="nama dosen">NIDN Dosen<font color="red" size="2px">*</font> :</label>
                            
                            <div id="nidn">
                              <input type="text" name="" value="{{ $cektabel->nama_karyawan }} | {{ $cektabel->nidn }}" class="form-control" placeholder="Pilih nama dosen dahulu" readonly="" required=""/>
                            </div>
                          
                          </div>
                      </div>
                      @else
                      @endif



                       <div class="col-md-3">
                          <div class="form-group" >

                            <label for="nama prodi">Nama Prodi<font color="red" size="2px">*</font> :</label>
                            <select id="id_prodi" name="id_prodi" class="dosen form-control" required="" >
                              <option value="">Pilih Nama Prodi</option>
                                @foreach ($prodi as $item_prodi)
                                <option @if ($item_prodi->id_prodi == $cektabel->id_prodi) selected @endif" value="{{$item_prodi->id_prodi}}">{{$item_prodi->nama_prodi}}</option>                                        
                                @endforeach
                            </select>
                          
                          </div>
                      </div>

                      
                      <div class="col-md-3">
                            <div class="form-group" >

                              <label for="nama mk">Nama MK<font color="red" size="2px">*</font> :</label>
                              <select id="id_mk" name="id_mk" class="form-control" required="" >
                                <option value="">Pilih Nama MK</option>
                                  @foreach ($mk as $item_mk)
                                  <option @if ($item_mk->id_mk == $cektabel->id_mk) selected @endif"  @if($item_mk->jenis_mk == 'Pembimbing' || $item_mk->jenis_mk == 'Penguji')
                                  style="background: #d5cd68" 
                                  @endif  value="{{$item_mk->id_mk}}">{{$item_mk->nama_mk}} | {{$item_mk->jenis_mk}}</option>                                        
                                  @endforeach
                              </select>
                            
                            </div>
                        </div>

                        <div class="col-md-2">
                        <div class="form-group" >

                          <label for="tahun_ajar">Tahun Ajar<font color="red" size="2px">*</font> :</label>
                          <select id="tahun_ajar" name="tahun_ajar" class="form-control" required="" >
                            <option value="">Pilih Tahun Ajar</option>
                              
                              <option @if ("2019/2020" == $cektabel->tahun_ajar) selected @endif value="2019/2020">2019/2020</option>
                              <option @if ("2020/2021" == $cektabel->tahun_ajar) selected @endif value="2020/2021">2020/2021</option>
                              <option @if ("2021/2022" == $cektabel->tahun_ajar) selected @endif value="2021/2022">2021/2022</option>
                              <option @if ("2022/2023" == $cektabel->tahun_ajar) selected @endif value="2022/2023">2022/2023</option>
                              <option @if ("2023/2024" == $cektabel->tahun_ajar) selected @endif value="2023/2024">2023/2024</option>               

                          </select>
                        
                        </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" >

                              <label for="semester">Semester<font color="red" size="2px">*</font> :</label>
                              <select id="semester" name="semester" class="form-control" required="" >
                                <option value="">Semester</option>
                                  
                                  <option @if ("Genap" == $cektabel->semester) selected @endif value="Genap">Genap</option>  
                                  <option @if ("Gasal" == $cektabel->semester) selected @endif value="Gasal">Gasal</option>            

                              </select>
                            
                            </div>
                        </div>

                         <div class="col-md-2">
                            <div class="form-group" >

                              <label for="jenis">Jenis Surat<font color="red" size="2px">*</font> :</label>
                              <select id="jenis_surat" name="jenis_surat" class="form-control" required="" >
                                <option value="">Jenis</option>
                                  
                                  <option @if ("Baru" == $cektabel->jenis_surat) selected @endif value="Baru">Baru</option>  
                                  <option @if ("Perpanjangan" == $cektabel->jenis_surat) selected @endif value="Perpanjangan">Perpanjangan</option>
                                  <option @if ("Peralihan" == $cektabel->jenis_surat) selected @endif  value="Peralihan">Peralihan</option>               

                              </select>
                            
                            </div>
                        </div>

                      </div>

                    <h5>Mahasiswa</h5>
                    <div class="shadow-sm p-2 mb-3 bg-white rounded col-md-12 row mx-auto">

                      <div class="col-md-12">
                            <div class="form-group" >

                              <label for="nama mhs">Nama Mahasiswa<font color="red" size="2px">*</font> :</label>
                              <select name="id_mhs" data-placeholder="Pilih Nama Mahasiswa" class="form-control select" required="" >
                                  @foreach ($mhs as $item_mhs)
                                  <option @if ($item_mhs->id_mhs == $cektabel->id_mhs) selected @endif value="{{$item_mhs->id_mhs}}">{{$item_mhs->nama}} | {{$item_mhs->nim}}</option>                                        
                                  @endforeach
                              </select>
                            
                            </div>
                        </div>

                    </div>

            </div>
                   

            <div class="card-footer bg-white" style="float: right;">
              <a href="{{ Route('IndexSuratTugasPembimbing') }}" title="Cancel">
                <span class="btn btn-danger"><i class="fa fa-long-arrow-alt-left"> </i> Back</span>
              </a>  
              <button type="submit" class="btn btn-primary"><i class="fa fa-plus"> </i> Update</button>
              
            </div>
            
          </form>
        </div>
      </div><!-- /.row (main row) -->
    </div>
</div>

@endsection
@section('script')


<script type="text/javascript">

    jQuery( document ).ready(function($){


      $(document).on('submit', '#editsrttgs_pembimbing', function(e) {  
        e.preventDefault();
        var route = $('#editsrttgs_pembimbing').data('route');
        var form_data = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({

            type: 'PUT',
            url: route,
            data: form_data.serialize(),

            beforeSend: function(){
             $.blockUI({ css: { 
                            border: 'none', 
                            padding: '5px', 
                            backgroundColor: '#000', 
                            '-webkit-border-radius': '5px', 
                            '-moz-border-radius': '5px', 
                            opacity: .5, 
                            color: '#fff' 
                        } }); 
             },
            success: function(Response){
              console.log(Response)
              swal("Berhasil Mengubah Data!", "", "success")
              $.blockUI({ css: { 
                            border: 'none', 
                            padding: '5px', 
                            backgroundColor: '#000', 
                            '-webkit-border-radius': '5px', 
                            '-moz-border-radius': '5px', 
                            opacity: .5, 
                            color: '#fff' 
                        } }); 

            },
            complete: function() {
                    $.unblockUI();
                    setTimeout(location.reload.bind(location), 2000);
                        
                  },
            error: function(xhr) { // if error occured
                      swal("Upsss!", "Terjadi kesalahan Dalam Memproses Data", "error");
                  },

        })
      });




      //set auto nidn
      $('#id_dosen').on('change', function(){

        var ifConnected = window.navigator.onLine;
          if (ifConnected) {
            
          } else {
            swal("Upsss!", "Terjadi Kesalahan, Cek Internet Anda!", "error");
          }

          $.post('{{ Route('gd.nidn') }}', {
              type: 'gd_nidn', 
              _token: "{{ csrf_token() }}",
              id: $('#id_dosen').val(),

              beforeSend: function() {},
              success: function(msg) {},
       
            }, 

            function(e){
              $('#nidn').html(e);
          });
      });


      $('.dosen').select2({
        theme: 'bootstrap4'
      });

    });


    function onSelectChange(){
       document.getElementById('hitungform').submit();
      }

</script>
<script type="text/javascript">
  jQuery( document ).ready(function($){
  $('.select').select2({
    theme: 'bootstrap4'
  });


});
</script>
 
<style>
.tooltip-inner {
    min-width: 350px; /* the minimum width */
}
</style>

@include('sweet::alert')
@endsection
