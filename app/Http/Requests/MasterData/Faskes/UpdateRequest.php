<?php

namespace App\Http\Requests\MasterData\Faskes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

class UpdateRequest extends FormRequest
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
            'uuid_user'     => 'required|exists:users,uuid_user',
            'nama'          => ['required'],
            'kode'          => ['integer','max_digits:6','required', Rule::unique("faskes", "kode")->ignore($this->uuidFaskes, "uuid_faskes")],
            'no_faskes'     => ['required', Rule::unique("faskes", "no_faskes")->ignore($this->uuidFaskes, "uuid_faskes")],
            'id_provinsi'   => ['required', Rule::exists("reg_provinces", "id")],
            'id_kabupaten'  => ['required', Rule::exists("reg_regencies", "id")],
            'id_kecamatan'  => ['required', Rule::exists("reg_districts", "id")],
            'id_desa'       => ['required', Rule::exists("reg_villages", "id")],
            'alamat'        => 'required',
            'kode_pos'      => 'required',
            'counter_pasien' => 'required',
            'counter_kk'    => 'required',
            'latitude'      => 'required',
            'longitude'     => 'required',
            'uuid_poliklinik.*' => 'required|exists:poliklinik,uuid_poliklinik',
            'uuid_jenis_pembayaran.*' => 'required|exists:jenis_pembayaran,uuid_jenis_pembayaran',
            'logo'          => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ];
    }
}
