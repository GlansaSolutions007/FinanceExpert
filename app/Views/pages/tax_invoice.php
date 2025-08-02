<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content') ?>
<h3>Generate Agent Invoice For Tax</h3>
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
                        <label>Agent ID</label>
                        <select class="form-control select2" onchange="getAgentName()" id="heard">
                            <option>Select Agent ID</option>
                            <?php
                            if ($agents) {
                                foreach ($agents as $agent) {
                                    // Check if the 'Executive' field is not null before adding the option
                                    if (!empty($agent['Executive'])) {
                                        ?>
                                        <option><?= $agent['Executive']; ?></option>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="m-2">
                        <label class="h6">From Date</label>
                        <input type="date" required="required" class="form-control" name="fromDate" , id="fromDate">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="m-2">
                        <label>Agent Name</label>
                        <input class="form-control rounded" required class="form-control" name="agent_name"
                            id="agent_name" placeholder="" type="text" readonly />
                        <input type="email" name="email" id="email" hidden>
                        <input type="hidden" name="address" class="address">

                        <input type="hidden" id="agentGstNo">
                        <input type="hidden" id="alreadyPaid">
                        <input type="hidden" id="emi">
                        <input type='hidden' id="paymentMode">
                        <input type='hidden' id="payableAmount">
                        <input type="hidden" id="logo" value="<?= base_url('Finexpertlogo.png') ?>">
                    </div>
                    <div class="m-2">
                        <label class="h6">To Date</label>
                        <input type="date" required="required" class="form-control" name="toDate" , id="toDate">
                        <div id="dateError" class="text-danger font-weight-bold font-size-18"></div>
                    </div>

                </div>

                <div class="m-2 d-flex justify-content-center">
                    <!--<button class="btn btn-primary" id="addSubagentButton" data-target="#subagentModal" data-toggle="modal" onclick="validateAndAddSubAgent()">GO</button>-->

                    <button class="btn btn-primary" id="addSubagentButton" data-target="#subagentModal"
                        data-toggle="modal" onclick="addSubAgent()">GO</button>
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
                            <th hidden></th>
                            <th>Agent Id</th>
                            <th>Agent Name</th>
                            <th>Gross Payout</th>
                            <th>TDS</th>
                            <th>NetPayment</th>
                            <th>Payable Amount</th>
                            <!--<th>Deduction Payment</th>-->
                            <!--<th>EMI</th>-->

                            <th>Actions</th>
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

<style>
    body {
        font-family: Arial, sans-serif;
    }

    table {
        width: 50%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .text-right {
        text-align: right;
    }

    h3 {
        font-size: 20px;
    }
</style>


<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="invoiceModalLabel">Tax Invoice</h5>
                <h2 id="date"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td colspan="5" rowspan="2">
                            <h4 class="agentName"> </h4>
                            <!--<p> Company's GSTIN/UIN:</p>-->
                            <b>GST Number:</b>
                            <p id="gst_modal"></p>
                            <p><b>Address:</b></p>
                            <p class="address"></p>
                        </td>
                        <td>
                            Invoice No.
                            <p id="invoice"></p>
                        </td>
                        <td>
                            Date
                            <p id="date_modal"></p>
                            <p id="email"></p>
                        </td>

                    </tr>
                    <tr>
                        <!--<td> Delivery Note</td>-->
                        <td>
                            Mode/Terms of Payment
                        </td>
                        <td id="payment_type_modal"></td>
                    </tr>

                    <tr>
                        <td colspan="5" rowspan="2">
                            <!--<div>-->
                            <!--<img id="imageLogo" src="<?= base_url('Finexpertlogo.png') ?>"-->
                            <!--    style="height: 50px; width: 200px" alt="Finexperts Logo" />-->
                            <h3>FINEXPERTS</h3><br>
                            <!--</div>-->
                            6-3-661/B/2, Plot No 78, 2nd, SANGEETH NAGAR <br>
                            SOMAJIGUDA,HYDERABAD <br>
                            GSTIN/UIN : 36AAGFF3638R1ZT <br>
                            State Name : Telangana, Code:36
                        </td>

                        <td colspan="5"> Terms of Delivery </td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td style="text-align: center;"> Sl No.</td>
                        <td style="text-align: center;" colspan="4"> Particulars</td>
                        <td style="text-align: center;"> HSN/SAC</td>
                        <td style="text-align: center;" id="amount"> Amount </td>
                    </tr>
                    <tr>
                        <td style="border-bottom:none;border-top:none;text-align:right;">1 </td>
                        <td colspan="4">Commission</td>
                        <td style="border-bottom:none;border-top:none;text-align:right;"> </td>
                        <td id="paymentamount"> </td>
                    </tr>
                    <tr class="cgstamount">
                        <td style="border-bottom:none;border-top:none;text-align:right;">2</td>
                        <td colspan="4">CGST</td>
                        <td style="border-bottom:none;border-top:none;text-align:right;"> </td>
                        <td class="cgst_modal"> </td>
                    </tr>
                    <tr class="sgstamount">
                        <td style="border-bottom:none;border-top:none;text-align:right;">3</td>
                        <td colspan="4">SGST</td>
                        <td style="border-bottom:none;border-top:none;text-align:right;"> </td>
                        <td class="sgst_modal"> </td>
                    </tr>
                    <tr class="igstamount">
                        <td style="border-bottom:none;border-top:none;text-align:right;">3</td>
                        <td colspan="4">IGST</td>
                        <td style="border-bottom:none;border-top:none;text-align:right;"> </td>
                        <td class="igst_modal"> </td>
                    </tr>
                    <tr>
                        <td style="border-bottom:none;border-top:none;"> </td>
                        <td colspan="4" style="text-align: right;">Total</td>
                        <td> </td>
                        <td id="total_amount"></td>
                    </tr>
                    <tr>
                        <td colspan="7">
                            Amount Chargeable (in words)
                            <b>
                                <p id="word">
                            </b> </p>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2"> HSN/SAC</td>
                        <td rowspan="2"> Taxable <br> Value</td>
                        <td colspan="2"> Central Tax</td>
                        <td colspan="2"> State Tax</td>
                        <td rowspan="2"> Total <br>
                            Tax Amount </td>
                    </tr>
                    <tr>
                        <td>Rate</td>
                        <td>Amount</td>
                        <td>Rate</td>
                        <td>Amount</td>
                    </tr>
                    <tr>
                        <td> </td>
                        <td id=""> </td>
                        <td id="cgstrate"></td>
                        <td class="cgst_modal"></td>
                        <td id="sgstrate"></td>
                        <td class="sgst_modal"></td>
                        <td class="igst_modal" id="igst_modal"></td>
                    </tr>
                    <tr>
                        <td style="height: 100px;" colspan="7">

                            Tax Amount (in word) : <p id="inword"></p>
                            <br>
                            <br>
                            <br>
                            Company's GSTIN/UIN :

                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2" colspan="3" style="text-align: left;">
                            Customer's Seal and Signature
                        </td>
                        <td rowspan="2" colspan="4" style="text-align: right;">
                            for <h6 class="agentName"></h6>
                            <br> <br>
                            Authorised Signatory
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="downloadPdfBtn">Download</button>
            </div>
        </div>
    </div>
</div>


<!--SubAgent Model-->

<div id="subagentModal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="x_content">
                <form class="" method="POST">

                    <span class="section">Generate Invoice</span>
                    <div class="row">
                        <div class="col-3 text-center" id="SubAgentName">
                            <!--<h2>Agent Name</h2>-->
                        </div>
                        <div class="col-3" id="SubAgentTextField">
                            <!--<h2>Gross Payout</h2>-->
                        </div>
                        <div class="col-3" id="tds" style="border-right:1px solid gray;">
                            <!--<h2>TDS</h2>-->
                        </div>
                        <div class="col-3" id="Total">
                            <!--<h2>Net Payment</h2>-->
                        </div>

                    </div>
                    <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-10 offset-md-3 mt-3">
                                <button type='submit' class="btn btn-primary" data-dismiss="modal"
                                    id="generateInvoice">Generate</button>
                                <button type='reset' class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </form>
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

    .invoice-details th,
    .invoice-details td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }

    .invoice-total {
        margin-top: 20px;
        text-align: right;
    }

    .gst-input {
        display: none;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#toDate').on('change keyup', function () {
            var fromDate = new Date($('#fromDate').val());
            var toDate = new Date($(this).val());

            if (toDate > fromDate) {
                $('#dateError').text('');
            } else {
                $('#dateError').text('To Date cannot be less than From Date');
            }
        });

        $('#fromDate').on('change keyup', function () {
            var fromDate = new Date($(this).val());
            var toDate = new Date($('#toDate').val());

            if (toDate < fromDate) {
                $('#dateError').text('To Date cannot be less than From Date');
            } else {
                $('#dateError').text('');
            }
        });
    });
