<div class="card">
    <div class="card-header">
        <div class="card-header-left">
            <h5><?php echo $title; ?></h5>
        </div>
        <div class="card-header-right">
            <a class="btn btn-primary" href="<?php echo base_url('admin/galery/create'); ?>"> Buat Galery</a>
        </div>

    </div>
    <div class="card-body">
        <?php
        //Notifikasi
        if ($this->session->flashdata('message')) {
            echo '<div class="alert alert-success alert-dismissable fade show">';
            echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
            echo $this->session->flashdata('message');
            echo '</div>';
        }
        echo validation_errors('<div class="alert alert-warning">', '</div>');

        ?>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Gambar</th>
                        <th>Judul Gambar</th>
                        <th>Type</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <?php $no = 1;
                foreach ($galery as $galery) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><img class="img-fluid" src="<?php echo base_url('assets/img/galery/' . $galery->galery_img); ?>"></td>
                        <td><?php echo $galery->galery_title; ?></td>
                        <td>
                            <?php if ($galery->galery_type == "Slider") : ?>
                                <div class="badge badge-success">Slider</div>
                            <?php elseif ($galery->galery_type == "Halaman") : ?>
                                <div class="badge badge-danger">Halaman</div>
                            <?php else : ?>
                                <div class="badge badge-info">Featured</div>
                            <?php endif; ?>



                        </td>
                        <td>
                            <a href="<?php echo base_url('galery/detail/' . $galery->galery_slug); ?>" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Lihat</a>
                            <a href="<?php echo base_url('admin/galery/update/' . $galery->id); ?>" class="btn btn-success btn-sm"><i class="far fa-edit"></i> Edit</a>
                            <?php include "delete_galery.php"; ?>
                        </td>
                    </tr>

                <?php $no++;
                }; ?>
            </table>
            <hr>
            <div class="pagination col-md-12 text-center">
                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>
            </div>

        </div>

    </div>
</div>