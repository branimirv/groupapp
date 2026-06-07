$('.stst1').first().addClass( "active" );
$('.stst2').first().addClass( "active" );
$('.stst3').first().addClass( "active" );
$('.stst4').first().addClass( "active" );

$('.stst1').click(function(){
  $('.stst1').removeClass('active')
$(this).addClass('active');
});
$('.stst2').click(function(){
  $('.stst2').removeClass('active')
$(this).addClass('active');
});
$('.stst3').click(function(){
  $('.stst3').removeClass('active')
$(this).addClass('active');
});
$('.stst4').click(function(){
  $('.stst4').removeClass('active')
$(this).addClass('active');
});



$('.select-pl').click(function(){
  $(this).toggleClass('pl-active');
  
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


for(let i = 0; i < pinRow.length; i++ ) {
  if(pinRow[i].textContent == '') {
    pinRow[i].style.display = 'none';
    pinRow[i].parentElement.parentElement.parentElement.parentElement.classList.add('dot-no');
  
  }
  else{
    
  }
}
for(let i = 0; i < pinRow.length; i++ ) {
  if(pinRow[i].textContent !== '') {
    pinRow[i].parentElement.parentElement.parentElement.parentElement.classList.add('add-pop');

   
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

//
  $('.switch-btn').addClass('switch-on');
  $('.switch-btn').addClass('change');
  if($('.switch-btn').hasClass('change')){
    $('.comp1').removeClass('active-pricing');
    $('.comp2').addClass('active-pricing');
    $('.collor').addClass('collor100');
    $('.ch_price').addClass('ch-active');
    $('.ch_price_y').addClass('ch-active_y');
    $('.old-p').css({
      'display':'none',
    });
    $('.new-p').css({
      'display':'contents',
    });
    $('.bt-m').css({
      'display':'none',
    });
    $('.bt-y').css({
      'display':'block',
    });

    
  }
  else{
    $('.comp1').addClass('active-pricing');
    $('.comp2').removeClass('active-pricing');
    $('.collor').removeClass('collor100');
    $('.ch_price').removeClass('ch-active');
    $('.ch_price_y').removeClass('ch-active_y');
    $('.old-p').css({
      'display':'contents',
    });
    $('.new-p').css({
      'display':'none',
    });
    $('.bt-m').css({
      'display':'block',
    });
    $('.bt-y').css({
      'display':'none',
    });

  }
$('.switch-btn').click(function(){
  $(this).toggleClass('switch-on');
  $(this).toggleClass('change');
  if($('.switch-btn').hasClass('change')){
    $('.comp1').removeClass('active-pricing');
    $('.comp2').addClass('active-pricing');
    $('.collor').addClass('collor100');
    $('.ch_price').addClass('ch-active');
    $('.ch_price_y').addClass('ch-active_y');
    $('.old-p').css({
      'display':'none',
    });
    $('.new-p').css({
      'display':'contents',
    });
    $('.bt-m').css({
      'display':'none',
    });
    $('.bt-y').css({
      'display':'block',
    });

    
  }
  else{
    $('.comp1').addClass('active-pricing');
    $('.comp2').removeClass('active-pricing');
    $('.collor').removeClass('collor100');
    $('.ch_price').removeClass('ch-active');
    $('.ch_price_y').removeClass('ch-active_y');
    $('.old-p').css({
      'display':'contents',
    });
    $('.new-p').css({
      'display':'none',
    });
    $('.bt-m').css({
      'display':'block',
    });
    $('.bt-y').css({
      'display':'none',
    });

  }
});
if($(window).width() < '992'&& $(window).width() > '720'){
  $('.switch-btn').click(function(){
    if($('.switch-btn').hasClass('change')){
      $('.bt-m').css({
        'display':'none',
      });
      $('.bt-y').css({
        'display':'flex',
      });
    }
    else{
      $('.new-p').css({
        'display':'none',
      });
      $('.bt-m').css({
        'display':'flex',
      });
      $('.bt-y').css({
        'display':'none',
      });
  
    }
  });
}

if($('.td-ch-1').hasClass('td-active')){
  $('.tabtv').addClass('tabtvrem1');
}
if($('.td-ch-2').hasClass('td-active')){
  $('.tabtv').addClass('tabtvrem2');
}
$('.td-ch').click(function(){
  $('.td-ch').removeClass('td-active');
  $(this).addClass('td-active');

  if($('.td-ch-1').hasClass('td-active')){
    $('.tabtv').removeClass('tabtvrem2');
    $('.tabtv').removeClass('tabtvrem3');
    $('.tabtv').removeClass('tabtvrem4');
    $('.tabtv').addClass('tabtvrem1');
  }
  if($('.td-ch-2').hasClass('td-active')){
    $('.tabtv').removeClass('tabtvrem1');
    $('.tabtv').removeClass('tabtvrem3');
    $('.tabtv').removeClass('tabtvrem4');
    $('.tabtv').addClass('tabtvrem2');
    
  }
  if($('.td-ch-3').hasClass('td-active')){
    $('.tabtv').removeClass('tabtvrem2');
    $('.tabtv').removeClass('tabtvrem1');
    $('.tabtv').removeClass('tabtvrem4');
    $('.tabtv').addClass('tabtvrem3');
  }
  if($('.td-ch-4').hasClass('td-active')){
    $('.tabtv').removeClass('tabtvrem2');
    $('.tabtv').removeClass('tabtvrem3');
    $('.tabtv').removeClass('tabtvrem1');
    $('.tabtv').addClass('tabtvrem4');
  }
});

let today = new Date();
let year = today.getFullYear();
$('.this_year').text(year);


jQuery(function($){

  $('#load-more-posts').click(function(){
 
    var button = $(this),
        page = button.data('page'),
        url = button.data('url'),
        query = button.data('query'),
        postContainer = $('#post-container'),
        loadingIndicator = $('.loading-indicator'),
        max_pages = button.data('max-pages');

    button.prop('disabled', true); // отключение кнопки
    loadingIndicator.show();
    button.hide();

    $.ajax({
      url : url,
      data : {
        action : 'load_more_posts',
        page : page,
        query : query
      },
      type : 'POST',
      success : function( result ) {
        button.data( 'page', page + 1 );
        if ( page >= max_pages ) {
          button.addClass('load-no');
        }
        // сохраняем результат в глобальной переменной
        window.ajaxResult = result;
      },
      complete: function() {
        setTimeout(function() {
          loadingIndicator.hide();
          button.show();
          postContainer.append(window.ajaxResult);
          button.prop('disabled', false); // включение кнопки
        }, 1000); // 2 секунды
      }
    });
  });
});
jQuery(function($) {
  $('#load-more-posts-cat').click(function() {
   
    var button = $(this),
      page = button.data('page'),
      url = button.data('url'),
      category = button.data('category'),
      postContainer = $('#post-container2'),
      loadingIndicator = $('.loading-indicator'),
      max_pages = button.data('max-pages');
      

    button.prop('disabled', true); // отключение кнопки
    loadingIndicator.show();
    button.hide();

    $.ajax({
      url: url,
      data: {
          action: 'load_more_posts_cat',
          page: page,
          category: category, // добавлен параметр категории
          num_posts: postContainer.find('.ttd').length,
          total_posts: button.data('total-posts')
      },
      type: 'POST',
      success: function(result) {
        setTimeout(function() {
          button.data('page', page + 1);
          if (page >= max_pages) {
              button.addClass('load-no');
          }
          if(postContainer.find('.ttd').length<21){
            button.addClass('load-no');
          }
         

          window.ajaxResult = result;
          
          console.log(result.data.result);
          console.log(category);
          // console.log(result.category_name); 
          postContainer.append(result.data.result);
        }, 1500);
          
      },
      complete: function() {
          setTimeout(function() {
              loadingIndicator.hide();
              button.show();
              postContainer.append(window.ajaxResult);
             
              button.prop('disabled', false);
          }, 1500);
      }
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
        
      $(".accordian-item")
      .not($(this))
      .removeClass("active-f");
      
      $(this).find(".accordian-item , .answer").toggleClass("open");
      $(this).toggleClass("active-f");
      
    });
  });
});



const prevent = ev => ev.preventDefault();

$(document).mouseup(function (e) {
  
  var container = $(".pop");
  if (container.has(e.target).length === 0){
    $('.pop-content').removeClass('active-com');
    document.removeEventListener('wheel', prevent);
    $('body').removeClass('body-hidden');
  }
  var contfilter = $('.select-pl');
  if (contfilter.has(e.target).length === 0){
    $('.select-pl').removeClass('pl-active');
  }
});


var lastScrollTop = 0;
var scrollHandler = function(e) {
  var st = $(this).scrollTop();
  if (st > lastScrollTop&&lastScrollTop>100&&$(window).width() < '720'){
    $('header').addClass('active_header');
   
    
  } 
  if(st <lastScrollTop&&lastScrollTop>100&&$(window).width() < '720') {
   
       $('header').removeClass('active_header');

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
window.addEventListener('scroll', scrollHandler);

// Добавляем обработчик события нажатия на кнопку
$('.menu-btn').on('click', function() {
  $(this).toggleClass('active-btn-hom');

  if($(this).hasClass('active-btn-hom')){
  const scrollY = document.documentElement.style.getPropertyValue('--scroll-y');
  const body = document.body;
  body.style.position = 'fixed';
  body.style.top = `-${scrollY}`;
  window.removeEventListener('scroll', scrollHandler);

  
  
  }
  else{
    const body = document.body;
    const scrollY = body.style.top;
    body.style.position = '';
    body.style.top = '';
    window.scrollTo(0, parseInt(scrollY || '0') * -1);
    window.addEventListener('scroll', scrollHandler);
 
  
  }
  // Удаляем обработчик события прокрутки
  

});
if( $(window).width() > '1200' ){


  $('.open-pop').click(function(){
    //
    $(this).parent().parent().parent().addClass('active-com');
  document.addEventListener('wheel', prevent, {passive: false});
        
  });
  
  $('.close').click(function(){
    $('.pop-content').removeClass('active-com');
    document.removeEventListener('wheel', prevent);
  });
  $(document).mouseup(function (e) {
    var container = $(".add-pop");
    if (container.has(e.target).length === 0){
      $('.pop-content').removeClass('active-com');
      document.removeEventListener('wheel', prevent);
      
    }
    var contfilter = $('.select-pl');
    if (contfilter.has(e.target).length === 0){
      $('.select-pl').removeClass('pl-active');
    }
  });
} 

if($(window).width() < '1100') {
  
  $('.open-pop').click(function(){
    $(this).parent().parent().parent().addClass('active-com');
  const scrollY = document.documentElement.style.getPropertyValue('--scroll-y');
  const body = document.body;
  body.style.position = 'fixed';
  body.style.top = `-${scrollY}`;
        
  });
  
  $('.close').click(function(){
    $('.pop-content').removeClass('active-com');
    const body = document.body;
    const scrollY = body.style.top;
    body.style.position = '';
    body.style.top = '';
    window.scrollTo(0, parseInt(scrollY || '0') * -1);
    
  });

  $('.add-pop').mouseup(function (e) {
    var container = $(".pop");
    if (container.has(e.target).length === 0){
      $('.pop-content').removeClass('active-com');
      const body = document.body;
      const scrollY = body.style.top;
      body.style.position = '';
      body.style.top = '';
      window.scrollTo(0, parseInt(scrollY || '0') * -1);
    
    }

  });


  

  
} 

window.addEventListener('scroll', () => {
  document.documentElement.style.setProperty('--scroll-y', `${window.scrollY}px`);
  });
