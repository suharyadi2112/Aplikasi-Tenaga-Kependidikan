
@php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=hasil.xls");
@endphp

<head>
    <meta charset="UTF-8">
</head>

@if($jenis_mk == 'magang')
<table id="tbl1" class="table2excel" border="1">
    <thead>
        <tr> 
            <th>No</th>
            <th>Nim</th>
            <th>Nama Mhs</th>
            <th>Prodi</th>
            <th>Nama MK</th>
            <th>Judul</th>
            <th>Tempat</th>
            <th>Mulai</th>
            <th>Selesai</th>
            <th>Dosen Pembimbing</th>
            <th>NIDN</th>
            <th>Nomor Surat</th>
        </tr>
    </thead>
    @php $no = 1; @endphp
    @forelse($CekSks as $KeySks => $Vsks)
    @php
    @endphp
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $Vsks->nim }}</td>
            <td>{{ $Vsks->nama }}</td>
            <td>{{ $Vsks->nama_prodi }}</td>
            <td>{{ $Vsks->nama_mk }}</td>
            <td>{!! $Vsks->judul !!}</td>
            <td>{{ $Vsks->lokasi }}</td>
            <td>{{ $Vsks->mulai }}</td>
            <td>{{ $Vsks->selesai }}</td>
            <td>{{ $Vsks->nama_karyawan }}</td>
            <td>{{ $Vsks->nidn }}</td>
            <td>{{ $Vsks->no_surat }}</td>
        </tr>
    @php $no++; @endphp
    @empty
        <tr>
            <td colspan="100">Tidak Ada Data</td>
        </tr>
    
    @endforelse
        
</table>


@else
<table id="tbl1" class="table2excel" border="1">
    <thead>
        <tr> 
            <th>No</th>
            <th>Nim</th>
            <th>Nama Mhs</th>
            <th>Prodi</th>
            <th>Judul</th>
            <th>Dos Pem 1</th>
            <th>Dos Pem 2</th>
            <th>Dos Pem 3</th>
            <th>Penguji 1</th>
            <th>Penguji 2</th>
            <th>Penguji 3</th>
        </tr>
    </thead>
    @php $no = 1; @endphp
    @forelse($CekSks as $KeySks => $Vsks)
    @php
    @endphp
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $Vsks->nim }}</td>
            <td>{{ $Vsks->nama }}</td>
            <td>{{ $Vsks->nama_prodi }}</td>
            <td>{!! $Vsks->judul !!}</td>
            @php
            $pem =  DB::table('a_sks_dp')
                    ->join('pegawai','pegawai.id_pegawai','=','a_sks_dp.id_dosen')
                    ->select('pegawai.nama_karyawan','a_sks_dp.surat_tugas')
                    ->orderBy('a_sks_dp.id','ASC')
                    ->where('a_sks_dp.id_sks_selesai','=', $Vsks->id_sks)->get();

            $pem2 =  DB::table('a_sks_dp')->select('surat_tugas')->where('id_sks_selesai','=', $Vsks->id_sks)->first();

            $penguji =  DB::table('a_srt_tgs_pembimbing')
                      ->join('a_udg_dp','a_udg_dp.id_udg','=','a_srt_tgs_pembimbing.id_udg')
                      ->join('pegawai','pegawai.id_pegawai','=','a_udg_dp.id_dosen')
                      ->select('pegawai.nama_karyawan')
                      ->orderBy('a_udg_dp.id','ASC')
                      ->where([['a_srt_tgs_pembimbing.id','=', $pem2->surat_tugas],['kategori_dosen','=','Penguji']])->get();

            @endphp

            @if(count($pem) == '2')
              @foreach($pem as $cPem)
                <td>
                  {{ $cPem->nama_karyawan }}
                </td>
              @endforeach
              <td></td>
            @elseif( count($pem) == '1')
              @foreach($pem as $cPem)
                <td>
                  {{ $cPem->nama_karyawan }}
                </td>
              @endforeach
                <td></td>
                <td></td>
            @elseif(count($pem) == '3')
             @foreach($pem as $cPem)
                <td>
                  {{ $cPem->nama_karyawan }}
                </td>
              @endforeach
            @else
            @endif

            @if(count($penguji) == '2')
              @foreach($penguji as $Vpeng)
                <td>
                  {{ $Vpeng->nama_karyawan }}
                </td>
              @endforeach
              <td></td>
            @elseif( count($penguji) == '1')
              @foreach($penguji as $Vpeng)
                <td>
                  {{ $Vpeng->nama_karyawan }}
                </td>
              @endforeach
                <td></td>
                <td></td>
            @elseif(count($penguji) == '3')
             @foreach($penguji as $Vpeng)
                <td>
                  {{ $Vpeng->nama_karyawan }}
                </td>
              @endforeach
            @else
              <td></td>
              <td></td>
              <td></td>
            @endif

        </tr>
    @php $no++; @endphp
    @empty
        <tr>
            <td colspan="100">Tidak Ada Data</td>
        </tr>
    
    @endforelse
        
</table>
@endif

