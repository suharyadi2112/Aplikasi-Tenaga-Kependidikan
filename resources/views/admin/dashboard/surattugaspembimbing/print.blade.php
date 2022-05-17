<?php if(cek_akses('92') == 'yes'){
}else{ 
echo 'Anda Tidak Memiliki Akses';  
die;
} ?> 

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

<!DOCTYPE html>
<html>
<head>
</head>
<style type="text/css">
	p {
  margin: 0px;
}
</style>



@foreach($cekQuery as $fg => $valueAll)

<body onload="window.print()" style=" margin-left:43px; margin-right: 43px;">


@if(is_null($valueAll->id_udg) === true && is_null($valueAll->bentuk_mbkm))

<!----------------------------------------PERSETUJUAN SEMINAR-------------------------------------->


<img style="width: 35%; position: fixed; top: 0px;" src="{{ URL::asset('admin/dist/img/headerlogo.png') }}" />
<img style="width: 87%; position: fixed; bottom: 0px;" src="{{ URL::asset('admin/dist/img/footerlogo2.png') }}" />




<!----------------------------------------Surat Tugas Pembimbing------------------------------------->

<br>
<br>
<br>
<br>
<br>



<p style="line-height: 115%; margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><u><span style="font-size: 18.0pt; line-height: 115%; font-family: Arial, sans-serif;">SURAT TUGAS</span></u></p>

<p style="line-height: 115%; margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">No. </span><span style="font-family: Arial, sans-serif;">{{ $valueAll->no_surat }}</span></p>


<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">

@if($valueAll->jenis_surat == "Peralihan")
Dengan adanya peralihan tugas pembimbing 
@else
Dalam rangka 
@endif

@if($valueAll->jenis_surat == "Perpanjangan")
Perpanjangan
@endif
@if($valueAll->jenis_surat == "Peralihan")
@else
pembimbingan 
@endif
bagi mahasiswa Program Studi </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">{{$valueAll->nama_prodi}}</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;"> yang melaksanakan </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">{{$valueAll->nama_mk}}</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;"> di periode Semester {{$valueAll->semester}} T.A. {{$valueAll->tahun_ajar}}, maka dipandang perlu adanya penugasan dosen Pembimbing bagi mahasiswa bersangkutan.</span></p>
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">Oleh karena itu, kami menugaskan nama dosen berikut:</span></p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">
{{$valueAll->nama_karyawan}}</span></p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">NIDN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">
@if(empty($valueAll->nidn))
	-
@else
	{{$valueAll->nidn}}
@endif

</span></p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">Untuk melaksanakan tugas sebagai dosen </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">

Pembimbing
@if($valueAll->urutan_pembimbing == 0)
@elseif($valueAll->urutan_pembimbing == 1)
Pertama
@elseif($valueAll->urutan_pembimbing == 2)
Kedua
@elseif($valueAll->urutan_pembimbing == 3)
Ketiga
@endif

</span> <span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">{{$valueAll->nama_mk}} </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;"> di periode Semester {{$valueAll->semester}} T.A. {{$valueAll->tahun_ajar}}&nbsp; bagi mahasiswa:</span></p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">{{$valueAll->nama}}</span></p>
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">NIM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">{{$valueAll->nim}}</span></p>
<p style="margin: 0in 0in 0.0001pt 0.5in; text-align: justify; line-height: 150%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>

@if($valueAll->jenis_surat == "Peralihan")
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">Surat tugas ini berlaku sejak </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">tanggal</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;"> ditetapkan</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;"> hingga akhir</span> <span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">Semester {{$valueAll->semester}} T.A. {{ $valueAll->tahun_ajar }}</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">.</span></p>

@else
@endif

<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Demikian surat tugas ini dibuat untuk dilaksanakan dengan sebaik-baiknya.</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 3.15in; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Batam, 

@if($TglInput == 1)
{{tanggal_indo(date('Y-m-d',strtotime($valueAll->created_at)))}}
@elseif($tgl_diinginkan)
{{tanggal_indo($tgl_diinginkan)}}
@else
{{tanggal_indo(date('Y-m-d'))}}
@endif

</span></p>

<p style="margin: 0in 0in 0.0001pt 3.15in; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Wakil Rektor Akademik dan Kemahasiswaan</span></p>



<table width="100%" border="0">
	<tr>
		<td style="width: 250px;"></td>
		<td>
		@if($ttd == 1 && $cap_uvers == null)
			<img style="left: 0; text-align: left; margin-left: 50.85pt;width: 100px; height: 65.95pt; z-index: -251653120; visibility: visible;" src="{{ URL::asset('admin/dist/img/ttdpakaswandi.png') }}" />
		@elseif($cap_uvers == 1 && $ttd == 1)
			<img src="{{ URL::asset('admin/dist/img/fusion2.png') }}" style="width: 165px;margin-left: 2px;">
		@else
			<br><br><br><br>
		@endif
			<p style="margin-left: 45px; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Dr.techn. Aswandy, M.T.</span></p>
		</td>
	</tr>
