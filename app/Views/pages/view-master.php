<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content') ?>
<h1>View Master Sheet</h1>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form class="form-label-left input_mask">
                    <div class="field item form-group col-md-10">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Select Master Bank<span class="text-danger">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select id="heard" class="form-control dropdown select2" name="bankname" required>
                                <option value="">Choose..</option>
                               
                                        <?php if ($banks){ ?>
                                            <?php foreach ($banks as $bank) { ?>
                                                <option value="<?= $bank['name'] ?>"><?= $bank['name'] ?></option>
                                          <?php
                                          } 
                                         } ?>
                                    </select>
                            
                        </div>
                    </div>
                    <script>
                        .dropdown{
                              width: 50%;
                              clear: both;
                            }
                    </script>
                    <div class="field item form-group col-md-10">
                        <label class="col-form-label col-md-3 col-sm-3 justify-content-center label-align">Select Month Span<span class="text-danger">*</span></label>
                        <div class="col-md-3">
                            <label class="col-form-label col-md-6 col-sm-6 ">From Date<span class="required">*</span></label>
                            
                            <div class="field item form-group col-md-10">
    
                                <div class="col-md-4">
                                    <input class="form-control date date-input" type="text"  id="day1" name="day"  min="1" max="31" required>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control date date-input" type="text"  id="month1" name="month"  min="1" max="12" required>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control date1 date-input" type="text"  id="year1" name="year"  min="1900" max="2100" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                             <label class="col-form-label col-md-6 col-sm-6 ">To Date<span class="text-danger">*</span></label>
                            
                            <div class="field item form-group col-md-10">
    
                                <div class="col-md-4">
                                    <input class="form-control date date-input" type="text"  id="day2" name="day" min="1" max="31" required>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control date date-input" type="text"  id="month2" name="month"  min="1" max="12" required>
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control date1 date-input" type="text" id="year2" name="year"  min="1900" max="2100" required>
                                </div>
                                
                            </div>
                        </div>
                        </div>
                    </div>
                     <div id="dateError" class="text-danger"></div>
                    <style>
                        .date
                        {
                            width:50px;
                        }
                        .date1
                        {
                            width:70px;
                        }
                    </style>
                    <div class="field item form-group text-center col-md-10">
                        <button class="btn btn-primary" id="view-button">View</button>
                         <button type="reset" class="btn btn-info" onclick="resetForm()">Reset</button>
                    </div>
                </form>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                           <div class="card-box table-responsive" id="table">
                               
                                 <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sno.</th>
                                            <th hidden></th>
                                            <th>LOS Number</th>
                                            <th>Bank Name</th>
                                            <th>Disbursal Date</th>
                                            <th>Customer Name</th>
                                            <th>Executive</th>
                                             <th hidden></th>
                                            <th>Actions</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody class="tbody">
                                       
                                    </tbody>
                                </table>
                                <h3 id="noDataMessage" style="display: none;"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="assignModal" data-id="'+ row.id +'" tabindex="-1" aria-labelledby="asignModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Agents</h5>
        <button type="button" class="btn btn-close" data-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
          
          <div class="d-flex mt-2 ">
             <label class="col-form-label col-md-3 col-sm-3 label-align">Select Agent Name<span class="required">*</span></label>
            <select name="assignagentid" id="agentname_select"  class="form-control select2">
            <option value="">Choose..</option>
             <?php if ($agents) { ?>
                        <?php foreach ($agents as $agent) { ?>
                            <option value="<?= $agent['user_id'] ?>"><?= $agent['user_id'] ?></option>
                        <?php } ?>
                    <?php } ?>
        </select>
            
        </div>
        
        <div class="d-flex mt-2 ">
             <label class="col-form-label col-md-3 col-sm-3 label-align">Name<span class="required">*</span></label>
            <input type="text" name="agentname" id="agentname" readonly class="form-control" value="">
            <input type="hidden" name="rowId" id="rowId" value="">
            
        </div>
        <div class="d-flex mt-2 ">
             <label class="col-form-label col-md-3 col-sm-3 label-align">Mobile No<span class="required">*</span></label>
            <input type="text" name="mobile" id="mobile" class="form-control" value="">
            
        </div>
        <div class="d-flex mt-2 ">
                       <label class="col-form-label col-md-3 col-sm-3 label-align">Email<span class="required">*</span></label>
            <input type="text" name="email" id="email" class="form-control" value="">
        </div>
        <div class="mt-2">
                       <label class="col-form-label col-md-3 col-sm-3 label-align">Address<span class="required">*</span></label>
            <div><textarea type="text" name="address" id="address" class="form-control"></textarea></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="Assign_click">Assign</button>
      </div>
    </div>
  </div>
 </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <form class="" action="<?php echo base_url().'ExcelController/updateExecutive'?>" method="POST">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="rowId" id="rowId" class="rowId" value="">
                    <div class="d-flex mt-2 ">
                         <label class="col-form-label col-md-3 col-sm-3 label-align">Bank Name<span class="required">*</span></label>
                        <input type="text" name="editbankname" id="editbankname" class="form-control" value="">
                    </div>
                    
                    <div class="d-flex mt-2 ">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Disbursaldate<span class="required">*</span></label>
                        <input type="text" name="editdisbursaldate" id="editdisbursaldate" class="form-control" value="">
                    </div>
                    
                   <div class="d-flex mt-2 ">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Customer Name<span class="required">*</span></label>
                        <input type="text" name="editcustomername" id="editcustomername" class="form-control" value="">
                    </div>
                    
                     <div class="d-flex mt-2 ">
                         <label class="col-form-label col-md-3 col-sm-3 label-align">Executive<span class="required">*</span></label>
                          <select id="editexecutive" name="editexecutive" class="form-control select2" required>
                                <option value="">Choose Agent Name</option>
                                    <?php foreach ($agents as $agent) { ?>
                                        <option value="<?= $agent['user_id'] ?>" data-executive="<?= $agent['name'] ?>">
                                         <?= $agent['name'] ?>
                                    </option>
                                     <?php } ?>
                            </select>
                        </div>
                    </div>
                    
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary updateAgentButton" id="updateBtn">Update</button>
            </div>
        </div>
    </div>
 </form>
