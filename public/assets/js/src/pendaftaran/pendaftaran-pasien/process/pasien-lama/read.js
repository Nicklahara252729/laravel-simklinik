const getDataPasien = async (no_rm) => {
   try {
      const response = await sendApiRequest({
         url: `/api/web/pendaftaran-pasien/get/${no_rm}`,
         type: "GET",
      }, true);
      return response.data;
   } catch (error) {
      console.error(error);
      throw error
   }
}

export { getDataPasien }
