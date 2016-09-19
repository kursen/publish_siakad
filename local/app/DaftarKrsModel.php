<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class DaftarKrsModel extends Model
{
    //public $nim;
    public $semester;
    protected $table = 'krs';
    protected $filltable=[
        
        'nim',
        'kodemk',
        'keterangan'
    ];
    public function showmk(){
        $data = DB::table('matakuliah')
                     ->whereNotExists(function($query)
                     {
                        $query->select(DB::raw(1))
                        ->from('krs')
                        ->whereRaw('matakuliah.kodemk = krs.kodemk and krs.nim = '.$this->nim);
                     })
                     ->whereRaw("matakuliah.semester = ".$this->semester)
                     ->select([
                                'matakuliah.kodemk',
                                'matakuliah.matakuliah',
                                'matakuliah.bobot',
                                DB::raw('toroman(matakuliah.semester) as sem')
                              ]);
        return $data;
    }
    public function showkrs(){
	
    	$data = $this->join('mahasiswa', 'krs.nim', '=', 'mahasiswa.nim')
    				 ->join('matakuliah', 'krs.kodemk', '=', 'matakuliah.kodemk')
    				 ->where('krs.nim', '=', $this->nim)
                     ->whereRaw("matakuliah.semester = ".$this->semester)
    				 ->select([
    				     		'matakuliah.kodemk',
    				     		'matakuliah.matakuliah',
    				     		'matakuliah.bobot',
                                 DB::raw('toroman(matakuliah.semester) as sem'),
    				     		 DB::raw('year(krs.tanggal) as tahun'),
    				     		'krs.keterangan'
    				     	  ])->get();
    	return $data;
    }
    public function showmahasiswa(){
    
        $data = DB::table('mahasiswa')
                         ->join('kelas_mahasiswa', 'mahasiswa.nim', '=', 'kelas_mahasiswa.nim')
                         ->join('kelas', 'kelas_mahasiswa.idkelas', '=', 'kelas.idkelas')
                         ->join('dosen', 'kelas.iddosen', '=', 'dosen.iddosen')
                         ->join('detailmahasiswa', 'mahasiswa.nim', '=', 'detailmahasiswa.nim')
                         ->join('angkatan', 'detailmahasiswa.idangkatan', '=', 'angkatan.idangkatan')
                         ->where('mahasiswa.nim', '=', $this->nim)
                         ->select([
                                    'mahasiswa.nim',
                                    'mahasiswa.nama',
                                    DB::raw('toroman(angkatan.angkatan) as angkatan'),
                                    'angkatan.tahun',
                                    DB::raw("ftanggal(CURDATE()) as tanggal"),
                                    'dosen.nama as dosenwali'
                                ])->get();
        
        return $data;
    }
    public function getsemester($kat){
        //1 = untuk form add krs
        //2 = untuk view krs
        if($kat==1){
            $data = DB::table('matakuliah')
                     ->orderBy('matakuliah.semester', 'asc')
                     ->whereNotExists(function($query)
                     {
                        $query->select(DB::raw(1))
                        ->from('krs')
                        ->whereRaw('matakuliah.kodemk = krs.kodemk and krs.nim = '.$this->nim);
                     })
                     ->select([ 
                                'matakuliah.semester',
                                DB::raw('toroman(matakuliah.semester) as romsem')
                              ])->distinct()->get();
        }else{
            $data = DB::table('krs')
                     ->orderBy('matakuliah.semester', 'asc')
                     ->join('matakuliah', 'krs.kodemk', '=', 'matakuliah.kodemk')
                     ->where('krs.nim', '=', $this->nim)
                     ->select([ 
                                 'matakuliah.semester',
                                 DB::raw('toroman(matakuliah.semester) as romsem')
                              ])->distinct()->get();
        }
        
        return $data;
    }
    public function showperiodekrs(){
        $data = DB::table('periode')
                                 ->where('idperiode', '=', '4')
                                 ->select([
                                            DB::raw("
                                                        date_format(tglawal, '%d-%m-%Y') as tglawal,
                                                        date_format(tglakhir, '%d-%m-%Y') as tglakhir
                                                    ")
                                        ])->get();
                
        return $data;
    }
    public function showstatusmhs(){
         $data = DB::table('mahasiswa')
                         ->where('nim', '=', $this->nim)
                         ->select([
                                    'status'
                                ])->get();
        
        return $data;
    }
    public $timestamps = false;
     
}
