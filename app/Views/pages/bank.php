<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content') ?>
<!-- <div class="container-fluid"> -->

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
                    
                
    <!-- Page Heading -->

    <div class="s" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Bank Details</h3>
                </div>
            </div>
            <div class="clearfix"></div>
                            <div class="row m-3">
                                 <div class="col-md-12">
                                <div class="container p-5 bg-white borderd col-sm-6 shadow rounded">
                                    <div class="container-fluid">
                                        <form action="<?php echo base_url().'admin/savedata';?>" method="POST">
                                            
                                            <div class="col-md-6">
                                                    <div class="m-2">
                                                        <label class="h6">Bank Name<span class="text-danger">*</span></label>
                                                        <input class="form-control rounded textInputs" data-validate-length-range="6"
                                            data-validate-words="2" name="name" id="textInput" placeholder="Enter Bank Name"
                                            required="required" type="text"/>
                                                    </div>
                                                    <div class="m-2">
                                                        <label class="h6">State<span class="text-danger">*</span></label>
                                                <input class="form-control rounded" name="branch"
                                                       pattern="[A-Za-z\s]+" 
                                                       title="Only letters and spaces are allowed"
                                                       required='required' placeholder="Enter State Name" type="text">
                                                     </div>
                                                 </div>
                                                 
                                                   <div class="col-md-6"> 
                                                    <div class="m-2">
                                                        <label class="h6">Number of Scheme</label>
                                                        <input class="form-control rounded" data-validate-length-range="6" data-validate-words="2" name="schemano" placeholder="No. Of Scheme" type="number" id="numberOfschema" />
                                                    </div>
                                                    <div id="schema" class="m-2"></div>
                                                    
                                                    <div class="m-2">
                                                        <label class="h6">From Date<span class="text-danger">*</span></label>
                                                        <input class="form-control rounded" onchange="datechange()" id="from_date" name="from_date"
                                                         required='required' type="date">
                                                    </div>
                                                    
                                                    <div class="m-2 d-flex justify-content-evenly">
                                                        <button type='submit' class="btn btn-outline-success">Submit</button>
                                                        <button type='reset' class="btn btn-outline-danger">Reset</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                              </div>
                          </div>
                      </div>

    <div class="x_content">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>State</th>
                                <th>Actions</th>
                            </tr>
                            
                        </thead>
                                <tbody>
                                    <?php
                                    if($users)
                                    {
                                        $i=1;
                                        foreach($users as $user)
                                        {
                                            
                                            ?>
        
                                    <tr>
                                        <input type="hidden" value="<?= $user['id'] ?> ">
                                        
                                        <td><?php echo $i++;?>
                                        <td><?= $user['name']?></td>
                                        <td><?= $user['branch']?></td>
                                        <!--<td><?= $user['address']?></td>-->
                                        
                                        <td>
                                        <?php if (session('role') == '2'): ?>
                                    <!-- Don't display the "Edit" button for assigners -->
                                    <a data-target="#viewProductModal" class="view btn btn-outline-info" data-toggle="modal">
                                            <i class="material-icons"  data-id="<?= $user['id'] ?>" data-toggle="tooltip" title="View">View</i>
                                        </a>
                                <?php else: ?>
                                    <a 
                                                data-target="#editProductModal" class="edit btn btn-outline-warning" data-toggle="modal"><i
                                                    class="material-icons" data-toggle="tooltip" title="Edit">Edit</i></a>
        
                                            <a
                                                data-target="#deleteProductModal" class="delete btn btn-outline-danger" data-toggle="modal"><i
                                                 data-id="<?= $user['id'] ?>" data-toggle="tooltip" title="Delete">Delete</i></a>
                                        </td>
                                <?php endif; ?>
                                         
                                    </tr>
                                    <?php
                                      } $i++;
                                    }?>
                            </tbody>
                        </table>
                     </div>
                </div>
            </div>
        <!-- Edit Modal HTML -->
        <div id="editProductModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="x_content">
                        <form class="" action="<?php echo base_url().'admin/update'?>" method="POST">
                            
                            <span class="section">Bank Info</span>
                            <div class="field item form-group">
                                <input type="hidden" name="edit_id"  id="edit_id">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Bank Name<span class="text-danger">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control textInputs" 
                                         id="name" name="name"
                                        placeholder="Enter Bank Name" required pattern="[A-Za-z\s]+" title="Please Enter Only Characters" />
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">State<span class="text-danger">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" type="text" class='number' id="branch" 
                                        name="branch" required='required' pattern="[A-Za-z\s]+" title="Please Enter Only Characters">
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
 
