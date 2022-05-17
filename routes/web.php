<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::view('homepage','homepage');
Route::resource('/posts', 'PostController'); 
//Route::view('welcome','welcome');

/*Route::get('test', function () {
    event(new App\Events\StatusLiked('Someone'));
    return "Event has been sent!";
});*/

 


 

//Route as admin\
Route::get('/home', array('as' => 'admin', 'uses' => 'AdminController@index'));
Route::get('/dashboard', array('as' => 'admin', 'uses' => 'AdminController@index'));

Route::group(['middleware' => 'auth'], function(){

	Route::post('/notif/view',array('as'=>'notif.view', 'uses' => 'SuratTugas\SuratTugasController@notif'));


	Auth::routes(['register' => false,'reset' => false]);

	////////user////////
	//index
	
	//Route::get('/user',array('as'=>'user', 'uses' => 'Auth\UserController@index'));
	Route::get('/user', 'Auth\UserController@index')->name('UserIndex');
	Route::get('/datauser',array('as'=>'user.data', 'uses' => 'Auth\UserController@prodilist'));
	//tambah
	Route::get('/user/tambah',array('as'=>'user.tambah.show', 'uses' => 'Auth\UserController@showtambah'));
	Route::post('/datauser/tambah',array('as'=>'user.tambah', 'uses' => 'Auth\UserController@tambahakun'));
	//hapus
	Route::get('datauser/destroy/{id}', 'Auth\UserController@destroy');
	//resetpass
	Route::get('datauser/reset/{id}', 'Auth\UserController@reset');
	//changePassword
	Route::get('/changePassword',array('as'=>'user.changepassword', 'uses' => 'Auth\UserController@showChangePasswordForm'));
	Route::post('simpan/changePassword','Auth\UserController@changePassword')->name('simpan/changePassword');
	//edit
	Route::get('/user/{id}/edit',array('as'=>'user.edit', 'uses' => 'Auth\UserController@edituser'));
	Route::put('/user/{id}/simpanedit',array('as'=>'user.simpan.edit', 'uses' => 'Auth\UserController@simpanedit'));
	////////user////////



	////////Kategori Sebagai////////
	//index
	Route::get('/kategori',array('as'=>'kategori.show', 'uses' => 'KategoriSebagai\KategoriController@index'));
	Route::get('/datakategori',array('as'=>'kategori.data', 'uses' => 'KategoriSebagai\KategoriController@kategorilist'))
	;
	//tambah
	Route::get('/tambahkat',array('as'=>'kategori.tambah', 'uses' => 'KategoriSebagai\KategoriController@showtambah'));
	Route::post('/simpankat',array('as'=>'kategori.simpan', 'uses' => 'KategoriSebagai\KategoriController@tambahprodi'));
	//hapus
	Route::get('/kat/{id}/destroy',array('as'=>'kategori.destroy', 'uses' => 'KategoriSebagai\KategoriController@destroy'));
	//edit
	Route::get('/kat/{id}/edit',array('as'=>'kategori.edit', 'uses' => 'KategoriSebagai\KategoriController@showedit'));
	Route::put('/editkat/{id}/egori',array('as'=>'kategori.editkat', 'uses' => 'KategoriSebagai\KategoriController@simpanedit'));
	////////Kategori Sebagai////////




	////////////////////////////////PEGAWAI/////////////////////////////

	//2.0
	Route::get('/pegawai',array('as'=>'pegawai.show', 'uses' => 'Pegawai\PegawaiController@index'));
	Route::get('/pegawaidata',array('as'=>'pegawai.data', 'uses' => 'Pegawai\PegawaiController@pegawailist'));
	//Route::post('/simpanpegawai',array('as'=>'pegawai.simpan', 'uses' => 'Pegawai\PegawaiController@tambahpegawai'));
	Route::post('simpanpegawai', 'Pegawai\PegawaiController@tambahpegawai')->name('simpanpegawai');
	Route::post('CekUserPeg', 'Pegawai\PegawaiController@CekUserPeg')->name('CekUserPeg');
	//route pegawai 2.0
	Route::post('tambahpegawai/', 'Pegawai\PegawaiController@showtambah')->name('showtambahPegawai');
	//Route::get('/tambahpegawai',array('as'=>'pegawai.tambah', 'uses' => 'Pegawai\PegawaiController@showtambah'));

	//ADD DATA DIRI PEGAWAI 2.0

	Route::match(['get', 'post'],'/datpeg/{id}',  'Pegawai\PegawaiController_20@DataDiriPegawai')->name('DataDiriPegawai');
	Route::get('PegawaiAddDataDiri_2.0/{id_user}', 'Pegawai\PegawaiController_20@PegawaiAddDataDiri')->name('PegawaiAddDataDiri');
	Route::post('ProsesSimpanData/', 'Pegawai\PegawaiController_20@PegawaiProsesSimpanData')->name('PegawaiProsesSimpanData');

	//SMA PEGAWAI
	Route::post('/tambah_smasederajat', 'Pegawai\PegawaiController_20@TambahSmaSederajat')->name('TambahSmaSederajat');
	//PERTING PEGAWAI
	Route::post('/TambahPertingPeg/pk', 'Pegawai\PegawaiController_20@TambahPertingPeg')->name('TambahPertingPeg');
	//MARITAL PASANGAN
	Route::post('/TambahMaritalPasangan/', 'Pegawai\PegawaiController_20@TambahMaritalPasangan')->name('TambahMaritalPasangan');
	Route::get('/HapusMaritalPasangan/{id}', 'Pegawai\PegawaiController_20@HapusMaritalPasangan')->name('HapusMaritalPasangan');

	//MARITAL ANAK
	Route::post('/tambahanakPeg/', 'Pegawai\PegawaiController_20@TambahAnakMaritalPegawai')->name('TambahAnakMaritalPegawai');
	Route::post('/editanakmarital/', 'Pegawai\PegawaiController_20@EditAnakMarital')->name('EditAnakMarital');

	//KONTAK DARURAT
	Route::post('/tambah/kontak/darurat', 'Pegawai\PegawaiController_20@TambahKontakDarurat')->name('TambahKontakDarurat');
	Route::get('/Destroy/{id}', 'Pegawai\PegawaiController_20@HapusKonDar')->name('HapusKonDar');

	//Edit Identitas
	Route::post('/EditIdentitasDataPegawai/{id_user}', 'Pegawai\PegawaiController_20@EditIdentitasDataPegawai')->name('EditIdentitasDataPegawai');

	Route::post('lht_jabmatan/{id}', 'Pegawai\PegawaiController@lht_jabatan')->name('lht_jabatan');
	Route::post('UbahNamaJabatan/', 'Pegawai\PegawaiController@UbahNamaJabatan')->name('UbahNamaJabatan');
	Route::get('DestoryJabPegawai/{id}', 'Pegawai\PegawaiController@destroyjabatan')->name('DestoryJabPegawai');
	Route::get('/pegawai/{id}/edit/',array('as'=>'pegawai.showedit', 'uses' => 'Pegawai\PegawaiController@showedit'));
	Route::post('TambahHonorView2_0/{id}', 'Pegawai\PegawaiController@TambahHonorView')->name('TambahHonorView2_0');
	
	//KATEGORI JABATAN
	Route::post('TambahKatJab/', 'Pegawai\PegawaiController@TambahKatJab')->name('TambahKatJab');
	Route::post('EditKatJab/', 'Pegawai\PegawaiController@EditKatJab')->name('EditKatJab');
	Route::post('TambahDetailSaja/', 'Pegawai\PegawaiController@TambahDetailSaja')->name('TambahDetailSaja');
	Route::post('DestroyDetailJab/', 'Pegawai\PegawaiController@DestroyDetailJab')->name('DestroyDetailJab');
	Route::post('DestroyKatab/', 'Pegawai\PegawaiController@DestroyKatab')->name('DestroyKatab');
	Route::post('UpdateDetJab/', 'Pegawai\PegawaiController@UpdateDetJab')->name('UpdateDetJab');
	
	//HONOR/JABATAN FUNGSIONAL 2.0
	Route::post('LihatJabFungsional/{id}', 'Pegawai\PegawaiController@LihatJabFungsional')->name('LihatJabFungsional');
	Route::post('ViewEditHonor/{id}', 'Pegawai\PegawaiController@ViewEditHonor')->name('ViewEditHonor');
	Route::post('ViewEditPeg/{id}', 'Pegawai\PegawaiController@ViewEditPeg')->name('ViewEditPeg');
	Route::post('ProsesEditPeg/', 'Pegawai\PegawaiController@simpanedit')->name('SimpanEditPegawai');

	//KATEGORI JABATAN
	Route::get('Kategori/Jabatan','Pegawai\PegawaiController@ViewKategoriJabatan')->name('KategoriJabatan');
	Route::get('Kategori/Data','Pegawai\PegawaiController@GetDataKatJabatan')->name('GetDataKatJabatan');

	Route::get('/pegawai/{id}/destroy',array('as'=>'pegawai.destroy', 'uses' => 'Pegawai\PegawaiController@destroy'));
	//Route::get('/jabatan/{id}/destroy',array('as'=>'jabatan.destroy', 'uses' => 'Pegawai\PegawaiController@destroyjabatan'));

	Route::get('/showtambahjabatan',array('as'=>'pegawai.showtambahjabatan', 'uses' => 'Pegawai\PegawaiController@showtambahjabatan'));

	Route::post('/simpanjabatanpegawai',array('as'=>'pegawai.simpanjabatan', 'uses' => 'Pegawai\PegawaiController@tambahjabatan'));

	//BERKAS DATA DIRI MELALUI PEGAWAI //1-11-2021
	Route::get('Berkas/DataDiri/{id_user}','Pegawai\PegawaiController@BerkasDataDiri')->name('BerkasDataDiri');
	Route::get('LihatBerkasPegawai/DataDiri/{id_file}','Pegawai\PegawaiController@LihatBerkasPegawai')->name('LihatBerkasPegawai');

	Route::get('HapusBerkasPegawaiAdmin/DataDiri/{id_file}','Pegawai\PegawaiController_20@HapusBerkasPegawaiAdmin')->name('HapusBerkasPegawaiAdmin');

	Route::get('GetFormTambahBerkas/DataDiri/{id_user}','Pegawai\PegawaiController@GetFormTambahBerkas')->name('GetFormTambahBerkas');
	Route::post('TambahBerkasFilev/DataDiri/','Pegawai\PegawaiController_20@TambahBerkasFilev')->name('TambahBerkasFilev');
	
	Route::post('UploadBerkasDataAdmin/DataDiri/','Pegawai\PegawaiController_20@UploadBerkasDataAdmin')->name('UploadBerkasDataAdmin');
	





	////////////////////////////////PEGAWAI/////////////////////////////

	////////Surat Tugas////////

	//SURAT TUGAS 2.0
	Route::get('setuju/admin/{id}','SuratTugas\SuratTugasController@SetujuAdmin')->name('SetujuAdmin');

	Route::get('ExportExcelSrtTgs/admin/','SuratTugas\SuratTugasController@ExportExcelSrtTgs')->name('ExportExcelSrtTgs');

	Route::get('/surattugas',array('as'=>'surat.show', 'uses' => 'SuratTugas\SuratTugasController@index'));
	Route::get('/suratdata',array('as'=>'surat.data', 'uses' => 'SuratTugas\SuratTugasController@suratlist'));
	Route::get('/edit/{id}/surattugas',array('as'=>'surat.editshow', 'uses' => 'SuratTugas\SuratTugasController@showedit'));
	Route::put('/surattugas/{id}/ubah',array('as'=>'surat.editsimpan', 'uses' => 'SuratTugas\SuratTugasController@simpanedit'));

	Route::get('/update/{id}/proses/',array('as'=>'surat.updateproses', 'uses' => 'SuratTugas\SuratTugasController@updateproses'));

	Route::get('/setup/{id}/surat',array('as'=>'surat.setupsurat', 'uses' => 'SuratTugas\SuratTugasController@setupprint'));
	Route::get('autocompletesurattugas', 'SuratTugas\SuratTugasController@autocompletesurattugas')->name('autocompletesurattugas');

	Route::match(['get','post'],'/cetak/{id}/surat',array('as'=>'surat.cetaksurat', 'uses' => 'SuratTugas\SuratTugasController@suratcetak'));

	Route::get('/surattugas/{id}/destroy',array('as'=>'surat.destroysurattugas', 'uses' => 'SuratTugas\SuratTugasController@destroysurattugas'));

	Route::match(['get', 'post'],'/tambahsurattugas',array('as'=>'surat.tambah', 'uses' => 'SuratTugas\SuratTugasController@showtambah'));

	Route:: post('/dropdown', array('as'=>'surat.jabatan', 'uses' => 'SuratTugas\SuratTugasController@postDropdown'));
	Route:: post('/dropdownnipnidn', array('as'=>'surat.nipnidn', 'uses' => 'SuratTugas\SuratTugasController@postDropdownnipnidn'));
	
	Route:: post('/simpansrt', array('as'=>'surat.simpansrt', 'uses' => 'SuratTugas\SuratTugasController@tambahsrttgs'));

	Route::get('autocomplete', 'SuratTugas\SuratTugasController@autocomplete')->name('autocomplete');
	Route::get('autocomplete2', 'SuratTugas\SuratTugasController@autocomplete2')->name('autocomplete2');

	//peserta
	Route::get('/lihat/{id}/peserta',array('as'=>'surat.pesertashow', 'uses' => 'SuratTugas\SuratTugasController@indexpeserta'));
	Route::match(['get','post'],'/tambah/{id}/peserta',array('as'=>'surat.showtambahpeserta', 'uses' => 'SuratTugas\SuratTugasController@tambahshowpeserta'));
	Route::post('/simpan/{id}/peserta',array('as'=>'surat.pesertasimpan', 'uses' => 'SuratTugas\SuratTugasController@simpanpeserta'));
	Route::get('/hapus/{id}/peserta/{surat_tugas}',array('as'=>'surat.hapuspeserta', 'uses' => 'SuratTugas\SuratTugasController@destroypeserta'));

	//berkas
	
	Route::get('/lihat/{id}/berkas',array('as'=>'surat.berkasshow', 'uses' => 'SuratTugas\SuratTugasController@indexberkas'));
	Route::get('/download/{id}/file/{nm_file}',array('as'=>'surat.downloadberkas', 'uses' => 'SuratTugas\SuratTugasController@getDownloadfile'));

	Route::get('/tambah/{id}/berkas',array('as'=>'surat.tambahberkas', 'uses' => 'SuratTugas\SuratTugasController@showtambahberkas'));

	Route::post('/simpan/{id}/berkas',array('as'=>'surat.simpanberkas', 'uses' => 'SuratTugas\SuratTugasController@simpanberkas'));
	Route::get('/hapus/{id}/file/{surat_tugas}',array('as'=>'surat.hapusberkas', 'uses' => 'SuratTugas\SuratTugasController@destroyfile'));

	Route::post('update/nosurat',array('as'=>'surat.updatenosu', 'uses' => 'SuratTugas\SuratTugasController@updatenosurat'));
	Route::get('cek/{id}/alasan',array('as'=>'surat.alasantolak', 'uses' => 'SuratTugas\SuratTugasController@alasantolak'));

	//setup akses management
	Route::get('index_hakakses', 'HakAkses\HakAkses@index_hakakses')->name('index_hakakses');
	Route::post('simpan_hakakses', 'HakAkses\HakAkses@simpan_hakakses')->name('simpan_hakakses');



	///-----------------------------------------PENILAIAN KERJA----------------------------------------///
	Route::get('/index/penkerja', 'PenilaianKerja\PenilaianKerja@index_penilaian_kerja')->name('IndexPenilaianKerja');

	Route::get('/index_cek/penkerja', 'PenilaianKerja\PenilaianKerja@index_penilaian_kerja_cek')->name('IndexPenilaianKerjaCek');
	Route::get('/get_datapenilaiankerja', 'PenilaianKerja\PenilaianKerja@getdata_penilaiankerja')->name('GetDataPK');


	Route::get('add_datadiri', 'PenilaianKerja\PenilaianKerja@add_data_diri')->name('add_datadiri');
	Route::post('/kabupatenkota', 'PenilaianKerja\PenilaianKerja@kabupatenkota')->name('kabupatenkota');
	Route::post('/sub_jabatanpendidik', 'PenilaianKerja\PenilaianKerja@sub_jabatanpendidik')->name('sub_jabatanpendidik');
	Route::post('/sub_jabatan_tenaga_kependidikan', 'PenilaianKerja\PenilaianKerja@sub_jabatanpendidik')->name('sub_jabatan_tenaga_kependidikan');
	Route::post('/serdos', 'PenilaianKerja\PenilaianKerja@serdos')->name('serdos');
	Route::post('/jabatan_akademik', 'PenilaianKerja\PenilaianKerja@jabatan_akademik')->name('jabatan_akademik');

 	
 	//UPDATE 27 september 2021
 	Route::post('/KecamatanDomisili', 'PenilaianKerja\PenilaianKerja@KecamatanDomisili')->name('KecamatanDomisili');
 	Route::post('/BerkasDataDiriPenKerja', 'PenilaianKerja\PenilaianKerjaProses@BerkasDataDiriPenKerja')->name('BerkasDataDiriPenKerja');
	Route::get('/HapusBerkasDataDiri/{id_berkas}', 'PenilaianKerja\PenilaianKerjaProses@HapusBerkasDataDiri')->name('HapusBerkasDataDiri');
	Route::get('/LihatBerkasDatdir/{id_berkas}', 'PenilaianKerja\PenilaianKerjaProses@LihatBerkasDatdir')->name('LihatBerkasDatdir');

	//UBAH FOTO PROFIL
	Route::post('/UbahProfilDataDiri/', 'PenilaianKerja\PenilaianKerjaProses@UbahProfilDataDiri')->name('UbahProfilDataDiri');

 	

	Route::post('/post_datadiri', 'PenilaianKerja\PenilaianKerjaProses@SimpanDataDiri')->name('SimpanDataDiri');
	Route::put('/editdata_diri/{id}', 'PenilaianKerja\PenilaianKerjaProses@EditDataDiri')->name('EditDataDiri');
	Route::post('/editidentitas', 'PenilaianKerja\PenilaianKerjaProses@EditIdentitas')->name('EditIdentitas');
	Route::get('/hapus_jabatanan_pen/{id}', 'PenilaianKerja\PenilaianKerjaProses@hapus_jabatanan_pen')->name('hapus_jabatanan_pen');
	Route::get('/hapus_jabatanakademik/{id}', 'PenilaianKerja\PenilaianKerjaProses@HapusJabatanAkademik')->name('HapusJabatanAkademik');

	Route::post('/tambahjabatan', 'PenilaianKerja\PenilaianKerjaProses@TambahJabatan')->name('TambahJabatan');
	Route::post('/tambahjabatanaka', 'PenilaianKerja\PenilaianKerjaProses@TambahJabatanAka')->name('TambahJabatanAka');

	Route::post('/edit_smasederajat', 'PenilaianKerja\PenilaianKerjaProses@EditSmaSederajat')->name('EditSmaSederajat');

	Route::post('/editperting/pk', 'PenilaianKerja\PenilaianKerjaProses@EditPerting')->name('EditPerting');
	Route::post('/tambah_perting/pk', 'PenilaianKerja\PenilaianKerjaProses@TambahPerting')->name('TambahPerting');
	Route::get('/destroy_perting/pk/{id}', 'PenilaianKerja\PenilaianKerjaProses@HapusPerting')->name('HapusPerting');

	Route::get('/destroy_maritalanak/pk/{id}', 'PenilaianKerja\PenilaianKerjaProses@HapusMaritalAnak')->name('HapusMaritalAnak');
	Route::post('/editmaritalpasangan/pk', 'PenilaianKerja\PenilaianKerjaProses@EditMaritalPasangan')->name('EditMaritalPasangan');
	Route::post('/tambahanak/pk', 'PenilaianKerja\PenilaianKerjaProses@TambahAnakMarital')->name('TambahAnakMarital');
	Route::post('/editanakmarital/pk', 'PenilaianKerja\PenilaianKerjaProses@EditAnakMarital')->name('EditAnakMarital');

	Route::post('/editkontakdarurat/pk', 'PenilaianKerja\PenilaianKerjaProses@EditKontakDarurat')->name('EditKontakDarurat');
	
	Route::get('/get_data_admin/pen/{id_versi}', 'PenilaianKerja\PenilaianKerja@GetDataPen')->name('GetDataPen');

	Route::get('/get_form/{type}/{versisoal}', 'PenilaianKerja\PenilaianKerja@FormPenilaian')->name('FormPenilaian');
	Route::post('/postjawaban/', 'PenilaianKerja\PenilaianKerjaProses@SimpanJawaban')->name('SimpanJawaban');

	Route::post('/poststatus', 'PenilaianKerja\PenilaianKerjaProses@PostStatus')->name('PostStatus');

	Route::get('/printverif/{id_user}/{id_versi}', 'PenilaianKerja\PenilaianKerjaProses@printverif')->name('printverif');

	//CEK EDIT FORMPENILAIAN KERJA
	Route::get('/get_form_edit/{type}/{id_user}/{versi}', 'PenilaianKerja\PenilaianKerja@FormPenilaianEdit')->name('FormPenilaianEdit');
	Route::post('/update/jawaban/', 'PenilaianKerja\PenilaianKerjaProses@UpdateJawaban')->name('UpdateJawaban');
	
	//CEK EDIT FORMPENILAIAN KERJA

	//Verifikasi form
	Route::get('/verif/form/{id_user_tujuan}/{id_versi}', 'PenilaianKerja\PenilaianKerja@VerifikasiForm')->name('VerifikasiForm');

	Route::get('/verif/soal/{type}/{id_user}/{id_u_tujuan}/{id_versi}', 'PenilaianKerja\PenilaianKerja@VerifPenilaianForm')->name('VerifPenilaianForm');

	Route::post('/postjawaban/verif', 'PenilaianKerja\PenilaianKerjaProses@SimpanJawabanVerif')->name('SimpanJawabanVerif');
	//Verifikasi form

	//pesan Motivasi
	Route::post('/pesan/motivasi', 'PenilaianKerja\PenilaianKerjaProses@pesanMotivasi')->name('pesanMotivasi');
	//pesan Motivasi

	Route::get('/DownloadPetunjukTeknis/', 'PenilaianKerja\PenilaianKerjaProses@DownloadPetunjukTeknis')->name('DownloadPetunjukTeknis');

	//ADMIN//
	Route::get('/index/pen/admin/{level}', 'PenilaianKerja\PenilaianKerjaAdmin@IndexAdminPen')->name('IndexAdminPen');
	Route::get('/get_data_admn/admin/{level}/{idversi}', 'PenilaianKerja\PenilaianKerjaAdmin@GetDataPenAdmin')->name('GetDataPenAdmin');

	Route::get('/IndexPenilaianKerjaAdmin/{id_user}', 'PenilaianKerja\PenilaianKerjaAdmin@index_penilaian_kerja_admin')->name('IndexPenilaianKerjaAdmin');
	Route::get('/get_datapen_admin/{id_user}', 'PenilaianKerja\PenilaianKerjaAdmin@get_datapk_admin')->name('GetDataPkAdmin');

	Route::post('/teruskanpegawai', 'PenilaianKerja\PenilaianKerjaAdmin@teruskanpegawai')->name('teruskanpegawai');

	Route::get('/kelompok/{id_user}/{id_versi}', 'PenilaianKerja\PenilaianKerjaAdmin@Kelompok')->name('Kelompok');
	
	Route::get('/print/hasil/admin/{id_user_tujuan}/{id_user}/{id_versi}', 'PenilaianKerja\PenilaianKerjaAdmin@CekPrintJawaban')->name('CekPrintJawaban');

	Route::get('/jawaban/sendiri/cek/{id_user}/{id_versi}', 'PenilaianKerja\PenilaianKerjaAdmin@CekJawabanSendiri')->name('CekJawabanSendiri');

	Route::get('/CekRekap/{id_user_tujuan}/{id_user}/{id_versi}', 'PenilaianKerja\RekapPenilaian@CekRekapPenilaian')->name('CekRekapPenilaian');

	Route::get('/CekRekapMulti/{id_user}/{id_versi}', 'PenilaianKerja\RekapPenilaianMulti@CekRekapPenilaianMulti')->name('CekRekapPenilaianMulti');

	//CEK INDEX NILAI ATASAN
	Route::post('/CekJawabanBawahan/', 'PenilaianKerja\PenilaianKerjaAdmin@CekJawabanBawahan')->name('CekJawabanBawahan');
	
	//ABSENSI
	Route::get('/CekAbsensiKehadiranDanPelaksanaanTugasLain/{id_user}/{id_versi}', 'PenilaianKerja\PenilaianKerjaAdmin@CekAbsensi')->name('CekAbsensi');


	Route::post('/SimpanFinalAbsensi/', 'PenilaianKerja\PenilaianKerjaAdmin@SimpanFinalAbsensi')->name('SimpanFinalAbsensi');


	Route::post('absen/view/{id_user}/{id_versi}', 'PenilaianKerja\PenilaianKerjaAdmin@getViewAbsen')->name('getViewAbsen');
	Route::get('absen/view/edit/{id_user}/{id_versi}', 'PenilaianKerja\PenilaianKerjaAdmin@ViewEditAbsensi')->name('ViewEditAbsensi');

	Route::post('absen/proses/edit/}', 'PenilaianKerja\PenilaianKerjaAdmin@ProsesEditAbsensi')->name('ProsesEditAbsensi');

	Route::post('tujuan/individu/{id_user}/{versi}', 'PenilaianKerja\PenilaianKerjaAdmin@getTujuanIndividu')->name('getTujuanIndividu');


	//TO EXCEL DATA PENILAIAN KERJA//
	Route::get('/ToExcel/DataPegawai', 'PenilaianKerja\PenilaianKerjaAdmin@ToExcelDataPegawai')->name('ToExcelDataPegawai');
	
	Route::post('/ExportExcel/DataPegawai', 'PenilaianKerja\PenilaianKerjaAdmin@DataPegawaiExport')->name('DataPegawaiExport');
	Route::post('/ExportExcel/DataPegawaiNilai', 'PenilaianKerja\PenilaianKerjaAdmin@DataPegawaiNilai')->name('DataPegawaiNilai');


	// PELAKSANAAN TUGAS LAIN 
	Route::post('/upload/tugas/lain', 'PenilaianKerja\PenilaianKerjaProses@UploadTugasLain')->name('UploadTugasLain');

	Route::post('/Hapus/tugas/lain', 'PenilaianKerja\PenilaianKerjaProses@HapusPTL')->name('HapusPTL');
	Route::get('/Download/tugas/{id}', 'PenilaianKerja\PenilaianKerjaProses@DownloadPTL')->name('DownloadPTL');
	//PTL UNTUK ADMIN
	Route::get('/DownloadPTLForAdmin/{id}/{versi}', 'PenilaianKerja\PenilaianKerjaProses@DownloadPTLForAdmin')->name('DownloadPTLForAdmin');
	

	
	//SETUP TAHUN BERDASARKAN VERSI SOAL
	Route::post('/TahunVersiDLL', 'PenilaianKerja\PenilaianKerjaAdmin@TahunVersi')->name('TahunVersiDLL');

	//RENDER MODAL FORM UNTUK ASAL DAN TUJUAN PEGAWAI
	Route::post('/AsalDanTujuan', 'PenilaianKerja\PenilaianKerjaAdmin@AsalDanTujuan')->name('AsalDanTujuan');

	//NILAI ATASAN
	Route::get('/NilaiAtasan/{id_user}/{id_versi}', 'PenilaianKerja\PenilaianKerja@NilaiAtasan')->name('NilaiAtasan');

	//SIMPAN HASIL MENILAI ATASAN 
	Route::post('/SimpanNilaiAtasan/', 'PenilaianKerja\PenilaianKerjaProses@SimpanJawabanNilaiAtasan')->name('SimpanJawabanNilaiAtasan');

	//TAMPIL MODAL LAINNYA DI PENILAIAN KERJA
	Route::get('/DetailPenilaianKerja/{id_versi}/', 'PenilaianKerja\PenilaianKerja@DetailPenilaianKerja')->name('DetailPenilaianKerja');

	//SIMPAN NILAI PELAKSANAAN TUGAS LAIN
	Route::post('/SimpanNilaiPTL/', 'PenilaianKerja\PenilaianKerjaProses@SimpanNilaiPTL')->name('SimpanNilaiPTL');

	//TAMPIL MODAL UNTUK INPUT NILAI PELAKSANAAN TUGAS LAIN
	Route::post('/TampilNilaiPTL/', 'PenilaianKerja\PenilaianKerja@TampilNilaiPTL')->name('TampilNilaiPTL');

	Route::post('/TampilNilaiPTL/', 'PenilaianKerja\PenilaianKerja@TampilNilaiPTL')->name('TampilNilaiPTL');



	///-----------------------------------------PENILAIAN KERJA----------------------------------------///


	

	//CUTI (PERHITUNGAN CUTI)
	Route::get('/CutiPegawai', 'CutiPegawai\CutiPegawai@IndexCutiPegawai')->name('CutiPegawai');
	Route::get('/GetCutiPegawai/{periode}', 'CutiPegawai\CutiPegawai@GetCutiPegawai')->name('GetCutiPegawai');

	Route::post('/LihatDetAmCut', 'CutiPegawai\CutiPegawai@ShowDetailAmbilCuti')->name('ShowDetailAmbilCuti');
	Route::post('/LihatPeriodeCuti', 'CutiPegawai\CutiPegawai@LihatPeriodeCuti')->name('LihatPeriodeCuti');
	//PERIODE
	Route::get('/GetCutiPegawai/', 'CutiPegawai\CutiPegawai@GetPeriode')->name('GetPeriode');
	Route::post('/GetDataEditPriod/', 'CutiPegawai\CutiPegawai@GetDataEditPriod')->name('GetDataEditPriod');
	//proses
	Route::post('/SimpanPeriode', 'CutiPegawai\CutiPegawaiProses@SimpanPeriode')->name('SimpanPeriodeCut');
	Route::post('/HapusPeriode/', 'CutiPegawai\CutiPegawaiProses@HapusPeriode')->name('HapusPeriodeCut');
	Route::post('/UbahPeriode/', 'CutiPegawai\CutiPegawaiProses@UbahPeriode')->name('UbahPeriodeCut');
	Route::post('/EditCutiBersamaPros/', 'CutiPegawai\CutiPegawaiProses@EditCutiBersamaPros')->name('EditCutiBersamaPros');
	Route::post('/TamPegCuti/', 'CutiPegawai\CutiPegawaiProses@TamPegCuti')->name('TamPegCuti');
	//CUTI BERSAMA DALAM PERIODE INDEX
	Route::post('/TambahCutiBersama/', 'CutiPegawai\CutiPegawaiProses@TambahCutiBersama')->name('TambahCutiBersama');
	Route::post('/HapusCutiBersama/', 'CutiPegawai\CutiPegawaiProses@HapusCutiBersama')->name('HapusCutiBersama');
	Route::post('/EstimasiHakcuti/', 'CutiPegawai\CutiPegawai@EstimasiHakcuti')->name('EstimasiHakcuti');
	//PEGAWAI DALAM PERIODE
	Route::post('/TamTamPegawai/', 'CutiPegawai\CutiPegawai@TampilTambahPegawai')->name('TamTamPegawai');
	Route::post('/GetDataPegawaiCek/', 'CutiPegawai\CutiPegawai@GetDataPegawaiCek')->name('GetDataPegawaiCek');
	//PENGAMBILAN CUTI
	Route::post('/ajax_upload/action', 'CutiPegawai\CutiPegawaiProses@UploadPengambilanCuti')->name('UploadPengambilanCuti');
	Route::post('/Check/SimpanAmbilCuti', 'CutiPegawai\CutiPegawaiProses@SimpanAmbilCuti')->name('SimpanAmbilCuti');
	Route::get('/GetDatPengCut/{id_cuti}', 'CutiPegawai\CutiPegawai@GetDatPengCut')->name('GetDatPengCut');
	Route::post('/HapusPengCuti/', 'CutiPegawai\CutiPegawaiProses@HapusPengCuti')->name('HapusPengCuti');
	Route::post('/GetDataCutEdit/', 'CutiPegawai\CutiPegawaiProses@GetDataCutEdit')->name('GetDataCutEdit');
	Route::post('/UpdateCutiPros/', 'CutiPegawai\CutiPegawaiProses@UpdateCutiPros')->name('UpdateCutiPros');
	//KONTEN UPLOAD FILE BUKTI CUTI
	Route::post('/KontenUploadCuti/', 'CutiPegawai\CutiPegawai@KontenUploadCuti')->name('KontenUploadCuti');
	//EXPORT EXCEL CUTI
	Route::get('/ExportCutiInfo/{id}', 'CutiPegawai\CutiPegawaiProses@ExportCutiInfo')->name('ExportCutiInfo');
	//UPDATE TMK VIA CUTI PEGAWAI
	Route::post('/UpdateTmkViaCuti/', 'CutiPegawai\CutiPegawaiProses@UpdateTmkViaCuti')->name('UpdateTmkViaCuti');
	//History Cuti
	Route::post('/HistoryCuti/', 'CutiPegawai\CutiPegawai@HistoryCuti')->name('HistoryCuti');
	Route::get('/GetHistoryCuti/', 'CutiPegawai\CutiPegawai@GetHistoryCuti')->name('GetHistoryCuti');
	//HAPUS KARYWAWAN DARI DAFTAR CUTI
	Route::post('/HapusKaryawanFromCut/', 'CutiPegawai\CutiPegawaiProses@HapusKarFromCut')->name('HapusKarFromCut');
	//EDIT KARYWAWAN DARI DAFTAR CUTI
	Route::post('/GetDataUbahCutiKaryawan/', 'CutiPegawai\CutiPegawai@GetDataUbahCutiKaryawan')->name('GetDataUbahCutiKaryawan');
	Route::post('/SubmitUbahDatKaryCut/', 'CutiPegawai\CutiPegawaiProses@SubmitUbahDatKaryCut')->name('UbahDataKaryawanCuti');
	


	//ADMIN//
	///-----------------------------------------PENILAIAN KERJA----------------------------------------///


});

