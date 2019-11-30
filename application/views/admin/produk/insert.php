<?php $this->load->view('admin/includes/header') ?>
<!-- BREADCRUMB-->
<section class="au-breadcrumb2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="au-breadcrumb-content">
                    <div class="au-breadcrumb-left">
                        <span class="au-breadcrumb-span">You are here:</span>
                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                            <li class="list-inline-item active">
                                <a href="#">Home</a>
                            </li>
                            <li class="list-inline-item seprate">
                                <span>/</span>
                            </li>
                            <li class="list-inline-item">Dashboard</li>
                        </ul>
                    </div>
                    <form class="au-form-icon--sm" action="" method="post">
                        <input class="au-input--w300 au-input--style2" type="text" placeholder="Search for datas &amp; reports...">
                        <button class="au-btn--submit2" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END BREADCRUMB-->

<!-- DATA TABLE-->
<section class="p-t-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-5 m-b-35">Produk <b>Tambah</b></h3>

                <?php echo form_open(""); ?>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="col-form-label">Nama</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="nama" class="form-control" value="<?php echo set_value('nama') ?>">
                        <?php echo form_error('nama', '<p class="text-danger">', '</p>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="col-form-label">sayur</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="sayur" class="form-control" value="<?php echo set_value('sayur') ?>">
                        <?php echo form_error('sayur', '<p class="text-danger">', '</p>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="col-form-label">keterangan</label>
                    </div>
                    <div class="col-md-10">
                        <textarea name="keterangan" class="form-control" value="<?php echo set_value('keterangan') ?>"></textarea>
                        <?php echo form_error('keterangan', '<p class="text-danger">', '</p>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
<!-- END DATA TABLE-->

<!-- COPYRIGHT-->
<section class="p-t-60 p-b-20">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END COPYRIGHT-->
<?php $this->load->view('admin/includes/footer') ?>
<script>
    $(document).ready(function() {
        $('#data-table').DataTable();
    });
</script>