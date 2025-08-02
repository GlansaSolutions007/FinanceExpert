<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content')?>
 <!--<div class="container-fluid"> -->

    <!-- Page Heading -->

    <div class="s" role="main" id="agents">
        <!--<form action="<?php echo base_url().'agentadmin/insert';?>" method="POST">-->
        <div class="">
            <div class="page-title">
               <div class="title_left d-flex align-items-center justify-content-between col-md-12">
                    <h3><b>Agent List</b></h3>
                    <a href="<?= base_url('agentadmin/exportToExcel'); ?>"><button class="btn btn-success">Export</button></a>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                        <div class="input-group">
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

                            
                    

    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive" id="table">
                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Agent Id</th>
                                <th>Mobile No</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Aadhar No</th>
                                <th>Aadhar Images</th>
                                <th>Pard No</th>
                                <th>Pan Image</th>
                                <th>Action</th>

                            </tr>
                        </thead>


                        <tbody>
                        <?php
                        if($user)
                        {
                            $i=1;      
                               foreach($user as $users)
                                {
                                   
                                    ?>

                            <tr>
                                <input type="hidden" value="<?= $users['id'] ?> ">
                                
                                <td><?= $i;?>
                                <td><?= $users['name']?></td>
                                <td><?= $users['user_id']?></td>
                                <td><?= $users['phone_no']?></td>
                                <td><?= $users['email']?></td>
                                <td><?= $users['address']?></td>
                                <td><?= $users['adhar_no']?></td>
                                <td><img src="<?= base_url('writable/uploads/Aadhar_images/' . $users['adhar_files']) ?>" alt="Aadhar Image" width="80" height="80"></td>
                                <td><?= $users['pan_no']?></td>
                                <td><img src="<?= base_url('writable/uploads/Pan_images/' . $users['pan_files']) ?>" alt="Pan Image" width="80" height="80"></td>
                                <td>

                                    <a 
                                        data-target="#getAgentDetails" class="agentdetails btn btn-outline-primary" data-toggle="modal"><i
                                            class="material-icons" data-toggle="tooltip" title="get_agent_details">View Agent</i></a>

                                    <a
                                        data-target="#getsubAgentDetails" class="subagentdetails btn btn-outline-primary" data-toggle="modal"><i
                                            class="material-icons" data-toggle="tooltip" title="get_subagent_details">View SubAgent</i></a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                    
                } 
            }
                    
                           ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        <!--</form>-->
        </div>
        <!-- Edit Modal HTML -->
        <div id="getAgentDetails" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="x_content">                            
                            <div class="modal-header">
                            <h5 class="modal-title">Agent Details</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                            <div class="field item form-group modal-body">
                                <input type="hidden" name="agent_id"  id="agent_id">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Agent Name:<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" 
                                         id="name" name="name"
                                        placeholder="Enter Bank Name" />
                                </div>
                            </div>



                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Mobile No:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" class='number' id="mobile" 
                                        name="mobile" required='required'>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Email:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" class='number' id="email" 
                                        name="email" required='required'>
                                </div>
                            </div>




                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Address:<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea name='address' id="address"></textarea>
                                </div>
                            </div>
                            
                             <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Account No:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" class='number' id="account_no" 
                                        name="account_no">
                                </div>
                            </div>
                            
                             <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">GST No:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" class='number' id="gst_no" 
                                        name="gst_no">
                                </div>
                            </div>
                            
                             <div class="field item form-group">
                                                    <label class="h6">Percentage Of Agent:</label>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                             <label class="h6">Private</label>
                                                            <input class="form-control rounded" name="private" id="private" type="number">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="h6">Goverment</label>
                                                            <input class="form-control rounded" name="goverment" id="goverment"  type="number">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="h6">Files</label>
                                                            <input class="form-control rounded" name="files" id="files"   type="number">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

        <!-- Edit Modal HTML -->
<div id="getsubAgentDetails" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">SubAgent Details</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered" id="subAgentDetailsTable">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Mobile No</th>
                            <th>Email</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- SubAgent details will be appended here -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


       
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->

