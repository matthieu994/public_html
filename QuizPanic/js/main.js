function reload_js(src) {
   $('script[src="' + src + '"]').remove();
   $('<script>').attr('src', src).appendTo('html');
}
$("#profil").click(function () {
   $("#dropdown").toggle();
});
/*-----------------------GESTION HELP's----------------------------*/
$(".hoverable").mousemove(function (event) {
   var parentOffset = $(this).parent().offset();
   var x = event.clientX,
   y = event.clientY;
   $(this).next().css("left", (x - $(this).next().width()/2 - parentOffset.left) + 'px');
   $(this).next().css("top", (y - $(this).next().height()*1.8 - parentOffset.top) + 'px');
});

/*-----------------------FENETRES MENU----------------------------*/
$("#play").click(function () {
   $("#play").removeClass("zoomIn").addClass("fadeOutLeft");
   $("#question").removeClass("zoomIn").addClass("fadeOutRight");
   setTimeout(function () {
      $("#play").hide().removeClass("fadeOutLeft").addClass("fadeInLeft");
      $("#question").hide().removeClass("fadeOutRight").addClass("fadeInRight");
   }, 299);
   setTimeout(function () {
      $("#container-fenetre").show();
      $("#container-play").show();
   }, 300);
});
$("#question").click(function () {
   $("#play").removeClass("zoomIn").addClass("fadeOutLeft");
   $("#question").removeClass("zoomIn").addClass("fadeOutRight");
   setTimeout(function () {
      $("#play").hide().removeClass("fadeOutLeft").addClass("fadeInLeft");
      $("#question").hide().removeClass("fadeOutRight").addClass("fadeInRight");
   }, 299);
   setTimeout(function () {
      $("#container-fenetre").show();
      $("#container-question").show();
   }, 300);
});
$(".fenetre .fa-chevron-left").click(function () {
   $("#container-play").removeClass("slideInRight");
   $("#container-question").removeClass("slideInRight");
   $("#container-play").removeClass("slideInUp").addClass("fadeOutDown");
   $("#container-question").removeClass("slideInUp").addClass("fadeOutDown");
   setTimeout(function () {
      $("#container-play").hide().removeClass("fadeOutDown").addClass("slideInUp");
      $("#container-question").hide().removeClass("fadeOutDown").addClass("slideInUp");
      $("#container-fenetre").hide();
   }, 299);
   setTimeout(function () {
      $("#play").show();
      $("#question").show();
   }, 300);
});
$("#container-play .fa-chevron-right").click(function () {
   $("#container-play").removeClass("slideInRight");
   $("#container-question").removeClass("slideInRight");
   $("#container-play").removeClass("slideInUp").addClass("fadeOutLeft");
   $("#container-question").removeClass("slideInUp").addClass("slideInRight");
   setTimeout(function () {
      $("#container-play").hide().removeClass("fadeOutLeft").addClass("slideInUp");
   }, 299);
   setTimeout(function () {
      $("#container-question").show();
      // $("#container-question").removeClass("slideInRight").addClass("slideInUp");
   }, 300);
});
$("#container-question .fa-chevron-right").click(function () {
   $("#container-play").removeClass("slideInRight");
   $("#container-question").removeClass("slideInRight");
   $("#container-question").removeClass("slideInUp").addClass("fadeOutLeft");
   $("#container-play").removeClass("slideInUp").addClass("slideInRight");
   setTimeout(function () {
      $("#container-question").hide().removeClass("fadeOutLeft").addClass("slideInUp");
   }, 299);
   setTimeout(function () {
      $("#container-play").show();
      // $("#container-play").removeClass("slideInRight").addClass("slideInUp");
   }, 300);
});
