<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\PeriodeModel;
use Yajra\Datatables\Datatables;
use NotFoundHttpException;


class PeriodeController extends Controller
{
    //
	public function index(){
		return view('periode.show_periode');
	}
	
		public function edit($idperiode){
			$periode = PeriodeModel::findOrfail($idperiode);
			return view('periode.edit_periode')->with('periode',$periode);;
			
			
	}
	public function add(){
		
		return view('periode.add_periode');
	}
	

	
	public function store(Request $request){
		$stat=0;
		$model = new PeriodeModel;
		//$validator = $tbmatakuliah->validate($request->all());
			
		//if($validator->passes()){
			//$tbmatakuliah = new MataKuliahModel;
			$model->idperiode = $request->idperiode;
			$model->tglawal = $request->tglawal;
			$model->tglakhir = $request->tglakhir;
			$model->sistem = $request->sistem;
			$model->save();
			$stat=1;
			
		//}else{
			//$stat=2;
		//}
		
		return response()->json(['return' => $stat]);
	}
		public function autocomplete(Request $request){
		$statreturn = 0;
		$term = $request->get('term');
		if (PeriodeModel::where('idperiode', '=',$term)->exists()) {
			$statreturn=1;
		}
		return response()->json(['return' => $statreturn]);
	}
	
		public function updateperiode(Request $request){
			$stat=0;
			//validasi
			$tbperiode = new PeriodeModel;
			$validator = $tbperiode->validate($request->all());
			//
			if($validator->passes()){
				$idperiode=$request->idperiode;
				$edit_periode=PeriodeModel::find($idperiode);
					if($edit_periode){
						$edit_periode->sistem = $request->sistem;
						$edit_periode->tglawal = $request->tglawal;
						$edit_periode->tglakhir = $request->tglakhir;
						$edit_periode->save();
						$stat=1;
				}
			}
		
		return response()->json(['return' => $stat]);
	}
		
		
	public function destroy(Request $request){
		$statreturn = 0;
		$term = $request->get('idperiode');
		if(PeriodeModel::destroy($term)){
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
	return view('datatablesperiode.index');
	}
	
	/**
	 * Process datatables ajax request.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getData()
	{
		return Datatables::of(PeriodeModel::query())->make(true);
	}

}
