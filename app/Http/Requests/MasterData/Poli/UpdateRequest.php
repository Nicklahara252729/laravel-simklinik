<?php

namespace App\Http\Requests\MasterData\Poli;

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
            'poliklinik' => ['required', Rule::unique("poliklinik", "poliklinik")->ignore($this->uuidPoliklinik, "uuid_poliklinik")],
        ];
    }
}
