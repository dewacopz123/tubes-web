document.addEventListener("DOMContentLoaded", function () {

    const btnMasukKerja = document.getElementById("btnMasukKerja");
    const btnKeluarKerja = document.getElementById("btnKeluarKerja");
    const popupContainer = document.getElementById("popupContainer");
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    // ================= MODAL =================
    function removeModal(id) {
        const m = document.getElementById(id);
        if (m) m.remove();
    }

    function createModal(title, message, id, reload = false) {
        removeModal(id);

        const overlay = document.createElement("div");
        overlay.id = id;
        Object.assign(overlay.style, {
            position: "fixed",
            top: 0,
            left: 0,
            width: "100vw",
            height: "100vh",
            background: "rgba(0,0,0,0.5)",
            display: "flex",
            alignItems: "center",
            justifyContent: "center",
            zIndex: 9999,
        });

        const modalBox = document.createElement("div");
        Object.assign(modalBox.style, {
            background: "#fff",
            borderRadius: "10px",
            padding: "25px",
            width: "320px",
            textAlign: "center",
        });

        modalBox.innerHTML = `
            <h3>${title}</h3>
            <p>${message}</p>
            <button id="modalOk" style="
                background:#00bcd4;
                color:white;
                border:none;
                padding:10px 25px;
                border-radius:20px;
                cursor:pointer;
                font-weight:bold;
            ">OK</button>
        `;

        overlay.appendChild(modalBox);
        popupContainer.appendChild(overlay);

        document.getElementById("modalOk").onclick = () => {
            overlay.remove();
            if (reload) location.reload();
        };
    }

    // ================= SEND ABSENSI =================
    function sendAbsensi(url, title) {
        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrf,
                "Accept": "application/json"
            }
        })
        .then(res => {
            if (!res.ok) throw new Error("Gagal");
            return res.json();
        })
        .then(() => {
            const jam = new Date().toLocaleTimeString("id-ID", {
                hour: "2-digit",
                minute: "2-digit"
            });

            createModal(
                title,
                `Berhasil pada pukul <b>${jam}</b>.`,
                "modal-absensi",
                true
            );
        })
        .catch(() => {
            createModal(
                "Gagal",
                "Terjadi kesalahan saat menyimpan data.",
                "modal-error"
            );
        });
    }

    // ================= EVENT =================
    btnMasukKerja?.addEventListener("click", () => {
        sendAbsensi("/absensi/masuk", "Masuk Kerja");
    });

    btnKeluarKerja?.addEventListener("click", () => {
        sendAbsensi("/absensi/keluar", "Selesai Kerja");
    });

});
