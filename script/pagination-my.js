var outer = document.getElementById("outer1");

// Получаем все внутренние блоки с классом "inner"
var inners = outer.querySelectorAll(".prtt1");

// Получаем количество внутренних блоков
var count_col = inners.length;

// Получаем количество внутренних блоков

var count = count_col; //всего записей
var cnt = 12; //сколько отображаем сначала
var cnt_page = Math.ceil(count / cnt); //кол-во страниц

//выводим список страниц
var paginator = document.querySelector(".paginator1");
var page = "";
for (var i = 0; i < cnt_page; i++) {
  page +=
    "<span data-page=" +
    i * cnt +
    '  id="page' +
    (i + 1) +
    '">' +
    (i + 1) +
    "</span>";
}

if (cnt_page > 1) {
  paginator.innerHTML = page;
  var main_page = document.getElementById("page1");
  $(".paginator1").css({
    "margin-bottom": "20px",
  });
  main_page.classList.add("current");
}

//выводим первые записи {cnt}
var div_num = document.querySelectorAll(".prtt1");
for (var i = 0; i < div_num.length; i++) {
  if (i >= cnt) {
    div_num[i].style.display = "none";
  }
}
var div_num = document.querySelectorAll(".prtt1");

for (var i = 0; i < div_num.length; i++) {
  div_num[i].setAttribute("data-num", i);
}

var postCount = div_num.length;
//листаем
var currentPage = 0; // переменная для хранения текущей страницы

function pagination1(event) {
  var e = event || window.event;
  var target = e.target;
  var id = target.id;

  if (target.tagName.toLowerCase() != "span") return;

  var num_ = id.substr(4);
  var data_page = +target.dataset.page;
  main_page.classList.remove("current");
  main_page = document.getElementById(id);
  main_page.classList.add("current");

  currentPage = data_page / cnt; // сохраняем текущую страницу в переменной

  var j = 0;
  for (var i = 0; i < div_num.length; i++) {
    var data_num = div_num[i].dataset.num;
    if (data_num <= data_page || data_num >= data_page)
      div_num[i].style.display = "none";
  }
  for (var i = data_page; i < div_num.length; i++) {
    if (j >= cnt) break;
    div_num[i].style.display = "block";
    j++;
  }
  if (div_num.length > cnt) {
    $(".load-a1").removeClass("load-no");
  }
  var pages = document.querySelectorAll(".paginator1 span");
  for (var i = 0; i < pages.length; i++) {
    pages[i].classList.remove("vis");
    if (i === currentPage - 1 && currentPage > 1) {
      pages[i].classList.add("vis");
    }

    if (i === currentPage + 1 && currentPage < cnt_page - 1) {
      pages[i].classList.add("vis");
    }
    if (i === 0 || i === cnt_page - 1 || Math.abs(currentPage - i) <= 1) {
      pages[i].textContent = i + 1;
      pages[i].classList.remove("extend");
    } else if (Math.abs(currentPage - i) === 2) {
      pages[i].textContent = "...";
      pages[i].classList.add("extend");
    } else if (Math.abs(currentPage - i) > 2) {
      pages[i].textContent = i + 1;
      pages[i].classList.remove("extend");
    }
  }
}

//

//show load mowre
var postCount = div_num.length; // количество постов
var shown = cnt;
var loadCount = 0;
if (postCount < 12) {
  $(".load-more").css({
    display: "none",
  });
}

function showMore() {
  var loadMoreBtn = $(".load-a1");
  if (!loadMoreBtn.hasClass("load-no")) {
    $(".load-more1").css({
      display: "none",
    });
    // Показываем индикатор загрузки
    $(".loading-indicator1").css({
      display: "block",
    });
    setTimeout(function () {
      // Добавляем новые посты через 2 секунды
      var nextPage = currentPage + 1; // определяем следующую страницу
      var startIndex = nextPage * cnt; // определяем индекс первой записи на следующей странице
      var endIndex = startIndex + cnt; // определяем индекс последней записи на следующей странице

      for (var i = startIndex; i < endIndex; i++) {
        if (i < div_num.length) {
          div_num[i].style.display = "block";
        }
      }
      currentPage++;
      shown = endIndex;
      // Скрываем индикатор загрузки
      $(".loading-indicator1").css({
        display: "none",
      });
      // Если показаны все посты, скрываем кнопку "Load More"
      if (shown >= div_num.length) {
        $(".load-a1").addClass("load-no");
      }
      // Если не все посты показаны, отображаем кнопку "Load More"
      if (shown < div_num.length) {
        $(".load-a1").removeClass("load-no");
      }
      if (shown >= postCount) {
        $(".load-a1").addClass("load-no");
      }
      // Отображаем кнопку "Load More" через 2 секунды

      $(".load-more1").css({
        display: "flex",
      });
    }, 1000);
  }
}
var loadMoreBtn = document.querySelector(".load-more1");
loadMoreBtn.addEventListener("click", showMore);

//
//
//

////
//
//
//
//
//
//
//

var outer2 = document.getElementById("outer2");

// Получаем все внутренние блоки с классом "inner"
var inners2 = outer2.querySelectorAll(".prtt2");

