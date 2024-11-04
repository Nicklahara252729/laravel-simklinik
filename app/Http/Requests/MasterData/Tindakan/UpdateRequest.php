<?php

namespace App\Http\Requests\MasterData\Tindakan;

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
                Rule::unique('tindakan')->where(function ($query) {
                    $query->where('uuid_faskes', $this->uuid_faskes);
                    return $query->whereNot(function (Builder $query) {
                        $query->where('uuid_tindakan', $this->getTindakan());
                    });
                })
            ],
            'nama' => [
                'required',
                Rule::unique('tindakan')->where(function ($query) {
                    $query->where('uuid_faskes', $this->uuid_faskes);
                    return $query->whereNot(function (Builder $query) {
                        $query->where('uuid_tindakan', $this->getTindakan());
                    });
                })
            ],
            'uuid_tindakan_kategori' => [
                'required',
                Rule::exists('tindakan_kategori')->where(function (Builder $query) {
                    return $query->where([
                        'uuid_tindakan_kategori' => $this->uuid_tindakan_kategori,
                        'uuid_faskes' => $this->getTindakan()
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

    private function getTindakan()
    {
        try {
            $checkerhelper = new CheckerHelpers;
            $getUuidFaskes = $checkerhelper->tindakanChecker(['uuid_tindakan' => $this->uuidTindakan]);
            if (is_null($getUuidFaskes)) :
                throw new \Exception($this->outputMessage('not found', 'tindakan'));
            endif;
            $response = $getUuidFaskes->uuid_faskes;
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }
}
