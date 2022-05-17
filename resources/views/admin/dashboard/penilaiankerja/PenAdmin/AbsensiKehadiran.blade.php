
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
<br>
<div class="container-fluid"> 
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

        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Absensi Kehadiran & Pelaksanaan Tugas Lain : <span class="badge badge-pill badge-primary">{{ $DataDiri->nama_lengkap }}</span></h3>


              @php

                if ($DataDiri->level == 1 || $DataDiri->level == 3 || $DataDiri->level == 4) {
                  $link = 4;
                }elseif($DataDiri->level == 10 || $DataDiri->level == 2 ){
                  $link = 10;
                }else{
                  $link = $DataDiri->level;
                }

              @endphp


            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <a href="{{ Route('IndexAdminPen',$link) }}"><button type="button" class="btn btn-tool"><i class="fas fa-times"></i></button></a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">


          <form data-route="{{ Route('SimpanFinalAbsensi') }}"  data-routeback="#" id="myForm" role="form" method="POST"  accept-charset="utf-8">
          @csrf


          <input type="hidden" name="id_user" value="{{ $id_user }}" >
          <input type="hidden" name="id_versi" value="{{ $id_versi }}" >

              <table style="border-collapse: collapse; width: 100%;" border="0">

              @foreach($indikator as $key => $s_indikator)
              <tr>
                <td colspan="5" class="bg-info" style="text-align: center; font-weight: bold;"><h5>{{ $s_indikator->nama_indikator }}</h5></td>
              </tr>
              @php
                  $aspek = DB::table('b_aspek_indikator')->select('id_aspek','nama_aspek')->where('id_indikator_fk','=',$s_indikator->id_indikator)->get();
              @endphp


                <tbody>
                <tr>
                <td style="width: 23.3499%;" nowrap="">
                  <div class="col-md-12">
                    <div class="form-group">
                      <h5>{{ $s_indikator->nama_indikator }}</h5>
                    </div>
                    <!-- /.form-group -->
                  </div>
                </td>
                <td style="width: 100%; vertical-align: middle;">

                @foreach($aspek as $keyaspek => $s_aspek)
                <div class="row">
                  <div class="col-md-4">
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label>ASPEK</label>
                      <blockquote>
                        <p><h5>{{ $s_aspek->nama_aspek }}</h5></p>
                      </blockquote>
                    </div>
                    <!-- /.form-group -->
                  </div>

                  @php
                  $sub_aspek = DB::table('b_subaspek_indikator')->select('id_subaspek','nama_subaspek')->where('id_aspek_fk','=',$s_aspek->id_aspek)->get();

                  @endphp
                  @php $i = 0; @endphp
                  <div class="col-md-8">
                  @foreach($sub_aspek as $keysubaspek => $s_sub_aspek)
                  <div class="row">
                    <div class="col-sm">
                      <div class="form-group">

                          @if($s_sub_aspek->nama_subaspek == '-')

                          @else

                            <label>SUB ASPEK</label>
                            <!--input type="text" name="" class="form-control" value="{{ $s_sub_aspek->nama_subaspek }}" readonly=""-->
                            <blockquote class="quote-secondary">
                              <p>{{ $s_sub_aspek->nama_subaspek }}.</p>
                              <small>{{$s_aspek->nama_aspek}} <cite title="Source Title">, Aspek</cite></small>
                            </blockquote>

                          @endif

                      </div>
                    </div>
                    @php
                    //mengambil ID dari SUB ASPEK
                    $pointIndi = DB::table('b_point_absen_kehadiran')
                    ->select('id_detail_indikator','detail_indikator','point','id_aspek_fk','status_sub_aspek')
                    ->where('id_aspek_fk','=',$s_sub_aspek->id_subaspek)
                    ->get();



                    @endphp
                    <div class="col-sm">

                      <label>INDIKATOR</label>
                      <blockquote class="quote-danger"> 
                         <select class="form-control" name="FinalIndikator[]" required="">
                            <option value="">Pilih Indikator</option>
                            @foreach($pointIndi as $keypointsub => $pointIndi_s)
                            <option value="{{ $pointIndi_s->id_detail_indikator }}">{{ $pointIndi_s->detail_indikator }} | {{$pointIndi_s->point}} Point</option>
                            @endforeach
                          </select>
                      <small>Setiap indikator memiliki bobot point yang berbeda </small>
                      </blockquote>

                    </div>   
                  </div>
                  
                  @endforeach
                  </div>
                </div>
                <hr style=" border: 1px solid green;">
                @endforeach
                </td>

               
                </tr>
             
                </tbody>
               @endforeach
            </table>
            <div class="modal-footer">
              <button type="submit" style="float: right;" class="btn btn-outline-primary btn-flat">Simpan Absensi & Pelaksanaan Tugas Lain</button>
            </div>

          </form>

          <!-- /.card-body -->
        </div>
      <!-- /.col -->
    </div>
  </div>
</div>


@endsection
@section('script')

<script type="text/javascript">

  $(document).on('submit', '#myForm', function(e) {  
      e.preventDefault();
      var namaLengkap = '<?php echo $DataDiri->nama_lengkap; ?>';
      var route = $('#myForm').data('route');
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
              return confirm("Yakin Untuk Memproses Data "+namaLengkap+"?");
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

           switch(data.ceks){
              case 'berhasil': /*First case */
                swal({
                  title: "Berhasil!",
                  text: "Absensi kehadiran "+namaLengkap+" Berhasil Diisi !",
                  icon: "success",
                  button: "Ok!",
                  closeOnClickOutside: false,
                }).then((value) => {
                  window.location.href = "{{ Route('IndexAdminPen',$link) }}";
                });
              break;
              case 'gagal' : /*Second... */
              swal("Gagal!", "Gagal Menyimpan Data", "error");
              break;
              case 'sudah ada' : /*Second... */
                swal({
                  title: "Gagal!",
                  text: "Absensi kehadiran "+namaLengkap+" ini sudah diisi !",
                  icon: "error",
                  button: "Ok!",
                  closeOnClickOutside: false,
                }).then((value) => {
                  window.location.href = "{{ Route('IndexAdminPen',$link) }}";
                });
              break;
              default:
              }
            },
          complete: function() {
                $('#myForm').modal('hide');
                $.unblockUI();
                },
          error: function(xhr) { // if error occured
                    swal("Upsss!", "Terjadi Kesalahan", "error");
                },

      })
    });
</script>

@include('sweet::alert')
@endsection