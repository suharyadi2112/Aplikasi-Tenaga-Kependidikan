<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User as User;
use App\level as Level;
use DataTables;
use DB;
use Validator;
use Response;
use Redirect; 
use Alert;
use Hash;
use Auth;

class UserController extends Controller
{	
	//////index///////
	public function index(){

		//$level = Level::orderBy('id_level')->get();
    	return view('admin.dashboard.user.index');
    	
    }
    public function prodilist(){

	    return DataTables::of(DB::table('users')
		->join('usergroup', 'usergroup.id', '=', 'users.level')
       	->select('*'))
	    ->addColumn('action', function($data){
	                    $button = '<a href="user/'.$data->username.'/edit">
	                         	 	<button type="button" class="btn btn-primary btn-xs"><span class="fa fa-edit"> Edit User</span></button>
	                          </a>';
	                    $button .= '&nbsp;&nbsp;';
	                    $button .= '<button type="button" name="delete" id="'.$data->username.'" class="delete btn btn-danger btn-xs"><span class="fa fa-trash"> Delete User</span></button>';
	                    $button .= '&nbsp;&nbsp;';
	                    $button .= '<button type="button" name="reset" id="'.$data->username.'" class="reset btn btn-warning btn-xs"><span class="fa fa-recycle"> Reset Password</span></button>';
	                    return $button;
	                })
	                ->rawColumns(['action'])
	                ->make(true);

	}
	//////index///////


	//////tambah///////
	public function showtambah(){

		//$level = Level::orderBy('id_level')->get();
        $usergroup = DB::table('usergroup')->select('*')->get();
		return view('admin.dashboard.user.tambahuser',['usergroup' => $usergroup]);

	}

	protected function validator(array $data)
    {
        $messages = [
            'username.required'    => 'Username dibutuhkan.',
            'username.unique'      => 'Username sudah Digunakan.',
            'password.required'    => 'Password dibutuhkan.',
            'level.required'       => 'level dibutuhkan.',
            'password.confirmed'   => 'Password dan Konfirmasi password tidak sama.',
            'password.min'         => 'Panjang password minimal 6 karakter',
            
        ];
        return Validator::make($data, [
            'username' 	=> 'required|unique:users',
            'level'	 	=> 'required',
            'password' 	=> 'required|confirmed|min:6'
            
        ], $messages);
    }

    protected function insertakun(array $data)
    {

        $account = new User();
        $account->name        		= $data['name'];
        $account->username        	= $data['username'];
        $account->level         	= $data['level'];
        $account->password         	= bcrypt($data['password']);

        //melakukan save, jika gagal (return value false) lakukan harakiri
        //error kode 500 - internel server error
        if (! $account->save() )
          App::abort(500);

    }

    public function tambahakun(Request $request)
    {
        $validator = $this->validator($request->all(), 'user')->validate();
 
        $this->insertakun($request->all());
 
        response()->json($request->all(),200);

        alert()->success('User', 'Berhasil Simpan Data')->persistent('Close');

        return Redirect::action('Auth\UserController@index')
                          ->with('successMessage','Data User "'.Input::get('name').'" telah berhasil ditambah.');

    }
    //////tambah///////


    //////Edit///////

   	public function edituser($id){


	        //$data = User::find($id);
            $data = DB::table('users')->select('*')->where('username','=',$id)->first();
  
	        $levelgrup = DB::table('usergroup')->select('*')->get();

	        return view('admin.dashboard.user.edituser',['data' => $data, 'levelgrup' => $levelgrup]);
	    }


	public function simpanedit($id){

       $input = Input::all();

       foreach ($input as $key) {
            $input['username'];
       }
       $usernamec = $input['username'];
       
        $messages = [
            'username.required'     =>   'Username dibutuhkan.'
        ];
        
        $validator = Validator::make($input, [
                           	'username' 	=> 'required'

                      ], $messages);

        if($validator->fails()) {
            # Kembali kehalaman yang sama dengan pesan error
            return Redirect::back()->withErrors($validator)->withInput();
          # Bila validasi sukses
        }

        //$editProdi = Prodi::find($id);
        //$editProdi->prodiKode = Input::get('prodiKode'); //atau bisa $input['prodiKode']
        //$editProdi->prodiNama = $input['prodiNama'];
        //$editProdi->prodiKodeJurusan = Input::get('prodiJurKode');
        $users_count = DB::table('users')
         ->where('username', '=', $usernamec)
         ->count();

        $data = User::find($id);
        if ($users_count > 0 && $usernamec != $data->username) {
            $messages = [
                'username'     =>   'Username Sudah Digunakan.'
            ];
           return Redirect::back()->withErrors($messages)->withInput();
        }

        $user = DB::table('users')->where('id', $id)->update([
			'name' => $input['name'],
			'username' => $input['username'],
			'level' => $input['level']
			]);

        if ($user) {
        	return Redirect::action('Auth\UserController@index')
                            ->with('successMessage','Data User "'.Input::get('name').'" telah berhasil diubah.'); 
        }else{
        	return Redirect::action('Auth\UserController@index');
        }
    }


    //////Edit///////


    //////Hapus///////
    public function destroy($id){


    if($this->cek_akses('76') == 'yes'){

            $data = DB::table('users')->where('username', '=', $id)->delete();

            if ($data) {
                alert()->success('User', 'Berhasil Hapus Data')->persistent('Close');
            }else{
                alert()->error('User', 'Gagal Menghapus Data')->persistent('Close');
            }

        }else{
        return Response::json(array(
                                'success' => false,
                                'errors' => 'Tidak Memiliki Akses #l345lh34',
                            ), 400);
      } 

      
	}
	//////Hapus///////

	//reseting//
	public function reset($id){

        if($this->cek_akses('77') == 'yes'){

                $input  = Input::all();
                $user   = DB::table('users')->where('username', $id)->update([
                    'password' => bcrypt('12345678'),
                    ]);

                if ($user) {
                    return Redirect::action('Auth\UserController@index')
                                  ->with('successMessage','Data telah berhasil direset.'); 
                }else{
                    abort(500);
                }

        }else{

            return Response::json(array(
                                'success' => false,
                                'errors' => 'Tidak Memiliki Akses #l345lh34',
                            ), 400);

        }

       
    }
    //resetting//


    //////change password//////
    public function showChangePasswordForm(){
        return view('admin.dashboard.user.changepassword');
    }
    
    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        DB::table('backup_pass')->insert(
            ['id_user_c' =>  Auth::user()->id, 'password' => $request->get('new-password'),'created_at' => \Carbon\Carbon::now()]
        );

        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password Berhasil Diganti !");


    }
    //////change password//////



    protected function cek_akses($aModul) {

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

}
