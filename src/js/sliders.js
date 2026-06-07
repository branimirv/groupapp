import $ from "jquery";

const RESIZE_DEBOUNCE_MS = 150;

const SLIDER_ARROWS = ".slider__arrows";
const SLIDER_ARROW_PREV = ".slider__arrow--prev";
const SLIDER_ARROW_NEXT = ".slider__arrow--next";

/**
 * Debounced window resize helper (one listener per callback key).
 * @param {string} key
 * @param {() => void} callback
 */
function onDebouncedResize(key, callback) {
  const flag = `__gaResize_${key}`;
  if (window[flag]) return;

  let timer = 0;
  window[flag] = true;
  window.addEventListener(
    "resize",
    () => {
      window.clearTimeout(timer);
      timer = window.setTimeout(callback, RESIZE_DEBOUNCE_MS);
    },
    { passive: true },
  );
}

/**
 * @param {JQuery} $track
 */
function destroySlick($track) {
  if (!$track.hasClass("slick-initialized")) return;

  try {
    $track.slick("unslick");
  } catch {
    $track.removeClass("slick-initialized");
  }
}

/**
 * @param {HTMLElement} section
 */
function initCaseStudiesSliderInSection(section) {
  const $section = $(section);
  const $slider = $section.find(".case-studies__slider");
  const $track = $slider.find(".case-studies__slides");
  const $arrows = $slider.find(SLIDER_ARROWS);

  if (!$track.length) return;

  const slideCount = $track.children(".case-studies__slide").length;
  if (slideCount <= 1) {
    destroySlick($track);
    $arrows.addClass("is-hidden");
    return;
  }

  $arrows.removeClass("is-hidden");

  const refreshPosition = () => {
    const instance = $track.get(0)?.slick;
    if (instance) {
      instance.setPosition();
    }
  };

  if ($track.hasClass("slick-initialized")) {
    refreshPosition();
    return;
  }

  const refreshLayout = () => {
    window.setTimeout(refreshPosition, 0);
  };

  $track.on("init.caseStudies afterChange.caseStudies", refreshLayout);

  onDebouncedResize("caseStudies", refreshPosition);

  $track.slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    infinite: false,
    adaptiveHeight: true,
    speed: 300,
    swipe: true,
    touchThreshold: 8,
    waitForAnimate: true,
    appendArrows: $arrows,
    prevArrow: $slider.find(SLIDER_ARROW_PREV),
    nextArrow: $slider.find(SLIDER_ARROW_NEXT),
  });
}

/**
 * @param {HTMLElement} section
 */
function initTestimonialsSliderInSection(section) {
  const $section = $(section);
  const $slider = $section.find(".testimonials__slider");
  const $track = $slider.find(".testimonials__slides");
  const $arrows = $slider.find(SLIDER_ARROWS);

  if (!$track.length) return;

  const slideCount = $track.children(".testimonials__slide").length;
  if (slideCount <= 1) {
    destroySlick($track);
    $arrows.addClass("is-hidden");
    return;
  }

  $arrows.removeClass("is-hidden");

  const refreshPosition = () => {
    const instance = $track.get(0)?.slick;
    if (instance) {
      instance.setPosition();
    }
  };

  if ($track.hasClass("slick-initialized")) {
    refreshPosition();
    return;
  }

  const refreshLayout = () => {
    window.setTimeout(refreshPosition, 0);
  };

  $track.on("init.testimonials afterChange.testimonials", refreshLayout);

  onDebouncedResize("testimonials", refreshPosition);

  $track.slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    dots: false,
    infinite: true,
    adaptiveHeight: false,
    speed: 300,
    swipe: true,
    touchThreshold: 8,
    waitForAnimate: true,
    appendArrows: $arrows,
    prevArrow: $slider.find(SLIDER_ARROW_PREV),
    nextArrow: $slider.find(SLIDER_ARROW_NEXT),
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
        },
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
        },
      },
    ],
  });
}

/**
 * Initialize all Slick sliders on the page.
 * @param {ParentNode} [scope]
 */
export function initSliders(scope = document) {
  scope
    .querySelectorAll(".case-studies")
    .forEach(initCaseStudiesSliderInSection);

  scope
    .querySelectorAll(".testimonials")
    .forEach(initTestimonialsSliderInSection);
}
