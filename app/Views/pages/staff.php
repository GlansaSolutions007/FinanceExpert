<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content')?>
 <style>
                            .password-input {
                                position: relative;
                            }

                            .password-input .form-control {
                                padding-right: 40px;
                                /* Adjust this value to leave space for the icon */
                            }

                            .password-input .toggle-password {
                                position: absolute;
                                top: 50%;
                                right: 10px;
                                transform: translateY(-50%);
                                cursor: pointer;
                                z-index: 2;
                            }
                            </style>



<div class="s" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Staff Details</h3>
                <?php 
                // echo session('role');
                ?>
               
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">

                </div>
            </div>
        </div>
        <div class="clearfix"></div>


        <div class="row m-3">
            <div class="container p-5 bg-white borderd col-sm-6 shadow rounded">
                <div class="container-fluid">
                    <form action="<?php echo base_url().'staffadmin/insert';?>" method="POST" onsubmit="return validateForm(event);">

                        <div class="col-md-12">
                            <div class="m-2">
                                <label class="h6">Staff Name<span class="text-danger">*</span></label>
                                <input class="form-control rounded" data-validate-length-range="6"
                                    data-validate-words="2" name="name" id="textInput" placeholder="Enter Staff Name"
                                    required="required" type="text" />
                            </div>
                            <div class="m-2">
                                <label class="h6">Staff Email<span class="text-danger"></span></label>
                                <input class="form-control rounded" data-validate-length-range="6"
                                    data-validate-words="2" name="email" id="textInput" placeholder="Enter Staff Email"
                                    required="required" type="text" />
                            </div>
                            <div class="m-2">
                                <label class="h6">Staff Type<span class="text-danger">*</span></label><br>
                                <div class="d-flex justify-content-around">
                                    <div>
                                        <span>Super Admin</span>
                                        <input type="radio" name="is_admin" value="1">
                                    </div>
                                    <div>
                                        <span>Assigner</span>
                                        <input type="radio" name="is_admin" value="2">
                                    </div>
                                </div>
                                 <div id="error" class="text-danger"></div> 
                            </div>
                            <div class="m-2">
                                <div class="password-input">
                                    <label class="h6">Password<span class="text-danger">*</span></label>
                                    <div class="password-container">
                                    <input class="form-control rounded" id="password" name='password'
                                        placeholder="Enter Password" type="password" required pattern="^(?=.*[A-Z])(?=.*[\W_]).{8,}$" title="Atleast use one uppercase and one special character with minimum 8 characters">
                                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password align-items-center"></span>
                                </div>
                                </div>
                            </div> 
 
                           
                            <div class="m-2 d-flex justify-content-evenly">
                                <button type='submit' class="btn btn-outline-success" onsubmit="return validateForm(event);">Submit</button>
                                <button type='reset' class="btn btn-outline-danger">Reset</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .password-container {
    position: relative;
}

.password-container .toggle-password {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: 10px; /* Adjust this value as needed */
    cursor: pointer;
}

</style>


<div class="x_content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
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
                            <td>
                                <a data-target="#editProductModal" class="edit btn btn-outline-warning"
                                    data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                        title="Edit">Edit</i></a>
                                <a data-target="#deleteProductModal" class="delete btn btn-outline-danger"
                                    data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                        title="Delete">Delete</i></a>
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
<!-- Edit Modal HTML -->

