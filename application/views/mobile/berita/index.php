<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<div class="container my-5">

    <?php foreach ($berita as $data) : ?>
        <a class="text-decoration-none" href="<?php echo base_url('berita/detail/' . $data->berita_slug); ?>">
            <div class="d-flex align-items-center list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                <div class="list-card-image">
                    <img src="<?php echo base_url('assets/img/artikel/' . $data->berita_gambar); ?>" class="img-fluid item-img w-100">

                </div>
                <div class="p-3 position-relative">
                    <div class="list-card-body">
                        <h6 class="mb-1 text-muted"><?php echo substr($data->berita_title, 0, 35); ?>

                        </h6>
                        <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pb-1 pt-1"><i class="fa-solid fa-calendar-day"></i> <?php echo date('d/m/Y', strtotime($data->date_created)); ?> </span></p>
                    </div>

                </div>
            </div>
        </a>
    <?php endforeach; ?>


    <div class="pagination col-md-12 text-center">
        <?php if (isset($paginasi)) {
            echo $paginasi;
        } ?>
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
            <a href="<?php echo base_url('myaccount/transaksi'); ?>" class="text-dark small font-weight-bold text-decoration-none">
                <p class="h4 m-0"><i class="fa-solid fa-bag-shopping"></i></p>
                My Order
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