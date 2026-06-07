/**
 * Header mega-menu + mobile slide-in nav.
 *
 * - Desktop: clicking a `.primary-nav__trigger` opens its `.mega-menu` dropdown.
 *   Outside click and Esc close it. Only one panel is open at a time.
 * - Mobile (<= 992px): the same trigger toggles its panel as an inline accordion
 *   inside the slide-in menu. Closing the hamburger also resets all panels.
 */
export function initMegaMenu() {
  const menuToggle = document.querySelector(".menu-btn.toggle");
  const mobileMenu = document.querySelector(".header-menu.links");
  const body = document.body;
  const megaTriggers = document.querySelectorAll(".primary-nav__trigger");
  const megaPanels = document.querySelectorAll(".mega-menu");

  const isDesktop = () => window.innerWidth > 992;

  function closeAllMegaPanels() {
    megaTriggers.forEach((trigger) =>
      trigger.setAttribute("aria-expanded", "false")
    );
    megaPanels.forEach((panel) => {
      panel.removeAttribute("data-open");
      panel.setAttribute("hidden", "");
    });
  }

  function openMegaPanel(panelId) {
    closeAllMegaPanels();
    const trigger = document.querySelector(
      `.primary-nav__trigger[aria-controls="${panelId}"]`
    );
    const panel = document.getElementById(panelId);
    if (!trigger || !panel) return;
    trigger.setAttribute("aria-expanded", "true");
    panel.setAttribute("data-open", "true");
    panel.removeAttribute("hidden");
  }

  // Mega-menu trigger clicks (desktop dropdown + mobile accordion)
  megaTriggers.forEach((trigger) => {
    trigger.addEventListener("click", function (event) {
      event.preventDefault();
      event.stopPropagation();
      const panelId = trigger.getAttribute("aria-controls");
      const isOpen = trigger.getAttribute("aria-expanded") === "true";
      if (isOpen) {
        closeAllMegaPanels();
      } else {
        openMegaPanel(panelId);
      }
    });
  });

  // Close any open mega panel when clicking outside (desktop only)
  document.addEventListener("click", function (event) {
    if (!isDesktop()) return;
    const insideTrigger = event.target.closest(".primary-nav__trigger");
    const insidePanel = event.target.closest(".mega-menu");
    if (!insideTrigger && !insidePanel) {
      closeAllMegaPanels();
    }
  });

  // Close on Esc
  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
      closeAllMegaPanels();
    }
  });

  // Reset open panels on resize so desktop/mobile state can't get mixed
  let megaResizeTimer;
  window.addEventListener("resize", function () {
    clearTimeout(megaResizeTimer);
    megaResizeTimer = setTimeout(closeAllMegaPanels, 150);
  });

  if (!menuToggle || !mobileMenu) return;

  menuToggle.addEventListener("click", function () {
    menuToggle.classList.toggle("active");
    mobileMenu.classList.toggle("active");

    if (mobileMenu.classList.contains("active")) {
      body.style.overflow = "hidden";
    } else {
      body.style.overflow = "";
      closeAllMegaPanels();
    }
  });

  // Close mobile menu when clicking on real menu links (skip mega-menu triggers
  // — they're <button>s so this NodeList won't include them anyway)
  const menuLinks = mobileMenu.querySelectorAll("a");
  menuLinks.forEach((link) => {
    link.addEventListener("click", function () {
      menuToggle.classList.remove("active");
      mobileMenu.classList.remove("active");
      body.style.overflow = "";
      closeAllMegaPanels();
    });
  });

  // Close mobile menu when clicking outside the menu/toggle (mobile only)
  document.addEventListener("click", function (event) {
    if (isDesktop()) return;
    if (
      !menuToggle.contains(event.target) &&
      !mobileMenu.contains(event.target)
    ) {
      menuToggle.classList.remove("active");
      mobileMenu.classList.remove("active");
      body.style.overflow = "";
      closeAllMegaPanels();
    }
  });
}
