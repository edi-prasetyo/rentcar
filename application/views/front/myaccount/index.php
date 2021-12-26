<div class="container my-5">
    <div class="col-md-7 mx-auto">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <img class="img-fluid" src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>">
                    </div>
                    <div class="col-md-6">
                        <div><i class="fa fa-user"></i> <span class="font-weight-bold"><?php echo $user->name; ?></span></div>
                        <div><i class="fa fa-envelope"></i> <span class="font-weight-bold"><?php echo $user->email; ?></span></div>
                        <div><i class="fa fa-phone"></i> <span class="font-weight-bold"><?php echo $user->user_phone; ?></span></div>
                        <?php echo $user->id; ?>
                    </div>
                    <div class="col-md-3">
                        <a href="" class="btn btn-primary btn-block">Edit Profile</a>
                        <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-danger btn-block">Logout</a>
                    </div>
                </div>

            </div>
        </div>
        <div class="card">
            <ul class="list-group">
                <a href="<?php echo base_url('myaccount/point'); ?>" class="text-decoration-none">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Point
                        <span class="badge badge-primary badge-pill"><?php echo number_format($total_pointku->nominal_point, 0, ",", "."); ?></span>
                    </li>
                </a>
                <a href="<?php echo base_url('myaccount/transaksi'); ?>" class="text-decoration-none">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Transaksi

                    </li>
                </a>
            </ul>
        </div>
    </div>
</div>