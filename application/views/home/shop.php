<?php $this->load->view('home/includes/header') ?>

<div class="hero-wrap hero-bread" style="background-image: url('<?php echo base_url('vegefoods/') ?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
                <h1 class="mb-0 bread">Products</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <input type="text" class="form-control" placeholder="Pencarian" onchange="change_search(this)">
                <span class="text-muted">tekan tombol Enter</span>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-10 mb-5 text-center">
                <ul class="product-category">
                    <li><a href="javascript:void(0)" class="active" id="kategori-" onclick="produk_kategori('')">All</a></li>
                    <?php foreach ($this->db->group_by('kategori')->get('produk')->result() as $key => $value) : ?>
                        <li><a href="javascript:void(0)" id="kategori-<?php echo $value->kategori ?>" onclick="produk_kategori($(this).data('kategori'))" data-kategori="<?php echo $value->kategori ?>"><?php echo $value->kategori ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        <div class="row" id="produk-container">

        </div>
        <div class="row mt-5">
            <div class="col text-center">
                <div class="block-27">
                    <ul id="produk-pager">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('home/includes/footer') ?>

<script>
    var kategori = '';
    var current_page = 1;
    var total_page = 1;
    var search_key = "";

    $(document).ready(function() {
        get_produk();




    });

    var produk_kategori = (kat) => {
        $('.product-category').find('a').removeClass('active');
        $('#kategori-' + kat).addClass('active');
        kategori = kat;
        get_produk();
    }

    var change_search = (obj) => {
        let word = $(obj).val();
        search_key = word;
        get_produk();
    }

    var pagerNext = () => {
        if (current_page < total_page) {
            current_page++;
            show_produk_page(current_page);
        }
    }

    var pagerPrev = () => {
        if (current_page > 1) {
            current_page--;
            show_produk_page(current_page);
        }
    }

    var show_produk_page = (pages) => {
        current_page = pages;
        $('.produk-data').fadeOut();
        $('.produk-page-' + pages).fadeIn();
        $('.btn-pages-status').removeClass('active');
        $('.btn-pages').removeClass('link-disabled');
        $('.btn-pages-' + pages).addClass('link-disabled').parent().addClass('active');
    }

    var get_produk = () => {
        $.ajax({
            url: "<?php echo base_url('Home/get_produk') ?>",
            type: "POST",
            data: {
                kategori: kategori,
                search_key: search_key,
            },
            dataType: "JSON",
        }).done(function(data) {
            let produk = data.produk;
            $('#produk-container').html('');

            var page = 1;
            $.each(produk, function(key, value) {
                let html = "";
                html += '<div class="col-md-6 col-lg-3 produk-data produk-page-' + page + '" style="display:none">';
                html += '<div class="product">';
                html += '<a href="<?php echo base_url('Home/produk/') ?>' + value.id + '" class="img-prod"><img class="img-fluid" src="<?php echo base_url('storage/produk/') ?>' + value.gambar + '" alt="Colorlib Template" style="min-height:260px;max-height:260px;width:100%;">';
                html += '<div class="overlay"></div>';
                html += '</a>';
                html += '<div class="text py-3 pb-4 px-3 text-center">';
                html += '<h3><a href="#">' + value.kategori + '</a></h3>';
                html += '<h4 class="text-muted"><a href="#">' + value.nama + '</a></h4>';
                html += '<div class="d-flex">';
                html += '<div class="pricing">';
                html += '<p class="price"><span>Rp. ' + value.harga + '</span></p>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                if (page % 12 == 0) {
                    page++;
                }
                $('#produk-container').append(html);
            })
            total_page = page;
            let produk_pager = "";
            produk_pager += '<li><a href="javascript:void(0)" onclick="pagerPrev()">&lt;</a></li>';
            for (var i = 1; i <= page; i++) {
                produk_pager += '<li class="btn-pages-status"><a href="javascript:void(0)" onclick="show_produk_page(' + i + ')" class="btn-pages btn-pages-' + i + '">' + i + '</a></li>';
            }
            produk_pager += '<li><a href="javascript:void(0)" onclick="pagerNext()">&gt;</a></li>';
            $('#produk-pager').html(produk_pager);

            show_produk_page(1);
            current_page = 1;
        });
    };
</script>