<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content') ?>
<!-- <div class="container-fluid"> -->

<!-- Page Heading -->

<div class="s" role="main" id="agents">
    <form action="<?php echo base_url() . 'agentadmin/insert'; ?>" method="POST" enctype="multipart/form-data">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Agent Details</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                        <div class="input-group">

                        </div>
                    </div>
                </div>
            </div>
            <!-- inserting Agent-->
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 m-3">
                    <div class="container p-5 bg-white borderd col-sm-6 shadow rounded">
                        <div class="container-fluid">
                            <div class="col-md-6">
                                <div class="m-2">
                                    <!--<label class="h6">Agent User ID:</label>-->
                                    <input class="form-control rounded" data-validate-length-range="6"
                                        data-validate-words="2" name="user_id" placeholder="Enter Agent Name"
                                        required="required" type="hidden" />
                                </div>
                                <div class="m-2">
                                    <label class="h6">Agent Name<span class="text-danger">*</span></label>
                                    <input class="form-control rounded" data-validate-length-range="6"
                                        data-validate-words="2" name="name" id="textInput"
                                        placeholder="Enter Agent Name" required="required" type="text" />
                                </div>
                                <div class="m-2">
                                    <label class="h6">Mobile No<span class="text-danger">*</span></label>
                                    <input class="form-control rounded" id="numericInput" name="phone_no"
                                        data-validate-minmax="10,100" required='required' placeholder="Enter Mobile No"
                                        type="text">
                                </div>
                                <div class="m-2">
                                    <label class="h6">Email<span class="text-danger">*</span></label>
                                    <input class="form-control rounded" id="aemail" name="aemail"
                                        data-validate-minmax="10,100" required='required' placeholder="Enter Email"
                                        type="email">
                                    <div class="invalid-feedback" id="email-error-msg" style="font-size:15px;"></div>
                                </div>

                                <div class="m-2">
                                    <label class="h6">Account No<span class="text-danger">*</span></label>
                                    <input class="form-control rounded" id="numericaccount" name="account_no"
                                        data-validate-minmax="10,100" required='required' placeholder="Enter Account No"
                                        type="text" maxlength="16">
                                </div>
                                <div id="popup3" style="display: none;">
                                    <p>Please enter a valid 16 digit Account number .</p>
                                </div>
                                <div class="m-2">
                                    <label class="h6">Percentage Of Agent<span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="h6">Private:</label>
                                            <input class="form-control rounded" name="private" required placeholder=""
                                                type="number" step="any" pattern="\d+(\.\d+)?">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="h6">Government:</label>
                                            <input class="form-control rounded" name="goverment" required placeholder=""
                                                type="number" step="any" pattern="\d+(\.\d+)?">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="h6">SEP:</label>
                                            <input class="form-control rounded" name="files" required placeholder=""
                                                type="number" step="any" pattern="\d+(\.\d+)?">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-2">
                                    <label class="h6">Address<span class="text-danger">*</span></label>
                                    <textarea class="form-control rounded" name='address' required
                                        placeholder="Enter Address" type="text-area"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="m-2">
                                    <label class="h6">Has SubAgents:</label>
                                    <input type="checkbox" name="" id="subagents">
                                </div>

                                <div class="m-2">
                                    <label class="h6">Aadhar No<span class="text-danger">*</span></label>
                                    <input class="form-control rounded" required name="adhar_no" id="adhar_input"
                                        type="text">
                                </div>

                                <div id="popup" style="display: none;">
                                    <p>Please enter a valid 12 digit Aadhar card number .</p>
                                </div>

                                <div class="m-2">
                                    <label class="h6">Aadhar Files:</label>
                                    <input class="form-control rounded" name="adhar_files" type="file">
                                </div>

                                <div class="m-2">
                                    <label class="h6">Pan No<span class="text-danger">*</span></label>
                                    <input class="form-control rounded panInput" required name="pan_no" type="text"
                                        maxlength="10">
                                    <div class="panError text-danger font-weight-bold font-size-18"></div>
                                </div>
                                
                                <div class="m-2">
                                    <label class="h6">Pan Files:</label>
                                    <input class="form-control rounded" name="pan_files" type="file">
                                </div>


                                <div class="m-2">
                                    <label class="h6">GST No<span class="text-danger">*</span></label>
                                    <input class="form-control rounded" required name="gst_no" id="gst_no" type="text">
                                </div>

                                <div id="popup2" style="display: none;">
                                    <p>Please enter a valid 15-digit alphanumeric GST Number.</p>
                                </div>

                                <div class="m-2 d-flex justify-content-evenly">
                                    <button type='submit' class="btn btn-outline-success"
                                        id="agent_submit">Submit</button>
                                    <button type='reset' class="btn btn-outline-danger">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end of inserting agent-->

                <!--Number of pages-->
                <div class="col-md-4 m-3" id="subagentsform">
                    <div class="container p-5 bg-white borderd col-sm-6 shadow rounded">
                        <div class="container-fluid">
                            <!-- <form action="<?php echo base_url() . 'agentadmin/insert'; ?>" method="POST"> -->

                            <div class="col-md-12">
                                <div class="m-2">
                                    <label class="h6">Enter how many sub agents you want to enter</label>
                                    <input class="form-control rounded" data-validate-length-range="6"
                                        data-validate-words="2" name="subno" placeholder="No. Of Sub Agent"
                                        type="number" id="numberOfFields" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <button type='submit' class="btn btn-outline-success subagentSubmit" id="submit">Submit</button>
            </div>

            <div class="x_content subagent">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive" id="table">
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sub Agent Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <!--<th>Show details</th>-->
                                        <th>Aadhar No</th>
                                        <!--<th>Aadhar image</th>-->
                                        <th>Pan No</th>
                                        <!--<th>Pan Image</th>-->
                                        <th>GST No</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>

