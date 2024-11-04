import { RegionData } from "./RegionData.js";

class RenderRegion extends RegionData{
    constructor() {
        super();
        this.provinsiSelect = $("#provinsi");
        this.kabupatenSelect = $("#kabupaten");
        this.kecamatanSelect = $("#kecamatan");
        this.desaSelect = $("#desa");
    }

    prepareSelect = async (select) => {
        select.append(`<option value=""></option>`);
    }

    setupProvinsiSelect = async () => {
        const data = await this.getDataProvinsi();
        this.provinsiSelect.empty();
        this.prepareSelect(this.provinsiSelect);
        data.forEach((prov) => {
            const option = `<option value="${prov.id}">${prov.name}</option>`;
            this.provinsiSelect.append(option);
        });
    }

    setupKabupatenSelect = async (id_provinsi) => {
        const data = await this.getDataKabupatenByIdProvinsi(id_provinsi);
        this.kabupatenSelect.empty();   
        this.prepareSelect(this.kabupatenSelect);
        data.forEach((kab) => {
            const option = `<option value="${kab.id}">${kab.name}</option>`;
            this.kabupatenSelect.append(option);
        });
    }

    setupKecamatanSelect = async (id_kabupaten) => {
        const data = await this.getDataKecamatanByIdKabupaten(id_kabupaten);
        this.kecamatanSelect.empty();
        this.prepareSelect(this.kecamatanSelect);
        data.forEach((kec) => {
            const option = `<option value="${kec.id}">${kec.name}</option>`;
            this.kecamatanSelect.append(option);
        });
    }

    setupDesaSelect = async (id_kecamatan) => {
        const data = await this.getDataDesaByIdKecamatan(id_kecamatan);
        this.desaSelect.empty();
        this.prepareSelect(this.desaSelect);
        data.forEach((desa) => {
            const option = `<option value="${desa.id}">${desa.name}</option>`;
            this.desaSelect.append(option);
        });
    }
}

export { RenderRegion }