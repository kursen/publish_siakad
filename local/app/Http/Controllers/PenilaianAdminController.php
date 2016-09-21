<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModelPenilaian;
use Datatables;
class PenilaianAdminController extends Controller
{

   public function getsemmk($sem){
        $model = new ModelPenilaian;
    
        $model->semester    = $sem;
        $datamk = $model->getallmatkul();
        return Datatables::of($datamk)->make(true);
    }

     public function editnilai($idkhs){
        $model = new ModelPenilaian;
        $model->idkhs  = $idkhs;
        $datanilai = $model->editnilai();
       return view("penilaian.edit_penilaian", ['datanilai'=>$datanilai]);
    }

 public function datakhs($kelas, $sem, $matkul){
        $model = new ModelPenilaian;
        $model->idkelas  = $kelas;
        $model->semester = $sem;
        $model->kodemk   = $matkul;
        $datanilai = $model->showpenilaian();
        return Datatables::of($datanilai)->make(true);
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
