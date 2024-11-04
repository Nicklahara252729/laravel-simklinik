import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";

class ModalInput {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-jenis-pembayaran");
        this.buttonSubmit = $("#submit-button-jenis-pembayaran")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/jenis-pembayaran/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah jenis pembayaran");
        this.buttonSubmit.text("Simpan")
    }

    async modalEditHandler(uuidJenisPembayaran) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/jenis-pembayaran/update/${uuidJenisPembayaran}`
        );
        const dataJenisPembayaran = await getDataById(uuidJenisPembayaran);
        this.formManager.fillForm(dataJenisPembayaran);
        this.titleModal.text("Edit jenis pembayaran");
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-jenis-pembayaran').modal('show');
    }
}

export {ModalInput}