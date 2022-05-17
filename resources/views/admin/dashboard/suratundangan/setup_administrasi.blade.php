<!-------------------------------Cetak Setup Surat undangan------------------------------------->

@extends('admin.layout.master')
@section('content')

<br>
<?php if(cek_akses('69') == 'yes'){
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
<div class="container-fluid"> 
    <div class="row">
      <div class="col-12">

      	@if (session('gagal'))
      	<div class="alert alert-dismissible alert-danger fade show" role="alert">
		  <strong>Terjadi Kesalahan! </strong>{{ session('gagal') }}
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		@endif

		@php
        $thnajar =  DB::table('tahun_ajar')->select('tahun_ajar')->groupBy('tahun_ajar')->where('status','=','1')->get();
        $semester =  DB::table('tahun_ajar')->select('semester')->groupBy('semester')->where('status','=','1')->get();
		@endphp

        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Setup Cetak Berkas Administrasi</h3>
          </div>

          <div class="card-body">
		  <h3>{{$nama_prodi}} <b>|</b> <small><u>{{$nm_berkas}}</u></small></h3>
          	<hr>
		      <form action="{{ route('setupcetak.administrasi') }}" role="form" method="POST" accept-charset="utf-8" target="_blank">
		      @csrf
		      <input type="hidden" name="id_undangan"  value="{{$id}}" readonly="" />

				  @if ($id_berkas_adm == 26 || $id_berkas_adm == 10 || $id_berkas_adm == 11 || $id_berkas_adm == 12 || $id_berkas_adm == 13 || $id_berkas_adm == 14 || $id_berkas_adm == 15 || $id_berkas_adm == 16 || $id_berkas_adm == 17)
				  <div class="form-group">
						<label for="label">Tahun Ajar</label>
						<select class="form-control" name="tahun_ajar" required>
							@foreach($thnajar as $htj)
								<option value="{{ $htj->tahun_ajar }}">{{ $htj->tahun_ajar }}</option>
							@endforeach
						</select>
				  </div>
				  <div class="form-group">
					<label for="label">Semester</label>
					<select class="form-control" name="semester" required>
						@foreach($semester as $htdj)
								<option value="{{ $htdj->semester }}">{{ $htdj->semester }}</option>
						@endforeach
					</select>
			  </div>
				  <div class="form-group">
						<div class="alert alert-dismissible fade show" role="alert" style="background: #d5c617b0">
							<b>Beberapa berkas membutuhkan masukan tahun ajar dan jenis semester !</b>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						</div>
				  </div>
				
				  
				<hr>
				  
				@endif

		      @forelse($kode_prodi as $key => $show_kodeprodi )
		      <div class="form-group">

				
		        	
		      	@if($key == '2112')
		      		
		      		<script>alert('Terjadi Kesalahan Harap Hubungi Admin'); window.location = "{{URL::to('/index_undangan')}}";</script>";
		      		
		      	@else
			      	<div class="form-group clearfix">
	                  <div class="icheck-primary d-inline">
						<input type="checkbox" id="checkboxPrimary{{$key}}" name="pilihan_jenis[]" value="{{$key}}" 
						
						@if ($id_berkas_adm == 12 && $key == 'd') 
							
						@elseif($id_berkas_adm == 12 && $key == 'g') 

						@else checked @endif>

	                    <label for="checkboxPrimary{{$key}}">
							{{strtoupper($show_kodeprodi)}}
								@if ($id_berkas_adm == 12 && $key == 'd')
									<span class="badge badge-pill badge-warning">Lembar penilaian tugas akhir terpisah, button cetak penilaian tugas akhir akan muncul dibagian bawah setelah centang</span><div class="spinner-grow spinner-grow-sm text-info" role="status">
										<span class="sr-only">Loading...</span>
									  </div>
								@endif
	                    </label>
					  </div>
					   
					</div>
					
                @endif

		      </div>

		      @empty
                Tidak Ada Data Apapun
			  @endforelse
			  
				<div class="alert alert-dismissible fade show" role="alert" style="background: #d5c617b0">
				  <strong>Centang</strong> jika diperlukan, pilihan dengan <strong>Un-centang</strong> tidak akan tampil saat akan diprint
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
              <hr>

				<div class="card-footer bg-white" style="float: left; padding: 0px;">
					<a href="{{ Route('indexundangan') }}" title="Cancel">
						<span class="btn btn-danger"><i class="fa fa-long-arrow-alt-left"> </i> Back</span>
					</a>  | 
					<button type="submit" id="beteen1" class="btn btn-primary"><span class="fa fa-print"></span> Cetak Berkas Administrasi</button> | 
				</div>
		      </form>
			
			<!---------------Cek Penilaian Ujian Pertunjukan dan Sidang Tugas Akhir dari seni musik---------------->
			<div class="cekpen" style="display: none">
			  <div class="form-group clearfix">
					@if ($id_berkas_adm == 12)
					<form method="POST" action="{{ Route('setupcetak.administrasi')}}" target="_blank"> 
						@csrf
						<input type="hidden" name="id_undangan" value="{{$id}}">
						<input type="hidden" name="jenis" value="clp_sm">
						<button type="submit" class="cekke btn btn-outline-info no-print">Cetak Lembar Penilaian Versi 1</button>
					</form>
					@endif
				</div>
			</div>

			<div class="cekpen_versi2" style="display: none">
			  <div class="form-group clearfix">
					@if ($id_berkas_adm == 12)
					<form method="POST" action="{{ Route('setupcetak.administrasi')}}" target="_blank"> 
						@csrf
						<input type="hidden" name="id_undangan" value="{{$id}}">
						<input type="hidden" name="jenis" value="clp_v_2_sm">
						<button type="submit" class="cekke btn btn-outline-info no-print">Cetak Lembar Penilaian Versi 2</button>
					</form>
					@endif
				</div>
			</div>
			<!---------------Cek Penilaian Ujian Pertunjukan dan Sidang Tugas Akhir dari seni musik-------------- -->

	    </div>
	  </div>
	</div>
  </div>
</div>


@endsection
@section('script')

@if($id_berkas_adm == 12) 
<script type="text/javaScript">

	$(document).ready(function() {
		$("#checkboxPrimaryd").click(function(event) {
			if ( $( ".cekpen" ).first().is( ":hidden" ) ) {
				$( ".cekpen" ).slideDown( "slow" );
				document.getElementById("beteen1").disabled = true;
			} else {
				$( ".cekpen" ).hide();
				document.getElementById("beteen1").disabled = false;
			}
		});
	});
</script>

<script type="text/javaScript">

	$(document).ready(function() {
		$("#checkboxPrimaryg").click(function(event) {
			if ( $( ".cekpen_versi2" ).first().is( ":hidden" ) ) {
				$( ".cekpen_versi2" ).slideDown( "slow" );
				document.getElementById("beteen1").disabled = true;
			} else {
				$( ".cekpen_versi2" ).hide();
				document.getElementById("beteen1").disabled = false;
			}
		});
	});
</script>
@endif

@include('sweet::alert')
@endsection