const ROOT = "[data-program-delivery-tabs]";
const NAV = ".program-delivery__tabs-nav";
const INDICATOR = ".program-delivery__tabs-indicator";
const TAB_BTN = ".program-delivery__tab";
const PANEL = ".program-delivery__panel";
const DESCRIPTION = "[data-program-delivery-description]";
const ACCORDION_TRIGGER = "[data-program-delivery-accordion-trigger]";
const ACCORDION_PANEL = "[data-program-delivery-accordion-panel]";

const ACTIVE_TAB = "is-active";
const ACTIVE_PANEL = "is-active";
const REDUCED_MOTION = "(prefers-reduced-motion: reduce)";
const ACCORDION_TRANSITION_MS = 320;

function prefersReducedMotion() {
  return window.matchMedia(REDUCED_MOTION).matches;
}

function moveIndicator(nav, indicator, tab) {
  if (!indicator || !tab) return;

  const navRect = nav.getBoundingClientRect();
  const tabRect = tab.getBoundingClientRect();

  indicator.style.width = `${tabRect.width}px`;
  indicator.style.transform = `translateX(${tabRect.left - navRect.left}px)`;
}

function setActiveTab(root, index) {
  const nav = root.querySelector(NAV);
  const indicator = root.querySelector(INDICATOR);
  const tabs = [...root.querySelectorAll(TAB_BTN)];
  const panels = [...root.querySelectorAll(PANEL)];

  if (!tabs.length || index < 0 || index >= tabs.length) return;

  tabs.forEach((tab, i) => {
    const isActive = i === index;
    tab.classList.toggle(ACTIVE_TAB, isActive);
    tab.setAttribute("aria-selected", isActive ? "true" : "false");
    tab.tabIndex = isActive ? 0 : -1;
  });

  panels.forEach((panel, i) => {
    const isActive = i === index;
    panel.classList.toggle(ACTIVE_PANEL, isActive);
    panel.hidden = !isActive;
  });

  moveIndicator(nav, indicator, tabs[index]);
  setActiveDescriptions(root, index);
}

function setActiveDescriptions(root, index) {
  const descriptions = [...root.querySelectorAll(DESCRIPTION)];

  descriptions.forEach((description, i) => {
    const isActive = i === index;
    description.classList.toggle(ACTIVE_PANEL, isActive);
    description.hidden = !isActive;
  });
}

/**
 * Preload images in inactive panels so tab switches do not flash.
 * @param {Element} root
 */
