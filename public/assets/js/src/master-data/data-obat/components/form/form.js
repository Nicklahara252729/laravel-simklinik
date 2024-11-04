import { renderDataDataObat } from "../../process/read.js";
import { getDataKlasifikasiObat } from "../../../klasifikasi-obat/process/read.js";
import { getDataSatuanObat } from "../../../satuan-obat/process/read.js";
import { FormManager } from "../../../../../helpers/FormManager.js";
// import { JenisPembayaranHargaForm } from "../../../../../helpers/JenisPembayaranHargaForm.js";
import { formJenisPembayaranHarga } from "./JenisPembayaranHargaForm.js";
import { ValidatorObat } from "./validator.js";

class FormInput extends FormManager {
    constructor(formElement, modal, submitButton) {
        super(formElement, modal, submitButton);
        
        this.maskConfig = {
            "alias": "numeric",
            "groupSeparator": ".",
            "autoGroup": true,
            "digits": 0,
            "digitsOptional": false,
            "placeholder": "0",
            "rightAlign": false,
            "autoUnmask" : true
        };
        this.hargaSatuanMask = new Inputmask(this.maskConfig);
        this.hargaSatuanMask = this.hargaSatuanMask.mask(this.form.find("input[name='harga_satuan']"));
        console.log(this.hargaSatuanMask);

        this.hargaBeliMask = new Inputmask(this.maskConfig);
        this.hargaBeliMask = this.hargaBeliMask.mask(this.form.find("input[name='harga_beli']"));
        console.log(this.hargaBeliMask);

        this.validator = new ValidatorObat(this.form);
        this.validator = this.validator.validator;
        console.log(this.validator);

        this.initForm();


    }

    getPostData = () => {
        const formData = this.getFormData();
        formData.set("harga_satuan", this.hargaSatuanMask.unmaskedvalue());
        formData.set("harga_beli", this.hargaBeliMask.unmaskedvalue());

        const hargaJualInputs = document.getElementsByName("harga_jual[]");
        const updatedHargaJual = Array.from(hargaJualInputs).map(input => {
            return new Inputmask(this.maskConfig).mask(input).unmaskedvalue();
        });
    
        // Remove existing "harga_jual[]" entries from formData
        formData.delete("harga_jual[]");
    
        // Set updated "harga_jual[]" entries in formData
        updatedHargaJual.forEach(value => {
            formData.append("harga_jual[]", value);
        });
    
        return formData;
    }

    setFlatpickrDefault(inputName, date) {
        $(".flatpickr").flatpickr({
            dateFormat: "Y-m-d", // Set the date format to yyyy-mm-dd
            defaultDate: date,
        });
    }

    handleSuccessResponse = async (response) => {
        swalSuccess(response.message, async () => {
            this.modal.modal("hide");
            this.emptyForm();
            await renderDataDataObat();
        });
    };

    emptyForm = () => {
        this.form.trigger("reset");
        const selectInputs = ['uuid_satuan_obat', 'uuid_klasifikasi_obat', 'jenis'];
        selectInputs.forEach(inputName => {
            const selectElement = $(`[name="${inputName}"]`);
            selectElement.val(null).trigger("change");
        })
    }

    fillForm(data) {
        const { harga_obat: dataHargaObat } = data;
        this.emptyForm();
        
        // Array of field names to exclude from rendering
        const selectInputs = ['uuid_satuan_obat', 'uuid_klasifikasi_obat', 'jenis'];
        const dateInputs = ['tgl_expired'];
        const radioInputs = ['status'];
        
        const excludeFields = [...selectInputs, ...dateInputs, ...radioInputs, ...['harga_satuan', 'harga_beli']];
    
        // Loop through the response data and populate the form fields
        $.each(data, (key, value) => {
            // Find input elements with matching name attributes
            const inputElement = $(`[name="${key}"]`);
            
            // Check if the field is not in the excludeFields array
            if (!excludeFields.includes(key)) {
    
                // Check if the input element exists and set its value
                if (inputElement.length) {
                    inputElement.val(value);
                }
            } else {
                if(radioInputs.includes(key)) {
                    $(`#is-active-radio`).prop('checked', value == "active");
                }
                if(dateInputs.includes(key)) {
                    this.setFlatpickrDefault(key, value);
                }
                if (selectInputs.includes(key)) {
                    const selectElement = $(`[name="${key}"]`);
                    selectElement.val(value);
                    selectElement.trigger("change");
                }
                if(key == 'harga_satuan') {
                    console.log(key, value);
                    setTimeout(() => {
                        inputElement.val(value);
                        this.hargaMask.mask(inputElement);
                    }, 10);
                }
                if(key == 'harga_beli') {
                    setTimeout(() => {
                        inputElement.val(value);
                        this.hargaMask.mask(inputElement);
                    }, 10);
                }
            }
        });

        // Initialize JenisPembayaranHargaForm using jQuery selector
        const jenisPembayaranHargaForm = new formJenisPembayaranHarga($("#container-row-jenis-pembayaran-harga"), dataHargaObat, 'data-obat ');
    }

    initForm = async () => {;
        const dataKlasifikasiObat = await getDataKlasifikasiObat();
        const dataSatuanObat = await getDataSatuanObat();
        const satuanObatOptions = dataSatuanObat.map(({ uuid_satuan_obat, satuan }) => `<option value="${uuid_satuan_obat}">${satuan}</option>`).join(' ');
        const klasifikasiObatOptions = dataKlasifikasiObat.map(({ uuid_klasifikasi_obat, klasifikasi }) => `<option value="${uuid_klasifikasi_obat}">${klasifikasi}</option>`).join(' ');
        $("#uuid-satuan-obat").append(satuanObatOptions);
        $("#uuid-klasifikasi-obat").append(klasifikasiObatOptions);

        $(".flatpickr").flatpickr({
            dateFormat: "Y-m-d", // Set the date format to yyyy-mm-dd
        });
        
        this.submitButton.off('click').on('click', () => {
            // Call the form's submit method
            console.log(this.validator);

            if (this.validator) {
                this.validator.validate().then((status) => {        
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

const formInput = new FormInput($("#form-data-obat"), $("#modal-data-obat"), $("#submit-button-data-obat"));
export { formInput };