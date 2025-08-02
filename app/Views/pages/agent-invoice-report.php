<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content') ?>
<h3>Agent Invoice Report</h3>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form class="form-label-left input_mask">
                    <div class="field item form-group col-md-10">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Select Agent Id<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <select id="agent" onchange="getAgentName()" class="form-control" name="agent_id" required>
                            <option value="">Choose..</option>
                            
                            <?php if ($agents) { ?>
                                    <?php foreach ($agents as $agent) { ?>
                                        <option value="<?= $agent['user_id'] ?>"><?= $agent['user_id'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                        </select>

                            
                        </div>
                    </div>
                    <div class="field item form-group col-md-10">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Agent Name<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" id="agent_name">
                        </div>
                    </div>
                    
                   <div class="field item form-group col-md-10">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">From Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="date" class="form-control" id="fromdate">
                        </div>
                    </div>
                   
                    <div class="field item form-group col-md-10">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">To Date<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="date" class="form-control" id="todate">
                        </div>
                    </div>
                   
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
                        <button class="btn btn-success" id="export-button" onclick="validateFormAndProceed('export')">Export</button>
                                                
                        
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
                                            <th>Transaction ID</th>
                                            <th>Transaction Date</th>
                                            <th>Transaction Amount</th>
                                            <th>GST</th>
                                            <th>Voucher</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="datatable tbody">
                                       
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


<div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                
               
            </div>
            <div class="modal-body">
                <!-- Modal content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="downloadPdf()" id="downloadPdfBtn">Download</button>
            </div>
        </div>
    </div>
</div>
<style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-container {
            /*width: 50%;*/
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .invoice-header {
            text-align: center;
        }
        .invoice-header h1 {
            margin: 0;
        }
        .invoice-details {
            margin-top: 20px;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details th, .invoice-details td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
        
        
       
</style>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->

<script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>   
 <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
    // When the agent ID dropdown changes, fetch the agent name and update the text box
    function getAgentName() {
    var selectedAgentID = document.getElementById('agent').value;
    if (selectedAgentID !== '') {
        // Make an AJAX call to the server to retrieve the agent name
        $.ajax({
            type: 'GET',
            url: '<?= base_url("Miscontroller/getAgentName/"); ?>' + selectedAgentID,
            success: function (response) {
                console.log(response.name);
                document.getElementById("agent_name").value = response.name;
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
$(document).ready(function () {
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
        window.location.href = '<?= base_url('agentinvoice/exportToExcel') ?>?fromDate=' + fromDate + '&toDate=' + toDate + '&agentId=' + agentId;
    }
    
  });
});
</script>

<script>
    $(document).ready(function() {
    // When the "View" button is clicked
    $(document).on('click', '.generate_voucher', function (event) {
        event.preventDefault(event);
        // console.log("hi");
        const rowId = $(this).data('id');
        //  console.log('Row ID:', rowId); // Check if the correct ID is logged

        
        // Use AJAX to fetch data based on rowId
        $.ajax({
            type: 'POST',
            url: '<?= base_url("agentinvoice/getRowData/"); ?>' + rowId,
            dataType: 'json',
           data: $('form').serialize(), // Serialize the form data
            success: function(response) {
                // console.log(response);
                // Assuming response contains the necessary data
                populateModal(response);
            },
            error: function(xhr, status, error) {
                console.error("Error occurred during AJAX request:", error);
            }
        });
    });
    
// function convertNumberToWords(number) {
//     const units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
//     const teens = ['Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
//     const tens = ['', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
//     const thousands = ['', 'Thousand', 'Million', 'Billion'];

//     function convertChunk(number) {
//         if (number === 0) {
//             return '';
//         }

//         if (number < 10) {
//             return units[number];
//         }

//         if (number < 20) {
//             return teens[number - 11];
//         }

//         if (number < 100) {
//             return tens[Math.floor(number / 10)] + ' ' + convertChunk(number % 10);
//         }

//         return units[Math.floor(number / 100)] + ' Hundred ' + convertChunk(number % 100);
//     }

//     if (number === 0) {
//         return 'Zero';
//     }

//     let result = '';
//     let chunkIndex = 0;

//     while (number > 0) {
//         if (number % 1000 !== 0) {
//             result = convertChunk(number % 1000) + ' ' + thousands[chunkIndex] + ' ' + result;
//         }
//         number = Math.floor(number / 1000);
//         chunkIndex++;
//     }

//     return result.trim();
// }
function convertNumberToWords(number) {
    if (number === 0) return 'Zero';

    const units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten',
                   'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
    const tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
    const scales = ['', 'Thousand', 'Million', 'Billion', 'Trillion', 'Quadrillion', 'Quintillion'];

    function convertChunk(num) {
        if (num < 20) return units[num];
        if (num < 100) return tens[Math.floor(num / 10)] + (num % 10 !== 0 ? ' ' + units[num % 10] : '');
        if (num < 1000) return units[Math.floor(num / 100)] + ' Hundred' + (num % 100 !== 0 ? ' ' + convertChunk(num % 100) : '');
        return '';
    }

    let words = '';
    let scaleIndex = 0;
    while (number > 0) {
        if (number % 1000 !== 0) {
            const chunkWords = convertChunk(number % 1000);
            if (chunkWords) {
                words = chunkWords + (scaleIndex > 0 ? ' ' + scales[scaleIndex] : '') + (words ? ' ' + words : '');
            }
        }
        number = Math.floor(number / 1000);
        scaleIndex++;
    }
    return words;
}

console.log(convertNumberToWords(1234567)); // Output: "One Million Two Hundred Thirty Four Thousand Five Hundred Sixty Seven"

    // Function to populate the modal with data
        function populateModal(response) {
            const modalBody = $('#staticBackdrop .modal-body');
            
          const amountInWords = convertNumberToWords(parseFloat(response.payment_amount));
                    
                    
            const currentDate = new Date().toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            modalBody.html(`
            <div class="row">
                <div class="col-md-4">
                    <div class="company-info">
                     <img src="<?= base_url('Finexpertlogo.png') ?>" style="height: 50px; width: 250px" alt="Finexperts Logo">

                        <p>6-3-661/B/2, Plot No 78,2ed,</br>
                         SANGGTH NAGAR, SOMAJIGUDA, HYDERABAD</p>
                         <p>DATE: ${currentDate}</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="payment-invoice">
                        <div class="invoice-header">
                            <h3 class="text-center">Payment Invoice</h3>
                        </div>
                    </div>
                </div>
                </div>
                
            
                <table class="table">
                    <tr>
                        <td>PV No:</td>
                        <td style="border-bottom: 1px solid black;width:100px;">${response.voucher}</td>
                        
                        
                    </tr>
                    <tr>
                        <td>Paid To:</td>
                        <td colspan="3"style="border-bottom: 1px solid black;width:500px;">${response.agent_name}</td>
                    </tr>
                     <tr>
                        <td>Transaction Id:</td>
                        <td colspan="3"style="border-bottom: 1px solid black;width:500px;">${response.transaction_id}</td>
                    </tr>
                     <tr>
                        <td>Transaction Date:</td>
                        <td colspan="3"style="border-bottom: 1px solid black;width:500px;">${response.transaction_date}</td>
                    </tr>
                    <tr>
                        <td>Transaction Amount:</td>
                        <td colspan="3"style="border-bottom: 1px solid black;width:500px;">&#8377;${response.payment_amount} </td>
                    </tr>
                      <tr>
                    <td>In Words:</td>
                    <td colspan="3"style="border-bottom: 1px solid black;width:500px;"> ${amountInWords} Rupees Only</td>
                </tr>
                </table>
            `);

            $('#staticBackdrop').modal('show');
        }
});
</script>

<script>

$(document).ready(function() {
    // new DataTable('#datatable');
        $('#view-button').on('click', function(e) {
            e.preventDefault();
            
            var fromdate =$('#fromdate').val();
            var todate = $('#todate').val();
            var agentname = $('#agent').val();
            
            
            // alert(todate);
            compareDates(agentname, fromdate, todate);
        });
        
        
        function compareDates(agentname, fromdate, todate) {
            
            
            if (fromdate > todate) {
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
                url: '<?= base_url('agentinvoice/comparedates') ?>', // Replace with the correct URL for data retrieval on the server side
                method: 'POST',
                data: { agentname: agentname, fromdate: fromdate, todate: todate },
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
    if (data.length > 0) {
        $.each(data, function(index, row) {
            var newRow = $('<tr>');
            newRow.append('<td>' + (index + 1) + '</td>');
            newRow.append('<td hidden>' + row.id + '</td>');
            newRow.append('<td>' + row.transaction_id + '</td>');
            newRow.append('<td>' + row.transaction_date + '</td>');
            newRow.append('<td>' + row.payment_amount + '</td>');
            newRow.append('<td>' + row.gst_no + '</td>');
            newRow.append('<td>' + row.voucher + '</td>');
           
            
               newRow.append('<td><button class="btn btn-success generate_voucher" data-toggle="modal" value="' + row.id + '"  data-target="#staticBackdrop" data-id="' + row.id + '">View</button></td>');

            //   newRow.append('<td><button class="btn btn-success addButton" data-toggle="modal" value="' + row.id + '" onclick="downloadPdf()" data-bs-target="assignModal" data-id="' + row.id + '">Download</button></td>');

            

            tableBody.append(newRow);
        });
    } 
    $('#datatable').DataTable();
}
    

        
    });
    
</script>

<script>
    // Function to download the PDF
    function downloadPdf(agent_name) {
        // Select the target element (the modal content) to be converted to PDF
        const element = document.querySelector('.modal-body');
        
        const filename = `invoice_${agent_name}.pdf`;

        // Create an options object for html2pdf.js
        const options = {
            margin: 10,
            filename: 'invoice.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
        };

        // Use html2pdf.js to generate the PDF
        html2pdf().from(element).set(options).save();
        
    }
  const agentName = "agent_name";
    // Call the downloadPdf function when the "Download" button is clicked
    document.getElementById('downloadPdfBtn').addEventListener('click', downloadPdf);
    downloadPdf(agent_name);
    
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--Assigning agent script start-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>-->
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->
<!--    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>-->
<!--    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>-->
<!--    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>-->
<!--    <script src="../vendors/jquery/dist/jquery.min.js"></script>-->

    <!--<script src="../vendors/jquery/dist/jquery.min.js"></script>-->
    <!-- Bootstrap  -->
    <!--<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>-->
      <!-- FastClick   -->
    <!--<script src="../vendors/fastclick/lib/fastclick.js"></script>-->
      <!-- NProgress   -->
    <!--<script src="../vendors/nprogress/nprogress.js"></script>-->
      <!-- iCheck   -->
    <!--<script src="../vendors/iCheck/icheck.min.js"></script>-->
      <!-- Datatables   -->
    <!--<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>-->
    <!--<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>-->
    <!--<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>-->
    <!--<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>-->
    <!--<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>-->
    <!--<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>-->
    <!--<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>-->
    <!--<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>-->
    <!--<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>-->
    <!--<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>-->
    <!--<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>-->
    <!--<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>-->
    <!--<script src="../vendors/jszip/dist/jszip.min.js"></script>-->
    <!--<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>-->
    <!--<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>-->

      <!-- Custom Theme Scripts   -->
    <!--<script src="../build/js/custom.min.js"></script>-->

<?= $this->endSection() ?>