
@extends('admin.layout.master')

@section('content')
<?php if(cek_akses('65') == 'yes'){
}else{ ?>
  <script type="text/javascript">history.back(alert("Anda Tidak Memiliki Akses"))</script>
<?php } ?> 

<div class="container-fluid"> 
    <div class="row">
      <div class="col-12">

        <font size="2" color="blue"><b>* S-U : Status Upload</b></font>

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

        <div class="card card-success">
          <div class="card-body bg-dark p-2">
            <h3 class="card-title">Surat Undangan | </h3>&nbsp;
            <a href="{{ Route('showtambahudg-ert') }}" class="btn btn-sm btn-info">
              <span class="fa fa-plus"> </span> Tambah Surat Undangan
            </a>

            <a class="btn btn-sm btn-outline-info" data-toggle="collapse" href="#collapseExample123" role="button" aria-expanded="false" aria-controls="collapseExample123">
              <span class="fa fa-print"> </span> Multiple Print
            </a>

             <form action="{{ route('setupcetak.udgpenguji') }}" role="form" method="POST" accept-charset="utf-8" target="_blank">
              @csrf
              <div class="collapse" id="collapseExample123">
                <div class="card card-body bg-dark">

                  <div class="row">
 
                    <div class="col-3">
                      <div class="form-group">
                        @php
                        $year = DB::table('a_srt_udg_penguji')->select('tahun')->groupby('tahun')->get();
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
            <table id="cekundangan" class="table table-striped table-bordered display table-dark table-hover" width="100%">
              <thead>
              <tr>
                <th><span class="fa fa-eye"></span></th>
                <th></th>
                <th></th>
                <th nowrap="">Nomor Surat</th> 
                <th nowrap="">Nama Mahasiswa</th>
                <th nowrap="">Prodi</th>
                <th nowrap="">Tanggal</th>
                <th nowrap="">Berkas Administrasi</th>
                <th nowrap="">S-U</th>
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


<!-------------------------------Update nomor surat------------------------------------->
<div id="updatenosu" class="modal fade" role="dialog">
  <div class="modal-dialog">
      <div class="modal-content">
         <div id="overlay">
          
        </div>
          <div class="modal-header">
              <h3 class="modal-title">Update Nomor Surat Undangan</h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
                <div class="modal-body">
                  <form data-route="{{ route('updatenosu-oih2') }}"  id="updatenosiu-oih2" role="form" method="POST" accept-charset="utf-8">
                  @csrf
                  <input type="hidden" name="id" id="id" value=""/>
                  
                  <div class="form-group">
                    <label for="surat undangan">Nomor Surat Undangan :<font color="red" size="2px">*</font></label>
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

  <!-------------------------------Cetak Setup Surat undangan------------------------------------->
<div id="setupcetak" class="modal fade" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content bg-dark">
             <div id="overlay">
              
            </div>
              <div class="modal-header">
                  <h3 class="modal-title">Setup Undangan</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                    <div class="modal-body">
                      <form action="{{ route('setupcetak.udgpenguji') }}" role="form" method="POST" accept-charset="utf-8" target="_blank">
                      @csrf
                      <input type="hidden" name="id[]" id="id_cetak" value="" required="" />
                      
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

                      <label >Custom Sebagai :</label>
                      <div id="optionAnggota"></div> 
                  

                      <hr>
                      <div class="form-group">
                        <label >Tanggal Diinginkan</label>
                        <input type="date" class="form-control" id="tgl_diinginkan" name="tgl_diinginkan">
                      </div>

                      <div class="form-group">
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="TglInput" value="1" id="TglInput" style="cursor:pointer padding-right: 0px;">
                            <label for="TglInput" class="custom-control-label">Gunakan Tanggal Input</label>
                          </div>
                      </div>

                       <div class="modal-footer">
                          <button type="submit" class="join btn btn-primary"><span class="fa fa-print"></span> Cetak Surat Undangan</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    
                  </form> 
              </div>
          </div>
      </div>
</div>




