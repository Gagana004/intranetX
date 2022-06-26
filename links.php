<?php
require ('db_connection.php');
require ('header.php');

$query = "SELECT * FROM links";
$statement = $connect->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$arr_links = [];
if ($count > 0){
    $arr_links = $statement->fetchAll();
}
?>

<table id="link_table">
    <thead>
    <th>id</th>
    <th>Name</th>
    <th>Link</th>
    </thead>
    <tbody>
    <?php if(!empty($arr_links)) { ?>
        <?php foreach($arr_links as $link) { ?>
            <tr>
                <td><?= $link['link_id']; ?></td>
                <td><?= $link['link_name']; ?></td>
                <td><a type="button"  href="<?= $link['link'];?>">click here</a></td>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>



<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>-->
<script>
    jQuery(document).ready(function($) {
        $('#link_table').DataTable();
    } );

    $(document).ready(function () {
        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: '../server_side/scripts/server_processing.php',
        });
    });
</script>

