
@php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=hasil.xls");
@endphp

<head>
    <meta charset="UTF-8">
</head>

<table id="tbl1" class="table2excel" border="1">
    <thead>
        <tr> 
            <th>No</th>
            <th>No Surat</th>
            <th>Kategori</th>
            <th>Nama Kegiatan</th>
            <th>Penyelenggara</th>
            <th>Lokasi</th>
            <th>Tanggal ACC</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Selesai</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Peserta</th>
        </tr>
    </thead>
    @php $no = 1; @endphp
    @forelse($CekData as $Keyf => $SrtTgs)
    @php
    @endphp
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $SrtTgs->nomor_surat }}</td>
            <td>{{ $SrtTgs->nama_kategori }}</td>
            <td>{{ $SrtTgs->nama_kegiatan }}</td>
            <td>{{ $SrtTgs->penyelengara }}</td>
            <td>{{ $SrtTgs->lokasi }}</td>
            <td>{{ $SrtTgs->tanggal_acc }}</td>
            <td>{{ $SrtTgs->tanggal_kegiatan_mulai }}</td>
            <td>{{ $SrtTgs->tanggal_kegiatan_selesai }}</td>
            <td>{{ $SrtTgs->jam_kegiatan_mulai }}</td>
            <td>{{ $SrtTgs->jam_kegiatan_selesai }}</td>
            <td>
            	@php
            	$cekPeg = DB::table('peserta')
	            		->join('pegawai','pegawai.id_pegawai','=','peserta.id_pegawaip_fk')
	            		->select('peserta.nidnp','peserta.nama_jabatanp','peserta.nipp','pegawai.nama_karyawan')
	            		->where('id_surattugas_fk','=',$SrtTgs->id_surattugas)
	            		->get();
	           	$ni = 1;
	            foreach($cekPeg as $keyrr => $Vpeg){
	            	echo $ni.'.'.$Vpeg->nama_karyawan.'<br>';
	            $ni++;
	            }

            	@endphp
            </td>
        </tr>
    @php $no++; @endphp
    @empty
        <tr>
            <td colspan="100">Tidak Ada Data</td>
        </tr>
    
    @endforelse
        
</table>


