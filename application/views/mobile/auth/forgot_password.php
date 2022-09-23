<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<div class="container my-5">
    <div class="col-md-12">
        <div class="text-center">
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
        $attributes = array('class' => 'user');
        echo form_open('auth/forgotpassword', $attributes)
        ?>
        <div class="form-group">
            <label>Masukan Nomor Whatsapp </label>
            <input type="text" class="form-control form-control-lg shadow-sm border-0" name="user_phone" id="user_phone" placeholder="No Whatsapp..." value="<?php echo set_value('email'); ?>" style="text-transform: lowercase">
            <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>


        <button type="submit" class="btn btn-primary btn-user btn-block btn-lg my-3">
            Reset Password
        </button>

        <?php echo form_close() ?>


        <div class="text-center my-3">
            <a class="text-muted" href="<?php echo base_url('auth') ?> ">Back to Login</a>
        </div>

    </div>
</div>