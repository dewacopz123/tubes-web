function initNavbarTitle() {
  const navbarTitle = document.getElementById("navbar-page-title");
  if (!navbarTitle) return;

  const activeMenuText = document.querySelector(".sidebar-nav ul li.active span")?.textContent?.trim();
  const savedTitle = localStorage.getItem("navbarPageTitle");

  if (activeMenuText) {
    navbarTitle.textContent = activeMenuText;
    localStorage.setItem("navbarPageTitle", activeMenuText);
  } else if (savedTitle) {
    navbarTitle.textContent = savedTitle;
  } else {
    navbarTitle.textContent = "Dashboard";
  }

  const menuLinks = document.querySelectorAll(".sidebar-nav ul li a");
  menuLinks.forEach((link) => {
    link.addEventListener("click", function () {
      const span = this.querySelector("span");
      if (!span) return;
      localStorage.setItem("navbarPageTitle", span.textContent.trim());
    });
  });
}

function initSidebarActiveMenu() {
  const currentPath = window.location.pathname.replace(/\/$/, "") || "/";
  const menuLinks = document.querySelectorAll(".sidebar-nav ul li a");

  document.querySelectorAll(".sidebar-nav ul li").forEach((item) => item.classList.remove("active"));

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
  }
}

/* ================= SIDEBAR TOGGLE ================= */
function updateMobileBodyState() {
  const sidebar = document.querySelector(".sidebar");
  const isMobile = window.innerWidth <= 900;
  const isExpanded = sidebar && !sidebar.classList.contains("collapsed");
  document.body.classList.toggle("mobile-sidebar-open", isMobile && isExpanded);
}

function initSidebarToggle() {
  const sidebar = document.querySelector(".sidebar");
  const toggleBtn = document.getElementById("sidebar-toggle");

  if (!sidebar || !toggleBtn) return;

  // restore state
  const saved = localStorage.getItem("sidebarState");

  if (saved === "collapsed") {
    sidebar.classList.add("collapsed");
  }

  updateMobileBodyState();

  toggleBtn.addEventListener("click", function () {
    sidebar.classList.toggle("collapsed");

    const state = sidebar.classList.contains("collapsed")
      ? "collapsed"
      : "expanded";

    localStorage.setItem("sidebarState", state);
    updateMobileBodyState();
  });

  window.addEventListener("resize", updateMobileBodyState);
}

/* ================= INIT ================= */
document.addEventListener("DOMContentLoaded", function () {
  // Navbar title init
  if (document.getElementById("navbar-page-title")) {
    initNavbarTitle();
  } else {
    const observer = new MutationObserver(() => {
      if (document.getElementById("navbar-page-title")) {
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
