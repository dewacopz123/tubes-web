function initNavbarTitle() {
  const navbarTitle = document.getElementById("navbar-page-title");
  if (!navbarTitle) return;

  const activeMenuText = document
    .querySelector(".sidebar-nav ul li.active span")
    ?.textContent?.trim();

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

      localStorage.setItem(
        "navbarPageTitle",
        span.textContent.trim()
      );
    });
  });
}

function initSidebarActiveMenu() {
  const currentPath =
    window.location.pathname.replace(/\/$/, "") || "/";

  const menuLinks =
    document.querySelectorAll(".sidebar-nav ul li a");

  document
    .querySelectorAll(".sidebar-nav ul li")
    .forEach((item) => item.classList.remove("active"));

  let activeItem = Array.from(menuLinks).find((link) => {
    const href = link.getAttribute("href");

    if (
      !href ||
      href === "#" ||
      href === "javascript:void(0)"
    ) {
      return false;
    }

    const url = new URL(href, window.location.origin);
    const path = url.pathname.replace(/\/$/, "") || "/";

    if (path === currentPath) return true;

    if (
      currentPath === "/" &&
      path === "/dashboard"
    ) {
      return true;
    }

    return false;
  });

  if (!activeItem && currentPath !== "/") {
    activeItem = Array.from(menuLinks).find((link) => {
      const href = link.getAttribute("href");

      if (!href) return false;

      const url = new URL(href, window.location.origin);
      const path = url.pathname.replace(/\/$/, "") || "/";

      return (
        currentPath.startsWith(path) &&
        path !== "/"
      );
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

  const isExpanded =
    sidebar &&
    !sidebar.classList.contains("collapsed");

  document.body.classList.toggle(
    "mobile-sidebar-open",
    isMobile && isExpanded
  );
}

function initSidebarToggle() {
  const sidebar = document.querySelector(".sidebar");
  const toggleBtn = document.getElementById("sidebar-toggle");

  if (!sidebar || !toggleBtn) return;

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

  window.addEventListener(
    "resize",
    updateMobileBodyState
  );
}

/* ================= DIALOG ================= */

function openDialog(html) {
  const dialog = document.getElementById("dialogContainer");
  if (!dialog) return;

  dialog.innerHTML = html;

  dialog.querySelectorAll("[data-dialog-close]").forEach((btn) => {
    btn.onclick = () => {
      dialog.innerHTML = "";
    };
  });
}

function showConfirmDialog(title, message, onConfirm) {
  openDialog(`
    <div class="dialog-overlay">
      <div class="dialog-box">
        <h3>${title}</h3>

        <p class="dialog-text">
          ${message}
        </p>

        <div class="dialog-actions">
          <button
            type="button"
            class="btn btn-jobdesk"
            data-dialog-confirm>
            Ya
          </button>

          <button
            type="button"
            class="btn btn-danger"
            data-dialog-close>
            Batal
          </button>
        </div>
      </div>
    </div>
  `);

  const dialog = document.getElementById("dialogContainer");

  const confirmButton =
    dialog.querySelector("[data-dialog-confirm]");

  if (confirmButton) {
    confirmButton.onclick = () => {
      dialog.innerHTML = "";
      onConfirm();
    };
  }
}

/* ================= LOGOUT ================= */

function initLogoutConfirmation() {
  const logoutForm =
    document.getElementById("logoutForm");

  if (!logoutForm) return;

  logoutForm.addEventListener("submit", function (e) {
    e.preventDefault();

    showConfirmDialog(
      "Logout",
      "Apakah Anda yakin ingin keluar dari sistem?",
      () => {
        logoutForm.submit();
      }
    );
  });
}

/* ================= INIT ================= */

document.addEventListener("DOMContentLoaded", function () {
  if (document.getElementById("navbar-page-title")) {
    initNavbarTitle();
  } else {
    const observer = new MutationObserver(() => {
      if (
        document.getElementById("navbar-page-title")
      ) {
        initNavbarTitle();
        observer.disconnect();
      }
    });

    observer.observe(document.body, {
      childList: true,
      subtree: true,
    });
  }

  initSidebarActiveMenu();
  initSidebarToggle();
  initLogoutConfirmation();
});