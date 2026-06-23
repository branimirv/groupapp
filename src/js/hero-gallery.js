import $ from "jquery";
import { observeWhenVisible } from "./utils/defer-init";

const HERO_GALLERY_BREAKPOINT = 992;
const HERO_GALLERY_RESIZE_DEBOUNCE_MS = 150;

/**
 * Restore a clean slider root: only direct .hero__gallery-item children.
 * Fixes orphan .slick-list / duplicated slides after HMR or failed inits.
 *
 * @param {JQuery} $gallery
 */
function resetHeroGalleryDom($gallery) {
  if ($gallery.get(0)?.slick) {
    try {
      $gallery.slick("unslick");
      return;
    } catch {
      // Fall through to manual rebuild.
    }
  }

  const items = [];

  $gallery.find(".hero__gallery-item").not(".slick-cloned").each(function () {
    items.push(this.cloneNode(true));
  });

  if (!items.length) {
    $gallery.children().each(function () {
      const el = this;
      if (
        el.classList.contains("slick-list") ||
        el.classList.contains("slick-track") ||
        el.classList.contains("slick-arrow") ||
        el.classList.contains("slick-dots")
      ) {
        return;
      }
      items.push(el.cloneNode(true));
    });
  }

  $gallery.empty().removeClass("slick-initialized slick-slider");
  items.forEach((node) => $gallery.append(node));
}

/**
 * @param {JQuery} $gallery
 * @returns {number}
 */
function getHeroGallerySlideCount($gallery) {
  return $gallery.children(".hero__gallery-item").length;
}

/**
 * @param {number} slideCount
 * @returns {object}
 */
function getHeroGallerySlickOptions(slideCount) {
  const initialSlide = Math.max(0, Math.floor(slideCount / 2));

  // variableWidth + fixed slide width (CSS) so slides are narrower than the
  // list — neighbors can sit in the centerPadding zone (Slick demo behavior).
  return {
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    dots: false,
    infinite: true,
    centerMode: true,
    centerPadding: "80px",
    variableWidth: true,
    initialSlide,
    swipe: true,
    swipeToSlide: true,
    touchMove: true,
    responsive: [
      {
        breakpoint: 768,
        settings: {
          centerMode: true,
          centerPadding: "70px",
          slidesToShow: 1,
          variableWidth: true,
        },
      },
      {
        breakpoint: 480,
        settings: {
          centerMode: true,
          centerPadding: "60px",
          slidesToShow: 1,
          variableWidth: true,
        },
      },
    ],
  };
}

/**
 * @param {JQuery} $gallery
 */
function destroyHeroGallerySlider($gallery) {
  resetHeroGalleryDom($gallery);
}

/**
 * @param {JQuery} $gallery
 */
function initHeroGallerySliderInSection($gallery) {
  if (!$gallery.length) return;

  const isMobileOrTablet = window.innerWidth <= HERO_GALLERY_BREAKPOINT;

  if (!isMobileOrTablet) {
    destroyHeroGallerySlider($gallery);
    return;
  }

  resetHeroGalleryDom($gallery);

  const slideCount = getHeroGallerySlideCount($gallery);

  if (slideCount <= 1) {
    return;
  }

  $gallery.off("init.heroGallery").one("init.heroGallery", () => {
    window.requestAnimationFrame(() => {
      if ($gallery.get(0)?.slick) {
        $gallery.slick("setPosition");
      }
    });
  });

  $gallery.slick(getHeroGallerySlickOptions(slideCount));
}

/**
 * @param {ParentNode} [scope]
 */
export function initHeroGallerySlider(scope = document) {
  const galleries = Array.from(scope.querySelectorAll(".hero__gallery"));
  if (!galleries.length) return;

  const initialized = new WeakSet();

  const setupGallery = (gallery) => {
    if (initialized.has(gallery)) {
      initHeroGallerySliderInSection($(gallery));
      return;
    }

    initialized.add(gallery);
    initHeroGallerySliderInSection($(gallery));
  };

  observeWhenVisible(
    galleries,
    (gallery) => setupGallery(gallery),
    { rootMargin: "300px 0px" },
  );

  let resizeTimer = 0;
  let lastWindowWidth = window.innerWidth;

  window.addEventListener(
    "resize",
    () => {
      const currentWidth = window.innerWidth;
      if (currentWidth === lastWindowWidth) return;
      lastWindowWidth = currentWidth;

      window.clearTimeout(resizeTimer);
      resizeTimer = window.setTimeout(() => {
        galleries.forEach((gallery) => {
          if (initialized.has(gallery)) {
            initHeroGallerySliderInSection($(gallery));
          }
        });
      }, HERO_GALLERY_RESIZE_DEBOUNCE_MS);
    },
    { passive: true },
  );
}
