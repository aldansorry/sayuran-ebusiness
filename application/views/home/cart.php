<?php $this->load->view('home/includes/header') ?>

<div class="hero-wrap hero-bread" style="background-image: url('<?php echo base_url('vegefoods/') ?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
                <h1 class="mb-0 bread">My Cart</h1>
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
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="cart-container">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Coupon Code</h3>
                    <p>Enter your coupon code if you have one</p>
                    <form action="#" class="info">
                        <div class="form-group">
                            <label for="">Coupon code</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                        </div>
                    </form>
                </div>
                <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
            </div>
            <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Estimate shipping and tax</h3>
                    <p>Enter your destination to get a shipping estimate</p>
                    <form action="#" class="info">
                        <div class="form-group">
                            <label for="">Country</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="country">State/Province</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="country">Zip/Postal Code</label>
                            <input type="text" class="form-control text-left px-3" placeholder="">
                        </div>
                    </form>
                </div>
                <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p>
            </div>
            <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Cart Totals</h3>
                    <p class="d-flex">
                        <span>Subtotal</span>
                        <span id="price-subtotal"></span>
                    </p>
                    <p class="d-flex">
                        <span>Delivery</span>
                        <span id="price-delivery"></span>
                    </p>
                    <p class="d-flex">
                        <span>Discount</span>
                        <span id="price-discount"></span>
                    </p>
                    <hr>
                    <p class="d-flex total-price">
                        <span>Total</span>
                        <span id="price-total"></span>
                    </p>
                </div>
                <p><a href="<?php echo base_url("Home/checkout") ?>" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('home/includes/footer') ?>

<script>
    var price_subtotal = 0;
    var price_delivery = 0;
    var price_discount = 0;
    var price_total = 0;

    $(document).ready(function() {

        get_cart();

    });

    var get_cart = () => {
        $.ajax({
            url: "<?php echo base_url('Cart/get_content') ?>",
            type: "POST",
            dataType: "JSON",
        }).done(function(data) {
            let cart = data.cart;
            $("#cart-container").html("");
            $.each(cart, function(key, value) {

                let html = "";
                html += '<tr class="text-center">';
                html += '<td class="product-remove"><a href="#" onclick="remove_cart(this)" data-cartid="' + value.cartId + '"><span class="ion-ios-close"></span></a></td>';
                html += '<td class="image-prod">';
                html += '<div class="img" style="background-image:url(<?php echo base_url('storage/produk/') ?>' + value.gambar + ');"></div>';
                html += '</td>';
                html += '<td class="product-name">';
                html += '<h3>' + value.name + '</h3>';
                html += '<p>Jenis <b>' + value.jenis + '</b></p>';
                html += '</td>';
                html += '<td class="price">Rp. ' + value.harga + '</td>';
                html += '<td class="quantity">';
                html += '<div class="input-group mb-3">';
                html += '<input type="text" class="quantity form-control input-number" onchange="update_cart(this)" data-cartid="' + value.cartId + '" value="' + value.quantity + '" min="1" max="100">';
                html += '</div>';
                html += '</td>';
                html += '<td class="total">Rp. ' + value.subtotal + '</td>';
                html += '</tr>';
                $("#cart-container").append(html);
            });

            price_subtotal = data.total;
            checkout_data();
        });
    }

    var checkout_data = () => {
        $('#price-subtotal').html(price_subtotal)
        $('#price-delivery').html(price_delivery)
        $('#price-discount').html(price_discount)
        price_total = price_subtotal+price_delivery-price_discount;
        $('#price-total').html(price_total)
    }

    var update_cart = (obj) => {
        let cartid = $(obj).data('cartid');
        let quantity = $(obj).val();

        $(obj).attr('disabled', true);
        $.ajax({
            url: "<?php echo base_url('Cart/update') ?>",
            type: "POST",
            data: {
                cartid: cartid,
                quantity: quantity
            }
        }).done(function(data) {
            get_cart();
        });
    }

    var remove_cart = (obj) => {
        let cartid = $(obj).data('cartid');

        $.ajax({
            url: "<?php echo base_url('Cart/remove') ?>",
            type: "POST",
            data: {
                cartid: cartid
            }
        }).done(function(data) {
            get_cart();
        });
    }
</script>