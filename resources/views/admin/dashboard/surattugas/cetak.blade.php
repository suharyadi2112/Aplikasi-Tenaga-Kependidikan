<style type="text/css">
    table { page-break-inside:auto}
    tr    { page-break-inside:avoid; page-break-after:auto}
    thead { display:table-header-group}
    tfoot { display:table-footer-group }
</style>

<!DOCTYPE html>
<html>
<input type="button" class="btn btn-success" onclick="printDiv('printableArea')" value="Print" />
<input type="button" class="btn btn-success" onclick="printDiv('printableArea2')" value="Print(English)" />
<!-- left column -->
<div id="printableArea">

<body style="margin: 50px">

<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center">
	<span style="font-size: 35.0pt; font-family: 'Schneidler Blk BT', serif;">SURAT TUGAS</span>
</p>

<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center">
	<span style="font-size: 11.0pt; font-family: Verdana, sans-serif;">No : </span>
	<span style="font-size: 11.0pt; font-family: Verdana, sans-serif;">{{ $a }}</span>
</p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">	<span style="font-size: 6.0pt; line-height: 150%; font-family: Verdana, sans-serif;">&nbsp;</span>
</p>

<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">Yang bertanda tangan di bawah ini, Rektor Universitas Universal memberikan tugas, wewenang, dan tanggung jawab kepada :</span>
</p>

<table class="MsoNormalTable" style="margin-left: 1.4pt; border-collapse: collapse; border: none; height: 53px;" border="1" width="100%" cellspacing="0" cellpadding="0">
	<tbody>
	<tr style="height: 16.65pt;">
		<td style="width: 50.2708px; border: 1pt solid windowtext; background: #d9d9d9; padding: 0in 5.4pt;">
			<p style="text-align: center; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center">
				<strong>
					<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">No</span>
				</strong>
			</p>
		</td>

		<td style="width: 265.938px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; background: #d9d9d9; padding: 0in 5.4pt;">

		<p style="text-align: center; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center">
			<strong>
				<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">Nama</span>
			</strong>
		</p>
		</td>

		<td style="width: 142.938px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; background: #d9d9d9; padding: 0in 5.4pt;">

			<p style="text-align: center; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center">
				<strong>
					<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">
							
						<?php echo $c ?>

					</span>
				</strong>
			</p>
		</td>

		<td style="width: 300.271px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; background: #d9d9d9; padding: 0in 5.4pt;">

			<p style="text-align: center; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center">
				<strong>
					<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">Jabatan</span>
				</strong>
			</p>
		</td>
	</tr>
<?php $i=1 ?>
@forelse($peserta as $datapeserta => $value)

	<tr style="height: 20.8pt;">

		<td style="width: 46.2708px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0in 5.4pt;">
		<p style="text-align: center; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">{{ $datapeserta + 1 }}</span></p>
		</td>
		<td style="width: 260.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0in 5.4pt;" nowrap="">
		<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 9.0pt; font-family: Verdana, sans-serif; color: #222222;">{{ $value->nama_karyawan }}</span></p>
		</td>

		<?php if (($c == "nip") || ($c == "NIP")) { ?>

			<?php if ($value->nipp == null) { ?>
				<td style="width: 142.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0in 5.4pt;">
				<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; font-family: Verdana, sans-serif;">-</span></p>
				</td>
			<?php }else{ ?>

				<td style="width: 142.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0in 5.4pt;">
				<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; font-family: Verdana, sans-serif;">{{ $value->nipp }}</span></p>
				</td>

			<?php } ?>
			
		<?php }elseif (($c == "nidn") || ($c == "NIDN")) { ?>

			<?php if ($value->nidnp == null) { ?>
				<td style="width: 142.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0in 5.4pt;">
				<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; font-family: Verdana, sans-serif;">-</span></p>
				</td>
			<?php }else{ ?>
				<td style="width: 142.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0in 5.4pt;">
				<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; font-family: Verdana, sans-serif;">{{ $value->nidnp }}</span></p>
				</td>
			<?php } ?>
			
		<?php }else{
			echo "<td>terjadi kesalahan</td>";
		} ?>
		

		<td style="width: 300.271px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0in 5.4pt;">
		<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; font-family: Verdana, sans-serif; color: black;">{{ $value->nama_jabatanp }}</span></p>
		</td>

	</tr>
	@empty
    <tr>
      <td colspan="10"><center>Tidak Ada Data Peserta</center></td>
    </tr>
