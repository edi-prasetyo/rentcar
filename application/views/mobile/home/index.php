<?php
$meta = $this->meta_model->get_meta();
?>
<section class="bg-info" style="height: 60px;">
    <div class="col-7 mx-auto">
        <!-- <img class="img-fluid mt-3" src="<?php //echo base_url('assets/img/logo/' . $meta->logo); 
                                                ?>"> -->
        <!-- <span class="text-white mx-auto my-auto" style="font-size:30px;font-weight:bold"> Sewamobiloka</span> -->
    </div>
</section>

<div class="container" style="margin-top:-20px;">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 border-right text-muted">
                        <i class="fa-solid fa-ticket"></i> Point
                    </div>
                    <div class="col-6 text-right text-muted">
                        <i class="fa-solid fa-user"></i> Akun
                    </div>
                </div>
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
                        <div class="card shadow-sm border-0" style="border-radius: 15px;">
                            <div class=" card-body">
                                <img class="img-fluid" src="<?php echo base_url('assets/img/galery/' . $data->image); ?>">
                            </div>
                        </div>
                    </a>
                    <?php echo $data->product_name; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>




<div class="trending-slider">

    <div class="osahan-slider-item py-3 px-1">
        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
            <div class="list-card-image">
                <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> Kode Promo</span></div>
                <div class="member-plan position-absolute"><span class="badge badge-dark">Promo</span></div>
                <a href="restaurant.html">
                    <img src="<?php echo base_url('assets/img/galery/card-1.jpg'); ?>" class="img-fluid item-img w-100">
                </a>
            </div>
        </div>
    </div>

    <div class="py-3 px-1">
        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
            <div class="list-card-image">
                <div class="star position-absolute"><span class="badge badge-success"><i class="feather-star"></i> 3.1 (300+)</span></div>
                <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="feather-heart"></i></a></div>
                <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                <a href="restaurant.html">
                    <img src="<?php echo base_url('assets/img/galery/card-2.jpg'); ?>" class="img-fluid item-img w-100">
                </a>
            </div>

        </div>
    </div>

</div>





<div class="container mt-3 mb-5 pb-5">
    <div class="col-12">

        <div class="pb-3 title d-flex align-items-center">
            <h5 class="m-0 pt-3">Info Terbaru</h5>
            <a class="pt-3 font-weight-bold ml-auto" href="#">Lihat Semua <i class="feather-chevrons-right"></i></a>
        </div>

        <div class="d-flex align-items-center list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
            <div class="list-card-image">

                <a href="restaurant.html">
                    <img src="<?php echo base_url('assets/img/galery/card-2.jpg'); ?>" class="img-fluid item-img w-100">
                </a>
            </div>
            <div class="p-3 position-relative">
                <div class="list-card-body">
                    <h6 class="mb-1"><a href="restaurant.html" class="text-black">Lorem Ipsum is simply dummy text
                        </a>
                    </h6>
                    <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="fa-solid fa-calendar-day"></i> 23 Mei 2022</span> <span class="float-right text-black-50"> $500 FOR TWO</span></p>
                </div>
                <div class="list-card-badge">
                    <span class="badge badge-danger">Rental</span>
                </div>
            </div>
        </div>
    </div>

</div>



<!-- Footer Menu -->

<div class="carbook-menu-fotter fixed-bottom bg-white px-3 py-2 text-center shadow text-muted">
    <div class="row">
        <div class="col <?php if ($this->uri->segment(1) == "") {
                            echo 'selected text-info';
                        } ?>">
            <a href="<?php echo base_url(); ?>" class="text-dark small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="fa-solid fa-house"></i></p>
                Home
            </a>
        </div>


        <div class="col <?php if ($this->uri->segment(1) == "rental-mobil") {
                            echo 'selected text-info';
                        } ?>">
            <a href="<?php echo base_url('rental-mobil'); ?>" class="text-dark small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="fa-solid fa-bag-shopping"></i></p>
                Order
            </a>
        </div>




        <div class="col <?php if ($this->uri->segment(1) == "berita") {
                            echo 'selected text-info';
                        } ?>">
            <a href="<?php echo base_url('berita'); ?>" class="text-dark small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="fa-solid fa-fire-flame-curved"></i></p>
                News
            </a>
        </div>

        <?php if ($this->session->userdata('email')) : ?>

            <div class="col <?php if ($this->uri->segment(1) == "myaccount") {
                                echo 'selected text-info';
                            } ?>">

                <a href="<?php echo base_url('myaccount') ?>" class="text-dark small font-weight-bold text-decoration-none">
                    <p class="h4 m-0"><i class="fa-solid fa-user"></i></p>
                    Akun
                </a>

            </div>

        <?php else : ?>

            <div class="col <?php if ($this->uri->segment(1) == "auth") {
                                echo 'selected text-info';
                            } ?>">

                <a href="<?php echo base_url('auth') ?>" class="text-dark small font-weight-bold text-decoration-none">
                    <p class="h4 m-0"><i class="fa-solid fa-user"></i></p>
                    Akun
                </a>

            </div>

        <?php endif; ?>
    </div>
</div>