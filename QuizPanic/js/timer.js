/*------------------------AUTO LOGOUT------------------------------------------------------*/
var idleInterval;
var timer;

var idleTime = 0;
var currsec = 0;
var minutes = 5; // Temps avant affichage countdown visible
var untilsec = 90; // Temps affiché countdown visible
var el = document.querySelector("#timeleft");

startTimer();
function startTimer() {
   idleInterval = setInterval(timerIncrement, 60000); // En minutes

   $(this).mousemove(function () {
      idleTime = 0;
   });
   $(this).keypress(function () {
      idleTime = 0;
   });
   $(this).click(function () {
      idleTime = 0;
   });

   function timerIncrement() {
      idleTime++;
      // console.log("Time: " + idleTime);

      if (idleTime >= minutes) {
         el.innerHTML = untilsec;
         clearInterval(idleInterval);
         $(".notification div").attr("id", "container-timer");
         $("section.alert div").each(function(){$(this).hide()});
         $('section[role="page"]').css('opacity', '1');
         $(".notification").fadeIn(600);
         timer = setInterval(countdown, 1000);
         $("#exitnotif").click(reloadAll);
         $(this).keypress(reloadAll);
         $(this).click(reloadAll);
      }
   }
}

function countdown() {
   currsec++;
   el.innerHTML = (untilsec-currsec);
   if (currsec == untilsec) {
      window.location.replace("logout.php");
   }
}

function reloadAll(event) {
   // console.log(event.target.offsetParent);
   if(event.type == "click" && ($("#container-timer").is(event.target) || $("#container-timer").is(event.target.offsetParent)) && !$("#exitnotif").is(event.target))
   return;
   $(".notification").fadeOut(300);
   clearInterval(idleInterval);
   clearInterval(timer);
   reload_js('js/timer.js');
}
