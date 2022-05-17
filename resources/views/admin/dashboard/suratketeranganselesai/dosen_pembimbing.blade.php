
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
        @if ($message = Session::get('danger'))
         <div class="uk-alert uk-alert-danger" data-uk-alert>
            <a href="" class="uk-alert-close uk-close"></a>
           
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <strong>{{ $message }}</strong>
            </div>
            
        </div>
        @endif

        <div class="card card-info">
          <div class="card-header">
            <a href="#" class="tambahdosen btn btn-sm" data-id="{{$id_sks}}" style="float: right; background: #08203c">
              <span class="fa fa-plus"> </span> Tambah Dosen Pembimbing
            </a>
            <h3 class="card-title">Surat Keterangan Selesai (Dosen Pembimbing)</h3>
          </div>
         
          <div class="card-body">
            <div class="table-responsive">
            <table id="cekundangan" class="table table-striped table-bordered dt-responsive display">
              <thead>
              <tr>
                <th>No</th> 
                <th>Nomor Surat Dosen</th>
                <th>Nama Dosen</th>
                <th>NIDN</th>
                <th>Aksi</th>
              </tr>
           
              @forelse ($dosen as $key => $show2)
              <tr>
               <td>{{ $key + 1 }}</td>
               <td>{{ $show2->no_surat }}</td>
               <td>{{ $show2->nama_karyawan }}</td>
               <td>{{ $show2->nidn }}</td>
             
               <td>


                <a href="#" class="cekswal btn btn-xs btn-outline-danger " data-idkey="{{$show2->id}}" data-nama="{{$show2->nama_karyawan}}"><span class="fa fa-trash"></span></a> | 

                <a href="#" class="eddosen  btn btn-xs btn-outline-primary " 
                data-ideddos="{{$show2->id}}" 
                data-namadosen="{{$show2->id_dosen}}"
                 data-id_sks="{{$id_sks}}">
                  <span class="fa fa-edit"> </span>
                </a> | 


                 <a href="#" class="ednosu  btn btn-xs btn-outline-dark " 
                data-nosu="{{$show2->no_surat}}"
                data-ideddosnosu="{{$show2->id}}" >
                  <span class="fa fa-sort-numeric-up-alt"> </span>
                </a>

               </td>

              </tr>
              @empty
              <tr>
                <td colspan="100" style="text-align: center;">Tidak Ada Data</td>
              </tr>
              @endforelse
              </thead>
        
            </table>
            <a href="{{{ route('IndexSuratKeteranganSelesai') }}}" title="Kembali"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</div>
</div>


<!-------------------------------Cetak Setup Surat Tugas------------------------------------->
<div id="tambahdos" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
            <div id="overlay">
              
            </div>
              <div class="modal-header bg-info">
                  <h3 class="modal-title">Tambah Dosen Pembimbing</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                    <div class="modal-body">
                      <form data-route="{{ route('tamdospembimbingsks') }}" id="tamdos" role="form" method="POST" accept-charset="utf-8" target="_blank">
                      @csrf
                      <input type="hidden" name="id_sks" id="id_sks" value=""/>
                      
                      <div class="form-group">
                        <select class="selecttamdos" name="id_penguji" required="">
                          <option value=""> Pilih Pegawai</option>
                          @foreach($list_pegawai as $showdosen)
                          <option value="{{$showdosen->id_pegawai}}">{{ $showdosen->nama_karyawan }} | {{$showdosen->nidn}}</option>
                          @endforeach
                        </select>

                      </div>

                       <div class="modal-footer">
                          <button type="submit" class="join btn btn-primary"><span class="fa fa-plus"></span> Tambah</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    
                  </form> 
              </div>
          </div>
      </div>
</div>


<!-------------------------------Edit Dosen------------------------------------->
<div id="eddosen" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
            <div id="overlay2">
              
            </div>
              <div class="modal-header bg-info">
                  <h3 class="modal-title">Edit Dosen Pembimbing</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                    <div class="modal-body">
                      <form data-route="{{ route('eddospembimbingsks') }}" id="edmdos" role="form" method="POST" accept-charset="utf-8" target="_blank">
                      @csrf
                      <input type="hidden" name="id_sks_eddos" id="id_sks_eddos" value=""/>
                      <input type="hidden" name="id_sks" id="id_sks_utama" value=""/>
             

                      <div class="form-group cekperubahan">
                        <label>Pegawai</label>
                        <select class="selectedit cek_dosen" name="id_pembimbing_ed" required="">
                          @foreach($list_pegawai as $showdosen)
                          <option value="{{$showdosen->id_pegawai}}">{{ $showdosen->nama_karyawan }} | {{$showdosen->nidn}}</option>
                          @endforeach
                        </select>
                      </div>

                       <div class="modal-footer">
                          <button type="submit" class="join btn btn-primary"><span class="fa fa-plus"></span> Edit</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    
                  </form> 
              </div>
          </div>
      </div>
