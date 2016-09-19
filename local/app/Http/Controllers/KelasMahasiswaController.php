<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ModelKelas;
use App\ModelKelasMahasiswa;
use App\ModelMahasiswa;
use Datatables;

class KelasMahasiswaController extends Controller
{
    //
    public function index()
    {
        return view('kelas_mahasiswa.show_kelas_mahasiswa');
    }

    public function add()
    {
    	$arrsemester =array(
					'1'=>'Semester 1',
					'2'=>'Semester 2',
					'3'=>'Semester 3',
					'4'=>'Semester 4',
					'5'=>'Semester 5',
					'6'=>'Semester 6',
					'7'=>'Semester 7',
					'8'=>'Semester 8');
    	$datakelas = ModelKelas::pluck('namakelas','idkelas');
    	return view('kelas_mahasiswa.add_kelas_mahasiswa',compact('datakelas','arrsemester'));
    }

    public function store(Request $request)
    {
        $stat=0;
        $model = array();
        $arrnim = $request->nim;
        foreach ($arrnim as $key => $value) {
            # code...
            $data = array(
                'idkelas'=>$request->kode_kelas,
                'nim'=>$value,
                'tahun_ajaran'=>$request->tahun_ajaran,
                'semester'=>$request->semester
            );
            array_push($model, $data);
        }
        
        $execute = ModelKelasMahasiswa::insert($model);
        if($execute)
        {
            $stat=1;
        }
        return response()->json(['return' => $stat]);
    }

    public function checking(Request $request)
    {
        $statreturn = 0;
        $nim = $request->get('nim');
        $semester = $request->get('semester');
        $idkelas = $request->get('idkelas');
        $tahun_ajaran = $request->get('tahun_ajaran');
        $where_group =['nim'=>$nim,'semester'=>$semester,'idkelas'=>$idkelas,'tahun_ajaran'=>$tahun_ajaran];
        if (ModelKelasMahasiswa::where($where_group)->exists()) {
            $statreturn=1;
        }
        return response()->json(['return' => $statreturn]);
    }

    public function getKelasMahasiswa()
    {
        $model = ModelKelasMahasiswa::with(['relasi_kelas','relasi_mahasiswa'])->get();
        return Datatables::of($model)->make(true);
    }


    public function destroy($id)
    {
        $statreturn = 0;
        $model = new ModelKelasMahasiswa;
        $data  = $model->find($id);
        $destroy = $data->delete();
        if($destroy){
            $statreturn = 1;
        }
        return response()->json(['return' => $statreturn]);
    }

    public function edit($id)
    {
        $arrsemester =array(
                    '1'=>'Semester 1',
                    '2'=>'Semester 2',
                    '3'=>'Semester 3',
                    '4'=>'Semester 4',
                    '5'=>'Semester 5',
                    '6'=>'Semester 6',
                    '7'=>'Semester 7',
                    '8'=>'Semester 8');
        $datakelas = ModelKelas::pluck('namakelas','idkelas');

        $model_edit = ModelKelasMahasiswa::with(['relasi_kelas','relasi_mahasiswa'])->find($id);
        return view('kelas_mahasiswa.edit_kelas_mahasiswa',
            compact('datakelas','arrsemester','model_edit'));
       
    }

    public function update(Request $request)
    {
                $stat=0;

                $id=$request->id;
                $model_update=ModelKelasMahasiswa::find($id);
                    if($model_update){
                        $model_update->idkelas = $request->kode_kelas;
                        $model_update->nim = $request->nim;
                        $model_update->tahun_ajaran = $request->tahun_ajaran;
                        $model_update->semester = $request->semester;
                        
                        $model_update->save();
                        $stat=1;
                }
        
        return response()->json(['return' => $stat]);
    }

   


}
