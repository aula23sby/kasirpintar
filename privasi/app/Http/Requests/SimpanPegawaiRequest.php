<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimpanPegawaiRequest extends FormRequest
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
            'nama_pegawai' => 'required|max:150',
            'umur_pegawai' => 'required|numeric|max:150',
            'jabatan_pegawai' => 'required|max:200',
            'alamat_pegawai' => 'required|max:200',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Inputan :attribute wajib diisi',
            'umur_pegawai.numeric' => 'Inputan :attribute harus angka',
            'max' => 'Inputan :attribute harus diisi maksimal :max',
        ];
    }
}
