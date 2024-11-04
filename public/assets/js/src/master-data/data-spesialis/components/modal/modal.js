import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";

class ModalInput {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-spesialis");
        this.buttonSubmit = $("#submit-button-spesialis")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/data-spesialis/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah Spesialis");
        this.buttonSubmit.text("Simpan")
    }

    async modalEditHandler(uuidSpesialis) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/data-spesialis/update/${uuidSpesialis}`
        );
        const dataSpesialis = await getDataById(uuidSpesialis);
        this.formManager.fillForm(dataSpesialis);
        this.titleModal.text("Edit Spesialis");
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-spesialis').modal('show');
    }
}

export {ModalInput}