<!--fetch agent data-->

<div class="x_content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table id="datatable1" class="table table-striped table-bordered" style="width: 100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Agent Id</th>
                            <th>Name</th>
                            <th>Mobile No</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Aadhar No</th>
                            <th>Aadhar Image</th>
                            <th>Pan No</th>
                            <th>Pan Image</th>
                            <th>No of sub agents</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($agents as $index => $agent): ?>
                            <tr>
                                <input type="hidden" value="<?= $agent['id'] ?> ">
                                <td><?= $index + 1 ?></td>
                                <td><?= $agent['user_id'] ?></td>
                                <td><?= $agent['name'] ?></td>
                                <td><?= $agent['phone_no'] ?></td>
                                <td><?= $agent['email'] ?></td>
                                <td><?= $agent['address'] ?></td>
                                <td><?= $agent['adhar_no'] ?></td>
                                <td><img src="<?= base_url('writable/uploads/Aadhar_images/' . $agent['adhar_files']) ?>"
                                        alt="Aadhar Image" width="80" height="80"></td>
                                <td><?= $agent['pan_no'] ?></td>
                                <td><img src="<?= base_url('writable/uploads/Pan_images/' . $agent['pan_files']) ?>"
                                        alt="Pan Image" width="80" height="80"></td>
                                <td><?= $agent['sub_agent_count'] ?></td>

                                <td>
                                    <?php if (session('role') == '2'): ?>
                                        <!-- Display only the "View" button for role 2 -->
                                        <a data-target="#viewAgentListModal" class="view btn btn-outline-info"
                                            data-toggle="modal">
                                            <i class="material-icons" data-id="<?= $agent['id'] ?>" data-toggle="tooltip"
                                                title="View">View</i>
                                        </a>
                                        <?php if ($agent['sub_agent_count'] > 0): ?>
                                            <a data-target="#getsubAgentDetails" class="subagentdetails btn btn-outline-primary"
                                                data-toggle="modal">
                                                <i class="material-icons" data-toggle="tooltip" title="get_subagent_details">View
                                                    SubAgent</i>
                                            </a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <!-- Display "Edit" and "Delete" actions for other roles -->
                                        <?php if ($agent['sub_agent_count'] > 0): ?>
                                            <a data-target="#getsubAgentDetails" class="subagentdetails btn btn-outline-primary"
                                                data-toggle="modal">
                                                <i class="material-icons" data-toggle="tooltip" title="get_subagent_details">View
                                                    SubAgent</i>
                                            </a>
                                        <?php endif; ?>
                                        <a data-target="#editProductModal" class="edit btn btn-outline-warning"
                                            data-toggle="modal">
                                            <i class="material-icons" data-toggle="tooltip" title="get_agent_details">Edit</i>
                                        </a>
                                        <a data-target="#deleteProductModal" class="delete btn btn-outline-danger"
                                            data-toggle="modal">
                                            <i class="material-icons" data-toggle="tooltip" title="Delete">Delete</i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- View Agent Modal HTML -->

<!-- Modal -->
<div class="modal fade" id="viewAgentListModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agent List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Display agent list here -->
                <table class="table table-striped">
                    <!-- Table headers here -->
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Mobile No</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Aadhar No</th>
                            <th>Pan No</th>
                            <th>No of sub agents</th>
                            <!-- Add other columns here -->
                        </tr>
                    </thead>
                    <tbody id="agentListTableBody">
                        <!-- Agent data will be displayed here -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit Agent Modal HTML -->
