<div class="card">
        <div class="card-header">
                <div class="card-header-left">
                        <h5><?php echo $title; ?></h5>
                </div>
                <div class="card-header-right">

                </div>

        </div>
        <div class="card-body">



                <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nama
                        </label>
                        <div class="col-lg-6">
                                : <?php echo $user_detail->name; ?>
                        </div>
                </div>
                <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Nomor Handphone
                        </label>
                        <div class="col-lg-6">
                                : <?php echo $user_detail->user_phone; ?>
                        </div>
                </div>
                <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Email
                        </label>
                        <div class="col-lg-6">
                                : <?php echo $user_detail->email; ?>
                        </div>
                </div>
                <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Alamat
                        </label>
                        <div class="col-lg-6">
                                : <?php echo $user_detail->user_address; ?>
                        </div>
                </div>
                <div class="form-group row">
                        <label class="col-lg-3 col-form-label">Counter ID
                        </label>
                        <div class="col-lg-6">
                                : <?php echo $user_detail->user_code; ?>
                        </div>
                </div>
        </div>
</div>