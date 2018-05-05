var result, intervalPlayers;;

/*-----------------------------------  AFFICHAGE JOUEURS -----------------------------------------*/
$(document).ready(function() {
   loadPlayers();
   intervalPlayers = setInterval(function () { //Afficher nbr de joueurs
      loadPlayers();
      $('head title').text(result['room']+' - '+result['current']+'/'+result['maxplayers']);
      if (result['current'] == result['maxplayers']) {
         clearInterval(intervalPlayers);
         backgroundData();
         start();
      }
   }, 1000);
});
function backgroundData() {
   setInterval(function () {
      loadPlayers();
   }, 1000);
}
function loadPlayers() {
   $.post('play.php', {getName: '1', loadPlayers: '1'}, function(data) {
      if (data == "NOT IN ROOM") {
         window.location.href = 'main.php';
      }
      result = $.parseJSON(data);
      // console.log(result);
      $('#players').children().remove();
      $('#players').append('<div><img src="img/avatar'+result['user']['avatar']+'.png"><span style="color: #0cd50c">'+ result['user']['username']);
      for (var i = 0; i < result['current']-1; i++) {
         $('#players').append('<div><img src="img/avatar'+result[i]['avatar']+'.png"><span>'+ result[i]['username']);
      }
   });
}
function start() {
   setTimeout(function () {
      displayAnswer("#pad1");
      setTimeout(function () {
         displayAnswer("#pad2");
         setTimeout(function () {
            displayAnswer("#pad3");
            setTimeout(function () {
               displayAnswer("#pad4");
               setTimeout(function () {
                  $('#question').animate({
                     marginTop: '10px'
                  });
                  $('#progressbar').fadeIn().animate({
                     width: 0
                  }, 9500);
                  setTimeout(function () {
                     $('#progressbar').css('background', 'rgb(174, 141, 16)');
                  }, 2000);
                  setTimeout(function () {
                     $('#progressbar').css('background', 'rgb(127, 0, 0)');
                  }, 6500);
                  setTimeout(function () {
                     $('#finishtime').fadeIn();
                     $('#question').css('marginTop', '-70px');
                     $('#progressbar').css('width', '1000px').css('background', 'rgb(44, 156, 44)').hide();
                  }, 9800);
               }, 500);
            }, 800);
         }, 800);
      }, 800);
   }, 10);
}
function displayAnswer(pad) {
   $(pad).fadeIn();
}

/*-----------------------------------  SETTINGS -----------------------------------------*/
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
