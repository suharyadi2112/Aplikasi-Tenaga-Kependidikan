
@extends('admin.layout.master')

@section('content')


<?php if(cek_akses('85') == 'yes'){
}else{ ?>
  <script type="text/javascript">history.back(alert("Anda Tidak Memiliki Akses"))</script>
<?php } ?> 


<br>
<div class="container-fluid"> 
    <div class="row">
      <div class="col-12">

         @if ($message = Session::get('success'))
           <div class="uk-alert uk-alert-success" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
             
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $message }}</strong>

                  <script type="text/javascript">
                    var err = "<?php echo $message ?>";
                    alert(err)
                  </script>

              </div>
              
          </div>
        @endif

        @if ($message = Session::get('error'))
           <div class="uk-alert uk-alert-error" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
             
              <div class="alert alert-error alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $message }}</strong>

                  <script type="text/javascript">
                    var err = "<?php echo $message ?>";
                    alert(err)
                  </script>

              </div>
              
          </div>
        @endif

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tanggal Buka Buku dan Tutup Buku</h3>
            <?php if(cek_akses('86') == 'yes'){ ?>
              <a href="#" class="buktup btn btn-outline-dark btn-sm btn-flat" style="float: right;">
              <span class="fa fa-clock"> </span> Tambah Tanggal Baru
              </a>
            <?php }else{ ?>
               <a href="#" class="btn btn-outline-dark btn-sm btn-flat" style="float: right;" onclick="myFunction()">
                <span class="fa fa-clock"> </span> Tambah Tanggal Baru
                </a>
               <script>
                function myFunction() {
                  alert("Anda Tidak Memiliki Akses");
                }
                </script>
            <?php } ?> 
              
             
          </div>

        <div class="card-body">
          <div class="table-responsive">
            <table id="" class="table table-striped table-bordered dt-responsive display">
              <thead>
              <tr>
                <th nowrap="">No</th>
                <th nowrap="">Tanggal Buka</th>
                <th nowrap="">Tanggal Tutup</th>
                <th nowrap="">Tanggal Buka Alternatif</th>
                <th nowrap="">Tanggal Tutup Alternatif</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>

                @forelse($cek_data as $key => $showdata)
                @if($key == 0)
                <tr class="bg-info"> 

                  <td>{{ $key + 1 }}</td>
                  <td>{{ tanggal_indo($showdata->buka_buku_ori) }}</td>
                  <td>{{ tanggal_indo($showdata->tutup_buku_ori) }}</td>
                  <td>{{ tanggal_indo($showdata->buka_buku_kw) }}</td>
                  <td>{{ tanggal_indo($showdata->tutup_buku_kw) }}</td>
                  <td>
                    
                     <?php if(cek_akses('87') == 'yes'){ ?>
                      <a onClick="return confirm('Apakah Anda Yakin Menghapus Tangga Ini ?')" 
                          href="{{ Route('destroy_buktup', ['id' => $showdata->id]) }}" class="btn btn-outline-danger btn-xs btn-flat" title="Hapus Data"><span class="fa fa-trash"></span>
                      </a>
                    <?php }else{ ?>
                      <a href="#" class="btn btn-outline-danger btn-xs btn-flat" title="Hapus Data" onclick="myFunction()"><span class="fa fa-trash"></span>
                      </a>
                       <script>
                        function myFunction() {
                          alert("Anda Tidak Memiliki Akses");
                        }
                        </script>
                    <?php } ?> 

                  </td>
               
                </tr>
                @else
                <tr> 
                  <td>{{ $key + 1 }}</td>
                  <td>{{ tanggal_indo($showdata->buka_buku_ori) }}</td>
                  <td>{{ tanggal_indo($showdata->tutup_buku_ori) }}</td>
                  <td>{{ tanggal_indo($showdata->buka_buku_kw) }}</td>
                  <td>{{ tanggal_indo($showdata->tutup_buku_kw) }}</td>
                  <td>
                    <?php if(cek_akses('87') == 'yes'){ ?>
                      <a onClick="return confirm('Apakah Anda Yakin Menghapus Tangga Ini ?')" 
                          href="{{ Route('destroy_buktup', ['id' => $showdata->id]) }}" class="btn btn-outline-danger btn-xs btn-flat" title="Hapus Data"><span class="fa fa-trash"></span>
                      </a>
                    <?php }else{ ?>
                      <a href="#" class="btn btn-outline-danger btn-xs btn-flat" title="Hapus Data" onclick="myFunction()"><span class="fa fa-trash"></span>
                      </a>
                       <script>
                        function myFunction() {
                          alert("Anda Tidak Memiliki Akses");
                        }
                        </script>
                    <?php } ?> 
                    
                     

                  </td>
                @endif
                </tr>
                @empty
                  <tr>
                    <td colspan="10" style="text-align: center;">Tidak Ada Data</td>
                  </tr>
                @endforelse

              </tbody>
            </table>
            <b>Urutan pertama ditabel yang digunakan (blok biru)</b>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</div>
