(function() {
    
    var results = document.getElementById('results');

    function getResults(event) { // Effectue une requête et récupère les résultats

	var keywords = event.target.value;

	if(keywords == "")
	    return;

	var xhr = new XMLHttpRequest();
	xhr.open('GET', 'search.php?s=' + encodeURIComponent(keywords));
	
    	xhr.addEventListener('readystatechange', function() {
            if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
		displayResults(xhr.responseText);
            }
	});
	
	xhr.send(null);
	
	return xhr;
	
    }
    
    function displayResults(response) {
	//alert(response);

    	results.style.display = response.length ? 'block' : 'none';
	
	if (response.length) {
	    
	    response = response.split('|');
	    var responseLen = response.length;
	    
	    results.innerHTML = response;
	    
/*	    for (var i = 0, div ; i < responseLen ; i++) {
		
            	div = results.appendChild(document.createElement('div'));
            	div.innerHTML = response[i];
	    }*/

	}
    }

    document.getElementsByName("nom")[0].addEventListener('keyup', getResults);
    
})();