<!------------------------------Upload Berkas Hasil Scan------------------------------------->
<div id="upload_berkas" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
          <div class="modal-content">
             <div id="overlay">
              
            </div>
              <div class="modal-header bg-primary">
                  <h3 class="modal-title">Upload Berkas</h3>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
                    <div class="modal-body">
                      <form action="{{ route('BerkasScanUpload') }}" role="form" method="POST" accept-charset="utf-8" enctype='multipart/form-data'>
                      @csrf
                      <input type="hidden" name="id_sks" id="id_sks_upload_berkas" value=""/>
                      
                      
                      <div class="form-group row">
                        
                        <div class="shadow-sm p-3 mb-1 bg-white rounded col-12">
                          <label>Kategori dan Jenis File : </label>
                         <input type="text" name="kategori_berkas" class="form-control" id="jenis_mk_buff" readonly="" />
                         <hr>
                         <label>Nama Mahasiswa : </label>
                         <input type="text" class="form-control" id="nama_mhs_show" readonly="" />
                         </div>
                         
                     
                      </div>


                      <label>Masukan Nama Lampiran : </label>
                      <div class="form-group row">
                        <div class="shadow-sm p-3 mb-1 bg-white rounded col-12">
                          <textarea class="form-control" name="nama_lampiran" placeholder="Surat Keterangan Pelaksanaan Pembimbing Tugas Akhir Semester Genap T.A. 2018/2019" required=""></textarea>
                          <font size="2px" color="red">*Pastikan Magang dan TA Terisi Benar (Tidak Terbalik)</font>  
                        </div>
                      
                      </div>

                      <label>Pilih Berkas : </label>
                      <div class="form-group row">
                        <div class="shadow-sm p-3 mb-1 bg-white rounded col-12">
                          <input type="file" name="files" id="someId" class="form-control" required="">
                          <font size="2px" color="red">*Hanya file PDF yang diizinkan</font>  
                        </div>
                      
                      </div>


                       <div class="modal-footer">
                          <button type="submit" class="join btn btn-primary"><span class="fa fa-upload"></span> Upload File/Berkas</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    
                  </form> 
              </div>
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

@endsection
@section('script')
<script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script type="text/javascript">



function format ( d ) {

    return '<div class="slider">'+  
      'lampiran : <small class="badge badge-warning"><i class="far fa fa-home"></i> '+d.lampiran+'</small> '+
                '<hr style="margin-top: 0.5rem;  margin-bottom: 0.5rem;">'+
                '<table id="surattugas" class="table table-striped">'+
                     '<thead style="background-color: #08203c; color: white">'+
                      '<tr>'+
                        '<th style="width: 200px;">Nama Kegiatan</th>'+
                        '<th style="width: 500px;">Ruangan</th>'+
                        '<th style="width: 500px;">Jam Pelaksanaan</th>'+
                        '<th style="width: 500px;">Judul</th>'+
                        '<th style="width: 500px;">Dos Pembimbing X Penguji</th>'+
                        '</tr>'+
                      '</thead>'+
                      '<tbody>'+
                            '<tr>'+
                                '<td>'+d.nama_mk+'</td>'+
                                '<td><b>'+d.nama_ruangan+'</b></td>'+
                                '<td><b>'+d.jam_mulai+' - '+d.jam_selesai+'</b></td>'+
                                '<td>'+d.judul_con+'</td>'+
                                '<td>'+d.pembimbing + ' | ' +d.penguji+'</td>'+

                            '</tr>'+
                      '</tbody>'+
                '</table>'+
                '<hr style="margin-top: 0.4rem;  margin-bottom: 0.4rem;">'+
                '<button type="submit" class="upatenosu btn btn-outline-primary btn-sm" data-id="'+d.id_undangan+'"><span class="fa fa-sort-numeric-up-alt"></span> Nomor Surat</button> | '+

                '<button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-file"></span> Berkas Scan'+
                '</button>'+

                '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'+
                  ''+d.upload_berkas_cek+''+
                  ''+d.destroy_berkas+''+ 
                  ''+d.preview_berkas+''+
                '</div> '+


                //'| <button type="submit" class="upload_berkas btn btn-outline-dark btn-sm" data-id="'+d.id_undangan+'" jenis_mk="'+d.jenis_berkas_adm+'"><span class="fa fa-upload"></span> Upload berkas</button>'+

                ' | <button type="submit" class="setupcetak btn btn-outline-info btn-sm" data-id="'+d.id_undangan+'"><span class="fa fa-print"></span> Setup Cetak Undangan</button>'+
               
                

                ' | '+d.action+''+
              '</div>'
  
  }

