const SECTION = ".testimonials";
const OPEN = "[data-testimonials-modal-open]";
const CLOSE = "[data-testimonials-modal-close]";
const MODAL = ".testimonials-modal";
const ACTIVE = "is-active";

function portalModals(scope) {
  scope.querySelectorAll(MODAL).forEach((modal) => {
    if (modal.parentElement !== document.body) {
      document.body.appendChild(modal);
    }
  });
}

function getModal(id) {
  return document.getElementById(id);
}

/**
 * @param {HTMLElement} modal
 */
function openModal(modal) {
  if (!modal || modal.classList.contains(ACTIVE)) return;

  modal.setAttribute("aria-hidden", "false");
  modal.classList.add(ACTIVE);
}

function closeModal(modal) {
  if (!modal || !modal.classList.contains(ACTIVE)) return;

  modal.classList.remove(ACTIVE);
  modal.setAttribute("aria-hidden", "true");
}

function closeActiveModal() {
  const active = document.querySelector(`${MODAL}.${ACTIVE}`);
  if (active) closeModal(active);
}

/**
 * Prevent focus on mousedown so the browser does not scroll the page
 * to bring the slider button into view (common inside Slick).
 */
function preventFocusScroll(event) {
  event.preventDefault();
}

/**
 * @param {ParentNode} [scope]
 */
export function initTestimonialsModals(scope = document) {
  const sections = scope.querySelectorAll(SECTION);
  if (!sections.length) return;

  portalModals(scope);

  sections.forEach((section) => {
    section.addEventListener(
      "mousedown",
      (event) => {
        if (!event.target.closest(OPEN)) return;
        preventFocusScroll(event);
      },
      true
    );

    section.addEventListener(
      "click",
      (event) => {
        const openBtn = event.target.closest(OPEN);
        if (!openBtn || !section.contains(openBtn)) return;

        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();

        const modalId = openBtn.getAttribute("data-testimonials-modal-open");
        if (!modalId) return;

        const modal = getModal(modalId);
        if (modal) openModal(modal);
      },
      true
    );
  });

  document.addEventListener(
    "mousedown",
    (event) => {
      const closeTarget = event.target.closest(CLOSE);
      if (!closeTarget || !closeTarget.closest(MODAL)) return;
      preventFocusScroll(event);
    },
    true
  );

  document.addEventListener("click", (event) => {
    const closeTarget = event.target.closest(CLOSE);
    if (!closeTarget) return;

    const modal = closeTarget.closest(MODAL);
    if (!modal || !modal.classList.contains(ACTIVE)) return;

    event.preventDefault();
    closeModal(modal);
  });

  document.addEventListener("keydown", (event) => {
    if (event.key !== "Escape") return;
    if (!document.querySelector(`${MODAL}.${ACTIVE}`)) return;
    closeActiveModal();
  });
}
