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
<body onload="window.print()" style="margin-top: 80px; margin-left:40px; margin-right: 40px;">

<!----------------------------------------PERSETUJUAN UJIAN  TUGAS AKHIR-------------------------------------->

<p style="line-height: 115%; margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><u><span style="font-size: 14.0pt; line-height: 115%; font-family: Arial, sans-serif;">Persetujuan</span></u><u><span style="font-size: 14.0pt; line-height: 115%; font-family: Arial, sans-serif;"> Ujian Tugas Akhir</span></u><u><span style="font-size: 14.0pt; line-height: 115%; font-family: Arial, sans-serif;"> </span></u></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>

<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Dosen </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Pembimbing</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"> y</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">ang bertanda</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"> </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">tangan di bawah ini</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"> dengan persetujuan Koordinator Program Studi Manajemen, m</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">enyetujui pelaksanaan </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Ujian Tugas Akhir </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">dari Mahasiswa:</span></p>


<br>
<table style="border-collapse: collapse; width: 100%; height: 168px; font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;">Nama</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 79.1666%; height: 21px;"><b>{{ $cek->nama }}</b></td>
</tr>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;">NIM</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 79.1666%; height: 21px;"><b>{{ $cek->nim }}</b></td>
</tr>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;">&nbsp;</td>
<td style="width: 1.16822%; height: 21px;"></td>
<td style="width: 79.1666%; height: 21px;">&nbsp;</td>
</tr>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;" colspan="10">yang akan diselenggarakan pada</td>
</tr>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;">&nbsp;</td>
<td style="width: 1.16822%; height: 21px;">&nbsp;</td>
<td style="width: 79.1666%; height: 21px;">&nbsp;</td>
</tr>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;">Hari</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 79.1666%; height: 21px;"><b>{{cek_hari($date)}}</b></td>
</tr>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;">Tanggal</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 79.1666%; height: 21px;"><b>{{tanggal_indo($cek->tanggal_pelaksanaan)}}</b></td>
</tr>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;">Jam</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 79.1666%; height: 21px;"><b>

	@if($cek->jam_mulai == $cek->jam_selesai)
		{{cek_jam($cek->jam_mulai)}} WIB s/d Selesai
	@else
		{{cek_jam($cek->jam_mulai)}} WIB - {{cek_jam($cek->jam_selesai)}} WIB
	@endif
	

</b>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;">Tempat/Ruangan</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 79.1666%; height: 21px;"><b>{{$cek->nama_ruangan}}</b></td>
</tr>
</tbody>
</table>
<br>
<br>
<table style="border-collapse: collapse; width: 100%; height: 101px; font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;" border="1">
<tbody>
<tr style="height: 11px;">
<td style="width: 33.3333%; height: 11px; text-align: center;"><b>Nama Pembimbing</b></td>
<td style="width: 33.3333%; height: 11px; text-align: center;"><b>Tanda Tangan</b></td>
<td style="width: 33.3333%; height: 11px; text-align: center;"><b>Tanggal Persetujuan</b></td>
</tr>
@forelse($dospem as $cekpem)
<tr style="height: 60px;">
<td style="width: 33.3333%; height: 20px;"  nowrap="">&nbsp;{{$cekpem->nama_karyawan}}</td>
<td style="width: 33.3333%; height: 20px;"></td>
<td style="width: 33.3333%; height: 20px;"></td>
</tr>
@empty
<tr>
	<td colspan="10">Tidak Ada Data</td>
</tr>
@endforelse

</tbody>
</table>

<br>
<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Atas perhatian dan kerja samanya disampaikan terima kasih.</span></p>
<br>

<br>
<table style="border-collapse: collapse; width: 100%; height: 147px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Batam, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">____________________</span></td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Menyetujui, </span></td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp; K</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">oordinator</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Program</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> Studi</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Manajemen</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp; Ibnu Harris, S.Kom., M.M. </span></p>
</td>
</tr>
</tbody>
</table>

