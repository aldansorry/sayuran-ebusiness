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

                <?php echo form_open_multipart(""); ?>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="col-form-label">Produk</label>
                    </div>
                    <div class="col-md-10">
                        <select name="fk_produk" id="" class="form-control">
                            <option value="" selected disabled>Choose</option>
                            <?php foreach ($this->db->get('produk')->result() as $key => $value) : ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->nama ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="col-form-label">jenis</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="jenis" class="form-control" value="<?php echo set_value('jenis') ?>">
                        <?php echo form_error('jenis', '<p class="text-danger">', '</p>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="col-form-label">satuan</label>
                    </div>
                    <div class="col-md-10">
                        <input type="text" name="satuan" class="form-control" value="<?php echo set_value('satuan') ?>" list="list-satuan">
                        <datalist id="list-satuan">
                            <?php foreach ($this->db->select('satuan')->group_by('satuan')->get('produk_detail')->result() as $key => $value) : ?>
                                <option><?php echo $value->satuan ?></option>
                            <?php endforeach ?>
                        </datalist>
                        <?php echo form_error('satuan', '<p class="text-danger">', '</p>') ?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="col-form-label">harga</label>
                    </div>
                    <div class="col-md-10">
                        <input type="number" name="harga" class="form-control" value="<?php echo set_value('harga') ?>">
                        <?php echo form_error('harga', '<p class="text-danger">', '</p>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="col-form-label">gambar</label>
                    </div>
                    <div class="col-md-10">
                        <img src="" id="img-preview" alt="" style="width:200px;display:none">
                        <input type="file" name="gambar" id="file-gambar" class="form-control">
                        <?php echo (isset($gambar_error) ? "<p class='text-danger'>" . $gambar_error . "</p>" : "") ?>
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

        $('#file-gambar').change(function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img-preview').attr('src', e.target.result);
                $('#img-preview').fadeIn();
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>