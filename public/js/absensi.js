document.addEventListener("DOMContentLoaded", function () {
    const btnMasukKerja = document.getElementById("btnMasukKerja");
    const btnKeluarKerja = document.getElementById("btnKeluarKerja");
    const csrf = document.querySelector('meta[name="csrf-token"]').content;
    const selectKaryawan = document.getElementById("selectKaryawan");

    function sendAbsensi(url, title) {
        const karyawan_id = selectKaryawan.value;

        fetch(url, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrf,
                "Accept": "application/json",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ karyawan_id })
        })
        .then(res => res.json())
        .then(data => {
            alert(`${title} berhasil untuk karyawan ID ${karyawan_id}`);
            location.reload();
        })
        .catch(err => {
            console.error(err);
            alert("Terjadi kesalahan saat menyimpan data");
        });
    }

    btnMasukKerja?.addEventListener("click", () => sendAbsensi("/absensi/masuk", "Masuk Kerja"));
    btnKeluarKerja?.addEventListener("click", () => sendAbsensi("/absensi/keluar", "Selesai Kerja"));
});