</div>


<!-- ... Your existing HTML code ... -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->

<script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>   
 <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Add event listener to date input fields
   $('.date-input').on('input', function () {
        // Get the values of the From Date and To Date inputs
        const fromDate = new Date($('#year1').val(), $('#month1').val() - 1, $('#day1').val());
        const toDate = new Date($('#year2').val(), $('#month2').val() - 1, $('#day2').val());

        // Check if To Date is less than From Date
        if (fromDate > toDate) {
            // Show an error in the specified div
            $('#dateError').html('To Date must be greater than or equal to From Date');
        } else {
            // Remove the error message
            $('#dateError').html('');
        }
    });
</script>
 <script>
    function resetForm() {
        var form = document.getElementById("myForm");
        form.reset();

        // Destroy and reinitialize DataTable
        var dataTable = $('#datatable').DataTable();
        dataTable.destroy();
        dataTable = $('#datatable').DataTable({
            // your DataTable initialization options here
        });
    }
</script>

<script>
    
    $(document).ready(function() {
    $("#dropdown").select2({
        placeholder: 'Search for an agent...', 
        allowClear: true, 
        width: '100%',
    });
});

</script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script>
    // $(document).ready(function(){
    //     new DataTable('#datatable');
    // });

</script>

<!--Assigning agent script start-->
<script>
    $(document).ready(function() {
    $('#heard').change(function() {
        var selectedBankName = $(this).val();
        $.ajax({
            url: '<?= base_url('ExcelController/getBankData') ?>',
            method: 'POST',
            data: { bankname: selectedBankName },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var agentData = response.data;

                    // Extract the day, month, and year from the fetched date
                    var fromDate = new Date(agentData.from_date);
                    var toDate = new Date(fromDate);
                    toDate.setMonth(toDate.getMonth() + 1);

                    // Populate the "From Date" fields
                    $('#day1').val(fromDate.getDate());
                    $('#month1').val(fromDate.getMonth() + 1);
                    $('#year1').val(fromDate.getFullYear());

                    // Populate the "To Date" fields
                    // Calculate the last day of the month for the "To Date"
                    var lastDayOfMonth = new Date(fromDate.getFullYear(), fromDate.getMonth() + 1, 0);
                    $('#day2').val(lastDayOfMonth.getDate());
                    $('#month2').val(toDate.getMonth() + 1);
                    $('#year2').val(toDate.getFullYear());
                } else {
                    // Clear the "From Date" fields
                    $('#day1').val('');
                    $('#month1').val('');
                    $('#year1').val('');

                    // Clear the "To Date" fields
                    $('#day2').val('');
                    $('#month2').val('');
                    $('#year2').val('');
                }
            },
            error: function(xhr, status, error) {
                // Handle error if needed
                console.error("Error occurred during AJAX request:", error);
            }
        });
    });
});
</script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--<script src="path/to/jquery.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>-->

