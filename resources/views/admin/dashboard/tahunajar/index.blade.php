
@extends('admin.layout.master')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />


<?php if(cek_akses('111') == 'yes'){ ?>
<div class="container-fluid"> 
    <div class="row">
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
         <div class="uk-alert uk-alert-danger" data-uk-alert>
            <a href="" class="uk-alert-close uk-close"></a>
           
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>{{ $message }}</strong>
            </div>
            
        </div>
        @endif
        <br>
        <div class="card">

            <div class="card-body bg-dark p-2">

            @if(cek_akses('112') == 'yes')

            <a href="#" class="tamta btn btn-sm bg-info" ><span class="fa fa-plus"> </span> Tambah</a>
            @endif
            <hr class="m-2">

            <div class="table-responsive">
            <table id="index212" class="table table-striped table-bordered display table-dark table-hover">
              <thead>
              <tr>
                <th>Tahun Ajar</th>
                <th>Semester</th>
                <th>Status</th>
                @if(Auth::user()->id != '142')
                @if(cek_akses('114') == 'yes')
                <th>Aksi</th>
                @endif
                @endif
              </tr>
              </thead>
              <tbody>
              @php $o = 1; @endphp
              @foreach($ThnAjar as $vlu)
              <tr>
                <td>{{ $vlu->tahun_ajar }}</td>
                <td>
                  @if($vlu->semester == 'Genap')
                    <span class="badge badge-pill badge-primary" style="width: 40px">{{ $vlu->semester }}</span>
                  @else
                    <span class="badge badge-pill badge-warning" style="width: 40px">{{ $vlu->semester }}</span>
                  @endif
                </td>
                <td style="width: 10%">
                  @if($vlu->status == '1')
                  <div class="custom-control custom-switch">
                    <input type="checkbox" value="{{ $vlu->id }}" class="custom-control-input  Ubah{{ $vlu->id }}" checked="" id="customSwitch1{{ $vlu->id }}">
                    <label class="custom-control-label" for="customSwitch1{{ $vlu->id }}"></label>
                  </div>
                  @else
                  <div class="custom-control custom-switch ">
                    <input type="checkbox" value="{{ $vlu->id }}" class="custom-control-input Ubah{{ $vlu->id }}" id="customSwitch1{{ $vlu->id }}">
                    <label class="custom-control-label " for="customSwitch1{{ $vlu->id }}" ></label>
                  </div>
                  @endif
           
                </td>
                @if(Auth::user()->id != '142')
                @if(cek_akses('114') == 'yes')
                <td style="width: 10%">
                  <a href="{{ Route('DestroyThnAjr',['id' => $vlu->id]) }}" title="Hapus Data Tahun Ajar" onclick="return confirm('Apakah Anda Yakin Menghapus Data Ini ?' ) ">
                        <button type="button" class="btn btn-outline-danger btn-xs"><span class="fa fa-trash"> </span></button>
                        </a>
                </td>
                @endif
                @endif
              </tr>
              @php $o++; @endphp
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</div>
</div>

<!-------------------------------Update nomor surat------------------------------------->
<div id="showtamta" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content bg-dark">
             <div id="overlay">
              
            </div>
              <div class="modal-header">
                  <h3 class="modal-title">Tambah Tahun Ajar Baru</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                <div class="modal-body">
                  <form data-route="{{ route('TamThnAjr') }}"  id="tamtaninput" role="form" method="POST" accept-charset="utf-8">
                  @csrf

                  <div class="form-group" >
                    <label> Tahun Ajar<font color="red" size="2px">*</font> :</label>
                      <input type="text" name="tahunajar" required="" class="form-control" placeholder="2060/2061">
                  </div>

                  <div class="form-group" >
                    <label> Semester<font color="red" size="2px">*</font> :</label>
                      <select class="form-control" name="semester" required="">
                        <option value="Genap">Genap</option>
                        <option value="Gasal">Gasal</option>
                      </select>
                  </div>

                  <div class="form-group" >
                    <label> Status<font color="red" size="2px">*</font> :</label>
                      <select class="form-control" name="status" required="">
                        <option value="1">Aktif</option>
                        <option value="0">Tidak</option>
                      </select>
                  </div>

                   <div class="modal-footer">
                      <button type="submit" class="join btn btn-primary">Simpan</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>
                
                  </form> 
              </div>
          </div>
      </div>
  </div>


@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
<script type="text/javascript">
$.noConflict();
jQuery( document ).ready(function( $ ) {
    
  $('#index212').DataTable({
        processing: true,
        sort:false,
        language: {
            "infoFiltered":"",
            "processing": '<img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 30%;">',
            "searchPlaceholder": "Masukan Tahun",
        },
    });

    $('.select').select2({
      theme: 'bootstrap4'
    });

    $(document).on('click', '.tamta', function(){
      $('#showtamta').modal('show');
    });

    $(document).on('submit', '#tamtaninput', function(e) {  
      e.preventDefault();
      var route = $('#tamtaninput').data('route');
      var form_data = $(this);
      var wrapper = $("#overlay");
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

             $.blockUI({ css: { 
                border: 'none', 
                padding: '5px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '5px', 
                '-moz-border-radius': '5px', 
                opacity: .5, 
                color: '#fff' 
            } }); 
                $('#overlay').remove();
                $('#showtamta').modal('hide');
             
            },
          complete: function() {
                $.unblockUI();
               swal("Berhasil!", "Berhasil Menyimpan Data", "success");
                setTimeout(location.reload.bind(location), 2000);
                },
          error: function(xhr) { // if error occured
                    swal("Upsss!", "Terjadi kesalahan", "error");
                },

      })
    }); 

});
</script>

