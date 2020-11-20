<main class="container">
    <?php include './app/views/components/menu.php' ?>
    <div class="content">
        <div class="row h-100">
            <div class="col-9">
                <div class="h-100" id="map"></div>
            </div>
            <div class="col-3">
                <div class="d-flex align-items-center p-2 text-dark rounded shadow-sm">
                    <?php
                        foreach ($areas as $area){
                            echo "<div class='my-3 p-3 bg-white w-100'><h3 class='border-bottom border-grey pb-1 pl-2'>". $area['name']. "</h3>";

                            if (!empty($area['parklots'])){
                                foreach ($area['parklots'] as $parklot){
                                    echo "<div class='my-2' onclick='setLocation(".$parklot['longitude'] . ', '. $parklot['latitude'] .")'>". $parklot['name'].
                                            "<span onclick='add_park_info(".$parklot['parklot_id'] . ", \"" . $parklot['name'] ."\")' class='float-right'>order</span>
                                        </div>";
                                }
                            }

                            echo "</div>";
                        }
                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Order Park Location</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form >
                <div class="modal-body">
                    <input type="hidden" id="parklot_id" name="parklot_id">
                    <div class="form-group">
                        <label for="parklot_name" class="col-form-label h3">Park Location Name</label>
                        <span class="form-control" onclick="form-control" id="parklot_name"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
    </div>
</main>

<script>
    let map;
    // Initialize and add the map
    function initMap() {
        // The map, centered at Uluru
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 14,
        });


    }

    function add_park_info(id, name){
        $('#parklot_name').text(name);
        $('#parklot_id').val(id);
        $('#modal').modal();
    }

    function setLocation(lng, lat){
        latLng = { lat: lat, lng: lng}
        const marker = new google.maps.Marker({
            position: latLng,
            map:map
        })
        map.setCenter(latLng)
    }
</script>