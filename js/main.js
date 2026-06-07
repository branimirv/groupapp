// headr scroll
// var lastScroll = 0;
// var isScrolled = false;
// window.addEventListener("scroll", function () {
//   var topHeader = document.querySelector("header");
//   // var toptab = document.querySelector(".tab1");
//   var currentScroll =
//     window.pageYOffset ||
//     document.documentElement.scrollTop ||
//     document.body.scrollTop ||
//     0;
//   var scrollDirection = currentScroll < lastScroll;
//   var shouldToggle = isScrolled && scrollDirection;
//   isScrolled = currentScroll > 100;
//   topHeader.classList.toggle("active_header", shouldToggle);
//   // toptab.classList.toggle("tab1_scroll", shouldToggle);
//   lastScroll = currentScroll;
// });

$(".stst1").first().addClass("active");
$(".stst2").first().addClass("active");
$(".stst3").first().addClass("active");
$(".stst4").first().addClass("active");

$(".stst1").click(function () {
  $(".stst1").removeClass("active");
  $(this).addClass("active");
});
$(".stst2").click(function () {
  $(".stst2").removeClass("active");
  $(this).addClass("active");
});
$(".stst3").click(function () {
  $(".stst3").removeClass("active");
  $(this).addClass("active");
});
$(".stst4").click(function () {
  $(".stst4").removeClass("active");
  $(this).addClass("active");
});

$(".select-pl").click(function () {
  $(this).toggleClass("pl-active");
});

// pop

// if($('.all_txt').textContent == ''){
//   $('.open').addClass('sd');
// }

// $('.coment-pop').click(function(e){
//   $('.pop-content').removeClass('active-com');
// });

const pinRow = document.querySelectorAll(".all_txt");
const pinRow2 = document.querySelectorAll("add-pop");

for (let i = 0; i < pinRow.length; i++) {
  if (pinRow[i].textContent == "") {
    pinRow[i].style.display = "none";
    pinRow[
      i
    ].parentElement.parentElement.parentElement.parentElement.classList.add(
      "dot-no"
    );
  } else {
  }
}
for (let i = 0; i < pinRow.length; i++) {
  if (pinRow[i].textContent !== "") {
    pinRow[
      i
    ].parentElement.parentElement.parentElement.parentElement.classList.add(
      "add-pop"
    );
  }
}
// if($('.pop-content ').hasClass('add-pop')){
//   $(this).addClass('test');
// }

//navbar
const navbar = document.querySelector(".header-top");
navbar.querySelector(".toggle").addEventListener("click", () => {
  navbar.classList.toggle("collapsed");
});

// window.addEventListener("scroll", e => {
//   let windowY = window.pageYOffset;
//   let navbarHeight = document.querySelector(".header-top").offsetHeight;
//   if (windowY > 1 && windowY > navbarHeight) {
//     navbar.classList.add("sticky");

//   } else {
//     navbar.classList.remove("sticky");
//   }
// });

// Pricing page interactions: see src/js/pricing-page.js (webpack bundle).

let today = new Date();
let year = today.getFullYear();
$(".this_year").text(year);

jQuery(function ($) {
  $("#load-more-posts").click(function () {
    var button = $(this),
      page = button.data("page"),
      url = button.data("url"),
      query = button.data("query"),
      postContainer = $("#post-container"),
      loadingIndicator = $(".loading-indicator"),
      max_pages = button.data("max-pages");

    button.prop("disabled", true); // отключение кнопки
    loadingIndicator.show();
    button.hide();

    $.ajax({
      url: url,
      data: {
        action: "load_more_posts",
        page: page,
        query: query,
      },
      type: "POST",
      success: function (result) {
        button.data("page", page + 1);
        if (page >= max_pages) {
          button.addClass("load-no");
        }
        // сохраняем результат в глобальной переменной
        window.ajaxResult = result;
      },
      complete: function () {
        setTimeout(function () {
          loadingIndicator.hide();
          button.show();
          postContainer.append(window.ajaxResult);
          button.prop("disabled", false); // включение кнопки
        }, 400); // 2 секунды
      },
    });
  });
});
jQuery(function ($) {
  $("#load-more-posts-cat").click(function () {
    var button = $(this),
      page = button.data("page"),
      url = button.data("url"),
      category = button.data("category"),
      postContainer = $("#post-container2"),
      loadingIndicator = $(".loading-indicator"),
      max_pages = button.data("max-pages");

    button.prop("disabled", true); // отключение кнопки
    loadingIndicator.show();
    button.hide();

    $.ajax({
      url: url,
      data: {
        action: "load_more_posts_cat",
        page: page,
        category: category,
      },
      type: "POST",
      success: function (result) {
        button.data("page", page + 1);
        if (page >= max_pages) {
          button.addClass("load-no");
        }
        // сохраняем результат в глобальной переменной
        window.ajaxResult = result;
        console.log(result);
      },
      complete: function () {
        setTimeout(function () {
          loadingIndicator.hide();
          button.show();
          postContainer.append(window.ajaxResult);
          button.prop("disabled", false); // включение кнопки
        }, 400); // 2 секунды
      },
    });
  });
});

