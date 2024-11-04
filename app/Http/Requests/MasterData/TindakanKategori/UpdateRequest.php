<?php

namespace App\Http\Requests\MasterData\TindakanKategori;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Database\Query\Builder;
use App\Helpers\CheckerHelpers;

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
            'kategori' => [
                'required',
                Rule::unique('tindakan_kategori')->where(function ($query) {
                    $query->where('uuid_faskes', $this->getTindakanKategori());
                    return $query->whereNot(function (Builder $query) {
                        $query->where('uuid_tindakan_kategori', $this->uuidTindakanKategori);
                    });
                })
            ]
        ];
    }

    private function getTindakanKategori()
    {
        try {
            $checkerhelper = new CheckerHelpers;
            $getUuidFaskes = $checkerhelper->tindakanKategoriChecker(['uuid_tindakan_kategori' => $this->uuidTindakanKategori]);
            if (is_null($getUuidFaskes)) :
                throw new \Exception($this->outputMessage('not found', 'tindakan kategori'));
            endif;
            $response = $getUuidFaskes->uuid_faskes;
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }
}
