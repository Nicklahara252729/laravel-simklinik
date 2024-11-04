<?php

namespace App\Http\Requests\MasterData\JadwalPoli;

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
            'uuid_poliklinik' => [
                'required',
                Rule::exists('poliklinik')->where(function ($query) {
                    return $query->where('uuid_poliklinik', $this->uuid_poliklinik);
                }),
                Rule::unique('jadwal_poli')->where(function ($query) {
                    return $query->where([
                        'uuid_faskes' => $this->getJadwalPoli(),
                        'dokter' => $this->dokter,
                        'hari' => $this->hari
                    ]);
                })->ignore($this->uuidJadwalPoli, "uuid_jadwal_poli")
            ],
            'dokter' => [
                'required',
                'exists:users,uuid_user',
                Rule::unique('jadwal_poli')->where(function ($query) {
                    return $query->where([
                        'uuid_faskes' => $this->getJadwalPoli(),
                        'uuid_poliklinik' => $this->uuid_poliklinik,
                        'dokter' => $this->dokter,
                        'hari' => $this->hari
                    ]);
                })->ignore($this->uuidJadwalPoli, "uuid_jadwal_poli")
            ],
            'perawat' => [
                'required',
                'exists:users,uuid_user',
                Rule::exists('jadwal_poli')->where(function ($query) {
                    return $query->where([
                        'uuid_faskes' => $this->getJadwalPoli()
                    ]);
                })
            ],
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
            'jam' => 'required',
            'keterangan' => 'nullable',
            'kode_antrian' => 'nullable',
        ];
    }

    private function getJadwalPoli()
    {
        try {
            $checkerhelper = new CheckerHelpers;
            $getUuidFaskes = $checkerhelper->jadwalPoliChecker(['uuid_jadwal_poli' => $this->uuidJadwalPoli]);
            if (is_null($getUuidFaskes)) :
                throw new \Exception($this->outputMessage('not found', 'jadwal poli'));
            endif;
            $response = $getUuidFaskes->uuid_faskes;
        } catch (\Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }
}
