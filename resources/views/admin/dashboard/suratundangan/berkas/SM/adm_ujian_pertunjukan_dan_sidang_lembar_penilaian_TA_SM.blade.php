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
@media print{@page {size: landscape}}
</style>

<img style="width: 15%; position: fixed; top: 0px;" src="{{ URL::asset('admin/dist/img/headerlogo.png') }}" />
<img style="width: 57%; position: fixed;padding-left: 18%;  bottom: 0px;" src="{{ URL::asset('admin/dist/img/footerlogo2.png') }}" />
<body onload="window.print()" style="margin-top: 25px; margin-left:35px; margin-right: 35px;" >

@foreach($dospen as $key => $cekdospen)
<!---------------------------------------BERITA ACARA UJIAN PROPOSAL TUGAS AKHIR -------------------------------------->
<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">Lembar Penilaian Ujian Tugas Akhir</span></p>

<br>
<p><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif; margin-left: 20px;">Pada hari ini, <b>{{cek_hari($date)}}, tanggal {{tanggal_indo($cek->tanggal_pelaksanaan)}}</b> telah diselenggarakan Ujian Pertunjukan dan Ujian Sidang Tugas Akhir mahasiswa:</span></p>


<table style="border-collapse: collapse; width: 100%; height: 63px; margin-left: 20px; margin-right: 30px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 5.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</td>
<td style="width: 1.16822%; height: 21px;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;font-size: 11.0pt;" >{{$cek->nama}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 5.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</td>
<td style="width: 1.16822%; height: 21px;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;font-size: 11.0pt;">{{$cek->nim}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 5.9019%; height: 21px; vertical-align: top; font-size: 11.0pt; font-family: Arial, sans-serif;">Judul</td>
<td style="width: 1.16822%; height: 21px; vertical-align: top;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; vertical-align: top; text-align: justify;" >@php echo $cek->judul @endphp</td>
</tr>
</tbody>
</table>

<p style="padding-top: 5px; padding-bottom: 5px;"><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif; margin-left: 30px;">Saya selaku penguji melakukan pengujian/penilaian terhadap tugas akhir tersebut dan memberikan nilai sebagai berikut :</span></p>


<table  style="width: 100%, border-collapse: collapse; border: none;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="width: 366.9pt; border: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" colspan="4" valign="top">
<ol style="list-style-type: upper-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="text-align: justify; margin: 0cm 0cm 0.0001pt 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Ujian Pertunjukan </span></strong></li>
</ol>
</td>
<td style="width: 361.45pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;" colspan="4" valign="top">
<ol style="list-style-type: upper-alpha; margin-bottom: 0cm; margin-top: 0px;" start="2">
<li style="text-align: justify; margin: 0cm 0cm 0.0001pt 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Ujian Sidang</span></strong></li>
</ol>
</td>
</tr>
<tr>
<td style="width: 26.7pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">No</span></p>
</td>
<td style="width: 248.05pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Komponen Penilaian</span></p>
</td>
<td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Nilai Angka </span><em><span style="font-size: 6.0pt; font-family: Arial, sans-serif;">(0-100)</span></em></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Skor <br /></span><em><span style="font-size: 6.0pt; font-family: Arial, sans-serif;">(bobot&nbsp; X nilai)</span></em></p>
</td>
<td style="width: 27.05pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">No</span></p>
</td>
<td style="width: 242.25pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Komponen Penilaian</span></p>
</td>
<td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Nilai Angka </span><em><span style="font-size: 6.0pt; font-family: Arial, sans-serif;">(0-100)</span></em></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Skor <br /></span><em><span style="font-size: 6.0pt; font-family: Arial, sans-serif;">(bobot&nbsp; X nilai)</span></em></p>
</td>
</tr>
<tr>
<td style="width: 26.7pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">1</span></p>
</td>
<td style="width: 248.05pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 27.05pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">1</span></p>
</td>
<td style="width: 242.25pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td style="width: 26.7pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">2</span></p>
</td>
<td style="width: 248.05pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 27.05pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">2</span></p>
</td>
<td style="width: 242.25pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td style="width: 26.7pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">3</span></p>
</td>
<td style="width: 248.05pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 27.05pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">3</span></p>
</td>
<td style="width: 242.25pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td style="width: 26.7pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">4</span></p>
</td>
<td style="width: 248.05pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 27.05pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">4</span></p>
</td>
<td style="width: 242.25pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td style="width: 26.7pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">5</span></p>
</td>
<td style="width: 248.05pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 27.05pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">5</span></p>
</td>
<td style="width: 242.25pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">(bobot = ... %)</span></p>
</td>
<td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr>
<td style="width: 317.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;" colspan="3">
<p style="text-align: right; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Total Skor Ujian Pertunjukan</span></strong></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 27.05pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 242.25pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: right; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Total Skor Ujian Sidang</span></strong></p>
</td>
<td style="width: 42.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 49.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
</tbody>
</table>

<p><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif;">Demikian penilaian ini dilaksanakan.</span></p>



<p style="margin: 0cm 0cm 0.0001pt 16cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Batam, </span><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">{{tanggal_indo($cek->tanggal_pelaksanaan)}}</span></p>
<p style="margin: 0cm 0cm 0.0001pt 16cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">

@if($key == 0)
Ketua Penguji
@elseif($key == 1)
Penguji Ahli
@else
Penguji
@endif

</span></p>
<p style="margin: 0cm 0cm 0.0001pt 16cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0cm 0cm 0.0001pt 16cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0cm 0cm 0.0001pt 16cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">

{{$cekdospen->nama_karyawan}}
</span></p>

<p style="page-break-before: always"></p>
<br>
<br>

@endforeach


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
