/**
 * Hero rotating phrases — same timing pattern as CodePen abwZmoO:
 * fade out 400ms → swap → fade in 400ms, next cycle after 1500ms idle.
 */

const CONTAINER = "[data-hero-rotating]";
const LIST = ".hero__rotating-list";
const ITEM = "li";
const ACTIVE = "is-active";

const FADE_MS = 400;
const INTERVAL_MS = 1500;

function prefersReducedMotion() {
  return window.matchMedia("(prefers-reduced-motion: reduce)").matches;
}

function waitFadeOut(el, done) {
  let finished = false;
  const finish = () => {
    if (finished) return;
    finished = true;
    el.removeEventListener("transitionend", onEnd);
    window.clearTimeout(fallback);
    done();
  };
  const onEnd = (e) => {
    if (e.propertyName === "opacity") finish();
  };
  const fallback = window.setTimeout(finish, FADE_MS + 80);
  el.addEventListener("transitionend", onEnd);
}

/**
 * @param {ParentNode} [root]
 */
export function initHeroRotatingText(root = document) {
  if (prefersReducedMotion()) return;

  root.querySelectorAll(CONTAINER).forEach((container) => {
    const list = container.querySelector(LIST);
    if (!list) return;

    const items = list.querySelectorAll(ITEM);
    const n = items.length;
    if (n <= 1) {
      if (n === 1) items[0].classList.add(ACTIVE);
      return;
    }

    let index = [...items].findIndex((li) => li.classList.contains(ACTIVE));
    if (index < 0) {
      index = 0;
      items.forEach((li) => li.classList.remove(ACTIVE));
      items[0].classList.add(ACTIVE);
    }

    let timeoutId = 0;

    const schedule = () => {
      window.clearTimeout(timeoutId);
      timeoutId = window.setTimeout(step, INTERVAL_MS);
    };

    const step = () => {
      const current = items[index];
      current.classList.remove(ACTIVE);

      waitFadeOut(current, () => {
        index = (index + 1) % n;
        const next = items[index];
        // Ensure next paints from opacity 0 before turning active (match jQuery fadeIn)
        window.requestAnimationFrame(() => {
          next.classList.add(ACTIVE);
          schedule();
        });
      });
    };

    schedule();
  });
}
