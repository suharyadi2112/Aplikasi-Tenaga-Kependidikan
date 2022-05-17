
@extends('admin.layout.master')
@section('content')
<!--toastr alert-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" />
<!--date multi picker jquery ui-->
<link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" rel="stylesheet"/>
<link rel="stylesheet" href="{{ URL::asset('admin/plugins/jquery-mulitdatepicker/jquery-ui.multidatespicker.css') }}">
<!--load menunggu-->
<link href="{{ URL::asset('admin/dist/css/load_fb.css') }}" rel="stylesheet"/>

<?php if(cek_akses('100') == 'yes'){ ?>

<div class="container-fluid"> 
    <div class="row">
      <div class="col-12">
        <br>
        <!--font size="2" color="blue"><b>* S-U : Status Upload</b></fon-->
        <!--PERIODE CONTOH periode 1 Juli 2020 - 30 Juni 2021-->
      @if ($message = Session::get('success'))<div class="uk-alert uk-alert-success" data-uk-alert> <a href="" class="uk-alert-close uk-close"></a><div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <strong>{{ $message }}</strong></div></div> @endif
      @if ($message = Session::get('error'))<div class="uk-alert uk-alert-error" data-uk-alert> <a href="" class="uk-alert-close uk-close"></a><div class="alert alert-error alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <strong>{{ $message }}</strong></div></div> @endif

        <div class="card card-success">
          <div class="card-body bg-dark p-2">
            <h3 class="card-title">CUTI PEGAWAI | </h3>&nbsp;
            <a class="btn btn-sm btn-info" id="BtnSetupF" data-toggle="collapse" href="#collapseExample123" role="button" aria-expanded="false" aria-controls="collapseExample123">
              <span id="SpanSetup" class="fa fa-plus-circle"> </span> Setup
            </a>
            
            <div class="collapse" id="collapseExample123">
              <div class=" pb-2 pl-5 pr-5 pt-2">
                <div class="callout callout-warning" style="background-color: #0D143E">
                <div class="row">
                  <div class="form-group">
                    @php
                    $year = DB::table('c_periode_cuti')->select('id_kategori','periode_awal','periode_akhir')->orderBy('periode_awal','DESC')->get();
                    @endphp

                    <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                        <select class="form-control PilihTahun" id="targetYear" name="PilihTahun" onchange="top.location.href = this.options[this.selectedIndex].value" @if(cek_akses('101') == 'yes') @else disabled="" title="Anda Tidak Memiliki Akses" @endif>
                          <option>Pilih Periode</option>
                          @foreach($year as $jy => $Vyear)
                          <option value="{{Route('CutiPegawai', ['PeriodeAwal'=>$Vyear->periode_awal,'PeriodeAkhir'=>$Vyear->periode_akhir]) }}">{{ tanggal_indo($Vyear->periode_awal) }} - {{ tanggal_indo($Vyear->periode_akhir) }}</option>
                          @endforeach
                        </select>
                    </div>
                        @if(cek_akses('101') == 'yes') @else 
                        <span class="badge badge-pill badge-danger" style="cursor: pointer;" onclick="AlertAkses()"><i class="fa fa-exclamation"></i></span> <code>info</code> 
                        @endif
                  </div>
               
                    @php
                      $periode = request()->PeriodeAwal;
                      $periodeb = request()->PeriodeAkhir;
                      if ($periode) {
                        $periodeCek = $periode;
                      } else { 
                        $cekPeriod = DB::table('c_periode_cuti')->select('periode_awal')->orderBy('periode_awal','DESC')->latest()
                                ->first();
                        if ($cekPeriod) {
                          $periodeCek = $cekPeriod->periode_awal;
                        }else{
                          $periodeCek = '';
                        }
                      }
                    @endphp
                    &nbsp;&nbsp;
                    <div class="form-group">
               
                      <button type="button" class="btn btn-outline-info LihatPeriode" @if(cek_akses('102') == 'yes') @else  title="Anda Tidak Memiliki Akses" disabled @endif >
                        <span class="fa fa-calendar"></span> Periode & Cuti Bersama
                      </button><br>
                      @if(cek_akses('102') == 'yes') @else  <span class="badge badge-pill badge-danger" style="cursor: pointer;" onclick="AlertAkses()"><i class="fa fa-exclamation"></i></span> <code>info</code>  @endif
                      
                    </div>


                    &nbsp;&nbsp;
                    <div class="form-group">
                     
                        <button class="btn btn-outline-info TambahPegawai" type="button" @if(cek_akses('103') == 'yes') @else  title="Anda Tidak Memiliki Akses" disabled="" @endif>
                           <span class="fa fa-users"></span> Pegawai
                        </button><br>
                      @if(cek_akses('103') == 'yes') @else  <span class="badge badge-pill badge-danger" style="cursor: pointer;" onclick="AlertAkses()"><i class="fa fa-exclamation"></i></span> <code>info</code>  @endif
                    </div>

                    &nbsp;&nbsp;
                    <div class="form-group">
                      <button class="btn btn-primary" id="BtnHistoryCheck" data-target="#HistoryCheck" data-toggle="collapse" type="button" role="button" aria-expanded="false" aria-controls="HistoryCheck" @if(cek_akses('104') == 'yes') @else  title="Anda Tidak Memiliki Akses" disabled @endif>
                           <span class="fa fa-history"></span> History
                        </button><br>
                        @if(cek_akses('104') == 'yes') @else  <span class="badge badge-pill badge-danger" style="cursor: pointer;" onclick="AlertAkses()"><i class="fa fa-exclamation"></i></span> <code>info</code>  @endif
                    </div>
                    &nbsp;&nbsp;
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-file-excel"></i></span>
                        </div>
                        <select class="form-control" onchange="window.open(this.value, '_blank')" @if(cek_akses('105') == 'yes') @else  title="Anda Tidak Memiliki Akses" disabled @endif>
                          <option value="">Excel</option>
                          @forelse($year as $jy => $Vyear)
                            <option value="{{ Route('ExportCutiInfo',['id_periode' => $Vyear->id_kategori]) }}">{{ tanggal_indo($Vyear->periode_awal) }} - {{ tanggal_indo($Vyear->periode_akhir) }}</option>
                            @empty
                            <option value="">Tidak Ada Data</option>
                          @endforelse
                        </select>
                      </div>
                       @if(cek_akses('105') == 'yes') @else  <span class="badge badge-pill badge-danger" style="cursor: pointer;" onclick="AlertAkses()"><i class="fa fa-exclamation"></i></span> <code>info</code>  @endif
                    </div>
                  </div>

                  </div>
               </div>
             </div>
            
            <div class="collapse" id="HistoryCheck" data_id="cekhistory" style="padding-top:10px;">
              <div class="pb-2 pl-5 pr-5">
                <div class="card card-body bg-light">
                  <div class="shadow p-3 mb-5 bg-white rounded">
                    <h4><u>Histori Transaksi Cuti</u></h4>
                    <div id="KontenHistory"></div>
                  </div>
                </div>
              </div>
            </div>
         
            <div class="table-responsive pt-4">
              <table id="cekcutipegawai" class="table table-striped table-bordered display table-dark table-hover" width="100%">
                <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th style="vertical-align: middle; text-align: center">No</th>
                  <th style="vertical-align: middle; text-align: center; white-space: nowrap;">Nama Karyawan</th> 
                  <th nowrap="" style="vertical-align: middle; text-align: center">TMK</th>
                  <th nowrap="" style="vertical-align: middle; text-align: center">Hak</th>
                  <th nowrap="" style="vertical-align: middle; text-align: center">Sisa</th>
                  <th nowrap="" style="width: 100px; vertical-align: middle;">Cuti Bersama</th>
                  <th nowrap="" style="vertical-align: middle; text-align: center">Ambil Cuti</th>
                  <th nowrap="" style="vertical-align: middle; text-align: center">Periode</th>
                  <th nowrap="" style="vertical-align: middle; text-align: center">Aksi</th>
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



<!--LIHAT PENGAMBILAN CUTI-->
<div class="modal fade" id="ViewModalAmbilCuti" role="dialog" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content" id="modal-content"><div class="row"><div class="col-lg-12"><div class="modal-header bg-info p-2"><h5 class="modal-title" id="staticBackdropLabel">Pengambilan Cuti</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div><div class="modal-body" ><div id="LihatHasilAmbilCuti"></div></div></div></div></div></div></div>
<!--LIHAT PERIODE / INDEX PERIODE-->
<div class="modal fade" id="ViewPeriode" role="dialog" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-xl"><div class="modal-content" id="modal-content"><div class="row"><div class="col-lg-12"><div class="modal-header bg-info p-3"><h5 class="modal-title" id="staticBackdropLabel">Periode</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div><div class="modal-body" id="renderPeriode"></div></div></div></div></div></div>
<!--EDIT PERIODE-->
<div class="modal fade" id="EditPeriode" role="dialog" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content bg-dark" id="modal-content"><div class="row"><div class="col-lg-12"><div class="modal-body p-1" id="RenderEditPeriode"></div></div></div></div></div></div>
<!--EDIT CUTI BERSAMA-->
<div class="modal fade" id="EditCutiBersama" role="dialog" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content bg-dark" id="modal-content"><div class="row"><div class="col-lg-12"><div class="modal-body p-1" id="RenderEditCutiBersama"></div></div></div></div></div></div>
<!--TAMBAH PEGAWAI DALAM PERIODE-->
<div class="modal fade" id="TambahPegawai" data-backdrop="static" role="dialog" tabindex="-1" aria-hidden="true"><div class="modal-dialog"><div class="modal-content" id="modal-content"><div id="overlayTmpeg"></div><div class="row"><div class="col-lg-12"><div class="modal-header bg-info p-3"><h5 class="modal-title" id="staticBackdropLabel">Tambah Pegawai Dalam Periode Terpilih</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div><form data-route="{{ route('TamPegCuti') }}" id="TamPegCutForm" role="form" method="POST" accept-charset="utf-8"><div class="modal-body p-2" id="RenderTambahPegawai"></div><div class="modal-footer"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <button type="submit" class="btn btn-info TamPegCutiBtn" style="float:right;"><span class="fa fa-save"></span> Simpan</button></div></form></div></div></div></div></div>
<!--GET DAA UBAH KARYAWAN CUTI-->
<div class="modal fade" id="EditCutKat" data-backdrop="static" role="dialog" tabindex="-1" aria-hidden="true"><div class="modal-dialog"><div class="modal-content" id="modal-content"><div id="overlayUbKarCut"></div><div class="row"><div class="col-lg-12"><div class="modal-header bg-info p-3"><h5 class="modal-title" id="staticBackdropLabel">Ubah Data Karyawan Yang Tersedia</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div><div class="modal-body p-3" id="RenderCutKar"></div></div></div></div></div></div>


@endsection
@section('script')
<!--toastr alert-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
<!--date multi picker jquery ui-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{ URL::asset('admin/plugins/jquery-mulitdatepicker/jquery-ui.multidatespicker.js')}}"></script>

