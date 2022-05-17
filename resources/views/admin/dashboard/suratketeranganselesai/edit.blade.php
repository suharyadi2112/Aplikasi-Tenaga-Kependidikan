@extends('admin.layout.master')

@section('content')

<?php if(cek_akses('61') == 'yes'){
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
  
        <div style="display: none;" class="cekpesansuccess">
          <div class="uk-alert uk-alert-success" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                <strong><div id="resultsuccess"></div></strong>
              </div>
          </div>
        </div>

        <!-- general form elements -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title"> Edit Surat Keterangan Selesai</h3>
          </div>

          <form data-route="{{ route('edit-sks',['id' => $id_sks]) }}" id="sksadd" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="card-body bg-light">

                  @csrf
                  <h5>Mahasiswa & Umum</h5>
                  <div class="shadow-sm p-2 mb-3 bg-white rounded col-md-12 row mx-auto">

                      <div class="col-md-6">
                          <div class="form-group" >

                            <label for="nama dosen">Nama Mahasiswa<font color="red" size="2px">*</font> :</label>
                            <select id="id_mhs" name="id_mhs" class="form-control dosen" required="" >
                              <option value="">Pilih Nama Mahasiswa</option>
                                @foreach ($mhs as $item_mhs)
                                <option @if ($item_mhs->id_mhs == $cektabel->mahasiswa) selected @endif value="{{$item_mhs->id_mhs}}">{{$item_mhs->nama}}</option>                                        
                                @endforeach
                            </select>
                            <font color="red" size="2px">*wajib diisi</font>
                          
                          </div>
                      </div>


                      <div class="col-md-6">
                          <div class="form-group" >
                            <label for="Judul">Judul<font color="red" size="2px">*</font> :</label>
                             <textarea class="textarea" placeholder="Place some text here" name="judul" 
                                    style=" padding: 10px;">{{ $cektabel->judul }}</textarea>
                            <font color="red" size="2px">*wajib diisi</font>
                          </div>
                      </div>

                       <div class="col-md-3">
                            <div class="form-group" >

                              <label for="nama mk">Nama MK<font color="red" size="2px">*</font> :</label>
                              <select id="id_mk" name="id_mk" class="form-control" required="" >
                                <option value="">Pilih Nama MK</option>
                                  @foreach ($mk as $item_mk)
                                  <option @if ($item_mk->id_mk == $cektabel->nama_mk) selected @endif) value="{{$item_mk->id_mk}}">{{$item_mk->nama_mk}} | {{$item_mk->jenis_mk}}</option>                                        
                                  @endforeach
                              </select>
                              <font color="red" size="2px">*wajib diisi</font>
                            </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group" >

                            <label for="nama prodi">Nama Lokasi<font color="red" size="2px">*</font> :</label>
                            <input type="text" class="form-control" name="lokasi" value="{{$cektabel->lokasi}}">
                          <font color="red" size="2px">*wajib diisi jika magang</font>
                          </div>
                        </div>

                        <div class="col-md-3">
                          <div class="form-group" >

                            <label for="nama prodi">Nama Prodi<font color="red" size="2px">*</font> :</label>
                            <select id="id_prodi" name="id_prodi" class="dosen form-control" required="" >
                              <option value="">Pilih Nama Prodi</option>
                                @foreach ($prodi as $item_prodi)
                                <option @if ($item_prodi->id_prodi == $cektabel->prodi) selected @endif value="{{$item_prodi->id_prodi}}">{{$item_prodi->nama_prodi}}</option>                                        
                                @endforeach
                            </select>
                          <font color="red" size="2px">*wajib diisi</font>
                          </div>
                      </div>

                      <div class="col-md-3">
                          <div class="form-group" >

                            <label for="tahun ajar">Tahun Ajar<font color="red" size="2px">*</font> :</label>
                            <select id="" name="tahun_ajar" class="form-control" required="" >
                              <option value="">Pilih Tahun Ajar</option>
                              <option value="2019/2020"  @if ($cektabel->tahun_ajar == '2019/2020') selected @endif >2019/2020</option>
                              <option value="2020/2021"  @if ($cektabel->tahun_ajar == '2020/2021') selected @endif >2020/2021</option>
                              <option value="2021/2022"  @if ($cektabel->tahun_ajar == '2021/2022') selected @endif >2021/2022</option>
                              <option value="2022/2023"  @if ($cektabel->tahun_ajar == '2022/2023') selected @endif >2022/2023</option>
                              <option value="2023/2024"  @if ($cektabel->tahun_ajar == '2023/2024') selected @endif >2023/2024</option>
                            </select>
                          <font color="red" size="2px">*wajib diisi</font>
                          </div>
                      </div>

                      <div class="col-md-3">
                          <div class="form-group" >

                            <label for="ganjilgenap">Semester<font color="red" size="2px">*</font> :</label>
                            <select id="" name="ganjilgenap" class="form-control" required="" >
                              <option value="">Pilih Tahun Ajar</option>
                              <option value="Gasal" @if ($cektabel->semester == 'Gasal') selected @endif >Gasal</option>
                              <option value="Genap"  @if ($cektabel->semester == 'Genap') selected @endif>Genap</option>
                            </select>
                          <font color="red" size="2px">*wajib diisi</font>
                          </div>
                      </div>

               
                        <div class="col-md-3">
                            <div class="form-group" >

                              <label for="tanggal pelaksanaan">Tanggal Mulai<font color="red" size="2px">*</font> :</label>
                              <input type="date" value="{{$cektabel->mulai}}" name="tanggal_pelaksanaan_mulai" class="form-control" required="" />
                              <font color="red" size="2px">*wajib diisi</font>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group" >

                              <label for="tanggal pelaksanaan">Tanggal Selesai<font color="red" size="2px">*</font> :</label>
                              <input type="date" value="{{$cektabel->selesai}}" name="tanggal_pelaksanaan_selesai" class="form-control" required="" />
                              <font color="red" size="2px">*wajib diisi</font>
                            </div>
                        </div>
   
                    </div>

            </div>

            <div id="result"></div>

            <div class="card-footer bg-white" style="float: right;">
              <a href="{{ Route('IndexSuratKeteranganSelesai') }}" title="Cancel">
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


<script type="text/javascript">


    jQuery( document ).ready(function($){


      $(document).on('submit', '#sksadd', function(e) {  
        e.preventDefault();
        var route = $('#sksadd').data('route');
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
            success: function(response){
              console.log(response)

              $('.cekpesansuccess').show();
              $('#resultsuccess').html(response.success);

              swal("Berhasil Memproses Data", "", "success")
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
                    $.unblockUI();
                   
                        
                  },
            error: function(xhr, response) { // if error occured
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
    });


</script>
<script type="text/javascript">
  jQuery( document ).ready(function($){
  $('.select').select2({
    theme: 'bootstrap4'
  });
  $("select").on("select2:select", function (evt) {
  var element = evt.params.data.element;
    var $element = $(element);
    
    $element.detach();
    $(this).append($element);
    $(this).trigger("change");
  });


});
</script>
<script>
  $(function () {
    // Summernote
      $('.textarea').summernote({
        width: 450,
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
