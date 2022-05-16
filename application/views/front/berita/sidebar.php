<div class="card">
    <div class="card-header bg-white">
        <b>Category</b>
    </div>
    <ul class="list-group list-group-flush">
        <?php foreach ($category as $category) : ?>
            <li class="list-group-item"><a class="text-decoration-none text-muted" href="<?php echo base_url('category/item/' . $category->category_slug); ?>"> <i class="bi-tag"></i> <?php echo $category->category_name; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>


<?php foreach ($berita_sidebar as $data) : ?>
    <a class="text-decoration-none text-muted" href="<?php echo base_url('berita/detail/' . $data->berita_slug); ?>">
        <div class="card my-3">
            <div class="row no-gutters">
                <div class="col-md-5">
                    <img class="img-fluid" src="<?php echo base_url('assets/img/artikel/' . $data->berita_gambar); ?>" alt="...">
                </div>
                <div class="col-md-7">
                    <div class="p-3">
                        <h6><?php echo substr($berita->berita_title, 0, 35); ?></h6>
                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                    </div>
                </div>
            </div>
        </div>
    </a>

<?php endforeach; ?>