<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MataKuliahModel;
use App\ModelDetailMatakuliah;
use Yajra\Datatables\Datatables;
use NotFoundHttpException;
class MataKuliahController extends Controller
{
	
    //
	public function index(){
		return view('matakuliah.show_matakuliah');
	}
	
	public function edit($kodemk){
		 
				$arrsemester =array(
					'1'=>'Semester 1',
					'2'=>'Semester 2',
					'3'=>'Semester 3',
					'4'=>'Semester 4',
					'5'=>'Semester 5',
					'6'=>'Semester 6',
					'7'=>'Semester 7',
					'8'=>'Semester 8');
				
			$matakuliah = MataKuliahModel::with(['relasi_detailmatakuliah'])->findOrfail($kodemk);
			$detailmatakuliah = ModelDetailMatakuliah::with(['relasi_dosen'])->where('kodemk',$kodemk)->get();

			return view('matakuliah.edit_matakuliah',compact('arrsemester','matakuliah','detailmatakuliah'));
			
	}
	
	public function autocomplete(Request $request){
		$statreturn = 0;
		$term = $request->get('term');
		if (MataKuliahModel::where('kodemk', '=',$term)->exists()) {
			$statreturn=1;
		}
		return response()->json(['return' => $statreturn]);
	}
	
	public function add(){
		$arrsemester =array(
		'1'=>'Semester 1',
		'2'=>'Semester 2',
		'3'=>'Semester 3',
		'4'=>'Semester 4',
		'5'=>'Semester 5',
		'6'=>'Semester 6',
		'7'=>'Semester 7',
		'8'=>'Semester 8');
		return view('matakuliah.add_matakuliah',array('arrsemester' => $arrsemester));
	}
	
	public function store(Request $request){
		$stat=0;
		$tbmatakuliah = new MataKuliahModel;
		$validator = $tbmatakuliah->validate($request->all());
			
		if($validator->passes()){
			$tbmatakuliah = new MataKuliahModel;
			$tbmatakuliah->kodemk = $request->kodemk;
			$tbmatakuliah->matakuliah = $request->matakuliah;
			$tbmatakuliah->bobot = $request->bobot;
			$tbmatakuliah->teori = $request->teori;
			$tbmatakuliah->praktek = $request->praktek;
			$tbmatakuliah->klinik = $request->klinik;
			$tbmatakuliah->kadep = $request->kadep;
			$tbmatakuliah->semester = $request->semester;
			$tbmatakuliah->bobotnilai = $request->bobotnilai;
			//looping nidn to input
			$model = array();
	        $arriddosen = $request->iddosen;
	        foreach ($arriddosen as $key => $value) {
	            # code...
	            $data = array(
	                'kodemk'=>$request->kodemk,
	                'iddosen'=>$value
	            );
	            array_push($model, $data);
	        }
	        $tbmatakuliah->save();
			$stat=1;
	        $execute = ModelDetailMatakuliah::insert($model);
	        if($execute)
	        {
	            $stat=1;
	        }
		}else{
			$stat=2;
		}
		
		return response()->json(['return' => $stat]);
	}
	
	public function updatematakuliah(Request $request){
			$stat=0;
			//validasi
			$tbmatakuliah = new MataKuliahModel;
			$validator = $tbmatakuliah->validate($request->all());
			//
			if($validator->passes()){
				$kodemk=$request->kodemk;
				$edit_mk=MataKuliahModel::find($kodemk);
					if($edit_mk){
						$edit_mk->matakuliah = $request->matakuliah;
						$edit_mk->bobot = $request->bobot;
						$edit_mk->teori = $request->teori;
						$edit_mk->praktek = $request->praktek;
						$edit_mk->klinik = $request->klinik;
						$edit_mk->kadep = $request->kadep;
						$edit_mk->semester = $request->semester;
						$edit_mk->bobotnilai = $request->bobotnilai;
						$edit_mk->save();
						$stat=1;
						$model = array();
						if(isset($request->iddosen))
						{
							$arriddosen = $request->iddosen;
							foreach ($arriddosen as $key => $value) {
				            # code...
					            $data = array(
					                'kodemk'=>$request->kodemk,
					                'iddosen'=>$value
					            );
					            array_push($model, $data);
				        	}
				        	$execute = ModelDetailMatakuliah::insert($model);
				        	if($execute)
		        			{
		            			$stat=1;
		        			}
						}
						
					}
			}
		
		return response()->json(['return' => $stat]);
	}
	
	public function destroy(Request $request){
		$statreturn = 0;
		$term = $request->get('kodemk');
		if(MataKuliahModel::destroy($term)){
			$statreturn=1;
		}
		return response()->json(['return' => $statreturn]);
	}
	
	
	
	/**
	 * Displays datatables front end view
	 *
	 * @return \Illuminate\View\View
	 */
	public function getIndex()
	{
		return view('datatablesmatakuliah.index');
	}
	public function getData()
	{
		return Datatables::of(MataKuliahModel::query())->make(true);
	}
	
	/**
	 * Process datatables ajax request.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	

	public function check(Request $request){

		$statreturn = 0;
        $kodemk = $request->get('kodemk');
        $nidn = $request->get('nidn');
        $where_group =['iddosen'=>$nidn,'kodemk'=>$kodemk];
        if (ModelDetailMatakuliah::where($where_group)->exists()) {
            $statreturn=1;
        }
        return response()->json(['return' => $statreturn]);
	}

	public function delete_dosen_detailmatakuliah(Request $request)
	{
		$statreturn = 0;
		$term = $request->get('id');
		if(ModelDetailMatakuliah::destroy($term)){
			$statreturn=1;
		}
		return response()->json(['return' => $statreturn]);
	}

	public function detail($kodemk)
	{
		$matakuliah = MataKuliahModel::with(['relasi_detailmatakuliah'])->findOrfail($kodemk);
		$detailmatakuliah = ModelDetailMatakuliah::with(['relasi_dosen'])->where('kodemk',$kodemk)->get();
		return view('matakuliah.detail_matakuliah',compact('matakuliah','detailmatakuliah'));
	}
}
