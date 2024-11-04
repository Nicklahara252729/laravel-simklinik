import { getDataPoliklinik as getDataPoliklinikOption } from "../../master-data/poli/process/read.js";


//create me a function to render a datatable with data
const renderDataTable = async (data) => {
    const { level } = await userData();
    const table = $("#table-poliklinik").DataTable({
        info: false,
        order: [],
        lengthMenu: [10, 25, 50, 100, 150, 200, 250],
        pageLength: 10,
        responsive: {
            details: true,
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
                data: "no_pendaftaran",
            },
            {
                // width: '150px',
                data: "nama_pasien",
            },
            {
                data: "dari",
            },
            {
                data: "jenis_bayar",
            },
            {
                data: "obat",
            },
            {
                data: "status",
            },
            {
                data: "status_bridging",
            },
            // {
            //     data: null,
            //     render: ({ status_bridging }) =>
            //         status_bridging == "active"
            //             ? `<span class="badge badge-light-success fw-bolder">Aktif</span>`
            //             : `<span class="badge badge-light-danger fw-bolder">Tidak Aktif</span>`,
            // },
            // {
            //     data: null,
            //     render: ({ status_satu_sehat }) =>
            //         status_satu_sehat == "active"
            //             ? `<span class="badge badge-light-success fw-bolder">Aktif</span>`
            //             : `<span class="badge badge-light-danger fw-bolder">Tidak Aktif</span>`,
            // },
            {
                data: null,
                sClass: "text-center flex justify-center gap-1",
                render: (data) => {
                    // const { uuid_pendaftaran: uuidPoliklinik, nama, no_pendaftaran } = data;
                    // let buttons = `
                    //     <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat data pasien" class="btn btn-icon btn-light-primary action-button detail-button" data-queue="${no_pendaftaran}" data-uuid="${uuidPoliklinik}">
                    //         <i class="ki-outline ki-eye fs-2 "></i>
                    //     </button>
                    // `;
                    
                    // const canCallPatient = ['perawat'].includes(level);
                    // if (canCallPatient) {
                    //     buttons += `
                    //         <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Panggil pasien" class="btn btn-icon btn-light-success action-button call-button" data-queue="${no_pendaftaran}" data-uuid="${uuidPoliklinik}">
                    //             <i class="ki-outline ki-call fs-2 "></i>
                    //         </button>
                    //     `;
                    // }
                    
                    // return buttons;
                    return null;                    
                },
            },
        ],
        drawCallback: function (settings) {
            KTMenu.createInstances();
            $("body").tooltip({
                selector: ".action-button",
            });
        },
    });
    table.on("order.dt search.dt", function () {
        table
            .column(0, {
                search: "applied",
                order: "applied",
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
    const filterSearch = document.querySelector(
        '[data-kt-user-table-filter="search"]'
    );
    filterSearch.addEventListener("keyup", function (e) {
        table.search(e.target.value).draw();
    });

    table.on(
        "responsive-display",
        function (e, datatable, row, showHide, update) {
            KTMenu.createInstances();
            $("body").tooltip({
                selector: ".action-button",
            });
        }
    );
};

const getAllData = async () => {
    try {
        await renderDataPoliklinikSelect();
        const UUIDPoliklinikLinkKlinik = $("#poliklinik-select").val();
        console.log(UUIDPoliklinikLinkKlinik);
        await renderDataPoliklinik(UUIDPoliklinikLinkKlinik);

        $("#poliklinik-select").on("change", async (e) => {
            await renderDataPoliklinik(e.target.value);
            localStorage.setItem('selectedPoliklinik', e.target.value);
        });

        $("#date-filter").removeClass('d-none');
        $("date-filter").find('input').prop('disabled', false);

        $("#date-range-picker").on('apply.daterangepicker', async (e, picker) => {
            const dateValue = `${picker.startDate.format('YYYY/MM/DD')} - ${picker.endDate.format('YYYY/MM/DD')}`;
            await renderDataPoliklinik(UUIDPoliklinikLinkKlinik, dateValue);
        });

        cb(start, end);

        $("#date-range-picker").daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            },
            alwaysShowCalendars: true
        }, cb);

        // if(user.level == 'superadmin' || user.level == 'admin_faskes') {
        //     $("#form-diagnosa-container").removeClass('d-none');
        // }


    } catch (error) {
        console.error(error);
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

const callQueue = async (queue) => {

    const audio = new Audio('/assets/audio/bell.wav');
    audio.play();

    console.log(window.speechSynthesis.getVoices())

    setTimeout(() => {
        let msg = new SpeechSynthesisUtterance();
        msg.text = `Antrian nomor ${queue}, silahkan menuju ke ruangan dokter`;
        msg.volume = 1;   // 0.1 sampai 1
        msg.rate = 0.9;     // 0.1 sampai 10
        msg.pitch = 0.8;    // 0 sampai 2
        msg.voice = window.speechSynthesis.getVoices()[165]; 
        console.log(msg);
        window.speechSynthesis.speak(msg);
    }, 3000);

}

const getDataPoliklinik = async (UUIDPoliklinikLinkKlinik, dateValue = null) => {
    try {
        //add payload date only if its not null
        const response = await sendApiRequest(
            {
                url: `api/web/poliklinik/data/${UUIDPoliklinikLinkKlinik}`,
                type: "GET",
                data: dateValue ? { filter: dateValue } : null
            },
            true
        );
        return response.data;
    } catch (error) {
        if (error.status == 404) return [];
        console.error(error);
        throw error;
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

const renderDataPoliklinik = async (UUIDPoliklinikLinkKlinik, dateValue = null) => {
    try {
        // const dataPoliklinik = await getDataPoliklinik(UUIDPoliklinikLinkKlinik, dateValue);
        const dataApotek = []
        await renderDataTable(dataApotek);
    } catch (error) {
        console.error(error);
    }
};

const getDataById = async (uuidPoliklinik) => {
    try {
        const response = await sendApiRequest(
            {
                url: `api/web/poliklinik/get/${uuidPoliklinik}`,
                type: "GET",
            },
            true
        );
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

let start = moment();
let end = moment();

const cb = (start, end) => {
    $("#date-range-picker").html(start.format("YYYY/MM/DD") + " - " + end.format("YYYY/MM/DD"));
}



export { renderDataPoliklinik, getAllData, getDataById };
