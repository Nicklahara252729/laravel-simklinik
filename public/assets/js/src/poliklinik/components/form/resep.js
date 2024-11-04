import { getDataDataObat as getDataObat } from "../../../master-data/data-obat/process/read.js";

class ResepInput{
    constructor(inititalData = []){
        // run events
        this.events()

        // Get data obat from server        
        this.dataObat = null
        getDataObat().then((data) => {
            console.log(data)
            this.dataObat = data.map((item) => {
                return {
                    uuid_obat: item.uuid_data_obat,
                    nama_obat: item.nama,
                    harga: item.harga_satuan,
                }
            })

            console.log(this.dataObat)
        })

        // Render initial resep
        inititalData.map((item) => {
            this.renderResep(item)
        })
    }

    obatOptions = (defaultObat = null) => {
        return this.dataObat.map((item) => {
            return `
            <option value="${item.uuid_obat}" data-harga="${item.harga}" ${defaultObat == item.uuid_obat ? 'selected' : ''}>${item.nama_obat}</option>
            `
        }).join('')
    }

    renderResep = (data = []) => {
        const newResep = $(this.resepComponent(data));

        // Insert the new resep before the "Tambah Obat" button
        $('#add-resep').before(newResep);

        const newSelect = newResep.find('select[name="uuid_data_obat[]"]');

        newSelect.on('change', (e) => {
            this.calculateEvent(e)
        })

        const newJumlah = newResep.find('[name="jumlah[]"]');
        newJumlah.on('keyup', (e) => {
            this.calculateEvent(e)
        })
        

        // Initialize Select2 on the new select element
        newSelect.select2({
            // your select2 options
        });
    }

    resepComponent = ({uuid_data_obat = null, jumlah = null, aturan_pakai = null}) => {
        const total = formatIDR(jumlah && harga ? this.calculateTotal(jumlah, harga) : 0);
        return `
        <li class="mb-4">
            <div class="row mb-2">
                <div class="col-lg-5">
                    <select class="form-select form-select-solid" data-placeholder="Pilih obat" data-control="select2" data-close-on-select="true" name="uuid_data_obat[]" data-dropdown-parent="#modal-detail">
                        <option value=""></option>
                        ${this.obatOptions(uuid_data_obat)}
                    </select>
                </div>
                <div class="col-lg-3">
                    <input type="number" class="form-control form-control-solid" name="jumlah[]" placeholder="Jumlah" value=${jumlah ? jumlah : 1} min="1">
                </div>
                <div class="col-lg-3">
                    <input readonly class="form-control form-control-transparent" name="total[]" placeholder="Total :" value="${total}">
                </div>
                <div class="col-lg-1">
                    <button class="btn btn-sm btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger delete-row-button" type="button">
                        <i class="ki-outline ki-trash fs-1 p-0"></i>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <textarea class="form-control form-control form-control-solid" data-kt-autosize="true" name="aturan_pakai[]" placeholder="Aturan pakai" data-kt-autosize="true">${aturan_pakai ? aturan_pakai : ''}</textarea>
                </div>
            </div>
        </li>
        `
    }

    calculateTotal = (jumlah, harga) => {
        return jumlah * harga
    }

    calculateEvent = (e) => {
        const dataHarga = $(e.target).closest('.row').find('[name="uuid_data_obat[]"]').find(':selected').data('harga');
        const jumlah = $(e.target).closest('.row').find('[name="jumlah[]"]').val();
        const total = this.calculateTotal(parseInt(jumlah), dataHarga);
        console.log($(e.target).closest('.row').find('[name="total[]"]'))
        $(e.target).closest('.row').find('[name="total[]"]').val(
            formatIDR(total)
        );
    }

    events(){
        $("#add-resep").on("click", () => {
            // Create a new resep component
            this.renderResep([])
        });

        $("#resep-container").on("click", ".delete-row-button", (e) => {
            $(e.target).closest("li").remove();
        });
    }
}

const resepInput = new ResepInput();
export default resepInput;