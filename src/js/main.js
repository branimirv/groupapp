import $ from "jquery";
import { initHeroRotatingText } from "./hero-rotating-text";
import { initHeroGallerySlider } from "./hero-gallery";
import { initProgramDeliveryTabs } from "./program-delivery-tabs";
import { initIntegrationsHome } from "./integrations-home";
import { initIntegrationsFilter } from "./integrations-filter";
import { initBlogCategoryFilter } from "./blog-category-filter";
import { initSliders } from "./sliders";
import { initTestimonialsModals } from "./testimonials-modal";
import { initFaqAccordion } from "./faq-accordion";
import { initPricingPage } from "./pricing-page";
import { initPricingComparisonTooltips } from "./pricing-comparison-tooltip";
import { initMegaMenu } from "./mega-menu";
import { initFooterAccordion } from "./footer-accordion";
import { initHeaderScroll } from "./header-scroll";
import { observeWhenVisible, runWhenIdle } from "./utils/defer-init";

window.jQuery = window.$ = $;

// Import Bootstrap JS (requires Popper.js)
import "popper.js";
import "bootstrap";
// Import SCSS
import "../scss/main.scss";

// Import Slick Slider
import "slick-carousel/slick/slick.css";
import "slick-carousel";

const LAZY_ROOT_MARGIN = "200px 0px";

document.addEventListener("DOMContentLoaded", function () {
  // Critical for above-the-fold interaction.
  initHeroRotatingText();
  initMegaMenu();
  initHeaderScroll();

  initHeroGallerySlider();
  initSliders();

  observeWhenVisible(
    document.querySelectorAll(".creators__gallery"),
    (gallery) => initCreatorsSlider(gallery),
    { rootMargin: LAZY_ROOT_MARGIN },
  );

  initCommunityAndAutomationsSliders();

  observeWhenVisible(
    document.querySelectorAll(".sliderComments"),
    () => initCommentsSlider(),
    { rootMargin: LAZY_ROOT_MARGIN },
  );

  observeWhenVisible(
    document.querySelectorAll(".offer--overview"),
    () => initOfferOverviewSlider(),
    { rootMargin: LAZY_ROOT_MARGIN },
  );

  observeWhenVisible(
    document.querySelectorAll(".offer--customers"),
    () => initOfferCustomersSlider(),
    { rootMargin: LAZY_ROOT_MARGIN },
  );

  observeWhenVisible(
    document.querySelectorAll(".offer--built-in"),
    () => initOfferBuiltInSlider(),
    { rootMargin: LAZY_ROOT_MARGIN },
  );

  runWhenIdle(() => {
    initProgramDeliveryTabs();
    // TEMP: Disabled until all integration category images are available.
    // Re-enable when images are ready: initIntegrationsHome();
    initIntegrationsFilter();
    initBlogCategoryFilter();
    initTestimonialsModals();
    initFaqAccordion();
    initPricingPage();
    initPricingComparisonTooltips();
    initFooterAccordion();
    initOfferFaqAccordion();
    initFeatureTabContainers();
    initStandaloneAccordions();
    initMobilePostAd();
    initChaptersTOC();
    initChaptersAccordion();
    initChaptersAdSwap();
  });
});

let creatorsResizeAttached = false;

function initCreatorsSlider(creatorsGallery) {
  if (!creatorsGallery) return;

  const $gallery = $(creatorsGallery);

  if (window.innerWidth <= 992) {
    if ($gallery.hasClass("slick-initialized")) return;

    const totalSlides = $gallery.find("> div").length;
    const initialSlide = Math.max(1, Math.floor(totalSlides / 2));

    $gallery.slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: false,
      infinite: true,
      centerMode: true,
      centerPadding: "25%",
      variableWidth: false,
      autoplay: true,
      autoplaySpeed: 3000,
      focusOnSelect: true,
      initialSlide: initialSlide,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
            centerPadding: "20%",
            initialSlide: initialSlide,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            centerMode: true,
            centerPadding: "15%",
            initialSlide: initialSlide,
            variableWidth: true,
          },
        },
      ],
    });
  } else if ($gallery.hasClass("slick-initialized")) {
    $gallery.slick("unslick");
  }

  if (!creatorsResizeAttached) {
    creatorsResizeAttached = true;

    let resizeTimer;
    window.addEventListener("resize", function () {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(function () {
        document.querySelectorAll(".creators__gallery").forEach((gallery) => {
          initCreatorsSlider(gallery);
        });
      }, 250);
    });
  }
}

