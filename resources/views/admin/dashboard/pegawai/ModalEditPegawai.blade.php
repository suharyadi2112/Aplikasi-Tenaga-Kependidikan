

<!------------------------------------------------ DATA DIRI---------------------------------------------------->
<div id="datadiri_edit" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div id="overlay">
              
      </div>
      <div class="modal-header bg-info">
        <h2 class="modal-title">Edit Data Diri</h2>

        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form data-route="{{ Route('EditDataDiri',['id' => $Ddiri->id_data_diri]) }}" id="UpdateDataDiri" role="form" data-toggle="validator" method="put" accept-charset="utf-8">
        {{ csrf_field() }}
    
        <div class="modal-body mx-auto">
         <h5>Data Diri Umum :</h5>
          <div class="card-body row" style="padding: 1px;">

                    <div class="col-md-3">
                      <div class="form-group">
                      <label>Nama Lengkap :</label>
                       <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                          </div>
                          <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
                          
                        </div>
                       </div>
                      <!-- /.form group -->
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                      <label>Nama Mandarin :</label>
                       <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                          </div>
                          <input type="text" class="form-control" name="nama_mandarin" id="nama_mandarin">
                          
                        </div>
                       </div>
                      <!-- /.form group -->
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                      <label>Nomor KTP :</label>
                       <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                          </div>
                          <input type="text" class="form-control" name="nomor_ktp" id="nomor_ktp" required onkeypress="return isNumberKey(event)">
                          
                        </div>
                       </div>
                      <!-- /.form group -->
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                      <label>Durasi KTP :</label>
                       <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-hourglass-start"></i></span>
                          </div>
                           <select name="durasi_ktp" class="form-control" id="berlaku_sd" required>
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
                      <!-- /.form group -->
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                      <label>Nomor NPWP :</label>
                       <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                          </div>
                          <input type="text" class="form-control" name="nomor_npwp" id="nomor_npwp" onkeypress="return isNumberKey(event)">
                          
                        </div>
                       </div>
                      <!-- /.form group -->
                    </div>

                    <div class="col-md-3">
                      <div class="form-group cekperubahan">
                      <label>Provinsi Tempat Lahir :</label>
                       <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-map-marked-alt"></i></span>
                            </div>
                            <select class="form-control selectedit " id="provinsi" name="provinsi_lahir" required >
                                @foreach ($list_provinsi as $item_provinsi)
                                <option value="{{$item_provinsi->id_prov}}">{{$item_provinsi->nama}}</option>                                        
                                @endforeach
                            </select>
                          
                        </div>
                       </div>
                      <!-- /.form group -->
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                      <label>Kabupaten/Kota Tempat Lahir :</label>
                       <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-map-marked-alt"></i></span>
                          </div>
                            <select class="form-control select " id="kabupatenkota" name="kota_lahir" required >
                                <option value="{{ $Ddiri->kota_lahir }}">{{ $Ddiri->nama_kab }}</option>
                            </select>
                          
                        </div>
                       </div>
                      <!-- /.form group -->
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                      <label>Tanggal Lahir :</label>
                       <div class="input-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                            </div>
                          <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required >
                          </div>
                          
                        </div>
                       </div>
                      <!-- /.form group -->
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                      <label>Email :</label>
                       
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-at"></i></span>
                          </div>
                          <input class="form-control" type="email" name="email" value="{{ $Ddiri->email }}" placeholder="Masukan Alamat Email" required="" />
                        </div>
                          
                       </div>
                      <!-- /.form group -->
                    </div>
                   

                    

                    <div class="col-md-3">
                      <div class="form-group">
                      <label>Nomor Telepon :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-phone-alt"></i></span>
                          </div>
                          <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" data-inputmask='"mask": "9999-9999-9999-9999"' data-mask placeholder="masukan nomor telepon" required="">
                        </div>

                          
                       </div>
                      <!-- /.form group -->
                    </div>
                    
                    <div class="col-md-3">
                      <div class="form-group">
                      <label>Nomor Telepon 2:</label>
                       <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-phone-alt"></i></span>
                          </div>
                          <input class="form-control" name="nomor_telepon_2" id="nomor_telepon_2" placeholder="nomor telepon 2" data-inputmask='"mask": "9999-9999-9999-9999"' data-mask/>
                        </div>
                          
                       </div>
                      <!-- /.form group -->
                    </div>
               
                    <div class="col-md-3">
                      <div class="form-group">
                      <label>Nomor Whatsapp :</label>
                       
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-comments"></i></span>
                          </div>
                          <input class="form-control" name="nomor_wa" id="nomor_wa" placeholder="nomor WhatsApp" data-inputmask='"mask": "9999-9999-9999-9999"' data-mask/>
                        </div>
                          
                       </div>
                      <!-- /.form group -->
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                      <label>Alamat Sekarang :</label>
                       
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                          </div>
                          <textarea class="form-control" name="alamat_sekarang" placeholder="Masukan Alamat Tinggal" required="" >{{ $Ddiri->alamat_sekarang }}</textarea>
                        </div>
                          
                       </div>
                      <!-- /.form group -->
                    </div>
                    <div class="form-group col-md-3">
                        <div class="row">
                            <div class="col-md-12">
                              <label for="Suku">Suku :</label>
                              <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                              </div>
                                <input class="form-control" name="suku" value="{{ $Ddiri->suku }}" required="" placeholder="Masukan Suku"/>
                              </div>
                              <font style="color: #007bff" size="2px">*Wajib diisi</font>
                              <div class="help-block with-errors text-danger"></div>
                              </div>
                          </div>
                      </div>
                    <div class="form-group col-md-3">
                        <div class="row">
                            <div class="col-md-12">
                              <label for="Suku">Status Marital :</label>
                              <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                              </div>
                                <select class="form-control" name="sts_marital" required="">
                                  <option value="">Pilih Status Marital</option>
                                  <option value="Lajang" @if($Ddiri->status_marital == "Lajang") selected=""  @endif>Lajang</option>
                                  <option value="Menikah"  @if($Ddiri->status_marital == "Menikah") selected=""  @endif>Menikah</option>
                                </select>
                              </div>
                              <font style="color: #007bff" size="2px">*Wajib diisi</font>
                              <div class="help-block with-errors text-danger"></div>
                              </div>
                          </div>
                      </div>
                    <div class="col-md-12">
                     
                    </div>


                    <div class="col-md-3">
                      <div class="form-group">
                        <label>Agama :</label>
                        <table border="0" class="table table-sm table-bordered table-responsive">
                            <tr>
                              <thead class="bg-info">
                                <th colspan="7"><center>Jenis</center></th>
                              </thead>
                              <tbody>
                                <td>
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2a" value="Islam" name="agama" required="" @if($Ddiri->agama=='Islam') checked="checked" @endif>
                                    <label for="radioPrimary2a">
                                      Islam
                                    </label>
                                  </div>
                                </td>
                                <td>
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2b" value="Kristen" name="agama" required="" @if($Ddiri->agama=='Kristen') checked="checked" @endif>
                                    <label for="radioPrimary2b" >
                                      Kristen
                                    </label>
                                  </div>
                                </td>
                                <td>
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2c" value="Katolik" name="agama" required=""  @if($Ddiri->agama=='Katolik') checked="checked" @endif>
                                    <label for="radioPrimary2c" >
                                      Katolik
                                    </label>
                                  </div>
                                </td>
                                <td>
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2d" value="Hindu" name="agama" required="" @if($Ddiri->agama=='Hindu') checked="checked" @endif>
                                    <label for="radioPrimary2d" >
                                      Hindu
                                    </label>
                                  </div>
                                </td>
                                <td>
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2e" value="Buddha" name="agama" required="" @if($Ddiri->agama=='Buddha') checked="checked" @endif>
                                    <label for="radioPrimary2e" >
                                      Buddha
                                    </label>
                                  </div>
                                </td>
                                <td>
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary22112" class="cek_maitri" value="Buddha Maitreya" name="agama" required="" @if($Ddiri->agama=='Buddha Maitreya') checked="checked" @endif>
                                    <label for="radioPrimary22112" >
                                      Buddha Maitreya
                                    </label>
                                  </div>
                                </td>
                                <td>
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2f" value="Konghucu" name="agama" required="" @if($Ddiri->agama=='Konghucu') checked="checked" @endif>
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

                 
                   


                    <div class="col-md-5">
                      <div class="form-group">
                      <label>Status Tempat Tinggal :</label>
                       
                        <table border="0" class="table table-sm table-bordered table-responsive">
                          <tr>
                            <thead class="bg-info">
                              <th colspan="5"><center>Kepemilikan Tempat Tinggal</center></th>
                            </thead>
                            <tbody>
                              <td>
                                <div class="icheck-primary d-inline">
                                  <input type="radio" id="radioPrimary5" value="Sewa" name="kepemilikan_tempat_tinggal" required="" @if($Ddiri->status_tempat_tinggal=='Sewa') checked="checked" @endif>
                                  <label for="radioPrimary5">
                                    Sewa
                                  </label>
                                </div>
                              </td>
                              <td>
                                <div class="icheck-primary d-inline">
                                  <input type="radio" id="radioPrimary6" value="Milik Sendiri" name="kepemilikan_tempat_tinggal" required="" @if($Ddiri->status_tempat_tinggal=='Milik Sendiri') checked="checked" @endif>
                                  <label for="radioPrimary6">
                                    Milik Sendiri
                                  </label>
                                </div>
                              </td>
                              <td>
                                <div class="icheck-primary d-inline">
                                  <input type="radio" id="radioPrimary7" value="Milik Keluarga" name="kepemilikan_tempat_tinggal" required="" @if($Ddiri->status_tempat_tinggal=='Milik Keluarga') checked="checked" @endif>
                                  <label for="radioPrimary7">
                                    Milik Keluarga
                                  </label>
                                </div>
                              </td>
                              <td>
                                <div class="icheck-primary d-inline">
                                  <input type="radio" id="radioPrimary8" value="Kos" name="kepemilikan_tempat_tinggal" required="" @if($Ddiri->status_tempat_tinggal=='Kos') checked="checked" @endif>
                                  <label for="radioPrimary8">
                                    Kos
                                  </label>
                                </div>
                              </td>
                              <td>
                                <div class="icheck-primary d-inline">
                                  <input type="radio" id="radioPrimary9" value="Kontrak" name="kepemilikan_tempat_tinggal" required="" @if($Ddiri->status_tempat_tinggal=='Kontrak') checked="checked" @endif>
                                  <label for="radioPrimary9">
                                    Kontrak
                                  </label>
                                </div>
                              </td>
                            </tbody>
                          </tr>
                        </table>


                       </div>
                      <!-- /.form group -->
                    </div>



                    <div class="col-md-2">
                      <div class="form-group">
                      <label>Golongan Darah :</label>
                       <table border="0" class="table table-sm table-responsive">
                          <tr>
                          <thead class="bg-info">
                            <th colspan="5">
                              Jenis
                            </th>
                           
                          </thead>   

                          <tbody>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary1" value="A" name="golongan_darah" required=""  @if($Ddiri->golongan_darah=='A') checked="checked" @endif>
                                <label for="radioPrimary1">
                                  A
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary2" value="B" name="golongan_darah" required="" @if($Ddiri->golongan_darah=='B') checked="checked" @endif>
                                <label for="radioPrimary2">
                                B
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary3" value="AB" name="golongan_darah" required="" @if($Ddiri->golongan_darah=='AB') checked="checked" @endif>
                                <label for="radioPrimary3">
                                  AB
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="radioPrimary4" value="O" name="golongan_darah" required="" @if($Ddiri->golongan_darah=='O') checked="checked" @endif>
                                <label for="radioPrimary4">
                                O
                                </label>
                              </div>
                            </td>
                            <td>
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="TidakTahu" value="Tidak Tahu" name="golongan_darah" required="" @if($Ddiri->golongan_darah=='Tidak Tahu') checked="checked" @endif>
                                <label for="TidakTahu">
                                Tidak Tahu
                                </label>
                              </div>
                            </td>
                          </tbody>
                          </tr>
                        </table>
                       </div>
                      <!-- /.form group -->
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                      <label for="jenis_kelamin">Jenis Kelamin :</label>
                        
                        <table border="0" class="table table-sm table-bordered ">
                          <tr>
                            <thead class="bg-info">
                              <th colspan="5"><center>Jenis Kelamin</center></th>
                            </thead>
                            <tbody>
                              <td>
                                <div class="icheck-primary d-inline">
                                  <input type="radio" id="radioPrimary10" value="Pria" name="jenis_kelamin" required="" @if($Ddiri->jenis_kelamin=='Pria') checked="checked" @endif>
                                  <label for="radioPrimary10">
                                    Pria
                                  </label>
                                </div>
                              </td>
                              <td>
                                <div class="icheck-primary d-inline">
                                  <input type="radio" id="radioPrimary11" value="Wanita" name="jenis_kelamin" required="" @if($Ddiri->jenis_kelamin=='Wanita') checked="checked" @endif>
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


                  <div class="form-group col-md-12">
                    <div class="row">
                      
                    </div>
                  </div>

                  <div class="form-group col-md-4">
                      <div class="row">
                          <div class="col-md-12" > 
                          <label for="vegetarian">Vegetarian ? : <font style="color: #007bff" size="2px">*Khusus Umat Maitreya</font></label>
                          
                          <table border="0" class="table table-sm table-bordered">
                            <tr>
                              <thead class="bg-info">
                                <th colspan="5"><center>Status Vege ?</center></th>
                              </thead>
                              <tbody>
                                <td>
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="ikrarradio" value="Ikrar" name="ikrarvege" @if($Ddiri->vege=='Ikrar') checked="checked" @endif>
                                    <label for="ikrarradio">
                                      Ikrar
                                    </label>
                                  </div>
                                </td>
                                <td>
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="ikrarradio12" value="Belum Ikrar" name="ikrarvege" @if($Ddiri->vege=='Belum Ikrar') checked="checked" @endif>
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


                    <div class="form-group col-md-4" >
                      <div class="row">
                          <div class="col-md-12" id="showikrartahun">
                            <label for="Suku">Ikrar Tahun :<font style="color: #007bff" size="2px">*Khusus Umat Maitreya</font></label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                              <select class="form-control" id="tahunikrar" name="ikrartahun" >
                              </select>
                              
                            </div>
                            </div>
                        </div>
                    </div>



                    <div class="form-group col-md-4">
                      <div class="row">
                          <div class="col-md-12" >
                          <label for="status">Status Di Vihara <font style="color: #007bff" size="2px">*Khusus Umat Maitreya</font></label>
                          
                          <table border="0" class="table table-sm table-bordered">
                            <tr>
                              <thead class="bg-info">
                                <th colspan="5"><center>Status</center></th>
                              </thead>
                              <tbody>
                                <td>
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="status_vihara" value="Iya" name="QiuDao" @if($Ddiri->qiudao=='Iya') checked="checked" @endif>
                                    <label for="status_vihara">
                                      Sudah Qiu Dao
                                    </label>
                                  </div>
                                </td>
                                <td>
                                  <div class="icheck-primary d-inline">
                                    <input type="radio" id="status_vihara12" value="Tidak" name="QiuDao" @if($Ddiri->qiudao=='Tidak') checked="checked" @endif> 
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




                     <div class="form-group col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                            <label for="status">Detail Status Di Vihara <font style="color: #007bff" size="2px">*Khusus Umat Maitreya, Jika Sudah <b>Qiu Dao</b></font></label>
                            
                            <table border="0" class="table table-sm table-bordered">
                              <tr>
                                <thead class="bg-info">
                                  <th colspan="5"><center>Status</center></th>
                                </thead>
                                <tbody>
                                  <td>
                                    <div class="icheck-primary d-inline">
                                      <input type="radio" id="DaoQin" value="Dao Qin" name="detailqiudao" @if($Ddiri->jenis_qiudao=='Dao Qin') checked="checked" @endif>
                                      <label for="DaoQin">
                                        Dao Qin 
                                      </label>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="icheck-primary d-inline">
                                      <input type="radio" id="FoYuan" value="Fo Yuan" name="detailqiudao" @if($Ddiri->jenis_qiudao=='Fo Yuan') checked="checked" @endif>
                                      <label for="FoYuan" >
                                        Fo Yuan
                                      </label>
                                    </div>
                                  </td>
                                  <td>
                                    <div class="icheck-primary d-inline">
                                      <input type="radio" id="TanZhu" value="Tan Zhu" name="detailqiudao" @if($Ddiri->jenis_qiudao=='Tan Zhu') checked="checked" @endif>
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



                 
            </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ubah Data Diri</button>
      </div>
      </form>
      
    </div>
  </div>
