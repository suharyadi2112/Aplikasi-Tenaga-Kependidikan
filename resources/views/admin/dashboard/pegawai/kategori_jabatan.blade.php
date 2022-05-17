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
          <div class="uk-alert uk-alert-success" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
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
          <a href="{{ URL::to('pegawai') }}" class="btn btn-sm btn-flat btn-outline-warning" >
                <span class="fa fa-backward"> </span> Kembali Ke Management Pegawai
          </a> | 
          <a href="#" class="btn btn-outline-info btn-flat margin btn-sm TambahJabatan"><i class="fa fa-fw fa-plus"></i>Tambah Jabatan</a>
   
          <br>
          <br>
          <div class="card-body" style="padding: 0px;"> <div class="table table-responsive"> <table id="datatablespegawai" class="table  dt-responsive display table-dark table-striped table-hover"><!-- style="background-color: #08203c; color: #ffffff" --> <thead> <tr> <th>Nama Jabatan</th> <th>Lengkap</th> <th>Kategori</th>  <th>Detail</th> <th>Aksi</th> </tr></thead></table> </div></div>
        </div>
      </div>
      </div>
    </div>
  </div>
</div>

<!--TAMBAH KATGEORI JABATAN FORM-->
<div class="modal fade" id="ViewTambahJabatan" id="staticBackdrop" data-backdrop="static" role="dialog" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-dialog"><div id="OverlayTamKatJab"></div><form data-route="{{Route('TambahKatJab')}}" data-routeback="#" id="myForm" role="form" method="POST" accept-charset="utf-8"> @csrf<div class="modal-content bg-dark" id="modal-content"><div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Tambah Jabatan Baru</h5> <button type="button" class="close bg-dark" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="row"><div class="col-lg-12"><div class="modal-body" style="padding: 15px;"><label>Nama Jabatan : <font color="yellow" size="2">Biasanya dalam singkatan</font></label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-user-md"></i></span></div> <input type="text" name="nama_jabatan" class="form-control" placeholder="DKK" autocomplete="off" required=""></div></div><label>Nama Lengkap Jabatan : <font color="yellow" size="2">Kepanjangan dari singkatan</font></label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-user-md"></i></span></div> <input type="text" name="nama_lengkap_jabatan" class="form-control" placeholder="Kepegawaian dan Kerjasama" autocomplete="off"></div></div><label>Detail Nama Jabatan : </label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-user-md"></i></span></div> <input type="text" name="nama_detail_jabatan" class="form-control" placeholder="Staf Operator Kepegawaian" autocomplete="off" required=""></div></div><label>Katergori Jabatan : </label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-users"></i></span></div> <select class="form-control" name="kategori_jabatan" required=""><option value="">Pilih Kategori</option><option value="Pendidik">Pendidik</option><option value="Tenaga Kependidikan">Tenaga Kependidikan</option> </select></div></div></div></div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary">Tambah Kategori Jabatan</button></div></div></form></div></div>

<!---TAMBAH DETAIL JABATAN--->
<div class="modal fade" id="ViewDetJab" id="staticBackdrop" data-backdrop="static" role="dialog" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-dialog"><div id="OverlayTamKatJab2"></div><form data-route="{{Route('TambahDetailSaja')}}" data-routeback="#" id="myFormDetJab" role="form" method="POST" accept-charset="utf-8"> @csrf<div class="modal-content bg-dark" id="modal-content"><div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Tambah Detail Saja</h5> <button type="button" class="close bg-dark" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="row"><div class="col-lg-12"><div class="modal-body" style="padding: 15px;"><input type="hidden" name="id_set_jabatan" id="IdSetJab" required> <label>Nama Jabatan : </label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-user-md"></i></span></div> <input type="text" name="nama_jabatan" id="NaJab" class="form-control bg-dark" placeholder="DKK" autocomplete="off" required="" readonly></div></div><label>Nama Lengkap Jabatan : </label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-user-md"></i></span></div> <input type="text" name="nama_lengkap_jabatan" id="Naleng" class="form-control bg-dark" placeholder="Kepegawaian dan Kerjasama" autocomplete="off" readonly></div></div><label>Detail Nama Jabatan : </label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-user-md"></i></span></div> <input type="text" name="nama_detail_jabatan" class="form-control" placeholder="Staf Operator Kepegawaian" autocomplete="off" required=""></div></div><label>Katergori Jabatan : </label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-users"></i></span></div> <input type="text" name="kategori_jabatan" class="form-control bg-dark" id="Kat" autocomplete="off" required="" readonly></div></div></div></div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary">Tambah Detail Saja</button></div></div></form></div></div>

