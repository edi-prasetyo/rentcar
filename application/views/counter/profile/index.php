<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<div class="col-md-5 my-3 mx-auto">
    <div class="card">
        <div class="card-body">
            <div class="col-4 mx-auto">
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

        </div>
    </div>
    <div class="pb-5  mb-5">
        <ul class="list-group list-group-unbordered my-3">
            <li class="list-group-item">
                <b>No. Handphone </b> <span class="float-right"><?php echo $profile->user_phone; ?></span>
            </li>
            <li class="list-group-item">
                <b>Email</b> <span class="float-right"><?php echo $profile->email; ?></span>
            </li>
            <li class="list-group-item">
                <b>Counter ID</b> <span class="float-right"><?php echo $profile->user_code; ?></span>
            </li>
            <li class="list-group-item">
                <b>Alamat</b> <span class="float-right"><?php echo $profile->user_address; ?></span>
            </li>
            <li class="list-group-item">
                <b>Role</b> <span class="float-right"><?php echo $profile->name; ?></span>
            </li>
        </ul>
        <a href="<?php echo base_url('counter/profile/password'); ?>" class="btn btn-success btn-block">Ubah Password</a>
        <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-danger btn-block">Logout</a>
    </div>




</div>