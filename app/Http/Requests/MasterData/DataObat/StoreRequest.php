<?php

namespace App\Http\Requests\MasterData\DataObat;

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
                Rule::unique('data_obat')->where(function ($query) {
                    return $query->where('uuid_faskes', $this->getUuidFaskes());
                })
            ],
            'nama'              => 'required',
            'uuid_satuan_obat'  => 'required|exists:satuan_obat,uuid_satuan_obat',
            'uuid_klasifikasi_obat' => 'required|exists:klasifikasi_obat,uuid_klasifikasi_obat',
            'jenis'             => 'required|in:bhp,obat injeksi,reagent,vaksin,imunisasi',
            'harga_satuan'      => 'required|integer',
            'tgl_expired'       => 'required|date',
            'no_batch'          => 'required',
            'harga_beli'        => 'required',
            'no_batch'          => 'required',
            'uuid_jenis_pembayaran' => [
                'nullable',
                'array',
                new JpLinkFaskes('jenis_pembayaran_link_faskes', 'uuid_jp_link_faskes', $this->uuid_faskes)
            ],
            'harga_jual.*'      => 'nullable|integer'
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
