//create me a function to render a datatable with data
const renderDataTable = (data, tableElement) => {

    if (!tableElement || !tableElement.length) {
        console.error("Invalid table element provided.");
        return;
    }
    // Your existing DataTable initialization code
    const table = tableElement.DataTable({
        info: false,
        order: [],
        lengthMenu: [10, 25, 50, 100, 150, 200, 250],
        pageLength: 10,
        responsive: {
            details: true
        },
        bDestroy: true,
        stateSave: true,
        data: data,
        columns: [
            {
                data: null,
                width: "50px",
                sClass: "text-center",
                orderable: false,
            },
            {
                data: "poliklinik",
            },
            {
                data: "dokter",
            },
            {
                data: "jam",
            },
            {
                data: null,
                render: (data) => {
                    const { kode_antrian } = data
                    return `Antrian ke ${kode_antrian}`
                }
            },
            {
                data: "keterangan",
            },
            {
                data: null,
                sClass: "text-center d-flex gap-1",
                render: (data) => {
                    const { uuid_jadwal_poli: uuidJadwalPoli, poliklinik } = data;
                    return `
                        <a href="javascript:void(0)" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-outline ki-down fs-5 ms-1"></i>    
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${uuidJadwalPoli} class="menu-link px-3 edit-data-button">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${uuidJadwalPoli} data-poliklinik="${poliklinik}" class="menu-link px-3 delete-data-button" data-kt-users-table-filter="delete_row">Delete</a>
                            </div>
                        </div>
                    `;
                },
            },
        ],
        drawCallback: function (settings) {
            KTMenu.createInstances();
        }
    });

    table.on("order.dt search.dt", function () {
        table
            .column(0, {
                search: "applied",
                order: "applied"
            })
            .nodes()
            .each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
    });

    // update the data
    table.clear().rows.add(data).draw();

    // adjust the column sizes
    table.columns.adjust().draw();

    table.on('responsive-display', function (e, datatable, row, showHide, update) {
        KTMenu.createInstances();
    });
};

const getAllData = async () => {
    try {
        await renderDataJadwalPoli()

        // load data poliklinik
        const dataPoliklinik = await getDataPoliklinik();
        setupPoliklinikSelect(dataPoliklinik)

        // load data pegawai
        const dataPegawai = await getDataPegawai();
        setupPegawaiSelect(dataPegawai)
        setupPerawatSelect(dataPegawai)

        setupHariSelect()
    } catch (error) {
        console.error(error);
    }
};

const getDataByDay = (data, day) => {
    const lowercaseDay = day.toLowerCase();
    const foundData = data.find(item => item.hari.toLowerCase() === lowercaseDay);
    return foundData ? foundData.data : null;
};

const getDataJadwalPoli = async () => {
    try {
        // Make the API request to fetch data
        const response = await sendApiRequest({
            url: "/api/web/master-data/jadwal-poli/data",
            // headers: {
            //     uuidFaskes: getUuidFaskes(),
            // },
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        if(error.status == 404) return [];
        console.error(error);
        throw error;
    }
};

const renderDataJadwalPoli = async () => {
    try {
        const dataJadwalPoli = await getDataJadwalPoli();
        const day = ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']
        day.forEach((item) => {
            const data = getDataByDay(dataJadwalPoli, item);
            const tableElement = $(`#table-jadwal-poli-${item}`);
            renderDataTable(data, tableElement);
        })
    } catch (error) {
        console.error(error);
    }
};

const getDataById = async (uuid_jadwal_poli) => {
    try {
        const response = await sendApiRequest({
            url: `/api/web/master-data/jadwal-poli/get/${uuid_jadwal_poli}`,
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

/**
 * Get Data Poliklinik
 */
const getDataPoliklinik = async () => {
    try {
        const response = await sendApiRequest({
            url: "/api/web/master-data/poli/data",
            // headers : {
            //     uuidFaskes : getUuidFaskes(),
            // },
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

const setupPoliklinikSelect = (data) => {
    const selectPoliklinik = $("#poliklinik");
    data.forEach((pol) => {
        const option = `<option value="${pol.uuid_poliklinik}">${pol.poliklinik}</option>`;
        selectPoliklinik.append(option);
    });

    selectPoliklinik.select2({
        placeholder: "Pilih Poliklinik"
    });
};

/**
 * Get Data Poliklinik
 */
const getDataPegawai = async () => {
    try {
        const response = await sendApiRequest({
            url: "/api/web/master-data/pegawai/data",
            // headers : {
            //     uuidFaskes : getUuidFaskes(),
            // },
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

const setupPegawaiSelect = (data) => {
    const selectPegawai = $("#dokter");

    const targetLevel = "dokter";

    // Use the filter method to filter the array
    const filteredUsers = data.filter(user => user.level === targetLevel);

    filteredUsers.forEach((data) => {
        const option = `<option value="${data.uuid_user}">${data.name}</option>`;
        selectPegawai.append(option);
    });

    selectPegawai.select2({
        placeholder: "Pilih Dokter"
    });
};

const setupPerawatSelect = (data) => {
    const selectPegawai = $("#perawat");

    const targetLevel = "staff";

    // Use the filter method to filter the array
    const filteredUsers = data.filter(user => user.level === targetLevel);

    filteredUsers.forEach((data) => {
        const option = `<option value="${data.uuid_user}">${data.name}</option>`;
        selectPegawai.append(option);
    });

    selectPegawai.select2({
        placeholder: "Pilih Perawat",
    });
};

const setupHariSelect = () => {
    const days = ['', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu']
    const selectHari = $("#hari");

    days.forEach((day, index) => {
        const capitalizedDay = day.charAt(0).toUpperCase() + day.slice(1);
        const option = `<option value="${day}">${capitalizedDay}</option>`;
        selectHari.append(option);
    });

    selectHari.select2({
        minimumResultsForSearch: Infinity,
        placeholder: "Pilih Hari"
    });
};

// Event listener for Bootstrap tab shown event
$('.nav-link[data-bs-toggle="tab"]').on('shown.bs.tab', async function (event) {
    $.fn.dataTable
    .tables( { api: true } )
    .columns.adjust();

});


export { renderDataJadwalPoli, getAllData, getDataById };
