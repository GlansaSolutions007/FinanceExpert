<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content')?>
<div class="row">
    <div class="container mt-5">
        <div class="container-fluid justify-content-evenly">
            <div class="col-md-12">
                <div class="col-sm-4">
                    <div class="card rounded-lg shadow text-center">
                      <div class="card-head p-2">
                        <!--<h4>Sanctioned Loans</h4>-->
                    </div>
                    <div class="card-body p-2">
                        <h3>Count Of Banks</h3>
                        <h4><?= $countOfBanks ?></h4>
                    </div>
                    <div class="card-footer p-2">
                        <a class="btn btn-primary" href="<?php echo base_url('admin/bank')?>">Know More</a>
                    </div>  
                    </div>
                    
                </div>
                <div class="col-sm-4">
                    <div class="card rounded-lg shadow text-center">
                      <div class="card-head p-2">
                        <!--<h4>Sanctioned Loans</h4>-->
                    </div>
                    <div class="card-body p-2">
                        <h3>Count Of Agents</h3>
                        <h4><?= $countOfAgent['totalAgents']; ?></h4>
                    </div>
                    <div class="card-footer p-2">
                        <a class="btn btn-primary" href="<?php echo base_url('agentadmin/display')?>">Know More</a>
                    </div>  
                    </div>
                    
                </div>
                <div class="col-sm-4">
                    <div class="card rounded-lg shadow text-center">
                      <div class="card-head p-2">
                        <!--<h4>Sanctioned Loans</h4>-->
                    </div>
                    <div class="card-body p-2">
                       <h3>Count Of Staff</h3>
                        <h4><?= $countOfStaff ?></h4>
                    </div>
                    <div class="card-footer p-2">
                        <a class="btn btn-primary" href="<?php echo base_url('staffadmin/display')?>">Know More</a>
                    </div>  
                    </div>
                    
                </div>
                 <div class="col-sm-4 mt-4">
                    <div class="card rounded-lg shadow text-center">
                      <div class="card-head p-2">
                        <!--<h4>Sanctioned Loans</h4>-->
                    </div>
                    <div class="card-body p-2">
                        <h3>Count Of Sub Agents</h3>
                        <h4><?= $countOfsubAgent; ?></h4>
                    </div>
                    <div class="card-footer p-2">
                        <a class="btn btn-primary" href="<?php echo base_url('agentadmin/display')?>">Know More</a>
                    </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
 <script>
        // Check if the session variable exists and has a value
        <?php if (session()->has('agent_name') && session('agent_name')): ?>
            // Display a SweetAlert welcome message
            Swal.fire({
                title: 'Welcome, <?php echo session('agent_name'); ?>!',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    </script>

<?= $this->endSection()?>