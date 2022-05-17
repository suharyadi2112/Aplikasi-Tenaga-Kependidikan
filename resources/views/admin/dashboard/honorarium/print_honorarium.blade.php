<!DOCTYPE html>
<html>
<head>
</head> 

<style type="text/css">
@page  
{ 
    
    /* this affects the margin in the printer settings */ 
    margin: 20mm 10mm 15mm 10mm;  
    size: landscape;
} 

body  
{ 
    /* this affects the margin on the content before sending to printer */ 
    margin: 0px;  
} 
</style>


<!--img style="width: 15%; position: fixed; top: -10px;" src="{{ URL::asset('admin/dist/img/headerlogo.png') }}" /-->
<!--img style="width: 57%; position: fixed;padding-left: 18%;  bottom: 0px;" src="{{ URL::asset('admin/dist/img/footerlogo2.png') }}"/-->

<!--body  style="margin-top: 25px; margin-left:15px; margin-right: 15px;" -->


<br>


<body  onload="window.print()">
<!--SURAT KETERANGAN SELESAI-->

<table border="1" style="border-collapse: collapse; width: 100%" class="table table-strip">
	<thead style="background: #a6a6a6;border-color: black;" >
		<tr>
			<th>Nama</th>
			<th>Jabatan Fungsional</th>
			<th>Tugas Sebagai</th>
            <th>Hari, Tanggal</th>
            <th>Waktu</th>
			<th>Mulai</th>
			<th>Selesai</th>
			<th>Nama Mahasiswa, Prodi</th>
			<th>Pembayaran</th>
			<th>Lampiran</th>
		</tr>
	</thead>
	<tbody>


    @foreach($data_print as $key => $cek_data)


        <tr>
        	<td style="vertical-align: middle; text-align: center; width: 20%; font-size: 9pt; font-family: 'Times New Roman', serif; font-weight: bold; padding: 1px;">

            {{$cek_data->nama_karyawan }}


        	</td>
        	<td style=" font-size: 9pt; font-family: 'Times New Roman', serif; text-align: center; padding: 2px;">{{ $cek_data->jabatan_fungsional }}</td>

        	<td style="vertical-align: middle;  font-size: 9pt; font-family: 'Times New Roman', serif; padding: 1px;width: 20rem;"> {{ $cek_data->tugas_sebagai }}</td>

            @if(is_null($cek_data->tanggal) && is_null($cek_data->waktu))

                <td style="vertical-align: middle; text-align: center;  font-size: 9pt; font-family: 'Times New Roman', serif; padding: 2px;" nowrap="">-</td>

                <td style="vertical-align: middle; text-align: center;  font-size: 9pt; font-family: 'Times New Roman', serif; padding: 2px;" nowrap="">-</td>

                <td style="vertical-align: middle; text-align: center;  font-size: 9pt; font-family: 'Times New Roman', serif; padding: 2px;" nowrap="">{{ $cek_data->mulai }}</td>

                <td style="vertical-align: middle; text-align: center;  font-size: 9pt; font-family: 'Times New Roman', serif; padding: 2px;" nowrap="">{{ $cek_data->selesai }}</td>
            @else

                <td style="vertical-align: middle; text-align: center;  font-size: 9pt; font-family: 'Times New Roman', serif; padding: 2px;" nowrap="">{{ $cek_data->tanggal }}</td>

                <td style="vertical-align: middle; text-align: center;  font-size: 9pt; font-family: 'Times New Roman', serif; padding: 2px;" nowrap="">{{ $cek_data->waktu }}</td>

                <td style="vertical-align: middle; text-align: center;  font-size: 9pt; font-family: 'Times New Roman', serif; padding: 2px;" nowrap="">-</td>

                <td style="vertical-align: middle; text-align: center;  font-size: 9pt; font-family: 'Times New Roman', serif; padding: 2px;" nowrap="">-</td>

            @endif

        	<td style="vertical-align: middle; text-align: center;  font-size: 9pt; font-family: 'Times New Roman', serif; padding: 2px;" nowrap="">{{ $cek_data->nama_mahasiswa }},<br>{{ singkatjur($cek_data->prodi) }}</td>

        	<td style="vertical-align: middle; text-align: center;  font-size: 9pt; font-family: 'Times New Roman', serif; padding: 2px;" nowrap=""><b>Rp.{{ number_format($cek_data->pembayaran)}},-</b></td>

        
        	<td style="vertical-align: middle; text-align: left; width: 15rem; font-size: 9pt; font-family: 'Times New Roman', serif;padding: 2px;" >{{$cek_data->nama_lampiran}}</td>



        </tr>

       @endforeach
      

       

    </tbody>
</table>

 <p style="page-break-before: always"></p>
 
