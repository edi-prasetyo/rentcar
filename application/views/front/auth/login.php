<?php $meta = $this->meta_model->get_meta(); ?>
<div class="container">
    <div class="col-md-4 mx-auto">
        <div class="card my-5 p-4">
            <div class="card-body">
                <div class="col-md-12 mx-auto mb-4">
                    <img src="<?php echo base_url('assets/img/logo/' . $meta->logo); ?>" class="img-fluid">
                </div>

                <!-- Nested Row within Card Body -->
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
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope-open"></i> </span>
                        </div>
                        <input type="text" class="form-control form-control-user" name="email" id="email" placeholder="Enter Email Address..." value="<?php echo set_value('email'); ?>" style="text-transform: lowercase">
                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-unlock-alt"></i> </span>
                        </div>
                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>


                <div class="form-group">

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>
                    <a href="<?php echo base_url('auth/register'); ?>" class="btn btn-success btn-user btn-block">
                        Register
                    </a>

                </div>
                <?php echo form_close() ?>
            </div>


        </div>
    </div>
</div>