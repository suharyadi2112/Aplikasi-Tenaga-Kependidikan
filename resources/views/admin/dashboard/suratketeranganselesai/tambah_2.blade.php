@extends('admin.layout.master')

@section('content')

<?php if(cek_akses('60') == 'yes'){
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
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">Tambah Surat Keterangan Selesai Versi 2</h3>
          </div>

          <form data-route="{{ route('posttambahskscopy') }}" id="sksadd" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="card-body bg-light">

                  @csrf
                  <h5>Umum</h5>
                  <div class="shadow-sm p-2 mb-3 bg-white rounded col-md-12 row mx-auto">

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

                      <div class="col-md-3">
                          <div class="form-group" >

                            <label for="tahun ajar">Tahun Ajar<font color="red" size="2px">*</font> :</label>
                            <select name="tahun_ajar" class="form-control" required="" >
                              <option value="">Pilih Tahun Ajar</option>
                              <option value="2019/2020">2019/2020</option>
                              <option value="2020/2021">2020/2021</option>
                              <option value="2021/2022">2021/2022</option>
                              <option value="2022/2023">2022/2023</option>
                              <option value="2023/2024">2023/2024</option>
                            </select>
                          <font color="red" size="2px">*wajib diisi</font>
                          </div>
                      </div>

            
                      <div class="col-md-3">
                            <div class="form-group" >

                              <label for="nama mk">Nama MK<font color="red" size="2px">*</font> :</label>
                              <select id="id_mk" name="id_mk" class="form-control" required="" >
                                <option value="">Pilih Nama MK</option>
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

                            <label for="ganjilgenap">Semester<font color="red" size="2px">*</font> :</label>
                            <select id="" name="ganjilgenap" class="form-control" required="" >
                              <option value="">Pilih Tahun Ajar</option>
                              <option value="Ganjil">Ganjil</option>
                              <option value="Genap">Genap</option>
                            </select>
                          <font color="red" size="2px">*wajib diisi</font>
                          </div>
                      </div>

               
                        <div class="col-md-3">
                            <div class="form-group" >

                              <label for="tanggal pelaksanaan">Tanggal Mulai<font color="red" size="2px">*</font> :</label>
                              <input type="date" name="tanggal_pelaksanaan_mulai" class="form-control" required="" />
                              <font color="red" size="2px">*wajib diisi</font>
                            </div>
                        </div>





                 


                    </div>

                    <button class="tambah_mhs btn btn-outline-success btn-xs">Tambah Mahasiswa Lainnya
                            <span style="font-size:16px; font-weight:bold;">+</span>
                    </button>
                    <br>
                    <br>
                    <div class="show_mhs">
                    
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

@php

$data_dosen = array();
  foreach( $dosen as $s ) {
    $data_dosen[] = array(
      "id_dosen"    =>  $s->id_pegawai,
      "nama_karyawan"  =>  $s->nama_karyawan,
      "nidn"  =>  $s->nidn
    );

}

$data_mhs = array();
  foreach( $mhs as $s ) {
    $data_mhs[] = array(
      'id_mhs'  =>  $s->id_mhs, 
      'nama_mhs' => $s->nama,
      'nim_mhs' => $s->nim);
}
@endphp

@endsection
@section('script')


<script type="text/javascript">


    jQuery( document ).ready(function($){


    var dosen = <?php echo json_encode( $data_dosen ) ?>;
    var mhs = <?php echo json_encode( $data_mhs ) ?>;

      //pengalaman kerja bidang pendidikan
    $(document).ready(function() {


        var max_fieldspkbp = 10;
        var wrapperpkbp = $(".show_mhs");
        var add_buttonpkbp = $(".tambah_mhs");

        var x = 1;
        var z = 0;
        var c = 0;
        $(add_buttonpkbp).click(function(e) {
            e.preventDefault();
            if (x < max_fieldspkbp) {
                //$(".tahuntambah").attr("id", "tahuntambah"+x);
                x--;
                c++;
                //z++;
                    $(wrapperpkbp).append(
                '<div>'+
                '<hr style="border-top: 1px dashed black">'+
                     '<h4>Mahasiswa Ke-'+c+'</h4>'+

                    '<input type="hidden" name="jumlah[]" value="cek">'+

                    '<div class="shadow-sm p-2 mb-3 rounded col-md-12 row mx-auto" style=" background-color: #e8f3ff">'+

                       '<div class="col-md-5">'+
                          '<div class="form-group" >'+

                            '<label for="nama dosen">Nama Mahasiswa<font color="red" size="2px">*</font> :</label>'+
                            '<select id="list_mahasiswa'+x+'" name="id_mhs'+z+'[]" class="form-control mhs'+x+'" required="" >'+
                              '<option value="">Pilih Nama Mahasiswa</option>'+
                               
                            '</select>'+
                            '<font color="red" size="2px">*wajib diisi</font>'+
                          
                          '</div>'+
                      '</div>'+

                      '<div class="col-md-7">'+
                          '<div class="form-group" >'+
                            '<label for="Judul">Judul<font color="red" size="2px">*</font> :</label>'+
                             '<textarea class="textarea'+x+'" placeholder="Place some text here" name="judul'+z+'[]"  style=" padding: 10px;"></textarea>'+
                            '<font color="red" size="2px">*wajib diisi</font>'+
                          '</div>'+
                      '</div>'+

                      '<div class="col-md-5">'+
                            '<div class="form-group" >'+

                              '<label for="tanggal pelaksanaan">Tanggal Selesai<font color="red" size="2px">*</font> :</label>'+
                              '<input type="date" name="tanggal_pelaksanaan_selesai'+z+'[]" class="form-control" required="" />'+
                              '<font color="red" size="2px">*wajib diisi</font>'+
                            '</div>'+
                      '</div>'+


                      '<div class="col-md-7">'+
                          '<div class="form-group" >'+

                            '<label for="nama prodi">Nama Lokasi<font color="red" size="2px">*</font> :</label>'+
                            '<input type="text" class="form-control" name="lokasi'+z+'[]" value="-">'+
                          '<font color="red" size="2px">*wajib diisi jika magang</font>'+
                          '</div>'+
                      '</div>'+

                      '<h5>Dosen Pembimbing</h5>'+

                        '<div class="col-md-12">'+
                              '<div class="form-group" >'+

                                '<label for="nama dosen Pembimbing">Nama Dosen :</label>'+
                                '<select id="dosen_option'+x+'" name="id_pembimbing'+z+'[]" multiple="multiple" data-placeholder="Pilih Nama Dosen" class="form-control select_tambah'+x+'" >'+
                                    '<option value="">Pilih Dosen Pembimbing</option>'+
                                   
                                '</select>'+
                              '</div>'+
                          '</div>'+


                    '</div>'+
                '</div>'

                ); //add input box
            z++;
            } else {
                alert('Melebihi Batas Maksimum')
            }

            
            //UNTUK DATA OPTION MAHASISWA
            for (var i = 0; i < mhs.length; i++) {
                var select = document.getElementById('list_mahasiswa'+x+'');
                var option = document.createElement("option");
                option.text = mhs[i].nama_mhs+' | '+mhs[i].nim_mhs;
                option.value = mhs[i].id_mhs;
                select.add(option);

            }

            //UNTUK DATA OPTION DOSEN
            for (var i = 0; i < dosen.length; i++) {
                var select = document.getElementById('dosen_option'+x+'');
                var option = document.createElement("option");
                option.text = dosen[i].nama_karyawan+' | '+dosen[i].nidn;
                option.value = dosen[i].id_dosen;
                select.add(option);
            }



            $('.textarea'+x+'').summernote({
              width: 520,
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
            })
            $('.textarea'+x+'').summernote('fontSize', 12);

            $('.mhs'+x+'').select2({
              theme: 'bootstrap4'
            });

            $('.select_tambah'+x+'').select2({
              theme: 'bootstrap4'
            });

            $('select'+x+'').on('select2:select'+x+'', function (evt) {
              var element = evt.params.data.element;
                var $element = $(element);
                
                $element.detach();
                $(this).append($element);
                $(this).trigger("change");
            });


        }); 

       $(wrapperpkbp).on("click", ".deletepend", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
     
      });
      


      
      //Simpan data melalui ajax
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
            success: function(response){
              console.log(response)
            
              //$('#result').html(response.success);
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
        width: 520,
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
