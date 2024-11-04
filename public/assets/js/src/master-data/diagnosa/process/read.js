/**
 * Renders a DataTable with the provided data.
 *
 * @param {Array} data - The data to be displayed in the DataTable.
 */
const renderDataTable = (data) => {
    const table = $("#table-diagnosa").DataTable({
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
                data: "code",
            },
            {
                data: "diagnosa",
            },
            // {
            //     data: null,
            //     render: (data) => {
            //         const { warning } = data;
            //         const isWarning = warning == '1' ? true : false;
            //         return `<span class="badge badge-light-${isWarning ? "warning" : "success"} fw-bolder">${isWarning ? "Warning" : "No Warning"}</span>` 
            //     }
            // },
            {
                data: null,
                sClass: "text-center d-flex gap-1",
                render: (data) => {
                    const { code, diagnosa } = data;
                    return `
                        <a href="javascript:void(0)" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-outline ki-down fs-5 ms-1"></i>    
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${code} class="menu-link px-3 edit-data-button">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${code} data-nama="${diagnosa}" class="menu-link px-3 delete-data-button" data-kt-users-table-filter="delete_row">Delete</a>
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

/**
 * Fetches all data for rendering the DataTable and calls the rendering function.
 */
const getAllData = async () => {
    try {
        await renderDataDiagnosa()
    } catch (error) {
        console.error(error);
    }
};

/**
 * Fetches all data for Diagnosa.
 *
 * @returns {Array} - Array of Diagnosa data.
 * @throws Will throw an error if the API request fails.
 */
const getDataDiagnosa = async () => {
    try {
        const response = await sendApiRequest({
            url: "/api/web/master-data/diagnosa/data",
            type: "GET",
        }, true, true);
        return response.data;
    } catch (error) {
        if(error.status == 404) return [];
        console.error(error);
        throw error;
    }
};

/**
 * Fetches all data for rendering the DataTable and calls the rendering function.
 */
const renderDataDiagnosa = async () => {
    const dataDiagnosa = await getDataDiagnosa();
    renderDataTable(dataDiagnosa);
}

/**
 * Fetches Diagnosa data by its code.
 *
 * @param {string} code - The unique code of the Diagnosa.
 * @returns {Object} - Diagnosa data.
 * @throws Will throw an error if the API request fails.
 */
const getDataById = async (code) => {
    try {
        const response = await sendApiRequest({
            url: `/api/web/master-data/diagnosa/get/${code}`,
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

export { renderDataDiagnosa, getAllData, getDataById, getDataDiagnosa };
