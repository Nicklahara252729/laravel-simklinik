<?php

namespace App\Http\Requests\MasterData\Kamar;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBedRequest extends FormRequest
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
            'uuid_kamar' => [
                'required',
                Rule::exists('kamar')->where(function ($query) {
                    return $query->where([
                        'uuid_kamar' => $this->uuid_kamar,
                        'uuid_faskes' => $this->getUuidFaskes()
                    ]);
                }),
            ],
        ];
    }

    private function getUuidFaskes()
    {
        return authAttribute()['role'] == 'superadmin' ? $this->uuid_faskes : authAttribute()['id_faskes'];
    }
}