<script type="text/javascript">
//no akses alert
function AlertAkses() {
  alert('Tidak Memiliki Akses');
}

$.noConflict();
jQuery( document ).ready(function( $ ) {

$('#cekcutipegawai').DataTable({
        processing: true,
        serverSide: true,
        bStateSave : true,
        //scrollY : false,
        order: [[ 1, "DESC" ],[ 0, "DESC" ]],
        ajax: '{{route("GetCutiPegawai", ['periode' => $periodeCek])}}',
        language: {
            "infoFiltered":"",
            "processing": '<img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 30%;">',
            "searchPlaceholder": "Masukan Nama Pegawai",
        },
        columns: [
            { data: 'id_cuti', name: 'c_cuti.id_cuti', visible: false },
            { data: 'tahun', name: 'c_cuti.tahun', visible: false },
            { data: null,name: 'c_cuti.id_cuti', sortable: false, 
                 render: function (data, type, row, meta) {
                           return meta.row + meta.settings._iDisplayStart + 1;
                          }  
            },
            { data: 'nama_karyawan', name: 'pegawai.nama_karyawan' },
            { data: 'tmk', name: 'pegawai.tmk',

              render: function(value, type, row, meta){
                  if (row.tmk) {
                     return row.tmk;
                  }else{
                      var output1="";
                      output1 += '<a data-toggle="collapse" id="BtnTmkOpClo'+row.id_pegawai+'" href="#tmk'+row.id_pegawai+'" class="btn btn-outline-info btn-xs" role="button" aria-expanded="false" aria-controls="tmk'+row.id_pegawai+'">'+
                          '<span id="spanTmk'+row.id_pegawai+'" class="fa fa-user-clock"> </span>'+
                        '</a>'+
                      '<div class="collapse" id="tmk'+row.id_pegawai+'"><hr style="margin-top: 7px;margin-bottom: 7px;">';
                      output1+= '<form data-route="{{ route('UpdateTmkViaCuti') }}" class="UpdateTmk" role="form" method="POST" accept-charset="utf-8"><div class="input-group input-group-sm" style="width:180px;"><input type="date" name="TangglTmk" class="form-control" required><input type="hidden" name="id_pegawai" value="'+row.id_pegawai+'" class="form-control"><span class="input-group-append"><button type="submit" class="btn btn-info btn-flat"><span  class="fa fa-pen"></span></button></span></div></form>';
                      output1+= '</div>';
                    //openclose update tmk
                    $('#tmk'+row.id_pegawai+'').on('show.bs.collapse',function(e){$('#BtnTmkOpClo'+row.id_pegawai+'').toggleClass("btn-outline-info btn-danger");$('#spanTmk'+row.id_pegawai+'').toggleClass("fa-user-clock fa-times-circle");});$('#tmk'+row.id_pegawai+'').on('hide.bs.collapse',function(e){$('#BtnTmkOpClo'+row.id_pegawai+'').toggleClass("btn-danger btn-outline-info");$('#spanTmk'+row.id_pegawai+'').toggleClass("fa-times-circle fa-user-clock");});

                    return output1;
                  }
               }
            },
            { data: 'hak_cuti', name: 'c_cuti.hak_cuti',
               render: function(type, row,row){
                return '<span class="badge badge-pill badge-info" style="width:4rem;">'+row.hak_cuti+' Hari</span>';
               }
            },
            { data: 'sisa_cuti', name: 'c_cuti.sisa_cuti',
              render: function(type, row,row){
                if (row.sisa_cuti > 0) {
                  return '<span class="badge badge-pill badge-success badge-sm" style="width:4rem;">'+row.sisa_cuti+' Hari</span>';
                }else{
                  var output2="";
                    output2 += '<a data-toggle="collapse" href="#SisaCuti'+row.id_pegawai+'" role="button" aria-expanded="false" aria-controls="SisaCuti1234">'+
                          '<span class="badge badge-pill badge-danger" style="width:4rem;">0 Hari</span>'+
                        '</a>'+
                      '<div class="collapse" id="SisaCuti'+row.id_pegawai+'">';
                    output2 +=  '<b>'+row.sisa_cuti+' Hari</b>';
                    output2+= '</div>';
                    return output2;
                }
              }
            },
            { data: 'CutiBersama', 
              render: function(value, type, row, meta){
              var output3="";
              output3 += '<b>'+row.CutiBersama.length+' Hari </b>| <a data-toggle="collapse" href="#collapseExample'+row.id_pegawai+'" role="button" aria-expanded="false" aria-controls="collapseExample123">'+
                  '<span class="fa fa-calendar"> </span> detail'+
                '</a>'+
              '<div class="collapse" id="collapseExample'+row.id_pegawai+'">';
              for(var i=0;i<row.CutiBersama.length;i++){
                output3 +=  '<span class="badge badge-pill badge-success"style="width:auto;">'+row.CutiBersama[i]+'</span><br>';
              }
              output3+= '</div>';
              return output3;
             }
           },
           { data: 'TotalCuti', name: 'TotalCuti'},
           { data: 'periode', name: 'periode'},
           { data: 'cutiambil', name: 'cutiambil'},
        ],
        createdRow:function(row,data,index){$('td',row).eq(0).attr("style","vertical-align: middle; text-align: center");$('td',row).eq(1).attr("style","vertical-align: middle;");$('td',row).eq(2).attr("style","vertical-align: middle; text-align: center");$('td',row).eq(2).attr("nowrap","nowrap");$('td',row).eq(3).attr("style","vertical-align: middle; text-align: center");$('td',row).eq(3).attr("nowrap","nowrap");$('td',row).eq(4).attr("style","vertical-align: middle; text-align: center");$('td',row).eq(4).attr("nowrap","nowrap");$('td',row).eq(5).attr("style","vertical-align: middle;");$('td',row).eq(6).attr("style","vertical-align: middle;");$('td',row).eq(6).attr("nowrap","nowrap");$('td',row).eq(7).attr("style","vertical-align: middle; text-align: center");$('td',row).eq(7).attr("nowrap","nowrap");$('td',row).eq(8).attr("style","vertical-align: middle; text-align: center");$('td',row).eq(8).attr("nowrap","nowrap");},
    });
    $('.dataTables_filter input[type="search"]').css(
         {'width':'200px','display':'inline-block'}
    );
 
    //UPDATE TANGGAL TMK
    $(document).on('submit','.UpdateTmk',function(e){var result=confirm("Yakin untuk update TMK, pastikan tanggal yang masukan sudah benar ? saat sudah ter-update dan ingin mengubah kembali TMK, harap mengubahnya di menu PEGAWAI");e.preventDefault();var route=$('.UpdateTmk').data('route');var form_data=$(this);$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});if(result){$.ajax({type:'POST',url:route,data:form_data.serialize(),beforeSend:function(){Pace.restart();},success:function(data){switch(data.cek){case"berhasil":toastr.success('Berhasil Mengubah Data TMK Pegawai');break;case"noakses":toastr.warning('Anda tidak memiliki akses');break;case"cutihabis":toastr.error('Gagal Mengubah Data TMK Pegawai');break;}},complete:function(){$('#cekcutipegawai').DataTable().ajax.reload();},error:function(xhr){swal("Upsss!","TERJADI kESALAHAN","error");},})}});

    //UBAH CUTI KARYAWAN
    // $(document).on('click','.UbahCutiKaryawan',function(){var id=$(this).data("id");$.post('{{ Route('GetDataUbahCutiKaryawan') }}',{_token:"{{ csrf_token() }}",data_id:id,beforeSend:function(){Pace.restart();},}).done(function(data,response){$("#RenderCutKar").html(data.output);$("#EditCutKat").modal("show");$("#hak_cuti").keyup(function(){if(isNaN($(this).val())){$("#HasilSisa").html('<span class="badge badge-pill badge-danger">harap masukan angka</span>');$('.UbahDataCuti').attr('disabled','disabled');}else{var Hasil=$(this).val()-data.cutbertot;if(Hasil<=0){$("#HasilSisa").html('<b>-'+' Hari</b>');}else{var HasilNext=Hasil-data.cutamtot;if(HasilNext<=0){$("#HasilSisa").html('<b>-'+' Hari</b>');}else{$("#HasilSisa").html('<b>'+HasilNext+' Hari</b>');$("#SisaCutEsti").val(HasilNext);}} $('.UbahDataCuti').prop("disabled",false);}});});});

    $(document).on('click', '.UbahCutiKaryawan', function () {
          var id = $(this).data("id");
          $.post('{{ Route('GetDataUbahCutiKaryawan') }}', {
              _token: "{{ csrf_token() }}",
              data_id: id,
              beforeSend: function () {
                Pace.restart();
              },
            }).done(function (data, response) {
            $("#RenderCutKar").html(data.output);
            $("#EditCutKat").modal("show");

            $("#hak_cuti").keyup(function () {
              if (isNaN($(this).val())) {
                $("#HasilSisa").html('<span class="badge badge-pill badge-danger">harap masukan angka</span>');
                $('.UbahDataCuti').attr('disabled', 'disabled');
              } else {
                var Hasil = $(this).val() - data.cutbertot;
                if (Hasil <= 0) {
                  $("#HasilSisa").html('<b>-' + ' Hari</b>');
                  $("#SisaCutEsti").val(Hasil);
                } else {
                  var HasilNext = Hasil - data.cutamtot;
                  if (HasilNext <= 0) {
                    $("#HasilSisa").html('<b>-' + ' Hari</b>');
                  } else {
                    $("#HasilSisa").html('<b>' + HasilNext + ' Hari</b>');
                    $("#SisaCutEsti").val(HasilNext);
                    console.log(HasilNext);
                  }
                }
                $('.UbahDataCuti').prop("disabled", false);
              }
            });

          });
        });


    $(document).on('submit','#UbahDataKaryawanCuti',function(e){e.preventDefault();var route=$('#UbahDataKaryawanCuti').data('route');var form_data=$(this);var wrapper=$("#overlayUbKarCut");$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});$.ajax({type:'POST',url:route,data:form_data.serialize(),beforeSend:function(){$('.UbahDataCuti').attr('disabled','disabled');Pace.restart();$(wrapper).append('<div class="overlay d-flex justify-content-center align-items-center" id="ckjuts">'+'<i class="fas fa-2x fa-sync fa-spin"></i>'+' Sedang Memproses Data'+'</div>');},success:function(data){switch(data.cek){case"berhasil":toastr.success('Berhasil Mengubah Data Cuti Karyawan');break;case"gagal":toastr.error('Gagal Mengubah Data Cuti Karyawan');break;} $('#cekcutipegawai').DataTable().ajax.reload();},complete:function(){$('.UbahDataCuti').prop("disabled",false);$('#ckjuts').remove();},error:function(xhr){swal("Upsss!","TERJADI kESALAHAN","error");},})});

    //HAPUS KARYAWAN DARI LIST CUTI
    $(document).on('click','.HapusKaryawanCuti',function(){var id=$(this).data("id");var result=confirm("Yakin Untuk Menghapus Karyawan Ini Dari Daftar Cuti ?");if(result){$.post('{{ Route('HapusKarFromCut') }}',{_token:"{{ csrf_token() }}",data_id:id,beforeSend:function(){Pace.restart();},}).done(function(data,response){switch(data.cek){case'berhasil':toastr.success('Berhasil Menghapus Karyawan Dari List Cuti.');break;case'gagal':toastr.error('Gagal Menghapus Karyawan Dari List Cuti.');break;case'Exits':toastr.warning('Karyawan ini masih memiliki data di Ambil Cuti, mohon hapus terlebih dahulu data di Ambil Cuti.');break;default:} $('#cekcutipegawai').DataTable().ajax.reload();})}});

    //OPEN CLOSE SETUP 
    $('#collapseExample123').on('show.bs.collapse',function(e){$("#BtnSetupF").toggleClass("btn-info btn-outline-danger");$("#SpanSetup").toggleClass("fa-plus-circle fa-times-circle");});$('#collapseExample123').on('hide.bs.collapse',function(e){$("#BtnSetupF").toggleClass("btn-outline-danger btn-info");$("#SpanSetup").toggleClass("fa-times-circle fa-plus-circle");});


