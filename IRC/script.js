/*----------------- SCROLLBAR TO BOTTOM ---------------------*/
var scrolldiv = document.getElementById("messages");
function scroll () {
   scrolldiv.scrollTop = scrolldiv.scrollHeight;
}
scroll();

/*----------------- INFOS USER ---------------------*/
var el = document.getElementsByClassName('dropdown')[0];
var settings = document.getElementsByClassName('settings')[0];

var profil = document.getElementById('profil');
var show_settings = document.getElementsByClassName('profil-settings')[0];

function show () {
   el.style.display = "block";
   el.style.visibility = "visible";
}

function hide () {
   el.style.display = "none";
   el.style.visibility = "hidden";
}

function change () {
   settings.style.display = "block";
   settings.style.visibility = "visible";
}

profil.addEventListener("mouseover", show);
profil.addEventListener("mouseout", hide);
show_settings.addEventListener("click", change);

/*-------------------------- FERMER FENETRE SETTINGS -----------------------------*/
$(document).ready(function()
{
   $(document).mouseup(function(e)
   {
      var subject = $("#settings");

      if(e.target.id != subject.attr('id') && !subject.has(e.target).length)
      {
         updateAll();
         subject.fadeOut();
      }
   });
});

/*----------------- COLOR INPUTS ---------------------*/
var inputOther = document.querySelector('#othercolor');
var inputUser = document.querySelector('#usercolor');
var defaultOther = "#3d514a";
var defaultUser = "#1c2824";

function rgb2hex(rgb){
   rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
   return (rgb && rgb.length === 4) ? "#" +
   ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
   ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
   ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
}
function updateExemples() {
   document.querySelector(".other span").style.background = inputOther.value;
   document.querySelector(".user span").style.background = inputUser.value;
}

function updateAll() {
   defaultUser = inputUser.value;
   defaultOther = inputOther.value;

   // var spans = document.querySelectorAll('.' + sender + ' span');
   // for (var i = 0; i < spans.length; i++) {
   //    spans[i].style.background = event.target.value;
   // }
}
// function setColors() {
//    document.querySelectorAll('.messages .other span').forEach(function(spans) {
//       spans.style.background = defaultOther;
//    });
//    document.querySelectorAll('.messages .user span').forEach(function(spans) {
//       spans.style.background = defaultUser;
//    });
// }
// function updateAll(event) {
//    document.querySelectorAll("#react").forEach(function(p) {
//       p.style.color = event.target.value;
//    });
// }

/*----------------- AUTO-REFRESH DIV / TEXTAREA KEYS ---------------------*/
$("#chatarea").keypress(function (e) {
   if(e.which == 13 && !e.shiftKey) {
      if(jQuery.trim($("#chatarea").val()).length > 0) {
         $('#form').submit();
      }
      e.preventDefault();
      return false;
   }
   if(e.which == 10 && e.ctrlKey) {
      $('#chatarea').val($('#chatarea').val() + "\n");
   }
});
