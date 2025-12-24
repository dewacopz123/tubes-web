function initNavbarTitle() {
  const sekLogo = document.getElementById("sek_logo");
  if (!sekLogo) return; // navbar belum dimuat

  // Ambil judul tersimpan di localStorage
  const savedTitle = localStorage.getItem("sekTitle");
  sekLogo.textContent = savedTitle ? savedTitle : "SEK DASHBOARD";

  // Tambahkan event listener ke semua menu
  const menuLinks = document.querySelectorAll(".sidebar-nav ul li a");
  menuLinks.forEach(link => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const menuName = this.querySelector("span").textContent.trim();
      const href = this.getAttribute("href");

      // Simpan ke localStorage
      localStorage.setItem("sekTitle", `SEK ${menuName.toUpperCase()}`);

      // Pindah halaman dengan sedikit delay agar tersimpan
      if (href && href !== "#") {
        setTimeout(() => {
          window.location.href = href;
        }, 100);
      }
    });
  });
}

// Jalankan setelah DOM siap
document.addEventListener("DOMContentLoaded", function () {
  // Kasus normal (navbar sudah ada)
  if (document.getElementById("sek_logo")) {
    initNavbarTitle();
  } else {
    // Navbar dimuat lewat load_navbar.js → tunggu selesai
    const observer = new MutationObserver(() => {
      if (document.getElementById("sek_logo")) {
        initNavbarTitle();
        observer.disconnect();
      }
    });
    observer.observe(document.body, { childList: true, subtree: true });
  }
});
