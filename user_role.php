<?php
//user_role.php

include('database_connection.php');
include "function.php";

if (!isset($_SESSION['type'])) {
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
                        <h3 class="panel-title">User Role List</h3>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align="right">
                        <button type="button" name="add" id="add_button" data-toggle="modal" data-target="#UserRoleModal"
                                class="btn btn-success">ADD
                        </button>
                    </div>
                </div>


                <div style="clear:both"></div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="user_role_data" class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Role Name</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="UserRoleModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="user_role_form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Add User Role</h4>
            </div>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Role Name</label>
                        <input type="text" name="ur_name" id="ur_name" class="form-control" required/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="modal-footer">
                        <input type="hidden" name="ur_id" id="ur_id"/>
                        <input type="hidden" name="btn_action" id="btn_action"/>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                        <input type="submit" name="action" id="action" class="btn btn-submit"/>
                    </div>
                </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {

        $('#add_button').click(function () {
            $('#user_role_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Add User Role");
            $('#action').val('ADD');
            $('#btn_action').val('ADD');
        });

        $(document).on('submit', '#user_role_form', function (event) {
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "user_role_action.php",
                method: "POST",
                data: form_data,
                success: function (data) {
                    $('#user_role_form')[0].reset();
                    $('#UserRoleModal').modal('hide');
                    $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                    $('#action').attr('disabled', false);
                    userroledataTable.ajax.reload();
                }
            })
        });

        $(document).on('click', '.update', function () {
            var ur_id = $(this).attr("id");
            var btn_action = 'fetch_single';
            $.ajax({
                url: "user_role_action.php",
                method: "POST",
                data: {ur_id: ur_id, btn_action: btn_action},
                dataType: "json",
                success: function (data) {
                    $('#UserRoleModal').modal('show');
                    $('#ur_name').val(data.ur_name);
                    $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit User Role");
                    $('#ur_id').val(ur_id);
                    $('#action').val('EDIT');
                    $('#btn_action').val("EDIT");
                }
            })
        });

        var userroledataTable = $('#user_role_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "user_role_fetch.php",
                type: "POST"
            },
            "columnDefs": [
                {
                    // "targets":[1],
                    "orderable": false,
                },
            ],
            "pageLength": 25
        });

        $(document).on('click', '.delete', function () {
            var ur_id = $(this).attr('id');
            var btn_action = 'delete';
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: "user_role_action.php",
                    method: "POST",
                    data: {ur_id: ur_id, btn_action: btn_action},
                    success: function (data) {
                        $('#alert_action').fadeIn().html('<div class="alert alert-danger">' + data + '</div>');
                        userroledataTable.ajax.reload();
                    }
                })
            } else {
                return false;
            }
        });
    });
</script>

<?php
include('footer.php');
?>
				