<div id="editProductModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <form class="" action="<?php echo base_url().'staffadmin/update'?>" method="POST"  onsubmit="return validateForms(event);">
                <div class="modal-header">
                    <h4 class="modal-title">Staff Info</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <div class="m-2">
                        <label class="h6">Staff Name<span class="text-danger">*</span></label>
                        <!--<input class="form-control rounded" id="name" name='name' type="text" required>-->
                        <input class="form-control rounded" data-validate-length-range="6"
                                    data-validate-words="2" name="name" id="name" placeholder="Enter Staff Name"
                                    required="required" type="text" pattern="^[a-zA-Z]+$" title="Please enter characters only"/>
                    </div>

                    <div class="m-2">
                        <label class="h6">Staff Email<span class="text-danger">*</span></label>
                        <!--<input class="form-control rounded" id="name" name='name' type="text" required>-->
                        <input class="form-control rounded" data-validate-length-range="6"
                                    data-validate-words="2" name="email" id="email" placeholder="Enter Staff Email"
                                    required="required" type="text"pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Please enter a valid email address" />
                    </div>

                    <div class="m-2">
                        <label class="h6">Staff Type<span class="text-danger">*</span></label><br>
                        <div class="d-flex justify-content-around">
                            <div>
                                <span>Super Admin</span>
                                <input type="radio" id="is_admin1Super" name="is_admin1" value="1">
                            </div>
                            <div>
                                <span>Assigner</span>
                                <input type="radio" id="is_admin1Normal" name="is_admin1" value="2">
                            </div>
                        </div>
                         <!--<div id="error" class="text-danger"></div>-->
                    </div>

                   <div class="m-2">
                        <label class="h6">Password<span class="text-danger">*</span></label>
                        <div class="password-input">
                            <input type="password" name="password" id="password1" class="form-control"
                                placeholder="Enter Password" required pattern="^(?=.*[A-Z])(?=.*[\W_]).{8,}$" title="Atleast use one uppercase and one special character with minimum 8 characters">
                            <span toggle="#password1" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        </div>
                    </div>
                </div>

                <style>
                .password-input {
                    position: relative;
                }

                .password-input .form-control {
                    padding-right: 40px;
                    /* Adjust this value to leave space for the icon */
                }

                .password-input .toggle-password {
                    position: absolute;
                    top: 50%;
                    right: 10px;
                    transform: translateY(-50%);
                    cursor: pointer;
                    z-index: 2;
                }
                </style>

                <div class="modal-footer">
                    <div class="col-md-6 offset-md-3">
                        <button type='submit' class="btn btn-primary" onsubmit="return validateForms(event);">Submit</button>
                        <button type='reset' class="btn btn-success">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>   
 <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
function validateForm(e) {
    var radios = document.getElementsByName('is_admin');
    var isChecked = false;

    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            isChecked = true;
            break;
        }
    }

    if (!isChecked) {
        e.preventDefault();
        
        // Use SweetAlert to display the error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select a Staff Type.'
        });
        
        return false; // Prevent form submission
    } else {
        return true; // Allow form submission
    }
}


</script>
<script>
function validateForms(e) {
    var radios = document.getElementsByName('is_admin1');
    var isChecked = false;

    for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) {
            isChecked = true;
            break;
        }
    }

    if (!isChecked) {
        e.preventDefault();
        
        // Use SweetAlert to display the error message
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please select a Staff Type.'
        });
        
        return false; // Prevent form submission
    } else {
        return true; // Allow form submission
    }
}


</script>


<script>
$(document).ready(function() {
    
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
});
</script>

<script>
$(document).on('click', '.edit', function(e) {
    e.preventDefault();
    var id = $(this).parent().siblings()[0].value;
    // console.log(id);
    $.ajax({
        url: "<?= base_url(); ?>" + "staffadmin/edit/" + id,
        method: 'GET',
        success: function(result) {
            var res = JSON.parse(result);
            console.log(res);
            $("#name").val(res.name);
            // $("#is_admin1").val(res.role);
             if (res.role == "1") {
                $("#is_admin1Super[value='1']").prop("checked", true);
            } else if (res.role == "2") {
                $("#is_admin1Normal[value='2']").prop("checked", true);
            }

            $("#email").val(res.email)
            $("#password1").val(res.password);
            $("#edit_id").val(res.id);

        }
    });
});

$(document).ready(function() {
    new DataTable('#datatable');
})

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

<script>
$(document).ready(function() {
    $('input[name="is_admin"]').on('change', function() {
        var selectedOption = $(this).val();

        if (selectedOption === '1') {
            $('#user-section').addClass('hidden');
        } else if (selectedOption === '2') {
            $('#user-section').removeClass('hidden');
        }
    });
});
</script>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
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

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

<?= $this->endSection()?>