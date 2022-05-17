@extends('admin.layout.master')

@section('content') 


<?php if(cek_akses('39') == 'yes'){
}else{ ?>
  <script type="text/javascript">history.back(alert("Anda Tidak Memiliki Akses"))</script>
<?php } ?> 
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


<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
  <!-- /.content-header -->

  <!-- Main content -->

  <section class="content">
    <div class="container-fluid">
    
        <!-- /.card-header -->
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
   
              <ol class="carousel-indicators" style="bottom: -25px;">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active" style="height: 7px; background-color: #1B83E4"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"  style="height: 7px;background-color: #1B83E4"></li>
              </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">

                  <div class="row">
                   <div class="col-lg-3 col-6">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          @php
                          $cekPegawai = DB::table('pegawai')->where('status_aktif','=','Aktif')->count();
                          @endphp

                          <h3>{{ $cekPegawai }}</h3>

                          <p>Karyawan Aktif</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ URL('/pegawai') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

                      </div>
                    </div>
                    <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        @php
                          $cekSrtTgsPegawai = DB::table('surat_tugas')->count();
                        @endphp
                        <h3>{{ $cekSrtTgsPegawai }}</h3>

                        <p>Surat Tugas Kepegawaian</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-envelope-square"></i>
                      </div>
                      <a href="{{ Route('UserIndex') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                        @php
                          $cekHonorarium = DB::table('a_berkas_scan_buff')->where('pilihan_print','=','0')->count();
                        @endphp
                        <h3>{{ $cekHonorarium }} <sup><code style="font-size: 20px; color: yellow;">baru</code></sup></h3>

                        <p>Honorarium @if($cekHonorarium > 0)(menunggu)@endif</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-money-bill-wave"></i>
                      </div>
                      <a href="{{ Route('index_honorarium') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
               
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                      <div class="inner">
                        @php
                          $cekHonorariumTotal = DB::table('a_berkas_scan_buff')->count();
                        @endphp
                        <h3>{{ $cekHonorariumTotal }} <sup><code style="font-size: 20px; color: yellow;">total</code></sup></h3>

                        <p>Total Honorarium</p>
                      </div>
                      <div class="icon">
                        <i class="fa fa-money-bill-wave"></i>
                      </div>
                      <a href="{{ Route('index_honorarium') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                </div>
              </div>

              <div class="carousel-item">

                  <div class="row">

                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                          <div class="inner">
                            @php
                            $cekSrtTgsakademik = DB::table('a_srt_tgs_pembimbing')->count();
                            @endphp

                            <h3>{{ $cekSrtTgsakademik }} </h3>

                            <p>Surat Tugas Magang/TA</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-users"></i>
                          </div>
                          <a href="{{ Route('IndexSuratTugasPembimbing') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

                        </div>
                      </div>

                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                          <div class="inner">
                            @php
                            $cekSrtTgsSelesai  = DB::table('a_surat_keterangan_selesai')->count();
                            @endphp

                            <h3>{{ $cekSrtTgsSelesai }} </h3>

                            <p>Surat Keterangan Selesai</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-users"></i>
                          </div>
                          <a href="{{ Route('IndexSuratTugasPembimbing') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

                        </div>
                      </div>

                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                          <div class="inner">
                            @php
                            $ceksrtundangan  = DB::table('a_srt_udg_penguji')->count();
                            @endphp

                            <h3>{{ $ceksrtundangan }} </h3>

                            <p>Surat Undangan Penguji</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-users"></i>
                          </div>
                          <a href="{{ Route('IndexSuratTugasPembimbing') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

                        </div>
                      </div>

                      <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                          <div class="inner">
                            @php
                            $cekUser = DB::table('users')->count();
                            @endphp

                            <h3>{{ $cekUser }}</h3>

                            <p>User Terdaftar</p>
                          </div>
                          <div class="icon">
                            <i class="fa fa-users"></i>
                          </div>
                          <a href="{{ Route('UserIndex') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>

                        </div>
                      </div>

                  </div>

              </div>
            </div>
        </div>
      </div>
 
  </section>


  <br>
  <br>


  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <!-- DONUT CHART -->
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Surat Undangan Penguji Prop & TA</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="donutChart" style=" height: 400px;max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
 

        <div class="col-md-6">
          <!-- DONUT CHART -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Surat Tugas Kepegawaian</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="donutChart2" style=" height: 400px;max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>
    </div>
  </section>




