<div class="card">
    <div class="card-header">
        <div class="card-header-left">
            <h5><?php echo $title; ?></h5>
        </div>
        <div class="card-header-right">

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
        <a href="<?php echo base_url('admin/promo/create'); ?>" class="btn btn-info waves-effect waves-light">Buat Berita</a>
        <hr>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Promo</th>
                        <th>Expired</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <?php $no = 1;
                foreach ($promo as $promo) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $promo->name; ?></td>
                        <td> <?php echo date('d/m/Y', strtotime($promo->expired_at)); ?></td>
                        <td>Rp. <?php echo number_format($promo->price, 0, ",", "."); ?></td>
                        <td>
                            <?php if ($promo->is_active == 1) : ?>
                                <div class="badge badge-success"> Aktif</div>
                            <?php else : ?>
                                <div class="badge badge-danger"> Tidak Aktif</div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url('admin/promo/create'); ?>" class="btn btn-success btn-sm"><i class="ti-eye"></i> Lihat</a>
                            <a href="<?php echo base_url('admin/promo/update/' . $promo->id); ?>" class="btn btn-info btn-sm"><i class="ti-pencil-alt"></i> Edit</a>
                            <?php include "delete_promo.php"; ?>
                        </td>
                    </tr>

                <?php $no++;
                }; ?>
            </table>

            <div class="pagination col-md-12 text-center">
                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>
            </div>

        </div>

    </div>
</div>