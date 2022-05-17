
@extends('admin.layout.master')
@section('content')

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
  <!-- /.content-header --> 
<div class="container-fluid">
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
<div style="padding-top: 7px; padding-bottom: 7px; ">
<a href="{{ URL::to('pegawai') }}" class="btn btn-outline-danger btn-xs" data-toggle="tooltip" data-placement="bottom" title="Kembali - Home Pegawai"><b><span class="fa fa-arrow-left"></span> Kembali </b></a></div>
    <div class="row">
      <div class="col-12 mx-auto"> 
        <div class="card">
         <div class="card-body">
          <!--form data-route="#" data-routeback="#" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8"-->
      <form data-route="{{ Route('PegawaiProsesSimpanData') }}"  data-routeback="#" id="myForm" role="form" method="POST" data-toggle="validator" accept-charset="utf-8">
          @csrf

          <!-- SmartWizard html -->
          <div id="smartwizard">
          <ul>
              <li><a href="#step-1">Step 1<br /><small>Data Diri Bagian 1</small></a></li>
              <li><a href="#step-2">Step 2<br /><small>Data Diri Bagian 2</small></a></li>
              <li><a href="#step-3">Step 3<br /><small>Data Diri Bagian 3</small></a></li>
              <li><a href="#step-4">Step 4<br /><small>Pendidikan Bagian 1</small></a></li>
              <li><a href="#step-5">Step 5<br /><small>Pendidikan Bagian 2</small></a></li>
          </ul>


          <div>
                <!-- batas form-->

          <br>


          <div id="step-1"  role="form">
              <div id="form-step-0" role="form" data-toggle="validator" class="row">
                <input type="hidden" value="{{$id_user}}" name="id_user">
                  <div class="form-group col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                          <label for="nama_lengkap">Nama Lengkap : <font style="color: #007bff" size="2px">*Sertakan gelar</font></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-user-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Masukan Nama Lengkap" value="{{ $nama_karyawan }}">
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nama_mandarin">Nama Mandarin : <font style="color: #007bff" size="2px">*Jika ada</font></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-language"></i></span>
                              </div>
                              <input type="text" class="form-control" name="nama_mandarin" id="nama_mandarin" placeholder="Masukan Nama Mandarin">
                            </div>
                            <div class="help-block with-errors text-danger"></div>
                        </div>
                    </div>
                  </div> 

                  <div class="form-group col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <label for="nomorktp">Nomor KTP :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                                </div>
                              <input type="text" class="form-control" name="nomor_ktp" id="nomor_ktp" placeholder="Masukan Nomor KTP" onkeypress="return isNumberKey(event)">
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="form-group col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                          
                            <label for="nomorktp">Berlaku s.d :</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fa fa-hourglass-start"></i></span>
                                </div>
                                <select name="durasi_ktp" class="form-control" id="berlaku_sd">
                                    <option value="">Masa Berlaku</option>
                                    <?php
                                      $thn_skr = 2005;
                                      for ($x = $thn_skr; $x <= 2030; $x++) {
                                        ?>
                                            <option value="<?php echo $x ?>"><?php echo $x ?></option>
                                        <?php
                                      }
                                    ?>
                                    <option value="SEUMUR HIDUP">Seumur Hidup</option>
                                </select>
                            </div>
                        </div>
                      </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        
                          <label for="nomorktp">Nomor NPWP : <font style="color: #007bff" size="2px">*Jika Ada</font></label>
                          <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                              </div>
                            <input type="text" class="form-control" name="nomor_npwp" id="nomor_npwp" placeholder="Masukan Nomor NPWP" onkeypress="return isNumberKey(event)">
                          </div>
                          <div class="help-block with-errors text-danger"></div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                        <label for="alamat">Alamat Tinggal Sekarang :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                          </div>
                          <textarea class="form-control" id="alamat" name="alamat_sekarang" placeholder="Masukan Alamat Tinggal" ></textarea>
                        </div>
                        </div>
                    </div>
                  </div>


                

                <div class="form-group col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                        <label for="nomortelepon">Alamat Email :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-at"></i></span>
                          </div>
                          <input class="form-control" type="email" name="email" placeholder="Masukan Alamat Email" />
                        </div>
                        </div>
                    </div>
                </div>

                  <div class="form-group col-md-6 mx-auto">
                      <div class="row">
                          <div class="col-md-12">
                            <table border="0" class="table table-sm ">
                             
                              <label for="nomorktp">Identitas Lainnya : <font style="color: #007bff" size="2px">*Centang Jika Ada</font></label>
                              <tr>
                                <thead class="bg-info">
                                  <th colspan="5">
                                    <center>
                                      Jenis Kartu Identitas
                                    </center>
                                  </th>
                                </thead>
                                <tbody>
                                  <td>
                                    <div class="icheck-primary d-inline">
                                      <input type="checkbox" id="checkboxPrimary1" name="jenis_iden[]" value="KARTU KELUARGA">
                                      <label for="checkboxPrimary1">
                                        KK
                                      </label>
                                    </div>
                                  </td>
                                  <td style="width: 50px"> </td>
                                  <td>
                                    <div class="icheck-primary d-inline">
                                      <input type="checkbox" id="checkboxPrimary2" name="jenis_iden[]" value="PASPOR">
                                      <label for="checkboxPrimary2">
                                        PASPOR
                                      </label>
                                    </div>
                                  </td>
                                  <td  style="width: 50px"> </td>
                                  <td ></td>
                                </tbody>

                                <tbody>
                                  <td>
                                    <div class="icheck-primary d-inline">
                                      <input type="checkbox" id="checkboxPrimary3" name="jenis_iden[]" value="SIM A">
                                      <label for="checkboxPrimary3">
                                        SIM A
                                      </label>
                                    </div>
                                  </td>
                                  <td> </td>
                                  <td>
                                    <div class="icheck-primary d-inline">
                                      <input type="checkbox" id="checkboxPrimary4" name="jenis_iden[]" value="SIM B">
                                      <label for="checkboxPrimary4">
                                        SIM B
                                      </label>
                                    </div>
                                  </td>
                                  <td> </td>
                                  <td>
                                    <div class="icheck-primary d-inline">
                                      <input type="checkbox" id="checkboxPrimary5" name="jenis_iden[]" value="SIM C">
                                      <label for="checkboxPrimary5">
                                        SIM C
                                      </label>
                                    </div>
                                  </td>
                                </tbody>
                                <thead class="bg-info">
                                  <th colspan="5">
                                    <center>
                                      BPJS
                                    </center>
                                  </th>
                                </thead>
                                <tbody>
                                  <td>
                                    <div class="icheck-primary d-inline">
                                      <input type="checkbox" id="checkboxPrimary6" name="jenis_iden[]" value="BPJS KESEHATAN">
                                      <label for="checkboxPrimary6">
                                      Kesehatan
                                      </label>
                                    </div>
                                  </td>
                                  <td> </td>
                                  <td>
                                     <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="checkboxPrimary7" name="jenis_iden[]" value="BPJS KETENAGAKERJAAN">
                                        <label for="checkboxPrimary7">
                                        Ketenagakerjaan
                                        </label>
                                    </div>
                                  </td>
                                  <td> </td>
                                  <td style="width: 200px"> 
                                    <div class="icheck-primary d-inline">
                                      <input type="checkbox" id="checkboxPrimary8" name="jenis_iden[]" value="BPJS JAMINAN PENSIUN">
                                      <label for="checkboxPrimary8">
                                      Jaminan Pensiun
                                      </label>
                                    </div>
                                </td>
                                </tbody>
                              </tr>

                            </table>
                          </div>
                        </div>
                    </div>


                
                <div class="form-group col-md-6">
                  <div class="row">
                      <div class="col-md-12">
                      <label for="alamat">Status Tempat Tinggal :</label>
                      
                      <table border="0" class="table table-sm table-bordered">
                        <tr>
                          <thead class="bg-info">
                            <th colspan="5"><center>Kepemilikan Tempat Tinggal</center></th>
                          </thead>
                          <tbody>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary5" value="Sewa" name="status_tempat_tinggal">
                                <label for="radioPrimary5">
                                  Sewa
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary6" value="Milik Sendiri" name="status_tempat_tinggal">
                                <label for="radioPrimary6">
                                  Milik Sendiri
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary7" value="Milik Keluarga" name="status_tempat_tinggal">
                                <label for="radioPrimary7">
                                  Milik Keluarga
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary8" value="Kos" name="status_tempat_tinggal">
                                <label for="radioPrimary8">
                                  Kos
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary9" value="Kontrak" name="status_tempat_tinggal">
                                <label for="radioPrimary9">
                                  Kontrak
                                </label>
                              </div>
                            </td>
                          </tbody>
                        </tr>
                      </table>
                      </div>
                  </div>
                </div>

              
                <div class="form-group col-md-6">
                  <div class="row">
                      <div class="col-md-12">
                      <label for="jenis_kelamin">Jenis Kelamin :</label>
                      
                      <table border="0" class="table table-sm table-bordered">
                        <tr>
                          <thead class="bg-info">
                            <th colspan="5"><center>Jenis Kelamin</center></th>
                          </thead>
                          <tbody>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary10" value="Pria" name="jenis_kelamin">
                                <label for="radioPrimary10">
                                  Pria
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary11" value="Wanita" name="jenis_kelamin">
                                <label for="radioPrimary11">
                                  Wanita
                                </label>
                              </div>
                            </td>
                          </tbody>
                        </tr>
                      </table>
                      </div>
                  </div>
                </div>



                </div>
          </div>


          <!--step 2-->

          <div id="step-2">
            <div id="form-step-1" role="form" data-toggle="validator" class="row">
              
                <div class="form-group col-md-4">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="provinsi">Provinsi Tempat Lahir :</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-map-marked-alt"></i></span>
                            </div>
                            <select class="form-control select" id="provinsi" name="provinsi_lahir">
                              <option value="" >------Pilih Provinsi-----</option>
                                @foreach ($list_provinsi as $item_provinsi)
                                <option value="{{$item_provinsi->id_prov}}">{{$item_provinsi->nama}}</option>                                        
                                @endforeach
                            </select>
                          </div>
                      </div>
                  </div>
                </div>

                <div class="form-group col-md-4">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kabupatenkota">Kabupaten/Kota Tempat Lahir :</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-map-marked-alt"></i></span>
                            </div>
                            <select id="kabupatenkota" name="kota_lahir" class="form-control select">
                              <option value="">Pilih Provinsi Dahulu</option>
                            
                            </select>
                          </div>
                        </div>
                  </div>
                </div>

                <div class="form-group col-md-4">
                  <div class="row">
                      <div class="col-md-12">
                      <label for="tanggallahir">Tanggal Lahir :</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                            </div>
                          <input type="text" name="tanggal_lahir" class="form-control float-right" id="reservationtime" readonly="" >
                        </div>
                      </div>
                  </div>
                </div>

               

                  <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                        <label for="nomortelepon">Nomor Telepon :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-phone-alt"></i></span>
                          </div>
                          <input type="text" class="form-control" name="nomor_telepon" data-inputmask='"mask": "9999-9999-9999-9999"' data-mask placeholder="masukan nomor telepon" >
                        </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                        <label for="nomortelepon">Nomor Telepon 2:</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-phone-alt"></i></span>
                          </div>
                          <input class="form-control" name="nomor_telepon_2" placeholder="nomor telepon 2" data-inputmask='"mask": "9999-9999-9999-9999"' data-mask/>
                        </div>
                        </div>
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                        <label for="nomortelepon">Nomor WhatsApp (WA) :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-comments"></i></span>
                          </div>
                          <input class="form-control" name="nomor_wa" placeholder="nomor WhatsApp" data-inputmask='"mask": "9999-9999-9999-9999"' data-mask/>
                        </div>
                        </div>
                    </div>
                  </div>
                
                   <div class="form-group col-md-5">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="tanggallahir">Golongan Darah :</label>
                        <table border="0" class="table table-sm ">
                          <tr>
                          <thead class="bg-info">
                            <th colspan="5">
                              Jenis
                            </th>
                           
                          </thead>   

                          <tbody>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary1" value="A" name="golongan_darah">
                                <label for="radioPrimary1">
                                  A
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary2" value="B" name="golongan_darah">
                                <label for="radioPrimary2">
                                B
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary3" value="AB" name="golongan_darah">
                                <label for="radioPrimary3">
                                  AB
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary4" value="O" name="golongan_darah">
                                <label for="radioPrimary4">
                                O
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="TidakTahu" value="Tidak Tahu" name="golongan_darah">
                                <label for="TidakTahu">
                                Tidak Tahu
                                </label>
                              </div>
                            </td>
                          </tbody>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>


            </div>
          </div>


          <div id="step-3">
            <div id="form-step-2" role="form" data-toggle="validator" class="row">
                


                <div class="form-group col-md-4">
                  <div class="row">
                      <div class="col-md-12">
                      <label for="jenis_kelamin">Status Marital :</label>
                      
                      <table border="0" class="table table-sm table-bordered">
                        <tr>
                          <thead class="bg-info">
                            <th colspan="5"><center>Jenis Marital</center></th>
                          </thead>
                          <tbody>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary12" value="Lajang" name="status_marital"  onclick="javascript:houseclean();">
                                <label for="radioPrimary12">
                                  Lajang
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary13" value="Menikah" name="status_marital"  onclick="javascript:houseclean();">
                                <label for="radioPrimary13" >
                                  Menikah
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary14" value="Duda/Janda" name="status_marital"  onclick="javascript:houseclean();">
                                <label for="radioPrimary14">
                                  Duda/Janda
                                </label>
                              </div>
                            </td>
                          </tbody>
                        </tr>
                      </table>
                      </div>
                  </div>
                </div>
                

                <div class="form-group col-md-5">
                  <div class="row">
                      <div class="col-md-12">
                      <label for="agama">Agama :</label>
                      
                      <table border="0" class="table table-sm table-bordered">
                        <tr>
                          <thead class="bg-info">
                            <th colspan="7"><center>Jenis</center></th>
                          </thead>
                          <tbody>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary2a" value="Islam" name="agama"  onclick="javascript:housecleanagama();">
                                <label for="radioPrimary2a">
                                  Islam
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary2b" value="Kristen" name="agama"onclick="javascript:housecleanagama();">
                                <label for="radioPrimary2b" >
                                  Kristen
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary2c" value="Katolik" name="agama"onclick="javascript:housecleanagama();">
                                <label for="radioPrimary2c" >
                                  Katolik
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary2d" value="Hindu" name="agama"onclick="javascript:housecleanagama();">
                                <label for="radioPrimary2d" >
                                  Hindu
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary2e" value="Buddha" name="agama"onclick="javascript:housecleanagama();">
                                <label for="radioPrimary2e" >
                                  Buddha
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary22112" value="Buddha Maitreya" name="agama"onclick="javascript:housecleanagama();">
                                <label for="radioPrimary22112" >
                                  Buddha Maitreya
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary2f" value="Konghucu" name="agama"onclick="javascript:housecleanagama();">
                                <label for="radioPrimary2f" >
                                  Konghucu
                                </label>
                              </div>
                            </td>
                          </tbody>
                        </tr>
                      </table>
                      </div>
                  </div>
                </div>  
              


                <div class="form-group col-md-4" id="nama_pasangan" style="display: none;">
                <div class="row">
                    <div class="col-md-12">
                      <hr class="new4">
                        <label for="suamiistri">Nama Suami/Istri:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-restroom"></i></span>
                            </div>
                            <input class="form-control" name="nama_pasangan" id="nama_pasangan2"  placeholder="Masukan Nama Suami Atau Istri"  disabled />
                            </div>
                      </div>
                  </div>
                </div>
                <div class="form-group col-md-4" id="pekerjaan_pasangan" style="display: none;">
                <div class="row">
                    <div class="col-md-12">
                      <hr class="new4">
                      <label for="Pekerjaan">Pekerjaan:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-people-carry"></i></span>
                        </div>
                        <input class="form-control"  name="pekerjaan_pasangan" id="pekerjaan_pasangan2"  placeholder="Masukan Pekerjaan Suami Atau Istri" disabled/>
                      </div>
                      <font style="color: #007bff" size="2px">*Jika ada</font>
                      <div class="help-block with-errors text-danger"></div>
                      </div>
                  </div>
                </div>
                <div class="form-group col-md-4" id="nomor_telepon_pasangan" style="display: none;">
                <div class="row">
                    <div class="col-md-12">
                      <hr class="new4">
                      <label for="notelppasangan">Nomor Telepon Suami/Istri:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        </div>
                        <input class="form-control"  name="nomor_telepon_pasangan" id="nomor_telepon_pasangan2"  placeholder="Masukan Nomor Telepon Suami Atau Istri" data-inputmask='"mask": "9999-9999-9999"' data-mask disabled/>
                      </div>
                      <font style="color: #007bff" size="2px">*Jika ada</font>
                      <div class="help-block with-errors text-danger"></div>
                      </div>
                  </div>
                </div>


                <div class="form-group col-md-12" id="tampil_punya_anak" style="display: none;">
                      <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <div class="icheck-danger d-inline">
                              <input type="checkbox" id="punya_anak" onclick="javascript:houseclean100();">
                              <label for="punya_anak">
                                Saya memiliki anak!
                              </label><hr style="margin-bottom: 0px;">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group col-md-4" id="nama_anak" style="display: none;">
                <div class="row">
                    <div class="col-md-12">
                        <label for="anak">Nama Anak:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-restroom"></i></span>
                            </div>
                            <input class="form-control" name="nama_anak[]" id="nama_anak_id"  placeholder="Masukan Nama Anak"  disabled />
                            </div>
                      </div>
                  </div>
                </div>

                <div class="form-group col-md-4" id="ttl_anak" style="display: none;">
                <div class="row">
                    <div class="col-md-12">
                        <label for="anak">Tanggal Lahir Anak:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-restroom"></i></span>
                            </div>
                            <input class="form-control" type="date" name="ttl_anak[]" id="ttl_anak_id"    disabled />
                            </div>
                      </div>
                  </div>
                </div>

                <div class="form-group col-md-4" id="jenis_kelamin_anak" style="display: none;">
                <div class="row">
                    <div class="col-md-12">
                        <label for="anak">Jenis Kelamin Anak:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-restroom"></i></span>
                            </div>
                            <select class="form-control" name="jenis_kelamin_anak[]" id="jenis_kelamin_anak_id" disabled="">
                              
                              <option value="">Pilih Jenis Kelamin</option>
                              <option value="Laki-Laki">Laki-laki</option>
                              <option value="perempuan">Perempuan</option>

                            </select>
                            </div>
                      </div>

                  </div>
                </div>

                <div class="form-group col-md-12" id="btn-tam-anak" style="display: none;">
                <div class="row">
                    <div class="col-md-12">
                      <button class="add_tamanak btn btn-outline-success btn-xs">Tambah anak
                        <span style="font-size:16px; font-weight:bold;">+</span>
                      </button>    
                    </div>

                  </div>
                </div>

                <div class="form-group col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <fieldset disabled="" id="tambah_anak" style="display: none;">
                     <div class="container_anak">
                 
                      </div>
                    </fieldset>

                    </div>

                  </div>
                </div>

            
             <div class="form-group col-md-4">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="Suku">Suku :</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                          <input class="form-control" name="suku"  placeholder="Masukan Suku"/>
                        </div>
                        </div>
                    </div>
                </div>


                 <div class="form-group col-md-4">
                  <div class="row">
                      <div class="col-md-12" id="vegeshow" style="display: none;"> 
                      <label for="vegetarian">Vegetarian ? : <font style="color: #007bff" size="2px">*Khusus Umat Maitreya</font></label>
                      
                      <table border="0" class="table table-sm table-bordered">
                        <tr>
                          <thead class="bg-info">
                            <th colspan="5"><center>Status Vege ?</center></th>
                          </thead>
                          <tbody>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="ikrarradio" value="Ikrar" name="ikrarvege" onclick="javascript:housecleanikrar();">
                                <label for="ikrarradio">
                                  Ikrar
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="ikrarradio12" value="Belum Ikrar" name="ikrarvege" onclick="javascript:housecleanikrar();">
                                <label for="ikrarradio12" >
                                  Belum Ikrar
                                </label>
                              </div>
                            </td>
                          </tbody>
                        </tr>
                      </table>
                      </div>
                  </div>
                </div>


                <div class="form-group col-md-4">
                  <div class="row">
                      <div class="col-md-12" id="status_vihara_show" style="display: none;">
                      <label for="status">Status Di Vihara <font style="color: #007bff" size="2px">*Khusus Umat Maitreya</font></label>
                      
                      <table border="0" class="table table-sm table-bordered">
                        <tr>
                          <thead class="bg-info">
                            <th colspan="5"><center>Status</center></th>
                          </thead>
                          <tbody>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="status_vihara" value="Iya" name="QiuDao" onclick="javascript:housecleanqiudao();">
                                <label for="status_vihara">
                                  Sudah Qiu Dao
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="status_vihara12" value="Tidak" name="QiuDao" onclick="javascript:housecleanqiudao();">
                                <label for="status_vihara12" >
                                  Belum Qiu Dao
                                </label>
                              </div>
                            </td>
                          </tbody>
                        </tr>
                      </table>
                      </div>
                  </div>
                </div>



                <div class="form-group col-md-4" >
                  <div class="row">
                      <div class="col-md-12" id="showikrartahun" style="display: none;">
                        <label for="Suku">Ikrar Tahun :<font style="color: #007bff" size="2px">*Khusus Umat Maitreya</font></label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-user"></i></span>
                        </div>
                          <select class="form-control" id="tahunikrar" name="ikrartahun" disabled=""></select>
                          
                        </div>
                        </div>
                    </div>
                </div>

               <div class="form-group col-md-8">
                  <div class="row">
                      <div class="col-md-12" id="QiuDao" style="display: none;">
                      <label for="status">Detail Status Di Vihara <font style="color: #007bff" size="2px">*Khusus Umat Maitreya, Jika Sudah <b>Qiu Dao</b></font></label>
                      
                      <table border="0" class="table table-sm table-bordered">
                        <tr>
                          <thead class="bg-info">
                            <th colspan="5"><center>Status</center></th>
                          </thead>
                          <tbody>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="DaoQin" value="Dao Qin" name="detailqiudao" disabled="">
                                <label for="DaoQin">
                                  Dao Qin 
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="FoYuan" value="Fo Yuan" name="detailqiudao" disabled="">
                                <label for="FoYuan" >
                                  Fo Yuan
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="TanZhu" value="Tan Zhu" name="detailqiudao" disabled="">
                                <label for="TanZhu" >
                                  Tan Zhu
                                </label>
                              </div>
                            </td>
                          </tbody>
                        </tr>
                      </table>

                      </div>
                  </div>
                </div>


              <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Kontak Darurat :<font style="color: #007bff" size="2px"> *yang dihubungi</font></label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                        </div>
                          <input class="form-control" name="nama_nodarurat[]"  placeholder="Masukan Nama"/>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Hubungan :<font style="color: #007bff" size="2px"> *sepupu, ipar dll</font></label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-user-tag"></i></span>
                        </div>
                          <input class="form-control" name="hubungan_nodarurat[]"  placeholder="Masukan Hubungan"/>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Nomor Telepon :</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        </div>
                          <input class="form-control" name="nomor_darurat[]"  placeholder="Masukan Nomor Telepon" data-inputmask='"mask": "9999-9999-9999-9999"' data-mask/>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Kota :</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-city"></i></span>
                        </div>
                          <input class="form-control" name="kota_nodarurat[]"  placeholder="Masukan Kota"/>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Kontak Darurat :<font style="color: #007bff" size="2px"> *yang dihubungi</font></label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                        </div>
                          <input class="form-control" name="nama_nodarurat[]"  placeholder="Masukan Nama"/>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Hubungan :<font style="color: #007bff" size="2px"> *sepupu, ipar dll</font></label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-user-tag"></i></span>
                        </div>
                          <input class="form-control" name="hubungan_nodarurat[]"  placeholder="Masukan Hubungan"/>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Nomor Telepon :</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        </div>
                          <input class="form-control" name="nomor_darurat[]"  placeholder="Masukan Nomor Telepon" data-inputmask='"mask": "9999-9999-9999-9999"' data-mask/>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Kota :</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-city"></i></span>
                        </div>
                          <input class="form-control" name="kota_nodarurat[]"  placeholder="Masukan Kota"/>
                        </div>
                        </div>
                    </div>
                </div>

             

            </div>
          </div>





          <div id="step-4">
            <h5>Sekolah Menengah Atas (Sederajat) | <input type="checkbox" name="" id="cek_sma" style="transform: scale(1.4);" ><font size="2">  &nbsp;*Centang untuk pengisian data, lewati jika tidak ada data yang akan diisi</font></h5>
            <fieldset id="fieldsetsma" disabled="">
            
            <div id="form-step-3" role="form" data-toggle="validator" class="row">
                 <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Nama Sekolah :</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-university"></i></span>
                        </div>
                          <textarea class="form-control" name="nama_sekolah" id="sma_namasekolah" placeholder="Masukan Nama Sekolah" ></textarea>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Jurusan :</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-chalkboard-teacher"></i></span>
                        </div>
                          <input type="text" class="form-control" name="jurusan" placeholder="Masukan Jurusan" >
                        </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Mulai Pendidikan :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-hourglass-start"></i></span>
                          </div>
                          <input type="month" class="form-control" name="mulai_pendidikan" value="" placeholder="Pilih Tanggal" > 
                        </div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Selesai Pendidikan :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-hourglass-end"></i></span>
                          </div>
                          <input type="month" class="form-control" name="selesai_pendidikan" value=""  placeholder="Pilih Tanggal" >
                        </div>
                        </div>
                    </div>
                </div>

            </div>
          </fieldset>
          
          </div>


          <div id="step-5" >
             <h5>Jenjang Pendidikan Lanjut | <input type="checkbox" name="" id="cek_perting" style="transform: scale(1.4);" ><font size="2">  &nbsp;*Centang untuk pengisian data, lewati jika tidak ada data yang akan diisi</font></h5>
            <fieldset  id="fieldsetperguruantinggi" disabled="">
            
            <div class="shadow-sm p-3 mb-5 rounded mx-auto" id="alert_onclick" onclick="alert('Centang Untuk Pengisian Data')">


              <div id="form-step-4" role="form" data-toggle="validator" class="row">



                  <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                          <label for="nama_perguruantinggi">Nama Lengkap Perguruan Tinggi :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-university"></i></span>
                          </div>
                          <textarea class="form-control"  pattern="[a-z A-Z 0-9]{1,30}" name="nama_sekolah_perting[]" id="diploma_namaperguruan" placeholder="Masukan Nama Perguruan Tinggi" ></textarea>
                        </div>
                        </div>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                          <label for="Tingkat">Tingkat</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>
                          </div>
                          <select class="form-control" name="tingkat_perting[]" >
                            <option value="">--Pilih Jenjang Pendidikan--</option>
                            <option value="S3">Doktoral (S3)</option>
                            <option value="S2">Magister (S2)</option>
                            <option value="S1">Sarjana (S1)</option>
                            <option value="D4">Diploma (D4)</option>
                            <option value="D3">Diploma (D3)</option>
                            <option value="D2">Diploma (D2)</option>
                            <option value="D1">Diploma (D1)</option>
                            

                          </select>
                        </div>
                        </div>
                    </div>
                  </div>

                   <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                          <label for="Program Studi">Program Studi :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-chalkboard-teacher"></i></span>
                          </div>
                          <input type="text" class="form-control" name="jurusan_perting[]"  placeholder="Masukan Program Studi" >
                        </div>
                        </div>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                          <label for="ipk">IPK :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-star"></i></span>
                          </div>
                          <input type="text" class="form-control" name="ipk_perting[]" placeholder="Masukan IPK"  maxlength="5">
                        </div>
                        </div>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                          <label for="tahun_mulai">Mulai Pendidikan :</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-hourglass-start"></i></span>
                            </div>
                            <input type="month" class="form-control" name="mulai_pendidikan_perting[]" value="" placeholder="Pilih Tanggal" autocomplete="off" > 
                          </div>
                        </div>
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                          <label for="tahun_selesai">Selesai Pendidikan :</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-hourglass-end"></i></span>
                            </div>
                            <input type="month" class="form-control" name="selesai_pendidikan_perting[]" value=""  placeholder="Pilih Tanggal" autocomplete="off" >
                          </div>
                    </div>
                  </div>
                </div>

                  <button class="add_form_field btn btn-outline-success btn-xs">Tambah Jenjang Pendidikan Lanjut
                          <span style="font-size:16px; font-weight:bold;">+</span>
                  </button>
                  <hr>
                  <div class="container1">
                       
                  </div>

                  </div>
                </fieldset>
              </div>

                <!--penutup batas form-->
          </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<style type="text/css">

