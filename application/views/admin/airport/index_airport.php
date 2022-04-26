<div class="card">
    <div class="card-header bg-white">
        <h3 class="card-title">
            <?php echo $title; ?> - <?php echo $mobil->mobil_name; ?>
        </h3>
        <div class="card-tools">
            <a class="btn btn-primary text-white" href="<?php echo base_url('admin/mobil/create_dropoff/' . $mobil->id . '/1'); ?>"> <i class="fa fa-plus"></i> Buat Paket</a>
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
                    <th>Kota</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($airport as $data) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data->airport_name; ?></td>

                    <td>
                        <a href="<?php echo base_url('admin/mobil/create_airport/' . $mobil_id . '/' . $data->id); ?>" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Buat Paket</a>
                        <?php // include "delete_hourly.php";
                        ?>
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