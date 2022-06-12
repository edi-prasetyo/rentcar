<div class="row">

    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="card-title"><?php echo $title; ?></h5>
                <div class="card-tools">
                    <a href="<?php echo base_url('admin/airport/create') ?>" title="Tambah Bandara" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah bandara</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php
                //Notifikasi
                if ($this->session->flashdata('message')) {
                    echo $this->session->flashdata('message');
                    unset($_SESSION['message']);
                }
                echo validation_errors('<div class="alert alert-warning">', '</div>');

                ?>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Kota</th>
                        <th>Nama Bandara</th>
                        <th>Kode Bandara</th>
                        <th width="20%">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($airport as $airport) : ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $airport->kota_name; ?></td>
                            <td><?php echo $airport->airport_name; ?></td>
                            <td><?php echo $airport->airport_code; ?></td>
                            <td><a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/airport/update/' . $airport->id); ?>">Update</a>
                                <?php include "delete.php"; ?>
                            </td>

                        </tr>
                    <?php $no++;
                    endforeach; ?>

                </tbody>
            </table>


            <div class="card-footer bg-white border-top">

                <div class="pagination col-md-12 text-center p-0 m-0">
                    <?php if (isset($pagination)) {
                        echo $pagination;
                    } ?>
                </div>
            </div>


        </div>

    </div>
</div>