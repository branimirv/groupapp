/**
 * Pricing page interactions: billing toggle, comparison accordion, mobile tabs.
 */

const MOBILE_BREAKPOINT = 992;

const ROOT = ".pricing-plans";
const BILLING_SWITCH = ".pricing-billing__switch";
const YEARLY_ACTIVE = "is-yearly";
const PRICE_MONTHLY = ".pricing-plans__price-value--monthly";
const PRICE_YEARLY = ".pricing-plans__price-value--yearly";
const CAPTION_YEARLY = ".pricing-plans__caption--yearly";
const CAPTION_MONTHLY = ".pricing-plans__caption--monthly";
const CTA_MONTHLY = ".pricing-plans__cta--monthly";
const CTA_YEARLY = ".pricing-plans__cta--yearly";
const CAPTION_VISIBLE = "is-caption-visible";
const CAPTION_HIDDEN = "is-caption-hidden";

const COMPARISON = ".pricing-comparison";
const COMPARISON_TOGGLE = ".pricing-comparison__expand";
const COMPARISON_CONTENT = ".pricing-comparison__content";
const COMPARISON_GROUP = ".pricing-comparison__group";
const COMPARISON_TABLE = ".pricing-comparison__table--features";
const COMPARISON_HEADER = ".pricing-comparison__table--header";
const ICON_TOGGLE = ".icon-toggle";
const ICON_ACTIVE = "is-active";
const GROUP_ACTIVE = "is-active";
const STICKY_HEADER = "is-sticky";

const EXPAND_SHOW = ".pricing-comparison__expand-label--show";
const EXPAND_HIDE = ".pricing-comparison__expand-label--hide";

function setDisplay(elements, value) {
  elements.forEach((el) => {
    el.style.display = value;
  });
}

function applyYearlyBilling(root, isYearly) {
  const monthlyPrices = root.querySelectorAll(PRICE_MONTHLY);
  const yearlyPrices = root.querySelectorAll(PRICE_YEARLY);
  const yearlyCaptions = root.querySelectorAll(CAPTION_YEARLY);
  const monthlyCaptions = root.querySelectorAll(CAPTION_MONTHLY);
  const monthlyCtas = root.querySelectorAll(CTA_MONTHLY);
  const yearlyCtas = root.querySelectorAll(CTA_YEARLY);

  const billingSwitch = document.querySelector(BILLING_SWITCH);
  const monthlyLabel = document.querySelector(
    ".pricing-billing__label--monthly",
  );
  const yearlyLabel = document.querySelector(".pricing-billing__label--yearly");
  const indicator = document.querySelector(
    ".pricing-billing__switch-indicator",
  );

  if (billingSwitch) {
    billingSwitch.classList.toggle(YEARLY_ACTIVE, isYearly);
  }
  if (monthlyLabel) {
    monthlyLabel.classList.toggle(ICON_ACTIVE, !isYearly);
  }
  if (yearlyLabel) {
    yearlyLabel.classList.toggle(ICON_ACTIVE, isYearly);
  }
  if (indicator) {
    indicator.classList.toggle("is-shifted", isYearly);
  }

  setDisplay(monthlyPrices, isYearly ? "none" : "block");
  setDisplay(yearlyPrices, isYearly ? "block" : "none");
  setDisplay(monthlyCtas, isYearly ? "none" : "block");
  setDisplay(yearlyCtas, isYearly ? "block" : "none");

  yearlyCaptions.forEach((el) => {
    el.classList.toggle(CAPTION_VISIBLE, isYearly);
  });
  monthlyCaptions.forEach((el) => {
    el.classList.toggle(CAPTION_HIDDEN, isYearly);
  });
}

function initBillingToggle(root) {
  const billingSwitch = document.querySelector(BILLING_SWITCH);
  if (!billingSwitch) {
    return;
  }

  applyYearlyBilling(root, billingSwitch.classList.contains(YEARLY_ACTIVE));

  billingSwitch.addEventListener("click", () => {
    const isYearly = !billingSwitch.classList.contains(YEARLY_ACTIVE);
    applyYearlyBilling(root, isYearly);
  });
}

