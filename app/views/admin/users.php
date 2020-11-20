<main class="container">
    <?php include './app/views/admin/menu.php'?>
    <div class="main_content">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>User Name</th>
                <th>User Role</th>
                <th>Default Num</th>
                <th>Statue</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            <?php
            if($data_list && !empty($data_list)){

                foreach ($data_list as $k => $u){
                    $userType = $u["role"] == 0 ? 'Normal User' : 'Admin User';
                    $userStatus = $u['is_active'] == 0 ? 'Disable' : 'Available';
                    $userStatusBtn = $u['is_active'] == 0 ?
                        '<a class="px-3" href="/admin/active_user?userid='. $u["user_id"] . '">Activate</a>' :
                        '<a class="px-3" href="/admin/disable_user?userid='. $u["user_id"] . '">Disable</a>';


                    echo '<tr><td>'. ($k +1) .'</td>
                            <td>'. $u["name"] .'</td>
                            <td>'.$userType .'</td>
                            <td>'.$u['default_num'] .'</td>
                            <td>'.$userStatus .'</td>
                            <td>
                                <a class="px-3" href="/admin/del_user?userid='. $u["user_id"] . '">Delete</a>'. $userStatusBtn.'
                                <a class="px-3" href="/admin/park_history?userid='. $u["user_id"] . '">Park History</a>
                            </td>
                            </tr>';
                }
            }else{
                echo '<tr><td colspan="6" class="text-center h3">No Data</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>

</main>