////////////////////////////////PENGAMBILAN CUTI //////////////////////////////////////////

    //MODAL LIHAT AMBIL CUTI
    $(document).ready(function () {
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }),
        $(document).on("click", ".LihatAmbilCuti", function () {
          var id = $(this).data("id");
            $.ajax({
                url: '{{route("ShowDetailAmbilCuti")}}',
                method: "POST",
                data : {id_cuti:id},
                beforeSend: function () {Pace.restart();},
                success: function (e) {

                    if (e.akses == 'CutiHabis') { 
                        toastr.error('Pegawai Tidak Memiliki Cuti');
                    }
                    if (e.akses == 'noakses') {
                        toastr.warning('Anda Tidak Memiliki Akses');
                    }else{
                      $("#LihatHasilAmbilCuti").html(e.output);
                      //DATEMULTIPICKER
                      $(document).ready(function(){var arrAmbilCuti=e.ambil_cuti;var date=new Date();$('#mdp-demo').multiDatesPicker({dateFormat:"yy-mm-dd",
                        showAnim:"",  
                          onSelect: function() {
                          var datepickerObj = $(this).data("datepicker");
                          var datepickerSettings = datepickerObj.settings;
                          var d = new Date();
                          var dayDiff = datepickerObj.selectedDay - d.getDate();
                          var monthDiff = datepickerObj.selectedMonth - d.getMonth();
                          var yearDiff = datepickerObj.selectedYear - d.getFullYear();
                          var pickedDate =
                            "+" + dayDiff + "d +" + monthDiff + "m +" + yearDiff + "y";
                          delete datepickerSettings["defaultDate"];
                          datepickerSettings.defaultDate = pickedDate;
                          $("#mdp-demo").blur();
                          setTimeout(function() {
                            $("#mdp-demo").focus();
                          }, 1); 
                        },
                        beforeShowDay:function(date){var string=jQuery.datepicker.formatDate('yy-mm-dd',date);return[arrAmbilCuti.indexOf(string)==-1]}});});

                        var url = '{{route("GetDatPengCut", ":id_cuti")}}'.replace(":id_cuti", id);
                        $('#TablePengambilanCuti').DataTable({
                            processing: true,
                            serverSide: true,
                            //bStateSave : true,
                            //scrollY : false,
                            order: [[ 1, "DESC" ]],
                            ajax: url,
                            language: {
                                "infoFiltered":"",
                                "processing": '<img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 20%;">',
                                "searchPlaceholder": "Masukan Tanggal",
                            },
                            columns: [
                                { data: null,name: 'c_detail_cuti.id_set_cuti', sortable: false, 
                                     render: function (data, type, row, meta) {
                                               return meta.row + meta.settings._iDisplayStart + 1;
                                              }  
                                },
                                { data: 'ambil_cuti', name: 'c_detail_cuti.ambil_cuti' },
                                { data: 'filename', name: 'c_bukti.filename',
                                   render: function(type, row,row){
                                    if (row.filename) {
                                      return ''+row.filename+'';
                                    }else{
                                      return '<span class="badge badge-pill badge-danger" style="width:5rem;">Belum Upload</span>';
                                    }
                                  }
                                },
                                { data: 'ket_cuti', name: 'c_detail_cuti.ket_cuti' },
                                { data: 'aksi', name: 'aksi'},
                            ],
                            createdRow: function ( row, data, index ) {
                              $('td', row).eq(1).attr("nowrap","nowrap");
                              $('td', row).eq(0).attr("style","width:20px");
                            },
                        });

                        $("#ViewModalAmbilCuti").modal("show");
                        //OPEN TAMBAH PENGAMBILAN CUTI
                        $('#TambahAmbilCutiCh').on('show.bs.collapse',function(e){$("#TmcutBtn").toggleClass("btn-info btn-outline-danger");$("#spanAmCut").toggleClass("fa-plus-circle fa-times-circle");});$('#TambahAmbilCutiCh').on('hide.bs.collapse',function(e){$("#TmcutBtn").toggleClass("btn-outline-danger btn-info");$("#spanAmCut").toggleClass("fa-times-circle fa-plus-circle");});

                        //OPEN CLOSE UPLOAD FILE
                        $('#UploadFile').on('hide.bs.collapse',function(e){$("#BtnUploadFileCut").toggleClass("btn-outline-danger btn-info");$("#spanFileUpload").toggleClass("fa-times-circle fa-file-image");});


                        $('#UploadFile').on('show.bs.collapse', function(e){
                          $("#BtnUploadFileCut").toggleClass("btn-info btn-outline-danger");
                          $("#spanFileUpload").toggleClass("fa-file-image fa-times-circle");
                          var depId  = $(e.target).attr('data_id').replace('collapse','');
                          var wrapper = $("#KontenUpload");
                          $.post('{{ Route('KontenUploadCuti') }}', {
                              _token: "{{ csrf_token() }}",
                              data_id:depId,
                              beforeSend: function() { 
                                $(wrapper).html(Loading());
                              },
                          }).done(function(data, response) {
                            //CEK AKSES
                            if (data.output == 'noakses') {
                              toastr.warning('Anda tidak memiliki akses');
                            }else{
                               $("#KontenUpload").html(data.output);
                             
                                //PEMBATAS FILE YANG  DIUPLOAD / 5 mb
                                CekFile(document.getElementById('select_file'));
                                //PROSES KE SERVER UPLOAD FILE
                                $(document).ready(function(){$('#upload_form').on('submit',function(event){event.preventDefault();$.ajax({url:"{{ route('UploadPengambilanCuti') }}",method:"POST",data:new FormData(this),dataType:'JSON',contentType:false,cache:false,processData:false,beforeSend:function(){$('.UploadFileCheck').attr('disabled','disabled');Pace.restart();},success:function(data){switch(data.cek){case"berhasil":toastr.success('Berhasil Upload Data dan File');break;case"sudahAda":toastr.warning('Foto Sudah Ada | '+data.TglDipilih+'');break;case"gagal":toastr.error('Gagal Menambah Data');break;case"TglNo":toastr.warning('Tanggal Belum Dipilih');break;case"Kosongg":toastr.warning('Tidak ada cuti yang terpilih, harap periksa');break;}},complete:function(){$('.UploadFileCheck').prop("disabled",false);reloadPengcut();},})});});
                            }
                          });
                        });
                        //tutup collapse
                        //GET DATA CUTI UNTUK DISET KE COLLPASE EDIT
                        //DATEMULTIPICKER
                        $(document).on('click','.EditDataCut',function(){var id=$(this).data("id");$.post('{{ Route('GetDataCutEdit') }}',{_token:"{{ csrf_token() }}",data_id:id,beforeSend:function(){Pace.restart();$("#FormEditCuti").slideUp();},}).done(function(data,response){$("#FormEditCuti").slideDown();$("textarea#ket_cuti_ytr").val(data.ket_cuti);$("#SetTanggalEdit").val(data.tanggal);$("#id_set_cuti").val(id);$(document).on('click','.CloseFormCut',function(){$("#FormEditCuti").slideUp();});});});

                        //UPDATE CUTI/PROSES
                        $(document).on('submit','#UpdateCutiPros',function(e){e.preventDefault();var route=$('#UpdateCutiPros').data('route');var form_data=$(this);$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});$.ajax({type:'POST',url:route,data:form_data.serialize(),beforeSend:function(){$('.UpdateAmbilCuti').attr('disabled','disabled');Pace.restart();},success:function(data){switch(data.cek){case"berhasil":toastr.success('Berhasil Mengubah Data Cuti');break;case"cutihabis":toastr.error('Gagal Mengubah Data Cuti');break;} reloadPengcut();},complete:function(){$('.UpdateAmbilCuti').prop("disabled",false);},error:function(xhr){swal("Upsss!","TERJADI kESALAHAN","error");},})});

                    }
                },
            });
        });
      });
      
      function CekFile(CekFile){
        var file = CekFile;

        file.onchange = function() {
           for (var i = 0; i < file.files.length; i++) {
                if(this.files[i].size > 5242880){
                   swal( file.files.item(i).name  +  "", "File Mungkin Lebih 5MB!", "error");
                   this.value = "";
                }
                var ext = file.files[i].name.substr(-3);
                var ygempat = file.files[i].name.substr(-4);
                if(ext!== "jpg" && ygempat!== "jpeg" && ext !== "png" && ext !== "pdf")  {
                    swal( file.files.item(i).name  +  "", "Extention File Mungkin Tidak Diizinkan", "error");
                    this.value = '';
                }else{ alert( file.files.item(i).name  + ", File Diizinkan");}
              } function getFile(filePath) {
                  return filePath.substr(filePath.lastIndexOf('\\') + 1).split('.')[0];
              }
          };
      }

      //SIMPAN CUTI
      $(document).on('submit', '#SimpanPengambilanCuti', function(e) {  
        e.preventDefault();
        var route = $('#SimpanPengambilanCuti').data('route');
        var form_data = $(this);
        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
        Pace.track(function(){

          $.ajax({
            type: 'POST',
            url: route,
            data: form_data.serialize(),

            beforeSend:function(){$('.SimpanAmbilCuti').attr('disabled','disabled');Pace.restart();},

            success:function(data){switch(data.cek){case"berhasil":toastr.success('Berhasil Menambah Pengambilan Cuti');break;case"cutihabis":toastr.warning('Cuti Karyawan Ini Telah Habis');break;case"SisaCutLebihSikit":toastr.warning('Pengambilan Cuti Melebihi Sisa Cuti Yang Tersedia');break;case"gagal":toastr.error('Gagal Menambah Pengambilan Cuti');break;case"TglSudahAda":toastr.error('Tanggal yang dipilih saat ini sudah pernah dipilih sebelumnya');break;case"tglkosong":toastr.warning('Tanggal Tidak Boleh Kosong');break;} reloadPengcut();},

            complete:function(){$('.SimpanAmbilCuti').prop("disabled",false);},

            error:function(xhr){swal("Upsss!","TERJADI kESALAHAN","error");},
          });

        });
      });

      //HAPUS PILIHAN CUTI
      $(document).on('click','.HapusPilihCuti',function(){var id=$(this).data("id");var result=confirm("Yakin Untuk Menghapus Data Pengambilan Cuti Ini ?");if(result){$.post('{{ Route('HapusPengCuti') }}',{_token:"{{ csrf_token() }}",data_id:id,beforeSend:function(){Pace.restart();},}).done(function(data,response){switch(data.cek){case'berhasil':toastr.success('Berhasil Menghapus Pemilihan Cuti Ini.');break;case'gagal':toastr.error('Gagal Menghapus Data Pemilihan Cuti Ini.');break;}reloadPengcut();})}});

      //RELOAD TABLE BERDASARKAN ID
      function reloadPengcut(){$('#TablePengambilanCuti').DataTable().ajax.reload();$('#cekcutipegawai').DataTable().ajax.reload();}



