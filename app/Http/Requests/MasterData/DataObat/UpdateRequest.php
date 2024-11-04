<?php

namespace App\Http\Requests\MasterData\DataObat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use App\Helpers\CheckerHelpers;
use App\Rules\JpLinkFaskes;

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
            'kode' => [
                'required',
                Rule::unique('data_obat')->where(function ($query) {
                    return $query->where('uuid_faskes', $this->getDataObat());
                })->ignore($this->uuidDataObat, "uuid_data_obat")
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

    private function getDataObat()
    {
        try {
            $checkerhelper = new CheckerHelpers;
            $getUuidFaskes = $checkerhelper->dataObatChecker(['uuid_data_obat' => $this->uuidDataObat]);
            if (is_null($getUuidFaskes)) :
                throw new \Exception($this->outputMessage('not found', 'data obat'));
            endif;
            $response = $getUuidFaskes->uuid_faskes;
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }
}