$.noConflict();
jQuery( document ).ready(function( $ ) {

 var dt =  $('#cekundangan').DataTable({
        processing: true,
        serverSide: true,
        //bStateSave : true,
        //scrollY : false,

        order: [[ 2, "DESC" ],[3,"DESC"]],
        ajax: '{!! route('gd.indexundangan') !!}',
        language: {
            "infoFiltered":"",
            "processing": '<img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 30%;">',
            "searchPlaceholder": "Masukan Nama Mahasiswa",
        },
        columns: [
            {
                "class":          "details-control",
                "orderable":      false,
                //"data" : 'id',
                "defaultContent": "",
            }, 
            { data: 'id_undangan', name: 'id_undangan', visible: false },
            { data: 'tahun', name: 'tahun', visible: false },
            { data: 'no_surat', name: 'no_surat' },
            { data: 'nama', name: 'a_tbl_mhs.nama',
              render: function ( data, type, row ) {
                  return '<i class="far fa fa-user-graduate">&nbsp;</i>'+row.nama
              },
            },
            { data: 'nama_prodi', name: 'a_prodi.nama_prodi' },
        
            
            { data: 'tanggal_pelaksanaan',
              render: function ( data, type, row ) {
                  return moment(row.tanggal_pelaksanaan).format("LL")
              },
            },
            { data: 'nama_berkas', name: 'a_berkas_adm.nama_berkas' },
            { data: 'status_upload_scan', name: 'status_upload_scan' },
            //{ data: 'action', name: 'action' },
        ],

        createdRow: function ( row, data, index ) {
            $('td', row).eq(2).attr("nowrap","nowrap");
            $('td', row).eq(3).attr("nowrap","nowrap");
            $('td', row).eq(4).attr("nowrap","nowrap");
          },


    });
    var detailRows = [];
 
      // Add event listener for opening and closing details
    $('#cekundangan tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = dt.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            $('div.slider', row.child()).slideUp( function () {
                row.child.hide();
                tr.removeClass('shown');
            } );
        }
        else {
            // Open this row
            row.child( format(row.data()), 'no-padding' ).show();
            tr.addClass('shown');
 
            $('div.slider', row.child()).slideDown();
        }
    } );
     // On each draw, loop over the `detailRows` array and show any child rows
    dt.on( 'draw', function () {
        $.each( detailRows, function ( i, id ) {
            $('#'+id+' td.details-control').trigger( 'click' );
        } );
    } );

    //nodal Setup Cetak Surat Undangan 
    $(document).on('click', '.setupcetak', function(){
      $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } });
      var id = $(this).attr('data-id');
        url = '{{route("CekOptionUDG", ":IdPeg")}}'.replace(":IdPeg", id),
            $.ajax({
                url: url,
                method: "POST",
                data:{jenis:'srttgsudg'},
                beforeSend: function () {
                    $.blockUI({ css: { border: "none", padding: "5px", backgroundColor: "#000", "-webkit-border-radius": "5px", "-moz-border-radius": "5px", opacity: 0.5, color: "#fff" } }), Pace.restart();
                },
                success: function (e) {
                    $("#optionAnggota").html(e), 
                    $("#setupcetak").modal("show"), 
                    $.unblockUI(), 
                    $("#id_cetak").val(id);
                },
            });
      });

    //nodal update nosurat
    $(document).on('click', '.upatenosu', function(){
      id = $(this).attr('data-id');
      $("#id").val(id);
      $('#updatenosu').modal('show');
    });

    //modal upload berkas hasil scan
    $(document).on('click', '.upload_berkas', function(){
      id = $(this).attr('data-id');
      jenis_mk = $(this).attr('jenis_mk');
      nama_mhs = $(this).attr('nama_mhs');
      $("#id_sks_upload_berkas").val(id);
      $("#jenis_mk_buff").val(jenis_mk);
      $("#nama_mhs_show").val(nama_mhs);
      $('#upload_berkas').modal('show');
    });


 
     //komunikasi update nomor surat ke server
    $(document).on('submit', '#updatenosiu-oih2', function(e) {  
      e.preventDefault();
      var route = $('#updatenosiu-oih2').data('route');
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
          success: function(){

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
                 $('#cekundangan').DataTable().ajax.reload();
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
       url:"{{ Route('LoadMoreUndangan') }}",

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
       url:"{{ Route('LoadMoreUndangan') }}",

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
var file = document.getElementById('someId');

file.onchange = function() {
   for (var i = 0; i < file.files.length; i++) {

        if(this.files[i].size > 2097152){
           swal( file.files.item(i).name  +  "", "File Mungkin Lebih 2MB!", "error");
           this.value = "";

        }
        var ext = file.files[i].name.substr(-3);
        var ygempat = file.files[i].name.substr(-4);
        if(ext!== "PDF" && ext!== "pdf")  {

            swal( file.files.item(i).name  +  "", "Extention File Mungkin Tidak Diizinkan", "error");
            this.value = '';

        }else{
            alert( file.files.item(i).name  + ", File Diizinkan");
        }
      
      }

      function getFile(filePath) {
          return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
      }
};
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
</style>

@include('sweet::alert')
@endsection
