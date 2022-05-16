<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>

<div class="container mb-3">

    <div class="row">

        <div class="col-md-8">
            <div class="row">
                <?php foreach ($berita as $berita) : ?>
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <a class="text-decoration-none text-muted" href="<?php echo base_url('berita/detail/' . $berita->berita_slug); ?>">
                                <div class="img-frame">
                                    <img src="<?php echo base_url('assets/img/artikel/' . $berita->berita_gambar); ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title lh-lg"><?php echo substr($berita->berita_title, 0, 35); ?>..</h5>
                                </div>
                            </a>
                            <div class="card-footer bg-white">
                                <div class="badge badge-danger badge-pill">
                                    <a class="text-decoration-none text-white" href="<?php echo base_url('category/item/' . $berita->category_slug); ?>">
                                        <i class="ri-price-tag-3-line"></i> <?php echo $berita->category_name; ?>
                                    </a>
                                </div>
                            </div>

                        </div>


                    </div>
                <?php endforeach; ?>
            </div>
            <div class="pagination col-md-12 text-center">
                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>
            </div>
        </div>
        <div class="col-md-4">
            <?php include "sidebar.php"; ?>
        </div>
    </div>











    <div class="pagination col-md-12 text-center">
        <?php if (isset($paginasi)) {
            echo $paginasi;
        } ?>
    </div>
</div>