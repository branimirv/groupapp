// TEMP: Tab switching is disabled in main.js until all category images are available.
const ROOT = "[data-integrations-home]";
const ITEM_BTN = ".integrations-home__item";
const PANEL = ".integrations-home__panel";
const PREVIEW_PANEL = ".integrations-home__panel-preview";
const ACTIVE = "is-active";
const REDUCED_MOTION = "(prefers-reduced-motion: reduce)";

function prefersReducedMotion() {
  return window.matchMedia(REDUCED_MOTION).matches;
}

function setActive(root, index) {
  const items = [...root.querySelectorAll(ITEM_BTN)];
  const panels = [...root.querySelectorAll(PANEL)];
  const previewPanels = [...root.querySelectorAll(PREVIEW_PANEL)];

  if (!items.length || index < 0 || index >= items.length) return;

  items.forEach((item, i) => {
    const isActive = i === index;
    item.classList.toggle(ACTIVE, isActive);
    item.setAttribute("aria-selected", isActive ? "true" : "false");
    item.tabIndex = isActive ? 0 : -1;
  });

  panels.forEach((panel, i) => {
    const isActive = i === index;
    panel.classList.toggle(ACTIVE, isActive);
    panel.hidden = !isActive;
  });

  previewPanels.forEach((panel, i) => {
    panel.classList.toggle(ACTIVE, i === index);
  });
}

function preloadInactivePanelImages(root) {
  const panels = [...root.querySelectorAll(PANEL)];
  const urls = new Set();

  panels.forEach((panel) => {
    if (panel.classList.contains(ACTIVE)) return;

    panel.querySelectorAll("img[src]").forEach((img) => {
      const src = img.currentSrc || img.src;
      if (src) urls.add(src);
    });
  });

  urls.forEach((src) => {
    const preload = new Image();
    preload.src = src;
  });
}

function schedulePreload(root) {
  const run = () => preloadInactivePanelImages(root);

  if ("requestIdleCallback" in window) {
    requestIdleCallback(run, { timeout: 2000 });
  } else {
    window.setTimeout(run, 200);
  }
}

/**
 * @param {ParentNode} [scope]
 */
export function initIntegrationsHome(scope = document) {
  scope.querySelectorAll(ROOT).forEach((root) => {
    const items = [...root.querySelectorAll(ITEM_BTN)];

    if (!items.length) return;

    let activeIndex = items.findIndex((item) => item.classList.contains(ACTIVE));
    if (activeIndex < 0) activeIndex = 0;

    setActive(root, activeIndex);
    schedulePreload(root);

    items.forEach((item, index) => {
      item.addEventListener("click", () => {
        if (index === activeIndex) return;
        activeIndex = index;
        setActive(root, activeIndex);
      });

      item.addEventListener("keydown", (event) => {
        let nextIndex = activeIndex;

        if (event.key === "ArrowRight" || event.key === "ArrowDown") {
          nextIndex = (activeIndex + 1) % items.length;
        } else if (event.key === "ArrowLeft" || event.key === "ArrowUp") {
          nextIndex = (activeIndex - 1 + items.length) % items.length;
        } else if (event.key === "Home") {
          nextIndex = 0;
        } else if (event.key === "End") {
          nextIndex = items.length - 1;
        } else {
          return;
        }

        event.preventDefault();
        activeIndex = nextIndex;
        items[activeIndex].focus();
        setActive(root, activeIndex);
      });
    });
  });
}
