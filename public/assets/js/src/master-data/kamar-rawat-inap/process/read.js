//create me a function to render a datatable with data
const renderDataTable = (data) => {
    const table = $("#table-kamar").DataTable({
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
                data: "nama_kamar",
            },
            {
                // width: '150px',
                data: null,
                render: ({ harga }) => formatIDR(harga)
            },
            {
                data: null,
                render: (data) => {
                    const { status } = data;
                    const dataStatus = status ? "tersedia" : "tidak tersedia";
                    return `
                        <span class="badge badge-light-${status ? "success" : "danger"} fw-bolder">${status}</span>
                    `;
                },
            },
            {
                data: null,
                sClass: "text-center flex justify-center gap-1",
                render: (data) => {
                    const { uuid_kamar: uuidKamar, nama_kamar: namaKamar } = data;
                    return `
                        <a href="javascript:void(0)" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-outline ki-down fs-5 ms-1"></i>    
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid="${uuidKamar}" class="menu-link px-3 edit-data-button">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid="${uuidKamar}" data-nama="${namaKamar}" class="menu-link px-3 delete-data-button" data-kt-users-table-filter="delete_row">Delete</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid="${uuidKamar}" data-nama="${namaKamar}" class="menu-link px-3 bed-button" data-kt-users-table-filter="delete_row">Bed</a>
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
        await renderDataKamar()
    } catch (error) {
        console.error(error);
    }
};

const getDataKamar = async () => {
    try {
        const response = await sendApiRequest({
            url: "/api/web/master-data/kamar/data",
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        if(error.status === 404) return [];
        console.error(error);
        throw error;
    }
};

const renderDataKamar = async () => {
    const dataKamar = await getDataKamar();
    renderDataTable(dataKamar);
}

const getDataById = async (uuid_kamar) => {
    try {
        const response = await sendApiRequest({
            url: `/api/web/master-data/kamar/get/${uuid_kamar}`,
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

export { renderDataKamar, getAllData, getDataById, getDataKamar };
