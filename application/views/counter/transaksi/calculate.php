<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<div class="my-1">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.0235865120403!2d106.65151711458817!3d-6.127528195563287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a02695aaccb09%3A0x61dee98159fa3fe5!2sBandar%20Udara%20Internasional%20Soekarno%E2%80%93Hatta!5e0!3m2!1sid!2sid!4v1630481097996!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</div>
<div class="container my-3 pb-5">

    <div class="col-12 mx-auto">
        <div class="card">
            <div class="card-body">
                <?php echo form_open('counter/transaksi/create',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>

                <div class="form-group">
                    <label>Alamat Tujuan</label>
                    <div class="input-group mb-3">
                        <textarea class="form-control" name="address" placeholder="Alamat Tujuan" required></textarea>

                    </div>
                    <div class="invalid-feedback">Silahkan Masukan Alamat Tujuan</div>
                </div>

                <div class="form-group">
                    <label>KM</label>
                    <input type="number" class="form-control" name="jarak" placeholder="km" required>
                    <div class="invalid-feedback">Silahkan Masukan Total KM.</div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Cek Harga</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>