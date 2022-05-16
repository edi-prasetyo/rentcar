<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>
<div class="container">
    <div class="col-md-12">
        <div class="text-center">

            <h5 class="mb-4"><?php echo $this->session->userdata('reset_email'); ?></h5>
            <?php echo $this->session->flashdata('message'); ?>
        </div>
        <?php
        $attributes = array('class' => 'user');
        echo form_open('auth/changepassword', $attributes)
        ?>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control form-control-lg shadow border-0" name="password1" id="password1" placeholder="Password...">
            <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group">
            <label>Ulangi Password</label>
            <input type="password" class="form-control form-control-lg shadow border-0" name="password2" id="password2" placeholder="Ulangi Password...">
            <?php echo form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
        </div>

        <div class="form-group my-5">
            <button type="submit" class="btn btn-primary btn-user btn-block btn-lg shadow">
                Ubah Password
            </button>
        </div>

        <?php echo form_close() ?>
    </div>
</div>