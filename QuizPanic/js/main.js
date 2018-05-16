function reload_js(src) {
   $('script[src="' + src + '"]').remove();
   $('<script>').attr('src', src).appendTo('html');
}
$("#profil").click(function () {
   $("#dropdown").toggle();
});
function displayAlert(alert, time) {
   // console.log('heya');
   $("section.alert div").each(function(){$(this).hide()});
   $('section.alert #'+alert).fadeIn(200);
   setTimeout(function () {
      $('section.alert #'+alert).fadeOut(200);
   }, time);
}
function playSound() {
   if ($('footer .fa-volume-up').css('display') == 'block') {
      audioElement.play();
      $('footer .fa-volume-up').toggle().siblings('.fa-volume-down').toggle();
      setTimeout(function () {
         $('footer .fa-volume-up').fadeIn(200).siblings('.fa-volume-down').fadeOut();
      }, 400);
   }
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
function displayFenetre(fenetre) {
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
      fenetre.show();
   }, 300);
}
$("#play").click(function(){displayFenetre($('#container-play'))});      //Afficher #play / #questions
$("#question").click(function(){displayFenetre($('#container-question'))});
function returnMenu() {
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
}
$(".fenetre .fa-chevron-left").click(returnMenu); //Retour au menu
function slideToQuestions() {
   $("#container-play").removeClass("slideInRight");
   $("#container-question").removeClass("slideInRight");
   $("#container-play").removeClass("slideInUp").addClass("fadeOutLeft");
   $("#container-question").removeClass("slideInUp").addClass("slideInRight");
   setTimeout(function () {
      $("#container-play").hide().removeClass("fadeOutLeft").addClass("slideInUp");
   }, 299);
   setTimeout(function () {
      $("#container-question").show();
   }, 300);
}
$("#container-play .fa-chevron-right").click(slideToQuestions); //Slide play->questions
function slideToPlay() {
   $("#container-play").removeClass("slideInRight");
   $("#container-question").removeClass("slideInRight");
   $("#container-question").removeClass("slideInUp").addClass("fadeOutLeft");
   $("#container-play").removeClass("slideInUp").addClass("slideInRight");
   setTimeout(function () {
      $("#container-question").hide().removeClass("fadeOutLeft").addClass("slideInUp");
   }, 299);
   setTimeout(function () {
      $("#container-play").show();
   }, 300);
}
$("#container-question .fa-chevron-right").click(slideToPlay); //Slide questions->play

