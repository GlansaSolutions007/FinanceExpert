<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content') ?>
<h1>Generate Invoice and Payment Voucher</h1>


<!------ Include the above in your HEAD tag ---------->



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
                                ?>
                                        
                                        <option><?= $agent['agent_id']; ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="m-2">
                            <label>Agent Name</label>
                           <input class="form-control rounded"  name="agent_name" id="agent_name" placeholder="" type="text" />
                        </div>

                         <div class="m-2">
                            <label>Date</label>
                            <select class="form-control select2" id ="transaction_date_select" onchange="getCommissionAmount()">
                                <option>Select Transaction Date</option>
                            </select>
                        </div>

                        <!--<div class="m-2">-->
                        <!--    <label class="h6">Invoice No.</label>-->
                        <!--    <input class="form-control rounded" name="invoice-no" required='required' placeholder="Enter Invoice No" type="text">-->
                        <!--</div>-->
                        <div class="m-2">
                            <label class="h6">Address</label>
                            <textarea class="form-control rounded" name='address' id="address" placeholder="Enter Address" type="text-area">FIN EXPERTS
6-3-661/B/2, Plot No 78, 2nd, SANGEETH NAGAR SOMAJIIGUDA, HYDERABAD
GSTIN/UIN  : 36AAGFF3638R1ZT
PAN/IT NO  : 
State Name : Telangana, Code : 36
                            </textarea>
                        </div>
                        <div class="m-2">
                            <label class="h6">GSTIN/UIN</label>
                            <input class="form-control rounded" data-validate-length-range="6" data-validate-words="2" name="gst" id="gst" placeholder="" type="text" />
                        </div>
                        <div class="m-2">
                            <label class="h6">Mode/Terms of Payment</label>
                            <input class="form-control rounded" data-validate-length-range="6" data-validate-words="2" name="terms" id="payment_type" placeholder="Mode/Terms of Payment" type="text" />
                        </div>
                        <div class="m-2">
                            <label class="h6">Destination</label>
                            <input class="form-control rounded" data-validate-length-range="6" data-validate-words="2" name="despatched-through" placeholder="Enter Dispatched Through"  type="text" />
                        </div>
                        <!--<div class="m-2">-->
                        <!--    <label class="h6">Delivery Note</label>-->
                        <!--    <input class="form-control rounded" data-validate-length-range="6" data-validate-words="2" name="delivery-note" id="remarks" placeholder="Enter Delivery Note" required="required" type="text" />-->
                        <!--</div>-->
                        <!--<div class="m-2">-->
                        <!--    <label class="h6">Delivery Note Date</label>-->
                        <!--    <input class="form-control rounded" data-validate-length-range="6" data-validate-words="2" name="delivery-note-date" placeholder="Enter Delivery Note Date"  type="date" />-->
                        <!--</div>-->
                        <!--<div class="m-2">-->
                        <!--    <label class="h6">Dispatched Through</label>-->
                        <!--    <input class="form-control rounded" data-validate-length-range="6" data-validate-words="2" name="despatched-through" placeholder="Enter Dispatched Through"  type="text" />-->
                        <!--</div>-->
                    </div>
                    <div class="col-md-6">

                        
                        <div class="m-2">
                            <label class="h6">Terms of Delivery</label>
                            <textarea class="form-control rounded" name='address' placeholder="Enter Address" type="text-area"></textarea>
                        </div>
                        <div class="m-2">
                            <label class="h6">Commission Amount</label>
                            <input class="form-control rounded" data-validate-length-range="6" data-validate-words="2" id="commission-amount" name="commission-amount" placeholder="Enter Commission Amount" required="required" type="number" />
                        </div>
                        <div class="m-2">
                            <label class="h6">CGST</label>
                            <input class="form-control rounded" data-validate-length-range="6" data-validate-words="2" value="" id="cgst" name="cgst" placeholder="Enter CGST" required="required" type="number" />
                        </div>
                        <div class="m-2">
                            <label class="h6">SGST</label>
                            <input class="form-control rounded" data-validate-length-range="6" data-validate-words="2" id="sgst" name="sgst" placeholder="Enter SGST" required="required" type="number" />
                        </div>
                        <div class="m-2">
                            <label class="h6">IGST</label>
                            <input class="form-control rounded" data-validate-length-range="6" data-validate-words="2" id="igst" name="igst" placeholder="Enter IGST"  type="number" />
                        </div>
                        <div class="m-2">
                            <label class="h6">Total Amount</label>
                            <input class="form-control rounded" data-validate-length-range="6" data-validate-words="2" id="total_amt" name="total-amount" placeholder="Enter Total Amount" required="required" type="number" />
                        </div>
                        
                        <div class="m-2">
                            <label class="h6">Tax Amount (in words)</label>
                            <input class="form-control rounded" data-validate-length-range="6" data-validate-words="2" name="total-amount" placeholder="Enter Tax Amount (in words)"  type="text" />
                        </div>

                    </div>


                    <div class="m-2 d-flex justify-content-evenly">
                        <button type='submit' class="btn btn-outline-success" data-toggle="modal" data-target="#invoiceModal" onclick="generatePDF()">Download</button>
                        <button type='reset' class="btn btn-outline-danger">Reset</button>
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
                    <table class="table">
                       <tr>
            <td colspan="5" rowspan="2">
                <h4> VARK FINTECH PRIVATE LIMITED</h4>
                <P> Company's GSTIN/UIN:</P> <p id="gst_modal"></p>
            </td>
            <td>
                Invoice No. 
                <h4 id="invoice"></h4>
            </td>
            <td>
                Date 
                <p id="date_modal"></p>
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
              PAN/IT No  :                 <br>
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
            <td style="height: 300px;"> </td>
            <td style="height: 300px;" colspan="4"></td>
            <td style="height: 300px;"> </td>
            <td style="height: 300px;">  </td>
        </tr>
        <tr>
            <td> </td>
            <td colspan="4" style="text-align: right;" id="total_amount">Total</td>
            <td> </td>
            <td> </td>
        </tr>
        <tr>
           <td colspan="7">
            Amount Chargeable (in words)
            <h5 id="word"> </h5>
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
            <td> </td>
            <td></td>
            <td id ="cgst_modal"></td>
            <td></td>
            <td></td>
            <td id ="sgst_modal"></td>
        </tr>
        <tr>
            <td style="height: 300px;" colspan="7">

                Tax Amount (in word) : Indian Rupees Ninety Thousand Only 
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
                for VARK FINTECH PRIVATE LIMITED
                <br> <br>
                Authorised Signatory
            </td>
        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script>
    // $('.select2').select2();