<script>

$(document).ready(function() {
        $('#view-button').on('click', function(e) {
            e.preventDefault();
            
            var fromDate = $('#year1').val() + '-' + $('#month1').val() + '-' + $('#day1').val();
            var toDate = $('#year2').val() + '-' + $('#month2').val() + '-' + $('#day2').val();
            var selectedBank = $('#heard').val();

            compareDates(selectedBank, fromDate, toDate);
        });

        function compareDates(selectedBank, fromDate, toDate) {
            $.ajax({
                url: '<?= base_url('ExcelController/comparedates') ?>', // Replace with the correct URL for data retrieval on the server side
                method: 'POST',
                data: { bankname: selectedBank, fromdate: fromDate, todate: toDate },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    // On success, update the table with the fetched data
                    updateTable(response);
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                    console.error("Error occurred during AJAX request:", error);
                }
            });
          }

function updateTable(data) {
    var tableBody = $('#datatable tbody');
    var dataTable = $('#datatable').DataTable();

    // Destroy the DataTable
    dataTable.destroy();

    // Clear the table
    tableBody.empty();

    var userRole = <?php echo json_encode(session('role')); ?>;

    if (data.length > 0) {
        $.each(data, function(index, row) {
            var newRow = $('<tr>');
            newRow.append('<td>' + (index + 1) + '</td>');
            newRow.append('<td hidden>' + row.id + '</td>');
            newRow.append('<td>' + row.AgreementNo + '</td>');
            newRow.append('<td>' + row.Bank + '</td>');
            newRow.append('<td>' + row.DisbursalDate + '</td>');
            newRow.append('<td>' + row.CustomerName + '</td>');
            newRow.append('<td id="exec' + row.id + '">' + row.Executive + '</td>'); // Display assigned agent
            newRow.append('<td style="display:none;">' + row.id + '</td>');

            var actionButtons = ''; // Initialize an empty string for action buttons

if (userRole === '1') {
    // Show both "Edit" and "Add" buttons for super admin
    if (row.Executive) {
        // If an executive is assigned, show "Edit" button enabled and "Add" button disabled
        actionButtons = '<td id="btn' + row.id + '">' +
            '<button class="btn btn-success editbutton" data-toggle="modal" value="' + row.id + '" id="edit_agent_id" data-target="editModal" data-id="' + row.id + '">Edit</button>' +
            // '<button class="btn btn-success addButton" data-toggle="modal" value="' + row.id + '" id="agent_id" data-target="assignModal" data-id="' + row.id + '" disabled>Add</button>' +
            '</td>';
    } else {
        // If no executive is assigned, show both "Edit" and "Add" buttons enabled
        actionButtons = '<td id="btn1' + row.id + '">' +
            // '<button class="btn btn-success editbutton" data-toggle="modal" value="' + row.id + '" id="edit_agent_id" data-target="editModal" data-id="' + row.id + '">Edit</button>' +
            '<button class="btn btn-primary addButton" data-toggle="modal" value="' + row.id + '" id="agent_id" data-target="assignModal" data-id="' + row.id + '">Add</button>' +
            '</td>';
    }
} else {
    // For other user roles, show only the "Add" button
    if (row.Executive) {
        // If an executive is assigned, disable the "Add" button
        actionButtons = '<td id="btn' + row.id + '">' +
            '<button class="btn btn-success addButton" data-toggle="modal" value="' + row.id + '" id="agent_id" data-target="assignModal" data-id="' + row.id + '" disabled>Edit</button>' +
            '</td>';
    } else {
        // If no executive is assigned, enable the "Add" button
        actionButtons = '<td id="btn1' + row.id + '">' +
            '<button class="btn btn-primary addButton" data-toggle="modal" value="' + row.id + '" id="agent_id" data-target="assignModal" data-id="' + row.id + '">Add</button>' +
            '</td>';
    }
}


            newRow.append(actionButtons);

            tableBody.append(newRow);
        });
    } 
    $('#datatable').DataTable();
}





});
    
    $('body').on('click', '#edit_agent_id', function() {
            //  var id = $(this).data('agent_id');
             var ids = $(this).attr('value');
            //  console.log(ids);
            $('#editModal input[name="rowId"]').val(ids);
            $('#editModal').modal('show');
            
        });
    
    

 $('body').on('click', '#agent_id', function() {
            //  var id = $(this).data('agent_id');
             var ids = $(this).attr('value');
            //  console.log(ids);
            $('#assignModal input[name="rowId"]').val(ids);
            $('#assignModal').modal('show');
            
        });
    // });