<div id="editProductModal" class="modal fade ">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="x_content">
                <form class="" action="<?php echo base_url() . 'agentadmin/update' ?>" method="POST"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Agent Info</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 justify-content-around align-items-center p-3">
                            <div class="col-md-6">
                                <label class="col-form-label  label-align">Agent Name<span
                                        class="required">*</span></label>
                                <input type="hidden" name="edit_id" id="edit_id">
                                <input class="form-control" id="name" name="name" placeholder="Enter Agent Name"
                                    pattern="[A-Za-z]+" title="Please enter only characters (letters)" required />
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label  label-align">Mobile No</label>
                                <input class="form-control" type="text" class='number' id="mobile" name="mobile"
                                    required='required' pattern="[0-9]{10}" title="Please enter a 10-digit number"
                                    maxlength="10">
                            </div>
                        </div>
                    </div>

                    <!-- Agent (Email & Account no) -->
                    <div class="row">
                        <div class="col-lg-12 justify-content-around align-items-center p-3">
                            <div class="col-md-6">
                                <label class="col-form-label  label-align">Email<span class="required">*</span></label>
                                <input class="form-control" type="email" class='number' id="email" name="email"
                                    required='required'>
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label  label-align">Account No</label>
                                <input class="form-control" type="text" class='number' id="account_no" name="account_no"
                                    required='required' maxlength="16" title="Please Enter a 16 digit number">
                            </div>
                        </div>
                    </div>

                    <!-- Agent (GST & Address) -->
                    <div class="row">
                        <div class="col-lg-12 justify-content-around align-items-center p-3">
                            <div class="col-md-6">
                                <label class="col-form-label  label-align">GST No<span class="required">*</span></label>
                                <input class="form-control" maxlength="16" required='required' type="text"
                                    class='number' id="editgst_no" name="gst_no">
                            </div>
                            <div class="col-md-6">
                                <label class="col-form-label  label-align">Address</label><span
                                    class="required">*</span>
                                <div>
                                    <textarea name='address' id="address" required
                                        style="width: -webkit-fill-available"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Agent (Adharcard & Image) -->
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-around align-items-center p-3 ">
                            <div class="col-md-6 bg-light">
                                <label class="col-form-label  label-align">Aadhar No<span
                                        class="required">*</span></label>
                                <input class="form-control" type="text" class="number mb-3" id="editAdhar"
                                    name="editAdhar" maxlength="12" required pattern="[0-9]{12}"
                                    title="Please Enter a 12 digit number">
                            </div>
                            <div class="col-md-6 bg-light">
                                <label class="col-form-label  label-align">Pan No<span class="required">*</span></label>

                                <input class="form-control panInput" type="text" class='number' id="editPan"
                                    name="editPan" required maxlength="10" regex="[A-Z]{5}[0-9]{4}[A-Z]{1}"
                                    title="please enter a alpha numeric number">
                                <div class="panError text-danger font-weight-bold font-size-18"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Agent (Adharcard File Upload & Pan file upload) -->
                    <div class="row">
                        <div class="col-lg-12 d-flex justify-content-around align-items-center p-3 ">
                            <div class="col-md-6 bg-light">
                                <label class="col-form-label  label-align">Aadhar Files<span
                                        class="required">*</span></label>
                                <input type="file" class="form-control mb-3" id="editAdharfiles" name="editAdharfiles"
                                    data-default-src="" data-url="" alt="Adhar Files">
                            </div>

                            <div class="col-md-6 bg-light">
                                <label class="col-form-label  label-align">Pan Files<span
                                        class="required">*</span></label>
                                <input type="file" class="form-control mb-3" id="editPanFiles" name="editpanFiles"
                                    data-default-src="" data-url="" alt="Pan Files">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 p-3">
                            <label class="h6">Percentage Of Agent:</label>
                        </div>
                        <div class="col-lg-12 justify-content-around align-items-center p-3">
                            <div class="col-md-4">
                                <label class="h6">Private</label>
                                <input class="form-control rounded" name="private" id="private" required type="number"
                                    step="any" pattern="\d+(\.\d+)?">
                            </div>
                            <div class="col-md-4">
                                <label class="h6">Goverment</label>
                                <input class="form-control rounded" name="goverment" id="goverment" required
                                    type="number" step="any" pattern="\d+(\.\d+)?">
                            </div>
                            <div class="col-md-4">
                                <label class="h6">SEP</label>
                                <input class="form-control rounded" name="files" id="files" required type="number"
                                    step="any" pattern="\d+(\.\d+)?">
                            </div>
                        </div>
                    </div>

                    <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button type='submit' class="btn btn-primary">Submit</button>
                                <button type='reset' class="btn btn-success">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end of edit agent model-->

<!-- View Subagent Modal -->
<div id="getsubAgentDetails" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">SubAgent Details</h5>
                <?php if (session('role') == '1'): ?>
                    <a class="add-subagent btn btn-outline-primary" data-agent-id="" data-target="#addSubagentModal"
                        data-toggle="modal">
                        <i class="material-icons" data-toggle="tooltip" title="Add">Add</i>
                    </a>
                <?php endif ?>
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
                            <?php if (session('role') == '1'): ?>
                                <th>Actions</th>
                            <?php endif; ?>
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


<!-- Delete Modal for Agent -->
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


<!-- Delete Modal for Subagent-->
<div id="deleteSubagentModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteFormSubagent" method="post" action="">
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

<!--Add Subagent Modal-->

