document.addEventListener("DOMContentLoaded", function () {
    const btnMasukKerja = document.getElementById("btnMasukKerja");
    const btnKeluarKerja = document.getElementById("btnKeluarKerja");
    const popupContainer = document.getElementById("popupContainer");

    // Hapus modal jika ada
    function removeModal(id) {
        const m = document.getElementById(id);
        if (m) m.remove();
    }

    // Buat modal dengan gaya seperti contoh
    function createModal(title, message, id) {
        removeModal(id);

        // Overlay gelap transparan
        const overlay = document.createElement("div");
        overlay.id = id;
        Object.assign(overlay.style, {
            position: "fixed",
            top: "0",
            left: "0",
            width: "100vw",
            height: "100vh",
            backgroundColor: "rgba(0,0,0,0.5)",
            display: "flex",
            alignItems: "center",
            justifyContent: "center",
            zIndex: "1000",
        });

        // Kotak modal
        const modalBox = document.createElement("div");
        Object.assign(modalBox.style, {
            backgroundColor: "#fff",
            borderRadius: "10px",
            padding: "25px 30px",
            width: "320px",
            boxShadow: "0 4px 10px rgba(0,0,0,0.2)",
            textAlign: "center",
            fontFamily: "Arial, sans-serif",
        });

        // Judul
        const modalTitle = document.createElement("h2");
        modalTitle.textContent = title;
        Object.assign(modalTitle.style, {
            marginTop: "0",
            marginBottom: "20px",
            fontSize: "20px",
            fontWeight: "bold",
        });

        // Isi pesan
        const modalMsg = document.createElement("p");
        modalMsg.innerHTML = message;
        Object.assign(modalMsg.style, {
            fontSize: "15px",
            marginBottom: "25px",
            lineHeight: "1.4",
        });

        // Tombol kontainer
        const buttonContainer = document.createElement("div");
        Object.assign(buttonContainer.style, {
            display: "flex",
            justifyContent: "space-around",
            gap: "10px",
        });

        // Tombol Tutup (merah)
        const btnClose = document.createElement("button");
        btnClose.textContent = "Tutup";
        Object.assign(btnClose.style, {
            backgroundColor: "#f44336",
            color: "white",
            border: "none",
            borderRadius: "20px",
            padding: "10px 25px",
            cursor: "pointer",
            fontWeight: "bold",
        });
        btnClose.addEventListener("click", () => overlay.remove());

        // Tombol OK (biru)
        const btnOk = document.createElement("button");
        btnOk.textContent = "OK";
        Object.assign(btnOk.style, {
            backgroundColor: "#00bcd4",
            color: "white",
            border: "none",
            borderRadius: "20px",
            padding: "10px 25px",
            cursor: "pointer",
            fontWeight: "bold",
        });
        btnOk.addEventListener("click", () => overlay.remove());

        buttonContainer.appendChild(btnOk);
        buttonContainer.appendChild(btnClose);

        // Susun elemen modal
        modalBox.appendChild(modalTitle);
        modalBox.appendChild(modalMsg);
        modalBox.appendChild(buttonContainer);
        overlay.appendChild(modalBox);
        popupContainer.appendChild(overlay);
    }

    // Event: Masuk Kerja
    if (btnMasukKerja) {
        btnMasukKerja.addEventListener("click", () => {
            const now = new Date();
            const jam = now.toLocaleTimeString("id-ID", { hour: "2-digit", minute: "2-digit" });
            createModal("Masuk Kerja", `Anda telah masuk kerja pada pukul <b>${jam}</b>.`, "modal-masuk");
        });
    }

    // Event: Keluar Kerja
    if (btnKeluarKerja) {
        btnKeluarKerja.addEventListener("click", () => {
            const now = new Date();
            const jam = now.toLocaleTimeString("id-ID", { hour: "2-digit", minute: "2-digit" });
            createModal("Selesai Kerja", `Anda telah selesai kerja pada pukul <b>${jam}</b>.`, "modal-keluar");
        });
    }
});
