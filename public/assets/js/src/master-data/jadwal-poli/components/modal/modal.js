import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";

class ModalInput {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-jadwal-poli");
        this.buttonSubmit = $("#submit-button-jadwal-poli")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/jadwal-poli/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah Jadwal Poli");
        this.buttonSubmit.text("Simpan")
    }

    async modalEditHandler(uuidUser) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/jadwal-poli/update/${uuidUser}`
        );
        const dataJadwalPoli = await getDataById(uuidUser);
        this.formManager.fillForm(dataJadwalPoli);
        this.titleModal.text("Edit Jadwal Poli");
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-jadwal-poli').modal('show');
    }
}

export { ModalInput }