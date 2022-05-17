@extends('admin.layout.master')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
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
        <div class="card card-primary">
          <form data-route="{{ route('PostSksV3') }}" id="sksadd" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="card-body bg-dark justify-content-center">
            
                  @csrf
                  <h5>Mahasiswa & Umum</h5>
                  <div class="shadow-sm p-2 mb-3 bg-dark rounded col-md-12 mx-auto">
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group" >
                            <label for="nama dosen">Nomor Surat Pembimbing/Penguji<font color="yellow" size="2px">*</font> :</label>
                              <div id="SrtTgsReq"></div>
                            <font color="yellow" size="2px">*wajib diisi</font>
                          </div>
                      </div>

                      <input type="hidden" name="IdSuratTugas" id="IdSuratTugas" class="form-control">

                      <div class="col-md-3">
                          <div class="form-group" >
                            <label for="nama dosen">Nama Mahasiswa<font color="yellow" size="2px">*</font> :</label>
                             <div id="mhs_req"></div>
                            <font color="yellow" size="2px">*wajib diisi</font>
                          </div>
                      </div>
                      
                      <div class="col-md-3">
                          <div class="form-group" >
                            <label for="nama prodi">Nama Prodi<font color="yellow" size="2px">*</font> :</label>
                            <select id="id_prodi" name="id_prodi" class="dosen form-control" required="" >
                              <option value="">Pilih Nama Prodi</option>
                                @foreach ($prodi as $item_prodi)
                                <option value="{{$item_prodi->id_prodi}}">{{$item_prodi->nama_prodi}}</option>                                        
                                @endforeach
                            </select>
                          <font color="yellow" size="2px">*wajib diisi</font>
                          </div>
                      </div>

                      <div class="col-md-3">
                            <div class="form-group" >
                              <label for="nama mk">Nama MK<font color="yellow" size="2px">*</font> :</label>
                              <select id="id_mk" name="id_mk" class="form-control select" required="" >
                                <option value="">Pilih MK</option>
                                  @foreach ($mk as $item_mk)
                                  <option  @if($item_mk->jenis_mk == 'Pembimbing' || $item_mk->jenis_mk == 'Penguji')
                                  style="background: #d5cd68" 
                                  @endif  value="{{$item_mk->id_mk}}">{{$item_mk->nama_mk}} | {{$item_mk->jenis_mk}}</option>                                        
                                  @endforeach
                              </select>
                              <font color="yellow" size="2px">*wajib diisi</font>
                            </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-group" >
                            <label for="tahun ajar">Tahun Ajar<font color="yellow" size="2px">*</font> :</label>
                            <select name="tahun_ajar" class="form-control select" required="" id="tahun_ajar">
                              <option value="">Pilih Tahun Ajar</option>
                              <option value="2019/2020">2019/2020</option>
                              <option value="2020/2021">2020/2021</option>
                              <option value="2021/2022">2021/2022</option>
                              <option value="2022/2023">2022/2023</option>
                              <option value="2023/2024">2023/2024</option>
                            </select>
                          <font color="yellow" size="2px">*wajib diisi</font> | 
                          <a href="{{Route('indexAwal')}}"><span class="far fa fa-calendar-alt nav-icon"></span> Tahun Ajar </a>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group" >
                            <label for="ganjilgenap">Semester<font color="yellow" size="2px">*</font> :</label>
                            <select name="ganjilgenap" class="form-control select" required="" id="semester">
                                <option value="">Pilih Semester</option>
                                <option value="Gasal">Gasal</option>
                                <option value="Genap">Genap</option>     
                            </select>
                          <font color="yellow" size="2px">*wajib diisi</font>
                          </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group" >
                          <label for="nama prodi">Nama Lokasi<font color="yellow" size="2px">*</font> :</label>
                          <input type="text" class="form-control" name="lokasi" id="lokasi" value="-">
                        <font color="yellow" size="2px">*wajib diisi jika magang</font>
                        </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group" >
                            <label for="Judul">Judul<font color="yellow" size="2px">*</font> :</label>
                             <textarea class="textarea" placeholder="Place some text here" id="judul" name="judul" 
                                    style=" padding: 10px;"></textarea>
                            <font color="yellow" size="2px">*wajib diisi</font>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group" >

                            <label for="tanggal pelaksanaan">Tanggal Mulai<font color="yellow" size="2px">*</font> :</label>
                            <input type="date" name="tanggal_pelaksanaan_mulai" id="tgl_mulai" class="form-control" required="" />
                            <font color="yellow" size="2px">*wajib diisi</font>
                          </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group" >

                            <label for="tanggal pelaksanaan">Tanggal Selesai<font color="yellow" size="2px">*</font> :</label>
                            <input type="date" name="tanggal_pelaksanaan_selesai" id="tgl_selesai" class="form-control" required="" />
                            <font color="yellow" size="2px">*wajib diisi</font>
                          </div>
                      </div>

                    </div>
                  </div>
                  <!--PEMBIMBING TUGAS AKHIR-->
                  <div class="shadow-sm p-2 mb-3 bg-gradient-warning rounded col-md-12 mx-auto ruangPembimbing" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" >
                              
                              <div id="cnth" class="pembimbingrt2"></div>

                            </div>
                        </div>
                    </div>
                    <!--PEMBIMBING MAGANG-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group pembimbingrt" >

                              <div id=cnth2></div>
                              
                            </div>
                        </div>
                      </div>
                  </div>

                    <a href="{{ Route('IndexSuratKeteranganSelesai') }}" title="Cancel" style>
                      <span class="btn btn-danger"><i class="fa fa-long-arrow-alt-left"> </i> Back</span>
                    </a>  
                      <button type="submit" class="btn btn-primary" style="float: right;"><i class="fa fa-plus"> </i> Submit</button>
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
      //GET DATA MAHASISWA
      $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});$.ajax({url:"{{ Route('GetDoJson') }}",method:"POST",data:{jenis:'mhs'},success:function(data) {CekValueMhs(data.mhs);}})

      //UNTUK DATA OPTION DOSEN
      function CekValueMhs(param){$("#mhs_req").html('<select id="id_mhs" name="id_mhs" class="form-control select" required="" ><option value="">Pilih Mahasiswa</option</select');for(var kl=0;kl<param.length;kl++){var select=document.getElementById('id_mhs');var option=document.createElement("option");option.text=param[kl].nama+' | '+param[kl].nim;option.value=param[kl].id_mhs;select.add(option);} $('.select').select2({theme:'classic'});}

      //GET DATA SURAT TUGAS PEMBIMBING
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $.ajax({
         url:"{{ Route('GetDoJson') }}",
         method:"POST",
         data:{jenis:'srttgs'},
         success:function(data)
         {

           CekValSrtTgs(data.srttgs)

          //GET DATA DARI SURAT TUGAS PEMBIMBING
           $(document).ready(function(){
            $('.GetDataUndangan').change(function() {
                $.post('{{ Route('GetDataUndangan') }}', {
                    type: 'ceksrt', 
                    _token: "{{ csrf_token() }}",
                    id_surat: $('#SrtPem').val(),

                    beforeSend: function() { Pace.restart(); $.blockUI({css:{border:'none',padding:'5px',backgroundColor:'#000','-webkit-border-radius':'5px','-moz-border-radius':'5px',opacity:.5,color:'#fff'}});},

                }).done(function(data, response) {
                  $.unblockUI();
                   switch(data.kosong){
                    case '1': /*First case */
                    toastr.error('Data tidak ada.')
                    break;
                    case 'ininull': /*First case */
                    toastr.info('Data Direset.')
                    break;
                    default:
                      if (data.magang) {
                            toastr.success('Data '+data.magang.nama+' siap digunakan.')

                            $('#pembimbing').select2({ multiple : false ,theme: 'classic'});
                            $('.ruangPembimbing').show(); 
                            
                            //MAGANG
                            $('.pembimbingrt').show(); 
                            $('#pembimbing').prop( "disabled", false );

                            //TUGAS AKHIR
                            $('#cnth').hide(); 
                            $('.pembimbingta').prop( "disabled", true );

                            $.ajaxSetup({
                                  headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  }
                              });
                            $.ajax({
                                 url:"{{ Route('GetDoJson') }}",
                                 method:"POST",
                                 data:{jenis:'dosen'},
                                 beforeSend: function(){Pace.restart();},
                                 success:function(data)
                                 {
                                   CekValueDosMg(data.dosen);
                                 }
                              })

                             function CekValueDosMg(param,nmmhs) {
                                $("#cnth2").html('<h5>Dosen Pembimbing Magang | '+data.magang.nama+'</h5><label for="">Nama Dosen</label><select name="id_pembimbing[]" id="pembimbing" data-placeholder="Pilih Nama Dosen" class="form-control select" ></select>');
                                    //UNTUK DATA OPTION DOSEN
                                    for (var jk = 0; jk < param.length; jk++) {
                                        var select = document.getElementById('pembimbing');
                                        var option = document.createElement("option");
                                        option.text = param[jk].nama_karyawan+' | '+param[jk].nidn;
                                        option.value = param[jk].id_pegawai;
                                        select.add(option);
                                    }
                                $("#pembimbing option[value="+data.dospem+"]").prop("selected", "selected")
                                $('.select').select2({theme: 'classic'});
                              }

                            $('#judul').summernote('reset');
                            $('#IdSuratTugas').val(data.magang.id);
                            $("#id_mhs").val(data.magang.id_mhs); $('#id_mhs').trigger('change');
                            $("#id_mk").val(data.magang.id_mk); $('#id_mk').trigger('change');
                            $("#id_prodi").val(data.magang.id_prodi);$('#id_prodi').trigger('change');
                            $("#semester").val(data.magang.semester);$('#semester').trigger('change');
                            $("#tahun_ajar").val(data.magang.tahun_ajar);$('#tahun_ajar').trigger('change');

                      }else if(data.ta){  
                            toastr.success('Data '+data.ta.nama+' siap digunakan.')
                            if (data.dospem) {

                              $('.ruangPembimbing').show(); 
                              //MAGANG
                              $('.pembimbingrt').hide(); 
                              $('#pembimbing').prop( "disabled", true );   
                              //TUGAS AKHIR
                              $('#cnth').show(); 
                              $('.pembimbingta').prop( "disabled", false );

                               $.ajaxSetup({
                                  headers: {
                                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                  }
                              });
                              $.ajax({
                                 url:"{{ Route('GetDoJson') }}",
                                 method:"POST",
                                 data:{jenis:'dosen'},
                                 beforeSend: function(){Pace.restart();},
                                 success:function(data)
                                 {
                                   CekValueDos(data.dosen);
                                 }
                              })
                              function CekValueDos(param) {
                                var text = '';
                                text += '<h5>Dosen Pembimbing Tugas Akhir | '+data.ta.nama+'</h5>';
                                  for (i = 0; i < data.dospem.length; i++) {
                                    var cekk = i + 1;
                                    text += '<label for="nama dosen Pembimbing">Pembimbing '+cekk+' :</label><select id="dosen_option'+i+'" name="id_pembimbing[]" data-placeholder="Pilih Nama Dosen" class="form-control select pembimbingta"></select> <br>'; 
                                  }
                                $("#cnth").html(text);
                                  for (za = 0; za < data.dospem.length; za++) {
                                    //UNTUK DATA OPTION DOSEN
                                    for (var bg = 0; bg < param.length; bg++) {
                                        var select = document.getElementById('dosen_option'+za+'');
                                        var option = document.createElement("option");
                                        option.text = param[bg].nama_karyawan+' | '+param[bg].nidn;
                                        option.value = param[bg].id_pegawai;
                                        select.add(option);
                                    }
                                  $("#dosen_option"+za+" option[value="+data.dospem[za]+"]").prop("selected", "selected")
                                  }
                                $('.select').select2({theme: 'classic'});
                              }

                            }else{
                              toastr.error('Data Dosen Pembimbing Tidak Ada.')
                            }

                            $('#IdSuratTugas').val(data.ta.id);
                            $("#judul").summernote("code", data.judul);
                            $("#id_mhs").val(data.ta.id_mhs); $('#id_mhs').trigger('change');
                            $("#id_mk").val(data.ta.id_mk); $('#id_mk').trigger('change');
                            $("#id_prodi").val(data.ta.id_prodi);$('#id_prodi').trigger('change');
                            $("#semester").val(data.ta.semester);$('#semester').trigger('change');
                            $("#tahun_ajar").val(data.ta.tahun_ajar);$('#tahun_ajar').trigger('change');


                      }else{
                        toastr.error('Data Tidak Ditemukan.')
                      }
                    }
                 
                }).fail(function() {
                  alert( "Terjadi Kesalahan" );
                })
            });
          });

        }
      })
      function CekValSrtTgs(param) {
        $("#SrtTgsReq").html('<select id="SrtPem"name="nomorsuratpemimbing" class="form-control select GetDataUndangan" ><option value="">Pilih Nomor Surat Tugas Pembimbing</option> </select>');
            //UNTUK DATA OPTION DOSEN
            for (var nh = 0; nh < param.length; nh++) {
                var select = document.getElementById('SrtPem');
                var option = document.createElement("option");
                option.text = param[nh].no_surat+' | '+param[nh].nama+' | '+param[nh].nim+' | '+param[nh].nama_mk;
                option.value = param[nh].id;
                select.add(option);
            }
        $('.select').select2({theme: 'classic'});
      }

      //SIMPAN SURAT KETERANGAN SELESAI
      $(document).on('submit','#sksadd',function(e){e.preventDefault();var route=$('#sksadd').data('route');var form_data=$(this);$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});$.ajax({type:'POST',url:route,data:form_data.serialize(),beforeSend:function(){$.blockUI({css:{border:'none',padding:'5px',backgroundColor:'#000','-webkit-border-radius':'5px','-moz-border-radius':'5px',opacity:.5,color:'#fff'}});},success:function(response){swal("Berhasil Memproses Data","","success");resetCombo();},complete:function(){$.unblockUI();},error:function(xhr){swal("Upsss!","Terjadi kesalahan Dalam Memproses Data","error");},})});
   
      $('.dosen').select2({
        theme: 'classic'
      });
    });


