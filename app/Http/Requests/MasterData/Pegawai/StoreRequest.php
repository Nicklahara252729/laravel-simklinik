<?php

namespace App\Http\Requests\MasterData\Pegawai;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Spesialis;
use App\Rules\Kamar;
use App\Rules\PoliklinikLinkKlinik;

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

            /**
             * user
             */
            'name'              => 'required',
            'email'             => [
                'required',
                'email',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('uuid_faskes', $this->getUuidFaskes());
                })
            ],
            'username'          => [
                'required',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('uuid_faskes', $this->getUuidFaskes());
                })
            ],
            'level'             => 'required|in:superadmin,admin_dinas,admin_faskes,operator,dokter,staff,pasien,resepsionis,apoteker,kasir,perawat',
            'phone'             => [
                'required',
                'max_digits:13',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('uuid_faskes', $this->getUuidFaskes());
                })
            ],
            'photo'             => 'nullable|image|max:2048|mimes:png,jpg,jpeg,svg',

            /**
             * pegawai
             */
            'no_ktp'            => 'required|max_digits:16|unique:pegawai,no_ktp',
            'no_npwp'           => 'required|max_digits:16|unique:pegawai,no_npwp',
            'no_str'            => 'required|max_digits:16|unique:pegawai,no_str',
            'tgl_berlaku_str'   => 'required|date',
            'tgl_berakhir_str'  => 'required|date',
            'no_sip'            => 'nullable|unique:pegawai,no_sip',
            'tgl_berlaku_sip'   => 'nullable|date',
            'tgl_berakhir_sip'  => 'nullable|date',
            'alamat'            => 'required',
            'uuid_spesialis'    => [new Spesialis($this->level, $this->uuid_spesialis)],

            /**
             * khusus perawat
             */
            'uuid_role'         => 'nullable|exists:role,uuid_role',
            'uuid_kamar.*'      => [new Kamar($this->getUuidFaskes(), $this->uuid_role)],
            'uuid_poliklinik_link_klinik.*'   => [new PoliklinikLinkKlinik($this->getUuidFaskes(), $this->uuid_role)]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'uuid_faskes' => $this->getUuidFaskes()
        ]);
    }

    private function getUuidFaskes()
    {
        return authAttribute()['role'] == 'superadmin' ? $this->uuid_faskes : authAttribute()['id_faskes'];
    }
}