#mybutton {
  position: fixed;
  bottom: 70px;
  left: -10px
}
</style>


@endsection

@section('script')

<!-- Include jQuery Validator plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>


<script type="text/javascript">
    
 
    $(function(){
      $.ajaxSetup({
          headers:{
              'X-CSRF-Token' : $("input[name='_token'").attr('value')
          }
      });
        $('#myForm').submit(function(e){
          var route = $('#myForm').data('route');
          var routeback = $('#myForm').data('routeback');
          var form_data = $(this);

            $.ajax({

              type: 'POST',
              url: route,
              data: form_data.serialize(),

              beforeSend: function(){
                  $.blockUI({ css: { 
                      border: 'none', 
                      padding: '5px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '5px', 
                      '-moz-border-radius': '5px', 
                      opacity: .5, 
                      color: '#fff' 
                  } }); 

              },
              success: function(a, e){
                switch (a.ceks) {
                    case "berhasil":
                        swal("Berhasil!", "Berhasil Menambah Data", "success");
                        break;
                    case "duplicat":
                        swal("Gagal!", "Data ini sudah ada", "error");
                        break;
                    case "gagal":
                        swal("Gagal!", "Kesalahan tidak diketahui", "error");
                        break;
                   
                }
              },
              complete: function() {
                $.unblockUI()
                setTimeout(function() {
                  window.location.href = "{{URL::to('pegawai')}}";
                }, 2000);
              },
              error: function(xhr) { // if error occured
                        swal("Upsss!", "Terjadi kesalahan Dalam Menyimpan Data", "error");
                    },

          })

          e.preventDefault();
        });
      });

    $(document).ready(function(){
        // Toolbar extra buttons
        var btnFinish = $('<button type="button"></button>').text('Finish')
                                         .addClass('btn btn-info')
                                         .on('click', function(){
                                                if( !$(this).hasClass('disabled')){
                                                    var elmForm = $("#myForm");
                                                    if(elmForm){
                                                        elmForm.validator('validate');

                                                        var elmErr = elmForm.find('.has-error');
                                                        if(elmErr && elmErr.length > 0){

                                                          swal("Gagal", "Lengkapi data yang bersifat wajib terlebih dahulu", "error");

                                                            return false;
                                                        }else{

                                                        swal({
                                                          title: "Apakah Anda Yakin?",
                                                          text: "Data Akan Disimpan",
                                                          icon: "warning",
                                                          buttons: true,
                                                          dangerMode: true,
                                                        }).then((insertboy) => {
                                                              if (insertboy) {
                                                                elmForm.submit();
                                                                return false;
                                                              }else {
                                                                  swal("Batal menyimpan data");
                                                                }
                                                            })
                                                        }
                                                    }
                                                }
                                            });
        var btnCancel = $('<button type="button"></button>').text('Reset')
                                         .addClass('btn btn-danger')

                                         .on('click', function(){

                                          swal({
                                            title: "Apakah Anda Yakin?",
                                            text: "Seluruh form akan dikosongkan jika anda melakukan reset",
                                            icon: "warning",
                                            buttons: true,
                                            dangerMode: true,
                                          })
                                          .then((willDelete) => {
                                          if (willDelete) {

                                              $('#smartwizard').smartWizard("reset");
                                              $('#myForm').find("input:not([type='radio']), textarea, select").val("");
                                              //$('#myForm').find(".agama").val("");
                                              $('#myForm').find('input:checkbox').prop('checked', false);
                                              $('#myForm').find('input:radio').prop('checked', false);

                                            swal("Seluruh Form Telah Direset!", {
                                              icon: "success",
                                            });
                                          } else {
                                            swal("Batal melakukan reset form");
                                          }
                                        });

                                        });



        // Smart Wizard
        $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'arrows',
                transitionEffect:'fade',
                toolbarSettings: {toolbarPosition: 'bottom',
                                  toolbarExtraButtons: [btnFinish, btnCancel]
                                },
                anchorSettings: {
                            markDoneStep: true, // add done css
                            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                            removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                        },
                keyNavigation: false,
             });

        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
            var elmFormcek = $("#form-step-" + stepNumber);
       
            // stepDirection === 'forward' :- this condition allows to do the form validation
            // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
           
            if(stepDirection === 'forward' && elmFormcek){
                elmFormcek.validator('validate');
                //step1

                var elmErr = elmFormcek.children('.has-error');
                if(elmErr && elmErr.length > 0){
                    // Form validation failed
                    return false;

                }

            }

            return true;
        });

        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
            // Enable finish button only on last step
            if(stepNumber == 6){
                $('.btn-finish').removeClass('disabled');
            }else{
                $('.btn-finish').addClass('disabled');
            }
        });

    });
  

    
    //list ikrar tahun

    var year = 1900;
    var till = 2020;
    var options = "";
    for(var y=year; y<=till; y++){
      options += "<option value="+y+">"+ y +"</option>";
    }
    document.getElementById("tahunikrar").innerHTML = options;

   function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }

