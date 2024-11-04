import { RenderRegion } from "./RenderRegion.js";

class RegionHandler extends RenderRegion {
    constructor() {
        super();
        this.disableAllSelects();
    }

    disableAllSelects() {
        this.kabupatenSelect.prop("disabled", true);
        this.kecamatanSelect.prop("disabled", true);
        this.desaSelect.prop("disabled", true);
    }

    async resetAndTringgerChange(selectElements) {
        selectElements.forEach((selectElement) => {
            selectElement.val(null).trigger("change");
        });
    }

    provinceOnChange = async () => {
        const id_provinsi = this.provinsiSelect.val();
        if (id_provinsi) {
            await this.setupKabupatenSelect(id_provinsi);
            this.resetAndTringgerChange([
                this.kecamatanSelect,
                this.desaSelect,
                this.kabupatenSelect,
            ]);
    
            //enabel kabupaten select, disable kecamatan and desa select
            this.kabupatenSelect.prop("disabled", false);
            this.kecamatanSelect.prop("disabled", true);
            this.desaSelect.prop("disabled", true);
        }

    };

    kabupatenOnChange = async () => {
        const id_kabupaten = this.kabupatenSelect.val();
        if (id_kabupaten) {
            await this.setupKecamatanSelect(id_kabupaten);
            this.resetAndTringgerChange([this.desaSelect, this.kecamatanSelect]);
    
            //enable kecamatan select, disable desa select
            this.kecamatanSelect.prop("disabled", false);
            this.desaSelect.prop("disabled", true);
        }

    };

    kecamatanOnChange = async () => {
        const id_kecamatan = this.kecamatanSelect.val();
        if (id_kecamatan) {
            await this.setupDesaSelect(id_kecamatan);
            this.resetAndTringgerChange([this.desaSelect]);
            //enalbe desa select
            this.desaSelect.prop("disabled", false);
        }
    };
}

export { RegionHandler };
