import { RegionHandler } from "./RegionHandler.js";

class RegionMain extends RegionHandler {
    constructor() {
        super();
        this.setupProvinsiSelect();
        this.provinsiSelect.on("change", this.provinceOnChange);
        this.kabupatenSelect.on("change", this.kabupatenOnChange);
        this.kecamatanSelect.on("change", this.kecamatanOnChange);
    }

    setDefaultValue = async (
        id_provinsi,
        id_kabupaten,
        id_kecamatan,
        id_desa
    ) => {
        try {
            await this.setupProvinsiSelect();
            this.provinsiSelect.val(id_provinsi).trigger("change");

            await this.setupKabupatenSelect(id_provinsi);
            this.kabupatenSelect.val(id_kabupaten).trigger("change");

            await this.setupKecamatanSelect(id_kabupaten);
            this.kecamatanSelect.val(id_kecamatan).trigger("change");

            await this.setupDesaSelect(id_kecamatan);
            this.desaSelect.val(id_desa).trigger("change");
        } catch (error) {
            console.error("Error in setDefaultValue:", error);
        }
    };
}

export { RegionMain };
