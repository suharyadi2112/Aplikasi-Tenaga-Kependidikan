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

@endphp

<div class="container-fluid" style="padding-top: 5px;">
    <div class="row">
      <div class="col-12 mx-auto"> 
        <div class="card">
         <div class="card-body">
          <!--form data-route="#" data-routeback="#" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8"-->
          <form data-route="{{ Route('SimpanJawabanNilaiAtasan') }}"  data-routeback="#" id="myForm" role="form" method="POST" data-toggle="validator" accept-charset="utf-8">

          <input type="hidden" name="id_versi" value="{{ $id_versi }}" required>
          @csrf

          <!-- SmartWizard html -->
          <div id="smartwizard">
            <a href="{{ Route('IndexPenilaianKerjaCek') }}" style="float: right;"><button type="button" class="btn btn-outline-warning btn-sm"><span class="fa fa-arrow-left"></span> Back</button></a>
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
         
            <div id="step-{{ $no }}"  role="form">
              <div id="form-step-{{$no2}}" role="form" data-toggle="validator" class="row">
                <div class="form-group col-md-12">
                  <div class="row">
                  <div class="col-md-12">
                  <p style="font-weight:bold; margin-top:5px; margin-bottom:5px; "> Atasan : <u>{{ $nama_tujuan }}</u></p>
                  <div class="row">
                    <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h3>Form</h3>

                          <p>Penilaian Kerja <b>Tahun {{ $showsoal->tahun }}</b></p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-list"></i>
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
                      <div class="small-box bg-success">
                        <div class="inner">
                          <h3>Nilai Atasan</h3>

                          <p style="font-weight: bold;">{{ strtoupper('form tipe b') }} </p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-book"></i>
                        </div>
                      </div>
                    </div>
                  </div>

                  <input type="hidden" name="id_soal{{$key}}" value="{{ $showsoal->id_soal }}">
                  <input type="hidden" name="jumlahdata[]" value="cek">

                  <table class="table table-hover" width="100%">
                    <tbody>
                    <tr style="height: 40px;">
                    <td style="width: 95.2054%; height: 40px; font-size: 15px;" colspan="4" class="bg-dark"><b>SOAL : </b>{{ $showsoal->soal }}</td>
                    </tr>

                    <!----obsen a----->
                    <tr>
                    <td style="width: 1%">A</td>
                    <td style="width: 1%">:</td>
                    <td>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary{{$no + 100}}" value="a" name="jawaban{{$key}}" required="">
                        <label for="radioPrimary{{$no + 100}}">
                          {{ $showsoal->a}}
                        </label>
                      </div>
                    </td>
                    </tr>

                    <!----obsen b----->
                    <tr>
                    <td>B</td>
                    <td>:</td>
                    <td>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary{{$no + 200}}" value="b" name="jawaban{{$key}}" required="">
                        <label for="radioPrimary{{$no + 200}}">
                          {{ $showsoal->b}}
                        </label>
                      </div>
                    </td>
                    </tr>

                    <!----obsen c----->
                    <tr>
                    <td>C</td>
                    <td>:</td>
                    <td>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary{{$no + 300}}" value="c" name="jawaban{{$key}}" required="">
                        <label for="radioPrimary{{$no + 300}}">
                          {{ $showsoal->c}}
                        </label>
                      </div>
                    </td>
                    </tr>

                    <!----obsen d----->
                    <tr>
                    <td>D</td>
                    <td>:</td>
                    <td>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary{{$no + 400}}" value="d" name="jawaban{{$key}}" required="">
                        <label for="radioPrimary{{$no + 400}}">
                          {{ $showsoal->d}}
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



@endphp

@endsection

@section('script')

<!-- Include jQuery Validator plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>

<script type="text/javascript">
    	
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
          Pace.track(function(){
            Pace.restart();
	            $.ajax({

	              type: 'POST',
	              url: route,
	              data: form_data.serialize(),

	              beforeSend: function(){ blockUI(); },
	              success: function(data, response){
              	    switch(data.nhg){
                      case 'berhasil':
                      swal("Berhasil!", "Berhasil Memproses Data", "success");
                      setTimeout(function() { window.location.href = "{{ Route('IndexPenilaianKerjaCek') }}"; }, 1000);
                      break;
                      case 'gagal' :
                      swal("Gagal!", "Gagal Memproses Data", "error");
                      break;
                      case 'ganda' :
                      swal("Warning!", "Data Sudah Pernah Diinput Sebelumnya", "warning");
                      break;
                      default:
                    }
	              },
	              complete: function() { $.unblockUI(); },
	              error: function(xhr) {
	                        swal("Upsss!", "Terjadi kesalahan Dalam Menyimpan Data", "error");
	                    },

	          	});
        	});

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

   

    });
	
	function blockUI(){
		$.blockUI({ css: {  border: 'none', padding: '5px',  backgroundColor: '#000',  '-webkit-border-radius': '5px', '-moz-border-radius': '5px',  opacity: .5,  color: '#fff' } }); 
	}

</script>

<style type="text/css">
          hr.new4 {
    border: 1px solid #5bc0de;
  }
</style>
@include('sweet::alert')
@endsection
