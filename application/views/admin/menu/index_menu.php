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
        <a href="<?php echo base_url('admin/menu/create'); ?>" class="btn btn-rounded btn-info">Tambah Menu</a>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover example-table">
                <thead>
                    <tr>
                        <th>Nama Menu (ID)</th>
                        <th>Url</th>
                        <th>Urutan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php foreach ($list_menu as $menu) { ?>
                    <tr>
                        <td><?php echo $menu->nama_menu_ind; ?></td>
                        <td><?php echo $menu->url; ?></td>
                        <td><?php echo $menu->urutan; ?></td>
                        <td>
                            <a href="<?php echo base_url('admin/menu/update/') . $menu->id; ?>" class="btn btn-info btn-sm"><i class="icon-note"></i> Ubah</a>
                            <?php include "delete_menu.php"; ?>
                        </td>
                    </tr>

                <?php }; ?>
            </table>
        </div>
    </div>
</div>