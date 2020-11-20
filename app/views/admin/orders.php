<main class="container">
    <?php include './app/views/admin/menu.php'?>
    <div class="main_content">
        <table class="table">
            <thead>
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
            <tbody>

            <?php foreach ($data_list as $k => $order){
                $flight = $order['flight'];
                echo "<tr>
                      <th scope='row'>". $flight['flightID'] ."</th>
                      <td>". $flight['aircraft']['craftID']. "</td>
                      <td>$". $flight['price']. " NZD</td>
                      <td>". $flight['flight_time']. "</td>
                      <td>". $order['departure_date']. "</td>
                      <td>". $flight['departure_time']. "</td>
                      <td>". $flight['arrive_time']. "</td>
                      <td><a class='btn btn-danger ' href='/admin/del_order?orderID=". $order['orderID']. "'>Delete </a> </td>
                    </tr>";
            }?>

            </tbody>
        </table>
    </div>

</main>