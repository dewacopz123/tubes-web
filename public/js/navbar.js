function initNavbarTitle() {
  const sekLogo =
    document.getElementById("sek_logo") ||
    document.querySelector(".logo-text");

  if (!sekLogo) return;

  const savedTitle = localStorage.getItem("sekTitle");
  sekLogo.textContent = savedTitle ? savedTitle : "SEK DASHBOARD";

  const menuLinks = document.querySelectorAll(".sidebar-nav ul li a");

  menuLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      const span = this.querySelector("span");
      if (!span) return;

      const menuName = span.textContent.trim();
      const href = this.getAttribute("href");

      localStorage.setItem(
        "sekTitle",
        `SEK ${menuName.toUpperCase()}`
      );

      if (href && href !== "#") {
        e.preventDefault();
        setTimeout(() => {
          window.location.href = href;
        }, 100);
      }
    });
  });
}

/* ================= SIDEBAR TOGGLE ================= */
function initSidebarToggle() {
  const sidebar = document.querySelector(".sidebar");
  const toggleBtn = document.getElementById("sidebar-toggle");

  if (!sidebar || !toggleBtn) return;

  // restore state
  const saved = localStorage.getItem("sidebarState");

  if (saved === "collapsed") {
    sidebar.classList.add("collapsed");
  }

  toggleBtn.addEventListener("click", function () {
    sidebar.classList.toggle("collapsed");

    const state = sidebar.classList.contains("collapsed")
      ? "collapsed"
      : "expanded";

    localStorage.setItem("sidebarState", state);
  });
}

/* ================= INIT ================= */
document.addEventListener("DOMContentLoaded", function () {
  // Navbar title init
  if (document.getElementById("sek_logo")) {
    initNavbarTitle();
  } else {
    const observer = new MutationObserver(() => {
      if (document.getElementById("sek_logo")) {
        initNavbarTitle();
        observer.disconnect();
      }
    });

    observer.observe(document.body, {
      childList: true,
      subtree: true,
    });
  }

  // Sidebar toggle init
  initSidebarToggle();
});