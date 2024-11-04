<?php

namespace App\Http\Requests\Farmasi\Resep;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
         // 'uuid_pemeriksaan'  => 'required|exists:pemeriksaan,uuid_pemeriksaan',
         'uuid_pemeriksaan'  => 'required',
         'uuid_data_obat'    => 'required|exists:data_obat,uuid_data_obat',
         'aturan_pakai'      => 'required',
         'jumlah'            => 'required|integer',
         'harga'             => 'required|integer',
         'total'             => 'required|integer',
         'batch_no'          => 'required',
         'expired'           => 'required|date',
      ];
   }
}