</script>
<script>
    function validateAndAddSubAgent() {
        var fromDate = document.getElementById('fromDate').value;
        var toDate = document.getElementById('toDate').value;
        var agentname = document.getElementById('heard').value;

        // Check if either fromDate or toDate is empty and agentname is not empty
        if ((!fromDate || !toDate) && agentname !== '') {
            // Show SweetAlert dialog for validation error
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please fill in both the From Date and To Date fields.',
            });
            return; // Stop further execution
        }

        // Proceed to execute addSubAgent() function

    }
    addSubAgent();
</script>
<script>
    // When the agent ID dropdown changes, fetch the agent name and update the text box
    function getAgentName() {
        var selectedAgentID = document.getElementById('heard').value;
        if (selectedAgentID !== '') {
            // Make an AJAX call to the server to retrieve the agent name
            $.ajax({
                type: 'GET',
                url: '<?= base_url("Miscontroller/getAgentName/"); ?>' + selectedAgentID,
                success: function (response) {
                    console.log(response.gst_no);
                    document.getElementById("agent_name").value = response.name;
                    $("#email").val(response.email);
                    var address = response.address;
                    $(".address").val(address);
                    $("#agentGstNo").val(response.gst_no);
                    // document.getElementById('agentGstNo').value = response.gst_no;
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
    var agentDetails;
    var subagentDetails;
    function addSubAgent() {
        var userId = document.getElementById('heard').value;
        var agentName = document.getElementById('agent_name').value;
        var fromdate = $('#fromDate').val();
        var todate = $('#toDate').val();
        var initialAgentTotal = 0; // Store the initial agent total value
        var initialAgentTds = 0;
        var agentGross;

        $.ajax({
            type: 'POST',
            url: '<?= base_url('agentinvoice/comparedate') ?>',
            dataType: 'json',
            data: { agentname: userId, fromdate: fromdate, todate: todate },
            success: function (response) {
                console.log(response);
                agentDetails = response.payment_data;
                subagentDetails = response.sub_agent_data;
                var initialAgentTotal = response.payment_data[0].payment_amount;
                document.getElementById("SubAgentName").innerHTML = "";
                document.getElementById("SubAgentTextField").innerHTML = "";
                document.getElementById("tds").innerHTML = "";
                document.getElementById("Total").innerHTML = "";

                var h2Agent = document.createElement("h2");
                var lineBreak = document.createElement("br");
                h2Agent.textContent = 'Agent Name';
                document.getElementById("SubAgentName").appendChild(h2Agent);
                document.getElementById("SubAgentName").appendChild(lineBreak);


                var h2Gross = document.createElement("h2");
                var lineBreak = document.createElement("br");
                h2Gross.textContent = 'Gross Payout';
                document.getElementById("SubAgentTextField").appendChild(h2Gross);
                document.getElementById("SubAgentTextField").appendChild(lineBreak);

                var h2Tds = document.createElement("h2");
                var lineBreak = document.createElement("br");
                h2Tds.textContent = 'TDS';
                document.getElementById("tds").appendChild(h2Tds);
                document.getElementById("tds").appendChild(lineBreak);

                var h2Net = document.createElement("h2");
                var lineBreak = document.createElement("br");
                h2Net.textContent = 'Net Payment';
                document.getElementById("Total").appendChild(h2Net);
                document.getElementById("Total").appendChild(lineBreak);

                for (var i = 0; i < response.payment_data.length; i++) {
                    //  Agent Name Display
                    var h3 = document.createElement("h6");
                    var lineBreak = document.createElement("br");
                    h3.textContent = response.payment_data[i].agent_name;
                    document.getElementById("SubAgentName").appendChild(h3);
                    document.getElementById("SubAgentName").appendChild(lineBreak);


                    //  Gross Payout Display
                    agentGross = response.payment_data[i].payment_amount;

                    var GrossPayoutBox = document.createElement("input");
                    GrossPayoutBox.type = "text";
                    GrossPayoutBox.className = "form-control agentTotal mb-2";
                    GrossPayoutBox.value = agentGross;
                    initialAgentTotal = response.payment_data[i].payment_amount
                    document.getElementById("SubAgentTextField").appendChild(GrossPayoutBox);

                    // TDS display

                    var TdsBox = document.createElement("input");
                    TdsBox.type = "text";
                    TdsBox.className = "form-control AgentTds mb-2";
                    TdsBox.value = (response.payment_data[i].payment_amount * (5 / 100)).toFixed(2);
                    document.getElementById("tds").appendChild(TdsBox);

                    // Net Payment Display

                    var NetPaymentBox = document.createElement("input");
                    NetPaymentBox.type = "text";
                    NetPaymentBox.className = "form-control agentNetPayment mb-2";
                    NetPaymentBox.value = (response.payment_data[i].payment_amount * (95 / 100)).toFixed(2);
                    document.getElementById("Total").appendChild(NetPaymentBox);
                }



                for (var j = 0; j < response.sub_agent_data.length; j++) {

                    var h3 = document.createElement("h6");
                    var lineBreak = document.createElement("br");
                    h3.textContent = response.sub_agent_data[j].name;
                    document.getElementById("SubAgentName").appendChild(h3);
                    document.getElementById("SubAgentName").appendChild(lineBreak);


                    var GrossPayoutBox = document.createElement("input");
                    GrossPayoutBox.type = "text";
                    GrossPayoutBox.className = "form-control subagentTotal";
                    GrossPayoutBox.setAttribute("id", "subagentTotal" + j);
                    // GrossPayoutBox.value = response.sub_agent_data[j].payment_amount;
                    document.getElementById("SubAgentTextField").appendChild(GrossPayoutBox);


                    var TdsBox = document.createElement("input");
                    TdsBox.type = "text";
                    TdsBox.className = "form-control subagentTds";
                    TdsBox.setAttribute("id", "subagentTds" + j);
                    // TdsBox.value = (response.payment_data[i].payment_amount * (5/100)).toFixed(2);
                    document.getElementById("tds").appendChild(TdsBox);

                    // Net Payment Display

                    var NetPaymentBox = document.createElement("input");
                    NetPaymentBox.type = "text";
                    NetPaymentBox.className = "form-control subagentNetPayment";
                    NetPaymentBox.setAttribute("id", "subagentNetPayment" + j)
                    // NetPaymentBox.value = ((response.payment_data[i].payment_amount) - (response.payment_data[i].payment_amount * (5/100))).toFixed(2);
                    document.getElementById("Total").appendChild(NetPaymentBox);
                }
                document.addEventListener('input', function (event) {
                    if (event.target.className.includes('subagentTotal')) {
                        updateCalculations(event.target);
                    }
                });

                function updateCalculations(subagentInput) {
                    var subagentIndex = subagentInput.id.slice(-1); // Extract subagent index from input id
                    var subagentGross = parseFloat(subagentInput.value);

                    // Calculate total subagent gross payout
                    var totalSubagentGross = 0;
                    $('.subagentTotal').each(function () {
                        totalSubagentGross += parseFloat($(this).val()) || 0;
                    });

                    // Calculate agent gross payout after deducting total subagent gross payout
                    agentGross = initialAgentTotal - totalSubagentGross;

                    // Calculate agent TDS and net payment based on updated agent gross payout
                    var agentTds = agentGross * (5 / 100);
                    var agentNetPayment = agentGross * (95 / 100);

                    // Update agent total, TDS, and net payment fields
                    $('.agentTotal').val(agentGross.toFixed(2));
                    $('.AgentTds').val(agentTds.toFixed(2));
                    $('.agentNetPayment').val(agentNetPayment.toFixed(2));

                    // Calculate subagent TDS and net payment based on subagent gross payout
                    var subagentTds = subagentGross * (5 / 100);
                    var subagentNetPayment = subagentGross * (95 / 100);

                    // Update subagent TDS and net payment fields
                    $('#subagentTds' + subagentIndex).val(subagentTds.toFixed(2));
                    $('#subagentNetPayment' + subagentIndex).val(subagentNetPayment.toFixed(2));
                }

            },

        });
    }
</script>



<script>
    $(document).on('click', '#generateInvoice', function (e) {
        e.preventDefault();
        // agentDetails = response;
        console.log(agentDetails, "hkjgss");
        var agentData = [];
        if (agentDetails) {
            for (var i = 0; i < agentDetails.length; i++) {
                var agent = agentDetails[i];
                var agentgst_no = agentDetails[i].gst_no;
                var agentName = agentDetails[i].agent_name;
                var agent_id = agentDetails[i].agent_id;
                var agentgrossPayout = agentDetails[i].payment_amount;
                var agentinvoice_no = generateInvoiceNumber();
                var email = $('#email').val();
                var fromDate = $('#fromDate').val();
                var toDate = $('#toDate').val();
                var agentTds = (agentgrossPayout * (5 / 100)).toFixed(2);
                // var image = $('#logo').val();

                var agentNetPayment = agentgrossPayout - (agentgrossPayout * (5 / 100)).toFixed(2);
                var agentigst = (agentgrossPayout * (18 / 100)).toFixed(2);
                var agentcgst = (agentigst / 2);
                var agentsgst = agentigst / 2;
                var paymentType = agentDetails[i].transaction_type;
                var address = $('.address').val();
                var agentCommision = agentNetPayment;
                var totalAmount = agentNetPayment + agentcgst + agentsgst;
                var date = new Date().toLocaleDateString();

                var agentDataEntry = {
                    agentName: agentName,
                    agent_id: agent_id,
                    email: email,
                    tds: agentTds,
                    netPayment: agentNetPayment,
                    invoice_no: agentinvoice_no,
                    gst_no: agentgst_no,
                    date: date,
                    address: address,
                    payment_mode: paymentType,
                    grossPayout: agentgrossPayout,
                    payableAmount: agentgrossPayout,
                    cgst: agentcgst,
                    sgst: agentsgst,
                    igst: agentigst,
                    fromdate: fromDate,
                    todate: toDate,
                    commision: agentCommision,
                    image: image
                };
                agentData.push(agentDataEntry);
            }
        }

        if (subagentDetails) {
            for (var j = 0; j < subagentDetails.length; j++) {
                var subagentGstNo = subagentDetails[j].gst_no;
                var subagentName = subagentDetails[j].name;
                var subagentInvoiceNumber = generateInvoiceNumber();
                var subagentAddress = subagentDetails[j].address;
                var email = $('#email').val();
                var subagentGross = $('#subagentTotal' + j).val(); // Adjust the ID based on your HTML structure
                var subagentTds = (subagentGross * (5 / 100)).toFixed(2);
                var subagentNetPayment = subagentGross - subagentTds;
                var fromDate = $('#fromDate').val();
                var toDate = $('#toDate').val();
                var subagentIgst = (subagentGross * (18 / 100)).toFixed(2);
                var subagentCgst = subagentIgst / 2;
                var subagentSgst = subagentIgst / 2;
                var date = new Date().toLocaleDateString();
                var image = $('#logo').val();

                if (subagentGross > 0) {
                    var subagentDataEntry = {
                        agentName: subagentName,
                        agent_id: $('#heard').val(),
                        email: email,
                        tds: subagentTds,
                        netPayment: subagentNetPayment,
                        invoice_no: subagentInvoiceNumber,
                        gst_no: subagentGstNo,
                        date: date,
                        address: subagentAddress,
                        payment_mode: agentDetails[0].transaction_type,
                        grossPayout: subagentGross,
                        payableAmount: subagentGross,
                        cgst: subagentCgst,
                        sgst: subagentSgst,
                        igst: subagentIgst,
                        fromdate: fromDate,
                        todate: toDate,
                        commision: subagentNetPayment,
                        image: image
                    };
                    agentData.push(subagentDataEntry);
                }


            }
        }
        var postData = {
            subagentData: agentData
        };

        console.log(postData, "ljhkwdh");


        getInvoiceDetails(agent_id, fromDate, toDate, function (existingData) {
            // console.log(agent_id,fromDate,toDate);

            if (existingData) {
                // console.log(existingData);
                updateTable(existingData);
                console.log("Data already exists. No need to insert again.");
            } else {
                // Data does not exist, proceed with insertion
                console.log("Data does not exist. Proceed with insertion.");

                // Send the data to the server using AJAX
                $.ajax({
                    type: 'POST',
                    url: '<?= base_url("agentinvoice/insertInvoice") ?>',
                    data: { data: postData }, // Send the gathered data
                    dataType: 'json',
                    success: function (response) {
                        console.log(response, "====");
                        if (response.success) {
                            // var insertedAgentData = response.data.agentData;
                            var insertedSubagentData = response.data.subagentData;

                            $('#subagentModal').modal('hide');
                            updateTable(insertedSubagentData);

                            // sendEmailToAgent(agentName, email, agentinvoice_no);
                        } else {
                            console.error("Insertion failed:", response.error);
                        }
                    },
                    error: function (xhr, status, error) {
                        // Handle errors, e.g., show an error message
                        console.error("Error occurred during AJAX request:", error);
                    }
                });
            }
        });
    });

</script>

<script>

    function updateTable(data) {
        // console.log(data, "==========+++");
        var payableAmount = $('#payableAmount').val();
        var tableBody = $('#datatable tbody');
        var dataTable = $('#datatable').DataTable();

        // Destroy the DataTable
        dataTable.destroy();

        // Clear the table
        tableBody.empty();

        if (data && Object.keys(data).length > 2 && Object.prototype.toString.call(data) === '[object Object]') {
            var newRow = $('<tr>');
            // console.log(row);
            newRow.append('<td>' + 1 + '</td>');
            newRow.append('<td hidden>' + data.id + '</td>');
            newRow.append('<td hidden>' + data.email + '</td>');
            newRow.append('<td>' + data.agent_id + '</td>');
            newRow.append('<td>' + (data.agent_id == '' ? (data.agentName) + (" ( " + "Sub Agent" + " ) ") : data.agentName) + '</td>');
            newRow.append('<td>' + data.grossPayout + '</td>');
            newRow.append('<td>' + data.tds + '</td>');
            newRow.append('<td>' + data.commision + '</td>');
            newRow.append('<td>' + data.netPayment + '</td>');
            newRow.append('<td><button class="btn btn-success generate_voucher" data-id="' + data.id + '" data-toggle="modal" data-target="#invoiceModal">Generate Invoice</button></td>');
            tableBody.append(newRow);
        } else {
            $.each(data, function (index, row) {
                // console.log(data);
                var newRow = $('<tr>');
                // console.log(row.id);
                newRow.append('<td>' + (index + 1) + '</td>');
                newRow.append('<td hidden>' + row.id + '</td>');
                newRow.append('<td hidden>' + row.email + '</td>');
                newRow.append('<td>' + row.agent_id + '</td>');
                newRow.append('<td>' + (row.agent_id == '' ? (row.agentName) + (" ( " + "Sub Agent" + " ) ") : row.agentName) + '</td>');
                newRow.append('<td>' + row.grossPayout + '</td>');
                newRow.append('<td>' + row.tds + '</td>');
                newRow.append('<td>' + row.netPayment + '</td>');
                newRow.append('<td>' + row.netPayment + '</td>');
                newRow.append('<td><button class="btn btn-success generate_voucher" data-id="' + row.id + '" data-toggle="modal" data-target="#invoiceModal">Generate Invoice</button></td>');

                tableBody.append(newRow);
            });
        }
        if (data.length === 0) {
            var newRow = $('<tr>').html('<td colspan="7">No data available.</td>');
            tableBody.append(newRow);
        }

        $('#datatable').DataTable();
    }

    // // Modify your getInvoiceDetails function to accept a callback function
    function getInvoiceDetails(agentId, fromDate, toDate, callback) {
        $.ajax({
            type: 'POST',
            url: '<?= base_url("agentinvoice/checkDataExists") ?>',
            dataType: 'json',
            data: {
                agentId: agentId,
                fromDate: fromDate,
                toDate: toDate,
                // email:email,
            },
            success: function (response) {
                if (response.dataExists) {
                    callback(response.existingData); // Pass the existing data to the callback
                } else {
                    callback(null); // Data doesn't exist, pass null to the callback
                }
            },
            error: function (xhr, status, error) {
                console.error("Error occurred during AJAX request:", error);
                callback(null); // Error occurred, pass null to the callback
            }
        });
    }

    // Your populateModal function remains the same
    function populateModal(response) {
        // console.log("Hi:",response);
        var cgst = response.cgst;
        var cgstRate = Math.round((response.cgst / response.payableAmount) * 100);
        var sgstRate = Math.round((response.sgst / response.payableAmount) * 100);
        var commission = parseFloat(response.payableAmount);
        var total = parseFloat(response.payableAmount) + parseFloat(response.cgst) + parseFloat(response.sgst);
        var igst = parseFloat(response.igst);
        var totalInWords = convertToWords(total);
        var igstInWords = convertToWords(igst);

        if (response.gst_no.substring(0, 2) != '36') {
            $('.cgstamount').hide();
            $('.sgstamount').hide();
            $('.igstamount').show();
        }
        if (response.gst_no.substring(0, 2) == '36') {
            $('.igstamount').hide();
            $('.cgstamount').show();
            $('.sgstamount').show();
        }

        // Set the total amount in words in the modal
        $('#word').text(totalInWords);
        $('#inword').text(igstInWords);
        // console.log(total);
        $('#invoice').text(response.invoice_no);
        $('#date_modal').text(response.date);
        $('#email').text(response.email);
        $('.agentName').text(response.agentName);
        $('#gst_modal').text(response.gst_no);
        $('#total_amount').html('Rs.' + total);
        $('#paymentamount').html('Rs. ' + commission);
        $('#paymentdeduction').text(response.alreadyPaid);
        $('#payment_type_modal').text(response.payment_mode);
        $('.cgst_modal').html('Rs. ' + response.cgst);
        $('.sgst_modal').html('Rs. ' + response.sgst);
        $('.igst_modal').html('Rs. ' + response.igst);
        $('#cgstrate').text(cgstRate + '%');
        $('#sgstrate').text(sgstRate + '%');
        $('#monthlyEmi').text(response.emi);
        $('.address').text(response.address);
        $('#imageLogo').attr('src', response.image);
        $('#invoiceModal').modal('show');

    }

    function generateInvoiceNumber() {
        const currentDate = new Date();
        const day = currentDate.getDate();
        const month = currentDate.getMonth() + 1;
        const year = currentDate.getFullYear();
        const formattedDate = `${day < 10 ? '0' : ''}${day}/${month < 10 ? '0' : ''}${month}/${year}`;
        const randomNumber = Math.floor(Math.random() * 100);
        const invoice_no = `IN ${formattedDate} ${randomNumber}`;
        return invoice_no;
    }

    $(document).on('click', '.generate_voucher', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        // var url = 'https://example.com'; // Replace with your actual URL
        $.ajax({
            type: 'POST',
            url: '<?= base_url("agentinvoice/getInvoiceData") ?>',
            dataType: 'json',
            data: {
                id: id
            },
            success: function (data) {
                console.log(data);
                populateModal(data);

                // Generate the PDF from the modal content
                // Add your PDF generation logic here

            },
            error: function (xhr, status, error) {
                console.error("Error occurred during AJAX request:", error);
            }
        });
    });

    // Add this after your existing script
    $(document).ready(function () {
        $(document).on('click', '#downloadPdfBtn', function () {

            // Call a function to generate, save, and send the PDF
            generateSaveAndSendPdf();
        });
    });

    function generateSaveAndSendPdf() {
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
                    // timer.textContent = `${Swal.getTimerLeft()}`;
                }, 100);
            },
            willClose: () => {
                clearInterval(timerInterval);
            }
        });

        // Get the HTML content of the modal
        var modalContent = $('#invoiceModal .modal-body').html();
        var email = $('#email').text();

        // Send the HTML content to the server to generate, save, and send PDF
        $.ajax({
            type: 'POST',
            url: '<?= base_url("agentinvoice/savePdf") ?>',
            data: {
                htmlContent: modalContent,
                email: email,
            },
            success: function (response) {
                console.log(response);
                // Handle the success response
                // alert('PDF saved successfully and email sent at path:', response.pdf_path);
                Swal.fire({
                    icon: 'success',
                    title: 'Email Sent To Agent',
                    // text: 'Email sent at path: ' + response.pdf_path,
                });
            },
            error: function (xhr, status, error) {
                console.error('Failed to generate, save, and send PDF:', status, error);

                // Log additional details
                console.log(xhr.responseText);

                // Show an alert with the error details
                // alert('Error: Failed to generate, save, and send PDF. Check the console for details.');
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to generate, save, and send PDF. Check the console for details.',
                });
            }
        });
    }

    function getBase64Image(imgSrc) {
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        var img = new Image();
        img.src = imgSrc;
        ctx.drawImage(img, 0, 0);
        var dataURL = canvas.toDataURL('image/png');
        return dataURL;
    }

    function sendingEmail() {
        // Add your logic for sending email here
        // You may want to make another AJAX request to your CodeIgniter controller
        // to trigger the email sending process on the server side
        $.ajax({
            type: 'POST',
            url: '<?= base_url("agentinvoice/sendEmail") ?>',
            data: {
                // Include any additional data needed for sending the email
            },
            success: function (response) {
                // Handle the success response
                alert('Email sent successfully');
            },
            error: function (xhr, status, error) {
                console.error('Failed to send email:', status, error);
            }
        });
    }

    function convertToWords(amount) {
        const ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
        const teens = ['', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
        const tens = ['', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

        function convertCrores(num) {
            if (num >= 10000000) {
                return convertHundreds(Math.floor(num / 10000000)) + ' Crore ' + convertLakhs(num % 10000000);
            } else {
                return convertLakhs(num);
            }
        }

        function convertLakhs(num) {
            if (num >= 100000) {
                return convertHundreds(Math.floor(num / 100000)) + ' Lakh ' + convertThousands(num % 100000);
            } else {
                return convertThousands(num);
            }
        }

        function convertThousands(num) {
            if (num >= 1000) {
                return convertHundreds(Math.floor(num / 1000)) + ' Thousand ' + convertHundreds(num % 1000);
            } else {
                return convertHundreds(num);
            }
        }

        function convertHundreds(num) {
            if (num > 99) {
                return ones[Math.floor(num / 100)] + ' Hundred ' + convertTens(num % 100);
            } else {
                return convertTens(num);
            }
        }

        function convertTens(num) {
            if (num < 10) return ones[num];
            else if (num >= 11 && num <= 19) return teens[num - 10];
            else {
                return tens[Math.floor(num / 10)] + ' ' + ones[num % 10];
            }
        }

        if (amount === 0) return 'Zero';

        const parts = amount.toFixed(2).toString().split('.');
        const crores = parseInt(parts[0], 10);
        const lakhs = parseInt(parts[1], 10);

        let words = '';
        if (crores > 0) {
            words += convertCrores(crores);
        }

        if (lakhs > 0) {
            if (crores > 0) words += ' and';
            words += ' ' + convertLakhs(lakhs);
        }
        words += ' Only';
        return words;
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<?= $this->endSection() ?>