<!--EDIT NAMA DETAIL JABATAN-->
<div class="modal fade" id="ViewEdDetJab" id="staticBackdrop" data-backdrop="static" role="dialog" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-dialog"><div id="OverlayEdDetJab"></div><form data-route="{{Route('UpdateDetJab')}}" data-routeback="#" id="myFormEdDetJab" role="form" method="POST" accept-charset="utf-8"> @csrf<div class="modal-content bg-dark" id="modal-content"><div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Edit Nama Detail Saja</h5> <button type="button" class="close bg-dark" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="row"><div class="col-lg-12"><div class="modal-body" style="padding: 15px;"> <input type="hidden" name="id_set_jabatan" id="aa" required /> <label>Nama Jabatan : </label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-user-md"></i></span></div> <input type="text" name="nama_jabatan" id="bb" class="form-control bg-dark" placeholder="DKK" autocomplete="off" required="" readonly /></div></div> <label>Nama Lengkap Jabatan : </label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-user-md"></i></span></div> <input type="text" name="nama_lengkap_jabatan" id="cc" class="form-control bg-dark" placeholder="Kepegawaian dan Kerjasama" autocomplete="off" readonly /></div></div> <label>Detail Nama Jabatan : </label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-user-md"></i></span></div> <input type="text" name="nama_detail_jabatan" class="form-control ee" placeholder="Staf Operator Kepegawaian" autocomplete="off" required="" /> <input type="hidden" name="nama_detail_jabatan_old" class="form-control ee" placeholder="Staf Operator Kepegawaian" autocomplete="off" required="" /></div></div> <label>Katergori Jabatan : </label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-users"></i></span></div> <input type="text" name="kategori_jabatan" class="form-control bg-dark" id="dd" autocomplete="off" required="" readonly /></div></div></div></div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary">Edit Detail Saja</button></div></div></form></div></div>

<!--HAPUS DETAIL JABATAN-->
<div class="modal fade" id="ConfirmHapDet" id="staticBackdrop" data-backdrop="static" role="dialog" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-dialog"><div id="OverlayHapDet"></div><form data-route="{{Route('DestroyDetailJab')}}" data-routeback="#" id="myFormHapDet" role="form" method="POST" accept-charset="utf-8"> @csrf<div class="modal-content bg-dark" id="modal-content"><div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Confirm Hapus Detail Jabatan</h5> <button type="button" class="close bg-dark" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"> <input type="hidden" name="wakilHap" id="GBH" required> <input type="hidden" name="wakilHap2" id="GBH2" required><p><h4>Anda Yakin Menghapus Detail Jabatan Ini ?</h4></p></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary">Oke</button></div></div></form></div></div>

<!--EDIT KATEGORI UTAMA PADA JABATAN-->
<div class="modal fade" id="EditKatJabJabatan" id="staticBackdrop" data-backdrop="static" role="dialog" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-dialog"><div id="OverlayEdKatJab"></div><form data-route="{{Route('EditKatJab')}}" data-routeback="#" id="myFormEdKatJab" role="form" method="POST" accept-charset="utf-8"> @csrf<div class="modal-content bg-dark" id="modal-content"><div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Edit Jabatan</h5> <button type="button" class="close bg-dark" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="row"><div class="col-lg-12"><div class="modal-body" style="padding: 15px;"> <input type="hidden" name="id_set_jabatan" id="idSetjab"> <label>Nama Jabatan : <font color="yellow" size="2">Biasanya dalam singkatan</font></label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-user-md"></i></span></div> <input type="text" name="nama_jabatan" id="aaNamaJab" class="form-control" placeholder="DKK" autocomplete="off" required="" /></div></div> <label>Nama Lengkap Jabatan : <font color="yellow" size="2">Kepanjangan dari singkatan</font></label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-user-md"></i></span></div> <input type="text" name="nama_lengkap_jabatan" id="bbNamaLengJab" class="form-control" placeholder="Kepegawaian dan Kerjasama" autocomplete="off" /></div></div> <label>Kategori Jabatan : </label><div class="form-group"><div class="input-group"><div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-users"></i></span></div> <select class="form-control" name="kategori_jabatan" id="ddKatJab" required=""><option value="">Pilih Kategori</option><option value="Pendidik">Pendidik</option><option value="Tenaga Kependidikan">Tenaga Kependidikan</option> </select></div></div></div></div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary">Edit Kategori Jabatan</button></div></div></form></div></div>