<!----------------------------------------PERSETUJUAN UJIAN TUGAS AKHIR-------------------------------------->
 
 <p style="page-break-before: always"></p>

<!---------------------------------------BERITA ACARA UJIAN TUGAS AKHIR -------------------------------------->


<br>
<br>
<br>

<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">Berita Acara</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> Ujian Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Pelaksanaan Ujian Tugas Akhir dari mahasiswa:</span></p>


<table style="border-collapse: collapse; width: 100%; height: 63px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 9.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;"><b>{{$cek->nama}}</b></td>
</tr>
<tr style="height: 21px;">
<td style="width: 9.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;"><b>{{$cek->nim}}</b></td>
</tr>
<tr style="height: 21px;">
<td style="width: 9.9019%; height: 21px; vertical-align: top; font-size: 11.0pt; font-family: Arial, sans-serif;">Judul</td>
<td style="width: 1.16822%; height: 21px; vertical-align: top;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; vertical-align: top; font-size: 11.0pt; font-family: Arial, sans-serif;"><b>@php echo $cek->judul @endphp</b></td>
</tr>
</tbody>
</table>

<br>
<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">telah diselenggarakan pada:.</span></p>


<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 20.2492%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Hari/Tanggal</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 78.5825%;font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp; <b>{{cek_hari($date)}}, {{tanggal_indo($cek->tanggal_pelaksanaan)}}</b></td>
</tr>
<tr>
<td style="width: 20.2492%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Pukul</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 78.5825%;font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;<b>

	@if($cek->jam_mulai == $cek->jam_selesai)
		{{cek_jam($cek->jam_mulai)}} WIB s/d Selesai
	@else
		{{cek_jam($cek->jam_mulai)}} WIB - {{cek_jam($cek->jam_selesai)}} WIB
	@endif
</b>
</td>
</tr>
<tr>
<td style="width: 20.2492%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Ruangan</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 78.5825%;font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp; <b>{{$cek->nama_ruangan}}</b></td>
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
<td style="width: 83.4pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">
	
@if($key == 0)
	Ketua
@else
	Anggota
	@forelse($dospem as $k423 => $cekdospem123)
		@if($cekdospen->nama_karyawan == $cekdospem123->nama_karyawan)
		(Pembimbing)
		@endif
	@empty
	Anggota
	@endforelse
	
@endif

</span></p>
</td>


<td style="width: 205.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="font-size: 11.0pt; line-height: 0%; font-family: Arial, sans-serif;"><span style="font-size: 11.0pt; line-height: 0%; font-family: Arial, sans-serif;">{{$cekdospen->nama_karyawan}}</span></p>
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
<td style="width: 288.9pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;" colspan="2">
<p style="text-align: right; line-height: 200%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="right"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">Nilai Huruf</span></p>
</td>
<td style="width: 191.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;" colspan="2">
<p style="line-height: 200%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>

</tr>
</tbody>
</table>

<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Mahasiswa bersangkutan dinyatakan <b>(DAPAT / TIDAK DAPAT*) Ujian Tugas Akhir</b> dengan catatan :</span></p>

<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">_____________________________________________________________________________</span></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">_____________________________________________________________________________</span></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong><br></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">_____________________________________________________________________________</span></p>



<p style="padding-top: 0px;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Demikian berita acara ini dibuat dengan sesungguhnya untuk dipergunakan sebagaimana mestinya.</span></p>


