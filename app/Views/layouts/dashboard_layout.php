<?php $imagesURL = 'https://wwh.live/test/public/';

// session_start();

// Check if the user is logged in
if (!isset($_SESSION['agent_name']) || empty($_SESSION['agent_name'])) {
    // Redirect to the login page using CodeIgniter's redirect() helper
    header('Location: ' . base_url(''));
exit();
}

?>  
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= (isset($pageTitle)) ? $pageTitle : 'FinExpert'; ?></title>
    <!-- <base href="/"> -->
    <!-- Bootstrap -->
    <link href="<?= base_url('/admin_assets/vendors/bootstrap/dist/css/bootstrap.min.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <!-- Font Awesome -->
    <link href="<?= base_url('/admin_assets/vendors/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('/admin_assets/vendors/nprogress/nprogress.css')?>" rel="stylesheet">
    <!-- jQuery custom content scroller -->
    <link href="<?= base_url('/admin_assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css')?>"
        rel="stylesheet" />
    <!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->

    <link href="<?= base_url('/admin_assets/build/css/custom.min.css')?>" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
     <style>
    #sidebar-menu {
        width: 230px;
        background-color: #2A3F54;
        border-right: 1px solid #ddd;
    }

    .menu_section {
        padding-top: 20px;
    }

    .nav.side-menu li a {
        display: block;
        padding: 10px 15px;
        color: white;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    /*.nav.side-menu li a:hover {*/
    /*    background-color: #2A3F54;*/
    /*}*/

    .nav.child_menu {
        display: none;
        padding-left: 15px;
    }

    .nav.child_menu li a {
        padding: 8px 15px;
        color: white;
        text-decoration: none;
        display: block;
        transition: background-color 0.3s;
    }

    .nav.child_menu li a:hover {
        background-color: #2A3F54;
    }
</style>

</head>


<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <img src="<?= base_url('Finexpertlogo.png') ?>" style="height: 50px; width: 250px" alt="Finexperts Logo">
                    </div>

                    <div class="clearfix"></div>
                    
                     <!--menu profile quick info -->
                    <div class="profile clearfix">
                        <div class="profile_pic">
                            <!--<img src="<?= $imagesURL?>/images/img.jpg" alt="<?= base_url()?>.'/admin_assets."-->
                                <!--class="img-circle profile_img">-->
                        </div>
                        <div class="profile_info">
                             <h2>Welcome <?php echo session('agent_name'); ?></h2>
                            
                           
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    
                    
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <ul class="nav side-menu">
            <li><a href="<?= base_url('admin/home'); ?>"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li>
                <a href="javascript:void(0);" onclick="toggleSubMenu('master')">
                    <i class="fa fa-user"></i> Master <span class="fa fa-chevron-down"></span>
                </a>
                <ul id="masterSubMenu" class="nav child_menu">
                    <li><a href="<?= base_url('admin/bank'); ?>">Bank</a></li>
                    <li><a href="<?= base_url('agentadmin/display'); ?>">Agent</a></li>
                    <?php if (session('role') != 2): ?>
                        <li><a href="<?= base_url('staffadmin/display'); ?>">Staff</a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" onclick="toggleSubMenu('transactions')">
                    <i class="fa fa-money"></i> Transactions <span class="fa fa-chevron-down"></span>
                </a>
                <ul id="transactionsSubMenu" class="nav child_menu">
                    <li>
                        <a href="javascript:void(0);" onclick="toggleSubMenu('sales')">
                            Sales <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul id="salesSubMenu" class="nav child_menu">
                            <li><a href="<?= base_url('admin/uploadmaster'); ?>"> Upload Master Sheet </a></li>
                            <li><a href="<?= base_url('ExcelController/viewmaster'); ?>"> View Master Sheet </a></li>
                           
                                                <li class="sub_menu"><a href="<?= base_url('Miscontroller/bankdisplay'); ?>"> MIS Calculations </a>
                                                </li>
                                                 <li class="sub_menu"><a href="<?= base_url('paymentcontroller/payment_display'); ?>"> Payment </a>
                                                </li>
                                                <li class="sub_menu"><a href="<?= base_url('paymentcontroller/issueCapital'); ?>"> Issue Capital </a>
                                                </li>
                                                <!--<li class="sub_menu"><a href="<?= base_url('agentinvoice/agentInvoice'); ?>"> Generate Invoice & Payment-->
                                                <!--        Voucher </a>-->
                                                <!--</li>-->
                                                 <li class="sub_menu"><a href="<?= base_url('agentinvoice/taxinvoice'); ?>"> Generate Invoice</a>
                                                </li>
                            <!-- Add more sales submenu items as needed -->
                        </ul>
                    </li>
                    <li><a href="<?= base_url('bankInvoice/display'); ?>"> Purchase </a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" onclick="toggleSubMenu('reports')">
                    <i class="fa fa-book"></i> Reports <span class="fa fa-chevron-down"></span>
                </a>
                <ul id="reportsSubMenu" class="nav child_menu">
                    <li><a href="<?= base_url('agentadmin/agentlistdiplay'); ?>">Agent List</a></li>
                    <li><a href="<?= base_url('agentinvoice/display'); ?>">Agent Invoice Report</a></li>
                    <li><a href="<?= base_url('agentwisecontroller/agentLoanReports'); ?>">Agent Loan Reports</a></li>
                    <li><a href="<?= base_url('applicationReportController/getApplicationReport'); ?>">Application Reports</a></li>
                    <li><a href="<?= base_url('admin/gstreport'); ?>">GST Report</a></li>
                </ul>
            </li>
            <li>
                <a href="<?= base_url().'logout' ?>" class="text-white">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</div>
                    <!-- /sidebar menu -->

                    
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <!--<a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"-->
                                <!--    id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">-->
                                   
                                    <!--<img src="<?= $imagesURL?>images/img.jpg" alt="">-->
                                    <?php echo session('agent_name'); ?>
                                <!--</a>-->
                                <!--<div class="dropdown-menu dropdown-usermenu pull-right"-->
                                <!--    aria-labelledby="navbarDropdown">-->
                                    
                                <!--    <a class="dropdown-item logout-link" href="<?= base_url().'logout' ?>"><i class="fa fa-sign-out pull-right"></i>-->
                                <!--        Log Out</a>-->
                                <!--</div>-->
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <?= $this->renderSection('content'); ?>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <!--<footer>-->
            <!--    <div class="pull-right">-->
            <!--        All Copyrights Reserved By <a href="<?= base_url() ?>">Glansa Solutions</a>-->
            <!--    </div>-->
            <!--    <div class="clearfix"></div>-->
            <!--</footer>-->
            <!-- /footer content -->
        </div>
    </div>



<script>
$(document).ready(function() {
    // Handle logout click event
    $('.logout-link').on('click', function(e) {
        e.preventDefault();
        // Make an AJAX request to the logout URL
        $.ajax({
            url: $(this).attr('href'),
            method: 'GET',
            success: function(response) {
                // Redirect to the homepage after successful logout
                window.location.href = '<?= base_url() ?>';
            }
        });
    });
});
</script>
<script>
    function toggleSubMenu(subMenuId) {
        var subMenu = document.getElementById(subMenuId + 'SubMenu');
        if (subMenu.style.display === 'block') {
            subMenu.style.display = 'none';
        } else {
            subMenu.style.display = 'block';
        }
    }
</script>


    <!-- jQuery -->
    
    <!--<script src="<?= base_url('/admin_assets/vendors/jquery/dist/jquery.min.js')?>"></script>-->
    <!-- Bootstrap -->
    <!--<script src="<?= base_url('/admin_assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')?>"></script>-->
    <!-- FastClick -->
    <!--<script src="<?= base_url('/admin_assets/vendors/fastclick/lib/fastclick.js')?>"></script>-->
    <!-- NProgress -->
    <!--<script src="<?= base_url('/admin_assets/vendors/nprogress/nprogress.js')?>"></script>-->
    <!-- jQuery custom content scroller -->
    <!--<script src="<?= base_url('/admin_assets/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')?>"></script>-->

    <!-- Custom Theme Scripts -->
    <script src="<?= base_url('/admin_assets/build/js/custom.min.js')?>"></script>
    
    
</body>

</html> 