<!--Hapus Kategori Jabatan-->
<div class="modal fade" id="ConfirmHapKatJab" id="staticBackdrop" data-backdrop="static" role="dialog" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-dialog"><div id="OverlayHapKatJab"></div><form data-route="{{Route('DestroyKatab')}}" data-routeback="#" id="myFormHapKatJab" role="form" method="POST" accept-charset="utf-8"> @csrf<div class="modal-content bg-dark" id="modal-content"><div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Confirm Hapus Jabatan</h5> <button type="button" class="close bg-dark" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"> <input type="hidden" name="IdSetJab" id="IdHapKatJab" required><p><h4>Anda Yakin Menghapus Jabatan Utama Ini ?</h4></p></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-primary">Oke</button></div></div></form></div></div>

@endsection
@section('script')
<script>
$.noConflict(); 

jQuery( document ).ready(function( $ ) {
$('#datatablespegawai').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('GetDataKatJabatan') !!}',
        order: [[ 0, "ASC" ]],
        language: {
            "infoFiltered":"",
            "processing": '<img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 30%;">',
            "searchPlaceholder": "Masukan Nama Jabatan",
        },
        columns: [
            { data: 'nama_jabatan', name: 'b_set_jabatan.nama_jabatan' },
            { data: 'lengkap', name: 'b_set_jabatan.lengkap' }, 
            { data: 'kategori', name: 'b_set_jabatan.kategori' },
            { data: 'jabatan_detail', 
               render: function(value, type, row, meta){
               var output="";
               for(var i=0;i<row.jabatan_detail.length;i++){
                output +=  '<ul class="todo-list" data-widget="todo-list" >'+
                    '<li class="bg-dark" style="border-left: 0px;">'+
                      '<span class="text">'+row.jabatan_detail[i]+'</span>'+
                      '<div class="tools">'+
                        '<a><button title="EDIT NAMA DETAIL SAJA" class="btn btn-outline-info btn-xs EdDetJab" NaJab="'+row.nama_jabatan+'" NaLeng="'+row.lengkap+'" Kat="'+row.kategori+'" IdSetJab="'+row.id_set_jabatan+'" JabDetEd="'+row.jabatan_detail[i]+'"><span class="fas fa-edit"></span></button></a> &nbsp;'+
                        '<a><button class="btn btn-outline-danger btn-xs HapDet" HapDetW="'+row.jabatan_detail[i]+'" HapDetW2="'+row.id_set_jabatan+'" title="HAPUS JABATAN DETAIL SAJA"><span class="fas fa-trash"></span></button></a>'+
                      '</div>'+
                    '</li>'+

                  '</ul>';
                }
              output +=  '<hr style="margin:5px"><a><button class="btn btn-outline-info btn-flat margin btn-xs DetJab" NaJab="'+row.nama_jabatan+'" NaLeng="'+row.lengkap+'" Kat="'+row.kategori+'" IdSetJab="'+row.id_set_jabatan+'"><span class="fa fa-fw fa-plus"></span> Tambah Detail Jabatan</button></a><br>';
              return output;
             }
           },
            { data: 'action', name: 'action' },
        ],
        createdRow: function ( row, data, index ) {
            $('td', row).eq(3).attr("nowrap","nowrap");
            $('td', row).eq(4).attr("style","vertical-align:middle");
            $('body').tooltip({selector: '[data-toggle="tooltip"]'});
            $('.select').select2({theme: 'bootstrap4'});
          },
    });
     $('.dataTables_filter input[type="search"]').css(
         {'width':'200px','display':'inline-block'}
      );

