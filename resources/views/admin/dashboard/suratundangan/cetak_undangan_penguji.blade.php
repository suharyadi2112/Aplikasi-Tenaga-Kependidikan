
<!DOCTYPE html>
<html>
<head>
</head>
<style type="text/css">
	p {
  margin: 0px;
}
</style>



<body onload="window.print()" style=" margin-left:43px; margin-right: 43px;">

@foreach($cekData as $keyo => $show)

<?php 
$date = strtotime($show->tanggal_pelaksanaan);
$date = date('l', $date);
?>

<img style="width: 35%; position: fixed; top: 0px;" src="{{ URL::asset('admin/dist/img/headerlogo.png') }}" />
<img style="width: 87%; position: fixed; bottom: 0px;" src="{{ URL::asset('admin/dist/img/footerlogo2.png') }}" />

<br>
<br>
<br>
<br>

<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 14.5249%;">
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Nomor</span></p>
</td>
<td style="width: 1.16822%;">:</td>
<td style="width: 84.3068%; font-size: 11.0pt; font-family: Arial, sans-serif;">{{$show->no_surat}}</td>
</tr>
<tr>
<td style="width: 14.5249%;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Lamp</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 84.3068%; font-size: 11.0pt; font-family: Arial, sans-serif;">
	@if(empty($show->lampiran))
	-
	@else
	{{ $show->lampiran }}
	@endif
</td>
</tr>
<tr>
<td style="width: 14.5249%;"><span style="font-size: 11pt; font-family: Arial, sans-serif;">Hal</span></td>
<td style="width: 1.16822%;">:</td>
<td style="width: 84.3068%; font-size: 11.0pt; font-family: Arial, sans-serif;">Undangan {{$show->nama_berkas}} an. {{$show->nama}}</td>
</tr>
</tbody>
</table>


<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Kepada Yth.</span></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Bapak/Ibu Dosen Universitas Universal</span></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Di tempat</span></p>
<br>
<br>
<br>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Sehubungan dengan pelaksanaan </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">

	{{$show->nama_berkas}} Mahasiswa

</span>

<br><br>
<table style="border-collapse: collapse; width: 100%; height: 63px;" border="0">
<tbody>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;">Nama</td>
<td style="width: 1.16822%; height: 21px;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 150%; font-family: Arial, sans-serif; font-weight: normal; font-size: 11.0pt;">{{$show->nama}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;font-size: 11.0pt;">NIM</td>
<td style="width: 1.16822%; height: 21px;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 150%; font-family: Arial, sans-serif; font-weight: normal;font-size: 11.0pt;">{{$show->nim}}</td>
</tr>
<tr style="height: 21px;">
<td style="width: 13.9019%; height: 21px; vertical-align: top; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;font-size: 11.0pt;">Judul</td>
<td style="width: 1.16822%; height: 21px; vertical-align: top;font-size: 11.0pt;">:</td>
<td style="width: 64.6027%; height: 21px;line-height: 150%; font-family: Arial, sans-serif; font-weight: normal; vertical-align: top;">@php echo $show->judul @endphp</td>
</tr>
</tbody>
</table>


<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt;  font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Maka kami </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">mengundang </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Bapak/Ibu</span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;"> sebagai tim penguji p</span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">ada </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">


	{{$show->nama_berkas}}


mahasiswa bersangkutan</span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>


<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>

@php
$cekDosenPenguji =  DB::table('a_udg_dp')
    ->join('pegawai', 'pegawai.id_pegawai', '=', 'a_udg_dp.id_dosen') 
    ->select('a_udg_dp.*','pegawai.*')
    ->where([
        ['id_udg','=',$show->id_undangan],
        ['kategori_dosen','=','Penguji']
    ])
    ->orderBy('a_udg_dp.id','ASC')
    ->get();
@endphp

@forelse($cekDosenPenguji as $key => $valdos)
<tr>
<td style="width: 4.24451%;">&nbsp;</td>
<td style="width: 4.24451%; font-size: 11.0pt; font-family: Arial, sans-serif;">{{$key + 1}}.</td>
<td style="width: 62.4221%; font-size: 11.0pt; font-family: Arial, sans-serif;">{{$valdos->nama_karyawan}}

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

</td>
</tr>
@empty
<tr>
<td colspan="100"><center>Tidak ada data</center></td>
</tr>
@endforelse
</tbody>
</table>


<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">yang akan dilaksanakan </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">pada:</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>


<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 16.7445%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Hari/Tanggal</span></td>
<td style="width: 2.10275%;">:</td>
<td style="width: 81.1526%;font-size: 11.0pt; font-family: Arial, sans-serif;">{{ cek_hari($date) }}, {{tanggal_indo($show->tanggal_pelaksanaan)}}</td>
</tr>
<tr>
<td style="width: 16.7445%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Pukul</span><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">&nbsp;&nbsp; </span></td>
<td style="width: 2.10275%;">:</td>

<td style="width: 81.1526%;font-size: 11.0pt; font-family: Arial, sans-serif;">
	@if($show->jam_mulai == $show->jam_selesai)
	{{cek_jam($show->jam_mulai)}} WIB - Selesai
	@else
	{{cek_jam($show->jam_mulai)}} - {{cek_jam($show->jam_selesai)}} WIB
	@endif
</td>

</tr>
<tr>
<td style="width: 16.7445%;"><span style="font-size: 11.0pt; font-family: Arial, sans-serif;">Ruangan</span></td>
<td style="width: 2.10275%;">:</td>
<td style="width: 81.1526%;font-size: 11.0pt; font-family: Arial, sans-serif;">{{$show->nama_ruangan}}</td>
</tr>
</tbody>
</table>

<br>

<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">A</span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">tas perhatian dan kerjasamanya di</span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">sampai</span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">kan terima kasih</span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">.</span></p>
<p style="text-align: justify; line-height: 115%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 3.15in; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Batam, 

@if($TglInput == 1)
{{tanggal_indo(date('Y-m-d',strtotime($show->created_at)))}}
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
			<p style="margin-left: 44px; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Dr.techn. Aswandy, M.T.</span></p>
		</td>
	</tr>
</table>

<p style="page-break-before: always"></p>

@endforeach

</body>
</html>

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