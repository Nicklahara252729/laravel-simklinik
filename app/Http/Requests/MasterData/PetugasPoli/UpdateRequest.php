<?php

namespace App\Http\Requests\MasterData\PetugasPoli;

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
            'uuid_user' => [
                'required',
                Rule::exists('users')->where(function ($query) {
                    return $query->where('uuid_user', $this->uuid_user);
                }),
                Rule::unique('petugas_poli')->where(function ($query) {
                    return $query->where([
                        'uuid_faskes' => $this->uuid_faskes,
                        'uuid_poliklinik' => $this->uuid_poliklinik
                    ]);
                })->ignore($this->uuidPetugasPoli, "uuid_petugas_poli")
            ],
            'uuid_poliklinik' => [
                'required',
                Rule::exists('poliklinik')->where(function ($query) {
                    return $query->where('uuid_poliklinik', $this->uuid_poliklinik);
                }),
                Rule::unique('petugas_poli')->where(function ($query) {
                    return $query->where([
                        'uuid_faskes' => $this->uuid_faskes,
                        'uuid_user' => $this->uuid_user
                    ]);
                })->ignore($this->uuidPetugasPoli, "uuid_petugas_poli")
            ],
        ];
    }
}
