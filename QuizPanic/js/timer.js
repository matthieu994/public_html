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
   idleInterval = setInterval(timerIncrement, 1000); // En minutes

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

// function getTimeRemaining(endtime) {
//   var t = Date.parse(endtime) - Date.parse(new Date());
//   var seconds = Math.floor((t / 1000) % 60);
//   var minutes = Math.floor((t / 1000 / 60) % 60);
//   var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
//   var days = Math.floor(t / (1000 * 60 * 60 * 24));
//   return {
//     'total': t,
//     'days': days,
//     'hours': hours,
//     'minutes': minutes,
//     'seconds': seconds
//   };
// }
//
// // function initializeClock(id, endtime) {
// //   var clock = document.getElementById(id);
// //   var daysSpan = clock.querySelector('.days');
// //   var hoursSpan = clock.querySelector('.hours');
// //   var minutesSpan = clock.querySelector('.minutes');
// //   var secondsSpan = clock.querySelector('.seconds');
// //
// //   function updateClock() {
// //     var t = getTimeRemaining(endtime);
// //
// //     daysSpan.innerHTML = t.days;
// //     hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
// //     minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
// //     secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
// //
// //     if (t.total <= 0) {
// //       clearInterval(timeinterval);
// //     }
// //   }
// //
// //   updateClock();
// //   var timeinterval = setInterval(updateClock, 1000);
// // }
// //
// // var deadline = new Date(Date.parse(new Date()) + 15 * 24 * 60 * 60 * 1000);
// // initializeClock('clockdiv', deadline);
