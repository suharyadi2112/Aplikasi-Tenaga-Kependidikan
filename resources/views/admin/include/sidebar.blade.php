
 <aside class="main-sidebar sidebar-dark-navy elevation-4">

    <!-- Brand Logo -->
    <a href="{{URL::to('dashboard')}}" class="brand-link">
      <img src="{{ URL::asset('admin/dist/img/logo2.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-4"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Kepegawaian Uvers</span>
    </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ URL::asset('admin/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
      </div>
       
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name  }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="true">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-header" style="padding: 0px;">UTAMA</li>
        <li class="nav-item has-treeview menu-open">
          <!--a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
              <i class="right fas fa-angle-left"></i>
            </p>
          </a-->
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{URL::to('dashboard')}}" class="nav-link">
                <i class="far fa fa-home nav-icon"></i>
                <p>Dashboard</p>
              </a>
            </li>
          </ul>
         
        </li>

        <li class="nav-header" style="padding: 0px;">KINERJA</li>
  
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="far fa fa-users nav-icon"></i>
            <p>
                Penilaian Kerja
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">



          <?php if(cek_akses('98') == 'yes'){ ?>
          <li class="nav-item">
            <a href="{{ Route('IndexAdminPen',['level' => '4']) }}" class="nav-link bg-info">
              <i class="far fa fa-user-tie nav-icon"></i>
              <p>
                Non Jabatan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ Route('IndexAdminPen',['level' => '14']) }}" class="nav-link bg-info">
              <i class="far fa fa-user-tie nav-icon"></i>
              <p>
                Semi Jabatan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ Route('IndexAdminPen',['level' => '10']) }}" class="nav-link bg-info">
              <i class="far fa fa-user-tie nav-icon"></i>
              <p>
                Dengan Jabatan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ Route('IndexAdminPen',['level' => '11']) }}" class="nav-link bg-info">
              <i class="far fa fa-user-tie nav-icon"></i>
              <p>
                Wakil Rektor
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ Route('IndexAdminPen',['level' => '12']) }}" class="nav-link bg-info">
              <i class="far fa fa-user-tie nav-icon"></i>
              <p>
                Rektor
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ Route('IndexAdminPen',['level' => '13']) }}" class="nav-link bg-info">
              <i class="far fa fa-user-tie nav-icon"></i>
              <p>
                Ketua Yayasan
              </p>
            </a>
          </li>
          <?php }else{ ?>
          
          <?php } ?>

        

          <li class="nav-item">
            <a href="{{ Route('add_datadiri') }}" class="nav-link">
              <i class="far fa fa-user-tie nav-icon"></i>
              <p>
                Penilaian Kerja
              </p>
            </a>
          </li>

          <?php if(cek_akses('97') == 'yes'){ ?>
            <li class="nav-item">
              <a href="{{Route('IndexPenilaianKerja')}}" class="nav-link">
                <i class="far fa fa-user nav-icon"></i>
                <p>
                  Data Diri
                </p>
              </a>
            </li>
          <?php }else{ ?>
              
          <?php } ?> 

          <?php if(cek_akses('99') == 'yes'){ ?>
          <li class="nav-item">
            <a href="{{ Route('ToExcelDataPegawai') }}" class="nav-link">
              <i class="far fa fa-file-excel nav-icon"></i>
              <p>
                ToExcel
              </p>
            </a>
          </li>
          <?php }else{ ?>
          
          <?php } ?>
        </ul>
      </li>
      
      

        <?php if(cek_akses('41') == 'yes'){ ?>
        <li class="nav-header" style="padding: 0px;">SURAT TUGAS</li>
          @if(Auth::user()->level != "2")
          <li class="nav-item">
            <a href="{{URL::to('surattugas')}}" class="nav-link">
              <i class="far fa fa-mail-bulk nav-icon"></i>
              <p>
                Surat Tugas Kepegawaian
              </p>
            </a>
          </li>
        @endif
        <?php }else{ ?>
          
        <?php } ?> 
      
        
        <?php if(cek_akses('50') == 'yes'){ ?>
        <li class="nav-header" style="padding: 0px;">HONOR</li>
          <li class="nav-item">
          <a href="{{URL::to('honorarium')}}" class="nav-link">
            <i class="far fa fa-money-bill-wave nav-icon"></i>
            <p>
              Honorarium
            </p>
          </a>
        </li>
        <?php }else{ ?>
          
        <?php } ?> 

        <?php if(cek_akses('100') == 'yes'){ ?>
        <li class="nav-header" style="padding: 0px;">CUTI</li>
          <li class="nav-item">
          <a href="{{URL::to('CutiPegawai')}}" class="nav-link">
            <i class="far fa fa-calendar-week nav-icon"></i>
            <p>
              Cuti Pegawai
            </p>
          </a>
        </li>
        <?php }else{ ?>
          
        <?php } ?> 

        @if(Auth::user()->level == "2")
        <li class="nav-header"style="padding: 0px;">SURAT TUGAS</li>
        <li class="nav-item">
          <a href="{{URL::to('lihatpengajuan')}}" class="nav-link">
            <i class="far fa fa-mail-bulk nav-icon"></i>
            <p>
              Pengajuan Surat Tugas
            </p> 
          </a>
        </li>
        
        @endif

        

        <?php if(cek_akses('54') == 'yes'){ ?>
        <li class="nav-header" style="padding: 0px;">TA DAN MAGANG</li>
          <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="far fa fa-mail-bulk nav-icon"></i>
            <p>
               Surat Tugas Akademik
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ Route('IndexSuratTugasPembimbing') }}" class="nav-link">
              <i class="far fa fa-circle nav-icon"></i>
              <p>
                Magang dan TA
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ Route('IndexSuratKeteranganSelesai') }}" class="nav-link">
              <i class="far fa fa-circle nav-icon"></i>
              <p>
                Surat Keterangan Selesai
              </p>
            </a>
          </li>
        </ul>
      </li>
      <?php }else{ ?>
          
      <?php } ?> 
       
      
      <?php if(cek_akses('65') == 'yes'){ ?>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="far fa fa-mail-bulk nav-icon"></i>
            <p>
               Undangan Akademik
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ Route('indexundangan') }}" class="nav-link">
              <i class="far fa fa-circle nav-icon"></i>
              <p>
                Undangan Penguji Prop & TA
              </p>
            </a>
         
          </li>
        </ul>
      </li>
      
      <?php }else{ ?>
          
      <?php } ?> 


      <!------------------------------------------ Menu BU FIFI ------------------------------------------------>

       
      <li class="nav-header" style="padding: 0px;">PENGATURAN</li>


    <li class="nav-item has-treeview">
      <a href="#" class="nav-link">
        <i class="nav-icon far fa fa-cogs"></i>
        <p>
          Setup
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">

      <?php if(cek_akses('46') == 'yes'){ ?>
          <li class="nav-item">
          <a href="{{URL::to('kategori')}}" class="nav-link">
            <i class="far fa fa-circle nav-icon"></i>
            <p>
              Kategori
            </p>
          </a>
        </li>
      <?php }else{ ?>
          
      <?php } ?> 
      
      <?php if(cek_akses('73') == 'yes'){ ?>

      <li class="nav-item">
        <a href="{{URL::to('user')}}" class="nav-link">
          <i class="far fa fa-user nav-icon"></i>
          <p>
            User
          </p>
        </a>
      </li>

      <?php }else{ ?>
          
      <?php } ?> 

    
      <?php if(cek_akses('78') == 'yes'){ ?>
        <li class="nav-item">
          <a href="{{URL::to('changePassword')}}" class="nav-link">
            <i class="far fa fa-key nav-icon"></i>
            <p>
              Ganti Password
            </p>
          </a>
        </li>
      <?php }else{ ?>
          
      <?php } ?> 

   


      <?php if(cek_akses('79') == 'yes'){ ?>
        <li class="nav-item">
          <a href="{{URL::to('pegawai')}}" class="nav-link">
            <i class="far fa fa-user-tag nav-icon"></i>
            <p>
              Pegawai
            </p>
          </a>
        </li>
      <?php }else{ ?>
          
      <?php } ?> 

      <?php if(cek_akses('1') == 'yes'){ ?>
        <li class="nav-item">
          <a href="{{ Route('index_hakakses') }}" class="nav-link">
            <i class="far fa fa-users-cog nav-icon"></i>
            <p>
              Setup Akses
            </p>
          </a>
        </li>
      <?php }else{ ?>
          
      <?php } ?> 

      <?php if(cek_akses('111') == 'yes'){ ?>
      <li class="nav-item">
      <a href="{{Route('indexAwal')}}" class="nav-link">
        <i class="far fa fa-calendar-alt nav-icon"></i>
        <p>
          Tahun Ajar
        </p>
      </a>
      </li>
      <?php }else{ ?>
          
      <?php } ?> 

        </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>