function initCommunityAndAutomationsSliders() {
  const communitySliders = document.querySelectorAll(".community-items-slider");
  const automationsSliders = document.querySelectorAll(
    ".automations-items-slider"
  );

  // Combine both slider types
  const allSliders = [...communitySliders, ...automationsSliders];

  function initializeSlider(slider) {
    if (slider && window.innerWidth <= 992) {
      // Check if slider is already initialized
      if ($(slider).hasClass("slick-initialized")) {
        $(slider).slick("unslick");
      }

      // Initialize slick slider on mobile
      $(slider).slick({
        slidesToShow: 1.3,
        slidesToScroll: 1,
        arrows: false,
        dots: true,
        infinite: false,
        centerMode: false,
        variableWidth: false,
        adaptiveHeight: false,
        autoplay: false,
        focusOnSelect: true,
        initialSlide: 0,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1.2,
              slidesToScroll: 1,
              centerMode: false,
              variableWidth: false,
              infinite: false,
              adaptiveHeight: false,
              initialSlide: 0,
              dots: true,
            },
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1.1,
              slidesToScroll: 1,
              centerMode: false,
              variableWidth: false,
              infinite: false,
              adaptiveHeight: false,
              initialSlide: 0,
              dots: true,
            },
          },
        ],
      });
    } else {
      // Destroy slider on desktop
      if ($(slider).hasClass("slick-initialized")) {
        $(slider).slick("unslick");
      }
    }
  }

  // Make initializeSlider available globally
  window.initializeSlider = initializeSlider;

  observeWhenVisible(allSliders, (slider) => {
    initializeSlider(slider);
  }, { rootMargin: LAZY_ROOT_MARGIN });

  // Function to reinitialize sliders in active tab
  function reinitializeActiveSliders(container) {
    if (
      container.classList.contains("community") ||
      container.classList.contains("automations")
    ) {
      // Small delay to ensure tab content is visible before initializing slider
      setTimeout(() => {
        const activeTab = container.querySelector(".tab-content .tab.active");
        if (activeTab) {
          const slider = activeTab.querySelector(
            ".community-items-slider, .automations-items-slider"
          );
          if (slider) {
            initializeSlider(slider);
          }
        }
      }, 150);
    }
  }

  // Make this function available globally so it can be called from tab switching
  window.reinitializeActiveSliders = reinitializeActiveSliders;

  // Handle window resize
  let resizeTimer;
  window.addEventListener("resize", function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
      allSliders.forEach((slider) => {
        initializeSlider(slider);
      });
    }, 250);
  });
}

// Initialize Comments Slider
function initCommentsSlider() {
  const $carousel = $(".sliderComments");

  if (!$carousel.length) return; // Exit if slider doesn't exist

  function initializeSlider() {
    if (!$carousel.hasClass("slick-initialized")) {
      $carousel.slick({
        slidesToScroll: 1,
        variableWidth: true,
        prevArrow: $(".slick-slider__buttonPrev"),
        nextArrow: $(".slick-slider__buttonNext"),
        centerMode: true,
        initialSlide: 3,
        infinite: false,
        arrows: true,
        dots: false,
        responsive: [
          {
            breakpoint: 992,
            settings: {
              slidesToShow: 1.2,
              slidesToScroll: 1,
              centerMode: false,
              variableWidth: false,
              initialSlide: 0,
              arrows: true,
              infinite: false,
            },
          },
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 1.1,
              slidesToScroll: 1,
              centerMode: false,
              variableWidth: false,
              initialSlide: 0,
              arrows: true,
              infinite: false,
            },
          },
        ],
      });
    }
  }

  // Initialize on page load
  initializeSlider();

  // Handle window resize
  let resizeTimer;
  $(window).on("resize", function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
      if ($carousel.hasClass("slick-initialized")) {
        $carousel.slick("unslick");
      }
      initializeSlider();
    }, 300);
  });
}

// Initialize Offer FAQ Accordion
function initOfferFaqAccordion() {
  const faqList = document.querySelector(".offer--faq__list");
  if (!faqList) return;

  const faqItems = faqList.querySelectorAll(".offer--faq__list-item");

  faqItems.forEach((item) => {
    const question = item.querySelector(".offer--faq__list-item__question");
    const answer = item.querySelector(".offer--faq__list-item__answer");
    if (!question || !answer) return;

    question.addEventListener("click", function () {
      const isCurrentlyOpen = item.classList.contains("is-open");
      const icon = item.querySelector(".offer--faq__list-item__icon");

      // Close all items
      faqItems.forEach((otherItem) => {
        const otherAnswer = otherItem.querySelector(
          ".offer--faq__list-item__answer"
        );
        otherItem.classList.remove("is-open");
        if (otherAnswer) {
          otherAnswer.style.maxHeight = "0";
        }
        const otherIcon = otherItem.querySelector(
          ".offer--faq__list-item__icon"
        );
        if (otherIcon) {
          otherIcon.textContent = "+";
        }
      });

      // If the clicked item wasn't open, open it
      if (!isCurrentlyOpen) {
        item.classList.add("is-open");
        // Set max-height to the actual content height
        answer.style.maxHeight = answer.scrollHeight + "px";
        if (icon) {
          icon.textContent = "−";
        }
      } else {
        // If it was already open, just close it (icon already set to + above)
        answer.style.maxHeight = "0";
        if (icon) {
          icon.textContent = "+";
        }
      }
    });

    // Set initial height for items that are open by default
    if (item.classList.contains("is-open")) {
      answer.style.maxHeight = answer.scrollHeight + "px";
    }
  });
}

