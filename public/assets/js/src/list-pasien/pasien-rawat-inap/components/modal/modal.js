import { getDataById } from "./../../process/read.js";

class ModalInput {
    constructor() {
        this.titleModal = $("#title-list-pasien");
        this.listPasien = $("#list-pasien")

        this.elementList = {
            no_rm: '[name="no_rm"]',
            no_ktp: '[name="no_ktp"]',
            nama_pasien: '[name="nama_pasien"]',
            tgl_lahir: '[name="tgl_lahir"]',
            alamat: '[name="alamat"]',
            email: '[name="email"]',
            gender: '[name="gender"]',
            golongan_darah: '[name="golongan_darah"]',
            no_hp_1: '[name="no_hp_1"]',
            no_hp_2: '[name="no_hp_2"]',
            nama_pj: '[name="nama_pj"]',
            no_hp: '[name="no_hp"]',
            provinsi: '[name="provinsi"]',
            kabupaten: '[name="kabupaten"]',
            kecamatan: '[name="kecamatan"]',
            desa: '[name="desa"]',
            jenis_layanan: '[name="jenis_layanan"]',
        };

        $('#modal-list-pasien-rawat-inap').on('hidden.bs.modal', () => {
            this.listPasien.show();
            this.titleModal.show();
        });
    }

    async modalListHandler(uuidDataPribadi) {
        const dataListPasien = await getDataById(uuidDataPribadi);

        Object.entries(this.elementList).forEach(([key, elementSelector]) => {
            const value = dataListPasien.data_pribadi[key]; // Updated this line

            const displayValue = (value === null || value === "") ? '-' : value;

            if (key === 'golongan_darah') {
                $(elementSelector).text(`: ${displayValue.toUpperCase()}`);
            } else {
                $(elementSelector).text(`: ${displayValue}`);
            }
        });

        this.titleModal.hide();

        Object.entries(dataListPasien.pendaftaran).forEach(([key, value]) => {
            const elementSelector = this.elementList[key];
            const displayValue = (value === null || value === "") ? '-' : value;
            $(elementSelector).text(`: ${displayValue}`);
        })

        // Additional code to display the data_pj properties
        Object.entries(dataListPasien.data_pj).forEach(([key, value]) => {
            const elementSelector = this.elementList[key];
            const displayValue = (value === null || value === "") ? '-' : value;
            $(elementSelector).text(`: ${displayValue}`);
        });

        const nestedProperties = ['provinsi', 'kabupaten', 'kecamatan', 'desa'];

        nestedProperties.forEach((nestedProperty) => {
            const nestedValue = dataListPasien.data_pj[nestedProperty]?.nama || '-';
            const nestedElementSelector = this.elementList[nestedProperty];
            $(nestedElementSelector).text(`: ${nestedValue}`);
        });

        $('#modal-list-pasien-rawat-inap').modal('show');
    }

}

export { ModalInput }