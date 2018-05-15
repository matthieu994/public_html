/*------------------------CHANGE FORM------------------------------------------------------------------------*/
$(".signup button").click(toggle);
function toggle () {
   reset();
   var loginbutton = document.querySelector(".signup button");
   var signup = document.querySelector(".container-signup");
   var login = document.querySelector(".container-login");

   if(signup.style.display == "none") {
      $(".container-signup .confirm").fadeIn("slow");
      signup.style.display = "block";
      login.style.display = "none";
      document.querySelector(".signup span").innerHTML = "Déjà inscrit ?";
      loginbutton.innerHTML = "Se connecter";
      // document.querySelector("#error_auth").style.display = "none";
   }
   else {
      $(".container-signup .confirm").fadeOut();
      login.style.display = "block";
      signup.style.display = "none";
      document.querySelector(".signup span").innerHTML = "Pas de compte ?";
      loginbutton.innerHTML = "S'inscrire";
      // document.querySelector("#error_taken").style.display = "none";
   }
}

/*------------------------PASSWORD MATCH-------------------------------------------------------------------*/
function check_valid () {
   if($("#pass1").val() == "") {
      $(".container-signup .password .fas").each(function() {
         $(this).css("color", "#8aaaaa");
         // $("#alert_pass").fadeOut();
      });
      return;
   }
   if($("#pass1").val().length < 3) {
      displayAlert("alert_pass", 1500);
      $(".container-signup button").css("pointer-events", "none");
      $(".container-signup .password .fa-lock").first().css("color", "rgba(82, 0, 0, 0.59)");
      $(".container-signup button").prop("disabled", true);
   }
   if($("#pass1").val().length >= 3) {
      $("#alert_pass").fadeOut();
      $(".container-signup button").css("pointer-events", "auto");
      $(".container-signup .password .fa-lock").first().css("color", "rgb(30, 142, 61)");
      $(".container-signup button").prop("disabled", false);
   }
   if($("#pass2").val().length != 0) check();
   else $(".confirm .fa-lock").css("color", "#8aaaaa");
   verifUsername();
}
function check () {
   if($("#pass2").val() == "") {
      $(".confirm .fa-lock").css("color", "#8aaaaa");
      return;
   }
   if ($("#pass1").val() != $("#pass2").val()) {
      // $("#pass2").css("box-shadow", "rgba(82, 0, 0, 0.59) 0px 0px 10px 1px");
      $(".container-signup button").css("pointer-events", "none");
      $(".confirm .fa-lock").css("color", "rgba(82, 0, 0, 0.59)");
      $(".container-signup button").prop("disabled", true);
      displayAlert("alert_pass2", 1500);
   } else {
      // $("#pass2").css("box-shadow", "0px 0px 16px 1px rgba(0, 0, 0, 0.14)");
      $(".container-signup button").css("pointer-events", "auto");
      $(".confirm .fa-lock").css("color", "rgb(30, 142, 61)");
      $(".container-signup button").prop("disabled", false);
      $("#alert_pass2").fadeOut();
   }
   verifUsername();
}
function reset () {
   $("button").each(function() {
      $(this).css("pointer-events", "auto");
      $(this).prop("disabled", false);
   })
   $("form input").each(function() {
      $(this).val("");
   });
   $("form .fas").each(function() {
      $(this).css("color", "#8aaaaa");
   });
   $("section.alert div").each(function() {
      $(this).fadeOut("fast");
   });
}
$("#pass1").keyup(check_valid);
$("#pass1").focus(check_valid);
$("#pass2").keyup(check);
$("#pass2").focus(check);

/*------------------------SE CONNECTER------------------------------------------------------------*/
$('.container-login form').submit(function(event) {
   event.preventDefault();
   $.post('login.php', $('.container-login form').serialize(), function(data) {
      if (data == "connected") {
         window.location.href = 'main.php';
      }
      else {
         displayAlert("error_auth", 1500);
      }
   });
});

$('.container-signup form').submit(function(event) {
   event.preventDefault();
   $.post('register.php', $('.container-signup form').serialize(), function(data) {
      if (data == 'success') {
         window.location.href = 'main.php';
      }
   });
});

/*------------------------PASSWORD REVEAL------------------------------------------------------------*/
document.querySelector(".container-login .fa-eye-slash").addEventListener("mouseover", function () {this.classList.remove("fa-eye-slash"); document.getElementById("pass").type = "text";});
document.querySelector(".container-signup .fa-eye-slash").addEventListener("mouseover", function () {this.classList.remove("fa-eye-slash"); document.getElementById("pass1").type = "text";});
document.querySelector(".container-login .fa-eye-slash").addEventListener("mouseout", function () {this.classList.add("fa-eye-slash"); document.getElementById("pass").type = "password";});
document.querySelector(".container-signup .fa-eye-slash").addEventListener("mouseout", function () {this.classList.add("fa-eye-slash"); document.getElementById("pass1").type = "password";});

/*------------------------USERNAME VERIFICATION------------------------------------------------------*/
function verifUsername() { // Effectue une requête et récupère les résultats
   var username = $("#userinput").val();
   if(username == "") {
      $(".container-signup .fa-user").css("color", "#8aaaaa");
      $("#error_taken").fadeOut();
      return;
   }
   if(username.length < 3 || username.length > 25) {
      $(".container-signup .fa-user").css("color", "rgba(82, 0, 0, 0.59)");
      displayAlert("alert_user", 1500);
      $(".container-signup button").css("pointer-events", "none");
      $(".container-signup button").prop("disabled", true);
      return;
   }
   else  {
      $("#alert_user").fadeOut();
      $(".container-signup button").css("pointer-events", "auto");
      $(".container-signup button").prop("disabled", false);
   }

   $.post('register.php', {verifUsername: '1', username: username}, function(data) {
      if(data == "taken") { // Pseudo existe déjà
         $(".container-signup .fa-user").css("color", "rgba(82, 0, 0, 0.59)");
         displayAlert("error_taken", 1500);
         $(".container-signup button").css("pointer-events", "none");
         $(".container-signup button").prop("disabled", true);
      }
      else { // Pseudo libre
         $(".container-signup .fa-user").css("color", "rgb(30, 142, 61)");
         $("#error_taken").fadeOut();
         $(".container-signup button").css("pointer-events", "auto");
         $(".container-signup button").prop("disabled", false);
      }
   });
}
$(".container-signup .username").keyup(verifUsername);



function displayAlert(alert, time) {
   if($('#'+alert).css('display') != 'none') return;
   $("section.alert div").each(function(){$(this).hide()});
   $('section.alert #'+alert).fadeIn(200);
   setTimeout(function () {
      $('section.alert #'+alert).fadeOut(200);
   }, time);
}