</div>

<!------------------------------------------------ DATA DIRI---------------------------------------------------->




<!---------------------------------------------IDENTITAS LAINNYA ------------------------------------------------>

<div id="identitas_edit" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog ">
    <div class="modal-content">
       <div id="overlayiden">
    
        </div> 
      <div class="modal-header bg-info">
        <h3 class="modal-title">Edit Identitas Lainnya </h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form data-route="{{ Route('EditIdentitasDataPegawai',['id_user' => $id_user]) }}" id="UpdateIdentitas" role="form" data-toggle="validator" method="POST" accept-charset="utf-8">
        {{ csrf_field() }}
       
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;">

              <table border="0" class="table table-sm table-responsive">
                <hr>
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
                      <input type="hidden" name="kartu_keluarga" value="">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary1" name="iden[]" value="KARTU KELUARGA" 

                        @foreach($iden as $showEiden)
                        @if($showEiden->jenis=='KARTU KELUARGA') 

                        checked="checked" 

                        @endif
                        @endforeach

                        >
                        <label for="checkboxPrimary1">
                          KK
                        </label>
                      </div>
                    </td>
                    <td style="width: 50px"> </td>
                    <td>
                      <input type="hidden" name="paspor" value="">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary2" name="iden[]" value="PASPOR" 
                        @foreach($iden as $showEiden)
                        @if($showEiden->jenis=='PASPOR') 

                        checked="checked" 

                        @endif
                        @endforeach>
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
                      <input type="hidden" name="sim_a" value="">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary3" name="iden[]" value="SIM A" 
                        @foreach($iden as $showEiden)
                        @if($showEiden->jenis=='SIM A') 

                        checked="checked" 

                        @endif
                        @endforeach
                        >
                        <label for="checkboxPrimary3">
                          SIM A
                        </label>
                      </div>
                    </td>
                    <td> </td>
                    <td>
                      <input type="hidden" name="sim_b" value="">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary4" name="iden[]" value="SIM B" 
                        @foreach($iden as $showEiden)
                        @if($showEiden->jenis=='SIM B') 

                        checked="checked" 

                        @endif
                        @endforeach>
                        <label for="checkboxPrimary4">
                          SIM B
                        </label>
                      </div>
                    </td>
                    <td> </td>
                    <td>
                      <input type="hidden" name="sim_c" value="">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary5" name="iden[]" value="SIM C"
                        @foreach($iden as $showEiden)
                        @if($showEiden->jenis=='SIM C') 

                        checked="checked" 

                        @endif
                        @endforeach>
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
                      <input type="hidden" name="bpjs_kesehatan" value="">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary6" name="iden[]" value="BPJS KESEHATAN" 
                        @foreach($iden as $showEiden)
                        @if($showEiden->jenis=='BPJS KESEHATAN') 

                        checked="checked" 

                        @endif
                        @endforeach>
                        <label for="checkboxPrimary6">
                        Kesehatan
                        </label>
                      </div>
                    </td>
                    <td> </td>
                    <td>
                       <input type="hidden" name="bpjs_tenagakerja" value="">
                       <div class="icheck-primary d-inline">
                          <input type="checkbox" id="checkboxPrimary7" name="iden[]" value="BPJS KETENAGAKERJAAN" 
                          @foreach($iden as $showEiden)
                          @if($showEiden->jenis=='BPJS KETENAGAKERJAAN') 

                          checked="checked" 

                          @endif
                          @endforeach>
                          <label for="checkboxPrimary7">
                          Ketenagakerjaan
                          </label>
                      </div>
                    </td>
                    <td> </td>
                    <td style="width: 200px"> 
                      <input type="hidden" name="bpjs_jaminanpensiun" value="">
                      <div class="icheck-primary d-inline">
                        <input type="checkbox" id="checkboxPrimary8" name="iden[]" value="BPJS JAMINAN PENSIUN" 
                        @foreach($iden as $showEiden)
                        @if($showEiden->jenis=='BPJS JAMINAN PENSIUN') 

                        checked="checked" 

                        @endif
                        @endforeach
                        >
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ubah Identitas</button>
      </div>
      </form>
      
    </div>
  </div>
