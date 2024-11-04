import { renderDataSatuanObat } from "../../process/read.js";
import { FormManager } from "../../../../../helpers/FormManager.js";
import defaultValidator from "./validator.js";

class FormInput extends FormManager {
    constructor(formElement, modalElement, submitButtonElement) {
        super(formElement, modalElement, submitButtonElement);
        this.initForm();
    }

    handleSuccessResponse = async (response) => {
        swalSuccess(response.message, async () => {
            await renderDataSatuanObat();
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
    $("#form-satuan-obat"),
    $("#modal-satuan-obat"),
    $("#submit-button-satuan-obat")
);
export { FormManager, formInput };