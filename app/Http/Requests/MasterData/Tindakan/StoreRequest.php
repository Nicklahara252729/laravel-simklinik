<?php

namespace App\Http\Requests\MasterData\Tindakan;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
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
                Rule::unique('tindakan')->where(function ($query) {
                    return $query->where('uuid_faskes', $this->getUuidFaskes());
                })
            ],
            'nama' => [
                'required',
                Rule::unique('tindakan')->where(function ($query) {
                    return $query->where('uuid_faskes', $this->getUuidFaskes());
                })
            ],
            'uuid_tindakan_kategori' => [
                'required',
                Rule::exists('tindakan_kategori')->where(function (Builder $query) {
                    return $query->where([
                        'uuid_tindakan_kategori' => $this->uuid_tindakan_kategori,
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
            'uuid_poliklinik_link_klinik' => 'required|exists:poliklinik_link_klinik,uuid_poliklinik_link_klinik',
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
