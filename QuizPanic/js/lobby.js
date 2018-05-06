var result, players, intervalPlayers, questions, question_count = 5;
var position = new Object();

/*-----------------------------------  AFFICHAGE JOUEURS -----------------------------------------*/
$(document).ready(function() {
   $.post('play.php', {loadQuestions: 'Public'}, function(data) {
      questions = $.parseJSON(data);
   });
   if ($(window).height()-30 > 800) {
      $('body').css('min-height', $(window).height()-30);
      $('body').css('height', $(window).height()-30);
   }
   // if ($(window).width()-40 > 1000) {
   //    $('body').css('min-width', $(window).width()-40);
   //    $('body').css('width', $(window).width()-40);
   // }
   $(window).resize(function() {
      position = $('#players').offset();
      position.left -= $('#players').width()/2;
   });
   if ($('body').height()-$('.sub-container').eq(0).height()*2-$('.sub-container').eq(0).offset().top > 0) $('.sub-container').eq(1).css('margin-top', $('body').height()-$('.sub-container').eq(0).height()*2-$('.sub-container').eq(0).offset().top);
   loadPlayers();
   intervalPlayers = setInterval(function () { //Afficher nbr de joueurs
      loadPlayers();
      if (result['current'] == result['maxplayers']) {
         clearInterval(intervalPlayers);
         playerData();
         start();
      }
   }, 1000);
});

function loadPlayers() { //Chargement des joueurs avant la partie
   $.post('play.php', {loadPlayers: 1}, function(data) {
      if (data == "NOT IN ROOM") {
         window.location.href = 'main.php';
         return;
      }
      // console.log(data);
      result = $.parseJSON(data);
      $('head title').text(result['room']+' - '+result['current']+'/'+result['maxplayers']);
      $('#players').children().remove();
      $('#players').append('<div><img src="img/avatar'+result['user']['avatar']+'.png"><span style="color: #0cd50c">'+ result['user']['username']);
      for (var i = 0; i < result['current']-1; i++) {
         $('#players').append('<div><img src="img/avatar'+result[i]['avatar']+'.png"><span>'+result[i]['username']);
      }
      for (var i = 0; i < $('#players').children().length; i++) {
         position[i] = $('#players').children().eq(i).offset();
      }
      // position.left -= $('#players').children().first().width()/2;
   });
}
function start() { //Lancement d'un cycle
var random = 0;
$('#question').attr('question_id', questions[Math.round(Math.random()*Object.keys(questions).length)]);
$.post('play.php', {setQuestion: $('#question').attr('question_id')}, function(data) {
   setTimeout(function () {
      $("#pad1").fadeIn();
      setTimeout(function () {
         $("#pad2").fadeIn();
         setTimeout(function () {
            $("#pad3").fadeIn();
            setTimeout(function () {
               $("#pad4").fadeIn();
               setTimeout(function () { //Commencer décompte
                  $('#question').text(result['question'][0]);
                  $('#question').css('marginTop', '10px');
                  $('#progressbar').css('width', $(window).width()/2);
                  $('#progressbar').fadeIn().animate({
                     width: 0
                  }, 9500);
                  setTimeout(function () {
                     $('#progressbar').css('background', 'rgb(174, 141, 16)');
                  }, 2000);
                  setTimeout(function () {
                     $('#progressbar').css('background', 'rgb(127, 0, 0)');
                  }, 6500);
                  setTimeout(function () { //Fin du temps
                     $('#finishtime').fadeIn();
                     $('#progressbar').css('background', 'rgb(44, 156, 44)').hide();
                     showAnswers();
                  }, 9800);
               }, 500);
            }, 800);
         }, 800);
      }, 800);
   }, 10);
});
}
function showAnswers() {
   var i = 0;
}

/*----------------------------------- MOVE ON PAD / Player Data -----------------------------------------*/
function playerData() {
   setInterval(function () {
      $.post('play.php', {playerData: 1, answer: $('#players').children().first().attr('answer')}, function(data) {
         if (data == "NOT IN ROOM") {
            window.location.href = 'main.php';
            return;
         }
         result = $.parseJSON(data);
         players = result;
         console.log(result);
         if (result['current'] != $('#players').children().length) { //Si un joueur a quitté la salle
            $('head title').text(result['room']+' - '+result['current']+'/'+result['maxplayers']);
            for (var i = 1; i < $('#players').children().length; i++) {
               var verif = false;
               for (var j = 0; j < result['current']-1; j++) {
                  if ($('#players').children().eq(i).children('span').text().trim() == result[j]['username']) {
                     verif = true;
                  }
               }
               if(verif == false) $('#players').children().eq(i).css('opacity', '0');
            }
         }
         $('#players').children().first().children('img').attr('src', 'img/avatar'+result['user']['avatar']+'.png');
         for (var i = 0; i < result['current']-1; i++) { //Placement des joueurs
            var player = $('#players').children().eq(i+1);
            player.children('img').attr('src', 'img/avatar'+result[i]['avatar']+'.png');
            if (player.attr('answer') != result[i]['answer']) {
               player.attr('answer', result[i]['answer']);
               placePlayer(i+1);
            }
         }
      });
   }, 1000);
}
function placePlayer(index) {
   var player = $('#players').children().eq(index);
   var pad = $('#pad'+player.attr('answer'));
   player.animate({
      top: pad.offset().top-position[index].top+50,
      left: pad.offset().left+pad.width()/2-position[index].left-player.width()/2
   }, 600);
}
$('.sub-container div').click(function() {
   if ($('#progressbar').width() == 0) {
      return;
   }
   $('#players').children().first().attr('answer', $(this).attr('id').substr(3,1));
   placePlayer(0);
});

/*----------------------------------- SETTINGS -----------------------------------------*/
$('header .fa-cogs').click(function() {
   $('#settings').animate({
      marginLeft: 0,
      opacity: 1
   }, 400);
   $(this).fadeOut(300);
});
$('header .fa-chevron-left').click(function() {
   $('#settings').animate({
      marginLeft: '-300px',
      opacity: 0
   }, 400);
   $('header .fa-cogs').fadeIn(300);
});
function updateAvatar() {
   $.post('play.php', {getAvatar: 1}, function(data) {
      $('#avatar').children().eq(data-1).css('background', 'rgba(16, 121, 133, 0.4)');
   });
}
$('#avatar').ready(updateAvatar);
$('#avatar img').click(function() {
   $(this).parent().children('img').css('background', '');
   $.post('play.php', {setAvatar: $(this).index()+1});
   updateAvatar();
   $('#players').children().first().children('img').attr('src', 'img/avatar'+($(this).index()+1)+'.png').hide().fadeIn();
});

/*-----------------------------------  QUITTER SALLE -----------------------------------------*/
$('header .fa-sign-out-alt').click(function() {
   $.post('play.php', {leaveRoom: 1, room: result['room']}, function(data) {
      window.location.href = 'main.php';
   });
});
