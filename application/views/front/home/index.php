<?php $meta = $this->meta_model->get_meta(); ?>

<section class="pt-4 pb-3 mt-0 align-items-center bg-light" style="background-image: url(<?php echo base_url('assets/img/galery/1.jpg'); ?>); background-size: cover; min-height: 50vh;">
    <div class="container">
        <div class="container">
            <div class="row mb-md-4">
                <div class="col-12 col-lg-8 text-lg-start text-white">
                    <h3 class="text-warning small">Rental Mobil dengan Driver</h3>
                    <h2 class="title">Pilih Layanan Sewa mobil Sesuai kebutuhan</h2>
                    <p class="lead">
                        Kami menyediakan pilihan paket sewa mobil yang bisa anda pilih sesuai kebutuhan
                    </p>
                    <a class="text-white"><a class="btn btn-success text-white" href="https://wa.me/<?php echo $meta->whatsapp; ?>"><i class="fab fa-whatsapp"></i> Hubungi Kami Via Whatsapp </a></a>

                </div>
            </div>
        </div>
    </div>
</section>

<div class="section-product" id="services">
    <div class="container">
        <h2 class="title my-5 text-center">Pilih <span>Paket Sewa</span></h2>
        <div class="row">
            <?php foreach ($product as $data) : ?>
                <div class="col-md-4 col-6 my-2">
                    <a href="<?php echo base_url('/'); ?><?php echo $data->product_url; ?>" class="text-muted text-decoration-none product-button">
                        <div class="card shadow border-0 product-button" style="height:-130px;border-radius:15px">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div><img width="50%" class="img-fluid" src="<?php echo base_url('assets/img/galery/' . $data->image); ?>"> <?php echo $data->product_name; ?></div>
                                <div class="arrow-click"><i class="fas fa-arrow-right"></i></div>

                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<section id="services">
    <div class="container py-5">
        <h2 class="title my-5 text-center">Layanan <span>Rental Mobil</span></h2>
        <div class="row card-items">

            <div class="col-md-6 col-6">
                <div class="card shadow border-0 my-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="col-9">
                                <h4>Rental Harian</h4>
                                <p>Layanan Sewa Mobil paket Harian dengan driver</p>
                                <a class="btn btn-primary" href="<?php echo base_url('daily'); ?>">Booking </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-6">
                <div class="card shadow border-0 my-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <i class="far fa-clock"></i>
                            </div>
                            <div class="col-9">
                                <h4>Rental Per Jam</h4>
                                <p>Layanan Sewa mobil paket per jam</p>
                                <a class="btn btn-primary" href="<?php echo base_url('hourly'); ?>">Booking </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-6">
                <div class="card shadow border-0 my-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <i class="fas fa-car"></i>
                            </div>
                            <div class="col-9">
                                <h4>Rental online</h4>
                                <p>Layanan Sewa mobil dengan tarif per KM.</p>
                                <a class="btn btn-primary" href="<?php echo base_url('daily'); ?>">Booking </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-6">
                <div class="card shadow border-0 my-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <div class="col-9">
                                <h4>Sewa mobil Drop Off</h4>
                                <p>Layanan sewa mobil dari satu kota ke kota lain.</p>
                                <a class="btn btn-primary" href="<?php echo base_url('daily'); ?>">Booking </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="services" class="title text-center my-5">
    <h2 class="title my-5">Partner <span><?php echo $meta->title; ?></span></h2>
    <div class="container">
        <div class="col-md-7 mx-auto">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <img class="img-fluid" src="<?php echo base_url('assets/img/galery/partner_1.png'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <img class="img-fluid" src="<?php echo base_url('assets/img/galery/partner_2.png'); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <img class="img-fluid" src="<?php echo base_url('assets/img/galery/partner_3.png'); ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="services" class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <h2 class="title">Mengapa Memilih <span><?php echo $meta->title; ?></span>
                </h2>
                <p class=" mt-3 "><?php echo $meta->title; ?> merupakan layanan sewa mobil yang bisa anda gunakan di kota yang tersedia di seluruh Indonesia.</p>
                <p>
                    Kami menyediakan banyak paket sewa harian dan perjam. tersedia juga sewa mobil untuk luar kota. kami hadir untuk sewa mobil di berbagai wilayah kota
                </p>
                <a class="btn btn-primary my-5" href="#"><i class="fa fa-phone"></i> Info Selengkapnya </a>
            </div>
            <div class="col-lg-7">
                <div class="row card-items">
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <i class="far fa-handshake"></i>
                                <h5 class="card-title">Partner Rental Terbaik</h5>
                                <p class="card-text">Kami memiliki partner rental yang sudah terverifikasi.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <i class="fa fa-car"></i>
                                <h5 class="card-title">Pilihan Mobil Banyak</h5>
                                <p class="card-text">Kami memiliki partner sewa mobil yang memiliki banyak unit kendaraan.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <i class="fa fa-shield-alt"></i>
                                <h5 class="card-title"> Transaksi Aman dan Mudah</h5>
                                <p class="card-text">Lami menyediakan cara pembayaran cash atau Transfer</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <i class="fa fa-headphones-alt"></i>
                                <h5 class="card-title"> Customer support 24 Jam</h5>
                                <p class="card-text">Layanan 24 jam, jika anda butuh bantuan kami siap melayani.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>