document.addEventListener("DOMContentLoaded", function () {
    const btnMasuk = document.getElementById("btnMasukKerja");
    const btnKeluar = document.getElementById("btnKeluarKerja");
    const csrf = document.querySelector('meta[name="csrf-token"]').content;

    function kirimAbsensi(url, pesan) {
        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrf,
                "Accept": "application/json"
            }
        })
        .then(async res => {
            const data = await res.json().catch(() => ({}));
            if (!res.ok) throw new Error(data.message || "Terjadi kesalahan");
            return data;
        })
        .then(() => {
            alert(pesan);
            location.reload();
        })
        .catch(err => alert(err.message || "Terjadi kesalahan"));
    }

    btnMasuk?.addEventListener("click", () =>
        kirimAbsensi("/absensi/masuk", "Berhasil Masuk Kerja")
    );

    btnKeluar?.addEventListener("click", () =>
        kirimAbsensi("/absensi/keluar", "Berhasil Selesai Kerja")
    );
});
