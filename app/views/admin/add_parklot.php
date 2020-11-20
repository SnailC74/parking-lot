<main class="container">
    <?php include './app/views/admin/menu.php'?>
    <div class="main_content">
        <form method="post" action="/admin/add_parklot">
            <div class="form-group">
                <label for="name" class="col-form-label h3">Park Location Name</label>
                <input type="text" class="form-control" required id="name" name="name" />
            </div>
            <div class="form-group">
                <label for="longitude" class="col-form-label h3">Park Location</label>
                <div id="map" style="height: 300px"></div>
                <input type="hidden" step="0.0001" class="form-control" required id="longitude" name="longitude" />
                <input type="hidden" step="0.0001"  class="form-control" required id="latitude" name="latitude" />
            </div>
<!--            <div class="form-group">-->
<!--                <label for="latitude" class="col-form-label h3">Park Location Latitude</label>-->
<!--                <input type="number" step="0.0001"  class="form-control" required id="latitude" name="latitude" />-->
<!--            </div>-->
            <div class="form-group">
                <label for="area" class="col-form-label h3">Park Location Area</label>
                <select class="form-control" required id="area" name="area">
                    <?php
                        foreach ($areas as $a){
                            echo '<option value="'. $a['area_id']. '">' . $a['name'] . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="park_num" class="col-form-label h3">Park Location Number</label>
                <input type="number" step="1" min="1" class="form-control" required id="park_num" name="park_num" />
            </div>
            <div class="form-group">
                <label for="usage_begin" class="col-form-label h3">Park Location Usage Begin</label>
                <input type="time" class="form-control" required id="usage_begin" name="usage_begin" />
            </div>
            <div class="form-group">
                <label for="usage_end" class="col-form-label h3">Park Location Usage End</label>
                <input type="time" class="form-control" required id="usage_end" name="usage_end" />
            </div>

            <div class="form-group">
                <label for="weekday_usable" class="col-form-label h3">Park Location Usage Weekday </label>
                <input type="text" class="form-control" required id="weekday_usable" name="weekday_usable" />
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-block btn-info mx-2">Submit</button>
            </div>
        </form>
    </div>
</main>

<script>
    let marker

    // Initialize and add the map
    function initMap() {
        const begin = { lat: -25.344, lng: 131.036 };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
            center: begin,
        });

        map.addListener("click", (e)=>{
            console.log(e);
            $('#longitude').val(e.latLng.lng());
            $('#latitude').val(e.latLng.lat());

            placeMarker(e.latLng, map);
        })
    }

    function placeMarker(latLng, map){
        marker = new google.maps.Marker({
            position: latLng,
            map: map,
        });
        marker.addListener('click', ()=>{
            marker.setMap(null);
            $('#longitude').val();
            $('#latitude').val();
        })

        map.panTo(latLng);
    }

</script>
