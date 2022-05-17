
@extends('admin.layout.master')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />

<?php if(cek_akses('54') == 'yes'){
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
      <span class="badge badge-danger">catatan</span><br>
       <font size="1">*Jika terjadi perubahan pada blok merah pada <b>surat tugas penguji</b>, jangan lupa mengantinya juga dibagian undangannya</font><br>
       <font size="1">*Dalam pembuatan khususnya <b>surat tugas penguji</b>, pastikan undangannya sudah dibuat terlebih dahulu</b></font>

        <div class="card">
            <div class="card-body bg-dark p-2"> 

            <h3 class="card-title">Surat Tugas | </h3>&nbsp;
              <?php if(cek_akses('55') == 'yes'){ ?>
                 <a href="#" class="link_tipe btn btn-sm bg-info" >
                            <span class="fa fa-plus"> </span> Tambah Surat Tugas
                          </a>
              <?php }else{ ?>
              <a href="#" class="btn btn-sm bg-info"  onclick="myFunction()">
                            <span class="fa fa-plus"> </span> Tambah Surat Tugas
                          </a>
                <script type="text/javascript">
                 function myFunction() {
                    alert("Anda Tidak Memiliki Akses");
                  }
                </script>
              <?php } ?> 

              <a class="btn btn-sm btn-outline-info" data-toggle="collapse" href="#collapseExample123" role="button" aria-expanded="false" aria-controls="collapseExample123">
                  <span class="fa fa-print"> </span> Multiple Print
              </a>

               <form action="{{ route('setupcetak_srttgspembimbing') }}" role="form" method="POST" accept-charset="utf-8" target="_blank">
                    @csrf
                <div class="collapse" id="collapseExample123">
                  <hr class="bg-warning">
                  <div class="card card-body bg-dark">

                    <div class="row">

                        <div class="col-3">
                          <div class="form-group">
                            @php
                            $year = DB::table('a_srt_tgs_pembimbing')->select('tahun')->groupby('tahun')->get();
                            @endphp
                              <select class="form-control PilihTahun" id="Year" name="PilihTahun">
                                <option value="">Pilih Tahun</option>
                                @forelse($year as $jy => $Vyear)
                                <option value="{{ $Vyear->tahun }}">{{ $Vyear->tahun }}</option>
                                @empty
                                <option value="">Tidak Ada Data</option>
                                @endforelse
                              </select>
                            </div>
                          </div>
                      </div>

                    <div class="row">
                      <div class="col-9">
                        <div class="form-group">
                        <label>Pilih Nomor Surat :</label>
                            <div class="table-responsive">

                              <div id="post_data"></div>
                            </div>
                        </div>
                      </div>
                      <hr>

                      <div class="col-3">
                        <div class="form-group">
                          <label>Opsi Lain :</label><br>
                          <div class="icheck-primary d-inline"  style="cursor:pointer;">
                            <input type="checkbox" id="checkboxPrimaryttdasw"  name="ttd" value="1" checked>
                            <label for="checkboxPrimaryttdasw">
                              TTD Pak Aswandi
                            </label>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="icheck-primary d-inline">
                            <input  type="checkbox" name="cap_uvers" value="1" id="customCheckbox233" checked >
                            <label for="customCheckbox233">Cap Uvers</label>
                          </div>
                        </div>
                        <div class="form-group">
                        <div class="icheck-primary d-inline">
                          <input  type="checkbox" name="sebagai" value="1" id="fgs" checked >
                          <label for="fgs">Sebagai?</label>
                        </div>
                        </div>
                          <hr class="bg-secondary">
                        <div class="form-group">
                          <label>Tanggal Diinginkan :</label>
                          <input type="date" class="form-control" id="tgl_diinginkan2" name="tgl_diinginkan">
                        </div>
                        <div class="form-group">
                          <div class="icheck-primary d-inline">
                            <input type="checkbox" name="TglInput" value="1" id="TglInput2" style="padding-right: 0px;">
                            <label for="TglInput2" >Gunakan Tanggal Input</label>
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="icheck-primary d-inline">
                            <input type="checkbox" name="TglHrini" value="1" id="TglHrIni" style="padding-right: 0px;">
                            <label for="TglHrIni" >Gunakan Tanggal Hari Ini</label>
                          </div>
                        </div><br><br><br>
                        <button type="submit" class="join btn btn-outline-primary" style="float: right;"><span class="fa fa-print"></span> Cetak Surat Tugas</button>
                      </div>

                  </div>
                  </div>
                </div>
              </form>

            <hr class="m-2">

            <div class="table-responsive">
            <table id="index212" class="table table-striped table-bordered display table-dark table-hover" width="100%">
              <thead>
              <tr>
                <th><span class="fa fa-eye"></span></th>
                <th></th>
                <th nowrap="">Nomor Surat</th>
                <th>Dosen</th>
                <th>Prodi</th>
                <th>Nama MK</th>
                <th>Mahasiswa</th>
                <th nowrap="">Semester & Tahun ajar</th>
                <th>Jenis</th>
                </tr>
              </thead>
        
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


<!-------------------------------URUTAN PEMBIMBING------------------------------------->
<div id="linkUrtPem" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
         <div id="overlayUrtPem"></div>
          <div class="modal-header">
            <h3 class="modal-title">Urutan Pembimbing</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="shadow p-3 mb-5 bg-white rounded" id="KontenUrtPem"></div>

            <code><span class="badge badge-pill badge-success">&nbsp;</span> pertama</code>
            <code><span class="badge badge-pill badge-warning">&nbsp;</span> kedua</code>
            <code><span class="badge badge-pill badge-danger">&nbsp;</span> ketiga</code>
            <code><span class="badge badge-pill badge-secondary">&nbsp;</span> Solo/Sendiri</code>
          </div>
      </div>
  </div>
</div>


<!-------------------------------Update nomor surat------------------------------------->
<div id="updatenosu" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
             <div id="overlay">
              
            </div>
              <div class="modal-header">
                  <h3 class="modal-title">Update Nomor Surat Tugas</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                    <div class="modal-body">
                      <form data-route="{{ route('upsrttgspembimbing') }}"  id="updatenosiu" role="form" method="POST" accept-charset="utf-8">
                      @csrf
                      <input type="hidden" name="id" id="id" value=""/>
                      
                      <div class="form-group">
                        <label for="surat_tugas">Nomor Surat Tugas :<font color="red" size="2px">*</font></label>
                        <div title="Nomor Surat">

                          <div class="input-group">
                     
                             <input type="text" name="no_surat" class="form-control" autocomplete="off" placeholder="No.Surat " required="" style="max-width: 100px;">

                             <input type="hidden" name="nosusuto" value="{{ $nosu }}">

                              <div class="input-group-prepend">
                              <span class="input-group-text">{{ $nosu }}</span>
                            </div>
                          </div>
                          <small class="help-block"></small>
                        </div>
                      </div>
                       <div class="modal-footer">
                          <button type="submit" class="join btn btn-primary">Update Nomor Surat</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    
                  </form> 
              </div>
          </div>
      </div>
  </div>

<!-------------------------------Cetak Setup Surat Tugas------------------------------------->
<div id="setupcetak" class="modal fade" role="dialog">
      <div class="modal-dialog" >
          <div class="modal-content  bg-dark">
             <div id="overlay">
              
            </div>
              <div class="modal-header">
                  <h3 class="modal-title">Setup Cetak Surat Tugas</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                    <div class="modal-body">
                      <form action="{{ route('setupcetak_srttgspembimbing') }}" role="form" method="POST" accept-charset="utf-8" target="_blank">
                      @csrf
                      <input type="hidden" name="id[]" id="id_cetak" value=""/>
                      
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="ttd" value="1" id="customCheckbox2" checked style="padding-right: 0px;">
                          <label for="customCheckbox2" class="custom-control-label">Ttd Pak Aswandi</label>
                        </div>

                          <div class="custom-control custom-checkbox">
                              <input class="custom-control-input" type="checkbox" name="cap_uvers" value="1" id="customCheckbox2333" checked style="padding-right: 0px;">
                              <label for="customCheckbox2333" class="custom-control-label">Cap Uvers</label>
                            </div>

                      </div>
                      
                      <div class="form-group">
                        <div class="custom-control custom-checkbox">
                          <input class="custom-control-input" type="checkbox" name="sebagai" value="1" id="bsfg3" checked style="padding-right: 0px;">
                          <label for="bsfg3" class="custom-control-label">Sebagai ?</label>
                        </div>
                      </div>

                      <label>Custom Sebagai :</label>
                      <div id="optionAnggota"></div> 

                      <hr>
                      <div class="form-group">
                        <label >Tanggal Diinginkan</label>
                        <input type="date" class="form-control" id="tgl_diinginkan" name="tgl_diinginkan">
                      </div>

                      <div class="form-group">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="TglInput" value="1" id="TglInput" style="padding-right: 0px;">
                            <label for="TglInput" class="custom-control-label">Gunakan Tanggal Input</label>
                          </div>
                      </div>

                       <div class="modal-footer">
                          <button type="submit" class="join btn btn-primary"><span class="fa fa-print"></span> Cetak Surat Tugas</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    
                  </form> 
              </div>
          </div>
      </div>
</div>

<!-------------------------------Link Surat Tugas Pembimbing Atau Penguji------------------------------------->
<div id="link_surat" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
             <div id="overlay">
              
            </div>
              <div class="modal-header">
                  <h3 class="modal-title">Pilih Jenis Surat Tugas</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                    <div class="modal-body">

                      <div class="form-group">
                       <a href="{{ Route('showformtambah-rtz') }}"><button class="btn btn-outline-primary btn-sm" ><span class="fa fa-envelope-open-text"></span> Surat Tugas Pembimbing</button></a>

                      <button type="button" class="srt_penguji btn btn-outline-info btn-sm" ><span class="fa fa-envelope-open-text"></span> Surat Tugas Penguji</button>

                      </div> 
              </div>
          </div>
      </div>
</div>

<!-------------------------------Surat Tugas Penguji------------------------------------->


  <div id="srt_penguji" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
             <div id="overlay">
              
            </div>
              <div class="modal-header">
                  <h3 class="modal-title">Pilih Nomor Surat Undangan</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <form action="{{ route('surattugaspenguji') }}" role="form" method="POST" accept-charset="utf-8" onsubmit="return confirm('Apakah Anda Yakin Dengan Nomor Surat Undangan Yang Dipilih ? ');">
                @csrf
                  <div class="modal-body">
                    <div class="form-group">
                    <label for="nomor surat undangan">Nomor Surat Undangan<font color="red" size="2px">*</font> :</label>
                      <select name="id_surat_udg" class="form-control select" required="" ><option value="">Pilih Nomor Surat</option> @foreach ($nosu_udg as $nosu_udg_show)<option value="{{$nosu_udg_show->id_undangan}}">{{$nosu_udg_show->no_surat}} | <span class="badge badge-pill badge-primary">{{$nosu_udg_show->nim}}</span> | {{$nosu_udg_show->nama}}</option> @endforeach </select>
                    </div>
                    <div class="form-group">
                    <label for="nomor surat undangan">Semester<font color="red" size="2px">*</font> :</label>
                      <select name="semester" class="form-control" required="" >
                          @foreach($semester as $v_semester)
                          <option value="{{ $v_semester->semester }}">{{ $v_semester->semester }}</option>
                          @endforeach  
                      </select>

                    </div>
                    <div class="form-group" >
                          <label for="tahun_ajar">Tahun Ajar<font color="red" size="2px">*</font> :</label>
                          <select id="tahun_ajar" name="tahun_ajar" class="form-control" required="" >
                            @foreach($thnajar as $v_thnajar)
                            <option value="{{ $v_thnajar->tahun_ajar }}">{{ $v_thnajar->tahun_ajar }}</option>
                            @endforeach           
                          </select>
                      <br>
                      <a href="{{Route('indexAwal')}}"><span class="far fa fa-calendar-alt nav-icon"></span> Tahun Ajar </a>
                      </div>


                     <div class="modal-footer">
                        <button type="submit" class="join btn btn-primary"><span class="fa fa-print"></span> Simpan Data Untuk Surat Tugas Penguji</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                  </div>
              </form>
          </div>
      </div>
</div>
  
@endsection
@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>

<script type="text/javascript">
function format ( d ) {
    return 'Nama Mahasiswa : <small class="badge badge-info"><i class="far fa fa-user"></i> ' +d.nama+'</small>  '+
            '<hr>'+
            '<button type="submit" class="upatenosu btn btn-outline-primary btn-sm" data-id="'+d.id+'"><span class="fa fa-sort-numeric-up-alt"></span> Nomor Surat</button>'+

            ' | <button type="submit" class="setupcetak btn btn-outline-info btn-sm" data-id="'+d.id+'"><span class="fa fa-print"></span> Setup Cetak</button>'+

            ''+d.action+''

}
$.noConflict();
jQuery( document ).ready(function( $ ) {
    
 var dt =  $('#index212').DataTable({
        processing: true,
        serverSide: true,
        bStateSave : true,
        ajax: '{!! route('GD.srttgspembimbing') !!}',
        language: {
            "infoFiltered":"",
            "processing": '<img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 30%;">',
            "searchPlaceholder": "Masukan Nama Mahasiswa",
        },
        order: [ [1, 'DESC'],[2, 'DESC'] ], 
        columns: [

            {
                "class":          "details-control",
                "orderable":      false,
                //"data" : 'id',
                "defaultContent": "",
            }, 
            { data: 'tahun', name: 'tahun', visible:false},
            { data: 'no_surat', name: 'no_surat' },
            { data: 'nama_karyawan', name: 'pegawai.nama_karyawan', 

            render: function ( data, type, row ) {

                  var product_id = row.id_udg;
                  var url = '{{ route("ShowDosenPenguji", ":id") }}';
                  url = url.replace(':id',product_id);

                  if (row.id_udg != null) {
                    return '<a href="'+url+'"><span class="badge badge-success">'+row.jumlah_dosenpenguji+' penguji | <span class="fa fa-mouse-pointer"></span></span></a>';

                  }else{
                    if (row.urutan_pembimbing == 1) {
                        return row.nama_karyawan + ' <a class="urtPemb" data_id="'+row.id+'" style="cursor: pointer;"><span class="badge badge-pill badge-success">#'+row.urutan_pembimbing+'</span></a>';
                    }else if(row.urutan_pembimbing == 2){
                        return row.nama_karyawan + ' <a class="urtPemb" data_id="'+row.id+'" style="cursor: pointer;"><span class="badge badge-pill badge-warning">#'+row.urutan_pembimbing+'</span></a>';
                    }else if(row.urutan_pembimbing == 3){
                        return row.nama_karyawan + ' <a class="urtPemb" data_id="'+row.id+'" style="cursor: pointer;"><span class="badge badge-pill badge-danger">#'+row.urutan_pembimbing+'</span></a>';
                    }else{
                        return row.nama_karyawan;
                    }
                  }
              },

            },
            { data: 'nama_prodi', name: 'a_prodi.nama_prodi' },
            { data: 'nama_mk', name: 'a_nama_mk.nama_mk', 

             render: function ( data, type, row ) {
                  return row.nama_mk + ' | ' + row.jenis_mk + '';
              },

            },
            { data: 'nama', name: 'a_tbl_mhs.nama' },


            { data: 'semester',
              render: function ( data, type, row ) {
                  return row.semester + ' - ' + row.tahun_ajar + '';
              },
            },
            { data: 'jenis_surat', name: 'jenis_surat' },

            //{ data: 'action', name: 'action' },
        ],

        createdRow: function ( row, data, index ) {

              //pewarnaan untuk perpanjangan surat tugas pembimbing
              if ( data['jenis_surat'] == 'Perpanjangan' ) {
                  $('td', row).eq(7).addClass('bg-success');
              } else if(data['jenis_surat'] == 'Peralihan') {
                  $('td', row).eq(7).addClass('bg-primary');
              }else{
                  $('td', row).eq(7).addClass('bg-info');
              }

              if (data['id_udg'] === null) {
               
              }else{
                $('td', row).eq(3).addClass('bg-danger');
                $('td', row).eq(4).addClass('bg-danger');
                $('td', row).eq(5).addClass('bg-danger');
              }
              if (data['bentuk_mbkm'] == null) {

              }else{
                $('td', row).eq(4).addClass('bg-info');
              }
              $('td', row).eq(4).attr("nowrap","nowrap");
            },

         
    });


    //URUTAN PEMBIMBING
    $(document).on('click', '.urtPemb', function(){
      id = $(this).attr('data_id');
      var wrapper = $("#overlayUrtPem");
      Pace.track(function(){
        $.post('{{ Route('CekUrtPem') }}', {
            _token: "{{ csrf_token() }}",
            data_id:id,
            beforeSend: function(){Pace.restart();},
        }).done(function(data, response) {
          
            $('#KontenUrtPem').html(data.tableUrtPem);


            $('input[type=radio][name=RadioUrtPem]').change(function() {
                $.post('{{ Route('PostUpdateCekUrtPem') }}', {
                    _token: "{{ csrf_token() }}",
                    data_radio:this.value,
                    data_id:id,
                    beforeSend: function(){
                      $(wrapper).append(  '<div id="kjuty" class="overlay d-flex justify-content-center align-items-center">'+
                                            '<i class="fas fa-2x fa-sync fa-spin"></i>'+
                                            'Sedang Memproses Data'+
                                        '</div>');
                      Pace.restart();
                    },
                }).done(function(data, response) {

                  switch(data.cekUrt){
                    case '1': /*First case */
                    toastr.success('Data Berhasil Diubah.')
                    $('#index212').DataTable().ajax.reload(null, false);
                    break;
                    case '1': /*First case */
                    toastr.error('Data Gagal Di Ubah.')
                    break;
                   
                    default:
                  }

                }).fail(function() {alert( "Terjadi Kesalahan" );}).always(function() {$('#kjuty').remove();});
            });


        }).fail(function() {
          alert( "Terjadi Kesalahan" );
        })
      });
    });
     
    $(document).on('click', '.urtPemb', function(){
      $('#linkUrtPem').modal('show');
    });

     //tipe surat penguji
    $(document).on('click', '.srt_penguji', function(){
      $('#srt_penguji').modal('show');
      $('#link_surat').modal('hide');
    });


    //Pilih Tipe Surat Tugas
    $(document).on('click', '.link_tipe', function(){
      $('#link_surat').modal('show');
    });

    //nodal update nosurat
    $(document).on('click', '.upatenosu', function(){
      id = $(this).attr('data-id');
      $("#id").val(id);
      $('#updatenosu').modal('show');
    });


    //komunikasi update nomor surat ke server
    $(document).on('submit', '#updatenosiu', function(e) {  
      e.preventDefault();
      var route = $('#updatenosiu').data('route');
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
            
              setTimeout(function(){
                swal("Berhasil!", "Berhasil Menyimpan Data", "success");
                 $('#index212').DataTable().ajax.reload();
                }, 1000);
            },
          complete: function() {
                $('#overlay').remove();
                $('#updatenosu').modal('hide');
                $.unblockUI();

                },
          error: function(xhr) { // if error occured
                    swal("Upsss!", "Mungkin nomor surat sudah ada atau kesalahan lainnya", "error");
                },

      })
    });


  $(document).on('click', '.setupcetak', function(){
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } });
      var id = $(this).attr('data-id');
      url = '{{route("CekOptionUDG", ":IdPeg")}}'.replace(":IdPeg", id),
          $.ajax({
              url: url,
              method: "POST",
              data:{jenis:'srttgs'},
              beforeSend: function () {
                  $.blockUI({ css: { border: "none", padding: "5px", backgroundColor: "#000", "-webkit-border-radius": "5px", "-moz-border-radius": "5px", opacity: 0.5, color: "#fff" } }), 
                  Pace.restart();
              },
              success: function (e) {
                  $("#optionAnggota").html(e), 
                  $("#setupcetak").modal("show"), 
                  $.unblockUI(), 
                  $("#id_cetak").val(id);
              },
          });
    });


    //DISABLED FORM TANGGAL YANG DIINGINKAN JIKA INPUT MENGGUNKANA TANGGAL INPUT
    $(document).on('click', '#TglInput', function(){
    if (document.getElementById('TglInput').checked == true) {
        $("#tgl_diinginkan").prop('disabled', true);
      }else{
        $("#tgl_diinginkan").prop('disabled', false);
      }
    });

    //DISABLED FORM TANGGAL YANG DIINGINKAN JIKA INPUT MENGGUNKANA TANGGAL INPUT
    $(document).on('click', '#TglInput2', function(){
    if (document.getElementById('TglInput2').checked == true) {
        $("#tgl_diinginkan2").prop('disabled', true);
        $("#TglHrIni").prop('checked', false);
      }else{
        $("#tgl_diinginkan2").prop('disabled', false);
      }
    });
    //DISABLED FORM TANGGAL YANG DIINGINKAN JIKA INPUT MENGGUNKANA TANGGAL HARI INI
    $(document).on('click', '#TglHrIni', function(){
    if (document.getElementById('TglHrIni').checked == true) {
        $("#tgl_diinginkan2").prop('disabled', true);
        $("#TglInput2").prop('checked', false);
      }else{
        $("#tgl_diinginkan2").prop('disabled', false);
      }
    });



     var detailRows = [];
 
    $('#index212 tbody').on( 'click', 'tr td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = dt.row( tr );
        var idx = $.inArray( tr.attr('id'), detailRows );
 
        if ( row.child.isShown() ) {
            tr.removeClass( 'details' );
            row.child.hide();
 
            // Remove from the 'open' array
            detailRows.splice( idx, 1 );
        }
        else {
            tr.addClass( 'details' );
            row.child( format( row.data() ) ).show();
 
            // Add to the 'open' array
            if ( idx === -1 ) {
                detailRows.push( tr.attr('id') );
            }
        }
    });
     // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    } );


    $('.select').select2({
      theme: 'bootstrap4'
    });




  $(function() {
    var tahun;  //TEMPORARY VARIABLE UNTUK TAHUN
    //EVENT PILIH TAHUN SAAT MULTIPLE
    $( ".PilihTahun" ).change(function() {
        //gET DATA LOAD MORE multiple print
        var _token = $('input[name="_token"]').val();
        var tahun = this.value;
        window.tahun = this.value;

        load_data_pindah_tahun(_token,tahun);

    });

    $(document).on('click', '#load_more_button', function(){
      var id = $(this).data('id');
      var ns = $(this).data('ns');
      var var2 = window.tahun;

      var _token = $('input[name="_token"]').val();
      $('#load_more_button').html('Loading...');

      load_data_more(_token,var2,ns);
    });
  });

     //LOAD UNTUK PERTAMA MULTIPLE
     function load_data_pindah_tahun( _token,tahun,ns)
       {
        $.ajax({
         url:"{{ Route('loadmore.load_data') }}",

         method:"POST",
         data:{_token:_token, tahun:tahun, ns:ns},
         beforeSend: function(){ Pace.restart();
          $('#post_data').html('<center><img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 10%;"></center>');
          
         },
         success:function(data)
         {
          $('#load_more_button').remove();
          $('#sisa').remove();
          $('#post_data').html(data.cek);
         }
        })
       }

    //LOAD UNTUK SELANJUTNYA
    function load_data_more(_token,var2,ns)
       {
        $.ajax({
         url:"{{ Route('loadmore.load_data') }}",

         method:"POST",
         data:{_token:_token, tahun:var2, ns:ns},
         beforeSend: function(){Pace.restart();},
         success:function(data)
         {
          $('#load_more_button').remove();
          $('#sisa').remove();
          $('#post_data').append(data.cek);
         }
        })
       }

});

</script>


<script type="text/javascript">
 jQuery( document ).ready(function( $ ) {

  $('[data-toggle="penjelasan"]').tooltip()
  
})

 //CHECK ALL 
function toggle(source) {
  checkboxes = document.getElementsByName('id[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;

  }
}
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

.select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice { background-color: #ffffff !important; color: black; }
.select2-dropdown .select2-results__option[aria-selected=true] {background-color: #c7b90f !important; color: black;}
.select2-selection{background-color: #ffffff !important; color: black;}
.select2-container--bootstrap4 .select2-selection--multiple .select2-selection__choice {
    background-color: #ebee15 !important;
  }


</style>


@include('sweet::alert')
@endsection
