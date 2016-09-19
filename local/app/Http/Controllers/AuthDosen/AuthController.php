<?php

namespace App\Http\Controllers\AuthDosen;

use App\UserDosen;
use App\ModelDosen;
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
	protected $guard ='userdosens';
    protected $redirectTo = '/home/menu_dosen';
//
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware($this->guard, ['except' => 'logoutdosen']);
    }*/
    
  

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
            'nidn' => 'required|max:255',
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
        return UserDosen::create([
            'nama' => $data['nama'],
            'nidn' => $data['nim'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
	
	 public function showLoginForm()
	{
        if(Auth::guard('userdosens')->check())
        {
            $iddosen=Auth::guard('userdosens')->user()->iddosen;
            return redirect($this->redirectTo.'/'.$iddosen);
        }
		return view('user_dosen.login');
    }
	
	public function DosenLoginPost(Request $request)
	{
			$credentials =[
			'email'=>$request->email,
			'password'=>$request->password
			];
			


			$authorized = auth()->guard($this->guard)->attempt($credentials);
			if($authorized)
			{
                $getIddosen = UserDosen::where('email','=',$request->email)->first();
				return redirect($this->redirectTo.'/'.$getIddosen->iddosen);
			}else
			{
				
				return Redirect::back()->with('AuthErr','Email atau Password Salah!')->withInput($request->except('password'));
			}

	}

    public function logoutdosen(){
        Auth::guard($this->guard)->logout();
        return redirect('login-dosen');
    }
}
