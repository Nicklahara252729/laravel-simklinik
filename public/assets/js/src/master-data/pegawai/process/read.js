import { getDataSpesialis } from "../../data-spesialis/process/read.js";
import { getDataKamar } from "../../kamar-rawat-inap/process/read.js";
import { getDataPoliklinik as getDataPoli } from "../../poli/process/read.js";

const renderDataTable = (data) => {
    const table = $("#table-pegawai").DataTable({
        info: false,
        order: [],
        lengthMenu: [10, 25, 50, 100, 150, 200, 250],
        pageLength: 10,
        responsive: {
            details: true
        },
        bDestroy: true,
        saveState: true,
        data: data,
        columns: [
            {
                data: null,
                width: "50px",
                sClass: "text-center",
                orderable: false,
            },
            {
                data: null,
                sClass: "d-flex my-auto gap-3 align-items-center",
                render: (data) => {
                    const {name, photo, uuid_user: uuidPegawai} = data;
                    return `
                    <a data-fslightbox="${uuidPegawai}-lightbox" href="${photo}">
                        <div class="symbol symbol-25px symbol-circle">
                            <img src="${photo}" alt=""/>
                        </div>
                    </a>
                    <div>${name}</div>
                    `
                }
            },
            {
                data: "email",
            },
            {
                data: "phone",
            },
            {
                data: null,
                render: (data) => {
                    const {level} = data;
                    // const levelColor = {
                    //     "superadmin": "success",
                    //     "admin dinas": "primary",
                    //     "admin faskes": "warning",
                    //     "operator": "danger",
                    //     "dokter": "info",
                    //     "staff": "dark",
                    //     "pasien": "secondary",
                    // }
                    return `${capitalizeFirstLetter(level)}
                    `
                }
            },
            {
                data: null,
                sClass: "text-center d-flex gap-1",
                render: (data) => {
                    const { uuid_user: uuidPegawai, name } = data;
                    return `
                        <a href="javascript:void(0)" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-outline ki-down fs-5 ms-1"></i>    
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${uuidPegawai} class="menu-link px-3 edit-data-button">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${uuidPegawai} data-nama="${name}" class="menu-link px-3 delete-data-button" data-kt-users-table-filter="delete_row">Delete</a>
                            </div>
                        </div>
                    `;
                },
            },
        ],
        drawCallback: function( settings ) {
            KTMenu.createInstances();
            refreshFsLightbox();
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

    //search event
    const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
    filterSearch.addEventListener('keyup', function (e) {
        table.search(e.target.value).draw();
    });

    table.on('responsive-display', function (e, datatable, row, showHide, update) {
        KTMenu.createInstances();
    });
};

const getAllData = async () => {
    try {
        await renderDataPegawai()
        await setupDataKamar();
        await setupDataPoli();
        await setupDataSpesialis();
        await optionBasedonRole()
    } catch (error) {
        console.error(error);
    }
};

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
        if(error.status == 404) return [];
        console.error(error);
        throw error;
    }
};

const renderDataPegawai = async () => {
    const dataPegawai = await getDataPegawai();
    renderDataTable(dataPegawai);
}

const getDataById = async (uuid_pegawai) => {
    try {
        const response = await sendApiRequest({
            url: `/api/web/master-data/pegawai/get/${uuid_pegawai}`,
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

const setupDataKamar = async () => {
    const dataKamar = await getDataKamar();
    const kamarOptions = dataKamar.map((kamar) => {
        return `
            <option value="${kamar.uuid_kamar}">${kamar.nama_kamar}</option>
        `
    }).join("");
    $("#kamar-access").append(kamarOptions)
}

const setupDataPoli = async () => {
    const dataPoli = await getDataPoli();
    const poliOptions = dataPoli.map((poli) => {
        return `
            <option value="${poli.uuid_poliklinik_link_klinik}">${poli.poliklinik}</option>
        `
    }).join("");
    $("#poli-access").append(poliOptions)
}

const setupDataSpesialis = async () => {
    const dataSpesialis = await getDataSpesialis();
    const spesialisOptions = dataSpesialis.map((spesialis) => {
        return `
            <option value="${spesialis.uuid_spesialis}">${spesialis.spesialis}</option>
        `
    }).join("");
    $("#spesialis").append(spesialisOptions)
}

const optionBasedonRole = async () => {
    const user = await userData();
    const {level} = user

    if(level == 'superadmin'){
        $("#level").append(`
            <option value="admin_faskes">Admin Faskes</option>
        `)
    }
}

export { renderDataPegawai, getAllData, getDataById, getDataPegawai };
