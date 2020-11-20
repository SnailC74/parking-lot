<main class="container">
    <?php include './app/views/admin/menu.php'?>Area
    <div class="main_content">
        <div class="row justify-content-end mb-2">
            <div class="col-2">
                <a class="btn btn-primary text-white" href="/admin/add_parklot">Add Park Location</a>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Area</th>
                <th>Prak Number</th>
                <th>Usage</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            <?php
            if($data_list && !empty($data_list)){
                foreach ($data_list as $k => $u){
                    echo '<tr><td>'. ($k +1) .'</td>
                            <td>'. $u["name"] .'</td>
                            <td>'. $u['area_name'] .'</td>
                            <td>'. $u['park_num'] .'</td>
                            <td>'. $u['usage_begin'] . ' - '. $u['usage_end']. '<br/>' .'</td>
                            <td>
                                <a class="px-3" href="/admin/del_parklot?parklotid='. $u["parklot_id"] . '">Delete</a>
                            </td>
                            </tr>';
                }
            }else{
                echo '<tr><td colspan="8" class="text-center h3">No Data</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>

</main>