<?php
require ('db_connection.php');
require ('header.php');

$query = "SELECT * FROM user";
$statement = $connect->prepare($query);
$statement->execute();
$count = $statement->rowCount();
$arr_users = [];
if ($count > 0){
    $arr_users = $statement->fetchAll();
}
?>

<table id="user_table">
    <thead>
    <th>Username</th>
    <th>Type</th>
    </thead>
    <tbody>
    <?php if(!empty($arr_users)) { ?>
        <?php foreach($arr_users as $user) { ?>
            <tr>
                <td><?= $user['username']; ?></td>
                <td><?= $user['u_type']; ?></td>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>
<div>
    <button type="button" name="add" id="add_button">ADD</button>
</div>
<div>
<!--    action="user_action.php"-->
    <form  method="POST" id="user_form"  style="display: none">
        <label> Username</label>
        <input type="text" name="uname" id="unmae" class="form-control" required />
        <br>
        <label>User Password</label>
        <input type="password" name="password" id="password" class="form-control" required />
        <br>
        <label>Confirm Password</label>
        <input type="password" name="c_password" id="c_password" class="form-control" required />
        <br>
        <label>User Type</label>
        <select name="u_type" id="u_type" class="form-control" required>
            <option value="">User Type</option>
            <option value="master">Admin</option>
            <option value="user">User</option>
        </select>
        <br>
        <input type="hidden" name="btn_action" id="btn_action"/> <!-- btn_action is hidden -->
        <input type="submit" name="action" id="action" />
    </form>
</div>

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>-->
<script>
    //add-user form loading
    jQuery('#add_button').click(function(){
        $('#user_form').show();
        // $('#user_form')[0].reset();
        // $('.modal-title').html("<i class='fa fa-plus'></i> Add User");//Set model title -> "Add user"
        $('#action').val("ADD");//assign "Add" value to submit button in "model-footer"
        $('#btn_action').val("ADD");//assign "Add" value to hidden "btn_action" in "model-footer"
    });

    jQuery(document).ready(function($) {
        $('#user_table').DataTable();
    } );

    jQuery(document).on('submit', '#user_form', function(event){
        event.preventDefault();
        $('#action').attr('disabled','disabled');
        var form_data = $(this).serialize();
        console.log(form_data);
        $.ajax({
            url:"user_action.php",
            method:"POST",
            data:form_data,
            success: function(data) {
                alert(data);
            },
            error: function(data){
                // alert("fail");
                window.location.reload();
            }
                // console.log("success");
                // $('#user_form')[0].reset();
                // $('#userModal').modal('hide');
                // $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
                // $('#action').attr('disabled', false);
                // window.location.reload();
                // userdataTable.ajax.reload();

        })
    })
</script>

