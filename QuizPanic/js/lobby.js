var result, players, intervalPlayers, question_list, question, question_count = 5;
var position = new Object();

/*-----------------------------------  AFFICHAGE JOUEURS -----------------------------------------*/
$(document).ready(function() {
   if ($(window).height()-30 > 800) {
      $('body').css('min-height', $(window).height()-30);
      $('body').css('height', $(window).height()-30);
   }
   // if ($(window).width()-40 > 1000) {
   //    $('body').css('min-width', $(window).width()-40);
   //    $('body').css('width', $(window).width()-40);
   // }
   $(window).resize(function() {
      // position = $('#players').offset();
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
      if(question_list == undefined) question_list = result['question_list'];
      if(question_list != undefined) {
         $('#question').attr('question_id', question_list[question_count-1]);
         $.post('play.php', {setQuestion: $('#question').attr('question_id')});
      }
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
if(question_list != undefined) {
   // console.log(question_list);
   $('#question').attr('question_id', question_list[question_count-1]);
   question_count--;
}
$.post('play.php', {getQuestion: 1}, function(data) {
   console.log(data);
   question = $.parseJSON(data);
   while(question[0] == "") {
      $.post('play.php', {getQuestion: 1}, function(data) {
         question = $.parseJSON(data);
      });
   }
   // console.log(question);
   setTimeout(function () { //Affichage des réponses
      $("#pad1").children('span').text(question[1]);
      $("#pad1").fadeIn();
      setTimeout(function () {
         $("#pad2").children('span').text(question[2]);
         $("#pad2").fadeIn();
         setTimeout(function () {
            $("#pad3").children('span').text(question[3]);
            $("#pad3").fadeIn();
            setTimeout(function () {
               $("#pad4").children('span').text(question[4]);
               $("#pad4").fadeIn();
               setTimeout(function () { //Commencer décompte
                  $('#question').text(question[0]);
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
   var good = $('.sub-container > div').eq(question['good']-1);
   $('.sub-container > div').each(function(index, el) {
      if ($(this).is(good)) $(this).css('backgroundColor', 'rgba(11, 100, 14, 0.65)');
      else $(this).css('backgroundColor', 'rgba(100, 11, 14, 0.65)');
   });
   setTimeout(function () {
      $('.sub-container > div').css('backgroundColor','').fadeOut();
      $.post('play.php', {resetAnswers: 1});
      $('#players').children().each(function(index, el) {
         $(this).attr('answer', '0');
         placePlayer(index);
      });
      start();
   }, 3000);
}

/*----------------------------------- MOVE ON PAD / Player Data -----------------------------------------*/
function playerData() {
   setInterval(function () {
      if(question_list != undefined) {
         $.post('play.php', {setQuestion: $('#question').attr('question_id')});
      }
      $.post('play.php', {playerData: 1}, function(data) {
         if (data == "NOT IN ROOM") {
            window.location.href = 'main.php';
            return;
         }
         result = $.parseJSON(data);
         players = result;
         // console.log(result);
         if (result['current'] != $('#players').children().length) { //Si un joueur a quitté la salle
            $('head title').text(result['room']+' - '+result['current']+'/'+result['maxplayers']);
            for (var i = 1; i < $('#players').children().length; i++) {
               var verif = false;
               for (var j = 0; j < result['current']-1; j++) {
                  if ($('#players').children().eq(i).children('span').text().trim() == result[j]['username']) {
                     verif = true;
                  }
               }
               if(verif == false) $('#players').children().eq(i).css('opacity', '0').attr('answer', '0');
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
   if (player.attr('answer') == 0 || player.attr('answer') == undefined) {
      player.animate({
         top: 0, left: 0
      }, 600);
      return;
   }
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
   $.post('play.php', {setAnswer: $('#players').children().first().attr('answer')});
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
