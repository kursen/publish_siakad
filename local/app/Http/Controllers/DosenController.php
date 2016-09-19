<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ModelDosen;

use Datatables;

use DB;

class DosenController extends Controller
{
    //
	public function index(){

		return view('dosen.show_dosen');
	}
	
	public function add(){

		$arrjabakademik = array(
			''				=> 'Pilih',
			'Proses'	=> 'Proses',
			'Assisten Ahli'	=> 'Assisten Ahli',
			'Lektor'		=> 'Lektor',
			'Lektor Kepala'	=> 'Lektor Kepala',
			'Professor'		=> 'Professor'
			);

		$arrpendidikan =array(
			''	 => 'Pilih',
			'DIV' => 'DIV',
			'S1' => 'S1',
			'S2' => 'S2',
			'S3' => 'S3'
			);
		return view('dosen.add_dosen', compact('arrjabakademik','arrpendidikan'));
	}

	public function show(){
		$model = new ModelDosen;
		$data = $model->showdosen();

		return Datatables::of($data)->make(true);
	}

	public function edit($iddosen)
	{
		$model = new ModelDosen;

		$arrjabakademik = array(
			''				=> 'Pilih',
			'Proses'	=> 'Proses',
			'Assisten Ahli'	=> 'Assisten Ahli',
			'Lektor'		=> 'Lektor',
			'Lektor Kepala'	=> 'Lektor Kepala',
			'Professor'		=> 'Professor'
			);

		$arrpendidikan =array(
			''	 => 'Pilih',
			'DIV' => 'DIV',
			'S1' => 'S1',
			'S2' => 'S2',
			'S3' => 'S3'
			);
		
		$model->iddosen = $iddosen;
		$datadosen = $model->showdata();
		return view('dosen.edit_dosen', compact('arrjabakademik','arrpendidikan', 'datadosen'));
	}

	public function store(Request $requests){

		$stat = 0;
		$model = new ModelDosen;

		$model->iddosen			= null;
		$model->nidn 			= $requests['nidn'];
		$model->nama 			= $requests['nama'];
		$model->tgllahir 		= $requests['tanggallahir'];
		$model->jabatanakademik = $requests['jabatanakademik'];
		$model->sertifikat 		= $requests['sertifikat'];
		$model->pendidikan 		= $requests['pendidikan'];
		$model->asalpt 			= $requests['asalpt'];
		$model->bidang 			= $requests['bidang'];
		$save = $model->save();

		if($save){
			$stat=1;
		}
		else{
			$stat=2;
		}

		return response()->json(['return' => $stat]);
	}

	public function update($iddosen, Request $requests)
	{
		$stat = 0;
		$model = new ModelDosen;

		$data = $model->find($iddosen);

		$data->nidn 			= $requests['nidn'];
		$data->nama 			= $requests['nama'];
		$data->tgllahir 		= $requests['tanggallahir'];
		$data->jabatanakademik  = $requests['jabatanakademik'];
		$data->sertifikat 		= $requests['sertifikat'];
		$data->pendidikan 		= $requests['pendidikan'];
		$data->asalpt 			= $requests['asalpt'];
		$data->bidang 			= $requests['bidang'];
		$update = $data->save();

		if($update){
			$stat=1;
		}
		else{
			$stat=2;
		}

		return response()->json(['return' => $stat]);
	}

	public function destroy($iddosen){
		
		$stat = 0;
		$model = new ModelDosen;
		$data  = $model->find($iddosen);
		$destroy = $data->delete();
		if($destroy){
			$stat = 1;
		}
		return response()->json(['return' => $stat]);
	}

	public function getDataDosenPengampu()
	{
		$getmodel = ModelDosen::all('nama','nidn','iddosen');
		return Datatables::of($getmodel)->make(true);
	}

	public function check_nidn(Request $request){
		$statreturn = 0;
		$term = $request->get('term');
		if (ModelDosen::where('nidn', '=',$term)->exists()) {
			$statreturn=1;
		}
		return response()->json(['return' => $statreturn]);
	}

	public function detail($iddosen){
		$cdatadetail = ModelDosen::where('iddosen',$iddosen)->first();
		return view('dosen.detail_dosen', ['cdatadetail'=>$cdatadetail]);

	}

}
