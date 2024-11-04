import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";

class ModalInput {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-klasifikasi-obat");
        this.buttonSubmit = $("#submit-button-klasifikasi-obat")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/klasifikasi-obat/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah klasifikasi obat");
        this.buttonSubmit.text("Simpan")
    }

    async modalEditHandler(uuidKlasifikasiObat) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/klasifikasi-obat/update/${uuidKlasifikasiObat}`
        );
        const dataKlasifikasiObat = await getDataById(uuidKlasifikasiObat);
        this.formManager.fillForm(dataKlasifikasiObat);
        this.titleModal.text("Edit klasifikasi obat");
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-klasifikasi-obat').modal('show');
    }
}

export {ModalInput}