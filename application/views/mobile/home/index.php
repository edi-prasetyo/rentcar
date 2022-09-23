<?php
$meta = $this->meta_model->get_meta();
$user_id = $this->session->userdata('id');
$user = $this->user_model->user_detail($user_id);
// var_dump($user);
// die;
?>
<section class="bg-primary" style="height: 80px;">
    <div class="container">
        <h5 class="my-auto text-white text-center pt-3 font-weight-bold"><?php echo $meta->title; ?></h5>
    </div>

</section>

<div class="container" style="margin-top:-20px;">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">

                <?php if ($user == null) : ?>
                    <div class="col-md-12 text-muted text-center mb-2" style="font-size: 13px;">
                        Daftar Member & Kumpulkan Pointnya
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn-outline-info btn-block" href="<?php echo base_url('auth'); ?>">Masuk</a>
                        </div>
                        <div class="col-6">
                            <a class="btn btn-success btn-block" href="<?php echo base_url('auth/register'); ?>">Daftar</a>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <div class="col-6 border-right text-muted" style="font-size: 14px;">
                            <i class="fa-solid fa-ticket"></i> <?php echo number_format($total_pointku->nominal_point, 0, ",", "."); ?>
                        </div>
                        <div class="col-6 text-right text-muted" style="font-size: 14px;">
                            <i class="fa-solid fa-user"></i> <?php echo $user->name; ?>
                        </div>
                    </div>
                <?php endif; ?>



            </div>
        </div>
    </div>
</div>

<!-- <div class="container mt-4">
    <div class="col-12">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
           
            <div class="carousel-inner">
                <?php $i = 1;
                foreach ($mobile_slider as $mobile_slider) { ?>
                    <div class="carousel-item <?php if ($i == 1) {
                                                    echo 'active';
                                                } ?> ">
                        <a href="<?php echo base_url() . $mobile_slider->galery_url; ?>"><img class="img-fluid" style="border-radius: 15px;" width="100%" src="<?php echo base_url('assets/img/galery/' . $mobile_slider->galery_img) ?>" alt="<?php echo $mobile_slider->galery_title ?>"></a>
                        <div class="container">
                            <div class="carousel-caption text-left">
                            </div>
                        </div>
                    </div>
                <?php $i++;
                } ?>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div> -->

<div class="container mt-3">
    <div class="col-12">
        <div class="row">
            <?php foreach ($product as $data) : ?>
                <div class="col-4 text-center col-md-offset-2">
                    <a href="<?php echo base_url('/' . $data->product_url); ?>">
                        <div class="card shadow border-0 " style="border-radius: 15px;">
                            <div class="card-body">
                                <img class="img-fluid" src="<?php echo base_url('assets/img/galery/' . $data->image); ?>">
                            </div>
                        </div>
                    </a>
                    <div class="text-muted mt-2" style="font-size: 14px;"> <?php echo $data->product_name; ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<div class="container my-3">
    <a class="btn btn-block btn-success" href="https://wa.me/<?php echo $meta->whatsapp; ?>"><i class="fab fa-whatsapp"></i> Hubungi Kami</a>
</div>

<div class="trending-slider mt-3">

    <?php foreach ($promo_home as $data) : ?>

        <div class="py-3 px-1">
            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                <div class="list-card-image">
                    <div class="star position-absolute"><span class="badge badge-success"> <?php echo $data->name; ?> </span></div>
                    <div class="member-plan position-absolute"><span class="badge badge-dark"> <i class="fa-solid fa-ticket-simple mr-2"></i> Promo</span></div>
                    <a href="<?php echo base_url('promo/detail/' . $data->promo_slug); ?>">
                        <img src="<?php echo base_url('assets/img/promo/' . $data->image); ?>" class="img-fluid item-img w-100">
                    </a>
                </div>

            </div>
        </div>
    <?php endforeach; ?>

</div>


<div class="container mt-3 mb-5 pb-5">
    <div class="col-12">

        <div class="pb-3 title d-flex align-items-center">
            <h5 class="m-0 pt-3">Info Terbaru</h5>
            <a class="pt-3 font-weight-bold ml-auto" href="<?php echo base_url('berita'); ?>">Lihat Semua <i class="feather-chevrons-right"></i></a>
        </div>


        <?php foreach ($berita_home as $data) : ?>
            <a class="text-decoration-none" href="<?php echo base_url('berita/detail/' . $data->berita_slug); ?>">
                <div class="d-flex align-items-center list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                    <div class="list-card-image">
                        <img src="<?php echo base_url('assets/img/artikel/' . $data->berita_gambar); ?>" class="img-fluid item-img w-100">

                    </div>
                    <div class="p-3 position-relative">
                        <div class="list-card-body">
                            <h6 class="mb-1 text-muted"><?php echo substr($data->berita_title, 0, 35); ?>

                            </h6>
                            <p class="text-gray mb-3 time"><span class="bg-light text-muted rounded-sm pb-1 pt-1"><i class="fa-solid fa-calendar-day"></i> <?php echo date('d F Y', strtotime($data->date_created)); ?> </span></p>
                        </div>

                    </div>
                </div>
            </a>
        <?php endforeach; ?>


    </div>

</div>



<!-- Footer Menu -->

<div class="carbook-menu-fotter fixed-bottom bg-white px-3 py-2 text-center shadow text-muted">
    <div class="row">
        <div class="col <?php if ($this->uri->segment(1) == "") {
                            echo 'selected text-info';
                        } ?>">
            <a href="<?php echo base_url(); ?>" class="text-muted small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="fa-solid fa-house"></i></p>
                Home
            </a>
        </div>


        <div class="col <?php if ($this->uri->segment(1) == "rental-mobil") {
                            echo 'selected text-info';
                        } ?>">
            <a href="<?php echo base_url('myaccount/transaksi'); ?>" class="text-muted small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="fa-solid fa-bag-shopping"></i></p>
                My Order
            </a>
        </div>




        <div class="col <?php if ($this->uri->segment(1) == "berita") {
                            echo 'selected text-info';
                        } ?>">
            <a href="<?php echo base_url('berita'); ?>" class="text-muted small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="fa-solid fa-fire-flame-curved"></i></p>
                News
            </a>
        </div>

        <?php if ($this->session->userdata('email')) : ?>

            <div class="col <?php if ($this->uri->segment(1) == "myaccount") {
                                echo 'selected text-info';
                            } ?>">

                <a href="<?php echo base_url('myaccount') ?>" class="text-muted small font-weight-bold text-decoration-none">
                    <p class="h4 m-0"><i class="fa-solid fa-user"></i></p>
                    Akun
                </a>

            </div>

        <?php else : ?>

            <div class="col <?php if ($this->uri->segment(1) == "auth") {
                                echo 'selected text-info';
                            } ?>">

                <a href="<?php echo base_url('auth') ?>" class="text-muted small font-weight-bold text-decoration-none">
                    <p class="h4 m-0"><i class="fa-solid fa-user"></i></p>
                    Akun
                </a>

            </div>

        <?php endif; ?>
    </div>
</div>