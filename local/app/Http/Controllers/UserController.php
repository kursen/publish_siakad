<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\UserMahasiswa;
use App\UserDosen;
use App\ModelUser;
use DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    public function show_admin(){
    	return view('user_admin.show');
    }

      public function add_user_admin()
    {
        return view('user_admin.register');
    }

    public function store_user_admin(Request $request)
    {
    	
        $validasi = $this->validate($request,[
        		'name'=>'required',
        		'email'=>'required|email',
        		'password' => 'required|min:6|confirmed'
        	]);
        	$model = new ModelUser;
            $model->name = $request->name;
			$model->email = $request->email;
			$model->password = bcrypt($request->password);
			$model->remember_token = $request->_token;
			$model->admin = $request->admin;
			$execute=$model->save();
            if($execute)
            {
                return redirect('/home/show_useradmin');
            }else{
            	return Redirect::back()->withInput($request->except('password'));
        	}
            
    }

    public function uploadimage(Request $request)
    {
    	$models = ModelUser::where('id',$request->id)->first();
		$imgpath = $request->file('image_user');
		$img_data = file_get_contents($imgpath);
		$base64 = base64_encode($img_data);

		$models->imageuser = $base64;
		$execute = $models->save();
		if($execute){
			return Redirect::back();
		}
    }

    public function update_admin(Request $request)
    {
    	 $validasi = $this->validate($request,[
        		'name'=>'required',
        		'email'=>'required|email',
        		'password' => 'required|min:6|confirmed'
        	]);
    	 $id=$request->id;
    	$model_update = ModelUser::find($id);
    	if($model_update)
    	{
    		$model_update->name = $request->name;
			$model_update->email = $request->email;
			$model_update->password = bcrypt($request->password);
			$model_update->remember_token = $request->_token;
			$model_update->admin = $request->admin;
			$execute=$model_update->save();
			 if($execute)
            {
                return redirect('/home/show_useradmin');
            }else{
            	return Redirect::back()->withInput($request->except('password'));
        	}
    	}
    }

    public function changepassword_admin()
    {
    	return view('user_admin.changepassword');
    }

    public function post_changepassword_admin(Request $request)
    {
    	$models = ModelUser::where('id',$request->id)->first();
		
		if (Hash::check($request->LastPassword, $models->password))
		{
			$models->password = bcrypt($request->NewPassword);
			$models->save();
			return redirect('/home/');
		}else{
			return Redirect::back()->with('AuthErr','Password lama tidak cocok')
			->withInput($request->except('password'));
		}
    }

    public function edit_admin($id)
    {
    	$modeledit = ModelUser::find($id);
    	return view('user_admin.edit',array('modeledit'=>$modeledit));
    }

    public function getDataAdmin()
    {
    	return Datatables::of(ModelUser::query())->make(true);
    }

    public function destroy_admin(Request $request)
    {
    	$statreturn = 0;
		$term = $request->get('id');
		if(ModelUser::destroy($term)){
			$statreturn=1;
		}
		return response()->json(['return' => $statreturn]);
    }


	public function add_user_mahasiswa(){
		return view('user_mahasiswa.register');
	}
	
	public function store_user_mahasiswa(Request $request){
		
			$model = new UserMahasiswa;
			$model->nim = $request->nim;
			$model->nama = $request->nama;
			$model->email = $request->email;
			$model->password = bcrypt($request->password);
			$model->remember_token = $request->_token;
			$model->save();
			$stat=1;
			
		
		return response()->json(['return' => $stat]);
	}
	
	
	//autocomplete mahasiswa
	public function autocomplete_mahasiswa_checknim(Request $request){
		$stat=0;
		$term = $request->get('term');
		$results = array();
		$queries = DB::table('mahasiswa')->where('nim', 'LIKE', '%'.$term.'%')->take(10)->get();
	
			foreach ($queries as $query){
				$results[] = ['nim' => $query->nim, 'nama' => $query->nama];
			}
		
		return response()->json($results);
		
	
		
		//return Response::json($results);
		/*if (UserMahasiswa::where('nim', '=',$term)->exists()) {
			$statreturn=1;
			return response()->json($statreturn);
		}*/
	}

	public function delete_usermahasiswa(Request $request)
	{
		$statreturn = 0;
		$term = $request->get('id');
		if(UserMahasiswa::destroy($term)){
			$statreturn=1;
		}
		return response()->json(['return' => $statreturn]);
	}

	public function edit_usermahasiswa($id)
	{
		$modeledit = UserMahasiswa::find($id);
    	return view('user_mahasiswa.edit',array('modeledit'=>$modeledit));
	}
	
	public function update_usermahasiswa(Request $request)
	{
		$id = $request->id;
			$model = UserMahasiswa::find($id);
			$model->nim = $request->nim;
			$model->nama = $request->nama;
			$model->email = $request->email;
			$model->password = bcrypt($request->password);
			$model->remember_token = $request->_token;
			$model->save();
			$stat=1;
			
		
		return response()->json(['return' => $stat]);
	}

	/**
	 * Displays datatables front end view
	 *
	 * @return \Illuminate\View\View
	 */
	public function getIndex_usermahasiswa()
	{
		return view('datatables_usermahasiswa.index');
	}
	
	/**
	 * Process datatables ajax request.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getData_usermahasiswa()
	{
		return Datatables::of(UserMahasiswa::query())->make(true);
	}
	
	public function add_user_dosen(){
		return view('user_dosen.register');
	}
	
	
	public function store_user_dosen(Request $request){
			$model_dosen = new UserDosen;
			$model_dosen->iddosen = $request->iddosen;
			$model_dosen->nama = $request->nama;
			$model_dosen->email = $request->email;
			$model_dosen->password = bcrypt($request->password);
			
			$model_dosen->save();
			$stat=1;
			return response()->json(['return' => $stat]);
	}

	public function show_user_dosen()
	{
		return view('user_dosen.show_users_dosen');
	}

	public function edit_user_dosen($id)
	{
		$modeledit = UserDosen::find($id);
    	return view('user_dosen.edit',array('modeledit'=>$modeledit));
	}
	
	public function getDataDosen()
	{
		return Datatables::of(UserDosen::query())->make(true);
	}

	public function destroy_dosen(Request $request)
	{
		$statreturn = 0;
		$term = $request->get('id');
		if(UserDosen::destroy($term)){
			$statreturn=1;
		}
		return response()->json(['return' => $statreturn]);
	}

	public function update_dosen(Request $request)
	{
		$id = $request->id;
			$model = UserDosen::find($id);
			$model->nama = $request->nama;
			$model->email = $request->email;
			$model->password = bcrypt($request->password);
			$model->remember_token = $request->_token;
			$model->save();
			$stat=1;
			
		
		return response()->json(['return' => $stat]);
	}

	public function autocomplete_dosen(Request $request)
	{
		$stat=0;
		$term = $request->get('term');
		$results = array();
		$queries = DB::table('dosen')->where('nama', 'LIKE', '%'.$term.'%')->take(5)->get();
	
			foreach ($queries as $query){
				$results[] = ['nidn' => $query->nidn, 'nama' => $query->nama,'iddosen'=>$query->iddosen];
			}
		
		return response()->json($results);
	}

	public function check_iddosen(Request $request)
	{
		$stat=0;
		$iddosen =$request->get('iddosen');
		$check = UserDosen::where('iddosen','=',$iddosen)->first();
		if($check)
		{
			$stat=1;
		}
		return response()->json($stat);
	}
}