<?php $i++; ?>
@endforelse
	
	</tbody>
</table>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 9.0pt; line-height: 150%; font-family: Verdana, sans-serif;">&nbsp;</span>
</p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">Untuk melaksanakan tugas <?php echo $b ?> sebagai <?php echo $nama_kategori ?> <?php echo $kategori_tambahan ?></span>

	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">pada kegiatan</span>
	
	<strong>
		<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">&rdquo;<?php echo $nama_kegiatan ?>&rdquo;</span>
	</strong>
	
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;"> yang diselenggarakan oleh <strong><?php echo $penyelengara ?></strong></span>

	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">dengan waktu kegiatan pada hari</span>
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;"> <?php echo $hari ?>,</span> 

	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">

		<?php echo $tanggal_mulai ?><?php echo $satutanggal ?><?php if(empty($satutanggal) != true && (empty($jam_mulai && $jam_selesai) == true )){echo ",";} ?>

	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">

	<?php if (empty($satutanggal == false)) { ?>
	<?php }else{ ?>
		s.d.
	<?php } ?>
	
	</span>

	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">
		<?php 
		if ($hari_selesai != null) {
			echo $hari_selesai;
			echo ","; 
		}
		?>
		<?php echo $tanggal_selesai ?>
		<?php if(empty($tanggal_mulai && $tanggal_selesai) != true && (empty($jam_mulai && $jam_selesai)) == true){echo ",";} ?>
	</span> 
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">
		<?php if (($jam_mulai && $jam_selesai) == null || empty($jam_mulai && $jam_selesai)) { ?>

		<?php }elseif (($jam_mulai == "00:00") == false && ($jam_selesai == "00:00") == true){ ?>
			pukul <?php echo $jam_mulai ?> WIB s.d. selesai, 
		<?php }else{ ?>
			pukul <?php echo $jam_mulai ?> WIB s.d. <?php echo $jam_selesai ?> WIB, 
		<?php } ?>
	</span>
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">{{$posisi}} </span>
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;"><?php echo $lokasi ?>.</span>
</p>



<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">&nbsp;</span>
</p>
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
<span style="font-size: 10.0pt; line-height: 200%; font-family: Verdana, sans-serif;">Mengingat pentingnya tugas tersebut maka hendaklah dilaksanakan dengan sebaik-baiknya, jujur, sepenuh hati, dan penuh rasa tanggung jawab agar mendapatkan hasil yang semaksimal mungkin. 
	Pegawai yang ditugaskan wajib membuat pelaporan proses dan hasil kegiatan yang diikuti setelah kembali dari pelaksanaan tugas.
</span>
</p>

<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">&nbsp;</span>
</p>
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; line-height: 200%; font-family: Verdana, sans-serif;">Surat tugas ini berlaku sejak tanggal ditetapkan dan berakhir bersamaan dengan berakhirnya kegiatan yang ditugaskan. Bilamana terdapat kekeliruan dalam surat tugas ini akan dilakukan perbaikan sebagaimana mestinya. 
	</span>
</p>
<br>

<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
	<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
	<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>

	<strong>
		<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">Batam, {{ $tanggal_acc }}</span>
	</strong>
</p>

<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif; line-height: 150%;" ><strong><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></strong><strong><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  Rektor Universitas Universal</span></strong>
</p>

<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;</span></p>


<?php if ($ttd == 1) { ?>
	
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
	<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
	<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>

		<img src="{{ URL::asset('admin/dist/img/ttd2.png') }}" style="width: 200px" />
	
</p>
<?php }else{ ?>

<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;</span></p>

<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;</span></p>

<p style="margin: 0in 0in 0.0001pt 4.25in; text-align: justify; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;</span></p>

<?php } ?>

<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
	<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
	<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>

	<u>
		<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">Dr. Kisdarjono</span>
	</u>
</p>

<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>