//-------------------------------JAVASCIRPT BAGIAN STATUS MARITAL-------------------------------//
   function houseclean()
    {
    if (document.getElementById('radioPrimary13').checked == true)
      {
      
      $("#nama_pasangan").show(500);
      $("#pekerjaan_pasangan").show(500);
      $("#nomor_telepon_pasangan").show(500);
      $("#tampil_punya_anak").show(500);
      document.getElementById('nama_pasangan2').removeAttribute('disabled');
      document.getElementById('pekerjaan_pasangan2').removeAttribute('disabled');
      document.getElementById('nomor_telepon_pasangan2').removeAttribute('disabled');
      }
    else
      {
      $('#tambah_anak').prop('disabled', true);
      $('#tambah_anak').hide(500);
      

      $("#nama_pasangan").hide(500);
      $("#pekerjaan_pasangan").hide(500);
      $("#nomor_telepon_pasangan").hide(500);
      $("#nama_anak").hide(500);
      $("#ttl_anak").hide(500);
      $("#jenis_kelamin_anak").hide(500);
      $("#btn-tam-anak").hide(500);

      $("#tampil_punya_anak").hide(500);
      $("#punya_anak").prop('checked', false); 

      document.getElementById('nama_pasangan2').setAttribute('disabled','disabled');
      document.getElementById('pekerjaan_pasangan2').setAttribute('disabled','disabled');
      document.getElementById('nomor_telepon_pasangan2').setAttribute('disabled','disabled');
      document.getElementById('nama_anak_id').setAttribute('disabled','disabled');
      document.getElementById('ttl_anak_id').setAttribute('disabled','disabled');
      document.getElementById('jenis_kelamin_anak_id').setAttribute('disabled','disabled');
      }
    }

    function houseclean100()
    {
    if (document.getElementById('punya_anak').checked == true)
      {

      $('#tambah_anak').prop('disabled', false);
      $('#tambah_anak').show(500);

      $("#nama_anak").show(500);
      $("#ttl_anak").show(500);
      $("#jenis_kelamin_anak").show(500);
      $("#btn-tam-anak").show(500);
      document.getElementById('nama_anak_id').removeAttribute('disabled');
      document.getElementById('ttl_anak_id').removeAttribute('disabled');
      document.getElementById('jenis_kelamin_anak_id').removeAttribute('disabled');
      //$("#checkboxPrimary3").prop('checked', false); 
      }
    else
      {
      $('#tambah_anak').prop('disabled', true);
      $('#tambah_anak').hide(500);

      $("#nama_anak").hide(500);
      $("#ttl_anak").hide(500);
      $("#jenis_kelamin_anak").hide(500);
      $("#btn-tam-anak").hide(500);
      document.getElementById('nama_anak_id').setAttribute('disabled','disabled');
      document.getElementById('ttl_anak_id').setAttribute('disabled','disabled');
      document.getElementById('jenis_kelamin_anak_id').setAttribute('disabled','disabled');
      }
    }

    $(document).ready(function() {
      $('#cek_sma').change(function() {
              if(this.checked) {
                  $('#fieldsetsma').prop('disabled', false);
              }else{
                  $('#fieldsetsma').prop('disabled', true);
              }       
          });

      $('#cek_perting').change(function() {
              if(this.checked) {
                  $('#fieldsetperguruantinggi').prop('disabled', false);
                  $('#alert_onclick').removeAttr("onclick");
              }else{
                  $('#fieldsetperguruantinggi').prop('disabled', true);

              }       
          });

      //FORM SELECT JABATAN PENDIDIK DAN SUB PENDIDIK YANG DISABLE
      $('#cek_TenagaPendidik').change(function() {
              if(this.checked) {
                  $('#jabatan_pendidik0').prop('disabled', false);
                  $('#subjabatanpendidik0').prop('disabled', false);

                  $('#jabatan_akademik').prop('disabled', false);

                  $('#nomor_serdos').prop('disabled', false);

                  $('#radioPrimary100').prop('disabled', false);
                  $('#radioPrimary101').prop('disabled', false);
                  $('#radioPrimary111').prop('disabled', false);

                  $(".tamjab").hide(700);

                  $('.FormGroupSubJabatanPendidik').removeAttr("onclick");
              }else{
                  $('#jabatan_pendidik0').prop('disabled', true);
                  $('#subjabatanpendidik0').prop('disabled', true);
                  $('#jabatan_pendidik1').prop('disabled', true);
                  $('#subjabatanpendidik1').prop('disabled', true);
                  $('#jabatan_pendidik2').prop('disabled', true);
                  $('#subjabatanpendidik2').prop('disabled', true);
                  $('#jabatan_akademik').prop('disabled', true);

                  document.getElementById('nomor_serdos').setAttribute('disabled','disabled');
                  $('#tambahan_tenaga_pendidik').prop('checked', false); // Unchecks it

                  $('#radioPrimary100').prop('disabled', true);
                  $('#radioPrimary101').prop('disabled', true);
                  $('#radioPrimary111').prop('disabled', true);

              }       
          });
    });