<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt -7.1pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Arial, sans-serif;">Keterangan :&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Batam, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{tanggal_indo($cek->tanggal_pelaksanaan)}}</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; text-indent: 18.1pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Mengetahui,</span></p>
<table class="MsoTableGrid" style="border-collapse: collapse; border: none; margin-left: 7.5pt; margin-right: 7.5pt;" border="1" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="width: 40.85pt; border: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">Nilai</span></strong></p>
</td>
<td style="width: 50.8pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">Rentang</span></strong></p>
</td>
</tr>
<tr style="height: 9.0pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">A</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">81 - 100</span></p>
</td>
</tr>
<tr style="height: 6.35pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">AB</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">76 - 80</span></p>
</td>
</tr>
<tr style="height: 4.85pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">B</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">71 - 75</span></p>
</td>
</tr>
<tr style="height: 11.5pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">BC</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">61 - 70</span></p>
</td>
</tr>
<tr style="height: 12.0pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">C</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">56 - 60</span></p>
</td>
</tr>
<tr style="height: 12.75pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">D</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">46 - 55</span></p>
</td>
</tr>
<tr style="height: 9.5pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">E</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">0 - 45</span></p>
</td>
</tr>
</tbody>
</table>
<p style="margin: 0in 0in 0.0001pt 233.9pt; text-indent: 18.1pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Koordinator Program Studi Manajemen</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> </span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; text-indent: 18.1pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Ibnu Harris, S.Kom., M.M.</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">.</span></p>

<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><sup><span style="font-size: 6.0pt; font-family: Arial, sans-serif;">&nbsp;</span></sup></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><sup><span style="font-size: 6.0pt; font-family: Arial, sans-serif;">&nbsp;</span></sup></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><sup><span style="font-size: 6.0pt; font-family: Arial, sans-serif;">*)</span></sup><span style="font-size: 6.0pt; font-family: Arial, sans-serif;"> coret yang tidak perlu</span><span style="font-size: 6.0pt; font-family: Arial, sans-serif;"><br style="page-break-before: always;" clear="all" /></span></p>

<!---------------------------------------BERITA ACARA UJIAN TUGAS AKHIR -------------------------------------->

 <p style="page-break-before: always"></p>











<!---------------------------------------SARAN PERBAIKAN UJIAN TUGAS AKHIR -------------------------------------->

@foreach($dospen as $key => $cekdospen2)


<br>
<br>
<br>
<br>


<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> Saran Perbaikan Ujian Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<br>
<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Berdasarkan Ujian Tugas Akhir yang telah dilakukan oleh mahasiswa:</span></p>


<br>

<table style="border-collapse: collapse; width: 100%; height: 63px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;"><b>{{$cek->nama}}</b></td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;"><b>{{$cek->nim}}</b></td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; vertical-align: top; font-size: 11.0pt; font-family: Arial, sans-serif;">Judul</td>
<td style="width: 1.16822%; height: 21px; vertical-align: top;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; vertical-align: top; text-align: left;"><b>@php echo $cek->judul @endphp</b></td>
</tr>
</tbody>
</table>

<br>

<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Maka dapat kami sampaikan saran-saran sebagai berikut:</span></p>

<br>

<table style="border-collapse: collapse; width: 97.1963%; height: 300px;" border="1">
<tbody>
<tr style="height: 0px;">
<td style="width: 100%; height: 0px;">&nbsp;</td>
</tr>
</tbody>
</table>

<br>


<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Demikian untuk menjadi bahan periksa. Atas perhatiannya kami sampaikan terima kasih.</span></p>


<br>


<table style="border-collapse: collapse; width: 98.053%; height: 161px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 6.65261%; height: 21px;">&nbsp;</td>
<td style="width: 47.7215%; height: 21px;">&nbsp;</td>
<td style="width: 45.6259%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">Batam, </span><span style="font-size: 11pt; font-family: Arial, sans-serif;">{{tanggal_indo($cek->tanggal_pelaksanaan)}}</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 6.65261%; height: 21px;">&nbsp;</td>
<td style="width: 47.7215%; height: 21px;">&nbsp;</td>
<td style="width: 45.6259%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">Penguji</span><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">


	@if($key == 0)
	(Ketua)
	@else
	(Anggota)
	@endif

