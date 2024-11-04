<?php

namespace App\Http\Requests\MasterData\Diagnosa;

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
            'code' => ['required', Rule::unique("icd10", "code")->ignore($this->code, "code")],
            'diagnosa' => ['required', Rule::unique("icd10", "diagnosa")->ignore($this->code, "code")],
            'deskripsi' => 'required',
        ];
    }
}