//HAPUS JABATAN KATEGORI UTAMA
$(document).on("click",".HapKatJab",function(){var IdHapKatJab=$(this).attr("IdHapKatJab");$("#IdHapKatJab").val(IdHapKatJab);$("#ConfirmHapKatJab").modal("show");});
//PROSES HAPUS
$(document).on("submit","#myFormHapKatJab",function(a){a.preventDefault();var e=$("#myFormHapKatJab").data("route"),t=$(this),s=$("#OverlayHapKatJab");$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.ajax({type:"POST",url:e,data:t.serialize(),beforeSend:function(){$(s).append('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i>Sedang Memproses Data</div>'),Pace.restart();},success:function(a,e){switch(a.ceks){case"berhasil":swal("Berhasil!","Berhasil Menghapus Jabatan Kategori Utama","success");break;case"gagal":swal("Gagal!","Gagal Menghapus Data","error");break;case"anak-anak":swal("Gagal!","Jabatan Detail Dari Kategori Jabatan Ini Masih Ada!, Harap Hapus Terlebih Dahulu","error");break;}},complete:function(){$(".overlay").remove(),$("#ConfirmHapKatJab").modal("hide");$.unblockUI();$("#datatablespegawai").DataTable().ajax.reload();},error:function(a){swal("Upsss!","Terjadi Kesalahan","error");},});});
//EDIT JABATAN KATEGORI UTAMA
$(document).on("click",".EditPegawaiJab",function(){var IdPegawai=$(this).attr("IdPegawai");var NamaJabatan=$(this).attr("NamaJabatan");var LengkapJabatan=$(this).attr("LengkapJabatan");var KategoriJabatan=$(this).attr("KategoriJabatan");$("#idSetjab").val(IdPegawai);$("#aaNamaJab").val(NamaJabatan);$("#bbNamaLengJab").val(LengkapJabatan);$('#ddKatJab option[value="'+KategoriJabatan+'"]').attr("selected","selected");$("#EditKatJabJabatan").modal("show");});
//PROSES EDIT JABATAN KATEGORI UTAMA
$(document).on("submit", "#myFormEdKatJab", function (a) {
  a.preventDefault();
  var e = $("#myFormEdKatJab").data("route"),
    t = $(this),
    s = $("#OverlayEdKatJab");
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    }
  }), $.ajax({
    type: "POST",
    url: e,
    data: t.serialize(),
    beforeSend: function () {
      $(s).append('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i>Sedang Memproses Data</div>'), Pace.restart();
    },
    success: function (a, e) {
      switch (a.ceks) {
      case "berhasil":
        swal("Berhasil!", "Berhasil Mengubah Kategori Jabatan", "success");
        break;
      case "gagal":
        swal("Gagal!", "Gagal Mengubah Data", "error");
        break;
      case "ganda":
        swal("Gagal!", "Gagal, Kategori Ini Sudah Dipakai", "error");
        break;
      }
    },
    complete: function () {
      $(".overlay").remove(), $("#EditKatJabJabatan").modal("hide");
      $.unblockUI();
      $("#datatablespegawai").DataTable().ajax.reload();
    },
    error: function (a) {
      swal("Upsss!", "Terjadi Kesalahan", "error");
    },
  });
});
//EDIT NAMA DETAIL JABATAN SAJA
$(document).on("click",".EdDetJab",function(){$("#ViewEdDetJab").modal("show");var NaJab=$(this).attr("NaJab");var NaLeng=$(this).attr("NaLeng");var Kat=$(this).attr("Kat");var IdSetJab=$(this).attr("IdSetJab");var JabDetEd=$(this).attr("JabDetEd");$("#bb").val(NaJab);$("#cc").val(NaLeng);$("#dd").val(Kat);$("#aa").val(IdSetJab);$(".ee").val(JabDetEd);});
//PROSES EDIT NAMA DETAIL JABATAN SAJA
$(document).on("submit","#myFormEdDetJab",function(a){a.preventDefault();var e=$("#myFormEdDetJab").data("route"),t=$(this),s=$("#OverlayEdDetJab");$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.ajax({type:"POST",url:e,data:t.serialize(),beforeSend:function(){$(s).append('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i>Sedang Memproses Data</div>'),Pace.restart();},success:function(a,e){switch(a.ceks){case"berhasil":swal("Berhasil!","Berhasil Mengubah Detail Jabatan Saja","success");break;case"gagal":swal("Gagal!","Gagal Mengubah Data","error");}},complete:function(){$(".overlay").remove(),$("#ViewEdDetJab").modal("hide");$.unblockUI();$("#datatablespegawai").DataTable().ajax.reload();},error:function(a){swal("Upsss!","Terjadi Kesalahan","error");},});});
//HAPUS JABATAN DETAIL
$(document).on("click",".HapDet",function(){var HapDetW=$(this).attr("HapDetW");var HapDetW2=$(this).attr("HapDetW2");$("#GBH").val(HapDetW);$("#GBH2").val(HapDetW2);$("#ConfirmHapDet").modal("show");});
//PROSES HAPUS DETAIL JABATAN
$(document).on("submit","#myFormHapDet",function(a){a.preventDefault();var e=$("#myFormHapDet").data("route"),t=$(this),s=$("#OverlayHapDet");$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.ajax({type:"POST",url:e,data:t.serialize(),beforeSend:function(){$(s).append('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i>Sedang Memproses Data</div>'),Pace.restart();},success:function(a,e){switch(a.ceks){case"berhasil":swal("Berhasil!","Berhasil Menghapus Detail Jabatan","success");break;case"gagal":swal("Gagal!","Gagal Menghapus Data","error");}},complete:function(){$(".overlay").remove(),$("#ConfirmHapDet").modal("hide");$.unblockUI();$("#datatablespegawai").DataTable().ajax.reload();},error:function(a){swal("Upsss!","Terjadi Kesalahan","error");},});});