//

$(document).ready(function () {
  let cards = document.querySelectorAll(".accordian-item");
  [...cards].forEach((card) => {
    card.addEventListener("click", function () {
      $(".accordian-item .answer")
        .not($(this).find(".answer"))
        .removeClass("open");

      $(".accordian-item").not($(this)).removeClass("active-f");

      $(this).find(".accordian-item , .answer").toggleClass("open");
      $(this).toggleClass("active-f");
    });
  });
});

$(document).mouseup(function (e) {
  const prevent = (ev) => ev.preventDefault();
  var container = $(".pop");
  if (container.has(e.target).length === 0) {
    $(".pop-content").removeClass("active-com");
    document.removeEventListener("wheel", prevent);
    $("body").removeClass("body-hidden");
  }
  var contfilter = $(".select-pl");
  if (contfilter.has(e.target).length === 0) {
    $(".select-pl").removeClass("pl-active");
  }
});

var lastScrollTop = 0;
var scrollHandler = function (e) {
  var st = $(this).scrollTop();
  if (st > lastScrollTop && lastScrollTop > 100) {
    $("header").addClass("active_header");
  }
  if (st < lastScrollTop && lastScrollTop > 100) {
    $("header").removeClass("active_header");
  }
  lastScrollTop = st;
  // if($('header').hasClass('active_header')){
  //   $('.tab1').addClass('tab1_scroll');
  // }
  // else{
  //   $('.tab1').removeClass('tab1_scroll');
  // }
};

// Добавляем обработчик события прокрутки
window.addEventListener("scroll", scrollHandler);

// Добавляем обработчик события нажатия на кнопку
$(".menu-btn").on("click", function () {
  $(this).toggleClass("active-btn-hom");

  if ($(this).hasClass("active-btn-hom")) {
    const scrollY =
      document.documentElement.style.getPropertyValue("--scroll-y");
    const body = document.body;
    body.style.position = "fixed";
    body.style.top = `-${scrollY}`;
    window.removeEventListener("scroll", scrollHandler);
  } else {
    const body = document.body;
    const scrollY = body.style.top;
    body.style.position = "";
    body.style.top = "";
    window.scrollTo(0, parseInt(scrollY || "0") * -1);
    window.addEventListener("scroll", scrollHandler);
  }
  // Удаляем обработчик события прокрутки
});
if ($(window).width() > "1200") {
  const prevent = (ev) => ev.preventDefault();

  $(".open-pop").click(function () {
    //
    $(this).parent().parent().parent().addClass("active-com");
    document.addEventListener("wheel", prevent, { passive: false });
  });

  $(".close").click(function () {
    $(".pop-content").removeClass("active-com");
    document.removeEventListener("wheel", prevent);
  });
  $(document).mouseup(function (e) {
    var container = $(".add-pop");
    if (container.has(e.target).length === 0) {
      $(".pop-content").removeClass("active-com");
      document.removeEventListener("wheel", prevent);
      $("body").removeClass("body-hidden");
    }
    var contfilter = $(".select-pl");
    if (contfilter.has(e.target).length === 0) {
      $(".select-pl").removeClass("pl-active");
    }
  });
}

if ($(window).width() < "1100") {
  $(".open-pop").click(function () {
    $(this).parent().parent().parent().addClass("active-com");
    const scrollY =
      document.documentElement.style.getPropertyValue("--scroll-y");
    const body = document.body;
    body.style.position = "fixed";
    body.style.top = `-${scrollY}`;
  });

  $(".close").click(function () {
    $(".pop-content").removeClass("active-com");
    const body = document.body;
    const scrollY = body.style.top;
    body.style.position = "";
    body.style.top = "";
    window.scrollTo(0, parseInt(scrollY || "0") * -1);
  });

  $(".add-pop").mouseup(function (e) {
    var container = $(".pop");
    if (container.has(e.target).length === 0) {
      $(".pop-content").removeClass("active-com");
      const body = document.body;
      const scrollY = body.style.top;
      body.style.position = "";
      body.style.top = "";
      window.scrollTo(0, parseInt(scrollY || "0") * -1);
    }
  });
}

window.addEventListener("scroll", () => {
  document.documentElement.style.setProperty(
    "--scroll-y",
    `${window.scrollY}px`
  );
});
