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
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
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
<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">Berita Acara Ujian Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"><br> Program Studi Seni Musik Semester {{$semester}} T.A. {{$tahun_ajar}}</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Pelaksanaan Ujian Tugas Akhir (Ujian Pertunjukan dan Ujiang Sidang) dari mahasiswa:</span></p>


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
		{{cek_jam($cek->jam_mulai)}} WIB - {{cek_jam($cek->jam_selesai)}} WIB
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
<td style="width: 205.5pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt; text-align: center;">
<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Nama</span></p>
</td>
<td style="width: 70.85pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Nilai Ujian Pertunjukan</span></p>
</td>
<td style="width: 70.85pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Nilai Ujian Sidang</span></p>
</td>
<td style="width: 120.85pt; border: solid windowtext 1.0pt; border-left: none; padding: 0in 5.4pt 0in 5.4pt;">
<p style="line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Tanda Tangan</span></p>
</td>
</tr>

@foreach($dospen as $key => $cekdospen)

<tr>
<td style="width: 83.4pt; border: solid windowtext 1.0pt; border-top: none; padding: 0in 5.4pt 0in 5.4pt; padding-top: 0.5rem; padding-bottom: 0.5rem; white-space: nowrap;">
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
<td style="width: 191.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;" colspan="">
<p style="line-height: 200%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 191.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt;" colspan="">
<p style="line-height: 200%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 191.7pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0in 5.4pt 0in 5.4pt; background: black;" colspan="">
<p style="line-height: 200%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>

</tr>

</tbody>
</table>

<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Catatan:</span></p>
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
<td style="width: 44.3925%; height: 21px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Batam, </span><span style="font-size: 11pt; font-family: Arial, sans-serif;"><b>{{tanggal_indo($cek->tanggal_pelaksanaan)}}</b></span></td>
</tr>
<tr style="height: 21px;">
<td style="width: 35.079%; height: 21px; vertical-align: top;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Dekan Fakultas Seni</span></p>
</td>
<td style="width: 7.86813%; height: 21px;">&nbsp;</td>
<td style="width: 12.6602%; height: 21px;">&nbsp;</td>
<td style="width: 44.3925%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp; K</span><span style="font-size: 11pt; font-family: Arial, sans-serif;">oordinator</span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11pt; font-family: Arial, sans-serif;">Program</span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> Studi</span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11pt; font-family: Arial, sans-serif;"> &nbsp;</span></p>
	<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Seni Musik</span></p>
</td>
</tr>
<tr style="height: 50px;">
<td style="width: 35.079%; height: 40px;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 7.86813%; height: 20px;">&nbsp;</td>
<td style="width: 12.6602%; height:20px;">&nbsp;</td>
<td style="width: 44.3925%; height:20px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">&nbsp;</span></td>
</tr>
<tr style="height: 10px;">
<td style="width: 35.079%; height: 10px;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Widyanarto, S.Sn., M.Sn.</span></p>
</td>
<td style="width: 7.86813%; height: 10px;">&nbsp;</td>
<td style="width: 12.6602%; height: 10px;">&nbsp;</td>
<td style="width: 44.3925%; height: 10px;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Jayanti M Sagala, M.A.SI.</span><span style="font-size: 11pt; font-family: Arial, sans-serif;"></span></td>
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

<!---------------------------------------BERITA ACARA UJIAN PROPOSAL TUGAS AKHIR -------------------------------------->

 <p style="page-break-before: always"></p>



<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->







