import { JenisPembayaranHargaForm } from "../../../../../helpers/JenisPembayaranHargaForm.js";
import { renderDataTindakan } from "../../process/read.js";
import { FormManager } from "../../../../../helpers/FormManager.js";
import { masks, masksOptions } from "./mask.js";
import { defaultValidator} from "./validator.js"

class FormInput extends FormManager {
    constructor(form, modal, submitButton) {
        super(form, modal, submitButton);

        this.masks = masks
        
        this.validators = []

        
        this.jenisPembayaranHargaForm = new JenisPembayaranHargaForm($('#container-row-jenis-pembayaran-harga'), null, 'tindakan', this.form) 
        
        this.initForm();
    }

    getPostData = () => {
        const formData = this.getFormData();
        formData.set("harga", this.masks.harga.unmaskedvalue());
    
        const hargaJualInputs = document.getElementsByName("harga_jual[]");
        const updatedHargaJual = Array.from(hargaJualInputs).map(input => {
            return new Inputmask(this.maskConfig).mask(input).unmaskedvalue();
        });

        formData.append("uuid_poliklinik_link_klinik", $("#poliklinik-select").val());
    
        // Remove existing "harga_jual[]" entries from formData
        formData.delete("harga_jual[]");
    
        // Set updated "harga_jual[]" entries in formData
        updatedHargaJual.forEach(value => {
            formData.append("harga_jual[]", value);
        });
    
        return formData;
    }

    setValidators = (validators) => {
        this.validators = validators;
    } 

    fillForm = (data) => {
        this.emptyForm();
    
        const excludeFields = ['harga'];
    
        // Loop through the response data and populate the form fields
        $.each(data, (key, value) => {
            const inputElement = $(`[name="${key}"]`);
            
            // Check if the field is not in the excludeFields array
            if (!excludeFields.includes(key)) {
                // Check if the input element exists and set its value
                if (inputElement.length) {
                    inputElement.val(value);
                }
            } else if (key === 'harga') {
                // Manually update the display value after a delay
                this.masks.harga.setValue(value);   
            }
        });
    
        $("#kategori_tindakan").trigger('change');
        this.jenisPembayaranHargaForm = new JenisPembayaranHargaForm($("#container-row-jenis-pembayaran-harga"), data.tindakan_harga, 'tindakan', this.form);
    };
    
    

    handleSuccessResponse = async (response) => {
        swalSuccess(response.message, async () => {
            await renderDataTindakan();
            $("#modal-tindakan").modal("hide");
            this.emptyForm();
        });
    };


    emptyForm = () => {
        this.form[0].reset();
        $("#kategori_tindakan").trigger('change.select2');
        defaultValidator.resetForm(true);
    }



    initForm = () => {

        this.submitButton.off('click').on('click', async () => {
            //validate with validators
            // check if theres an jenis-pembayaran-harga-row class element, if yes then push validator jenishargavalidator
            const validators = [defaultValidator]

            const hasJenisPembayaran = $('.jenis-pembayaran-harga-row').length 
            if(hasJenisPembayaran){
                validators.push(this.jenisPembayaranHargaForm.getValidator()) 
                $('[data-field="uuid_jenis_pembayaran[]"][data-validator="notEmpty"]').parent().remove();
                $('[data-field="harga_jual[]"][data-validator="notEmpty"]').parent().remove();
                
                // this.jenisPembayaranHargaForm.validator.revalidateField('uuid_jenis_pembayaran[]')
                // this.jenisPembayaranHargaForm.validator.revalidateField('harga[]')
            }

            if (validators.length) {
                if(await this.validateValidators(validators)){
                    this.form.submit();
                }
                else{
                    console.log('validation failed')
                }
                // defaultValidator.validate().then((status) => {
                //     if (status === 'Valid') {
                //         this.form.submit();
                //     } else {
                //         const formElements = defaultValidator.elements;

                //         Object.keys(formElements).forEach(fieldName => {
                //             const field = formElements[fieldName];
                //             defaultValidator.validateField(fieldName).then(result => {
                //                 if (result === 'Invalid') {
                //                     console.log(`Field '${fieldName}' tidak valid`);
                //                     const errorMessages = defaultValidator.getMessages(field);
                //                     console.log('Pesan kesalahan:', errorMessages);
                //                 }
                //             });
                //         });
                        
                //     }
                // });
            }
            

            // Call the form's submit method if validation passes
        });

        $("#kategori_tindakan").on('change', (e) => {
            defaultValidator.revalidateField('uuid_tindakan_kategori')
        })

        this.form.off("submit").on("submit", (e) => {
            e.preventDefault();
            this.submitForm(true);
        });
        
    }
    
}

const formInput = new FormInput($("#form-tindakan"), $("#modal-tindakan"), $("#submit-button-tindakan"));
export { FormManager, formInput };
