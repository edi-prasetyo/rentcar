<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>
<section class="bg-white">
    <div class="container py-3">
        <div class="row">
            <div class="col-2">
                <span style="font-size:50px"> <i class="fa-regular fa-circle-user"></i></span>
            </div>
            <div class="col-10">
                <div> <span class="font-weight-bold" style="font-size: 20px;"><?php echo $user->name; ?></span></div>
                <div> <?php echo $user->email; ?></div>
                <div><?php echo $user->user_phone; ?></div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <a href="<?php echo base_url('myaccount/update_profile'); ?>" class="btn btn-primary btn-block">Edit Profile</a>
            <a href="<?php echo base_url('myaccount/update_password'); ?>" class="btn btn-success btn-block">Ubah Password</a>
        </div>
    </div>


    <div class="container mt-3">
        <h5>Menu</h5>
    </div>
    <ul class="list-group">
        <a class="text-muted" href="<?php echo base_url('myaccount/point'); ?>" class="text-decoration-none">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div><i class="fa-solid fa-crown mr-2"></i> Point Saya</div>
                <i class="fa-solid fa-chevron-right"></i>
            </li>
        </a>
        <a class="text-muted" href="<?php echo base_url('myaccount/transaksi'); ?>" class="text-decoration-none">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div><i class="fa-solid fa-sack-dollar mr-2"></i> Transaksi Saya</div>
                <i class="fa-solid fa-chevron-right"></i>
            </li>
        </a>
        <a class="text-muted" href="<?php echo base_url(''); ?>" class="text-decoration-none">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div><i class="fa-solid fa-user-shield mr-2"></i> Kebijakan Privasi</div>
                <i class="fa-solid fa-chevron-right"></i>
            </li>
        </a>
        <a class="text-muted" href="<?php echo base_url(''); ?>" class="text-decoration-none">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div><i class="fa-solid fa-phone mr-2"></i> Call Center</div>
                <i class="fa-solid fa-chevron-right"></i>
            </li>
        </a>
    </ul>
    <div class="container mt-3">
        <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-danger btn-lg btn-block">Logout</a>
    </div>

</section>