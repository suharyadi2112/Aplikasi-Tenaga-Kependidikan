
<?php if(cek_akses('63') == 'yes'){
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
<style type="text/css">
	p {
  margin: 0px;
}
</style>

<head>
	<title></title>
</head>

@foreach($cek as $hjt => $Vcek)
<!-----------------SURAT JENIS tUGAS AKHIR---------------->
@if($Vcek->nama_mk == 'Tugas Akhir')


<body onload="window.print()" style=" margin-left:43px; margin-right: 43px;">

<img style="width: 35%; position: fixed; top: 0px;" src="{{ URL::asset('admin/dist/img/headerlogo.png') }}" />
<img style="width: 87%; position: fixed; bottom: 0px;" src="{{ URL::asset('admin/dist/img/footerlogo2.png') }}" />


<br>
<br>
<br>

@php
$cekdospen_ns = DB::table('a_sks_dp')
->join('pegawai','pegawai.id_pegawai','=','a_sks_dp.id_dosen')
->where([['id_sks_selesai','=',$Vcek->id_sks],['kategori_dosen', '=','Pembimbing']])
->select('no_surat','nama_karyawan','nidn')
->get();

$jumlah_dos_pem = DB::table('a_sks_dp')
->where([['id_sks_selesai','=',$Vcek->id_sks],['kategori_dosen', '=','Pembimbing']])
->count();	
@endphp
@foreach($cekdospen_ns as $key => $tampildospen)

<p style="margin: 0cm 0cm 6pt 117.1pt; text-align: center; text-indent: -117.1pt; font-size: 11pt; font-family: Calibri, sans-serif;"><strong><u><span style="font-size: 18.0pt; font-family: Arial, sans-serif;">SURAT KETERANGAN</span></u></strong></p>
<p style="margin: 0cm 0cm 6pt 117.1pt; text-align: center; text-indent: -117.1pt; font-size: 11pt; font-family: Calibri, sans-serif;"><strong><span style="font-family: Arial, sans-serif;">No. {{$tampildospen->no_surat}}</span></strong></p>
<p style="text-align: center; margin: 0cm 0cm 0.0001pt 117.1pt; text-indent: -117.1pt; font-size: 11pt; font-family: Calibri, sans-serif;"><strong><span style="font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
<p style="text-align: center; line-height: 150%; margin: 0cm 0cm 0.0001pt 117.1pt; text-indent: -117.1pt; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-family: Arial, sans-serif;">Tentang</span></p>
<p style="text-align: center; line-height: 150%; margin: 0cm 0cm 0.0001pt 117.1pt; text-indent: -117.1pt; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-family: Arial, sans-serif;">

<!--Cek Jika Dosen pembimbing 1 atau lebih, jika dosen pembimbing hanya 1 maka tidak perlu pakai pertama ataupun kedua-->

@if($jumlah_dos_pem == 1)

Pelaksanaan Pembimbingan {{$Vcek->nama_mk}}

@else

Pelaksanaan Pembimbing {{ cekurutan($key + 1)}} {{$Vcek->nama_mk}}

@endif

</span></p>
<p style="text-align: center; line-height: 150%; margin: 0cm 0cm 0.0001pt 117.1pt; text-indent: -117.1pt; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-family: Arial, sans-serif;">Program Studi {{$Vcek->nama_prodi}}</span></p>


<br>
<br>


<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 100%; font-family: Arial, sans-serif; font-size: 11pt; text-align: justify;" colspan="3">Wakil Rektor Akademik dan Kemahasiswaan Universitas Universal menerangkan bahwa:</td>
</tr>
<tr>
<td style="width: 28.0374%;">&nbsp;</td>
<td style="width: 1.16822%;">&nbsp;</td>
<td style="width: 73.4813%;">&nbsp;</td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%">Nama</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt;">{{ $tampildospen->nama_karyawan }}</td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%">NIDN</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt;">
@if(is_null($tampildospen->nidn) || empty($tampildospen->nidn))
	-
@else
	{{ $tampildospen->nidn }}
@endif
</td>
</tr>
</tbody>
</table>


<br>


<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 100%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%" colspan="3">Telah selesai menjalankan tugas sebagai dosen 
@if($jumlah_dos_pem == 1)

Pembimbing

@else

Pembimbing {{ cekurutan($key + 1)}}

@endif  Tugas Akhir mahasiswa:</td>
</tr>
<tr>
<td style="width: 28.0374%;">&nbsp;</td>
<td style="width: 1.16822%;">&nbsp;</td>
<td style="width: 73.4813%;">&nbsp;</td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%">Nama</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt;">{{ $Vcek->nama }}</td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%">NIM</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt;">{{ $Vcek->nim }}</td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%; vertical-align: top;">Judul</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt; vertical-align: top;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%"><?php echo $Vcek->judul ?></td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%">Mulai</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt;">{{ tanggal_indo($Vcek->mulai) }}</td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%">Selesai</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt;">{{ tanggal_indo($Vcek->selesai) }}</td>
</tr>

</tbody>
</table>

<br>

<p style="margin: 0cm 0cm 0.0001pt 148.85pt; text-indent: -148.85pt; text-align: justify; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-family: Arial, sans-serif;">Surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</span></p>


<br>
<br>


<p style="margin: 0cm 0cm 0.0001pt 233.9pt; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Batam, 

@if($TglInput == 1)
{{tanggal_indo(date('Y-m-d',strtotime($Vcek->created_at)))}}
@elseif($tgl_diinginkan)
{{tanggal_indo($tgl_diinginkan)}}
@else
{{tanggal_indo(date('Y-m-d'))}}
@endif


</span></p>
<p style="margin: 0cm 0cm 0.0001pt 233.9pt; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="position: absolute; z-index: -1895820288; left: 0px; margin-left: 496px; margin-top: 46px; width: 151px; height: 136px;"><br /></span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Wakil </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Rektor</span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;"> Akademik dan Kemahasiswaan</span></p>
<p style="margin: 0cm 0cm 0.0001pt 233.9pt; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="position: absolute; z-index: -1895823361; left: 0px; margin-left: 366px; margin-top: 61px; width: 254px; height: 130px;">&nbsp;</span></p>


<table width="100%" border="0">
	<tr>
		<td style="width: 250px;"></td>
		<td>
		@if($ttd == 1 && $cap_uvers == null)
			<img style="left: 0; text-align: left; margin-left: 50.85pt;width: 100px; height: 65.95pt; z-index: -251653120; visibility: visible;" src="{{ URL::asset('admin/dist/img/ttdpakaswandi.png') }}" />
		@elseif($cap_uvers == 1 && $ttd == 1)
			<img src="{{ URL::asset('admin/dist/img/fusion2.png') }}" style="width: 165px;margin-left: 12px;">
		@else
			<br><br><br><br>
		@endif
			<p style="margin-left: 54px; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Dr.techn. Aswandy, M.T.</span></p>
		</td>
	</tr>
</table>

@if($loop->last)

@else

 <p style="page-break-before: always"></p>
 <br>
 <br>
 <br>
 <br>
@endif
@endforeach

</body>




<!--------------------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------
--------------------------------------------------------------------------------------------------->



<!-----------------SURAT JENIS MAGANG---------------->

@elseif($Vcek->nama_mk != 'Tugas Akhir')
	


<body onload="window.print()" style=" margin-left:43px; margin-right: 43px;">

<img style="width: 35%; position: fixed; top: 0px;" src="{{ URL::asset('admin/dist/img/headerlogo.png') }}" />
<img style="width: 87%; position: fixed; bottom: 0px;" src="{{ URL::asset('admin/dist/img/footerlogo2.png') }}" />


<br>
<br>
<br>

	
@php
$cekdospen_ns = DB::table('a_sks_dp')
->join('pegawai','pegawai.id_pegawai','=','a_sks_dp.id_dosen')
->where([['id_sks_selesai','=',$Vcek->id_sks],['kategori_dosen', '=','Pembimbing']])
->select('no_surat','nama_karyawan','nidn')
->get();

$jumlah_dos_pem = DB::table('a_sks_dp')
->where([['id_sks_selesai','=',$Vcek->id_sks],['kategori_dosen', '=','Pembimbing']])
->count();	
@endphp

@foreach($cekdospen_ns as $key => $tampildospen)

<p style="margin: 0cm 0cm 6pt 117.1pt; text-align: center; text-indent: -117.1pt; font-size: 11pt; font-family: Calibri, sans-serif;"><strong><u><span style="font-size: 18.0pt; font-family: Arial, sans-serif;">SURAT KETERANGAN</span></u></strong></p>
<p style="margin: 0cm 0cm 6pt 117.1pt; text-align: center; text-indent: -117.1pt; font-size: 11pt; font-family: Calibri, sans-serif;"><strong><span style="font-family: Arial, sans-serif;">No. {{$tampildospen->no_surat}}</span></strong></p>
<p style="text-align: center; margin: 0cm 0cm 0.0001pt 117.1pt; text-indent: -117.1pt; font-size: 11pt; font-family: Calibri, sans-serif;"><strong><span style="font-family: Arial, sans-serif;">&nbsp;</span></strong></p>
<p style="text-align: center; line-height: 150%; margin: 0cm 0cm 0.0001pt 117.1pt; text-indent: -117.1pt; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-family: Arial, sans-serif;">Tentang</span></p>
<p style="text-align: center; line-height: 150%; margin: 0cm 0cm 0.0001pt 117.1pt; text-indent: -117.1pt; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-family: Arial, sans-serif;">



@if($jumlah_dos_pem == 1)

Pelaksanaan Pembimbingan {{$Vcek->nama_mk}}

@else

Pelaksanaan Pembimbing {{ cekurutan($key + 1)}} {{$Vcek->nama_mk}}

@endif

</span></p>
<p style="text-align: center; line-height: 150%; margin: 0cm 0cm 0.0001pt 117.1pt; text-indent: -117.1pt; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-family: Arial, sans-serif;">Program Studi {{$Vcek->nama_prodi}}</span></p>
<p style="text-align: center; line-height: 150%; margin: 0cm 0cm 0.0001pt 117.1pt; text-indent: -117.1pt; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-family: Arial, sans-serif;">
	Semester {{$Vcek->semester}} T.A.{{$Vcek->tahun_ajar}}</span></p>


<br>
<br>


<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 100%; font-family: Arial, sans-serif; font-size: 11pt; text-align: justify;" colspan="3">Wakil Rektor Akademik dan Kemahasiswaan Universitas Universal menerangkan bahwa:</td>
</tr>
<tr>
<td style="width: 28.0374%;">&nbsp;</td>
<td style="width: 1.16822%;">&nbsp;</td>
<td style="width: 73.4813%;">&nbsp;</td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%">Nama</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt;">{{ $tampildospen->nama_karyawan }}</td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%">NIDN</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt;">
@if(is_null($tampildospen->nidn) || empty($tampildospen->nidn))
	-
@else
	{{ $tampildospen->nidn }}
@endif
</td>
</tr>
</tbody>
</table>


<br>


<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 100%; font-family: Arial, sans-serif; font-size: 11pt; text-align: justify; line-height: 150%" colspan="3">Telah selesai menjalankan tugas sebagai dosen Pembimbing {{$Vcek->nama_mk}} mahasiswa:</td>
</tr>
<tr>
<td style="width: 28.0374%;">&nbsp;</td>
<td style="width: 1.16822%;">&nbsp;</td>
<td style="width: 73.4813%;">&nbsp;</td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%">Nama</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt;">{{ $Vcek->nama }}</td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%">NIM</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt;">{{ $Vcek->nim }}</td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%; vertical-align: top;">Judul</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt; vertical-align: top;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%; padding-top: 2px;
    padding-bottom: 2px;"><?php echo $Vcek->judul ?></td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%">Lokasi</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt;">{{ $Vcek->lokasi }}</td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%">Mulai Pembimbingan</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt;">{{ tanggal_indo($Vcek->mulai) }}</td>
</tr>
<tr>
<td style="width: 28.0374%; font-family: Arial, sans-serif; font-size: 11pt; line-height: 150%">Selesai Pembimbingan</td>
<td style="width: 2.16822%; font-family: Arial, sans-serif; font-size: 11pt;">:</td>
<td style="width: 73.4813%; font-family: Arial, sans-serif; font-size: 11pt;">{{ tanggal_indo($Vcek->selesai) }}</td>
</tr>

</tbody>
</table>

<br>

<p style="margin: 0cm 0cm 0.0001pt 148.85pt; text-indent: -148.85pt; text-align: justify; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-family: Arial, sans-serif;">Surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</span></p>


<br>
<br>


<p style="margin: 0cm 0cm 0.0001pt 233.9pt; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Batam, 

@if($TglInput == 1)
{{tanggal_indo(date('Y-m-d',strtotime($Vcek->created_at)))}}
@elseif($tgl_diinginkan)
{{tanggal_indo($tgl_diinginkan)}}
@else
{{tanggal_indo(date('Y-m-d'))}}
@endif


</span></p>
<p style="margin: 0cm 0cm 0.0001pt 233.9pt; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="position: absolute; z-index: -1895820288; left: 0px; margin-left: 496px; margin-top: 46px; width: 151px; height: 136px;"><br /></span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Wakil </span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Rektor</span><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;"> Akademik dan Kemahasiswaan</span></p>
<p style="margin: 0cm 0cm 0.0001pt 233.9pt; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="position: absolute; z-index: -1895823361; left: 0px; margin-left: 366px; margin-top: 61px; width: 254px; height: 130px;">&nbsp;</span></p>



<table width="100%" border="0">
	<tr>
		<td style="width: 250px;"></td>
		<td>
		@if($ttd == 1 && $cap_uvers == null)
			<img style="left: 0; text-align: left; margin-left: 50.85pt;width: 100px; height: 65.95pt; z-index: -251653120; visibility: visible;" src="{{ URL::asset('admin/dist/img/ttdpakaswandi.png') }}" />
		@elseif($cap_uvers == 1 && $ttd == 1)
			<img src="{{ URL::asset('admin/dist/img/fusion2.png') }}" style="width: 165px;margin-left: 12px;">
		@else
			<br><br><br><br>
		@endif
			<p style="margin-left: 54px; text-align: justify; line-height: 115%; font-size: 12pt; font-family: 'Times New Roman', serif; font-weight: bold;"><span style="font-size: 11.0pt; line-height: 115%; font-family: Arial, sans-serif; font-weight: normal;">Dr.techn. Aswandy, M.T.</span></p>
		</td>
	</tr>
</table>


@if($loop->last)

@else

 <p style="page-break-before: always"></p>
 <br>
 <br>
 <br>
 <br>
@endif

@endforeach

</body>

@else
<script type="text/javascript">
	alert('tidak dalam kondisi, harap ulang kembali');
</script>
@endif



 <p style="page-break-before: always"></p>
@endforeach

</html>

@php
function cekurutan($cekurutan) {
	switch ($cekurutan) {
		case '1':
			return "Pertama";
			break;
		case '2':
			return "Kedua";
			break;
		case '3':
			return "Ketiga";
			break;
		case '4':
			return "Keempat";
			break;
		case '5':
			return "Kelima";
			break;
		
		default:
			return "error #321";
			break;
	}
}

function tanggal_indo($tanggal) {
        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
    }


@endphp