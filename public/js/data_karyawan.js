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
    // =========================
// CRUD DATA KARYAWAN (LOCAL)
// =========================

function getKaryawanData() {
    return JSON.parse(localStorage.getItem("karyawans")) || [];
}

function saveKaryawanData(data) {
    localStorage.setItem("karyawans", JSON.stringify(data));
}

function renderTable() {
    const tbody = document.getElementById("tableBody");
    tbody.innerHTML = "";

    const data = getKaryawanData();
    data.forEach((k, index) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${k.id}</td>
            <td>${k.nama}</td>
            <td>${k.email}</td>
            <td>${k.telepon}</td>
            <td>${k.role}</td>
            <td>${k.status}</td>
        `;
        tr.dataset.index = index;
        tbody.appendChild(tr);
    });
}

// =========================
// TAMBAH & EDIT DATA
// =========================
document.addEventListener("submit", function (e) {
    if (e.target && e.target.id === "formKaryawan") {
        e.preventDefault();

        const id = document.getElementById("idKaryawan").value;
        const nama = document.getElementById("namaKaryawan").value;
        const email = document.getElementById("emailKaryawan").value;
        const telepon = document.getElementById("teleponKaryawan").value;
        const role = document.getElementById("roleKaryawan").value;
        const status = document.getElementById("statusKaryawan").value;

        let data = getKaryawanData();
        const index = data.findIndex(k => k.id === id);

        if (index >= 0) {
            // UPDATE
            data[index] = { id, nama, email, telepon, role, status };
            alert("Data karyawan berhasil diupdate");
        } else {
            // CREATE
            data.push({ id, nama, email, telepon, role, status });
            alert("Data karyawan berhasil ditambahkan");
        }

        saveKaryawanData(data);
        renderTable();
        document.querySelector(".modal")?.remove();
    }
});

// =========================
// PILIH BARIS UNTUK EDIT / DELETE
// =========================
let selectedIndex = null;

document.getElementById("tableBody").addEventListener("click", function (e) {
    const row = e.target.closest("tr");
    if (!row) return;

    selectedIndex = row.dataset.index;

    document.querySelectorAll("#tableBody tr").forEach(tr => tr.classList.remove("active"));
    row.classList.add("active");
});

// =========================
// ISI DATA SAAT EDIT
// =========================
document.getElementById("btnEditKaryawan").addEventListener("click", function () {
    if (selectedIndex === null) {
        alert("Pilih data terlebih dahulu");
        return;
    }

    setTimeout(() => {
        const data = getKaryawanData()[selectedIndex];
        if (!data) return;

        document.getElementById("idKaryawan").value = data.id;
        document.getElementById("namaKaryawan").value = data.nama;
        document.getElementById("emailKaryawan").value = data.email;
        document.getElementById("teleponKaryawan").value = data.telepon;
        document.getElementById("roleKaryawan").value = data.role;
        document.getElementById("statusKaryawan").value = data.status;
    }, 300);
});

// =========================
// HAPUS DATA
// =========================
document.getElementById("btnDeleteKaryawan").addEventListener("click", function () {
    if (selectedIndex === null) {
        alert("Pilih data terlebih dahulu");
        return;
    }

    if (confirm("Yakin ingin menghapus data karyawan?")) {
        let data = getKaryawanData();
        data.splice(selectedIndex, 1);
        saveKaryawanData(data);
        renderTable();
        selectedIndex = null;
        alert("Data karyawan berhasil dihapus");
    }
});

// =========================
// LOAD AWAL
// =========================
renderTable();

});
