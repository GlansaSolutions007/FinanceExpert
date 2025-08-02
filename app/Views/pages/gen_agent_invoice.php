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
                               <select class="form-control select2"  onchange="getAgentName()" id ="heard">
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
                           <input type="date" class="form-control" name="fromDate", id="fromDate">
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="m-2">
                            <label>Agent Name</label>
                           <input class="form-control rounded" class="form-control" name="agent_name" id="agent_name" placeholder="" type="text" readonly required />
                            <input type="email" name="email" id="email" hidden>
                             <input type="hidden" name="address" class="address" >
                            
                           <input type="hidden" id="agentGstNo">
                           <input type="hidden" id="alreadyPaid">
                           <input type="hidden" id="emi">
                           <input type='hidden' id="paymentMode">
                           <input type='hidden' id="payableAmount">
                           <input type='hidden' id="fileName">
                            
                        </div>
                        <div class="m-2">
                            <label class="h6">To Date</label>
                            <input type="date" class="form-control" name="toDate", id="toDate">
                        </div>
                        
                    </div>
                    
                       <div class="m-2 d-flex justify-content-center">
                           
                        <button class="btn btn-primary" id="addSubagentButton" data-target="#subagentModal" data-toggle="modal" onclick="addSubAgent()">GO</button>
                    </div>
                </div>

           
        </div>
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
                    
                </form>
               
                 <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                           <div class="card-box table-responsive" id="table">
                                 <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Sno.</th>
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
        th, td {
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
    </style>


<div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
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
                    <table class="table" border="1">
                       <tr>
            <td colspan="5" rowspan="2">
                <h4 class="agentName"> </h4>
                <!--<p> Company's GSTIN/UIN:</p>-->
               <b>GST Number:</b>
               <p id="gst_modal"></p>
                <p><b>Address:</b></p><p class="address"></p>
            </td>
            <td>
                Invoice No. 
                <p id="invoice"></p>
            </td>
            <td>
                Date 
                <p id="date_modal"></p>
                <p id ="email" ></p>
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
              <h4> FIN EXPERTS</h4>
              6-3-661/B/2, Plot No 78, 2nd, SANGEETH NAGAR <br>
              SOMAJIGUDA,HADRABAD <br>
              GSTIN/UIN  : 36AAGFF3638R1ZT <br>
              <!--PAN/IT No  :                 <br>-->
              State Name : Telangana, Code:36
            </td>
           
            <td colspan="3">  Terms of Delivery </td>
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
            <td style="border-bottom:none;border-top:none;">1 </td>
            <td  colspan="4">Commission</td>
            <td style="border-bottom:none;border-top:none;"> </td>
            <td id="paymentamount">  </td>
        </tr>
        <tr class="cgstamount">
            <td style="border-bottom:none;border-top:none;">2</td>
            <td  colspan="4">CGST</td>
            <td style="border-bottom:none;border-top:none;"> </td>
            <td class="cgst_modal">  </td>
        </tr>
        <tr class="sgstamount">
            <td style="border-bottom:none;border-top:none;">3</td>
            <td  colspan="4">SGST</td>
            <td style="border-bottom:none;border-top:none;"> </td>
            <td class="sgst_modal">  </td>
        </tr>
        <tr class="igstamount">
            <td style="border-bottom:none;border-top:none;">3</td>
            <td  colspan="4">IGST</td>
            <td style="border-bottom:none;border-top:none;"> </td>
            <td class="igst_modal">  </td>
        </tr>
        <!--<tr>-->
        <!--    <td style="border-bottom:none;border-top:none;">4</td>-->
        <!--    <td  colspan="4">Already Paid</td>-->
        <!--    <td style="border-bottom:none;border-top:none;"> </td>-->
        <!--    <td id="paymentdeduction">  </td>-->
        <!--</tr>-->
        <!--<tr>-->
        <!--    <td style="border-bottom:none;border-top:none;">5</td>-->
        <!--    <td  colspan="4">EMI</td>-->
        <!--    <td style="border-bottom:none;border-top:none;"> </td>-->
        <!--    <td id="monthlyEmi">  </td>-->
        <!--</tr>-->
        <tr>
            <td style="border-bottom:none;border-top:none;" > </td>
            <td colspan="4" style="text-align: right;" >Total</td>
            <td> </td>
            <td id="total_amount"> </td>
        </tr>
        <tr>
           <td colspan="7">
            Amount Chargeable (in words)
            <b><p id="word"></b> </p>
           </td>
        </tr>
        <tr>
            <td rowspan="2"> HSN/SAC</td>
            <td rowspan="2"> Taxable <br> Value</td>
            <td colspan="2"> Central Tax</td>
            <td colspan="2"> State Tax</td>
            <td rowspan="2"> Total <br>
                              Tax Amount   </td>
        </tr>
        <tr>
            <td>Rate</td>
            <td>Amount</td>
            <td>Rate</td>
            <td>Amount</td>
        </tr>
        <tr>
            <td >  </td>
            <td id=""> </td>
            <td id ="cgstrate"></td>
            <td class ="cgst_modal"></td>
            <td id="sgstrate"></td>
            <td class ="sgst_modal"></td>
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
                Authorised Signature
            </td>
        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button  class="btn btn-primary"  id="downloadPdfBtn">Download and Send Mail</button>
                </div>
            </div>
        </div>
    </div>


<!--SubAgent Model-->

<div id="subagentModal" class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="x_content">
                        <form class=""  method="POST">
                            
                            <span class="section">Generate Invoice</span>
                            <div class="row">
                                <div class="col-3 text-center" id="SubAgentName" >
                                    <h2>Agent Name</h2>
                                </div>
                                <div class="col-3" id="SubAgentTextField" >
                                    <h2>Gross Payout</h2>
                                </div>
                                <div class="col-3" id="tds" style="border-right:1px solid gray;">
                                    <h2>TDS</h2>
                                </div>
                                 <div class="col-3" id="Total">
                                    <h2>Net Payment</h2>
                                </div>
                                <!--<div class="col-2" id="AmountTobePaid">-->
                                <!--    <h2 >Payable</h2>-->
                                <!--    <hr>-->
                                <!--    <input style="margin-top:36px;" type="text" id="payable" class="form-control">-->
                                <!--</div>-->
                            </div>
                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-10 offset-md-3 mt-3">
                                        <button type='submit' class="btn btn-primary" data-dismiss="modal" id="generateInvoice">Generate</button>
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
        .invoice-details th, .invoice-details td {
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


// document.getElementById('fromDate').addEventListener('change', function() {
//         validateDateRange();
//     });

    document.getElementById('toDate').addEventListener('change', function() {
        validateDateRange();
    });

    function validateDateRange() {
        var fromDate = document.getElementById('fromDate').value;
        var toDate = document.getElementById('toDate').value;

        // Check if fromDate is greater than toDate
        if (fromDate > toDate) {
            alert('From Date cannot be greater than To Date');
            // You can reset the input value or take other actions as needed
            document.getElementById('fromDate').value = '';
        }
    }


</script>


<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->

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
        type:'POST',
        url:'<?= base_url('agentinvoice/comparedate')?>',
        dataType:'json',
        data: {agentname : userId, fromdate : fromdate, todate:todate},
        success: function(response){
            console.log(response);
            agentDetails = response.payment_data;
            subagentDetails = response.sub_agent_data;
             var initialAgentTotal = response.payment_data[0].payment_amount;
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
                GrossPayoutBox.className = "form-control mt-1 agentTotal";
                GrossPayoutBox.value = agentGross;
                GrossPayoutBox.setAttribute("id", "agentTotal"+ i);
                initialAgentTotal = response.payment_data[i].payment_amount
                document.getElementById("SubAgentTextField").appendChild(GrossPayoutBox);
                
                // TDS display
                
                var TdsBox = document.createElement("input");
                TdsBox.type = "text";
                TdsBox.className = "form-control mt-1 AgentTds";
                TdsBox.value = (response.payment_data[i].payment_amount * (5/100)).toFixed(2);
                document.getElementById("tds").appendChild(TdsBox);
                
                // Net Payment Display
                
                var NetPaymentBox = document.createElement("input");
                NetPaymentBox.type = "text";
                NetPaymentBox.className = "form-control mt-1 agentNetPayment";
                NetPaymentBox.value  =(response.payment_data[i].payment_amount * (95/100)).toFixed(2);
                document.getElementById("Total").appendChild(NetPaymentBox); 
            }
            
            
            
            
            if(response.sub_agent_data.length > 0){
                for(var j = 0; j < response.sub_agent_data.length; j++){
                
                var h3 = document.createElement("h6");
                var lineBreak = document.createElement("br");
                h3.textContent = response.sub_agent_data[j].name;
                document.getElementById("SubAgentName").appendChild(h3);
                document.getElementById("SubAgentName").appendChild(lineBreak);
                
                
                var GrossPayoutBox = document.createElement("input");
                GrossPayoutBox.type = "text";
                GrossPayoutBox.className = "form-control mt-2 subagentTotal";
                GrossPayoutBox.setAttribute("id", "subagentTotal"+ j);
                // GrossPayoutBox.value = response.sub_agent_data[j].payment_amount;
                document.getElementById("SubAgentTextField").appendChild(GrossPayoutBox);
                
                
                var TdsBox = document.createElement("input");
                TdsBox.type = "text";
                TdsBox.className = "form-control mt-2 subagentTds";
                TdsBox.setAttribute("id", "subagentTds"+ j);
                // TdsBox.value = (response.payment_data[i].payment_amount * (5/100)).toFixed(2);
                document.getElementById("tds").appendChild(TdsBox);
                
                // Net Payment Display
                
                var NetPaymentBox = document.createElement("input");
                NetPaymentBox.type = "text";
                NetPaymentBox.className = "form-control mt-2 subagentNetPayment";
                NetPaymentBox.setAttribute("id", "subagentNetPayment"+ j)
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
        
            }
        
        

        },
        
    });

    
    
}



