import { getAllData } from "./process/read.js";

$(document).ready(async () => {
    await getAllData();
})
