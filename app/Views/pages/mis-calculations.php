<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content') ?>

<h3>MIS Calculations</h3>

<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form class="form-label-left input_mask">

                    <div class="d-flex col-md-12">
                        <div class="field item form-group col-md-6">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">From Date<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input type="date" class="form-control" id="fromdate" required>
                            </div>
                        </div>
                        <div class="field item form-group col-md-6">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">To Date<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input type="date" class="form-control" id="todate" required>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex col-md-12">
                        <div class="field item form-group col-md-6">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Select Agent Id<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <select id="agent" onchange="getAgentName()" class="form-control" name="agent_id"
                                    required>
                                    <option value="">Choose..</option>

                                    <?php if ($agents) { ?>
                                        <?php foreach ($agents as $agent) { ?>
                                            <option value="<?= $agent['user_id'] ?>"><?= $agent['user_id'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="field item form-group col-md-6">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Agent Name<span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input type="text" class="form-control" id="agent_name" readonly>
                                <input type="hidden" class="form-control" id="email" name="email">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="field item form-group col-md-6">
                            <label>Want to Change Payout Percentage</label>
                            <div class="col-md-6 col-sm-6">
                                <input type="checkbox" class="" id="checkForPayOut">
                            </div>
                        </div>

                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-md-9 d-flex">
                            <!--<div class="field item form-group col-md-6" id="bankName">-->
                            <!--    <label id="bankList" class="col-form-label col-md-3 col-sm-3 label-align"></label>-->
                            <!--</div>-->
                            <div class="col-md-3 bankNameField" style="display: none;">
                                <!--<div class="field item form-group" id="bankName">-->
                                <h2>Bank Name</h2>
                                <!--<label id="bankList" class="col-form-label col-md-3 col-sm-3 label-align"></label>-->
                                <div id="bankList"></div>
                            </div>
                            <div class="col-md-2 bankNameField" style="display: none;">

                                <h2>PVT</h2>
                                <div id="PvtInput"></div>

                            </div>
                            <div class="col-md-2 bankNameField" style="display: none;">

                                <h2>GOVT</h2>
                                <div id="GovtInput"></div>

                            </div>
                            <div class="col-md-2 bankNameField" style="display: none;">
                                <h2>SEP</h2>
                                <div id="SepInput"></div>
                            </div>
                            <div class="col-md-2 bankNameField" style="display: none;">
                                <h2>Update</h2>
                                <div id="updatePayoutBtn"></div>
                            </div>
                        </div>

                        <div class="field item form-group text-center col-md-10 d-flex">
                            <button class="btn btn-primary" id="view-button">View</button>
                            <button class="btn btn-success" id="export-button"
                                onclick="validateFormAndProceed('export')">Export</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="x_content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive" style="overflow-x: auto;">
                <table id="datatable" class="table table-striped table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th hidden></th>
                            <th>Agreement No</th>
                            <th>Bank Name</th>
                            <th>Disbursal Date</th>
                            <th>Customer Name</th>
                            <th>Location</th>
                            <th>State</th>
                            <th>Gross No</th>
                            <th>Topup</th>
                            <th>Scheme</th>
                            <th>Net</th>
                            <th>Loan Amount</th>
                            <th>Category</th>
                            <th>Payout %</th>
                            <th>WFH Deduction %</th>
                            <th>Net %</th>
                            <th>Gross Payout</th>
                            <th>TDS</th>
                            <th>Net Payment</th>
                            <th>Executive</th>
                            <th hidden></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="datatable tbody">

                    </tbody>
                </table>
                <h3 id="noDataMessage" style="display: none;"></h3>
                <div>Total Gross: <span id="totalGross">0.00</span></div>
                <div>Total TDS: <span id="totalTDS">0.00</span></div>


            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<!--Edit Modal-->
<style>
    .input_field {
        align-items: center;
    }
</style>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <!--<form class="">-->
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="rowId" id="rowId" value="">
                <div class="d-flex mt-2 input_field">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Agreement Number<span
                            class="required">*</span></label>
                    <input readonly type="text" name="agreementno" id="agreementno" class="form-control" value="">
                </div>
                <div class="d-flex mt-2 ">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Bank Name<span
                            class="required">*</span></label>
                    <input readonly type="text" name="bankname" id="bankname" class="form-control" value="">
                </div>
                <div class="d-flex mt-2 ">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Loan Amount<span
                            class="required">*</span></label>
                    <input readonly type="text" name="loanamount" id="loanamount" class="form-control" value="">
                </div>

                <div class="d-flex mt-2 ">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Category<span
                            class="required">*</span></label>
                    <input readonly type="text" name="category" id="category" class="form-control" value="">
                </div>
                <div class="d-flex mt-2 ">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Payout Percentage<span
                            class="required">*</span></label>
                    <input type="text" name="payout" id="payout" class="form-control" value="">
                </div>
                <div class="d-flex mt-2 ">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">WFH Deduction<span
                            class="required">*</span></label>
                    <input type="text" name="wfh" id="wfh" class="form-control" value="">
                </div>
                <div class="d-flex mt-2 ">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Net Percentage<span
                            class="required">*</span></label>
                    <input type="text" name="net" id="net" class="form-control" value="">
                </div>
                <div class="d-flex mt-2 ">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Gross Payout<span
                            class="required">*</span></label>
                    <input type="text" name="grosspayout" id="grosspayout" class="form-control" value="">
                </div>
                <div class="d-flex mt-2 ">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">TDS<span
                            class="required">*</span></label>
                    <input type="text" name="tds" id="tds" class="form-control" value="">
                </div>
                <div class="d-flex mt-2 ">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Net Payment<span
                            class="required">*</span></label>
                    <input type="text" name="netpayment" id="netpayment" class="form-control" value="">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary updateAgentButton" id="updateBtn">Update</button>
            </div>
        </div>
    </div>
    <!--</form>-->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script>
    function validateFormAndProceed(action) {
        // Get the values of the required fields
        var fromDate = document.getElementById('fromdate').value;
        var toDate = document.getElementById('todate').value;
        var agentId = document.getElementById('agent').value;

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
        $('#export-button').on('click', function (e) {
            e.preventDefault();
            var agentId = $('#agent').val();
            var fromDate = $('#fromdate').val();
            var toDate = $('#todate').val();
            var email = $('#email').val();
            // console.log(agentId);
            let timerInterval;
            Swal.fire({
                title: 'Sending Email...',
                // html: 'I will close in <b></b> milliseconds.',
                timer: 5000, // Adjust the timer duration as needed
                timerProgressBar: true,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                    const timer = Swal.getPopup().querySelector('b');
                    timerInterval = setInterval(() => {
                        timer.textContent = `${Swal.getTimerLeft()}`;
                    }, 100);
                },
                willClose: () => {
                    clearInterval(timerInterval);
                }
            });


            // Make an AJAX request to the server to initiate the export
            $.ajax({
                type: 'GET',
                url: '<?= base_url('applicationReportController/exportToExcel') ?>',
                data: { agentId: agentId, fromDate: fromDate, toDate: toDate, email: email },
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        //   alert('Excel file saved successfully at path:')
                        // Use Swal to show a success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Sent Mail to agent ',
                        });
                        // Optionally, you can redirect or perform other actions here
                    } else {

                    }
                },
                error: function (xhr, status, error) {
                    // Use Swal to show an error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error exporting the Excel file: ' + error,
                    });
                }
            });
        });

        function sendEmailToAgent(agentId, filePath) {
            // Make an AJAX request to retrieve the agent's email based on the selected agent ID
            $.ajax({
                type: 'GET',
                url: '<?= base_url('applicationReportController/getAgentEmail') ?>',
                data: { agentId: agentId },
                success: function (response) {
                    console.log(response);
                    if (response) {
                        // Use response.email to get the agent's email
                        var agentEmail = response[0].email;
                        console.log(agentEmail);
                        // Call the sendEmail function to send the email with the attachment
                        sendEmail(agentEmail, filePath);
                    } else {
                        alert('Agent email not found.');
                    }
                },
                error: function (xhr, status, error) {
                    alert('Error fetching agent email: ' + error);
                }
            });
        }

        // Function to send an email to the provided email address with the attachment
        function sendEmail(email, filePath) {
            $.ajax({
                type: 'POST', // You might need to change the method to POST
                url: '<?= base_url('applicationReportController/sendEmailToAgents') ?>',
                data: { email: email, filePath: filePath },
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        // alert('Email sent to the agent with attachment.');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Email sent to the agent with attachment.',
                        });
                    } else {
                        alert('Failed to send the email.');
                    }
                },
                error: function (xhr, status, error) {
                    alert('Error sending the email: ' + error);
                }
            });
        }
    });

