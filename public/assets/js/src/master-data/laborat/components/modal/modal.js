import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";
// /**
//  * differentiator Modal Add and Edit
//  */
class LaboratModalHandler {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-laborat");
        this.titleFormLaboratHarga = $("#title-laborat-harga");
        this.buttonSubmit = $("#submit-button-laborat")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/laborat/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah Laborat");
        this.buttonSubmit.text("Simpan")
        this.titleFormLaboratHarga.text("Laborat Harga");
    }

    async modalEditHandler(uuidLaborat) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/laborat/update/${uuidLaborat}`
        );
        const dataLaborat = await getDataById(uuidLaborat);
        this.formManager.fillForm(dataLaborat);
        this.titleModal.text("Edit Laborat");
        this.buttonSubmit.text("Simpan perubahan")
        this.titleFormLaboratHarga.text("Edit Laborat Harga");
        $('#modal-laborat').modal('show');
    }
}

export { LaboratModalHandler };
