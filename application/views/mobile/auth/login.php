<?php $meta = $this->meta_model->get_meta(); ?>
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
            <?php echo $this->session->flashdata('message');
            unset($_SESSION['message']);
            ?>
        </div>
        <?php
        $attributes = array('class' => 'user');
        echo form_open('auth', $attributes)
        ?>
        <div class="form-group">

            <label>Email</label>
            <input type="text" class="form-control form-control-lg shadow border-0" name="email" id="email" placeholder="Email Address..." value="<?php echo set_value('email'); ?>" style="text-transform: lowercase">
            <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

        </div>
        <div class="form-group">

            <label>Password</label>
            <input type="password" class="form-control form-control-lg shadow border-0" name="password" id="password" placeholder="Password">
            <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>

        </div>

        <div class="form-group ">
            <button type="submit" class="btn btn-primary btn-lg btn-block my-5">
                Login <i class="fa fa-arrow-right"></i>
            </button>



        </div>
        <div class="form-group row">


            <div class="col-6 border-right">
                <a class="text-muted" href="<?php echo base_url('auth/register'); ?>">Daftar Member</a>
            </div>
            <div class="col-6 text-right">
                <a class="text-muted" href="<?php echo base_url('auth/forgotpassword'); ?>">Lupa Password</a>
            </div>

        </div>
        <?php echo form_close() ?>
    </div>
</div>