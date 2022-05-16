<?php
$meta = $this->meta_model->get_meta();
?>

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

        <?php
        echo form_open('auth/register')
        ?>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">Title</label>
            <div class="col-md-8">
                <select class="form-control form-control-lg shadow border-0" name="user_title" value="">
                    <option value='Bapak'>Bapak</option>
                    <option value='Ibu'>Ibu</option>
                    <option value='Saudara'>Saudara</option>
                    <option value='Saudari'>Saudari</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">Nama Lengkap</label>
            <div class="col-md-8">
                <input type="text" class="form-control form-control-lg shadow border-0" name="name" placeholder="Nama Lengkap" value="<?php echo set_value('name'); ?>">
                <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-4 text-md-right">No. Handphone</label>
            <div class="col-md-8">
                <input type="text" class="form-control form-control-lg shadow border-0" name="user_phone" placeholder="Nomor Handphone" value="<?php echo set_value('user_phone'); ?>">
                <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>
        <input type="hidden" class="form-control" name="email">

        <div class="form-group row">
            <label class="col-md-4 text-md-right">Email</label>
            <div class="col-md-8">
                <input type="text" class="form-control form-control-lg shadow border-0" name="real_email" placeholder="Email Address" value="<?php echo set_value('real_email'); ?>" style="text-transform: lowercase">
                <?php echo form_error('real_email', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 text-md-right">Password</label>
            <div class="col-md-8">
                <input type="password" class="form-control form-control-lg shadow border-0" name="password1" placeholder="Password">
                <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 text-md-right">Ulangi Password</label>
            <div class="col-md-8">
                <input type="password" class="form-control form-control-lg shadow border-0" name="password2" placeholder="Repeat Password">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-4 text-md-right"></label>
            <div class="col-md-8">

                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Daftar Sekarang
                </button>
            </div>
        </div>

        <?php echo form_close() ?>



    </div>

</div>