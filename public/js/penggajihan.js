document.addEventListener("DOMContentLoaded", function () {
    const btnAdd = document.getElementById("btnAddPenggajian");
    const btnEdit = document.getElementById("btnEditPenggajian");
    const btnDelete = document.getElementById("btnDeletePenggajian");
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

    // --- Tombol Tambah Penggajian ---
    if (btnAdd) {
        btnAdd.addEventListener("click", async () => {
            try {
                const response = await fetch("../../Views/Penggajihan/formAddEditPenggajihan.html");
                const html = await response.text();
                const modal = createModal(html, "modal-add");

                const title = modal.querySelector("h3");
                const submitBtn = modal.querySelector(".btn-jobdesk");
                if (title) title.textContent = "Tambah Data Penggajian";
                if (submitBtn) submitBtn.textContent = "Simpan";
            } catch (err) {
                console.error("Gagal memuat form tambah penggajian:", err);
            }
        });
    }

    // --- Tombol Edit Penggajian ---
    if (btnEdit) {
        btnEdit.addEventListener("click", async () => {
            try {
                const response = await fetch("../../Views/Penggajihan/formAddEditPenggajihan.html");
                const html = await response.text();
                const modal = createModal(html, "modal-edit");

                const title = modal.querySelector("h3");
                const submitBtn = modal.querySelector(".btn-jobdesk");
                if (title) title.textContent = "Edit Data Penggajian";
                if (submitBtn) submitBtn.textContent = "Update";

                const idInput = modal.querySelector("#idPenggajian");
                if (idInput) idInput.disabled = true;
            } catch (err) {
                console.error("Gagal memuat form edit penggajian:", err);
            }
        });
    }

    // --- Tombol Hapus Penggajian ---
    if (btnDelete) {
        btnDelete.addEventListener("click", () => {
            if (confirm("Yakin ingin menghapus data penggajian?")) {
                alert("Data penggajian berhasil dihapus (simulasi).");
            }
        });
    }
});