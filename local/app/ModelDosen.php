<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelDosen extends Model
{
    //
    protected $table ='dosen';

     protected $filltable=[
        'iddosen',
    	'nidn',
    	'nama',
    	'tgllahir',
    	'jabatanakademik',
        'sertifikat',
    	'pendidikan',
    	'asalpt',
        'bidang'
    ];

    public function showdosen(){
    	$data = $this->select(['*']);
    	return $data;
    }

    public function showdata(){
       $data = $this->where(['iddosen'=>$this->iddosen])->get();
        return $data;
    }

    public $primaryKey  = 'iddosen';
}