</script>
<script>
    $(document).ready(function () {
        $('#checkForPayOut').change(function () {
            if (this.checked) {
                $('.bankNameField').show();
                return;
            } else {
                // If checkbox is not checked, hide the bank name field and clear its value
                $('.bankNameField').hide();
                $('#bankName').val('');
                return;
            }
        });
    });


    // When the agent ID dropdown changes, fetch the agent name and update the text box
    function getAgentName() {
        var selectedAgentID = document.getElementById('agent').value;
        // var selectedAgentID = document.getElementById('agent').value;

        if (selectedAgentID !== '') {
            // Make an AJAX call to retrieve the agent name
            $.ajax({
                type: 'GET',
                url: '<?= base_url("Miscontroller/getAgentName/"); ?>' + selectedAgentID,
                success: function (response) {
                    document.getElementById("agent_name").value = response.name;
                    document.getElementById("email").value = response.email;
                    //   console.log(email);
                    // After getting the agent name, make another AJAX call to get agent bank
                    getAgentBank(selectedAgentID, response);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        } else {
            document.getElementById("agent_name").value = '';
        }
    }

    function getAgentBank(agentId, data) {
        var fromDate = document.getElementById('fromdate').value;
        var todate = document.getElementById('todate').value;
        $.ajax({
            type: 'GET',
            url: '<?= base_url("Miscontroller/getAgentBank"); ?>',
            data: {
                agentId: agentId,
                fromDate: fromDate,
                todate: todate
            },
            success: function (response) {
                console.log(response);
                var bankListElement = $('#bankList');
                var inputPvt = $("#PvtInput");
                var inputGovt = $("#GovtInput");
                var inputSep = $("#SepInput");
                var payoutBtn = $('#updatePayoutBtn');

                // Clear existing elements
                bankListElement.empty();
                inputPvt.empty();
                inputGovt.empty();
                inputSep.empty();
                payoutBtn.empty();

                $.each(response, function (index, bankName) {

                    var inputElement = $('<input style="border:none; background-color:white;" readonly>').attr({
                        type: 'text',
                        class: 'form-control',
                        name: 'bank[]',
                        value: bankName.Bank

                    });
                    bankListElement.append(inputElement);
                    inputPvt.append('<input class="form-control m-1"  data-bank="' + bankName.Bank + '">');
                    inputGovt.append('<input class="form-control m-1" data-bank="' + bankName.Bank + '">');
                    inputSep.append('<input class="form-control m-1" data-bank="' + bankName.Bank + '">');
                    payoutBtn.append('<button class="btn btn-warning" id="updatePayout">Update</button>');
                    return;

                });

                function createInputHandler(type) {
                    return function () {
                        var inputValue = $(this).val();
                        var bankName = $(this).data('bank');

                        var dataToUpdate = {
                            bank: bankName,
                            pvt: type === 'pvt' ? inputValue : undefined,
                            govt: type === 'govt' ? inputValue : undefined,
                            sep: type === 'sep' ? inputValue : undefined
                        };

                        updateBankName(dataToUpdate);
                    };
                }

                inputPvt.find('input').blur(createInputHandler('pvt'));
                inputGovt.find('input').blur(createInputHandler('govt'));
                inputSep.find('input').blur(createInputHandler('sep'));

            }
        });
    }

    function updateBankName(data) {
        console.log(data);
        $('#updatePayoutBtn').on('click', '#updatePayout', function () {
            console.log(data, "=========");
            var selectedAgentID = document.getElementById('agent').value;
            var fromDate = document.getElementById('fromdate').value;
            var todate = document.getElementById('todate').value;
            $.ajax({
                method: 'POST',
                url: '<?= base_url('Miscontroller/updateAgentGrossPayout'); ?>',
                data: { agentId: selectedAgentID, fromDate: fromDate, todate: todate, bank: data.bank, pvt: data.pvt, govt: data.govt, sep: data.sep },
                success: function (response) {
                    console.log(response);
                    // Show SweetAlert message for successful update
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated Successfully',
                        text: 'The agent gross payout has been updated successfully.',
                        timer: 7000, // Timer in milliseconds (3 seconds in this case)
                        timerProgressBar: true, // Show progress bar
                        showConfirmButton: false // Hide the "OK" button
                    });
                }
            })

        });
    }


    // Assuming the container of the button has an ID 'payoutBtnContainer'


    function bankchange() {
        var selectedBankName = document.getElementById('heard').value;

        $.ajax({
            type: 'POST',
            url: '<?= base_url("Miscontroller/getAgentData") ?>',
            data: { bankname: selectedBankName },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    console.log(response);
                    var agentData = response.data;

                    // Extract the day, month, and year from the fetched date
                    var fromDate = new Date(agentData.from_date);
                    var toDate = new Date(agentData.to_date);

                    // Populate the "From Date" fields
                    document.getElementById('day1').value = fromDate.getDate();
                    document.getElementById('month1').value = fromDate.getMonth() + 1;
                    document.getElementById('year1').value = fromDate.getFullYear();

                    document.getElementById('month1').addEventListener('change', function () {
                        var selectedMonth = parseInt(this.value) + 1; // Increment month by 1
                        var year = parseInt(document.getElementById('year1').value);
                        if (selectedMonth > 12) {
                            selectedMonth = 1;
                            year++;
                        }

                        document.getElementById('month2').value = selectedMonth;
                        document.getElementById('year2').value = year;
                    });

                    var toDate = new Date(fromDate);
                    toDate.setMonth(toDate.getMonth() + 1);

                    // Populate the "To Date" fields
                    document.getElementById('day2').value = toDate.getDate() - 1;
                    document.getElementById('month2').value = toDate.getMonth() + 1;
                    document.getElementById('year2').value = toDate.getFullYear();
                } else {
                    // Clear the "From Date" fields
                    document.getElementById('day1').value = '';
                    document.getElementById('month1').value = '';
                    document.getElementById('year1').value = '';

                    // Clear the "To Date" fields
                    document.getElementById('day2').value = '';
                    document.getElementById('month2').value = '';
                    document.getElementById('year2').value = '';
                }
            },
            error: function (xhr, status, error) {
                console.error('Error occurred during AJAX request:', error);
            }
        });
    }

