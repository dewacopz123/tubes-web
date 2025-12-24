document.addEventListener("DOMContentLoaded", function () {
    const btnAddJobdesk = document.getElementById("btnAddJobdesk");
    const btnEditJobdesk = document.getElementById("btnEditJobdesk");
    const btnAddJobdeskKaryawan = document.getElementById("btnAddJobdeskKaryawan");
    const popupContainer = document.getElementById("popupContainer");

    function removeModal(id) {
        const m = document.getElementById(id);
        if (m) m.remove();
    }

    function createModal(html, id) {
        removeModal(id);
        const modal = document.createElement("div");
        modal.id = id;
        modal.className = "modal"; 
        modal.innerHTML = html;
        popupContainer.appendChild(modal);

        const closeBtns = modal.querySelectorAll("[data-close]");
        closeBtns.forEach(btn => btn.addEventListener("click", () => modal.remove()));

        return modal;
    }

    if (btnAddJobdesk) {
        btnAddJobdesk.addEventListener("click", async () => {
            try {
                const response = await fetch("../../Views/Jobdesk/formAddEdit.html");
                const html = await response.text();
                const modal = createModal(html, "modal-add");

                const selectInside = modal.querySelector("#selectNamaKaryawan");
                if (selectInside) selectInside.disabled = false;
            } catch (err) {
                console.error("Gagal memuat form add:", err);
            }
        });
    }

    if (btnEditJobdesk) {
        btnEditJobdesk.addEventListener("click", async () => {
            try {
                const response = await fetch("../../Views/Jobdesk/formAddEdit.html");
                const html = await response.text();
                const modal = createModal(html, "modal-edit");

                const idJobdeskElement = modal.querySelector("#idJobdesk");
                if (idJobdeskElement) {
                    idJobdeskElement.disabled = true;
                }

            } catch (err) {
                console.error("Gagal memuat form edit:", err);
            }
        });
    }
    
    if (btnAddJobdeskKaryawan) {
        btnAddJobdeskKaryawan.addEventListener("click", async () => {
            try {
                const response = await fetch("../../Views/Jobdesk/addJobdeskKaryawan.html");
                const html = await response.text();
                const modal = createModal(html, "modal-edit");

                const idJobdeskElement = modal.querySelector("#idJobdesk");
                if (idJobdeskElement) {
                    idJobdeskElement.hidden = true;
                    const labels = modal.querySelectorAll("label[for='idJobdesk']");
                    labels.forEach(label => label.hidden = true);
                }

            } catch (err) {
                console.error("Gagal memuat form edit:", err);
            }
        });
    }
    
});