</table>

</body>



<p style="page-break-before: always"></p>


{{-- SURAT TUGAS PEMBIMBING MBKM --}}




@elseif(!is_null($valueAll->bentuk_mbkm))


	
<body onload="window.print()" style=" margin-left:43px; margin-right: 43px;">

<img style="width: 35%; position: fixed; top: 0px;" src="{{ URL::asset('admin/dist/img/headerlogo.png') }}" />
<img style="width: 87%; position: fixed; bottom: 0px;" src="{{ URL::asset('admin/dist/img/footerlogo2.png') }}" />

<br>
<br>
<br>



<p style="line-height: 115%; margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><u><span style="font-size: 18.0pt; line-height: 115%; font-family: Arial, sans-serif;">SURAT TUGAS</span></u></p>

<p style="line-height: 115%; margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">No. </span><span style="font-family: Arial, sans-serif;">{{ $valueAll->no_surat }}</span></p>


<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">

@if($valueAll->jenis_surat == "Peralihan")
Dengan adanya peralihan tugas pembimbing 
@else
Dalam rangka 
@endif

@if($valueAll->jenis_surat == "Perpanjangan")
Perpanjangan
@endif
@if($valueAll->jenis_surat == "Peralihan")
@else
pembimbingan 
@endif
bagi mahasiswa Program Studi </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;font-weight:bold;">{{$valueAll->nama_prodi}}</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;"> yang melaksanakan </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">Program Merdeka Belajar Kampus Merdeka (MBKM) di luar Perguruan Tinggi di periode Semester {{$valueAll->semester}} T.A. {{$valueAll->tahun_ajar}}, maka dipandang perlu adanya penugasan dosen Pembimbing bagi mahasiswa bersangkutan.</span></p>
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">Oleh karena itu, kami menugaskan nama dosen berikut:</span></p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">Nama&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">
{{$valueAll->nama_karyawan}}</span></p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">NIDN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">
@if(empty($valueAll->nidn))
	-
@else
	{{$valueAll->nidn}}
@endif

</span></p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">Untuk melaksanakan tugas sebagai dosen </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">

<b>Pembimbing</b>
@if($valueAll->urutan_pembimbing == 0)
@elseif($valueAll->urutan_pembimbing == 1)
Pertama
@elseif($valueAll->urutan_pembimbing == 2)
Kedua
@elseif($valueAll->urutan_pembimbing == 3)
Ketiga
@endif

</span> <span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">MBKM </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;"> di periode Semester {{$valueAll->semester}} T.A. {{$valueAll->tahun_ajar}}&nbsp; bagi mahasiswa:</span></p> <br>

<table border="0" width="100%" style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal; text-align:justify;">
	<tr>
		<td width="23%" style="vertical-align:top;">Nama</td><td width="1%"style="vertical-align:top;">:</td><td style="font-weight:bold;">{{ $valueAll->nama }}</td>
	</tr>
	<tr>
		<td width="23%" style="vertical-align:top;">NIM</td><td width="1%"style="vertical-align:top;">:</td><td style="font-weight:bold;">{{ $valueAll->nim }}</td>
	</tr>
	<tr>
		<td width="23%" style="vertical-align:top;">Bentuk MBKM</td><td width="1%"style="vertical-align:top;">:</td><td style="font-weight:bold;">{{ $valueAll->bentuk_mbkm }}</td>
	</tr>
	<tr>
		<td width="23%" style="vertical-align:top;">Nama Kegiatan</td><td width="1%"style="vertical-align:top;">:</td><td style="font-weight:bold;">{{ $valueAll->nama_kegiatan_mbkm }}  

			@php
            $DataMatkulMKBM = DB::table('a_mata_kuliah_mbkm')->join('a_mata_kuliah','a_mata_kuliah.id_matakuliah','=','a_mata_kuliah_mbkm.id_mata_kuliah')->select('a_mata_kuliah.*','a_mata_kuliah_mbkm.*')->where('no_surat_tugas_pembimbing','=',$valueAll->no_surat)->get()
			@endphp

			@forelse($DataMatkulMKBM as $keyy => $valMatkul)
			<br> @if($keyy == 0)Mata Kuliah (pilih):<br>@endif
			{{ $valMatkul->kode }} - {{ $valMatkul->nama_matkul }} ({{ $valMatkul->sks }} sks) adalah {{ $valMatkul->detail_mata_kuliah }}
			@empty
			@endforelse

		</td>
	</tr>
	<tr>
		<td width="23%" style="vertical-align:top;">Jumlah sks Diakui</td><td width="1%"style="vertical-align:top;">:</td><td style="font-weight:bold;">{{ $valueAll->sks_diakui_mbkm }}</td>
	</tr>
