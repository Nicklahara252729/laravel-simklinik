import { formInput } from "../../../components/form/form.js";

class FormPendaftaranBaruRawatInapHandler {
   constructor() {
      this.formManager = formInput;
   }

   pendaftaranHandler() {
      this.formManager.setMethod("POST");
      this.formManager.setAction("/api/web/pendaftaran-pasien/rawat-inap/store/pasien-baru");
   }
}

export default FormPendaftaranBaruRawatInapHandler 