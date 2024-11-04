import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";

class ModalInput {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-pengguna");
        this.buttonSubmit = $("#submit-button-pengguna")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/pengguna/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah Pengguna");
        this.buttonSubmit.text("Simpan")
        this.formManager.setValidatorAdd();
        $('#password-input-container').show()
    }

    async modalEditHandler(uuidPengguna) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/pengguna/update/${uuidPengguna}`
        );
        $('#password-input-container').hide()
        const dataPengguna = await getDataById(uuidPengguna);
        this.formManager.fillForm(dataPengguna);
        this.titleModal.text("Edit Pengguna");
        this.formManager.setValidatorEdit();
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-pengguna').modal('show');
    }
}

export {ModalInput}