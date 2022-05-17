@extends('admin.layout.master')

@section('content')
<br>

<?php if(cek_akses('1') == 'yes'){
}else{ ?>
  <script type="text/javascript">history.back(alert("Anda Tidak Memiliki Akses"))</script>
<?php } ?> 

<div class="container-fluid" style="overflow-x: hidden;"> 
    <div class="row">
      <div class="col-12">
         @if ($message = Session::get('success'))
           <div class="uk-alert uk-alert-success" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
             
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $message }}</strong>
              </div>
               
          </div>
        @endif

        @if ($message = Session::get('error'))
           <div class="uk-alert uk-alert-error" data-uk-alert>
              <a href="" class="uk-alert-close uk-close"></a>
             
              <div class="alert alert-error alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>{{ $message }}</strong>
              </div>
              
          </div>
        @endif


        <div class="card card-info">
          <div class="card-header">

            <h5>Hak Akses</h5>

          </div>

          <div class="card-body text-center">
            <strong><center>Silahkan Pilih Usergroup</center></strong>
             <hr style="margin-top: 0.5rem;  width: 20%">
              <div class="form-group" >
                  <form name="fmGoTo">
                      <tr>
                          <label>
                              <select id="usergroup" type="dropdown-toggle" class="form-control" name="usergroup" onchange="top.location.href = this.options[this.selectedIndex].value">
                              <option value="{{ Route('index_hakakses', ['id' => null] ) }}">Pilih Usergroup</option>
                              
                              @foreach($usergroup as $keyus => $showusergroup)
                              <option class="apports" value="{{ Route('index_hakakses', ['id' => $showusergroup->id] ) }}"  @if (request()->id == $showusergroup->id) selected  @endif>{{ $showusergroup->nama }}</option>
                              @endforeach  

                              </select>
                              <?php $usergroup = request()->id ?>

                          </label>         
                      </tr>
                  </form>
              </div>
            </div>



            <div class="card-body" style="padding: 0px;">

              @php
                  if ($usergroup == NULL) {

                      echo "<h3><center>Pilih Usergroup Untuk Selanjutnya</center></h3><hr style='margin-top: 0.5rem;  width: 50%''>";

                  } else { 
              @endphp


                        

                      <div class="shadow p-2 mb-4 bg-white rounded col-11 mx-auto" >
                      <div class="card-body">
                        <div class="table-responsive">
                          
                        <table class="table">

                         <form action="{{ Route('simpan_hakakses') }}" method="POST" name="fSimpanHa">
                          @csrf
                          @php $i = 0; @endphp
                          
                              @if(cek_akses('2') == 'yes')
                              <div class="icheck-danger d-inline"  style="cursor:pointer; float: right;">
                                <input type="checkbox" id="checkboxPrimary1" name="ceksemua" value="check" onclick="checkAll(0);">
                                <label for="checkboxPrimary1">
                                  Centang Semua
                                </label>
                              </div>
                              @endif
                          
                          @foreach($groupmodul as $k_groupmodul => $showgroupmodul)

                          <tr>
                              <td width="20%" nowrap=""><strong>{{ $showgroupmodul->groupmodul }}</strong></td>
                              <td width="1%"><strong>:</strong></td>

                              <td width="70%" style="line-height: 1.5" nowrap="">

                                @php 
                                $groupmodul_cek = DB::table('hak')->select('*')->where('groupmodul','=',$showgroupmodul
                                  ->groupmodul)->orderBy('urutan', 'ASC')->get();
                                @endphp

                                @foreach($groupmodul_cek as $keyc => $s_groupmodul_cek)
                                @php 

                                $i++; 

                                  $query_hakakses = DB::table('hak_akses')->select('*')->where([['usergroup','=',$usergroup],['modul','=',$s_groupmodul_cek->id]])->count();

                                  if (0 < $query_hakakses) {
                                      $checked = "checked='checked'";
                                  } else {
                                      $checked = "";
                                  }

                                @endphp


                                @if(cek_akses('2') == 'yes')
                                  <div class="icheck-primary d-inline">
                                    <input style="cursor:pointer" name="ha<?php echo $i; ?>" type="checkbox" id="ha<?php echo $i; ?>" 
                               value="{{ $s_groupmodul_cek->id }}" <?php echo $checked; ?> /> {{ $s_groupmodul_cek->nama }}
                                    <label for="ha<?php echo $i; ?>">
                                    </label>
                                  </div>|
                                @else
                                   <div class="icheck-primary d-inline">
                                    <input style="cursor:pointer" name="kosong_haha" type="checkbox" id="ha<?php echo $i; ?>" 
                               <?php echo $checked; ?> disabled/> {{ $s_groupmodul_cek->nama }} |
                                    <label for="ha<?php echo $i; ?>">
                                    </label>
                                  </div>
                                @endif
                       

                                @endforeach
                              </td>
                          </tr>

                        
                          @endforeach
                          <tr>
                              <td colspan="3" >
                                <input class="btn bg-navy margin btn-sm" name="" value="Reset" type="reset" /> 
                                <input class="btn bg-olive margin btn-sm" type="submit" name="simpan" value="Simpan">
                              </td>
                          </tr>
                          <input type="hidden" name="jmlha" value="<?= $i ?>">
                          <input type="hidden" name="usergroup" value="<?= $usergroup ?>">
      
                        </form>
      
                      </table>
                    </div>
                    </div>
                  </div>


              @php 
                }
              @endphp

            </div>
      </div>
    </div>
</div>
</div>

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

@endsection
@section('script')
<script type="text/javascript">

//check all checkbox
    function checkAll(form) {
        for (var i = 0; i < document.forms['fSimpanHa'].elements.length; i++)
        {
            var e = document.forms['fSimpanHa'].elements[i];
            if ((e.name != 'allbox') && (e.type == 'checkbox'))
            {
                e.checked = document.forms['fSimpanHa'].ceksemua.checked;
            }
        }
    }
</script> 

@include('sweet::alert')
@endsection