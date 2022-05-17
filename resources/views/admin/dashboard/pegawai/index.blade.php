@extends('admin.layout.master')
@section('content')
<?php if(cek_akses('79') == 'yes'){
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
<!--link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.2/css/fixedColumns.dataTables.min.css"-->
<!--toastr alert-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
<div class="content-header" style="padding: 0px;">
  <div class="container-fluid">
    <div class="row mb-2">
   </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div> 
  <!-- /.content-header --> 
<div class="container-fluid">
    <div class="row">
      <div class="col-12">
          <div class="uk-alert uk-alert-warning" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
              @if ($message = Session::get('warningMessage'))

              <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-times"></i> Alert!</h5>
                <strong>{{ $message }}</strong>
              </div>
              @endif
              @if ($message = Session::get('successMessage'))

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Alert!</h5>
                <strong>{{ $message }}</strong>
              </div>
              @endif
          </div>
          <div class="shadow bg-dark rounded">
          <div class="card bg-dark">
          <div class="card-body p-2">
          <a href="#" class="btn btn-outline-info btn-flat margin btn-sm TambahPegawai"><i class="fa fa-fw fa-plus"></i>Tambah Pegawai</a>
          <a href="{{{ action('Pegawai\PegawaiController@showtambahjabatan') }}}" class="btn btn-outline-info btn-flat margin btn-sm" data-id=""><i class="fa fa-fw fa-plus"></i>Tambah Jabatan Pegawai</a> | 
          <a href="{{ Route('KategoriJabatan') }}" class="btn btn-outline-info btn-flat margin btn-sm" data-id=""><i class="fa fa-fw fa-user-md"></i>Setup Jabatan</a>

          <a href="#" class="btn btn-outline-warning btn-flat margin btn-sm Clear" style="float: right;"><i class="fa fa-fw fa-recycle"></i>Clear </a>
          <a href="#" class="btn btn-outline-warning btn-flat margin btn-sm" style="float: right;" onclick="myFunction()"><i class="fa fa-fw fa-table"></i>Tabel Kecil </a>
        
          <hr class="m-2">
          <div class="card-body"  style="padding: 0px;">
            <div class="table table-responsive">
            <table id="datatablespegawai" class="table table-dark table-stripped table-hover" style="width: 100%">
              <thead>
                <tr>
                  <th style="white-space: nowrap; "><center><span class="fa fa-eye"></span></center>
                  </th>
                  <th></th>
                  <th style="white-space: nowrap;">Nama Karyawan</th>
                  <th style="white-space: nowrap;">Data Diri</th>
                  <th style="white-space: nowrap;">NIP</th>
                  <th style="white-space: nowrap;">NIDN</th>
                  <th style="white-space: nowrap;">NITK</th>
                  <th style="white-space: nowrap;">Jabatan</th>
                  <th style="white-space: nowrap;">TMT</th>
                  <th style="white-space: nowrap;">TMK</th>
                  <th style="white-space: nowrap;">Status</th>
                  <th style="white-space: nowrap;">Akun</th>
                  <th style="white-space: nowrap;">Aksi</th>
                </tr>
              </thead>
            </table>
          </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

<!------------------------------------------------ MODAL---------------------------------------------->

<div class="modal fade" id="ModalBerkasDataDiri"  data-backdrop="static" role="dialog" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog modal-lg ">
    <div class="modal-content bg-dark" id="modal-content">
      <div class="row">
        <div class="col-lg-12">
          <div class="modal-body" id="KontenBerkasDataDiri">
            
          </div>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
    </div>
  </div>
</div>

<!---------------------------------------------PREVIEW JABATAN---------------------------------->
<div class="modal fade" id="ViewJabatan" role="dialog" tabindex="-1" aria-hidden="true" > <div class="modal-dialog modal-dialog-centered "> <div class="modal-content bg-dark" id="modal-content"> <div class="row"> <div class="col-lg-12"><div class="modal-body" id="LihatJabatanView"> </div></div></div></div></div></div>
<!---------------------------------------------PREVIEW JABATAN FUNGSIONAL------------------------------------>
<div class="modal fade" id="ViewJFungsional" role="dialog" tabindex="-1" aria-hidden="true" > <div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content bg-dark" id="modal-content"><div class="row"><div class="col-lg-12"><div class="modal-body" id="LihatJfungsional" style="padding: 3px;"><!--isi konten--></div><div class="modal-footer"><a href="{{ Route('setting_honorarium') }}" >Detail Data Honorarium ?</a></div> </div></div></div></div></div>
<!---------------------------------------------EDIT HONOR PEGAWAI/KARYAWAN------------------------------------>
<div class="modal fade" id="ViewEditHonor" role="dialog" tabindex="-1"> <div class="modal-dialog modal-dialog" role="document"> <div id="overlayidenEditHonor"> </div><div class="modal-content bg-dark"> <form data-route="{{route('put_set_honor')}}" id="EditHonorSet" role="form" method="POST" accept-charset="utf-8"> <div class="row"> <div class="col-lg-12"> <div class="modal-body" id="LihatEditHonor" style="padding: 10px;"> @csrf </div><div class="modal-footer"> <button type="button" class="btn btn-secondary btn-flat btn-sm" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary btn-flat btn-sm"><span class="fa fa-pencil-alt"></span> Edit</button> </div></div></div></form> </div></div></div>     
<!---------------------------------------------TAMBAH HONOR PEGAWAI/KARYAWAN------------------------------------>
<div class="modal fade" id="LihatViewTambahHonor" role="dialog" tabindex="-1"> <div class="modal-dialog modal-dialog" role="document"> <div id="overlayidenTambahHonor"></div><div class="modal-content"> <form data-route="{{route('add_set_honor')}}" id="TambahHonotSet" role="form" method="POST" accept-charset="utf-8"> <div class="row"> <div class="col-lg-12"> <div class="modal-body" id="ViewKontenTambahHonor" style="padding: 10px;">@csrf</div><div class="modal-footer"> <button type="button" class="btn btn-secondary btn-flat btn-sm" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary btn-flat btn-sm"><span class="fa fa-plus"></span> Tambah</button> </div></div></div></form> </div></div></div>
<!---------------------------------EDIT NAMA JABATAN------------------------------>
<div id="EditJabPegawai" class="modal fade" role="dialog"> <div class="modal-dialog modal-dialog-centered modal-lg" > <div id="overlayiden"> </div><div class="modal-content bg-dark"> <form data-route="{{Route('UbahNamaJabatan')}}" data-routeback="#" id="myForm" role="form" method="POST" accept-charset="utf-8"> @csrf <div class="modal-body mx-auto"> <div class="card-body row" style="padding: 1px;"> <div class="form-group col-md-12"> <div class="row"> <div class="col-md-12"> <input type="hidden" class="form-control" id="id_jabatan" name="id_jabatan"> <label for="Nama Jabatan">Nama Jabatan :</label> <div class="input-group bg-dark"> <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-briefcase"></i></span> </div><select class="form-control bg-dark" id="jabSSel" name="NamaJabs" required=""> @foreach($jabs as $keyJabs=> $valueJabs) <option value="{{$valueJabs->id_detail_jabatan}}">{{$valueJabs->nama_jabatan}} | {{$valueJabs->nama_detail_jabatan}}</option> @endforeach </select> </div><br><label for="Nama Jabatan">Prodi : <font size="2" color="yellow"> *prodi diisi jika dibutuhkan</font></label> <div class="input-group bg-dark"> <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-briefcase"></i></span> </div><select class="form-control bg-dark" name="prodi" id="ProdiSel"> <option value="">Pilih Prodi</option> @foreach($prodi as $keyProdi=> $valueProdi) <option value="{{$valueProdi->id_prodi}}">{{$valueProdi->nama_prodi}}</option> @endforeach </select> </div></div></div></div></div></div><div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary">Ubah</button> </div></form> </div></div></div>
<!---------------------------------TAMBAH PEGAWAI BARU------------------------------>
<div class="modal fade" id="ViewTambahPegawai" id="staticBackdrop" data-backdrop="static" role="dialog" tabindex="-1" aria-hidden="true"> <div class="modal-dialog modal-dialog "> <div id="OverlayTambahPegawai"> </div><form data-route="{{Route('simpanpegawai')}}" data-routeback="#" id="myFormTambahPeg" role="form" method="POST" accept-charset="utf-8"> @csrf <div class="modal-content bg-dark" id="modal-content"> <div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Tambah Pegawai Baru</h5><button type="button" class="close bg-dark" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button></div> <div class="row"> <div class="col-lg-12"> <div class="modal-body" id="KontenPegawai" style="padding: 15px;"></div></div></div><div class="modal-footer"> <button type="button" class="btn btn-secondary" id="ohild" data-dismiss="modal">Close</button> <button type="submit" id="Hjktiuhe" class="btn btn-primary">Tambah Pegawai</button> </div></div></form> </div></div>
<!---------------------------------EDIT PEGAWAI BARU------------------------------>
<div class="modal fade" id="ViewEditPegawai" id="staticBackdrop" data-backdrop="static" role="dialog" tabindex="-1" aria-hidden="true" data-dismiss="modal"><div class="modal-dialog modal-dialog"><div id="OverlayEditPegawai"></div><form data-route="{{Route('SimpanEditPegawai')}}" data-routeback="#" id="myFormEditPeg" role="form" method="POST" accept-charset="utf-8">@csrf <div class="modal-content bg-dark" id="modal-content"><div class="row"><div class="col-lg-12"><div class="modal-body" id="KontenPegawaiEdit" style="padding: 15px;"></div></div></div><div class="modal-footer"><button type="button" id="ohild2" class="btn btn-secondary" data-dismiss="modal">Close</button><button type="submit" id="Hjktiuhe2" class="btn btn-primary">Update Pegawai</button></div></div></form></div></div>


@endsection
@section('script')
<!--toastr alert-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
<!--script src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script-->
<script>
$.noConflict(); 
function format ( d ) {
    return '<div class="slider">'+  
               '<table class="table table-bordered" width="100%">'+ 
                '<thead>'+ 
                  '<tr>'+
                    '<th scope="col">Berkas</th>'+  
                    '<th scope="col">TMK</th>'+  
                    '<th scope="col">TMT</th>'+  
                    '<th scope="col">Keterangan</th>'+ 
                  '</tr>'+ 
                '</thead>'+ 
                '<tbody>'+ 
                  '<tr>'+
                    '<td scope="row" width="10%" nowrap>'+
                    '<button class="btn btn-outline-info btn-sm btn-flat btn-block" id="BerkasDataDiri" data-IdUser="'+d.id_user+'"><li class="fa fa-file-pdf"></li> Lihat Berkas</button>'+
                    '</td>'+ 
                    '<td scope="row">'+d.tmk+'</td>'+ 
                    '<td scope="row">'+d.tmt+'</td>'+  
                    '<td scope="row">'+d.keterangan_histori+'</td>'+ 
                  '</tr>'+ 
                '</tbody>'+ 
              '</table>'+ 
            '</div>'
  }
function cekstatus(a) {
  switch (a) {
  case "Aktif":
    return '<span class="badge badge-pill badge-success" style="width: 104px">Aktif</span>';
  case "Tidak Aktif":
    return '<span class="badge badge-pill badge-danger" style="width: 104px">Tidak Aktif</span>';
  case "Honorer Aktif":
    return '<span class="badge badge-pill badge-primary" style="width: 104px">Honorer Aktif</span>';
  case "Honorer Tidak Aktif":
    return '<span class="badge badge-pill badge-warning" style="width: 104px">Honorer Tidak Aktif</span>';
  case "Cuti Kuliah":
    return '<span class="badge badge-pill badge-light" style="width: 104px">Cuti Kuliah</span>';
  case "Penguji Ahli Dosen Luar":
    return '<span class="badge badge-pill badge-secondary" style="width: 104px">Penguji Ahli (DL)</span>';
  default:
    return '<span class="badge badge-pill badge-dark" style="width: 104px">Tidak Dalam Kondisi</span>'
  }
}


function myFunction() {
   var element = document.getElementById("datatablespegawai");
   element.classList.add("table-sm");
   var setKecil = 'table-sm';
   localStorage.setItem("TableKecil", setKecil);

   setTimeout(function(){location.reload(1)});
}
let techStack = localStorage.getItem("TableKecil");
var element = document.getElementById("datatablespegawai");
element.classList.add(techStack);


jQuery( document ).ready(function( $ ) {
  var dt =  $('#datatablespegawai').DataTable({
        processing: true,
        serverSide: true,
        bStateSave : true,
        responsive : true,
        scrollX: false,
        //scrollY: "450",
        ajax: '{!! route('pegawai.data') !!}',
        order: [[ 1, "DESC" ]],
        language: {
            "infoFiltered":"",
            "processing": '<img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 30%;">',
            "searchPlaceholder": "Masukan Nama Pegawai",
        },
        columns: [
            {
                "class":          "details-control",
                "orderable":      false,
                //"data" : 'id_pegawai',
                "defaultContent": "",
            },
            { data: 'id_pegawai', name: 'pegawai.id_pegawai', visible : false }, 
            { data: 'nama_karyawan', name: 'pegawai.nama_karyawan' },
            { data: 'DataDiri', name: 'DataDiri'},
            { data: 'nip', name: 'pegawai.nip' },
            { data: 'nidn', name: 'pegawai.nidn' },
            { data: 'nitk', name: 'pegawai.nitk' },
            { data: 'jabatan', 
               render: function(value, type, row, meta){
               var output="";
               for(var i=0;i<row.jabatan.length;i++){
                   output +=  i+1+'. <b>'+row.jabatan[i]+'</b><br>';
                 
               }
               return output;
             }
           },
           { data: 'tmt', name: 'pegawai.tmt' },
           { data: 'tmk', name: 'pegawai.tmk' },
            { data: 'status_aktif',  
            render: function ( data, type, row ) {
                  return cekstatus(row.status_aktif);
                
              },
            },
            { data: 'id_user', 
               render: function ( data, type, row ) {
                if (row.id_user) {
                   return '<span class="badge badge-pill badge-success"style="width: 40px">Ada</span>';
                 }else{
                   return '<span class="badge badge-pill badge-danger" style="width: 40px">Tidak</span>';
                 }
              },
            },
            { data: 'action', name: 'action' },
        ],
        createdRow: function ( row, data, index ) {
            $('td', row).eq(1).attr("nowrap","nowrap");
            $('td', row).eq(6).attr("nowrap","nowrap");
            $('td', row).eq(7).attr("nowrap","nowrap");
            $('td', row).eq(8).attr("nowrap","nowrap");
            $('td', row).eq(2).attr("style","text-align: center");
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
            $('.select').select2({theme: 'bootstrap4'});
          },
    });
 $('.dataTables_filter input[type="search"]').css(
     {'width':'200px','display':'inline-block'}
  );

var detailRows = [];
$('#datatablespegawai tbody').on('click', 'td.details-control', function() {
    var tr = $(this).closest('tr');
    var row = dt.row(tr);
    if (row.child.isShown()) {
        $('div.slider', row.child()).slideUp(function() {
            row.child.hide();
            tr.removeClass('shown');
        });
    } else {
        row.child(format(row.data()), 'no-padding').show();
        tr.addClass('shown');
        $('div.slider', row.child()).slideDown();
   }
});
dt.on('draw', function() {
    $.each(detailRows, function(i, id) {
        $('#' + id + ' td.details-control').trigger('click');
    });
});

///////////////////////////////////////////BERKAS DATA DIRI//////////////////////////////////////////////
$(document).on("click","#BerkasDataDiri",function(){
    var src = this.getAttribute('data-IdUser');
    if (src != 'null') {
      Pace.track(function(){
        Pace.restart();
        fetch('{{route("BerkasDataDiri", ":id_user")}}'.replace(":id_user", src))
        .then(function(response){ return response.json() })
        .then(function(data){
          switch(data.HasilCek) {
            case '001':
              document.getElementById("KontenBerkasDataDiri").innerHTML = data.tablenya;
              $('#ModalBerkasDataDiri').modal();

              $('#UntukUploadData').on('hide.bs.collapse',function(e){
                $("#ButtonUploadBerkas").toggleClass("btn-danger btn-info");
                $("#SpanBerkasUpload").toggleClass("fa-times-circle fa-file-image");
              });

              $('#UntukUploadData').on('show.bs.collapse', function(e){
                Pace.track(function(){
                  Pace.restart();
                  fetch('{{route("GetFormTambahBerkas", ":id_user")}}'.replace(":id_user", src))//get form upload
                  .then(function(response){ return response.json() })
                  .then(function(data){
                    document.getElementById("KontenFormUploadAdmin").innerHTML = data.HasilCek;
                  
                      $('.InputBerkasForm').change(function(ev) {

                      $('#'+$(this).attr('id')).addClass( "bg-success" );

                        var fileInput = document.getElementById($(this).attr('id'));
                        var filePath = fileInput.value;
                          
                        // Allowing file type
                        var allowedExtensions = /(\.png|\.gif|\.zip|\.rar)$/i;
                          
                        if (!allowedExtensions.exec(filePath)) {
                            toastr.warning('Extention File Mungkin Tidak Diizinkan');
                            fileInput.value = '';
                            return false;
                        }else{
                          toastr.success('File Diizinkan');
                        }
                     

                    });
                    $('.CloseFile').click(function(ev) { 
                        $('#'+$(this).attr('id')).removeClass("bg-success");
                        document.getElementById($(this).attr('id')).value = null;
                    }) 

                  }).catch(function(err){alert(err)});

                  $("#ButtonUploadBerkas").toggleClass("btn-info btn-danger");
                  $("#SpanBerkasUpload").toggleClass("fa-file-image fa-times-circle");

                });
              });

              break;
            case '002':
              toastr.warning('Pegawai ini tidak memiliki berkas apapun');
              break;
            default:
              alert('Terjadi Kesalahan #jlh4k3');
          }
        })
        .catch(function(err){alert(err)});
      }); 
    }else{
      alert('Berkas Tidak Ditemukan');
    }
});

//UNTUK HAPUS BERKAS
$(document).on("click",".HapusBerkasPegawaiAdmin",function(){
  var IdFileHapus = this.getAttribute('Data-Id');
  var result = confirm("Yakin Untuk Menghapus Data ?");
  if (result) {
    Pace.track(function(){
      Pace.restart();
      fetch('{{route("HapusBerkasPegawaiAdmin", ":IdFileHapusTukar")}}'.replace(":IdFileHapusTukar", IdFileHapus))
      .then(function(response){ return response.json() })
      .then(function(data){
        switch(data.HasilCeks) {
          case '001':
            toastr.success('File Berhasil Dihapus');
            var row = document.getElementById('RowBagian'+IdFileHapus);
            row.parentNode.removeChild(row);
            break;
          case '002':
            toastr.warning('File Gagal Dihapus');
            break;
          case '003':
            toastr.warning('File Tidak Ditemukan');
            break;
          default:
            alert('Terjadi Kesalahan #34kbj34kj');
        }

      })
      .catch(function(err){alert(err)});
    });
  }
});

///////////////////////////////////////////BERKAS DATA DIRI//////////////////////////////////////////////

 
//RESET LOCAL STORAGE
$(document).on("click",".Clear",function(){Pace.restart();localStorage.clear();$("#datatablespegawai").DataTable().ajax.reload(),$("#datatablespegawai").removeClass("table-sm"); setTimeout(function(){location.reload(1)}) })
//AJAX PROSES
//VIEW EDIT PEGAWAI
$(document).ready(function () {
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }),
        $(document).on("click", ".EditPegawai", function () {
            var e = $(this).attr("IdPegawai");
            (url = '{{route("ViewEditPeg", ":IdPeg")}}'.replace(":IdPeg", e)),
                $.ajax({
                    url: url,
                    method: "POST",
                    beforeSend: function () {
                        $.blockUI({ css: { border: "none", padding: "5px", backgroundColor: "#000", "-webkit-border-radius": "5px", "-moz-border-radius": "5px", opacity: 0.5, color: "#fff" } }), Pace.restart();
                    },
                    success: function (e) {
                        $("#KontenPegawaiEdit").html(e), $("#ViewEditPegawai").modal("show"), $.unblockUI(), $(".selecthjj").select2({ theme: "bootstrap4" });

                        $('#CekUserhtjj').on('change', function(){
                          $.post('{{ Route('CekUserPeg') }}', {
                              _token: "{{ csrf_token() }}",
                              id: $('#CekUserhtjj').val(),

                              beforeSend: function() {
                                Pace.restart();
                              },
                              success: function(msg) {},
                            }, 
                            function(e){
                               switch (e) {
                                case "f12we":
                                $('#UserDangerftg').html("<font class='bg-success' size='2'>Akun Ini Siap Digunakan</font>");
                                $("#Hjktiuhe2"). attr("disabled", false)
                                break; 
                                default:
                                $('#UserDangerftg').html(e);
                                $("#Hjktiuhe2"). attr("disabled", true)
                                }
                                $("#ohild2").click(function() {
                                  $("#Hjktiuhe2"). attr("disabled", false)
                                });
                            });
                        });
                    },
                });
        });
});

//PROSES EDIT PEGAWAI
$(document).on("submit", "#myFormEditPeg", function (a) {
    a.preventDefault();
    var e = $("#myFormEditPeg").data("route"),
        r = $(this),
        t = $("#OverlayEditPegawai");
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }),
        $.ajax({
            type: "POST",
            url: e,
            data: r.serialize(),
            beforeSend: function () {
                $(t).append('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i>Sedang Memproses Data</div>'), Pace.restart();
            },
            success: function (a, e) {
                switch (a.ceks) {
                    case "berhasil":
                        swal("Berhasil!", "Berhasil Mengubah Data", "success");
                        break;
                    case "gagal":
                        $("#OverlayEditPegawai").remove(),
                        swal("Gagal!", "Gagal Mengubah Data", "error");
                        break;
                    case "duplikatnip":
                        $("#OverlayEditPegawai").remove(),
                        swal("Gagal!", "NIP Sudah Terdaftar", "error");
                        break;
                    case "duplikatnidn":
                        $("#OverlayEditPegawai").remove(),
                        swal("Gagal!", "NIDN Sudah Terdaftar", "error");
                        break;
                    case "duplikatnitk":
                        $("#OverlayEditPegawai").remove(), 
                        swal("Gagal!", "NITK Sudah Terdaftar", "error");
                        break;
                    case "userganda":
                        $("#OverlayEditPegawai").remove(),
                        swal("Gagal!", "User Akun Sudah Dimiliki Pegawai Lain", "error");
                        break;
                }
            },
            complete: function () {
                $(".overlay").remove(), $("#ViewEditPegawai").modal("hide"), $.unblockUI(), $("#datatablespegawai").DataTable().ajax.reload();
            },
            error: function (a) {
                swal("Upsss!", "Terjadi Kesalahan", "error");
            },
        });
});