</span></p>
</td>
</tr>
<tr style="height: 66px;">
<td style="width: 6.65261%; height: 30px;">&nbsp;</td>
<td style="width: 47.7215%; height: 30px;">&nbsp;</td>
<td style="width: 45.6259%; height: 30px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 6.65261%; height: 21px;">&nbsp;</td>
<td style="width: 47.7215%; height: 21px;">&nbsp;</td>
<td style="width: 45.6259%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;"><span style="font-size: 11pt; font-family: Arial, sans-serif;"><b>

	{{ $cekdospen2->nama_karyawan }}
</b>
</span> </span></p>
</td>
</tr>
<tr style="height: 2px;">
<td style="width: 100%; height: 0px;" colspan="3">
<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Saran perbaikan telah dimasukkan ke dalam revisi TA</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 6.65261%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
</td>
<td style="height: 21px; width: 47.7215%;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">Pembimbing</span></p>
</td>
<td style="width: 45.6259%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">Penguji</span><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;"> 

	@if($key == 0)
	(Ketua)
	@else
	(Anggota)
	@endif

</span></p>
</td>
</tr>
<tr style="height: 63px;">
<td style="width: 6.65261%; height: 36px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
</td>
<td style="width: 47.7215%; height: 36px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
</td>
<td style="width: 45.6259%; height: 36px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 6.65261%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 47.7215%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><u><span style="font-size: 11pt; font-family: Arial, sans-serif;">
	
@foreach($dospem as $key => $cekdospem2)
@if($key == 0)
{{$cekdospem2->nama_karyawan}}
@else
@endif
@endforeach

</span></u></p>
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Tanggal:</span></p>
</td>
<td style="width: 45.6259%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><u><span style="font-size: 11pt; font-family: Arial, sans-serif;">

{{ $cekdospen2->nama_karyawan }}

</span></u><u><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;"> </span></u></p>
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Tanggal:</span></p>
</td>
</tr>
</tbody>
</table>


<p style="page-break-before: always"></p>

@endforeach

<!---------------------------------------SARAN PERBAIKAN UJIAN TUGAS AKHIR -------------------------------------->























<!---------------------------------------LEMBAR PENILAIAN UJIAN TUGAS AKHIR ------------------------------------>

@foreach($dospen as $key => $cekdospen3)

<br>
<br>
<br>
<br>


<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> Lembar Penilaian Ujian Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<br>
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Pada hari ini, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{cek_hari($date)}}</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{tanggal_indo($cek->tanggal_pelaksanaan)}}</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> telah diselenggarakan Ujian Tugas Akhir mahasiswa:</span></p>


<br>

<table style="border-collapse: collapse; width: 100%; height: 63px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;"><b>{{$cek->nama}}</b></td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;"><b>{{$cek->nim}}</b></td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; vertical-align: top; font-size: 11.0pt; font-family: Arial, sans-serif;">Judul</td>
<td style="width: 1.16822%; height: 21px; vertical-align: top;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; vertical-align: top;"><b>@php echo $cek->judul @endphp</b></td>
</tr>
</tbody>
</table>

<br>

<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Saya selaku penguji melakukan pengujian/penilaian terhadap Ujian Tugas Akhir tersebut memberikan &nbsp;dengan nilai sebagai berikut :</span></p>


<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
<div align="center">
<table class="MsoNormalTable" style="border-collapse: collapse; border: none;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 26.45pt;">
<td style="width: .4in; border: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NO</span></strong></p>
</td>
<td style="width: 1.85in; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">MATERI</span></strong></p>
</td>
<td style="width: 1.75in; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">PERSENTASE (%)</span></strong></p>
</td>
<td style="width: 1.0in; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NILAI</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: .4in; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">1</span></p>
</td>
<td style="width: 1.85in; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Isi materi</span></p>
</td>
<td style="width: 1.75in; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif; ">50</span></strong></p>
</td>
<td style="width: 1.0in; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 26.05pt;">
<td style="width: .4in; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">2</span></p>
</td>
<td style="width: 1.85in; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Penyampaian</span></p>
</td>
<td style="width: 1.75in; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt;  text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">20</span></strong></p>
</td>
<td style="width: 1.0in; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: .4in; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">3</span></p>
</td>
<td style="width: 1.85in; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Penguasaan</span></p>
</td>
<td style="width: 1.75in; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif; ">30</span></strong></p>
</td>
<td style="width: 1.0in; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 21.55pt;">
<td style="width: 2.25in; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;" colspan="2">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Jumlah</span></p>
</td>
<td style="width: 1.75in; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;" valign="middle">
<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">100</span></strong></p>
</td>
<td style="width: 1.0in; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
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
<td style="width: 43.1463%; height: 21px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Penguji</span></td>
</tr>
<tr style="height: 45px;">
<td style="width: 43.1463%; height: 45px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></td>
</tr>
<tr style="height: 10px;">
<td style="width: 43.1463%; height: 10px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">{{$cekdospen3->nama_karyawan}}</span></td>
</tr>
<tr style="height: 10px;">
<td style="width: 43.1463%; height: 10px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">