<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('c', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->

<!---------------------------------------SARAN PERBAIKAN UJIAN SEMINAR PROPOSAL -------------------------------------->

@foreach($dospen as $key => $cekdospen2)


<br>
<br>
<br>
<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">Saran Perbaikan Ujian Tugas Akhir</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<br>

<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif; font-weight: normal;">Berdasarkan </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif; font-weight: normal;">Ujian Pertunjukan dan Ujian Sidang Tugas Akhir </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif; font-weight: normal;">yang telah dilakukan oleh mahasiswa:</span></p>



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


<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Maka dapat kami sampaikan saran-saran sebagai berikut:</span></p>

<br>

<table style="border-collapse: collapse; width: 100%; height: 430px;" border="1">
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
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;"></span><span style="font-size: 11pt; font-family: Arial, sans-serif; font-weight: normal;">
	
	@if($key == 0)
	Penguji (Ketua)
	@elseif($key == 1)
	Penguji Ahli
	@else
	Penguji
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



</tbody>
</table>


<p style="page-break-before: always; "></p>

@endforeach

<!---------------------------------------SARAN PERBAIKAN UJIAN PROPOSAL TUGAS AKHIR -------------------------------------->


<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->











<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('e', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->


<!--------------------------------------Lembar Rekapitulasi Nilai Tugas Akhir------------------------------------->

<br>
<br>
<br>

<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">Lembar Rekapitulasi Nilai Tugas Akhir <br>
Program Studi Seni Musik Semester {{$semester}} T.A. {{$tahun_ajar}}
</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Penilaian terhadap tugas akhir dari mahasiswa:</span></p>


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
<td style="width: 64.6027%; height: 21px;line-height: 115%; font-family: Arial, sans-serif; font-weight: normal; vertical-align: top; text-align: justify;">@php echo $cek->judul @endphp</td>
</tr>
</tbody>
</table>

<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">telah diselenggarakan pada:</span></p>

<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 7.8271%;">&nbsp;</td>
<td style="width: 2.80374%;font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">A.</td>
<td style="width: 64.3691%;font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">Ujian Kelayakan Materi, tanggal … </td>
<td style="width: 25%;">&nbsp;</td>
</tr>
<tr>
<td style="width: 7.8271%;">&nbsp;</td>
<td style="width: 2.80374%;font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">B.</td>
<td style="width: 64.3691%;font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">Ujian Kelayakan Akhir, tanggal …</td>
<td style="width: 25%;">&nbsp;</td>
</tr>
<tr>
<td style="width: 7.8271%;">&nbsp;</td>
<td style="width: 2.80374%;font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">C.</td>
<td style="width: 64.3691%;font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">Ujian Pertunjukan, tanggal …</td>
<td style="width: 25%;">&nbsp;</td>
</tr>
<tr>
<td style="width: 7.8271%;">&nbsp;</td>
<td style="width: 2.80374%;font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">D.</td>
<td style="width: 64.3691%;font-size: 11.0pt; line-height: 200%; font-family: Arial, sans-serif;">Ujian Sidang, tanggal …</td>
<td style="width: 25%;">&nbsp;</td>
</tr>
</tbody>
</table>

<p><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">dengan penilaian sbb:</span></p>

<table class="MsoTableGrid" style="border-collapse: collapse; border: none; width: 100%" border="1" cellspacing="0" cellpadding="0">
<tbody>
<tr style="height: 37.1pt;">
<td style="width: 76.3pt; border: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 150%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Ujian Kelayakan Materi</span></p>
</td>
<td style="width: 77.95pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 150%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Ujian Kelayakan Akhir</span></p>
</td>
<td style="width: 70.9pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 150%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Ujian Pertunjukan</span></p>
</td>
<td style="width: 70.85pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 150%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Ujian Sidang</span></p>
</td>
<td style="width: 92.15pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 150%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Nilai Angka Akhir</span></p>
</td>
<td style="width: 92.15pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 150%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Nilai Huruf Akhir</span></p>
</td>
</tr>
<tr style="height: 1.0cm;">
<td style="width: 76.3pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="line-height: 200%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="line-height: 200%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 77.95pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 200%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 70.9pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="line-height: 200%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 70.85pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="line-height: 200%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 92.15pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="line-height: 200%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
<td style="width: 92.15pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;" valign="top">
<p style="line-height: 200%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 200%; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
</tbody>
</table>

<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Mahasiswa bersangkutan dinyatakan <strong>LULUS / TIDAK LULUS*) Tugas Akhir dengan catatan:&nbsp; </strong></span></p>
<p style="line-height: 200%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 200%; font-family: Arial, sans-serif;">____________________________________________________________________________________</span></p>
<p style="line-height: 200%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 200%; font-family: Arial, sans-serif;">____________________________________________________________________________________</span></p>
<p style="line-height: 200%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; line-height: 200%; font-family: Arial, sans-serif;">____________________________________________________________________________________</span></p>
<p style="text-align: justify; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Demikian lembar rekapitulasi ini dibuat dengan sesungguhnya untuk dipergunakan sebagaimana mestinya.</span></p>




<p style="margin: 0cm 0cm 0.0001pt -7.1pt; text-indent: 7.1pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 9.0pt; font-family: Arial, sans-serif;">Keterangan :</span></p>
<p style="margin: 0cm 0cm 0.0001pt 208.9pt; text-indent: 34.1pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Batam, {{tanggal_indo($cek->tanggal_pelaksanaan)}}</span></p>
<table class="MsoTableGrid" style="border-collapse: collapse; border: none; margin-left: 7.5pt; margin-right: 7.5pt;" border="1" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="width: 40.85pt; border: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">Nilai</span></strong></p>
</td>
<td style="width: 50.8pt; border: solid windowtext 1.0pt; border-left: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><strong><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">Rentang</span></strong></p>
</td>
</tr>
<tr style="height: 9.0pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">A</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">81 - 100</span></p>
</td>
</tr>
<tr style="height: 6.35pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">AB</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">76 - 80</span></p>
</td>
</tr>
<tr style="height: 4.85pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">B</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">71 - 75</span></p>
</td>
</tr>
<tr style="height: 11.5pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">BC</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">61 - 70</span></p>
</td>
</tr>
<tr style="height: 12.0pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">C</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">56 - 60</span></p>
</td>
</tr>
<tr style="height: 12.75pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">D</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">46 - 55</span></p>
</td>
</tr>
<tr style="height: 9.5pt;">
<td style="width: 40.85pt; border: solid windowtext 1.0pt; border-top: none; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">E</span></p>
</td>
<td style="width: 50.8pt; border-top: none; border-left: none; border-bottom: solid windowtext 1.0pt; border-right: solid windowtext 1.0pt; padding: 0cm 5.4pt 0cm 5.4pt;">
<p style="text-align: center; line-height: 115%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; line-height: 115%; font-family: Arial, sans-serif;">0 - 45</span></p>
</td>
</tr>
</tbody>
</table>
<p style="margin: 0cm 0cm 0.0001pt 238.5pt; text-align: justify; text-indent: 4.5pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Kepala Program Studi Seni Musik</span></p>
<p style="margin: 0cm 0cm 0.0001pt 238.5pt; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="margin: 0cm 0cm 0.0001pt 238.5pt; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="margin: 0cm 0cm 0.0001pt 238.5pt; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="margin: 0cm 0cm 0.0001pt 238.5pt; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="margin: 0cm 0cm 0.0001pt 238.5pt; text-align: justify; text-indent: 4.5pt; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Jayanti M. Sagala, S.Sn., M.A.</span></p>

<p style="margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><sup><span style="font-size: 6.0pt; font-family: Arial, sans-serif;">*)</span></sup><span style="font-size: 6.0pt; font-family: Arial, sans-serif;"> coret yang tidak perlu</span><span style="font-size: 6.0pt; font-family: Arial, sans-serif;"><br style="page-break-before: always;" clear="all" /></span></p>

<!--------------------------------------Lembar Rekapitulasi Nilai Tugas Akhir------------------------------------>

<p style="page-break-before: always"></p>



<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->














<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('f', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->



<!--------------------------------------PERSETUJUAN SELESAI TUGAS AKHIR -------------------------------->



<br><br><br>


<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"><u>Persetujuan Selesai Tugas Akhir</u>
</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

<br>
<br>

<p style="line-height: 150%; margin: 0cm 0cm 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Dosen </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Pembimbing</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"> y</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">ang bertanda</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"> </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">tangan di bawah ini</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;"> dengan persetujuan Kepala Program Studi Seni Musik, m</span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">enyetujui </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">selesainya </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">pelaksanaan </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">Tugas Akhir </span><span style="font-size: 11.0pt; line-height: 150%; font-family: Arial, sans-serif;">dari Mahasiswa:</span></p>

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

<td style="width: 41.7445%; height: 21px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Batam, </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">____________________</span></td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>

<td style="width: 41.7445%; height: 21px;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Menyetujui, </span></td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>

<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"></span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"></span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;"> </span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Koordinator Program Studi Seni Musik</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>

<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>

<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>

<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
</td>
</tr>
<tr style="height: 21px;">
<td style="width: 33.3333%; height: 21px;">&nbsp;</td>

<td style="width: 41.7445%; height: 21px;">
<p style="margin: 0in 0in 0.0001pt -5.4pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp; Jayanti M. Sagala, S.Sn., M.A. </span></p>
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


<p style="page-break-before: always"></p>














<!---cek kondisi jika pilihan sub file di centang -->
@if(in_array('b', $cek_pilihan, TRUE))
<!---cek kondisi jika pilihan sub file di centang -->

<!--------------------------------------DAFTAR HADIR SEMINAR PROPOSAL------------------------------------->
<?php for ($i=0; $i < 2; $i++) { ?> 

<br>
<br>
<br>

<p style="margin: 0in 0in 0.0001pt; text-align: center; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 14.0pt; font-family: Arial, sans-serif;">Daftar Hadir Ujian Tugas Akhir

</span><span style="font-size: 14.0pt; font-family: Arial, sans-serif;"> </span></p>

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
<td style="width: 77.7648%;font-size: 11.0pt; font-family: Arial, sans-serif;"><b>@if($cek->jam_mulai == $cek->jam_selesai){{cek_jam($cek->jam_mulai)}} WIB s/d Selesai
	@else
		{{cek_jam($cek->jam_mulai)}} WIB - {{cek_jam($cek->jam_selesai)}} WIB
	@endif
</b>
</td>
</tr>
</tbody>
</table>


<br>

<table style=" border-collapse: collapse; border: none; width: 100%" border="1" cellspacing="0" cellpadding="0">
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


<table  style="border-collapse: collapse;  height: 174px; width:100%" border="0" cellspacing="0" cellpadding="0" >
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

<p style="margin: 0in 0in 0.0001pt 273.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Dekan Fakultas Seni</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 233.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 273.9pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Widyanarto, S.Sn.,  M.Sn.</span></p>



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

<!---cek kondisi jika pilihan sub file di centang -->
@endif
<!---cek kondisi jika pilihan sub file di centang -->

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