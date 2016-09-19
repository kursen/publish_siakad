<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
class PeriodeModel extends Model
{
    //
	protected $table ='periode';
	protected $primaryKey ='idperiode';
	
	protected $filltable=[
		'idperiode',
    	'tglawal',
    	'tglakhir',
    	'sistem'
    ];
	

	public static function validate($input){
		$rules = array(
			'idperiode' => 'Required|Max:6',
			'sistem' => 'Required|Max:100',
			'tglawal' => 'Required|Max:20',
			'tglakhir' => 'Required|Max:20' ,
			
		);
		
		return Validator::make($input, $rules);
	}
	
	public $timestamps = false;
}
