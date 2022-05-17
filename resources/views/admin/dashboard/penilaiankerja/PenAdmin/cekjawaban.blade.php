
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
<div class="container-fluid "> 
    <div class="row">
      <div class="col-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Jawaban</h3>
              <input type="button" class="btn btn-success btn-sm btn-flat" style="float: right;" onclick="printDiv('printableArea')" value="print !" />
          </div>


        <div id="printableArea">   
          <div class="card-body">

              <!-- Font Awesome Icons -->
              <link rel="stylesheet" href="{{ URL::asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
              


              <h5 style="font-weight: bold;">Nama : {{ $nama_sendiri->name }}</h5>
              <hr>

              <table style="border-collapse: collapse; width: 100%" border="0" > 
              <tbody>
              <tr style="vertical-align: top;">
              <td style="width: 48.3499%;padding-right: 30px;">
                



              <!-----------------------------------------------------FORM A--------------------------------------------------->
              <table style="border-collapse: collapse; width: 100%;" border="0" cellspacing="0" cellpadding="0"><colgroup><col style="width: 52pt;" /> <col style="width: 29pt;" span="4" /> <col style="width: 5pt;" /> <col style="width: 29pt;" span="4" /></colgroup>
              <tbody>
              <tr style="height: 22.5pt;">
              <td style="width: 289pt; font-size: 12pt; font-family: AlleyOop; text-align: center; padding: 0px; color: black; font-weight: bold; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap; " colspan="10">Lembar Jawaban Penilaian Kinerja Kerja&nbsp;</td>
              </tr>
              <tr style="height: 15.75pt;">
              <td style="font-size: 12pt; font-family: AlleyOop; text-align: center; padding: 0px; color: black; font-weight: bold; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;" colspan="10">FORM A : ASPEK TEKNIS</td>
              </tr>
              <tr style="height: 6.75pt;">
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              </tr>

              <tr style="height: 16.0pt;">
              <td style="border-width: 1.5pt; border-style: solid; border-color: windowtext windowtext black; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;" rowspan="2">No. Soal</td>
              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: 1.5pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;" colspan="4">Diri Sendiri</td>
              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-width: 1.5pt 1.5pt 1pt; border-style: solid; border-color: windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">&nbsp;</td>
              <td style="border-right: 1.5pt solid black; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: 1.5pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;" colspan="4">Atasan</td>
              </tr>
              <tr style="height: 15.5pt;">
              <td style="border-top: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">A</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">B</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">C</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: none; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">D</td>
              <td style="border-top: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1.5pt solid windowtext; border-bottom: 1.5pt solid windowtext; border-left: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">&nbsp;</td>
              <td style="border-top: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">A</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">B</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">C</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1.5pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">D</td>
              </tr>



              @php 
              $noa = 1; 


              @endphp


              @foreach($CekJawaban as $key => $S_CekJawaban)
              @php
              $CekJawabanVerif = DB::table('b_verif_jawaban')
                ->select(
                        'b_verif_jawaban.id_jawaban_fk',
                        'b_verif_jawaban.verif_jawaban',
                        'b_verif_jawaban.id_user_verif'
                )
                ->where([['b_verif_jawaban.id_jawaban_fk','=',$S_CekJawaban->id_jawaban],['b_verif_jawaban.id_user_verif','=',$tujuan->id_user_tujuan]])
                //['b_verif_jawaban.id_user_verif','=',$id_user_tujuan]
                ->first();
              @endphp
              @if($S_CekJawaban->kategori_soal == 'a')


              <tr style="height: 15.5pt;">


              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 1.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 1.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">{{ $noa }}</td>


              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: none; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">
                
              @if($S_CekJawaban->jawaban == 'a')
              <span class="fa fa-check-square"></span>
              @endif

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if($S_CekJawaban->jawaban == 'b')
              <span class="fa fa-check-square"></span>
              @endif

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if($S_CekJawaban->jawaban == 'c')
              <span class="fa fa-check-square"></span>
              @endif

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if($S_CekJawaban->jawaban == 'd')
              <span class="fa fa-check-square"></span>
              @endif

              </td>




              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 1.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 1.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">&nbsp;</td>

              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: none; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">


              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'a')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif


              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

            
              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'b')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif
              

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'c')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif


              </td>


              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 1.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">


              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'd')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif

              </td>
              </tr>

              @php $noa++ @endphp
              @endif
              @endforeach


              </tbody>
              </table>

              </td>
              
              <td style="width: 48.4278%;">
                

              <!-----------------------------------------------------FORM B--------------------------------------------------->
              <table style="border-collapse: collapse; width: 100%" border="0" cellspacing="0" cellpadding="0"><colgroup><col style="width: 52pt;" /> <col style="width: 29pt;" span="4" /> <col style="width: 5pt;" /> <col style="width: 29pt;" span="4" /></colgroup>
              <tbody>
              <tr style="height: 22.5pt;">
              <td style="width: 289pt; font-size: 12pt; font-family: AlleyOop; text-align: center; padding: 0px; color: black; font-weight: bold; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;" colspan="10">Lembar Jawaban Penilaian Kinerja Kerja&nbsp;</td>
              </tr>
              <tr style="height: 15.75pt;">
              <td style="font-size: 12pt; font-family: AlleyOop; text-align: center; padding: 0px; color: black; font-weight: bold; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;" colspan="10">FORM B : ASPEK MANAJERIAL</td>
              </tr>
              <tr style="height: 6.75pt;">
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              </tr>

              <tr style="height: 16.0pt;">
              <td style="border-width: 1.5pt; border-style: solid; border-color: windowtext windowtext black; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;" rowspan="2">No. Soal</td>
              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: 1.5pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;" colspan="4">Diri Sendiri</td>
              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-width: 1.5pt 1.5pt 1pt; border-style: solid; border-color: windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">&nbsp;</td>
              <td style="border-right: 1.5pt solid black; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: 1.5pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;" colspan="4">Atasan</td>
              </tr>
              <tr style="height: 15.5pt;">
              <td style="border-top: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">A</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">B</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">C</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: none; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">D</td>
              <td style="border-top: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1.5pt solid windowtext; border-bottom: 1.5pt solid windowtext; border-left: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">&nbsp;</td>
              <td style="border-top: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">A</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">B</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">C</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1.5pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">D</td>
              </tr>



              @php $noa = 1; @endphp

              @foreach($CekJawaban as $key => $S_CekJawaban)
              @php
              $CekJawabanVerif = DB::table('b_verif_jawaban')
                ->select(
                        'b_verif_jawaban.id_jawaban_fk',
                        'b_verif_jawaban.verif_jawaban',
                        'b_verif_jawaban.id_user_verif'
                )
                ->where([['b_verif_jawaban.id_jawaban_fk','=',$S_CekJawaban->id_jawaban],['b_verif_jawaban.id_user_verif','=',$tujuan->id_user_tujuan]])
                //['b_verif_jawaban.id_user_verif','=',$id_user_tujuan]
                ->first();
              @endphp
              @if($S_CekJawaban->kategori_soal == 'b')


              <tr style="height: 15.5pt;" style="vertical-align: top;">


              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 1.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 1.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">{{ $noa }}</td>


              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: none; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">
                
              @if($S_CekJawaban->jawaban == 'a')
              <span class="fa fa-check-square"></span>
              @endif

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if($S_CekJawaban->jawaban == 'b')
              <span class="fa fa-check-square"></span>
              @endif

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if($S_CekJawaban->jawaban == 'c')
              <span class="fa fa-check-square"></span>
              @endif

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if($S_CekJawaban->jawaban == 'd')
              <span class="fa fa-check-square"></span>
              @endif

              </td>




              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 1.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 1.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">&nbsp;</td>

              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: none; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">


              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'a')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">


              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'b')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif
             

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">


              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'c')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif
         

              </td>


              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 1.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">


              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'd')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif


              </td>
              </tr>

              @php $noa++ @endphp
              @else
              
              @endif
              @endforeach


              </tbody>
              </table>

              </td>

              </tr>

              <tr style="vertical-align: top;">
              <td style="width: 48.3499%; padding-right: 30px;">
                

              <!-----------------------------------------------------FORM C--------------------------------------------------->
              <table style="border-collapse: collapse; width: 100%;" border="0" cellspacing="0" cellpadding="0"><colgroup><col style="width: 52pt;" /> <col style="width: 29pt;" span="4" /> <col style="width: 5pt;" /> <col style="width: 29pt;" span="4" /></colgroup>
              <tbody>
              <tr style="height: 22.5pt;">
              <td style="width: 289pt; font-size: 12pt; font-family: AlleyOop; text-align: center; padding: 0px; color: black; font-weight: bold; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;" colspan="10">Lembar Jawaban Penilaian Kinerja Kerja&nbsp;</td>
              </tr>
              <tr style="height: 15.75pt;">
              <td style="font-size: 12pt; font-family: AlleyOop; text-align: center; padding: 0px; color: black; font-weight: bold; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;" colspan="10">FORM C : ASPEK KEPERILAKUAN</td>
              </tr>
              <tr style="height: 6.75pt;">
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              </tr>

              <tr style="height: 16.0pt;">
              <td style="border-width: 1.5pt; border-style: solid; border-color: windowtext windowtext black; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;" rowspan="2">No. Soal</td>
              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: 1.5pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;" colspan="4">Diri Sendiri</td>
              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-width: 1.5pt 1.5pt 1pt; border-style: solid; border-color: windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">&nbsp;</td>
              <td style="border-right: 1.5pt solid black; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: 1.5pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;" colspan="4">Atasan</td>
              </tr>
              <tr style="height: 15.5pt;">
              <td style="border-top: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">A</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">B</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">C</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: none; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">D</td>
              <td style="border-top: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1.5pt solid windowtext; border-bottom: 1.5pt solid windowtext; border-left: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">&nbsp;</td>
              <td style="border-top: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">A</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">B</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">C</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1.5pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">D</td>
              </tr>



              @php $noa = 1; @endphp

              @foreach($CekJawaban as $key => $S_CekJawaban)

              @php
              $CekJawabanVerif = DB::table('b_verif_jawaban')
                ->select(
                        'b_verif_jawaban.id_jawaban_fk',
                        'b_verif_jawaban.verif_jawaban',
                        'b_verif_jawaban.id_user_verif'
                )
                ->where([['b_verif_jawaban.id_jawaban_fk','=',$S_CekJawaban->id_jawaban],['b_verif_jawaban.id_user_verif','=',$tujuan->id_user_tujuan]])
                //['b_verif_jawaban.id_user_verif','=',$id_user_tujuan]
                ->first();
              @endphp

              @if($S_CekJawaban->kategori_soal == 'c')


              <tr style="height: 15.5pt;">


              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 1.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 1.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">{{ $noa }}</td>


              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: none; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">
                
              @if($S_CekJawaban->jawaban == 'a')
              <span class="fa fa-check-square"></span>
              @endif

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if($S_CekJawaban->jawaban == 'b')
              <span class="fa fa-check-square"></span>
              @endif

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if($S_CekJawaban->jawaban == 'c')
              <span class="fa fa-check-square"></span>
              @endif

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if($S_CekJawaban->jawaban == 'd')
              <span class="fa fa-check-square"></span>
              @endif

              </td>




              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 1.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 1.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">&nbsp;</td>

              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: none; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">


              
              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'a')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif

             
              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">


              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'b')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">


              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'c')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif
              
              </td>


              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 1.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">


              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'd')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif

              </td>
              </tr>

              @php $noa++ @endphp
              @endif
              @endforeach

              </td>
              </tr>

              </tbody>
              </table>  

              </td>
              <td style="width: 48.4278%;">
                

              <!-----------------------------------------------------FORM D--------------------------------------------------->
              <table style="border-collapse: collapse; width: 100%;" border="0" cellspacing="0" cellpadding="0"><colgroup><col style="width: 52pt;" /> <col style="width: 29pt;" span="4" /> <col style="width: 5pt;" /> <col style="width: 29pt;" span="4" /></colgroup>
              <tbody>
              <tr style="height: 22.5pt;">
              <td style="width: 289pt; font-size: 12pt; font-family: AlleyOop; text-align: center; padding: 0px; color: black; font-weight: bold; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;" colspan="10">Lembar Jawaban Penilaian Kinerja Kerja&nbsp;</td>
              </tr>
              <tr style="height: 15.75pt;">
              <td style="font-size: 12pt; font-family: AlleyOop; text-align: center; padding: 0px; color: black; font-weight: bold; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;" colspan="10">FORM D : ASPEK HASIL KERJA</td>
              </tr>
              <tr style="height: 6.75pt;">
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              <td style="padding: 0px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
              </tr>

              <tr style="height: 16.0pt;">
              <td style="border-width: 1.5pt; border-style: solid; border-color: windowtext windowtext black; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;" rowspan="2">No. Soal</td>
              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: 1.5pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;" colspan="4">Diri Sendiri</td>
              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-width: 1.5pt 1.5pt 1pt; border-style: solid; border-color: windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">&nbsp;</td>
              <td style="border-right: 1.5pt solid black; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: 1.5pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;" colspan="4">Atasan</td>
              </tr>
              <tr style="height: 15.5pt;">
              <td style="border-top: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">A</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">B</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">C</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: none; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">D</td>
              <td style="border-top: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1.5pt solid windowtext; border-bottom: 1.5pt solid windowtext; border-left: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">&nbsp;</td>
              <td style="border-top: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; border-left: none; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">A</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">B</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">C</td>
              <td style="border-top: none; border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-right: 1.5pt solid windowtext; border-bottom: 1.5pt solid windowtext; background: #b8cce4; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">D</td>
              </tr>



              @php $noa = 1; @endphp

              @foreach($CekJawaban as $key => $S_CekJawaban)

              @php
              $CekJawabanVerif = DB::table('b_verif_jawaban')
                ->select(
                        'b_verif_jawaban.id_jawaban_fk',
                        'b_verif_jawaban.verif_jawaban',
                        'b_verif_jawaban.id_user_verif'
                )
                ->where([['b_verif_jawaban.id_jawaban_fk','=',$S_CekJawaban->id_jawaban],['b_verif_jawaban.id_user_verif','=',$tujuan->id_user_tujuan]])
                //['b_verif_jawaban.id_user_verif','=',$id_user_tujuan]
                ->first();
              @endphp

              @if($S_CekJawaban->kategori_soal == 'd')


              <tr style="height: 15.5pt;">


              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 1.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 1.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">{{ $noa }}</td>


              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: none; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if($S_CekJawaban->jawaban == 'a')
              <span class="fa fa-check-square"></span>
              @endif


              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if($S_CekJawaban->jawaban == 'b')
              <span class="fa fa-check-square"></span>
              @endif

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if($S_CekJawaban->jawaban == 'c')
              <span class="fa fa-check-square"></span>
              @endif

              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: none; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              @if($S_CekJawaban->jawaban == 'd')
              <span class="fa fa-check-square"></span>
              @endif

              </td>




              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 1.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: 1.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">&nbsp;</td>

              <td style="font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; border-left: none; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">

              
               @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'a')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif



              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">


              
              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'b')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif


              </td>

              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 0.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">


              
              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'c')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif

              </td>


              <td style="border-left: none; font-size: 12pt; font-weight: bold; font-family: 'Times New Roman', serif; text-align: center; vertical-align: middle; border-top: none; border-right: 1.5pt solid windowtext; border-bottom: 0.5pt solid windowtext; padding: 0px; color: black; font-style: normal; border-image: initial; white-space: nowrap;">


              
              @if(($CekJawabanVerif != null))
                @if($CekJawabanVerif->verif_jawaban == 'd')
                  <span class="fa fa-check-square"></span>
                @endif
              @endif


              </td>
              </tr>

              @php $noa++ @endphp
              @endif
              @endforeach

              </td>
              </tr>

              </tbody>
              </table>
              </td>

              </tbody>
              </table>

              </body>

          <!-- /.card-body -->
        </div>

        <!-- /.card -->
      </div>
    </div>
    <!-- /.col -->
  </div>
</div>
</div>


@endsection
@section('script')

<script type="text/javascript">
    function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>

@include('sweet::alert')
@endsection