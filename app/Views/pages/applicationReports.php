<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content') ?>
<h3>Application Reports</h3>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form class="form-label-left input_mask">
                    <div class="d-flex col-md-12">
                        
                        <div class="field item form-group col-md-6">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Agreement Number<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                        <input type="text" name="losno" class="form-control" id="losno" placeholder="Enter Los Number Here">
                        </div>
                    </div>
                    <div class="field item form-group col-md-6">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Select Agent Id</label>
                        <div class="col-md-6 col-sm-6">
                        <select id="agent"  class="form-control" onchange="getAgentName()" name="agent_id" >
                            <option value="">Choose..</option>
                            <?php if ($agents) : ?>
                                <?php foreach ($agents as $agent) : ?>
                                    <?php if ($agent['Executive'] !== null) : ?>
                                        <option value="<?= $agent['Executive'] ?>"><?= $agent['Executive'] ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>



                            
                        </select>

                            
                        </div>
                    </div>
                    
                    <input type="hidden" name="email" id="email">
                    </div>
                    
                    
                    <div class="d-flex col-md-12">
                        <div class="field item form-group col-md-6">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">From date</label>
                        <div class="col-md-6 col-sm-6">
                        <input type="date" name="fromDate" class="form-control" id="fromdate" >
                        </div>
                    </div>
                    <div class="field item form-group col-md-6">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">To date</label>
                        <div class="col-md-6 col-sm-6">
                        <input type="date" name="toDate" class="form-control" id="todate" >
                        </div>
                    </div>
                    
                    </div>
                    <div class="d-flex col-md-12">
                        <div class="field item form-group col-md-6">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Select Bank</label>
                            <div class="col-md-6 col-sm-6">
                                <select id="heard" class="form-control" name="bankname" >
                                    <option value="">Choose..</option>
                                    <?php if ($bankNames) { ?>
                                        <?php foreach ($bankNames as $bank) { ?>
                                            <option value="<?= $bank['Bank'] ?>"><?= $bank['Bank'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                            
                                </select>
                                
                            </div>
                        
                        </div>
                        <div class="field item form-group col-md-6">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <div class="field item form-group text-center">
                                <button class="btn btn-primary" id="view-button">View</button>
                                <button class="btn btn-success" id="export-button" onclick="validateFormAndProceed('export')">Export</button>
                            </div>
                            </div>
                            
                            
                        </div>
                     
                    </div>
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
                                            <th>Executive</th>
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
                                            <th>WFH Deduction</th>
                                            <th>Net %</th>
                                            <th>Gross Payout</th>
                                            <th>TDS</th>
                                            <th>Net Payment</th>
                                            
                                            <!--<th>Actions</th>-->
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
    var agentId = document.getElementById('agent_id').value;
    var bank = document.getElementById('agent_id').value;

    // Additional validation logic if needed

    // Check if the required fields are filled
    if (fromDate && toDate && agentId || bank) {
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
     function getAgentName() {
    var selectedAgentID = document.getElementById('agent').value;
    // console.log(selectedAgentID);
    if (selectedAgentID !== '') {
        // Make an AJAX call to the server to retrieve the agent name
        $.ajax({
            type: 'GET',
            url: '<?= base_url("applicationReportController/getEmailByAgentId/"); ?>' + selectedAgentID,
            success: function (response) {
                // console.log(response.gst_no);
                // document.getElementById("agent_name").value = response.name;
                 var email=document.getElementById("email").value = response.email;
                 console.log(email);
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
    
     $(document).ready(function () {
     $('#export-button').on('click', function(e) {
        e.preventDefault();
        var agentId = $('#agent').val();
        var fromDate = $('#fromdate').val()
        var toDate = $('#todate').val();
        var bankName = $('#heard').val();
        var losNo = $("#losno").val();
        
        var url = '<?= base_url('applicationReportController/export') ?>';
        
         if (fromDate && toDate && losNo && agentId && bankName) {
        url += '?fromDate=' + fromDate + '&toDate=' + toDate + '&losNo=' + losNo + '&agentId=' + agentId + '&bankName=' + bankName;
        } else if (fromDate && toDate && losNo && agentId) {
            url += '?fromDate=' + fromDate + '&toDate=' + toDate + '&losNo=' + losNo + '&agentId=' + agentId;
        } else if (bankName && losNo && agentId) {
            url += '?bankName=' + bankName + '&losNo=' + losNo + '&agentId=' + agentId;
        } else if (agentId && fromDate && toDate && bankName) {
            url += '?agentId=' + agentId + '&fromDate=' + fromDate + '&toDate=' + toDate + '&bankName=' + bankName;
        } else if (losNo && fromDate && toDate && bankName) {
            url += '?losNo=' + losNo + '&fromDate=' + fromDate + '&toDate=' + toDate + '&bankName=' + bankName;
        } else if (agentId && losNo) {
            url += '?agentId=' + agentId + '&losNo=' + losNo;
        } else if (bankName && losNo) {
            url += '?bankName=' + bankName + '&losNo=' + losNo;
        } else if (fromDate && toDate && losNo) {
            url += '?fromDate=' + fromDate + '&toDate=' + toDate + '&losNo=' + losNo;
        } else if (agentId && bankName) {
            url += '?agentId=' + agentId + '&bankName=' + bankName;
        } else if (agentId && fromDate && toDate) {
            url += '?agentId=' + agentId + '&fromDate=' + fromDate + '&toDate=' + toDate;
        } else if (bankName && fromDate && toDate) {
            url += '?bankName=' + bankName + '&fromDate=' + fromDate + '&toDate=' + toDate;
        } else if (losNo) {
            url += '?losNo=' + losNo;
        } else if (bankName) {
            url += '?bankName=' + bankName;
        } else if (fromDate && toDate) {
            url += '?fromDate=' + fromDate + '&toDate=' + toDate;
        } else if (agentId) {
            url += '?agentId=' + agentId;
        }
        
        window.location.href = url;
        
      });
    });
</script>

   <script> 
// });

</script>
    <script>
    $(document).ready(function() {
        // new DataTable('#datatable');
    $("#view-button").on("click", function() {
        event.preventDefault();
        var agentId = $("#agent").val();
        var bankName = $("#heard").val();
        var losNo = $("#losno").val();
        var fromDate = $("#fromdate").val(); 
        var toDate = $("#todate").val(); 
         var email = $("#email").val(); 
        
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
      
      if(fromDate && toDate && losNo && agentId && bankName) {
            // Make AJAX request based on agentId and losNo
                        $.ajax({
                url: "getAllData", // Replace with the actual URL
                type: "POST",
                data: {  fromDate: fromDate,toDate:toDate, losNo:losNo, agentId:agentId, bankName:bankName },
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
    }  
        
    else if(fromDate && toDate && losNo && agentId) {
            // Make AJAX request based on agentId and losNo
                        $.ajax({
                url: "getDataByFromToLosAgent", // Replace with the actual URL
                type: "POST",
                data: {  fromDate: fromDate,toDate:toDate, losNo:losNo, agentId:agentId },
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
    }else if(bankName && losNo && agentId) {
            // Make AJAX request based on agentId and losNo
                        $.ajax({
                url: "getDataByBankLosAgent",
                type: "POST",
                data: {  bankName: bankName, losNo:losNo, agentId:agentId },
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
    }
    else if(agentId && fromDate && toDate && bankName) {
            // Make AJAX request based on agentId and losNo
                        $.ajax({
                url: "getDataByBankAgentFromToDate", // Replace with the actual URL
                type: "POST",
                data: {  agentId: agentId, fromDate:fromDate, toDate:toDate, bankName:bankName },
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
    }
    
    else if(losNo && fromDate && toDate && bankName) {
            // Make AJAX request based on agentId and losNo
                        $.ajax({
                url: "getDataByBankLosFromToDate", // Replace with the actual URL
                type: "POST",
                data: {  losNo: losNo, fromDate:fromDate, toDate:toDate, bankName:bankName },
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
    }
    
       else if(agentId && losNo) {
            // Make AJAX request based on agentId and losNo
                        $.ajax({
                url: "getDataByAgentAndLos", // Replace with the actual URL
                type: "POST",
                data: {  agentId: agentId, losNo: losNo },
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
        } else if(bankName && losNo) {
            // Make AJAX request based on agentId and losNo
                        $.ajax({
                url: "getDataByBankAndLos", // Replace with the actual URL
                type: "POST",
                data: {  bankName: bankName, losNo: losNo },
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
        }else if(fromDate && toDate && losNo) {
            // Make AJAX request based on agentId and losNo
                        $.ajax({
                url: "getDataByfromToDateAndLos", // Replace with the actual URL
                type: "POST",
                data: {  fromDate: fromDate,toDate:toDate, losNo: losNo },
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
            
        }else if(agentId && bankName) {
            // Make AJAX request based on agentId and losNo
                        $.ajax({
                url: "getDataByAgentAndBank", // Replace with the actual URL
                type: "POST",
                data: {  agentId: agentId, bankName:bankName },
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
        
        }else if(agentId && fromDate && toDate) {
            // Make AJAX request based on agentId and losNo
                        $.ajax({
                url: "getDataByAgentAndFromToDate", // Replace with the actual URL
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
        }else if(bankName && fromDate && toDate) {
            // Make AJAX request based on agentId and losNo
                        $.ajax({
                url: "getDataByBankAndFromToDate", // Replace with the actual URL
                type: "POST",
                data: {  bankName: bankName, fromDate:fromDate, toDate:toDate },
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
        
        } else if(losNo) {
            // Make AJAX request based on losNo
            $.ajax({
                url: "getDataByLosNoLike", // Replace with the actual URL
                type: "POST",
                data: { losNo: losNo },
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
        } else if(bankName) {
            // Make AJAX request based on bankName
            console.log("Making AJAX request for bank: " + bankName);
            $.ajax({
                url: "getDataByBankName", // Replace with the actual URL
                type: "POST",
                data: { bankName: bankName },
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
        } else if(fromDate && toDate) {
            // Make AJAX request based on fromDate and toDate
            $.ajax({
                url: "getDataBetweenDatesLos", // Replace with the actual URL
                type: "POST",
                data: { fromDate: fromDate, toDate: toDate },
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
        } else if(agentId) {
            // No filtering criteria, show all data
            $.ajax({
                url: "getDataByAgentId", // Replace with the actual URL
                type: "POST",
                data: { agentId: agentId },
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
        }


       
    
    });
});

function updateTable(data) {
    var dataTable = $('#datatable').DataTable();
    dataTable.clear().draw();  // Clear existing rows and draw an empty table

    // Loop through the fetched data and add rows to the table
    for (var i = 0; i < data.length; i++) {
        var row = data[i];
        dataTable.row.add([
            i + 1,
            row.Executive,
            row.AgreementNo,
            row.Bank,
            row.DisbursalDate,
            row.CustomerName,
            row.Location,
            row.State,
            row.Gross,
            row.TopUp,
            row.Scheme,
            row.Net,
            row.LoanAmount,
            row.Category,
            row['PayOutPercentage'],
            row.WfhDeduction,
            row['NetPercentage'],
            row.GrossPayout,
            row.TDS,
            row.NetPayment
            // Add more data fields as needed
        ]).draw(false);
    }
}



</script>









<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--Assigning agent script start-->

    
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script>-->
    <!--<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>-->
    <!--<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>-->
    <!--<script src="../vendors/jquery/dist/jquery.min.js"></script>-->

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