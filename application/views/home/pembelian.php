<?php $this->load->view('home/includes/header') ?>
<div class="hero-wrap hero-bread" style="background-image: url('<?php echo base_url('vegefoods/') ?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Wishlist</span></p>
                <h1 class="mb-0 bread">My Wishlist</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-cart">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>Tanggal</th>
                                <th>Tanggal Kirim</th>
                                <th>Product List</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($this->db->where('fk_pengguna', $this->session->userdata('lg_id'))->get('penjualan')->result() as $key => $value) : ?>
                                <tr class="text-center">
                                    <td><?php echo $value->tanggal ?></td>
                                    <td><?php echo $value->tanggal_kirim ?></td>

                                    <td class="">
                                        <p>
                                            <?php $total = 0; ?>
                                            <?php foreach ($this->db->select('penjualan_detail.*,produk_detail.satuan produk_satuan,produk_detail.jenis produk_jenis,(select nama from produk where id=produk_detail.fk_produk) as produk_nama')->join('produk_detail', 'penjualan_detail.fk_produk_detail=produk_detail.id')->where('fk_penjualan', $value->id)->get('penjualan_detail')->result() as $k => $v) : ?>
                                                <?php echo $v->produk_nama . "-" . $v->produk_jenis . " @" . $v->harga_sekarang . " jumlah : " . $v->jumlah; ?>
                                                <?php 
                                                $total += $v->jumlah*$v->harga_sekarang;
                                                ?>
                                            <?php endforeach ?>
                                        </p>
                                    </td>


                                    <td class="total"><?php echo $total+($total  < 100000 ? 10000 : 0) ?></td>
                                    <td>
                                    <?php 
                                        switch($value->status){
                                            case 1:
                                                echo '<span class="badge badge-secondary">lakukan bukti pembayaran</span>';
                                            break;
                                            case 2:
                                                echo '<span class="badge badge-primary">tunggu konfirmasi</span>';
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
                                    <td class="product-remove">
                                        <?php if($value->status==1): ?>
                                            <a href="<?php echo base_url('Home/buktipembayaran/'.$value->kode) ?>">Bayar</a>
                                        <?php endif ?>
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

<?php $this->load->view('home/includes/footer') ?>