// Initialize Offer Customers Slider
function initOfferCustomersSlider() {
  const $customersList = $(".offer--customers__list");

  if (!$customersList.length) return; // Exit if slider doesn't exist

  // Destroy existing slider if it exists
  if ($customersList.hasClass("slick-initialized")) {
    try {
      $customersList.slick("unslick");
    } catch (e) {
      console.warn("Error destroying customers slider:", e);
      $customersList.removeClass("slick-initialized");
    }
  }

  // Small delay to ensure DOM is ready
  setTimeout(() => {
    // Initialize slick slider - same settings for mobile and desktop
    $customersList.slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      dots: true,
      infinite: true,
      autoplay: false,
      fade: false,
      speed: 300,
      swipe: true,
      touchMove: true,
      draggable: true,
      touchThreshold: 5,
      swipeToSlide: true,
    });

    // Prevent page jump when clicking on dots
    $customersList.on("click", ".slick-dots button", function (e) {
      e.preventDefault();
      e.stopPropagation();
    });

    // Also prevent default on anchor tags within dots (if any)
    $customersList.on("click", ".slick-dots a", function (e) {
      e.preventDefault();
      e.stopPropagation();
      return false;
    });
  }, 100);
}

// Initialize Offer Built-In Slider (mobile only)
let offerBuiltInResizeTimer;
let offerBuiltInResizeHandlerAttached = false;

function initOfferBuiltInSlider() {
  const $builtInList = $(".offer--built-in__list");

  if (!$builtInList.length) return; // Exit if slider doesn't exist

  function initializeSlider() {
    const isMobile = window.innerWidth <= 768;

    if (isMobile) {
      // Check if slider is already initialized
      if ($builtInList.hasClass("slick-initialized")) {
        try {
          $builtInList.slick("unslick");
        } catch (e) {
          console.warn("Error destroying built-in slider:", e);
          $builtInList.removeClass("slick-initialized");
        }
      }

      // Hide slider initially to prevent jump
      $builtInList.css({ opacity: 0, visibility: "hidden" });

      // Small delay to ensure DOM is ready
      setTimeout(() => {
        // Initialize slick slider on mobile
        // Based on common fixes from Slick GitHub issues for flickering
        $builtInList.slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          dots: true,
          infinite: true,
          autoplay: false,
          fade: false,
          speed: 300,
          swipe: true,
          touchMove: true,
          draggable: true,
          touchThreshold: 10, // Increased threshold to prevent accidental swipes
          swipeToSlide: false, // Disabled to prevent flickering (common fix)
          useCSS: true,
          useTransform: true,
          cssEase: "ease",
          waitForAnimate: true,
          adaptiveHeight: false, // Prevent height changes during slide
          initialSlide: 0, // Explicitly set first slide
        });

        // Fix first slide position and show slider
        $builtInList.on("init", function () {
          // Set position to ensure first slide is correct
          $builtInList.slick("setPosition");

          // Small delay then show slider to prevent jump
          setTimeout(() => {
            $builtInList.css({ opacity: 1, visibility: "visible" });
          }, 50);
        });

        // Also handle after init in case init event doesn't fire
        setTimeout(() => {
          $builtInList.slick("setPosition");
          $builtInList.css({ opacity: 1, visibility: "visible" });
        }, 100);
      }, 100);
    } else {
      // Destroy slider on desktop
      if ($builtInList.hasClass("slick-initialized")) {
        try {
          $builtInList.slick("unslick");
        } catch (e) {
          console.warn("Error destroying built-in slider:", e);
          $builtInList.removeClass("slick-initialized");
        }
      }
    }
  }

  // Initialize on page load with a small delay to ensure DOM is ready
  setTimeout(() => {
    initializeSlider();
  }, 200);

  // Attach resize handler only once
  if (!offerBuiltInResizeHandlerAttached) {
    $(window).on("resize.offerBuiltIn", function () {
      clearTimeout(offerBuiltInResizeTimer);
      offerBuiltInResizeTimer = setTimeout(function () {
        initializeSlider();
      }, 300);
    });
    offerBuiltInResizeHandlerAttached = true;
  }
}

