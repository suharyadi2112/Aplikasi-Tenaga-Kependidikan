
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
            <th>NO</th>
            <th>NAMA KARYAWAN</th>
            <th>TMK</th>
            <th>HAK CUTI</th>
            <th>CUTI BERSAMA</th>
            <th>SISA CUTI</th>
            <th>AMBIL CUTI PADA</th>
        </tr>
    </thead>
    @php $no = 1; @endphp
    @forelse($CekData as $Keyy => $VCuti)
    @php
    @endphp
    <tbody>
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $VCuti->nama_karyawan }}</td>
            <td nowrap>{{ $VCuti->tmk }}</td>
            <td>{{ $VCuti->hak_cuti }} Hari</td>
            <td>
              
              @php  

                $cekCutBer = DB::table('c_cuti_bersama')
                ->where('c_cuti_bersama.id_periode','=',$VCuti->id_kategori)
                ->count();

              @endphp
              {{ $cekCutBer }} Hari

            </td>
            <td>{{ $VCuti->sisa_cuti }} Hari</td>
            <td>
                
              @php  

                $DetCut = DB::table('c_detail_cuti')
                ->select('c_detail_cuti.ambil_cuti','c_detail_cuti.ket_cuti')
                ->where('c_detail_cuti.id_cuti','=',$VCuti->id_cuti)
                ->get();

                $JumHar = DB::table('c_detail_cuti')->where('c_detail_cuti.id_cuti','=',$VCuti->id_cuti)->count();

              @endphp
              {{ $JumHar }} Hari <br>
              @forelse($DetCut as $vDetCut)
                {{ $vDetCut->ambil_cuti }}<br>
              @empty
                -
              @endforelse

            </td>
        </tr>

    @php $no++; @endphp
    @empty
        <tr>
            <td colspan="7"><center>Tidak Ada Data</center></td>
        </tr>
    
    @endforelse
    @php
      $KetCutBer = DB::table('c_cuti_bersama')
                ->select('c_cuti_bersama.tanggal_cuti','c_cuti_bersama.ket_cuti_bersama')
                ->where('c_cuti_bersama.id_periode','=',$id_periode)
                ->get();
    @endphp
    <tr>
      <td colspan="7">
        <br>
      </td>
    </tr>
    <tr>
      <td colspan="7">
        <u><b>CUTI BERSAMA</b></u> <br>
        @forelse($KetCutBer as $VKetCut)
          {{ $VKetCut->tanggal_cuti}} | 
          {{ $VKetCut->ket_cuti_bersama }}<br>
        @empty
         -
        @endforelse

      </td>
    </tr>
    </tbody>
        
</table>