<div id="addSubagentModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="x_content">
                <form class="" action="<?php echo base_url() . 'agentadmin/insertsubagent' ?>" method="POST">
                    <span class="section">Add Subagent Details</span>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="field item form-group">
                                <input type="hidden" name="agent_id" id="agent_id">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" required='required' class="form-control" id="SubagentName"
                                        name="SubagentName">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Phone</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" class="form-control" id="SubagentPhone" name="SubagentPhone">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Email</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="email" class="form-control" id="SubagentEmail" name="SubagentEmail">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span
                                        class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea class="form-control" required='required' id="SubagentAddress"
                                        name="SubagentAddress"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Has GST</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="checkbox" id="hasGst" name="hasGst">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6" id="gstInputBox" style="display:none;">
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">GST Number</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" required='required' class="form-control" id="SubagentGstNumber"
                                        name="SubagentGstNumber">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Aadhar No</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="number" required='required' class="form-control"
                                        id="SubagentadharNumber" name="SubagentadharNumber">
                                </div>
                            </div>

                            <div id="popup7" style="display: none;">
                                <p>Please enter a valid 12 digit Aadhar card number.</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="field item form-group m-2">
                                <label class="h6 col-form-label col-md-3 col-sm-3 label-align">Aadhar Files:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control rounded" id="subadhar_files" name="subadhar_files"
                                        type="file">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Pan Number</label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" required='required' class="form-control panInput"
                                        regex="[A-Z]{5}[0-9]{4}[A-Z]{1}" maxlength="10" id="SubagentpanNumber"
                                        name="SubagentpanNumber">
                                    <div class="panError text-danger font-weight-bold font-size-18"></div>

                                </div>
                            </div>

                            <!--<div id="popup8" style="display: none;">-->
                            <!--    <p>Please enter a valid 10 digit Pan card number.</p>-->
                            <!--</div>-->
                        </div>

                        <div class="col-md-6">
                            <div class="field item form-group m-2">
                                <label class="h6 col-form-label col-md-3 col-sm-3 label-align">Pan Files:</label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control rounded" id="subpan_files" name="subpan_files"
                                        type="file">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button type='submit' class="btn btn-primary">Submit</button>
                                <button type='reset' class="btn btn-success">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!--Edit Subagent Modal-->

<div id="editSubagentModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="x_content">
                <form class="" action="<?php echo base_url() . 'agentadmin/updatesubagent' ?>" method="POST">

                    <span class="section">Edit Subagent Details</span>
                    <div class="field item form-group">
                        <input type="hidden" name="subagent_id" id="editSubagentId">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Name<span
                                class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" required='required' id="editSubagentName"
                                name="editSubagentName">
                        </div>
                    </div>



                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Phone</label>
                        <div class="col-md-6 col-sm-6">
                            <input type="tel" pattern="[0-9]{10}" maxlength="10" class="form-control"
                                required="required" id="editSubagentPhone" name="editSubagentPhone">
                            <small class="text-danger">Enter a 10-digit phone number.</small>
                        </div>
                    </div>

                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Email</label>
                        <div class="col-md-6 col-sm-6">
                            <input type="text" class="form-control" required='required' id="editSubagentEmail"
                                name="editSubagentEmail">
                        </div>
                    </div>




                    <div class="field item form-group">
                        <label class="col-form-label col-md-3 col-sm-3  label-align">Address<span
                                class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <textarea class="form-control" required='required' id="editSubagentAddress"
                                name="editSubagentAddress"></textarea>
                        </div>
                    </div>
                    <div class="ln_solid">
                        <div class="form-group">
                            <div class="col-md-6 offset-md-3">
                                <button type='submit' class="btn btn-primary">Submit</button>
                                <button type='reset' class="btn btn-success">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    #popup {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    #popup1 {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    #popup2 {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    #popup3 {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    #popup4 {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    #popup5 {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    #popup6 {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    #popup7 {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    #popup8 {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }
</style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->

<script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
    // Function to close the currently open modal, if any
    function closeModal() {
        $('.modal').modal('hide');
    }

    // Function to open a modal
    function openModal(modalId) {
        closeModal(); // Close any existing modal
        $(modalId).modal('show'); // Open the specified modal
    }

    // Event handler for clicking the "View SubAgent" button
    $('.subagentdetails').click(function () {
        openModal('#getsubAgentDetails');
    });

    // Event handler for clicking the "Add SubAgent" button
    $('.add-subagent').click(function () {
        openModal('#addSubagentModal');
    });
</script>
<script>
    // Event handler for clicking the "Edit Subagent" button inside the subagent modal
    $(document).on('click', '.edit-subagent', function () {
        // Close the current modal (subagent details modal)
        $('#getsubAgentDetails').modal('hide');

        // Open the "Edit Subagent" modal
        $('#editSubagentModal').modal('show');

        // Add code to handle editing the subagent here
    });

    // Event handler for clicking the "Delete Subagent" button inside the subagent modal
    $(document).on('click', '.delete-subagent', function () {
        // Close the current modal (subagent details modal)
        $('#getsubAgentDetails').modal('hide');

        // Open the "Delete Subagent" modal
        $('#deleteSubagentModal').modal('show');

        // Add code to handle deleting the subagent here
    });

</script>
<script>
    $(document).ready(function () {
        $('.panInput').on('input', function () {
            var pan = $(this).val().toUpperCase(); // Convert input to uppercase for consistent pattern matching
            var $errorDiv = $(this).siblings('.panError'); // Find the corresponding error message div

            if (/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/.test(pan)) {
                $errorDiv.text(''); // Clear error message if PAN is valid
            } else {
                $errorDiv.text('Please enter a alpha numeric number'); // Show error message if PAN format is invalid
            }
        });
    });