// Initialize Offer Overview Slider Syncing
let offerOverviewResizeTimer;
let offerOverviewResizeHandlerAttached = false;

function initOfferOverviewSlider() {
  const $sliderFor = $(".offer--overview .slider-for");
  const $sliderNav = $(".offer--overview .slider-nav");

  if (!$sliderFor.length || !$sliderNav.length) return; // Exit if sliders don't exist

  const isDesktop = window.innerWidth > 1192;

  // Destroy existing sliders if they exist - use try-catch to prevent errors
  try {
    if ($sliderFor.hasClass("slick-initialized")) {
      $sliderFor.slick("unslick");
    }
  } catch (e) {
    console.warn("Error destroying slider-for:", e);
    $sliderFor.removeClass("slick-initialized");
  }

  try {
    if ($sliderNav.hasClass("slick-initialized")) {
      $sliderNav.slick("unslick");
    }
  } catch (e) {
    console.warn("Error destroying slider-nav:", e);
    $sliderNav.removeClass("slick-initialized");
  }

  // Small delay to ensure sliders are fully destroyed before reinitializing
  setTimeout(() => {
    if (isDesktop) {
      // Desktop: Initialize only slider-for, use custom navigation
      $sliderFor.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        infinite: true,
        centerMode: true,
        focusOnSelect: true,
        asNavFor: null,
        centerPadding: "8px",
        useCSS: true,
        useTransform: true,
        waitForAnimate: true,
        initialSlide: 0,
      });

      // Fix first slide position
      setTimeout(() => {
        $sliderFor.slick("setPosition");
      }, 50);

      const $navItems = $sliderNav.find(".offer--overview__nav-item");

      const setActiveNavItem = (index) => {
        $navItems.removeClass("active");
        $navItems.eq(index).addClass("active");
      };

      $navItems.off("click.offerNav").on("click.offerNav", function () {
        const index = $(this).index();
        $sliderFor.slick("slickGoTo", index);
      });

      $sliderFor
        .off("afterChange.offerNav")
        .on("afterChange.offerNav", function (event, slick, currentSlide) {
          setActiveNavItem(currentSlide);
        });

      setActiveNavItem($sliderFor.slick("slickCurrentSlide") || 0);
    } else {
      // Mobile/Tablet: Same as desktop but nav is scrollable (not a Slick slider)
      // Initialize main slider with simpler settings to reduce flickering
      $sliderFor.slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        infinite: true,
        centerMode: false,
        focusOnSelect: false, // Disabled to reduce conflicts
        swipe: true,
        touchMove: true,
        draggable: true,
        touchThreshold: 8, // Moderate threshold
        swipeToSlide: false, // Disabled to prevent flickering
        useCSS: true,
        useTransform: true,
        speed: 300,
        waitForAnimate: true,
        adaptiveHeight: false,
        initialSlide: 0,
      });

      // Fix first slide position after initialization
      setTimeout(() => {
        $sliderFor.slick("setPosition");
      }, 50);

      // Use the same active state management as desktop
      const $navItems = $sliderNav.find(".offer--overview__nav-item");

      const setActiveNavItem = (index) => {
        $navItems.removeClass("active");
        $navItems.eq(index).addClass("active");

        // Scroll active nav item into view on mobile/tablet
        const $activeItem = $navItems.eq(index);
        if ($activeItem.length && window.innerWidth <= 1192) {
          // Use setTimeout to ensure DOM is ready and layout is calculated
          setTimeout(() => {
            const navContainer = $sliderNav[0];
            if (!navContainer) return;

            const itemOffset =
              $activeItem.position().left + navContainer.scrollLeft;
            const itemWidth = $activeItem.outerWidth();
            const containerWidth = navContainer.offsetWidth;

            navContainer.scrollTo({
              left: itemOffset - containerWidth / 2 + itemWidth / 2,
              behavior: "smooth",
            });
          }, 100);
        }
      };

      $navItems.off("click.offerNav").on("click.offerNav", function () {
        const index = $(this).index();
        $sliderFor.slick("slickGoTo", index);
      });

      $sliderFor
        .off("afterChange.offerNav")
        .on("afterChange.offerNav", function (event, slick, currentSlide) {
          setActiveNavItem(currentSlide);
        });

      setActiveNavItem($sliderFor.slick("slickCurrentSlide") || 0);
    }
  }, 50);

  // Attach resize handler only once
  if (!offerOverviewResizeHandlerAttached) {
    $(window).on("resize.offerOverview", function () {
      clearTimeout(offerOverviewResizeTimer);
      offerOverviewResizeTimer = setTimeout(function () {
        initOfferOverviewSlider();
      }, 300);
    });
    offerOverviewResizeHandlerAttached = true;
  }
}

