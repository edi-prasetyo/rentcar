<div class="container my-5">
    <?php foreach ($page as $page) : ?>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2><a href="<?php echo base_url('page/detail/' . $page->page_slug); ?>" class="text-muted"><?php echo substr($page->page_title, 0, 20); ?></a> </h2>
                    <p><?php echo substr($page->page_desc, 0, 117); ?>..</p>
                    <a class="btn btn-outline-info" href="<?php echo base_url('page/detail/' . $page->page_slug); ?>">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>