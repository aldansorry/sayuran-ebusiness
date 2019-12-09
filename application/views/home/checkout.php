<?php $this->load->view('home/includes/header') ?>

<div class="hero-wrap hero-bread" style="background-image: url('<?php echo base_url('vegefoods/') ?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
                <h1 class="mb-0 bread">Checkout</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <form action="" class="billing-form" id="form-checkout" method="post">
            <div class="row justify-content-center">
                <div class="col-xl-7 ftco-animate">

                

                        <h3 class="mb-4 billing-heading">Your Billing Information</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname">Nama</label>
                                    <input type="text" name="register[nama]" value="<?php echo $pengguna->nama ?>" class="form-control" style="color:black !important" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="w-100"></div>

                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="streetaddress">Street Address</label>
                                    <input type="text" name="register[alamat]" value="<?php echo $pengguna->alamat ?>" class="form-control" style="color:black !important" placeholder="House number and street name" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" name="register[alamatNote]" value="<?php echo $pengguna->alamatNote ?>" class="form-control" style="color:black !important" placeholder="Appartment, suite, unit etc: (optional)" disabled>
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
                                    <input type="text" name="register[kecamatan]" value="<?php echo $pengguna->kecamatan ?>" class="form-control" style="color:black !important" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postcodezip">Kode Pos</label>
                                    <input type="text" name="register[kodepos]" value="<?php echo $pengguna->kodepos ?>" class="form-control" style="color:black !important" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Telepon (WhatsApp)</label>
                                    <input type="text" name="register[telepon]" value="<?php echo $pengguna->telepon ?>" class="form-control" style="color:black !important" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="emailaddress">Email</label>
                                    <input type="text" name="register[email]" value="<?php echo $pengguna->email ?>" class="form-control" style="color:black !important" placeholder="" disabled>
                                </div>
                            </div>
                            <div class="w-100"></div>
                        </div>
                   
                </div>
                <div class="col-xl-5">
                    <div class="row mt-5 pt-3">
                        <div class="col-md-12 d-flex mb-3">
                            <div class="cart-detail cart-total p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Cart Total</h3>
                                <p class="d-flex">
                                    <span>Subtotal</span>
                                    <span><?php echo $subtotal ?></span>
                                </p>
                                <p class="d-flex">
                                    <span>Delivery</span>
                                    <span><?php echo $delivery ?></span>
                                </p>
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Total</span>
                                    <span><?php echo $total ?></span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="cart-detail p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Waktu Pengiriman</h3>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="emailaddress">Tanggal Kirim</label>
                                        <input type="date" name="tanggal_kirim" class="form-control" style="color:black !important" placeholder="" min="<?php echo date("Y-m-d") ?>" value="<?php echo set_value('tanggal_kirim') ?>">
                                        <?php echo form_error('tanggal_kirim', '<p class="text-danger">', '</p>') ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="emailaddress">Waktu Kirim</label>
                                        <input type="time" name="waktu_kirim" class="form-control" style="color:black !important" placeholder="" min="<?php echo date('H:i') ?>" required  value="<?php echo set_value('waktu_kirim') ?>">
                                        <?php echo form_error('waktu_kirim', '<p class="text-danger">', '</p>') ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="cart-detail p-3 p-md-4">
                            <h3 class="billing-heading mb-4">Metode Pembayaran</h3>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="payment_method" value="1" class="mr-2" <?php echo (isset($_POST['payment_method']) && $_POST['payment_method'] != 2 ? 'checked' : '') ?>> Transfer Bank (dapat point 10% dari pembelian)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="payment_method" value="2" class="mr-2" <?php echo (isset($_POST['payment_method']) && $_POST['payment_method'] == 2 ? 'checked' : '') ?>> Sok Point "<?php echo $this->db->select('point')->where('id', $this->session->userdata('lg_id'))->get('pengguna')->row(0)->point ?>"</label>
                                            <?php echo form_error('payment_method', '<p class="text-danger">', '</p>') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="term" value="" class="mr-2" required <?php echo (isset($_POST['term']) ? 'checked' : '') ?>> I have read and accept the terms and conditions</label>
                                            <?php echo form_error('term', '<p class="text-danger">', '</p>') ?>
                                        </div>
                                    </div>
                                </div>
                                <p><a href="#" class="btn btn-primary py-3 px-4" onclick="$('#form-checkout').submit()">Place an order</a></p>
                            </div>
                        </div>
                    </div>
                </div> <!-- .col-md-8 -->

                <?php if ($this->session->userdata('lg_status')) : ?>

                <?php endif ?>
            </div>

        </form><!-- END -->
    </div>
</section> <!-- .section -->
<?php $this->load->view('home/includes/footer') ?>