Route::group(['middleware' => 'web'], function(){

	//Route::get('/home', array('as' => 'adminhead.home', 'uses' => 'AdminController@index'));
	//Route::get('/dashboard', array('as' => 'adminhead.dashboard', 'uses' => 'AdminController@index'));
	Route::get('/lihatpengajuan', array('as' => 'adminhead.lihatpengajuan', 'uses' => 'SuratTugas\SuratTugasControllerHead@index'));
	Route::get('/listdatahead', array('as' => 'admin.headlist', 'uses' => 'SuratTugas\SuratTugasControllerHead@suratlist'));

	Route::get('/lihat/{id}/pesertahead',array('as'=>'admin.pesertashowhead', 'uses' => 'SuratTugas\SuratTugasControllerHead@indexpeserta'));

	Route::get('/lihat/{id}/filehead',array('as'=>'admin.filehead', 'uses' => 'SuratTugas\SuratTugasControllerHead@indexberkas'));

	Route::get('/download/{id}/berkas/{nm_file}/',array('as'=>'surat.downloadberkashead', 'uses' => 'SuratTugas\SuratTugasControllerHead@getDownloadfile'));

	Route::post('/verifikasi/kegiatan',array('as'=>'adminhead.verifikasi', 'uses' => 'SuratTugas\SuratTugasControllerHead@updateverifikasi'));
});





