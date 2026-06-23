const DEFAULT_ROOT_MARGIN = "200px 0px";

/**
 * Run work during browser idle time so it does not compete with first paint.
 * @param {() => void} callback
 * @param {{ timeout?: number }} [options]
 */
export function runWhenIdle(callback, options = {}) {
  const { timeout = 2000 } = options;

  if ("requestIdleCallback" in window) {
    requestIdleCallback(callback, { timeout });
    return;
  }

  window.setTimeout(callback, 1);
}

/**
 * @param {Element | NodeListOf<Element> | Element[] | null | undefined} targets
 * @returns {Element[]}
 */
function normalizeTargets(targets) {
  if (!targets) return [];
  if (targets instanceof Element) return [targets];
  return [...targets];
}

/**
 * Run a callback once when targets enter (or are near) the viewport.
 * @param {Element | NodeListOf<Element> | Element[] | null | undefined} targets
 * @param {(element: Element) => void} callback
 * @param {{ rootMargin?: string, threshold?: number }} [options]
 */
export function observeWhenVisible(targets, callback, options = {}) {
  const list = normalizeTargets(targets);
  if (!list.length) return;

  const { rootMargin = DEFAULT_ROOT_MARGIN, threshold = 0 } = options;

  if (!("IntersectionObserver" in window)) {
    list.forEach((element) => callback(element));
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        observer.unobserve(entry.target);
        callback(entry.target);
      });
    },
    { rootMargin, threshold },
  );

  list.forEach((element) => observer.observe(element));
}
