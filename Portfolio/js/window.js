$('#window-info div').hover(function() {
   $(this).children('i').css('visibility', 'visible');
}, function() {
   $(this).children('i').css('visibility', 'hidden');
});

$('#window-resize').click(function(event) {
   var isInFullScreen = (document.fullscreenElement && document.fullscreenElement !== null) ||
      (document.webkitFullscreenElement && document.webkitFullscreenElement !== null) ||
      (document.mozFullScreenElement && document.mozFullScreenElement !== null) ||
      (document.msFullscreenElement && document.msFullscreenElement !== null);

   var docElm = document.documentElement;
   if (!isInFullScreen) {
      if (docElm.requestFullscreen) {
           docElm.requestFullscreen();
      } else if (docElm.mozRequestFullScreen) {
           docElm.mozRequestFullScreen();
      } else if (docElm.webkitRequestFullScreen) {
           docElm.webkitRequestFullScreen();
      } else if (docElm.msRequestFullscreen) {
           docElm.msRequestFullscreen();
      }
   } else {
      if (document.exitFullscreen) {
           document.exitFullscreen();
      } else if (document.webkitExitFullscreen) {
           document.webkitExitFullscreen();
      } else if (document.mozCancelFullScreen) {
           document.mozCancelFullScreen();
      } else if (document.msExitFullscreen) {
           document.msExitFullscreen();
      }
   }
});