</div>

<!---------------------------------------------IDENTITAS LAINNYA ------------------------------------------------>


<!----------------------------------------------EDIT SEKOLAH SMA SEDERAJAT  ------------------------------------------------>
<div id="sma_sederajat" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
       <div id="overlayiden">
    
        </div> 
      <div class="modal-header bg-info">
        <h3 class="modal-title">Edit Sekolah Menengah Atas (Sederajat)</h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form action="{{ Route('EditSmaSederajat') }}" role="form"  method="post" accept-charset="utf-8">
        @csrf
       
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;">

              <input type="hidden" name="id_sma" id="idsma">

               <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Nama Sekolah :</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-university"></i></span>
                        </div>
                          <textarea class="form-control" name="nama_sekolah" id="nama_sma" placeholder="Masukan Nama Sekolah" required></textarea>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
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
                          <input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Masukan Jurusan" required>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
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
                          <input type="month" class="form-control" id="mulaisma" name="mulai_pendidikan"  placeholder="Pilih Tanggal" required> 
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Jurusan :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-hourglass-end"></i></span>
                          </div>
                          <input type="month" class="form-control" id="selesaisma" name="selesai_pendidikan"  placeholder="Pilih Tanggal" required>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ubah SMA Sederajat</button>
      </div>
      </form>
      
    </div>
  </div>
