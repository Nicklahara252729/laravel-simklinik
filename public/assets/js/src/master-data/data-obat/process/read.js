//create me a function to render a datatable with data
const renderDataTable = (data) => {
    const table = $("#table-data-obat").DataTable({
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
                data: null,
                render : ({satuan}) => capitalizeFirstLetter(satuan)
            },
            {
                data: null,
                render : ({harga_satuan: hargaSatuan}) => `Rp. ${hargaSatuan.toLocaleString('id-ID')}`
            },
            {
                data : null,
                render : ({harga_beli: hargaBeli}) => `Rp. ${hargaBeli.toLocaleString('id-ID')}`
            },
            {
                data : "no_batch"
            },
            {
                data : "expired"
            },
            {
                data : null,
                render : ({status}) => status == "active" ? `<span class="badge badge-light-success fw-bolder">Aktif</span>` : `<span class="badge badge-light-danger fw-bolder">Tidak Aktif</span>`
            },
            {
                data: null,
                sClass: "text-center flex justify-center gap-1",
                render: (data) => {
                    const { uuid_data_obat: uuidDataObat, nama } = data;
                    return `
                        <a href="javascript:void(0)" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-outline ki-down fs-5 ms-1"></i>    
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${uuidDataObat} class="menu-link px-3 edit-data-button">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${uuidDataObat} data-nama=${nama} class="menu-link px-3 delete-data-button" data-kt-users-table-filter="delete_row">Delete</a>
                            </div>
                        </div>
                    `;
                },
            },
        ],
        drawCallback: function( settings ) {
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
        await renderDataDataObat()
    } catch (error) {
        console.error(error);
    }
};

const getDataDataObat = async () => {
    try {
        const response = await sendApiRequest({
            url: "/api/web/master-data/data-obat/data",
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        return [];
        throw error;
    }
};

const renderDataDataObat = async () => {
    const dataDataObat = await getDataDataObat();
    console.log(dataDataObat)
    renderDataTable(dataDataObat);
}

const getDataById = async (uuidDataObat) => {
    try {
        const response = await sendApiRequest({
            url: `/api/web/master-data/data-obat/get/${uuidDataObat}`,
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

export { renderDataDataObat, getAllData, getDataById, getDataDataObat };
