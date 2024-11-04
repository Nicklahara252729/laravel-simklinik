// import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";
import { formInput } from "../form/form.js";

class ModalInput {
    constructor() {
        this.formManager = formInput;
        // this.titleModal = $("#title-pegawai");
        // this.buttonSubmit = $("#submit-button-pegawai")
    }

    modalAddHandler() {
        // this.formManager.setMethod("POST");
        // this.formManager.setAction("/api/web/master-data/pegawai/store");
        // this.formManager.emptyForm();
        // this.titleModal.text("Tambah Pasien");
        // this.buttonSubmit.text("Simpan")
        // $('#modal-pegawai').modal('show');
    }   

    async modalDetailHandler(uuidPasien) {
        // this.formManager.setMethod("PUT");
        // this.formManager.setAction(
        //     `/api/web/master-data/pegawai/update/${uuidPasien}`
        // );
        // $('#password-input-container').hide()
        const dataPasien = await getDataById(uuidPasien);
        this.renderDetail(dataPasien)
        // this.formManager.fillForm(dataPasien);
        // this.titleModal.text("Edit Pasien");
        // this.buttonSubmit.text("Simpan perubahan")
        const {level} = await userData();
        this.formManager.enablePerawatInput(level=='perawat')
        this.formManager.showDokterInput(level=='dokter')
        this.formManager.renderSelects()
        $('#form-diagnosa-container').toggleClass('d-none', !['dokter', 'perawat'].includes(level))
        $('#modal-detail').modal('show');
    }

    renderDetail(data){
        const {
            no_rm,
            nama_pasien,
            alamat,
            kunjungan,
            jenis_pelayanan,
            jenis_layanan,
            gender,
            gol_darah = '-',
            umur,
            status_pendaftaran,
            no_hp_1,
        } = data

        for(const key in data){
            const element = $(`#${key}`)
            console.log(element, data[key])
            if(element.length){
                element.text(data[key])
            }

            if(key=='gender'){
                this.showGender(data[key])
            }
        }
    }

    showGender(gender){
        if(gender=='laki - laki'){
            $("#is-male").removeClass('d-none')
            $("#is-female").addClass('d-none')
        }
        else{
            $("#is-male").addClass('d-none')
            $("#is-female").removeClass('d-none')
        }
    }
}

export {ModalInput}