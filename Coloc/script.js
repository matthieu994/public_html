(function() {
   var results = document.getElementById('results');

   function getResults(event) { // Effectue une requête et récupère les résultats
      var keywords = event.target.value;
      console.log(keywords);
      if(keywords == "") {
         results.innerHTML = "";
         return;
      }

      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'search.php?s=' + encodeURIComponent(keywords));
      xhr.addEventListener('readystatechange', function() {
         if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
            if (xhr.responseText.length) results.innerHTML = xhr.responseText;
         }
      });
      xhr.send(null);
      return xhr;
   }
   document.getElementsByName("nom")[0].addEventListener('keyup', getResults);
})();
