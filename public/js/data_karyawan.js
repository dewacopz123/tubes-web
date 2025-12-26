document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById("popupContainer");
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    // ======================
    // MODAL HANDLER
    // ======================
    function openModal(html) {
        popup.innerHTML = html;

        popup.querySelectorAll('[data-close]').forEach(btn => {
            btn.onclick = () => popup.innerHTML = '';
        });

        handleSubmit();
    }

    // ======================
    // TAMBAH DATA
    // ======================
    document.getElementById("btnAddKaryawan").onclick = async () => {
        const html = await fetch('/karyawan/form').then(r => r.text());
        openModal(html);

        modalTitle.innerText = "Tambah Data Karyawan";
        btnSubmit.innerText = "Simpan";
        mode.value = "create";
        formKaryawan.reset();
    };

    // ======================
    // EDIT DATA
    // ======================
    document.querySelectorAll(".btnEdit").forEach(btn => {
        btn.onclick = async () => {
            const id = btn.dataset.id;

            const data = await fetch(`/karyawan/${id}`).then(r => r.json());
            const formHtml = await fetch('/karyawan/form').then(r => r.text());

            openModal(formHtml);

            modalTitle.innerText = "Edit Data Karyawan";
            btnSubmit.innerText = "Update";
            mode.value = "edit";
            karyawanId.value = id;

            idKaryawan.value = data.id;
            namaKaryawan.value = data.nama;
            emailKaryawan.value = data.email;
            teleponKaryawan.value = data.telepon;
            roleKaryawan.value = data.role;
            statusKaryawan.value = data.status;
        };
    });



    // ======================
    // DELETE DATA
    // ======================
    document.querySelectorAll(".btnDelete").forEach(btn => {
        btn.onclick = async () => {
            if (!confirm("Yakin hapus data?")) return;

            await fetch(`/karyawan/${btn.dataset.id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": csrf
                }
            });

            location.reload();
        };
    });


    // ======================
    // SUBMIT CREATE & EDIT
    // ======================
    function handleSubmit() {
        formKaryawan.onsubmit = async e => {
            e.preventDefault();

            const payload = {
                nama: namaKaryawan.value,
                email: emailKaryawan.value,
                telepon: teleponKaryawan.value,
                role: roleKaryawan.value,
                status: statusKaryawan.value
            };

            const url = mode.value === "create"
                ? "/karyawan"
                : `/karyawan/${karyawanId.value}`;

            const method = mode.value === "create" ? "POST" : "PUT";

            const res = await fetch(url, {
                method,
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrf
                },
                body: JSON.stringify(payload)
            });

            if (res.ok) {
                alert(`Data berhasil ${mode.value === "create" ? "disimpan" : "diupdate"}`);
                location.reload();
            }
        };
    }

    const filterNama = document.getElementById("filterNama");
    const filterRole = document.getElementById("filterRole");

    function filterTable() {
        const nama = filterNama.value.toLowerCase();
        const role = filterRole.value.toLowerCase();

        document.querySelectorAll("tbody tr").forEach(row => {
            const rowNama = row.dataset.nama || "";
            const rowRole = row.dataset.role || "";

            const cocokNama = !nama || rowNama === nama;
            const cocokRole = !role || rowRole === role;

            row.style.display = cocokNama && cocokRole ? "" : "none";
        });
    }

    filterNama.addEventListener("change", filterTable);
    filterRole.addEventListener("change", filterTable);

});