<?php for ($x = 1; $x <= $jumlahloop; $x++) { ?>
	<br>
<?php } ?>

<table cellspacing="0" cellpadding="0" align="left">
<tbody>

<tr>
<td>&nbsp;</td>
<td style="border: 2.0pt solid black; vertical-align: top; background: white;" bgcolor="white">
<table cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<div class="shape" style="padding: 5.6pt 9.2pt 5.6pt 9.2pt;">
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 8pt; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">Pegawai yang ditugaskan di atas telah datang pada saya untuk keperluan dinas sesuai yang dituliskan di atas pada tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></p>
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 8pt; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">Dan kembali pada tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></p>
<p style="text-align: justify; margin: 0in 0in 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;">&nbsp;</p>
<p style="text-align: justify; margin: 0in 0in 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
<p style="text-align: justify; margin: 0in 0in 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10.0pt; line-height: 0%; font-family: Verdana, sans-serif;">Pejabat yang berwenang</span></p>

</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>


</body>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<hr>
<br>
<br>
<br>


<!-------------------------------b.ingriss------------------------------------>
<!-------------------------------b.ingriss------------------------------------>
<!-------------------------------b.ingriss------------------------------------>


<!-- left column -->
<div id="printableArea2">

<body style="margin: 50px">

<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center">
	<span style="font-size: 35.0pt; font-family: 'Schneidler Blk BT', serif;">LETTER OF ASSIGNMENT</span>
</p>

<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center">
	<span style="font-size: 11.0pt; font-family: Verdana, sans-serif;">No : </span>
	<span style="font-size: 11.0pt; font-family: Verdana, sans-serif;">{{ $a }}</span>
</p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">	<span style="font-size: 6.0pt; line-height: 150%; font-family: Verdana, sans-serif;">&nbsp;</span>
</p>

<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">The undersigned, the Rector of Universal University provides the duty, authority and responsibility to :</span>
</p>

<table class="MsoNormalTable" style="margin-left: 1.4pt; border-collapse: collapse; border: none; height: 53px;" border="1" width="100%" cellspacing="0" cellpadding="0">
	<tbody>
	<tr style="height: 16.65pt;">
		<td style="width: 50.2708px; border: 1pt solid windowtext; background: #d9d9d9; padding: 0in 5.4pt;">
			<p style="text-align: center; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center">
				<strong>
					<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">No</span>
				</strong>
			</p>
		</td>

		<td style="width: 265.938px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; background: #d9d9d9; padding: 0in 5.4pt;">

		<p style="text-align: center; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center">
			<strong>
				<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">Name</span>
			</strong>
		</p>
		</td>

		<td style="width: 142.938px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; background: #d9d9d9; padding: 0in 5.4pt;">

			<p style="text-align: center; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center">
				<strong>
					<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">
							
						Lecturer ID

					</span>
				</strong>
			</p>
		</td>

		<td style="width: 300.271px; border-top: 1pt solid windowtext; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-image: initial; border-left: none; background: #d9d9d9; padding: 0in 5.4pt;">

			<p style="text-align: center; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center">
				<strong>
					<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">Position</span>
				</strong>
			</p>
		</td>
	</tr>
<?php $i=1 ?>
@forelse($peserta as $datapeserta => $value)

	<tr style="height: 20.8pt;">

		<td style="width: 46.2708px; border-right: 1pt solid windowtext; border-bottom: 1pt solid windowtext; border-left: 1pt solid windowtext; border-image: initial; border-top: none; padding: 0in 5.4pt;">
		<p style="text-align: center; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">{{ $datapeserta + 1 }}</span></p>
		</td>
		<td style="width: 260.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0in 5.4pt;">
		<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 9.0pt; font-family: Verdana, sans-serif; color: #222222;">{{ $value->nama_karyawan }}</span></p>
		</td>
		<td style="width: 142.938px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0in 5.4pt;">
		<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; font-family: Verdana, sans-serif;">{{ $value->nipp }}</span></p>
		</td>
		<td style="width: 300.271px; border-top: none; border-left: none; border-bottom: 1pt solid windowtext; border-right: 1pt solid windowtext; padding: 0in 5.4pt;">
		<p style="text-align: center; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;" align="center"><span style="font-size: 9.0pt; font-family: Verdana, sans-serif; color: black;">{{ $value->nama_jabatanp }}</span></p>
		</td>

	</tr>
	@empty
    <tr>
      <td colspan="10"><center>Tidak Ada Data Peserta</center></td>
    </tr>
