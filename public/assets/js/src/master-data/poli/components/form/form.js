import { renderDataPoliklinik } from "../../process/read.js";
import { Validator } from "./validator.js";
import { FormManager } from "../../../../../helpers/FormManager.js";

class FormInput extends FormManager {
    constructor(form, modal, submitButton) {
        super(form, modal, submitButton);
        this.Validator = new Validator(form);
        this.initForm();
    }

    handleSuccessResponse = async (response) => {
        swalSuccess(response.message, async () => {
            await renderDataPoliklinik();
            this.modal.modal("hide");
            this.emptyForm();
        });
    };

    initForm = () => {
        // Attach a click event handler to the button
        this.submitButton.off('click').on('click', () => {
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
    $("#form-poliklinik"),
    $("#modal-poliklinik"),
    $("#submit_button_poliklinik")
);

export { formInput };