<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
class MataKuliahModel extends Model
{

    //
	protected $table ='matakuliah';
	protected $primaryKey ='kodemk';
	public $incrementing = false;
	public $timestamps = false;
	
	protected $filltable=[
			'kodemk' ,
			'matakuliah',
			'bobot' ,
			'teori' ,
			'praktek',
			'klinik',
			'kadep' ,
			'bobotnilai',
			'semester'
    ];

   
	public static function validate($input){
		$rules = array(
			'kodemk' => 'Required',
			'matakuliah' => 'Required|Max:100',
			'bobot' => 'Required|Max:4',
			'teori' => 'Required|Max:4' ,
			'praktek' => 'Required|Max:4' ,
			'kadep' => 'Required|Max:100',
			'bobotnilai' => 'Required|Max:4',
			'semester' => 'Required'
		);
		return Validator::make($input, $rules);
	}

	public function relasi_detailmatakuliah()
	{
		 return $this->hasMany('App\ModelDetailMatakuliah', 'kodemk', 'kodemk');
	}


}