//umum
Route::group(['middleware' => 'web'], function()  
{
	Auth::routes(['register' => false,'reset' => false]);
	Route::get('/masuk', array('as' => 'admin', 'uses' => 'AdminController@index'));
	//Route::get('/', array('as' => 'admin', 'uses' => 'ClientController@index'));
	//Route::get('/surattugas_first', array('as' => 'admin', 'uses' => 'ClientController@index'));
	Route::get('/', array('as' => 'admin', 'uses' => 'AdminController@index'));
	Route::get('surattugas_first', 'ClientController@index')->name('tambahsuratpertama');


	
	///////////////////////////////////////////HONORIUM////////////////////////////////////////////////
	Route::get('honorarium', 'Honorarium\Honorarium@indexhonorarium')->name('index_honorarium');
	Route::get('get-honorarium', 'Honorarium\Honorarium@getdatahonorarium')->name('getdatahonorarium');

	//HONORARIUM 2.0
	Route::get('KembaliRest', 'Honorarium\Honorarium@KembaliRest')->name('KembaliRest');
	Route::get('DaratFinish', 'Honorarium\Honorarium@DaratFinish')->name('DaratFinish');

	//detail honorarium
	Route::get('detail-honorarium', 'Honorarium\Honorarium@detail_honorarium')->name('detail_honorarium');
	Route::get('del-detail-honorarium/{id}/{id_berkas_buff}', 'Honorarium\Honorarium@destroy_detail_honorarium')->name('destroy_del_hon');

	Route::get('get-d-honorarium', 'Honorarium\Honorarium@getdata_d_honorarium')->name('getdata_d_honorarium');
	//print honorarium
	Route::get('print-honorarium', 'Honorarium\Honorarium@print_honorarium')->name('print_honorarium');

	Route::post('set-honorarium', 'Honorarium\Honorarium@cek_dos_honorarium')->name('cek_dos_honorarium');

	Route::post('add-honorarium', 'Honorarium\Honorarium@tambah_data_honorarium')->name('add_honorarium');


	//SETTING HONORARIUM
	Route::get('setting_honorarium', 'Honorarium\Honorarium@index_setting')->name('setting_honorarium');
	Route::get('embed_honor', 'Honorarium\Honorarium@embed_honor')->name('embed_honor');
	Route::get('get_data_setting_honorarium', 'Honorarium\Honorarium@getdata_setting_honorarium')->name('get_data_setting_honorarium');

	Route::post('add_set_honor', 'Honorarium\Honorarium@add_set_honor')->name('add_set_honor');

	Route::get('destroy_set_honor/{id}', 'Honorarium\Honorarium@destroy_set_honor')->name('destroy_set_honor');
	Route::get('edit_set_honor/{id}', 'Honorarium\Honorarium@edit_set_honor')->name('edit_set_honor');

	Route::post('put_set_honor', 'Honorarium\Honorarium@put_set_honor')->name('put_set_honor');



	///////////////////////////////TANGGAL BUKA DAN TUTUP BUKU///////////////////////////

	Route::post('post_buktup', 'Honorarium\Honorarium@post_buktup')->name('post_buktup');
	//untuk menu di setup buka dan tutup buku
	Route::get('view_buktup', 'BukaTutupBuku\BukaTutupBuku@index_buktup')->name('view_buktup');
	Route::get('destroy_buktup/{id}', 'BukaTutupBuku\BukaTutupBuku@destroy_buktup')->name('destroy_buktup');

	Route::get('get_data_f_calender', 'BukaTutupBuku\BukaTutupBuku@fecth_data_calender')->name('get_data_f_calender');
	///////////////////////////////TANGGAL BUKA DAN TUTUP BUKU///////////////////////////


	//////////////////////////////Surat Tugas BU FI////////////////////////////////

	
	//CEK/UPDATE URUTAN PEMBIMBING
	Route::post('CekUrtPem', 'SuratTugasPembimbing\SuratTugasPembimbing@CekUrutantPembimbing')->name('CekUrtPem');
	Route::post('PostUpdateCekUrtPem', 'SuratTugasPembimbing\SuratTugasPembimbingProses@UrtPemProses')->name('PostUpdateCekUrtPem');
	
	//TAHUN AJAR MANAGEMENT 2.0
	Route::match(['get', 'post'],'/tahun/ajar', 'TahunAjar\TahunAjar@indexAwal')->name('indexAwal');
	Route::match(['get', 'post'],'/ubah/change', 'TahunAjar\TahunAjar@UbahStsTahunAjar')->name('UbahStsTahunAjar');
	Route::match(['get', 'post'],'/tambah/thnajr', 'TahunAjar\TahunAjar@TambahTahunAjar')->name('TamThnAjr');
	Route::get('hapus/tahunajar/{id}', 'TahunAjar\TahunAjar@DestroyThnAjr')->name('DestroyThnAjr');

	//SURAT TUGAS PEMBIMBING DAN PENGUJI 2.0
	Route::match(['get', 'post'],'/loadmore/load_data', 'SuratTugasPembimbing\SuratTugasPembimbing@load_data')->name('loadmore.load_data');
	Route::match(['get', 'post'],'/mkauto', 'SuratTugasPembimbing\SuratTugasPembimbing@mkauto')->name('mkauto');

	//index surat tugas pembimbing magang & TA
	Route::get('Indexsrttgspembimbing', 'SuratTugasPembimbing\SuratTugasPembimbing@index_surattugaspembimbing')->name('IndexSuratTugasPembimbing');
	Route::get('GetDataIndexsrttgspembimbing', 'SuratTugasPembimbing\SuratTugasPembimbing@getdatasurattugaspembimbing')->name('GD.srttgspembimbing');


	//tambah surat tugas pembimbing magang & TA
	Route::match(['get', 'post'], '/showformtambah-rtz', 'SuratTugasPembimbing\SuratTugasPembimbing@showformtambah')->name('showformtambah-rtz');


	//tambah data surat tugas pembimbing
	Route::post('srttgspembimbing', 'SuratTugasPembimbing\SuratTugasPembimbingProses@tambahsurattugaspembimbing')->name('addsrttgs_pem');

	//get data 
	Route::post('gd_nidn', 'SuratTugasPembimbing\SuratTugasPembimbingProses@gd_nidn')->name('gd.nidn');
	Route::post('gd_mhs', 'SuratTugasPembimbing\SuratTugasPembimbingProses@gd_mhs_nim')->name('gd.mhs');

	Route::get('/edit/srttgspembimbing/{id}', 'SuratTugasPembimbing\SuratTugasPembimbing@showeditsrttgspembimbing')->name('showformsrttgspembimbing');

	Route::put('/update/srttgspembimbing/', 'SuratTugasPembimbing\SuratTugasPembimbingProses@editsrttgspembimbing')->name('edit_srttgspembimbing');

	Route::get('/destroy/srttgspembimbing/{id}', 'SuratTugasPembimbing\SuratTugasPembimbingProses@destroysrttgspembimbing')->name('dessrttgspembimbing');

	Route::post('/update/srttgspembimbing/', 'SuratTugasPembimbing\SuratTugasPembimbingProses@updatesrttgspembimbing')->name('upsrttgspembimbing');

	Route::post('/setupcetaksrttgspembimbing/', 'SuratTugasPembimbing\SuratTugasPembimbing@exportsrttgspembimbing')->name('setupcetak_srttgspembimbing');

	//surat tugas penguji
	Route::post('/simpansurattugaspenguji/', 'SuratTugasPembimbing\SuratTugasPembimbingProses@simpansurattugaspenguji')->name('surattugaspenguji');
	//////////////////////////////Surat Tugas BU FI////////////////////////////////

	//////////////////////////////Surat Undangan Penguji Proposal dan TA BU FI////////////////////////////////

	//UNDANGAN 2.0 
	Route::post('GetData/Pembimbing/', 'SuratUndangan\SuratUndanganProses@GetDataPembimbing')->name('GetDataPembimbing');
	Route::match(['get', 'post'],'/loadmore/undangan', 'SuratUndangan\SuratUndanganProses@LoadMoreUndangan')->name('LoadMoreUndangan');

	Route::post('GetData/OptionUUdg/{id}', 'SuratUndangan\SuratUndangan@CekOptionUDG')->name('CekOptionUDG');


	Route::get('/index_undangan', 'SuratUndangan\SuratUndangan@indexundangan')->name('indexundangan');
	Route::get('/index_undangan_gd', 'SuratUndangan\SuratUndangan@getdataindexundangan')->name('gd.indexundangan');
	Route::get('/index_udg_dosen/{id}', 'SuratUndangan\SuratUndangan@show_index_udg_dosen')->name('ShowDosenPenguji');
	Route::get('/index_udg_dosen_pem/{id}', 'SuratUndangan\SuratUndangan@show_index_udg_dosen_pembimbing')->name('ShowDosenPembimbing');

	Route::post('/tambahdosen/', 'SuratUndangan\SuratUndanganProses@tamdos')->name('tamdospenguji');
	Route::get('/destroydospen/{id_undangan}/{key}/proses/', 'SuratUndangan\SuratUndanganProses@destroydospen')->name('destroydospen');

	Route::get('/showformtambahundangan/', 'SuratUndangan\SuratUndangan@showtambahundangan')->name('showtambahudg-ert');

	Route::post('/postsuratundanganpengujipropta/', 'SuratUndangan\SuratUndanganProses@tambahsuratundangan')->name('tambahundangan-ert');

	Route::post('/updatenosu/', 'SuratUndangan\SuratUndanganProses@updatenosu')->name('updatenosu-oih2');
	Route::get('/showformueditdg/{id}', 'SuratUndangan\SuratUndangan@showformeditudg')->name('showformedit-ert');
	Route::put('/simpanedit/{id}', 'SuratUndangan\SuratUndanganProses@simpanedit')->name('simpanedit-ert');

	Route::post('/getnmberkas/', 'SuratUndangan\SuratUndanganProses@get_namaberkas')->name('namaberkas-ert');

	Route::post('/showcetakudgpenguji/', 'SuratUndangan\SuratUndangan@setupcetakudgpenguji')->name('setupcetak.udgpenguji');

	Route::get('/destroyundangan/{id}', 'SuratUndangan\SuratUndanganProses@destroyundangan')->name('destroy_undangan-ert');


	//////////////////////////////Surat Undangan Penguji Proposal dan TA Surat Tugas BU FI////////////////////////////////


	/////////////////////////Surat Berkas Administrasi BU FIFI//////////////////////////////////
	Route::match(['get','post'],'/berkas-administrasi/', 'SuratUndangan\SuratUndangan@cekberkasadministrasi')->name('setupcetak.administrasi');

	Route::get('/showsetupadministrasi/{id}', 'SuratUndangan\SuratUndangan@showsetupadministrasi')->name('SetAdminis');


	//Route::get('/clp_sm/', 'SuratUndangan\SuratUndangan@CetakLembarPenilaian_SM')->name('clp_SM');
	/////////////////////////Surat Berkas Administrasi BU FIFI//////////////////////////////////


	/////////////////////////Surat Keterangan Selesai BU FIFI//////////////////////////////////



	Route::get('/viewketeranganselesai', 'SuratKeteranganSelesai\SuratKeteranganSelesai@IndexSuratKeteranganSelesai')->name('IndexSuratKeteranganSelesai');

	Route::get('/index_sks_gd', 'SuratKeteranganSelesai\SuratKeteranganSelesai@getdataindexsks')->name('gd.index_sks_gd');
	Route::get('/index_dospem_sks/{id}', 'SuratKeteranganSelesai\SuratKeteranganSelesai@show_index_surat_sks_dosen_pembimbing')->name('index_dospem_sks');


	Route::post('/postdospemsks', 'SuratKeteranganSelesai\SuratKeteranganSelesaiProses@tammbahdospem')->name('tamdospembimbingsks');

	Route::put('/eddospembimbingsks', 'SuratKeteranganSelesai\SuratKeteranganSelesaiProses@editdospemsks')->name('eddospembimbingsks');

	

	Route::get('/destroydospensks/{idkey}/proses/', 'SuratKeteranganSelesai\SuratKeteranganSelesaiProses@destroydospensks')->name('destroydospensks');

	Route::get('/viewtambahsks', 'SuratKeteranganSelesai\SuratKeteranganSelesai@viewtambahsks')->name('TambahSks');
	Route::get('/viewtambahsks_v2', 'SuratKeteranganSelesai\SuratKeteranganSelesai@viewtambahsks_versi_2')->name('TambahSks_versi2');
	
	Route::post('/prosestambahsks', 'SuratKeteranganSelesai\SuratKeteranganSelesaiProses@posttambahsks')->name('tambahsurat-sks');
	
	Route::post('/posttambahskscopy', 'SuratKeteranganSelesai\SuratKeteranganSelesaiProses@posttambahskscopy')->name('posttambahskscopy');

	Route::get('/showformedit-sks/{id}', 'SuratKeteranganSelesai\SuratKeteranganSelesai@editsks')->name('showformedit-sks');

	Route::put('/prosesedit-sks/{id}', 'SuratKeteranganSelesai\SuratKeteranganSelesaiProses@proseseditsks')->name('edit-sks');

	Route::get('/destroy-sks/{id}', 'SuratKeteranganSelesai\SuratKeteranganSelesaiProses@destroy_sks')->name('destroy-sks');

	Route::post('/setup_sks/', 'SuratKeteranganSelesai\SuratKeteranganSelesai@setupcetak_sks')->name('setupcetak-sks');



	//SURAT KETERANGAN SELESAI 2.0
	Route::post('/SksMultiple/', 'SuratKeteranganSelesai\SuratKeteranganSelesai@SksMultiple')->name('SksMultiple');
	Route::get('/viewtambahsks_v3', 'SuratKeteranganSelesai\SuratKeteranganSelesai@viewtambahsks_versi_3')->name('TambahSks_versi3');
	Route::post('/PostSksV3/', 'SuratKeteranganSelesai\SuratKeteranganSelesaiProses@PostSksV3')->name('PostSksV3');


	Route::post('GetData/sksV3/', 'SuratKeteranganSelesai\SuratKeteranganSelesaiProses@GetDataUndangan')->name('GetDataUndangan');

	Route::post('Sks/Print/Excel', 'SuratKeteranganSelesai\SuratKeteranganSelesaiProses@PrintExcelSks')->name('PrintExcelSks');

	Route::post('Get/Json/Dsn', 'SuratKeteranganSelesai\SuratKeteranganSelesaiProses@GetDoJson')->name('GetDoJson');

	/////////////////////////Surat Keterangan Selesai BU FIFI//////////////////////////////////

	//upload_berkas
	/////////////////////////ULOAD BERKAS HASIL SCAN//////////////////////////////////	
	Route::post('/upload_berkas-sks/', 'BerkasScan\BerkasScanProses@ProsesUploadBerkasScan')->name('BerkasScanUpload');
	/////////////////////////ULOAD BERKAS HASIL SCAN//////////////////////////////////	


	//download dan preview
	/////////////////////////ULOAD BERKAS HASIL SCAN//////////////////////////////////	
	Route::get('/download_file_scan/{id}', 'BerkasScan\BerkasScanProses@download_file_scanan')->name('download_file_scan');
	Route::get('/preview_file_scan/{id}', 'BerkasScan\BerkasScanProses@preview_file_scanan')->name('preview_file_scan');
	/////////////////////////ULOAD BERKAS HASIL SCAN//////////////////////////////////	

	//////////////////////////////UPDATE STATUS BERKAS///////////////////////////////////////	
	Route::put('/u_p_p/', 'Honorarium\Honorarium@update_pilihan_print')->name('UpdatePilihanPrint');
	//////////////////////////////UPDATE STATUS BERKAS///////////////////////////////////////	

	/////////////////////////////////BERKAS SCAN BUFF DARI MENU SURAT UNDANGAN//////////////////////////////////////
	Route::get('preview_berkas_scan/{id}/{kategori}/{kategori2}', 'SuratUndangan\SuratUndanganProses@preview_berkas_scan')->name('preview_berkas_scan');

	Route::get('destroy_file_scan_undangan/{id}/{kategori}/{kategori2}', 'SuratUndangan\SuratUndanganProses@destroy_file_scan_undangan')->name('destroy_file_scan_undangan');
	/////////////////////////////////BERKAS SCAN BUFF DARI MENU SURAT UNDANGAN//////////////////////////////////////

	/////////////////////////////////BERKAS SCAN BUFF DARI MENU SURAT KETERANGAN SELESAI//////////////////////////////////////
	Route::get('preview_berkas_scan_sks/{id}/{kategori}', 'SuratKeteranganSelesai\SuratKeteranganSelesaiProses@preview_berkas_scan_sks')->name('preview_berkas_scan_sks');

	Route::get('destroy_file_scan_sks/{id}/{kategori}', 'SuratKeteranganSelesai\SuratKeteranganSelesaiProses@destroy_file_scan_sks')->name('destroy_file_scan_sks');
	/////////////////////////////////BERKAS SCAN BUFF DARI MENU SURAT KETERANGAN SELESAI//////////////////////////////////////


	////////////////////////////////////////BERKAS SCAN BUFF//////////////////////////////////////////////////
	




	//bagian surat tugas bu leny

	Route::get('/suratdataclient',array('as'=>'surat.data.client', 'uses' => 'ClientController@suratlistclient'));
	
	Route::match(['get','post'],'/showtambahclient',array('as'=>'surat.data.showtambahclient', 'uses' => 'ClientController@showtambahclient'));

	Route:: post('/dropdownclient', array('as'=>'surat.jabatanclient', 'uses' => 'ClientController@postDropdown'));
	Route:: post('/dropdownnipnidnclient', array('as'=>'surat.nipnidnclient', 'uses' => 'ClientController@postDropdownnipnidn'));

	Route:: get('lihat/{id}/pesertaclient', array('as'=>'surat.lihatpesertaclient', 'uses' => 'ClientController@indexpeserta'));
	Route:: post('client/tambah', 'ClientController@simpantambah')->name('surat.tambahclient');

	Route:: post('/simpansrtclient', array('as'=>'surat.simpansrtclient', 'uses' => 'ClientController@tambahsrttgsclient'));

	Route::get('autocompleteclient', 'ClientController@autocompleteclient')->name('autocompleteclient');
	Route::get('autocomplete2client', 'ClientController@autocomplete2client')->name('autocomplete2client');
	Route::get('autocomplete3client', 'ClientController@autocomplete3client')->name('autocomplete3client');

});

