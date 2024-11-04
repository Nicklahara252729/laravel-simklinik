<?php

namespace App\Http\Requests\Poliklinik;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Tindakan;

class StorePemeriksaanPerawatRequest extends FormRequest
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
         'uuid_pendaftaran'   => 'required|exists:pendaftaran,uuid_pendaftaran',
         'uuid_data_pribadi'  => [
            'required',
            Rule::exists('data_pribadi')->where(function ($query) {
               return $query->where([
                  'uuid_faskes' => $this->getUuidFaskes()
               ]);
            })
         ],
         'tindakan_perawat' => [
            'required',
            'array',
            new Tindakan($this->uuid_faskes)
        ],
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