function initComparisonExpand() {
  const comparison = document.querySelector(COMPARISON);
  const toggleBtn = document.querySelector(COMPARISON_TOGGLE);
  const content = document.querySelector(COMPARISON_CONTENT);

  if (!comparison || !toggleBtn || !content) {
    return;
  }

  const showLabel = toggleBtn.querySelector(EXPAND_SHOW);
  const hideLabel = toggleBtn.querySelector(EXPAND_HIDE);
  const toggleIcon = toggleBtn.querySelector(ICON_TOGGLE);
  const headerTable = content.querySelector(COMPARISON_HEADER);

  const setExpanded = (expanded) => {
    content.hidden = !expanded;
    if (headerTable) {
      headerTable.classList.toggle(STICKY_HEADER, false);
    }
    toggleBtn.setAttribute("aria-expanded", String(expanded));
    if (showLabel) {
      showLabel.hidden = expanded;
    }
    if (hideLabel) {
      hideLabel.hidden = !expanded;
    }
    if (toggleIcon) {
      toggleIcon.classList.toggle(ICON_ACTIVE, expanded);
    }
  };

  setExpanded(true);

  toggleBtn.addEventListener("click", () => {
    setExpanded(content.hidden);
  });
}

function initComparisonGroups() {
  const groups = document.querySelectorAll(COMPARISON_GROUP);
  if (!groups.length) {
    return;
  }

  groups.forEach((group, index) => {
    const table = group.querySelector(COMPARISON_TABLE);
    const toggleBtn = group.querySelector(".pricing-comparison__group-toggle");
    const toggleIcon = toggleBtn?.querySelector(ICON_TOGGLE);
    const titleRow = group.querySelector(".pricing-comparison__group-header");

    if (!table) {
      return;
    }

    const setOpen = (open) => {
      table.hidden = !open;
      group.classList.toggle(GROUP_ACTIVE, open);
      if (toggleIcon) {
        toggleIcon.classList.toggle(ICON_ACTIVE, open);
      }
    };

    if (index === 0) {
      setOpen(true);
    } else {
      setOpen(false);
    }

    const handleToggle = () => setOpen(table.hidden);

    titleRow?.addEventListener("click", handleToggle);
    toggleBtn?.addEventListener("click", (event) => {
      event.stopPropagation();
      handleToggle();
    });
  });

  const expandBtn = document.querySelector(COMPARISON_TOGGLE);
  const expandIcon = expandBtn?.querySelector(ICON_TOGGLE);
  if (expandIcon) {
    expandIcon.classList.add(ICON_ACTIVE);
  }
}

function initStickyComparisonHeader() {
  const content = document.querySelector(COMPARISON_CONTENT);
  const headerTable = content?.querySelector(COMPARISON_HEADER);
  if (!headerTable) {
    return;
  }

  let lastScroll = 0;
  let wasScrolled = false;

  window.addEventListener("scroll", () => {
    if (content?.hidden) {
      headerTable.classList.remove(STICKY_HEADER);
      return;
    }

    const currentScroll =
      window.pageYOffset ||
      document.documentElement.scrollTop ||
      document.body.scrollTop ||
      0;
    const scrollingUp = currentScroll < lastScroll;
    const shouldStick = wasScrolled && scrollingUp;

    wasScrolled = currentScroll > 100;
    headerTable.classList.toggle(STICKY_HEADER, shouldStick);
    lastScroll = currentScroll;
  });
}

function scrollActivePlanTabToStart(behavior = "auto") {
  if (window.innerWidth >= MOBILE_BREAKPOINT) {
    return;
  }

  const headerTable = document.querySelector(COMPARISON_HEADER);
  const activeTab = headerTable?.querySelector(
    ".pricing-comparison__plan-col.is-active",
  );
  const headerRow = headerTable?.querySelector("tr");

  if (!headerTable || !activeTab || !headerRow) {
    return;
  }

  const paddingLeft = parseFloat(getComputedStyle(headerRow).paddingLeft) || 0;
  const targetScrollLeft = Math.max(0, activeTab.offsetLeft - paddingLeft);

  headerTable.scrollTo({
    left: targetScrollLeft,
    behavior,
  });
}

