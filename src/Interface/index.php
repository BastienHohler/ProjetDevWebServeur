{% include 'nav.php' %}
<p class="text-center"><img src="https://unpkg.com/leaflet@1.3.1/dist/images/marker-icon.png" alt=""> personnes ayant le covid <img src="http://maps.google.com/mapfiles/ms/icons/red-dot.png" alt="">Moi</p><br>
<div class="d-flex justify-content-center align-middle" style="height:100vh;">
<div id="map">
	    <!-- Ici s'affichera la carte -->
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

 <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
	<script type="text/javascript">
    var listeMarker = []
    var mapInit=0
    var macarte = null;
    function success(position) {
      const latitude  = position.coords.latitude;
      const longitude = position.coords.longitude;
        $.ajax({
      method: "POST",
      url: 'http://localhost:8080/coord',
      data: {
        latitude: latitude,
        longitude: longitude
      }
    }).done(function(data) {
    });

		  if(mapInit == 0){
        initMap();
       }else{
         markerUpdate()
       } 
       mapInit=1    
       // Fonction d'initialisation de la carte
       function initMap() {
         for(i=0;i<listeMarker.length;i++){
          macarte.removeLayer(listeMarker[i]);
         }
           // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
           macarte = L.map('map').setView([latitude, longitude], 16);
           // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
           L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
               // Il est toujours bien de laisser le lien vers la source des données
               attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
               minZoom: 14,
               maxZoom: 20
           }).addTo(macarte);
           var meIcon = L.icon({
            iconUrl: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
            iconSize:     [40, 40], // size of the icon
            popupAnchor:  [0, -20] // point from which the popup should open relative to the iconAnchor
          });
           var marker = L.marker([latitude, longitude],{icon: meIcon}).addTo(macarte);
           marker.bindPopup("Moi");
           listeMarker.push(marker)
           $.get( "http://localhost:8080/coord", function( data ) {
             var response = JSON.parse(data);
            for(i=0;i<response.length;i++){
              if(response[i].latitude <= latitude+0.05 && response[i].latitude >= latitude-0.05 && response[i].longitude <= longitude+0.05 && response[i].longitude >= longitude-0.05){
                var marker = L.marker([response[i].latitude, response[i].longitude]).addTo(macarte)
                if(response[i].anonyme == 0){
                  marker.bindPopup(response[i].prenom+" "+response[i].nom);
                }else marker.bindPopup('Cette personne souhaite rester anonyme');
                listeMarker.push(marker)
              }
            }
            
            });

      status.textContent = '';
      }

      function markerUpdate() {
         for(i=0;i<listeMarker.length;i++){
          macarte.removeLayer(listeMarker[i]);
         }
           var meIcon = L.icon({
            iconUrl: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
            iconSize:     [40, 40], // size of the icon
            popupAnchor:  [0, -20] // point from which the popup should open relative to the iconAnchor
          });
           var marker = L.marker([latitude, longitude],{icon: meIcon}).addTo(macarte);
           marker.bindPopup("Moi");
           listeMarker.push(marker)
           $.get( "http://localhost:8080/coord", function( data ) {
             var response = JSON.parse(data);
            for(i=0;i<response.length;i++){
              if(response[i].latitude <= latitude+0.05 && response[i].latitude >= latitude-0.05 && response[i].longitude <= longitude+0.05 && response[i].longitude >= longitude-0.05){
                var marker = L.marker([response[i].latitude, response[i].longitude]).addTo(macarte)
                if(response[i].anonyme == 0){
                  marker.bindPopup(response[i].prenom+" "+response[i].nom);
                }else marker.bindPopup('Cette personne souhaite rester anonyme');
                listeMarker.push(marker)
              }
            }
            
            });

      status.textContent = '';
      }
    }

    function error() {
      status.textContent = 'Unable to retrieve your location';
    }

    function localisation(){
    if (!navigator.geolocation) {
      status.textContent = 'Geolocation is not supported by your browser';
    } else {
      status.textContent = 'Locating…';
      navigator.geolocation.getCurrentPosition(success, error);
      }
    }

    localisation()
    setInterval(localisation,60000)
        </script>
  </body>
</html>
