
@php
//header("Content-type: application/vnd-ms-excel");
//header("Content-Disposition: attachment; filename=hasil.xls");

@endphp



<head>
    <meta charset="UTF-8">
</head>

<body onload="tablesToExcel(['tbl1','tbl2','tbl3','tbl4','tbl5','tbl6'], ['Data Diri','Sekolah Perguruan Tinggi','Sekolah Menengah Atas','Marital Pasangan','Marital Anak','Kontak Darurat'], 'DataPegawaiPenilaianKerja.xls', 'Excel')">
<table id="tbl1" class="table2excel" border="1">
    <thead>
        <tr>
            <th>Nama Lengkap</th>
            <th>Nama Mandarin</th>
            <th>Nomor Ktp</th>
            <th>Durasi KTP</th>
            <th>Nomor NPWP</th>
            <th>Provinsi Lahir</th>
            <th>Kota Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Gologan Darah</th>
            <th>Nomor Telepon</th>
            <th>Nomor Telepon 2</th>
            <th>Nomor Whatsapp</th>
            <th>E-mail</th>
            <th>Alamat Sekarang</th>
            <th>Status Tempat Tinggal</th>
            <th>Jenis Kelamin</th>
            <th>Status Marital</th>

            <th>Kecamatan Domisili</th>
            <th>Kelurahan Domisili</th>
            <th>No BPJS Kesehatan</th>
            <th>No BPJS Ketenagakerjaan</th>
            <th>RT Domisili</th>
            <th>RW Domisili</th>
            
            <th>Agama</th>
            <th>Suku</th>
            <th>Qiudao</th>
            <th>Jenis QiuDao</th>
            <th>Vegetarian</th>
            <th>Ikrar Tahun</th>
          {{--   <th>Pendidikan</th> --}}
        </tr>
    </thead>
    @forelse($DataDiri as $keyDdiri => $ShowDiri)
        <tr>
            <td>{{ $ShowDiri->nama_lengkap }}</td>
            <td>{{ $ShowDiri->nama_mandarin }}</td>
            <td>'{{ $ShowDiri->nomor_ktp }}</td> 
            <td>{{ $ShowDiri->durasi_ktp }}</td>
            <td>'{{ $ShowDiri->nomor_npwp }}</td>
            <td>{{ $ShowDiri->nama }}</td>
            <td>{{ $ShowDiri->nama_kab }}</td>
            <td>{{ $ShowDiri->tanggal_lahir }}</td>
            <td>{{ $ShowDiri->golongan_darah }}</td>
            <td>{{ $ShowDiri->nomor_telepon }}</td>
            <td>{{ $ShowDiri->nomor_telepon_2 }}</td>
            <td>{{ $ShowDiri->nomor_wa }}</td>
            <td>{{ $ShowDiri->email }}</td>
            <td>{{ $ShowDiri->alamat_sekarang }}</td>
            <td>{{ $ShowDiri->status_tempat_tinggal }}</td>
            <td>{{ $ShowDiri->jenis_kelamin }}</td>
            <td>{{ $ShowDiri->status_marital }}</td>

            <td>{{ $ShowDiri->no_bpjs_kesehatan }}</td>
            <td>{{ $ShowDiri->no_bpjs_ketenagakerjaan }}</td>
            <td>{{ $ShowDiri->rt_domisili }}</td>
            <td>{{ $ShowDiri->rw_domisili }}</td>
            <td>{{ $ShowDiri->kecamatan_domisili }}</td>
            <td>{{ $ShowDiri->kelurahan_domisili }}</td>

            <td>{{ $ShowDiri->agama }}</td>
            <td>{{ $ShowDiri->suku }}</td>
            <td>{{ $ShowDiri->qiudao }}</td>
            <td>{{ $ShowDiri->jenis_qiudao }}</td>
            <td>{{ $ShowDiri->vege }}</td>
            <td>{{ $ShowDiri->ikrartahun_vege }}</td>

          {{--   <td style="text-align:left;">
                    
                @php
                 $PerguruanTinggiDalam = DB::table('b_perguruan_tinggi')
                    ->select('*')
                    //->orderBy('id_perting','ASC')
                    ->where('id_user','=',$ShowDiri->id_user)
                    ->get();

                foreach ($PerguruanTinggiDalam as $keyPerting => $VaPerting) {
                @endphp

                    <table>
                        <thead>
                            <tr>
                                <th>tes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>tes 2</td>
                            </tr>
                        </tbody>
                    </table>

                @php 
                }
                @endphp

            </td> --}}
        </tr>

    @empty
        <tr>
            <td colspan="100">Tidak Ada Data</td>
        </tr>
    @endforelse
        
