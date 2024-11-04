import { renderDataFaskes } from "./../../process/read.js";
import { FormManager } from "../../../../../helpers/FormManager.js";
import { RegionMain } from "../region/RegionMain.js";
import { MapHandler } from "../leafletmap/Map.js";
import { optionFormat } from "../select2/select2-template.js";
import defaultValidator from "./validator.js";

class FormInput extends FormManager{
    constructor(formElement, modalElement, submitButtonElement) {
        super(formElement, modalElement, submitButtonElement);
        this.selectFields = ['id_provinsi', 'id_kabupaten', 'id_kecamatan', 'id_desa']
        this.initForm();
        this.regionManager = new RegionMain();
        this.mapHandler = new MapHandler();
        this.mapHandler.initMap();
        this.mapHandler.map.invalidateSize();
    }

    getPostData = () => {
        const formData = this.getFormData();

        // append poliklinik_link
        const poliklinik_link = $('#poliklinik_link').val();
        poliklinik_link.forEach((poli) => {
            if (poli != null){
                formData.append('uuid_poliklinik[]', poli);
            }
        })

        const jenis_pembayaran_link = $('#jenis_pembayaran_link').val();
        jenis_pembayaran_link.forEach((jenisPembayaran) => {
            if (jenisPembayaran != null){
                formData.append('uuid_jenis_pembayaran[]', jenisPembayaran);
            }
        })

        return formData;
    }

    getPutData = () => {
        const formData = this.getPostData();
        formData.append("_method", "PUT");
        return formData;
    }

    setDropifyimage = (inputName , image) => {
        $(`[name=${inputName}] , .dropify-wrapper`).remove();
                
        const html = `<input type="file" id="imageInput" name="logo" class="dropify form-control" data-max-file-size="5M"  data-height="200" required=""
        data-default-file='${image}' />`;
        $('#logo-container').append(html);
        $(`[name=${inputName}]`).dropify(dropfiyConfig);
        console.log($(`[name=${inputName}]`))
    }


    fillForm(data) {
        this.emptyForm();
        
        const excludeFields = [...this.selectFields, 'logo']

        $.each(data, (key, value) => {
            if (!excludeFields.includes(key)) {
                const inputElement = $(`[name="${key}"]`);
    
                // Check if the input element exists and set its value
                if (inputElement.length) {
                    inputElement.val(value);
                }
            }
            if (key == 'logo') {
                const image = value;
                const inputName = key;
                this.setDropifyimage(inputName, image);
            }
        });

        $('#user-input').val(data.uuid_user).trigger('change');

        const poliklinik_link = data.poliklinik_link_klinik;
        if(poliklinik_link){
            const poliklinik_link_klinik_value = poliklinik_link.map((poli) => poli.uuid_poliklinik);
            $('#poliklinik_link').val(poliklinik_link_klinik_value).trigger('change');
        }

        const jenis_pembayaran_link = data.jenis_pembayaran_link_klinik;
        if(jenis_pembayaran_link){
            const jenis_pembayaran_link_klinik_value = jenis_pembayaran_link.map((jenisPembayaran) => jenisPembayaran.uuid_jenis_pembayaran);
            $('#jenis_pembayaran_link').val(jenis_pembayaran_link_klinik_value).trigger('change');
        }


        const { id_provinsi, id_kabupaten, id_kecamatan, id_desa } = data;
        this.regionManager.setDefaultValue(id_provinsi, id_kabupaten, id_kecamatan, id_desa);

        const { latitude, longitude } = data;
        this.mapHandler.setMapView(latitude, longitude);
    }
    
    handleSuccessResponse = async (response) => {
        swalSuccess(response.message, async () => {
            renderDataFaskes();
            this.modal.modal("hide");
            this.emptyForm();
        });
    };

    submitForm =  async () => {
        try {
            // Request endpoint create data tindakan
            const response = await sendApiRequest(
                {
                    url: this.getAction(),
                    data: this.getMethod() == "POST" ? this.getPostData() : this.getPutData(),
                    type: "POST",
                },
                true
            );
            this.handleSuccess(response);
        } catch (e) {
            this.handleSubmitError(e);
        }
    }

    emptyForm = () => {
        this.form[0].reset();
        $('.dropify-clear').trigger('click');
        this.mapHandler.setDefaultView();
        this.selectFields.forEach((field) => {
            $(`select[name=${field}]`).val(null).trigger('change');
        })
        $("#user-input").val(null).trigger('change');
        $("#poliklinik_link").val(null).trigger('change');
        $("#jenis_pembayaran_link").val(null).trigger('change');
        defaultValidator.resetForm(true);
    }

    initForm = () => {

        const pegawaiSelect = $("#user-input");
        pegawaiSelect.select2({
            allowClear: false,
            minimumResultsForSearch: 5,
            templateSelection: optionFormat,
            templateResult: optionFormat
        });

        pegawaiSelect.on('change', (e) => {
            defaultValidator.revalidateField('uuid_user');
        });

        $("#provinsi").on('change', (e) => {
            defaultValidator.revalidateField('id_provinsi');
        });

        $("#kabupaten").on('change', (e) => {
            defaultValidator.revalidateField('id_kabupaten');
        });

        $("#kecamatan").on('change', (e) => {
            defaultValidator.revalidateField('id_kecamatan');
        });

        $("#desa").on('change', (e) => {
            defaultValidator.revalidateField('id_desa');
        });

        $("#poliklinik_link").on('change', (e) => {
            defaultValidator.revalidateField('poliklinik');
        });

        $("#jenis_pembayaran_link").on('change', (e) => {
            defaultValidator.revalidateField('jenis_pembayaran');
        });

        $("#longitude").on('change', (e) => {
            defaultValidator.revalidateField('longitude');
        });

        this.submitButton.off('click').on('click', () => {
            //validate with validators
            if (defaultValidator) {
                defaultValidator.validate().then((status) => {
                    if (status === 'Valid') {
                        this.form.submit();
                    } else {
                        const formElements = defaultValidator.elements;

                        Object.keys(formElements).forEach(fieldName => {
                            const field = formElements[fieldName];
                            defaultValidator.validateField(fieldName).then(result => {
                                if (result === 'Invalid') {
                                    console.log(`Field '${fieldName}' tidak valid`);
                                    const errorMessages = defaultValidator.getMessages(field);
                                    console.log('Pesan kesalahan:', errorMessages);
                                }
                            });
                        });
                        
                    }
                });
            }
            

            // Call the form's submit method if validation passes
        });

        this.form.off("submit").on("submit", (e) => {
            e.preventDefault();
            this.submitForm(true);
        });
        
    }
}

const FormInputHandler = new FormInput($("#form-faskes"), $("#modal-faskes"), $("#submit-button-faskes"));
export { FormInput, FormInputHandler };