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
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-6">
                        <div class="row">
                            <h3 class="panel-title">Session List</h3>
                        </div>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div class="panel-body">
                    <div class="row">
                    	<div class="col-sm-12 table-responsive">
                            <table id="session_data" class="table">
                                <thead><tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>In time</th>
                                    <th>Out Time time</th>
                                    <th>Delete</th>
                                </tr></thead>
                            </table>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script>	
$(document).ready(function(){
	var sessiondataTable = $('#session_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"session_fetch.php",
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
		var id = $(this).attr('id');
		var btn_action = 'delete';
		if(confirm("Are you sure you want to change status?")) {
			$.ajax({
				url:"session_action.php",
				method:"POST",
				data:{id:id, btn_action:btn_action},
				success:function(data) {
					$('#alert_action').fadeIn().html('<div class="alert alert-danger">'+data+'</div>');
					sessiondataTable.ajax.reload();
				}
			})
		}else {
			return false;
		}
	});

//     var minDate, maxDate;
//
// // Custom filtering function which will search data in column four between two values
//     $.fn.dataTable.ext.search.push(
//         function( settings, data, dataIndex ) {
//             var min = minDate.val();
//             var max = maxDate.val();
//             var date = new Date( data[4] );
//
//             if (
//                 ( min === null && max === null ) ||
//                 ( min === null && date <= max ) ||
//                 ( min <= date   && max === null ) ||
//                 ( min <= date   && date <= max )
//             ) {
//                 return true;
//             }
//             return false;
//         }
//     );

    // // Create date inputs
    // minDate = new DateTime($('#min'), {
    //     format: 'MMMM Do YYYY'
    // });
    // maxDate = new DateTime($('#max'), {
    //     format: 'MMMM Do YYYY'
    // });
    //
    // // DataTables initialisation
    // var table = $('#example').DataTable();
    //
    // // Refilter the table
    // $('#min, #max').on('change', function () {
    //     table.draw();
    // });
});
</script>

<?php
include('footer.php');
?>
				