function getActiveColumnIndex(activeTab) {
  if (activeTab.classList.contains("pricing-comparison__plan-col--1")) {
    return 1;
  }
  if (activeTab.classList.contains("pricing-comparison__plan-col--2")) {
    return 2;
  }
  if (activeTab.classList.contains("pricing-comparison__plan-col--3")) {
    return 3;
  }
  if (activeTab.classList.contains("pricing-comparison__plan-col--4")) {
    return 4;
  }
  return 0;
}

function initComparisonMobileTabs() {
  const comparisonTable = document.querySelector(COMPARISON_HEADER);
  if (!comparisonTable) {
    return;
  }

  const showActiveTabContent = () => {
    const activeTab = document.querySelector(
      ".pricing-comparison__plan-col.is-active",
    );
    if (!activeTab) {
      return;
    }

    const activeIndex = getActiveColumnIndex(activeTab);

    document
      .querySelectorAll(".pricing-comparison__table--features tr")
      .forEach((row) => {
        row.querySelectorAll("td").forEach((cell, index) => {
          if (index === 0) {
            cell.style.display = "table-cell";
          } else if (index === activeIndex) {
            cell.style.display = "table-cell";
          } else {
            cell.style.display = "none";
          }
        });
      });

    const headerRow = document.querySelector(
      ".pricing-comparison__table--header tr",
    );
    if (!headerRow) {
      return;
    }

    headerRow.querySelectorAll("td").forEach((cell, index) => {
      cell.style.display = index === 0 ? "none" : "table-cell";
    });

    requestAnimationFrame(() => {
      scrollActivePlanTabToStart("smooth");
    });
  };

  const initializeTabs = () => {
    const firstColumn = document.querySelector(
      ".pricing-comparison__table--header tr td:first-child",
    );
    if (firstColumn) {
      firstColumn.style.display = "none";
    }

    const proTab = document.querySelector(".pricing-comparison__plan-col--2");
    if (proTab) {
      proTab.classList.add("is-active");
    }

    document
      .querySelectorAll(".pricing-comparison__plan-col")
      .forEach((tab) => {
        if (!tab.classList.contains("pricing-comparison__plan-col--2")) {
          tab.classList.remove("is-active");
        }
      });

    showActiveTabContent();

    requestAnimationFrame(() => {
      scrollActivePlanTabToStart("auto");
    });

    document
      .querySelectorAll(".pricing-comparison__plan-col")
      .forEach((tab) => {
        tab.addEventListener("click", function handleTabClick() {
          document
            .querySelectorAll(".pricing-comparison__plan-col")
            .forEach((t) => t.classList.remove("is-active"));
          this.classList.add("is-active");
          showActiveTabContent();
        });
      });
  };

  const resetToDesktop = () => {
    document
      .querySelectorAll(".pricing-comparison__table--header tr td")
      .forEach((cell, index) => {
        cell.style.display = index === 0 ? "flex" : "table-cell";
      });

    document
      .querySelectorAll(".pricing-comparison__table--features tr td")
      .forEach((cell) => {
        cell.style.display = "table-cell";
      });

    document
      .querySelectorAll(".pricing-comparison__plan-col")
      .forEach((tab) => {
        tab.replaceWith(tab.cloneNode(true));
      });
  };

  const setup = () => {
    if (window.innerWidth < MOBILE_BREAKPOINT) {
      initializeTabs();
    } else {
      resetToDesktop();
    }
  };

  setup();

  window.addEventListener("resize", setup);
}

/**
 * Initializes all pricing-page interactions.
 */
export function initPricingPage() {
  const plansRoot = document.querySelector(ROOT);
  if (plansRoot) {
    initBillingToggle(plansRoot);
  }

  if (!document.querySelector(COMPARISON)) {
    return;
  }

  initComparisonExpand();
  initComparisonGroups();
  initStickyComparisonHeader();
  initComparisonMobileTabs();
}
