const ROOT = "[data-faq-accordion]";
const ITEM = ".faq__item";
const TRIGGER = ".faq__trigger";
const ANSWER = ".faq__answer";
const OPEN = "is-open";
const REDUCED_MOTION = "(prefers-reduced-motion: reduce)";

function prefersReducedMotion() {
  return window.matchMedia(REDUCED_MOTION).matches;
}

function measureAnswer(answer) {
  const previousHeight = answer.style.height;
  answer.style.height = "auto";
  const height = answer.scrollHeight;
  answer.style.height = previousHeight;
  return height;
}

function expandAnswer(answer, animate) {
  if (!animate) {
    answer.style.height = "auto";
    return;
  }

  const targetHeight = measureAnswer(answer);
  answer.style.height = "0";
  answer.offsetHeight;
  answer.style.height = `${targetHeight}px`;

  const onTransitionEnd = (event) => {
    if (event.propertyName !== "height" || event.target !== answer) {
      return;
    }

    answer.removeEventListener("transitionend", onTransitionEnd);

    if (answer.closest(ITEM)?.classList.contains(OPEN)) {
      answer.style.height = "auto";
    }
  };

  answer.addEventListener("transitionend", onTransitionEnd);
}

function collapseAnswer(answer, animate) {
  if (!animate) {
    answer.style.height = "0";
    return;
  }

  answer.style.height = `${answer.scrollHeight}px`;
  answer.offsetHeight;
  answer.style.height = "0";
}

function setItemState(item, trigger, isOpen, animate) {
  const answer = item.querySelector(ANSWER);

  item.classList.toggle(OPEN, isOpen);
  trigger.setAttribute("aria-expanded", isOpen ? "true" : "false");

  if (!answer) {
    return;
  }

  if (isOpen) {
    expandAnswer(answer, animate);
  } else {
    collapseAnswer(answer, animate);
  }
}

function initAccordion(accordion) {
  const items = [...accordion.querySelectorAll(ITEM)];
  const animate = !prefersReducedMotion();

  if (!items.length) {
    return;
  }

  items.forEach((item) => {
    const trigger = item.querySelector(TRIGGER);
    const answer = item.querySelector(ANSWER);

    if (!trigger || !answer) {
      return;
    }

    if (item.classList.contains(OPEN)) {
      answer.style.height = "auto";
    } else {
      answer.style.height = "0";
    }

    trigger.addEventListener("click", () => {
      const isOpen = item.classList.contains(OPEN);
      const currentlyOpen = items.find((other) => other.classList.contains(OPEN));

      if (!isOpen) {
        setItemState(item, trigger, true, animate);

        if (currentlyOpen) {
          const openTrigger = currentlyOpen.querySelector(TRIGGER);

          if (openTrigger) {
            setItemState(currentlyOpen, openTrigger, false, animate);
          }
        }
      } else {
        setItemState(item, trigger, false, animate);
      }
    });
  });

  if (!animate) {
    accordion.classList.add("faq--reduced-motion");
  }

  let resizeTimer = 0;
  window.addEventListener("resize", () => {
    window.clearTimeout(resizeTimer);
    resizeTimer = window.setTimeout(() => {
      items.forEach((item) => {
        const answer = item.querySelector(ANSWER);

        if (!answer || !item.classList.contains(OPEN)) {
          return;
        }

        answer.style.height = "auto";
      });
    }, 100);
  });
}

/**
 * Initializes shared FAQ accordions (pricing, integrations, etc.).
 */
export function initFaqAccordion() {
  document.querySelectorAll(ROOT).forEach(initAccordion);
}
