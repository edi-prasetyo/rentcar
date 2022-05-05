<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>




<div class="container my-3">
    <div class="col-12">

        <?php
        echo form_open_multipart('myaccount/update_password/');
        ?>
        <label>Password Baru</label>
        <div class="form-group">
            <input type="password" class="form-control form-control-lg" name="password1" placeholder="Password">
            <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>


        <label>Ulangi Password</label>
        <div class="form-group">
            <input type="password" class="form-control form-control-lg" name="password2" placeholder="Repeat Password">
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">
            Update Password
        </button>

        <?php echo form_close(); ?>
    </div>
</div>