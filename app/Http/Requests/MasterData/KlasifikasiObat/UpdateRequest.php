<?php

namespace App\Http\Requests\MasterData\KlasifikasiObat;

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
            'klasifikasi' => ['required', Rule::unique("klasifikasi_obat", "klasifikasi")->ignore($this->uuidKlasifikasiObat, "uuid_klasifikasi_obat")],
        ];
    }
}