</div>
<!----------------------------------------------EDIT SEKOLAH SMA SEDERAJAT ------------------------------------------------>


<!----------------------------------------------TAMBAH SEKOLAH SMA SEDERAJAT  ------------------------------------------------>
<div id="sma_sederajat_tambah" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
       <div id="overlayiden">
    
        </div> 
      <div class="modal-header bg-info">
        <h3 class="modal-title">Tambah Sekolah Menengah Atas (Sederajat)</h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form action="{{ Route('TambahSmaSederajat') }}" role="form"  method="post" accept-charset="utf-8">
        @csrf
       
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;">

              <input type="hidden" name="id_user" value="{{ $id_user }}">

               <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Nama Sekolah :</label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fa fa-university"></i></span>
                        </div>
                          <textarea class="form-control" name="nama_sekolah" placeholder="Masukan Nama Sekolah" required></textarea>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
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
                          <input type="text" class="form-control" name="jurusan" placeholder="Masukan Jurusan" required>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
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
                          <input type="month" class="form-control" name="mulai_pendidikan"  placeholder="Pilih Tanggal" required> 
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Jurusan :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-hourglass-end"></i></span>
                          </div>
                          <input type="month" class="form-control" name="selesai_pendidikan"  placeholder="Pilih Tanggal" required>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah SMA Sederajat</button>
      </div>
      </form>
      
    </div>
  </div>