// Получаем количество внутренних блоков
var count_col2 = inners2.length;

// Получаем количество внутренних блоков

var count2 = count_col2; //всего записей
var cnt2 = 12; //сколько отображаем сначала
var cnt_page2 = Math.ceil(count2 / cnt2); //кол-во страниц

//выводим список страниц
var paginator2 = document.querySelector(".paginator2");
var page2 = "";
for (var i = 0; i < cnt_page2; i++) {
  page2 +=
    "<span data-page=" +
    i * cnt2 +
    '  id="pase' +
    (i + 1) +
    '">' +
    (i + 1) +
    "</span>";
}

if (cnt_page2 > 1) {
  paginator2.innerHTML = page2;
  var main_page2 = document.getElementById("pase1");
  $(".paginator2").css({
    "margin-bottom": "20px",
  });
  main_page2.classList.add("current");
}

//выводим первые записи {cnt}
var div_num2 = document.querySelectorAll(".prtt2");
for (var i = 0; i < div_num2.length; i++) {
  if (i >= cnt2) {
    div_num2[i].style.display = "none";
  }
}
var div_num2 = document.querySelectorAll(".prtt2");

for (var i = 0; i < div_num2.length; i++) {
  div_num2[i].setAttribute("data-num", i);
}

var postCount2 = div_num2.length;
//листаем
var currentPage2 = 0; // переменная для хранения текущей страницы

function pagination2(event2) {
  var e2 = event2 || window.event2;
  var target = e2.target;
  var id = target.id;

  if (target.tagName.toLowerCase() != "span") return;

  var num_ = id.substr(4);
  var data_page2 = +target.dataset.page;
  main_page2.classList.remove("current");
  main_page2 = document.getElementById(id);
  main_page2.classList.add("current");

  currentPage2 = data_page2 / cnt2; // сохраняем текущую страницу в переменной

  for (var i = 0; i < div_num2.length; i++) {
    div_num2[i].style.display = "none";
  }

  for (var i = 0; i < div_num2.length; i++) {
    if (i >= data_page2 && i < data_page2 + cnt2) {
      div_num2[i].style.display = "block";
    } else {
      div_num2[i].style.display = "none";
    }
  }

  if (div_num2.length > cnt2) {
    $(".load-a2").removeClass("load-no");
  }

  var pages2 = document.querySelectorAll(".paginator2 span");
  for (var i = 0; i < pages2.length; i++) {
    pages2[i].classList.remove("vis");
    if (i === currentPage2 - 1 && currentPage2 > 1) {
      pages2[i].classList.add("vis");
    }

    if (i === currentPage2 + 1 && currentPage2 < cnt_page2 - 1) {
      pages2[i].classList.add("vis");
    }
    if (i === 0 || i === cnt_page2 - 1 || Math.abs(currentPage2 - i) <= 1) {
      pages2[i].textContent = i + 1;
      pages2[i].classList.remove("extend");
    } else if (Math.abs(currentPage2 - i) === 2) {
      pages2[i].textContent = "...";
      pages2[i].classList.add("extend");
    } else if (Math.abs(currentPage2 - i) > 2) {
      pages2[i].textContent = i + 1;
      pages2[i].classList.remove("extend");
    }
  }
}

//
// show load mowre
var postCount2 = div_num2.length; // количество постов
var shown2 = cnt2;
var loadCount2 = 0;
if (postCount2 < 12) {
  $(".load-more").css({
    display: "none",
  });
}

function showMore2() {
  var loadMoreBtn2 = $(".load-a2");
  if (!loadMoreBtn2.hasClass("load-no")) {
    $(".load-more2").css({
      display: "none",
    });
    // Показываем индикатор загрузки
    $(".loading-indicator2").css({
      display: "block",
    });
    setTimeout(function () {
      // Добавляем новые посты через 2 секунды
      var nextPage2 = currentPage2 + 1; // определяем следующую страницу
      var startIndex2 = nextPage2 * cnt2; // определяем индекс первой записи на следующей странице
      var endIndex2 = startIndex2 + cnt2; // определяем индекс последней записи на следующей странице

      for (var i = startIndex2; i < endIndex2; i++) {
        if (i < div_num2.length) {
          div_num2[i].style.display = "block";
        }
      }
      currentPage2++;
      shown2 = endIndex2;
      // Скрываем индикатор загрузки
      $(".loading-indicator2").css({
        display: "none",
      });
      // Если показаны все посты, скрываем кнопку "Load More"
      if (shown2 >= div_num2.length) {
        $(".load-a2").addClass("load-no");
      }
      // Если не все посты показаны, отображаем кнопку "Load More"
      if (shown2 < div_num2.length) {
        $(".load-a2").removeClass("load-no");
      }
      if (shown2 >= postCount2) {
        $(".load-a2").addClass("load-no");
      }
      // Отображаем кнопку "Load More" через 2 секунды

      $(".load-more2").css({
        display: "flex",
      });
    }, 1000);
  }
}
var loadMoreBtn2 = document.querySelector(".load-more2");
loadMoreBtn2.addEventListener("click", showMore2);