</script>
<script>
    
      function getAgentName() {
    var selectedAgentID = document.getElementById('heard').value;
    if (selectedAgentID !== '') {
        // Make an AJAX call to the server to retrieve agent details and transaction dates
        $.ajax({
            type: 'GET',
            url: '<?= base_url("generateinvoicecontroller/getAgentData/"); ?>' + selectedAgentID,
            success: function (response) {
                // Update the agent details fields
                document.getElementById("agent_name").value = response.agent_name;
                document.getElementById("gst").value = response.gst_no;
                document.getElementById("payment_type").value = response.transaction_type;

                // Clear the existing options
                $('#transaction_date_select').empty();

                // Populate the options in the transaction date dropdown
                if (response.transaction_dates.length > 0) {
                    $.each(response.transaction_dates, function (index, value) {
                        $('#transaction_date_select').append('<option value="' + value + '">' + value + '</option>');
                    });
                } else {
                    $('#transaction_date_select').append('<option>No transaction dates available</option>');
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText); // Debugging: Check the error in the browser console
            }
        });
    } else {
        document.getElementById("agent_name").value = '';
        document.getElementById("gst").value = '';
        document.getElementById("payment_type").value = '';
        $('#transaction_date_select').empty();
    }
}


function getCommissionAmount() {
    var selectedAgentID = document.getElementById('heard').value;
    var selectedTransactionDate = document.getElementById('transaction_date_select').value;
    console.log(selectedTransactionDate);
    var transact = document.getElementById("date");
    // var cgst = document.getElementById("cgst");
    // console.log("Attempting to get element with ID 'cgst'");
    // var cgstElement = document.getElementById("cgst");
    //     console.log(cgstElement);
        
    //     if (cgstElement) {
    //         console.log("Setting CGST value");
    //         cgstElement.value = cgst; // Update CGST input field
    //     } else {
    //         console.log("CGST element not found");
    //     }
    
    //             if (sgstElement) {
    //                 sgstElement.value = sgst; // Update CGST input field
    //             }
    document.getElementById('date').value = selectedTransactionDate;

    if (selectedAgentID !== '' && selectedTransactionDate !== '') {
        // Make an AJAX call to the server to retrieve the commission amount
        $.ajax({
            type: 'GET',
            url: '<?= base_url("generateinvoicecontroller/getCommissionAmount/"); ?>' + selectedAgentID + '/' + selectedTransactionDate,
            success: function (response) {
                console.log(response);
                // Update the commission amount field
                var commission_amount = parseFloat(response.payment_amount);
                var totalGst = parseFloat(commission_amount) * 0.18;
                var total_amt = commission_amount + totalGst
                var cgst = totalGst/2 ;
                var sgst = totalGst/2 ;
                console.log(totalGst);
                console.log(cgst);
                console.log(sgst);
                var cgstElement = document.getElementById("cgst");
                if (cgstElement) {
                    cgstElement.value = cgst; // Update CGST input field
                }
                
                var sgstElement = document.getElementById("sgst");
                if (sgstElement) {
                    sgstElement.value = sgst; // Update CGST input field
                }
                
                var totalamtElement = document.getElementById("total_amt");
                if (totalamtElement) {
                    totalamtElement.value = total_amt; // Update CGST input field
                }
                
                

                var total_amt = commission_amount + totalGst
                document.getElementById("commission-amount").value = response.payment_amount;
                document.getElementById("remarks").value = response.remark;
                // document.getElementById("cgst").value = cgst;
                // document.getElementById("sgst").value = sgst;
                // document.getElementById("total_amt").value = total_amt;
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText); // Debugging: Check the error in the browser console
            }
        });
    } else {
        // If either the agent ID or transaction date is not selected, reset the commission amount field
                document.getElementById("commission-amount").value = '';
                 document.getElementById("remarks").value = '';
                document.getElementById("cgst").value = '';
                document.getElementById("sgst").value ='';
                document.getElementById("total_amt").value='';
    }
}




