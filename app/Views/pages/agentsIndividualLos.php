<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content')?>
<h3>Upload Individual Agent Los Sheet</h3>
	<div class="s" role="main">
        <div class="">
          <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="mt-4">
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <form class="" action="<?= base_url().'agentindividualadmin/uploadindividualexcel'?>" enctype="multipart/form-data" method="POST">
                                <!-- <span class="section">Bank Info</span> -->
                                <div class="field item form-group col-md-10">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Select Agent ID<span class="text-danger">*</span></label>
                                    <div class="col-md-6 col-sm-6">
									<select onchange="agentidChange()" name="agentid" id="agentid" class="form-control agentid" required>
                                            <option value="">Choose..</option>
                                            <?php
                                            if ($users) {
                                                $i = 1;
                                                foreach ($users as $user) {
                                                    ?>
                                                    <option value="<?= $user['user_id'] ?>"><?= $user['user_id'] ?></option>
                                                <?php
                                                }
                                            }
                                            ?>
                                    </select>
                                </div>
                                    <button class="btn btn-outline-success" onclick="downloadClick()">Download Common Template</button>
                                </div>
                                
                                <div class="field item form-group col-md-10">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Agent Name<span class="text-danger">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input type="text" name="agentNameTextBox" readonly class="form-control" id="agentNameTextBox">
                                    </div>
                                </div>

                                <div class="field item form-group col-md-10">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Upload Master Sheet<span class="text-danger">*</span></label>
                                    <div class="mb-3 col-md-6">
                						<input type="file" name="file" class="form-control" id="file" required>
                					</div>	
                                 </div>
                                <div>
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type='submit' name="submit" class="btn btn-primary">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            
                             <div class="mt-2">
                                <?php if (session()->has('message')){ ?>
                                    <div class="alert alert-dismissible fade show <?=session()->getFlashdata('alert-class') ?>" role="alert">
                                        <?=session()->getFlashdata('message') ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                         </button>
                                    </div>
                                <?php } ?>
                                <?php $validation = \Config\Services::validation(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
   function agentidChange() {
        var selectedAgentId = document.getElementById("agentid").value;
        if (selectedAgentId !== "") {
            // Make an AJAX request to fetch the agent name
            $.ajax({
                url: "<?= base_url('agentindividualadmin/getagent/') ?>" + selectedAgentId,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    // Update the textbox with the fetched agent name
                    console.log(data);
                    
                    if (data !== null) {
                        $("#agentNameTextBox").val(data.name);
                    } else {
                        $("#agentNameTextBox").val("Agent Name Not Found");
                    }
                },
                error: function() {
                    $("#agentNameTextBox").val("Error Fetching Agent Name");
                }
            });
        } else {
            // Clear the textbox if no agent ID is selected
            $("#agentNameTextBox").val("");
        }
    }
    
    function downloadClick() {
    // Send an AJAX GET request to the download URL
    $.ajax({
        url: "<?= base_url('agentindividualadmin/download_excel') ?>",
        method: "GET",
        success: function(data) {
            console.log(data);
            // On success, you can perform any additional actions
            console.log("File download initiated");
            window.location.href = "<?= base_url('agentindividualadmin/download_excel') ?>";
        },
        error: function() {
            // Handle errors if the download request fails
            console.error("Error initiating file download");
        }
    });
}
</script>
<?= $this->endSection()?>