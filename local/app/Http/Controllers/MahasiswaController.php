<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\MahasiswaRequests;

use App\ModelMahasiswa;

use Datatables;

use DB;

class MahasiswaController extends Controller
{
    //
	
	public function index(){
		return view('mahasiswa.show_mahasiswa');
	}
	
	public function add(){
		$arragama = array();
	 	$arragama[''] 			= 'Pilih';
	 	$arragama['Islam'] 		= 'Islam';
	 	$arragama['Katholik'] 	= 'Katholik';
	 	$arragama['Protestan'] 	= 'Protestan';
	 	$arragama['Hindu'] 		= 'Hindu';
	 	$arragama['Budha']		= 'Budha';

	 	$arrstatus = array();
	 	$arrstatus['1']		= 'Berhak';
	 	$arrstatus['2']		= 'Tidak Berhak';

		return view('mahasiswa.add_mahasiswa', ['arragama'=>$arragama, 'arrstatus'=>$arrstatus]);
	}

	public function store(MahasiswaRequests $requests){

		$stat=0;
		$model = new ModelMahasiswa;

		$model->nim 			= $requests['nim'];
		$model->nama 			= $requests['nama'];
		$model->tempatlahir 	= $requests['tempatlahir'];
		$model->tanggallahir 	= $requests['tanggallahir'];
		$model->agama 			= $requests['agama'];
		$model->asalsekolah 	= $requests['asalsekolah'];
		$model->namaortu 		= $requests['namaortu'];
		$model->status 			= $requests['status'];
		$save = $model->save();
		

		if($save){
			$stat=1;
		}
		else{
			$stat=2;
		}

		return response()->json(['return' => $stat]);
	}

	public function show(){

		$model = new ModelMahasiswa;
		$data = $model->show();

		return Datatables::of($data)->make(true);
	}
	
	public function autocomplete(Request $request){
		$statreturn = 0;
		$term = $request->get('term');
		if (ModelMahasiswa::where('nim', '=',$term)->exists()) {
			$statreturn=1;
		}
		return response()->json(['return' => $statreturn]);
	}

	public function edit($nim){

		$model = new ModelMahasiswa;

		$arragama = array();
	 	$arragama[''] 			= 'Pilih';
	 	$arragama['Islam'] 		= 'Islam';
	 	$arragama['Katholik'] 	= 'Katholik';
	 	$arragama['Protestan'] 	= 'Protestan';
	 	$arragama['Hindu'] 		= 'Hindu';
	 	$arragama['Budha']		= 'Budha';

	 	$arrstatus = array();
	 	$arrstatus['1']		= 'Berhak';
	 	$arrstatus['2']		= 'Tidak Berhak';

		$model->nim = $nim;
		$data = $model->edit();
		return view('mahasiswa.edit_mahasiswa', ['data'=>$data, 'arragama'=>$arragama, 'arrstatus'=>$arrstatus]);
	}

	public function update(MahasiswaRequests $requests){

		$stat=0;
		$model = new ModelMahasiswa;

		$data = $model->find($requests['nim']);

		$data->nim 			= $requests['nim'];
		$data->nama 		= $requests['nama'];
		$data->tempatlahir 	= $requests['tempatlahir'];
		$data->tanggallahir	= $requests['tanggallahir'];
		$data->agama 		= $requests['agama'];
		$data->asalsekolah 	= $requests['asalsekolah'];
		$data->namaortu 	= $requests['namaortu'];
		$data->status 		= $requests['status'];

		$update = $data->save();

		if($update){
			$stat=1;
		}else{
			$stat=2;
		}

		return response()->json(['return' => $stat]);
	}

	public function destroy($nim){
		
		$statreturn = 0;
		$model = new ModelMahasiswa;
		$data  = $model->find($nim);
		$destroy = $data->delete();
		if($destroy){
			$statreturn = 1;
		}
		return response()->json(['return' => $statreturn]);
	}


	public function getdatamahasiswa($tahunajaran)
	{
		//$getmodel = ModelMahasiswa::all('nama','nim');
		
		 $getmodel = ModelMahasiswa::where(DB::raw('substring(nim, 1, 2)'),"=",$tahunajaran)
		 ->select('nim','nama')->get();
		return Datatables::of($getmodel)->make(true);
	}

	public function detail($nim){
		$model = new ModelMahasiswa;
		$model->nim = $nim;
		$datadetail = $model->detail();
		/*foreach ($datadetail as $key => $value) {
			echo $value->nama;
		}*/
		return view('mahasiswa.detail_mahasiswa', ['datadetail'=>$datadetail]);

	}
}
