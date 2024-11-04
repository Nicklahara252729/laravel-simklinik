<?php

namespace App\Http\Requests\MasterData\Role;

use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;

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
            'menu'          => ['required', Rule::unique("role", "menu")->ignore('divider', 'menu')],
            'link'          => ['required'],
            'icon'          => 'nullable',
            'parent'        => 'nullable|exists:role,uuid_role',
            'admin_dinas'   => 'required|in:0,1',
            'admin_faskes'  => 'required|in:0,1',
            'operator'      => 'required|in:0,1',
            'dokter'        => 'required|in:0,1',
            'staff'         => 'required|in:0,1',
            'pasien'        => 'required|in:0,1',
            'resepsionis'   => 'required|in:0,1',
            'apoteker'      => 'required|in:0,1',
            'kasir'         => 'required|in:0,1',
            'perawat'       => 'required|in:0,1',
            // 'poli'          => 'required|in:0,1',
        ];
    }
}