<table border="1" style="border-collapse: collapse; windowtext; width: 100%">
    <thead style="background: #a6a6a6;border-color: black;">
        <tr>
            <th>Nama</th>
            <th>Total Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($hasil as $key => $show_hasil)
        <tr>
            <td style="vertical-align: left; text-align: center;  font-size: 9pt; font-family: 'Times New Roman', serif; padding: 2px; font-weight: bold;" >{{ $show_hasil->nama_karyawan }}</td>
            <td style="vertical-align: middle; text-align: center;  font-size: 9pt; font-family: 'Times New Roman', serif; padding: 2px; font-weight: bold;" >Rp.{{ number_format($show_hasil->hasil) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<table style="border-collapse: collapse; width: 881pt;" border="0" cellspacing="0" cellpadding="0"><colgroup><col style="width: 110pt;" /> <col style="width: 65pt;" /> <col style="width: 73pt;" /> <col style="width: 86pt;" /> <col style="width: 70pt;" /> <col style="width: 72pt;" /> <col style="width: 63pt;" /> <col style="width: 92pt;" /> <col style="width: 73pt;" /> <col style="width: 81pt;" /> <col style="width: 96pt;" /></colgroup>
<tbody>
<tr style="height: 18.75pt;">
<td style="width: 175pt; font-weight: bold; font-family: FZZhongKaiB-B08; text-align: left; vertical-align: middle; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; border: none; white-space: nowrap;" colspan="2">Batam, {{ tanggal_indo(date('Y-m-d')) }}</td>
<td style="width: 73pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 86pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 70pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 72pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 63pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 165pt; font-weight: bold; font-family: FZZhongKaiB-B08; text-align: left; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;" colspan="2">&nbsp;</td>
<td style="width: 81pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 96pt; text-align: left; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
</tr>
<tr style="height: 15.0pt;">
<td style="width: 110pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 65pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 73pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 86pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 70pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 72pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 63pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 92pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 73pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">Mengetahui,</td>
<td style="width: 81pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 96pt; text-align: left; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
</tr>

<tr style="height: 30.0pt;">
<td style="width: 110pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 65pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 73pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 86pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 70pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 72pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 63pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 92pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 73pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 81pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 96pt; text-align: left; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
</tr>


<tr style="height: 18.0pt;">
<td style="width: 175pt; font-weight: bold; font-family: FZZhongKaiB-B08; text-align: left; vertical-align: middle; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; border: none; white-space: nowrap;" colspan="2">Leny Pratiwi, S.H., M.Hum.</td>
<td style="width: 73pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 86pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 70pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 72pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 63pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 92pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 154pt; font-weight: bold; font-family: FZZhongKaiB-B08; text-align: left;  color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;" colspan="2">Irfan, S.Psi., M.M.</td>
<td style="width: 96pt; text-align: left; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-weight: 400; font-style: normal; font-family: Calibri, sans-serif; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
</tr>
<tr style="height: 30.0pt;">
<td style="width: 248pt; font-weight: bold; font-family: FZZhongKaiB-B08; text-align: left; vertical-align: middle;  color: black; font-size: 11pt; font-style: normal; border: none; white-space: nowrap;" colspan="3">Staf Administrasi Kepegawaian UVERS</td>
<td style="width: 86pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 70pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 72pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 63pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 92pt; font-weight: bold; font-family: FZZhongKaiB-B08; padding-top: 1px; padding-right: 1px; padding-left: 1px; color: black; font-size: 11pt; font-style: normal; vertical-align: bottom; border: none; white-space: nowrap;">&nbsp;</td>
<td style="width: 250pt; font-weight: bold; font-family: FZZhongKaiB-B08; text-align: left; vertical-align: middle; padding: 0px; color: black; font-size: 11pt; font-style: normal; border: none; white-space: nowrap;" colspan="3">Direktur Kepegawaian dan Kerjasama UVERS</td>
</tr>
</tbody>
</table>
    
</body>
</html>

@php
function singkatjur($prodi){

    switch ($prodi) {
        case 'Akuntansi':
            return 'AK';
            break;

        case 'Manajemen':
            return 'MN';
            break;

        case 'Seni Musik':
            return 'SM';
            break;

        case 'Seni Tari':
            return 'ST';
            break;

        case 'Pendidikan Bahasa Mandarin':
            return 'PBM';
            break;

        case 'Teknik Industri':
            return 'TI';
            break;

        case 'Teknik Lingkungan':
            return 'TL';
            break;

        case 'Sistem Informasi':
            return 'SI';
            break;

        case 'Teknik Informatika':
            return 'TI';
            break;

        case 'Teknik Perangkat Lunak':
            return 'TPL';
            break;

        
        default:
            return 'null';
            break;
    }

}


function tanggal_indo($tanggal) {
        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
    }
@endphp