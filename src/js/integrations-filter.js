const FILTER_CONTAINER = ".integrations-filter";
const FILTER_FORM = "#integration-filter-form";
const FILTER_ITEM = ".category-filter";
const FILTER_ALL = "#filter-all";
const INTEGRATION_ITEM = ".integration-item";
const MOBILE_BREAKPOINT = 992;

/**
 * @param {ParentNode} [scope]
 */
export function initIntegrationsFilter(scope = document) {
  const filterContainer = scope.querySelector(FILTER_CONTAINER);
  const filterForm = scope.querySelector(FILTER_FORM);

  if (!filterContainer || !filterForm) return;

  const filterItems = filterContainer.querySelectorAll(FILTER_ITEM);
  const allCheckbox = filterContainer.querySelector(FILTER_ALL);
  const integrationItems = scope.querySelectorAll(INTEGRATION_ITEM);

  function updateActiveFilterClasses() {
    filterItems.forEach((filter) => {
      const item = filter.closest(".new-select__item");
      if (item) {
        item.classList.toggle("new-select__item--active", filter.checked);
      }
    });
  }

  function filterIntegrationItems() {
    let selectedCategory = null;
    filterItems.forEach((cb) => {
      if (cb.checked) selectedCategory = cb.value;
    });

    if (!selectedCategory || selectedCategory === "all") {
      if (allCheckbox) allCheckbox.checked = true;
      integrationItems.forEach((item) => {
        item.style.display = "";
      });
      return;
    }

    integrationItems.forEach((item) => {
      item.style.display = item.classList.contains(selectedCategory)
        ? ""
        : "none";
    });
  }

  function scrollActiveFilterIntoView() {
    if (window.innerWidth > MOBILE_BREAKPOINT) return;

    const activeFilter = filterContainer.querySelector("input:checked");
    if (!activeFilter) return;

    const activeLabel = activeFilter.nextElementSibling;
    if (!activeLabel) return;

    const containerRect = filterForm.getBoundingClientRect();
    const labelRect = activeLabel.getBoundingClientRect();
    const currentScrollLeft = filterForm.scrollLeft;
    const labelLeftRelative = labelRect.left - containerRect.left;
    const labelRightRelative = labelRect.right - containerRect.right;

    if (labelLeftRelative < 0) {
      filterForm.scrollLeft = currentScrollLeft + labelLeftRelative - 20;
    } else if (labelRightRelative > 0) {
      filterForm.scrollLeft = currentScrollLeft + labelRightRelative + 20;
    }
  }

  filterItems.forEach((filter) => {
    filter.addEventListener("change", () => {
      filterItems.forEach((other) => {
        if (other !== filter) other.checked = false;
      });

      const anyChecked = Array.from(filterItems).some((c) => c.checked);
      if (!anyChecked && allCheckbox) allCheckbox.checked = true;

      updateActiveFilterClasses();
      filterIntegrationItems();

      setTimeout(scrollActiveFilterIntoView, 50);
    });
  });

  updateActiveFilterClasses();

  let isDragging = false;
  let startX = 0;
  let scrollLeft = 0;

  filterForm.addEventListener("mousedown", (e) => {
    if (window.innerWidth > MOBILE_BREAKPOINT) return;

    isDragging = true;
    startX = e.pageX - filterForm.offsetLeft;
    scrollLeft = filterForm.scrollLeft;
    filterForm.style.cursor = "grabbing";
  });

  filterForm.addEventListener("mouseleave", () => {
    if (window.innerWidth > MOBILE_BREAKPOINT) return;

    isDragging = false;
    filterForm.style.cursor = "grab";
  });

  filterForm.addEventListener("mouseup", () => {
    if (window.innerWidth > MOBILE_BREAKPOINT) return;

    isDragging = false;
    filterForm.style.cursor = "grab";
  });

  filterForm.addEventListener("mousemove", (e) => {
    if (window.innerWidth > MOBILE_BREAKPOINT || !isDragging) return;

    e.preventDefault();
    const x = e.pageX - filterForm.offsetLeft;
    const walk = (x - startX) * 2;
    filterForm.scrollLeft = scrollLeft - walk;
  });

  filterForm.addEventListener("touchstart", (e) => {
    if (window.innerWidth > MOBILE_BREAKPOINT) return;

    isDragging = true;
    startX = e.touches[0].pageX - filterForm.offsetLeft;
    scrollLeft = filterForm.scrollLeft;
  });

  filterForm.addEventListener("touchmove", (e) => {
    if (window.innerWidth > MOBILE_BREAKPOINT || !isDragging) return;

    const x = e.touches[0].pageX - filterForm.offsetLeft;
    const walk = (x - startX) * 2;
    filterForm.scrollLeft = scrollLeft - walk;
  });

  filterForm.addEventListener("touchend", () => {
    if (window.innerWidth > MOBILE_BREAKPOINT) return;

    isDragging = false;
  });

  function updateCursor() {
    filterForm.style.cursor =
      window.innerWidth <= MOBILE_BREAKPOINT ? "grab" : "default";
  }

  updateCursor();

  window.addEventListener("resize", updateCursor);
  window.addEventListener("resize", () => {
    setTimeout(scrollActiveFilterIntoView, 100);
  });

  filterIntegrationItems();
  setTimeout(scrollActiveFilterIntoView, 100);
}
