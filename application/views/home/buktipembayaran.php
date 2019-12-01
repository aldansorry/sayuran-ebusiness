<?php $this->load->view('home/includes/header') ?>
<div class="hero-wrap hero-bread" style="background-image: url('<?php echo base_url('vegefoods/') ?>images/bg_1.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Upload Bukti Pembayaran</span></p>
                <h1 class="mb-0 bread">Kode Pembayaran <b><?php echo $kode ?></b></h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-7 ftco-animate">
                <h3 class="mb-4 billing-heading">Upload Bukti Pembayaran</h3>
                <?php echo form_open_multipart('',['id' => 'form-upload']); ?>
                <img src="" id="img-preview" class="mb-3" alt="" style="width:100%;display:none">
                <input type="file" name="gambar" id="file-gambar" class="form-control">
                <?php echo (isset($gambar_error) ? "<p class='text-danger'>" . $gambar_error . "</p>" : "") ?>
                
                <a href="#" class="btn btn-primary py-3 px-4 mt-3" style="width:100% !important;" onclick="$('#form-upload').submit()">Upload</a>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('home/includes/footer') ?>
<script>
    $(document).ready(function() {
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