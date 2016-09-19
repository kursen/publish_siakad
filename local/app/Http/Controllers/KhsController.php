<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ModelKhs;

use Datatables;

use PDF;

class KhsController extends Controller
{
    public function index(){
    	$model = new ModelKhs;

    	$arrsemester = array();

        $model->nim  = auth()->guard('usermahasiswas')->user()->nim;
        
        $sem = $model->getsemester();
       
        $arrsemester['0'] = "Pilih";
        foreach ($sem as $key => $csem) {
            $arrsemester[$csem->semester] = "Semester ".$csem->semester;
        }
    	
    	return view("khs.show_khs", ["arrsemester"=>$arrsemester]);
    }

    public function datakhs($sem){

    	$model = new ModelKhs;

        $cmhs = array();

        $model->nim = auth()->guard('usermahasiswas')->user()->nim;
        $model->semester = $sem;

        $datakhs = $model->showkhs();

        $datamhs = $model->showmahasiswa(); 

        foreach ($datamhs as $name => $cdatamhs) {
            $cmhs['nim'] = $cdatamhs->nim;
            $cmhs['nama'] = $cdatamhs->nama;
            $cmhs['tempatlahir'] = $cdatamhs->tempatlahir;
            $cmhs['tanggallahir'] = $cdatamhs->tanggallahir;
            $cmhs['angkatan'] = $cdatamhs->angkatan;
            $cmhs['tahun'] = $cdatamhs->tahun;
        }

        return Datatables::of($datakhs)
        ->with($cmhs)
        ->make(true);

    }

    public function printkhs($sem){
        
        $model = new ModelKhs;

        $model->nim = auth()->guard('usermahasiswas')->user()->nim;
        $model->semester = $sem;

        $datakhs = $model->showkhs();
        $datamhs = $model->showmahasiswa();

        /*foreach ($datamhs as $key => $value) {
            echo $value->tempatlahir;
        }*/
        $pdf = PDF::loadView('khs.print_khs', ['datamhs'=>$datamhs, 'datakhs'=>$datakhs, 'vts'=>$sem])
                    ->setPaper('a4')
                    ->setOrientation('potrait');

        return $pdf->stream();
    }
}
