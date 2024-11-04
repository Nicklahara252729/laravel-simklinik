<?php

namespace App\Http\Requests\MasterData\PetugasPoli;

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
            'uuid_user' => [
                'required',
                Rule::exists('users')->where(function ($query) {
                    return $query->where('uuid_user', $this->uuid_user);
                }),
                Rule::unique('petugas_poli')->where(function ($query) {
                    return $query->where([
                        'uuid_faskes' => $this->getUuidFaskes(),
                        'uuid_poliklinik' => $this->uuid_poliklinik
                    ]);
                })
            ],
            'uuid_poliklinik' => [
                'required',
                Rule::exists('poliklinik')->where(function ($query) {
                    return $query->where('uuid_poliklinik', $this->uuid_poliklinik);
                }),
                Rule::unique('petugas_poli')->where(function ($query) {
                    return $query->where([
                        'uuid_faskes' => $this->getUuidFaskes(),
                        'uuid_user' => $this->uuid_user
                    ]);
                })
            ],
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
