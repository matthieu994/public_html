var room="Lobby", maxplayers=1, current=0, intervalPlayers;

/*-----------------------------------  AFFICHAGE JOUEURS -----------------------------------------*/
$(document).ready(function() {
   loadPlayers();
   $('head title').text(room+' - '+current+'/'+maxplayers);
   intervalPlayers = setInterval(function () {                //Afficher nbr de joueurs
      loadPlayers();
      $('head title').text(room+' - '+current+'/'+maxplayers);
      if (current == maxplayers) {
         clearInterval(intervalPlayers);
         start();
      }
   }, 1000);
});
function loadPlayers() {
   $.post('play.php', {getName: '1', loadPlayers: '1'}, function(data) {
      console.log(data);
      if (data == "NOT IN ROOM") {
         window.location.href = 'main.php';
      }
      var result = $.parseJSON(data);
      room = result['room'];
      maxplayers = result['maxplayers'];
      current = result['current'];
      $('#players').children().remove();
      for (var i = 0; i < current; i++) {
         $('#players').append('<div><img src="img/avatar.png"><span>'+ result[i]);
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

/*-----------------------------------  QUITTER SALLE -----------------------------------------*/
$('header .fa-sign-out-alt').click(function() {
   $.post('play.php', {leaveRoom: 1, room: room}, function(data) {
      window.location.href = 'main.php';
   });
});