//-------------------------------------------JAVASCIRPT BAGIAN STATUS MARITAL----------------------------------//






//-------------------------------------JAVASCIRPT BAGIAN STATUS TENAGA PENDIDIK---------------------------------//
   

</script>
<script type="text/javascript">

//Menampilkan nomor serdos
function houseclean2()
{
if (document.getElementById('radioPrimary100').checked == true)
  {
  $("#nomor_serdos_td").show(500);
  document.getElementById('nomor_serdos').removeAttribute('disabled');
  }
else
  {
  $("#nomor_serdos_td").hide(500);
  document.getElementById('nomor_serdos').setAttribute('disabled','disabled');
  }
}


//menampilkan detail agama budha maitri
function housecleanagama()
{
if (document.getElementById('radioPrimary22112').checked == true)
  {
  $("#vegeshow").show(500);
  $("#status_vihara_show").show(500);
  document.getElementById('tahunikrar').removeAttribute('disabled');
  }
else
  {
  $("#vegeshow").hide(500);
  $("#status_vihara_show").hide(500);
  $("#showikrartahun").hide(500);
  $("#QiuDao").hide(500);
  $("#ikrarradio").prop('checked', false);
  $("#ikrarradio12").prop('checked', false);
  $("#status_vihara").prop('checked', false); 
  $("#status_vihara12").prop('checked', false);
  document.getElementById('DaoQin').removeAttribute('disabled');
  document.getElementById('FoYuan').removeAttribute('disabled');
  document.getElementById('TanZhu').removeAttribute('disabled');
  document.getElementById('tahunikrar').setAttribute('disabled','disabled');
  }
}




