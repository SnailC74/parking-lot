<main class="container">
    <?php include './app/views/admin/menu.php'?>
    <div class="main_content">
        <div class="row justify-content-end mb-2">
            <div class="col-2">
                <a class="btn btn-primary text-white" href="/admin/add_area">Add Area</a>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th width="70%">Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            <?php
            if($data_list && !empty($data_list)){

                foreach ($data_list as $k => $u){

                    echo '<tr><td>'. ($k +1) .'</td>
                            <td>'. $u["name"] .'</td>
                            <td>
                                <a class="px-3" href="/admin/del_area?areaid='. $u["area_id"] . '">Delete</a>
                                <a class="px-3" href="/admin/parklots?areaid='. $u["area_id"] . '">Park Locations</a>
                            </td>
                            </tr>';
                }
            }else{
                echo '<tr><td colspan="3" class="text-center h3">No Data</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>

</main>