<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class ModelPenilaian extends Model
{
	//public $idkelas;
    protected $table = 'khs';
    protected $filltable = [
        'idkhs',
    	'nim',
    	'iddosen',
    	'semester',
        'kodemk',
        'idkelas'
    ];
    public function showdatamhs(){
    	$data = DB::table("mahasiswa")
    				->join("kelas_mahasiswa", "mahasiswa.nim", "=", "kelas_mahasiswa.nim")
                    ->join("kelasdosen", "kelas_mahasiswa.idkelas", "=", "kelasdosen.idkelas")
                    ->join("detailmatakuliah", "kelasdosen.iddosen", "=", "detailmatakuliah.iddosen")
    				->whereNotExists(function($query)
                     {
                        $query->select(DB::raw(1))
                        ->from("khs")
                        ->whereRaw("kelas_mahasiswa.idkelas = khs.idkelas and mahasiswa.nim = khs.nim and detailmatakuliah.kodemk = khs.kodemk and khs.semester = ".$this->semester);
                     })
    				->whereRaw("kelasdosen.iddosen = ".$this->iddosen." and kelas_mahasiswa.idkelas = ".$this->idkelas." and detailmatakuliah.kodemk = '".$this->kodemk."'")
                    ->select([
                                'mahasiswa.nim',
                                'mahasiswa.nama'
                            ]);
        return $data;
    }
	public function getksm($kat){
		
		if($kat==1){
			$data = DB::table('kelasdosen')
							 ->join("kelas", "kelasdosen.idkelas", "=", "kelas.idkelas")
                             ->join("detailmatakuliah", "kelasdosen.iddosen", "=", "detailmatakuliah.iddosen")
                             ->join("matakuliah", "detailmatakuliah.kodemk", "=", "matakuliah.kodemk")
							 ->whereNotExists(function($query)
		                     {
		                        $query->select(DB::raw(1))
		                        ->from('khs')
		                        ->whereRaw('kelasdosen.iddosen = khs.iddosen and kelas.idkelas = khs.idkelas and matakuliah.kodemk = khs.kodemk');
		                     })
		                     ->whereRaw('kelasdosen.iddosen = '.$this->iddosen)
		                     ->select([
		                     			'kelas.idkelas', 
		                     			'kelas.namakelas',
                                        'matakuliah.kodemk',
                                        'matakuliah.matakuliah',
                                        'matakuliah.semester',
                                        DB::raw('toRoman(matakuliah.semester) as romsem')
		                     		  ])->get();
		}
        else{
            $data = DB::table('kelasdosen')
                             ->join("kelas", "kelasdosen.idkelas", "=", "kelas.idkelas")
                             ->join("detailmatakuliah", "kelasdosen.iddosen", "=", "detailmatakuliah.iddosen")
                             ->join("matakuliah", "detailmatakuliah.kodemk", "=", "matakuliah.kodemk")
                             ->whereExists(function($query)
                             {
                                $query->select(DB::raw(1))
                                ->from('khs')
                                ->whereRaw('kelasdosen.iddosen = khs.iddosen and kelas.idkelas = khs.idkelas and matakuliah.kodemk = khs.kodemk');
                             })
                             ->whereRaw('kelasdosen.iddosen = '.$this->iddosen)
                             ->select([
                                        'kelas.idkelas', 
                                        'kelas.namakelas',
                                        'matakuliah.kodemk',
                                        'matakuliah.matakuliah',
                                        'matakuliah.semester',
                                        DB::raw('toRoman(matakuliah.semester) as romsem')
                                      ])->get();
        }
		return $data;
	}
    public function getkelas(){
        $data = DB::select(DB::raw("
                        select
                        kl.idkelas,
                        kl.namakelas
                        from kelasdosen kd
                        inner join kelas kl on kd.idkelas = kl.idkelas
                        where kd.iddosen = ".$this->iddosen));
        
        return $data;
    }
    public function getallkelas(){
        $data = DB::table('kelas')
                        ->select([
                                    'idkelas',
                                    'namakelas'
                                ])->get();
        
        return $data;
    }
    public function getallmatkul(){
        $data = DB::table("matakuliah")
                        ->whereRaw("matakuliah.semester = ".$this->semester)
                        ->select([
                                    'kodemk',
                                    'matakuliah'
                                ]);
        
        return $data;
    }
    public function getsem(){
        $data = DB::table("kelasdosen")
                        ->join("matakuliah", "kelasdosen.kodemk", "=", "matakuliah.kodemk")
                        ->orderBy("matakuliah.semester", "asc")
                        ->whereRaw("kelasdosen.iddosen = ".$this->iddosen." and kelasdosen.idkelas = ".$this->idkelas)
                        ->select([
                                    'matakuliah.semester',
                                    DB::raw('toroman(matakuliah.semester) as romsem')
                            ])->distinct();
       
        return $data;
    }
    public function getmatakuliah(){
        $data = DB::table("kelasdosen")
                        ->join("matakuliah", "kelasdosen.kodemk", "=", "matakuliah.kodemk")
                        ->orderBy("matakuliah.semester", "asc")
                        ->whereRaw("kelasdosen.iddosen = ".$this->iddosen." and kelasdosen.idkelas = ".$this->idkelas." and matakuliah.semester = ".$this->semester)
                        ->select([
                                    'matakuliah.kodemk',
                                    'matakuliah.matakuliah'
                            ])->distinct();
       
        return $data;
    }
    public function showpenilaian(){
        $data = $this->join("mahasiswa", "khs.nim", "=", "mahasiswa.nim")
                     ->join("kelas", "khs.idkelas", "=", "kelas.idkelas")
                     ->join("matakuliah", "khs.kodemk", "=", "matakuliah.kodemk")
                     ->whereRaw("khs.idkelas = ".$this->idkelas." and khs.semester = ".$this->semester." and khs.kodemk = '".$this->kodemk."'")
                     ->select([ 
                                'khs.idkhs',
                                'mahasiswa.nim',
                                'mahasiswa.nama',
                                'khs.absensi',
                                'khs.seminar',
                                'khs.tugas',
                                'khs.midsm',
                                'khs.nsem',
                                DB::raw('fhitungakhir(khs.absensi, khs.seminar, khs.tugas, khs.midsm, khs.nsem) as akhir'),
                                DB::raw('fnilaihuruf(fhitungakhir(khs.absensi, khs.seminar, khs.tugas, khs.midsm, khs.nsem)) as nilaihuruf'),
                                'khs.keterangan'
                              ])
                     ->orderBy('mahasiswa.nim', 'asc')
                     ->get();
        return $data;
    }
    public function editnilai(){
        $data = $this->join("mahasiswa", "khs.nim", "=", "mahasiswa.nim")
                     ->join("kelas", "khs.idkelas", "=", "kelas.idkelas")
                     ->join("matakuliah", "khs.kodemk", "=", "matakuliah.kodemk")
                     ->whereRaw("khs.idkhs = ".$this->idkhs)
                     ->select([ 
                                'khs.idkhs',
                                'mahasiswa.nim',
                                'mahasiswa.nama',
                                'khs.absensi',
                                'khs.seminar',
                                'khs.tugas',
                                'khs.midsm',
                                'khs.nsem',
                                'khs.keterangan'
                              ])->get();
        return $data;
    }
    public $primaryKey  = 'idkhs';
    public $timestamps = false;
}
