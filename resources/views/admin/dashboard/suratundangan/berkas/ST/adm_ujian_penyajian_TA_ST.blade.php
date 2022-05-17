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

<!---------cek array untuk sub file ---------->
@php $cek_pilihan = $pilihan @endphp
<!---------cek array untuk sub file ---------->


<body onload="window.print()" style=" margin-left:43px; margin-right: 43px;">

<img style="width: 35%; position: fixed; top: 0px;" src="{{ URL::asset('admin/dist/img/headerlogo.png') }}" />
<img style="width: 87%; position: fixed; bottom: 0px;" src="{{ URL::asset('admin/dist/img/footerlogo2.png') }}" />

<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('a', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->


<br>
<br>
<br>

<!---------------------------------------BERITA ACARA UJIAN PROPOSAL TUGAS AKHIR -------------------------------------->
<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">Berita Acara Ujian Penyajian Karya Tugas Akhir<br>
Program Studi Seni Tari Semester {{$semester}} T.A. {{$tahun_ajar}}



</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Pelaksanaan Ujian Penyajian Karya Tugas Akhir dari mahasiswa:</span></p>
<br>

<table style="border-collapse: collapse; width: 100%; height: 63px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</td>
<td style="width: 1.16822%; height: 21px;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;font-size: 11.0pt;" >{{$cek->nama}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</td>
<td style="width: 1.16822%; height: 21px;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;font-size: 11.0pt;">{{$cek->nim}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; vertical-align: top; font-size: 11.0pt; font-family: Arial, sans-serif;">Judul</td>
<td style="width: 1.16822%; height: 21px; vertical-align: top;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; vertical-align: top; text-align: justify;" >@php echo $cek->judul @endphp</td>
</tr>
</tbody>
</table>
<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">telah diselenggarakan pada:</span></p>


<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 20.2492%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Hari/Tanggal</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 78.5825%;font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp; {{cek_hari($date)}}, {{tanggal_indo($cek->tanggal_pelaksanaan)}}</td>
</tr>
<tr>
<td style="width: 20.2492%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Pukul</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 78.5825%;font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;

	@if($cek->jam_mulai == $cek->jam_selesai)
		{{cek_jam($cek->jam_mulai)}} WIB s/d Selesai
	@else
		{{cek_jam($cek->jam_mulai)}} - {{cek_jam($cek->jam_selesai)}} WIB
	@endif

</td>
</tr>
<tr>
<td style="width: 20.2492%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Ruangan</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 78.5825%;font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp; {{$cek->nama_ruangan}}</td>
</tr>
<tr>
<td style="width: 20.2492%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Penilaian</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 78.5825%;">&nbsp;</td>
</tr>
</tbody>
</table>



<table class="MsoTableGrid" style=" border-collapse: collapse; border: none; margin-left: 0.5pt;" border="1" >
<tbody>
<tr>
<td style="width: 83.4pt; border: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Tim Penguji</span></p>
</td>
<td style="width: 205.5pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Nama</span></p>
</td>
<td style="width: 70.85pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Nilai Angka</span></p>
</td>
<td style="width: 120.85pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Tanda Tangan</span></p>
</td>
</tr>

@foreach($dospen as $key => $cekdospen)

<tr>
<td style="width: 83.4pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt; padding-top: 0.5rem; padding-bottom: 0.5rem">
<p style="line-height: 200%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">


	@if($key == 0)
	Ketua
	@elseif($key == 1)
	Penguji Ahli
	@else
	Anggota
	@endif
		


</span></p>
</td>
<td style="width: 205.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="line-height: 200%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif; white-space: nowrap;">{{$cekdospen->nama_karyawan}}</span></p>
</td>
<td style="width: 70.85pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="line-height: 200%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 120.85pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="line-height: 200%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>

@endforeach

<tr>
<td style="width: 288.9pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;" colspan="2">
<p style="text-align: right; line-height: 200%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="right"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">Rata-Rata Nilai</span></p>
</td>
<td style="width: 191.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;" colspan="2">
<p style="line-height: 200%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr>


</tr>
</tbody>
</table>

<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Catatan:</span></p>

<p style="line-height: 200%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">..........................................................................................................................................................</span></p>
<p style="line-height: 200%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">..........................................................................................................................................................</span></p>
<p style="line-height: 200%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">..........................................................................................................................................................</span></p>

<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Demikian berita acara ini dibuat dengan sesungguhnya untuk dipergunakan sebagaimana mestinya.</span></p>

<br>

<table style="border-collapse: collapse; width: 98.053%; height: 166px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 35.079%; height: 21px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Mengetahui</span></td>
<td style="width: 7.86813%; height: 21px;">&nbsp;</td>
<td style="width: 12.6602%; height: 21px;">&nbsp;</td>
<td style="width: 44.3925%; height: 21px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Batam, </span><span style="font-size: 11pt; font-family: Arial, sans-serif;">{{tanggal_indo($cek->tanggal_pelaksanaan)}}</span></td>
</tr>
<tr style="height: 21px;">
<td style="width: 35.079%; height: 21px; vertical-align: top;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Dekan Fakultas Seni</span></p>
</td>
<td style="width: 7.86813%; height: 21px;">&nbsp;</td>
<td style="width: 7%; height: 21px;">&nbsp;</td>
<td style="width: 44.3925%; height: 21px; vertical-align: top;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp; K</span><span style="font-size: 11pt; font-family: Arial, sans-serif;">oordinator</span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11pt; font-family: Arial, sans-serif;">Program</span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> Studi Seni Tari</span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> &nbsp;</span></p>
</td>
</tr>
<tr style="height: 50px;">
<td style="width: 35.079%; height: 40px;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 7.86813%; height: 20px;">&nbsp;</td>
<td style="width: 7%; height:20px;">&nbsp;</td>
<td style="width: 44.3925%; height:20px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></td>
</tr>
<tr style="height: 10px;">
<td style="width: 35.079%; height: 10px;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Widyanarto, S.Sn., M.Sn. </span></p>
</td>
<td style="width: 7.86813%; height: 10px;">&nbsp;</td>
<td style="width: 7%; height: 10px;">&nbsp;</td>
<td style="width: 44.3925%; height: 10px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Mega Lestari Silalahi, S.Sn., M.Sn. </span><span style="font-size: 11pt; font-family: Arial, sans-serif;"></span></td>
</tr>

<tr style="height: 21px;">
<td style="width: 35.079%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;"><sup><span style="font-size: 6pt; font-family: Arial, sans-serif;">*)</span></sup><span style="font-size: 6pt; font-family: Arial, sans-serif;"> coret yang tidak perlu</span> </span></p>
</td>
<td style="width: 7.86813%; height: 21px;">&nbsp;</td>
<td style="width: 7%; height: 21px;">&nbsp;</td>
<td style="width: 44.3925%; height: 21px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></td>
</tr>
</tbody>
</table>

<!---------------------------------------BERITA ACARA UJIAN PROPOSAL TUGAS AKHIR -------------------------------------->

 <p style="page-break-before: always"></p>

<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->








<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('b', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->


<!---------------------------------------LEMBAR PENILAITAN SEMINAR PROPOSAL ------------------------------------>

@foreach($dospen as $key => $cekdospen3)
<br>
<br>
<br>


<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">Lembar Penilaian Ujian Penyajian Karya Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Pada hari ini, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{cek_hari($date)}}</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">tanggal {{tanggal_indo($cek->tanggal_pelaksanaan)}}</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> diselenggarakan Ujian Penyajian Karya Tugas Akhir mahasiswa:</span></p>

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

<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Saya selaku penguji melakukan pengujian/penilaian terhadap penyajian karya tugas akhir tersebut dan memberikan nilai sebagai berikut :</span></p>


<table class="MsoTableGrid" style="width: 480.3pt; border-collapse: collapse; border: none; height: 290px;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 29.6pt;">
<td style="width: 316.938px; border: 1pt solid windowtext; padding: 0cm 5.4pt; height: 10px;">
<p style="margin: 0cm 0cm 0.0001pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Komponen Penilaian (Indikator/ Dimensi)</span></strong></p>
</td>
<td style="width: 87.6042px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 10px;">
<p style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Nilai Angka</span></strong></p>
<p style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">(0-100)</span></strong></p>
</td>
<td style="width: 186.938px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 10px;">
<p style="margin: 0cm 0cm 0.0001pt; text-align: center; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Keterangan/ Catatan</span></strong></p>
</td>
</tr>
<tr style="height: 10px;">
<td style="width: 622.938px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 10px;" colspan="3" valign="top">

<ol style="list-style-type: upper-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="line-height: 115%; margin: 0cm 0cm 0.0001pt 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan menyajikan koreografi (Bobot = 60%)</span></strong></li>
</ol>
</td>
</tr>
<tr style="height: 29.0pt;">
<td style="width: 316.938px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 20px;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;">
<li style="line-height: 115%; margin: 0cm 0cm 0.0001pt 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Bentuk pertunjukan, teknik tari, isi (penjiwaan) (Bobot = 40%)</span></li>
</ol>
</td>
<td style="width: 87.6042px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 20px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 186.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 20px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 22.9pt;">
<td style="width: 316.938px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 25px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt 16pt; text-align: right; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Skor A.1</span></strong></p>
<p style="margin: 0cm 0cm 0.0001pt 16pt; text-align: right; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">(bobot A.1 X nilai A.1)</span></em></p>
</td>
<td style="width: 290.271px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 25px;" colspan="2" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 12.4pt;">
<td style="width: 316.938px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 18px;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="2">
<li style="line-height: 115%; margin: 0cm 0cm 0.0001pt 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Musik tari (Bobot = 5%)</span></li>
</ol>
</td>
<td style="width: 87.6042px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 18px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 186.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 18px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 12.4pt;">
<td style="width: 316.938px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 44px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt 16pt; text-align: right; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Skor A.2</span></strong></p>
<p style="margin: 0cm 0cm 0.0001pt 16pt; text-align: right; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">(bobot A.2 X nilai A.2)</span></em></p>
</td>
<td style="width: 290.271px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 44px;" colspan="2" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 12.4pt;">
<td style="width: 316.938px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 18px;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="3">
<li style="line-height: 115%; margin: 0cm 0cm 0.0001pt 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Tata rupa pentas dan properti (Bobot = 5%)</span></li>
</ol>
</td>
<td style="width: 87.6042px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 18px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 186.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 18px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 12.4pt;">
<td style="width: 316.938px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 44px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt 16pt; text-align: right; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Skor A.3</span></strong></p>
<p style="margin: 0cm 0cm 0.0001pt 16pt; text-align: right; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">(bobot A.3 X nilai A.3)</span></em></p>
</td>
<td style="width: 290.271px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 44px;" colspan="2" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 12.4pt;">
<td style="width: 316.938px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 18px;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="4">
<li style="line-height: 115%; margin: 0cm 0cm 0.0001pt 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Rias dan busana (Bobot = 5%)</span></li>
</ol>
</td>
<td style="width: 87.6042px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 18px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 186.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 18px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 12.4pt;">
<td style="width: 316.938px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 12px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt 16pt; text-align: right; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Skor A.4</span></strong></p>
<p style="margin: 0cm 0cm 0.0001pt 16pt; text-align: right; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">(bobot A.4 X nilai A.4)</span></em></p>
</td>
<td style="width: 290.271px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 12px;" colspan="2" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 31.45pt;">
<td style="width: 316.938px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 10px;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="5">
<li style="line-height: 115%; margin: 0cm 0cm 0.0001pt 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Tata cahaya (Bobot = 5%)</span></li>
</ol>
</td>
<td style="width: 87.6042px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 10px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 186.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 10px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 24.55pt;">
<td style="width: 316.938px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 17px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt 16pt; text-align: right; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Skor A.5</span></strong></p>
<p style="margin: 0cm 0cm 0.0001pt 15.9pt; text-align: right; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">(bobot A.5 X nilai A.5)</span></em></p>
</td>
<td style="width: 290.271px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 17px;" colspan="2" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 27.7pt;">
<td style="width: 316.938px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 44px;">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Skor A </span></strong></p>
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">(skor A.1 + A.2 + A.3 +A.4 + A.5) =</span></strong></p>
</td>
<td style="width: 290.271px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 44px;" colspan="2" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
</tbody>
</table>

<br>
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Demikian penilaian ini dilaksanakan.</span></p>

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
Penguji
@elseif($key == 1)
Penguji Ahli
@else
Penguji
@endif


</span></td>
</tr>
<tr style="height: 50px;">
<td style="width: 43.1463%; height: 60px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></td>
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




<p style="page-break-before: always"></p>




@endforeach
<!---------------------------------------LEMBAR PENILAITAN SEMINAR PROPOSAL----------------------------------->

<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->









<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('c', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->


<!--------------------------------------DAFTAR HADIR SEMINAR PROPOSAL------------------------------------->
<?php for ($i=0; $i < 2; $i++) { ?> 



<br>
<br>
<br>

<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">Daftar Hadir Ujian Penyajian Karya Tugas Akhir
</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<br>

<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 21.0669%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;">{{$cek->nama}}</td>
</tr>
<tr>
<td style="width: 21.0669%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;">{{$cek->nim}}</td>
</tr>
<tr>
<td style="width: 21.0669%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Hari/Tanggal</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;">{{cek_hari($date)}}, {{tanggal_indo($cek->tanggal_pelaksanaan)}}</td>
</tr>
<tr>
<td style="width: 21.0669%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Pukul</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;">@if($cek->jam_mulai == $cek->jam_selesai){{cek_jam($cek->jam_mulai)}} WIB s/d Selesai
	@else
		{{cek_jam($cek->jam_mulai)}} - {{cek_jam($cek->jam_selesai)}} WIB
	@endif

</td>
</tr>
</tbody>
</table>

<br>

<table style=" border-collapse: collapse; border: none; width:100%;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 18.4pt;">
<td style="width: 182.6pt; border: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Nama Peserta Ujian</span></strong></p>
</td>
<td style="width: 120.5pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt;" valign="top">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</span></strong></p>
</td>
<td style="width: 170.1pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Tanda Tangan</span></strong></p>
</td>
</tr>
<tr style="height: 50.35pt;">
<td style="width: 182.6pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{$cek->nama}}</span></p>
</td>
<td style="width: 120.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{$cek->nim}}</span></p>
</td>
<td style="width: 170.1pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
</tbody>
</table>

<br>


<table  style="border-collapse: collapse; width: 100%; height: 174px;" border="0" cellspacing="0" cellpadding="0" >
<tbody>


<tr style="height: .25in;">
<td style="width: 611.604px; padding: 0in 5.4pt; height: 22px;" colspan="8" nowrap="nowrap">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-family: Arial, sans-serif;">T</span><span style="font-family: Arial, sans-serif;">im Penguji:</span></p>
</td>
</tr>



<tr style="height: 20.25pt;">
<td style="width: 31.6042px; border-width: 2.25pt 1pt 2.25pt 2.25pt; border-style: double solid double double; border-color: windowtext; border-image: initial; padding: 0in 5.4pt; height: 26px;" nowrap="nowrap">
<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">NO</span></strong></p>
</td>
<td style="width: 328.938px; border-top: 2.25pt double windowtext; border-left: none; border-bottom: 2.25pt double windowtext; border-right: 1pt solid black; padding: 0in 5.4pt; height: 26px;" colspan="5" nowrap="nowrap">
<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">NAMA DOSEN</span></strong></p>
</td>
<td style="width: 217.604px; border-top: 2.25pt double windowtext; border-left: none; border-bottom: 2.25pt double windowtext; border-right: 2.25pt double black; padding: 0in 5.4pt; height: 26px;" colspan="2" nowrap="nowrap">
<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">TANDA TANGAN</span></strong></p>
</td>
</tr>

@foreach($dospen as $keyet => $cekdospen4)

<tr style="height: 20.1pt;">

<td style="width: 31.6042px; border-top: none; border-left: 2.25pt double windowtext; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0in 5.4pt; height: 29px;" nowrap="nowrap">
<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{$keyet + 1}}</span></p>
</td>
<td style="width: 328.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid black; padding: 0in 5.4pt; height: 29px;" colspan="5" nowrap="nowrap">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{ $cekdospen4->nama_karyawan }}</span></p>
</td>


@if( $keyet%2 == 0 )
<td style="width: 100.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0in 5.4pt; height: 54px;" rowspan="2" nowrap="nowrap">
<p style="margin: 0in 0in 0.0001pt; font-size: 11.0pt; font-family: Arial, sans-serif; ">{{ $keyet + 1 }}.</p>
</td>
<td style="width: 100.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 2.25pt double windowtext; padding: 0in 5.4pt; height: 54px;" rowspan="2" nowrap="nowrap">
<p style="margin: 0in 0in 0.0001pt; font-size: 11.0pt; font-family: Arial, sans-serif; ">{{ $keyet + 2}}.</p>
</td>
@endif

</tr>
@endforeach

@if( $keyet%2 == 0 )
<tr style="height: 20.1pt;">
<td style="width: 31.6042px; border-top: none; border-left: 2.25pt double windowtext; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0in 5.4pt; height: 25px;" nowrap="nowrap">&nbsp;</td>
<td style="width: 328.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid black; padding: 0in 5.4pt; height: 25px;" colspan="5" nowrap="nowrap">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">-</span></p>
</td>
</tr>
@endif

<tr style="height: 10.5pt;">
<td style="width: 611.604px; padding: 0in 5.4pt; height: 22px;" colspan="8" nowrap="nowrap">&nbsp;</td>
</tr>


</tbody>
</table>


<br>
<br>
<br>
<br>

<p style="margin: 0in 0in 0.0001pt 273.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Dekan Fakultas Seni</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 273.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Widyanarto, S.Sn., M.Sn.</span></p>



<br><br><br><br><br><br>


<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">Catatan:</span></em></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">Lembar asli dikembalikan ke DAK beserta dengan fotokopi Berita Acara Ujian </span></em></p>









<!-------------------------------------DAFTAR HADIR SEMINAR PROPOSAL---------------------------------------->


@if($i == 0)
<p style="page-break-before: always"></p>
@endif

<?php } ?>


<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->

</body>
@php

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

@endphp

</html>