import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";

class ModalInput {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-tindakan-kategori");
        this.buttonSubmit = $("#submit_button_tindakan_kategori")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/tindakan-kategori/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah kategori tindakan");
        this.buttonSubmit.text("Simpan")
    }

    async modalEditHandler(uuidTindakanKategori) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/tindakan-kategori/update/${uuidTindakanKategori}`
        );
        const dataTindakanKategori = await getDataById(uuidTindakanKategori);
        this.formManager.fillForm(dataTindakanKategori);
        this.titleModal.text("Edit kategori tindakan");
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-tindakan-kategori').modal('show');
    }
}

export { ModalInput }