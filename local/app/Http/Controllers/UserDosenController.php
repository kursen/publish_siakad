<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ModelDosen;
use App\UserDosen;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class UserDosenController extends Controller
{
    //
    protected $guard ='userdosens';
	public function __construct()
    {
        $this->middleware($this->guard, ['except' => 'logoutdosen']);
    }
	public function index($iddosen)
	{
			if(isset($iddosen)){
				$model = ModelDosen::findOrfail($iddosen);
				return view('menu_dosen.index')->with('model',$model);
		}
	}
	
	public function changepassword($iddosen){
		if(isset($iddosen)){
			$model = ModelDosen::findOrfail($iddosen);
			return view('menu_dosen.changepassword')->with('model',$model);;
		}
	}
	
	public function postchangepassword(Request $request)
	{
		$models = UserDosen::find($request->id);
		
		if (Hash::check($request->LastPassword, $models->password))
		{
			$models->password = bcrypt($request->NewPassword);
			$models->save();
			return redirect('/home/menu_dosen'.'/'.$request->iddosen);
		}else{
			return Redirect::back()->with('AuthErr','Password lama tidak cocok')->withInput($request->except('password'));
		}
	}
	
	public function TempUpload(Request $request)
	{
		$models = UserDosen::find($request->id)->first();
		$imgpath = $request->file('imageuser');
		$img_data = file_get_contents($imgpath);
		$base64 = base64_encode($img_data);

		$models->imageuser = $base64;
		$execute = $models->save();
		if($execute){
			return Redirect::back();
		}
		
	}
}
