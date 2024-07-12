window.addEventListener('load', function () {
    "use strict";

    const URL = 'getOffers.php';

    const updateToy =  function () {
      fetch(URL)
    .then(
      function (response) {
        if (response.status === 200) {
            return response.json();
          } else {
            throw new Error("Invalid response")
          }        
      }    
    )
    .then( 
      function (json) {
        document.getElementById("offers").innerHTML = "<h2>" + json.toyName +"</h2>";
        document.getElementById("offers").innerHTML += "<h3>Price: " + json.toyPrice +"</h3>";
        document.getElementById("offers").innerHTML += "<p>" + json.catDesc +"</p>";
    }
    )
    .catch(
      function (err) {
        console.log("Something went wrong!", err);
    }
    );
    }
    updateToy();
    setInterval(updateToy,5000);

});