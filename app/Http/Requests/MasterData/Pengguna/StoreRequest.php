<?php

namespace App\Http\Requests\MasterData\Pengguna;

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
            'name'      => 'required',
            'email'     => ['required',Rule::unique('users','email')],
            'username'  => ['required',Rule::unique('users','username')],
            'phone'     => ['required','max_digits:13',Rule::unique('users','phone')],
            'photo'     => 'nullable|image|max:2048|mimes:png,jpg,jpeg,svg',
        ];
    }
}