$(document).ready(function() {

    $('#Assign_click').on('click', function (e) {
        e.preventDefault();
        var yourDataArray = [];
        var agentId = $('#agentname_select').val();
        var rowId = $('#rowId').val();
        var agentName = $('#agentname').val(); // Assuming you have the agent's name available
        //  var agentEmail = $('#email').val();
        // Assuming you have an array named yourDataArray that holds the table data
        for (var i = 0; i < yourDataArray.length; i++) {
            if (yourDataArray[i].id === rowId) {
                yourDataArray[i].Executive = agentName; // Update the 'Executive' property
                break; // Assuming each ID is unique
            }
        }
        
        if(agentId != ""){
            $.ajax({
            url: '<?= base_url('ExcelController/assignagent') ?>',
            method: 'POST',
            data: { agent_id: agentId, row_id: rowId },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                // updateTable(response.data);
                // yourDataArray = response.data; // Assuming response.data holds your table data
                // updateTable(yourDataArray);
                if (response.success) {
                    // alert(response.message);
                            // Show success SweetAlert
                            Swal.fire({
                                icon: 'success',
                                title: 'Agent Assigned Successfully',
                                // text: response.message
                            });
                    $('#assignModal').modal('hide');
                    $('#assignModal').on('hidden.bs.modal', function () {
                    // Clear input fields, reset form, or perform any other necessary actions
                    $('#agentname_select').val('');
                    $('#agentname').val('');
                        $('#email').val('');
                        $('#mobile').val('');
                        $('#address').val('');
                });
                    
                    var newRowData = response.data;
                    console.log(newRowData);
                    var rowToUpdate = $('.tbody tr[data-id="' + newRowData.id + '"]');
                    $('#exec'+newRowData.id).text(newRowData.Executive);
                    $('#btn1'+ newRowData.id).text="Edit";
                    $('#btn2' + newRowData.id).text="Add";
                    console.log('#exec'+newRowData.id);
                        
                    if (newRowData.Executive) {
                    // If an agent is assigned, remove the "Add" button
                    $('#btn2' + newRowData.id).remove();
                    // Add the "Edit" button
                    $('#btn1' + newRowData.id).html('<button class="btn btn-success editbutton" data-toggle="modal" value="' + newRowData.id + '" data-target="editModal" data-id="' + newRowData.id + '">Edit</button>');
                } else {
                    // If an agent is not assigned, remove the "Edit" button
                    $('#btn2' + newRowData.id).remove();
                    // Add the "Add" button
                    $('#btn1' + newRowData.id).html('<button class="btn btn-primary addButton" data-toggle="modal" value="' + newRowData.id + '" data-target="assignModal" data-id="' + newRowData.id + '">Add</button>');
                }




                    // Sending an email to the agent if needed
                    // sendEmailToAgent(newRowData.email); // Uncomment if you have a function to send email
                } else {
                    // alert('Failed to assign agent: ' + response.error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        // text: response.message
                    });
                }
            },
            error: function (xhr, status, error) {
                // console.error('AJAX request failed:', error);
                // alert('An error occurred: ' + error + '. Please try again later.');
                Swal.fire({
            icon: 'error',
            title: 'AJAX Error',
            text: 'Failed to assign agent. Check the console for details.'
        });
            },
            complete: function () {
                // Hide loading indicator here if needed
            }
        });
        }else{
            alert("Please select a agent");
        }

        
    });
});

