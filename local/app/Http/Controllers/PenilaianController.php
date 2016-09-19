<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModelPenilaian;
use Datatables;
use Auth;
class PenilaianController extends Controller
{
    public function add(){
    	$model = new ModelPenilaian;
    	$model->iddosen = auth()->guard('userdosens')->user()->iddosen;
    	//$sem 	= $model->getsemester(1);
    	//$kelas 	= $model->getksm(1);
        $kelas = $model->getkelas();
        //$matkul = $model->getsemester(1);
        /*$arrsemester['0'] = "Semester";
        foreach ($sem as $key => $csem) {
            $arrsemester[$csem->semester]   = "Semester ".$csem->semester;
            $arrmatkul[$csem->kodemk]       = $csem->matakuliah;
        }*/
        $arrkelas['0']      = "Kelas";
        $arrsemester['0']   = "Semester";
        $arrmatkul['0']     = "Mata Kuliah";
        /*foreach ($kelas as $key => $ckelas) {
            //$arrkelas[$ckelas->idkelas]       = $ckelas->namakelas;
            $arrmatkul[$ckelas->kodemk]       = $ckelas->matakuliah;
            $arrsemester[$ckelas->semester]   = "Semester ".$ckelas->romsem;
        }*/
        foreach ($kelas as $key => $ckelas2) {
            $arrkelas[$ckelas2->idkelas]       = $ckelas2->namakelas;
            
        }
       /* $arrmatkul['0']   = "Mata Kuliah";
        foreach ($matkul as $key => $cmatkul) {
            $arrmatkul[$cmatkul->kodemk] = $cmatkul->matakuliah;
        }*/
    	return view("penilaian.add_penilaian", ['arrsemester' => $arrsemester, 'arrkelas'=>$arrkelas, 'arrmatkul'=>$arrmatkul]);
    }
    public function getsem($kelas){
        $model = new ModelPenilaian;
        $model->iddosen     = auth()->guard('userdosens')->user()->iddosen;     
        $model->idkelas     = $kelas;
        $datasem = $model->getsem();
        return Datatables::of($datasem)->make(true);
    }
    public function getmk($kelas, $sem){
        $model = new ModelPenilaian;
        $model->iddosen     = auth()->guard('userdosens')->user()->iddosen;     
        $model->idkelas     = $kelas;
        $model->semester    = $sem;
        $datamk = $model->getmatakuliah();
        return Datatables::of($datamk)->make(true);
    }
    public function getsemmk($sem){
        $model = new ModelPenilaian;
    
        $model->semester    = $sem;
        $datamk = $model->getallmatkul();
        return Datatables::of($datamk)->make(true);
    }
    public function getdatamhs($kelas, $sem, $matkul){
    	$model = new ModelPenilaian;
    	$model->iddosen 	= auth()->guard('userdosens')->user()->iddosen;  	
    	$model->idkelas		= $kelas;
    	$model->semester 	= $sem;
        $model->kodemk      = $matkul;
    	$datamhs = $model->showdatamhs();
    	return Datatables::of($datamhs)->make(true);
    }
    public function store(Request $requests){
        $model = new ModelPenilaian;
        $dosen      = auth()->guard('userdosens')->user()->iddosen;
        $nim        = $requests->nim;
        $absensi    = $requests->absensi;
        $seminar    = $requests->seminar;
        $tugas      = $requests->tugas;
        $midsm      = $requests->midsm;
        $nsemester  = $requests->nsemester;
        $nket       = $requests->ket;
        $kelas    = $requests->idkelas;
        $semester   = $requests->sem;
        $matkul     = $requests->matkul;
        foreach ($nim as $key => $vnim) {
            $datanim [] = $vnim;
        }
        foreach ($absensi as $key => $vabsensi) {
            $dataabsensi [] = $vabsensi;
        }
        foreach ($seminar as $key => $vseminar) {
            $dataseminar [] = $vseminar;
        }
        foreach ($tugas as $key => $vtugas) {
            $datatugas [] = $vtugas;
        }
        foreach ($midsm as $key => $vmidsm) {
            $datamidsem [] = $vmidsm;
        }
        foreach ($nsemester as $key => $vnsemester) {
            $datansemester [] = $vnsemester;
        }
        foreach ($nket as $key => $vket) {
            $dataket [] = $vket;
        }
       for($i=0; $i<count($datanim); $i++){
            $data [] = array(
                            'nim'       => $datanim[$i],
                            'kodemk'    => $matkul,
                            'absensi'   => $dataabsensi[$i],
                            'seminar'   => $dataseminar[$i],
                            'tugas'     => $datatugas[$i],
                            'midsm'     => $datamidsem[$i],
                            'nsem'      => $datansemester[$i],
                            'keterangan' => $dataket[$i],
                            'iddosen'   => $dosen,
                            'idkelas'   => $kelas,
                            'semester'  => $semester
                         );
       }
       $save = $model->insert($data);
        if($save){
            $stat = 1;
        }
        else{
            $stat = 2;
        }
        return response()->json(['return' => $stat]);
    }
    public function show(){
        $model = new ModelPenilaian;
        $model->iddosen = auth()->guard('userdosens')->user()->iddosen;
        $kelas = $model->getkelas();
        $arrkelas['0']      = "Kelas";
        $arrsemester['0']   = "Semester";
        $arrmatkul['0']     = "Mata Kuliah";
        foreach ($kelas as $key => $ckelas) {
            $arrkelas[$ckelas->idkelas]       = $ckelas->namakelas;
            
        }
        return view("penilaian.show_penilaian", ['arrsemester' => $arrsemester, 'arrkelas'=>$arrkelas, 'arrmatkul'=>$arrmatkul]);
        
    }
    public function shownilai(){
        $model = new ModelPenilaian;
        $kelas = $model->getallkelas();
        $arrkelas['0']      = "Kelas";
        $arrsemester['0']   = "Semester";
        $arrmatkul['0']     = "Mata Kuliah";
        foreach ($kelas as $key => $ckelas) {
            $arrkelas[$ckelas->idkelas]       = $ckelas->namakelas;
            
        }
        $arrsemester['1']   = "Semester I";
        $arrsemester['2']   = "Semester II";
        $arrsemester['3']   = "Semester III";
        $arrsemester['4']   = "Semester IV";
        $arrsemester['5']   = "Semester V";
        $arrsemester['6']   = "Semester VI";
        $arrsemester['7']   = "Semester VII";
        $arrsemester['8']   = "Semester VIII";
        return view("penilaian.showadmin_penilaian", ['arrsemester' => $arrsemester, 'arrkelas'=>$arrkelas, 'arrmatkul'=>$arrmatkul]);
        
    }
    public function datakhs($kelas, $sem, $matkul){
        $model = new ModelPenilaian;
        $model->idkelas  = $kelas;
        $model->semester = $sem;
        $model->kodemk   = $matkul;
        $datanilai = $model->showpenilaian();
        return Datatables::of($datanilai)->make(true);
    }
    public function editnilai($idkhs){
        $model = new ModelPenilaian;
        $model->idkhs  = $idkhs;
        $datanilai = $model->editnilai();
       return view("penilaian.edit_penilaian", ['datanilai'=>$datanilai]);
    }
    public function update(Request $requests){
        $stat=0;
        $model = new ModelPenilaian;
        $data = $model->find($requests['idkhs']);
        $data->absensi     = $requests['absensi'];
        $data->seminar     = $requests['seminar'];
        $data->tugas       = $requests['tugas'];
        $data->midsm       = $requests['midsm'];
        $data->nsem        = $requests['uas'];
        $data->keterangan  = $requests['keterangan'];
        $update = $data->save();
        if($update){
            $stat=1;
        }else{
            $stat=2;
        }
        return response()->json(['return' => $stat]);
    }
    public function destroy($idkhs){
        
        $statreturn = 0;
        $model = new ModelPenilaian;
        $data  = $model->find($idkhs);
        $destroy = $data->delete();
        if($destroy){
            $statreturn = 1;
        }
        return response()->json(['return' => $statreturn]);
    }
}
