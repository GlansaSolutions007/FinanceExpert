<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content') ?>

<!-- <div class="container-fluid"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <!-- Page Heading -->

    <div class="s" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Payment</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                        <!--<div class="input-group">-->
                        <!--    <input type="text" class="form-control" placeholder="Search for...">-->
                        <!--    <span class="input-group-btn">-->
                        <!--        <button class="btn btn-default" type="button">Go!</button>-->
                        <!--    </span>-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
                            <div class="row m-3">
                                 <div class="col-md-12">
                                <div class="container p-5 bg-white borderd col-sm-6 shadow rounded">
                                    <div class="container-fluid">
                                        <form action="<?php echo base_url().'paymentcontroller/insertPayment';?>" method="POST">
                                            
                                            <div class="col-md-6">
                                                
                                                <div class="m-2">
                                                        <label class="h6">From Date</label>
                                                        <input class="form-control rounded" name="fromdate"
                                              id="fromdate" type="date" >
                                                    </div>
                                                <div class="m-2">
                                                        <label class="h6">To Date</label>
                                                        <input class="form-control rounded"  name="todate"
                                              id="todate" type="date">
                                              <div id="dateError" class="text-danger font-weight-bold font-size-18"></div>
                                                    </div>
                                                    <div class="m-2">
                                                        <label class="h6">Agent ID<span class="text-danger">*</span></label>
                                                       
                                                        <select id="heard" class="form-control select2" onchange="getAgentName()" name="agent_id"
                                                            required>
                                                            <option value="">Choose Agent ID</option>
                                                            <?php if ($agent_id){ ?>
                                                                <?php foreach ($agent_id as $agent) { ?>
                                                                    <option value="<?= $agent['user_id'] ?>"><?= $agent['user_id'] ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="m-2">
                                                        <label class="h6">Agent Name</label>
                                                        <input class="form-control rounded" name="agent_name"
                                             required='required' id="agent_name" type="text" readonly>
                                                    </div>
                                                    
                                                     <div class="m-2">
                                                        <label class="h6">GST  PIN</label>
                                                        <input class="form-control rounded" name="gst_no"
                                             required='required' id="gst_no" type="text" readonly>
                                                    </div>
                                                    
                                                   
                                                        <input class="form-control rounded" name="voucher"
                                             required='required' id="voucher" type="hidden">
                                                   
                                                   <div class="m-2">
                                                        <label class="h6">Payment For<span class="text-danger">*</span></label>
                                                        <div class="d-flex justify-content-between">
                                                            <div class="form-check justif-content-center">
                                                            
                                                            <input type="radio" class="form-check-input paymentFor" id="mis" value="mis" name="payment_for" >
                                                            <label class="form-check-label mb-2" for="paymentFor1"> MIS</label>
                                                        </div>
                                                    
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input paymentFor" id="loan" value="loan" name="payment_for">
                                                            <label class="form-check-label" for="loan"> Loan</label>
                                                        </div>
                                                    
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input paymentFor" value="onspot" id="onspot" name="payment_for" required>
                                                            <label class="form-check-label" for="onspot"> On Spot</label>
                                                        </div>
                                                        </div>
                                                    </div>
                                                   
                                                    

                                                     </div>
                                                     <div class="col-md-6">
                                                    <div class="m-2">
                                                        <label class="h6">Transaction Date<span class="text-danger">*</span></label>
                                                        <input class="form-control rounded" name="date"
                                                         required='required' type="Date">
                                                         <input type="hidden" class="emiAmount" id="emiAmount" name="emiAmount">
                                                    </div>
                                                     <div class="m-2">
                                                        <label class="h6">Transaction Type<span class="text-danger">*</span></label>
                                                        <select class="form-control" name="transaction_type" required>
                                                            <option value="">Select Transaction Type</option>
                                                            <option value="phone_pay">Phone Pay</option>
                                                            <option value="google_pay">Google Pay</option>
                                                             <option value="Paytm">Paytm</option>
                                                            <option value="Cash">Cash</option>
                                                             <option value="Other">Other</option>
                                                            <!-- Add more options as needed -->
                                                        </select>
                                                    </div>
                                                    
                                                    
                                                    
                                                    <div class="m-2" id="otherTransactionDiv" style="display: none;">
                                                        <label class="h6">Other Transaction Details</label>
                                                        <input class="form-control rounded" name="other_transaction_details" placeholder="Enter Other Transaction Details" type="text">
                                                    </div>
                                                    
                                                    
                                                    
                                                    <div class="m-2">
                                                        <label class="h6">Payable Amount</label>
                                                        <input class="form-control rounded" id="payment_amount"  name="payment_amount" placeholder="Enter Amount" type="number" />
                                                    </div>
                                                    
                                                    
                                                     <div class="m-2">
                                                        <label class="h6">Transaction ID</label>
                                                        <input class="form-control rounded" name="transaction_id"
                                                         required='required' placeholder="Enter Transaction ID" type="text">
                                                    </div>
                                                    
                                                    <div class="m-2">
                                                        <label class="h6">Remarks</label>
                                                        <textarea class="form-control rounded" id="remarks" name ="remark"></textarea>
                                                    </div>
                                                    <div class="m-2">
                                                        <label class="h6">Don't Want to Pay EMI this month</label>
                                                        <input type="checkbox" class="" id="payEmi" name ="payEmi">
                                                    </div>
                                                    </div>
                                                    </div>
                                                    
                                                  
                                                    <div class="m-2 d-flex justify-content-evenly">
                                                        <button type='submit' class="btn btn-outline-success voucher_generate" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Submit</button>
                                                        <button type='reset' class="btn btn-outline-danger">Reset</button>
                                                    </div>
                                                     </form>
                                            </div>
                                                
                                       
                                    </div>
                            <!--    </div>-->
                            <!--</div>-->
                     
                 <!--</div>-->
                 <!--</div>-->
                 
                 <!-- display Payment List-->
                 <div class="x_content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>Name</th>
                            <th>GST Pin</th>
                            <th>Transaction Date</th>
                            <th>Transaction Type</th>
                            <th>Payable Amount</th>
                            <th>Transaction Id</th>
                            <th>Payment For</th>
                            <th>Remark</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($payment) {
                            $i = 1;
                            foreach ($payment as $payments) {
                        ?>
                            <tr>
                                <input type="hidden" value="<?= $payments['id'] ?> ">
                                <td><?= $i++; ?></td>
                                <td><?= $payments['agent_name']; ?></td>
                                <td><?= $payments['gst_no']; ?></td>
                                <td><?= $payments['transaction_date']; ?></td>
                                <td><?= $payments['transaction_type']; ?></td>
                                <td><?= $payments['payment_amount']; ?></td>
                                <td><?= $payments['transaction_id']; ?></td>
                                <td><?= $payments['payment_for']; ?></td>
                                <td><?= $payments['remark']; ?></td>
                                <td>
                                    <?php if (session('role') == '2'): ?>
                                        <!-- Don't display the "Edit" and "Delete" buttons for assigners -->
                                        <a data-target="#viewProductModal" class="view btn btn-outline-info" data-toggle="modal">
                                            <i class="material-icons" data-id="<?= $payments['id']; ?>" data-toggle="tooltip" title="View">View</i>
                                        </a>
                                    <?php else: ?>
                                       <a data-target="#editPaymentModal" class="edit btn btn-outline-warning" data-toggle="modal" data-payment-id="<?= $payments['id']; ?>">
                                         <i class="material-icons" data-toggle="tooltip" title="Edit">Edit</i>
                                        </a>

                                        <a data-target="#deleteProductModal" class="delete btn btn-outline-danger" data-toggle="modal" data-payment-id="<?= $payments['id']; ?>">
                                            <i class="material-icons" data-toggle="tooltip" title="Delete">Delete</i>
                                        </a>

                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editPaymentModal" tabindex="-1" role="dialog" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPaymentModalLabel">Edit Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for editing payment details -->
                <form id="editPaymentForm" action="<?php echo base_url().'paymentcontroller/update'?>" method="POST">
                    <div class="form-group">
                        <label for="editName"> Agent Name</label>
                        <input type="hidden" name="edit_id" id="edit_id">
                        <input type="text" class="form-control" id="editname" name="editname">
                    </div>
                    
                    <div class="form-group">
                        <label for="editGST"> GST Pin</label>
                        <input type="text" class="form-control" id="editgst_no" name="editgst_no">
                    </div>
                    
                    <div class="form-group">
                        <label for="editDate"> Transaction Date</label>
                        <input type="text" class="form-control" id="edittransaction_date" name="edittransaction_date">
                    </div>
                    
                    <div class="form-group">
                        <label for="editType"> Transaction Type</label>
                        <input type="text" class="form-control" id="edittransaction_type" name="edittransaction_type">
                    </div>
                    
                    <div class="form-group">
                        <label for="editTransactionId">Transaction Id</label>
                        <input type="text" class="form-control" id="edittransaction_id" name="edittransaction_id">
                    </div>
                    
                     <div class="form-group">
                        <label for="editTransactionId">Payable Amount</label>
                        <input type="text" class="form-control" id="editpayableAmount" name="editpayableAmount">
                    </div>
                    
                    <div class="form-group">
                        <label for="editName">Payment For</label>
                        <div class="d-flex justify-content-between">
                            <div class="form-check justif-content-center">
                                <input type="radio" class="form-check-input" id="mis" value="mis" name="payment_for">
                                <label class="form-check-label mb-2" for="mis">MIS</label>
                            </div>
                    
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="loan" value="loan" name="payment_for">
                                <label class="form-check-label" for="loan">Loan</label>
                            </div>
                    
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="onspot" value="onspot" name="payment_for">
                                <label class="form-check-label" for="onspot">On Spot</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="editRemark"> Remark</label>
                        <input type="text" class="form-control" id="editremark" name="editremark">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Delete Modal -->
<div id="deleteProductModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteForm" method="post" action="">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <!-- <input type="text" name="delete_id" id="delete_id" > -->
                    <p>Are you sure you want to delete this item?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" class="submit">Delete</button>
                </div>
            </form>
        </div>
     </div>
  </div>
</div>
    
    <div class="modal fade" id="customPopup" tabindex="-1" aria-labelledby="customPopupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customPopupLabel">Error</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body" id="customPopupMessage">
                Please Fill In All The Required Fields.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    
   <!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade invoice-container" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <!--<h1 style="text-align:center;">Fin Experts</h1>-->
       </div>
         <!--<p style="border-bottom: 1px solid black;text-align:center;"> 6-3-661/B/2, Plot No 78, 2ed, SANGGTH NAGAR, SOMAJIGUDA, HYDERABAD</p>-->
            <div class="modal-body invoice-items">
               <div class="invoice-header">
                  <h3>Payment Invoice</h3>
               </div>
               
                <table>
                <tr>
                    <td>PV No:</td>
                    <td style="border-bottom: 1px solid black;width:100px;">${response.voucher}</td>
                    <td style="padding-left: 300px;">Dated:</td>
                    <td style="border-bottom: 1px solid black;width:100px;">${response.date}</td>
                </tr>
                <tr>
                    <td style="width: 200PX;">Sum of Rupees:</td>
                    <td colspan="3"style="border-bottom: 1px solid black;width:500px;">${response.payment_amount} &#8377;</td>
                </tr>
                <tr>
                    <td>In Words:</td>
                    <td colspan="3"style="border-bottom: 1px solid black;width:500px;">${amountInWords} Rupees Only</td>
                </tr>
                <tr>
                    <td>Paid To:</td>
                    <td colspan="3"style="border-bottom: 1px solid black;width:500px;">${response.agent_name}</td>
                </tr>
                
            </table>
                
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

<!-- Delete Model -->

       
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->

<script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>   
 <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script>
    $(document).ready(function(){
        $('#todate').on('change keyup', function(){
            var fromDate = new Date($('#fromdate').val());
            var toDate = new Date($(this).val());
 
            if(toDate > fromDate) {
                $('#dateError').text('');
            } else {
               $('#dateError').text('To Date cannot be less than From Date');
            }
        });

        $('#fromdate').on('change keyup', function(){
            var fromDate = new Date($(this).val());
            var toDate = new Date($('#todate').val());

            if(toDate < fromDate) {
                $('#dateError').text('To Date cannot be less than From Date');
            } else {
                $('#dateError').text('');
            }
        });
    });
 </script>
<script>
$(function() {
    $("#heard").select2();
});
</script>
<script>
    $(document).ready(function(){
        new DataTable('#datatable');
    });

</script>

<script>
    
    // $(document).ready(function(){
    //     new DataTable('#datatable');
    // })

    $(document).on('click','.edit', function(e){
        e.preventDefault();
        var id = $(this).parent().siblings()[0].value;
        // alert(id);
        $.ajax({
            url:"<?= base_url(); ?>" + "paymentcontroller/edit/"+id,
            method:'GET',
            success : function(result) {
                var res = JSON.parse(result);
                console.log(res);
                $("#editname").val(res.agent_name);
                $("#editgst_no").val(res.gst_no);
                $("#edittransaction_date").val(res.transaction_date);
                $("#edittransaction_type").val(res.transaction_type);
                $("#edittransaction_id").val(res.transaction_id);
                $("#editpayableAmount").val(res.payment_amount);
                $("input[name='payment_for'][value='" + res.payment_for + "']").prop('checked', true);
                $("#editremark").val(res.remark);
                // $("#payableAmount").val(res.payableAmount);
                
                $("#edit_id").val(res.id);
            }
        });
    });
    
    $(document).on('click', '.delete', function(e) {
    e.preventDefault();
    var id = $(this).parent().siblings()[0].value;
    

    
    $('#deleteForm').attr('action', 'deletepayment/' + id);
    $('#deleteProductModal').modal('show');
});

$('#deleteForm').on('click', '.submit', function(e) {
    e.preventDefault();

    var form = $(this);
    var actionUrl = form.attr('action');

    $.ajax({
        url: actionUrl,
        method: 'POST',
        dataType: 'json',
        success: function(result) {
            var res = JSON.parse(result);
                console.log(res);
                location.reload();
                // $("#delete_id").val(res.id);
        }
        
    });
});


</script>


<script>
     $('#staticBackdrop').on('show.bs.modal', function () {
        var currentDate = new Date().toLocaleDateString();
        $('#receiptDate').text(currentDate);
    });
</script>
<script>
function getAgentName() {
    var selectedAgentID = document.getElementById('heard').value;
    if (selectedAgentID !== '') {
        // Make an AJAX call to the server to retrieve the agent name
        $.ajax({
            type: 'GET',
            url: '<?= base_url("paymentcontroller/getAgentName/"); ?>' + selectedAgentID,
            success: function (response) {
                console.log(response.name);
                $('#receiptDateLabel').html('Receipt Date: ' + response.date);
                document.getElementById("agent_name").value = response.name;
                document.getElementById("gst_no").value = response.gst_no;
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    } else {
        document.getElementById("agent_name").value = '';
        document.getElementById("gst_no").value = '';
    }
}

function closeAlert() {
        $('#validationAlert').hide();
    }
    
    $('.paymentFor').on('change', function(event) {
    event.preventDefault();
    
    const agentId = $('#heard').val();
    const fromdate = $('#fromdate').val();
    const todate = $('#todate').val();
    const payment_amount = $('#payment_amount').val();
    
    const selectedPaymentFor = [];


    $('.paymentFor').each(function() {
        if ($(this).prop('checked')) {
            selectedPaymentFor.push($(this).val());
        }
    });

    console.log(agentId, fromdate, todate, selectedPaymentFor);
    

    $.ajax({
        url: '<?= base_url("paymentcontroller/getData"); ?>',
        type: 'POST',
        data: {
            agentId: agentId,
            fromdate: fromdate,
            todate: todate,
            paymentFor: selectedPaymentFor
        },
        success: function(response) {
            console.log(response);
             
            if (Array.isArray(response.combinedData) && response.combinedData.length === 3) {
                var netPaymentCombined = parseInt(response.combinedData[1].GrossPayout).toFixed(2);
                var remainingDebtAmount = parseInt(response.combinedData[0].remainingDebtAmount);
                var monthlyEmiCombined = (parseInt(response.combinedData[0].monthlyEmi).toFixed(2) > 0) ? parseInt(response.combinedData[0].monthlyEmi).toFixed(2) : 0;
                var paymentAmount = response.combinedData[2].payment_amount;
                var onSpotAmount = paymentAmount !== null ? parseInt(paymentAmount).toFixed(2) : 0;
                var payAbleEmi = remainingDebtAmount === 0 ? 0 : monthlyEmiCombined;
               $('#payEmi').on('change', function() {
                    payAbleEmi = $(this).prop('checked') ? 0 : (remainingDebtAmount === 0 ? 0 : monthlyEmiCombined);
                    $('#remarks').val('MIS=' + netPaymentCombined + ',' + 'Monthly EMI=' + payAbleEmi + ',' + 'On Spot Payment=' + onSpotAmount);
                    $('#payment_amount').val(netPaymentCombined - payAbleEmi - onSpotAmount);
                });



                // var onSpotAmount = parseFloat(response.combinedData[2].payment_amount).toFixed(2) ?  parseFloat(response.combinedData[0].payment_amount).toFixed(2) : 0;
                
                $('#emiAmount').val(monthlyEmiCombined);
                $('#remarks').val('MIS' + "=" + netPaymentCombined + ',' + 'Monthly EMI' + "=" + payAbleEmi + ',' + 'On Spot Payment' +'=' + onSpotAmount);
                $('#payment_amount').val(netPaymentCombined - payAbleEmi - onSpotAmount);
            }

            else if (Array.isArray(response.combinedData) && response.combinedData.length === 2) {
                if(response.combinedData[1].payment_amount == null){
                     var netPaymentCombined = parseInt(response.combinedData[0].GrossPayout).toFixed(2);
                // var monthlyEmiCombined = parseFloat(response.combinedData[0].monthlyEmi).toFixed(2);
                var onSpotAmount = 0;
                
                $('#emiAmount').val(monthlyEmiCombined);
                $('#remarks').val('MIS' + "=" + netPaymentCombined + ','  + 'On Spot Payment' +'=' + onSpotAmount);
                $('#payment_amount').val(netPaymentCombined  - onSpotAmount);
                }
                else{
                    var grossPayoutString = response.combinedData[0].GrossPayout;
                    var grossPayoutFloat = parseInt(grossPayoutString);
                    var netPaymentCombined = grossPayoutFloat.toFixed(2);
                // var monthlyEmiCombined = parseFloat(response.combinedData[0].monthlyEmi).toFixed(2);
                    var onSpotAmount = parseInt(response.combinedData[1].payment_amount).toFixed(2) || 0;
                    var result = netPaymentCombined - onSpotAmount;
                
                $('#emiAmount').val(monthlyEmiCombined);
                $('#remarks').val('MIS' + "=" + netPaymentCombined + ','  + 'On Spot Payment' +'=' + onSpotAmount);
                $('#payment_amount').val(result.toFixed(2));
                }
                
                
                
            }


        }
    });
});

$('input[name="fromdate"], input[name="todate"]').on('keyup', function () {
    const fromDate = new Date($('input[name="fromdate"]').val());
    const toDate = new Date($('input[name="todate"]').val());

   const errorDiv = $('#dateError'); // Change #dateError to the actual ID of your error div

    // Compare dates
    if (fromDate > toDate) {
        errorDiv.text('To date cannot be less than from date.');
    } else {
        errorDiv.text(''); // Clear the error message if the condition is met
    }
});


 $('.voucher_generate').click(function (event) {
        event.preventDefault();
        const agentID = $('select[name="agent_id"]').val();
        const agentName = $('input[name="agent_name"]').val();
        const gstPIN = $('input[name="gst_no"]').val();
        const transactionID = $('input[name="transaction_id"]').val();
        const transactionType = $('select[name="transaction_type"]').val();
        const paymentAmount = $('input[name="payment_amount"]').val();
        const paymentFor = $('input[name="payment_for"]:checked').val();
        const monthlyEmi = $('#emiAmount').val();
        console.log(paymentFor);
        // Check if required fields are filled
        
        
       if (!agentID || !agentName || !gstPIN || !transactionID || !transactionType || !paymentAmount) {
        Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please Fill In All The Required Fields.',
                    
                });
        return;
    }

        if(paymentFor == 'onspot' || paymentFor == 'loan' || paymentFor == 'mis'){
                $.ajax({
            type: 'POST',
            url: '<?= base_url("paymentcontroller/insertPayment"); ?>',
            data: $('form').serialize(), // Serialize the form data
            success: function (response) {
                // If the response contains a voucherCode, open the modal
                if (response.voucher) {
                    const amountInWords = convertNumberToWords(parseFloat(response.payment_amount));
                    const currentDate = new Date().toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                    
        $('.modal-body').html(`
            <div class="row">
                <div class="col-md-4">
                    <div class="company-info">
                         <img src="<?= base_url('Finexpertlogo.png') ?>" style="height: 50px; width: 250px;" alt="Finexperts Logo">
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
                        <td>Voucher No:</td>
                        <td style="border-bottom: 1px solid black;width:100px;">${response.voucher}</td>
                        <td style="padding-left: 300px;border-bottom: 1px solid black;width:100px;">Dated:${response.date}</td>
                       
                    </tr>
                    <tr>
                        <td style="width: 200PX;">Sum of Rupees:</td>
                        <td colspan="3"style="border-bottom: 1px solid black;width:500px;">&#8377;${response.payment_amount} </td>
                    </tr>
                    <tr>
                        <td>In Words:</td>
                        <td colspan="3"style="border-bottom: 1px solid black;width:500px;">${amountInWords}</td>
                    </tr>
                    <tr>
                        <td>Paid To:</td>
                        <td colspan="3"style="border-bottom: 1px solid black;width:500px;">${response.agent_name}</td>
                    </tr>
                </table>
`);


                    
 
                    // Open the modal
                    $('#staticBackdrop').modal('show');
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        }
        if(paymentFor == 'mis'){
            $.ajax({
            type: 'POST',
            url: '<?= base_url("paymentcontroller/insertEmi"); ?>',
            data: $('form').serialize(), // Serialize the form data
            success: function (response) {
                // If the response contains a voucherCode, open the modal
                if (response.voucher) {
                    const amountInWords = convertNumberToWords(parseFloat(response.payment_amount));
                    const currentDate = new Date().toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                    
        $('.modal-body').html(`
            <div class="row">
                <div class="col-md-4">
                    <div class="company-info">
                       <img src="<?= base_url('Finexpertlogo.png') ?>" style="height: 50px; width: 250px;" alt="Finexperts Logo">
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
                        <td>Voucher No:</td>
                        <td style="border-bottom: 1px solid black;width:100px;">${response.voucher}</td>
                        <td style="padding-left: 300px;border-bottom: 1px solid black;width:100px;">Dated:${response.date}</td>
                       
                    </tr>
                    <tr>
                        <td style="width: 200PX;">Sum of Rupees:</td>
                        <td colspan="3"style="border-bottom: 1px solid black;width:500px;">${response.payment_amount} &#8377;</td>
                    </tr>
                    <tr>
                        <td>In Words:</td>
                        <td colspan="3"style="border-bottom: 1px solid black;width:500px;">${amountInWords}</td>
                    </tr>
                    <tr>
                        <td>Paid To:</td>
                        <td colspan="3"style="border-bottom: 1px solid black;width:500px;">${response.agent_name}</td>
                    </tr>
                </table>
`);
                  
 
                    // Open the modal
                    $('#staticBackdrop').modal('show');
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
        }
        
    });
    
  
function toggleOtherTransactionDiv() {
        const selectedValue = $('select[name="transaction_type"]').val();
        if (selectedValue === 'Other') {
            $('#otherTransactionDiv').show();
        } else {
            $('#otherTransactionDiv').hide();
        }
    }

    // Call the function on page load
    toggleOtherTransactionDiv();

    // Call the function whenever the dropdown value changes
    $('select[name="transaction_type"]').change(function() {
        toggleOtherTransactionDiv();
    });

</script>
<script>
    $('.select2').select2();
</script>
<!-- Add this script after your other scripts -->
<script>

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

console.log(convertNumberToWords(1234567)); // Output: "One Million Two Hundred Thirty Four Thousand Five Hundred Sixty Seven"+
</script>

<script>
    // Function to download the PDF
    function downloadPdf(agent_name) {
        // Select the target element (the modal content) to be converted to PDF
        const element = document.querySelector('.modal-body');
        
        const filename = `voucher_${agent_name}.pdf`;

        // Create an options object for html2pdf.js
        const options = {
            margin: 10,
            filename: 'voucher.pdf',
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

<!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->

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

<!-- Include pdfmake library -->
<!-- Add the following scripts to your HTML -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/vfs_fonts.js"></script>
<?= $this->endSection(); ?>