</div>
  
<!-------------------------------Edit Nomor Surat------------------------------------->
<div id="ednosu" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
            <div id="overlay2">
              
            </div>
              <div class="modal-header bg-info">
                  <h3 class="modal-title">Edit Nomor Surat</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                    <div class="modal-body">
                      <form data-route="{{ route('eddospembimbingsks') }}" id="edmdos" role="form" method="POST" accept-charset="utf-8" target="_blank">
                      @csrf
                      <input type="hidden" name="ideddosnosu" id="ideddosnosu" value=""/>
                      <input type="hidden" name="tipe_surat" value="ini_surat"/>
                      
                      <div class="form-group">
                        <label>Nomor Surat</label>
                        <input type="text" class="form-control" name="no_surat" id="no_surat" value=""/>
                      </div>

                       <div class="modal-footer">
                          <button type="submit" class="join btn btn-primary"><span class="fa fa-plus"></span> Edit</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    
                  </form> 
              </div>
          </div>
      </div>
</div>
  
@endsection
@section('script')

<script type="text/javascript">

$.noConflict();
jQuery( document ).ready(function( $ ) {

     $(document).on('submit', '#tamdos', function(e) {  
        e.preventDefault();
        var route = $('#tamdos').data('route');
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
                    $('#overlay').remove();
                    setTimeout(location.reload.bind(location), 2000);
                        
                  },
            error: function(xhr) { // if error occured
                      swal("Upsss!", 'Terjadi Kesalahan', "error");
                  },

        })
      });



     //Edit Data Dosen

     $(document).on('submit', '#edmdos', function(e) {  
        e.preventDefault();
        var route = $('#edmdos').data('route');
        var form_data = $(this);
        var wrapper = $("#overlay2");
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
              $(wrapper).append(  '<div class="overlay d-flex justify-content-center align-items-center">'+
                                      '<i class="fas fa-2x fa-sync fa-spin"></i>'+
                                      'Sedang Memproses Data'+
                                  '</div>');
             },
            success: function(response){
              console.log(response)
              swal(response.success, "", "success")
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
                    $('#overlay2').remove();
                    setTimeout(location.reload.bind(location), 2000);
                        
                  },
            error: function(xhr) { // if error occured
                      swal("Upsss!", 'Terjadi Kesalahan', "error");
                  },

        })
      });


    //Hapus Data Dosen

    $(document).on('click', '.cekswal', function(){
      idkey = $(this).attr('data-idkey');
      nama_dospen = $(this).attr('data-nama');
      swal({
        title: "Apakah Anda Yakin?",
        text: "Menghapus "+nama_dospen+"!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {

          $.ajax({
           url:"../destroydospensks/"+idkey+"/proses/",

          beforeSend:function(){
            Pace.restart()
           },
          success:function(data)
           {
            console.log();
            
            setTimeout(location.reload.bind(location), 2000);
           
            swal("Berhasil! Menghapus Data!", {
              icon: "success",

           
            });
           },
          error: function(xhr) { // if error occured
                swal("Upsss!", "Terjadi Kesalahan!", "error");
                
            },
          })  
        } else {
          swal("Batal Untuk Melakukan Proses!");
        }
      });
     });

    //tambah dosen
    $(document).on('click', '.tambahdosen', function(){
      id = $(this).attr('data-id');
      $("#id_sks").val(id);
      $('#tambahdos').modal('show');
    });


    //edit dosen
    $(document).on('click', '.eddosen', function(){
      id = $(this).attr('data-ideddos');
      id_dosen = $(this).attr('data-namadosen');
      no_surat = $(this).attr('data-nosu');
      id_sks = $(this).attr('data-id_sks');
      console.log(id)
      //$('.cek_dosen option[value=8]').attr('selected','selected');
      $("#id_sks_eddos").val(id);
      $("#id_sks_utama").val(id_sks);
      $("#no_surat").val(no_surat);
      $('#eddosen').modal('show');


      $("div.cekperubahan select").val(id_dosen);

      $('.selectedit').select2({
        theme: 'bootstrap4'
      });

      
    })
     //edit nomor surat
    $(document).on('click', '.ednosu', function(){
      
      no_surat = $(this).attr('data-nosu');
      id_utama = $(this).attr('data-ideddosnosu');
      $("#ideddosnosu").val(id_utama);
      $("#no_surat").val(no_surat);
      $('#ednosu').modal('show');

      
    })

    $('.selecttamdos').select2({
        theme: 'bootstrap4'
      });
});

</script>


@include('sweet::alert')
@endsection