function initFeatureTabContainers() {
  const tabContainers = document.querySelectorAll(
    ".community, .lms, .automations, .membership, .branding-and-customization"
  );

  tabContainers.forEach((container) => {
    const tabLinks = container.querySelectorAll(".tabs a");
    const tabsContainer = container.querySelector(".tabs");

    // Different sections have different content selectors
    let tabContent;
    if (
      container.classList.contains("lms") ||
      container.classList.contains("membership") ||
      container.classList.contains("branding-and-customization")
    ) {
      // For LMS, membership, and branding sections, tabs are in .lms__tab-panels
      tabContent = container.querySelectorAll(".lms__tab-panels .tab");
    } else {
      // For community and automations sections, tabs are in .tab-content
      tabContent = container.querySelectorAll(".tab-content .tab");
    }

    // Function to scroll active tab into view
    function scrollActiveTabIntoView() {
      if (window.innerWidth <= 992) {
        const activeTab = container.querySelector(".tabs li.active");
        if (activeTab) {
          const containerRect = tabsContainer.getBoundingClientRect();
          const tabRect = activeTab.getBoundingClientRect();
          const scrollLeft = tabsContainer.scrollLeft;

          // Calculate if tab is outside visible area
          const tabLeftRelative = tabRect.left - containerRect.left;
          const tabRightRelative = tabRect.right - containerRect.right;

          if (tabLeftRelative < 0) {
            // Tab is cut off on the left
            tabsContainer.scrollLeft = scrollLeft + tabLeftRelative - 20;
          } else if (tabRightRelative > 0) {
            // Tab is cut off on the right
            tabsContainer.scrollLeft = scrollLeft + tabRightRelative + 20;
          }
        }
      }
    }

    // Add click event listeners to tab links
    tabLinks.forEach((link, index) => {
      link.addEventListener("click", function (e) {
        e.preventDefault();

        // Remove active class from all tabs and content
        tabLinks.forEach((tabLink) => {
          tabLink.parentElement.classList.remove("active");
        });

        tabContent.forEach((content) => {
          content.classList.remove("active");
        });

        // Add active class to clicked tab and corresponding content
        this.parentElement.classList.add("active");

        // Get the target tab content
        const targetId = this.getAttribute("href").substring(1);
        const targetContent = container.querySelector(`#${targetId}`);

        if (targetContent) {
          targetContent.classList.add("active");
        }

        // For LMS, membership, and branding sections, also handle image switching
        if (
          container.classList.contains("lms") ||
          container.classList.contains("membership") ||
          container.classList.contains("branding-and-customization")
        ) {
          // Handle both desktop and mobile images
          const desktopImages = container.querySelectorAll(
            ".lms__images--desktop .lms__image"
          );
          const mobileImages = container.querySelectorAll(
            ".lms__images--mobile .lms__image"
          );

          // Handle payments section which has only one image container
          const paymentsImages = container.querySelectorAll(
            ".payments__images .lms__image"
          );

          // Remove active class from all images
          [...desktopImages, ...mobileImages, ...paymentsImages].forEach(
            (img) => {
              img.classList.remove("active");
            }
          );

          // Add active class to the corresponding images
          if (desktopImages[index]) {
            desktopImages[index].classList.add("active");
          }
          if (mobileImages[index]) {
            mobileImages[index].classList.add("active");
          }
          if (paymentsImages[index]) {
            paymentsImages[index].classList.add("active");
          }

          // Reinitialize accordions for the new active tab
          setTimeout(() => {
            initializeAccordionsForTab(targetContent);
          }, 50);
        }

        // Scroll active tab into view on mobile
        setTimeout(scrollActiveTabIntoView, 100);

        // Reinitialize sliders for community and automations sections
        if (
          container.classList.contains("community") ||
          container.classList.contains("automations")
        ) {
          reinitializeActiveSliders(container);
        }
      });
    });

    // Initialize draggable functionality for mobile
    if (tabsContainer) {
      let isDragging = false;
      let startX = 0;
      let scrollLeft = 0;

      // Mouse events
      tabsContainer.addEventListener("mousedown", (e) => {
        if (window.innerWidth <= 992) {
          isDragging = true;
          startX = e.pageX - tabsContainer.offsetLeft;
          scrollLeft = tabsContainer.scrollLeft;
          tabsContainer.style.cursor = "grabbing";
        }
      });

      tabsContainer.addEventListener("mouseleave", () => {
        isDragging = false;
        tabsContainer.style.cursor = "grab";
      });

      tabsContainer.addEventListener("mouseup", () => {
        isDragging = false;
        tabsContainer.style.cursor = "grab";
      });

      tabsContainer.addEventListener("mousemove", (e) => {
        if (!isDragging || window.innerWidth > 992) return;
        e.preventDefault();
        const x = e.pageX - tabsContainer.offsetLeft;
        const walk = (x - startX) * 2;
        tabsContainer.scrollLeft = scrollLeft - walk;
      });

      // Touch events
      tabsContainer.addEventListener("touchstart", (e) => {
        if (window.innerWidth <= 992) {
          isDragging = true;
          startX = e.touches[0].pageX - tabsContainer.offsetLeft;
          scrollLeft = tabsContainer.scrollLeft;
        }
      });

      tabsContainer.addEventListener("touchmove", (e) => {
        if (!isDragging || window.innerWidth > 992) return;
        const x = e.touches[0].pageX - tabsContainer.offsetLeft;
        const walk = (x - startX) * 2;
        tabsContainer.scrollLeft = scrollLeft - walk;
      });

      tabsContainer.addEventListener("touchend", () => {
        isDragging = false;
      });

      // Set cursor style on mobile
      function updateCursor() {
        if (window.innerWidth <= 992) {
          tabsContainer.style.cursor = "grab";
        } else {
          tabsContainer.style.cursor = "default";
        }
      }

      // Initial cursor setup
      updateCursor();

      // Update cursor on window resize
      window.addEventListener("resize", updateCursor);

      // Scroll active tab into view on window resize
      window.addEventListener("resize", () => {
        setTimeout(scrollActiveTabIntoView, 100);
      });
    }
  });
}

