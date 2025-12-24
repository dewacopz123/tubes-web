document.addEventListener("DOMContentLoaded", function () {
    const btnAddKaryawan = document.getElementById("btnAddKaryawan");
    const btnEditKaryawan = document.getElementById("btnEditKaryawan");
    const btnDeleteKaryawan = document.getElementById("btnDeleteKaryawan");
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

    if (btnAddKaryawan) {
        btnAddKaryawan.addEventListener("click", async () => {
            try {
                const response = await fetch("../../Views/DataKaryawan/formAddEditKaryawan.html");
                const html = await response.text();
                const modal = createModal(html, "modal-add");

                const title = modal.querySelector("h3");
                const submitBtn = modal.querySelector(".btn-jobdesk");
                if (title) title.textContent = "Tambah Data Karyawan";
                if (submitBtn) submitBtn.textContent = "Simpan";

            } catch (err) {
                console.error("Gagal memuat form tambah karyawan:", err);
            }
        });
    }

    if (btnEditKaryawan) {
        btnEditKaryawan.addEventListener("click", async () => {
            try {
                const response = await fetch("../../Views/DataKaryawan/formAddEditKaryawan.html");
                const html = await response.text();
                const modal = createModal(html, "modal-edit");

                const title = modal.querySelector("h3");
                const submitBtn = modal.querySelector(".btn-jobdesk");
                if (title) title.textContent = "Edit Data Karyawan";
                if (submitBtn) submitBtn.textContent = "Update";

                const idInput = modal.querySelector("#idKaryawan");
                if (idInput) idInput.disabled = true;

            } catch (err) {
                console.error("Gagal memuat form edit karyawan:", err);
            }
        });
    }

    if (btnDeleteKaryawan) {
        btnDeleteKaryawan.addEventListener("click", () => {
            if (confirm("Yakin ingin menghapus data karyawan?")) {
                alert("Fitur hapus akan diimplementasikan di versi berikutnya.");
            }
        });
    }
});