////////////////////////////////PENGAMBILAN CUTI //////////////////////////////////////////

////////////////////////////////PERIODE SETUP & CUTI BERSAMA//////////////////////////////////////////
   
  //MODAL LIHAT PERIODE INDEx
  $(document).ready(function () {
  $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }),
      $(document).on("click", ".LihatPeriode", function () {

        Pace.track(function(){
          $.ajax({
              url: '{{route("LihatPeriodeCuti")}}',
              method: "POST",
              beforeSend: function () {Pace.restart();},
              success: function (e) {
                $("#renderPeriode").html(e);
                $('#periode').DataTable({
                    processing: true,
                    serverSide: true,
                    //bStateSave : true,
                    //scrollY : false,
                    order: [[ 1, "DESC" ]],
                    ajax: '{{route("GetPeriode")}}',
                    language: {
                        "infoFiltered":"",
                        "processing": '<img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 20%;">',
                        "searchPlaceholder": "Masukan Tanggal",
                    },
                    columns: [
                        { data: 'aksi', name: 'aksi'},
                        { data: 'periode_awal', name: 'c_periode_cuti.periode_awal' },
                        { data: 'periode_akhir', name: 'c_periode_cuti.periode_akhir' },
                        { data: 'keterangan_periode', name: 'c_periode_cuti.keterangan_periode'},
                        { data: 'cutibersama', name: 'cutibersama'},
                    ],
                      createdRow: function ( row, data, index ) {
                        $('td', row).eq(0).attr("style","vertical-align: middle; text-align: center");
                        $('td', row).eq(1).attr("style","vertical-align: middle; text-align: center");
                        $('td', row).eq(2).attr("style","vertical-align: middle; text-align: center");
                        $('td', row).eq(3).attr("style","vertical-align: middle; text-align: center");
                        $('td', row).eq(4).attr("style","width: 50%;");
                      },
                });
                //TAMPIL MODAL
              $("#ViewPeriode").modal("show");

              $('#PeriodeTam').on('show.bs.collapse',function(e){$("#BtnTambhPeriod").toggleClass("btn-info btn-outline-danger");$("#PeriodeTamSpan").toggleClass("fa-plus-circle fa-times-circle");});$('#PeriodeTam').on('hide.bs.collapse',function(e){$("#BtnTambhPeriod").toggleClass("btn-outline-danger btn-info");$("#PeriodeTamSpan").toggleClass("fa-times-circle fa-plus-circle");});
              },
          });
        });

        });
    });

 
  //SIMPAN PERIODE
  $(document).on('submit','#SimpanPeriode',function(e){e.preventDefault();var route=$('#SimpanPeriode').data('route');var form_data=$(this);$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});$.ajax({type:'POST',url:route,data:form_data.serialize(),beforeSend:function(){$('.SimpanPeriodety').attr('disabled','disabled');Pace.restart();},success:function(data){switch(data.cek){case"berhasil":toastr.success('Berhasil Menambah periode');break;case"gagal":toastr.error('Gagal Menambah Periode');break;} $('#periode').DataTable().ajax.reload();},complete:function(){$('.SimpanPeriodety').prop("disabled",false);},error:function(xhr){swal("Upsss!","TERJADI kESALAHAN","error");},})});

  //TAMBAH CUTI BERSAMA DALAM PERIODE
  $(document).on('click', '.TambCutBerCe', function () {
      var id = $(this).data("id");
      var awal = $(this).data("awal");
      var akhir = $(this).data("akhir");
      var date = new Date();
      $(".InputDateCutBer").html('<input name="tanggalCutBer[]" class="form-control" id="CutBerDate" size="20" placeholder="Click" readonly>');
      $('#CutBerDate').multiDatesPicker({
        dateFormat: "yy-mm-dd",
        showAnim:"",   
        defaultDate: awal,
        minDate: awal,
        maxDate: akhir,
        onSelect: function() {
          var datepickerObj = $(this).data("datepicker");
          var datepickerSettings = datepickerObj.settings;
          var d = new Date();
          var dayDiff = datepickerObj.selectedDay - d.getDate();
          var monthDiff = datepickerObj.selectedMonth - d.getMonth();
          var yearDiff = datepickerObj.selectedYear - d.getFullYear();
          var pickedDate =
            "+" + dayDiff + "d +" + monthDiff + "m +" + yearDiff + "y";
          delete datepickerSettings["defaultDate"];
          datepickerSettings.defaultDate = pickedDate;
          $("#CutBerDate").blur();
          setTimeout(function() {
            $("#CutBerDate").focus();
          }, 1); 
        },
      });
      $("#FormCutBer" + id + "").toggle(400);
    });

  //Edit Open Dan Close CutiBersama
  $(document).on('click','.EditCutiBersamaNew',function(){var id=$(this).data("id_periode");var id_cutber=$(this).data("id");var tanggal=$(this).data("tanggal");var ket=$(this).data("ket");$("#EditkahCutBer"+id+"").toggle(400);$("#EditkahCutBer"+id+"").show(400);$("#id_cutberKah"+id+"").val(id_cutber);$("#tanggalCutberkah"+id+"").val(tanggal);$("#ketCutBerkah"+id+"").val(ket);});
  $(document).on('click','.CloseCutBer',function(){var id=$(this).data("id_periode");$("#EditkahCutBer"+id+"").hide(400);});
  //UPDATE CUTI BERSAMA
  $(document).on('submit','.EditCutiBersamaPros',function(e){e.preventDefault();var route=$('.EditCutiBersamaPros').data('route');var form_data=$(this);$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});$.ajax({type:'POST',url:route,data:form_data.serialize(),beforeSend:function(){Pace.restart();$('.UpdateCutBerNew').attr('disabled','disabled');},success:function(data){switch(data.cek){case"berhasil":toastr.success('Berhasil Mengubah Data Cuti Bersama');$('.UpdateCutBerNew').prop("disabled",false);break;case"gagal":toastr.error('Gagal Mengubah Cuti Bersama');break;} $('#periode').DataTable().ajax.reload();},error:function(xhr){swal("Upsss!","TERJADI kESALAHAN","error");},})});
  //HAPUS PERIODE
  $(document).on('click','.HapusPeriode',function(){var id=$(this).data("id");var result=confirm("Yakin Untuk Menghapus Data periode Ini ?");if(result){$.post('{{ Route('HapusPeriodeCut') }}',{_token:"{{ csrf_token() }}",data_id:id,beforeSend:function(){Pace.restart();},}).done(function(data,response){switch(data.cek){case'berhasil':toastr.success('Berhasil Menghapus Data Periode.');break;case'gagal':toastr.error('Gagal Menghapus Data Periode.');case'cbma':toastr.error('Gagal Menghapus, Data Cuti Bersama Dalam Periode Masih Ada.');break;default:} $('#periode').DataTable().ajax.reload();})}});
  //GET DATA PERIODE UNTUK EDIT
  $(document).on('click','.EditPeriode',function(){var id=$(this).data("id");$.post('{{ Route('GetDataEditPriod') }}',{_token:"{{ csrf_token() }}",data_id:id,beforeSend:function(){Pace.restart();},}).done(function(data,response){$("#RenderEditPeriode").html(data);$("#EditPeriode").modal("show");});});
  //UPDATE PERIODE PERIODE
  $(document).on('submit','#UbahPeriode',function(e){e.preventDefault();var route=$('#UbahPeriode').data('route');var form_data=$(this);$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});$.ajax({type:'POST',url:route,data:form_data.serialize(),beforeSend:function(){Pace.restart();},success:function(data){switch(data.cek){case"berhasil":toastr.success('Berhasil Mengubah periode');break;case"gagal":toastr.error('Gagal Mengubah Periode');break;} $('#periode').DataTable().ajax.reload();},error:function(xhr){swal("Upsss!","TERJADI kESALAHAN","error");},})});
  //tambah cuti bersama
  $(document).on('submit','.SimpanCutBersama',function(e){e.preventDefault();var route=$('.SimpanCutBersama').data('route');var form_data=$(this);$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});$.ajax({type:'POST',url:route,data:form_data.serialize(),beforeSend:function(){$('.SimpanCut').attr('disabled','disabled');Pace.restart();},success:function(data){switch(data.cek){case"berhasil":toastr.success('Berhasil Menambah Cuti Bersama');break;case"gagal":toastr.error('Gagal Menambah Cuti Bersama');break;case"TglSudahAda":toastr.warning('Gagal Menambah Cuti Bersama Karena Tanggal Sudah Dipilih');break;case"tglkosong":toastr.warning('Tanggal Tidak Boleh Kosong');break;} $('#periode').DataTable().ajax.reload();},complete:function(data){$('#cekcutipegawai').DataTable().ajax.reload();},error:function(xhr){swal("Upsss!","TERJADI kESALAHAN","error");},})});
  //HAPUS CUTI BERSAMA
  $(document).on('click','.HapusCutiBersama',function(){var id=$(this).data("id");var result=confirm("Yakin Untuk Menghapus Data Cuti Bersama Ini ?");if(result){$.post('{{ Route('HapusCutiBersama') }}',{_token:"{{ csrf_token() }}",data_id:id,beforeSend:function(){Pace.restart();},}).done(function(data,response){switch(data.cek){case'berhasil':toastr.success('Berhasil Menghapus Data Cuti Bersama.');break;case'gagal':toastr.error('Gagal Menghapus Data Cuti Bersama.');break;default:} $('#periode').DataTable().ajax.reload();$('#cekcutipegawai').DataTable().ajax.reload();})}});

