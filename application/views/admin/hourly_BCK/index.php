<div class="card">
    <div class="card-header bg-white">
        <h3 class="card-title">
            <?php echo $title; ?> - <?php echo $mobil->mobil_name; ?>
        </h3>
        <div class="card-tools">
            <a class="btn btn-primary" href="<?php echo base_url('admin/mobil/create_hourly/' . $mobil->id); ?>"> <i class="fa fa-plus"></i> Buat Paket</a>
        </div>

    </div>
    <?php
    //Notifikasi
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    echo validation_errors('<div class="alert alert-warning">', '</div>');

    ?>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Paket</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($hourly as $hourly) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $hourly->paket; ?></td>
                    <td>Rp. <?php echo number_format($hourly->price, '0', ',', '.'); ?></td>
                    <td><?php if ($hourly->status == true) : ?>
                            <div class="badge badge-success">Aktif</div>
                        <?php else : ?>
                            <div class="badge badge-danger">Nonaktif</div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <!-- <a href="<?php //echo base_url('hourly/detail/' . $hourly->id); 
                                        ?>" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt"></i> Lihat</a> -->
                        <a href="<?php echo base_url('admin/hourly/update/' . $hourly->id); ?>" class="btn btn-success btn-sm"><i class="far fa-edit"></i> Edit</a>
                        <!-- <?php //include "delete_hourly.php"; 
                                ?> -->
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