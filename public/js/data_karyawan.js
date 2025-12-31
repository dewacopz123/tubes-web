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

        document.getElementById("modalTitle").innerText = "Tambah Data Karyawan";
        document.getElementById("btnSubmit").innerText = "Simpan";
        document.getElementById("mode").value = "create";
        document.getElementById("formKaryawan").reset();
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

            document.getElementById("modalTitle").innerText = "Edit Data Karyawan";
            document.getElementById("btnSubmit").innerText = "Update";
            document.getElementById("mode").value = "edit";
            document.getElementById("karyawanId").value = id;

            document.getElementById("namaKaryawan").value = data.nama;
            document.getElementById("emailKaryawan").value = data.email;
            document.getElementById("teleponKaryawan").value = data.telepon;
            document.getElementById("roleKaryawan").value = data.role;
            document.getElementById("statusKaryawan").value = data.status;
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
        const form = document.getElementById("formKaryawan");

        const modalTitle = document.getElementById("modalTitle");
        const btnSubmit = document.getElementById("btnSubmit");
        const mode = document.getElementById("mode");
        const karyawanId = document.getElementById("karyawanId");

        const namaKaryawan = document.getElementById("namaKaryawan");
        const emailKaryawan = document.getElementById("emailKaryawan");
        const teleponKaryawan = document.getElementById("teleponKaryawan");
        const roleKaryawan = document.getElementById("roleKaryawan");
        const statusKaryawan = document.getElementById("statusKaryawan");

        form.onsubmit = async function (e) {
            e.preventDefault();

            // =========================
            // CREATE (FormData)
            // =========================
            if (mode.value === "create") {
                const formData = new FormData();
                formData.append("nama", namaKaryawan.value);
                formData.append("email", emailKaryawan.value);
                formData.append("telepon", teleponKaryawan.value); // harus ada
                formData.append("role", roleKaryawan.value);
                formData.append("status", statusKaryawan.value);

                const res = await fetch("/karyawan", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": csrf
                    },
                    body: formData
                });

                if (!res.ok) {
                    const err = await res.text();
                    console.error(err);
                    alert("Gagal menyimpan data");
                    return;
                }

                alert("Data berhasil disimpan");
                location.reload();
                return;
            }


            // =========================
            // EDIT (JSON – BIARKAN)
            // =========================
            if (mode.value === "edit") {

                const payload = {
                    nama: namaKaryawan.value,
                    email: emailKaryawan.value,
                    telepon: teleponKaryawan.value,
                    role: roleKaryawan.value,
                    status: statusKaryawan.value
                };

                const res = await fetch(`/karyawan/${karyawanId.value}`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrf
                    },
                    body: JSON.stringify(payload)
                });

                if (!res.ok) {
                    const err = await res.text();
                    console.error(err);
                    alert("Gagal mengupdate data");
                    return;
                }

                alert("Data berhasil diupdate");
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
