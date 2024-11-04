<?php

namespace App\Http\Requests\MasterData\Kamar;

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
            'harga'       => 'required|integer',
            'nama_kamar' => [
                'required',
                Rule::unique('kamar')->where(function ($query) {
                    return $query->where('uuid_faskes', $this->uuid_faskes);
                })
            ],
        ];
    }
}