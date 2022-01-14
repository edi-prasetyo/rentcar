<?php
$meta = $this->meta_model->get_meta();
?>


<div class="container">
    <div class="col-md-6 mx-auto">
        <div class="card my-5">
            <div class="card-header bg-white">
                <h5 class="text-center">Daftar</h5>
            </div>
            <div class="card-body">
                <?php
                echo form_open('auth/register')
                ?>
                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Title</label>
                    <div class="col-md-8">
                        <select class="form-control form-control-chosen" name="user_title" value="">
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
                        <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="<?php echo set_value('name'); ?>">
                        <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 text-md-right">No. Handphone</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="user_phone" placeholder="Nomor Handphone" value="<?php echo set_value('user_phone'); ?>">
                        <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="email">

                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Email</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="real_email" placeholder="Email Address" value="<?php echo set_value('real_email'); ?>" style="text-transform: lowercase">
                        <?php echo form_error('real_email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Password</label>
                    <div class="col-md-8">
                        <input type="password" class="form-control" name="password1" placeholder="Password">
                        <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-md-right">Ulangi Password</label>
                    <div class="col-md-8">
                        <input type="password" class="form-control" name="password2" placeholder="Repeat Password">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 text-md-right"></label>
                    <div class="col-md-8">

                        <button type="submit" class="btn btn-primary btn-block">
                            Daftar Sekarang
                        </button>
                    </div>
                </div>

                <?php echo form_close() ?>



            </div>
            <div class="card-footer bg-white">
                <a class="btn btn-warning btn-sm" href="<?php echo base_url('auth/forgotpassword'); ?>">Lupa Password</a>
                <a class="btn btn-success btn-sm" href="<?php echo base_url('auth') ?>">Login</a>
            </div>
        </div>
    </div>
</div>