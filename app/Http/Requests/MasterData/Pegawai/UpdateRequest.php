<?php

namespace App\Http\Requests\MasterData\Pegawai;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Spesialis;
use App\Rules\Kamar;
use App\Rules\PoliklinikLinkKlinik;

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

            /**
             * user
             */
            'name'              => 'required',
            'email'             => [
                'required',
                'email',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('uuid_faskes', $this->getUuidFaskes());
                })->ignore($this->uuidUser, "uuid_user")
            ],
            'username'          => [
                'required',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('uuid_faskes', $this->getUuidFaskes());
                })->ignore($this->uuidUser, "uuid_user")
            ],
            'level'             => 'required|in:superadmin,admin_dinas,admin_faskes,operator,dokter,staff,pasien,resepsionis,apoteker,kasir,perawat',
            'phone'             => [
                'required',
                'max_digits:13',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('uuid_faskes', $this->getUuidFaskes());
                })->ignore($this->uuidUser, "uuid_user")
            ],
            'photo'             => 'nullable|image|max:2048|mimes:png,jpg,jpeg,svg',

            /**
             * pegawai
             */
            'no_ktp'            => ['required','max_digits:16', Rule::unique("pegawai", "no_ktp")->ignore($this->uuidUser, "uuid_user")],
            'no_npwp'           => ['required','max_digits:16', Rule::unique("pegawai", "no_npwp")->ignore($this->uuidUser, "uuid_user")],
            'no_str'            => ['required','max_digits:16', Rule::unique("pegawai", "no_str")->ignore($this->uuidUser, "uuid_user")],
            'tgl_berlaku_str'   => 'required|date',
            'tgl_berakhir_str'  => 'required|date',
            'no_sip'            => ['nullable', Rule::unique("pegawai", "no_sip")->ignore($this->uuidUser, "uuid_user")],
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
