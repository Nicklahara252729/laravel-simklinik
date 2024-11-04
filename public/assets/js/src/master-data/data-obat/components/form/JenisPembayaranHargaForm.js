import { JenisPembayaranHargaForm } from "../../../../../helpers/JenisPembayaranHargaForm.js";
import { Validator } from "../../../jenis-pembayaran/components/vaildator/validator.js";

class formJenisPembayaranHarga extends JenisPembayaranHargaForm {
    constructor(container, initData, modal) {
        super(container, initData, modal);
        this.validator = new Validator($('#form-data-obat'));
        this.validator = this.validator.validator;
    }

    tableRowComponent(counterNumber, defaultData = {}) {
        const { uuid_jenis_pembayaran: UuidJenisPembayaran = '', harga_jual: hargaJual = '' } = defaultData;
        // console.log(defaultData)
        const options = this.optionsData.map(element => {
            return `<option value="${element.uuid_jp_link_faskes}" ${element.uuid_jp_link_faskes === UuidJenisPembayaran ? 'selected' : ''}> ${element.jenis_pembayaran} </option>`;
        }).join(' ');

        return `
            <tr class="jenis-pembayaran-harga-row">
                <td class="counter-cell">${counterNumber}</td>
                <td>
                    <select class="form-select form-select-solid jenis-pembayaran" data-control="select2" data-placeholder="Pilih jenis pembayaran" name="uuid_jenis_pembayaran[]" data-dropdown-parent="#modal-${this.modal}">
                        <option></option>
                        ${options}
                    </select>
                </td>
                <td>
                    <div class="input-group input-group-solid">
                        <span class="input-group-text">Rp.</span>
                        <input inputmode="text" class="form-control form-control-solid" name="harga_jual[]" placeholder="Masukan harga jual" value="${hargaJual}" required />
                    </div>
                </td>
                <td>
                    <button class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger delete-row-button" type="button">
                        <i class="ki-outline ki-trash fs-1 p-0"></i>
                    </button>
                </td>
            </tr>
        `;
    }

    addRowComponent(defaultData) {
        const counterNumber = $('.jenis-pembayaran-harga-row').length + 1;
        const newRow = this.tableRowComponent(counterNumber, defaultData);
        this.container.append(newRow);
    
        this.container.find(".jenis-pembayaran-harga-row:last-child .jenis-pembayaran").select2();
    
        const inputMask = this.applyInputMaskToHargaJual(); // Store the Inputmask instance
    
        // Get the input field in the newly added row
        const lastRowInput = this.container.find('.jenis-pembayaran-harga-row:last-child input[name="harga_jual[]"]');
        inputMask.mask(lastRowInput)

        
        // Set the default value using the stored Inputmask instance and fetched hargaJualValue
        const hargaJualValue = defaultData.harga_jual || ''; // Fetch the value from defaultData
        inputMask.setValue(lastRowInput[0], hargaJualValue);

        this.validator.revalidateField(lastRowInput);
    }
}

export { formJenisPembayaranHarga };