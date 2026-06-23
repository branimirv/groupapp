import $ from "jquery";
import { observeWhenVisible } from "./utils/defer-init";

const RESIZE_DEBOUNCE_MS = 150;
const LAZY_ROOT_MARGIN = "200px 0px";

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
    window.requestAnimationFrame(refreshPosition);
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
    window.requestAnimationFrame(refreshPosition);
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
 * Customer stories top slider (`.slider.slick-not-init`).
 * @param {HTMLElement} sliderEl
 */
function initCustomerStoriesSliderElement(sliderEl) {
  const $slider = $(sliderEl);
  if (!$slider.length || !$slider.hasClass("slick-not-init")) return;

  try {
    $slider
      .on("init", function () {
        $(this).removeClass("slick-not-init").addClass("slick-initialized");
      })
      .slick({
        dots: true,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 4000,
        pauseOnFocus: false,
        pauseOnHover: false,
        fade: true,
        cssEase: "ease-in-out",
        speed: 500,
      });
  } catch (error) {
    console.warn("Slick slider initialization failed:", error);
    $slider.removeClass("slick-not-init").addClass("slick-fallback");
    return;
  }

  window.setTimeout(() => {
    if ($slider.hasClass("slick-not-init")) {
      $slider.removeClass("slick-not-init").addClass("slick-fallback");
    }
  }, 1000);
}

/**
 * Initialize all Slick sliders on the page when their sections enter the viewport.
 * @param {ParentNode} [scope]
 */
export function initSliders(scope = document) {
  observeWhenVisible(
    scope.querySelectorAll(".case-studies"),
    initCaseStudiesSliderInSection,
    { rootMargin: LAZY_ROOT_MARGIN },
  );

  observeWhenVisible(
    scope.querySelectorAll(".testimonials"),
    initTestimonialsSliderInSection,
    { rootMargin: LAZY_ROOT_MARGIN },
  );

  observeWhenVisible(
    scope.querySelectorAll(".slider.slick-not-init"),
    initCustomerStoriesSliderElement,
    { rootMargin: LAZY_ROOT_MARGIN },
  );
}