</div>


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

<!--CEK TANGGAL BUKA BUKU DAN TUTUP BUKU-->
<div id="buktupshow"  class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <div id="overlay_buktup">
            
          </div>
            <div class="modal-header bg-info">
                <h4><center>Preview Buka dan Tutup buku</center></h4>
                <button type="button" class="tutup_bg close" data-dismiss="modal">&times;</button>
            </div>
             <form data-route="{{ route('post_buktup') }}" id="buktup_add" role="form" method="POST" accept-charset="utf-8"> 
              @csrf
                <div class="modal-body ">
                  <div class="container-fluid">
                      <div class="col-md-12">

                     <h4><center>Buka dan Tutup Buku <b>Baru</b></center></h4>

                      <div class="card card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <label>Tanggal Buka Buku - Tutup Buku :<font color="red" size="2px">*</font></label>

                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                              </div>
                              <input type="text" name="buktup" class="calender_b form-control float-right" readonly="" required="" >
                            </div>
                          </div>
                         
                        </div>
                      </div>


                      <div class="card card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <label>Tanggal Buka Buku - Tutup Buku Alternatif :<font color="red" size="2px">*</font></label>

                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                              </div>
                              <input type="text" name="buktup_remake" class="calender_b form-control float-right" readonly="" required="" >
                            </div>
                          </div>
                        </div>
                      </div>

                      </div>  

                      </div>
                      </div>

                   <div class="modal-footer">
                      <button type="submit" class="btn btn-primary"><span class="fa fa-plus"></span> Simpan</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>
                  
                </form> 
            </div>
        </div>
    </div>



@php

function tanggal_indo($tanggal) {


        $datecek=date_create($tanggal);
        $enddate = date_format($datecek,"Y-m-d");


        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $split = explode('-', $enddate);
        return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
    }

@endphp

@endsection
@section('script')
<script type="text/javascript">
   
   //untuk buka dan tutup buku 
    $(document).on('click', '.buktup', function(){
      $('#buktupshow').modal('show');
    });


    //komunikasi ke server penambahan buka dan tutup buku
    $(document).on('submit', '#buktup_add', function(e) {  
      e.preventDefault();
      var route = $('#buktup_add').data('route');
      var form_data = $(this);
      var wrapper = $("#overlay_buktup");
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

            $(wrapper).append(  '<div class="overlay d-flex justify-content-center align-items-center">'+
                                      '<i class="fas fa-2x fa-sync fa-spin"></i>'+
                                      'Sedang Memproses Data'+
                                  '</div>');

          },
          success: function(Response){
            console.log(Response);
             $.blockUI({ css: { 
                border: 'none', 
                padding: '5px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '5px', 
                '-moz-border-radius': '5px', 
                opacity: .5, 
                color: '#fff' 
            } }); 
            
              setTimeout(function(){
                swal("Berhasil!", "Berhasil Mengubah Data", "success");
                });
              
            },
          complete: function() {
                $('#overlay_buktup').remove();
                $('#buktupshow').modal('hide');
                setTimeout(function () { location.reload(1); }, 2000);
                $.unblockUI();

                },
          error: function(xhr) { // if error occured
                    swal("Upsss!", "Terjadi Kesalahan", "error");
                },

      })
    });

    jQuery( document ).ready(function($){
     //Date range picker
      $('.calender_b').daterangepicker({
        //timePicker: true,

        timePickerIncrement: 30,
        locale: {
          format: 'YYYY-MM-DD',
        }
      })
    })



</script>
@include('sweet::alert')
@endsection
