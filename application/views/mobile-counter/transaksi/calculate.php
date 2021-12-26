<div class="card">
    <div class="card-body">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.0235865120403!2d106.65151711458817!3d-6.127528195563287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6a02695aaccb09%3A0x61dee98159fa3fe5!2sBandar%20Udara%20Internasional%20Soekarno%E2%80%93Hatta!5e0!3m2!1sid!2sid!4v1630481097996!5m2!1sid!2sid" width="100%" height="100" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Cek Harga</h3>
            </div>
            <div class="card-body">
                <?php echo form_open('counter/transaksi/create',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                <div class="row">
                    <div class="col-md-12">
                        <fieldset class="fieldset-title">
                            <legend class="fieldset-title"> Data Alamat :</legend>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat Tujuan</label>
                                        <input type="text" class="form-control" name="address" placeholder="Alamat Tujuan" required>
                                        <div class="invalid-feedback">Silahkan Masukan Alamat Tujuan</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>KM</label>
                                        <input type="number" class="form-control" name="jarak" placeholder=".." required>
                                        <div class="invalid-feedback">Silahkan Masukan Total KM.</div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Cek Harga</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>