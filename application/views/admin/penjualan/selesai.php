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
                                <th>Tanggal Kirim</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Note</th>
                                <th>Kecamatan</th>
                                <th>Produk</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->db->select('penjualan.*,pengguna.nama pengguna_nama,pengguna.alamat pengguna_alamat,pengguna.alamatNote pengguna_alamatNote,pengguna.kecamatan pengguna_kecamatan')->join('pengguna','penjualan.fk_pengguna=pengguna.id')->where('status', 4)->get('penjualan')->result() as $key => $value) : ?>
                                <tr>
                                    <td><?php echo $key + 1 ?></td>
                                    <td><?php echo $value->kode ?></td>
                                    <td><?php echo $value->tanggal_kirim ?></td>
                                    <td><?php echo $value->pengguna_nama ?></td>
                                    <td><?php echo $value->pengguna_alamat ?></td>
                                    <td><?php echo $value->pengguna_alamatNote ?></td>
                                    <td><?php echo $value->pengguna_kecamatan ?></td>
                                    <td>
                                        <?php foreach ($this->db->select('penjualan_detail.*,produk_detail.satuan produk_satuan,produk_detail.jenis produk_jenis,(select nama from produk where id=produk_detail.fk_produk) as produk_nama')->join('produk_detail', 'penjualan_detail.fk_produk_detail=produk_detail.id')->where('fk_penjualan', $value->id)->get('penjualan_detail')->result() as $k => $v) : ?>
                                            <?php echo $v->produk_nama . "-" . $v->produk_jenis . " jumlah : " . $v->jumlah. " ".$v->produk_satuan; ?>
                                        <?php endforeach ?></td>
                                    
                                    <td>
                                        <a href="<?php echo base_url('Penjualan/set_selesai/' . $value->id) ?>" class="btn btn-sm btn-primary">Selesai</a>
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