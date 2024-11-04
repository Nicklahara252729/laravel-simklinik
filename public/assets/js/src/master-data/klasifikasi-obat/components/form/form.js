import { renderDataKlasifikasiObat } from "../../process/read.js";
import { FormManager } from "../../../../../helpers/FormManager.js";
import defaultValidator from "./validator.js";

class FormInput extends FormManager {
    constructor(formElement, modalElement, submitButtonElement) {
        super(formElement, modalElement, submitButtonElement);
        this.initForm();
    }

    fillForm(data) {
        this.emptyForm();
    
        // Array of field names to exclude from rendering
        const excludeFields = ['is_active'];
    
        // Loop through the response data and populate the form fields
        $.each(data, function(key, value) {
            // Check if the field is not in the excludeFields array
            if (!excludeFields.includes(key)) {
                // Find input elements with matching name attributes
                const inputElement = $(`[name="${key}"]`);
    
                // Check if the input element exists and set its value
                if (inputElement.length) {
                    inputElement.val(value);
                }
            }
        });
    }

    handleSuccessResponse = async (response) => {
        swalSuccess(response.message, async () => {
            await renderDataKlasifikasiObat();
            this.modal.modal("hide");
            this.emptyForm();
        });
    };


    emptyForm = () => {
        defaultValidator.resetForm(true);
    }

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

const formInput = new FormInput(
    $("#form-klasifikasi-obat"),
    $("#modal-klasifikasi-obat"),
    $("#submit-button-klasifikasi-obat")
);

export { formInput };