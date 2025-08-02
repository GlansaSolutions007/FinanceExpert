<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content')?>
<h1>Bank Invoice</h1>
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
                            <label>Bank Name</label>
                              <select id="bank" class="form-control" name="bankname" required>
                                <option value="">Choose..</option>
                               
                                <?php
                                        $uniqueBankNames = array(); // Array to store unique bank names
                                        if ($banks) {
                                            foreach ($banks as $bank) {
                                                if (!in_array($bank['name'], $uniqueBankNames)) { // Check if the bank name is already in the unique array
                                                    array_push($uniqueBankNames, $bank['name']); // Add the bank name to the unique array
                                                    echo '<option value="' . $bank['name'] . '">' . $bank['name'] . '</option>';
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
                             <label class="h6">Bank Branch</label>
                          <select id="branch" class="form-control" name="bankname" required>
                                <option value="">Choose..</option>
                               
                                <?php
                                    $uniqueBranchNames = array(); // Array to store unique branch names
                                    if ($branch) {
                                        foreach ($branch as $branchs) {
                                            if (!in_array($branchs['branch'], $uniqueBranchNames)) { // Check if the branch name is already in the unique array
                                                array_push($uniqueBranchNames, $branchs['branch']); // Add the branch name to the unique array
                                                echo '<option value="' . $branchs['branch'] . '">' . $branchs['branch'] . '</option>';
                                            }
                                        }
                                    }
                                    ?>
    
                                    </select>
                    
                    </div>
                       
                        <div class="m-2">
                             <label class="h6">To Date</label>
                           <input type="date" class="form-control" name="toDate", id="toDate">
                        </div>
                    </div>
                    
                       <div class="m-2 d-flex justify-content-center">
                        <button class="btn btn-primary generate_voucher" id="view-button">Submit</button>
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

                   
                <!--<div class="x_content">-->
                <!--    <div class="row">-->
                <!--        <div class="col-sm-12">-->
                <!--            <div class="card-box table-responsive">-->
                <!--                <table id="datatable" class="table table-striped table-bordered" style="width:100%">-->
                <!--                    <thead>-->
                <!--                        <tr>-->
                <!--                            <th>Sno.</th>-->
                <!--                            <th>Bank Name</th>-->
                <!--                            <th>Executive</th>-->
                <!--                        </tr>-->
                <!--                    </thead>-->
                <!--                    <tbody id="datatable tbody">-->
                                       
                <!--                    </tbody>-->
                <!--                </table>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
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
                <h4 class="agentName"> </h4>
                <P> Company's GSTIN/UIN:</P> <p id="gst_modal"></p>
            </td>
            <td>
                Invoice No. 
                <p id="invoice"></p>
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
            <td style="border-bottom:none;border-top:none;">1 </td>
            <td  colspan="4">Commission</td>
            <td style="border-bottom:none;border-top:none;"> </td>
            <td id="paymentdeduction">  </td>
        </tr>
        <tr >
            <td style="border-bottom:none;border-top:none;">2</td>
            <td  colspan="4">CGST</td>
            <td style="border-bottom:none;border-top:none;"> </td>
            <td class="cgst_modal">  </td>
        </tr>
        <tr>
            <td style="border-bottom:none;border-top:none;">3</td>
            <td  colspan="4">SGST</td>
            <td style="border-bottom:none;border-top:none;"> </td>
            <td class="sgst_modal">  </td>
        </tr>
        <tr>
            <td style="border-bottom:none;border-top:none;">4</td>
            <td  colspan="4">Already Paid</td>
            <td style="border-bottom:none;border-top:none;"> </td>
            <td id="paymentamount">  </td>
        </tr>
        <tr>
            <td style="border-bottom:none;border-top:none;">5</td>
            <td  colspan="4">Loan Amount</td>
            <td style="border-bottom:none;border-top:none;"> </td>
            <td >  </td>
        </tr>
        <tr>
            <td style="border-bottom:none;border-top:none;" > </td>
            <td colspan="4" style="text-align: right;" >Total</td>
            <td> </td>
            <td id="total_amount"> </td>
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
            <td id=""> </td>
            <td id ="cgstrate"></td>
            <td class ="cgst_modal"></td>
            <td id="sgstrate"></td>
            <td class ="sgst_modal"></td>
            <td id="igst_modal"></td>
        </tr>
        <tr>
            <td style="height: 100px;" colspan="7">

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
                for <h6 class="agentName"></h6>
                <br> <br>
                Authorised Signatory
            </td>
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


<!-- ... Your existing HTML code ... -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#view-button').on('click', function() {
            var selectedBankId = $('#bank').val();
            var selectedbranch = $('#branch').val();
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            
            // Replace with your generateInvoice function
            // var generatedInvoice = generateInvoice(selectedBankId, selectedbranch, fromDate, toDate);
            
            // $('#invoiceContent').html(generatedInvoice); // Update the modal content
            $('#invoiceModal').modal('show'); // Open the modal
        });

        // ... Rest of your JavaScript code ...
    });
</script>



    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
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


<?= $this->endSection()?>