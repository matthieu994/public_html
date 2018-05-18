$('form#adopter').submit(function(event) {
   event.preventDefault();
   if($('form#adopter input[name="name"]').val().trim().length < 1) return;
   $.post('action.php', $('form#adopter').serialize(), function(data) {
      console.log(data);
      $('table').first().load(
         'action.php',
         {lister: 1}
      );
      $('form#adopter')[0].reset();
   });
});

$(document).ready(function() {
   $('table').first().load(
      'action.php',
      {lister: 1}
   );
});

function reloadAll() {
   setInterval(function () {
      $('table').first().load(
         'action.php',
         {lister: 1}
      );
   }, 500);
}

function update(index) {
   $('a#'+index+' img').css('transform','rotate(180deg)');
   setTimeout(function () {
      $('a#'+index+' img').css('transition', 'unset');
      $('a#'+index+' img').css('transform','');
      setTimeout(function () {
         $('a#'+index+' img').css('transition', '0.5s linear');
      }, 50);
   }, 500);


   $.post('action.php', {reload: index}, function(data) {
      var result = JSON.parse(data);
      $('table #'+index).parent().prev().prev().prev().prev().text(result['naissance']);
      $('table #'+index).parent().prev().prev().prev().text((result['soif']));
      $('table #'+index).parent().prev().prev().text((result['faim']));
      $('table #'+index).parent().prev().text((result['bonheur']));
   });
}