</table>

<br>
@if($valueAll->jenis_surat == "Peralihan")
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">Surat tugas ini berlaku sejak </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">tanggal</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;"> ditetapkan</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;"> hingga akhir</span> <span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">Semester {{$valueAll->semester}} T.A. {{ $valueAll->tahun_ajar }}</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">.</span></p>

@else
@endif

<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Demikian surat tugas ini dibuat untuk dilaksanakan dengan sebaik-baiknya.</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 3.15in; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Batam, 

@if($TglInput == 1)
<b>{{tanggal_indo(date('Y-m-d',strtotime($valueAll->created_at)))}}</b>
@elseif($tgl_diinginkan)
<b>{{tanggal_indo($tgl_diinginkan)}}</b>
@else
<b>{{tanggal_indo(date('Y-m-d'))}}</b>
@endif

</span></p>

<p style="margin: 0in 0in 0.0001pt 3.15in; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Wakil Rektor Akademik dan Kemahasiswaan</span></p>



<table width="100%" border="0">
	<tr>
		<td style="width: 250px;"></td>
		<td>
		@if($ttd == 1 && $cap_uvers == null)
			<img style="left: 0; text-align: left; margin-left: 50.85pt;width: 100px; height: 65.95pt; z-index: -251653120; visibility: visible;" src="{{ URL::asset('admin/dist/img/ttdpakaswandi.png') }}" />
		@elseif($cap_uvers == 1 && $ttd == 1)
			<img src="{{ URL::asset('admin/dist/img/fusion2.png') }}" style="width: 165px;margin-left: 2px;">
		@else
			<br><br><br><br>
		@endif
			<p style="margin-left: 45px; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Dr.techn. Aswandy, M.T.</span></p>
		</td>
	</tr>
</table>

</body>


@else
<?php 
$date = strtotime($valueAll->tanggal_pelaksanaan);
$date = date('l', $date);
?>


<!-----------------------------------------Surat Tugas Penguji------------------------------------------>

<body onload="window.print()" style=" margin-left:43px; margin-right: 43px;">




<img style="width: 35%; position: fixed; top: 0px;" src="{{ URL::asset('admin/dist/img/headerlogo.png') }}" />
<img style="width: 87%; position: fixed; bottom: 0px;" src="{{ URL::asset('admin/dist/img/footerlogo2.png') }}" />



<br>
<br>
<br>
<br>
<br>

<p style="line-height: 115%; margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><u><span style="font-size: 18.0pt; line-height: 115%; font-family: Arial, sans-serif;">SURAT TUGAS</span></u></p>
<p style="line-height: 115%; margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">No. </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">{{$valueAll->no_surat}}</p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Sehubungan dengan pelaksanaan </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">{{$valueAll->nama_berkas}} </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">mahasiswa:</span></p>

<br>
<table style="border-collapse: collapse; width: 100%; height: 80px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 24.9221%; height: 21px; line-height: 150%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</span></td>
<td style="width: 1.98597%; height: 21px;">:</td>
<td style="width: 73.0919%; height: 21px;font-size: 11.0pt; font-family: Arial, sans-serif; line-height: 150%;">{{ $valueAll->nama }}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 24.9221%; height: 21px; line-height: 150%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</span></td>
<td style="width: 1.98597%; height: 21px;">:</td>
<td style="width: 73.0919%; height: 21px;font-size: 11.0pt; font-family: Arial, sans-serif; line-height: 150%;">{{ $valueAll->nim }}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 24.9221%; height: 21px; vertical-align: top; line-height: 150%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Judul</span></td>
<td style="width: 1.98597%; height: 21px; vertical-align: top;">:</td>
<td style="width: 73.0919%; height: 21px; font-family: Arial, sans-serif; line-height: 150%;"><?php echo $valueAll->judul ?></td>
</tr>
</tbody>
</table>

<br>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Maka kami </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">menugaskan </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Bapak/Ibu</span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;"> sebagai tim penguji p</span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">ada </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">{{$valueAll->nama_berkas}} mahasiswa bersangkutan</span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>


<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
@php
$cekdospenguji = DB::table('a_udg_dp')
                ->leftJoin('pegawai','pegawai.id_pegawai','=','a_udg_dp.id_dosen')
                ->select('a_udg_dp.id','a_udg_dp.kategori_dosen','pegawai.nama_karyawan','pegawai.nidn')
                ->where([['id_udg','=',$valueAll->id_udg],['kategori_dosen','=','Penguji']])
                ->orderBy('a_udg_dp.id','ASC')
                ->get();
