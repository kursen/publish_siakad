<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ModelKelasDosen;
use Datatables;
class KelasDosenController extends Controller
{
    public function index(){
    	return view('kelas_dosen.show_kelasdosen');
    }
    public function add(){
    	$model = new ModelKelasDosen;
    	$datakelas = $model->datakelas();
    	$arrkelas = array();
    	$arrkelas[''] = 'Pilih';
    	foreach ($datakelas as $key => $ckelas) {
    		$arrkelas[$ckelas->idkelas] = $ckelas->namakelas;
    	}
    	return view('kelas_dosen.add_kelasdosen', ['arrkelas'=>$arrkelas]);
    }
    public function edit($idkelasdosen){
    	$model = new ModelKelasDosen;
    	$datakelas = $model->datakelas();
    	$arrkelas = array();
    	foreach ($datakelas as $key => $ckelas) {
    		$arrkelas[$ckelas->idkelas] = $ckelas->namakelas;
    	}
    	$model->idkelasdosen = $idkelasdosen;
    	$datakelasdosen = $model->datakelasdosen();
    	return view('kelas_dosen.edit_kelasdosen', ['datakelasdosen'=>$datakelasdosen, 'arrkelas'=>$arrkelas]);
    }
    public function datadosen($idkelas){
    	$model = new ModelKelasDosen;
    	$model->idkelas = $idkelas;
    	$datadosen = $model->datadosen();
    	return Datatables::of($datadosen)->make(true);
    }
    public function update(Request $requests){
    	$stat = 0;
    	$model = new ModelKelasDosen;
    	$data = $model->find($requests['idkelasdosen']);
    	$data->idkelas = $requests['idkelas'];
    	$update = $data->save();
  		
  		if($update){
  			$stat = 1;
  		}else{
  			$stat = 2;
  		}
    	return response()->json(['return' => $stat ]);
    }
    public function store(Request $requests){
    	
    	$stat = 0;
    	$model = new ModelKelasDosen;
    	
    	$iddosen = $requests->iddosen;
        $kodemk = $requests->kodemk;
    	
        foreach ($iddosen as $key => $valuedosen) {
            $datadosen[] = $valuedosen;
        }
        foreach ($kodemk as $key => $valuekodemk) {
            $datamk[] = $valuekodemk;
        }
        for($i=0; $i<count($datadosen); $i++){
            $data [] = array(
                            'iddosen' => $datadosen[$i],
                            'idkelas' => $requests['idkelas'],
                            'kodemk'  => $datamk[$i]
                            );
        }
    	$save = $model->insert($data);
    	if($save){
    		$stat = 1;
    	}
    	else{
    		$stat = 2;
    	}
    	//echo $stat;
    	return response()->json(['return' => $stat ]);
    }
    public function show(){
    	$model = new ModelKelasDosen;
    	$data = $model->showkelasdosen();
		return Datatables::of($data)->make(true);
    }
    public function destroy($idkelasdosen){
    	
    	$stat = 0;
		$model = new ModelKelasDosen;
		$data  = $model->find($idkelasdosen);
		$destroy = $data->delete();
		if($destroy){
			$stat = 1;
		}
		return response()->json(['return' => $stat]);
    }
}