function preloadInactivePanelImages(root) {
  const panels = [...root.querySelectorAll(PANEL)];
  const urls = new Set();

  panels.forEach((panel) => {
    if (panel.classList.contains(ACTIVE_PANEL)) return;

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

function schedulePreloadInactivePanelImages(root) {
  const run = () => preloadInactivePanelImages(root);

  if ("requestIdleCallback" in window) {
    requestIdleCallback(run, { timeout: 2000 });
  } else {
    window.setTimeout(run, 200);
  }
}

function openAccordionPanel(panel) {
  if (!panel) return;

  if (prefersReducedMotion()) {
    panel.hidden = false;
    panel.classList.add(ACTIVE_PANEL);
    panel.style.maxHeight = "none";
    panel.style.opacity = "1";
    return;
  }

  panel.hidden = false;
  panel.classList.add(ACTIVE_PANEL);
  panel.style.maxHeight = "0px";
  panel.style.opacity = "0";

  window.requestAnimationFrame(() => {
    panel.style.maxHeight = `${panel.scrollHeight}px`;
    panel.style.opacity = "1";
  });

  window.setTimeout(() => {
    if (!panel.hidden) panel.style.maxHeight = "none";
  }, ACCORDION_TRANSITION_MS);
}

function closeAccordionPanel(panel) {
  if (!panel || panel.hidden) return;

  if (prefersReducedMotion()) {
    panel.classList.remove(ACTIVE_PANEL);
    panel.hidden = true;
    panel.style.maxHeight = "0px";
    panel.style.opacity = "0";
    return;
  }

  panel.style.maxHeight = `${panel.scrollHeight}px`;
  panel.style.opacity = "1";

  window.requestAnimationFrame(() => {
    panel.classList.remove(ACTIVE_PANEL);
    panel.style.maxHeight = "0px";
    panel.style.opacity = "0";
  });

  window.setTimeout(() => {
    if (!panel.classList.contains(ACTIVE_PANEL)) panel.hidden = true;
  }, ACCORDION_TRANSITION_MS);
}

function setActiveAccordionItem(root, index) {
  const triggers = [...root.querySelectorAll(ACCORDION_TRIGGER)];
  const panels = [...root.querySelectorAll(ACCORDION_PANEL)];

  if (!triggers.length) return;

  triggers.forEach((trigger, i) => {
    const isActive = i === index;
    trigger.classList.toggle(ACTIVE_TAB, isActive);
    trigger.setAttribute("aria-expanded", isActive ? "true" : "false");
  });

  panels.forEach((panel, i) => {
    const isActive = i === index;
    if (isActive) {
      openAccordionPanel(panel);
      return;
    }

    closeAccordionPanel(panel);
  });

  setActiveDescriptions(root, index);
}

function scrollTabIntoView(nav, tab) {
  if (window.innerWidth > 992) return;

  const navRect = nav.getBoundingClientRect();
  const tabRect = tab.getBoundingClientRect();
  const tabLeft = tabRect.left - navRect.left + nav.scrollLeft;
  const target =
    tabLeft - navRect.width / 2 + tabRect.width / 2;

  nav.scrollTo({
    left: Math.max(0, target),
    behavior: prefersReducedMotion() ? "auto" : "smooth",
  });
}

/**
 * @param {ParentNode} [scope]
 */
export function initProgramDeliveryTabs(scope = document) {
  scope.querySelectorAll(ROOT).forEach((root) => {
    const nav = root.querySelector(NAV);
    const indicator = root.querySelector(INDICATOR);
    const tabs = [...root.querySelectorAll(TAB_BTN)];
    const accordionTriggers = [...root.querySelectorAll(ACCORDION_TRIGGER)];

    if (!nav || !tabs.length) return;

    let activeIndex = tabs.findIndex((tab) =>
      tab.classList.contains(ACTIVE_TAB)
    );
    if (activeIndex < 0) activeIndex = 0;

    setActiveTab(root, activeIndex);
    schedulePreloadInactivePanelImages(root);

    tabs.forEach((tab, index) => {
      tab.addEventListener("click", () => {
        if (index === activeIndex) return;
        activeIndex = index;
        setActiveTab(root, activeIndex);
        scrollTabIntoView(nav, tab);
      });

      tab.addEventListener("keydown", (event) => {
        let nextIndex = activeIndex;

        if (event.key === "ArrowRight") {
          nextIndex = (activeIndex + 1) % tabs.length;
        } else if (event.key === "ArrowLeft") {
          nextIndex = (activeIndex - 1 + tabs.length) % tabs.length;
        } else if (event.key === "Home") {
          nextIndex = 0;
        } else if (event.key === "End") {
          nextIndex = tabs.length - 1;
        } else {
          return;
        }

        event.preventDefault();
        activeIndex = nextIndex;
        tabs[activeIndex].focus();
        setActiveTab(root, activeIndex);
        scrollTabIntoView(nav, tabs[activeIndex]);
      });
    });

    if (accordionTriggers.length) {
      let activeAccordionIndex = accordionTriggers.findIndex((trigger) =>
        trigger.classList.contains(ACTIVE_TAB)
      );
      if (activeAccordionIndex < 0) activeAccordionIndex = -1;
      setActiveAccordionItem(root, activeAccordionIndex);

      if (activeAccordionIndex < 0) {
        activeAccordionIndex = 0;
        setActiveAccordionItem(root, activeAccordionIndex);
      }

      accordionTriggers.forEach((trigger, index) => {
        trigger.addEventListener("click", () => {
          if (index === activeAccordionIndex) {
            activeAccordionIndex = -1;
            setActiveAccordionItem(root, activeAccordionIndex);
            return;
          }

          activeAccordionIndex = index;
          setActiveAccordionItem(root, activeAccordionIndex);
        });
      });
    }

    const onResize = () => {
      const current = tabs[activeIndex];
      if (current) moveIndicator(nav, indicator, current);
    };

    let resizeTimer = 0;
    window.addEventListener("resize", () => {
      window.clearTimeout(resizeTimer);
      resizeTimer = window.setTimeout(onResize, 100);
    });

    if ("ResizeObserver" in window) {
      const observer = new ResizeObserver(onResize);
      observer.observe(nav);
      tabs.forEach((tab) => observer.observe(tab));
    }
  });
}