</script>
<script>

    $(document).ready(function () {
        // new DataTable('#datatable');
        $('#view-button').on('click', function (e) {
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
                url: "getDataByAgentFromToDate", // Replace with the actual URL
                type: "POST",
                data: { agentId: agentId, fromDate: fromDate, toDate: toDate },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    // Update the table with the fetched data
                    updateTable(data);
                    // updateTotalValues();
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching data: " + error);
                }
            });
        });
        function updateTable(data) {
            var totalGross = 0;
            var totalTDS = 0;
            var tableBody = $('#datatable tbody');
            var dataTable = $('#datatable').DataTable();
            // Destroy the DataTable
            dataTable.destroy();
            // Clear the table
            tableBody.empty();
            var userRole = <?php echo json_encode(session()->get('role')); ?>;
            if (data.length > 0) {

                $.each(data, function (index, row) {
                    var newRow = $('<tr>');
                    newRow.append('<td>' + (index + 1) + '</td>');
                    newRow.append('<td hidden>' + row.id + '</td>');
                    newRow.append('<td>' + row.AgreementNo + '</td>');
                    newRow.append('<td>' + row.Bank + '</td>');
                    newRow.append('<td>' + row.DisbursalDate + '</td>');
                    newRow.append('<td>' + row.CustomerName + '</td>');
                    newRow.append('<td>' + row.Location + '</td>');
                    newRow.append('<td>' + row.State + '</td>');
                    newRow.append('<td>' + row.Gross + '</td>');
                    newRow.append('<td>' + (row.Gross - row.Net) + '</td>');
                    newRow.append('<td>' + row.Scheme + '</td>');
                    newRow.append('<td>' + row.Net + '</td>');
                    newRow.append('<td>' + row.LoanAmount + '</td>');
                    newRow.append('<td>' + row.Category + '</td>');
                    newRow.append('<td id="payoutP' + row.id + '">' + row['PayOutPercentage'] + '</td>');
                    newRow.append('<td id="wfhDd' + row.id + '">' + row.WfhDeduction + '</td>');
                    newRow.append('<td id="netP' + row.id + '">' + row['NetPercentage'] + '</td>');
                    newRow.append('<td id="grossP' + row.id + '">' + row.GrossPayout + '</td>');
                    newRow.append('<td id="tableTds_' + row.id + '">' + row.TDS + '</td>');
                    newRow.append('<td id="netPay' + row.id + '">' + row.NetPayment + '</td>');
                    newRow.append('<td>' + row.Executive + '</td>');
                    totalTDS += parseFloat(row.TDS);
                    totalGross += parseFloat(row.GrossPayout);

                    // Check if the user's role is not 1, and if it's not, hide the "Edit" button
                    if (userRole !== '1') {
                        newRow.append('<td></td>');
                    } else {
                        newRow.append('<td><button class="btn btn-outline-warning editmis" data-toggle="modal" data-target="#editModal" data-id="' + row.id + '">Edit</button></td>');
                    }

                    newRow.append('<td style="display:none;">' + row.id + '</td>');

                    tableBody.append(newRow);
                });
            }
            $('#datatable').DataTable();
            $('#totalTDS').text(totalTDS.toFixed(2));
            $('#totalGross').text(totalGross.toFixed(2));
        }
        $("#editModal").on("input", "#wfh", function () {
            updateCalculations($(this).closest("#editModal"));
        });

        $("#editModal").on("input", "#payout", function () {
            updateCalculations($(this).closest("#editModal"));
        });

        function updateCalculations(modal) {
            // Retrieve the value of WFH Deduction from the input field inside the modal
            var wfh = parseFloat(modal.find("#wfh").val());
            var payout = parseFloat(modal.find('#payout').val());
            // Get the relevant data from the modal
            // var payoutPercentage = parseFloat(modal.find("#payout").val());
            var loanamount = parseFloat(modal.find("#loanamount").val());
            // Calculate the new values based on WFH Deduction
            var netPercentage = payout - wfh;
            var grossPayout = loanamount * (netPercentage / 100);
            var tds = grossPayout * (5 / 100);
            var netPayment = grossPayout - tds;
            // Update the relevant fields inside the modal
            modal.find("#net").val(netPercentage.toFixed(2));
            modal.find("#grosspayout").val(grossPayout.toFixed(2));
            modal.find("#tds").val(tds.toFixed(2));
            modal.find("#netpayment").val(netPayment.toFixed(2));
        }
        // ...Edit Mis Calcution Ajax code ...
        $(document).on('click', '.editmis', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: "<?= base_url(); ?>" + "Miscontroller/editmis/" + id,
                method: 'GET',
                success: function (result) {
                    var res = JSON.parse(result);
                    // Update the modal fields with the retrieved data
                    $("#rowId").val(res.id);
                    $("#agreementno").val(res.AgreementNo);
                    $("#bankname").val(res.Bank);
                    $("#loanamount").val(res.LoanAmount);
                    $("#category").val(res.Category);
                    $("#payout").val(res['PayOutPercentage']);
                    $("#wfh").val(res.WfhDeduction);
                    // Trigger the input event on WFH Deduction to recalculate all values
                    $("#editModal").find("#wfh").trigger("input");
                }
            });
        });
    });
