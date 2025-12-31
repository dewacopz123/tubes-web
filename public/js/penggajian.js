document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById("popupContainer");
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    function openModal(html) {
        popup.innerHTML = html;

        popup.querySelector('[data-close]').onclick = () => popup.innerHTML = '';
        handleSubmit();
    }

    // ================= TAMBAH =================
    document.getElementById("btnAddPenggajian").onclick = async () => {
        const html = await fetch('/penggajian/create').then(r => r.text());
        openModal(html);

        document.getElementById("modalTitle").innerText = "Tambah Penggajian";
        document.getElementById("mode").value = "create";
        document.getElementById("formPenggajian").reset();
    };

    // ================= EDIT =================
    document.querySelectorAll(".btnEdit").forEach(btn => {
        btn.onclick = async () => {
            const id = btn.dataset.id;

            const data = await fetch(`/penggajian/${id}`).then(r => r.json());
            const html = await fetch('/penggajian/create').then(r => r.text());

            openModal(html);

            document.getElementById("modalTitle").innerText = "Edit Penggajian";
            document.getElementById("mode").value = "edit";
            document.getElementById("penggajian_id").value = id;

            document.getElementById("karyawan_id").value = data.karyawan_id;
            document.getElementById("tanggal").value = data.tanggal;
            document.getElementById("gaji_pokok").value = data.gaji_pokok;
        };
    });

    // ================= DELETE =================
    document.querySelectorAll(".btnDelete").forEach(btn => {
        btn.onclick = async () => {
            if (!confirm("Hapus data penggajian?")) return;

            await fetch(`/penggajian/${btn.dataset.id}`, {
                method: "DELETE",
                headers: { "X-CSRF-TOKEN": csrf }
            });

            location.reload();
        };
    });

    // ================= SUBMIT =================
    function handleSubmit() {
        const form = document.getElementById("formPenggajian");

        form.onsubmit = async (e) => {
            e.preventDefault();

            const mode = document.getElementById("mode").value;
            const id = document.getElementById("penggajian_id").value;

            const data = new FormData();
            data.append("karyawan_id", document.getElementById("karyawan_id").value);
            data.append("tanggal", document.getElementById("tanggal").value);
            data.append("gaji_pokok", document.getElementById("gaji_pokok").value);

            let url = "/penggajian";
            let method = "POST";

            if (mode === "edit") {
                url += "/" + id;
                data.append("_method", "PUT");
            }

            const res = await fetch(url, {
                method: "POST",
                headers: { "X-CSRF-TOKEN": csrf },
                body: data
            });

            if (!res.ok) {
                alert("Gagal menyimpan data");
                return;
            }

            alert("Data penggajian berhasil disimpan");
            location.reload();
        };
    }
});
