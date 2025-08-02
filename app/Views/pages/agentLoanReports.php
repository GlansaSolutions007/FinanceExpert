<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content') ?>
<h3>Agent Loan Reports</h3>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_content">
                <br />
               
                
                <form class="form-label-left input_mask">
                   
                    <div class="d-flex col-md-12">
                        <div class="field item form-group col-md-6">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Select Agent Id<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <select id="agent" onchange="getAgentName()" class="form-control" name="agent_id" required>
                            <option value="">Choose..</option>
                            
                            <?php if ($emis) { ?>
                                    <?php foreach ($emis as $emi) { ?>
                                        <option value="<?= $emi['agent_id'] ?>"><?= $emi['agent_id'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                        </select>
                        </div>
                    </div>
                    <div class="field item form-group col-md-6">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Agent Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" id="agent_name">
                        </div>
                    </div>
                    </div>
                    
                    <div class="d-flex col-md-12">
                        <div class="field item form-group col-md-6">
                            
                        <label class="col-form-label col-md-3 col-sm-3 label-align">From Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <input type="date" class="form-control" id="fromdate">
                        </div>
                    </div>
                    
                    
                    <div class="field item form-group col-md-6">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">To Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="date" class="form-control" id="todate">
                        </div>
                    </div>
                    </div>
                    
                    <div class="field item form-group text-center col-md-10 d-flex">
                        <button class="btn btn-primary" id="view-button">View</button>
                        <button class="btn btn-success" id="export-button" onclick="validateFormAndProceed('export')">Export</button>
                    </div>
                </form>
                 <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sno.</th>
                                            <!--<th hidden></th>-->
                                            <th>Agent Id</th>
                                            <th>Agent Name</th>
                                            <th>Loan Amount</th>
                                            <th>Duration in Month</th>
                                            <th>Monthly Emi</th>
                                            <th>Remaining Debt Amount</th>
                                            <th>Date</th>
                                            <th>Voucher Number</th>
                                            <th hidden></th>
                                        </tr>
                                    </thead>
                                    <tbody id="datatable tbody">
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
<!--Edit Modal-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->

<script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>   
 <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
 
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // When the agent ID dropdown changes, fetch the agent name and update the text box
    function getAgentName() {
    var selectedAgentID = document.getElementById('agent').value;
    if (selectedAgentID !== '') {
        // Make an AJAX call to the server to retrieve the agent name
        $.ajax({
            type: 'POST',
            url: '<?= base_url("agentwisecontroller/getAgentName"); ?>',
            data: { selectedAgentID: selectedAgentID },
            dataType: 'json', // 'datatype' should be 'dataType'
            success: function (response) {
                console.log(response.agentName);
                document.getElementById("agent_name").value = response.agentName;
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    } else {
        document.getElementById("agent_name").value = '';
    }
}

</script>

 <script>
function validateFormAndProceed(action) {
    // Get the values of the required fields
    var fromDate = document.getElementById('fromdate').value;
    var toDate = document.getElementById('todate').value;
    var agentId = document.getElementById('agent_name').value;

    // Additional validation logic if needed

    // Check if the required fields are filled
    if (fromDate && toDate && agentId) {
        // Fields are filled, proceed with the action
        if (action === 'view') {
            // Perform the "View" action
            console.log('View action');
        } else if (action === 'export') {
            // Perform the "Export" action
            console.log('Export action');
        }
    } else {
        // Show an error message or handle the absence of required fields
        // alert('Please fill in all required fields before proceeding.');
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please fill in all required fields before proceeding.',
        });
    }
}
</script>
<script>

$(document).ready(function () {
    // new DataTable('#datatable');
 $('#export-button').on('click', function(e) {
    e.preventDefault();
    var agentId = $('#agent').val();
    var fromDate = $('#fromdate').val();
    var toDate = $('#todate').val();
    if(agentId === ''){
        alert("Please select agent id");
    }else if(fromDate ==='' || toDate === ''){
        // alert("Please select from date and to date");
    }else{
    window.location.href = '<?= base_url('agentwisecontroller/exportToExcel') ?>?fromDate=' + fromDate + '&toDate=' + toDate + '&agentId=' + agentId;
    }
    // window.location.href = '<?= base_url('agentwisecontroller/exportToExcel') ?>?fromDate=' + fromDate + '&toDate=' + toDate + '&agentId=' + agentId;
  });
});

</script>



<script>
    
    $(document).ready(function() {
        $('#view-button').on('click', function(e) {
            e.preventDefault();
            
            var agentId = $('#agent').val();
            var fromDate = $('#fromdate').val();
            var toDate = $('#todate').val();
            
            
            if (fromDate > toDate) {
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'ToDate cannot be earlier than FromDate.',
                
            });
            document.getElementById('todate').value = '';
            return;
                // You can choose to prevent the form submission or take other actions.
            } else {
                // Proceed with your form submission or other actions.
                // Example: document.getElementById('yourFormId').submit();
            }
            
        $.ajax({
                url: "getAgentLoanData", // Replace with the actual URL
                type: "POST",
                data: {  agentId: agentId, fromDate:fromDate, toDate:toDate },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    // Update the table with the fetched data
                    updateTable(data);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data: " + error);
                }
            });
            
        });
        
        
    function updateTable(data) {
   var tableBody = $('#datatable tbody');
    var dataTable = $('#datatable').DataTable();

    // Destroy the DataTable
    dataTable.destroy();

    // Clear the table
    tableBody.empty();

    if (data.length > 0) {
        $.each(data, function(index, row) {
            if (row.loanAmount !== row.remainingDebtAmount) {
                var newRow = $('<tr>');
                // Use 'index + 1' for the first column (serial number)
                newRow.append('<td>' + (index + 1) + '</td>');
                newRow.append('<td>' + row.agent_id + '</td>');
                newRow.append('<td>' + row.agentName + '</td>');
                newRow.append('<td>' + row.loanAmount + '</td>');
                newRow.append('<td>' + row.month + '</td>');
                newRow.append('<td>' + row.monthlyEmi + '</td>');
                newRow.append('<td>' + row.remainingDebtAmount + '</td>');
                newRow.append('<td>' + row.date + '</td>');
                newRow.append('<td>' + row.voucher + '</td>');
                newRow.append('<td style="display:none;">' + row.id + '</td>');

                // Append the row to the table
                tableBody.append(newRow);
            }
        });
    }  $('#datatable').DataTable();
}


    
});


</script>


<?= $this->endSection() ?>