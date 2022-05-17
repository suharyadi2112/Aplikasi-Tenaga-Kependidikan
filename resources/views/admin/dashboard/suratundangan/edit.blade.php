@extends('admin.layout.master')

@section('content')
<br>
  <!-- /.content-header -->
  <!-- /.content-header -->
<?php if(cek_akses('67') == 'yes'){
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
            <h3 class="card-title">Edit Surat Undangan Penguji Proposal & TA</h3>
          </div>

          <form data-route="{{ route('simpanedit-ert',['id_undangan'=> $id_undangan]) }}" id="editundangan" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
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
                                <option @if ($item_mhs->id_mhs == $udg->id_mhs) selected @endif value="{{$item_mhs->id_mhs}}">{{$item_mhs->nama}}</option>                                        
                                @endforeach
                            </select>
                            <font color="red" size="2px">*wajib diisi</font>
                          
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group" >
                            <label for="Judul">Judul<font color="red" size="2px">*</font> :</label>
                             <textarea class="textarea" placeholder="Place some text here" name="judul" 
                                    style=" padding: 10px;">{{ $udg->judul }}</textarea>
                            <font color="red" size="2px">*wajib diisi</font>
                          </div>
                      </div>

                      <div class="col-md-3">
                            <div class="form-group" >

                              <label for="nama mk">Nama MK<font color="red" size="2px">*</font> :</label>
                              <select id="id_mk" name="id_mk" class="form-control" required="" >
                                <option value="">Pilih Nama MK</option>
                                  @foreach ($mk as $item_mk)
                                  <option @if ($item_mk->id_mk == $udg->id_nama_mk) selected @endif  @if($item_mk->jenis_mk == 'Pembimbing' || $item_mk->jenis_mk == 'Penguji')
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
                                <option @if ($item_prodi->id_prodi == $udg->id_prodi) selected @endif value="{{$item_prodi->id_prodi}}">{{$item_prodi->nama_prodi}}</option>                                        
                                @endforeach
                            </select>
                          <font color="red" size="2px">*wajib diisi</font>
                          </div>
                      </div>

                        <div class="col-md-6">
                          <div class="form-group" >

                            <label for="nama prodi">Nama Berkas Administrasi<font color="red" size="2px">*</font> :</label>
                            <select id="nama_berkas" name="id_jenisberkas" class="dosen form-control" required="" >
                              <option  value="{{ $udg->id_berkas_adm }}">{{ $udg->nama_berkas }}</option>
                            </select>
                          <font color="red" size="2px">*wajib diisi</font>
                          </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" >

                              <label for="tanggal pelaksanaan">Tanggal<font color="red" size="2px">*</font> :</label>
                              <input type="date" name="tanggal_pelaksanaan" class="form-control" required="" value="{{ $udg->tanggal_pelaksanaan }}" />
                              <font color="red" size="2px">*wajib diisi</font>
                            </div>
                        </div>

                     
                        <div class="col-md-3">
                            <div class="form-group" >

                              <label for="jam Awal">Jam Awal<font color="red" size="2px">*</font> :</label>
                              <input type="text" name="jam_mulai" class="form-control mulai" required="" />
                              <font color="red" size="2px">*wajib diisi</font>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group" >

                              <label for="jam akhir">Jam Akhir<font color="red" size="2px">*</font> :</label>
                              <input type="text" name="jam_selesai" class="form-control selesai" required="" />
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
                                <option @if ($item_ruangan->id_ruangan == $udg->id_ruangan) selected @endif" value="{{$item_ruangan->id_ruangan}}">{{$item_ruangan->nama_ruangan}}</option>                                        
                                @endforeach
                            </select>
                            <font color="red" size="2px">*wajib diisi</font>
                          </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group" >

                          <label for="Ruangan">Lampiran :</label>
                          <input type="text" class="form-control" name="lampiran" value="{{ $udg->lampiran }}" placeholder="masukan lampiran jika ada">
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

<?php
$mulai = date("H:i", strtotime($udg->jam_mulai));
$selesai = date("H:i", strtotime($udg->jam_selesai));
?>
@endsection
@section('script')


<script type="text/javascript">


    jQuery( document ).ready(function($){

      $(document).on('submit', '#editundangan', function(e) {  
        e.preventDefault();
        var route = $('#editundangan').data('route');
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

      var mulai = '<?php echo $mulai ;?>'
      $('.mulai').timepicker({
          timeFormat: 'H:mm',
          interval: 15,
          minTime: '0',
          maxTime: '23:00pm',
          defaultTime: mulai ,
          startTime: '08:00',
          dynamic: false,
          dropdown: true,
          scrollbar: true
      });
      var selesai = '<?php echo $selesai ;?>'
      $('.selesai').timepicker({
          timeFormat: 'H:mm',
          interval: 15,
          minTime: '0',
          maxTime: '23:00pm',
          defaultTime: selesai ,
          startTime: '08:00',
          dynamic: false,
          dropdown: true,
          scrollbar: true
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
          ['font', ['Arial',]],
          ['fontsize', ['fontsize']],
          ['color', ['color']],
          // /['para', ['ul', 'ol', 'paragraph']],
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