</script>
<script type="text/javascript">
jQuery(document).ready(function($){$('.select').select2({theme:'classic'});$("#pembimbing").on("select2:select",function(evt){var element=evt.params.data.element;var $element=$(element);$element.detach();$(this).append($element);$(this).trigger("change");});});
</script>
<script>
$(function(){$('.textarea').summernote({width:550,height:100,fontSizes:['8','9','10','11','12','13','14','15','16','17','18','19','20'],toolbar:[['undo',['undo',]],['redo',['redo',]],['style',['bold','italic','underline',]],['font',['Arial']],['fontsize',['fontsize']],['color',['color']],['para',['ul','ol','paragraph']],]});$('.textarea').summernote('fontSize',12);})
      
function resetCombo() {
    $('input[name=tanggal_pelaksanaan_selesai').val('');
    $('input[name=lokasi').val('-');
    $("#id_mhs").val(""); $('#id_mhs').trigger('change');
    $("#SrtPem").val(""); $('#SrtPem').trigger('change');
    $("#id_mk").val(""); $('#id_mk').trigger('change');
    $("#id_prodi").val(""); $('#id_prodi').trigger('change');
    $("#semester").val(""); $('#semester').trigger('change');
    $("#tahun_ajar").val(""); $('#tahun_ajar').trigger('change');
    $('#judul').summernote('reset');
}
</script>
 
<style>
.tooltip-inner {
    min-width: 350px; /* the minimum width */
}
.select2-selection--multiple .select2-selection__choice {
    background-color: #1b1d21;
  }
.form-control {
  height: 28px;
}

</style>

@include('sweet::alert')
@endsection
