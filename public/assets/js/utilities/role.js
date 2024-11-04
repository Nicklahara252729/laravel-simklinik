const getSideMenuByRole = async () => {
    try {
        const response = await sendApiRequest(
            {
                url: `/api/web/master-data/role`,
                type: "GET",
            },
            true
        );

        //change all link from every menu and submenu if its # to not-found
        response.data.forEach((menu) => {
            if (menu.submenu) {
                menu.submenu.forEach((submenu) => {
                    if (submenu.link === "#") {
                        submenu.link = "not-found";
                    }
                });
            }
        })
        return response.data;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

const isLinkActive = (link) => {
    const strippedLink = link.replace(window.location.origin, '').split('?')[0]; // Removes base URL and query parameters
    const strippedPath = getRelativePath().slice(1); // Gets current path without base URL and query parameters
    // console.log({strippedLink, strippedPath, isActive : strippedLink === strippedPath})
    return strippedLink === strippedPath;
};

const getRelativePath = (url = window.location.href) => {
    const parsedUrl = new URL(url);
    const pathWithoutParams = parsedUrl.pathname; // This will give you the path without query parameters or fragments
    const basePath = window.location.origin;
    const relativePath = pathWithoutParams.replace(basePath, ""); // This will give you the path relative to the base URL
    return relativePath;
};

const menuItem = ({ link, menu, icon = "", bullet = false, submenu = [] }) => {
    const hasSubmenu = submenu.length > 0;
    const isActive = isLinkActive(link);
    link = (link == '#') ? 'not-found' : link;

    const bulletHtml = bullet
        ? `<span class="menu-bullet"><span class="bullet bullet-dot"></span></span>`
        : '';

    const iconHtml = icon
        ? `<span class="menu-icon"><i class="ki-outline ki-${icon} fs-2"></i></span>`
        : '';

    const titleHtml = `<span class="menu-title">${menu}</span>`;

    if (hasSubmenu) {
        return `
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion ${isActive ? 'here hover show' : ''}">
            <span class="menu-link">
                ${bulletHtml}
                ${iconHtml}
                ${titleHtml}
                ${hasSubmenu ? '<span class="menu-arrow"></span>' : ""}
            </span>
            <div class="menu-sub menu-sub-accordion">
                ${submenu.map((submenuItem) => dotNestedElement(submenuItem)).join("")}
            </div>
        </div>`;
    } else {
        return `
        <div class="menu-item">
            <a class="menu-link ${isActive ? 'active' : ''}" href="/${link}">
                ${bulletHtml}
                ${iconHtml}
                ${titleHtml}
            </a>
        </div>`;
    }
};


const independentMenuElement = ({ link, menu, icon }) => {
    const isActive = isLinkActive(link);
    link = (link == '#') ? 'not-found' : link;

    return `
        <div class="menu-item ${isActive ? 'here show' : ''}">
            <a class="menu-link" href="/${link}">
                <span class="menu-icon">
                    <i class="ki-outline ki-${icon}  fs-2"></i>
                </span>
                <span class="menu-title">${menu}</span>
            </a>
        </div>
    `;
}

const nestedElement = ({ link, menu, icon, submenu }) =>
    menuItem({ link, menu, icon, submenu });

const dotNestedElement = ({ link, menu, submenu }) =>
    menuItem({ link, menu, bullet: true, submenu });

const dividerElement = () => `
    <div class="menu-item">
        <div class="menu-content">
            <div class="separator my-2"></div>
        </div>
    </div>
`;

const getParentLink = (submenu, menuData) => {
    for (const menu of menuData) {
        if (menu.submenu && menu.submenu.includes(submenu)) {
            return menu.link;
        }
    }
    return null;
};

const renderRole = async () => {

    try {
        const menuData = await getSideMenuByRole();
        const menuContainer = $(".menu.menu-column.menu-rounded.menu-sub-indention.fw-bold");
        menuContainer.empty();

        menuData.forEach((menu) => {
            let menuItem;
            if ((menu.menu).toLowerCase() === 'divider') {
                menuItem = dividerElement();
            } else {
                if (menu.submenu) {
                    menuItem = nestedElement(menu);
                } else {
                    menuItem = independentMenuElement(menu);
                }
            }

            menuContainer.append(menuItem);

            // Check if any submenu item is active
            const isSubmenuActive = menu.submenu && menu.submenu.some((submenuItem) => isLinkActive(submenuItem.link));

            // Add a class to the parent accordion if a submenu item is active
            if (isSubmenuActive) {
                const activeSubmenuLink = menu.submenu.find((submenuItem) => isLinkActive(submenuItem.link)).link;
                const parentAccordion = menuContainer.find(`[href="/${activeSubmenuLink}"]`).closest('.menu-item.menu-accordion');
                parentAccordion.addClass('here hover show');
            }
        });
    } catch (error) {
        console.error(error);
    }
};

// const userData = async () => {
//     try{
//         const userData = await sendApiRequest({
//             url: `/api/profil/data`,
//             type: "GET",
//         }, true)
//         const { name, photo, level } = userData.data;
//         return { name, photo, level };
//     }
//     catch(error){
//         console.error(error);
//         throw error;
//     }
// }

const renderUserData = async () => {
    const { name, photo, level } = await userData();

    const capitalizedUserName = capitalizeFirstLetter(name);
    const userPhoto = photo ? photo : "default.png";
    const capitalizedLevel = capitalizeFirstLetter(level.replace(/_/g, ' '));

    $("#user-name-menu").text(capitalizedUserName);
    $("#user-name").text(capitalizedUserName);
    $("#user-photo").attr("src", userPhoto);
    $("#user-photo-menu").attr("src", userPhoto);
    $("#user-level-menu").text(capitalizedLevel);
    $("#user-level").text(capitalizedLevel);

    if (level === "perawat" || level === "dokter") {
        const poliklinikMenu = $(".menu-item a[href='/poliklinik']");
        poliklinikMenu.find('.menu-title').text("Daftar Pasien");
    }
};

$(document).ready(async () => {
    try {
        await renderRole();
        await renderUserData();
    } catch (error) {
        console.error(error);
    }
});