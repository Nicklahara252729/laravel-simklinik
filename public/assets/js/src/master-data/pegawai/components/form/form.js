import { renderDataPegawai } from "../../process/read.js";
import { FormManager } from "../../../../../helpers/FormManager.js";
import dokterAction from "./dokter-action.js";
import perawatAction from "./perawat-action.js";
import {masks} from "./mask.js";
import {
    defaultValidator,
    perawatValidator,
    dokterValidator,
    kamarValidator,
    poliValidator,
    passwordValidator,
} from "./validator.js";

class FormInput extends FormManager {
    constructor(form, modal, submitButton) {
        super(form, modal, submitButton);
        this.dateInputs = ['tgl_berakhir_sip', 'tgl_berakhir_str', 'tgl_berlaku_sip', 'tgl_berlaku_str'];
        this.fileInputs = ['photo'];
        this.radioInputs = ['jabatan'];

        this.masks = masks

        this.validators = [
            defaultValidator,
            perawatValidator,
            dokterValidator,
            kamarValidator,
            poliValidator,
            passwordValidator,
        ]

        this.initForm()
    }

    getPostData = () => {
        const formData = this.getFormData();

        //append kamar if not disabled exist in form as uuid_kamar[] loop
        const isKamarShow = !$('.kamar-access').hasClass('d-none');
        const kamar = $('#kamar-access').val();
        if(isKamarShow){
            kamar.map(item => {
                formData.append('uuid_kamar[]', item);
            })
        }

        //set unmasked value from masked input

        // Set nilai unmasked ke dalam formData
        Object.keys(this.masks).forEach(fieldName => {
            formData.set(fieldName, this.masks[fieldName].unmaskedvalue());
        });

        //append poliklinik if exist in form uuid_poliklinik_link_klinik[] loop
        const isPoliklinikShow = !$('.poli-access').hasClass('d-none');
        const poliklinik = $('#poli-access').val();
        if(isPoliklinikShow){
            poliklinik.map(item => {
                formData.append('uuid_poliklinik_link_klinik[]', item);
            })
        }

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
        const selectedLevel = $("#level").val();
        const isPerawat = selectedLevel === 'perawat';
    
        defaultValidator.resetForm(true);
        $("#form-pegawai select").val(null).trigger('change.select2').trigger('change.showLevelBasedInput');
    
        const resetValidators = (validators) => validators.forEach(validator => validator.resetForm(true));
    
        isPerawat ? resetValidators([perawatValidator, kamarValidator, poliValidator]) : resetValidators([dokterValidator]);
        passwordValidator.resetForm(true)
    
        $('.dropify-clear').click();
    }
    

    fillForm(data) {
        this.emptyForm();
        const maskInputs = ['phone', 'no_ktp']
        const excludeFields = [...this.dateInputs, ...this.fileInputs, ...this.radioInputs, ['kamar', 'poliklinik'], ...maskInputs];
    
        // Use an arrow function to preserve the 'this' context
        $.each(data, (key, value) => {
            if (!excludeFields.includes(key)) {
                const inputElement = $(`[name="${key}"]`);
                if (inputElement.length) {
                    inputElement.val(value);
                }
            }
            if(this.dateInputs.includes(key)) {
                this.setFlatpickrDefault(key, value);
            }
            if(this.radioInputs.includes(key)) {
                $(`[name="${key}"][value="${value}"]`).prop('checked', true);
            }
            if(this.fileInputs.includes(key)) {
                const dropify = $('.dropify').dropify(dropfiyConfig);
                const dropifyInstance = dropify.data('dropify');
                dropifyInstance.resetPreview();
                dropifyInstance.clearElement();
                dropifyInstance.settings.defaultFile = `${value}`;
                dropifyInstance.destroy();
                dropifyInstance.init();
            }
            if(maskInputs.includes(key)) {
                this.masks[key].setValue(value);
            }
        });

        

        const level = data.level;
        if(level == "perawat" ){
            $('#role').val(data.role.uuid_role).trigger('change');

            perawatAction.fillData(data);
        }


        if(level == "dokter") {
            const spesialis = data.uuid_spesialis;
            $('#spesialis').val(spesialis).trigger('change');
        }
        
        $(`[name="level"]`).trigger('change');
    }

    setFlatpickrDefault(inputName, date) {
        // Find the specific Flatpickr instance based on input name
        const flatpickrElement = $(`input[name="${inputName}"].flatpickr`).get(0); // Get the DOM element
        if (flatpickrElement && flatpickrElement._flatpickr) {
            // Access the Flatpickr instance from the DOM element
            const flatpickrInstance = flatpickrElement._flatpickr;
    
            // Set the default date for the found Flatpickr instance
            flatpickrInstance.setDate(date);
        } else {
            console.error(`Flatpickr instance for input '${inputName}' not found.`);
        }
    }
    
    
    handleSuccessResponse = async (response) => {
        swalSuccess(response.message, async () => {
            await renderDataPegawai(); // render new data pegawai table
            this.modal.modal("hide");
            this.emptyForm();
        });
    };


    initForm = () => {
        $(".flatpickr").flatpickr({
            dateFormat: "Y-m-d", // Set the date format to yyyy-mm-dd
        });

        this.submitButton.off('click').on('click', async () => {
            const validators = [defaultValidator]

            $("#level").val() == 'dokter' ? validators.push(dokterValidator) : null;
            $("#level").val() == 'perawat' ? validators.push(perawatValidator) : null;

            //validate if kamar-access is not disabled
            $("#level").val() == 'perawat' && !$("kamar-access").prop('disabled') ? validators.push(kamarValidator) : null;

            //validate if poli-access is not disabled
            $("#level").val() == 'perawat' && !$("poli-access").prop('disabled') ? validators.push(poliValidator) : null;

            this.getMethod() == 'POST' ? validators.push(passwordValidator) : null;

            console.log(validators)


            //validate with validators
            if (validators.length && await this.validateValidators(validators)) {
                console.log("valid")
                this.form.submit();
            }
            else {
                console.log('validation failed')
            }
            

            // Call the form's submit method if validation passes
        });

        this.form.off("submit").on("submit", (e) => {
            e.preventDefault();
            this.submitForm(true);
        });

        $('.dropify').dropify(dropfiyConfig);

        $('#level').on('change.showLevelBasedInput', (e) => {
            const level = e.target.value;

            const isDokter = level === 'dokter';
            const isPerawat = level === 'perawat';
            
            $(".perawat-container").toggleClass('d-none', !isPerawat);
            $(".perawat-container").find('select').prop('disabled', !isPerawat);
            dokterAction.showHideDokterInput(isDokter);
        });

        $("#level").on('change', (e) => {
            $('#role').val(null).trigger('change');
            defaultValidator.revalidateField('level');
        })

        $('#role').on('change', (e) => {
            perawatValidator.revalidateField('uuid_role')
        })

        $('#spesialis').on('change', (e) => {
            dokterValidator.revalidateField('uuid_spesialis')
        })

        $('#kamar-access').on('change', (e) => {
            kamarValidator.revalidateField('uuid_kamar[]')
        })

        $('#poli-access').on('change', (e) => {
            poliValidator.revalidateField('uuid_poliklinik_link_klinik[]')
        })
        
    }
}

const formInput = new FormInput($("#form-pegawai"), $("#modal-pegawai"), $("#submit-button-pegawai"));
export { FormManager, formInput };