////////////////////////////////PERIODE SETUP & CUTI BERSAMA//////////////////////////////////////////


////////////////////////////////PEGAWAI SETUP//////////////////////////////////////////
    
  //TAMPIL MODAL TANBAH PEGAWAI DALAM PERIODE
  $(document).ready(function(){$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$(document).on("click",".TambahPegawai",function(){Pace.track(function(){$.ajax({url:'{{route("TamTamPegawai")}}',method:"POST",beforeSend:function(){Pace.restart();},success:function(e,data){$("#RenderTambahPegawai").html(e);$("#TambahPegawai").modal("show");$('#ForPegall').change(function(){$('#allpeg').attr('disabled','disabled');});$('#EventPeriode').change(function(){$.post('{{ Route('GetDataPegawaiCek') }}',{_token:"{{ csrf_token() }}",data_id:$(this).val(),beforeSend:function(){Pace.restart();},}).done(function(data,response){$("#ForPegall").html(data.ListPegAktif);$("#ListCutber").html(data.ketCutBer);});});$("#allpeg").change(function(){if(this.checked){$('#ForPegall').attr('disabled','disabled');}else{$('#ForPegall').prop("disabled",false);}});},});});});});

  //SIMPAN PEGAWAI CUTI DIPERIODE TERPILIH
  $(document).on('submit','#TamPegCutForm',function(e){e.preventDefault();var route=$('#TamPegCutForm').data('route');var form_data=$(this);var wrapper=$("#overlayTmpeg");$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});$.ajax({type:'POST',url:route,data:form_data.serialize(),beforeSend:function(){$(wrapper).append('<div class="overlay d-flex justify-content-center align-items-center" id="ckjut">'+'<i class="fas fa-2x fa-sync fa-spin"></i>'+' Sedang Memproses Data'+'</div>');Pace.restart();$('.TamPegCutiBtn').attr('disabled','disabled');},success:function(data){switch(data.cek){case"Bbanyak":toastr.success('Berhasil Menyimpan Pegawai Di Periode Terpilih Secara Multiple');break;case"Gbanyak":toastr.error('Gagal Menyimpan Data Secara Multiple');break;case"Bsolo":toastr.success('Berhasil Menyimpan Data');break;case"Gsolo":toastr.error('Gagal Menyimpan Data');break;case"Pexist":toastr.error('Pegawai Sudah Ada Diperiode Yang Dipilih');break;case"full":toastr.success('Semua Pegawai Aktif Sudah Ada Di Periode Cuti Ini');break;case"tes":toastr.error('Terjadi Kesalahan Yang Tidak Diketahui');break;}},complete:function(){$('.TamPegCutiBtn').prop("disabled",false);$('#ckjut').remove();$('#cekcutipegawai').DataTable().ajax.reload();},error:function(xhr){swal("Upsss!","TERJADI kESALAHAN","error");},})});


