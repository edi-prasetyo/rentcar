<div class="card">
    <div class="card-header">

        <div class="row">
            <div class="col-md-3">
                <?php echo form_open('admin/customer'); ?>
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Masukan Nama" value="<?php echo set_value('search'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="col-md-3">
                <?php echo form_open('admin/customer'); ?>
                <div class="input-group mb-3">
                    <input type="text" name="search_email" class="form-control" placeholder="Masukan Email" value="<?php echo set_value('search_email'); ?>">
                    <div class="input-group-append">
                        <button class="btn btn-info" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>


            <div class="col-md-3">
                <div class="card-tools">
                    <a href="<?php echo base_url(); ?>admin/customer/create" class="btn btn-info btn-block"><i class="fa fa-plus"></i> Add Customer</a>
                </div>
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
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Point</th>
                    <th>Status</th>
                    <th>Locked</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($customer_point as $customer) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $customer->id; ?></td>
                    <td><?php echo $customer->name; ?></td>
                    <td><?php echo $customer->email; ?></td>
                    <td><?php echo $customer->user_phone; ?></td>
                    <td><?php echo $customer->nominal_point; ?></td>

                    <td>
                        <?php if ($customer->is_active == 1) : ?>
                            <span class="badge badge-success">Aktif</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Nonactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($customer->is_locked == 1) : ?>
                            <span class="badge badge-success">No</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Yes</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($customer->is_locked == 0) : ?>
                            <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/customer/activated/' . $customer->id); ?>"><i class="fas fa-check"></i></a>
                        <?php endif; ?>

                        <?php if ($customer->is_active == 0) : ?>
                            <a class="btn btn-success btn-sm" href="<?php echo base_url('admin/customer/activated/' . $customer->id); ?>"><i class="fas fa-check"></i></a>
                        <?php else : ?>
                            <a class="btn btn-danger btn-sm" href="<?php echo base_url('admin/customer/banned/' . $customer->id); ?>"><i class="fas fa-times"></i></a>

                        <?php endif; ?>
                        <a href="<?php echo base_url('admin/customer/detail/' . $customer->id); ?>" class="btn btn-info btn-sm"> <i class="fas fa-eye"></i></a>
                        <!-- <a href="<?php echo base_url('admin/customer/saldo/' . $customer->id); ?>" class="btn btn-success btn-sm"> <i class="fas fa-wallet"></i></a>
                        <a href="<?php echo base_url('admin/customer/transaksi/' . $customer->id); ?>" class="btn btn-warning btn-sm"> <i class="fas fa-shopping-bag"></i></a> -->
                    </td>
                </tr>

            <?php $no++;
            }; ?>
        </table>




    </div>
    <div class="card-footer">
        <div class="pagination col-md-12 text-center">
            <?php

            if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>
</div>