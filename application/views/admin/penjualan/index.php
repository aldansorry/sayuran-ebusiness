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
                <h3 class="title-5 m-b-35">Penjualan</h3>
                <div class="table-responsive table-responsive-data2">
                    <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_penjualan as $key => $value) : ?>
                                <tr>
                                    <td><?php echo $key+1 ?></td>
                                    <td><?php echo $value->kode ?></td>
                                    <td><?php echo $value->tanggal ?></td>
                                    <td>
                                        <?php 
                                        switch($value->status){
                                            case 1:
                                                echo '<span class="badge badge-secondary">belum dibayar</span>';
                                            break;
                                            case 2:
                                                echo '<span class="badge badge-primary">belum dikonfirmasi</span>';
                                            break;
                                            case 3:
                                                echo '<span class="badge badge-success">sudah dikonfirmasi</span>';
                                            break;
                                            case 4:
                                                echo '<span class="badge badge-warning">proses pengiriman</span>';
                                            break;
                                            case 5:
                                                echo '<span class="badge badge-success">selesai</span>';
                                            break;
                                        }
                                        ?>
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