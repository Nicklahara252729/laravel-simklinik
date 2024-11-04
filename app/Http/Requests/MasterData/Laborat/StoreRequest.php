<?php

namespace App\Http\Requests\MasterData\Laborat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\JpLinkFaskes;

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
            'kode' => [
                'required',
                Rule::unique('laborat')->where(function ($query) {
                    return $query->where('uuid_faskes', $this->getUuidFaskes());
                })
            ],
            'nama' => [
                'required',
                Rule::unique('laborat')->where(function ($query) {
                    return $query->where('uuid_faskes', $this->getUuidFaskes());
                })
            ],
            'uuid_laborat_kategori' => [
                'required',
                Rule::exists('laborat_kategori')->where(function ($query) {
                    return $query->where([
                        'uuid_laborat_kategori' => $this->uuid_laborat_kategori,
                        'uuid_faskes' => $this->getUuidFaskes()
                    ]);
                }),
            ],
            'harga' => 'required|integer',
            'uuid_jenis_pembayaran' => [
                'nullable',
                'array',
                new JpLinkFaskes('jenis_pembayaran_link_faskes', 'uuid_jp_link_faskes', $this->uuid_faskes)
            ],
            'harga_jual.*' => 'nullable|integer',
        ];
    }

    private function getUuidFaskes()
    {
        return authAttribute()['role'] == 'superadmin' ? $this->uuid_faskes : authAttribute()['id_faskes'];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'uuid_faskes' => $this->getUuidFaskes()
        ]);
    }
}
