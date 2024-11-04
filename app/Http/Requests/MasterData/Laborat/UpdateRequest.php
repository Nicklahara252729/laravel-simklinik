<?php

namespace App\Http\Requests\MasterData\Laborat;

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
                Rule::unique('laborat')->where(function ($query) {
                    $query->where('uuid_faskes', $this->uuid_faskes);
                    return $query->whereNot(function (Builder $query) {
                        $query->where('uuid_laborat', $this->getLaborat());
                    });
                })
            ],
            'nama' => [
                'required',
                Rule::unique('laborat')->where(function ($query) {
                    $query->where('uuid_faskes', $this->uuid_faskes);
                    return $query->whereNot(function (Builder $query) {
                        $query->where('uuid_laborat', $this->getLaborat());
                    });
                })
            ],
            'uuid_laborat_kategori' => [
                'required',
                Rule::exists('laborat_kategori')->where(function ($query) {
                    return $query->where([
                        'uuid_laborat_kategori' => $this->uuid_laborat_kategori,
                        'uuid_faskes' => $this->getLaborat()
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
    
    private function getLaborat()
    {
        try {
            $checkerhelper = new CheckerHelpers;
            $getUuidFaskes = $checkerhelper->laboratChecker(['uuid_laborat' => $this->uuidLaborat]);
            if (is_null($getUuidFaskes)) :
                throw new \Exception($this->outputMessage('not found', 'laborat'));
            endif;
            $response = $getUuidFaskes->uuid_faskes;
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }
}
