import { getDataPasien } from "../src/pendaftaran/pendaftaran-pasien/process/pasien-lama/read.js";
import { RegionMain } from "./../src/pendaftaran/pendaftaran-pasien/components/region/RegionMain.js";
import { validateFormStepTwo } from "../src/pendaftaran/pendaftaran-pasien/pendaftaran-pasien.js";

class FormManagerPendaftaran {
    constructor(form, submitButton) {
        this.form = form;
        this.submitButton = submitButton;
        this.action = "";
        this.selectFields = ['id_provinsi', 'id_kabupaten', 'id_kecamatan', 'id_desa']
        this.method = "POST";
        this.regionManager = new RegionMain();
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

    getPostData = () => this.getFormData();

    getPutData = () => {
        const formData = this.getPostData();
        formData.append("_method", "PUT");
        return formData;
    };

    emptyForm = () => {
        this.form[0].reset();
    };

    directToPage = () => {
        const baseURL = "https://simpus.infotekmetrodata.co.id/"
        setTimeout(() => {
            window.location.href = `${baseURL}pendaftaran/list-pendaftaran`;
        }, 800)
    }

    handleSuccess = async (response) => {
        if (response.status) {
            await this.handleSuccessResponse(response);
        } else {
            console.error(response);
        }
    };


    handleSuccessResponse = async (response) => {
        swalSuccess(response.message, async () => {
            this.emptyForm();
        });
    };

    handleSubmitError = (e) => {
        console.error(e);

        if (e.status === 422) {
            const errorFields = e.responseJSON.errors;
            const errorMessage = Object.entries(errorFields)
                .map(([field, errors]) => errors.map(error => `<li style="text-align: left">${field}: ${error}</li>`))
                .flat()
                .join("\n");
            swalError(`Validasi Error: <ul>${errorMessage}</ul>`, () => { })

        } else {
            const errorMessage = e.responseJSON && e.responseJSON.message ? e.responseJSON.message : "Oops, Something error :(";
            swalError(errorMessage, () => { })
        }
    };

    fillFormData = (data) => {
        // Check if 'data_pribadi' is present in the response
        if (data) {
            const dataPribadi = data;

            // Update form fields with 'data_pribadi'
            Object.keys(dataPribadi).forEach((key) => {
                const element = this.form.find(`[name="${key}"]`);

                if (element.length) {
                    const elementType = element.prop('type');

                    if (elementType === 'text' || elementType === 'date' || elementType === 'email') {
                        element.val(dataPribadi[key]);
                    } else if (elementType === 'select-one') {
                        // Handle select elements
                        const selectElement = element[0];

                        // Set the value of the select element
                        selectElement.value = dataPribadi[key];

                        // Trigger the change event
                        $(selectElement).trigger('change');
                    } else if (elementType === 'checkbox' || elementType === 'radio') {
                        // For checkboxes and radio buttons, handle checked property
                        element.prop('checked', dataPribadi[key]);
                    }
                }
            });
        }
    };

    submitForm = async () => {

        // const isFormValid = validateFormStepTwo();

        try {
            // Continue with form submission
            const response = await sendApiRequest({
                url: this.getAction(),
                data: this.getMethod().toLowerCase() === "post" ? this.getPostData() : this.getPutData(),
                type: "POST",
            }, true);
            this.handleSuccess(response);
            this.directToPage();
        } catch (e) {
            this.handleSubmitError(e);
        }
    };

    handleNomorRekamedisInput = async () => {
        try {
            const nomorRekamedisInput = this.form.find('[name="no_rm"]');
            const no_rm = nomorRekamedisInput.val();

            // Fetch data based on the inputted RM number
            const dataPasien = await getDataPasien(no_rm);

            // Check if data is found and if it matches the inputted RM number
            if (dataPasien && dataPasien.no_rm === no_rm) {
                const excludeFields = [...this.selectFields];

                // Set form fields excluding the region fields
                $.each(dataPasien, (key, value) => {
                    if (!excludeFields.includes(key)) {
                        const inputElement = $(`[name="${key}"]`);
                        if (inputElement.length) {
                            inputElement.val(value);
                        }
                    }
                });

                // Auto-fill form with retrieved data
                this.fillFormData(dataPasien);

                $('#step-4').show()
                $("#step-4 :input").prop("readonly", true);
                $('#next-button').show()
            } else {
                // Handle case where no matching data is found
                this.fillFormData.val('');
                console.error("No matching data found for RM number:", no_rm);
            }
        } catch (e) {
            const errorMessage = e.responseJSON && e.responseJSON.message ? e.responseJSON.message : "Nomor Rekam Medis Tidak Ditemukan";
            swalError(errorMessage, () => { })
        }
    };

    initForm = () => {
        // Use the change event instead of keyup
        const nomorRekamedisInput = this.form.find('[name="no_rm"]');
        nomorRekamedisInput.on('change', this.handleNomorRekamedisInput);

        this.submitButton.on("click", () => {
            this.submitForm();
        });

        this.form.on("submit", (e) => {
            e.preventDefault();
            this.submitForm();
        });
    };

}

export { FormManagerPendaftaran };