<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content') ?>
<h3>Upload Master Sheet</h3>

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
                        <form class="" action="<?= base_url() . 'ExcelController/importExcelToDb' ?>"
                            enctype="multipart/form-data" method="POST">
                            <div class="mt-2">
                                <?php if (session()->has('message')) { ?>
                                    <div class="alert <?= session()->getFlashdata('alert-class') ?>">
                                        <?= session()->getFlashdata('message') ?>
                                    </div>
                                <?php } ?>
                                <?php $validation = \Config\Services::validation(); ?>
                            </div>
                            <!-- <span class="section">Bank Info</span> -->
                            <div class="field item form-group col-md-10">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Select Master Bank<span
                                        class="text-danger">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <select name="bankname" id="bankname" class="form-control" required>
                                        <option value="">Choose..</option>
                                        <?php
                                        if ($banks) {
                                            $i = 1;
                                            foreach ($banks as $bank) {

                                                ?>

                                                <option value="<?= $bank['name'] ?>"><?= $bank['name'] ?></option>
                                                <?php
                                            }
                                        } ?>
                                    </select>
                                </div>
                                <button class="btn btn-outline-success" onclick="downloadClick()">Download Common
                                    Template</button>
                            </div>

                            <div class="field item form-group col-md-10">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Upload Master Sheet (Kindly
                                    upload common template only)<span class="text-danger">*</span></label>
                                <div class="mb-3 col-md-6">
                                    <input type="file" name="file" class="form-control" id="file" accept=".xls, .xlsx"
                                        required>

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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function downloadClick() {
        // Send an AJAX GET request to the download URL
        $.ajax({
            url: "<?= base_url('ExcelController/download_excel') ?>",
            method: "GET",
            success: function (data) {
                console.log(data);
                // On success, you can perform any additional actions
                console.log("File download initiated");
                window.location.href = "<?= base_url('ExcelController/download_excel') ?>";
            },
            error: function () {
                // Handle errors if the download request fails
                console.error("Error initiating file download");
            }
        });
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Add SweetAlert2 -->
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


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->

<script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<?= $this->endSection() ?>