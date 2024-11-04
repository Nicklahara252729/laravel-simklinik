<?php

namespace App\Http\Requests\Pendaftaran\PendaftaranPasien\RawatInap;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePasienBaruRawatInapRequest extends FormRequest
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

            /**
             * pendaftaran
             */
            'jenis_layanan'               => 'required|in:rawat inap',
            'jenis_pelayanan'             => 'required|in:umum,bpjs,lainnya',

            /**
             * data pribadi
             */
            'no_ktp'                      => [
                'required',
                'max_digits:16',
                Rule::unique('data_pribadi')->where(function ($query) {
                    return $query->where([
                        'no_ktp' => $this->no_ktp,
                        'uuid_faskes' => $this->getUuidFaskes()
                    ]);
                }),
            ],
            'nama_pasien'                 => 'required',
            'tgl_lahir'                   => 'required|date',
            'alamat'                      => 'required',
            'email'                       => [
                'nullable',
                'email',
                Rule::unique('data_pribadi')->where(function ($query) {
                    return $query->where([
                        'email' => $this->email,
                        'uuid_faskes' => $this->getUuidFaskes()
                    ]);
                }),
            ],
            'gender'                      => 'required|in:laki - laki,perempuan',
            'golongan_darah'              => 'required|in:a,b,ab,o,tidak tahu',
            'no_hp_1'                     => [
                'required',
                'max_digits:13',
                Rule::unique('data_pribadi')->where(function ($query) {
                    return $query->where([
                        'no_hp_1' => $this->no_hp_1,
                        'uuid_faskes' => $this->getUuidFaskes()
                    ]);
                }),
            ],
            'no_hp_2'                     => 'nullable|max_digits:13',

            /**
             * data penanggung jawab
             */
            'nama_pj'                     => 'required|string',
            'alamat_pj'                     => 'required|string',
            'no_hp'                       => 'required|max_digits:13',
            'id_provinsi'                 => 'required|exists:reg_provinces,id',
            'id_kabupaten'                => 'required|exists:reg_regencies,id',
            'id_kecamatan'                => 'required|exists:reg_districts,id',
            'id_desa'                     => 'required|exists:reg_villages,id',

            /**
             * data pendukung
             */
            'kunjungan'                   => 'required|in:sehat,sakit',
            'uuid_kamar'                   => [
                'required',
                Rule::exists('kamar')->where(function ($query) {
                    return $query->where([
                        'uuid_kamar' => $this->uuid_kamar,
                        'uuid_faskes' => $this->getUuidFaskes()
                    ]);
                }),
            ],
            'uuid_bed'                   => [
                'required',
                Rule::exists('bed')->where(function ($query) {
                    return $query->where([
                        'uuid_kamar' => $this->uuid_kamar,
                        'uuid_bed' => $this->uuid_bed
                    ]);
                }),
            ],
            'no_bpjs'                   => 'nullable|integer',
            'uuid_jp_link_faskes' => [
                'nullable',
                Rule::exists('jenis_pembayaran_link_faskes')->where(function ($query) {
                    return $query->where([
                        'uuid_jp_link_faskes' => $this->uuid_jp_link_faskes,
                        'uuid_faskes' => $this->getUuidFaskes()
                    ]);
                }),
            ]
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
