<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="<?php echo base_url("cooladmin/") ?>css/font-face.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url("cooladmin/") ?>vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url("cooladmin/") ?>vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url("cooladmin/") ?>vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?php echo base_url("cooladmin/") ?>vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="<?php echo base_url("cooladmin/") ?>vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url("cooladmin/") ?>vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url("cooladmin/") ?>vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url("cooladmin/") ?>vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url("cooladmin/") ?>vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url("cooladmin/") ?>vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url("cooladmin/") ?>vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?php echo base_url("cooladmin/") ?>css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="<?php echo base_url("cooladmin/") ?>images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="" method="post">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="au-input au-input--full" type="text" name="username" placeholder="Username">
                                    <?php echo form_error('username', '<p class="text-danger">', '</p>') ?>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
                                    <?php echo form_error('password', '<p class="text-danger">', '</p>') ?>
                                </div>

                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="<?php echo base_url("cooladmin/") ?>vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="<?php echo base_url("cooladmin/") ?>vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="<?php echo base_url("cooladmin/") ?>vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="<?php echo base_url("cooladmin/") ?>vendor/slick/slick.min.js">
    </script>
    <script src="<?php echo base_url("cooladmin/") ?>vendor/wow/wow.min.js"></script>
    <script src="<?php echo base_url("cooladmin/") ?>vendor/animsition/animsition.min.js"></script>
    <script src="<?php echo base_url("cooladmin/") ?>vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="<?php echo base_url("cooladmin/") ?>vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="<?php echo base_url("cooladmin/") ?>vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="<?php echo base_url("cooladmin/") ?>vendor/circle-progress/circle-progress.min.js"></script>
    <script src="<?php echo base_url("cooladmin/") ?>vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="<?php echo base_url("cooladmin/") ?>vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?php echo base_url("cooladmin/") ?>vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="<?php echo base_url("cooladmin/") ?>js/main.js"></script>

</body>

</html>
<!-- end document-->