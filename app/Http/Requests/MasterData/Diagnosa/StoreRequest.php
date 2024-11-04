<?php

namespace App\Http\Requests\MasterData\Diagnosa;

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
            'code' => 'required|unique:icd10,code',
            'diagnosa' => 'required|unique:icd10,diagnosa',
            'deskripsi' => 'required',
        ];
    }
}