//VIEW TAMBAH PEGAWAI
$(document).ready(function () {
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }),
        $(document).on("click", ".TambahPegawai", function () {
            $.ajax({
                url: '{{route("showtambahPegawai")}}',
                method: "POST",
                beforeSend: function () {
                    $.blockUI({ css: { border: "none", padding: "5px", backgroundColor: "#000", "-webkit-border-radius": "5px", "-moz-border-radius": "5px", opacity: 0.5, color: "#fff" } }), Pace.restart();
                },
                success: function (e) {
                    $("#KontenPegawai").html(e), 
                    $("#ViewTambahPegawai").modal("show"), 
                    $.unblockUI(), 
                    $(".selecthjy").select2({ theme: "bootstrap4" });
                    //CEK USER REAL TIME
                    $('#CekUser').on('change', function(){
                          $.post('{{ Route('CekUserPeg') }}', {
                              _token: "{{ csrf_token() }}",
                              id: $('#CekUser').val(),

                              beforeSend: function() {
                                Pace.restart();
                              },
                              success: function(msg) {},
                            }, 
                            function(e){
                              switch (e) {
                                case "f12we":
                                $('#UserDanger').html("<font class='bg-success' size='2'>Akun Ini Siap Digunakan</font>");
                                $("#Hjktiuhe"). attr("disabled", false)
                                break; 
                                default:
                                $('#UserDanger').html(e);
                                $("#Hjktiuhe"). attr("disabled", true)
                                }
                                $("#ohild").click(function() {
                                  $("#Hjktiuhe"). attr("disabled", false)
                                });
                          });
                      });
                },
            });
        });
});

