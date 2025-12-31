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
                const response = await fetch("/jobdesk/form");
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
                const response = await fetch("/jobdesk/form");
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
                const response = await fetch("/jobdesk/form");
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


document.addEventListener("submit", async function (e) {
    if (e.target.id === "formJobdesk") {
        e.preventDefault();

        const id = document.getElementById("jobdesk_id").value;
        const formData = new FormData(e.target);

        const url = id ? `/jobdesk/${id}` : "/jobdesk";
        const method = id ? "POST" : "POST";

        if (id) formData.append("_method", "PUT");

        const res = await fetch(url, {
            method,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        });

        const data = await res.json();
        alert(data.message);
        location.reload();
    }
});


document.addEventListener("click", async function (e) {

    const editBtn = e.target.closest(".btn-edit");
    const deleteBtn = e.target.closest(".btn-delete");

    // ===== EDIT =====
    if (editBtn) {
        const row = editBtn.closest("tr");
        const id = row.dataset.id;

        console.log("EDIT CLICKED, ID:", id); // 🔍 DEBUG

        const resForm = await fetch("/jobdesk/form");
        const html = await resForm.text();
        document.getElementById("popupContainer").innerHTML = html;

        const resData = await fetch(`/jobdesk/${id}`);
        const data = await resData.json();

        document.getElementById("jobdesk_id").value = id;
        document.querySelector("[name='nama_jobdesk']").value = data.nama_jobdesk;
        document.querySelector("[name='tugas_utama']").value = data.tugas_utama;
        document.querySelector("[name='karyawan_id']").value = data.karyawan_id;

        bindModalClose();
    }

    // ===== DELETE =====
    if (deleteBtn) {
        const row = deleteBtn.closest("tr");
        const id = row.dataset.id;

        console.log("DELETE CLICKED, ID:", id); // 🔍 DEBUG

        if (!confirm("Yakin ingin menghapus jobdesk ini?")) return;

        const res = await fetch(`/jobdesk/${id}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]').content
            }
        });

        const data = await res.json();
        alert(data.message);
        location.reload();
    }
});


function bindModalClose() {
    document.querySelectorAll("[data-close]").forEach(btn => {
        btn.addEventListener("click", () => {
            document.querySelector(".modal-form-overlay")?.remove();
        });
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const jobdeskSelect = document.getElementById("searchJobdeskName");
    const karyawanSelect = document.getElementById("searchKaryawanName");
    const rows = document.querySelectorAll("#jobdeskTable tbody tr");

    // === Isi dropdown dari data tabel ===
    const jobdeskSet = new Set();
    const karyawanSet = new Set();

    rows.forEach(row => {
        jobdeskSet.add(
            row.querySelector(".col-jobdesk").innerText.trim()
        );
        karyawanSet.add(
            row.querySelector(".col-karyawan").innerText.trim()
        );
    });

    jobdeskSet.forEach(name => {
        jobdeskSelect.innerHTML += `<option value="${name}">${name}</option>`;
    });

    karyawanSet.forEach(name => {
        karyawanSelect.innerHTML += `<option value="${name}">${name}</option>`;
    });

    // === Fungsi filter ===
    function filterTable() {
        const jobdeskVal = jobdeskSelect.value;
        const karyawanVal = karyawanSelect.value;

        rows.forEach(row => {
            const jobdeskText = row.querySelector(".col-jobdesk").innerText.trim();
            const karyawanText = row.querySelector(".col-karyawan").innerText.trim();

            const matchJobdesk = !jobdeskVal || jobdeskText === jobdeskVal;
            const matchKaryawan = !karyawanVal || karyawanText === karyawanVal;

            row.style.display = (matchJobdesk && matchKaryawan) ? "" : "none";
        });
    }

    jobdeskSelect.addEventListener("change", filterTable);
    karyawanSelect.addEventListener("change", filterTable);
});
