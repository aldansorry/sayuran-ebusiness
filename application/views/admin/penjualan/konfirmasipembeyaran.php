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
                                <th>Tanggal Kirim</th>
                                <th>Methode Pembayaran</th>
                                <th>Total</th>
                                <th>Gambar</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_penjualan as $key => $value) : ?>
                                <tr>
                                    <td><?php echo $key + 1 ?></td>
                                    <td><?php echo $value->kode ?></td>
                                    <td><?php echo $value->tanggal ?></td>
                                    <td><?php echo $value->tanggal_kirim ?></td>
                                    <td>
                                        <?php if($value->payment_method == 1): ?>
                                            <span class="badge badge-warning">Transfer</span>
                                        <?php else: ?>
                                            <span class="badge badge-primary">Sok Point <?php echo $this->db->select('point')->where('id', $value->fk_pengguna)->get('pengguna')->row(0)->point ?></span>
                                        <?php endif ?>
                                    </td>
                                    <td><?php echo $value->total+($value->total  < 100000 ? 10000 : 0) ?></td>
                                    <td>
                                        <a href="<?php echo base_url('storage/buktipembayaran/' . $value->bukti_pembayaran) ?>">
                                            <img src="<?php echo base_url('storage/buktipembayaran/' . $value->bukti_pembayaran) ?>" alt="" style="width:100px">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('Penjualan/set_konfirmasi/'.$value->id) ?>" class="btn btn-sm btn-success">Konfirmasi</a>
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