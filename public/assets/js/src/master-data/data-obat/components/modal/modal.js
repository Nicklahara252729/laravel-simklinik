import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";
// /**
//  * differentiator Modal Add and Edit
//  */
class ModalInput {
    constructor() {
        this.formManager = formInput;
        this.titleModal = $("#title-data-obat");
        this.titleFormDataObatHarga = $("#title-harga");
        this.buttonSubmit = $("#submit-button-data-obat")
    }

    modalAddHandler() {
        this.formManager.setMethod("POST");
        this.formManager.setAction("/api/web/master-data/data-obat/store");
        this.formManager.emptyForm();
        this.titleModal.text("Tambah Data Obat");
        this.buttonSubmit.text("Simpan")
        this.titleFormDataObatHarga.text("Harga berdasarkan Jenis Pembayaran");
    }

    async modalEditHandler(uuidDataObat) {
        this.formManager.setMethod("PUT");
        this.formManager.setAction(
            `/api/web/master-data/data-obat/update/${uuidDataObat}`
        );
        const dataDataObat = await getDataById(uuidDataObat);
        this.formManager.fillForm(dataDataObat);
        this.titleModal.text("Edit Data Obat");
        this.buttonSubmit.text("Simpan perubahan")
        this.titleFormDataObatHarga.text("Edit Harga berdasarkan Jenis Pembayaran");
        $('#modal-data-obat').modal('show');
    }
}

export { ModalInput };
