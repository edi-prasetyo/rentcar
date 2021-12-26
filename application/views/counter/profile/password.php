<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header">
            Ubah Password, <?php echo $profile->name; ?>
        </div>

        <?php
        echo form_open_multipart('counter/profile/password');
        ?>

        <div class="card-body">



            <div class="row">

                <label class="col-md-3">Password Baru</label>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password1" placeholder="Password">
                        <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="col-md-3">Ulangi Password</div>
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password2" placeholder="Repeat Password">
                    </div>
                </div>

                <div class="col-3">

                </div>
                <div class="col-9">
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Update Password
                    </button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>