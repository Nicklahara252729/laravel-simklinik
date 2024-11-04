import { renderDataJadwalPoli } from "../../process/read.js";
import { FormManager } from "../../../../../helpers/FormManager.js";
import defaultValidator from "./validator.js";
class FormInput extends FormManager {
    constructor(formElement, modalElement, submitButton) {
        super(formElement, modalElement, submitButton);
        this.selectFields = ['uuid_poliklinik', 'dokter', 'perawat', 'hari'];
        this.initForm();
    }

    fillForm(data) {
        this.emptyForm();
    
        // Array of field names to exclude from rendering
        const excludeFields = [...this.selectFields, 'jam'];

        $.each(data, (key, value) => {
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
            if ((this.selectFields).includes(key)) {
                const selectElement = $(`[name="${key}"]`);
                selectElement.val(value);
                selectElement.trigger("change");
            }
        });

        // Split and apply the "jam" value
        this.splitAndApplyJam(data.jam);
    }

    splitAndApplyJam(jamValue) {
        // Assuming jamValue is in the format "start - end"
        const [startTime, endTime] = jamValue.split(' - ');

        // Set the values in the corresponding input fields
        $("#start-hour").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            defaultDate: startTime,
        })
        $("#end-hour").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            defaultDate: endTime,
        })
    }

    emptyForm = () => {
        this.form[0].reset();
        defaultValidator.resetForm(true);
        this.selectFields.forEach((field) => {
            $(`[name="${field}"]`).val(null);
            $(`[name="${field}"]`).trigger("change");
        });
    };
    
    combineStartAndEndTime() {
        const startTime = $("#start-hour").val();
        const endTime = $("#end-hour").val();
        return `${startTime} - ${endTime}`;
    }

    setDefaultStartAndEndTime(start, end) {
        $("#start-hour").val(start);
        $("#end-hour").val(end);
    }

    getPostData = (isUseFaskes) => {
        const formData = this.getFormData();
        isUseFaskes ? formData.append("uuid_faskes", getUuidFaskes()) : '';
        formData.append("jam", this.combineStartAndEndTime());
        console.log(this.combineStartAndEndTime())
        return formData;
    }

    getPutData = (isUseFaskes) => {
        const formData = this.getPostData(isUseFaskes);
        formData.append("_method", "PUT");
        console.log({formData})
        return formData;
    }

    handleSuccessResponse = async (response) => {
        swalSuccess(response.message, async () => {
            await renderDataJadwalPoli();
            this.modal.modal("hide");
            this.emptyForm();
            this.selectFields.forEach((field) => {
                $(`[name="${field}"]`).trigger("change");
            });
        });
    };

    initForm = () => {
        $('#start-hour').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
        })
        $('#end-hour').flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        })

        this.submitButton.off('click').on('click', () => {
            if(defaultValidator){
                defaultValidator.validate().then((status) => {
                    if(status === 'Valid'){
                        this.form.submit();
                    } else {
                        const formElements = defaultValidator.elements;
                        Object.keys(formElements).forEach(fieldName => {
                            const field = formElements[fieldName];
                            defaultValidator.validateField(fieldName).then(result => {
                                if(result === 'Invalid'){
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
            console.log('submit');
            e.preventDefault();
            this.submitForm(true);
        });
    }
}

const formInput = new FormInput($('#form-jadwal-poli'), $('#modal-jadwal-poli'), $('#submit-button-jadwal-poli'));
export { formInput };