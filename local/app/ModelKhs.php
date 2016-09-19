<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class ModelKhs extends Model
{
    protected $table = "khs";

    protected $filltable=[
        
        'nim',
        'semester'
    ];

    public function getsemester(){

        $data = $this->where('nim', '=', $this->nim)
                     ->select([ 
                                 DB::raw('toroman(semester) as semester')
                              ])->distinct()->get();
        return $data;
    }

    public function showmahasiswa(){
    
        $data = DB::table('mahasiswa')
                         ->join('detailmahasiswa', 'mahasiswa.nim', '=', 'detailmahasiswa.nim')
                         ->join('angkatan', 'detailmahasiswa.idangkatan', '=', 'angkatan.idangkatan')
                         ->where('mahasiswa.nim', '=', $this->nim)
                         ->select([
                                    'mahasiswa.nim',
                                    'mahasiswa.nama',
                                    'mahasiswa.tempatlahir',
                                    DB::raw("ftanggal(mahasiswa.tanggallahir) as tanggallahir"),
                                    DB::raw("toroman(angkatan.angkatan) as angkatan"),
                                    'angkatan.tahun',
                                    DB::raw("ftanggal(CURDATE()) as tanggal")
                                ])->get();
        
        return $data;
    }

    public function showkhs(){

    	$data = $this->join("matakuliah", "khs.kodemk", "=", "matakuliah.kodemk")
    				 ->whereRaw("khs.nim = '".$this->nim."' and khs.semester = fromRoman('".$this->semester."')")
    				 ->select([
    				 			"matakuliah.kodemk",
    				 			"matakuliah.matakuliah",
    				 			"matakuliah.bobot",
    				 			DB::raw('fnilaimutu(fnilaihuruf(fhitungakhir(khs.absensi, khs.seminar, khs.tugas, khs.midsm, khs.nsem))) as nilaimutu'),
                                DB::raw('fnilaihuruf(fhitungakhir(khs.absensi, khs.seminar, khs.tugas, khs.midsm, khs.nsem)) as lambang'),
                               DB::raw('fnilaimutu(fnilaihuruf(fhitungakhir(khs.absensi, khs.seminar, khs.tugas, khs.midsm, khs.nsem))) * matakuliah.bobot as bobotnilai'),
    				 		  ])->get();
    	return $data;
    }

}
