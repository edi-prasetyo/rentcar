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
    <div class="col-md-7 mx-auto">

        <?php echo form_open('myaccount/update_profile'); ?>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">Nama</label>
            <div class="col-md-8">
                <input type="text" class="form-control form-control-lg" name="name" value="<?php echo $user->name; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">Email</label>
            <div class="col-md-8">
                <input type="text" class="form-control form-control-lg" name="email" value="<?php echo $user->email; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">Phone</label>
            <div class="col-md-8">
                <input type="text" class="form-control form-control-lg" name="user_phone" value="<?php echo $user->user_phone; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">Alamat</label>
            <div class="col-md-8">
                <textarea class="form-control form-control-lg" name="user_address"><?php echo $user->user_address; ?></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right"></label>
            <div class="col-md-8">
                <button type="submit" class="btn btn-success btn-lg btn-block">Update</button>
            </div>
        </div>
        <?php echo form_close(); ?>

    </div>
</div>