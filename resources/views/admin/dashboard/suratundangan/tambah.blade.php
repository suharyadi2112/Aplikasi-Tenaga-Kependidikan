@extends('admin.layout.master')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
<br>
  <!-- /.content-header -->
  <!-- /.content-header -->
<?php if(cek_akses('66') == 'yes'){
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
<div class="container-fluid">
  <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Tambah Surat Undangan Penguji Proposal & TA</h3>
          </div>

          <form data-route="{{ route('tambahundangan-ert') }}" id="undanganadd" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="card-body bg-light">

                  @csrf
                  <h5>Mahasiswa & Umum</h5>
                  <div class="shadow-sm p-2 mb-3 bg-white rounded col-md-12 row mx-auto">

                      <div class="col-md-6">
                          <div class="form-group" >

                            <label for="nama dosen">Nomor Surat Pembimbing<font color="red" size="2px">*</font> :</label>
                            <select id="SrtPem"name="nomorsuratpemimbing" class="form-control select GetDataPembimbing" >
                              <option value="">Pilih Nomor Surat Tugas Pembimbing</option>
                                @foreach ($NoSuratPembimbing as $ItemNoSurat)
                                <option value="{{$ItemNoSurat->id}}">{{$ItemNoSurat->no_surat}} | {{$ItemNoSurat->nama}} | {{$ItemNoSurat->nim}}</option>                                        
                                @endforeach
                            </select>
                            <font color="red" size="2px">*wajib diisi</font>
                          
                          </div>
                      </div>

                      <br>

                      <div class="col-md-6">
                          <div class="form-group" >

                            <label for="nama dosen">Nama Mahasiswa<font color="red" size="2px">*</font> :</label>
                            <select id="id_mhs" name="id_mhs" class="form-control dosen" required="" >
                                <option>Pilih Mahasiswa</option>
                                @foreach ($mhs as $item_mhs)
                                <option value="{{$item_mhs->id_mhs}}">{{$item_mhs->nama}} | {{$item_mhs->nim}} | {{ $item_mhs->inisial }}</option>                                        
                                @endforeach
                            </select>
                            <font color="red" size="2px">*wajib diisi</font>
                          
                          </div>
                      </div>
            
                      <div class="col-md-3">
                            <div class="form-group" >

                              <label for="nama mk">Nama MK<font color="red" size="2px">*</font> :</label>
                              <select id="id_mk" name="id_mk" class="form-control" required="" >
                                  @foreach ($mk as $item_mk)
                                  <option  @if($item_mk->jenis_mk == 'Pembimbing' || $item_mk->jenis_mk == 'Penguji')
                                  style="background: #d5cd68" 
                                  @endif  value="{{$item_mk->id_mk}}">{{$item_mk->nama_mk}} | {{$item_mk->jenis_mk}}</option>                                        
                                  @endforeach
                              </select>
                              <font color="red" size="2px">*wajib diisi</font>
                            </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group" >

                            <label for="nama prodi">Nama Prodi<font color="red" size="2px">*</font> :</label>
                            <select id="id_prodi" name="id_prodi" class="dosen form-control" required="" >
                              <option value="">Pilih Nama Prodi</option>
                                @foreach ($prodi as $item_prodi)
                                <option value="{{$item_prodi->id_prodi}}">{{$item_prodi->nama_prodi}}</option>                                        
                                @endforeach
                            </select>
                          <font color="red" size="2px">*wajib diisi</font>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group" >

                          <label for="nama prodi">Nama Berkas Administrasi<font color="red" size="2px">*</font> :</label>
                          <select id="nama_berkas" name="id_jenisberkas" class="dosen form-control" required="" >
                            <option value="">Pilih Prodi Dahulu</option>
                          </select>
                        <font color="red" size="2px">*wajib diisi</font>
                        </div>
                      </div>
                    </div>

                    <div class="shadow-sm p-2 mb-3 bg-white rounded col-md-12 row mx-auto">

                      <div class="col-md-12">
                            <div class="form-group" >

                              <label for="nama dosen Pembimbing">Nama Dosen Pembimbing:</label>
                              <select name="id_pembimbing[]" id="id_pembimbing" multiple="multiple" data-placeholder="Pilih Nama Dosen" class="form-control select" required="">
                                  <option value="">Pilih Dosen Pembimbing</option>
                                  @foreach ($dosen as $item_dosen)
                                  <option value="{{$item_dosen->id_pegawai}}">{{$item_dosen->nama_karyawan}} | {{$item_dosen->nidn}}</option>                                        
                                  @endforeach
                              </select>
                            </div>
                        </div>

                    </div>

                    <div class="shadow-sm p-2 mb-3 bg-white rounded col-md-12 row mx-auto">
                      <div class="col-md-6">
                          <div class="form-group p-0 m-0" >
                            <label for="Judul">Judul<font color="red" size="2px">*</font> :</label>
                             <textarea class="textarea" placeholder="Place some text here" name="judul" 
                                    style=" padding: 10px;"></textarea>
                            <font color="red" size="2px">*wajib diisi</font>
                          </div>
                      </div>

                        <div class="col-md-2">
                            <div class="form-group" >

                              <label for="tanggal pelaksanaan">Tanggal<font color="red" size="2px">*</font> :</label>
                              <input type="date" name="tanggal_pelaksanaan" class="form-control" required="" />
                              <font color="red" size="2px">*wajib diisi</font>
                            </div>
                        </div>

                     
                        <div class="col-md-2">
                            <div class="form-group" >

                              <label for="jam Awal">Jam Awal<font color="red" size="2px">*</font> :</label>
                              <input type="text" name="jam_mulai" class="form-control timepicker" required="" />
                              <font color="red" size="2px">*wajib diisi</font>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group" >

                              <label for="jam akhir">Jam Akhir<font color="red" size="2px">*</font> :</label>
                              <input type="text" name="jam_selesai" class="form-control timepicker" required="" />
                              <font color="red" size="2px">*samakan jika tidak memiliki jam akhir</font>
                              <font color="red" size="2px">*wajib diisi</font>
                            </div>
                        </div>

                        
                        <div class="col-md-3">
                          <div class="form-group" >

                            <label for="Ruangan">Nama Ruangan<font color="red" size="2px">*</font> :</label>
                            <select id="id_ruangan" name="id_ruangan" class="dosen form-control" required="" >
                              <option value="">Pilih Ruangan</option>
                                @foreach ($ruangan as $item_ruangan)
                                <option value="{{$item_ruangan->id_ruangan}}">{{$item_ruangan->nama_ruangan}}</option>                                        
                                @endforeach
                            </select>
                            <font color="red" size="2px">*wajib diisi</font>
                          </div>
                        </div>

                         <div class="col-md-6">
                          <div class="form-group" >

                            <label for="Ruangan">Lampiran :</label>
                            <input type="text" class="form-control" name="lampiran" placeholder="masukan lampiran jika ada">
                          </div>
                        </div>

                      

                    </div>

              
                    <h5>Dosen Penguji</h5>
                    <div class="shadow-sm p-2 mb-3 bg-white rounded col-md-12 row mx-auto">

                      <div class="col-md-12">
                            <div class="form-group" >

                              <label for="nama dosen penguji">Nama Dosen<font color="red" size="2px">*urutan pertama adalah ketua, dilanjutkan dengan anggota</font> :</label>
                              <select name="id_pegawai[]" id="pengujiCheck" multiple="multiple" data-placeholder="Pilih Nama Dosen" class="form-control select" required="" >
                                  @foreach ($dosen as $item_dosen2)
                                  <option value="{{$item_dosen2->id_pegawai}}">{{$item_dosen2->nama_karyawan}} | {{$item_dosen2->nidn}}</option>                                        
                                  @endforeach
                              </select>
                            <font color="red" size="2px">*wajib diisi</font>
                            </div>
                        </div>

                    </div>

            </div>
                   

            <div class="card-footer bg-white" style="float: right;">
              <a href="{{ Route('indexundangan') }}" title="Cancel">
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

    //TAMBAH DATA UNDANGAN PENGUJI
      $(document).on('submit', '#undanganadd', function(e) {  
        e.preventDefault();
        var route = $('#undanganadd').data('route');
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
            success: function(Response){
              console.log(Response)
              swal("Berhasil Menyimpan Data!", "", "success")
              $.blockUI({ css: { 
                            border: 'none', 
                            padding: '5px', 
                            backgroundColor: '#000', 
                            '-webkit-border-radius': '5px', 
                            '-moz-border-radius': '5px', 
                            opacity: .5, 
                            color: '#fff' 
                        } }); 
              setTimeout(location.reload.bind(location), 2000);

            },
            complete: function() {
                    $.unblockUI();},
            error: function(xhr) { // if error occured
                      swal("Upsss!", "Terjadi kesalahan Dalam Memproses Data", "error");
                  },

        })
      });

      $('.timepicker').timepicker({
          timeFormat: 'H:mm',
          interval: 15,
          minTime: '0',
          maxTime: '23:00pm',
          defaultTime: new Date(),
          startTime: '08:00',
          dynamic: false,
          dropdown: true,
          scrollbar: true
      });

      $('.dosen').select2({
        theme: 'bootstrap4'
      });

      //set auto nidn
      $('#id_prodi').on('change', function(){

        var ifConnected = window.navigator.onLine;
          if (ifConnected) {
            
          } else {
            swal("Upsss!", "Terjadi Kesalahan, Cek Internet Anda!", "error");
          }

          $.post('{{ Route('namaberkas-ert') }}', {
              type: 'gd_nmberkas', 
              _token: "{{ csrf_token() }}",
              id: $('#id_prodi').val(),

              beforeSend: function() {},
              success: function(msg) {},
       
            }, 

            function(e){
              $('#nama_berkas').html(e);
          });
      });
    });


