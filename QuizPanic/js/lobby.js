var room, maxplayers=1, current=0, intervalPlayers;
$(document).ready(function() {
   intervalPlayers = setInterval(function () {                // Afficher nbr de joueurs
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
      var result = $.parseJSON(data);
      room = result['room'];
      maxplayers = result['maxplayers'];
      current = result['current'];
   });
}
function start() {
   $('#question').animate({
      marginTop: '10px'
   });
   setTimeout(function () {
      displayAnswer("#pad1");
      setTimeout(function () {
         displayAnswer("#pad2");
         setTimeout(function () {
            displayAnswer("#pad3");
            setTimeout(function () {
               displayAnswer("#pad4");
               $('#progressbar').fadeIn().animate({
                  width: 0
               }, 9500);
               setTimeout(function () {
                  $('#progressbar').css('background', 'rgb(174, 141, 16)');
               }, 2000);
               setTimeout(function () {
                  $('#progressbar').css('background', 'rgb(180, 37, 37)');
               }, 6000);
               setTimeout(function () {
                  $('.sub-container > div').fadeOut();
                  $('#question').css('marginTop', '-40px');
                  $('#progressbar').css('width', '1000px').css('background', 'rgb(44, 156, 44)').hide();
               }, 10000);
            }, 800);
         }, 800);
      }, 800);
   }, 10);
}
function displayAnswer(pad) {
   $(pad).fadeIn();
}