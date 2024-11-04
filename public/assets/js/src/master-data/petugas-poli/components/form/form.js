import { renderDataPetugasPoli } from "../../process/read.js";
import { getDataPegawai } from "../../../pegawai/process/read.js";
import { getDataPoliklinik } from "../../../poli/process/read.js";
import { optionFormat, optionPoliklinik, optionPegawai } from "../select2/select2-template.js";
import { FormManager } from "../../../../../helpers/FormManager.js";
import defaultValidator from "./validator.js";

class FormInput extends FormManager {
    constructor(formElement, modalElement, submitButtonElement) {
        super(formElement, modalElement, submitButtonElement);
        this.initForm();
    }

    emptyForm = () => {
        this.form[0].reset();
        defaultValidator.resetForm(true);
        $("#user-input").val(null).trigger('change');
        $("#poliklinik-input").val(null).trigger('change');
    }

    renderSelectOptions(selectElement, data, type) {
        const options = data
            .map((item) => {
                return type == 'pegawai' ? optionPegawai(item) : optionPoliklinik(item)
            })
            .join("");
        selectElement.append(options);
    }

    fillForm(data) {
        data = data[0] || {};
        this.emptyForm();

        // Array of field names to exclude from rendering
        const excludeFields = [""];
        const selectFields = ["uuid_user", "uuid_poliklinik"];

        // Loop through the response data and populate the form fields
        $.each(data, function (key, value) {
            // Check if the field is not in the excludeFields array
            if (!excludeFields.includes(key)) {
                // Find input elements with matching name attributes
                const inputElement = $(`[name="${key}"]`);
                console.log({inputElement, value})

                // Check if the input element exists and set its value
                if (inputElement.length) {
                    inputElement.val(value);
                }
            }
            if (selectFields.includes(key)) {
                const selectElement = $(`[name="${key}"]`);
                selectElement.trigger("change");
            }
        });
    }

    handleSuccessResponse = async (response) => {
        swalSuccess(response.message, async () => {
            await renderDataPetugasPoli();
            this.modal.modal("hide");
            this.emptyForm();
        });
    };

    initForm = async () => {
        const submitButton = $("#submit-button-petugas-poli");

        const pegawaiSelect = $("#user-input");
        const poliklinikSelect = $("#poliklinik-input");

        const dataPegawai = await getDataPegawai();
        const dataPoliklinik = await getDataPoliklinik();

        this.renderSelectOptions(pegawaiSelect, dataPegawai, 'pegawai');
        this.renderSelectOptions(poliklinikSelect, dataPoliklinik, 'poliklinik');

        pegawaiSelect.select2({
            allowClear: true,
            minimumResultsForSearch: 5,
            templateSelection: optionFormat,
            templateResult: optionFormat
        });

        pegawaiSelect.on('change', function () {
            defaultValidator.revalidateField('uuid_user');
        })

        poliklinikSelect.on('change', function () {
            defaultValidator.revalidateField('uuid_poliklinik');
        })

        // Attach a click event handler to the button
        submitButton.off("click").on("click", () => {
            if(defaultValidator) {
                defaultValidator.validate().then((status) => {
                    if(status == 'Valid') {
                        this.form.submit();
                    } else {
                        const formElements = defaultValidator.elements;

                        Object.keys(formElements).forEach(fieldName => {
                            const field = formElements[fieldName];
                            defaultValidator.validateField(fieldName).then(result => {
                                if(result == 'Invalid') {
                                    console.log(`Field '${fieldName}' tidak valid`);
                                    const errorMessages = defaultValidator.getMessages(field);
                                    console.log('Pesan kesalahan:', errorMessages);
                                }
                            });
                        });
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
    $("#form-petugas-poli"),
    $("#modal-petugas-poli"),
    $("#submit-button-petugas-poli")
);

export { formInput };
