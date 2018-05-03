$(document).ready(function() {
   var room, maxplayers, current;
   setInterval(function () {                             // Afficher nbr de joueurs
      $.post('play.php', {getName: '1'}, function(data) {
         var result = $.parseJSON(data);
         room = result['room'];
         maxplayers = result['maxplayers'];
         current = result['current'];
         $('head title').text(room+' - '+current+'/'+maxplayers);
      });
   }, 1000);
});
