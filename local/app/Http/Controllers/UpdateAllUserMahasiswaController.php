<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserMahasiswa;

class UpdateAllUserMahasiswaController extends Controller
{
    //
    public function showform()
    {
    	return view('user_mahasiswa.update_all_usermahasiswa');

    }

    public function postUpdate(Request $request)
    {
    	$statreturn = 0;
        $id = $request->get('id');
        $password=bcrypt($request->get('password'));
        $model_update =UserMahasiswa::find($id);
        if($model_update)
        {
        	$model_update->password = $password;
        	$model_update->remember_token=$request->_token;
        	$model_update->save();
        	$statreturn=1;
        }
		
        return response()->json(['return' => $statreturn]);
    }
}