</div>
<!----------------------------------------------EDIT SEKOLAH SMA SEDERAJAT ------------------------------------------------>



<!----------------------------------------------EDIT DATA PERTING ------------------------------------------------>
<div id="edit_perting" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
       <div id="overlayiden">
    
        </div> 
      <div class="modal-header bg-info">
        <h3 class="modal-title">Edit Perguruan Tinggi</h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form action="{{ Route('EditPerting') }}" role="form"  method="post" accept-charset="utf-8">
        @csrf
       
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;">

              <input type="hidden" name="id_perting" id="id_perting">

               <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                          <label for="nama_perguruantinggi">Nama Lengkap Perguruan Tinggi :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-university"></i></span>
                          </div>
                          <textarea class="form-control"  pattern="[a-z A-Z 0-9]{1,30}" id="nama_sekolah_perting" name="nama_sekolah_perting" id="diploma_namaperguruan" placeholder="Masukan Nama Perguruan Tinggi" required></textarea>
                        </div>
                          <font style="color: #007bff" size="2px">*Wajib Diisi</font>
                          <div class="help-block with-errors text-danger"></div>
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
                          <select class="form-control" name="tingkat_perting" id="tingkat_perting" required>
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
                          <div class="help-block with-errors text-danger"></div>
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
                          <input type="text" class="form-control" name="jurusan_perting" id="jurusan_perting" placeholder="Masukan Program Studi" required>
                        </div>
                          <div class="help-block with-errors text-danger"></div>
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
                          <input type="text" class="form-control" name="ipk_perting" id="ipk_perting" placeholder="Masukan IPK"  maxlength="5" required>
                        </div>
                          <div class="help-block with-errors text-danger"></div>
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
                            <input type="month" class="form-control" id="mulai_pendidikan_perting" name="mulai_pendidikan_perting" value="" placeholder="Pilih Tanggal" autocomplete="off" required> 
                          </div>
                          <div class="help-block with-errors text-danger"></div>
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
                            <input type="month" class="form-control" id="selesai_pendidikan_perting" name="selesai_pendidikan_perting" value=""  placeholder="Pilih Tanggal" autocomplete="off" required>
                          </div>
                              <div class="help-block with-errors text-danger"></div>
                        </div>
                    </div>
                  </div>

            </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Ubah Perguruan Tinggi</button>
      </div>
      </form>
      
    </div>
  </div>
