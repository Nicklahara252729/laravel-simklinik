const optionFormat = (item) => {
    if (!item.id) {
        return item.text;
    }

    const template = `
        <div class="d-flex align-items-center gap-3">
            <div class="symbol symbol-25px symbol-circle">
                <div class="symbol-label" style="background-image:url(${item.element.getAttribute('data-image')})"></div>
            </div>
            <div class="d-flex flex-column">
                <span class="fs-6 fw-bold">${item.text}</span>
                <span class="text-muted fs-8">${item.element.getAttribute('data-email')}</span>
            </div>
        </div>
    `;

    const span = document.createElement('span');
    span.innerHTML = template;

    return $(span);
};

const optionPegawai = (data) => `
    <option value="${data.uuid_user}" data-image="${data.photo}" data-email="${data.email}">${data.name}</option>
`;

const optionPoliklinik = (data) => `
    <option value="${data.uuid_poliklinik}">${data.poliklinik}</option>
`;

export {
    optionFormat,
    optionPoliklinik,
    optionPegawai
}