import { getAllData } from "../../process/pasien-baru/read.js";
import { FormManagerPendaftaran } from "../../../../../helpers/FormManagerPendaftaran.js";

class FormInput extends FormManagerPendaftaran {
   constructor(form, submitButton) {
      super(form, submitButton);
   }

   emptyForm = () => {
      this.form[0].reset();
   };

   handleSuccessResponse = async (response) => {
      swalSuccess(response.message, async () => {
         await getAllData();
         this.emptyForm();
      });
   };

}

const formInput = new FormInput($("#form-pendaftaran-pasien"), $("#submit-button-pendaftaran"));
export { FormManagerPendaftaran, formInput };