//PROSES TAMBAH PEGAWAI 
$(document).on("submit", "#myFormTambahPeg", function(a) {
    a.preventDefault();
    var e = $("#myFormTambahPeg").data("route"),
        r = $(this),
        s = $("#OverlayTambahPegawai");
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    }), $.ajax({
        type: "POST",
        url: e,
        data: r.serialize(),
        beforeSend: function() {
            $(s).append('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i>Sedang Memproses Data</div>'), Pace.restart()
        },
        success: function(a, e) {
            switch (a.ceks) {
                case "berhasil":
                    swal("Berhasil!", 'Berhasil Menambah "' + a.nm_kar + '"', "success"), 
                    $("#OverlayTambahPegawai").remove(), 
                    $("#ViewTambahPegawai").modal("hide");
                    break;
                case "gagal":
                    $("#OverlayTambahPegawai").remove(), 
                    swal("Gagal!", "Gagal Menambah Data", "error");
                    break;
                case "duplikatnip":
                    $("#OverlayTambahPegawai").remove(), 
                    swal("Gagal!", "NIP Sudah Terdaftar", "error");
                    break;
                case "duplikatnidn":
                    $("#OverlayTambahPegawai").remove(), 
                    swal("Gagal!", "NIDN Sudah Terdaftar", "error");
                    break;
                case "duplikatnitk":
                    $("#OverlayTambahPegawai").remove(), 
                    swal("Gagal!", "NITK Sudah Terdaftar", "error");
                    break;
                case "userganda":
                    $("#OverlayTambahPegawai").remove(), 
                    swal("Gagal!", 'User Akun Sudah Dimiliki Pegawai Lain', "error");
                    break;
            }
        },
        complete: function() {
            $("#datatablespegawai").DataTable().ajax.reload()
        },
        error: function(a) {
            swal("Upsss!", "Terjadi Kesalahan", "error")
        }
    })
});


