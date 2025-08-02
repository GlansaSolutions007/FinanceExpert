<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Fin Experts </title>

    <!-- Bootstrap -->
    <link href="<?= base_url('/admin_assets/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('/admin_assets/vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('/admin_assets/vendors/nprogress/nprogress.css') ?>" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url('/admin_assets/vendors/animate.css/animate.min.css') ?>" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url('/admin_assets/build/css/custom.min.css') ?>" rel="stylesheet">
</head>

<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form method="post" action="<?= base_url() ?>" enctype="multipart/form-data">
                        <h1>Finexperts Admin</h1>
                        <div class="mt-2">
                            <?php if (session()->has('tempdata')) { ?>
                                <div class="alert text-white bg-danger <?= session()->getFlashdata('alert-class') ?>">
                                    <?= session()->getFlashdata('tempdata') ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" id="name"
                                name="name" />
                        </div>

                        <div>
                            <div class="password-input">
                                <input class="form-control rounded" id="pwd" name='password'
                                    placeholder="Enter Password" type="password" required>
                                <span toggle="#pwd" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                        </div>
                        <div>
                            <input type="hidden" name="role" id="role">
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
                        <div>
                            <button class="btn btn-outline-primary submit">Log in</button>
                        </div>
                        <div class="mt-2">
                            <a href="#" class="text-primary" data-toggle="modal"
                                data-target="#forgotPasswordModal">Forgot Password?</a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <img src="<?= base_url('Finexpertlogo.png') ?>" style="height: 100px; width: 300px"
                                    alt="Finexperts Logo">
                            </div>

                            <p>©2023 All Rights Reserved. Finexperts.</p>
                        </div>
                    </form>
                </section>
            </div>
        </div>

        <!-- Forgot Password Modal -->
        <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog"
            aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="forgotPasswordForm" method="POST"
                            action="<?= base_url('ForgotPasswordController/sendResetLink') ?>">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Send Reset Link</button>
                            </div>
                        </form>
                        <div id="forgotPasswordMessage" class="alert d-none"></div>
                    </div>
                </div>
            </div>
        </div>

        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form>
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="" />
                    </div>

                    <div>
                        <a class="btn btn-default submit" href="index.html">Submit</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 4 template. Privacy and Terms
                            </p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap JavaScript -->
    <script src="<?= base_url('/admin_assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="<?= base_url('/admin_assets/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function () {
            $(".toggle-password").click(function () {
                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });

            $('#forgotPasswordForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function (response) {
                        // Display success message using SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Password reset link sent to your email.',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        // Reset the form
                        $('#forgotPasswordForm').trigger('reset');
                    },
                    error: function (xhr, status, error) {
                        // Display error message using SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to send password reset link.',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            });

        });
    
    </script>
</body>

</html>