<?php $i++; ?>
@endforelse
	
	</tbody>
</table>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 9.0pt; line-height: 150%; font-family: Verdana, sans-serif;">&nbsp;</span>
</p>


<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">to attend the {{ $b }}</span>
	
	<strong>
		<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">&rdquo;{{ $nama_kegiatan }}&rdquo; </span>
	</strong>

	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">as {{ $nama_kategori }}.</span>
	
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">Starting on</span>
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;"> {{ $hari_ing }},</span> 

	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">

		<?php echo $tanggal_mulai_ing ?>{{ $satutanggal }}<?php if(empty($satutanggal) != true && (empty($jam_mulai && $jam_selesai) == true )){echo ",";} ?>

	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">

	<?php if (empty($satutanggal == false)) { ?>
	<?php }else{ ?>
		to
	<?php } ?>
	
	</span>

	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">
		<?php echo $tanggal_selesai_ing ?><?php if(empty($tanggal_mulai_ing && $tanggal_selesai_ing) != true && (empty($jam_mulai && $jam_selesai)) == true){echo ",";} ?>
	</span> 
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">
		<?php if (($jam_mulai && $jam_selesai) == null || empty($jam_mulai && $jam_selesai)) { ?>

		<?php }else{ ?>
			 {{ $jam_mulai }} to {{ $jam_selesai }}, 
		<?php } ?>
	</span>

	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">will be held by </span>
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">
	<strong>{{ $penyelengara }}</strong>
	</span>

	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">in </span>
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">{{ $lokasi }}</span>
</p>



<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">&nbsp;</span>
</p>
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">Given the importance of the task should be done with the best, honest, wholehearted, and full of responsibility in order to get the maximum possible results. The assigned employee is obligated to make report of the process and results of the activities followed after returning from the execution of the task.
</span>
</p>

<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">&nbsp;</span>
</p>
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">This assignment letter is valid from the date of stipulation and ends with the end of the assigned activity.
	</span>
</p>
<br>
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></strong><strong><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Batam, <?php echo $tanggal_acc_ing ?></span></strong>
</p>

<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><strong><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></strong><strong><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Rector of Universal University </span></strong>
</p>

<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;</span></p>
<p style="text-align: justify; margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt 4.25in; text-align: justify; font-size: 12pt; font-family: 'Times New Roman', serif;"><span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;</span></p>
<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">
	<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
	<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
	<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
	<u>
		<span style="font-size: 10.0pt; font-family: Verdana, sans-serif;">Dr. Kisdarjono</span>
	</u>
</p>

<p style="margin: 0in 0in 0.0001pt; font-size: 12pt; font-family: 'Times New Roman', serif;">&nbsp;</p>



<table cellspacing="0" cellpadding="0" align="left">
<tbody>

<tr>
<td>&nbsp;</td>
<td style="border: 2.0pt solid black; vertical-align: top; background: white;" bgcolor="white">
<table cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td>
<div class="shape" style="padding: 5.6pt 9.2pt 5.6pt 9.2pt;">
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 8pt; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">The officer assigned above has come to me for official purposes as mentioned above Starting date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></p>
<p style="text-align: justify; line-height: 150%; margin: 0in 0in 8pt; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10.0pt; line-height: 150%; font-family: Verdana, sans-serif;">And return on date&nbsp;&nbsp; : &hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;</span></p>
<p style="text-align: justify; margin: 0in 0in 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;">&nbsp;</p>
<p style="text-align: justify; margin: 0in 0in 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;">&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.</p>
<p style="text-align: justify; margin: 0in 0in 8pt; line-height: 107%; font-size: 11pt; font-family: Calibri, sans-serif;"><span style="font-size: 10.0pt; line-height: 0%; font-family: Verdana, sans-serif;">Authorized official/Organizer</span></p>

</div>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>


</body>
</div>




</html>

<script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
