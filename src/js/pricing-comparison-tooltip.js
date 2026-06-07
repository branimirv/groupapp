const SECTION = ".pricing-comparison";
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

/**
 * @param {HTMLElement} modal
 */
function openModal(modal) {
  if (!modal || modal.classList.contains(ACTIVE)) return;

  modal.setAttribute("aria-hidden", "false");
  modal.classList.add(ACTIVE);
}

/**
 * @param {HTMLElement} modal
 */
function closeModal(modal) {
  if (!modal || !modal.classList.contains(ACTIVE)) return;

  modal.classList.remove(ACTIVE);
  modal.setAttribute("aria-hidden", "true");
}

function preventFocusScroll(event) {
  event.preventDefault();
}

let documentListenersBound = false;

function bindDocumentListeners() {
  if (documentListenersBound) return;
  documentListenersBound = true;

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

    const active = document.querySelector(`${MODAL}.${ACTIVE}`);
    if (active) closeModal(active);
  });
}

/**
 * @param {ParentNode} [scope]
 */
export function initPricingComparisonTooltips(scope = document) {
  const section = scope.querySelector(SECTION);
  if (!section) return;

  portalModals(scope);
  bindDocumentListeners();

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

      const modalId = openBtn.getAttribute("data-testimonials-modal-open");
      if (!modalId) return;

      const modal = document.getElementById(modalId);
      if (modal) openModal(modal);
    },
    true
  );
}
