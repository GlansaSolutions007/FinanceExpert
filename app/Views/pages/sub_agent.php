<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content')?>
 <!--<div class="container-fluid"> -->

    <!-- Page Heading -->

    <div class="s" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Sub Agent Details</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                        <div class="input-group">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

                            <div class="row m-3">
                                <div class="container p-5 bg-white borderd col-sm-6 shadow rounded">
                                    <div class="container-fluid">
                                        <form action="<?php echo base_url().'agentadmin/insert';?>" method="POST">
                                            
                                            <div class="col-md-12">
                                                    <div class="m-2">
                                                        <label class="h6">Agent Name</label>
                                                        <input class="form-control rounded" data-validate-length-range="6"
                                            data-validate-words="2" name="name" placeholder="Enter Agent Name"
                                            required="required" type="text"/>
                                                    </div>
                                                    <div class="m-2">
                                                        <label class="h6">Mobile No</label>
                                                        <input class="form-control rounded" name="phone_no"
                                            data-validate-minmax="10,100" required='required' placeholder="Enter Mobile No" type="text">
                                                    </div>
                                                    <div class="m-2">
                                                        <label class="h6">Email</label>
                                                        <input class="form-control rounded" name="email"
                                            data-validate-minmax="10,100" required='required' placeholder="Enter Email" type="text">
                                                    </div>
                                                    
                                                    <div class="m-2">
                                                        <label class="h6">Percentage</label>
                                                        <input class="form-control rounded" name="percentage"
                                            data-validate-minmax="10,100" value="3.5%" readonly required='required' placeholder="" type="text">
                                                    </div>
                                                    
                                                    <div class="m-2">
                                                        <label class="h6">Address</label>
                                                        <textarea class="form-control rounded" name='address' placeholder="Enter Address" type="text-area"></textarea>
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
                            


    
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>



    <script>

    $(document).on('click','.edit', function(e){
        e.preventDefault();
        var id = $(this).parent().siblings()[0].value;
        // console.log(id);
        $.ajax({
            url:"<?= base_url(); ?>" + "agentadmin/edit/"+id,
            method:'GET',
            success : function(result) {
                var res = JSON.parse(result);
                console.log(res);
                $("#name").val(res.name);
                $("#mobile").val(res.phone_no);
                $("#email").val(res.email);
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

    <?= $this->endSection(); ?>