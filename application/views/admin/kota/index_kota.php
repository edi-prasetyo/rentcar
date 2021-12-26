<div class="row">

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?php echo $title; ?></h3>
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
                        <th>Nama Kota</th>
                        <th>Destinasi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($kota as $kota) : ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $kota->provinsi_name; ?> - <?php echo $kota->kota_name; ?></td>
                            <td><a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/kota/tujuan/' . $kota->id); ?>">Set Destinasi Tujuan</a></td>

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