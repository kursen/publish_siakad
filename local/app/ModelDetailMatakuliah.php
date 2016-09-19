<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelDetailMatakuliah extends Model
{
    //
    protected $table='detailmatakuliah';

    public function relasi_dosen()
    {
    	return $this->hasOne('App\ModelDosen','iddosen','iddosen');
    }

}
