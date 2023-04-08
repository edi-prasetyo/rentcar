<div class="card">
    <div class="card-header">
        <b><?php echo $title; ?></b>
        <div class="card-tools">
            <?php include "create_provinsi.php"; ?>
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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Provinsi</th>
                    <th width="30%">Data Kota</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($provinsi as $provinsi) { ?>
                    <tr>
                        <td><?php echo $provinsi->id; ?></td>
                        <td><?php echo $provinsi->provinsi_name; ?></td>
                        <td> <a href="<?php echo base_url('admin/provinsi/kota/' . $provinsi->id); ?>" class="btn btn-info btn-sm btn-block"><i class="fa fa-plus"></i> Tambah Kota / Kabupaten </a>
                        </td>
                        <td>
                            <?php include "update_provinsi.php"; ?>
                            <?php //include "delete_provinsi.php"; 
                            ?>
                        </td>
                    </tr>

                <?php }; ?>


            </tbody>
        </table>
    </div>

    <div class="card-footer bg-white border-top">

        <div class="pagination col-md-12 text-center p-0 m-0">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>
</div>