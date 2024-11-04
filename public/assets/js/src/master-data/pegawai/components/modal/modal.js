import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";

class ModalInput {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-pegawai");
        this.buttonSubmit = $("#submit-button-pegawai")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/pegawai/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah Pegawai");
        this.buttonSubmit.text("Simpan")
        $('#password-input-container').show()
    }

    async modalEditHandler(uuidPegawai) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/pegawai/update/${uuidPegawai}`
        );
        $('#password-input-container').hide()
        const dataPegawai = await getDataById(uuidPegawai);
        this.formManager.fillForm(dataPegawai);
        this.titleModal.text("Edit Pegawai");
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-pegawai').modal('show');
    }
}

export {ModalInput}