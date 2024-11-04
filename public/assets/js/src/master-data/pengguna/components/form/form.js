import { renderDataPengguna } from "../../process/read.js";
import { FormManager } from "../../../../../helpers/FormManager.js";
import { masks } from "./mask.js";
import { defaultValidator, passwordValidator } from "./validator.js";

class FormInput extends FormManager {
    constructor(form, modal, submitButton) {
        super(form, modal, submitButton);
        this.validatorUsed = [];
        this.masks = masks
        this.initForm()
    }

    getPostData = () => {
        const formData = this.getFormData();

        // Set nilai unmasked ke dalam formData
        Object.keys(this.masks).forEach(fieldName => {
            console.log(fieldName, this.masks[fieldName].unmaskedvalue())
            formData.set(fieldName, this.masks[fieldName].unmaskedvalue());
        });
        return formData;
    }

    getPutData = () => {
        const formData = this.getPostData();
        formData.append("_method", "PUT");
        formData.delete('password');
        formData.delete('confirm_password');
        return formData;
    }

    emptyForm = () => {
        defaultValidator.resetForm(true)
        passwordValidator.resetForm(true);
        this.form[0].reset();
        $('.dropify-clear').click();
    }

    fillForm(data) {
        this.emptyForm();
        const excludeFields = ['level', 'uuid_faskes', 'uuid_user', 'photo'];
        const masksInput = Object.keys(this.masks);
    
        // Use an arrow function to preserve the 'this' context
        $.each(data, (key, value) => {
            if (!excludeFields.includes(key)) {
                console.log(key, value)
                const inputElement = $(`[name="${key}"]`);
                if (inputElement.length) {
                    inputElement.val(value);
                }
            }
            if(['photo'].includes(key)) {
                const dropify = $('.dropify').dropify(dropfiyConfig);
                const dropifyInstance = dropify.data('dropify');
                dropifyInstance.resetPreview();
                dropifyInstance.clearElement();
                console.log(value)
                dropifyInstance.settings.defaultFile = `${value}`;
                dropifyInstance.destroy();
                dropifyInstance.init();
            }
            if(masksInput.includes(key)) {
                this.masks[key].setValue(value);
            }
        });
    }
    
    handleSuccessResponse = async (response) => {
        swalSuccess(response.message, async () => {
            await renderDataPengguna(); // render new data pengguna table
            this.modal.modal("hide");
            this.emptyForm();
        });
    };

    setValidatorAdd = async () => {
        this.validatorUsed = [defaultValidator, passwordValidator];
    }

    setValidatorEdit = async () => {
        this.validatorUsed = [defaultValidator];
    }

    validateForm = async () => {
        const statuses = await Promise.all(this.validatorUsed.map(validator => validator.validate()));
    
        const isValid = statuses.every(status => status === 'Valid');
        if (isValid) {
            return true;
        }
    
        const handleInvalidFields = async (validator) => {
            const formElements = validator.elements;
            for (const fieldName in formElements) {
                const field = formElements[fieldName];
                const result = await validator.validateField(fieldName);
                if (result === 'Invalid') {
                    console.log(`Field '${fieldName}' is not valid`);
                    const errorMessages = validator.getMessages(field);
                    console.log('Error messages:', errorMessages);
                }
            }
        };
    
        // await Promise.all([handleInvalidFields(validator1), ...(validator2 ? [handleInvalidFields(validator2)] : [])]);
        return false;
    };
    
    initForm = () => {
        this.submitButton.off('click').on('click', () => {
            //validate with validators
            console.log(this.validatorUsed)
            if (this.validatorUsed) {
                this.validateForm().then(isValid => {
                    if (isValid) {
                        this.form.submit();
                    } else {
                        console.log('not valid')
                    }
                });
            }
        });

        this.form.off("submit").on("submit", (e) => {
            e.preventDefault();
            this.submitForm(true);
        });

        $('.dropify').dropify(dropfiyConfig);
    }
}

const formInput = new FormInput($("#form-pengguna"), $("#modal-pengguna"), $("#submit-button-pengguna"));
export { FormManager, formInput };