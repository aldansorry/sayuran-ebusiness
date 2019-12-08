<?php $this->load->view('home/includes/header') ?>

<div class="hero-wrap hero-bread" style="background-image: url('<?php echo base_url('vegefoods/') ?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Login</span></p>
                <h1 class="mb-0 bread">Login</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
                <h3 class="mb-4 billing-heading">Login</h3>

                <form action="" class="billing-form" id="form-login" method="post">
                    <div class="row align-items-end">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname">Email</label>
                                <input type="text" name="email" class="form-control" style="color:black !important" placeholder="">
                                <?php echo form_error('email', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname">Password</label>
                                <input type="password" name="password" class="form-control" style="color:black !important" placeholder="">
                                <?php echo form_error('password', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>

                        <div class="w-100"></div>
                        <a href="#" class="btn btn-primary py-3 px-4" style="width:100% !important;" onclick="$('#form-login').submit()">Login</a>

                        <p class="text-center" style="text-align: center;width:100%;margin-top:20px;">
                            <a href="<?php echo base_url('Home/register') ?>">Atau register untuk mendapatkan akun</a>
                        </p>
                    </div>
                </form><!-- END -->
            </div>
        </div>

    </div>

    </div>
</section> <!-- .section -->
<?php $this->load->view('home/includes/footer') ?>