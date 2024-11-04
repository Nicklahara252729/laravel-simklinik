import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";
// /**
//  * differentiator Modal Add and Edit
//  */
class LaboratKategoriModalHandler {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-laborat-kategori");
        this.buttonSubmit = $("#submit-button-laborat-kategori")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/laborat-kategori/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah Laborat Kategori");
        this.buttonSubmit.text("Simpan")
    }

    async modalEditHandler(uuidLaboratKategori) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/laborat-kategori/update/${uuidLaboratKategori}`
        );
        const dataLaboratKategori = await getDataById(uuidLaboratKategori);
        this.formManager.fillForm(dataLaboratKategori);
        this.titleModal.text("Edit Laborat Kategori");
        this.buttonSubmit.text("Simpan perubahan")
        $('#modal-laborat-kategori').modal('show');
    }
}

export { LaboratKategoriModalHandler };
