<?php
//link.php

include('database_connection.php');
include 'function.php';

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
                        <h3 class="panel-title">Services List</h3>
                    </div>
                    <?php if ($_SESSION['type'] == 'admin') { ?>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6" align="right">
                            <button type="button" name="add" id="add_button" data-toggle="modal"
                                    data-target="#linkModal" class="btn btn-success">ADD
                            </button>
                        </div>
                    <?php } ?>
                    <div style="clear:both"></div>
                </div>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 table-responsive">
                        <table id="link_data" class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Service Name</th>
                                <th>Visit Here</th>
                                <?php if ($_SESSION['type'] == 'admin') { ?>
                                    <th>Access Roles</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                <?php } ?>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="linkModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="link_form">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus"></i> Add link</h4>
            </div>
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group">
                        <label>link Name</label>
                        <input type="text" name="link_name" id="link_name" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label>link </label>
                        <input type="text" name="link" id="link" class="form-control" required/>
                    </div>
                    <div class="form-group">
                        <label>Access Roles </label>
                        <select name="link_access[]" id="choices-multiple-remove-button" class="form-control" placeholder="Select Access Roles" multiple>
<!--                            --><?php //echo fill_user_type_list($connect); ?>
                            <option value="admin">Admin</option>
                            <option value="hr">HR</option>
                            <option value="it">IT</option>
                            <option value="dev">DEV</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="link_id" id="link_id"/>
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

        var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            maxItemCount:5,
            searchResultLimit:5,
            renderChoiceLimit:5
        });

        $('#add_button').click(function () {
            $('#link_form')[0].reset();
            $('.modal-title').html("<i class='fa fa-plus'></i> Add link");
            $('#action').val('ADD');
            $('#btn_action').val('ADD');
        });

        $(document).on('submit', '#link_form', function (event) {
            event.preventDefault();
            $('#action').attr('disabled', 'disabled');
            var form_data = $(this).serialize();
            $.ajax({
                url: "link_action.php",
                method: "POST",
                data: form_data,
                success: function (data) {
                    $('#link_form')[0].reset();
                    $('#linkModal').modal('hide');
                    $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                    $('#action').attr('disabled', false);
                    linkdataTable.ajax.reload();
                }
            })
        });

        $(document).on('click', '.update', function () {
            var link_id = $(this).attr("id");
            var btn_action = 'fetch_single';
            $.ajax({
                url: "link_action.php",
                method: "POST",
                data: {link_id: link_id, btn_action: btn_action},
                dataType: "json",
                success: function (data) {
                    $('#linkModal').modal('show');
                    $('#link_name').val(data.link_name);
                    $('#link').val(data.link);
                    $('.modal-title').html("<i class='fa fa-pencil-square-o'></i> Edit link");
                    $('#link_id').val(link_id);
                    $('#action').val('EDIT');
                    $('#btn_action').val("EDIT");
                }
            })
        });

        var linkdataTable = $('#link_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "link_fetch.php",
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
            var link_id = $(this).attr('id');
            var status = $(this).data("status");
            var btn_action = 'delete';
            if (confirm("Are you sure you want to delete?")) {
                $.ajax({
                    url: "link_action.php",
                    method: "POST",
                    data: {link_id: link_id, status: status, btn_action: btn_action},
                    success: function (data) {
                        $('#alert_action').fadeIn().html('<div class="alert alert-danger">' + data + '</div>');
                        linkdataTable.ajax.reload();
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
				