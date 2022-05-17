@extends('admin.layout.master')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />

<?php if(cek_akses('55') == 'yes'){
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
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Tambah Surat Tugas Pembimbing Magang & TA</h3>
          </div>

          <form data-route="{{ route('addsrttgs_pem') }}" id="addsrttgs_pembimbing" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="card-body bg-light">

                  @csrf


                  <h5>Mahasiswa</h5>
                  <div class="shadow p-2 mb-3 bg-white rounded col-md-12 row mx-auto">

                    <div class="col-md-6">
                          <div class="form-group" >

                            <label for="nama mhs">Nama Mahasiswa<font color="red" size="2px">*</font> :</label>
                            <select name="id_mhs" id="set_mhs" data-placeholder="Pilih Nama Mahasiswa" class="form-control select mhsid_prodi" required="" >
                                <option value="">Pilih Mahasiswa</option>
                                @foreach ($mhs as $item_mhs)
                                <option value="{{$item_mhs->id_mhs}}">{{$item_mhs->nama}} | {{$item_mhs->nim}} | {{ $item_mhs->inisial }}</option>                                        
                                @endforeach
                            </select>
                          
                          </div>
                      </div>
                       <div class="col-md-6">
                          <div class="form-group" >

                            <label for="nama mk">Nama MK<font color="red" size="2px">*</font> :</label>
                            <select id="id_mk" name="id_mk" class="form-control select" required="" >
                              <option value="">Pilih Nama MK</option>
                            </select>
                          
                          </div>
                      </div>

                  </div>

                  <h5>Dosen & Umum</h5>
                  <div class="shadow p-2 mb-3 bg-white rounded col-md-12 row mx-auto">

                      <div class="col-md-12">
                          <div class="form-group" >

                            <label for="nama dosen">Nama Dosen  <font color="red" size="2px">*</font> : <code>urutan pertama yaitu pembimbing pertama, dan seterusnya</code></label>
                            <select id="id_dosen" name="id_dosen[]" class="form-control dosen" multiple="multiple" required="" placeholder="Pilih Dosen">
                              <option value="">Pilih Nama Dosen</option>
                                @foreach ($dosen as $item_dosen)
                                <option value="{{$item_dosen->id_pegawai}}">{{$item_dosen->nama_karyawan}} | {{ $item_dosen->nidn }}</option>                                        
                                @endforeach
                            </select>
                          
                          </div>
                      </div>

                        <div class="col-md-4">
                            <div class="form-group" >

                              <label for="tahun_ajar">Tahun Ajar<font color="red" size="2px">*</font> :</label>
                              <select id="tahun_ajar" name="tahun_ajar" class="form-control" required="" >
                                @foreach($thnajar as $v_thnajar)
                                <option value="{{ $v_thnajar->tahun_ajar }}">{{ $v_thnajar->tahun_ajar }}</option>
                                @endforeach
                              </select>
                            <br>
                            <a href="{{Route('indexAwal')}}"><span class="far fa fa-calendar-alt nav-icon"></span> Tahun Ajar </a>
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="form-group" >

                              <label for="semester">Semester<font color="red" size="2px">*</font> :</label>
                              <select id="semester" name="semester" class="form-control" required="" >
                                  
                                  @foreach($semester as $v_semester)
                                  <option value="{{ $v_semester->semester }}">{{ $v_semester->semester }}</option>
                                  @endforeach         

                              </select>
                            
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group" >

                              <label for="jenis">Jenis Surat<font color="red" size="2px">*</font> :</label>
                              <select id="jenis_surat" name="jenis_surat" class="form-control" required="" >
                                <option value="">Jenis</option>
                                  
                                  <option value="Baru">Baru</option>  
                                  <option value="Perpanjangan">Perpanjangan</option> 
                                  <option value="Peralihan">Peralihan</option>            

                              </select>
                            
                            </div>
                        </div>

                      </div>
                      <hr>


                      {{-- UNTUK MBKM --}}

                      <h5>Merdeka Belajar Kampus Merdeka <b>(MBKM)</b></h5>
                      <div class="shadow p-2 mb-3 bg-white rounded col-md-12 row mx-auto">

                      <div class="col-md-12">
                        <div class="custom-control custom-switch ">
                          <input type="checkbox" class="custom-control-input mbkm" id="customSwitch1">
                          <label class="custom-control-label " for="customSwitch1" ></label>
                        </div>
                          <div class="form-group" >

                            <label for="nama MataKuliah">Mata Kuliah </label>
                            <select id="mata_kul" name="mata_kuliah[]" class="form-control MataKuliah mbkmform" multiple="multiple"  disabled>
                                @foreach ($mata_kuliah as $item_mata_kuliah)
                                <option value="{{$item_mata_kuliah->id_matakuliah}}">{{$item_mata_kuliah->kode}} | {{$item_mata_kuliah->sks}} | {{ $item_mata_kuliah->nama_matkul }}</option>                                        
                                @endforeach
                            </select>
                          
                          </div>
                      </div>  

                      <div class="col-md-12">
                        <div class="shadow p-2 mb-3 bg-secondary">
                          <div class="form-group" >
                            
                            <label for="nama MataKuliah">Detail Matkul</label></font>
                            <div id="formAp"></div>
                            </div>
                          </div>
                      </div>  


                      <div class="col-md-4">
                        <div class="form-group" >
                          <label for="nama_kegiatan">Nama Kegiatan<font color="red" size="2px">*</font> :</label>
                          <textarea class="form-control mbkmform" name="nama_kegiatan" required="" placeholder="Nama Kegiatan" disabled></textarea>
                        </div>
                      </div>


                      <div class="col-md-4">
                          <div class="form-group" >
                            <label for="mbkm">Bentuk MBKM<font color="red" size="2px">*</font> :</label>
                            <select id="mbkm" name="mbkm" class="form-control mbkmform" required="" disabled>
                              <option value="">Pilih Bentuk MBKM</option>
                              <option value="Pertukaran Pelajar">Pertukaran Pelajar</option>
                              <option value="Magang/ Praktik Kerja">Magang/ Praktik Kerja </option>
                              <option value="Asistensi Mengajar di Satuan Pendidikan">Asistensi Mengajar di Satuan Pendidikan</option>
                              <option value="Penelitian/ Riset">Penelitian/ Riset</option>
                              <option value="Proyek Kemanusiaan">Proyek Kemanusiaan</option>
                              <option value="Kegiatan Wirausaha">Kegiatan Wirausaha</option>
                              <option value="Studi / Proyek Independen">Studi / Proyek Independen</option>
                              <option value="Membangun Desa / Kuliah Kerja Nyata Tematik">Membangun Desa / Kuliah Kerja Nyata Tematik</option>
                            </select>
                          </div>

                      </div>

                    
                        <div class="col-md-4">
                            <div class="form-group" >

                              <label for="jenis">SKS Diakui<font color="red" size="2px">*</font> :</label>
                              <input type="text" name="sks_diakui" class="form-control mbkmform" placeholder="Masukan SKS" required=""disabled>                            
                            </div>
                        </div>

                      </div>
 
            </div>
                   

            <div class="card-footer bg-white" style="float: right;">
              <a href="{{ Route('IndexSuratTugasPembimbing') }}" title="Cancel">
                <span class="btn btn-danger"><i class="fa fa-long-arrow-alt-left"> </i> Back</span>
              </a>  
              <button type="submit" class="btn btn-primary"><i class="fa fa-plus"> </i> Submit</button>
              
            </div>
            
          </form>
        </div>
      </div><!-- /.row (main row) -->
    </div>
</div>

@endsection
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

<script type="text/javascript">


    jQuery( document ).ready(function($){

      $(document).on('submit', '#addsrttgs_pembimbing', function(e) {  
        e.preventDefault();
        var route = $('#addsrttgs_pembimbing').data('route');
        var form_data = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $.ajax({

            type: 'POST',
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
            success: function(data,Response){
               $.unblockUI();

              switch(data.cek){
                case '1': /*First case */
                toastr.success('Data Berhasil disimpan.')
                break;
                case '2': /*First case */
                toastr.error('Gagal Menyimpan Data.')
                break;
                case '3': /*First case */
                toastr.error('Prodi Mahasiswa Tidak Ditemukan.')
                break;
                default:
              }

            },
            complete: function() {
                   
                  },
            error: function(xhr) { // if error occured
                      swal("Upsss!", "Terjadi kesalahan Dalam Memproses Data", "error");
                  },

        })
      });

       //set auto MK
      $('.mhsid_prodi').on('change', function(){

        var ifConnected = window.navigator.onLine;
          if (ifConnected) {
            
          } else {
            swal("Upsss!", "Terjadi Kesalahan, Cek Internet Anda!", "error");
          }

          $.post('{{ Route('mkauto') }}', {
              type: 'id_mk', 
              _token: "{{ csrf_token() }}",
              id_mhstr: $('.mhsid_prodi').val(),

              beforeSend: function() { Pace.restart();},
              success: function(msg) {},
       
            }, 

            function(e){
              $('#id_mk').html(e);
          });
      });


      //set auto nim
      $('#set_mhs').on('change', function(){

        var ifConnected = window.navigator.onLine;
          if (ifConnected) {
            
          } else {
            swal("Upsss!", "Terjadi Kesalahan, Cek Internet Anda!", "error");
          }
          $.post('{{ Route('gd.mhs') }}', {
              type: 'gd_mhs', 
              _token: "{{ csrf_token() }}",
              id: $('#set_mhs').val(),

              beforeSend: function() {},
              success: function(msg) {},
       
            }, 
            function(e){
              $('#mhs_get').html(e);
          });
      });



    });


    function onSelectChange(){
       document.getElementById('hitungform').submit();
      }

</script>
<script type="text/javascript">
  jQuery( document ).ready(function($){

  $(".mbkm").click(function() {
    if($(this).is(":checked")) {
        $('.mbkmform').removeAttr("disabled");//HAPUS ATRIBUT DISABLED UNTUK MBKM  
    }else{
        $('.mbkmform').attr("disabled","disabled");//TAMBAH ATRIBUT DISABLED UNTUK MBKM
    }
  });

  $(document).ready(function(){
    $('.select').select2({
      theme: 'bootstrap4'
    });
  });
  $(document).ready(function(){
    $('.dosen').select2({
      theme: 'bootstrap4',
      placeholder: "Pilih Dosen",
      maximumSelectionLength: 3
    });
    $(".dosen").on("select2:select", function (evt) {
      var element = evt.params.data.element;
      var $element = $(element);

      $element.detach();
      $(this).append($element);
      $(this).trigger("change");
    });

});


  $(document).ready(function(){
    $('.MataKuliah').select2({
      theme: 'bootstrap4',
      placeholder: "Pilih Mata Kuliah",
      maximumSelectionLength: 10
    });
    $(".MataKuliah").on("select2:select", function (evt) {
      var element = evt.params.data.element;
      var $element = $(element);
      $element.detach();
      $(this).append($element);
      $(this).trigger("change");
      console.log(element.text)
      //TAMBAH FORM UNTUK DETAIL MATA KULIAH
      input = jQuery('<div class="col-md-12" id="'+element.value+'"><div class="form-group" ><label for="namaDetailMAtkul">'+element.text+' :</label><input type="text"  class="form-control mbkmform" name="DetailMatkul[]" placeholder="Contoh : adalah mata kuliah di Prodi Manajemen dan Akuntansi Universitas Universal"></div></div>');
      jQuery('#formAp').append(input);
    });

    //HAPUS FORM SAAT UN SELECT PILIHAN MATA KULIAH
    $(".MataKuliah").on("select2:unselect", function (evt) {

      var element = evt.params.data.element;
      jQuery('#'+element.value+'').remove();

     
    });

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
