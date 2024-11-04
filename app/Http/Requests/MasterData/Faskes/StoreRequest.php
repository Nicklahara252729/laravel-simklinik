<?php

namespace App\Http\Requests\MasterData\Faskes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'uuid_user'         => 'required|exists:users,uuid_user',
            'nama'              => 'required',
            'kode'              => 'required|unique:faskes,kode|integer|max_digits:6',
            'no_faskes'         => 'required|unique:faskes,no_faskes',
            'id_provinsi'       => 'required|exists:reg_provinces,id',
            'id_kabupaten'      => 'required|exists:reg_regencies,id',
            'id_kecamatan'      => 'required|exists:reg_districts,id',
            'id_desa'           => 'required|exists:reg_villages,id',
            'alamat'            => 'required',
            'kode_pos'          => 'required',
            'counter_pasien'    => 'required',
            'counter_kk'        => 'required',
            'latitude'          => 'required',
            'longitude'         => 'required',
            'uuid_poliklinik.*' => 'required|exists:poliklinik,uuid_poliklinik',
            'uuid_jenis_pembayaran.*' => 'required|exists:jenis_pembayaran,uuid_jenis_pembayaran',
            'logo'              => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ];
    }

}
