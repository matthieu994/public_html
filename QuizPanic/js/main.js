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
$('#add form').submit(false);
$("#add form button").click(function() {
   $("section.alert div").each(function(){$(this).hide()});
   if($("#add textarea").val().trim().length <= 10) {
      $("#alert_question").fadeIn();
      $(this).prop("disabled", true);
      setTimeout(function () {
         $("#alert_question").fadeOut();
      }, 4000);
   }
   else if($("#add input").eq(0).val().trim() <= 4 || $("#add input").eq(1).val().trim() <= 4 || $("#add input").eq(2).val().trim() <= 4 || $("#add input").eq(3).val().trim() <= 4) {
      $("#alert_answer2").fadeIn();
      $(this).prop("disabled", true);
      setTimeout(function () {
         $("#alert_answer2").fadeOut();
      }, 4000);
   }
   else if($("#add select").val() <= 0) {
      $("#alert_answer").fadeIn();
      $(this).prop("disabled", true);
      setTimeout(function () {
         $("#alert_answer").fadeOut();
      }, 4000);
   }
   else {
      if($(this).text() == "Modifier") {
         modifyQuestion();
      }
      else {
         addQuestion();
      }
   }
   setTimeout(function () {
      $("#add form button").prop("disabled", false);
   }, 1000);
});

function loadQuestions() {
   $("#questions_list").load("question.php", {
      getQuestions : '1'
   });
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
      audioElement.play();
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

/*------------------------------GET DETAILS-------------------------------------------*/
$("#questions_list").on('click', '.fa-info-circle',function () {
   if($('section.alert #question_details').css('opacity') != '0.5') {
      return;
   }
   $("section.alert div").each(function(){$(this).hide()});
   if($('section.alert #question_details').css('display') == 'none') {
      $('section.alert #question_details span').text($(this).next().text());
      $(this).next().next().clone().appendTo('section.alert #question_details');
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
   if ($('section.alert #question_details').css('opacity') != '0.5' || $('section.alert #alert_details').css('display') == 'block') {
      return;
   }
   $("section.alert div").each(function(){$(this).hide()});
   if($('section.alert #alert_details').css('display') == 'none') {
      $('section.alert #alert_details').fadeIn();
   }
});
$("#questions_list").on('mouseleave', '.fa-info-circle',function () {
   if($('section.alert #alert_details').css('display') == 'block') {
      $('section.alert #alert_details').fadeOut();
   }
});
$(document).click(function (event) {
   if(!$("section.alert #question_details #exitnotif").is(event.target) && ($("section.alert #question_details").is(event.target.offsetParent) || $("section.alert #question_details").is(event.target) || $('section.alert #question_details').css('opacity') != '1')) return;
   else {
      $('section.alert #question_details').animate({
         marginTop : '-18%',
         opacity : 0.5
      }).fadeOut();
      setTimeout(function () {
         $('section.alert #question_details select').remove();
      }, 300);
      $('section[role="page"]').animate({
         opacity : 1
      });
   }
});

/*------------------------------MODIFY QUESTION-------------------------------------------*/
$("#questions_list").on('mouseenter', '.fa-pencil-alt',function () {
   if ($('section.alert #question_details').css('opacity') != '0.5' || $('section.alert #alert_details').css('display') == 'block') {
      return;
   }
   $("section.alert div").each(function(){$(this).hide()});
   if($('section.alert #alert_modify').css('display') == 'none') {
      $('section.alert #alert_modify').fadeIn();
   }
});
$("#questions_list").on('mouseleave', '.fa-pencil-alt',function () {
   if($('section.alert #alert_modify').css('display') == 'block') {
      $('section.alert #alert_modify').fadeOut();
   }
});
$("#questions_list").on('click', '.fa-pencil-alt',function () { //Modification question
   if ($('section.alert #question_details').css('opacity') != '0.5' || $('section.alert #alert_details').css('display') == 'block') {
      return;
   }
   $('form#addquestion textarea').val($(this).prev().prev().text());
   $('form#addquestion input[name="answer1"]').val($(this).prev().children().eq(0).text());
   $('form#addquestion input[name="answer2"]').val($(this).prev().children().eq(1).text());
   $('form#addquestion input[name="answer3"]').val($(this).prev().children().eq(2).text());
   $('form#addquestion input[name="answer4"]').val($(this).prev().children().eq(3).text());
   $('form#addquestion select').val($(this).prev().find(":selected").val());
   $('form#addquestion button').text("Modifier").attr('question_id', $(this).parent().attr('question_id'));
   $('#add button').animate({
      width : '18%',
      marginLeft : 0
   });
   $('form#addquestion button').css('margin-right', '8%').css('background-color', '#4ec57f');
   $('button#cancelmodify').delay(200).fadeIn(100);
   $('button#cancelmodify').css('margin-right', '2%').css('background-color', '#bd5555');
});
$("#add #cancelmodify").click(function() {
   $('form#addquestion')[0].reset();
   $('button#cancelmodify').hide();
   $('form#addquestion button').text("Ajouter").animate({
      width : '35%',
      marginLeft : '4%',
      marginRight : '10%'
   }).css('background-color', '#aac4c4').removeAttr('style');
});

function modifyQuestion() {
   var data = $("form#addquestion").serializeArray();
   data.push({name: 'modifyQuestion', value: 1});
   data.push({name: 'id', value: $('form#addquestion button').attr('question_id')});
   $.post(
      'question.php',
      data
   )
   .done(function() {
      $("section.alert div").each(function(){$(this).hide()});
      $("#success_modifyquestion").fadeIn();
      audioElement.play();
      setTimeout(function () {
         $("#success_modifyquestion").fadeOut();
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
   $('form#addquestion')[0].reset();
   $('button#cancelmodify').hide();
   $('form#addquestion button').text("Ajouter").animate({
      width : '35%',
      marginLeft : '4%',
      marginRight : '10%'
   }).css('background-color', '#aac4c4').removeAttr('style');
}

/*-----------------------------PLAY SOUND--------------------------------------*/
var audioElement = document.createElement('audio');
audioElement.setAttribute('src', 'sounds/ring.m4r');
$('#audioplay').click(function() {
   audioElement.play();
});
$('#audiopause').click(function() {
   audioElement.pause();
});
