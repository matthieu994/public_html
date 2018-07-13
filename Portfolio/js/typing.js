var portfolio = ["Portfolio", "Présentation", "Réalisations", "Contact"];
var prevTitle;
var prevText;
var interval;

function type(title, speed, chances) {
   if(title.css('display') != 'none') return;

   if(prevTitle) {
      prevTitle.text(prevText);
      if(prevTitle.parent().parent().find('.return').css('display') == 'none') {
         prevTitle.parent().parent().find('.return').fadeIn();
      }
   }
   clearInterval(interval);

   var i = 0;
   var text = title.text().trim();
   prevText = text;
   prevTitle = title;
   title.show().text('');

   var error = false;

   interval = setInterval(function () {
      if(i < text.length || error) {
         if(error) {
            title.text(title.text().substr(0, title.text().length-1));
            i--;
            error = false;
         }
         else if (Math.random() < chances) {
            title.text(title.text() + "abcdefghijklmnopqrstuvwxyz".charAt(Math.floor(Math.random()*"abcdefghijklmnopqrstuvwxyz".length)));
            i++;
            error = true;
         } else {
            title.text(title.text() + text.charAt(i));
            i++;
         }
      } else {
         clearInterval(interval);
         if(title.parent().parent().find('.return').css('display') == 'none') {
            setTimeout(function () {
               title.parent().parent().find('.return').fadeIn();
            }, 200);
         }
      }
   }, speed);
}

/* Set caret blink */
setInterval(function () {
   $('.caret').each(function() {
      if($(this).css('visibility') == 'hidden')
      $(this).css('visibility', 'visible');
      else
      $(this).css('visibility', 'hidden');
   });
}, 500);

/* Portfolio data */
$(portfolio).each(function(index, value) {
   var slide = $('<div>').attr('class', 'row d-block').attr('id', 'slide'+(index+1));
   slide.append($('<div>').attr('class', 'col-12'));
   slide.children('div').append($('<h1>>').attr('class', 'title'));
   slide.children('div').append($('<h1>'+value+'</h1>').attr('class', 'title typer'));
   slide.children('div').append($('<div>|</div>').attr('class', 'caret'));

   slide.append($('<div>').attr('class', 'col'));
   slide.children('div').last().append($('<h1>').attr('class', 'return'));

   for (var i = 0; i < portfolio.length; i++) {
      if(i == index) continue;
      slide.children('.col').children('.return').append($('<span>').text(portfolio[i]));
   }
   $('.container-fluid').append(slide);
});

/* Trigger type */
// $(window).scroll(function() {
//    for (var i = 1; i <= portfolio.length; i++) {
//       var slide = $('#slide'+i);
//       var bottom_of_object = slide.offset().top + slide.outerHeight()/2;
//       var bottom_of_window = $(window).scrollTop() + $(window).height();
//       if(bottom_of_window > bottom_of_object && slide.find('.typer').css('display') == 'none') {
// type(slide.find('.typer'), 200, 0.1);
// slide.find('.typer').toggle();
//       }
//    }
// });




/* Locked scroll */
var isScrolling = true;
var currentSlide = (Math.floor($(window).scrollTop() / ($(document).height() / portfolio.length)));
$('html, body').animate({
   scrollTop: $(document).height()/portfolio.length * currentSlide
}, 500, function () {
   isScrolling = false;
});

$(document).ready(function() {
   for (var i = 0; i < portfolio.length; i++) {
      $('#scrollShow').append($('<div>'));
   }
   showScroll(currentSlide);
});

function showScroll(index) {
   var slide = $('#slide'+(index+1));
   type(slide.find('.typer'), 200, 0.1);

   $('#scrollShow').children().each(function() {
      $(this).animate({
         backgroundColor: 'transparent'
      }, 200);
   });
   $('#scrollShow').children().eq(index).animate({
      backgroundColor: 'white'
   }, 200);
}

var prevPos = $(window).scrollTop();
$(window).scroll(function() {
   if(isScrolling) return;
   currentSlide = Math.floor($(window).scrollTop() / ($(document).height() / portfolio.length));
   if(prevPos < $(window).scrollTop() && currentSlide < portfolio.length) { //Scroll down
      scroll('scroll', currentSlide + 1);
   }
   else if (prevPos > $(window).scrollTop()) { //Scroll up
      scroll('scroll', currentSlide);
   }
});

var prevSize = $(window).height();
$(window).resize(function() {
   if(isScrolling) return;
   currentSlide = Math.floor($(window).scrollTop() / ($(document).height() / portfolio.length));
   if(prevSize < $(window).height() && currentSlide < portfolio.length) { //Scroll down
      scroll('resize', currentSlide+1);
   }
   else if (prevSize > $(window).height()) { //Scroll up
      scroll('resize', currentSlide);
   }
});

function scroll(type, index) {
   isScrolling = true;
   $('html, body').animate({
      scrollTop: $(document).height()/portfolio.length * index
   }, 800, function () {
      isScrolling = false;
      if(type == 'scroll') prevPos = $(window).scrollTop();
      else prevSize = $(window).height();
   });
   showScroll(index);
}

$('#scrollShow').on('click', 'div', function() {
   scroll('scroll', $(this).index());
});

$('.return').on('click', 'span', function() {
   scroll('scroll', portfolio.indexOf($(this).text()));
});
