<?php
$user_id = $this->session->userdata('id');
$user = $this->user_model->user_detail($user_id);
?>

<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <?php echo $title; ?>
        </div>
        <div class="card-body">
            <!-- Nested Row within Card Body -->
            <?php
            echo form_open_multipart('admin/profile/update')
            ?>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">

                    Ganti Foto</label>
                <div class="col-md-8">
                    <div class="col-md-6">
                        <?php if($profile->user_image == NULL):?>
                       <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/img/avatars/default.jpg') ?>" alt="User profile picture">
                        <?php else:?>
                             <img class="img-fluid mb-3" src="<?php echo base_url('assets/img/avatars/' . $profile->user_image); ?>">
                            
                    
                <?php endif;?>
                    </div>
                    <input type="file" class="form-control" name="user_image">
                </div>
            </div>



            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nama Lengkap</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" value="<?php echo $profile->name; ?>">
                    <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Allamat Lengkap</label>
                <div class="col-md-8">
                    <textarea class="form-control" name="user_address" placeholder="Alamat Lengkap"><?php echo $profile->user_address; ?></textarea>
                    <?php echo form_error('user_address', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Nomor Hp</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="user_phone" placeholder="Nomor Handphone" value="<?php echo $profile->user_phone; ?>">
                    <?php echo form_error('user_phone', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Email</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo $profile->email; ?>" style="text-transform: lowercase" readonly>
                    <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right"></label>
                <div class="col-md-8">
                    <button type="submit" class="btn btn-primary btn-block">
                        Update Account
                    </button>
                </div>

                <?php echo form_close() ?>



            </div>
        </div>
    </div>