<!-- View Modal HTML -->
<div id="viewProductModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Bank Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group d-flex">
                    <label class="form-label me-2"><b>Name:</b></label>
                    <p class="ms-2" id="viewBankName"></p>
                </div>
                <div class="form-group d-flex">
                    <label><b>Branch:</b></label>
                    <p id="viewBranch"></p>
                </div>
                <div class="form-group d-flex">
                    <label><b>Scheme Name(s):</b></label>
                    <p id="viewSchemeNames"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #viewProductModal .modal-body {
    font-size: 18px; /* Change this value to your desired font size */
}
p
{
     font-size: 15px;
}

/* Optionally, you can also increase the font size for the modal title */
#viewProductModal .modal-title {
    font-size: 18px; /* Change this value to your desired font size */
}
</style>


        <!-- Delete Model -->
      
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>   
 <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
 
function datechange(){
  var fromDateInput = document.getElementById("from_date").value;
  
//   alert(fromDateInput);

}
</script>
<script>
    $(document).ready(function () {
        $('.textInputs').on('input', function () {
            // Get the current value of the input
            let inputValue = $(this).val();

            // Convert the entire input value to uppercase
            let uppercaseValue = inputValue.toUpperCase();

            // Set the updated value back to the input
            $(this).val(uppercaseValue);
        });
    });
</script>
<script>
    const textInput = document.getElementById('textInput');
    
    textInput.addEventListener('input', function() {
        const inputValue = this.value;
        const regex = /^[^0-9]*$/; // Regex pattern to allow only non-numeric characters
        
        if (!regex.test(inputValue)) {
            // If the input contains numbers, remove them
            this.value = inputValue.replace(/[0-9]/g, '');
        }
    });
</script>
<script>
$(document).ready(function(){
    $('#numberOfschema').on('input', function(){
        var schemano = parseInt($(this).val());
        console.log(schemano);
        var formbody = $('#schema');
        formbody.empty(); // Clear any existing content before adding new elements
        for (var i = 1; i <= schemano; i++){
            
            var schemaName = $('<input type="text" class="form-control" placeholder="Scheme:-' + i + '" name="schemaName[]"> <br> ');

            formbody.append( schemaName);
        }
    });
});
</script>

    <script>
    $(document).on('click','.edit', function(e){
        e.preventDefault();
        var id = $(this).parent().siblings()[0].value;
        // console.log(id);
        $.ajax({
            url:"<?= base_url(); ?>" + "admin/edit/"+id,
            method:'GET',
            success : function(result) {
                var res = JSON.parse(result);
                console.log(res);
                $("#name").val(res.name);
                $("#branch").val(res.branch);
                $("#address").val(res.address);
                $("#edit_id").val(res.id);
            }
        });
    });



    $(document).on('click', '.delete', function(e) {
    e.preventDefault();
    var id = $(this).parent().siblings()[0].value;
    

    
    $('#deleteForm').attr('action', 'delete/' + id);
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
 $(document).ready(function () {
        new DataTable('#datatable');

        $(document).on('click', '.view', function (e) {
            e.preventDefault();
            // var id = $(this).parent().siblings('input[type="hidden"]').val();
           var id = $(this).parent().siblings()[0].value;
            $.ajax({
                url: "<?= base_url(); ?>" + "admin/view/" + id,
                method: 'GET',
                dataType: 'json',
                success: function (result) {
                    console.log(result);
                    // Extract bank data
                    var bankName = result.bank_id.name;
                    console.log(bankName);
                    var branch = result.bank_id.branch;

                    // Extract scheme names
                    var schemeNames = result.scheme_name.map(function (scheme) {
                        return scheme.scheme_name;
                    });

                    // Update your modal content
                    $('#viewBankName').html(bankName);
                    $('#viewBranch').text(branch);
                    $('#viewSchemeNames').text(schemeNames.join(', ')); // Display scheme names

                    // Show the modal
                    $('#viewProductModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error(xhr, status, error);
                }
            });
        });
    });


    </script>
    
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
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
    <?= $this->endSection(); ?>