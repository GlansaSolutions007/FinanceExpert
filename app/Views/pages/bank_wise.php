<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content')?>
<h1>Bank Report</h1>

<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_content">
                <br />
                <form class="form-label-left input_mask">
                    <div class="field item form-group col-md-10">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Select Bank<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select id="heard" class="form-control" name="bankname" required>
                                <option value="">Choose..</option>
                               
                                        <?php if ($banks){ ?>
                                            <?php foreach ($banks as $bank) { ?>
                                                <option value="<?= $bank['name'] ?>"><?= $bank['name'] ?></option>
                                          <?php
                                          } 
                                         } ?>
                                    </select>
                            
                        </div>
                    </div>
                    
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Select Branch<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select id="heard" class="form-control" name="bankname" required>
                                <option value="">Choose..</option>
                               
                                        <?php if ($banks){ ?>
                                            <?php foreach ($banks as $bank) { ?>
                                                <option value="<?= $bank['name'] ?>"><?= $bank['name'] ?></option>
                                          <?php
                                          } 
                                         } ?>
                                    </select>
                            
                        </div>
                    </div>
                    
                    <!-- <div class="field item form-group col-md-10">-->
                    <!--    <label class="col-form-label col-md-3 col-sm-3 label-align">From Date<span class="required">*</span></label>-->
                    <!--    <div class="col-md-6 col-sm-6">-->
                    <!--        <input type="date" class="form-control" name="fromdate" id="fromdate">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="field item form-group col-md-10">-->
                    <!--    <label class="col-form-label col-md-3 col-sm-3 label-align">To Date<span class="required">*</span></label>-->
                    <!--    <div class="col-md-6 col-sm-6">-->
                    <!--        <input type="date" class="form-control" name="todate" id="todate">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="field item form-group col-md-10">-->
                    <!--    <label class="col-form-label col-md-3 col-sm-3 justify-content-center label-align">Select Month Span<span class="required">*</span></label>-->
                    <!--    <div class="col-md-3">-->
                    <!--        <label class="col-form-label col-md-6 col-sm-6 ">From Date<span class="required">*</span></label>-->
                            
                    <!--        <div class="field item form-group col-md-10">-->
    
                    <!--            <div class="col-md-4">-->
                    <!--                <input class="form-control date" type="text"  id="day1" name="day"  min="1" max="31" required>-->
                    <!--            </div>-->
                    <!--            <div class="col-md-4">-->
                    <!--                <input class="form-control date" type="text"  id="month1" name="month"  min="1" max="12" required>-->
                    <!--            </div>-->
                    <!--            <div class="col-md-4">-->
                    <!--                <input class="form-control date1" type="text"  readonly id="year1" name="year"  min="1900" max="2100" required>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <div class="col-md-3">-->
                    <!--         <label class="col-form-label col-md-6 col-sm-6 ">To Date<span class="required">*</span></label>-->
                            
                    <!--        <div class="field item form-group col-md-10">-->
    
                    <!--            <div class="col-md-4">-->
                    <!--                <input class="form-control date" type="text"  id="day2" name="day" min="1" max="31" required>-->
                    <!--            </div>-->
                    <!--            <div class="col-md-4">-->
                    <!--                <input class="form-control date" type="text"  id="month2" name="month"  min="1" max="12" required>-->
                    <!--            </div>-->
                    <!--            <div class="col-md-4">-->
                    <!--                <input class="form-control date1" type="text" readonly id="year2" name="year"  min="1900" max="2100" required>-->
                    <!--            </div>-->
                                
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    </div>-->
                    <!--</div>-->
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
                                            <th>Bank Name</th>
                                            <th>Executive</th>
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




<!-- ... Your existing HTML code ... -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
     $(document).ready(function(){
        new DataTable('#datatable');
    });
    
        $(document).ready(function() {
        $('#view-button').on('click', function(e) {
            e.preventDefault();
            var selectedBank = $('#heard').val();
            // var fromDate= $('#fromdate').val();
            // var toDate=  $('#todate').val();
             
            compareDate(selectedBank);
        });

        function compareDate(selectedBank) {
            $.ajax({
                url: '<?= base_url('agentwisecontroller/comparedateBank') ?>', // Replace with the correct URL for data retrieval on the server side
                method: 'POST',
                data: { name: selectedBank },
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
    tableBody.empty(); // Clear the existing table content

    if (data.length > 0) {
        $.each(data, function(index, row) {
            var newRow = $('<tr>');
            newRow.append('<td>' + (index + 1) + '</td>');
            newRow.append('<td>' + row.Bank + '</td>');
            newRow.append('<td>' + row.Executive + '</td>');
            // newRow.append('<td>' + parseFloat(row.NetPayment).toFixed(2) + '</td>'); // Display assigned agent
           
            tableBody.append(newRow);
        });

    } else {
        // If no data found, display a message in a new row
        var newRow = $('<tr>').html('<td colspan="8">No data available.</td>');
        tableBody.append(newRow);
      }
     }
        
  });
</script>

<!-- ... Your existing HTML code ... -->


<!--Assigning agent script start-->



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