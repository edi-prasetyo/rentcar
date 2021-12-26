<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <?php echo form_open('admin/destinasi'); ?>
                <div class="form-group">
                    <label>Kota Asal</label>
                    <input type="text" class="form-control" name="kota_asal" placeholder="Kota Asal" required="required">
                    <?php echo form_error('kota_asal', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label>Kota Tujuan</label>
                    <input type="text" class="form-control" name="kota_tujuan" placeholder="Kota Tujuan" required="required">
                    <?php echo form_error('kota_tujuan', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Simpan Destinasi">
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">

                <h3 class="card-title">Data Destinasi </h3>
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
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($destinasi as $data) : ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data->kota_asal; ?></td>
                            <td><?php echo $data->kota_tujuan; ?></td>
                            <td>
                                <?php include "update_kota.php"; ?>
                                <a href="<?php echo base_url(); ?>" class="btn btn-danger btn-sm">hapus</a>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>

                </tbody>
            </table>




        </div>

    </div>
</div>