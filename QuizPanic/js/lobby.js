var result, players, intervalPlayers, question_list, question, question_count = 5;
var time = 8000;
var position = new Object();
var intervalPlayers, intervalData;

/*-----------------------------------  AFFICHAGE JOUEURS -----------------------------------------*/
$(document).ready(function() {
   if ($(window).height()-30 > 800) {
      $('body').css('min-height', $(window).height()-30);
      $('body').css('height', $(window).height()-30);
   }
   if ($(window).width()-40 > 1000) {
      $('body').css('min-width', $(window).width()-40);
      $('body').css('width', $(window).width()-40);
   }
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
         $.post('play.php', {setQuestion: $('#question').attr('question_id'), setScore: 0}, function(data){
            // console.log(data);
            start();
         }); //Le joueur hôte set la question et les utilisateurs la chargent
      }
   }, 1000);
});

function loadPlayers() { //Chargement des joueurs avant la partie
   $.post('play.php', {loadPlayers: 1}, function(data) {
      if (data == "NOT IN ROOM") {
         window.location.href = 'main.php';
         return;
      }
      console.log(data);
      result = $.parseJSON(data);
      if(result['current'] == 1 && question_list == undefined) {
         question_list = result['question_list'];
         $('#question').attr('question_id', question_list[question_count-1]);
         question_count--;
         console.log(question_list);
      }
      $('head title').text(result['room']+' - '+result['current']+'/'+result['maxplayers']);
      $('#players').children().remove();
      $('#players').append('<div><span></span><img src="img/avatar'+result['user']['avatar']+'.png"><span>'+ result['user']['username']);
      for (var i = 0; i < result['current']-1; i++) {
         $('#players').append('<div><span></span><img src="img/avatar'+result[i]['avatar']+'.png"><span>'+result[i]['username']);
      }
      for (var i = 0; i < $('#players').children().length; i++) { //Contient la position de chaque joueur
         position[i] = $('#players').children().eq(i).offset();
      }
      // position.left -= $('#players').children().first().width()/2;
   });
}
function start() { //Lancement d'un cycle
$.post('play.php', {getQuestion: 1}, function(data) {
   if(data == "") {
      console.log("Le serveur a planté, fonction: start()");
      return endGame();
   }
   // console.log(data);
   question = $.parseJSON(data);
   if(question['id'] == -1) return endGame(); //Fin du jeu
   if(question_list != undefined) {
      $('#question').attr('question_id', question_list[question_count-1]);
      question_count--;
   }
   console.log(question);
   var padArray = [1,2,3,4];
   padArray = shuffle(padArray); console.log(padArray);
   setTimeout(function () { //Affichage des réponses
      $('#players').children().each(function(index) { //On masque les scores
         $(this).children('span').first().fadeOut();
      });
      $('#progressbar').css('width', $(window).width()/2);
      $('.sub-container > div').each(function(index) {
         $(this).attr('id', 'pad'+padArray[index]);
      });
      $("#pad1").children('span').text(question[1]);
      $("#pad2").children('span').text(question[2]);
      $("#pad3").children('span').text(question[3]);
      $("#pad4").children('span').text(question[4]);
      $(".sub-container.top > div:first-of-type").fadeIn();
      setTimeout(function () {
         $(".sub-container.top > div:last-child").fadeIn();
         setTimeout(function () {
            $(".sub-container.bottom > div:first-child").fadeIn();
            setTimeout(function () {
               $(".sub-container.bottom > div:last-of-type").fadeIn();
               setTimeout(function () { //Commencer décompte
                  $('#question').text(question[0]);
                  $('#question').fadeIn();
                  $('#progressbar').fadeIn().animate({
                     width: 0
                  }, time);
                  setTimeout(function () {
                     $('#progressbar').css('background', 'rgb(174, 141, 16)');
                  }, time*0.4);
                  setTimeout(function () {
                     $('#progressbar').css('background', 'rgb(127, 0, 0)');
                  }, time*0.7);
                  setTimeout(function () { //Fin du temps
                     // $('#finishtime').fadeIn();
                     $('#progressbar').css('background', 'rgb(44, 156, 44)').hide();
                     showAnswers();
                  }, time);
               }, 500);
            }, 800);
         }, 800);
      }, 800);
   }, 10);
});
}
function showAnswers() {
   var good = $('#pad'+question['good']);
   $('.sub-container > div').each(function(index, el) { //Affichage des réponses
      if ($(this).is(good)) $(this).css('backgroundColor', 'rgba(11, 100, 14, 0.65)');
      else $(this).css('backgroundColor', 'rgba(100, 11, 14, 0.65)');
   });
   setTimeout(function () {
      $('.sub-container > div').css('box-shadow', '').css('backgroundColor','').fadeOut();
      $.post('play.php', {resetAnswers: 1});
      $('#question').fadeOut();
      setScores();
      setTimeout(function () {
         start();
      }, 3500);
   }, 5000);
}
function setScores() {
   if(question_list != undefined) {
      var scores = new Object();
      $('#players').children().each(function(index) {
         scores[index] = new Object();
         scores[index]['username'] = $(this).children('span:last-of-type').text();
         if($(this).attr('answer') == undefined) scores[index]['answer'] = "0";
         else scores[index]['answer'] = $(this).attr('answer');
         $(this).attr('answer', '0'); //Set tout les joueurs sur answer0 et re-positionne
         placePlayer(index);
      });
      $.post('play.php', {setScores: scores, goodAnswer: question['good']});
      // console.log(scores);
   } else {
      $('#players').children().each(function(index) {
         $(this).attr('answer', '0'); //Set tout les joueurs sur answer0 et re-positionne
         placePlayer(index);
      });
   }
   var indexMax = 0;
   $('#players').children().each(function(index) { //On affiche les scores et recupere le meilleur score
      $(this).children('span').first().fadeIn();
      // if ($(this).children('span').first().text() > $('#players').children().eq(indexMax).children('span').first().text()) {
      //    indexMax = index;
      // }
      // if ($(this).children('img').length > 1) {
      //    $(this).children('img').first().remove();
      // }
   });
   // if($('#players').children().eq(indexMax).children('span').first().text() > 0) $('#players').children().eq(indexMax).prepend('<img src="img/crown.png">');
}
function endGame() {
   setScores();
   setTimeout(function () {
      // clearInterval(intervalData);
   }, 1500);
   console.log("End of game!");
   // if(question_list != undefined) {
   //    $.post('play.php', {kickAll: result['room']});
   //    window.location.href = 'main.php';
   // }
}
/*----------------------------------- MOVE ON PAD / Player Data -----------------------------------------*/
function playerData() {
   intervalData = setInterval(function () {
      if(question_list != undefined && question_count == -1) { //Set question à -1 pour endGame
         // console.log("set to -1");
         $.post('play.php', {setQuestion: -1});
      }
      else if(question_list != undefined) {
         $.post('play.php', {setQuestion: $('#question').attr('question_id')}, function(data){}); //Le joueur hôte set la question
         // console.log("set to "+$('#question').attr('question_id'));
      }
      $.post('play.php', {playerData: 1}, function(data) {
         if (data == "NOT IN ROOM") {
            window.location.href = 'main.php';
            return;
         }
         result = $.parseJSON(data);
         if(result['current'] == 1 && result['maxplayers']!=1) window.location.reload(); //Si joueur seul dans la salle
         players = result;
         // if(result['question_id'] == -1) return endGame(); //Fin du jeu
         $('#players').children().first().children().first().text(result['user']['score']); //Set scores
         $('#players').children(':not(:first-child)').each(function(index) {
            $(this).children().first().text(result[index]['score']);
         });
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
         $('#players').children().first().children('img:last-of-type').attr('src', 'img/avatar'+result['user']['avatar']+'.png');
         for (var i = 0; i < result['current']-1; i++) { //Placement des joueurs
            var player = $('#players').children().eq(i+1);
            player.children('img:last-of-type').attr('src', 'img/avatar'+result[i]['avatar']+'.png');
            if (player.attr('answer') != result[i]['answer'] && $('#progressbar').width() != 0) {
               arrangePad(i+1, result[i]['answer']);
               placePlayer(i+1);
               // $('#players').children().each(function(index) {
               //    placePlayer(index);
               // });
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
      }, 650);
      return;
   }
   var pad = $('#pad'+player.attr('answer'));
   var offset = {top: 0, left: 0}; var sameAnswer = 0;
   $('#players').children().each(function(count, el) {
      if(player.attr('answer') == $(this).attr('answer') && index != count) sameAnswer++;
   });
   if(sameAnswer >= 1) offset.top += 70; if(sameAnswer == 1 || sameAnswer == 3) offset.left -= player.width(); if(sameAnswer == 2 || sameAnswer == 5) offset.left += player.width();
   if(sameAnswer >= 3) offset.top += 70; if(sameAnswer == 3) offset.left-=player.width()/2; if(sameAnswer == 3) offset.left+=player.width()/2;
   player.animate({
      top: pad.offset().top-position[index].top+50+offset.top,
      left: pad.offset().left+pad.width()/2-position[index].left-player.width()/2+offset.left
   }, 400);
}
function arrangePad(playerIndex, newAnswer) { //Reset les positions sur le pad et attribue answer
   var initPlayer = $('#players').children().eq(playerIndex);
   var answer = initPlayer.attr('answer');
   initPlayer.attr('answer', newAnswer);
   if (answer < 1 || answer > 4 || answer == undefined) return;
   var pad = $('#pad'+answer);
   $('#players').children().each(function(index, el) {
      if($(this).attr('answer') == answer && index != playerIndex) {
         if ($(this).offset().top > initPlayer.offset().top && $(this).offset().left < initPlayer.offset().left) { //Le joueur était 2e
            placePlayer(index);
         }
      }
   });
}
$('.sub-container div').click(function() {
   if ($('#progressbar').width() == 0 || $(this).css('opacity') != 1) {
      return;
   }
   $('.sub-container div').css('box-shadow', '');
   $(this).css('box-shadow', '0px 0px 16px 1px rgba(0, 0, 0, 0.3)');
   arrangePad(0, $(this).attr('id').substr(3,1));
   placePlayer(0);
   $.post('play.php', {setAnswer: $('#players').children().first().attr('answer')});
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



function shuffle(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    return a;
}
