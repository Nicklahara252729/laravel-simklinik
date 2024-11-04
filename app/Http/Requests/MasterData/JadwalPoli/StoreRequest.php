<?php

namespace App\Http\Requests\MasterData\JadwalPoli;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;

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
            'uuid_poliklinik' => [
                'required',
                Rule::exists('poliklinik')->where(function ($query) {
                    return $query->where('uuid_poliklinik', $this->uuid_poliklinik);
                }),
                Rule::unique('jadwal_poli')->where(function ($query) {
                    return $query->where([
                        'uuid_faskes' => $this->getUuidFaskes(),
                        'dokter' => $this->dokter,
                        'hari' => $this->hari
                    ]);
                })
            ],
            'dokter' => [
                'required',
                'exists:users,uuid_user',
                Rule::unique('jadwal_poli')->where(function ($query) {
                    return $query->where([
                        'uuid_faskes' => $this->getUuidFaskes(),
                        'uuid_poliklinik' => $this->uuid_poliklinik,
                        'dokter' => $this->dokter,
                        'hari' => $this->hari
                    ]);
                })
            ],
            'perawat' => [
                'required',
                'exists:users,uuid_user',
                Rule::exists('jadwal_poli')->where(function ($query) {
                    return $query->where([
                        'uuid_faskes' => $this->getUuidFaskes()
                    ]);
                })
            ],
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'jam' => 'required',
            'keterangan' => 'nullable',
            'kode_antrian' => 'nullable',
        ];
    }

    private function getUuidFaskes()
    {
        return authAttribute()['role'] == 'superadmin' ? $this->uuid_faskes : authAttribute()['id_faskes'];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'uuid_faskes' => $this->getUuidFaskes()
        ]);
    }
}