</script>

<script>
    document.querySelectorAll(".SubagentpanNumber").forEach(function (input) {
        input.addEventListener("input", function () {
            var panNumber = this.value.trim();
            var regex = /^[A-Za-z]{5}\d{4}[A-Za-z]{1}$/; // Regular expression for PAN number validation

            if (regex.test(panNumber)) {
                // Valid PAN number format
                this.closest(".col-md-6").querySelector(".popup8").style.display = "none";
            } else {
                // Invalid PAN number format
                this.closest(".col-md-6").querySelector(".popup8").style.display = "block";
            }
        });
    });

</script>
<script>
    const textInput = document.getElementById('textInput');

    textInput.addEventListener('input', function () {
        const inputValue = this.value;
        const regex = /^[^0-9]*$/; // Regex pattern to allow only non-numeric characters

        if (!regex.test(inputValue)) {
            // If the input contains numbers, remove them
            this.value = inputValue.replace(/[0-9]/g, '');
        }
    });

    const editSubagentName = document.getElementById('editSubagentName');

    editSubagentName.addEventListener('input', function () {
        const inputValue = this.value;
        const regex = /^[^0-9]*$/; // Regex pattern to allow only non-numeric characters

        if (!regex.test(inputValue)) {
            // If the input contains numbers, remove them
            this.value = inputValue.replace(/[0-9]/g, '');
        }
    });

    const SubagentName = document.getElementById('SubagentName');

    SubagentName.addEventListener('input', function () {
        const inputValue = this.value;
        const regex = /^[^0-9]*$/; // Regex pattern to allow only non-numeric characters

        if (!regex.test(inputValue)) {
            // If the input contains numbers, remove them
            this.value = inputValue.replace(/[0-9]/g, '');
        }
    });
</script>

<script>
    const name = document.getElementById('name');

    name.addEventListener('input', function () {
        const inputValue = this.value;
        const regex = /^[^0-9]*$/; // Regex pattern to allow only non-numeric characters

        if (!regex.test(inputValue)) {
            // If the input contains numbers, remove them
            this.value = inputValue.replace(/[0-9]/g, '');
        }
    });
</script>

<script>
    const numericInput = document.getElementById('numericInput');

    numericInput.addEventListener('input', function () {
        // Remove non-numeric characters using a regular expression
        this.value = this.value.replace(/[^0-9]/g, '');

        // Limit the input to 10 characters
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });
    const SubagentPhone = document.getElementById('SubagentPhone');

    SubagentPhone.addEventListener('input', function () {
        // Remove non-numeric characters using a regular expression
        this.value = this.value.replace(/[^0-9]/g, '');

        // Limit the input to 10 characters
        if (this.value.length > 10) {
            this.value = this.value.slice(0, 10);
        }
    });
</script>
<script>

    document.getElementById('numericaccount').addEventListener('input', function () {
        var accountNumber = this.value.trim();

        // Limit the input to 15 characters
        if (accountNumber.length > 16) {
            accountNumber = accountNumber.substring(0, 16);
            this.value = accountNumber; // Update the input field
        }

        // Allow only numbers
        var isValidAccount = /^[0-9]+$/.test(accountNumber);

        if (isValidAccount) {
            document.getElementById('popup3').style.display = 'none';
        } else {
            document.getElementById('popup3').style.display = 'block';
        }
    });

</script>
<script>

    document.getElementById('account_no').addEventListener('input', function () {
        var accountNumber = this.value.trim();

        // Limit the input to 15 characters
        if (accountNumber.length > 16) {
            accountNumber = accountNumber.substring(0, 16);
            this.value = accountNumber; // Update the input field
        }

        // Allow only numbers
        var isValidAccount = /^[0-9]+$/.test(accountNumber);

        if (isValidAccount) {
            document.getElementById('popup3').style.display = 'none';
        } else {
            document.getElementById('popup3').style.display = 'block';
        }
    });

