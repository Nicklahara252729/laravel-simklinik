import { getDataPoliklinik as getDataPoliklinikOption } from "../../poli/process/read.js";

//create me a function to render a datatable with data
const renderDataTable = (data) => {
    const table = $("#table-tindakan").DataTable({
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
                data: "kategori",
            },
            {
                data: null,
                render: ({ harga }) => formatIDR(harga)
            },
            {
                data: null,
                sClass: "text-center flex justify-center gap-1",
                render: (data) => {
                    const { uuid_tindakan: uuidTindakan, nama } = data;
                    return `
                        <a href="javascript:void(0)" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                            <i class="ki-outline ki-down fs-5 ms-1"></i>    
                        </a>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${uuidTindakan} class="menu-link px-3 edit-data-button">Edit</a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" data-uuid=${uuidTindakan} data-nama="${nama}" class="menu-link px-3 delete-data-button" data-kt-users-table-filter="delete_row">Delete</a>
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
        $("#poliklinik-select").on("change", async (e) => {
            await renderDataTindakan();
            localStorage.setItem('selectedPoliklinik', e.target.value);
        });

        await renderDataPoliklinikSelect();

        const dataTindakanKategori = await getDataTindakanKategori();
        setupTindakanKategoriSelect(dataTindakanKategori.data);


        await renderDataTindakan();
        
        
    } catch (error) {
        console.error(error);
    }
};

const getDataTindakan = async (poliklinik) => {
    try {
        const response = await sendApiRequest({
            url: `/api/web/master-data/tindakan/data/${poliklinik}`,
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        if(error.status === 404){
            // swalError(error.responseJSON.message)
            return []
        }
        console.error(error.satus);
        throw error;
    }
};

const setDefaultSelect2Value = () => {
    const storedValue = localStorage.getItem('selectedPoliklinik');
    const $poliklinikSelect = $('#poliklinik-select');

    if (storedValue) {
        $poliklinikSelect.val(storedValue).trigger('change');
    } else {
        // If no value is stored or if an error occurs, select the second option
        $poliklinikSelect.val($poliklinikSelect.find('option:eq(0)').val()).trigger('change');
    }
};

const renderDataPoliklinikSelect = async () => {
    try {
        const dataPoliklinik = await getDataPoliklinikOption();
        console.log(dataPoliklinik);

        const optionsHTML = dataPoliklinik.map(({ uuid_poliklinik_link_klinik, poliklinik }) =>
            `<option value="${uuid_poliklinik_link_klinik}">${poliklinik}</option>`
        ).join('');


        $("#poliklinik-select").html(optionsHTML);

        // Set default value for Select2 after rendering options
        setDefaultSelect2Value();
    } catch (error) {
        console.error(error);
        // If an error occurs while fetching data, set the default value to the second option
        $('#poliklinik-select').val($('#poliklinik-select').find('option:eq(1)').val()).trigger('change');
    }
};

const renderDataPoliklinik = async (UUIDPoliklinikLinkKlinik) => {
    try {
        const dataPoliklinik = await getDataPoliklinik(UUIDPoliklinikLinkKlinik);
        renderDataTable(dataPoliklinik);
    } catch (error) {
        console.error(error);
    }
};

const renderDataTindakan = async () => {
    const poliklinik = $("#poliklinik-select").val();
    const dataTindakan = await getDataTindakan(poliklinik);
    renderDataTable(dataTindakan);
}

const getDataTindakanKategori = async () => {
    try {
        const response = await sendApiRequest({
            url: "/api/web/master-data/tindakan-kategori/data/",
            type: "GET",
        }, true);
        return response;
    } catch (error) {
        if(error.status === 404){
            // swalError(error.responseJSON.message)
            return []
        }
        console.error(error.satus);
        throw error;
    }
};

const setupTindakanKategoriSelect = (data) => {
    const selectTindakanKategori = $("#kategori_tindakan");

    data.forEach((item) => {
        const option = `<option value="${item.uuid_tindakan_kategori}">${item.kategori}</option>`;
        selectTindakanKategori.append(option);
    });
};

const getDataById = async (uuid_tindakan) => {
    try {
        const response = await sendApiRequest({
            url: `/api/web/master-data/tindakan/get/${uuid_tindakan}`,
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

const getDataPoliklinik = async () => {
    try {
        const response = await sendApiRequest({
            url: "/api/web/master-data/poli/data",
            type: "GET",
        }, true);
        return response.data;
    } catch (error) {
        if(error.status === 404) return [];
        console.error(error);
        throw error;
    }
};

export { renderDataTindakan, getAllData, getDataById, getDataTindakan };
