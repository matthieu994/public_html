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

/*-----------------------------------ADD QUESTION----------------------------------------*/
$("#add button").click(function() {
   $("section.alert div").each(function(){$(this).hide()});
   if($("#add textarea").val().trim().length <= 10) {
      $("#alert_question").fadeIn();
      $("#add button").prop("disabled", true);
      setTimeout(function () {
         $("#alert_question").fadeOut();
      }, 4000);
   }
   else if($("#add input").eq(0).val().trim() <= 4 || $("#add input").eq(1).val().trim() <= 4 || $("#add input").eq(2).val().trim() <= 4 || $("#add input").eq(3).val().trim() <= 4) {
      $("#alert_answer2").fadeIn();
      $("#add button").prop("disabled", true);
      setTimeout(function () {
         $("#alert_answer2").fadeOut();
      }, 4000);
   }
   else if($("#add select").val() <= 0) {
      $("#alert_answer").fadeIn();
      $("#add button").prop("disabled", true);
      setTimeout(function () {
         $("#alert_answer").fadeOut();
      }, 4000);
   }
   else {
      addQuestion();
   }
   setTimeout(function () {
      $("#add button").prop("disabled", false);
   }, 1000);
});

function loadQuestions() {
   $("#questions_list").load("question.php", {
      getQuestions : '1'
   });
   // $("#questions_list").children().children('div').addClass("question_details");
   // $("<style>").text("#question_list #question_details { position: absolute;width: 100px;height: 100px;border: 1px solid white;top: -90px;left: -90px;}").appendTo("head");
   // $.getJSON(
   //
   // );
}

function addQuestion() {
   $.post(
      'question.php',
      $("form#addquestion").serialize()
   )
   .done(function() {
      $("section.alert div").each(function(){$(this).hide()});
      $("#success_addquestion").fadeIn();
      setTimeout(function () {
         $("#success_addquestion").fadeOut();
      }, 4000);
   })
   .fail(function() {
      $("section.alert div").each(function(){$(this).hide()});
      $("#fail_addquestion").fadeIn();
      setTimeout(function () {
         $("#fail_addquestion").fadeOut();
      }, 4000);
   })
   .always(function() {
      $("form#addquestion")[0].reset();
      loadQuestions();
   });
}
loadQuestions();


$("#questions_list").on('click', '.fa-info-circle',function () {
   if($('section.alert #question_details').css('display') != 'none') {
      $('section.alert #question_details').fadeOut();
      return;
   }
   $("section.alert div").each(function(){$(this).hide()});
   if($('section.alert #question_details').css('display') == 'none') {
      $('section.alert #question_details span').text($(this).next().text());
      $('section.alert #question_details option[value="1"]').text($(this).next().next().children('option[value="1"]').text());
      $('section.alert #question_details option[value="2"]').text($(this).next().next().children('option[value="2"]').text());
      $('section.alert #question_details option[value="3"]').text($(this).next().next().children('option[value="3"]').text());
      $('section.alert #question_details option[value="4"]').text($(this).next().next().children('option[value="4"]').text());
      $('section.alert #question_details').animate({
         marginTop : '75px',
         opacity : 1
      }).show();
      $('section[role="page"]').animate({
         opacity : 0.4
      });
   }
});
$("#questions_list").on('mouseenter', '.fa-info-circle',function () {
   if ($('section.alert #question_details').css('display') == 'block' || $('section.alert #alert_details').css('display') != 'none') {
      return;
   }
   $("section.alert div").each(function(){$(this).hide()});
   if($('section.alert #alert_details').css('display') == 'none') {
      $('section.alert #alert_details').fadeIn();
   }
});
$("#questions_list").on('mouseleave', '.fa-info-circle',function () {
   if($('section.alert #alert_details').css('display') == 'block') {
      $('section.alert #alert_details').delay(500).fadeOut();
   }
});
$(document).click(function (event) {
   if(!$("section.alert #question_details #exitnotif").is(event.target) && ($("section.alert #question_details").is(event.target.offsetParent) || $("section.alert #question_details").is(event.target) || $('section.alert #question_details').css('opacity') != '1')) return;
   else {
      $('section.alert #question_details').animate({
         marginTop : '-18%',
         opacity : 0.5
      }).fadeOut();
      $('section[role="page"]').animate({
         opacity : 1
      });
   }
});
