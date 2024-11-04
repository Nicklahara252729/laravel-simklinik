const optionFormat = (item) => {
    if (!item.id) {
        return item.text;
    }

    const template = `
        <div class="gap-3 pe-5 ">
            <div class="d-flex align-items-center justify-content-between">
                <span class="fs-6 fw-bold">${item.text}</span>
                <span class="text-muted fs-8">Rp. ${item.element.getAttribute('data-harga')}</span>
            </div>
        </div>
    `;

    const span = document.createElement('span');
    // span.classList.add('pe-5');
    span.innerHTML = template;

    return $(span);
};

const optionSelectedFormat = (item) => {
    if (!item.id) {
        return item.text;
    }

    const template = `
    <div class="d-flex justify-content-between">
        <span class="fs-6 fw-bold">${item.text}</span>
        <span class="text-muted fs-8">Rp. ${item.element.getAttribute('data-harga')}</span>
    </div>
    `;

    const span = document.createElement('span');
    span.classList.add('w-full');
    span.innerHTML = template;

    return $(span);
}


const renderTindakanData = (data) => {
    const tindakanElPerawat = $('#tindakan-perawat');
    const tindakanElDokter = $('#tindakan-dokter');
    const tindakan = data.map(({uuid_tindakan, harga, nama}) => `
        <option value="${uuid_tindakan}" data-harga="${harga}">${nama}</option>
    `).join('');
    $(tindakanElPerawat).empty().html(tindakan);
    $(tindakanElDokter).empty().html(tindakan);
}

const renderDataDiagnosa = (data) => {
    const diagnosaEl = $('#diagnosa');
    const diagnosa = data.map((item) => {
        return `<option value="${item.code}">${item.diagnosa}</option>`;
    }).join('');
    $(diagnosaEl).html(diagnosa);
}

const renderDataResep = (data) => {
    const resepEl = $('#resep');
    const resep = data.map((item) => {
        return `<option value="${item.id}">${item.nama}</option>`;
    }).join('');
    $(resepEl).html(resep);
}

export {
    optionFormat,
    renderTindakanData,
    optionSelectedFormat,
    renderDataDiagnosa,
    renderDataResep
}