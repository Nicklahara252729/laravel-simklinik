<?php

namespace App\Http\Requests\Poliklinik;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Tindakan;
use App\Rules\Diagnosa;

class StorePemeriksaanDokterRequest extends FormRequest
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
         'tindakan_dokter' => [
            'required',
            'array',
            new Tindakan($this->uuid_faskes)
         ],
         'diagnosa'       => [
            'required',
            'array',
            new Diagnosa()
         ],
         'uuid_data_obat' => [
            'required',
            'array',
            Rule::exists('data_obat')->where(function ($query) {
               return $query->where([
                  'uuid_faskes' => $this->getUuidFaskes()
               ]);
            })
         ],
         'keterangan'        => 'required',
         'aturan_pakai.*'    => 'required|string',
         'jumlah.*'          => 'required|integer',
         'total.*'           => 'required|integer',
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
