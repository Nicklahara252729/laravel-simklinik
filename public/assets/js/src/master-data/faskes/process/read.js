import { getDataPengguna } from "../../pengguna/process/read.js";
import { optionPegawai } from "../components/select2/select2-template.js";
import { getDataPoliklinik } from "../../poli/process/read.js";
import { getDataJenisPembayaran } from "../../jenis-pembayaran/process/read.js";

//create me a function to render a datatable with data
const renderDataTable = (data) => {
    const table = $("#table-faskes").DataTable({
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
                // width: '250px',
                data: "kode",
            },
            {
                // width: '150px',
                data: "nama",
            },
            {
                data: "no_faskes",
            },
            {
                data: "alamat",
            },
            {
                data: "kode_pos"
            },
            {
                data: null,
                sClass: "text-center flex justify-center gap-1",
                render: (data) => {
                    const { uuid_faskes: uuidFaskes, nama } = data;
                    return `
                        <a href="javascript:void(0)" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-outline ki-down fs-5 ms-1"></i>    
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${uuidFaskes} class="menu-link px-3 edit-data-button">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${uuidFaskes} data-nama="${nama}" class="menu-link px-3 delete-data-button" data-kt-users-table-filter="delete_row">Delete</a>
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
        await renderDataFaskes();
        await renderDataPengguna();

        
        // load data poliklinik
        const dataPoliklinik = await getDataPoliklinik();
        setupPoliklinikSelect(dataPoliklinik)

        //load data jenis pembayaran
        const dataJenisPembayaran = await getDataJenisPembayaran();
        setupJenisPembayaranSelect(dataJenisPembayaran)
    } catch (error) {
        console.error(error);
    }
};

const getDataFaskes = async () => {
    try {
        const response = await sendApiRequest({
            url: "/api/web/master-data/faskes/data",
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

const renderDataFaskes = async () => {
    const dataFaskes = await getDataFaskes();
    renderDataTable(dataFaskes);
}

const getDataById = async (uuid_faskes) => {
    try {
        const response = await sendApiRequest({
            url: `/api/web/master-data/faskes/get/${uuid_faskes}`,
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

const renderDataPengguna = async () => {
    const dataPengguna = await getDataPengguna();
    $("#user-input").append(`
        ${dataPengguna.map((data) => optionPegawai(data)).join("")}
    `)
}

const setupPoliklinikSelect = (data) => {
    const selectPoliklinik = $("#poliklinik_link");

    data.forEach((poli) => {
        const option = `<option value="${poli.uuid_poliklinik}">${poli.poliklinik}</option>`;
        selectPoliklinik.append(option);
    });
};

const setupJenisPembayaranSelect = (data) => {
    const selectJenisPembayaran = $("#jenis_pembayaran_link");

    data.forEach((jenisPembayaran) => {
        const option = `<option value="${jenisPembayaran.uuid_jenis_pembayaran}">${jenisPembayaran.jenis_pembayaran}</option>`;
        selectJenisPembayaran.append(option);
    });
};

export { renderDataFaskes, getAllData, getDataById };