//LIHAT LIST JABATAN 
$(document).ready(function(){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$(document).on("click",".LihatJabatan",function(){var a=$(this).attr("DataIdPegawai"),e='{{route("lht_jabatan", ":id_peg")}}';e=e.replace(":id_peg",a),$.ajax({url:e,method:"POST",data:{id_peg:a},beforeSend:function(){$.blockUI({css:{border:"none",padding:"5px",backgroundColor:"#000","-webkit-border-radius":"5px","-moz-border-radius":"5px",opacity:.5,color:"#fff"}}),Pace.restart()},success:function(a){$("#LihatJabatanView").html(a),$("#ViewJabatan").modal("show"),$("#ViewEditPegawai").modal("hide"),$.unblockUI()}})})});

//UNTUK VIEW DATA HONOR PEGAWAI/KARYAWAN(JABATAN FUNGSIONAL)
$(document).ready(function(){$.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}); $(document).on('click', '.LihatJFungsional', function(){var id_peg=$(this).attr("DataIdPegawai"); var url='{{route("LihatJabFungsional", ":id_peg")}}'; url=url.replace(':id_peg', id_peg); $.ajax({url: url, method:"POST", data:{id_peg : id_peg}, beforeSend: function(){$.blockUI({css:{border: 'none', padding: '5px', backgroundColor: '#000', '-webkit-border-radius': '5px', '-moz-border-radius': '5px', opacity: .5, color: '#fff'}});  Pace.restart();}, success:function(data){$('#LihatJfungsional').html(data); $('#ViewJFungsional').modal("show"); $.unblockUI();}});});});
//TAMBAH HONOR PEGAWAI/BAGIAN JABATAN FUNGSIONAL
$(document).ready(function(){$.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}); $(document).on('click', '.TambahHonor', function(){var id_peg=$(this).attr("IdPegawai"); var url='{{route("TambahHonorView2_0", ":id_peg")}}'; url=url.replace(':id_peg', id_peg); $.ajax({url: url, method:"POST", data:{id_peg : id_peg}, beforeSend: function(){$.blockUI({css:{border: 'none', padding: '5px', backgroundColor: '#000', '-webkit-border-radius': '5px', '-moz-border-radius': '5px', opacity: .5, color: '#fff'}});Pace.restart();}, success:function(data){$('#ViewKontenTambahHonor').html(data); $('#LihatViewTambahHonor').modal("show"); $('#ViewJFungsional').modal("hide"); $.unblockUI();}});});});
//UNTUK VIEW EDIT HONOR PEGAWAI/KARYAWAN(JABATAN FUNGSIONAL)
$(document).ready(function(){$.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}); $(document).on('click', '.editHonor', function(){var id_honor=$(this).attr("idHonor"); var urlHonor='{{route("ViewEditHonor", ":id_honor")}}'; urlHonor=urlHonor.replace(':id_honor', id_honor); $.ajax({url: urlHonor, method:"POST", data:{id_honor : id_honor}, beforeSend: function(){$.blockUI({css:{border: 'none', padding: '5px', backgroundColor: '#000', '-webkit-border-radius': '5px', '-moz-border-radius': '5px', opacity: .5, color: '#fff'}});Pace.restart();}, success:function(data){$('#LihatEditHonor').html(data); $('#ViewEditHonor').modal("show"); $('#ViewJFungsional').modal("hide"); $.unblockUI();}});});});
//TAMBAH PROSES HONOR JABATAN FUNGSIONAL DAN NILAI HONOR
$(document).on('submit', '#TambahHonotSet', function(e){e.preventDefault(); var route=$('#TambahHonotSet').data('route'); var form_data=$(this); var wrapper=$("#overlayidenTambahHonor"); $.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}}); $.ajax({type: 'POST', url: route, data: form_data.serialize(), beforeSend: function(){$(wrapper).append( '<div class="overlay d-flex justify-content-center align-items-center">'+ '<i class="fas fa-2x fa-sync fa-spin"></i>'+ 'Sedang Memproses Data'+ '</div>');Pace.restart();}, success: function(Response){setTimeout(function(){swal("Berhasil!", "Berhasil Menambah Data", "success");});}, complete: function(){$('#overlayidenTambahHonor').remove(); setTimeout(function (){location.reload(1);}, 2000);}, error: function(xhr){swal("Upsss!", "Terjadi Kesalahan", "error");},})});

