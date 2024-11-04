import { formInput } from "../../../components/form/form.js";

class FormPendaftaranBaruRawatJalanHandler {
   constructor() {
      this.formManager = formInput;
   }

   pendaftaranHandler() {
      this.formManager.setMethod("POST");
      this.formManager.setAction("/api/web/pendaftaran-pasien/rawat-jalan/store/pasien-baru");
   }
}

export default FormPendaftaranBaruRawatJalanHandler 