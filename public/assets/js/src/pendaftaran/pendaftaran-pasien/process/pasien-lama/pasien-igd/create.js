import { formInput } from "../../../components/form/form.js";

class FormPendaftaranLamaIgdHandler {
   constructor() {
      this.formManager = formInput;
   }

   pendaftaranHandler() {
      this.formManager.setMethod("POST");
      this.formManager.setAction("/api/web/pendaftaran-pasien/igd/store/pasien-lama");
   }
}

export default FormPendaftaranLamaIgdHandler