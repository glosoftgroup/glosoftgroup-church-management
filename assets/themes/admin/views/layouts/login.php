<!DOCTYPE html>
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- start: HEAD -->
    <head>
        <title><?php echo $template['title']; ?></title>
        <!-- start: META -->
        <meta charset="utf-8" />
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- end: META -->
        <!-- start: MAIN CSS -->
        <link rel="stylesheet" href="<?php echo plugin_path('bootstrap/css/bootstrap.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo plugin_path('font-awesome/css/font-awesome.min.css'); ?>" >
        <?php echo theme_css('fonts/style.css'); ?>
        <?php echo theme_css('main.css'); ?>

        <?php echo theme_css('main-responsive.css'); ?>
        <link rel="stylesheet" href="<?php echo plugin_path('iCheck/skins/all.css'); ?>" >
        <link rel="stylesheet" href=" <?php echo plugin_path('perfect-scrollbar/src/perfect-scrollbar.css'); ?>">
        <?php echo theme_css('theme_light.css'); ?>
        <!--[if IE 7]>
        <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css">
        <![endif]-->
        <!-- end: MAIN CSS -->
        <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
        <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    </head>
    <!-- end: HEAD -->
    <!-- start: BODY -->
    <body class="login example2">
        <div class="main-login col-sm-4 col-sm-offset-4">
            <div class="logo">
                <?php echo theme_image('logo.png'); ?>

            </div>
            <!-- start: LOGIN BOX -->
            <div class="box-login">
                <h3>Sign in to your account</h3>
                <p>
                    Please enter your name and password to log in.
                </p>
                <?php echo $template['body'] ?>
            </div>
            <!-- end: LOGIN BOX -->
            <!-- start: FORGOT BOX -->
            <div class="box-forgot">
                <h3>Forget Password?</h3>
                <p>
                    Enter your e-mail address below to reset your password.
                </p>
                <form class="form-forgot">
                    <div class="errorHandler alert alert-danger no-display">
                        <i class="icon-remove-sign"></i> You have some form errors. Please check below.
                    </div>
                    <fieldset>
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                <i class="icon-envelope"></i> </span>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-light-grey go-back">
                                <i class="icon-circle-arrow-left"></i> Back
                            </button>
                            <button type="submit" class="btn btn-bricky pull-right">
                                Submit <i class="icon-circle-arrow-right"></i>
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <!-- end: FORGOT BOX -->
            <!-- start: REGISTER BOX -->
            <div class="box-register">
                <h3>Sign Up</h3>
                <p>
                    Enter your personal details below:
                </p>
                <form class="form-register">
                    <div class="errorHandler alert alert-danger no-display">
                        <i class="icon-remove-sign"></i> You have some form errors. Please check below.
                    </div>
                    <fieldset>
                        <div class="form-group">
                            <input type="text" class="form-control" name="full_name" placeholder="Full Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="city" placeholder="City">
                        </div>
                        <div class="form-group">
                            <div>
                                <label class="radio-inline">
                                    <input type="radio" class="grey" value="F" name="gender">
                                    Female
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" class="grey" value="M" name="gender">
                                    Male
                                </label>
                            </div>
                        </div>
                        <p>
                            Enter your account details below:
                        </p>
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                                <i class="icon-envelope"></i> </span>
                        </div>
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <i class="icon-lock"></i> </span>
                        </div>
                        <div class="form-group">
                            <span class="input-icon">
                                <input type="password" class="form-control" name="password_again" placeholder="Password Again">
                                <i class="icon-lock"></i> </span>
                        </div>
                        <div class="form-group">
                            <div>
                                <label for="agree" class="checkbox-inline">
                                    <input type="checkbox" class="grey agree" id="agree" name="agree">
                                    I agree to the Terms of Service and Privacy Policy
                                </label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-light-grey go-back">
                                <i class="icon-circle-arrow-left"></i> Back
                            </button>
                            <button type="submit" class="btn btn-bricky pull-right">
                                Submit <i class="icon-circle-arrow-right"></i>
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <!-- end: REGISTER BOX -->
            <!-- start: COPYRIGHT -->
            <div class="copyright">
                <?php echo date('Y'); ?> &copy; Keypad Systems.
            </div>
            <!-- end: COPYRIGHT -->
        </div>
        <!-- start: MAIN JAVASCRIPTS -->
        <!--[if lt IE 9]>
        <script src="assets/plugins/respond.min.js"></script>
        <script src="assets/plugins/excanvas.min.js"></script>
        <![endif]-->
        <?php echo theme_js('jquery.min.js'); ?>
        <script src="<?php echo plugin_path('jquery-ui/jquery-ui-1.10.2.custom.min.js'); ?>"></script>
        <script src="<?php echo plugin_path('bootstrap/js/bootstrap.min.js'); ?>"></script>
        <script src=" <?php echo plugin_path('blockUI/jquery.blockUI.js'); ?>"></script>
        <script src=" <?php echo plugin_path('iCheck/jquery.icheck.min.js'); ?>"></script>
        <script src="<?php echo plugin_path('perfect-scrollbar/src/jquery.mousewheel.js'); ?>"></script>
        <script src="<?php echo plugin_path('perfect-scrollbar/src/perfect-scrollbar.js'); ?>"></script>

        <?php echo theme_js('main.js'); ?> 
        <script src="<?php echo plugin_path('jquery-validation/dist/jquery.validate.min.js'); ?>"></script>
        <?php echo theme_js('login.js'); ?>

        <!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
        <script>
                jQuery(document).ready(function () {
                    Main.init();
                    Login.init();
                });
        </script>
    </body>
    <!-- end: BODY -->
</html>