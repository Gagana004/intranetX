<?php
//user.php

include('database_connection.php');

if(!isset($_SESSION['type']))
{
	header('location:login.php');
}

include('header.php');

?>

	<span id="alert_action"></span>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                                <h3 class="panel-title">User List</h3>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align="right">
<!--                            <div class="row">-->
<!--                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">-->
                                    <button type="button" name="add" id="add_button" data-toggle="modal" data-target="#UserModal" class="btn btn-success">ADD</button>
<!--                                </div>-->
<!--                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">-->
<!--                                    <a type="button" name="export" id="export" href="user_export.php" class="btn btn-success">Export</a>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>
                    </div>


                    <div style="clear:both"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                    	<div class="col-sm-12 table-responsive">
                    		<table id="user_data" class="table">
                    			<thead><tr>
									<th>ID</th>
									<th>Username</th>
									<th>User type</th>
									<th>Update</th>
									<th>Delete</th>
								</tr></thead>
                    		</table>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="UserModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="user_form"> 			
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-plus"></i> Add User</h4>
				</div>
				<div class="modal-content">
    				<div class="modal-body">
    					<label> Username</label>
						<input type="text" name="username" id="username" class="form-control" required />
						<label> Password </label>
						<input type="password" name="u_password" id="u_password" class="form-control" required/>
                        <label>Select User Type</label>
                        <select name="u_type" id="u_type" class="form-control" required>
                            <option value="">Select User Type</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="form-group">
    				<div class="modal-footer">
    					<input type="hidden" name="u_id" id="u_id"/>
    					<input type="hidden" name="btn_action" id="btn_action"/>
    					<button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
						<input type="submit" name="action" id="action" class="btn btn-submit"/>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
    
<script>	
$(document).ready(function(){

	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add User");
		$('#action').val('ADD');
		$('#btn_action').val('ADD');
	});

	$(document).on('submit','#user_form', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url:"user_action.php",
			method:"POST",
			data:form_data,
			success:function(data) {
				$('#user_form')[0].reset();
				$('#UserModal').modal('hide');
				$('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
				$('#action').attr('disabled', false);
				userdataTable.ajax.reload();
			}
		})
	});

	$(document).on('click', '.update', function(){
		var u_id = $(this).attr("id");
		var btn_action = 'fetch_single';
		$.ajax({
			url:"user_action.php",
			method:"POST",
			data:{u_id:u_id, btn_action:btn_action},
			dataType:"json",
			success:function(data) {
				$('#UserModal').modal('show');
				$('#username').val(data.username);
                $('#u_password').val(data.u_password);
                $('#u_type').val(data.u_type);
				$('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit User");
				$('#u_id').val(u_id);
				$('#action').val('EDIT');
				$('#btn_action').val("EDIT");
			}
		})
	});

	var userdataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"user_fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				// "targets":[1],
				"orderable":false,
			},
		],
		"pageLength": 25
	});

	$(document).on('click', '.delete', function(){
		var u_id = $(this).attr('id');
		var btn_action = 'delete';
		if(confirm("Are you sure you want to delete?")) {
			$.ajax({
				url:"user_action.php",
				method:"POST",
				data:{u_id:u_id, btn_action:btn_action},
				success:function(data) {
					$('#alert_action').fadeIn().html('<div class="alert alert-danger">'+data+'</div>');
					userdataTable.ajax.reload();
				}
			})
		}else {
			return false;
		}
	});
});
</script>

<?php
include('footer.php');
?>
				