@endphp
@forelse($cekdospenguji as $key => $value)
<tr>

<td style="width: 2.1028%;"></td>
<td style="width: 2.1028%;"></td>
<td style="width: 2.1028%;font-size: 12.0pt; font-family: Arial, sans-serif;"><b>{{$key + 1}}.</b></td>
<td style="width: 97.8972%;font-size: 12.0pt; font-family: Arial, sans-serif; line-height: 150%;"><b>&nbsp;&nbsp;{{$value->nama_karyawan}} / @if($value->nidn) {{ $value->nidn }} @else - @endif

	@if($cekPos == '1')

		@if($sebagai == '1')
		@if($key == 0)
			(Ketua)
		@elseif($key == 1)
			(Pembimbing)
		@else
			(Anggota)
		@endif

	@endif

	@else

		@if($sebagai == '1')
			{{ $cekPos[$key] }}
		@endif

	@endif


</b>
</td>
</tr>
@empty
<tr>
<td colspan="100">Tidak ada data</td>
</tr>
@endforelse
</tbody>
</table>


<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">yang akan</span> <span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">dilaksanakan </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">pada:</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>


<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 16.7445%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Hari/Tanggal</span></td>
<td style="width: 2.10275%;">:</td>
<td style="width: 81.1526%;font-size: 11.0pt; font-family: Arial, sans-serif;">{{ cek_hari($date) }}, {{tanggal_indo($valueAll->tanggal_pelaksanaan)}}</td>
</tr>
<tr>
<td style="width: 16.7445%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Pukul</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;&nbsp; </span></td>
<td style="width: 2.10275%;">:</td>

<td style="width: 81.1526%;font-size: 11.0pt; font-family: Arial, sans-serif;">
	@if($valueAll->jam_mulai == $valueAll->jam_selesai)
	{{cek_jam($valueAll->jam_mulai)}} WIB - Selesai
	@else
	{{cek_jam($valueAll->jam_mulai)}} - {{cek_jam($valueAll->jam_selesai)}} WIB
	@endif
</td>

</tr>
<tr>
<td style="width: 16.7445%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Ruangan</span></td>
<td style="width: 2.10275%;">:</td>
<td style="width: 81.1526%;font-size: 11.0pt; font-family: Arial, sans-serif;">{{$valueAll->nama_ruangan}}</td>
</tr>
</tbody>
</table>
<br>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Demikian surat tugas ini dibuat untuk dilaksanakan dengan sebaik-baiknya.</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>



<p style="margin: 0in 0in 0.0001pt 3.15in; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Batam, 

@if($TglInput == 1)
{{tanggal_indo(date('Y-m-d',strtotime($valueAll->created_at)))}}
@elseif($tgl_diinginkan)
{{tanggal_indo($tgl_diinginkan)}}
@else
{{tanggal_indo(date('Y-m-d'))}}
@endif
</span></p>

<p style="margin: 0in 0in 0.0001pt 3.15in; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Wakil Rektor Akademik dan Kemahasiswaan</span></p>

<table width="100%" border="0">
	<tr>
		<td style="width: 250px;"></td>
		<td>
		@if($ttd == 1 && $cap_uvers == null)
			<img style="left: 0; text-align: left; margin-left: 50.85pt;width: 100px; height: 65.95pt; z-index: -251653120; visibility: visible;" src="{{ URL::asset('admin/dist/img/ttdpakaswandi.png') }}" />
		@elseif($cap_uvers == 1 && $ttd == 1)
			<img src="{{ URL::asset('admin/dist/img/fusion2.png') }}" style="width: 165px;margin-left: 2px;">
		@else
			<br><br><br><br>
		@endif
			<p style="margin-left: 45px; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Dr.techn. Aswandy, M.T.</span></p>
		</td>
	</tr>
</table>

</body>

@endif


<p style="page-break-before: always"></p>
@endforeach



<?php 
function cek_jam($ert){
$test = $ert;
$t = date('H.i',strtotime($test));
return $t;
}

function cek_hari ($date) {

	switch ($date) {
	    case "Sunday":
	        $hari = 'Minggu';
	        break;
	    case "Monday":
	        $hari = 'Senin';
	        break;
	    case "Tuesday":
	        $hari = 'Selasa';
	        break;
	    case "Wednesday":
	        $hari = 'Rabu';
	        break;
	    case "Thursday":
	        $hari = 'Kamis';
	        break;
	    case "Friday":
	        $hari = 'Jumat';
	        break;
	    case "Saturday":
	        $hari = 'Sabtu';
	        break;
	    default:
	        $hari = 'Tidak Dalam Kondisi Apapun';
	}

	return $hari;
}

function tanggal_indo($tanggal) {
        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
    }
?>
</html>