<?= $this->extend('layouts/dashboard_layout'); ?>
<?= $this->section('content') ?>

<!-- <div class="container-fluid"> -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<!-- Page Heading -->

<div class="s" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Issue Capital</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                    <!--<div class="input-group">-->
                    <!--    <input type="text" class="form-control" placeholder="Search for...">-->
                    <!--    <span class="input-group-btn">-->
                    <!--        <button class="btn btn-default" type="button">Go!</button>-->
                    <!--    </span>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row m-3">
            <div class="col-md-12">
                <div class="container p-5 bg-white borderd col-sm-6 shadow rounded">
                    <div class="container-fluid">
                            <form action="<?php echo base_url() . 'paymentcontroller/insertLoan'; ?>" method="POST">

                                <div class="col-md-6">
                                    <div class="m-2">
                                        <label class="h6">Agent ID </label>

                                        <select id="heard" required class="form-control select2" onchange="getAgentName()"
                                            name="agent_id" required>
                                            <option value="">Choose Agent ID</option>
                                            <?php if ($agents) { ?>
                                                <?php foreach ($agents as $agent) { ?>
                                                    <option value="<?= $agent['user_id'] ?>"><?= $agent['user_id'] ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="m-2">
                                        <label class="h6">Agent Name </label>
                                        <input class="form-control rounded" name="agent_name" required required='required'
                                            id="agent_name" type="text" readonly>
                                    </div>

                                    <div class="m-2">
                                        <label class="h6">Amount In Rupees <span class="text-danger">*</span></label>
                                        <input class="form-control rounded" name="loanAmount" required required='required'
                                            placeholder="Enter Amount In Rupees" id="loanAmount" type="number"
                                            pattern="\d+(\.\d+)?">
                                    </div>


                                    <input class="form-control rounded" name="voucher" required='required' id="voucher"
                                        type="hidden">


                                    <div class="m-2">
                                        <label class="h6">Return EMI Month Span <span class="text-danger">*</span></label>
                                        <input type="number" required class="form-control rounded" name='month' id="month"
                                            placeholder="Enter Month" pattern="\d+(\.\d+)?">
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="m-2">
                                        <label class="h6">EMI Per Month <span class="text-danger">*</span></label>
                                        <input class="form-control rounded" required data-validate-length-range="6"
                                            data-validate-words="2" name="monthlyemi" placeholder="EMI Per Month"
                                            type="text" id="monthlyemi" readonly />
                                    </div>


                                    <div class="m-2">
                                        <label class="h6">From Date <span class="text-danger">*</span></label>
                                        <input class="form-control rounded" required id="from_date" name="from_date"
                                            required='required' type="date">
                                    </div>
                                    <div class="m-2">
                                        <label class="h6">Remarks<span class="text-danger">*</span></label>
                                        <textarea class="form-control rounded" id="remarks" name="remarks"
                                            required='required'></textarea>
                                    </div>
                                </div>
                        </div>

                        <style>
                            /*#customPopupMessage{*/
                            /*        padding: 0;*/
                            /*       color: red;*/
                            /*        border: 0;*/
                            }
                        </style>



                        <div class="m-2 d-flex justify-content-evenly">
                            <button type='submit' class="btn btn-outline-success voucher_generate"
                                data-toggle="modal">Submit</button>
                            <button type='reset' class="btn btn-outline-danger">Reset</button>
                        </div>
                        </form>
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
                            <th>Agent Id</th>
                            <th>Agent Name</th>
                            <th>Loan Taken By Agent</th>
                            <th>Date</th>
                            <th>Duration in Month</th>
                            <th>EMI Per Month</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                        if ($loans) {
                            $i = 1;
                            foreach ($loans as $loan) {

                                ?>

                                <tr>
                                    <input id="id" name="id" type="hidden" value="<?= $loan['id'] ?> ">

                                    <td><?php echo $i++; ?></td>
                                    <td><?= $loan['agent_id'] ?></td>
                                    <td><?= $loan['agentName'] ?></td>
                                    <td><?= $loan['loanAmount'] ?></td>
                                    <td><?= $loan['date'] ?></td>
                                    <td><?= $loan['month'] ?></td>
                                    <td><?= $loan['monthlyEmi'] ?></td>
                                    <td>

                                        <a data-target="#editProductModal" class="edit btn btn-outline-warning"
                                            data-toggle="modal"><i class="material-icons" data-toggle="tooltip"
                                                title="Edit">Edit</i></a>

                                        <a data-target="#deleteProductModal" class="delete btn btn-outline-danger"
                                            data-toggle="modal"><i data-id="<?= $loan['id'] ?>" data-toggle="tooltip"
                                                title="Delete">Delete</i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            $i++;
                        } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!--Edit Modal-->
    <div id="editProductModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="x_content">
                    <form class="" action="<?php echo base_url() . 'paymentcontroller/loanupdate' ?>" method="POST">

                        <span class="section">Loan Details</span>
                        <div class="field item form-group">
                            <input type="hidden" name="edit_id" id="edit_id">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Agent Id<span
                                    class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" id="agentId" name="agentId" placeholder="Enter Agent ID"
                                    readonly />
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Agent Name </label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="text" class='number' id="agentName" name="agentName"
                                    required='required' readonly>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Taken Loan Amount </label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="text" class='number' id="loan" name="loan"
                                    required='required' pattern="\d+(\.\d+)?" title="Please Enter Digits only">
                            </div>
                        </div>
                        <div class="field item form-group" style="margin-top: -15px;">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Date </label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="date" class='number' id="date" name="date"
                                    required='required'>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Duration in Month </label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="text" class='number' id="duration" name="duration"
                                    required='required' pattern="\d+(\.\d+)?" title="Please Enter Digits only">
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Emi Per Month </label>
                            <div class="col-md-6 col-sm-6">
                                <input class="form-control" type="text" class='number' id="emi" name="emi"
                                    required='required' readonly>
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


    <!--Delete Modal-->
    <div id="deleteProductModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" method="post" action="">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Confirmation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!--<input type="text" name="delete_id" id="delete_id" > -->
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

    <!--</div>-->
    <div class="modal fade" id="customPopup" tabindex="-1" aria-labelledby="customPopupLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customPopupLabel">Error</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body" id="customPopupMessage">
                    Please Fill In All The Required Fields.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade invoice-container" id="staticBackdrop" data-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="<?= base_url('Finexpertlogo.png') ?>" style="height: 50px; width: 250px;text:center"
                        alt="Finexperts Logo">
                </div>
                <!--<p style="border-bottom: 1px solid black;text-align:center;"> 6-3-661/B/2, Plot No 78, 2ed, SANGGTH NAGAR, SOMAJIGUDA, HYDERABAD</p>-->
                <div class="modal-body invoice-items">
                    <div class="invoice-header">
                        <h3>Payment Invoice</h3>
                    </div>

                    <table>
                        <tr>
                            <td>PV No:</td>
                            <td style="border-bottom: 1px solid black;width:100px;">${response.voucher}</td>
                            <td style="padding-left: 300px;">Dated:</td>
                            <td style="border-bottom: 1px solid black;width:100px;">${response.date}</td>
                        </tr>
                        <tr>
                            <td style="width: 200PX;">Sum of Rupees:</td>
                            <td colspan="3" style="border-bottom: 1px solid black;width:500px;">
                                ${response.payment_amount} &#8377;</td>
                        </tr>
                        <tr>
                            <td>In Words:</td>
                            <td colspan="3" style="border-bottom: 1px solid black;width:500px;">${amountInWords}</td>
                        </tr>
                        <tr>
                            <td>Paid To:</td>
                            <td colspan="3" style="border-bottom: 1px solid black;width:500px;">${response.agent_name}
                            </td>
                        </tr>

                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="downloadPdf()"
                        id="downloadPdfBtn">Download</button>
                </div>
            </div>
        </div>
    </div>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice-container {
            /*width: 50%;*/
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .invoice-header {
            text-align: center;
        }

        .invoice-header h1 {
            margin: 0;
        }

        .invoice-details {
            margin-top: 20px;
        }

        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-details th,
        .invoice-details td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .invoice-total {
            margin-top: 20px;
            text-align: right;
        }
    </style>

    <!-- Delete Model -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src='https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(function () {
            $("#heard").select2();
        });

        $(document).ready(function () {
            $('#duration').on("change", function () {
                var loanAmount = $('#loan').val();
                var month = $(this).val();
                var monthlyEmi = loanAmount / month;
                $('#emi').val(monthlyEmi);
            })
        })
    </script>

    <script>
        $(document).on('click', '.edit', function (e) {
            e.preventDefault();
            var id = $(this).parent().siblings()[0].value;
            // console.log(id);
            $.ajax({
                url: "<?= base_url(); ?>" + "paymentcontroller/editLoan/" + id,
                method: 'GET',
                success: function (result) {
                    var res = JSON.parse(result);
                    console.log(res);
                    $('#edit_id').val(res.id);
                    $('#agentId').val(res.agent_id);
                    $('#agentName').val(res.agentName);
                    $('#loan').val(res.loanAmount);
                    $('#date').val(res.date);
                    $('#duration').val(res.month);
                    $('#emi').val(res.monthlyEmi);
                }
            });
        });

        $(document).on('click', '.delete', function (e) {
            e.preventDefault();
            var id = $(this).parent().siblings()[0].value;
            $('#deleteForm').attr('action', 'delete/' + id);
            $('#deleteProductModal').modal('show');
        });

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
    </script>


    <script>
        $('#staticBackdrop').on('show.bs.modal', function () {
            var currentDate = new Date().toLocaleDateString();
            $('#receiptDate').text(currentDate);
        });
    </script>
    <script>
        function getAgentName() {
            var selectedAgentID = document.getElementById('heard').value;
            if (selectedAgentID !== '') {
                // Make an AJAX call to the server to retrieve the agent name
                $.ajax({
                    type: 'GET',
                    url: '<?= base_url("paymentcontroller/getAgentName/"); ?>' + selectedAgentID,
                    success: function (response) {
                        console.log(response.name);
                        $('#receiptDateLabel').html('Receipt Date: ' + response.date);
                        document.getElementById("agent_name").value = response.name;
                        // document.getElementById("gst_no").value = response.gst_no;
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            } else {
                document.getElementById("agent_name").value = '';
                // document.getElementById("gst_no").value = '';
            }
        }

        function calculateEMI() {
            var loanAmount = parseFloat($('#loanAmount').val());
            var month = parseInt($('#month').val());

            if (!isNaN(loanAmount) && !isNaN(month) && month > 0) {
                var monthlyEMI = loanAmount / month;
                $('#monthlyemi').val(monthlyEMI.toFixed(2));
            } else {
                $('#monthlyemi').val('');
            }
        }

        $('#loanAmount, #month').on("input", calculateEMI);

        function closeAlert() {
            $('#validationAlert').hide();
        }

        $('.voucher_generate').click(function (event) {
            event.preventDefault();
            const agentID = $('select[name="agent_id"]').val();
            const agentName = $('input[name="agent_name"]').val();
            const loanAmount = $('input[name="loanAmount"]').val();
            const month = $('input[name="month"]').val();
            const monthlyemi = $('input[name="monthlyemi"]').val();
            const from_date = $('input[name="from_date"]').val();
            const remarks = $('textarea[name="remarks"]').val();
            // console.log(agentID + agentName + loanAmount +month+ monthlyemi + from_date + remarks);
            // Check if required fields are filled
            if (!agentID || !agentName || !loanAmount || !month || !monthlyemi || !from_date || !remarks) {

                $('#customPopupMessage').text('Please Fill In All The Required Fields.');
                $('#customPopup').modal('show');
                return;
            }
            // Submit the form using AJAX
            $.ajax({
                type: 'POST',
                url: '<?= base_url("paymentcontroller/insertLoan"); ?>',
                data: $('form').serialize(), // Serialize the form data
                success: function (response) {
                    console.log(response);
                    // If the response contains a voucherCode, open the modal
                    if (response.voucher) {
                        const amountInWords = convertNumberToWords(parseFloat(response.loanAmount));
                        const currentDate = new Date().toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });

                        $('.modal-body').html(`
            <div class="row">
                <div class="col-md-4">
                    <div class="company-info">
                        <h4>FINEXPERT</h4>
                        <p>6-3-661/B/2, Plot No 78,2ed,</br>
                         SANGGTH NAGAR, SOMAJIGUDA, HYDERABAD</p>
                         <p>DATE: ${currentDate}</p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="payment-invoice">
                        <div class="invoice-header">
                            <h3 class="text-center">Payment Invoice</h3>
                        </div>
                    </div>
                </div>
                </div>
                <table class="table">
                    <tr>
                        <td>Voucher No:</td>
                        <td style="border-bottom: 1px solid black;width:100px;">${response.voucher}</td>
                        <td style="padding-left: 300px;border-bottom: 1px solid black;width:100px;">Dated:${response.date}</td>
                       
                    </tr>
                    <tr>
                        <td style="width: 200PX;">Sum of Rupees:</td>
                        <td colspan="3"style="border-bottom: 1px solid black;width:500px;">&#8377; ${response.loanAmount} </td>
                    </tr>
                    <tr>
                        <td>In Words:</td>
                        <td colspan="3"style="border-bottom: 1px solid black;width:500px;">${amountInWords}</td>
                    </tr>
                    <tr>
                        <td>Paid To:</td>
                        <td colspan="3"style="border-bottom: 1px solid black;width:500px;">${response.agentName}</td>
                    </tr>
                </table>
`);
                        // Open the modal
                        $('#staticBackdrop').modal('show');
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            new DataTable('#datatable');
        })
        $('.select2').select2();
    </script>
    <!-- Add this script after your other scripts -->
    <script>

        function convertNumberToWords(number) {
            if (number === 0) return 'Zero';

            const units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten',
                'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
            const tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];
            const scales = ['', 'Thousand', 'Million', 'Billion', 'Trillion', 'Quadrillion', 'Quintillion'];

            function convertChunk(num) {
                if (num < 20) return units[num];
                if (num < 100) return tens[Math.floor(num / 10)] + (num % 10 !== 0 ? ' ' + units[num % 10] : '');
                if (num < 1000) return units[Math.floor(num / 100)] + ' Hundred' + (num % 100 !== 0 ? ' ' + convertChunk(num % 100) : '');
                return '';
            }

            let words = '';
            let scaleIndex = 0;
            while (number > 0) {
                if (number % 1000 !== 0) {
                    const chunkWords = convertChunk(number % 1000);
                    if (chunkWords) {
                        words = chunkWords + (scaleIndex > 0 ? ' ' + scales[scaleIndex] : '') + (words ? ' ' + words : '');
                    }
                }
                number = Math.floor(number / 1000);
                scaleIndex++;
            }
            return words;
        }

        console.log(convertNumberToWords(1234567)); // Output: "One Million Two Hundred Thirty Four Thousand Five Hundred Sixty Seven"
    </script>
    <script>
        // Function to download the PDF
        function downloadPdf(agent_name) {
            // Select the target element (the modal content) to be converted to PDF
            const element = document.querySelector('.modal-body');
            const filename = `voucher_${agent_name}.pdf`;
            // Create an options object for html2pdf.js
            const options = {
                margin: 10,
                filename: 'voucher.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'landscape' }
            };

            // Use html2pdf.js to generate the PDF
            html2pdf().from(element).set(options).save();
            // window.location.reload();

        }
        const agentName = "agent_name";

        // Call the downloadPdf function when the "Download" button is clicked
        document.getElementById('downloadPdfBtn').addEventListener('click', downloadPdf);
        downloadPdf(agent_name);
    </script>
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
    <!-- Include pdfmake library -->
    <!-- Add the following scripts to your HTML -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/vfs_fonts.js"></script>
    <?= $this->endSection(); ?>