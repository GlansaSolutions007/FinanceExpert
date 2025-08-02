<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content') ?>
<h1>GST Report</h1>
<div class="row m-3">
    <div class="container p-5 bg-white borderd col-sm-12 shadow rounded">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <style>
                        .select2-container .select2-selection--single {
                            height: 34px !important;
                        }

                        .select2-container--default .select2-selection--single {
                            border: 1px solid #ccc !important;
                            border-radius: 0px !important;
                        }
                    </style>
                    <div class="m-2">
                        <label class="h6">From Date</label>
                        <input type="date" class="form-control" name="fromDate" id="fromDate">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="m-2">
                        <label class="h6">To Date</label>
                        <input type="date" class="form-control" name="toDate" id="toDate">
                    </div>
                </div>
                <div class="m-2 d-flex justify-content-center">
                    <button class="btn btn-primary" id="view-button">Submit</button>
                    <button class="btn btn-success" id="export-button" onclick="validateFormAndProceed('export')">Export</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .date {
        width: 50px;
    }

    .date1 {
        width: 70px;
    }
</style>

<div class="x_content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Invoice No</th>
                            <th>Agent Id</th>
                            <th>Agent Name</th>
                            <th>CGST</th>
                            <th>SGST</th>
                            <th>IGST</th>
                            <th>TDS</th>
                            <th>GST Number</th>
                        </tr>
                    </thead>
                    <tbody id="datatable-tbody">
                        
                    </tbody>
                </table>
                <div id="summary-section" class="bg-light p-3 border">
                    <div>
                        <strong class="custom-font-size">Total TDS:&#8377;</strong> <span class="custom-font-size" id="total-tds">0.00</span>
                    </div>
                    <div>
                        <strong class="custom-font-size">Total GST(CGST + SGST):&#8377;</strong> <span class="custom-font-size" id="total-gst">0.00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // $(document).ready(function(){
    //     new DataTable('#datatable');
    // });
   
</script>
<script>
function validateFormAndProceed(action) {
    // Get the values of the required fields
    var fromDate = document.getElementById('fromDate').value;
    var toDate = document.getElementById('toDate').value;
    // var agentId = document.getElementById('agent_name').value;

    // Additional validation logic if needed

    // Check if the required fields are filled
    if (fromDate && toDate) {
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
    // Initialize DataTable
    var dataTable = $('#datatable').DataTable();

    $('#view-button').on('click', function (e) {
        e.preventDefault();
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();
        compareDate(fromDate, toDate);
    });

    function compareDate(fromDate, toDate) {
        
        if (fromDate > toDate) {
                Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'ToDate cannot be earlier than FromDate.',
                
            });
            document.getElementById('toDate').value = '';
            return;
                // You can choose to prevent the form submission or take other actions.
            } else {
                // Proceed with your form submission or other actions.
                // Example: document.getElementById('yourFormId').submit();
            }
        $.ajax({
            url: '<?= base_url('gstController/comparedates') ?>',
            method: 'POST',
            data: { fromDate: fromDate, toDate: toDate },
            dataType: 'json',
            success: function (response) {
                updateTable(response);
            },
            error: function (xhr, status, error) {
                console.error("Error occurred during AJAX request:", error);
                console.log("Response from server:", xhr.responseText);
            }
        });
    }

    function updateTable(data) {
    var table = $('#datatable').DataTable();
    table.clear().draw(); // Clear existing content

    var totalTDS = 0;
    var totalCGST = 0;
    var totalSGST = 0;

    if (data.rows.length > 0) {
        $.each(data.rows, function (index, reports) {
            var rowData = [
                (index + 1),
                reports.invoice_no,
                reports.agent_id,
                reports.agentName,
                reports.cgst,
                reports.sgst,
                reports.igst,
                reports.tds,
                reports.gst_no
            ];

            table.row.add(rowData).draw();

            // Update totals
            totalTDS += parseFloat(reports.tds);
            totalCGST += parseFloat(reports.cgst) || 0; // Make sure it's a number, default to 0 if NaN
            totalSGST += parseFloat(reports.sgst) || 0;
        });

        // Display totals
        $('#total-tds').text(totalTDS.toFixed(2));
        $('#total-gst').text((totalCGST + totalSGST).toFixed(2));
    } else {
        var newRow = $('<tr>').html('<td colspan="9">No data available.</td>');
        $('#datatable tbody').append(newRow);
    }
}


    $('#export-button').on('click', function (e) {
        e.preventDefault();
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();
        window.location.href = '<?= base_url('gstController/exportToExcel') ?>?fromDate=' + fromDate + '&toDate=' + toDate;
    });
});

</script>


<?= $this->endSection() ?>
