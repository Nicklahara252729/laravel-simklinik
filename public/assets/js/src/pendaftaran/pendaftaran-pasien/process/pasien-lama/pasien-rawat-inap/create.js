import { formInput } from "../../../components/form/form.js";

class FormPendaftaranLamaRawatInapHandler {
   constructor() {
      this.formManager = formInput;
   }

   pendaftaranHandler() {
      this.formManager.setMethod("POST");
      this.formManager.setAction("/api/web/pendaftaran-pasien/rawat-inap/store/pasien-lama");
   }
}

export default FormPendaftaranLamaRawatInapHandler