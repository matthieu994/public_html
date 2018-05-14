function feed(id) {
   $.post('action.php', {feed: id}, function(data) {
      reload(id);
   });
}

function water(id) {
   $.post('action.php', {water: id}, function(data) {
      reload(id);
   });
}

function pet(id) {
   $.post('action.php', {pet: id}, function(data) {
      reload(id);
   });
}

function reload(id) {
   $('body').load(
      'action.php',
      {loadTama: id}
   );
}
