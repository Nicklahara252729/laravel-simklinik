import { formInput } from "../../../components/form/form.js";

class FormPendaftaranLamaRawatJalanHandler {
   constructor() {
      this.formManager = formInput;
   }

   pendaftaranHandler() {
      this.formManager.setMethod("POST");
      this.formManager.setAction("/api/web/pendaftaran-pasien/rawat-jalan/store/pasien-lama");
   }
}

export default FormPendaftaranLamaRawatJalanHandler