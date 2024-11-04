class BedManager {
    constructor(container, uuid_kamar) {
        this.container = container;
        this.uuid_kamar = uuid_kamar;
        this.data = [];

        this.init();
    }

    render() {
        this.data.forEach((data, index) => {
            const bedComponent = this.createBedComponent(data.uuid_bed, index);
            this.container.append(bedComponent);
        });
    }

    async loadDataBedByUuidKamar(uuid_kamar) {
        const data = sendApiRequest({
            url: `/api/web/master-data/kamar/read/bed/${uuid_kamar}`,
            type: 'GET',
        }, true);
        this.data = data;   
        return data;
    }

    setUuidKamar(uuid_kamar) {
        this.uuid_kamar = uuid_kamar;
    }

    createBedComponent(uuid_bed, index) {
        const bedData = `
            <div class="col-md-3" id="bed-${uuid_bed}">
                <div class="d-flex flex-center bg-light rounded p-4 h-80px mb-1 overlay">
                    <div class="overlay-wrapper text-gray-600 d-flex gap-2 align-items-center">
                        <i class="ki-outline ki-grid fs-2x"></i> Bed ${index + 1}
                    </div>
                    <div class="overlay-layer overlay bg-gray-500 bg-opacity-25 rounded d-flex">
                        <button type="button" class="btn btn-light-danger btn-sm btn-delete-bed" data-uuid=${uuid_bed}>
                            Hapus ?
                        </button>
                    </div>
                </div>
            </div>
        `;
        return bedData;
    }

    createAddBedButton() {
        return `
            <button type="button" class="btn btn-outline btn-outline-dashed btn-outline-primary btn-active-light-primary mt-4" id="add-bed">
                <i class="ki-outline ki-plus fs-2"></i>
            </button>
        `;
    }


    successHandler() {
        swalSuccess('Data berhasil disimpan', () => {
            this.refreshDataBed();
        });
    }

    confirmDeleteBed(uuid_bed) {
        swalConfirmDelete('Anda yakin ingin menghapus bed ini ?', async () => {
            try{
                const response = await this.deleteBedApi(uuid_bed);
                if (response.status) {
                    swalSuccess(response.message, () => {
                        this.deleteBedElement(uuid_bed);
                        this.updateBedElementIndex();
                    });
                }
            }
            catch(error) {
                console.error(error);
            }
        });
    }

    async deleteBedApi(uuid_bed) {
        try{
            const response = await sendApiRequest({
                url: `/api/web/master-data/kamar/delete/bed/${uuid_bed}`,
                type: 'DELETE',
            }, true);
            return response;
        }
        catch(error) {
            console.error(error);
        }
    }

    deleteBedElement(uuid_bed) {
        $(`#bed-${uuid_bed}`).remove();
    }

    updateBedElementIndex() {
        this.container.children().each((index, element) => {
            $(element).find('.overlay-wrapper').html(`<i class="ki-outline ki-grid fs-2x"></i> Bed ${index + 1}`);
        });
    }

    async addBedApi() {
        const formData = new FormData();
        formData.append('uuid_kamar', this.uuid_kamar); 
        return sendApiRequest({
            url: `/api/web/master-data/kamar/bed/store`,
            type: 'POST',
            data: formData,
        }, true);
    }

    async refreshDataBed() {
        this.container.html('');
        await this.getDataBed();
        this.addButton = this.createAddBedButton();
        this.container.append(this.addButton);
    }

    async getDataBedById(uuid_bed) {
        try{
            return sendApiRequest({
                url: `/api/web/master-data/kamar/get/bed/${uuid_bed}`,
                type: 'GET',
            }, true);
        }
        catch(error) {
            console.error(error);
        }
    }

    async getDataBed() {
        try {
            const dataBedById = await this.getDataBedById(this.uuid_kamar);
            this.data = dataBedById.data;
            this.render();
        } catch (error) {
            console.error(error);
        }
    }

    async init() {
        if (this.uuid_kamar != null) {
            this.loadDataBedByUuidKamar(this.uuid_kamar).then(() => {
                this.render();
            });
        }

        $(document).on('click', '#add-bed', async () => {
            try {
                const response = await this.addBedApi();
                if (response.status) {
                    swalSuccess(response.message, () => {
                        this.refreshDataBed();
                    });
                }
            } catch (error) {
                console.error(error);
            }
        });

        this.container.on('click', '.btn-delete-bed', async (e) => {
            try {
                const uuid_bed = $(e.currentTarget).data('uuid');
                await this.confirmDeleteBed(uuid_bed);
            } catch (error) {
                console.error(error);
            }
        });
    }
}

const bedManager = new BedManager($('#bed-container'), null);
export { bedManager };