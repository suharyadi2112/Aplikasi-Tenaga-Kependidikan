
@extends('admin.layout.master')
@section('content')
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
@php

if(cek_verif($id_user, $type, $id_versi) == '2'){ 

    echo ("<script LANGUAGE='JavaScript'>
            window.alert('Form Tipe ".strtoupper($type)." Sudah Diverifikasi');
            window.location.href='".Route('VerifikasiForm',['id_u_tujuan' => Crypt::encryptString($id_u_tujuan), 'id_versi' => $id_versi])."';
            </script>");
} 
@endphp

<div class="container-fluid"style="padding-top: 5px;">
    <div class="row">
      <div class="col-12 mx-auto"> 
         
        <div class="card">
         <div class="card-body"> 
          <form data-route="{{ Route('SimpanJawabanVerif') }}"  data-routeback="#" id="myForm" role="form" method="POST" data-toggle="validator" accept-charset="utf-8">
          @csrf
          <input type="hidden" name="id_u_tujuan" value="{{ $id_u_tujuan }}">
          <input type="hidden" name="id_user" value="{{ $id_user }}">
          <!-- SmartWizard html -->
          <div id="smartwizard">
             <span class="badge badge-pill badge-warning"><span class="fa fa-user"></span></span> : <span class="badge badge-pill badge-primary"> {{ strtoupper($nm_lengkap) }}</span>
             <span class="badge badge-pill badge-warning"><span class="fa fa-language"></span></span> : <span class="badge badge-pill badge-info"> {{ strtoupper($nm_mandarin) }}</span>

            <a href="{{ Route('VerifikasiForm',['id_u_tujuan' => Crypt::encryptString($id_u_tujuan), 'id_versi' => $id_versi]) }}" style="float: right;"><button type="button" class="btn btn-outline-warning btn-sm"><span class="fa fa-arrow-left"></span> Back</button></a>
             
          <ul >

            @foreach($form_cek as $key => $showsoal)
              <li><a href="#step-{{$key + 1}}" style="padding:7px;">Soal {{$key + 1}} <br /></a></li>
            @endforeach
          </ul>
          <div>


          <!-- batas form-->
          <br>
          <?php $no = 1 ?>
          <?php $no2 = 0 ?>
          @foreach($form_cek as $key => $showsoal)

          @php
          $cekjawaban = DB::table('b_jawaban')
              ->join('b_soal','b_soal.id_soal','=','b_jawaban.id_soal')
              ->select('b_soal.id_soal','b_soal.kategori_soal' ,'b_jawaban.id_jawaban','b_jawaban.id_user','b_jawaban.id_soal','b_jawaban.jawaban')
              ->where([
                ['b_soal.kategori_soal','=',$showsoal->kategori_soal],
                ['b_jawaban.id_user','=',$id_user],
                ['b_soal.id_soal','=', $showsoal->id_soal],
                ['b_soal.id_versi_fk','=',$id_versi],
                ['b_jawaban.jenis_jawaban','!=','nilai_atasan']
              ])
              ->first();
        
          @endphp
         

            <div id="step-{{ $no }}"  role="form">
              <!--CEK ID JAWABAN UNTUK SAVE KE DB-->
              

              <div id="form-step-{{$no2}}" role="form" data-toggle="validator" class="row">
                <div class="form-group col-md-12">
                  <div class="row">
                  <div class="col-md-12">

                  <div class="row">
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h3>{{strtoupper($cekjawaban->jawaban)}}</h3>

                        <p>Jawaban yang dipilih</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-crosshairs"></i>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3>ASPEK</h3>

                        <p>{{ strtoupper($showsoal->jenis_soal) }} </p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-cogs"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                      <div class="inner">
                        <h3>Panduan</h3>

                        <p>{{ strtoupper($showsoal->tipe_soal) }} </p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-road"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <h3><b>{{ strtoupper($type) }} </b></h3>

                        <p>Form Tipe</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-people-carry"></i>
                      </div>
                    </div>
                  </div>
                </div>

                  <input type="hidden" name="id_soal{{$key}}" value="{{ $showsoal->id_soal }}">
                  <input type="hidden" name="jumlahdata[]" value="cek">

                  <input type="hidden" name="id_jawaban{{ $key }}" value="{{ $cekjawaban->id_jawaban }}">   

                  <table class="table table-hover">
                    <tbody>
                    <tr style="height: 40px;">
                    <td style="width: 95.2054%; height: 40px; font-size: 15px;" colspan="5" class="bg-dark"><b>SOAL : </b>{{ $showsoal->soal }}</td>
                    </tr>

                    <!----obsen a----->
                    <tr style="height: 21px;">
                    <td style="width: 1%; font-weight: bold;">A</td>
                    <td style="width: 1%; font-weight: bold;">:</td>
                    <td style="width: 1%; font-weight: bold;">
                      <div class="icheck-success d-inline">
                        <input type="radio" id="radioPrimary{{$no + 1000}}"  required="" disabled="" @if($cekjawaban->jawaban == 'a') checked="" @endif>
                        <label for="radioPrimary{{$no + 1000}}">
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary{{$no + 100}}" value="a" name="jawaban{{$key}}" required="">
                        <label for="radioPrimary{{$no + 100}}">{{ $showsoal->a}}
                        </label>
                      </div>
                    </td>
                    </tr>

                    <!----obsen b----->
                    <tr style="height: 21px;">
                    <td style="width: 1%; font-weight: bold;">B</td>
                    <td style="width: 1%; font-weight: bold;">:</td>
                    <td style="width: 1%; font-weight: bold;">
                      <div class="icheck-success d-inline">
                        <input type="radio" id="radioPrimary{{$no + 2000}}" required="" disabled="" @if($cekjawaban->jawaban == 'b') checked="" @endif>
                        <label for="radioPrimary{{$no + 2000}}">
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary{{$no + 200}}" value="b" name="jawaban{{$key}}" required="">
                        <label for="radioPrimary{{$no + 200}}">{{ $showsoal->b}}
                        </label>
                      </div>
                    </td>
                    </tr>

                    <!----obsen c----->
                    <tr style="height: 21px;">
                    <td style="width: 1%; font-weight: bold;">C</td>
                    <td style="width: 1%; font-weight: bold;">:</td>
                    <td style="width: 1%; font-weight: bold;">
                      <div class="icheck-success d-inline">
                        <input type="radio" id="radioPrimary{{$no + 3000}}" required="" disabled=""  @if($cekjawaban->jawaban == 'c') checked="" @endif>
                        <label for="radioPrimary{{$no + 3000}}">
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary{{$no + 300}}" value="c" name="jawaban{{$key}}" required="">
                        <label for="radioPrimary{{$no + 300}}">{{ $showsoal->c}}
                        </label>
                      </div>
                    </td>
                    </tr>

                    <!----obsen d----->
                    <tr style="height: 21px;">
                    <td style="width: 1%; font-weight: bold;">D</td>
                    <td style="width: 1%; font-weight: bold;">:</td>
                    <td style="width: 1%; font-weight: bold;">
                      <div class="icheck-success d-inline">
                        <input type="radio" id="radioPrimary{{$no + 4000}}" required="" disabled=""  @if($cekjawaban->jawaban == 'd') checked="" @endif>
                        <label for="radioPrimary{{$no + 4000}}">
                        </label>
                      </div>
                    </td>
                    <td>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary{{$no + 400}}" value="d" name="jawaban{{$key}}" required="">
                        <label for="radioPrimary{{$no + 400}}">{{ $showsoal->d}}
                        </label>
                      </div>
                    </td>
                    </tr>

                    </tbody>
                  </table>


                  <div class="help-block with-errors text-danger"></div>

                </div>
              </div>
            </div>

                </div>
            </div>
          <?php $no++ ?>
          <?php $no2++ ?>
          @endforeach


                <!--penutup batas form-->
          </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@php
if ($type == 'a') {
   $newType = [
                'type'=> 'b', 
                'versi'=> $id_versi, 
                'id_user'=> Crypt::encryptString($id_user),
                'id_u_tujuan' => Crypt::encryptString($id_u_tujuan)
              ];
}else if($type == 'b'){
    $newType = [
                'type'=> 'c', 
                'versi'=> $id_versi, 
                'id_user'=> Crypt::encryptString($id_user),
                'id_u_tujuan' => Crypt::encryptString($id_u_tujuan)
              ];

}else if($type == 'c'){
   $newType = [
                'type'=> 'd', 
                'versi'=> $id_versi, 
                'id_user'=> Crypt::encryptString($id_user),
                'id_u_tujuan' => Crypt::encryptString($id_u_tujuan)
              ];

}else if($type == 'd'){
    $newType = [
                'type'=> 'a', 
                'versi'=> $id_versi, 
                'id_user'=> Crypt::encryptString($id_user),
                'id_u_tujuan' => Crypt::encryptString($id_u_tujuan)
              ];
}else{

}

function cek_verif($id_user, $kategori_soal ,$id_versi){

  $tescek = DB::table('b_jawaban')
  ->join('b_soal','b_soal.id_soal','=','b_jawaban.id_soal')
  ->join('b_verif_jawaban','b_jawaban.id_jawaban','=','b_verif_jawaban.id_jawaban_fk')
  ->select('b_jawaban.*','b_soal.kategori_soal')
  ->where([['b_jawaban.id_user','=',$id_user],['b_soal.kategori_soal','=', $kategori_soal],['b_verif_jawaban.id_user_verif','=',Auth::user()->id],['b_soal.id_versi_fk','=',$id_versi]])
  ->get();

  if (empty($tescek)) {
    return '3';
  }

  if ($tescek->isEmpty()) {
    return '1';
  }else{
    return '2';
  }
}


@endphp

@endsection

@section('script')

<!-- Include jQuery Validator plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>

<script type="text/javascript">
    var valtipe = "<?php echo strtoupper($type) ?>";
     $(function(){
      $.ajaxSetup({
          headers:{
              'X-CSRF-Token' : $("input[name='_token'").attr('value')
          }
      });
        $('#myForm').submit(function(e){
          var route = $('#myForm').data('route');
          var routeback = $('#myForm').data('routeback');
          var form_data = $(this);

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
              success: function(data, Response){

                 switch(data.cekganda){
                    case 'ganda': /*First case */
                    swal("Gagal!", 'Data Sudah Ada Sebelumnya', "error");
                    break;
                    case 'Berhasil': /*First case */
                    swal({
                      title: "Verfikasi Form "+valtipe+" Berhasil !",
                      text: "Klik Oke Untuk Melanjutkan Verifikasi Form Selanjutnya!",
                      icon: "success",
                      closeOnClickOutside: false,
                      buttons: true,
                      dangerMode: true,
                    })
                    .then((willDelete) => {
                      if (willDelete) {
                        swal("Mohon Tunggu Sebentar, Halaman akan dialihkan ke form selanjutnya", {
                          icon: "success",
                        });
                        setTimeout(function() {
                          window.location.href = "{{ Route('VerifPenilaianForm',$newType) }}";
                        }, 2000);
                      } else {
                        swal("Sedang Dialihkan Kembali ke halaman utama verifikasi");
                        setTimeout(function() {
                          window.location.href = "{{ Route('VerifikasiForm',['id_u_tujuan' => Crypt::encryptString($id_u_tujuan), 'id_versi' => $id_versi]) }}";
                        }, 2000);
                        
                      }
                    });
                    break;
                    default:
                  /* If none of the above */
                  }

                

              },
              complete: function() {
                $.unblockUI()
              },
              error: function(xhr) { // if error occured
                        swal("Upsss!", "Terjadi kesalahan Dalam Menyimpan Data", "error");
                    },

          })

          e.preventDefault();
        });
      });


    $(document).ready(function(){
      
        // Toolbar extra buttons
        var btnFinish = $('<button type="button"></button>').text('Finish')
                                         .addClass('btn btn-info')
                                         .on('click', function(){
                                                if( !$(this).hasClass('disabled')){
                                                    var elmForm = $("#myForm");
                                                    if(elmForm){
                                                        elmForm.validator('validate');

                                                        var elmErr = elmForm.find('.has-error');
                                                        if(elmErr && elmErr.length > 0){

                                                          swal("Gagal", "Lengkapi data yang bersifat wajib terlebih dahulu", "error");

                                                            return false;
                                                        }else{

                                                        swal({
                                                          title: "Apakah Anda Yakin?",
                                                          text: "Data Akan Disimpan",
                                                          icon: "warning",
                                                          buttons: true,
                                                          dangerMode: true,
                                                        }).then((insertboy) => {
                                                              if (insertboy) {
                                                               
                                                                elmForm.submit();

                                                                return false;
                                                              }else {
                                                                  swal("Batal menyimpan data");
                                                                }
                                                            })
                                                        }
                                                    }
                                                }
                                            });
     


        // Smart Wizard
        $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'dots',
                transitionEffect:'fade',
                toolbarSettings: {
                  toolbarPosition: 'bottom',
                  toolbarButtonPosition : 'center',
                  toolbarExtraButtons: [btnFinish]
                                },
                anchorSettings: {
                            markDoneStep: true, // add done css
                            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                            removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                        },
                keyNavigation: false,
                lang: { // Language variables for button
                    next: 'Next',
                    previous: 'Previous'
                },
             });

        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
            var elmFormcek = $("#form-step-" + stepNumber);
       
            // stepDirection === 'forward' :- this condition allows to do the form validation
            // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
           
            if(stepDirection === 'forward' && elmFormcek){
                elmFormcek.validator('validate');
                //step1

                var elmErr = elmFormcek.children('.has-error');
                if(elmErr && elmErr.length > 0){
                    // Form validation failed
                    return false;

                }

            }

            return true;
        });

        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
            // Enable finish button only on last step
            if(stepNumber == 15){
                $('.btn-finish').removeClass('disabled');
            }else{
                $('.btn-finish').addClass('disabled');
            }
        });


    });


</script>

<style type="text/css">
          hr.new4 {
    border: 1px solid #5bc0de;
  }
</style>
@include('sweet::alert')
@endsection
