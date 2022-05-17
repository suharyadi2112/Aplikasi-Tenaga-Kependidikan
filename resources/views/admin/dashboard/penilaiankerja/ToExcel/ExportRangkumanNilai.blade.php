
@php
//header("Content-type: application/vnd-ms-excel");
//header("Content-Disposition: attachment; filename=hasil.xls");
@endphp

<head>
    <meta charset="UTF-8">
</head>

<table id="tbl1" class="table2excel" border="1">
    <thead>
        <tr>
          <th rowspan="3">No</th>
          <th rowspan="3">BAG</th>
          <th rowspan="3">NAMA</th>
          <th rowspan="3">JABATAN</th>
          
          <th colspan="4">RERATA NILAI</th>
        </tr>
        <tr>
          <th colspan="4">FORM A (ASPEK TEKNIS)</th>
        </tr>
        <tr>
          <th>ATASAN</th>
          <th>BOBOT</th>
          <th>DIRI SENDIRI</th> 
          <th>BOBOT</th>
        </tr>
    </thead>
    @forelse($NamaPegawai as $KeyNP => $ShowSNP)
        <tr> 
            <td>{{ $KeyNP + 1 }}</td>
            <td nowrap="">{{ $ShowSNP->kategori }}</td>
            <td>{{ $ShowSNP->nama_lengkap }}</td>
            <td>{{ $ShowSNP->nama_jabatan }}</td>

            <!--FORM A-->
            <td>Atasan</td>
            <td>15%</td>
            <td>Dirisendiri</td>
            <td>5%</td>
            <!--FORM A-->

        </tr>

    @empty
        <tr>
            <td colspan="100">Tidak Ada Data</td>
        </tr>
    @endforelse
        
</table>


<!--button class="big-button" onclick="tablesToExcel(['tbl1'], ['Data Diri'], 'NilaiPegawai.xls', 'Excel')">Export Nilai to Excel</button-->
 

<style type="text/css">
    :root {
  --backgroundColor: rgba(246, 241, 209);
  --colorShadeA: rgb(106, 163, 137);
  --colorShadeB: rgb(121, 186, 156);
  --colorShadeC: rgb(150, 232, 195);
  --colorShadeD: rgb(187, 232, 211);
  --colorShadeE: rgb(205, 255, 232);
}

@import url("https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700");
* {
  box-sizing: border-box;
}
*::before, *::after {
  box-sizing: border-box;
}
body {
  font-family: 'OpenSans', sans-serif;
  font-size: 1rem;
  line-height: 2;
  display: flex;
          align-items: center;
          justify-content: center;
  margin: 0;
  min-height: 100vh;
  background: var(--backgroundColor);
}
button {
  position: relative;
  display: inline-block;
  cursor: pointer;
  outline: none;
  border: 0;
  vertical-align: middle;
  text-decoration: none;
  font-size: 1.5rem;
    color:var(--colorShadeA);
  font-weight: 700;
  text-transform: uppercase;
  font-family: inherit;
}

button.big-button {
   padding: 1em 2em;
   border: 2px solid var(--colorShadeA);
  border-radius: 1em;
  background: var(--colorShadeE);
transform-style: preserve-3d;
   transition: all 175ms cubic-bezier(0, 0, 1, 1);
}
button.big-button::before {
  position: absolute;
  content: '';
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: var(--colorShadeC);
  border-radius: inherit;
    box-shadow: 0 0 0 2px var(--colorShadeB), 0 0.75em 0 0 var(--colorShadeA);
 transform: translate3d(0, 0.75em, -1em);
     transition: all 175ms cubic-bezier(0, 0, 1, 1);
}


button.big-button:hover {
  background: var(--colorShadeD);
  transform: translate(0, 0.375em);
}

button.big-button:hover::before {
  transform: translate3d(0, 0.75em, -1em);
}

button.big-button:active {
            transform: translate(0em, 0.75em);
}

button.big-button:active::before {
  transform: translate3d(0, 0, -1em);
  
      box-shadow: 0 0 0 2px var(--colorShadeB), 0 0.25em 0 0 var(--colorShadeB);

}
</style>

<script type="text/javascript">
    var tablesToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,'
    , tmplWorkbookXML = '<?xml version="1.0"?><?mso-application progid="Excel.Sheet"?><Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">'
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
</script>