</script>
<script type="text/javascript">
  jQuery( document ).ready(function($){
  $('.select').select2({
    theme: 'bootstrap4'
  });

  //matikan auto sort
  $("#pengujiCheck").on("select2:select", function (evt) {
    var element = evt.params.data.element;
    var $element = $(element);

    $element.detach();
    $(this).append($element);
    $(this).trigger("change");
  });

    //GET DATA DARI SURAT TUGAS PEMBIMBING
  $(document).ready(function(){
    $('.GetDataPembimbing').change(function() {
        $.post('{{ Route('GetDataPembimbing') }}', {
            type: 'ceksrt', 
            _token: "{{ csrf_token() }}",
            id_surat: $('#SrtPem').val(),

            beforeSend: function() { Pace.restart();},

        }).done(function(data, response) {

           switch(data.kosong){
            case '1': /*First case */
            toastr.error('Data tidak ada.')
            break;
            
            default:
            toastr.success('Data '+data.nama_mhs+' siap digunakan.')
              //var  id_anak = $(this).attr('data_idanak');
              console.log(data.dospem)
              $('#id_pembimbing').val(data.dospem).change();

              $("#id_mhs").val(data.id_mhs); $('#id_mhs').trigger('change');
              $("#id_prodi").val(data.id_prodi);$('#id_prodi').trigger('change');
              //$("#id_pembimbing").val(data.id_pembimbing);$('#id_pembimbing').trigger('change');
            }
         
        }).fail(function() {
          alert( "Terjadi Kesalahan" );
        })
    });
  });

});
</script>
<script>
  $(function () {
    // Summernote
      $('.textarea').summernote({
        width: 500,
        height: 100,
        fontSizes: ['8', '9', '10', '11', '12','13', '14','15' ,'16','17','18','19','20'],
        toolbar: [

          ['undo', ['undo',]],
          ['redo', ['redo',]],
          ['style', ['bold', 'italic', 'underline',]],
          ['font', ['Arial']],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
        ]
      });
      $('.textarea').summernote('fontSize', 12);
  })
</script>
 
<style>
.tooltip-inner {
    min-width: 350px; /* the minimum width */
}
</style>

@include('sweet::alert')
@endsection