@foreach($ThnAjar as $vlu2)
<script type="text/javascript">
jQuery( document ).ready(function( $ ) {
     //tipe surat penguji
    $(document).on('click', '.Ubah{{ $vlu2->id }}', function(){

        $.post('{{ Route('UbahStsTahunAjar') }}', {
            type: 'status', 
            _token: "{{ csrf_token() }}",
            id_thnajr: $('#customSwitch1<?php echo $vlu2->id ?>').val(),

            beforeSend: function() { Pace.restart();},

        }).done(function(data, response) {
          switch(data.gg){
            case '1': /*First case */
            toastr.error('Status Tahun Ajar yang aktif hanya boleh Satu.')
            $("#customSwitch1<?php echo $vlu2->id ?>").prop('checked', false);
            break;
            case '3': /*First case */
            toastr.warning('Anda tidak memiliki akses.')
            setTimeout(function(){location.reload()}, 1000);
            break;
            case '2' : /*Second... */
            toastr.success('Berhasil Mengubah Status.')
            default:
            /* If none of the above */
            }
   
        })
    });
});
</script>
@endforeach

<script type="text/javascript">
 jQuery( document ).ready(function( $ ) {

  $('[data-toggle="penjelasan"]').tooltip()
  
})
</script>

<style>
.tooltip-inner {
    min-width: 350px; /* the minimum width */
}
td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_close.png') no-repeat center center;
}
div.slider {
    display: none;
}
.custom-control-input:checked~.custom-control-label::before{
    color: #fff;
    border-color: #3be211;
    background-color: #34ad01;
    box-shadow: none;
}
</style>
@include('sweet::alert')

<?php }else{ ?>
  <script type="text/javascript">history.back(alert("Anda Tidak Memiliki Akses"))</script>
<?php die; } ?> 

@php
function cek_akses($aModul) {
    $level = Auth::user()->level;
    $username = Auth::user()->username;
    //query untuk mendapatkan iduser dari user           
    $quser = DB::table('users')->select('level')->where('username','=',$username)->first();
    $qry = DB::table('hak_akses')->select('id')->where([['usergroup','=',$quser->level],['modul','=',$aModul]])->count();
    if (1 > $qry) { return "no"; } else {return "yes";}
}
@endphp

@endsection
