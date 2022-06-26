<?php
require ('db_connection.php');
require ('header.php');

$query = "SELECT u.username, s.* FROM sessions as s, user as u WHERE u.u_id = s.user_id";
$statement = $connect->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$arr_users = [];
if ($count > 0){
    $arr_users = $statement->fetchAll();
}
?>

    <table id="session_table">
        <thead>
        <th>session id</th>
        <th>user id</th>
        <th>in time</th>
        <th>out time</th>
        </thead>
        <tbody>
        <?php if(!empty($arr_users)) { ?>
            <?php foreach($arr_users as $user) { ?>
                <tr>
                    <td><?= $user['id']; ?></td>
                    <td><?= $user['username']; ?></td>
                    <td><?= $user['in_time']; ?></td>
                    <td><?= $user['out_time']; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>

<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<!--    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>-->
    <script>
        jQuery(document).ready(function($) {
            $('#session_table').DataTable();
        } );
    </script>

<?php
