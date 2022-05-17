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


<!----------------------------------------PERSETUJUAN SEMINAR-------------------------------------->


<img style="width: 35%; position: fixed; top: 0px;" src="{{ URL::asset('admin/dist/img/headerlogo.png') }}" />
<img style="width: 87%; position: fixed; bottom: 0px;" src="{{ URL::asset('admin/dist/img/footerlogo2.png') }}" />



<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('a', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->

<br>
<br>
<br>

<p style="line-height: 115%; margin: 0in 0in 0.0001pt; text-align: center; font-size: 14pt; font-family: 'Times New Roman', serif; font-weight: bold;"><u><span style="font-size: 14.0pt; line-height: 115%; font-family: Arial, sans-serif;">Persetujuan</span></u><u><span style="font-size: 14.0pt; line-height: 115%; font-family: Arial, sans-serif;"> Seminar Proposal Tugas Akhir</span></u><u><span style="font-size: 14.0pt; line-height: 115%; font-family: Arial, sans-serif;"> </span></u></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"> Dosen Pembimbing yang bertanda tangan di bawah ini dengan persetujuan Koordinator Program Teknik Industri, menyetujui pelaksanaan Seminar Proposal Tugas Akhir dari Mahasiswa:</span>
</p>


<br>
<table style="border-collapse: collapse; width: 100%; height: 168px; font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;">Nama</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 79.1666%; height: 21px;">{{ $cek->nama }}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;">NIM</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 79.1666%; height: 21px;">{{ $cek->nim }}</td>
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
<td style="width: 79.1666%; height: 21px;">{{cek_hari($date)}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;">Tanggal</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 79.1666%; height: 21px;">{{tanggal_indo($cek->tanggal_pelaksanaan)}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;">Jam</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 79.1666%; height: 21px;">

	@if($cek->jam_mulai == $cek->jam_selesai)
		{{cek_jam($cek->jam_mulai)}} WIB s/d Selesai
	@else
		{{cek_jam($cek->jam_mulai)}} - {{cek_jam($cek->jam_selesai)}} WIB
	@endif
	


</td>
</tr>
<tr style="height: 21px;">
<td style="width: 19.6651%; height: 21px;">Ruangan</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 79.1666%; height: 21px;">{{$cek->nama_ruangan}}</td>
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
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;&nbsp;Koordinator Program Studi Teknik</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Industri</span></td>
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
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp; Mia Juliana Siregar, S.T., M.T. </span></p>
</td>
</tr>
</tbody>
</table>

<!----------------------------------------PERSETUJUAN SEMINAR-------------------------------------->
 
 <p style="page-break-before: always"></p>

<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->








<!---------------------------------------BERITA ACARA UJIAN SEMINAR -------------------------------------->

<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('b', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->


<br>
<br>
<br>

<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">Berita Acara</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> Seminar Proposal Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<br>
<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"> Pelaksanaan Seminar Proposal Tugas Akhir dari mahasiswa:</span></p>


<br>

<table style="border-collapse: collapse; width: 100%; height: 63px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; font-size: 11.0pt; ">{{$cek->nama}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; font-size: 11.0pt; ">{{$cek->nim}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; vertical-align: top; font-size: 11.0pt; font-family: Arial, sans-serif;">Judul</td>
<td style="width: 1.16822%; height: 21px; vertical-align: top;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; vertical-align: top;">@php echo $cek->judul @endphp</td>
</tr>
</tbody>
</table>

<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">telah diselenggarakan pada:.</span></p>
<br>

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
		{{cek_jam($cek->jam_mulai)}}  - {{cek_jam($cek->jam_selesai)}} WIB 
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

<br>


<table class="MsoTableGrid" style=" border-collapse: collapse; border: none; margin-left: 0.5pt;" border="1" >
<tbody>
<tr>
<td style="width: 1px; border: solid windowtext 1.0pt;  text-align: center;">
<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">No</span></p>
</td>
<td style="width: 205.5pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt; text-align: center;">
<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Nama Tim Penguji</span></p>
</td>
<td style="width: 70.85pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt; text-align: center;">
<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Nilai Angka</span></p>
</td>
<td style="width: 120.85pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt; text-align: center;">
<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Tanda Tangan</span></p>
</td>
</tr>

@foreach($dospen as $key => $cekdospen)

<tr>
<td style="border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt; text-align: center;">
<p style="line-height: 200%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">
	
{{$key + 1}}

</span></p>
</td>
<td style="width: 205.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="line-height: 200%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 350%; font-family: Arial, sans-serif;">{{$cekdospen->nama_karyawan}}</span></p>
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
</tbody>
</table>


<br>
<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Mahasiswa bersangkutan dinyatakan <b>(DAPAT / TIDAK DAPAT*)</b> melanjutkan ke Penelitian Tugas Akhir.</span></p>

<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Demikian berita acara ini dibuat dengan sesungguhnya untuk dipergunakan sebagaimana mestinya.</span></p>
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
<td style="width: 35.079%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Dekan Fakultas Teknik</span></p>
</td>
<td style="width: 7.86813%; height: 21px;">&nbsp;</td>
<td style="width: 12.6602%; height: 21px;">&nbsp;</td>
<td style="width: 44.3925%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp; K</span><span style="font-size: 11pt; font-family: Arial, sans-serif;">oordinator</span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11pt; font-family: Arial, sans-serif;">Program Studi Teknik</span></p>
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span><span style="font-size: 11pt; font-family: Arial, sans-serif;"></span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11pt; font-family: Arial, sans-serif;">Industri</span></p>
</td>
</tr>
<tr style="height: 50px;">
<td style="width: 35.079%; height: 53px;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 7.86813%; height: 53px;">&nbsp;</td>
<td style="width: 12.6602%; height: 53px;">&nbsp;</td>
<td style="width: 44.3925%; height: 53px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></td>
</tr>
<tr style="height: 10px;">
<td style="width: 40.079%; height: 10px;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Dr. Eng. Ansarullah Lawi, M.Eng.</span></p>
</td>
<td style="width: 7.86813%; height: 10px;">&nbsp;</td>
<td style="width: 12.6602%; height: 10px;">&nbsp;</td>
<td style="width: 44.3925%; height: 10px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Mia Juliana Siregar, S.T., M.T.</span><span style="font-size: 11pt; font-family: Arial, sans-serif;">.</span></td>
</tr>
<tr style="height: 10px;">
<td style="width: 35.079%; height: 10px;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 7.86813%; height: 10px;">&nbsp;</td>
<td style="width: 12.6602%; height: 10px;">&nbsp;</td>
<td style="width: 44.3925%; height: 10px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></td>
</tr>
<tr style="height: 21px;">
<td style="width: 35.079%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;"><sup><span style="font-size: 6pt; font-family: Arial, sans-serif;">*)</span></sup><span style="font-size: 6pt; font-family: Arial, sans-serif;"> coret yang tidak perlu</span> </span></p>
</td>
<td style="width: 7.86813%; height: 21px;">&nbsp;</td>
<td style="width: 12.6602%; height: 21px;">&nbsp;</td>
<td style="width: 44.3925%; height: 21px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></td>
</tr>
</tbody>
</table>

<!---------------------------------------BERITA ACARA SEMINAR -------------------------------------->

 <p style="page-break-before: always"></p>


<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->








<!---------------------------------------SARAN PERBAIKAN UJIAN PROPOSAL TUGAS AKHIR -------------------------------------->

<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('c', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->

@foreach($dospen as $key => $cekdospen2)


<br>
<br>
<br>


<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> Saran Perbaikan Seminar Proposal Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<br>
<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Berdasarkan Seminar Proposal Tugas Akhir yang telah dilakukan oleh mahasiswa:</span></p>


<br>

<table style="border-collapse: collapse; width: 100%; height: 63px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; font-size: 11.0pt;">{{$cek->nama}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; font-size: 11.0pt;">{{$cek->nim}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; vertical-align: top; font-size: 11.0pt; font-family: Arial, sans-serif;">Judul</td>
<td style="width: 1.16822%; height: 21px; vertical-align: top;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; vertical-align: top;">@php echo $cek->judul @endphp</td>
</tr>
</tbody>
</table>

<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Maka dapat kami sampaikan saran-saran sebagai berikut:</span></p>

<br>

<table style="border-collapse: collapse; width: 100%; height: 400px;" border="1">
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
<td style="width: 6.65261%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
</td>

<td style="height: 21px; width: 47.7215%;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">Mengetahui Perbaikan,<br>Pembimbing</span></p>
</td>
<td style="width: 45.6259%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">Batam, {{tanggal_indo($cek->tanggal_pelaksanaan)}} <br></span><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;"> 

	@if($key == 0)
	Ketua Penguji
	@else
	Penguji {{$key + 0}}
	@endif

</span></p>
</td>
</tr>
<tr style="height: 53px;">
<td style="width: 6.65261%; height: 30px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
</td>
<td style="width: 47.7215%; height: 30px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
</td>
<td style="width: 45.6259%; height: 30px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 6.65261%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 47.7215%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">
	
@foreach($dospem as $key => $cekdospem2)
@if($key == 0)
{{$cekdospem2->nama_karyawan}}
@else
@endif
@endforeach

</span></p>

</td>
<td style="width: 45.6259%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; "><span style="font-size: 11pt; font-family: Arial, sans-serif;">

{{ $cekdospen2->nama_karyawan }}

</span></p>
</td>
</tr>
</tbody>
</table>


<p style="page-break-before: always"></p>

@endforeach



<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->

<!---------------------------------------SARAN PERBAIKAN UJIAN PROPOSAL TUGAS AKHIR -------------------------------------->























<!---------------------------------------LEMBAR PENILAIAN SEMINAR------------------------------------>


<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('d', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->


@foreach($dospen as $key => $cekdospen3)

<br>
<br>
<br>

<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> Lembar Penilaian Seminar Proposal Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>

<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Pada hari ini, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{cek_hari($date)}}</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{tanggal_indo($cek->tanggal_pelaksanaan)}}</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> telah diselenggarakan seminar Proposal Tugas Akhir  mahasiswa:</span></p>
<br>

<table style="border-collapse: collapse; width: 100%; height: 63px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; font-size: 11.0pt;">{{$cek->nama}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; font-size: 11.0pt;">{{$cek->nim}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; vertical-align: top; font-size: 11.0pt; font-family: Arial, sans-serif;">Judul</td>
<td style="width: 1.16822%; height: 21px; vertical-align: top;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; vertical-align: top;">@php echo $cek->judul @endphp</td>
</tr>
</tbody>
</table>

<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif; ">Saya selaku penguji melakukan pengujian/penilaian terhadap Seminar Proposal Tugas Akhir tersebut memberikan  dengan nilai sebagai berikut :</span></p>

<table class="MsoNormalTable" style="border-collapse: collapse; border: none; height: 380px; width: 100%" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 26.45pt;">
<td style="width: 38.625px; border: 1pt solid windowtext; padding: 0cm 5.4pt; height: 27px;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NO</span></strong></p>
</td>
<td style="width: 522.625px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 27px;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">MATERI</span></strong></p>
</td>
<td style="width: 55.625px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 27px;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">BOBOT</span></strong><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> (%)</span></strong></p>
</td>
<td style="width: 42.625px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; padding: 0cm 5.4pt; height: 27px;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NILAI</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: 38.625px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 74px;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">1</span></p>
</td>
<td style="width: 522.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 74px;">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">PENDAHULUAN</span></strong></p>
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">1. Ketajaman latar belakang dalam mengangkat isu (masalah)</span></p>
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">2. Ketajaman Perumusan Masalah</span></p>
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">3. Tujuan dan Kontribusi</span></p>
</td>
<td style="width: 55.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 74px;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">20</span></strong></p>
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 42.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 74px;">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 26.05pt;">
<td style="width: 38.625px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 88px;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">2</span></p>
</td>
<td style="width: 522.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 88px;">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">KAJIAN PUSTAKA</span></strong></p>
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">1. Relevansi dengan masalah</span></p>
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">2. Pengacuan dasar konsep/teori/ riset sebelumnya</span></p>
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">3. Kemutakhiran atau keaslian sumber referensi</span></p>
</td>
<td style="width: 55.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 88px;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">25</span></strong></p>
</td>
<td style="width: 42.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 88px;">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: 38.625px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 98px;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">3</span></p>
</td>
<td style="width: 522.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 98px;">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">METODE PENELITIAN</span></strong></p>
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">1. Kesesuaian dengan Masalah</span></p>
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">2. Ketepatan Rancangan</span></p>
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">3. Ketepatan Instrumen</span></p>
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">4. Ketepatan dan Ketajaman alat Analisis</span></p>
</td>
<td style="width: 55.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 98px;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">30</span></strong></p>
</td>
<td style="width: 42.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 98px;">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: 38.625px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 65px;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">4</span></p>
</td>
<td style="width: 522.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 65px;">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">PRESENTASI DAN PENGUASAAN MATERI</span></strong></p>
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">1. Kualitas presentasi</span></p>
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">2. Kemampuan mempertahankan dan menjelaskan materi proposal</span></p>
</td>
<td style="width: 55.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 65px;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">25</span></strong></p>
</td>
<td style="width: 42.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 65px;">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 21.55pt;">
<td style="width: 576.625px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0cm 5.4pt; height: 28px;" colspan="2">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">J</span></strong><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">UMLAH</span></strong></p>
</td>
<td style="width: 55.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 28px;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">100</span></strong></p>
</td>
<td style="width: 42.625px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0cm 5.4pt; height: 28px;" valign="top">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
</tbody>
</table>

<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; line-height: 150%"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Demikian penilaian ini dilaksanakan.</span></p>


<table style="border-collapse: collapse; width: 100%; height: 106px;" border="0">
<tbody>
<tr style="height: 20px;">
<td style="width: 33.3333%; height: 20px;" rowspan="5">
<p style="line-height: 50%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 150%; font-family: Arial, sans-serif;">Keterangan : </span></p>
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
</table></td>
<td style="width: 23.5203%; height: 20px;" rowspan="5">&nbsp;</td>
<td style="width: 43.1463%; height: 20px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Batam, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">
{{tanggal_indo($cek->tanggal_pelaksanaan)}}</span></td>
</tr>
<tr style="height: 21px;">
<td style="width: 43.1463%; height: 21px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">

	@if($key == 0)
	Ketua Penguji
	@else
	Penguji {{$key + 0}}
	@endif

</span></td>
</tr>
<tr style="height: 50px;">
<td style="width: 43.1463%; height: 50px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></td>
</tr>
<tr style="height: 10px;">
<td style="width: 43.1463%; height: 10px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">{{$cekdospen3->nama_karyawan}}</span></td>
</tr>
<tr style="height: 10px;">
<td style="width: 43.1463%; height: 10px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">

@if($key == 0)

@else
@endif


</span></td>
</tr>
</tbody>
</table>

<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>





<p style="page-break-before: always"></p>




@endforeach
<!---------------------------------------LEMBAR PENILAIAN SEMINAR------------------------------------>


<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->







<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('e', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->

<?php for ($i=0; $i < 2; $i++) { ?> 


<!----------------------------------------DAFTAR HADIR SEMINAR ---------------------------------------->

<br>
<br>
<br>
<br>

<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">Daftar Hadir Seminar Proposal Tugas Akhir
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
		{{cek_jam($cek->jam_mulai)}}  - {{cek_jam($cek->jam_selesai)}} WIB
	@endif

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


<table  style="border-collapse: collapse;  width: 100%; height: 174px;" border="0" cellspacing="0" cellpadding="0" >
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
<p style="margin: 0in 0in 0.0001pt; font-size: 11.0pt; font-family: Arial, sans-serif; ">{{ $keyet + 2 }}.</p>
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

<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Dekan Fakultas Teknik</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Dr. Eng. Ansarullah Lawi, M.Eng.</span></p>



<br><br><br><br><br><br>


<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">Catatan:</span></em></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">Lembar asli dikembalikan ke DAK beserta dengan fotokopi Berita Acara Ujian </span></em></p>



<!----------------------------------------DAFTAR HADIR SEMINAR ---------------------------------------->



<p style="page-break-before: always"></p>

<?php } ?>

<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->






<!--------------------------------------DAFTAR HADIR MAHASISWA SEMINAR -------------------------------->


<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('f', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->


<br><br><br>


<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">Daftar Hadir Seminar Proposal Tugas Akhir
</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

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


<p style="margin: 0in 0in 0.0001pt;line-height: 250%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-family: Arial, sans-serif;">Mahasiswa Peserta:</span></p>


<table style="width: 100%; margin-left: 4.65pt; border-collapse: collapse;" border="0" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 20.25pt;">
<td style="width: 27.3pt; border: double windowtext 2.25pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" nowrap="nowrap">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NO</span></strong></p>
</td>
<td style="width: 188.55pt; border-top: double windowtext 2.25pt; border-left: none; border-bottom: double windowtext 2.25pt; border-right: solid black 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" colspan="5" nowrap="nowrap">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NAMA</span></strong></p>
</td>
<td style="width: 184.5pt; border-top: double windowtext 2.25pt; border-left: none; border-bottom: double windowtext 2.25pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NIDN/</span></strong><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</span></strong></p>
</td>
<td style="width: 84.2pt; border-top: double windowtext 2.25pt; border-left: none; border-bottom: double windowtext 2.25pt; border-right: double black 2.25pt; padding: 0cm 5.4pt 0cm 5.4pt;" nowrap="nowrap">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">TTD</span></strong></p>
</td>
<td style="border: none; padding: 0cm 0cm 0cm 0cm;">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>
</td>
</tr>

<?php for ($i=0; $i < 20; $i++) { ?>

<tr style="height: 20.1pt;">
<td style="width: 27.3pt; border-top: none; border-left: double windowtext 2.25pt; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" nowrap="nowrap">
<p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-family: Arial, sans-serif;">{{$i + 1}}</span></p>
</td>
<td style="width: 188.55pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" colspan="5" nowrap="nowrap">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 184.5pt; border-top: none; border-left: none; border-bottom: solid black 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 84.2pt; border-top: none; border-left: none; border-bottom: solid black 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="border: none; padding: 0cm 0cm 0cm 0cm;">
<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>
</td>
</tr>

<?php } ?>

</tbody>
</table>

</tbody>
</table>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Mengetahui,</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Dekan Fakultas Teknik</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Dr. Eng. Ansarullah Lawi, M.Eng.</span></p>

<!--------------------------------------DAFTAR HADIR MAHASISWA SEMINAR-------------------------------->


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