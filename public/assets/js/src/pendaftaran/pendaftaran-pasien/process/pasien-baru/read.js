import { RegionMain } from "../../../../master-data/faskes/components/region/RegionMain.js";

const getAllData = async () => {
   try {
      new RegionMain()

      const dataPoliklinik = await getDataPoliklinik();
      setupPoliklinikSelect(dataPoliklinik);

      const dataJenisPembayaran = await getDataJenisPembayaran();
      setupJenisPembayaranSelect(dataJenisPembayaran);

      const dataKamar = await getDataKamar();
      setupKamarButton(dataKamar)

   } catch (error) {
      console.error(error);
   }
};

/**
 * Render data poliklinik
 */
const getDataPoliklinik = async () => {
   try {
      const response = await sendApiRequest({
         url: "/api/web/master-data/poli/data",
         type: "GET",
      }, true);

      return response.data;
   } catch (error) {
      console.error(error);
      throw error;
   }
};

const setupPoliklinikSelect = (data) => {
   const selectPoliklinik = $("#poliklinik");

   selectPoliklinik.select2({
      placeholder: "Pilih Tujuan"
   })

   if (!data) {
      console.error("data is undefined in setupPoliklinikSelect");
      return;
   }

   data.forEach((poli) => {
      const option = `<option value="${poli.uuid_poliklinik_link_klinik}">${poli.poliklinik}</option>`;
      selectPoliklinik.append(option);
   });
};

/**
 * Render data jenis pembayaran
 */

const getDataJenisPembayaran = async () => {
   try {
      const response = await sendApiRequest({
         url: "/api/web/master-data/jenis-pembayaran/data",
         type: "GET",
      }, true);
      return response.data;
   } catch (error) {
      console.error(error);
      throw error;
   }
};

const setupJenisPembayaranSelect = (data) => {
   const selectJenisPembayaran = $("#jenis-pembayaran");

   if (!data) {
      console.error("data is undefined in setupSelectJenisPembayaran");
      return;
   }

   data.forEach((jenis_pembayaran) => {
      const option = `<option value="${jenis_pembayaran.uuid_jp_link_faskes}">${jenis_pembayaran.jenis_pembayaran}</option>`;
      selectJenisPembayaran.append(option);
   });
};

/**
 * Render Data Kamar
 */

const getDataKamar = async () => {
   try {
      const response = await sendApiRequest({
         url: "/api/web/master-data/kamar/data",
         type: "GET",
      }, true);
      return response.data;
   } catch (error) {
      if (error.status === 404) return [];
      console.error(error);
      throw error;
   }
};

const getDataBedByIdKamar = async (uuid_kamar) => {
   try {
      const response = await sendApiRequest({
         url: `/api/web/master-data/kamar/get/bed/${uuid_kamar}`,
         type: "GET",
      }, true);
      return response.data;
   } catch (error) {
      console.error(error);
      throw error;
   }
};

const setupBedSelect = (data) => {
   const selectBed = $("#select-bed");
   let bedCounter = 1; // Counter variable for bed increment

   // Clear existing options in select-bed and reset bedCounter
   selectBed.empty();
   bedCounter = 1;

   // Populate select-bed with bed options and increment the counter in the bed name
   data.forEach((bed) => {
      const incrementedBedName = `Bed ${bedCounter}`;
      const option = `<option value="${bed.uuid_bed}">${incrementedBedName}</option>`;
      selectBed.append(option);
      bedCounter++;
   });
};

const setupKamarButton = (data) => {
   const setupKamar = $("#select-ruangan");

   data.forEach((data) => {
      const kamar = `<option value="${data.uuid_kamar}">${data.nama_kamar}</option>`;
      setupKamar.append(kamar);
   });

   // Add change event listener to the select-ruangan element
   setupKamar.change(async () => {
      const selectedUuidKamar = setupKamar.val();

      // Fetch data beds based on the selected uuid_kamar
      const dataBeds = await getDataBedByIdKamar(selectedUuidKamar);

      // Call the setupBedSelect function to render bed options
      setupBedSelect(dataBeds);
   });
};
export { getAllData }