</table>

<table id="tbl2" class="table2excel" border="1" style="display: none;">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Nama Perguruan Tinggi</th>
            <th>Nama Prodi</th>
            <th>Tingkat</th>
            <th>IPK</th>
            <th>Mulai Pendidikan</th>
            <th>Selesai Pendidikan</th>
          
        </tr>
    </thead>
    @forelse($PerguruanTinggi as $keyPerting => $ShowPerting)
        <tr>
            <td>{{ $ShowPerting->nama_lengkap }}</td>
            <td>{{ $ShowPerting->nama_sekolah_perting }}</td>
            <td>{{ $ShowPerting->program_studi }}</td>
            <td>{{ $ShowPerting->tingkat }}</td>
            <td>{{ $ShowPerting->ipk }}</td>
            <td>{{ $ShowPerting->mulai_pendidikan }}</td>
            <td>{{ $ShowPerting->selesai_pendidikan }}</td>
           
        </tr>

    @empty
        <tr>
            <td colspan="100">Tidak Ada Data</td>
        </tr>
    @endforelse
        
</table>

<table id="tbl3" class="table2excel" border="1" style="display: none;">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Nama Sekolah</th>
            <th>Jurusan</th>
            <th>Mulai Pendidikan</th>
            <th>Selesai Pendidikan</th>
          
        </tr>
    </thead>
    @forelse($SmaSederajat as $keySma => $ShowSma)
        <tr>
            <td>{{ $ShowSma->nama_lengkap }}</td>
            <td>{{ $ShowSma->nama_sekolah }}</td>
            <td>{{ $ShowSma->jurusan }}</td>
            <td>{{ $ShowSma->mulai_pendidikan }}</td>
            <td>{{ $ShowSma->selesai_pendidikan }}</td>
         </tr>

    @empty
        <tr>
            <td colspan="100">Tidak Ada Data</td>
        </tr>
    @endforelse
        
</table>


<table id="tbl4" class="table2excel" border="1" style="display: none;">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Nama Pasangan</th>
            <th>Pekerjaan Pasangan</th>
            <th>Nomor Telepon Pasangan</th>
        </tr>
    </thead>
    @forelse($MaritalPasangan as $KeyMaritalPasangan => $ShowMarital)
        <tr>
            <td>{{ $ShowMarital->nama_lengkap }}</td>
            <td>{{ $ShowMarital->nama_pasangan }}</td>
            <td>{{ $ShowMarital->pekerjaan_pasangan }}</td>
            <td>{{ $ShowMarital->nomor_telepon_pasangan }}</td>
         </tr>

    @empty
        <tr>
            <td colspan="100">Tidak Ada Data</td>
        </tr>
    @endforelse
        
</table>

<table id="tbl5" class="table2excel" border="1" style="display: none;">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Nama Anak</th>
            <th>Tanggal Lahir Anak</th>
            <th>Jenis Kelamin</th>
        </tr>
    </thead>
    @forelse($Marital as $KeyMarital => $ShowMaritalAnak)
        <tr>
            <td>{{ $ShowMaritalAnak->nama_lengkap }}</td>
            <td>{{ $ShowMaritalAnak->nama_anak }}</td>
            <td>{{ $ShowMaritalAnak->ttl_anak }}</td>
            <td>{{ $ShowMaritalAnak->jenis_kelamin_anak }}</td>
         </tr>

    @empty
        <tr>
            <td colspan="100">Tidak Ada Data</td>
        </tr>
    @endforelse
        
</table>

<table id="tbl6" class="table2excel" border="1" style="display: none;">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Nama Kontak Darurat</th>
            <th>Hubungan</th>
            <th>Nomor Telepon</th>
            <th>Kota</th>
        </tr>
    </thead>
    @forelse($KontakDarurat as $KeyKD => $ShowKontakDarurat)
        <tr>
            <td>{{ $ShowKontakDarurat->nama_lengkap }}</td>
            <td>{{ $ShowKontakDarurat->nama_kd }}</td>
            <td>{{ $ShowKontakDarurat->hubungan_kd }}</td>
            <td>{{ $ShowKontakDarurat->nomor_telepon_kd }}</td>
            <td>{{ $ShowKontakDarurat->kota_kd }}</td>
         </tr>

    @empty
        <tr>
            <td colspan="100">Tidak Ada Data</td>
        </tr>
    @endforelse
        
