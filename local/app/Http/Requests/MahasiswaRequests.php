<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MahasiswaRequests extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nim'           => 'required|numeric',
            'nama'          => 'required',
            'tempatlahir'   => 'required',
            'tanggallahir'  => 'required|date',
            'asalsekolah'   => 'required',
            'namaortu'      => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nim.required'           => 'Nim tidak boleh kosong',
            'nim.numeric'            => 'Nim harus angka',
            //'nim.max'                => 'Nim maksimal 10 angka',
            'nama.required'          => 'Nama tidak boleh kosong',
            'tempatlahir.required'   => 'Tempat Lahir tidak boleh kosong',
            'tanggallahir.required'  => 'Tanggal Lahir tidak boleh kosong',
            'tanggallahir.date'      => 'Tanggal tidak sesuai',
            'asalsekolah.required'   => 'Asal Sekolah tidak boleh kosong',
            'namaortu.required'      => 'Nama Orang Tua tidak boleh kosong'
        ];
    }
}