</script>


<!--Assigning agent script end-->



    <script>
    $(document).ready(function () {
    $('#agentname_select').change(function () {
        //  var id = $(this).data('id');
        // e.preventDefault();

        var selectedAgentName = $(this).val();
        //  alert(selectedAgentName);
        // if (selectedAgentName !== '') {
            $.ajax({
                url: '<?= base_url('ExcelController/getAgentData') ?>',
                method: 'POST',
                data: { agentname: selectedAgentName },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        var agentData = response.data;
                        $('#agentname').val(agentData.name);
                        $('#email').val(agentData.email);
                        $('#mobile').val(agentData.phone_no);
                        $('#address').val(agentData.address);
                        
                        
                    } else {
                        
                        $('#agentname').val('');
                        $('#email').val('');
                        $('#mobile').val('');
                        $('#address').val('');
                    }
                }
            });
        // }
    });

    // ... Your other script code ...
});
        
   
</script>



<script>

    $(document).ready(function() {
        // ... Your other JavaScript code ...
        

        // Add an event listener for the "Edit" button
        $('body').on('click', '.editbutton', function() {
            var rowId = $(this).closest('tr').find('td:eq(7)').text(); // Get the ID from the hidden column (index 7)

            // Make an AJAX request to fetch data for the clicked row
            $.ajax({
                url: '<?= base_url('ExcelController/getdatabyid/') ?>' + rowId,
                method: 'GET',
                data: { id: rowId },
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    if (response) {
                        // Populate the modal with the fetched data
                        $('#edit_id').val(response.id);        
                        $('#editbankname').val(response.Bank);
                        $('#editdisbursaldate').val(response.DisbursalDate);
                        $('#editcustomername').val(response.CustomerName);
                        $('#editexecutive').val(response.Executive);
                        // Show the modal
                        $('#editModal').modal('show');
                    } else {
                        // Show an error message if data fetching failed
                        alert('Failed to fetch data for editing. Please try again.');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                    console.error("Error occurred during AJAX request:", error);
                }
            });
        });
      
    });   
</script>
<script>
   $(document).ready(function() {
    $('#updateBtn').on('click', function(e) {
        e.preventDefault();    
        var selectedAgent = $('#editexecutive').val();
        var rowId = $('.rowId').val();
        console.log(rowId); 
        console.log("Selected agent:", selectedAgent);
        console.log("Row ID:", rowId);
        $.ajax({
            url: "<?= base_url('ExcelController/updateExecutive'); ?>",
            method: "POST",
            data: { editexecutive: selectedAgent, rowId: rowId },
            dataType: "json",
            success: function(response) {
                console.log("AJAX response:", response);
                //  $('#editModal').modal('hide');
                if (response.success) {
                    console.log("Hi");
                    $('#editModal').modal('hide');
                    // $('#exec' + )
                    // console.log("Agent name updated successfully.");
                     Swal.fire({
                        icon: 'success',
                        title: 'Agent name updated successfully',
                        // text: 'Email sent at path: ' + response.pdf_path,
                    });
                    // var executiveCell;
                     $('#exec' + rowId).text(selectedAgent);
                    // executiveCell.text(selectedAgent); 
                    
                } else {
                    // console.log("Agent name update failed.");
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Agent name update failed.',
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log("AJAX error:", error);
            }
        });
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
<?php if(session()->has('status')): ?>
    <script>
    $(document).ready(function() {
        <?php if(session('status') === 'success'): ?>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?php echo session('message'); ?>'
            });
        <?php elseif(session('status') === 'error'): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?php echo session('message'); ?>'
            });
        <?php endif; ?>
    });
    </script>
<?php endif; ?>
<?= $this->endSection() ?>