$(document).on("click", ".TambahJabatan", function () {
    $("#ViewTambahJabatan").modal("show");
});
//PROSES TAMBAH JABATAN KATEGORI
$(document).on("submit","#myForm",function(a){a.preventDefault();var e=$("#myForm").data("route"),t=$(this),s=$("#OverlayTamKatJab");$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.ajax({type:"POST",url:e,data:t.serialize(),beforeSend:function(){$(s).append('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i>Sedang Memproses Data</div>'),Pace.restart();},success:function(a,e){switch(a.ceks){case"berhasil":swal("Berhasil!","Berhasil Menambah Kategori Jabatan","success");break;case"gagal":swal("Gagal!","Gagal Menambah Data","error");break;case"ganda":swal("Gagal!","Gagal, Kategori Ini Sudah Dipakai","error");break;}},complete:function(){$(".overlay").remove(),$("#ViewTambahJabatan").modal("hide");$.unblockUI();$("#datatablespegawai").DataTable().ajax.reload();},error:function(a){swal("Upsss!","Terjadi Kesalahan","error");},});});


$(document).on("click",".DetJab",function(a){$("#ViewDetJab").modal("show");var NaJab=$(this).attr("NaJab");var NaLeng=$(this).attr("NaLeng");var Kat=$(this).attr("Kat");var IdSetJab=$(this).attr("IdSetJab");$("#NaJab").val(NaJab);$("#Naleng").val(NaLeng);$("#Kat").val(Kat);$("#IdSetJab").val(IdSetJab);});
//PROSES TAMBAH DETAIL JABATAN
$(document).on("submit","#myFormDetJab",function(a){a.preventDefault();var e=$("#myFormDetJab").data("route"),t=$(this),s=$("#OverlayTamKatJab2");$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.ajax({type:"POST",url:e,data:t.serialize(),beforeSend:function(){$(s).append('<div class="overlay d-flex justify-content-center align-items-center"><i class="fas fa-2x fa-sync fa-spin"></i>Sedang Memproses Data</div>'),Pace.restart();},success:function(a,e){switch(a.ceks){case"berhasil":swal("Berhasil!","Berhasil Menambah Detail Jabatan Saja","success");break;case"gagal":swal("Gagal!","Gagal Menambah Data","error");break;case"ganda":swal("Gagal!","Jabatan Sudah Ada Di Bagian Detail Ini","error");break;}},complete:function(){$(".overlay").remove(),$("#ViewDetJab").modal("hide");$.unblockUI();$("#datatablespegawai").DataTable().ajax.reload();},error:function(a){swal("Upsss!","Terjadi Kesalahan","error");},});});

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
});

</script>
<style>
td.details-control{background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_open.png') no-repeat center center; cursor: pointer;}tr.shown td.details-control{background: url('https://raw.githubusercontent.com/DataTables/DataTables/1.10.7/examples/resources/details_close.png') no-repeat center center;}div.slider{display: none;}.modal{overflow-y:auto;}.select2-selection{background-color: #ffffff !important; color: black;}
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: #1d2a38;
}

</style>

@include('sweet::alert')
@endsection
