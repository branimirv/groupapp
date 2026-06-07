const FILTER_SECTION = ".section-category-filter";
const SCROLL_CONTAINER = ".select-pl";
const FILTER_LIST = ".new-select__list";
const ACTIVE_ITEM = ".new-select__item--active";
const CATEGORY_BLOG_BODY_CLASS = "page-template-category-blog";
const MOBILE_BREAKPOINT = 992;

function isCategoryBlogPage(scope = document) {
  return (
    scope === document &&
    document.body.classList.contains(CATEGORY_BLOG_BODY_CLASS)
  );
}

/**
 * Scroll the active category pill to the leading edge on mobile/tablet.
 *
 * @param {ParentNode} [scope]
 * @param {ScrollBehavior} [behavior]
 */
function scrollActiveCategoryToStart(scope = document, behavior = "auto") {
  if (window.innerWidth > MOBILE_BREAKPOINT) return;

  const section = scope.querySelector(FILTER_SECTION);
  if (!section) return;

  const scrollEl = section.querySelector(SCROLL_CONTAINER);
  const listEl = section.querySelector(FILTER_LIST);
  const activeItem = section.querySelector(ACTIVE_ITEM);

  if (!scrollEl || !listEl || !activeItem) return;

  const paddingLeft = parseFloat(getComputedStyle(listEl).paddingLeft) || 0;
  const targetScrollLeft = Math.max(0, activeItem.offsetLeft - paddingLeft);

  scrollEl.scrollTo({
    left: targetScrollLeft,
    behavior,
  });
}

/**
 * @param {ParentNode} [scope]
 */
export function initBlogCategoryFilter(scope = document) {
  if (!isCategoryBlogPage(scope)) return;

  const section = scope.querySelector(FILTER_SECTION);
  if (!section) return;

  let resizeTimer;

  const updateScrollPosition = (behavior = "auto") => {
    scrollActiveCategoryToStart(scope, behavior);
  };

  requestAnimationFrame(() => {
    updateScrollPosition("auto");
  });

  window.addEventListener("resize", () => {
    clearTimeout(resizeTimer);
    resizeTimer = window.setTimeout(() => {
      updateScrollPosition("auto");
    }, 100);
  });

  if (typeof document.fonts !== "undefined" && document.fonts.ready) {
    document.fonts.ready.then(() => {
      updateScrollPosition("auto");
    });
  }
}
