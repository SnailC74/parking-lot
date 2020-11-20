<main class="container">
    <?php include './app/views/admin/menu.php'?>
    <div class="main_content">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Park Location Name</th>
                <th>User Name</th>
                <th>Usage Begin</th>
                <th>Usage End</th>
                <th>Abided</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            <?php
            if($data_list && !empty($data_list)){
                foreach ($data_list as $k => $u){
                    $userStatusBtn = $u['is_active'] == 0 ?
                        '<a class="px-3" href="/admin/active_user?userid='. $u["user_id"] . '">Activate</a>' :
                        '<a class="px-3" href="/admin/disable_user?userid='. $u["user_id"] . '">Disable</a>';


                    echo '<tr><td>'. ($k +1) .'</td>
                            <td>'. $u["name"] .'</td>
                            <td>'.$u['longitude'] .'</td>
                            <td>'.$u['latitude'] .'</td>
                            <td>'.$u['area_name'] .'</td>
                            <td>'.$u['park_num'] .'</td>
                            <td>'.$u['usage_begin'] .'</td>
                            <td>
                                <a class="px-3" href="/admin/del_parklot?parklotid='. $u["parklot_id"] . '">Delete</a>'. $userStatusBtn.'
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