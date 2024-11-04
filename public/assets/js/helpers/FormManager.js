class FormManager {
    constructor(form, modal, submitButton) {
        this.form = form;
        this.modal = modal;
        this.submitButton = submitButton;
        this.action = ''
        this.url = ''
        
        this.initForm();
    }

    setAction = (action) => {
        this.action = action;
    };

    getAction = () => this.action;

    setMethod = (method) => {
        this.method = method;
    };

    getMethod = () => this.method;

    getFormData = () => new FormData(this.form[0]);

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
    };

    handleSuccess = async (response) => {
        if (response.status) {
            await this.handleSuccessResponse(response);
        } else {
            console.error(response);
            // this.handleErrorResponse(response.data.message);
        }
    };

    handleSuccessResponse = async (response) => {
        swalSuccess(response.message, async () => {
            this.modal.modal("hide");
            this.emptyForm();
        });
    };

    fillForm(data) {
        this.emptyForm();

        // Array of field names to exclude from rendering
        const excludeFields = [''];

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
        })
    }

    validateValidators = async (validators) => {
        try {
            // Use Promise.all to wait for all validations to complete
            await Promise.all(validators.map(async (validator) => {
                const status = await validator.validate();
                if (status !== 'Valid') {
                    throw validator;
                }
            }));
    
            // All validators are valid
            return true;
        } catch (invalidValidator) {
            // At least one validator is invalid
            console.log('Form is invalid', invalidValidator);
            return false;
        }
    };
    

    handleSubmitError = (e) => {
        console.error(e);

        if (e.status === 422) {
            const errorFields = e.responseJSON.errors;
            const errorMessage = Object.entries(errorFields)
                .map(([field, errors]) => errors.map(error => `<li style="text-align: left">${field}: ${error}</li>`))
                .flat()
                .join("\n");
            swalError(`Validasi Error: <ul>${errorMessage}</ul>`, () => {})

        } else {
            const errorMessage = e.responseJSON && e.responseJSON.message ? e.responseJSON.message : "Oops, Something error :(";
            swalError(errorMessage, () => {})
        }
    };


    submitForm = async () => {

        try {
            const response = await sendApiRequest({
                url: this.getAction(),
                data: this.getMethod().toLowerCase() === "post" ? this.getPostData() : this.getPutData(),
                type: "POST",
            }, true);
            this.handleSuccess(response);
        } catch (e) {
            this.handleSubmitError(e);
        }
    };

    initForm = () => {

        this.submitButton.on('click', () => {
            // Call the form's submit method
            this.form.submit();
        });


        this.form.on("submit", (e) => {
            e.preventDefault();
            this.submitForm(true);
        });
    };
}

export { FormManager };