</script>

<script>
    $(document).ready(function(){
        new DataTable('#datatable');
    })
</script>

<script>
$(document).on('click', '#generateInvoice', function(e) {
    e.preventDefault();
    // agentDetails = response;
    var agentData = [];
    if(agentDetails){
        for (var i = 0; i < agentDetails.length; i++) {
            var agent = agentDetails[i];
             
            var agentgst_no = agentDetails[i].gst_no;
            var agentName = agentDetails[i].agent_name;
            var agent_id = agentDetails[i].agent_id;
            var currentYear = new Date().getFullYear();
            var currentMonth = new Date().getMonth();
            var random = parseInt(Math.random()*100);
            var fileName = agentName+currentMonth+currentYear+random;
            var agentgrossPayout = parseInt($('#agentTotal' + i).val());
            var agentinvoice_no = generateInvoiceNumber();
            var email = $('#email').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            var agentTds = (agentgrossPayout * (5/100)).toFixed(2);
            
            var agentNetPayment = agentgrossPayout - (agentgrossPayout * (5/100)).toFixed(2);
            var agentigst = (agentgrossPayout * (18/100)).toFixed(2);
            var agentcgst = (agentigst / 2);
            var agentsgst = agentigst / 2;
            var paymentType = agentDetails[i].transaction_type;
            var address = $('.address').val();
            var agentCommision = agentNetPayment ;
            var totalAmount = agentNetPayment + agentcgst + agentsgst;
            var date = new Date().toLocaleDateString();
            
            var agentDataEntry = {
                agentName: agentName,
                agent_id: agent_id,
                email:email,
                tds: agentTds,
                fileName:fileName,
                netPayment: agentNetPayment,
                invoice_no: agentinvoice_no,
                gst_no: agentgst_no,
                date: date,
                address:address,
                payment_mode: paymentType,
                grossPayout: agentgrossPayout,
                payableAmount:agentgrossPayout,
                cgst: agentcgst,
                sgst: agentsgst,
                igst: agentigst,
                fromdate: fromDate,
                todate: toDate,
                commision: agentCommision
            };
            agentData.push(agentDataEntry);
        }
    }
    
    
    
    if (subagentDetails.length > 0) {
        // console.log(subagentDetails.length);
    for (var j = 0; j < subagentDetails.length; j++) {
        var subagentGstNo = subagentDetails[j].gst_no;
        var subagentName = subagentDetails[j].name;
        var currentYear = new Date().getFullYear();
        var currentMonth = new Date().getMonth();
        var random = parseInt(Math.random()*100);
        var fileName = subagentName+currentMonth+currentYear+random;
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
        
        if(subagentGross > 0){
            var subagentDataEntry = {
            agentName: subagentName,
            agent_id: $('#heard').val(),
            email: email,
            tds: subagentTds,
            fileName:fileName,
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
            commision: subagentNetPayment
        };
        agentData.push(subagentDataEntry);
        }
    // console.log("hiiii");
        
    }
}

    
    
    var postData = {
        subagentData: agentData
    };
    
   
getInvoiceDetails(agent_id, fromDate, toDate, function(existingData) {
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
            url: '<?= base_url('agentinvoice/insertInvoice') ?>',
            data: { data: postData }, // Send the gathered data
            dataType: 'json',
            success: function(response) {
                // console.log(response,"====");
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
            error: function(xhr, status, error) {
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
    tableBody.empty(); // Clear the existing table content
    
    if(data && Object.keys(data).length > 2 && Object.prototype.toString.call(data) === '[object Object]'){
         var newRow = $('<tr>');
        // console.log(row);
        newRow.append('<td>' + 1 + '</td>');
        newRow.append('<td hidden>' + data.id + '</td>');
        newRow.append('<td hidden>' + data.email + '</td>');
        newRow.append('<td>' + data.agent_id + '</td>');
        newRow.append('<td>' + (data.agent_id == ''? (data.agentName)+(" ( " + "Sub Agent" + " ) "): data.agentName) + '</td>');
        newRow.append('<td>' + data.grossPayout + '</td>');
        newRow.append('<td>' + data.tds + '</td>');
         newRow.append('<td>' + data.commision + '</td>');
        newRow.append('<td>' + data.netPayment + '</td>');
        // newRow.append('<td>' + (data.alreadyPaid !== undefined ? data.alreadyPaid : 0) + '</td>');
        // newRow.append('<td>' + (data.emi !== undefined ? data.emi : 0) + '</td>');
       
        newRow.append('<td><input type="hidden" class="form-control" name="modeldatainfo", id="modeldatainfo"><button class="btn btn-success generate_voucher" data-id="' + data.id + '" data-toggle="modal" data-target="#invoiceModal">Generate Invoice</button></td>');

        tableBody.append(newRow);
    }else{
        $.each(data, function(index, row) {
            // console.log(data);
        var newRow = $('<tr>');
        // console.log(row.id);
        newRow.append('<td>' + (index + 1) + '</td>');
        newRow.append('<td hidden>' + row.id + '</td>');
        newRow.append('<td hidden>' + row.email + '</td>');
        newRow.append('<td>' + row.agent_id + '</td>');
        newRow.append('<td>' + (row.agent_id == ''? (row.agentName)+(" ( " + "Sub Agent" + " ) "): row.agentName) + '</td>');
        newRow.append('<td>' + row.grossPayout + '</td>');
        newRow.append('<td>' + row.tds + '</td>');
        newRow.append('<td>' + row.netPayment + '</td>');
        newRow.append('<td>' + row.netPayment + '</td>');
        // newRow.append('<td>' + (row.alreadyPaid !== undefined ? row.alreadyPaid : 0) + '</td>');
        // newRow.append('<td>' + (row.emi !== undefined ? row.emi : 0) + '</td>');
        
        
        newRow.append('<td><input type="hidden" class="form-control" name="modeldatainfo", id="modeldatainfo"><button class="btn btn-success generate_voucher" data-id="' + row.id + '" data-toggle="modal" data-target="#invoiceModal">Generate Invoice</button></td>');

        tableBody.append(newRow);
    });
    }

    

    if (data.length === 0) {
        var newRow = $('<tr>').html('<td colspan="7">No data available.</td>');
        tableBody.append(newRow);
    }
}

// // Modify your getInvoiceDetails function to accept a callback function
function getInvoiceDetails(agentId, fromDate, toDate,  callback) {
    $.ajax({
        type: 'POST',
        url: '<?= base_url('agentinvoice/checkDataExists') ?>',
        dataType: 'json',
        data: {
            agentId: agentId,
            fromDate: fromDate,
            toDate: toDate,
            // email:email,
        },
        success: function(response) {
            if (response.dataExists) {
                callback(response.existingData); // Pass the existing data to the callback
            } else {
                callback(null); // Data doesn't exist, pass null to the callback
            }
        },
        error: function(xhr, status, error) {
            console.error("Error occurred during AJAX request:", error);
            callback(null); // Error occurred, pass null to the callback
        }
    });
}

// Your populateModal function remains the same

// Your insertData function remains the same




    
    
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
    
    if(response.gst_no.substring(0,2)!= '36') {
        $('.cgstamount').hide();
        $('.sgstamount').hide();
        $('.igstamount').show();
    }
    if(response.gst_no.substring(0,2)== '36'){
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
    $('#total_amount').text(total);
    $('#paymentamount').text(commission);
    $('#paymentdeduction').text(response.alreadyPaid);
    $('#payment_type_modal').text(response.payment_mode);
    $('.cgst_modal').text(response.cgst);
    $('.sgst_modal').text(response.sgst);
    $('.igst_modal').text(response.igst);
    $('#cgstrate').text(cgstRate + '%');
    $('#sgstrate').text(sgstRate + '%');
    $('#monthlyEmi').text(response.emi);
    $('.address').text(response.address);
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

// $(document).on('click', '.generate_voucher', function(e) {
//     e.preventDefault();
//     // console.log("HIIIIIIII");
//     var id = $(this).data('id');
//     // console.log(id);
//     $.ajax({
//         type: 'POST',
//         url: '<?= base_url('agentinvoice/getInvoiceData') ?>',
//         dataType: 'json',
//         data: {
//             id: id
//         },
//         success: function(response) {
//             // console.log(response);
//             populateModal(response);
            
//              var agentName = response.agentName;
//              var email = response.email;
             
//              var agentinvoice_no = response.agentinvoice_no;

//             const element = document.querySelector('.modal-body');
        
//             const filename = `invoice_${agent_name}.pdf`;

//         // Create an options object for html2pdf.js
//         const options = {
//             margin: 10,
//             filename: 'invoice.pdf',
//             image: { type: 'jpeg', quality: 0.98 },
//             html2canvas: { scale: 2 },
//             jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
//         };
//             // downloadPdf(agentName)
//             // Send the email details to the server for email sending
//             // sendEmailToAgent(agentName, email, agentinvoice_no);
            
//         },
//         error: function(xhr, status, error) {
//             console.error("Error occurred during AJAX request:", error);
//         }
//     });
// //  });
// });
$(document).on('click', '.generate_voucher', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        type: 'POST',
        url: '<?= base_url('agentinvoice/getInvoiceData') ?>',
        dataType: 'json',
        data: {
            id: id
        },
        success: function (response) {
            console.log(response);
            populateModal(response);
            var agentName = response.agentName;
            $('#fileName').val(response.fileName);

            // Find the modal body element
            var element = document.querySelector('.modal-body');
          //  var element = $('.modal-body').text();
// console.log(element);
            // Ensure the page height is set to fit a single A4 page
            const pageHeight = 297; // 297 mm is the height of an A4 page

            // Create an options object for html2pdf.js
            const options = {
                margin: 10,
                filename: `invoice_${agentName}.pdf`,
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait',
                    pageHeight: pageHeight,
                    pagebreak: { mode: 'css', before: '.page-break' }
                }
            };

            // Generate the PDF from the modal content
            html2pdf().from(element).set(options).outputPdf().then(function (pdfArrayBuffer) {
                if (pdfArrayBuffer) {
                    //console.log("pdfarray")
                    //console.log(pdfArrayBuffer);
                    // Convert ArrayBuffer to Blob
                    const pdfBlob = new Blob([pdfArrayBuffer], { type: 'application/pdf' });
 // console.log("pdfBlob");
 // console.log(pdfBlob);
                    const currentMonth = new Date().getTime();
                    const currentYear = new Date().getFullYear();
                    const random = parseInt(Math.random()*100);
                    const fileName = `${response.fileName}.pdf`;

                    // Create FormData and append the PDF Blob with the constructed filename
                    const formData = new FormData();
                    //formData.append('pdf_file', pdfBlob, fileName);
                    //formData.append('pdf_file', element);
                    $("#modeldatainfo").val(element.innerHTML);
                    // console.log($("#modeldatainfo").val());
                    formData.append('pdf_file', $("#modeldatainfo").val());
                    formData.append('agent_name',fileName);
                    // Use fetch or other AJAX methods to send the PDF to the server
                    fetch('<?= base_url('agentinvoice/savePdf') ?>', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert('PDF generated and saved successfully.' + data.message);
                        } else {
                            alert('PDF generation failed: ' + data.message);
                        }
                    })
                    // .catch(error => {
                    //     console.error('Error while saving PDF:', error);
                    // });
                } else {
                    console.error('PDF data is empty.');
                }
            }).catch(function (error) {
                console.error('Error generating PDF:', error);
            });
        },
        error: function (xhr, status, error) {
            console.error("Error occurred during AJAX request:", error);
        }
    });
});