</div>
<!----------------------------------------------EDIT DATA PERTING ----------------------------------------------->






<!----------------------------------------------TAMBAH PERGURUAN TINGGI------------------------------------------->
<div id="tambah_perting" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
       <div id="overlayiden">
    
        </div> 
      <div class="modal-header bg-info">
        <h3 class="modal-title">Tambah Perguruan Tinggi</h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form action="{{ Route('TambahPertingPeg') }}" role="form"  method="post" accept-charset="utf-8">
        @csrf
       
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;">

              <input type="hidden" name="id_user" value="{{ $id_user }}">

               <div class="form-group col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                          <label for="nama_perguruantinggi">Nama Lengkap Perguruan Tinggi :</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-university"></i></span>
                          </div>
                          <textarea class="form-control"  pattern="[a-z A-Z 0-9]{1,30}" name="nama_sekolah_perting" id="diploma_namaperguruan" placeholder="Masukan Nama Perguruan Tinggi" required></textarea>
                        </div>
                          <font style="color: #007bff" size="2px">*Wajib Diisi</font>
                          <div class="help-block with-errors text-danger"></div>
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
                          <select class="form-control" name="tingkat_perting" required>
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
                          <div class="help-block with-errors text-danger"></div>
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
                          <input type="text" class="form-control" name="jurusan_perting"  placeholder="Masukan Program Studi" required>
                        </div>
                          <div class="help-block with-errors text-danger"></div>
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
                          <input type="text" class="form-control" name="ipk_perting" placeholder="Masukan IPK"  maxlength="5" required>
                        </div>
                          <div class="help-block with-errors text-danger"></div>
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
                            <input type="month" class="form-control"  name="mulai_pendidikan_perting" value="" placeholder="Pilih Tanggal" autocomplete="off" required> 
                          </div>
                          <div class="help-block with-errors text-danger"></div>
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
                            <input type="month" class="form-control" name="selesai_pendidikan_perting" value=""  placeholder="Pilih Tanggal" autocomplete="off" required>
                          </div>
                              <div class="help-block with-errors text-danger"></div>
                        </div>
                    </div>
                  </div>

            </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah Perguruan Tinggi</button>
      </div>
      </form>
      
    </div>
  </div>
</div>
<!----------------------------------------------TAMBAH PERGURUAN TINGGI---------------------------------------------->


<!----------------------------------------------MARITAL PASANGAN------------------------------------------------>

