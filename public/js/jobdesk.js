document.addEventListener("DOMContentLoaded", function () {

    /* ===================== FILTER JOBDESK & KARYAWAN ===================== */
    const selectJobdesk = document.getElementById("searchJobdeskName");
    const selectKaryawan = document.getElementById("searchKaryawanName");
    const table = document.getElementById("jobdeskTable");
    if (table) {
        const rows = table.querySelectorAll("tbody tr");

        const jobdeskSet = new Set();
        const karyawanSet = new Set();

        rows.forEach(row => {
            const jobdeskCell = row.querySelector(".col-jobdesk");
            const karyawanCell = row.querySelector(".col-karyawan");

            if (jobdeskCell) jobdeskSet.add(jobdeskCell.textContent.trim());
            if (karyawanCell) karyawanSet.add(karyawanCell.textContent.trim());
        });

        jobdeskSet.forEach(name => {
            const opt = document.createElement("option");
            opt.value = name;
            opt.textContent = name;
            selectJobdesk.appendChild(opt);
        });

        karyawanSet.forEach(name => {
            const opt = document.createElement("option");
            opt.value = name;
            opt.textContent = name;
            selectKaryawan.appendChild(opt);
        });

        function filterTable() {
            const jobdeskVal = selectJobdesk.value;
            const karyawanVal = selectKaryawan.value;

            rows.forEach(row => {
                const jobdeskText = row.querySelector(".col-jobdesk")?.textContent.trim();
                const karyawanText = row.querySelector(".col-karyawan")?.textContent.trim();

                const matchJobdesk = !jobdeskVal || jobdeskText === jobdeskVal;
                const matchKaryawan = !karyawanVal || karyawanText === karyawanVal;

                row.style.display = (matchJobdesk && matchKaryawan) ? "" : "none";
            });
        }

        selectJobdesk.addEventListener("change", filterTable);
        selectKaryawan.addEventListener("change", filterTable);
    }

    /* ===================== CRUD JOBDESK ===================== */
    const popupContainer = document.getElementById("popupContainer");
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

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

        modal.querySelectorAll("[data-close]").forEach(btn => {
            btn.addEventListener("click", () => modal.remove());
        });

        const form = modal.querySelector("#formJobdesk");
        if (form) {
            form.addEventListener("submit", async function (e) {
                e.preventDefault();

                const jobdeskId = form.querySelector("#jobdesk_id").value;
                const formData = new FormData(form);
                const url = jobdeskId ? `/jobdesk/${jobdeskId}` : "/jobdesk";

                if (jobdeskId) formData.append("_method", "PUT");

                try {
                    const res = await fetch(url, {
                        method: "POST",
                        headers: { "X-CSRF-TOKEN": csrfToken },
                        body: formData
                    });

                    const data = await res.json();
                    alert(data.message);
                    location.reload();
                } catch (err) {
                    console.error(err);
                    alert("Gagal menyimpan jobdesk");
                }
            });
        }

        return modal;
    }

    const btnAddJobdesk = document.getElementById("btnAddJobdesk");
    if (btnAddJobdesk) {
        btnAddJobdesk.addEventListener("click", async () => {
            const res = await fetch("/jobdesk/form");
            const html = await res.text();
            createModal(html, "modal-add");
        });
    }

    document.addEventListener("click", async function (e) {
        const editBtn = e.target.closest(".btn-edit");
        if (editBtn) {
            const row = editBtn.closest("tr");
            const id = row.dataset.id;

            const resForm = await fetch("/jobdesk/form");
            const html = await resForm.text();
            const modal = createModal(html, "modal-edit");

            const resData = await fetch(`/jobdesk/${id}`);
            const data = await resData.json();

            modal.querySelector("#jobdesk_id").value = id;
            modal.querySelector("[name='nama_jobdesk']").value = data.nama_jobdesk;
            modal.querySelector("[name='tugas_utama']").value = data.tugas_utama;
            modal.querySelector("[name='karyawan_id']").value = data.karyawan_id;
        }
    });

    document.addEventListener("click", async function (e) {
        const deleteBtn = e.target.closest(".btn-delete");
        if (deleteBtn) {
            const row = deleteBtn.closest("tr");
            const id = row.dataset.id;

            if (!confirm("Yakin ingin menghapus jobdesk ini?")) return;

            const res = await fetch(`/jobdesk/${id}`, {
                method: "DELETE",
                headers: { "X-CSRF-TOKEN": csrfToken }
            });

            const data = await res.json();
            alert(data.message);
            location.reload();
        }
    });

});