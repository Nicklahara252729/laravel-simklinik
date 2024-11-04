import { getDataTindakan } from "../../../master-data/tindakan/process/read.js";
import { getDataDiagnosa } from "../../../master-data/diagnosa/process/read.js";
import {
    optionFormat,
    renderTindakanData,
    renderDataDiagnosa,
    renderDataResep,
    optionSelectedFormat
} from './select2.js'

import resepInput from "./resep.js";

class FormInput {
    constructor(modal, button) {
        this.modal = modal;
        this.button = button;
        this.url = ''
        this.form = null
        this.uuidPendaftaran = null
        this.uuidDataPribadi = null
        this.level = null

        this.init();
    }

    getPostData() {
        const formData = new FormData(this.form[0]);
        
        this.level == 'perawat' && formData.set('uuid_data_pribadi', this.uuidDataPribadi);
        
        formData.set('uuid_pendaftaran', this.uuidPendaftaran);

        (this.level === 'dokter') && Array.from(document.getElementsByName('total[]')).forEach((input, index) => {
            const numericValue = parseIDR(input.value);
            formData.set(`total[${index}]`, numericValue);
        });

        return formData;
    }

    enablePerawatInput(isEnable) {
        $('#perawat-action-form').find('select').prop('disabled', !isEnable);
    }

    showDokterInput(isShow) {
        $('#dokter-action-form').toggleClass('d-none', !isShow);
        $('#dokter-action-form').find('select').prop('disabled', !isShow);
    }

    async renderSelects() {
        const dataDiagnosa = await getDataDiagnosa();
        const dataTindakan = await getDataTindakan($('#poliklinik-select').val());
        
        renderTindakanData(dataTindakan);
        renderDataDiagnosa(dataDiagnosa);

        $('#tindakan-perawat').select2({
            templateSelection: optionFormat,
            templateResult: optionFormat
        });

        $('#tindakan-dokter').select2({
            templateSelection: optionSelectedFormat,
            templateResult: optionFormat 
        });
    }

    serializeArrayToSelect2(data, key) {
        return data.map((item) => itme[key]);
    }

    async fillFormPerawat(data){
        const perawatData = data.map(item => item.uuid_tindakan);        
        // Set the default values
        $('#tindakan-perawat').val(perawatData).trigger('change').attr('disabled', true);
    }

    async emptyTindakanPerawat(){
        $('#tindakan-perawat').val(null).trigger('change').attr('disabled', false);
    }

    async fillFormDokter(data){

    }

    // fillForm(data) {
    //     $('#perawat-input').val(this.serializeArrayToSelect2(data.tindakan_perawat, uuid_tindakan )).trigger('change');

    //     $('#dokter-input').val(this.serializeArrayToSelect2(data.tindakan_dokter, uuid_tindakan )).trigger('change');

    //     $('#diagnosa').val(this.serializeArrayToSelect2(data.diagnosa, code )).trigger('change');

    //     $('#resep').val(this.serializeArrayToSelect2(data.resep, id )).trigger('change');

    //     $('[name="keterangan"]').val(data.keterangan);
    // }

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
                url: this.form.attr('action'),
                data: this.getPostData(),
                type: "POST",
            }, true);
            this.handleSuccess(response);
        } catch (e) {
            this.handleSubmitError(e);
        }
    };

    init = async () => {        
        const {level} = await userData();
        this.level = level;
        this.form = level == 'perawat' ? $('#perawat-action-form') : $('#dokter-action-form');

        this.button.on('click', () => {
            console.log('clicked')
            console.log(this.form)
            this.form.submit();
        })

        this.form.on('submit', async (e) => {
            e.preventDefault();
            await this.submitForm();
        })
    }
}

const formInput = new FormInput(
    $('#modal-tahap-selanjutnya'),
    $('#submit-tahap-selanjutnya')
);

export { formInput };