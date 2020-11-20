<main class="container">
    <?php include './app/views/components/menu.php' ?>
    <div class="bars">
        <img src="/static/img/image.jpg">
    </div>
    <div class="content mb-5">
        <div class="t_area ">
            <div class="t_title"><h2><?php  echo $msg; ?></h2></div>
            <hr>
            <?php
            if(isset($flight)){
                echo "<table class='table table-hover'><thead>
                        <tr>
                            <td scope='col'>Flight No.</td>
                            <td scope='col'>Aircraft Type</td>
                            <td scope='col'>Price</td>
                            <td scope='col'>Flight Time</td>
                            <td scope='col'>Departure Time</td>
                            <td scope='col'>Arrive Time</td>
                        </tr>
                    </thead>
                    <tbody><tr>
                              <th scope='row'>". $flight['flightID'] ."</th>
                              <td>". $flight['aircraft']['craftID']. "</td>
                              <td>$". $flight['price']. " NZD</td>
                              <td>". $flight['flight_time']. "</td>
                              <td>". $flight['departure_time']. "</td>
                              <td>". $flight['arrive_time']. "</td>
                            </tr>
                    </tbody></table>";
            }
             ?>
        </div>
    </div>
</main>