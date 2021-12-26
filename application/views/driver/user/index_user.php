<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?php echo $title; ?></h3>
        <div class="card-tools">
            <a href="<?php echo base_url(); ?>admin/user/create_agen" class="btn btn-info right"><i class="fa fa-plus"></i> Buat Main Agen</a>
        </div>
    </div>

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
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>ID Agen</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Status</th>

                    <th width="30%"></th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($my_counter as $my_counter) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $my_counter->user_code; ?></td>
                    <td><?php echo $my_counter->name; ?></td>
                    <td><?php echo $my_counter->role; ?></td>
                    <td>
                        <?php if ($my_counter->is_active == 1) : ?>
                            <span class="badge badge-success">Aktif</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Nonactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url('admin/user/detail/' . $my_counter->id); ?>" class="btn btn-info btn-sm" target="blank"> <i class="fas fa-external-link-alt"></i> Lihat</a>
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