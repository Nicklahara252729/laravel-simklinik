import { renderDataDiagnosa } from "../../process/read.js";
import { FormManager } from "../../../../../helpers/FormManager.js";
import defaultValidator from "./vaildator.js";

/**
 * Manages form-related operations for Diagnosa management.
 *
 * @class
 */
class FormInput extends FormManager {
    constructor(form, modal, submitButton) {
        super(form, modal, submitButton);
        this.initForm();
    }

    handleSuccessResponse = async (response) => {
        swalSuccess(response.message, async () => {
            await renderDataDiagnosa(); // render new data diagnosa table
            $("#modal-diagnosa").modal("hide"); // hide modal
            this.emptyForm(); // reset form
        });
    };

    getPostData = () => {
        const formData = this.getFormData();
        return formData;
    }

    getPutData = () => {
        const formData = this.getPostData();
        formData.append("_method", "PUT");
        return formData;
    }

    emptyForm = () => {
        this.form[0].reset();
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

        this.form.off('submit').on("submit", (e) => {
            e.preventDefault();
            this.submitForm(false);
        });
    };
}

const formInput = new FormInput($("#form-diagnosa"), $("#modal-diagnosa"), $("#submit-button-diagnosa"));
export { formInput };