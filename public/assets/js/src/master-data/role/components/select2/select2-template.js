import { icons } from "../../../../../helpers/icons.js";

const optionFormat = (item) => {
    if (!item.id) {
        return item.text;
    }

    const template = `
        <div class="d-flex align-items-center gap-3">
            <i class="ki-outline ki-${item.element.getAttribute('data-icon')} fs-6"></i>
            <div class="d-flex flex-column">
                <span class="text-muted fs-8">${item.text}</span>
            </div>
        </div>
    `;

    const span = document.createElement('span');
    span.innerHTML = template;

    return $(span);
};

const iconOptions = () => {
    return Object.keys(icons).map(category => {
        const categoryKey = category; // This is the category key
        const categoryValues = icons[category]; // This is the array of values for the current category
    
        return `
            <optgroup label="${category}">
                ${categoryValues.map(icon => {
                    return `<option value="${icon}" data-icon="${icon}">${icon}</option>`;
                })}
            </optgroup>
        `
    }).join('');
}

const parentMenuOptions = (data) => {
    return data.map(item => {
        if(item.menu != "divider"){
            return `<option value="${item.uuid_role}" data-icon="${item.icon}">${item.menu}</option>`
        }
    }).join('');
}

export {
    optionFormat,
    iconOptions,
    parentMenuOptions
}