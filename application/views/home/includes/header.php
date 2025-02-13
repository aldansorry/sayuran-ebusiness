<!DOCTYPE html>
<html lang="en">

<head>
	<title>Vegefoods - Free Bootstrap 4 Template by Colorlib</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo base_url('vegefoods/') ?>css/open-iconic-bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('vegefoods/') ?>css/animate.css">

	<link rel="stylesheet" href="<?php echo base_url('vegefoods/') ?>css/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url('vegefoods/') ?>css/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?php echo base_url('vegefoods/') ?>css/magnific-popup.css">

	<link rel="stylesheet" href="<?php echo base_url('vegefoods/') ?>css/aos.css">

	<link rel="stylesheet" href="<?php echo base_url('vegefoods/') ?>css/ionicons.min.css">

	<link rel="stylesheet" href="<?php echo base_url('vegefoods/') ?>css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="<?php echo base_url('vegefoods/') ?>css/jquery.timepicker.css">


	<link rel="stylesheet" href="<?php echo base_url('vegefoods/') ?>css/flaticon.css">
	<link rel="stylesheet" href="<?php echo base_url('vegefoods/') ?>css/icomoon.css">
	<link rel="stylesheet" href="<?php echo base_url('vegefoods/') ?>css/style.css">
	<style>
		.link-disabled {
			pointer-events: none;
		}

		.separator {
			display: flex;
			align-items: center;
			text-align: center;
		}

		.separator::before,
		.separator::after {
			content: '';
			flex: 1;
			border-bottom: 1px solid rgba(0, 0, 0, 0.3);
		}

		.separator::before {
			margin-right: .25em;
		}

		.separator::after {
			margin-left: .25em;
		}
	</style>
</head>

<body class="goto-here">
	<div class="py-1 bg-primary">
		<div class="container">
			<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
				<div class="col-lg-12 d-block">
					<div class="row d-flex">
						<div class="col-md pr-4 d-flex topper align-items-center">
							<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
							<span class="text">+62 812-9163-4919</span>
						</div>
						<div class="col-md pr-4 d-flex topper align-items-center">
							<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
							<span class="text">tahtareza98@gmail.com</span>
						</div>
						<div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
							<span class="text">3-5 Business days delivery &amp; Free Returns</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="<?php echo base_url('Home') ?>">Sok Kabeh</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active"><a href="<?php echo base_url('Home') ?>" class="nav-link">Home</a></li>
					
					<li class="nav-item active"><a href="<?php echo base_url('Home/shop') ?>" class="nav-link">Shop</a></li>
					<li class="nav-item"><a href="<?php echo base_url('Home/about') ?>" class="nav-link">About</a></li>
					<?php if ($this->session->userdata('lg_status')) : ?>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pengguna [<?php echo $this->session->userdata('lg_nama') ?>]</a>
							<div class="dropdown-menu" aria-labelledby="dropdown04">
								<a class="dropdown-item" href="<?php echo base_url('Home/pembelian') ?>">Pembelian</a>
								<a class="dropdown-item" href="<?php echo base_url('Home/profile') ?>">Profile</a>
								<a class="dropdown-item" href="<?php echo base_url('Home/logout') ?>">Logout</a>
							</div>
						</li>
					<?php else : ?>

						<li class="nav-item"><a href="<?php echo base_url('Home/login') ?>" class="nav-link">Login</a></li>
					<?php endif ?>
					<li class="nav-item cta cta-colored"><a href="<?php echo base_url('Home/cart') ?>" class="nav-link"><span class="icon-shopping_cart"></span><span id="cart-count">[0]</span></a></li>

				</ul>
			</div>
		</div>
	</nav>