</script>

<script>
    // Function to download the PDF
    function downloadPdf(agent_name) {
        // Select the target element (the modal content) to be converted to PDF
        const element = document.querySelector('.modal-body');
        const currentMonth = new Date().getMonth();
        const currentYear = new Date().getFullYear();
        const agentName = $('#agent_name').val();
        console.log(agentName);
        const agentEmail = $('#email').val();
        const random = parseInt(Math.random()*100);
        var file = $('#fileName').val();
        const fileName = `${file}.pdf`;

        // Create an options object for html2pdf.js
        const options = {
            margin: 10,
            filename: fileName,
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        // Use html2pdf.js to generate the PDF
        sendEmailWithAgentName(fileName,agentEmail);
        html2pdf().from(element).set(options).save();
        
        
    }
  const agentName = "agent_name";
    // Call the downloadPdf function when the "Download" button is clicked
    document.getElementById('downloadPdfBtn').addEventListener('click', downloadPdf);
    downloadPdf(agent_name);
    
</script>
<script>
//  document.getElementById('downloadPdfBtn').addEventListener('click', function () {
//             var agentName = document.getElementById('agent_name').value;
//             var email = document.getElementById('email').value;
//             const element = document.querySelector('.modal-body');
            
//             const options = {
//                 margin: 10,
//                 filename: `invoice_${agentName}.pdf`,
//                 image: { type: 'jpeg', quality: 0.98 },
//                 html2canvas: { scale: 2 },
//                 jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
//             };

//             // Generate the PDF
//             html2pdf().from(element).set(options).outputPdf().then(function (pdfArrayBuffer) {
//                 if (pdfArrayBuffer) {
//                     // Convert ArrayBuffer to Blob
//                     const pdfBlob = new Blob([pdfArrayBuffer], { type: 'application/pdf' });

//                     // Create a FormData object to send the PDF to the server
//                     const formData = new FormData();
//                     formData.append('agent_name', agentName);
//                     formData.append('email', email);
//                     formData.append('pdf_file', pdfBlob, `invoice_${agentName}.pdf`);

//                     // Send the PDF to the server using AJAX
//                     var xhr = new XMLHttpRequest();
//                     xhr.open('POST', 'savePdf', true); // Replace with the correct URL
//                     xhr.onreadystatechange = function () {
//                         if (xhr.readyState === XMLHttpRequest.DONE) {
//                             if (xhr.status === 200) {
//                                 var response = JSON.parse(xhr.responseText);
//                                 if (response.status === 'success') {
//                                     // PDF generated and saved successfully
//                                     alert('PDF generated and saved successfully.');
//                                 } else {
//                                     alert('PDF generation failed: ' + response.message);
//                                 }
//                             } else {
//                                 alert('Request failed with status: ' + xhr.status);
//                             }
//                         }
//                     };

//                     // Send POST data
//                     xhr.send(formData);
//                 } else {
//                     console.error('PDF data is empty.');
//                 }
//             }).catch(function (error) {
//                 console.error('Error generating PDF:', error);
//             });
//         });
// document.addEventListener('DOMContentLoaded', function() {
//     document.getElementById('downloadPdfBtn').addEventListener('click', function() {
//         // Get the modal body content
//         var modalBody = document.querySelector('.modal-body');

//         // Generate the PDF from the modal body content
//         html2pdf()
//             .from(modalBody)
//             .set({ margin: 10, filename: 'invoice.pdf', image: { type: 'jpeg', quality: 0.98 }, html2canvas: { scale: 2 }, jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' } })
//             .outputPdf()
//             .then(function(pdf) {
//                 // Convert the PDF data to a Blob
//                 var blob = new Blob([pdf], { type: 'application/pdf' });

//                 // Create a FormData object to send the Blob to the server
//                 var formData = new FormData();
//                 formData.append('pdf', blob);

//                 // Send an AJAX request to the server to save the PDF
//                 var xhr = new XMLHttpRequest();
//                 xhr.open('POST', '/savePdf', true); // Replace with the correct URL for your server-side handling
//                 xhr.onreadystatechange = function() {
//                     if (xhr.readyState === XMLHttpRequest.DONE) {
//                         if (xhr.status === 200) {
//                             // PDF saved successfully on the server
//                             // You can add a success message or redirection here
//                         } else {
//                             alert('PDF saving failed: ' + xhr.statusText);
//                         }
//                     }
//                 };
//                 xhr.send(formData);
//             })
//             .catch(function(error) {
//                 console.error('Error generating PDF:', error);
//             });
//     });
// });


function sendEmailWithAgentName(agentName, email) {
    $.ajax({
        url: 'sendEmail', 
        method: 'POST',
        data: { agent_name: agentName, email: email },
        success: function(response) {
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}


function convertToWords(amount) {
    const ones = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
    const teens = ['', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
    const tens = ['', 'Ten', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

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

    function convertMillions(num) {
        if (num >= 1000000) {
            return convertHundreds(Math.floor(num / 1000000)) + ' Million ' + convertThousands(num % 1000000);
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

    if (amount === 0) return 'Zero';

    const parts = amount.toFixed(2).toString().split('.');
    const dollars = parseInt(parts[0], 10);
    const cents = parseInt(parts[1], 10);

    let words = '';
    if (dollars > 0) {
        words += convertMillions(dollars);
        words += ' Rupees';
    }

    if (cents > 0) {
        if (dollars > 0) words += ' and';
        words += ' ' + convertTens(cents) + ' Paise';
    }

    return words + ' Only';
}

    
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>


<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>-->
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--Assigning agent script start-->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/jquery/dist/jquery.min.js"></script>

    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap  -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <!-- FastClick   -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress   -->
    <script src="../vendors/nprogress/nprogress.js"></script>
      <!-- iCheck   -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
      <!-- Datatables   -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

      <!-- Custom Theme Scripts   -->
    <script src="../build/js/custom.min.js"></script>

<?= $this->endSection() ?>