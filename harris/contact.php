<?=template_header('Contact')?>

<div class="contact-header">
    <h1>Contact Us</h1>
</div>
<div class="map">
        <div id="map" style="height: 480px; width:850px"></div>
        <script>
          function initMap() {
            var uluru = {lat: 11.664877, lng: 78.147859};
            var grayStyles = [
              {
                featureType: "all",
                stylers: [
                  { saturation: -90 },
                  { lightness: 50 }
                ]
              },
              {elementType: 'labels.text.fill', stylers: [{color: '#ccdee9'}]}
            ];
            var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: -31.197, lng: 150.744},
              zoom: 9,
              styles: grayStyles,
              scrollwheel:  false
            });
          }
          
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&callback=initMap" ></script>
        
      </div>
      <?=template_footer()?>