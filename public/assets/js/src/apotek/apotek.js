import { getAllData } from "./process/read.js"
// import { detailInit } from "./process/detail.js";

document.addEventListener("DOMContentLoaded", async () => {
    await getAllData();
    // detailInit();
})
