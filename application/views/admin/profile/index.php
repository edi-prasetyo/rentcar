<div class="row">
    <div class="col-md-5 mx-auto">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">


                <?php
                //Notifikasi
                if ($this->session->flashdata('message')) {
                    echo '<div class="alert alert-success alert-dismissable fade show">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    echo $this->session->flashdata('message');
                    unset($_SESSION['message']);
                    echo '</div>';
                }
                echo validation_errors('<div class="alert alert-warning">', '</div>');

                ?>

                <div class="text-center">
                    <?php if ($profile->user_image == NULL) : ?>
                        <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/img/avatars/default.jpg') ?>" alt="User profile picture">
                    <?php else : ?>
                        <img class="profile-user-img img-fluid img-circle" src="<?php echo base_url('assets/img/avatars/' . $profile->user_image) ?>" alt="User profile picture">


                    <?php endif; ?>
                </div>

                <h3 class="profile-username text-center"><?php
                                                            echo $profile->name;
                                                            ?></h3>

                <p class="text-muted text-center"><?php echo $profile->role; ?> </p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>No. Handphone </b> <span class="float-right"><?php echo $profile->user_phone; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <span class="float-right"><?php echo $profile->email; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b> ID</b> <span class="float-right"><?php echo $profile->user_code; ?></span>
                    </li>
                    <li class="list-group-item">
                        <b>Alamat</b> <span class="float-right"><?php echo $profile->user_address; ?></span>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-6">
                        <a href="<?php echo base_url('admin/profile/update'); ?>" class="btn btn-primary btn-block"><b>Ubah Data</b></a>
                    </div>
                    <div class="col-6">
                        <a href="<?php echo base_url('admin/profile/password'); ?>" class="btn btn-info btn-block"><b>Ubah Password</b></a>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>