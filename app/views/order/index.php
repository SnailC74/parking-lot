<main class="container">
    <?php include './app/views/components/menu.php' ?>
    <div class="bars">
        <img src="/static/img/image.jpg">
    </div>
    <div class="content mb-5">
        <div class="t_area">
            <div class="t_title mb-5">My Orders</div>
            <?php if(isset($orders)){
                echo "<table class='table table-hover'><thead>
                        <tr>
                            <td scope='col'>Flight No.</td>
                            <td >Aircraft Type</td>
                            <td >Price</td>
                            <td >Flight Time</td>
                            <td >Daparture Date</td>
                            <td >Departure Time</td>
                            <td >Arrive Time</td>
                            <td >Operation</td>
                        </tr>
                    </thead>
                    <tbody>";
                foreach ($orders as $order){
                    $flight = $order['flight'];
                    echo "<tr>
                          <th scope='row'>". $flight['flightID'] ."</th>
                          <td>". $flight['aircraft']['craftID']. "</td>
                          <td>$". $flight['price']. " NZD</td>
                          <td>". $flight['flight_time']. "</td>
                          <td>". $order['departure_date']. "</td>
                          <td>". $flight['departure_time']. "</td>
                          <td>". $flight['arrive_time']. "</td>
                          <td><a class='btn btn-danger ' href='/order/delete?orderID=". $order['orderID']. "'>Delete </a> </td>
                        </tr>";
                }
            }else{
                echo "<h2 class='text-centre'>No Order </h2>";
            }
            ?>

        </div>
    </div>
</main>