</script>
<script>
    document.getElementById('gst_no').addEventListener('input', function () {
        var gstNo = this.value.trim();

        // Limit the input to 15 characters
        if (gstNo.length > 15) {
            gstNo = gstNo.substring(0, 15);
            this.value = gstNo; // Update the input field
        }

        var isValidGst = /^[0-9a-zA-Z!@#$%^&*()_+{}\[\]:;<>,.?~\\-]{15}$/.test(gstNo);

        if (isValidGst) {
            document.getElementById('popup2').style.display = 'none';
        } else {
            document.getElementById('popup2').style.display = 'block';
        }
    });
    document.getElementById('SubagentGstNumber').addEventListener('input', function () {
        var gstNo = this.value.trim();

        // Limit the input to 15 characters
        if (gstNo.length > 15) {
            gstNo = gstNo.substring(0, 15);
            this.value = gstNo; // Update the input field
        }

        var isValidGst = /^[0-9a-zA-Z!@#$%^&*()_+{}\[\]:;<>,.?~\\-]{15}$/.test(gstNo);

        if (isValidGst) {
            document.getElementById('popup5').style.display = 'none';
        } else {
            document.getElementById('popup5').style.display = 'block';
        }
    });
    document.getElementById('gst_no').addEventListener('input', function () {
        var gstNo = this.value.trim();

        // Limit the input to 15 characters
        if (gstNo.length > 15) {
            gstNo = gstNo.substring(0, 15);
            this.value = gstNo; // Update the input field
        }

        var isValidGst = /^[0-9a-zA-Z!@#$%^&*()_+{}\[\]:;<>,.?~\\-]{15}$/.test(gstNo);

        if (isValidGst) {
            document.getElementById('popup2').style.display = 'none';
        } else {
            document.getElementById('popup2').style.display = 'block';
        }
    });
</script>
<script>
    document.getElementById('pan_input').addEventListener('input', function () {
        var panInput = this.value.trim();

        // Limit the input to 10 characters
        if (panInput.length > 10) {
            panInput = panInput.substring(0, 10);
            this.value = panInput; // Update the input field
        }

        var isValidPan = /^[0-9a-zA-Z]{10}$/.test(panInput);

        if (isValidPan) {
            document.getElementById('popup1').style.display = 'none';
        } else {
            document.getElementById('popup1').style.display = 'block';
        }
    });
    document.getElementById('SubagentpanNumber').addEventListener('input', function () {
        var panInput = this.value.trim();

        // Limit the input to 10 characters
        if (panInput.length > 10) {
            panInput = panInput.substring(0, 10);
            this.value = panInput; // Update the input field
        }

        var isValidPan = /^[0-9a-zA-Z]{10}$/.test(panInput);

        if (isValidPan) {
            document.getElementById('popup8').style.display = 'none';
        } else {
            document.getElementById('popup8').style.display = 'block';
        }
    });
</script>

<script>
    // Function to show/hide GST input box based on checkbox state
    function toggleGstInputBox() {
        var isChecked = document.getElementById('hasGst').checked;
        var gstInputBox = document.getElementById('gstInputBox');

        // Show/hide the GST input box based on checkbox state
        if (isChecked) {
            gstInputBox.style.display = 'block';
        } else {
            gstInputBox.style.display = 'none';
        }
    }

    // Add event listener to the checkbox to call the function when checkbox is clicked
    document.getElementById('hasGst').addEventListener('click', toggleGstInputBox);
</script>

<script>
    document.getElementById('adhar_input').addEventListener('input', function () {
        var aadharInput = this.value.trim();

        // Limit the input to 12 characters
        if (aadharInput.length > 12) {
            aadharInput = aadharInput.substring(0, 12);
            this.value = aadharInput; // Update the input field
        }

        var isValidAadhar = /^\d{12}$/.test(aadharInput);

        if (isValidAadhar) {
            document.getElementById('popup').style.display = 'none';
        } else {
            document.getElementById('popup').style.display = 'block';
        }
    });

    document.getElementById('SubagentadharNumber').addEventListener('input', function () {
        var aadharInput = this.value.trim();

        // Limit the input to 12 characters
        if (aadharInput.length > 12) {
            aadharInput = aadharInput.substring(0, 12);
            this.value = aadharInput; // Update the input field
        }

        var isValidAadhar = /^\d{12}$/.test(aadharInput);

        if (isValidAadhar) {
            document.getElementById('popup7').style.display = 'none';
        } else {
            document.getElementById('popup7').style.display = 'block';
        }
    });


</script>

<script>
    // document.getElementById("agent_gst").onchange = function() {
    //     var gstFieldsContainer = document.getElementById("gst_fields_container");
    //     if (this.checked) {
    //         gstFieldsContainer.style.display = "block";
    //     } else {
    //         gstFieldsContainer.style.display = "none";
    //     }
    // };
</script>

<script>

    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var id = $(this).parent().siblings()[0].value;

        $.ajax({
            url: "<?= base_url(); ?>" + "agentadmin/edit/" + id,
            method: 'GET',
            success: function (result) {
                var res = JSON.parse(result);
                console.log(result);
                // Update the input fields with the retrieved data
                $("#name").val(res.name);
                $("#mobile").val(res.phone_no);
                $("#email").val(res.email);
                $("#account_no").val(res.account_no);
                $("#address").val(res.address);
                $("#private").val(res.PVT);
                $("#goverment").val(res.GOVT);
                $("#files").val(res.SEP);
                $("#editgst_no").val(res.gst_no);
                $("#editAdhar").val(res.adhar_no);
                $("#editPan").val(res.pan_no);
                $("#edit_id").val(res.id);

                // Check if the adhar_files field is not empty
                if (res.adhar_files) {
                    var adharImageUrl = "<?= base_url('writable/uploads/Aadhar_images/') ?>" + res.adhar_files;
                    // Set the image source
                    $("#editAdharfile").attr("src", adharImageUrl);
                    // Set the width and height
                    $("#editAdharfile").css("width", "100%");
                    $("#editAdharfile").css("height", "100%");
                }

                // Fetch and display the Pan image
                if (res.pan_files) {
                    var panImageUrl = "<?= base_url('writable/uploads/Pan_images/') ?>" + res.pan_files;
                    // Set the image source
                    $("#editpanfile").attr("src", panImageUrl);
                    // Set the width and height
                    $("#editpanfile").css("width", "100%");
                    $("#editpanfile").css("height", "100%");
                }
            }
        });
    });


    $(document).on('click', '.add-subagent', function (e) {
        e.preventDefault();
        var agentId = $(this).data('agent-id'); // Retrieve the agent ID from the "Add" button's data attribute
        $('#agent_id').val(agentId); // Set the agent ID in the hidden input field
        $('#addSubagentModal').modal('show'); // Show the modal
    });

    // Existing code...

    $(document).on('click', '.subagentdetails', function (e) {
        e.preventDefault();
        var id = $(this).parent().siblings()[0].value;
        // alert(id);
        // Existing code...
    });

    // New function to handle View Subagent button click
    $(document).on('click', '.subagentdetails', function (e) {
        e.preventDefault();
        var id = $(this).parent().siblings('input[type="hidden"]').val();
        $('.add-subagent').data('agent-id', id);
        // alert(id);
        $.ajax({
            url: "<?= base_url('agentadmin/getSubAgent'); ?>", // Update the URL to call the controller method
            method: 'POST',
            data: { agent_id: id },
            dataType: 'json',
            success: function (result) {
                var subagentCount = result.subagent_count;
                var subagents = result.subagents;

                if (subagentCount > 0) {
                    // $('#getsubAgentDetails').modal('show');

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
                            <?php if (session('role') == '1'): ?>
                            "<td>" +
                                "<a class='btn btn-outline-warning btn-sm edit-subagent' data-id='" + subagent.id + "' data-target='#editSubagentModal' data-toggle='modal'>Edit</a>" +
                                "<a class='btn btn-outline-danger btn-sm delete-subagent' data-id='" + subagent.id + "' data-target='#deleteSubagentModal' data-toggle='modal'>Delete</a>" +
                                "</td>" +
                                <?php
                            endif;
                            ?>
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


    // Edit Subagent Functionality
    $(document).on('click', '.edit-subagent', function () {
        var subagentId = $(this).data('id');

        // Make an AJAX request to retrieve the subagent details
        $.ajax({
            url: "<?= base_url(); ?>" + "agentadmin/getsubagentedit/" + subagentId,
            method: 'POST',
            data: { subagent_id: subagentId },
            dataType: 'json',
            success: function (result) {
                console.log('Received Data:', result);

                // Assuming you have the subagent details in 'result' object

                // Populate the modal form fields with subagent data
                $('#editSubagentId').val(result.id);
                $('#editSubagentName').val(result.name);
                $('#editSubagentPhone').val(result.phone_no);
                $('#editSubagentEmail').val(result.email);
                $('#editSubagentAddress').val(result.address);
                // Fill other form fields with respective subagent data

                // Show the modal
                $('#editSubagentModal').modal('show');
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', xhr.responseText);
            }
        });
    });

    $(document).on('click', '.delete-subagent', function () {
        var subagentId = $(this).data('id');
        console.log(subagentId);
        $('#deleteFormSubagent').attr('action', 'deletesubagent/' + subagentId);
        $('#deleteSubagentModal').modal('show');
        // Perform the delete operation using the subagentId
        // ...
    });



    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        var id = $(this).parent().siblings()[0].value;



        $('#deleteForm').attr('action', 'delete/' + id);
        $('#deleteProductModal').modal('show');
    });


    // Delete functionality of Subagent
    $('#deleteFormSubagent').on('click', '.submit', function (e) {
        e.preventDefault();

        var form = $(this);
        var actionUrl = form.attr('action');

        $.ajax({
            url: actionUrl,
            method: 'POST',
            dataType: 'json',
            success: function (result) {
                var res = JSON.parse(result);
                console.log(res);
                location.reload();
                // $("#delete_id").val(res.id);
            }

        });
    });


    // Delete functionality for Agent
    $('#deleteForm').on('click', '.submit', function (e) {
        e.preventDefault();

        var form = $(this);
        var actionUrl = form.attr('action');

        $.ajax({
            url: actionUrl,
            method: 'POST',
            dataType: 'json',
            success: function (result) {
                var res = JSON.parse(result);
                console.log(res);
                location.reload();
                // $("#delete_id").val(res.id);
            }

        });
    });


    $(document).ready(function () {
        $('.subagent').hide();
        $('.subagentSubmit').hide();
        new DataTable('#datatable1');
        $('#subagents').on('change', function () {
            if ($(this).is(':checked')) {
                $('#agent_submit').hide();
                $('#subagentsform').show();
                $('.subagent').show();
                $('.subagentSubmit').show();
            } else {
                $('#agent_submit').show();
                $('#subagentsform').hide();
                $('.subagent').hide();
                $('.subagentSubmit').hide();
            }
        });
    });



    $(document).ready(function () {
        new DataTable('#datatable1');
        $('#subagents').on('change', function () {
            if ($(this).is(':checked')) {
                $('#agent_submit').hide();
                $('#subagentsform').show();
            } else {
                $('#agent_submit').show();
                $('#subagentsform').hide();
            }
        });
    });

    $(document).ready(function () {
        $('#subagentsform').hide();
        $('.aadharno').hide();
        $('.panno').hide();
        $('.gstno').hide();
    });



    $(document).ready(function () {
        $('#numberOfFields').on('input', function () {
            var numberOfFields = parseInt($(this).val());
            var tableBody = $('#datatable tbody');
            tableBody.empty(); // Clear any existing rows in the table

            for (var i = 1; i <= numberOfFields; i++) {
                var newRow = $('<tr>');
                var subAgentNameCell = $('<td>').append($('<input type="text" class="form-control" name="subAgentName[]" placeholder="Sub Agent Name" required>'));
                var mobileNumberCell = $('<td>').append($('<input type="number" class="form-control" name="mobileNumber[]" placeholder="Mobile Number" required>'));
                var emailCell = $('<td>').append($('<input type="text" class="form-control" name="email[]" placeholder="Email" required>'));
                var addressCell = $('<td>').append($('<input type="text" class="form-control" name="subagent_address[]" placeholder="Address" required>'));
                // var showDetailsCell = $('<td>').append('<input type="checkbox" class="show-details-checkbox"> Has GST');

                var AadharNo = $('<td class="aadhar-details">').append($('<input type="text" class="form-control aadharno" name="subaadhar_no[]" placeholder="Aadhar No" required>'));
                var PanNo = $('<td class="pan-details">').append($('<input type="text" class="form-control panno" name="subpan_no[]" placeholder="Pan No" required>'));
                var GSTNo = $('<td class="gst-details">').append($('<input type="text" class="form-control gstno" name="gst_number[]" placeholder="GST No" required>'));

                newRow.append(subAgentNameCell, mobileNumberCell, emailCell, addressCell, AadharNo, PanNo, GSTNo);
                tableBody.append(newRow);
            }
        });

        // Event listener for the show details checkboxes
        // $(document).on('change', '.show-details-checkbox', function () {
        //     var isChecked = $(this).prop('checked');
        //     var row = $(this).closest('tr');

        //     row.find('.aadhar-details, .pan-details, .gst-details').toggle(isChecked);
        // });
    });
    // }


    // <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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




<script>
    $(document).ready(function () {
        // Add an event listener for the email input field
        $('#aemail').on("input", function () {
            validateEmail($(this), $('#email-error-msg'));
        });
    });

    function validateEmail(inputField, errorMessageElement) {
        // Get the value of the email input
        var emailValue = inputField.val();

        // Use a regular expression to validate the email format
        var emailRegex = /^[^\d][^\s@]+@[^\s@]+\.[^\s@]+$/;
        var isValidEmail = emailRegex.test(emailValue);

        // Show/hide the error message and apply appropriate classes
        var errorMessage = isValidEmail ? "" : "Please enter a valid email address without starting with a number.";
        inputField.toggleClass("is-invalid", !isValidEmail);
        errorMessageElement.text(errorMessage);
    }


</script>
<script>
    $(document).on('click', '.view', function () {
        var agentId = $(this).parent().siblings('input[type="hidden"]').val();
        // alert(agentId);
        // Make an AJAX request to fetch agent details by ID
        $.ajax({

            url: "<?= base_url(); ?>" + "agentadmin/view",
            method: 'POST',
            data: { id: agentId },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                // Populate the modal with agent data
                var agentListTableBody = $('#agentListTableBody');
                agentListTableBody.empty();

                // Loop through the data and create rows for the table

                var row = '<tr>' +
                    '<td>' + 1 + '</td>' +
                    '<td>' + data.name + '</td>' +
                    '<td>' + data.phone_no + '</td>' +
                    '<td>' + data.email + '</td>' +
                    '<td>' + data.address + '</td>' +
                    '<td>' + data.adhar_no + '</td>' +
                    '<td>' + data.pan_no + '</td>' +
                    '<td>' + data.sub_agent_count + '</td>' +
                    // Add other columns here
                    '</tr>';
                agentListTableBody.append(row);


                // Show the modal
                $('#viewAgentListModal').modal('show');
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
            }
        });
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const emailInput = document.querySelector('input[name="aemail"]');
        const emailErrorMsg = document.getElementById('email-error-msg');

        console.log("Email Input:", emailInput);
        console.log("Email Error Msg:", emailErrorMsg);

        emailInput.addEventListener('input', function () {
            const email = emailInput.value.trim();

            if (email !== '') {
                // Log the fetch request details
                console.log("Fetch URL:", "<?= base_url(); ?>" + "agentadmin/checkEmail");
                console.log("Payload:", JSON.stringify({ email: email }));

                // Send an AJAX request to the server
                fetch("<?= base_url(); ?>" + "agentadmin/checkEmail", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ email: email }),
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Data:", data);
                        console.log("Exists:", data.exists);

                        if (data.exists) {
                            console.log("Email already exists.");
                            emailErrorMsg.textContent = 'Email already exists.';
                            emailErrorMsg.style.display = 'block';
                        } else {
                            console.log("Email is valid.");
                            emailErrorMsg.textContent = '';
                            emailErrorMsg.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Handle other potential errors here
                    });
            }
        });
    });


</script>
<?= $this->endSection(); ?>