<script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>   
 <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>


    <script>

    $(document).on('click','.agentdetails', function(e){
        e.preventDefault();
        var id = $(this).parent().siblings()[0].value;
        console.log(id);
        $.ajax({
            url:"<?= base_url(); ?>" + "agentadmin/edit/"+id,
            method:'GET',
            success : function(result) {
                var res = JSON.parse(result);
                // console.log(res);
                $("#name").val(res.name);
                $("#mobile").val(res.phone_no);
                $("#email").val(res.email);
                $("#address").val(res.address);
                $("#account_no").val(res.account_no);
                $("#private").val(res.PVT);
                $("#goverment").val(res.GOVT);
                $("#files").val(res.SEP);
                $("#gst_no").val(res.gst_no);
                $("#agent_id").val(res.id);
            }
        });
    });

    $(document).ready(function () {
        new DataTable('#datatable');
    // Loop through each table row to get the subagentCount for each agent
    $('tbody tr').each(function () {
        var id = $(this).find('input[type="hidden"]').val();
        var button = $(this).find('.subagentdetails');

        $.ajax({
            url: "<?= base_url('agentadmin/getsubagentdetails'); ?>",
            method: 'POST',
            data: { agent_id: id },
            dataType: 'json',
            success: function (result) {
                var subagentCount = result.subagent_count;
                console.log(subagentCount);

                // Show or hide the "View SubAgent" button for the current agent based on subagentCount
                if (subagentCount > 0) {
                    button.show();
                } else {
                    button.hide();
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

// $(document).on('click', '.subagentdetails', function (e) {
//     e.preventDefault();
//     var id = $(this).parent().siblings('input[type="hidden"]').val();

//     $.ajax({
//         url: "<?= base_url('agentadmin/getSubAgentCount'); ?>",
//         method: 'POST',
//         data: { agent_id: id },
//         dataType: 'json',
//         success: function (result) {
//             var subagentCount = result.subagent_count;
//             console.log(subagentCount);

//             // Show or hide the "View SubAgent" button for the current agent based on subagentCount
//             if (subagentCount > 0) {
//                 $('#getsubAgentDetails').modal('show');

//                 // Populate the modal table with subagent data
//                 var subagents = result.subagents; // Assuming 'subagents' is an array of subagents
//                 var tableBody = $('#subAgentDetailsTable tbody');
//                 tableBody.empty(); // Clear the table body before populating with new data

//                 // Loop through each subagent and create a table row for it
//                 for (var i = 0; i < subagents.length; i++) {
//                     var subagent = subagents[i];
//                     var row = "<tr>" +
//                         "<td>" + (i + 1) + "</td>" +
//                         "<td>" + subagent.name + "</td>" +
//                         "<td>" + subagent.phone_no + "</td>" +
//                         "<td>" + subagent.email + "</td>" +
//                         "<td>" + subagent.address + "</td>" +
//                         "</tr>";
//                     tableBody.append(row);
//                 }
//             } else {
//                 // Show a message indicating that there are no subagents
//                 alert('No subagents found for this agent.');
//             }
//         },
//         error: function (xhr, status, error) {
//             console.error(xhr.responseText);
//         }
//     });
// });
$(document).on('click', '.subagentdetails', function (e) {
    e.preventDefault();
    var id = $(this).parent().siblings('input[type="hidden"]').val();

    $.ajax({
        url: "<?= base_url('agentadmin/getSubAgentDetails'); ?>", // Update the URL to call the controller method
        method: 'POST',
        data: { agent_id: id },
        dataType: 'json',
        success: function (result) {
            var subagentCount = result.subagent_count;
            var subagents = result.subagents;

            if (subagentCount > 0) {
                $('#getsubAgentDetails').modal('show');

                // Populate the modal table with subagent data
                var tableBody = $('#subAgentDetailsTable tbody');
                tableBody.empty(); // Clear the table body before populating with new data

                for (var i = 0; i < subagents.length; i++) {
                    var subagent = subagents[i];
                    var row = "<tr>" +
                        "<td>" + (i + 1) + "</td>" +
                        "<td>" + subagent.name + "</td>" +
                        "<td>" + subagent.phone_no + "</td>" +
                        "<td>" + subagent.email + "</td>" +
                        "<td>" + subagent.address + "</td>" +
                        "</tr>";
                    tableBody.append(row);
                }
            } else {
                alert('No subagents found for this agent.');
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});


    </script>


    <!--<script src="https://code.jquery.com/jquery-3.7.0.js"></script>-->
    <!--<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>-->
    <!--<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>-->
    <!--<script src="../vendors/jquery/dist/jquery.min.js"></script>-->
    <!-- Bootstrap -->
    <!--<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>-->
    <!-- FastClick -->
    <!--<script src="../vendors/fastclick/lib/fastclick.js"></script>-->
    <!-- NProgress -->
    <!--<script src="../vendors/nprogress/nprogress.js"></script>-->
    <!-- iCheck -->
    <!--<script src="../vendors/iCheck/icheck.min.js"></script>-->
    <!-- Datatables -->
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

    <!-- Custom Theme Scripts -->
    <!--<script src="../build/js/custom.min.js"></script>-->

    <?= $this->endSection(); ?>