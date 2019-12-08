<?php $this->load->view('home/includes/header') ?>

<div class="hero-wrap hero-bread" style="background-image: url('<?php echo base_url('vegefoods/') ?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Profile</span></p>
                <h1 class="mb-0 bread">Profile</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
                <h3 class="mb-4 billing-heading">Profile</h3>

                <form action="" class="billing-form" id="form-register" method="post">
                    <div class="row align-items-end">
                    <div class="col-md-12">
                            <div class="form-group">
                                <label for="firstname">Nama</label>
                                <input type="text" name="register[nama]" class="form-control" style="color:black !important" placeholder="" value="<?php echo $pengguna->nama ?>">
                                    <?php echo form_error('register[nama]', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="w-100"></div>

                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="streetaddress">Street Address</label>
                                <input type="text" name="register[alamat]" class="form-control" style="color:black !important" placeholder="House number and street name" value="<?php echo $pengguna->alamat ?>">
                                    <?php echo form_error('register[alamat]', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="register[alamatNote]" class="form-control" style="color:black !important" placeholder="Appartment, suite, unit etc: (optional)" value="<?php echo $pengguna->alamatNote ?>">
                                    <?php echo form_error('register[alamatNote]', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="streetaddress">Negara</label>
                                <input type="text" name="register[negara]" class="form-control" style="color:black !important" value="Indonesia" disabled>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="towncity">Provinsi</label>
                                <input type="text" name="register[provinsi]" class="form-control" style="color:black !important" value="Jawa Timur" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postcodezip">Kota</label>
                                <input type="text" name="register[kota]" class="form-control" style="color:black !important" value="Malang" disabled>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="towncity">Kecamatan</label>
                                <input type="text" name="register[kecamatan]" class="form-control" style="color:black !important" placeholder="" value="<?php echo $pengguna->kecamatan ?>">
                                    <?php echo form_error('register[kecamatan]', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postcodezip">Kode Pos</label>
                                <input type="text" name="register[kodepos]" class="form-control" style="color:black !important" placeholder="" value="<?php echo $pengguna->kodepos ?>">
                                    <?php echo form_error('register[kodepos]', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Telepon (WhatsApp)</label>
                                <input type="text" name="register[telepon]" class="form-control" style="color:black !important" placeholder="" value="<?php echo $pengguna->telepon ?>">
                                    <?php echo form_error('register[telepon]', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">Email</label>
                                <input type="text" name="register[email]" class="form-control" style="color:black !important" placeholder="" value="<?php echo $pengguna->email ?>" disabled>
                                    <?php echo form_error('register[email]', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="w-100">
                            <div class="separator">Optional</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">Password</label>
                                <input type="password" name="register[password]" class="form-control" style="color:black !important" placeholder="">
                                <?php echo form_error('register[password]', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="emailaddress">Reenter Password</label>
                                <input type="password" name="register[repassword]" class="form-control" style="color:black !important" placeholder="">
                                <?php echo form_error('register[repassword]', '<p class="text-danger">', '</p>') ?>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="w-100"></div>
                <a href="#" class="btn btn-primary py-3 px-4" style="width:100% !important;" onclick="$('#form-register').submit()">Register</a>
            </div>
        </div>

    </div>

    </div>
</section> <!-- .section -->
<?php $this->load->view('home/includes/footer') ?>