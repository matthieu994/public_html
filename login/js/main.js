
function verify_alert() {
   if(document.getElementsByClassName('alert').length > 0) {
      document.getElementsByClassName('exist')[0].style.visibility = "hidden";
      document.getElementsByClassName('exist')[0].style.display = "none";
   }
   else {
      document.getElementsByClassName('exist')[0].style.visibility = "visible";
      document.getElementsByClassName('exist')[0].style.display = "block";
   }
}

function signup() {
   document.getElementsByClassName('signup')[0].innerHTML="Se connecter";
   document.getElementsByClassName('signup')[0].setAttribute("onclick", "signin()");

   var mail = document.getElementsByClassName('signup-div')[0];
   mail.setAttribute("class", "wrap-input100 validate-input signup-div");
   mail.children[0].setAttribute("class", "input100");

   mail.style.visibility = "visible";
   mail.style.display = "inline-block";

   var wrap = document.getElementsByClassName('wrap-input100');
   $(wrap[1]).removeClass('alert-validate');
   $(wrap[2]).removeClass('alert-validate');

   document.getElementsByClassName('exist')[0].style.visibility = "hidden";
   document.getElementsByClassName('exist')[0].style.display = "none";
   if(document.getElementsByClassName('alert').length > 0) {
      document.getElementsByClassName('alert')[0].style.visibility = "hidden";
      document.getElementsByClassName('alert')[0].style.display = "none";
   }
   document.getElementsByClassName('create')[0].style.visibility = "visible";
   document.getElementsByClassName('create')[0].style.display = "block";
}

function signin () {
   document.getElementsByClassName('signup')[0].innerHTML="S'inscrire";
   document.getElementsByClassName('signup')[0].setAttribute("onclick", "signup()");

   var mail = document.getElementsByClassName('signup-div')[0];
   mail.removeAttribute("class");
   mail.setAttribute("class", "signup-div");
   mail.children[0].removeAttribute("class");

   mail.style.visibility = "hidden";
   mail.style.display = "none";

   var wrap = document.getElementsByClassName('wrap-input100');
   $(wrap[0]).removeClass('alert-validate');
   $(wrap[1]).removeClass('alert-validate');

   document.getElementsByClassName('exist')[0].style.visibility = "visible";
   document.getElementsByClassName('exist')[0].style.display = "block";
   if(document.getElementsByClassName('alert').length > 0) {
      document.getElementsByClassName('alert')[0].style.visibility = "hidden";
      document.getElementsByClassName('alert')[0].style.display = "none";
   }
   document.getElementsByClassName('create')[0].style.visibility = "hidden";
   document.getElementsByClassName('create')[0].style.display = "none";
}


(function ($) {
   "use strict";


   /*==================================================================
   [ Focus input ]*/
   $('.input100').each(function(){
      $(this).on('blur', function(){
         if($(this).val().trim() != "" || $(this).val() == " ") {
            $(this).addClass('has-val');
         }
         else {
            $(this).removeClass('has-val');
         }
      })
   })


   /*==================================================================
   [ Validate ]*/

   $('.validate-form').on('submit',function(){
      var input = $('.validate-input .input100');
      var check = true;

      for(var i=0; i<input.length; i++) {
         if(validate(input[i]) == false){
            console.log(input[i]);
            showValidate(input[i]);
            check=false;
         }
      }

      return check;
   });


   $('.validate-form .input100').each(function(){
      $(this).focus(function(){
         hideValidate(this);
      });
   });

   function validate (input) {
      if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
         if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
            console.log("dont match");
            return false;
         } else {
            // $(input).addClass('has-val');
            // hideValidate(input);
         }
      }
      else {
         if($(input).val().trim() == '' && $(input).val() != " "){
            return false;
         }
      }
   }

   function showValidate(input) {
      var thisAlert = $(input).parent();

      $(thisAlert).addClass('alert-validate');
   }

   function hideValidate(input) {
      var thisAlert = $(input).parent();

      $(thisAlert).removeClass('alert-validate');
   }

   /*==================================================================
   [ Show pass ]*/
   var showPass = 0;
   $('.btn-show-pass').on('click', function(){
      if(showPass == 0) {
         $(this).next('input').attr('type','text');
         $(this).addClass('active');
         showPass = 1;
      }
      else {
         $(this).next('input').attr('type','password');
         $(this).removeClass('active');
         showPass = 0;
      }

   });


})(jQuery);