/*-----------------------------------ADD QUESTION----------------------------------------*/
$('#add form select[name="good_answer"]').click(function() {
   $(this).children().each(function(index, el) {
      if ($(this).text() == "Bonne réponse" || $(this).parent().parent().children().eq(index).val() == "") {
         return;
      }
      $(this).text($(this).parent().parent().children().eq(index).val());
   });
});
$('#add form').submit(false);
$("#add form button").click(function() {
   $("section.alert div").each(function(){$(this).hide()});
   if($("#add textarea").val().trim().length <= 10) {
      displayAlert("alert_question", 1500);
      $(this).prop("disabled", true);
   }
   else if($("#add input").eq(0).val().trim().length <= 1 || $("#add input").eq(1).val().trim().length <= 1 || $("#add input").eq(2).val().trim().length <= 1 || $("#add input").eq(3).val().trim().length <= 1) {
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
   $("#questions_list").load("question.php", {getQuestions : '1'}, function() { //TRI SUPER COOL POUR SETS
      var $div = $('#questions_list > div');
      sets = {};
      $div.each(function(){
         sets[$(this).attr('question_set')] = '';
      });
      for (set in sets) {
         $div.filter('[question_set="'+ set +'"]').wrapAll('<section class="set" question_set="'+ set +'"></section>');
      }
      $('form#addquestion select[name="sets"]').empty();
      $('form#addquestion select[name="sets"]').append('<option value="NULL" selected>Set: Indéfini');
      $('#questions_list section.set').each(function () {
         if ($(this).attr("question_set") == "NULL") $(this).prepend('<span>'+"Indéfini"+'<i class="fas fa-trash-alt" style="color: #d72d2d"></i><i class="fas fa-caret-down">');
         else {
            if($(this).attr("question_set") == 'Public') $(this).prepend('<span>'+$(this).attr("question_set")+'<i class="fas fa-caret-down">');
            else $(this).prepend('<span>'+$(this).attr("question_set")+'<i class="fas fa-trash-alt" style="color: #d72d2d"></i><i class="fas fa-caret-down">');
            $('form#addquestion select[name="sets"]').append($('<option>', {
               value: $(this).attr("question_set"),
               text: 'Set: '+$(this).attr("question_set")
            }));
         }
      });
   });
}

function addQuestion() {
   $.post(
      'question.php',
      $("form#addquestion").serialize()
   )
   .done(function() {
      displayAlert("success_addquestion", 1500)
      playSound();
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

/*------------------------------DELETE SET-------------------------------------------*/
$("#questions_list").on('click', 'section.set span .fa-trash-alt',function () {
   if ($(this).parent().text().trim() == 'Indéfini') var set = 'NULL';
   else var set = $(this).parent().text().trim();
   $.post('question.php', {deleteSet: set}, function(data) {loadQuestions()});
   displayAlert("success_deleteset", 1500);
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
   $('form#addquestion select[name="good_answer"]').click();
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
         console.log(data);
         if(data == "ERROR_PERM_UPDATE") {
            displayAlert("error", 1500);
         } else {
            displayAlert("success_modifyquestion", 1500);
            playSound();
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
         // console.log(data);
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
$('#questions_list').on('click', 'div .fa-trash-alt',function () { //Suppression question
   // var data = $("form#addquestion").serializeArray();
   deleteQuestion([{name: 'id', value: $(this).parent().attr('question_id')}]);
});

/*----------------------------- PLAY SOUND / OVERFLOW-Y --------------------------------------*/
var audioElement = document.createElement('audio');
audioElement.setAttribute('src', 'sounds/ring.m4r');
$('footer .fas').click(function() {
   $(this).toggle();
   $(this).siblings('.fas').eq(0).toggle();
});

$(document).ready(function() { //Desactiver overflow pendant animation
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
   var verif = 0;
   $('select[name="sets"] option').each(function(index) {
      if($("form#addquestion input#addset").val() == $(this).attr('value')) verif = 1;
   });
   if (verif == 1 || $("form#addquestion input#addset").val().length <= 1 || $("form#addquestion input#addset").val() == 'Indéfini') return;
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
$("#questions_list").on('click', 'section.set > span i.fa-caret-down',function () {
   $(this).parent().parent().children('div').toggle(300);
   // console.log($(this).css('transform'));
   if($(this).css('transform') == 'none') $(this).css('transform','rotate(180deg)');
   else $(this).css('transform','none');
});

/*------------------------------ROOMS MANAGE------------------------------------------*/
$(document).on('input change', 'form#addroom input#range', function() {
   $('form#addroom output#range').text("0 - "+$(this).val());
});
$('#rooms form').submit(function(event) {
   event.preventDefault();
   if($('#addroom button[type="cancel"]').eq(0).is(document.activeElement)) { //Annuler Modification
      // console.log("cancel");
      $('#rooms form')[0].reset();
      $('form#addroom output#range').text("0 - "+$('form#addroom input#range').val());
      $("#rooms .title").text("Créer une salle");
      $("#rooms form button:first-child").attr('room_id', 0).text("Ajouter").css('float', '');
      $("#rooms form button:not(:first-child)").hide();
      return;
   }
   if($('#addroom button[type="delete"]').eq(0).is(document.activeElement)) { //Supprimer room
      var data = $(this).serializeArray();
      data.push({name: 'deleteRoom', value: 1});
      data.push({name: 'id', value: $("#rooms form button:first-child").attr('room_id')});
      editRoom(data, "delete");
      return;
   }
   if ($(this).children('input[name="room"]').val().trim().length <= 1) {
      displayAlert("alert_roomname", 1800);
      return;
   }
   if ($("#rooms form button:first-child").text() == "Ajouter") { //Ajouter
      $.post(
         'room.php',
         $(this).serialize(),
         function (data) {
            var childDivs = $('#join section').children().length;
            loadRooms();
            // console.log(data);
            setTimeout(function () {
               if (childDivs+1 == $('#join section').children().length) { //Si ajout effectué
                  playSound();
                  displayAlert("success_addroom", 2000);
                  $('#rooms form')[0].reset();
                  $('form#addroom output#range').text("0 - "+$('form#addroom input#range').val());
               }
               else {
                  if (data == "MAX_ROOMS") {
                     displayAlert("error_maxrooms", 1500);
                  }
                  else {
                     displayAlert("error_room", 1500);
                  }
               }
            }, 100);
         }
      );
   }
   else { //Modifier
      var data = $(this).serializeArray();
      data.push({name: 'modifyRoom', value: 1});
      data.push({name: 'id', value: $("#rooms form button:first-child").attr('room_id')});
      editRoom(data, "modify");
   }
});
function editRoom(data, type) {
   $.post(
      'room.php',
      data,
      function (data) {
         if (data != "ERROR_PERM_UPDATE") {
            if(type == "modify") displayAlert("success_modifyroom", 1500);
            if(type == "delete") displayAlert("success_deleteroom", 1500);
            if(type == "modify" || type == "delete") playSound();
            loadRooms();
         }
         else {
            displayAlert("error", 1500);
         }
         $('#rooms form')[0].reset();
         $('form#addroom output#range').text("0 - "+$('form#addroom input#range').val());
         $("#rooms .title").text("Créer une salle");
         $("#rooms form button:first-child").attr('room_id', 0).text("Ajouter").css('float', '');
         $("#rooms form button:not(:first-child)").hide();
      }
   );
}
function loadRooms() { //Chargement des rooms
   $("#join section").load("room.php", {
      getRooms : '1'
   });
   refreshStatus();
}
function refreshStatus() { //Chargement du status
   setTimeout(function () {
      $('#join .fa-sign-in-alt').each(function() {
         if(!$(this).next().children().eq(1).is(':checked') && $(this).next().children().length >= 1) {
            $(this).css('color', 'rgb(172, 22, 22)');
            $(this).prev().css('cursor', 'not-allowed');
         }
         else {
            $(this).css('color', '');
            $(this).prev().css('cursor', '');
         }
      });
   }, 200);
}
$('#join .fa-sync-alt').click(function () { //reload rooms
   $(this).css('transform','rotate(180deg)');
   loadRooms();
   setTimeout(function () { //annulation du rotate sur actualiser
      $('#join .fa-sync-alt').css('transition', 'unset');
      $('#join .fa-sync-alt').css('transform','');
      setTimeout(function () {
         $('#join .fa-sync-alt').css('transition', '0.5s ease-in');
      }, 50);
   }, 500);
});
$("#join section").on('click', '.fa-pencil-alt',function () { //Modification room -> form
   $("#rooms form").children().eq(0).val($(this).parent().text().trim());
   $('form#addroom input#range').val($(this).parent().prev().prev().children().eq(1).text());
   $('form#addroom output#range').text("0 - "+$('form#addroom input#range').val());
   $("#rooms .title").text("Modifier une salle");
   $("#rooms form button:first-child").attr('room_id', $(this).next().attr('id')).text("Modifier").css('float', 'right');
   $("#rooms form button:not(:first-child)").show();
});
$("#join section").on('click', '.tgl-btn',function () { //Modification statut
   var room = $(this).parent().text().trim(),
   data = $(this).serializeArray();
   data.push({name: 'id', value: $(this).prev().attr('id')});
   data.push({name: 'editStatus', value: 1});
   if ($(this).prev().is(':checked')) {
      data.push({name: 'status', value: "Off"});
      $.post('play.php', {kickAll: room});
   }
   else {
      data.push({name: 'status', value: "On"});
   }
   editRoom(data, 0);
   setTimeout(function () {
      loadRooms();
   }, 800);
});

/*------------------------------JOIN ROOM------------------------------------------*/
$(document).ready(function() { //quitte la salle ou le joueur était
   $.post('play.php', {leaveRoom: '1'}, function() {
      loadRooms();
   });
});
$("#join section").on('mouseenter', '.tgl-btn',function () { //Hover status
   $(this).parent().prev().prev().css('opacity', '1');
});
$("#join section").on('mouseleave', '.tgl-btn',function () {
   $(this).parent().prev().prev().css('opacity', '');
});
$("#join section").on('click', '.playercount', function() { //Rejoindre une salle
   if ($(this).css('cursor') == "not-allowed") {
      return;
   }
   var room = $(this).next().next();
   var maxplayers = $(this).children().eq(1).text();
   $.post('room.php', {room: room.text().trim(), verifRoom: 1}, function(data) {
      // console.log(data);
      var data = JSON.parse(data);
      if(data['players'] == 0) {
         if (room.children().length == 3) { //Si le joueur est admin
            $('#room_popup button').css('float','left').css('marginLeft', '10px');
            $('#room_popup span').last().fadeIn();
            $('#room_popup label').fadeIn(200).prev().prop('checked', false);
         }
         if(data['admin'] == 0) {
            $('#room_popup').fadeIn(300);
            $('#room_popup input').first().val(5); $('#room_popup output').first().text("5 questions");
            $('#room_popup input').last().val(10); $('#room_popup output').last().text("10 secondes");
            $('#room_popup span').eq(0).text(room.text().trim());
            $('#container-play').css('opacity', '0.4').css('z-index', '-1');
         }
      }
      else if(data['players']-data['admin'] < maxplayers) {
         $.post('room.php', {room: room.text().trim(), verifRoom: 1, joinRoom: 1}, function() {
            window.location.href = "lobby.php";
         });
      }
   });
});

/*------------------------------ ROOM POPUP ------------------------------------------*/
$('#room_popup form').first().on('input change', 'input#range', function() {
   $(this).next().text($(this).val()+" questions");
   $('#room_popup select').children().remove();
   $('#questions_list section.set').each(function() {
      if($(this).children('div').length >= $('#room_popup input#range').val())
      $('#room_popup select').append($('<option>', {
         value: $(this).attr('question_set'),
         text: $(this).children('span').text()
      }));
   });
});
$('#room_popup form').last().on('input change', 'input#range', function() {
   $(this).next().text($(this).val()+" secondes");
});
$('#room_popup button').click(function() {
   var data = {
      room: $('#room_popup span').first().text(),
      verifRoom: 1,
      joinRoom: 1,
      questionCount: $('#room_popup input').first().val()
   };
   if($('#room_popup label').prev().prop('checked') == true && $(this).parent().css('height') == '235px') { //Admin : true
      data['admin'] = 1;
      data['delay'] = $('#room_popup input').last().val();
      data['set'] = $('#room_popup select').val();
   }
   $.post('room.php', data, function(data) {
      window.location.href = "lobby.php";
   });
});
$('#room_popup label').click(function() {
   if($(this).prev().prop('checked') == false) { //Si le joueur est admin
      $(this).parent().css('height', '235px');
      $('#room_popup form').last().fadeIn();
      $('#room_popup div').fadeIn();
      $('#room_popup select').children().remove();
      $('#questions_list section.set').each(function() {
         if($(this).children('div').length >= $('#room_popup input#range').val())
         $('#room_popup select').append($('<option>', {
            value: $(this).attr('question_set'),
            text: $(this).children('span').text()
         }));
      });
   } else {
      $(this).parent().css('height', '');
      $('#room_popup form').last().hide();
      $('#room_popup div').hide();
   }
});
$('#room_popup #exitnotif').click(function() {
   $(this).parent().fadeOut('300', function() {
      $(this).css('height', '');
      $('#room_popup form').last().hide();
      $('#room_popup button').css('float','').css('marginLeft', '');
      $('#room_popup span').last().hide();
      $('#room_popup label').hide();
      $('#room_popup div').hide();
   });
   $('#container-play').css('opacity', '').css('z-index','');
});

/*--------------------------- HELPER (clic droit) -----------------------------*/
var helper = $('#helper');
$(document).contextmenu(function(event) {
   event.preventDefault();
   if(helper.is(event.target) || helper.children().is(event.target)) return;
   if(event.clientX+353 > $(this).width()) helper.css('left',$(this).width()-390);
   else helper.css('left',event.clientX);
   if(event.clientY+100 > $(this).height()) helper.css('top',$(this).height()-100);
   else helper.css('top', event.clientY);
   helper.fadeIn(100);
});
$('#helper span').click(function(event) {
   helper.hide();
   if ($("#container-play").css('display')!='none' || $("#container-question").css('display')!='none') {
      if($("#container-play").css('display')=='none' && $('#helper span').first().is(event.target)) slideToPlay();
      if($("#container-question").css('display')=='none' && $('#helper span').last().is(event.target)) slideToQuestions();
      return;
   }
   if($('#helper span').first().is(event.target)) displayFenetre($("#container-play"));
   else displayFenetre($("#container-question"));
});
$(document).click(function(event) {
   if(helper.is(event.target) || helper.children().is(event.target)) return;
   helper.hide();
});

// function loadParty() { //IFRAME
//    var data = [];
//    data.push({name: 'room', value: $(this).next().next().text().trim()});
//    data.push({name: 'joinRoom', value: 1});
//    editRoom(data);
//    $('body').children().fadeOut();
//    $('body').prepend('<iframe>');
//    $('body').children('iframe').hide().fadeIn(800).attr('role', 'lobby').attr('src', 'lobby.php');
// }
