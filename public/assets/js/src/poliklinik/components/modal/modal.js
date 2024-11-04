// import { formInput } from "../form/form.js";
import { getDataById } from "../../process/read.js";
import { formInput } from "../form/form.js";

class ModalInput {
    constructor() {
        this.formManager = formInput;
        // this.titleModal = $("#title-pegawai");
        // this.buttonSubmit = $("#submit-button-pegawai")
    }

    modalAddHandler() {
        // this.formManager.setMethod("POST");
        // this.formManager.setAction("/api/web/master-data/pegawai/store");
        // this.formManager.emptyForm();
        // this.titleModal.text("Tambah Pasien");
        // this.buttonSubmit.text("Simpan")
        // $('#modal-pegawai').modal('show');
    }   

    async modalDetailHandler(uuidPasien) {
        const dataPasien = await getDataById(uuidPasien);
        this.renderDetail(dataPasien)

        const {level} = await userData();
        this.perawatAction(level=='perawat')
        this.dokterAction(level=='dokter')

        //show diagnosa form if level is dokter or perawat
        $('#form-diagnosa-container').toggleClass('d-none', !['dokter', 'perawat'].includes(level))

        //resize detail cards if level is dokter or perawat
        $('#detail-cards-container').toggleClass('col-lg-12', !['dokter', 'perawat'].includes(level))

        await this.formManager.renderSelects()
        this.formManager.uuidPendaftaran = dataPasien.uuid_pendaftaran
        this.formManager.uuidDataPribadi = dataPasien.uuid_data_pribadi

        const {tindakan_perawat: tindakanPerawat} = dataPasien
        tindakanPerawat ? await this.formManager.fillFormPerawat(tindakanPerawat) : await this.formManager.emptyTindakanPerawat()

        $('#modal-detail').modal('show');
    }

    perawatAction(isPerawat){
        this.formManager.enablePerawatInput(isPerawat)
    }

    dokterAction(isDokter){
        this.formManager.url = '/api/web/poliklinik/store/dokter'
        this.formManager.showDokterInput(isDokter)
    }

    renderDetail(data){
        const {
            no_rm,
            nama_pasien,
            alamat,
            kunjungan,
            jenis_pelayanan,
            jenis_layanan,
            gender,
            gol_darah = '-',
            umur,
            status_pendaftaran,
            no_hp_1,
        } = data

        for(const key in data){
            const element = $(`#${key}`)
            // console.log(element, data[key])
            if(element.length){
                element.text(data[key])
            }

            if(key=='gender'){
                this.showGender(data[key])
            }
        }
    }

    showGender(gender){
        if(gender=='laki - laki'){
            $("#is-male").removeClass('d-none')
            $("#is-female").addClass('d-none')
        }
        else{
            $("#is-male").addClass('d-none')
            $("#is-female").removeClass('d-none')
        }
    }
}

export {ModalInput}