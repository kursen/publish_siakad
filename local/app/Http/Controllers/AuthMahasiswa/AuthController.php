<?php

namespace App\Http\Controllers\AuthMahasiswa;

use App\UserMahasiswa;
use App\ModelMahasiswa;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
	protected $guard ='usermahasiswas';
    protected $redirectTo = '/home/menu_mahasiswa';
    
  

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama' => 'required|max:255',
            'nim' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return UserMahasiswa::create([
            'nama' => $data['nama'],
            'nim' => $data['nim'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
	
	 public function showLoginForm()
	{
        if(Auth::guard($this->guard)->check())
        {
            $nim=Auth::guard($this->guard)->user()->nim;
            return redirect($this->redirectTo.'/'.$nim);
        }
		return view('user_mahasiswa.login');
    }
	
	public function mahasiswaLoginPost(Request $request)
	{
			$credentials =[
			'nim'=>$request->nim,
			'password'=>$request->password
			];
			
			$authorized = auth()->guard($this->guard)->attempt($credentials);
			if($authorized)
			{
				return redirect($this->redirectTo.'/'.$request->nim);
			}else
			{
				
				return Redirect::back()->with('AuthErr','Nim atau Password Salah!')->withInput($request->except('password'));
			}

	}

    public function logoutmahasiswa(){
        Auth::guard($this->guard)->logout();
        return redirect('login-mahasiswa');
    }
}
