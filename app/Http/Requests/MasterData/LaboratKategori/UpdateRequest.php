<?php

namespace App\Http\Requests\MasterData\LaboratKategori;

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
                Rule::unique('laborat_kategori')->where(function ($query) {
                    $query->where('uuid_faskes', $this->getLaboratKategori());
                    return $query->whereNot(function (Builder $query) {
                        $query->where('uuid_laborat_kategori', $this->uuidLaboratKategori);
                    });
                })
            ]
        ];
    }

    private function getLaboratKategori()
    {
        try {
            $checkerhelper = new CheckerHelpers;
            $getUuidFaskes = $checkerhelper->laboratKategoriChecker(['uuid_laborat_kategori' => $this->uuidLaboratKategori]);
            if (is_null($getUuidFaskes)) :
                throw new \Exception($this->outputMessage('not found', 'laborat kategori'));
            endif;
            $response = $getUuidFaskes->uuid_faskes;
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }
}