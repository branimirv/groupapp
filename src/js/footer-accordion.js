/**
 * Footer mobile accordion (<= 992px).
 * Desktop: all panels stay visible; triggers are non-interactive.
 */
const ROOT = "[data-footer-accordion]";
const ITEM = ".footer--top__accordion-item";
const TRIGGER = ".footer--top__accordion-trigger";
const PANEL = ".footer--top__accordion-panel";
const OPEN = "is-open";
const MOBILE_MAX = 992;

function isMobile() {
  return window.innerWidth <= MOBILE_MAX;
}

function closeItem(item) {
  const trigger = item.querySelector(TRIGGER);
  const panel = item.querySelector(PANEL);

  item.classList.remove(OPEN);
  if (trigger) {
    trigger.setAttribute("aria-expanded", "false");
  }
  if (panel) {
    panel.hidden = true;
  }
}

function openItem(item) {
  const trigger = item.querySelector(TRIGGER);
  const panel = item.querySelector(PANEL);

  item.classList.add(OPEN);
  if (trigger) {
    trigger.setAttribute("aria-expanded", "true");
  }
  if (panel) {
    panel.hidden = false;
  }
}

function closeAll(items) {
  items.forEach(closeItem);
}

function openOnly(items, index) {
  closeAll(items);
  if (items[index]) {
    openItem(items[index]);
  }
}

function applyDesktopState(items) {
  items.forEach((item) => {
    const trigger = item.querySelector(TRIGGER);
    const panel = item.querySelector(PANEL);

    item.classList.remove(OPEN);
    if (trigger) {
      trigger.setAttribute("aria-expanded", "true");
    }
    if (panel) {
      panel.hidden = false;
      panel.removeAttribute("hidden");
    }
  });
}

function applyMobileState(items) {
  closeAll(items);
  if (items.length) {
    openOnly(items, 0);
  }
}

export function initFooterAccordion() {
  const root = document.querySelector(ROOT);
  if (!root) {
    return;
  }

  const items = [...root.querySelectorAll(ITEM)];
  if (!items.length) {
    return;
  }

  function syncLayout() {
    if (isMobile()) {
      applyMobileState(items);
    } else {
      applyDesktopState(items);
    }
  }

  items.forEach((item, index) => {
    const trigger = item.querySelector(TRIGGER);
    if (!trigger) {
      return;
    }

    trigger.addEventListener("click", (event) => {
      if (!isMobile()) {
        return;
      }

      event.preventDefault();
      const isOpen = trigger.getAttribute("aria-expanded") === "true";

      if (isOpen) {
        closeItem(item);
      } else {
        openOnly(items, index);
      }
    });
  });

  syncLayout();

  let resizeTimer;
  window.addEventListener("resize", () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(syncLayout, 150);
  });
}
