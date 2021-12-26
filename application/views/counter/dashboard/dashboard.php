<?php $meta = $this->meta_model->get_meta(); ?>
<nav class="site-header sticky-top py-1" style="background-color: transparent;position:absolute">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a class="text-white text-center" href="#" aria-label="Product">
        </a>
    </div>
</nav>


<section class="boot-elemant-bg py-md-5 py-4 hero" style="height: 130px;background-color:rgba(0, 80, 184)">
    <div class="container position-relative py-md-5 py-0">
        <div class="row">
            <div class="container" style="position: absolute;">
                <div class="row">
                    <div class="col-md-7">
                        <div class="text-center text-white mt-3" style="font-size:x-large;">
                            <p><i class="ri-flight-takeoff-line"></i> <span class="font-weight-bold"><?php echo $meta->title; ?></span></p>
                        </div>
                    </div>
                    <div class="col-md-5">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="elemant-bg-overlay black"></div>
    <svg class="hero-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10" preserveAspectRatio="none">
        <path d="M0 10 0 0 A 90 59, 0, 0, 0, 100 0 L 100 10 Z"></path>
    </svg>
</section>

<div class="container productcat">
    <div class="row my-3">
        <div class="col-6 my-2">
            <a href="<?php echo base_url('counter/transaksi/calculate'); ?>" class="text-dark small font-weight-bold text-decoration-none">
                <div class="card shadow-sm text-center border-0">
                    <div class="card-body">
                        <p class="h3 m-0 text-info"><i class="ri-car-line"></i></p>
                        Online
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 my-2">
            <a href="<?php echo base_url('counter/transaksi/createjk'); ?>" class="text-dark small font-weight-bold text-decoration-none">
                <div class="card shadow-sm text-center border-0">
                    <div class="card-body">
                        <p class="h3 m-0 text-danger"><i class="ri-caravan-line"></i></i></p>
                        JK
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 my-2">
            <a href="<?php echo base_url('counter/transaksi/riwayat'); ?>" class="text-dark small font-weight-bold text-decoration-none">
                <div class="card shadow-sm text-center border-0">
                    <div class="card-body">
                        <p class="h3 m-0 text-primary"><i class="ri-file-paper-line"></i></p>
                        Riwayat
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 my-2">
            <a href="<?php echo base_url('counter/profile'); ?>" class="text-dark small font-weight-bold text-decoration-none">
                <div class="card shadow-sm text-center border-0">
                    <div class="card-body">
                        <p class="h3 m-0 text-success"><i class="ri-user-line"></i></p>
                        Akun
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>