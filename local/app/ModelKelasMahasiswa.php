<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelKelasMahasiswa extends Model
{
    //
     protected $table ='kelas_mahasiswa';
	public $timestamps = false;

	public static function validate($input){
		$rules = array(
			'nim' => 'Required',
			'idkelas' => 'Required'
		);
		return Validator::make($input, $rules);
	}

	public function relasi_kelas()
	{
		return $this->hasOne('App\ModelKelas','idkelas','idkelas');
	}
	public function relasi_mahasiswa()
	{
		return $this->hasOne('App\ModelMahasiswa','nim','nim');
	}
}
