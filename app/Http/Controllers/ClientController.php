<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;

use App\level as Level;
use App\Pegawai as Pegawai;
use App\Jabatan as jabatan;
use App\kategori as kategori;
use App\SuratTugas as SuratTugas;
use App\Berkas as Berkas;
use DataTables;
use DB;
use Validator;
use Response;
use Redirect;
use Alert;
use Auth;
use File;


class ClientController extends Controller
{

	public function __construct()
    {
       
    }

    public function index(){

       	$pegawai        = Pegawai::orderBy('id_pegawai')->get();
        return view('admin.dashboard.surattugasclient.index')->with('list_pegawai', $pegawai);
    }

    ///////////////////////////////////////////////Index Peserta//////////////////////////////////////////////////////
    public function indexpeserta($id){

        $peserta = DB::table('peserta')
        ->join('pegawai', 'peserta.id_pegawaip_fk','=','pegawai.id_pegawai' )
        ->select('peserta.id_peserta','pegawai.nama_karyawan','peserta.nipp','peserta.nidnp','peserta.nama_jabatanp','peserta.id_pegawaip_fk', 'peserta.id_surattugas_fk')
        ->where('peserta.id_surattugas_fk', '=', $id)
        ->get();

        return view('admin.dashboard.surattugasclient.pesertaclient')->with('list_peserta', $peserta);
    }

 
    public function suratlistclient(Request $request){

        return DataTables::of(DB::table('surat_tugas')
        ->join('kategorisebagai', 'kategorisebagai.id_kategori','=','surat_tugas.kategori_fk' )
        ->select('surat_tugas.id_surattugas','surat_tugas.nomor_surat','surat_tugas.kategori_fk','surat_tugas.nama_kegiatan'
        ,'surat_tugas.penyelengara','surat_tugas.tanggal_kegiatan_mulai','surat_tugas.tanggal_kegiatan_selesai','surat_tugas.jam_kegiatan_mulai','surat_tugas.jam_kegiatan_selesai','surat_tugas.lokasi','surat_tugas.tanggal_acc','kategorisebagai.id_kategori','kategorisebagai.nama_kategori', 'surat_tugas.status_acc')
        )
        ->addColumn('tanggal_mulai', function($data){
                $button =   $this->tanggal_indo($data->tanggal_kegiatan_mulai);
                return $button;
            })
        ->addColumn('tanggal_selesai', function($data){
                $button =   $this->tanggal_indo($data->tanggal_kegiatan_selesai);
                return $button;
            })
     
        ->addColumn('status', function($data){
                if ($data->status_acc == 0) {
                    $button =   '<small class="badge badge-info">Diajukan</small>
                                ';
                }elseif ($data->status_acc == 1) {
                    $button =   '<small class="badge badge-success">Diterima</small>
                                ';
                }elseif ($data->status_acc == 2){
                    $button =   '<small class="badge badge-danger">Ditolak</small>
                                ';
                }elseif ($data->status_acc == 3){
                    $button =   '<small class="badge badge-warning">Diproses</small>
                                ';
                }else{
                    $button = 'Terjadi kesalahan';
                }
                
                return $button;
            })
            ->addColumn('jumlahorang', function($data){
                $cek = DB::table('peserta')
                 ->where('id_surattugas_fk', '=', $data->id_surattugas)
                 ->count();
                return $cek;
            })

            ->addColumn('berkas', function($data){
                $cekberkas = DB::table('berkas')
                 ->where('id_srt_tgs_fk', '=', $data->id_surattugas)
                 ->count();
                return $cekberkas;
            })        

            ->rawColumns(['tanggal_mulai','tanggal_selesai','status','jumlahorang','berkas'])
            ->make(true);
            
    }

    public function simpantambah(Request $request){

    	$input = Input::all();

    	if (strpos($input['nipnidn'], '.9.') == true) {
                    $nippecah = $input['nipnidn'];
                    $nidnpecah = null;
                }elseif (strpos($input['nipnidn'], '.6.') == true) {
                    $nippecah = $input['nipnidn'];
                    $nidnpecah = null;
                }else{
                    $nidnpecah = $input['nipnidn'];
                    $nippecah = null;
                }

        $peserta = DB::table('peserta')->where('id_surattugas_fk', $input['id_surattugas'])->insert([
            'id_surattugas_fk' => $input['id_surattugas'],
            'id_pegawaip_fk' => $input['pegawai'],
            'nipp' => $nippecah,
            'nidnp' => $nidnpecah,
            'nama_jabatanp' => $input['jabatan'],
             ]);
        
        if(!$peserta) {
        	abort(500);
        }else{
        	alert()->success('Ikut Kegiatan', 'Berhasil Mengikuti Kegiatan')->persistent('Close');
            return Redirect::action('ClientController@index');
		}


    }