</script>
<script>
    $('#updateBtn').on("click", function () {
        var id = $('#rowId').val();
        var payout = $('#payout').val();
        var wfh = $('#wfh').val();
        var net = $('#net').val();
        var grosspayout = $('#grosspayout').val();
        var tds = $('#tds').val();
        var netpayment = $('#netpayment').val();
        $.ajax({
            type: 'POST',
            url: '<?= base_url('Miscontroller/updateMis'); ?>',
            data: { id: id, payout: payout, wfh: wfh, net: net, grosspayout: grosspayout, tds: tds, netpayment: netpayment },
            success: function (response) {
                console.log(response);
                $('#editModal').modal('hide');
                $('#tableTds_' + response.id).text(response.TDS);
                $('#payoutP' + response.id).text(response.PayOutPercentage);
                $('#wfhDd' + response.id).text(response.WfhDeduction);
                $('#netP' + response.id).text(response.NetPercentage);
                $('#grossP' + response.id).text(response.GrossPayout);
                $('#netPay' + response.id).text(response.NetPayment);
            },
            error: function (xhr, status, error) {
                console.log(error);
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
<?php if (session()->has('status')): ?>
    <script>
        $(document).ready(function () {
            <?php if (session('status') === 'success'): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '<?php echo session('message'); ?>'
                });
            <?php elseif (session('status') === 'error'): ?>
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