</script>

<script>
function generateRandomInvoiceNumber() {
        const min = 1000; // minimum invoice number
        const max = 9999; // maximum invoice number
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function generatePDF() {
        // Fetch form data
        const invoice = document.getElementById('invoice').value;
         const date = document.getElementById('transaction_date_select').value;
        // const agentName = document.getElementById('agent_name').value;
        const address = document.getElementById('address').value;
        const gst = document.getElementById('gst').value;
        const cgst = document.getElementById('cgst').value;
        const igst = document.getElementById('igst').value;
        const sgst = document.getElementById('sgst').value;
        const paymentType = document.getElementById('payment_type').value;
        const commissionAmount = document.getElementById('commission-amount').value;
        const totalAmount = document.getElementById('total_amt').value;

        // Set the fetched data to the modal fields
        document.getElementById('invoice').textContent = invoice;
        document.getElementById('date_modal').textContent = date;
        document.getElementById('gst_modal').textContent = gst;
        document.getElementById('cgst_modal').textContent = cgst;
        document.getElementById('igst_modal').textContent = igst;
        document.getElementById('sgst_modal').textContent = sgst;
        document.getElementById('payment_type_modal').textContent = paymentType;
        // document.getElementById('dates').value = date;
        document.getElementById('amount').textContent = commissionAmount;
        document.getElementById('total_amount').textContent = totalAmount;

     document.getElementById('invoice').textContent = `Invoice No. ${invoice}`;
        // Open the invoice modal
        $('#invoiceModal').modal('show');
    }
</script>

<!-- Include jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>


<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<?= $this->endSection() ?>