// Accordion functionality
function toggleAccordion(element) {
  const accordionItem = element.closest(".accordion-item");
  const accordionContent = accordionItem.querySelector(".accordion-content");
  const accordionSign = element.querySelector(".accordion-sign");

  // Find the accordion container - either a tab or a standalone accordion container
  const currentTab = element.closest(".tab");
  const accordionContainer =
    currentTab ||
    element.closest(".thrive-with-groupapp__content") ||
    element.closest(".tab-content__items");

  // Get all accordion items in the same container
  const allAccordionItems = accordionContainer
    ? accordionContainer.querySelectorAll(".accordion-item")
    : [];

  // Close all other accordions in the same container
  allAccordionItems.forEach((item) => {
    if (item !== accordionItem) {
      const otherContent = item.querySelector(".accordion-content");
      const otherHeader = item.querySelector(".accordion-header");
      const otherSign = item.querySelector(".accordion-sign");

      if (otherContent && otherHeader && otherSign) {
        otherContent.classList.remove("active");
        otherHeader.classList.remove("active");
        otherSign.textContent = "+";
      }
    }
  });

  // Toggle current accordion
  const isActive = accordionContent.classList.contains("active");

  if (isActive) {
    // Close current accordion
    accordionContent.classList.remove("active");
    element.classList.remove("active");
    accordionSign.textContent = "+";
  } else {
    // Open current accordion
    accordionContent.classList.add("active");
    element.classList.add("active");
    accordionSign.textContent = "-";
  }
}

// Make toggleAccordion function globally accessible
window.toggleAccordion = toggleAccordion;

function initStandaloneAccordions() {
  const tabPanels = document.querySelectorAll(
    ".lms__tab-panels .tab, .membership .tab, .branding-and-customization .tab"
  );

  tabPanels.forEach((tab) => {
    if (tab.classList.contains("active")) {
      const firstAccordionItem = tab.querySelector(".accordion-item");
      if (firstAccordionItem) {
        const firstHeader =
          firstAccordionItem.querySelector(".accordion-header");
        const firstContent =
          firstAccordionItem.querySelector(".accordion-content");
        const firstSign = firstAccordionItem.querySelector(".accordion-sign");

        if (firstHeader && firstContent && firstSign) {
          firstHeader.classList.add("active");
          firstContent.classList.add("active");
          firstSign.textContent = "-";
        }
      }
    }
  });

  const standaloneAccordionContainers = document.querySelectorAll(
    ".thrive-with-groupapp__content"
  );

  standaloneAccordionContainers.forEach((container) => {
    const firstAccordionItem = container.querySelector(".accordion-item");
    if (firstAccordionItem) {
      const firstHeader = firstAccordionItem.querySelector(".accordion-header");
      const firstContent =
        firstAccordionItem.querySelector(".accordion-content");
      const firstSign = firstAccordionItem.querySelector(".accordion-sign");

      if (firstHeader && firstContent && firstSign) {
        firstHeader.classList.add("active");
        firstContent.classList.add("active");
        firstSign.textContent = "-";
      }
    }
  });
}

