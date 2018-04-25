function reload_js(src) {
   $('script[src="' + src + '"]').remove();
   $('<script>').attr('src', src).appendTo('html');
}
$("#profil").click(function () {
   $("#dropdown").toggle();
});
function displayAlert(alert, time) {
   $("section.alert div").each(function(){$(this).hide()});
   $('section.alert #'+alert).fadeIn(200);
   setTimeout(function () {
      $('section.alert #'+alert).fadeOut(200);
   }, time);
}
/*-----------------------GESTION HELP's----------------------------*/
$(".hoverable").mousemove(function (event) {
   var parentOffset = $(this).parent().offset();
   var x = event.clientX,
   y = event.clientY;
   $(this).next().css("left", (x - $(this).next().width()/2 - parentOffset.left) + 'px');
   $(this).next().css("top", (y - $(this).next().height()*1.8 - parentOffset.top) + 'px');
});

/*-----------------------FENETRES MENU----------------------------*/
$("#play").click(function () { //aficher rooms
   $('body').css('overflow-y', 'hidden');
   setTimeout(function () {
      $('body').css('overflow-y', 'auto');
   }, 1000);
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
$("#question").click(function () { //afficher questions
   $('body').css('overflow-y', 'hidden');
   setTimeout(function () {
      $('body').css('overflow-y', 'auto');
   }, 1000);
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
$(".fenetre .fa-chevron-left").click(function () { //retour menu
   $('body').css('overflow-y', 'hidden');
   setTimeout(function () {
      $('body').css('overflow-y', 'auto');
   }, 1000);
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
$("#container-play .fa-chevron-right").click(function () { //slide to questions
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
$("#container-question .fa-chevron-right").click(function () { //slide to play
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
      displayAlert("alert_question", 1500);
      $(this).prop("disabled", true);
   }
   else if($("#add input").eq(0).val().trim().length <= 2 || $("#add input").eq(1).val().trim().length <= 2 || $("#add input").eq(2).val().trim().length <= 2 || $("#add input").eq(3).val().trim().length <= 2) {
      displayAlert("alert_answer2", 1500);
      $(this).prop("disabled", true);
   }
   else if($("#add select[name='good_answer']").val() <= 0) {
      displayAlert("alert_answer", 1500);
      $(this).prop("disabled", true);
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
$('#set .fa-sync-alt').click(function () { //reload questions
   $(this).css('transform','rotate(180deg)');
   loadQuestions();
   setTimeout(function () { //annulation du rotate sur actualiser
      $('#set .fa-sync-alt').css('transition', 'unset');
      $('#set .fa-sync-alt').css('transform','');
      setTimeout(function () {
         $('#set .fa-sync-alt').css('transition', '0.5s ease-in');
      }, 50);
   }, 500);
});
function loadQuestions() {
   // $("#questions_list").append('Chargement des questions');
   $("#questions_list").load("question.php", {
      getQuestions : '1'
   });
   $("#questions_list").ready(function() {
      setTimeout(function () { //TRI SUPER COOL POUR SETS
         var $div = $('#questions_list > div');
         sets = {};
         $div.each(function(){
            sets[$(this).attr('question_set')] = '';
         });
         for (set in sets) {
            $div.filter('[question_set='+ set +']').wrapAll('<section class="set" question_set="'+ set +'"></section>');
         }
         $('form#addquestion select[name="sets"]').empty();
         $('form#addquestion select[name="sets"]').append('<option value="NULL" selected>Set: Indéfini');
         $('#questions_list section.set').each(function () {
            if ($(this).attr("question_set") == "NULL") $(this).prepend('<span>'+"Indéfini"+'<i class="fas fa-caret-down"></i>');
            else {
               $(this).prepend('<span>'+$(this).attr("question_set")+'<i class="fas fa-caret-down"></i>');
               $('form#addquestion select[name="sets"]').append($('<option>', {
                  value: $(this).attr("question_set"),
                  text: 'Set: '+$(this).attr("question_set")
               }));
            }
         });
      }, 100);
   });
}

function addQuestion() {
   $.post(
      'question.php',
      $("form#addquestion").serialize()
   )
   .done(function() {
      displayAlert("success_addquestion", 1500)
      if ($('footer .fa-volume-up').css('display') == 'block') {
         audioElement.play();
         $('footer .fa-volume-up').toggle().siblings('.fa-volume-down').toggle();
         setTimeout(function () {
            $('footer .fa-volume-up').fadeIn(200).siblings('.fa-volume-down').fadeOut();
         }, 400);
      }
   })
   .fail(function() {
      displayAlert("error", 1500);
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

/*------------------------------MODIFY/DELETE QUESTION-------------------------------------------*/
$("#questions_list").on('mouseenter', '.fa-pencil-alt',function () { //alerte infos
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
   $('form#addquestion select[name="good_answer"]').val($(this).prev().find(":selected").val());
   $('form#addquestion select[name="sets"]').val($(this).parent().attr("question_set"));
   if ($('form#addquestion button').text() == "Modifier") {
      return;
   }
   $('form#addquestion button').text("Modifier").attr('question_id', $(this).parent().attr('question_id'));
   $("#add .title#delete").show(200);
   $('#add .title').first().text("Modifier une question");
   $('#add button').css('transition', 'unset').animate({
      width : '18%',
      marginLeft : 0
   });
   $('form#addquestion button').css('margin-right', '8%').css('background-color', '#4ec57f');
   $('button#cancelmodify').delay(200).fadeIn(100);
   $('button#cancelmodify').css('margin-right', '2%').css('background-color', '#bd5555');
   setTimeout(function () {
      $('#add button').css('transition', '0.2s ease-in');
   }, 400);
});
$("#add #cancelmodify").click(function() {
   $('form#addquestion')[0].reset();
   $('button#cancelmodify').hide();
   $('#add button').css('transition', 'unset');
   $("#add .title#delete").hide(200);
   $('#add .title').first().text("Ajouter une question");
   $('form#addquestion button').text("Ajouter").animate({
      width : '35%',
      marginLeft : '4%',
      marginRight : '7%'
   }).css('background-color', '#aac4c4').removeAttr('style');
   setTimeout(function () {
      $('#add button').css('transition', '0.2s ease-in');
   }, 400);
});

function modifyQuestion() {
   var data = $("form#addquestion").serializeArray();
   data.push({name: 'modifyQuestion', value: 1});
   data.push({name: 'id', value: $('form#addquestion button').attr('question_id')});
   $.post(
      'question.php',
      data,
      function(data) { //callback on update
         if(data == "ERROR_PERM_UPDATE") {
            displayAlert("error", 1500);
         } else {
            displayAlert("success_modifyquestion", 1500);
            if ($('footer .fa-volume-up').css('display') == 'block') {
               audioElement.play();
               $('footer .fa-volume-up').toggle().siblings('.fa-volume-down').toggle();
               setTimeout(function () {
                  $('footer .fa-volume-up').fadeIn(200).siblings('.fa-volume-down').fadeOut();
               }, 400);
            }
         }
         $("form#addquestion")[0].reset();
         loadQuestions();
      }
   );
   $("#add .title#delete").hide(200);
   $('#add .title').first().text("Ajouter une question");
   $('form#addquestion')[0].reset();
   $('button#cancelmodify').hide();
   $('form#addquestion button').text("Ajouter").animate({
      width : '35%',
      marginLeft : '4%',
      marginRight : '10%'
   }).css('background-color', '#aac4c4').removeAttr('style');
}

function deleteQuestion(donnees) {
   donnees.push({name: 'deleteQuestion', value: 1});
   $.post(
      'question.php',
      donnees,
      function(data) { //callback on update
         if(data == "ERROR_PERM_UPDATE") {
            displayAlert("error", 1500);
         } else {
            displayAlert("success_deletequestion", 1500);
         }
         $("form#addquestion")[0].reset();
         loadQuestions();
      }
   );
}
$('#add #delete').click(function () {
   var data = $("form#addquestion").serializeArray();
   data.push({name: 'id', value: $('form#addquestion button').attr('question_id')});
   deleteQuestion(data);
   $('form#addquestion')[0].reset();
   $('button#cancelmodify').hide();
   $('form#addquestion button').text("Ajouter").animate({
      width : '35%',
      marginLeft : '4%',
      marginRight : '10%'
   }).css('background-color', '#aac4c4').removeAttr('style');
});
$('#questions_list').on('click', '.fa-trash-alt',function () { //Suppression question
   var data = $("form#addquestion").serializeArray();
   data.push({name: 'id', value: $(this).parent().attr('question_id')});
   deleteQuestion(data);
});

/*----------------------------- PLAY SOUND / OVERFLOW-Y --------------------------------------*/
var audioElement = document.createElement('audio');
audioElement.setAttribute('src', 'sounds/ring.m4r');
$('footer .fas').click(function() {
   $(this).toggle();
   $(this).siblings('.fas').eq(0).toggle();
});

$( document ).ready(function() { //Desactiver overflow pendant animation
   setTimeout(function () {
      $('body').css('overflow-y', 'auto');
   }, 1000);
   loadRooms();
   $('input, textarea').each(function() {
      $(this).attr('onfocus', "this.placeholder = ''");
      $(this).attr('onblur', "this.placeholder = '"+ $(this).attr('placeholder') +"'")
   });
});

/*------------------------------ADD SET------------------------------------------*/
$('form#addquestion .fas').click(function(event) {
   $(this).toggle(200);
   $(this).siblings('.fas').toggle(200);
   $("form#addquestion input#addset").toggle().focus();
   $("form#addquestion select[name='sets']").toggle();
});
$('form#addquestion .fa-check').click(function(event) {
   if ($("form#addquestion input#addset").val().length <= 1) return;
   $('form#addquestion select[name="sets"]').append($('<option>', {
      value: $("form#addquestion input#addset").val(),
      text: 'Set: '+$("form#addquestion input#addset").val()
   }));
   $('form#addquestion select[name="sets"]').val($("form#addquestion input#addset").val());
   $('form#addquestion input#addset').val('');
});
$('form#addquestion input#addset').keypress(function(event){ //simuler click pour addset
   if(event.keyCode == 13){
      event.stopImmediatePropagation(); event.preventDefault();
      $('form#addquestion .fa-check').click();
   }
});

/*------------------------------DISPLAY SETS------------------------------------------*/
$("#questions_list").on('click', 'section.set > span i',function () {
   $(this).parent().parent().children('div').toggle(300);
   if($(this).css('transform') == 'unset') $(this).css('transform','rotate(180deg)');
   else $(this).css('transform','unset');
});

/*------------------------------ROOMS MANAGE------------------------------------------*/
$(document).on('input change', 'input#range', function() {
   $('output#range').text("0 - "+$(this).val());
});
$('#rooms form').submit(function(event) {
   event.preventDefault();
   if ($(this).children('input[name="room"]').val().trim().length <= 1) {
      displayAlert("alert_roomname", 1800);
      return;
   }
   $.post(
      'room.php',
      $(this).serialize(),
      function (data) {
         displayAlert("success_addroom", 2000);
         $('#rooms form')[0].reset();
         $('output#range').text("0 - "+$('input#range').val());
         loadRooms();
      }
   );
});
function loadRooms() {
   $("#join section").load("room.php", {
      getRooms : '1'
   });
}
$("#join section").on('click', '.fa-pencil-alt',function () { //Modification room
   $("#rooms form").children().eq(0).val($(this).parent().text());
   $("#rooms .title").text("Modifier une salle");
   $("#rooms form").children().eq(3).text("Modifier");
});