    public function showtambahclient(){

        $pegawai        = Pegawai::orderBy('id_pegawai')->get();
        $kategori       = kategori::orderBy('id_kategori')->get();
        $jabatan        = jabatan::orderBy('id_jabatan')->get(); 

        $jmlform = Input::get('loopingform');

        return view('admin.dashboard.surattugasclient.tambahclient',['jumlah_form' => $jmlform])->with('list_pegawai', $pegawai)->with('list_kategori', $kategori)->with('list_jabatan',$jabatan);
    }



    public function autocompleteclient(Request $request)
    {
        $data1 = DB::table('ac_namakegiatan')
                ->select('nama_kegiatan_auto', DB::raw('count(*) as total'))
                ->groupBy('nama_kegiatan_auto')
                ->where("nama_kegiatan_auto","LIKE","%{$request->input('query')}%")
                ->get();
        $data2 = array();
        foreach ($data1 as $data)
            {
                $data2[] = $data->nama_kegiatan_auto;
            }
        return response()->json($data2);
    }


    public function autocomplete2client(Request $request)
    {
        $data1 = DB::table('ac_namakegiatan')
                ->select('diselenggarakan_oleh', DB::raw('count(*) as total'))
                ->groupBy('diselenggarakan_oleh')
                ->where("diselenggarakan_oleh","LIKE","%{$request->input('query')}%")
                ->get();
        $data2 = array();
        foreach ($data1 as $data)
            {
                $data2[] = $data->diselenggarakan_oleh;
            }
        return response()->json($data2);
    }

    public function autocomplete3client(Request $request)
    {
        $data1 = DB::table('surat_tugas')
                ->select('lokasi', DB::raw('count(*) as total'))
                ->groupBy('lokasi')
                ->where("lokasi","LIKE","%{$request->input('query')}%")
                ->get();
        $data2 = array();
        foreach ($data1 as $data)
            {
                $data2[] = $data->lokasi;
            }
        return response()->json($data2);
    }


    public function postDropdown() {   
        # Tarik ID inputan
        $set = Input::get('id');

        # Inisialisasi variabel berdasarkan masing-masing tabel dari model
        # dimana ID target sama dengan ID inputan
        $jabatan = jabatan::where('id_pegawai_fk', $set)->get();

        # Buat pilihan "Switch Case" berdasarkan variabel "type" dari form
        switch(Input::get('type')):
            # untuk kasus "kabupaten"
            case 'jabatan':
                # buat nilai default
                $return = '';
                # lakukan perulangan untuk tabel kabupaten lalu kirim
                foreach($jabatan as $temp) 
                    # isi nilai return
                    $return .= "<option value='$temp->nm_jabatan'>$temp->nm_jabatan</option>";
                # kirim
                return $return;
            break;
        # pilihan berakhir
        endswitch;    
    }

    public function postDropdownnipnidn() {   
        # Tarik ID inputan
        $set = Input::get('id');

        # Inisialisasi variabel berdasarkan masing-masing tabel dari model
        # dimana ID target sama dengan ID inputan
        $ceknipnidn = DB::table('pegawai')
        ->select('id_pegawai','nip','nidn')
        ->where('id_pegawai', $set)
        ->get();

        # Buat pilihan "Switch Case" berdasarkan variabel "type" dari form
        switch(Input::get('type')):
            # untuk kasus "kabupaten"
            case 'nipnidn':
                # buat nilai default
                //$return = '<option value="">Pilih NIP Atau NIDN...</option>';
                # lakukan perulangan untuk tabel kabupaten lalu kirim
                foreach($ceknipnidn as $key ) 
                    # isi nilai return
                    $return = "<option value='$key->nip'>NIP : $key->nip</option>";
                    $return .= "<option value='$key->nidn'>NIDN : $key->nidn</option>";
                  # kirim
                return $return;
            break;
        # pilihan berakhir
        endswitch;    
    }


     ///////////////////////////////////////////////tambah/////////////////////////////////////////////////////////////

