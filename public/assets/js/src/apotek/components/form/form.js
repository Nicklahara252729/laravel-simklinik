import { getDataTindakan } from "../../../master-data/tindakan/process/read.js";
import { getDataDiagnosa } from "../../../master-data/diagnosa/process/read.js";
import {
    optionFormat,
    renderTindakanData,
    renderDataDiagnosa,
    renderDataResep,
    optionSelectedFormat
} from './select2.js'

class FormInput {
    constructor(form, modal, button) {
        this.form = form;
        this.modal = modal;
        this.button = button;

        this.init();
    }

    enablePerawatInput(isEnable) {
        $('.perawat-input').find('select').prop('disabled', !isEnable);
    }

    showDokterInput(isShow) {
        $('.dokter-input').toggleClass('d-none', !isShow);
        $('.dokter-input').find('select').prop('disabled', !isShow);
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

        // const dataResep = await getDataResep();
        // this.renderTindakanData(dataTindakan);
        // this.renderDataDiagnosa(dataDiagnosa);
    }

    serializeArrayToSelect2(data, key) {
        return data.map((item) => itme[key]);
    }

    fillForm(data) {
        $('#perawat-input').val(this.serializeArrayToSelect2(data.tindakan_perawat, uuid_tindakan )).trigger('change');

        $('#dokter-input').val(this.serializeArrayToSelect2(data.tindakan_dokter, uuid_tindakan )).trigger('change');

        $('#diagnosa').val(this.serializeArrayToSelect2(data.diagnosa, code )).trigger('change');

        $('#resep').val(this.serializeArrayToSelect2(data.resep, id )).trigger('change');

        $('[name="keterangan"]').val(data.keterangan);
    }

    init = () => {        
        // console.log('init form input')


        // this.form.on('submit', (e) => {
        //     e.preventDefault();
        //     this.submitHandler();
        // });
    }
}

const formInput = new FormInput(
    $('#form-tahap-selanjutnya'),
    $('#modal-tahap-selanjutnya'),
    $('#submit-button-tahap-selanjutnya')
);

export { formInput };