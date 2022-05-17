<!DOCTYPE html>
<html>
<head>
</head>
@php
$date = strtotime($cek->tanggal_pelaksanaan);
$date = date('l', $date);
@endphp
<style type="text/css">
	p {
  margin: 0px;
}
</style>



<body onload="window.print()" style=" margin-left:43px; margin-right: 43px;">

<img style="width: 35%; position: fixed; top: 0px;" src="{{ URL::asset('admin/dist/img/headerlogo.png') }}" />
<img style="width: 87%; position: fixed; bottom: 0px;" src="{{ URL::asset('admin/dist/img/footerlogo2.png') }}" />





<!---------------------------------------LEMBAR PENILAIAN UJIAN TUGAS AKHIR ------------------------------------>

@foreach($dospen as $key => $cekdospen3)

<br>
<br>
<br>


<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> Lembar Penilaian Ujian Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<br>
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Pada hari ini, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{cek_hari($date)}}</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{tanggal_indo($cek->tanggal_pelaksanaan)}}</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> telah diselenggarakan Ujian Sidang Tugas Akhir mahasiswa:</span></p>


<br>

<table style="border-collapse: collapse; width: 100%; height: 63px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</td>
<td style="width: 1.16822%; height: 21px;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;font-size: 11.0pt;">{{$cek->nama}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</td>
<td style="width: 1.16822%; height: 21px;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;font-size: 11.0pt;">{{$cek->nim}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; vertical-align: top; font-size: 11.0pt; font-family: Arial, sans-serif;">Judul</td>
<td style="width: 1.16822%; height: 21px; vertical-align: top;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; vertical-align: top;">@php echo $cek->judul @endphp</td>
</tr>
</tbody>
</table>

<br>

<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Saya selaku penguji melakukan pengujian/penilaian terhadap Ujian Tugas Akhir tersebut memberikan &nbsp;dengan nilai sebagai berikut :</span></p>


<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
<div align="center">


<table class="MsoTableGrid" style="border-collapse: collapse; border: none; width: 100%;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="width: 33.35pt; border: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">No</span></p>
</td>
<td style="width: 314.7pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Komponen Penilaian</span></p>
</td>
<td style="width: 66.9pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Nilai Angka </span><em><span style="font-size: 6.0pt; font-family: Arial, sans-serif;">(0-100)</span></em></p>
</td>
<td style="width: 49.5pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Skor </span><span style="font-size: 10.0pt; font-family: Arial, sans-serif;"><br /></span><em><span style="font-size: 6.0pt; font-family: Arial, sans-serif;">(bobot&nbsp; X nilai)</span></em></p>
</td>
</tr>
<tr>
<td style="width: 33.35pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">1</span></p>
</td>
<td style="width: 314.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 66.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td style="width: 33.35pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">2</span></p>
</td>
<td style="width: 314.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 66.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td style="width: 33.35pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">3</span></p>
</td>
<td style="width: 314.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 66.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td style="width: 33.35pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">4</span></p>
</td>
<td style="width: 314.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 66.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td style="width: 33.35pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">5</span></p>
</td>
<td style="width: 314.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 66.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td style="width: 33.35pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 314.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Jumlah</span></strong></p>
</td>
<td style="width: 66.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
</tbody>
</table>



</div>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>


<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Demikian penilaian ini dilaksanakan.</span></p>

<br>


<table style="border-collapse: collapse; width: 100%; height: 106px;" border="0">
<tbody>
<tr style="height: 20px;">
<td style="width: 33.3333%; height: 20px;" rowspan="5">&nbsp;</td>
<td style="width: 23.5203%; height: 20px;" rowspan="5">&nbsp;</td>
<td style="width: 43.1463%; height: 20px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Batam, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">
{{tanggal_indo($cek->tanggal_pelaksanaan)}}</span></td>
</tr>
<tr style="height: 21px;">
<td style="width: 43.1463%; height: 21px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">

@if($key == 0)
Ketua
@else
@endif
Penguji



</span></td>
</tr>
<tr style="height: 45px;">
<td style="width: 43.1463%; height: 45px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></td>
</tr>
<tr style="height: 10px;">
<td style="width: 43.1463%; height: 10px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">{{$cekdospen3->nama_karyawan}}</span></td>
</tr>
<tr style="height: 10px;">
<td style="width: 43.1463%; height: 10px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">



</span></td>
</tr>
</tbody>
</table>

<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>


<p style="page-break-before: always"></p>


@endforeach
<!---------------------------------------LEMBAR PENELITIAN UJIAN TUGAS AKHIR ------------------------------------>




</body>
<!---------------------------------------BERITA ACARA UJIAN PROPOSAL TUGAS AKHIR -------------------------------------->
@php

function cek_jam($ert){
$test = $ert;
$t = date('H:i',strtotime($test));
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

@endphp