@if($key == 0)
(Ketua Penguji) 
@else
@endif


</span></td>
</tr>
</tbody>
</table>

<br>
<br>
<br>

<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif;">Keterangan : </span></p>
<table class="MsoTableGrid" style="margin-left: 12.5pt; border-collapse: collapse; border: none;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="width: 40.85pt; border: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">Nilai</span></strong></p>
</td>
<td style="width: 50.8pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">Rentang</span></strong></p>
</td>
</tr>
<tr style="height: 9.0pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">A</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">81 - 100</span></p>
</td>
</tr>
<tr style="height: 6.35pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">AB</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">76 - 80</span></p>
</td>
</tr>
<tr style="height: 4.85pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">B</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">71 - 75</span></p>
</td>
</tr>
<tr style="height: 11.5pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">BC</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">61 - 70</span></p>
</td>
</tr>
<tr style="height: 12.0pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">C</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">56 - 60</span></p>
</td>
</tr>
<tr style="height: 12.75pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">D</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">46 - 55</span></p>
</td>
</tr>
<tr style="height: 9.5pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">E</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">0 - 45</span></p>
</td>
</tr>
</tbody>
</table>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>





<p style="page-break-before: always"></p>




@endforeach
<!---------------------------------------LEMBAR PENELITIAN UJIAN TUGAS AKHIR ------------------------------------>


<?php for ($i=0; $i < 2; $i++) { ?> 

<!----------------------------------------DAFTAR HADIR UJIAN TUGAS AKHIR ---------------------------------------->

<br>
<br>
<br>
<br>

<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 14pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> Daftar Hadir Ujian Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<br>

<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 21.0669%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;"><b>&nbsp;{{$cek->nama}}</b></td>
</tr>
<tr>
<td style="width: 21.0669%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;"><b>&nbsp;{{$cek->nim}}</b></td>
</tr>
<tr>
<td style="width: 21.0669%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Hari/Tanggal</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;"><b>&nbsp;{{cek_hari($date)}}, {{tanggal_indo($cek->tanggal_pelaksanaan)}}</b></td>
</tr>
<tr>
<td style="width: 21.0669%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Pukul</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;"><b>&nbsp;@if($cek->jam_mulai == $cek->jam_selesai){{cek_jam($cek->jam_mulai)}} WIB s/d Selesai
	@else
		{{cek_jam($cek->jam_mulai)}} WIB - {{cek_jam($cek->jam_selesai)}} WIB
	@endif
</b>
</td>
</tr>
</tbody>
</table>

<br>

<table style=" border-collapse: collapse; border: none;" border="1" cellspacing="0" cellpadding="0">
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


<table  style="border-collapse: collapse;  height: 174px;" border="0" cellspacing="0" cellpadding="0" >
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
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>
</td>
<td style="width: 100.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 2.25pt double windowtext; padding: 0in 5.4pt; height: 54px;" rowspan="2" nowrap="nowrap">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>
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

<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Dekan Fakultas Bisnis</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Dr. Didi Sundiman, S.T., M.M.</span></p>



<br><br><br><br><br><br>


<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">Catatan:</span></em></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">Lembar asli dikembalikan ke DAK beserta dengan fotokopi Berita Acara Ujian </span></em></p>









<!----------------------------------------DAFTAR HADIR UJIAN  TUGAS AKHIR ---------------------------------------->

<p style="page-break-before: always"></p>


<?php } ?>


