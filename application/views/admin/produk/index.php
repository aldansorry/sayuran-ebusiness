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
                <h3 class="title-5 m-b-35">Produk</h3>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <!-- <div class="rs-select2--light rs-select2--md">
                            <select class="js-select2" name="property">
                                <option selected="selected">All Properties</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <div class="rs-select2--light rs-select2--sm">
                            <select class="js-select2" name="time">
                                <option selected="selected">Today</option>
                                <option value="">3 Days</option>
                                <option value="">1 Week</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                        <button class="au-btn-filter">
                            <i class="zmdi zmdi-filter-list"></i>filters</button> -->
                    </div>
                    <div class="table-data__tool-right">
                        <a href="<?php echo base_url($cname."/insert") ?>" class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>add item</a>
                        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                            <select class="js-select2" name="type">
                                <option selected="selected">Export</option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Gambar</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_produk as $key => $value) : ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><?php echo $value->nama ?></td>
                                    <td><?php echo $value->kategori ?></td>
                                    <td><?php echo $value->keterangan ?></td>
                                    <td>
                                        <img src="<?php echo base_url('storage/produk/'.$value->gambar) ?>" alt="" style="width:100px">
                                    </td>
                                    <td>
                                    <a href="<?php echo base_url("ProdukDetail/set_produk/".$value->id) ?>" class="btn btn-sm btn-info"><i class="fa fa-info"></i></a>
                                        <a href="<?php echo base_url($cname."/update/".$value->id) ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-alt text-white"></i></a>
                                        <a href="<?php echo base_url($cname."/delete/".$value->id) ?>" onclick="return confirm('Apakah anda yakin??');" class="btn btn-sm btn-danger"><i class="fa fa-trash text-white"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
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