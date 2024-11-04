const getAllData = async () => {
   try {
      const data = await getDataDashboard()
      const pasien = document.getElementById("pasien-terdaftar")
      const igd = document.getElementById("pasien-igd")
      const rawatJalan = document.getElementById("pasien-rawat-jalan")
      const rawatInap = document.getElementById("pasien-rawat-inap")

      pasien.innerHTML = data.pasien
      igd.innerHTML = data.igd
      rawatJalan.innerHTML = data.rawat_jalan
      rawatInap.innerHTML = data.rawat_inap

   } catch (error) {
      console.error(error);
   }
};

const getDataDashboard = async () => {
   try {
      const response = await sendApiRequest({
         url: "/api/web/dashboard/data",
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

export { getAllData }