import { getDataKamar } from "../../master-data/kamar-rawat-inap/process/read.js";

const getAllData = async () => {
   try {
      await renderDataKamar()
   } catch (error) {
      console.error(error);
   }
}

const loadDataBedByUuidKamar = async (uuid_kamar) => {
   try {
      const response = sendApiRequest({
         url: `/api/web/master-data/kamar/get/bed/${uuid_kamar}`,
         type: 'GET',
      }, true);

      return response;

   } catch (error) {
      console.log(error);
   }
}

// Function to render bed data in the modal
const renderBedDataInModal = (bedData) => {
   const bed = bedData.data
   const modalContent = document.querySelector('#modal-content');
   modalContent.innerHTML = '';

   bed.forEach((beds, index) => {

      const bedComponent = `
      <div class="col-lg-4 col-sm-6 col-12">
         <input type="radio" class="btn-check" name="bed" value="${beds.uuid_bed}" id="${beds.uuid_bed}" />
         <label class="btn btn-outline btn-outline-primary btn-active-light-primary p-7 d-flex align-items-center mb-5" for="${beds.uuid_bed}">
            <i class="fa-solid fa-bed fs-3x me-4"></i>
            <span class="d-block fw-semibold text-start">
               <span class="text-gray-900 fw-bold d-block fs-3">Bed ${index + 1}</span>
               <span class="badge badge-success">Kosong</span>
            </span>
         </label>
      </div>
      `;
      modalContent.innerHTML += bedComponent;
   });
};

// Function render data kamar 
const renderDataKamar = async () => {
   try {
      const dataKamar = await getDataKamar()
      const containerKamar = document.querySelector('#wrapper-kamar');

      dataKamar.forEach((kamar) => {
         const cardKamar = `
         <div class="col-lg-4 col-sm-6 col-12">
            <div class="card mb-4 card-kamar" id="${kamar.uuid_kamar}">
               <div class="card-body">
                  <div class="row">
                     <div class="col-lg-3 col-md-4 col-4 align-items-center d-flex">
                        <div class="d-flex flex-center rounded-circle h-60px w-60px bg-primary" id="rounded-color">
                           <i class="fa-solid fa-door-open fs-2x text-white"></i>
                        </div>
                     </div>
                     <div class="col-lg-9 col-md-6 col-6">
                        <div class="nama-kamar mt-4">
                           <h1 class="" id="nama_kamar">${kamar.nama_kamar}</h1>
                        </div>
                        <div class="jumlah-bed">
                           <span class="fs-4 text-muted">Jumlah Bed :</span> <span class="fs-4 text-muted" id="jumlah_bed">${kamar.jumlah_bed}</span>
                        </div>
                        <div class="status-kamar">
                           <span class="fs-4 text-muted">Status :</span> <span class="fs-4 text-muted" id="jumlah_bed">-</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         `

         containerKamar.innerHTML += cardKamar
      });

      const cardKamarElements = document.querySelectorAll('.card-kamar');

      cardKamarElements.forEach((card) => {
         card.addEventListener('click', async (event) => {

            const cardId = event.currentTarget.id;
            const bedData = await loadDataBedByUuidKamar(cardId);
            renderBedDataInModal(bedData);

            $('#modal-manage-kamar').modal('show')
         });
      });

      $('#modal-manage-kamar').on('hidden.bs.modal', function () {
         const modalContent = document.querySelector('#modal-content');
         modalContent.innerHTML = '';
      });

   } catch (error) {
      console.error(error);
   }
}


export { getAllData }