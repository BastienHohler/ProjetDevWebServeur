{% include 'nav.php' %}
<div class="d-flex justify-content-center align-middle" style="height:100vh;">
<div id="map">
	    <!-- Ici s'affichera la carte -->
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
function geoFindMe() {

const status = document.querySelector('#status');
const mapLink = document.querySelector('#map-link');

mapLink.href = '';
mapLink.textContent = '';

function success(position) {
  const latitude  = position.coords.latitude;
  const longitude = position.coords.longitude;

  status.textContent = '';
  mapLink.href = `https://www.openstreetmap.org/#map=18/${latitude}/${longitude}`;
  mapLink.textContent = `Latitude: ${latitude} °, Longitude: ${longitude} °`;
}

function error() {
  status.textContent = 'Unable to retrieve your location';
}

if (!navigator.geolocation) {
  status.textContent = 'Geolocation is not supported by your browser';
} else {
  status.textContent = 'Locating…';
  navigator.geolocation.getCurrentPosition(success, error);
}

}

document.querySelector('#find-me').addEventListener('click', geoFindMe);
    </script>
 <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
	<script type="text/javascript">
  function coordonnee($address){
    $.ajax({
    url: 'http://api.positionstack.com/v1/forward',
    data: {
      access_key: 'c600e0b8cf0213139ff1b36a17ec62b3',
      query: $address,
      limit: 1
    }
  }).done(function(data) {
    console.log(data.data[0].latitude)
  });
  }
    function success(position) {
      const latitude  = position.coords.latitude;
      const longitude = position.coords.longitude;
      var macarte = null;
      window.onload = function(){
		  initMap(); 
            };
            
       // Fonction d'initialisation de la carte
       function initMap() {
           // Créer l'objet "macarte" et l'insèrer dans l'élément HTML qui a l'ID "map"
           macarte = L.map('map').setView([latitude, longitude], 16);
           // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
           L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
               // Il est toujours bien de laisser le lien vers la source des données
               attribution: 'données © <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
               minZoom: 10,
               maxZoom: 20
           }).addTo(macarte);
           var marker = L.marker([latitude, longitude]).addTo(macarte);
            }

      status.textContent = '';
    }

    function error() {
      status.textContent = 'Unable to retrieve your location';
    }

    if (!navigator.geolocation) {
      status.textContent = 'Geolocation is not supported by your browser';
    } else {
      status.textContent = 'Locating…';
      navigator.geolocation.getCurrentPosition(success, error);
    }
        </script>
  </body>
</html>