// Function to initialize accordions for a specific tab
function initializeAccordionsForTab(tab) {
  if (!tab) return;

  // Close all accordions in the tab first
  const allAccordions = tab.querySelectorAll(".accordion-item");
  allAccordions.forEach((accordion) => {
    const header = accordion.querySelector(".accordion-header");
    const content = accordion.querySelector(".accordion-content");
    const sign = accordion.querySelector(".accordion-sign");

    if (header && content && sign) {
      header.classList.remove("active");
      content.classList.remove("active");
      sign.textContent = "+";
    }
  });

  // Open the first accordion in the tab
  const firstAccordion = tab.querySelector(".accordion-item");
  if (firstAccordion) {
    const firstHeader = firstAccordion.querySelector(".accordion-header");
    const firstContent = firstAccordion.querySelector(".accordion-content");
    const firstSign = firstAccordion.querySelector(".accordion-sign");

    if (firstHeader && firstContent && firstSign) {
      firstHeader.classList.add("active");
      firstContent.classList.add("active");
      firstSign.textContent = "-";
    }
  }
}

// Make this function available globally
window.initializeAccordionsForTab = initializeAccordionsForTab;

function initMobilePostAd() {
  const postContentLeft = document.querySelector(".blog-single__body");
  const desktopAd = document.querySelector(".post-ad.desktop");

  if (!postContentLeft || !desktopAd) {
    return;
  }

  // Only create mobile ad on mobile devices (max-width: 992px)
  // This prevents both ads from existing in DOM simultaneously, avoiding duplicate ConvertBox initialization
  const isMobile = window.innerWidth <= 992;

  if (!isMobile) {
    // On desktop, remove mobile ad if it exists (in case of window resize)
    const existingMobileAd = postContentLeft.querySelector(".post-ad.mobile");
    if (existingMobileAd) {
      existingMobileAd.remove();
    }
    return;
  }

  // Check if mobile ad already exists to avoid duplicates
  const existingMobileAd = postContentLeft.querySelector(".post-ad.mobile");
  if (existingMobileAd) {
    return;
  }

  // Find the first figure element that contains an img
  const figures = postContentLeft.querySelectorAll("figure");
  let firstFigureWithImg = null;

  for (let figure of figures) {
    const img = figure.querySelector("img");
    if (img) {
      firstFigureWithImg = figure;
      break;
    }
  }

  // If we found a figure with an img, insert the mobile ad after it
  if (firstFigureWithImg) {
    // Create a new div element instead of cloning to avoid CORS/duplicate initialization issues
    const mobileAd = document.createElement("div");
    mobileAd.className = "post-ad mobile";

    // Copy the innerHTML from desktop ad
    mobileAd.innerHTML = desktopAd.innerHTML;

    // Insert after the first figure
    firstFigureWithImg.insertAdjacentElement("afterend", mobileAd);
  }
}

// Handle window resize to add/remove mobile ad dynamically
let resizeTimeout;
window.addEventListener("resize", function () {
  clearTimeout(resizeTimeout);
  resizeTimeout = setTimeout(function () {
    initMobilePostAd();
  }, 250);
});

// Mobile accordion functionality
function initChaptersAccordion() {
  const headers = document.querySelectorAll(".chapters-toc__header");

  headers.forEach(function (header) {
    // Make the entire header clickable
    header.style.cursor = "pointer";

    header.addEventListener("click", function (e) {
      // Check if we're on mobile
      const isMobile = window.innerWidth <= 992;
      if (!isMobile) return;

      e.preventDefault();
      const card = this.closest(".chapters-toc__card");
      const toggleButton = this.querySelector(".chapters-toc__toggle");
      const isExpanded = card.classList.contains("is-expanded");

      if (isExpanded) {
        card.classList.remove("is-expanded");
        if (toggleButton) {
          toggleButton.setAttribute("aria-expanded", "false");
        }
      } else {
        card.classList.add("is-expanded");
        if (toggleButton) {
          toggleButton.setAttribute("aria-expanded", "true");
        }
      }
    });
  });
}

