<?php

namespace App\Http\Requests\MasterData\Pengguna;

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
            'name'              => ['required'],
            'email'             => ['required','email', Rule::unique("users", "email")->ignore($this->uuidUser, "uuid_user")],
            'username'          => ['required', Rule::unique("users", "username")->ignore($this->uuidUser, "uuid_user")],
            'phone'             => ['required','max_digits:13', Rule::unique("users", "phone")->ignore($this->uuidUser, "uuid_user")],
            'photo'             => 'nullable|image|max:2048|mimes:png,jpg,jpeg,svg',
        ];
    }
}
