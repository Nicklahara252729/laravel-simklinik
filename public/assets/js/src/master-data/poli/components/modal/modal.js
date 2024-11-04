import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";

class ModalInput {
    constructor(formElement) {
        this.formManager = formInput;
        this.titleModal = $("#title-poliklinik");
        this.buttonSubmit = $("#submit_button_poliklinik")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/poli/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah Poliklinik");
        this.buttonSubmit.text("Simpan")
    }

    async modalEditHandler(uuidPoliklinik) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/poli/update/${uuidPoliklinik}`
        );
        const dataPoliklinik = await getDataById(uuidPoliklinik);
        this.formManager.fillForm(dataPoliklinik);
        this.titleModal.text("Edit Poliklinik");
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-poliklinik').modal('show');
    }
}

export { ModalInput }