//ikrar
function housecleanikrar()
{
if (document.getElementById('ikrarradio').checked == true)
  {
  $("#showikrartahun").show(500);
  document.getElementById('tahunikrar').removeAttribute('disabled');
  }
else
  {
  $("#showikrartahun").hide(500);
  document.getElementById('tahunikrar').setAttribute('disabled','disabled');
  }
}
//qiudao
function housecleanqiudao()
{
if (document.getElementById('status_vihara').checked == true)
  {
  $("#QiuDao").show(500);
  document.getElementById('DaoQin').removeAttribute('disabled');
  document.getElementById('FoYuan').removeAttribute('disabled');
  document.getElementById('TanZhu').removeAttribute('disabled');
  }
else
  {
  $("#QiuDao").hide(500);
  document.getElementById('DaoQin').setAttribute('disabled','disabled');
  document.getElementById('FoYuan').setAttribute('disabled','disabled');
  document.getElementById('TanZhu').setAttribute('disabled','disabled');
  }
}

</script>

<script type="text/javascript">
  
jQuery( document ).ready(function($){
  $('#provinsi').on('change', function(){
        $.post('{{ URL::to('/kabupatenkota') }}', {
            type: 'kabupaten', 
            _token: "{{ csrf_token() }}",
            id: $('#provinsi').val(),

            beforeSend: function() {

               $.blockUI({ css: { 
                      border: 'none', 
                      padding: '5px', 
                      backgroundColor: '#000', 
                      '-webkit-border-radius': '5px', 
                      '-moz-border-radius': '5px', 
                      opacity: .5, 
                      color: '#fff' 
                  } }); 

            },
            success: function(msg) {
                $.unblockUI();
            },
        
          }, 
          function(e){
            $('#kabupatenkota').html(e);
        });
    });
});

