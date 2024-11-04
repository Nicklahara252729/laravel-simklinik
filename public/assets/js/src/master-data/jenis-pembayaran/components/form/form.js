import { renderDataJenisPembayaran } from "../../process/read.js";
import { FormManager } from "../../../../../helpers/FormManager.js";
import { Validator } from "../vaildator/validator.js";
class FormInput extends FormManager {
    constructor(formElement, modalElement, submitButtonElement) {
        super(formElement, modalElement, submitButtonElement);
        this.Validator = new Validator(formElement);
        this.initForm();
    }

    fillForm(data) {
        this.emptyForm();

        // Array of field names to exclude from rendering
        const excludeFields = ['is_active'];

        // Loop through the response data and populate the form fields
        $.each(data, function (key, value) {
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
            await renderDataJenisPembayaran();
            this.modal.modal("hide");
            this.emptyForm();
        });
    };

    emptyForm = () => {
        this.Validator.validator.resetForm();
    }

    initForm = () => {
        const submitButton = $("#submit-button-jenis-pembayaran")

        // Attach a click event handler to the button
        submitButton.off('click').on('click', () => {
            // Call the form's submit method

            if (this.Validator.validator) {
                this.Validator.validator.validate().then((status) => {        
                    if (status == 'Valid') {
                        this.form.submit();
                    }
                });
            }
        });

        this.form.off("submit").on("submit", (e) => {
            e.preventDefault();
            this.submitForm();
        });
    }
}

const formInput = new FormInput(
    $("#form-jenis-pembayaran"),
    $("#modal-jenis-pembayaran"),
    $("#submit-button-jenis-pembayaran")
);

export { formInput };