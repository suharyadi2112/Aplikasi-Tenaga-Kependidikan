
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

        <h3 class="card-title">Formulir Rekap Penilaian Kerja</h3>
        <input type="button" class="btn btn-info btn-sm btn-flat" id="btn-print" style="float: right;" onclick="printDiv('printableArea')" value="print !" />


        <div id="printableArea"> 
          <div id="logo" style="display: none;">
                    
            <img style="width: 35%; position: fixed; top: 0px; display: block;" src="{{ URL::asset('admin/dist/img/headerlogo.png') }}"/>
            <img style="width: 80%; padding-left: 160px; position: fixed; bottom: 0px; " src="{{ URL::asset('admin/dist/img/footerlogo2.png') }}" />


            </div>
          
            <br><br><br>
          <div class="card-body">


            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">FORMULIR REKAP PENILAIAN KINERJA</span></strong></p>
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">TENAGA KEPENDIDIKAN YANG MENDUDUKI JABATAN STRUKTURAL</span></strong></p>
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">TAHUN AKADEMIK : 201</span></strong><strong><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">9</span></strong><strong><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">/20</span></strong><strong><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">20</span></strong></p>


            <table class="MsoNormalTable" style=" border-collapse: collapse; border: none; width: 100%;" border="1" cellspacing="0" cellpadding="0">


            <tbody>
            <tr>
            <td style="width: 50%; border: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">NAMA:</span></strong></p>

            <center>{{ $nama_lengkap }}</center>

            </td>
            <td style="width: 50%; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">JABATAN</span></strong><strong><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">:</span></strong></p>
            <center>{{ $Jabatan }}</center>
            </td>
       
            </tr>
            </tbody>
            </table>
            <p style="margin: 0cm 0cm 0cm 129pt; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">&nbsp;</span></strong></p>





            <table class="MsoNormalTable" style="border-collapse: collapse; border: none; height: 600px; width: 100%" border="1" cellspacing="0" cellpadding="0">




            <tbody>
            <tr>
            <td style="width: 99.25pt; border: solid windowtext 1.0pt; background: #66a3ff; padding: 0cm 5.4pt 0cm 5.4pt;" rowspan="2">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">KRITERIA</span></strong></p>
            </td>
            <td style="width: 318.95pt; border: solid windowtext 1.0pt; border-left: none; background: #66a3ff; padding: 0cm 5.4pt 0cm 5.4pt;" colspan="6">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">RERATA NILAI DARI:</span></strong></p>
            </td>
            <td style="width: 2.0cm; border: solid windowtext 1.0pt; border-left: none; background: #66a3ff; padding: 0cm 5.4pt 0cm 5.4pt;" rowspan="2">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">TOTAL </span></strong><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">1</span></strong><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">)</span></strong></p>
            </td>
            </tr>
            <tr>
            <td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #66a3ff; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">ATASAN</span></strong></p>
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">(a)</span></strong></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #66a3ff; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">BOBOT</span></strong></p>
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">(b)</span></strong></p>
            </td>
            <td style="width: 99.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #66a3ff; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">DKK</span></strong><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;"> /</span></strong><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">REKAN</span></strong></p>
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">(c)</span></strong></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #66a3ff; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">BOBOT</span></strong></p>
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">(d)</span></strong></p>
            </td>
            <td style="width: 42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #66a3ff; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">DIRI</span></strong></p>
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">(e)</span></strong></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #66a3ff; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">BOBOT</span></strong></p>
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">(f)</span></strong></p>
            </td>
            </tr>
            <tr>
            <td style="width: 99.25pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 7.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">FORM A</span></strong></p>
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 7.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">(Aspek Teknis)</span></strong></p>
            </td>
            <td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;"> 


            {{ $form_aV }}


            </span></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #F2F2F2; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">15</span><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">%</span></p>
            </td>
            <td style="width: 99.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #A6A6A6; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">&nbsp;</span></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #A6A6A6; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">&nbsp;</span></p>
            </td>
            <td style="width: 42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">


            {{$form_a}}

            </span></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #F2F2F2; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">5%</span></p>
            </td>
            <td style="width: 2.0cm; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;"> 


            {{ $total_akhirFormA }}


            </span></p>
            </td>
            </tr>
            <tr>
            <td style="width: 99.25pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 7.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">FORM B</span></strong></p>
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 7.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">(Aspek Manajerial)</span></strong></p>
            </td>
            <td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">



            {{ $h_form_bV }}



            </span></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #F2F2F2; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">30%</span></p>
            </td>
            <td style="width: 99.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #A6A6A6; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">&nbsp;</span></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #A6A6A6; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">&nbsp;</span></p>
            </td>
            <td style="width: 42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">


            {{ $h_form_b }}


            </span></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #F2F2F2; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">5%</span></p>
            </td>
            <td style="width: 2.0cm; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">
                  

            {{ $total_akhirFormB }}


            </span></p>
            </td>
            </tr>
            <tr>
            <td style="width: 99.25pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 7.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">FORM C</span></strong></p>
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 7.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">(Aspek Kedisiplinan)</span></strong></p>
            </td>
            <td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;"> 


            {{ $form_cV }}


            </span></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #F2F2F2; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">15</span><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">%</span></p>
            </td>
            <td style="width: 99.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #A6A6A6; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">&nbsp;</span></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #A6A6A6; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">&nbsp;</span></p>
            </td>
            <td style="width: 42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">
                  

            {{ $form_c }}


            </span></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #F2F2F2; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">5</span><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">%</span></p>
            </td>
            <td style="width: 2.0cm; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;"> 


            {{ $total_akhirFormC }}


            </span></p>
            </td>
            </tr>
            <tr>
            <td style="width: 99.25pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 7.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">FORM D</span></strong></p>
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 7.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">(Aspek Hasil Kerja)</span></strong></p>
            </td>
            <td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">


            {{ $form_dV }}


            </span></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #F2F2F2; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">20</span><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">%</span></p>
            </td>
            <td style="width: 99.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #A6A6A6; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">&nbsp;</span></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #A6A6A6; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">&nbsp;</span></p>
            </td>
            <td style="width: 42.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">


            {{ $form_d }}


            </span></p>
            </td>
            <td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; background: #F2F2F2; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">5%</span></p>
            </td>
            <td style="width: 2.0cm; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">


            {{ $total_akhirFormD  }}


            </span></p>
            </td>
            </tr>
            <tr>
            <td style="width: 99.25pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">RATING</span></strong></p>
            </td>
            <td style="width: 318.95pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" colspan="6">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">



            @php 

            if ($hasilrating > 3.5) {
                 echo "Sangat Baik";
            }else if($hasilrating >= 2.7 && $hasilrating <= 3.5){
                  echo "Baik";
            }else if($hasilrating >= 2.0 && $hasilrating <= 2.6){
                  echo "Cukup";
            }else if($hasilrating < 2.0){
                  echo "Kurang";
            }else{
                  echo "Terjadi Kesalahan";
            }
            
            @endphp



            </span></strong></p>
            </td>
            <td style="width: 2.0cm; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">



            {{ $hasilrating }}


            </span></strong></p>
            </td>
            </tr>
            <tr style="height: 43.15pt;">
            <td style="width: 99.25pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">Catatan<br />(Pesan/Motivasi)</span></strong></p>
            </td>
            <td style="width: 375.65pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" colspan="7">
            <p style="margin: 0cm; text-align: center; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 8.0pt; line-height: 150%; font-family: Arial, sans-serif; color: black;">
                  

            @foreach($pesan as $cekPesan)
                @if($cekPesan == null)
                
                @else
                {{ $cekPesan }}&nbsp;
                @endif
            @endforeach


            </span></strong></p>
            </td>
            </tr>
            </tbody>
            </table>

                 <br>
            <br>
            <br>
            <br>

            <p style="margin: 0cm; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="line-height: 150%; font-family: 'Times New Roman', serif;">Keterangan :</span></p>
            <ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
            <li style="line-height: 150%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%;">Sangat Baik, apabila mendapatkan nilai akhir penilaian kinerja &gt;3.5;</span></li>
            <li style="line-height: 150%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%;">Baik, apabila mendapatkan nilai akhir penilaian kinerja </span><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif;">&ge;</span><span style="font-size: 11.0pt; line-height: 150%;">2.7 &ndash; 3.5;</span></li>
            <li style="line-height: 150%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%;">Cukup, apabila mendapatkan nilai akhir penilaian kinerja </span><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif;">&ge;</span><span style="font-size: 11.0pt; line-height: 150%;">2.0 &ndash; 2.6;</span></li>
            <li style="line-height: 150%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%;">Kurang, apabila mendapatkan nilai akhir penilaian kinerja &le;2.0.</span></li>
            </ol>

            <br>

            <table style="border-collapse: collapse; width: 100%; height: 155px;" border="0">
            <tbody>
            <tr style="height: 21px;">
            <td style="width: 92.0607%; height: 21px; font-weight: bold; text-align: center;" colspan="5">Batam, 26 Oktober 2020 <br> <br></td>
            </tr>
            <tr style="height: 14px;">
            <td style="width: 18.3654%; height: 10px; line-height: 1; text-align: left;">
            <p style="margin: 0cm 0cm 10pt; line-height: 100%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="line-height: 115%; font-family: 'Times New Roman', serif;">Mengetahui, </span></p>
            <p style="margin: 0cm 0cm 10pt; line-height: 100%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="line-height: 100%; font-family: 'Times New Roman', serif;">Rektor&nbsp;</span></p>
            </td>
            <td style="width: 18.3654%; height: 10px; line-height: 1; text-align: left;">&nbsp;</td>
            <td style="width: 24.2844%; height: 10px; line-height: 1; text-align: left;">
            <p><span style="font-size: 11.0pt; line-height: 100%; font-family: 'Times New Roman', serif;">Direktur Bid. Kepegawaian </span></p>
            <p><span style="font-size: 11.0pt; line-height: 100%; font-family: 'Times New Roman', serif;">dan Kerjasama&nbsp;</span></p>
            </td>
            <td style="width: 12.6022%; height: 10px; line-height: 1; text-align: left;">&nbsp;</td>
            <td style="width: 18.4433%; height: 10px; line-height: 1; text-align: left; vertical-align: top;">
            <p style="margin: 0cm; line-height: 150%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="line-height: 150%; font-family: 'Times New Roman', serif;">Pegawai Yang Dinilai</span></p>
            </td>
            </tr>
            <tr style="height: 21px;">
            <td style="width: 18.3654%; height: 59px;"><img src="{{ URL::asset('admin/dist/img/ttd2.png') }}" style="width: 190px" /></td>
            <td style="width: 18.3654%; height: 59px;">&nbsp;</td>
            <td style="width: 24.2844%; height: 59px;"><img src="{{ URL::asset('admin/dist/img/ttd_irfan2.png') }}" style="width: 120px" /></td>
            <td style="width: 12.6022%; height: 59px;">&nbsp;</td>
            <td style="width: 18.4433%; height: 59px;">&nbsp;</td>
            </tr>
            <tr style="height: 21px;">
            <td style="width: 18.3654%; height: 65px;"><strong><u><span style="font-size: 11.0pt; line-height: 115%; font-family: 'Times New Roman', serif;">Dr.Kisdarjono</span></u></strong><span style="font-size: 11.0pt; line-height: 115%; font-family: 'Times New Roman', serif;"> </span></td>
            <td style="width: 18.3654%; height: 65px;">&nbsp;</td>
            <td style="width: 24.2844%; height: 65px;"><strong><u><span style="font-size: 11.0pt; line-height: 115%; font-family: 'Times New Roman', serif;">Irfan, S.Psi., M.M.</span></u></strong></td>
            <td style="width: 12.6022%; height: 65px;">&nbsp;</td>
            <td style="width: 24.2844%; height: 65px;"><strong><u><span style="font-size: 11.0pt; line-height: 115%; font-family: 'Times New Roman', serif;">{{ $nama_lengkap }}</span></u></strong></td>
            </tr>
            </tbody>
            </table>

          </div>
          <!-- /.card-body -->
        </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
</div>




@endsection
@section('script')

<script type="text/javascript">
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;
     document.getElementById("logo").removeAttribute("style"); 

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

@include('sweet::alert')
@endsection