<div id="TambahMaritalPasangan" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h3 class="modal-title">Tambah Marital Pasangan </h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form action="{{ Route('TambahMaritalPasangan') }}" role="form"  method="POST" accept-charset="utf-8">
        @csrf
       
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;">

              <input type="hidden" name="id_user" value="{{$id_user}}">
              <div class="form-group col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <label for="suamiistri">Nama Suami/Istri:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-restroom"></i></span>
                            </div>
                            <input class="form-control" name="nama_pasangan" required=""  placeholder="Masukan Nama Suami Atau Istri"   />
                            </div>
                            <div class="help-block with-errors text-danger"></div>
                      </div>
                  </div>
                </div>
                <div class="form-group col-md-4">
                <div class="row">
                    <div class="col-md-12">
                      <label for="Pekerjaan">Pekerjaan:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-people-carry"></i></span>
                        </div>
                        <input class="form-control"  name="pekerjaan_pasangan"  placeholder="Masukan Pekerjaan Suami Atau Istri" />
                      </div>
                      <div class="help-block with-errors text-danger"></div>
                      </div>
                  </div>
                </div>
                <div class="form-group col-md-4">
                <div class="row">
                    <div class="col-md-12">
                      <label for="notelppasangan">Nomor Telepon Suami/Istri:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        </div>
                        <input class="form-control"  name="nomor_telepon_pasangan" required="" placeholder="Masukan Nomor Telepon Suami Atau Istri" data-inputmask='"mask": "9999-9999-9999-9999"' data-mask />
                      </div>
                      <div class="help-block with-errors text-danger"></div>
                      </div>
                  </div>
                </div>
                 
            </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah Marital Pasangan</button>
      </div>
      </form>
      
    </div>
  </div>
</div>

<!----------------------------------------------MARITAL PASANGAN------------------------------------------------>



<!----------------------------------------------MARITAL------------------------------------------------>

<div id="edit_maritalpasangan" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h3 class="modal-title">Edit Marital Pasangan </h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form action="{{ Route('EditMaritalPasangan') }}" role="form"  method="POST" accept-charset="utf-8">
        @csrf
       
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;">

              <input type="hidden" name="id_maritalpasangan" id="idpasangan">
              <div class="form-group col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <label for="suamiistri">Nama Suami/Istri:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-restroom"></i></span>
                            </div>
                            <input class="form-control" name="nama_pasangan" id="nama_pasangan2" required=""  placeholder="Masukan Nama Suami Atau Istri"   />
                            </div>
                            <div class="help-block with-errors text-danger"></div>
                      </div>
                  </div>
                </div>
                <div class="form-group col-md-4">
                <div class="row">
                    <div class="col-md-12">
                      <label for="Pekerjaan">Pekerjaan:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-people-carry"></i></span>
                        </div>
                        <input class="form-control"  name="pekerjaan_pasangan" id="pekerjaan_pasangan2"  placeholder="Masukan Pekerjaan Suami Atau Istri" />
                      </div>
                      <div class="help-block with-errors text-danger"></div>
                      </div>
                  </div>
                </div>
                <div class="form-group col-md-4">
                <div class="row">
                    <div class="col-md-12">
                      <label for="notelppasangan">Nomor Telepon Suami/Istri:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-phone"></i></span>
                        </div>
                        <input class="form-control"  name="nomor_telepon_pasangan" required="" id="nomor_telepon_pasangan2"  placeholder="Masukan Nomor Telepon Suami Atau Istri" data-inputmask='"mask": "9999-9999-9999-9999"' data-mask />
                      </div>
                      <div class="help-block with-errors text-danger"></div>
                      </div>
                  </div>
                </div>
                 
            </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Edit Marital Pasangan</button>
      </div>
      </form>
      
    </div>
  </div>
</div>



<div id="tambah_maritalanak" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h3 class="modal-title">Tambah Marital Anak </h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form action="{{ Route('TambahAnakMaritalPegawai') }}" role="form"  method="POST" accept-charset="utf-8">
        @csrf
       
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;">
              <input type="hidden" value="{{ $id_user }}" name="id_user">
              <div class="form-group col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <label for="anak">Nama Anak:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-restroom"></i></span>
                            </div>
                            <input class="form-control" name="nama_anak" required=""  placeholder="Masukan Nama Anak" />
                            </div>
                            <font style="color: #007bff" size="2px">*Wajib diisi</font>
                            <div class="help-block with-errors text-danger"></div>
                      </div>
                  </div>
                </div>

                <div class="form-group col-md-4" >
                <div class="row">
                    <div class="col-md-12">
                        <label for="anak">Tanggal Lahir Anak:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-restroom"></i></span>
                            </div>
                            <input class="form-control" type="date" name="ttl_anak" required="" />
                            </div>
                            <font style="color: #007bff" size="2px">*Wajib diisi</font>
                            <div class="help-block with-errors text-danger"></div>
                      </div>
                  </div>
                </div>

                <div class="form-group col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <label for="anak">Jenis Kelamin Anak:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-restroom"></i></span>
                            </div>
                            <select class="form-control" name="jenis_kelamin_anak" required="">
                              
                              <option value="">Pilih Jenis Kelamin</option>
                              <option value="Laki-Laki">Laki-laki</option>
                              <option value="perempuan">Perempuan</option>

                            </select>
                            </div>
                            <font style="color: #007bff" size="2px">*Wajib diisi</font>
                            <div class="help-block with-errors text-danger"></div>
                      </div>

                  </div>
                </div>
                 
            </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah Marital Anak</button>
      </div>
      </form>
      
    </div>
  </div>