//EDIT AJAX HONOR PEGAWAI JABATAN FUNGSIONAL
$(document).on("submit", "#EditHonorSet", function (e) {
  e.preventDefault();
  var route = $("#EditHonorSet").data("route");
  var form_data = $(this);
  var wrapper = $("#overlayidenEditHonor");
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  });
  $.ajax({
    type: "POST",
    url: route,
    data: form_data.serialize(),
    beforeSend: function () {
      $(wrapper).append('<div class="overlay d-flex justify-content-center align-items-center">' + '<i class="fas fa-2x fa-sync fa-spin"></i>' + "Sedang Memproses Data" + "</div>");
      Pace.restart();
    },
    success: function (data, Response) {
      switch (data.ceks) {
      case "Berhasil":
        swal("Berhasil!", "Berhasil Mengubah Data", "success");
        $("#overlayidenEditHonor").remove();
        $("#ViewEditHonor").modal("hide");
        break;
      case "Gagal":
        swal("Gagal!", "Gagal Mengubah Data", "error");
        $("#overlayidenEditHonor").remove();
        break;
      default:
      }
    },
    complete: function () {
      $.unblockUI();
    },
    error: function (xhr) {
      swal("Upsss!", "Terjadi Kesalahan", "error");
    },
  });
});

//EDIT AJAX PEGAWAI JABATAN
$(document).on("click",".EditNamaJabatan",function(){$("#EditJabPegawai").modal("show");var a=$(this).attr("DataIdPegEdit"),e=$(this).attr("NamaJabEdit"),t=$(this).attr("ProdiJabs");$("#id_jabatan").val(a),$('#ProdiSel option[value="'+t+'"]').attr("selected","selected"),$('#jabSSel option[value="'+e+'"]').attr("selected","selected"),$(document).on("submit","#myForm",function(a){a.preventDefault();var e=$("#myForm").data("route"),t=$(this),s=$("#overlayiden");$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.ajax({type:"POST",url:e,data:t.serialize(),beforeSend:function(){$(s).append('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i>Sedang Memproses Data</div>'),Pace.restart()},success:function(a,e){switch(a.ceks){case"berhasil":swal("Berhasil!","Berhasil Mengubah Nama Jabatan","success");break;case"gagal":swal("Gagal!","Gagal Mengubah Data","error")}},complete:function(){$(".overlay").remove(),$("#EditJabPegawai").modal("hide"),$.unblockUI(),setTimeout(function(){location.reload(1)},1e3)},error:function(a){swal("Upsss!","Terjadi Kesalahan","error")}})})});

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
});

</script>
<style>
td.details-control{background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_open.png') no-repeat center center; cursor: pointer;}tr.shown td.details-control{background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_close.png') no-repeat center center;}div.slider{display: none;}.modal{overflow-y:auto;}.select2-selection{background-color: #ffffff !important; color: black;}
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color:  #44895014;
}

</style>

@include('sweet::alert')
@endsection
