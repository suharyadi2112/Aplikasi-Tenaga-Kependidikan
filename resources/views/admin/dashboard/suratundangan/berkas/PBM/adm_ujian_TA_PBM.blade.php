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

<!---------------------------------------BERITA ACARA UJIAN TUGAS AKHIR -------------------------------------->

<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">Berita Acara</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> Ujian Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Pelaksanaan Ujian Tugas Akhir dari mahasiswa:</span></p>

<br>
<table style="border-collapse: collapse; width: 100%; height: 63px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 9.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">Nama</td>
<td style="width: 1.16822%; height: 21px;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;font-size: 11.0pt;">{{$cek->nama}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 9.9019%; height: 21px; font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</td>
<td style="width: 1.16822%; height: 21px;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;font-size: 11.0pt;">{{$cek->nim}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 9.9019%; height: 21px; vertical-align: top; font-size: 11.0pt; font-family: Arial, sans-serif;font-size: 11.0pt;">Judul</td>
<td style="width: 1.16822%; height: 21px; vertical-align: top;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; vertical-align: top; font-size: 11.0pt; font-family: Arial, sans-serif;">@php echo $cek->judul @endphp</td>
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
<br>

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
		
		@endif
	@empty
	Anggota
	@endforelse
	
@endif

</span></p>
</td>


<td style="width: 205.5pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;">
<p style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"><span style="font-size: 11.0pt; line-height: 0%; font-family: Arial, sans-serif;">{{$cekdospen->nama_karyawan}}</span></p>
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

<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Mahasiswa bersangkutan dinyatakan <b>(LULUS/ TIDAK LULUS*) Ujian Tugas Akhir</b> dengan catatan :</span></p>

<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">_____________________________________________________________________________</span></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">_____________________________________________________________________________</span></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></strong><br></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">_____________________________________________________________________________</span></p>



<p style="padding-top: 0px;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Demikian berita acara ini dibuat dengan sesungguhnya untuk dipergunakan sebagaimana mestinya.</span></p>

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
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Dekan Fakultas Pendidikan, Bahasa, dan Budaya</span></p>
</td>
<td style="width: 7.86813%; height: 21px;">&nbsp;</td>
<td style="width: 12.6602%; height: 21px;">&nbsp;</td>
<td style="width: 44.3925%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp; K</span><span style="font-size: 11pt; font-family: Arial, sans-serif;">oordinator</span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11pt; font-family: Arial, sans-serif;">Program</span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> Studi</span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11pt; font-family: Arial, sans-serif;">Pendidikan &nbsp;</span></p>
	<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Bahasa Mandarin</span></p>
</td>
</tr>
<tr style="height: 80px;">
<td style="width: 35.079%; height: 83px;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 7.86813%; height: 83px;">&nbsp;</td>
<td style="width: 12.6602%; height: 83px;">&nbsp;</td>
<td style="width: 44.3925%; height: 83px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></td>
</tr>
<tr style="height: 10px;">
<td style="width: 35.079%; height: 10px;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Dr. Herman, B.Ed., MTCSOL</span></p>
</td>
<td style="width: 7.86813%; height: 10px;">&nbsp;</td>
<td style="width: 12.6602%; height: 10px;">&nbsp;</td>
<td style="width: 44.3925%; height: 10px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Dr. Herman, B.Ed., MTCSOL</span><span style="font-size: 11pt; font-family: Arial, sans-serif;">.</span></td>

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

<!---------------------------------------BERITA ACARA UJIAN TUGAS AKHIR -------------------------------------->

 <p style="page-break-before: always"></p>


<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->







<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('b', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->
<!---------------------------------------SARAN PERBAIKAN UJIAN TUGAS AKHIR -------------------------------------->

@foreach($dospen as $key => $cekdospen2)


<br>
<br>
<br>


<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> Saran Perbaikan Ujian Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>

<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Berdasarkan Ujian Tugas Akhir yang telah dilakukan oleh mahasiswa:</span></p>

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
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; vertical-align: top; text-align: left;">@php echo $cek->judul @endphp</td>
</tr>
</tbody>
</table>

<br>

<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Maka dapat kami sampaikan saran-saran sebagai berikut:</span></p>


<table style="border-collapse: collapse; width: 97.1963%; height: 400px;" border="1">
<tbody>
<tr style="height: 0px;">
<td style="width: 100%; height: 0px;">&nbsp;</td>
</tr>
</tbody>
</table>



<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Demikian untuk menjadi bahan periksa. Atas perhatiannya kami sampaikan terima kasih.</span></p>


<br>
<table style="border-collapse: collapse; width: 98.053%; height: 161px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 6.65261%; height: 21px;">&nbsp;</td>
<td style="width: 47.7215%; height: 21px;">&nbsp;</td>
<td style="width: 45.6259%; height: 21px;">
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; "><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">Batam, </span><span style="font-size: 11pt; font-family: Arial, sans-serif;">{{tanggal_indo($cek->tanggal_pelaksanaan)}}</span></p>
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
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">

	{{ $cekdospen2->nama_karyawan }}

</span> </span></p>
</td>
</tr>


</tbody>
</table>


<p style="page-break-before: always"></p>

@endforeach

<!---------------------------------------SARAN PERBAIKAN UJIAN TUGAS AKHIR -------------------------------------->



<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->




















<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('c', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->

<!---------------------------------------LEMBAR PENILAIAN UJIAN TUGAS AKHIR ------------------------------------>

@foreach($dospen as $key => $cekdospen3)

<br>
<br>
<br>


<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> Lembar Penilaian Ujian Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Pada hari ini, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{cek_hari($date)}}</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">{{tanggal_indo($cek->tanggal_pelaksanaan)}}</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> telah diselenggarakan Ujian Tugas Akhir mahasiswa:</span></p>

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



<!---------------------->

<div align="center">
<table class="MsoNormalTable" style="width: 661px; border-collapse: collapse; border: none;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 26.1pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">NO</span></strong></p>
</td>
<td style="width: 98.45pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">ASPEK PENILAIAN</span></strong></p>
</td>
<td style="width: 279.0pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">PARAMETER</span></strong></p>
</td>
<td style="width: 48.2pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="margin: 0cm -7.35pt 0.0001pt -5.45pt; text-align: center; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">BOBOT</span></strong><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;"> </span></strong><strong><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">(%)</span></strong></p>
</td>
<td style="width: 42.6pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">NILAI</span></strong></p>
</td>
</tr>
<tr style="height: 21.25pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">I</span></p>
</td>
<td style="width: 377.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" colspan="2">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">PENULISAN</span></p>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 21.25pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 377.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" colspan="2">
<ol style="list-style-type: upper-alpha; margin-bottom: 0cm; margin-top: 0px; padding-left: 18px;">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">PENGUASAAN PENULISAN</span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">20</span></strong></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 26.05pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px; ">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Sistematika </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">p</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">enulisan</span></li>
</ol>
</td>
<td style="width: 279.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Sesuai tata urutan yang berlaku:</span></p>
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Bagian Pendahuluan:</span></li>
</ol>
<p style="margin: 0cm 0cm 0cm 18pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Halaman judul, pengesahan, kata pengantar, daftar isi, abstrak</span></p>
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;" start="2">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Bagian isi:</span></li>
</ol>
<p style="margin: 0cm 0cm 0cm 18pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Pendahuluan, </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">t</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">injauan </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">t</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">eori, </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">m</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">etodologi penelitian, hasil dan pembahasan</span></p>
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;" start="3">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Daftar pustaka dan lampiran-lampiran</span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">10</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 26.05pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="2">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Ketepatan </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">p</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">enggunaan </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">b</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">ahasa dan </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">i</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">stilah</span></li>
</ol>
</td>
<td style="width: 279.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Pungtuasi (</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">p</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">enggunaan tanda baca yang tepat)</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Tata bahasa yang tepat</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Diksi (pemilihan kata)</span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">10</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 21.25pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 377.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" colspan="2">
<ol style="list-style-type: upper-alpha; margin-bottom: 0cm; margin-top: 0px;" start="2">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">SEGI ILMIAH PENULISAN</span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">60</span></strong></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 26.05pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kesesuaian judul dan isi</span></li>
</ol>
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 279.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Isi tulisan sesuai judul</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Memungkinkan untuk diteliti</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Memberikan kontribusi</span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">2</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="2">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kejelasan paparan latar </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">b</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">elakang</span></li>
</ol>
</td>
<td style="width: 279.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Pernyataan masalah jelas</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Skala/ justifikasi masalah</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kronologis masalah (sebab-akibat)</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Konsep solusi (dituliskan secara urut)</span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">3</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="3">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan merumuskan masalah</span></li>
</ol>
</td>
<td style="width: 279.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Jelas dan ringkas</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Didukung oleh fakta</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Penting untuk diteliti</span></li>
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Pernyataan masalah (berupa pertanyaan, spesifik, dan terpisah)</span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">3</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>

</tbody>
</table>
</div>


<p style="page-break-before: always"></p>
<!---------------------->

<br>
<br>
<br>
<br>
<br>


<div align="center">
<table class="MsoNormalTable" style="width: 661px; border-collapse: collapse; border: none;" border="1" cellspacing="0" cellpadding="0">
<tbody>


<tr style="height: 22.45pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>

<td style="width: 27.3pt; border: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<ol style="margin-top: 0cm; margin-bottom: .0001pt;" start="4">
<li style="margin: 0cm -10.85pt 0.0001pt 0px; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kejelasan penulisan tujuan dan manfaat penelitian</span></li>
</ol>
</td>

<td style="width: 27.3pt; border: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Menggunakan kata kerja yang operasional</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Dapat dicapai</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Spesifik</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Tujuan dan ma</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">nfaat</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;"> jelas</span></li>
</ol>
</td>
<td style="width: 27.3pt; border: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">3</span></p>
</td>

<td style="width: 27.3pt; border: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>



<tr style="height: 22.45pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-top: 0cm; margin-bottom: .0001pt;" start="5">
<li style="margin: 0cm -3.75pt 0.0001pt 0px; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Ketepatan dan kedalaman menuliskan tinjauan teori (pustaka)</span></li>
</ol>
</td>
<td style="width: 279.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Semua </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">variabel</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;"> </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">dan </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">faktor</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;"> yang berhubungan dengan masalah yang diteliti dituliskan</span></li>
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Setiap pernyataan didukung oleh daftar pustaka yang sesuai</span></li>
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kejelasan dalam membuat paraphrase setiap pernyataan</span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">3</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>

<tr style="height: 22.45pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="6">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Penyusunan kerangka konseptual (berdasarkan&nbsp; teori)</span></li>
</ol>
</td>
<td style="width: 279.0pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Berdasarkan teori atau model yang berlaku secara umum</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Mengambarkan semua yang tertulis pada tinjauan teori</span></li>
</ol>
</td>
<td style="width: 48.2pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">2</span></p>
</td>
<td style="width: 42.6pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="7">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Perumusan hipotesis</span></li>
</ol>
</td>
<td style="width: 279.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kalimat pernyataan (anta</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">rvariabel</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">)</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Hipotesis kerja/ nol</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Dapat diuji</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Berdasarkan teori</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Bersifat dapat m</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">emprediksi</span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">3</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="8">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Penggunaan metode penelitian dan statistik</span></li>
</ol>
</td>
<td style="width: 279.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Pemilihan design atau rancangan yang tepat</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Sesuai dengan tujuan penelitian</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Variabel</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;"> yang diukur dinyatakan dengan jelas</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Penentuan subjek yang tepat</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Penjelasan pengumpulan data </span></li>
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Penentuan instrumen penelitian yang tepat (valid dan reliab</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">e</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">l)</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Penggunaan dan pengolahan data yang tepat</span></li>
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Dituliskan keterbatasan (<em>samp</em></span><em><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">l</span></em><em><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">ing design, instrument, feasibility</span></em><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">)</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Penulisan <em>ethical clearance</em></span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">5</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="9">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan menulis hasil data</span></li>
</ol>
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 279.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kalimat pengantar</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Ketepatan </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">menentukan populasi dan s</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">a</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">mpel</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Ketepatan </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">pengumpulan data</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan menganalisis data</span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">5</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="10">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Pembahasan hasil penelitian</span></li>
</ol>
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 279.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Menganalisa makna hasil penelitian dihubungkan dengan tujuan penelitian (menjelaskan <em>Why</em> dan <em>How</em>)</span></li>
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Penulisan mengandung </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">unsur </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">fakta (dianalisa),</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;"> t</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">eori (pustaka)</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">, </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">opini (pendapat peneliti)</span></li>
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Isi tulisan disesuaikan dengan tujuan khusus penelitian</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Dituliskan keterbatasan penelitian</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Penulisan secara wajar tidak berlebihan</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;"> </span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">2</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">1</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
</tbody>
</table>
</div>




<p style="page-break-before: always"></p>
<!---------------------->

<br>
<br>
<br>
<br>

<div align="center">
<table class="MsoNormalTable" style="width: 661px; border-collapse: collapse; border: none;" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 22.45pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="11">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan menarik kesimpulan dan saran</span></li>
</ol>
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 279.0pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kesimpulan ditulis untuk menjawab masalah/ tujuan penelitian</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Didasarkan pada hasil dan pembahasan</span></li>
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Ringkas dan jelas dalam member</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">i</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;"> makna hasil, dengan meminimalkan penulisan angka-angka hasil uji statistic</span></li>
</ol>
</td>
<td style="width: 48.2pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">5</span></p>
</td>
<td style="width: 42.6pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="12">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Penggunaan kepustakaan</span></li>
</ol>
</td>
<td style="width: 279.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Konsisten dengan model pustaka yang digunakan</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Pustaka diambil dari tahun terbit maksimal 10 tahun terakhir</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Pustaka yang dianjurkan adalah jurnal-jurnal hasil penelitian terbaru (internet,</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;"> </span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">buku)</span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">5</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 21.25pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">II</span></p>
</td>
<td style="width: 377.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" colspan="2">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">PENYAJIAN SKRIPSI</span></p>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">20</span></strong></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan Penyajian</span></li>
</ol>
</td>
<td style="width: 279.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan mengemukakan konsep dan teori</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan berbicara dengan jelas</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan menyajikan teori secara sistematis</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan dalam menekankan beberapa hal yang penting</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan tekn</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">ik</span><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;"> penyajian secara keseluruhan</span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">10</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 22.45pt;">
<td style="width: 27.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 98.45pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="margin-bottom: 0cm; margin-top: 0px;" start="2">
<li style="line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan Berdiskusi</span></li>
</ol>
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 279.0pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<ol style="list-style-type: lower-alpha; margin-bottom: 0cm; margin-top: 0px;">
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan berkomunikasi atau berdialog</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan menjawab dengan tepat</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan menerima fakta baru secara terbuka</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan menerima pendapat lain secara kritis</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kemampuan mengendalikan emosi</span></li>
<li style="text-align: justify; line-height: 115%; margin: 0cm 0cm 0cm 0px; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">Kejujuran mengemukakan pendapat</span></li>
</ol>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">10</span></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
</td>
</tr>
<tr style="height: 21.55pt;">
<td style="width: 404.75pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;" colspan="3">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">Jumlah</span></p>
</td>
<td style="width: 48.2pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">100</span></strong></p>
</td>
<td style="width: 42.6pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="line-height: 115%; margin: 0cm; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
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
<td style="width: 33.3333%; height: 20px;" rowspan="5">
	
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

</td>
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



<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>





<p style="page-break-before: always"></p>




@endforeach
<!---------------------------------------LEMBAR PENELITIAN UJIAN TUGAS AKHIR ------------------------------------>



<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->











<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('d', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->

<!----------------------------------------DAFTAR HADIR UJIAN TUGAS AKHIR ---------------------------------------->

<?php for ($i=0; $i < 2; $i++) { ?> 

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
<td style="width: 1.16822%;">:&nbsp;</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;">{{$cek->nama}}</td>
</tr>
<tr>
<td style="width: 21.0669%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">NIM</span></td>
<td style="width: 1.16822%;">:&nbsp;</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;">{{$cek->nim}}</td>
</tr>
<tr>
<td style="width: 21.0669%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Hari/Tanggal</span></td>
<td style="width: 1.16822%;">:&nbsp;</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;">{{cek_hari($date)}}, {{tanggal_indo($cek->tanggal_pelaksanaan)}}</td>
</tr>
<tr>
<td style="width: 21.0669%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Pukul</span></td>
<td style="width: 1.16822%;">:&nbsp;</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;">@if($cek->jam_mulai == $cek->jam_selesai){{cek_jam($cek->jam_mulai)}} WIB s/d Selesai
	@else
		{{cek_jam($cek->jam_mulai)}} - {{cek_jam($cek->jam_selesai)}} WIB
	@endif

</td>
</tr>
</tbody>
</table>

<br>

<table style=" border-collapse: collapse; width: 100%; border: none;" border="1" cellspacing="0" cellpadding="0">
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
<td style="width: 100.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0in 5.4pt; height: 54px; vertical-align: top;" rowspan="2" nowrap="nowrap">
<p style="margin: 0in 0in 0.0001pt; font-size: 11.0pt; font-family: Arial, sans-serif; ">{{ $keyet + 1 }}.</p>
</td>
<td style="width: 100.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 2.25pt double windowtext; padding: 0in 5.4pt; height: 54px; vertical-align: top;" rowspan="2" nowrap="nowrap">
<p style="margin: 0in 0in 0.0001pt; font-size: 11.0pt; font-family: Arial, sans-serif;">{{ $keyet + 2}}.</p>
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

<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Dekan Fakultas Pendidikan, Bahasa, dan Budaya</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Dr. Herman, B.Ed., MTCSOL</span></p>



<br><br><br>


<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">Catatan:</span></em></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><em><span style="font-size: 8.0pt; font-family: Arial, sans-serif;">Lembar asli dikembalikan ke DAK beserta dengan fotokopi Berita Acara Ujian </span></em></p>









<!----------------------------------------DAFTAR HADIR UJIAN  TUGAS AKHIR ---------------------------------------->

<p style="page-break-before: always"></p>


<?php } ?>



<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->











<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('e', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->

<!--------------------------------------PERSETUJUAN SELESAI TUGAS AKHIR -------------------------------->



<br><br><br>


<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"><u>Persetujuan Selesai Tugas Akhir</u>
</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>
<br>

<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Dosen </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Pembimbing</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"> y</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">ang bertandatangan di bawah ini</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"> dengan persetujuan Koordinator Program Studi Pendidikan Bahasa Mandarin, m</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">enyetujui </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">selesainya </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">pelaksanaan </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Tugas Akhir </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">dari Mahasiswa:</span></p>

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
<td style="width: 31.0669%; padding-bottom: 70px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Judul TA (Bahasa Indonesia)</span></td>
<td style="width: 1.16822%;padding-bottom: 70px;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;"><b></b></td>
</tr>
<tr>
<td style="width: 31.0669%; padding-bottom: 70px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Judul TA (Bahasa Mandarin)</span></td>
<td style="width: 1.16822%;padding-bottom: 70px;">:</td>
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;"><b></b></td>
</tr>
<tr>
<td style="width: 31.0669%;padding-bottom: 70px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Judul TA (bahasa Inggris)</span></td>
<td style="width: 1.16822%;padding-bottom: 70px;">:</td>
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
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp; K</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">oordinator</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Program</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> Studi</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Pendidikan</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>
<td style="width: 24.9221%; height: 21px;">&nbsp;</td>
<td style="width: 41.7445%; height: 21px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Bahasa Mandarin </span></td>
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
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp; Dr. Herman, B.Ed., MTCSOL</span></p>
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