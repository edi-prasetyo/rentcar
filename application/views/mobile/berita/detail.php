<nav class="site-header bg-white sticky-top py-1 shadow-sm">
    <div class="container py-2 d-flex justify-content-between align-items-center">
        <a style="text-decoration:none;" class="text-dark text-left" href="javascript:history.back()"><i style="font-size: 25px;" class="ri-arrow-left-line"></i></a>
        <span class="text-dark text-center font-weight-bold">
            <?php echo $title; ?>
        </span>
        <div style="color:transparent;"></div>
    </div>
</nav>

<img class="img-fluid" src="<?php echo base_url('assets/img/artikel/' . $berita->berita_gambar); ?>">


<div class="container mb-3">
    <div class="card-body">
        <h3><?php echo $berita->berita_title; ?></h3>
    </div>
    <div class="card-body">
        <?php echo $berita->berita_desc; ?>
    </div>
</div>