    public function tambahsrttgsclient(Request $request){
      
        ############################request tabel peserta#############################
        $pegawai = Input::get('pegawai');
        $nipnidn = Input::get('nipnidn');
        $jabatan = Input::get('jabatan');
        $kategori_kegiatan = Input::get('kategori_kegiatan');
        ############################request tabel peserta#############################
        


        $simpansurattugas = $this->datasurattugas($request->all());
        $last_id = DB::getPDO()->lastInsertId($simpansurattugas);

        $files = $request->file('files');
        $berkas=array();

        foreach($files as $file){
            $name = $file->getClientOriginalName();
            $size = $file->getSize();
                $path = public_path().'/berkas/' . $last_id;
                  if(empty($errors)==true){
                      if(!File::isDirectory($path)){
                            Storage::makeDirectory($path, $mode = 0777, true, true);
                          }
                          if(File::isDirectory("$path/".$name)==false){
                               if (file_exists($path.'/'.$name)) {
                                alert()->error('Surat Tugas', 'File Sudah Ada')->persistent('Close');
                                die;
                              }
                              $file->move("$path/",$name);
                          }else{                  // rename the file if another one exist
                                alert()->error('Surat Tugas', 'Terjadi Kesalahan, Harap Coba Kembali')->persistent('Close');
                          }
                      }else{
                              print_r($errors);
                      }

                    $flight = new Berkas;

                    $flight->id_srt_tgs_fk = $last_id;
                    $flight->file_name = $name;
                    $flight->file_size = $size;
                   
                    $flight->save();

        }

        $dataSet = [];
            foreach ($nipnidn as $key => $nipnidnpecah) {

                if (strpos($nipnidnpecah, '.9.') == true) {
                    $nippecah = $nipnidnpecah;
                    $nidnpecah = null;
                }elseif (strpos($nipnidnpecah, '.6.') == true) {
                    $nippecah = $nipnidnpecah;
                    $nidnpecah = null;
                }else{
                    $nidnpecah = $nipnidnpecah;
                    $nippecah = null;
                }
      
        $dataSet[] = [
                'id_surattugas_fk'     => $last_id,
                'id_pegawaip_fk'  => $pegawai[$key],
                'nipp'  => $nippecah,
                'nidnp'  => $nidnpecah,
                'nama_jabatanp'  => $jabatan[$key]
            ];
        }

        $query2 = DB::table('peserta')->insert($dataSet);

    
        if ($simpansurattugas && $flight && $query2) {
            //return response()->json($request->all(),200);
            alert()->success('Surat Tugas', 'Berhasil Melakukan Pengajuan')->persistent('Close');
            
            return Redirect::action('ClientController@index');
        }else{
            abort(500);
        }
    }
    ///////////////////////////////////////////////tambah/////////////////////////////////////////////////////////////




      protected function tanggal_indo($tanggal) {
        $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $split = explode('-', $tanggal);
        return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
    }

     ##################request tabel surat tugas ############################
    protected function datasurattugas(array $data){
        
        $kategori_kegiatan = Input::get('kategori_kegiatan');
        $nama_kegiatan = Input::get('nama_kegiatan');
        $diselenggarakan_oleh = Input::get('diselenggarakan_oleh');
        $lokasi = Input::get('lokasi');
        $waktu_kegiatan = Input::get('waktu_kegiatan');

        $status_acc = 0;

        $pecah = explode(" ", $waktu_kegiatan);
        $tanggal_mulai  = $pecah[0];
        $tanggal_selesai = $pecah[2];
        $jam_mulai = Input::get('jam_kegiatan_mulai');

        if (empty(Input::get('sdselesai')) == false) {
            $jam_selesai = '00:00:00';

        }else{
            $jam_selesai =  Input::get('jam_kegiatan_selesai');
        }

        if ((empty($jam_mulai) == true) && (empty($jamselesai) == true)) {
            $jam_mulai = "00:00:00";
            $jam_selesai = "00:00:00";
        }
       
        $query1 = DB::table('surat_tugas')->insert( 
            [   'kategori_fk'       => $kategori_kegiatan, 
                'nama_kegiatan'     => $nama_kegiatan,
                'penyelengara'      => $diselenggarakan_oleh,
                'lokasi'            => $lokasi,
                'status_acc'        => $status_acc,
                'tanggal_kegiatan_mulai'    => $tanggal_mulai,
                'tanggal_kegiatan_selesai'  => $tanggal_selesai,
                'jam_kegiatan_mulai'        => $jam_mulai,
                'jam_kegiatan_selesai'      => $jam_selesai
            ]
        );

        if ($query1) {
            return true;
        }else{
            alert()->error('Surat Tugas', 'Gagal Melakukan Pengajuan')->persistent('Close');
            return Redirect::action('SuratTugas\SuratTugasController@showtambah');
        }

        ############################ request tabel peserta#############################
    }


}