////////////////////////////////PEGAWAI SETUP//////////////////////////////////////////

////////////////////////////////HISTORY///////////////////////////////////////////////
//HISTORY
$('#HistoryCheck').on('hide.bs.collapse',function(e){$("#BtnHistoryCheck").toggleClass("btn-outline-danger btn-primary");$("#SpanHistory").toggleClass("fa-times-circle fa-history");});
$('#HistoryCheck').on('show.bs.collapse', function(e){
  $("#BtnHistoryCheck").toggleClass("btn-primary btn-outline-danger");
  $("#SpanHistory").toggleClass("fa-history fa-times-circle");
  var wrapper = $("#KontenHistory");
  $.post('{{ Route('HistoryCuti') }}', {
    _token: "{{ csrf_token() }}",
    beforeSend: function () {
      $(wrapper).html(Loading());
    },
  }).done(function (data, response) {
    $("#KontenHistory").html(data);
    //RENDER DATA HISTORY CUTI
    $(document).ready(function () {
        $('#HistoriTable').DataTable({
            processing: true,
            serverSide: true,
            //bStateSave : true,
            //scrollY : false,
            order: [[ 0, "DESC" ]],
            ajax: '{{route("GetHistoryCuti")}}',
            language: {
                "infoFiltered":"",
                "processing": '<img src="{{ URL::asset('admin/dist/img/1a.png')}}" style="padding:0px; width: 20%;">',
                "searchPlaceholder": "Tanggal",
            },
            columns: [
                { data: 'id_histori', name: 'c_history_cuti.id_histori', visible:false},
                { data: null,name: 'c_history_cuti.id_histori', sortable: false, 
                     render: function (data, type, row, meta) {
                               return meta.row + meta.settings._iDisplayStart + 1;
                              }  
                },
                { data: 'nama_karyawan', name: 'pegawai.nama_karyawan'},
                { data: 'jenis', name: 'c_history_cuti.jenis',
                  render: function(value, type, row, meta){
                    switch(row.jenis){
                      case"Ambil Cuti":
                      return '<span class="badge badge-pill badge-success">'+row.jenis+'</span>';
                      break;
                      case"Hapus Cuti":
                      return '<span class="badge badge-pill badge-danger">'+row.jenis+'</span>';
                      break;
                      case"Ubah Cuti":
                      return '<span class="badge badge-pill badge-info">'+row.jenis+'</span>';
                      break;
                      default:
                      return '<span class="badge badge-pill badge-secondary">-</span>';
                    }
                    
                  }
                },
                { data: 'tanggal_aksi', name: 'c_history_cuti.tanggal_aksi',
                  render: function(value, type, row, meta){
                   return tanggal_indoJS(row.tanggal_aksi);
                  }
                },
                { data: 'keterangan', name: 'c_history_cuti.keterangan'},
                { data: 'created_at', name: 'c_history_cuti.created_at'},
            ],
              createdRow: function ( row, data, index ) {
                //$('td', row).eq(0).attr("style","vertical-align: middle; text-align: center");
              },

        });
    });
  });
});


////////////////////////////////HISTORY///////////////////////////////////////////////
//CONVERT TANGGAL JS
function tanggal_indoJS(tanggal) {
  if (tanggal) {
    var bulan = new Array('-','Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    var split = tanggal.split('-');
    return split[2]+'-'+bulan[parseInt(split[1])]+'-'+split[0];
  } else {
    return '-';
  }
}

//loading
function Loading(){
  return '<div class="timeline-wrapper"><div class="timeline-item"><div class="animated-background"><div class="background-masker header-top"></div><div class="background-masker header-left"></div><div class="background-masker header-right"></div><div class="background-masker header-bottom"></div><div class="background-masker subheader-left"></div><div class="background-masker subheader-right"></div><div class="background-masker subheader-bottom"></div><div class="background-masker content-top"></div><div class="background-masker content-first-end"></div><div class="background-masker content-second-line"></div><div class="background-masker content-second-end"></div><div class="background-masker content-third-line"></div><div class="background-masker content-third-end"></div></div></div></div>';
}
    
//tutup jquery

});
  
</script>


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
function tanggal_indo($tanggal) {
      $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
      $split = explode('-', $tanggal);
      return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
  }
@endphp
@endsection
