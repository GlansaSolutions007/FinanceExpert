<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content')?>
 <!--<div class="container-fluid"> -->

    <!-- Page Heading -->

    <div class="s" role="main" id="agents">
        <form action="<?php echo base_url().'phpmail/submitForm';?>" method="POST"  enctype="multipart/form-data">
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
                            <div class="col-6 m-3">
                                <div class="container p-5 bg-white borderd col-sm-6 shadow rounded">
                                    <div class="container-fluid">
                                        
                                            
                                            <div class="col-md-12">
                                                    <div class="m-2">
                                                        <!--<label class="h6">Agent User ID:</label>-->
                                                        <input class="form-control rounded" data-validate-length-range="6"
                                            data-validate-words="2" name="user_id" placeholder="Enter Agent Name"
                                            required="required" type="hidden"/>
                                                    </div>
                                                    <div class="m-2">
                                                        <label class="h6">Agent Name:</label>
                                                        <input class="form-control rounded" data-validate-length-range="6"
                                            data-validate-words="2" name="name" placeholder="Enter Agent Name"
                                            required="required" type="text"/>
                                                    </div>
                                                    <div class="m-2">
                                                        <label class="h6">Mobile No:</label>
                                                        <input class="form-control rounded" name="phone_no"
                                            data-validate-minmax="10,100" required='required' placeholder="Enter Mobile No" type="text">
                                                    </div>
                                                    <div class="m-2">
                                                        <label class="h6">Email:</label>
                                                        <input class="form-control rounded" name="aemail"
                                            data-validate-minmax="10,100" required='required' placeholder="Enter Email" type="text">
                                                    </div>
                                                 
                                     
                                                    
                                                    <div class="m-2 d-flex justify-content-evenly">
                                                        <button type='submit' class="btn btn-outline-success" id="agent_submit">Submit</button>
                                                        <button type='reset' class="btn btn-outline-danger">Reset</button>
                                                    </div>
                                            </div>
                                             
                                       </div>
                                </div>
                            </div>
                            
                            <!--end of inserting agent-->
                            
                            <!--Number of pages-->
                             </script>
    
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/jquery/dist/jquery.min.js"></script>

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
                           
                   