<!--------------------------------------PERSETUJUAN SELESAI TUGAS AKHIR -------------------------------->



<br><br><br>


<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"><u>Persetujuan Selesai Tugas Akhir</u>
</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<br>
<br>

<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Dosen </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Pembimbing</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"> y</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">ang bertanda</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"> </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">tangan di bawah ini</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"> dengan persetujuan Koordinator Program Studi Manajemen, m</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">enyetujui </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">selesainya </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">pelaksanaan </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Tugas Akhir </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">dari Mahasiswa:</span></p>

<br>

<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 31.0669%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;"><b>&nbsp;{{$cek->nama}}</b></td>
</tr>
<tr>
<td style="width: 31.0669%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;"><b>&nbsp;{{$cek->nim}}</b></td>
</tr>
<tr>
<td style="width: 31.0669%; padding-bottom: 90px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Judul TA (final)</span></td>
<td style="width: 1.16822%;padding-bottom: 90px;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;"><b></b></td>
</tr>
<tr>
<td style="width: 31.0669%;padding-bottom: 90px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Judul TA (bahasa Inggris)</span></td>
<td style="width: 1.16822%;padding-bottom: 90px;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;"><b></b></td>
</tr>
<tr>
<td style="width: 31.0669%;padding-bottom: 20px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Nilai akhir (angka)</span></td>
<td style="width: 1.16822%;padding-bottom: 20px;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;"><b></b></td>
</tr>
<tr>
<td style="width: 31.0669%;padding-bottom: 20px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Nilai akhir (huruf)</span></td>
<td style="width: 1.16822%;padding-bottom: 20px;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;"><b></b></td>
</tr>
</tbody>
</table>

<br>

<table style="border-collapse: collapse; width: 100%; height: 101px; font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;" border="1">
<tbody>
<tr style="height: 11px;">
<td style="width: 33.3333%; height: 11px; text-align: center;"><b>Nama Pembimbing</b></td>
<td style="width: 33.3333%; height: 11px; text-align: center;"><b>Tanda Tangan</b></td>
<td style="width: 33.3333%; height: 11px; text-align: center;"><b>Tanggal Persetujuan</b></td>
</tr>
@forelse($dospem as $cekpem)
<tr style="height: 60px;">
<td style="width: 33.3333%; height: 20px;"  nowrap="">&nbsp;{{$cekpem->nama_karyawan}}</td>
<td style="width: 33.3333%; height: 20px;"></td>
<td style="width: 33.3333%; height: 20px;"></td>
</tr>
@empty
<tr>
	<td colspan="10">Tidak Ada Data</td>
</tr>
@endforelse

</tbody>
</table>

<br>

<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Atas perhatian dan kerja samanya disampaikan terima kasih.</span></p>

<br>

<table style="border-collapse: collapse; width: 100%; height: 147px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Batam, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">____________________</span></td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Menyetujui, </span></td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp; K</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">oordinator</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Program</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> Studi</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Akuntansi</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp; Ibnu Harris, S.Kom., M.M. </span></p>
</td>
</tr>
</tbody>
</table>

<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">Catatan:</span></em></p>
<ol style="margin-bottom: 0in; margin-top: 0px;">
<li style="margin: 0in 0in 0.0001pt 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">Penulisan judul menggunakan kaidah penulisan yang benar untuk keperluan pelaporan ke PDDIKTI</span></em></li>
<li style="margin: 0in 0in 0.0001pt 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">Lembar asli dikembalikan ke DAK</span></em></li>
</ol>
<!--------------------------------------PERSETUJUAN SELESAI TUGAS AKHIR -------------------------------->


</body>
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

</html>