</div><!--/. container-fluid -->

@php
//CHART UNDANGAN PENGUJI PROPOSAL DAN TA
$cek = DB::table('a_srt_udg_penguji')
      ->join('a_prodi','a_prodi.id_prodi','=','a_srt_udg_penguji.id_prodi')
      ->select(DB::raw('count(*) as prodiCount, a_prodi.nama_prodi'))
      ->groupBy('a_prodi.nama_prodi')
      ->get();
foreach ($cek as $key => $bg) {
  $cekbg[] = [$bg->nama_prodi];
  $prodiCount[] = $bg->prodiCount; 
}
$jumlahProdi = count($cekbg);
echo "<script>
        var Prodi = ".json_encode($cekbg)."
        var ProdiCount = ".json_encode($prodiCount)."
        var jumlahProdi = ".$jumlahProdi."
      </script>";


//CHART UNTUK SURAT TUGAS KEPEGAWAIAN
$ceksrttgs = DB::table('surat_tugas')
      ->join('kategorisebagai','surat_tugas.kategori_fk','=','kategorisebagai.id_kategori')
      ->select(DB::raw('count(*) as kategoriCount, kategorisebagai.nama_kategori'))
      ->groupBy('kategorisebagai.nama_kategori')
      ->get();

foreach ($ceksrttgs as $vsrttgs) {
  $cekkatcount[] = $vsrttgs->kategoriCount;
  $namKat[] = $vsrttgs->nama_kategori;
}

$jumlahkategori = count($ceksrttgs);

echo "<script>
        var katCountjav = ".json_encode($cekkatcount)."
        var namkatjav = ".json_encode($namKat)."
        var jumlahkategori = ".$jumlahkategori."
      </script>";

@endphp



@endsection
@section('script')

<script src="{{ URL::asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
<script>

// Get context with jQuery - using jQuery's .get() method.
function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}


var Tes = [];


$.noConflict();
jQuery( document ).ready(function( $ ) {
  
  //-------------
  //- DONUT CHART - //SURAT UNDANGAN
  //-------------
  for (i = 0; i < jumlahProdi; i++){
    Tes.push(getRandomColor());
  }

  var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
  var donutData        = {
    labels: Prodi,
    datasets: [
      {
        data: ProdiCount,
        backgroundColor : Tes,
      }
    ]
  }
  var donutOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    title: {
            display: true,
            text: 'Jumlah Prodi Surat Undangan Penguji'
        },
    layout: {
            padding: {
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
            }
        },
    animation: {
            animateScale: true,
            animateRotate: true
        }
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  var donutChart = new Chart(donutChartCanvas, {
    type: 'doughnut',
    data: donutData,
    options: donutOptions  
  });



var Tes2 = [];

  //-------------
  //- DONUT CHART - //SURAT TUGAS KEPEGAWAIAN
  //-------------

  for (i = 0; i < jumlahkategori; i++){
    Tes2.push(getRandomColor());
  }

  var donutChartCanvas = $('#donutChart2').get(0).getContext('2d')
  var donutData        = {
    labels: namkatjav,
    datasets: [
      {
        data: katCountjav,
        backgroundColor : Tes2,
      }
    ]
  }
  var donutOptions     = {
    maintainAspectRatio : false,
    responsive : true,
    title: {
            display: true,
            text: 'Jumlah Kategori Setiap Surat Tugas'
        },
    layout: {
            padding: {
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
            }
        },
    animation: {
            animateScale: true,
            animateRotate: true
        }
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  var donutChart = new Chart(donutChartCanvas, {
    type: 'horizontalBar',
    data: donutData,
    options: donutOptions  
  })



  })
</script>

@endsection
