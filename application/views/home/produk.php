<?php $this->load->view('home/includes/header') ?>

<div class="hero-wrap hero-bread" style="background-image: url('<?php echo base_url('vegefoods/') ?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="index.html">Product</a></span> <span>Product Single</span></p>
                <h1 class="mb-0 bread">Product Single</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="<?php echo base_url('storage/produk/' . $produk->gambar) ?>" class="image-popup"><img src="<?php echo base_url('storage/produk/' . $produk->gambar) ?>" class="img-fluid" alt="Colorlib Template"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3><?php echo $produk->nama ?></h3>
                <div class="rating d-flex">
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2">5.0</a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                    </p>
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
                    </p>
                    <p class="text-left">
                        <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
                    </p>
                </div>
                <p class="price"><span>Rp. <?php echo $produk->minharga ?> - <?php echo $produk->maxharga ?></span></p>
                <p>
                    <?php echo $produk->keterangan ?>
                </p>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <img src="<?php echo base_url('storage/produk/' . $produk->gambar) ?>" class="img-fluid mb-3" id="produk-detail-img" alt="Colorlib Template" style="width:150px;">
                        <div class="form-group d-flex">
                            <div class="select-wrap">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="id_produk_detail" id="" class="form-control">
                                    <?php foreach ($this->db->where('fk_produk', $produk->id)->get('produk_detail')->result() as $key => $value) : ?>
                                        <option value="<?php echo $value->id ?>" data-gambar="<?php echo $value->gambar ?>"><?php echo $value->jenis ?> Rp. <?php echo $value->harga . "/" . $value->satuan ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="input-group col-md-6 d-flex mb-3">
                        <span class="input-group-btn mr-2">
                            <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                <i class="ion-ios-remove"></i>
                            </button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                        <span class="input-group-btn ml-2">
                            <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                <i class="ion-ios-add"></i>
                            </button>
                        </span>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <p style="color: #000;">600 kg available</p>
                    </div>
                </div>
                <p><a href="#" class="btn btn-black py-3 px-5" id="btn-add-to-cart">Add to Cart</a></p>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Products</span>
                <h2 class="mb-4">Related Products</h2>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php foreach ($related_produk as $key => $value) : ?>
                <div class="col-md-6 col-lg-3 ftco-animate">
                    <div class="product">
                        <a href="<?php echo base_url('Home/produk/' . $value->id) ?>" class="img-prod"><img class="img-fluid" src="<?php echo base_url('storage/produk/' . $value->gambar) ?>" alt="Colorlib Template" style="min-height:260px;max-height:260px;width:100%;">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 pb-4 px-3 text-center">
                            <h3><a href="#"><?php echo $value->nama ?></a></h3>
                            <div class="d-flex">
                                <div class="pricing" style="text-align:center;">
                                    <p class="price"><span>Rp. <?php echo number_format($value->harga, 0, ',', '.') ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<?php $this->load->view('home/includes/footer') ?>
<script>
    $(document).ready(function() {
        $('[name=id_produk_detail]').change(function() {
            $('#produk-detail-img').attr('src', "<?php echo base_url('storage/produk/') ?>" + $(this).find(':selected').data('gambar'));
        });

        var quantity = 0;
        $('.quantity-right-plus').click(function(e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);


            // Increment

        });

        $('.quantity-left-minus').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if (quantity > 0) {
                $('#quantity').val(quantity - 1);
            }
        });


        $('#btn-add-to-cart').click(function() {
            let id_produk = $('[name=id_produk_detail]').val();
            let quantity = $('[name=quantity]').val();

            $.ajax({
                url: "<?php echo base_url('Cart/insert') ?>",
                type: "POST",
                data: {
                    id_produk: id_produk,
                    quantity: quantity
                }
            }).done(function(data) {
                refresh_count();
                alert("SUKSES ADD TO CART");
            });
        });
    });
</script>