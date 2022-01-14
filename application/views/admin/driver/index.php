<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <?php echo form_open('admin/driver'); ?>
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Masukan Nama" value="<?php echo set_value('search'); ?>">
                <div class="input-group-append">
                    <button class="btn btn-outline-info" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </h3>
        <div class="card-tools">
            <div class="card-tools">
                <a href="<?php echo base_url(); ?>admin/driver/create" class="btn btn-info btn-block"><i class="fa fa-plus"></i> Add Driver</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <?php
        //Notifikasi
        if ($this->session->flashdata('message')) {
            echo '<div class="alert alert-success alert-dismissable fade show">';
            echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
            echo $this->session->flashdata('message');
            unset($_SESSION['message']);
            echo '</div>';
        }
        echo validation_errors('<div class="alert alert-warning">', '</div>');

        ?>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>ID Driver</th>
                    <th>Nama</th>
                    <th>No. Hp</th>
                    <th>Saldo</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Locked</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($driver as $data) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data->user_code; ?></td>
                    <td><?php echo $data->name; ?></td>
                    <td><?php echo $data->user_phone; ?></td>
                    <td><?php echo $data->saldo_driver; ?></td>
                    <td><?php echo $data->role; ?></td>
                    <td>
                        <?php if ($data->is_active == 1) : ?>
                            <span class="badge badge-success">Aktif</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Nonactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($data->is_locked == 1) : ?>
                            <span class="badge badge-success">No</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Yes</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($data->is_locked == 0) : ?>
                            <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/driver/activated/' . $data->id); ?>"><i class="fas fa-check"></i></a>
                        <?php endif; ?>

                        <?php if ($data->is_active == 0) : ?>
                            <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/driver/activated/' . $data->id); ?>"><i class="fas fa-check"></i></a>
                        <?php else : ?>
                            <a class="btn btn-danger btn-sm" href="<?php echo base_url('admin/driver/banned/' . $data->id); ?>"><i class="fas fa-times"></i></a>

                        <?php endif; ?>
                        <a href="<?php echo base_url('admin/driver/detail/' . $data->id); ?>" class="btn btn-info btn-sm" target="blank"> <i class="fas fa-external-link-alt"></i> Lihat</a>
                    </td>
                </tr>

            <?php $no++;
            }; ?>
        </table>




    </div>
    <div class="card-footer">
        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>
</div>