</script>

<script type="text/javascript">
  jQuery( document ).ready(function($){
    $('.select').select2({
      theme: 'bootstrap4'
    });
  });
</script>
<script type="text/javascript">
  jQuery( document ).ready(function($){
   $('#reservationtime').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10),
    locale:{
    format: 'YYYY-MM-DD',
    }
  })
 })
</script>
<script type="text/javascript">
  jQuery( document ).ready(function($){
  $('[data-mask]').inputmask()
});


    //Tambah Jenjang Pendidikan
    $(document).ready(function() {
        var max_fieldspend = 5;
        var wrapperpend = $(".container1");
        var add_buttonpend = $(".add_form_field");

        var x = 1;
        $(add_buttonpend).click(function(e) {
            e.preventDefault();
            if (x < max_fieldspend) {
                //$(".tahuntambah").attr("id", "tahuntambah"+x);
                x++;
                $(wrapperpend).append('<div class="row">'+
              
                '<div class="col-md-4">'+
                '<div class="form-group" >'+
                  '<label for="nama_perguruantinggi">Nama Lengkap Perguruan Tinggi:</label>'+
                  '<div class="input-group">'+
                    '<div class="input-group-prepend">'+
                      '<span class="input-group-text"><i class="fa fa-university"></i></span>'+
                   '</div>'+
                   '<textarea class="form-control" name="nama_sekolah_perting[]"  placeholder="Masukan Nama Perguruan Tinggi" ></textarea>'+
                  '</div>'+
                    '<div class="help-block with-errors text-danger"></div>'+
                  '</div>'+
                '</div>'+

                '<div class="col-md-4">'+
                 '<div class="form-group" >'+
                    '<label for="Tingkat">Tingkat</label>'+
                    '<div class="input-group">'+
                      '<div class="input-group-prepend">'+
                        '<span class="input-group-text"><i class="fa fa-graduation-cap"></i></span>'+
                      '</div>'+
                      '<select class="form-control" name="tingkat_perting[]" >'+
                        '<option value="">--Pilih Jenjang Pendidikan--</option>'+
                        '<option value="S3">Doktoral (S3)</option>'+
                        '<option value="S2">Magister (S2)</option>'+
                        '<option value="S1">Sarjana (S1)</option>'+
                        '<option value="D4">Diploma (D4)</option>'+
                        '<option value="D3">Diploma (D3)</option>'+
                        '<option value="D2">Diploma (D2)</option>'+
                        '<option value="D1">Diploma (D1)</option>'+
                      '</select>'+
                    '</div>'+
                      '<div class="help-block with-errors text-danger"></div>'+
                    '</div>'+
                '</div>'+

                '<div class="col-md-4">'+
                  '<div class="form-group" >'+
                    '<label for="Program Studi">Program Studi:</label>'+
                    '<div class="input-group">'+
                      '<div class="input-group-prepend">'+
                        '<span class="input-group-text"><i class="fa fa-chalkboard-teacher"></i></span>'+
                      '</div>'+
                      '<input type="text" class="form-control" name="jurusan_perting[]" id="" placeholder="Masukan Program Studi" >'+
                    '</div>'+
                     '<div class="help-block with-errors text-danger"></div>'+
                    '</div>'+
                '</div>'+

                '<div class="col-md-4">'+
                '<div class="form-group" >'+
                    '<label for="ipk">IPK :</label>'+
                    '<div class="input-group">'+
                      '<div class="input-group-prepend">'+
                        '<span class="input-group-text"><i class="fa fa-star"></i></span>'+
                      '</div>'+
                      '<input type="text" class="form-control" name="ipk_perting[]" id="" placeholder="Masukan IPK"  maxlength="5">'+
                    '</div>'+
                      '<div class="help-block with-errors text-danger"></div>'+
                    '</div>'+
                '</div>'+

                '<div class="col-md-4">'+
                  '<div class="form-group" >'+
                      '<label for="tahun_mulai">Mulai Pendidikan :</label>'+
                      '<div class="input-group">'+
                        '<div class="input-group-prepend">'+
                          '<span class="input-group-text"><i class="fa fa-hourglass-start"></i></span>'+
                        '</div>'+
                        '<input type="month" class="form-control" name="mulai_pendidikan_perting[]" placeholder="Pilih Tanggal" > '+
                      '</div>'+
                      '<div class="help-block with-errors text-danger"></div>'+
                    '</div>'+
                  '</div>'+

                  '<div class="col-md-4">'+
                  '<div class="form-group" >'+
                    '<label for="tahun_selesai">Selesai Pendidikan :</label>'+
                    '<div class="input-group">'+
                      '<div class="input-group-prepend">'+
                        '<span class="input-group-text"><i class="fa fa-hourglass-end"></i></span>'+
                      '</div>'+
                     '<input type="month" class="form-control" id="" name="selesai_pendidikan_perting[]"  placeholder="Pilih Tanggal" >'+
                    '</div>'+
                        '<div class="help-block with-errors text-danger"></div>'+
                    '</div>'+

                '</div>'+
                '<a href="#" class="deletepend123 btn btn-danger btn-xs" title="Hapus Tambahan Pendidikan Lanjut"><span class="fa fa-trash"> </span</a>'+
                '<div>'
                );
               //add input box
            } else {
                alert('Melebihi Batas Maksimum')
            }

        });
      
      $(wrapperpend).on("click", ".deletepend123", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
       
    });



    //TAMBAH FORM ANAK
    $(document).ready(function() {
        var max_fieldanak = 10;
        var wrapper_anak = $(".container_anak");
        var add_buttonanak = $(".add_tamanak");

        var o = 1;
        $(add_buttonanak).click(function(e) {
            e.preventDefault();
            if (o < max_fieldanak) {
                //$(".tahuntambah").attr("id", "tahuntambah"+x);
                o++;
                $(wrapper_anak).append('<div class="row">'+
              
                '<div class="form-group col-md-4" id="nama_anak" >'+
                '<div class="row">'+
                    '<div class="col-md-12">'+
                        '<label for="anak">Nama Anak:</label>'+
                          '<div class="input-group">'+
                            '<div class="input-group-prepend">'+
                              '<span class="input-group-text"><i class="fa fa-restroom"></i></span>'+
                            '</div>'+
                            '<input class="form-control" name="nama_anak[]" id="nama_anak_id"   placeholder="Masukan Nama Anak"   />'+
                            '</div>'+
                      '</div>'+
                  '</div>'+
                '</div>'+

                '<div class="form-group col-md-4" id="ttl_anak" >'+
                '<div class="row">'+
                    '<div class="col-md-12">'+
                        '<label for="anak">Tanggal Lahir Anak:</label>'+
                          '<div class="input-group">'+
                            '<div class="input-group-prepend">'+
                              '<span class="input-group-text"><i class="fa fa-restroom"></i></span>'+
                            '</div>'+
                            '<input class="form-control" type="date" name="ttl_anak[]" id="ttl_anak_id"   />'+
                            '</div>'+
                      '</div>'+
                  '</div>'+
                '</div>'+

                '<div class="form-group col-md-4" id="jenis_kelamin_anak" >'+
                '<div class="row">'+
                    '<div class="col-md-12">'+
                        '<label for="anak">Jenis Kelamin Anak:</label>'+
                          '<div class="input-group">'+
                            '<div class="input-group-prepend">'+
                              '<span class="input-group-text"><i class="fa fa-restroom"></i></span>'+
                            '</div>'+
                            '<select class="form-control" name="jenis_kelamin_anak[]" id="jenis_kelamin_anak_id" >'+
                              
                              '<option value="">Pilih Jenis Kelamin</option>'+
                              '<option value="Laki-Laki">Laki-laki</option>'+
                              '<option value="perempuan">Perempuan</option>'+

                            '</select>'+
                            '</div>'+
                      '</div>'+

                  '</div>'+
                '</div>'+


                '&nbsp;&nbsp;&nbsp;<a href="#" class="del_anak btn btn-danger btn-xs" title="Hapus tambahan"><span class="fa fa-trash"> </span</a>'+
                '<div>'
                );
               //add input box
            } else {
                alert('Melebihi Batas Maksimum')
            }

        });


      $(wrapper_anak).on("click", ".del_anak", function(e) {
            e.preventDefault();
            $(this).parent('div').remove();
            o--;
        })
       
    });



</script>





<style type="text/css">
          hr.new4 {
    border: 1px solid #5bc0de;
  }
</style>
@include('sweet::alert')
@endsection
