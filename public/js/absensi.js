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
        .then(res => res.json())
        .then(() => {
            alert(pesan);
            location.reload();
        })
        .catch(() => alert("Terjadi kesalahan"));
    }

    btnMasuk?.addEventListener("click", () =>
        kirimAbsensi("/absensi/masuk", "Berhasil Masuk Kerja")
    );

    btnKeluar?.addEventListener("click", () =>
        kirimAbsensi("/absensi/keluar", "Berhasil Selesai Kerja")
    );
});
