<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class ModelMahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $filltable=[
    	'nim',
    	'nama',
    	'tempatlahir',
    	'tanggallahir',
        'agama',
    	'asalsekolah',
    	'namaortu',
        'status'
    ];

    public function show(){
    	$data = $this->select([
                                'nim', 
                                'nama',
                                'tempatlahir',
                                'tanggallahir',
                                'agama',
                               DB::raw("case when mahasiswa.status=1 then 'Berhak'
                                             else 'Tidak Berhak'
                                        end as status")
                            ]);
    	return $data;
    }

    public function edit(){
        $data = $this->where(['nim'=>$this->nim])->get();
        return $data;
    }

    public function detail(){
         $data = $this->join('detailmahasiswa', 'mahasiswa.nim', '=', 'detailmahasiswa.nim')
                      ->join('angkatan', 'detailmahasiswa.idangkatan', '=', 'angkatan.idangkatan')
                      ->where('mahasiswa.nim', '=', $this->nim)
                      ->select([
                                    'mahasiswa.nim',
                                    'mahasiswa.nama',
                                    'mahasiswa.tempatlahir',
                                    'mahasiswa.tanggallahir',
                                    'mahasiswa.agama',
                                    'mahasiswa.asalsekolah',
                                    'mahasiswa.namaortu',
                                    DB::raw("case when mahasiswa.status=1 then 'Berhak'
                                                  else 'Tidak Berhak'
                                            end as status"),
                                    'angkatan.angkatan',
                                    'angkatan.tahun'
                                ])->get();
        
        return $data;
    }

    public $primaryKey  = 'nim';
}
