//create me a function to render a datatable with data
const renderDataTable = (data) => {
   const table = $("#table-list-pasien-rawat-inap").DataTable({
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
            data: "no_rm",
         },
         {
            data: "nama_pasien",
         },
         {
            data: "no_ktp",
         },
         {
            data: "gender",
         },
         {
            data: "no_hp",
         },
         {
            data: "alamat",
         },
         {
            data: "tanggal",
         },
         {
            data: null,
            sClass: "text-center flex justify-center gap-1",
            render: (data) => {
               const { uuid_pendaftaran: uuidPendaftaran } = data;
               return `
                     <a type="button" title="Lihat detail" class="btn btn-icon btn-light-primary action-button detail-button list-data-button" data-uuid="${uuidPendaftaran}">
                        <i class="ki-outline ki-eye fs-2 "></i>
                     </a>
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
      await renderDataPasien()
   } catch (error) {
      console.error(error);
   }
};

const getDataPasien = async () => {
   try {
      const response = await sendApiRequest({
         url: "/api/web/list-pasien/pasien-rawat-inap/data",
         type: "GET",
      }, true);
      return response.data;
   } catch (error) {
      if (error.status === 404) {
         return []
      }
      throw error;
   }
};

const getDataById = async (uuid_data_pribadi) => {
   try {
      const response = await sendApiRequest({
         url: `/api/web/list-pasien/pasien-rawat-inap/get/${uuid_data_pribadi}`,
         type: "GET",
      }, true);
      return response.data;
   } catch (error) {
      console.error(error);
      throw error;
   }
};


const renderDataPasien = async () => {
   const dataPasien = await getDataPasien();
   renderDataTable(dataPasien);
}

export { renderDataPasien, getAllData, getDataById };