</div>

<!--EDIT ANAK MARITAL--->

<div id="edit_anak" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h3 class="modal-title">Edit Marital Anak </h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form action="{{ Route('EditAnakMarital') }}" role="form"  method="POST" accept-charset="utf-8">
        @csrf
       
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;">
              <input type="hidden" name="id_anak" id="id_anak">
              <div class="form-group col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <label for="anak">Nama Anak:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-restroom"></i></span>
                            </div>
                            <input class="form-control" name="nama_anak" id="nama_anak_id" required=""  placeholder="Masukan Nama Anak" />
                            </div>
                            <font style="color: #007bff" size="2px">*Wajib diisi</font>
                            <div class="help-block with-errors text-danger"></div>
                      </div>
                  </div>
                </div>

                <div class="form-group col-md-4" >
                <div class="row">
                    <div class="col-md-12">
                        <label for="anak">Tanggal Lahir Anak:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-restroom"></i></span>
                            </div>
                            <input class="form-control" type="date" name="ttl_anak" id="ttl_anak_id" required="" />
                            </div>
                            <font style="color: #007bff" size="2px">*Wajib diisi</font>
                            <div class="help-block with-errors text-danger"></div>
                      </div>
                  </div>
                </div>

                <div class="form-group col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <label for="anak">Jenis Kelamin Anak:</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-restroom"></i></span>
                            </div>
                            <select class="form-control" name="jenis_kelamin_anak" id="jenis_kelamin_anak_id" required="">
                              
                              <option value="">Pilih Jenis Kelamin</option>
                              <option value="Laki-Laki">Laki-laki</option>
                              <option value="perempuan">Perempuan</option>

                            </select>
                            </div>
                            <font style="color: #007bff" size="2px">*Wajib diisi</font>
                            <div class="help-block with-errors text-danger"></div>
                      </div>

                  </div>
                </div>
                 
            </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Edit Marital Anak</button>
      </div>
      </form>
      
    </div>
  </div>
</div>

<!----------------------------------------------MARITAL ------------------------------------------------>




<!----------------------------------------------KONTAK DARURAT ------------------------------------------------>

<div id="edit_kontakdarurat" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h3 class="modal-title">Edit Kontak Darurat</h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form action="{{ Route('EditKontakDarurat') }}" role="form"  method="POST" accept-charset="utf-8">
        @csrf
       
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;">

              <input type="hidden" id="id_kontak" name="id_kontak">

              <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Kontak Darurat :<font style="color: #007bff" size="2px"> *yang dihubungi</font></label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                        </div>
                          <input class="form-control" name="nama_nodarurat" id="nama_nodarurat" required="" placeholder="Masukan Nama"/>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
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
                          <input class="form-control" name="hubungan_nodarurat" id="hubungan_nodarurat" required="" placeholder="Masukan Hubungan"/>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
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
                          <input class="form-control" name="nomor_darurat" required="" id="nomor_darurat" placeholder="Masukan Nomor Telepon" data-inputmask='"mask": "9999-9999-9999-9999"' data-mask/>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
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
                          <input class="form-control" name="kota_nodarurat" required="" id="kota_nodarurat" placeholder="Masukan Kota"/>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Edit Kontak Darurat</button>
      </div>
      </form>
      
    </div>
  </div>
</div>


<div id="tambah_kontakdarurat" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h3 class="modal-title">Tambah Kontak Darurat</h3>

        <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form action="{{ Route('TambahKontakDarurat') }}" role="form"  method="POST" accept-charset="utf-8">
        @csrf
       
        <div class="modal-body mx-auto">
            <div class="card-body row" style="padding: 1px;">

              <input type="hidden" value="{{ $id_user }}" name="id_user">

              <div class="form-group col-md-3">
                  <div class="row">
                      <div class="col-md-12">
                        <label for="kontakdarurat">Kontak Darurat :<font style="color: #007bff" size="2px"> *yang dihubungi</font></label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                        </div>
                          <input class="form-control" name="nama_nodarurat" required="" placeholder="Masukan Nama"/>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
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
                          <input class="form-control" name="hubungan_nodarurat" required="" placeholder="Masukan Hubungan"/>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
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
                          <input class="form-control" name="nomor_darurat" required=""  placeholder="Masukan Nomor Telepon" data-inputmask='"mask": "9999-9999-9999-9999"' data-mask/>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
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
                          <input class="form-control" name="kota_nodarurat" required="" placeholder="Masukan Kota"/>
                        </div>
                        <font style="color: #007bff" size="2px">*Wajib diisi</font>
                        <div class="help-block with-errors text-danger"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah Kontak Darurat</button>
      </div>
      </form>
      
    </div>
  </div>
</div>
<!----------------------------------------------KONTAK DARURAT ------------------------------------------------>