</table>

{{-- 
<table id="tbl7" class="table2excel" border="1" style="display: none;">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Nama Jabatan</th>
            <th>Detail jabatan</th>
        </tr>
    </thead>
    @forelse($Jabatan as $KeyJabatan => $ShowJabatan)
        <tr>
            <td>{{ $ShowJabatan->nama_lengkap }}</td>
            <td>{{ $ShowJabatan->nama_jabatan }}</td>
            <td>{{ $ShowJabatan->nama_detail_jabatan }}</td>
         </tr>

    @empty
        <tr>
            <td colspan="100">Tidak Ada Data</td>
        </tr>
    @endforelse
        
</table> --}}
 
</body>



<script type="text/javascript">

    var tablesToExcel = (function () {
    var uri = 'data:application/vnd.ms-excel;base64,'
    , tmplWorkbookXML = '<?php echo '<?xml version="1.0"?><?mso-application progid="Excel.Sheet"?>'?><Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">'
      + '<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office"><Author>Axel Richter</Author><Created>{created}</Created></DocumentProperties>'
      + '<Styles>'
      + '<Style ss:ID="Currency"><NumberFormat ss:Format="Currency"></NumberFormat></Style>'
      + '<Style ss:ID="Date"><NumberFormat ss:Format="Medium Date"></NumberFormat></Style>'
      + '</Styles>' 
      + '{worksheets}</Workbook>'
    , tmplWorksheetXML = '<Worksheet ss:Name="{nameWS}"><Table>{rows}</Table></Worksheet>'
    , tmplCellXML = '<Cell{attributeStyleID}{attributeFormula}><Data ss:Type="{nameType}">{data}</Data></Cell>'
    , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
    return function(tables, wsnames, wbname, appname) {
      var ctx = "";
      var workbookXML = "";
      var worksheetsXML = "";
      var rowsXML = "";

      for (var i = 0; i < tables.length; i++) {
        if (!tables[i].nodeType) tables[i] = document.getElementById(tables[i]);
        for (var j = 0; j < tables[i].rows.length; j++) {
          rowsXML += '<Row>'
          for (var k = 0; k < tables[i].rows[j].cells.length; k++) {
            var dataType = tables[i].rows[j].cells[k].getAttribute("data-type");
            var dataStyle = tables[i].rows[j].cells[k].getAttribute("data-style");
            var dataValue = tables[i].rows[j].cells[k].getAttribute("data-value");
            dataValue = (dataValue)?dataValue:tables[i].rows[j].cells[k].innerHTML;
            var dataFormula = tables[i].rows[j].cells[k].getAttribute("data-formula");
            dataFormula = (dataFormula)?dataFormula:(appname=='Calc' && dataType=='DateTime')?dataValue:null;
            ctx = {  attributeStyleID: (dataStyle=='Currency' || dataStyle=='Date')?' ss:StyleID="'+dataStyle+'"':''
                   , nameType: (dataType=='Number' || dataType=='DateTime' || dataType=='Boolean' || dataType=='Error')?dataType:'String'
                   , data: (dataFormula)?'':dataValue
                   , attributeFormula: (dataFormula)?' ss:Formula="'+dataFormula+'"':''
                  };
            rowsXML += format(tmplCellXML, ctx);
          }
          rowsXML += '</Row>'
        }
        ctx = {rows: rowsXML, nameWS: wsnames[i] || 'Sheet' + i};
        worksheetsXML += format(tmplWorksheetXML, ctx);
        rowsXML = "";
      }

      ctx = {created: (new Date()).getTime(), worksheets: worksheetsXML};
      workbookXML = format(tmplWorkbookXML, ctx);



      var link = document.createElement("A");
      link.href = uri + base64(workbookXML);
      link.download = wbname || 'Workbook.xls';
      link.target = '_blank';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }
  })();

    if (tablesToExcel) {
       setTimeout(function() {
          window.location.href = "{{ Route('ToExcelDataPegawai') }}";
        }, 2000);
    }


</script>
