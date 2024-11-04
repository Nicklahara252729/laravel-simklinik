import { renderDataKamar } from "../../process/read.js";
import { FormManager } from "../../../../../helpers/FormManager.js";
import defaultValidator from "./validator.js";
import { masks, masksOptions } from "./mask.js";

class FormInput extends FormManager {
   constructor(form, modal, submitButton) {
      super(form, modal, submitButton);
      this.masks = masks;

      this.initForm();
   }

   emptyForm = () => {
      this.form[0].reset();
      defaultValidator.resetForm(true);
   };

   getPostData = () => {
      const formData = this.getFormData();

      // Set nilai unmasked ke dalam formData
      Object.keys(this.masks).forEach(fieldName => {
         formData.set(fieldName, this.masks[fieldName].unmaskedvalue());
      });
      return formData;
  }


   fillForm = (data) => {
      this.emptyForm();

      const excludeFields = ['harga'];
      const maskInputs = Object.keys(this.masks);

      // Loop through the response data and populate the form fields
      $.each(data, (key, value) => {
         // Check if the field is not in the excludeFields array
         const inputElement = $(`[name="${key}"]`);
         if (!excludeFields.includes(key)) {
            // Find input elements with matching name attributes

            // Check if the input element exists and set its value
            if (inputElement.length) {
               inputElement.val(value);
            }
         }
         if (maskInputs.includes(key)) {
            console.log(this.masks[key])
            this.masks[key].setValue(value);
         }
      });
   };

   handleSuccessResponse = async (response) => {
      swalSuccess(response.message, async () => {
         await renderDataKamar();
         $("#modal-kamar").modal("hide");
         this.emptyForm();
      });
   };

   initForm = () => {

      this.submitButton.off('click').on('click', () => {
          //validate with validators
          if (defaultValidator) {
              defaultValidator.validate().then((status) => {
                  if (status === 'Valid') {
                      this.form.submit();
                  } else {
                      const formElements = defaultValidator.elements;

                      Object.keys(formElements).forEach(fieldName => {
                          const field = formElements[fieldName];
                          defaultValidator.validateField(fieldName).then(result => {
                              if (result === 'Invalid') {
                                  console.log(`Field '${fieldName}' tidak valid`);
                                  const errorMessages = defaultValidator.getMessages(field);
                                  console.log('Pesan kesalahan:', errorMessages);
                              }
                          });
                      });
                      
                  }
              });
          }
          

          // Call the form's submit method if validation passes
      });

      this.form.off("submit").on("submit", (e) => {
          e.preventDefault();
          this.submitForm(true);
      });
      
  }

}

const formInput = new FormInput($("#form-kamar"), $("#modal-kamar"), $("#submit-button-kamar"));
export { FormManager, formInput };
