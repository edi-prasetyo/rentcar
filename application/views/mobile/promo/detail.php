<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<img class="img-fluid" src="<?php echo base_url('assets/img/promo/' . $promo->image); ?>">


<div class="container mb-3">

    <div class="badge badge-success">Kode Promo</div>
    <div class="alert alert-success text-center">
        <h3><?php echo $promo->name; ?></h3>
    </div>
    <?php echo $promo->description; ?>
</div>