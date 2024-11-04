class RegionData {
    constructor() {
        this.provinsi = [];
        this.kabupaten = [];
        this.kecamatan = [];
        this.desa = [];
    }

    getDataProvinsi = async () => {
        try {
            const response = await sendApiRequest({
                url: "/api/region/provinsi/data",
                type: "GET",
            }, true);
            return response.data;
        } catch (error) {
            console.error(error);
            throw error;
        }
    };

    getDataKabupatenByIdProvinsi = async (id_provinsi) => {
        try {
            const response = await sendApiRequest({
                url: `/api/region/kota/get/id-provinsi/${id_provinsi}`,
                type: "GET",
            }, true);
            return response.data;
        } catch (error) {
            console.error(error);
            throw error;
        }
    };

    getDataKecamatanByIdKabupaten = async (id_kabupaten) => {
        try {
            const response = await sendApiRequest({
                url: `/api/region/kecamatan/get/id-kota/${id_kabupaten}`,
                type: "GET",
            }, true);
            return response.data;
        } catch (error) {
            console.error(error);
            throw error;
        }
    }

    getDataDesaByIdKecamatan = async (id_kecamatan) => {
        try {
            const response = await sendApiRequest({
                url: `/api/region/desa/get/id-kecamatan/${id_kecamatan}`,
                type: "GET",
            }, true);
            return response.data;
        } catch (error) {
            console.error(error);
            throw error;
        }
    }
}

export { RegionData }