function initChaptersTOC() {
  // Smooth scroll (optional)
  document.documentElement.style.scrollBehavior = "smooth";

  // Helper function to calculate mobile offset
  function getMobileOffset() {
    const chaptersToc = document.querySelector(".chapters-toc");
    if (chaptersToc) {
      const tocHeight = chaptersToc.offsetHeight;
      const tocTopPosition = 16;
      const spacing = 20;
      return tocHeight + tocTopPosition + spacing;
    }
    return 16;
  }

  // Ensure targets exist: if an ID is missing, assign it to the first matching heading
  const chapterLinks = document.querySelectorAll(".chapters-toc__link");
  const observedHeadings = [];
  let isScrolling = false;
  let scrollTimeout;

  chapterLinks.forEach(function (link) {
    const targetId = link.getAttribute("href").replace("#", "");
    if (!targetId) return;

    if (!document.getElementById(targetId)) {
      const title = link.getAttribute("data-chapter-title");
      if (!title) return;

      // Find first heading with matching text (case-insensitive, trimmed)
      const headings = document.querySelectorAll("h1, h2, h3, h4");
      for (let i = 0; i < headings.length; i++) {
        const h = headings[i];
        if (h.textContent.trim().toLowerCase() === title.trim().toLowerCase()) {
          h.setAttribute("id", targetId);
          // Add scroll margin for spacing (responsive)
          const isMobile = window.innerWidth <= 992;
          h.style.scrollMarginTop = isMobile
            ? getMobileOffset() + "px"
            : "80px";
          break;
        }
      }
    }

    // Store reference to heading for intersection observer
    const heading = document.getElementById(targetId);
    if (heading) {
      observedHeadings.push({ id: targetId, element: heading, link: link });
    }

    // Add click handler to apply scroll offset
    link.addEventListener("click", function (e) {
      const targetId = this.getAttribute("href").replace("#", "");
      const target = document.getElementById(targetId);

      if (target) {
        e.preventDefault();

        // Immediately set this link as active
        isScrolling = true;
        chapterLinks.forEach((l) => l.parentElement.classList.remove("active"));
        this.parentElement.classList.add("active");

        // Use different offset for mobile vs desktop
        const isMobile = window.innerWidth <= 992;
        const offset = isMobile ? getMobileOffset() : 112;

        const targetPosition =
          target.getBoundingClientRect().top + window.pageYOffset - offset;

        window.scrollTo({
          top: targetPosition,
          behavior: "smooth",
        });

        // Re-enable observer after scroll completes
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(function () {
          isScrolling = false;
        }, 1000); // Wait 1 second after scroll starts
      }
    });
  });

  // Set up Intersection Observer to track active headings
  if (observedHeadings.length > 0) {
    const observerOptions = {
      root: null, // Use viewport as root
      rootMargin: "-20% 0px -70% 0px", // Trigger when heading is in the middle third of viewport
      threshold: 0,
    };

    const observer = new IntersectionObserver(function (entries) {
      // Don't update active state while user is clicking/scrolling
      if (isScrolling) return;

      entries.forEach(function (entry) {
        const targetId = entry.target.getAttribute("id");
        const matchingLink = observedHeadings.find(
          (h) => h.id === targetId
        )?.link;

        if (entry.isIntersecting) {
          // Remove active class from all links
          chapterLinks.forEach((link) =>
            link.parentElement.classList.remove("active")
          );

          // Add active class to the matching link's parent (li element)
          if (matchingLink) {
            matchingLink.parentElement.classList.add("active");
          }
        }
      });
    }, observerOptions);

    // Observe all heading elements
    observedHeadings.forEach(function (item) {
      observer.observe(item.element);
    });

    // Update scroll margins on resize
    let resizeTimeout;
    window.addEventListener("resize", function () {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(function () {
        const isMobile = window.innerWidth <= 992;
        const scrollMargin = isMobile ? getMobileOffset() + "px" : "80px";
        observedHeadings.forEach(function (item) {
          item.element.style.scrollMarginTop = scrollMargin;
        });
      }, 250);
    });
  }
}

function initChaptersAdSwap() {
  if (window.innerWidth <= 992) return;

  const container = document.querySelector(".chapters-with-ad");
  if (!container) return;

  const ad = container.querySelector(".ad-with-chapter");
  const toc = container.querySelector(".chapters-toc.desktop");
  if (!toc) return;

  if (!ad) {
    container.classList.remove("has-ad");
    container.classList.add("is-toc-visible");
    return;
  }

  container.classList.add("has-ad");

  const content = document.querySelector(".blog-single__body");
  if (!content) return;

  const paragraphs = Array.from(content.querySelectorAll("p"));
  const firstParagraph = paragraphs.find((p) => {
    const text = (p.textContent || "").replace(/\s+/g, " ").trim();
    return text.length > 0;
  });

  if (!firstParagraph) {
    container.classList.add("is-toc-visible");
    return;
  }

  const triggerOffset = 112; // matches your desktop scroll offsets
  const updateVisibility = () => {
    const paragraphTop =
      firstParagraph.getBoundingClientRect().top + window.pageYOffset;

    const shouldShowToc = window.pageYOffset + triggerOffset >= paragraphTop;

    container.classList.toggle("is-toc-visible", shouldShowToc);
  };

  updateVisibility();
  window.addEventListener("scroll", updateVisibility, { passive: true });
  window.addEventListener("resize", updateVisibility);
}
