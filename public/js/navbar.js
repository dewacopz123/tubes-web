function setSidebarHeaderTitle(menuName) {
  const sekLogo =
    document.getElementById("sek_logo") ||
    document.querySelector(".sidebar-header .logo-text");

  if (!sekLogo || !menuName) return;

  const titleText = `SEK ${menuName.toUpperCase()}`;
  sekLogo.textContent = titleText;
  localStorage.setItem("sekTitle", titleText);
}

function initNavbarTitle() {
  const sekLogo =
    document.getElementById("sek_logo") ||
    document.querySelector(".sidebar-header .logo-text");

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

      setSidebarHeaderTitle(menuName);

      if (href && href !== "#") {
        e.preventDefault();
        setTimeout(() => {
          window.location.href = href;
        }, 100);
      }
    });
  });
}

function initSidebarActiveMenu() {
  const currentPath = window.location.pathname.replace(/\/$/, "") || "/";
  const menuLinks = document.querySelectorAll(".sidebar-nav ul li a");

  document.querySelectorAll(".sidebar-nav ul li").forEach((item) => {
    item.classList.remove("active");
  });

  let activeItem = Array.from(menuLinks).find((link) => {
    const href = link.getAttribute("href");
    if (!href || href === "#" || href === "javascript:void(0)") return false;

    const url = new URL(href, window.location.origin);
    const path = url.pathname.replace(/\/$/, "") || "/";

    if (path === currentPath) return true;
    if (currentPath === "/" && path === "/dashboard") return true;
    return false;
  });

  if (!activeItem && currentPath !== "/") {
    activeItem = Array.from(menuLinks).find((link) => {
      const href = link.getAttribute("href");
      if (!href) return false;

      const url = new URL(href, window.location.origin);
      const path = url.pathname.replace(/\/$/, "") || "/";
      return currentPath.startsWith(path) && path !== "/";
    });
  }

  if (activeItem) {
    activeItem.closest("li")?.classList.add("active");

    const activeMenuName = activeItem.querySelector("span")?.textContent.trim();
    if (activeMenuName) {
      setSidebarHeaderTitle(activeMenuName);
    }
  }
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

  // Sidebar init
  initSidebarActiveMenu();
  initSidebarToggle();
});