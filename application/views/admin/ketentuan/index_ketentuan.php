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
            echo '<div class="alert alert-success">';
            echo $this->session->flashdata('message');
            echo '</div>';
        }

        ?>
        <a href="<?php echo base_url('admin/ketentuan/create'); ?>" class="btn btn-rounded btn-info">Tambah Menu</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover example-table">
                <thead>
                    <tr>
                        <th>Nama Ketentuan Sewa</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php foreach ($ketentuan as $data) { ?>
                    <tr>
                        <td><?php echo $data->ketentuan_name; ?></td>
                        <td>
                            <a href="<?php echo base_url('admin/ketentuan/update/') . $data->id; ?>" class="btn btn-info btn-sm"><i class="icon-note"></i> Ubah</a>
                            <?php include "delete_ketentuan.php"; ?>
                        </td>
                    </tr>

                <?php }; ?>
            </table>
        </div>
    </div>
</div>