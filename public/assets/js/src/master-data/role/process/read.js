const badgeIcon = (status) => {
    const color = status == "1" ? "success" : "warning";
    const icon = status == "1" ? "shield-tick" : "lock-2";
    return `
        <span class="badge d-flex badge-light-${color} badge-circle rounded border-${color} border border-dashed fw-bolder">
        <i class="ki-outline ki-${icon} text-${color}"></i>
        </span>
    `
}

const renderDataTable = (data) => {
    const table = $("#table-role").DataTable({
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
                data: null,
                render: ({ menu }) => capitalizeFirstLetter(menu)
            },
            {
                sClass: "fs-8",
                data: null,
                render: ({ link }) => link ? `<a href=${link}>${link}</a>` : `-`
            },
            {
                data: null,
                render: ({ icon }) => icon ? `<i class="ki-outline ki-${icon} fs-2"></i>` : `-`
            },
            {
                sClass: "fs-8",
                data: null,
                render: ({ parent }) => parent ? parent : "-"
            },
            {
                data: null,
                sClass: "text-center",
                render: ({ admin_dinas }) => badgeIcon(admin_dinas)
            },
            {
                data: null,
                sClass: "text-center",
                render: ({ admin_faskes }) => badgeIcon(admin_faskes)
            },
            {
                data: null,
                sClass: "text-center",
                render: ({ operator }) => badgeIcon(operator)
            },
            {
                data: null,
                sClass: "text-center",
                render: ({ dokter }) => badgeIcon(dokter)
            },
            {
                data: null,
                sClass: "text-center",
                render: ({ staff }) => badgeIcon(staff)
            },
            {
                data: null,
                sClass: "text-center",
                render: ({ pasien }) => badgeIcon(pasien)
            },
            {
                data: null,
                sClass: "text-center",
                render: ({ resepsionis }) => badgeIcon(resepsionis)
            },
            {
                data: null,
                sClass: "text-center",
                render: ({ apoteker }) => badgeIcon(apoteker)
            },
            {
                data: null,
                sClass: "text-center",
                render: ({ kasir }) => badgeIcon(kasir)
            },
            {
                data: null,
                sClass: "text-center",
                render: ({ perawat }) => badgeIcon(perawat)
            },
            {
                data: null,
                sClass: "text-center",
                orderable: false,
                render: (data) => {
                    const { uuid_role: uuidRole, menu } = data;
                    return `
                        <a href="javascript:void(0)" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-outline ki-down fs-5 ms-1"></i>    
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${uuidRole} class="menu-link px-3 edit-data-button">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${uuidRole} data-nama="${menu}" class="menu-link px-3 delete-data-button" data-kt-users-table-filter="delete_row">Delete</a>
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
        await renderDataRole()
    } catch (error) {
        console.error(error);
    }
};

const getDataRole = async () => {
    try {
        const response = await sendApiRequest({
            url: "/api/web/master-data/role/data",
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

const renderDataRole = async () => {
    const dataRole = await getDataRole();
    renderDataTable(dataRole);
}

const getDataById = async (uuidRole) => {
    try {
        const response = await sendApiRequest({
            url: `/api/web/master-data/role/get/${uuidRole}`,
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

export { renderDataRole, getAllData, getDataById, getDataRole };
