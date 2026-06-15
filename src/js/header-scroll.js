/**
 * Hide header on scroll down, show on scroll up; mark when page is scrolled past top.
 */
export function initHeaderScroll() {
  const header = document.querySelector("header");
  if (!header) return;

  let lastScrollTop = 0;

  window.addEventListener(
    "scroll",
    () => {
      const currentScrollTop = window.scrollY;

      if (currentScrollTop > lastScrollTop) {
        header.classList.add("hide-header");
      } else {
        header.classList.remove("hide-header");
      }

      header.classList.toggle("not-at-top", currentScrollTop > 100);

      lastScrollTop = currentScrollTop <= 0 ? 0 : currentScrollTop;
    },
    { passive: true },
  );
}
